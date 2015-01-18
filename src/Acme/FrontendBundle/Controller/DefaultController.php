<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends CustomerController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $session->set('is_visitor', true);
        $objORM = $this->getDoctrine()->getManager();
        /*$test = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMDetailsList();
        echo '<pre>';
        print_r($test);
        echo '</pre>';exit;*/
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findAll();
        $arrChampionlogPRC = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::PRCZONE, 22);
        $arrChampionlogHKTW = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::HKTWZONE, 22);
        $arrStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(5, 4, 'timeCreateTime', 'DESC');
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $intLastTermNo = $session->get('last_term_no');
        $arrLastRankSongPRC = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::PRCZONE, 20, $intLastTermNo);
        $arrLastRankSongHKTW = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::HKTWZONE, 20, $intLastTermNo);
        $intNextRankTime = $session->get('next_rank_time');
        return $this->render('AcmeFrontendBundle:Default:index.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'flash' => $arrFlash,
                'champion_log_prc' => $arrChampionlogPRC,
                'champion_log_hktw' => $arrChampionlogHKTW,
                'articles' => $arrStarInterviewList,
                'rank_songs_prc' => $arrLastRankSongPRC,
                'rank_songs_hktw' => $arrLastRankSongHKTW,
                'fms' => $arrFMList,
                'current_term_no' => $intLastTermNo,
                'next_rank_time' => $intNextRankTime,
            ));
    }

    /**
     * @param $token
     * @return Response
     * @Route("/play/{token}", name="_play")
     */
    public function playAction($token)
    {
        $md5 = substr($token, 0, 32);
        $id = substr($token, 32);
        $request = $this->getRequest();
        $session = $request->getSession();
        $boolIsVistor = $session->get('is_visitor');
        if(!$boolIsVistor)
            return new Response('請勿盜鏈 Please Do Not Pivate Link');
        $objORM = $this->getDoctrine()->getManager();
        $song =
            $objORM->getRepository('AcmeBackendBundle:Song')->find($id);
        if(md5($song->getStrSongFile()) != $md5)
            return new Response('請勿盜鏈 Please Do Not Pivate Link');

        $options = array(
            'serve_filename' => $song->getStrTitle().".".pathinfo($song->getStrSongFile(), PATHINFO_EXTENSION),
            'absolute_path' => false,
            'inline' => false,
        );
        if(strpos($song->getStrSongFile(), '.mp3')>0)
            $strMimeType = 'audio/mpeg';
        if(strpos($song->getStrSongFile(), '.wav')>0)
            $strMimeType = 'audio/x-wav';
        return $this->get('igorw_file_serve.response_factory')
            ->create('../web/uploads/gallery/'.$song->getStrSongFile(), $strMimeType, $options);
    }

    /**
     * @param $id
     * @return Response
     * @Route("/fm/{id}", name="_fm")
     */
    public function fmAction($id)
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("fm", name="_fm_list")
     */
    public function fmListAction()
    {
        return new Response();
    }

}

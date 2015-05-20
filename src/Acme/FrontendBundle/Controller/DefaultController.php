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
            ->getArrFrontendInfo(600);
        $arrFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findBy(array('intCategory' => 0));
        $arrFlash2 = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findBy(array('intCategory' => 2));
        $arrChampionlogPRC = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::PRCZONE, 22, 600);
        $arrChampionlogHKTW = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::HKTWZONE, 22, 600);
        $arrStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(5, 5, 'timeCreateTime', 'DESC', 600);
        $arrIndustryNewsList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(1, 5, 'timeCreateTime', 'DESC', 600);
        $arrEntertainmentList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(2, 5, 'timeCreateTime', 'DESC', 600);
        $arrTodayNewsList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(3, 5, 'timeCreateTime', 'DESC', 600);
        $arrHotPicList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(4, 5, 'timeCreateTime', 'DESC', 600);
        $arrDJInfoList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(6, 5, 'timeCreateTime', 'DESC', 600);
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC', 600);
        $intLastTermNo = $session->get('last_term_no');
        $arrLastRankSongPRC = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::PRCZONE, 20, $intLastTermNo, null, 600);
        $arrLastRankSongHKTW = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::HKTWZONE, 20, $intLastTermNo, null, 600);
        $intNextRankTime = $session->get('next_rank_time');
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7, 600);
        $response = $this->render('AcmeFrontendBundle:Default:index.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'flash' => $arrFlash,
                'flash2' => $arrFlash2,
                'champion_log_prc' => $arrChampionlogPRC,
                'champion_log_hktw' => $arrChampionlogHKTW,
                'articles' => $arrStarInterviewList,
                'articles1' => $arrIndustryNewsList,
                'articles2' => $arrEntertainmentList,
                'articles3' => $arrTodayNewsList,
                'articles4' => $arrHotPicList,
                'articles6' => $arrDJInfoList,
                'coops' => $arrCoopList,
                'rank_songs_prc' => $arrLastRankSongPRC,
                'rank_songs_hktw' => $arrLastRankSongHKTW,
                'fms' => $arrFMList,
                'current_term_no' => $intLastTermNo + 1,
                'last_term_no' => $intLastTermNo,
                'next_rank_time' => $intNextRankTime,
            ));
        $response->setETag(md5($response->getContent()));
        $response->setPublic(); // make sure the response is public/cacheable
        $response->isNotModified($request);

        return $response;
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
     * @param $token
     * @return Response
     * @Route("/playact/{token}", name="_playact")
     */
    public function playActAction($token)
    {
        $md5 = substr($token, 0, 32);
        $id = substr($token, 32);
        $request = $this->getRequest();
        $session = $request->getSession();
        $boolIsVistor = $session->get('is_visitor');
        //if(!$boolIsVistor)
            //return new Response('請勿盜鏈 Please Do Not Pivate Link');
        $objORM = $this->getDoctrine()->getManager();
        $act =
            $objORM->getRepository('AcmeBackendBundle:Act')->find($id);
        if(md5($act->getStrActFile()) != $md5)
            return new Response('請勿盜鏈 Please Do Not Pivate Link');

        $options = array(
            'serve_filename' => $act->getStrTitle().".".pathinfo($act->getStrActFile(), PATHINFO_EXTENSION),
            'absolute_path' => false,
            'inline' => false,
        );
        if(strpos($act->getStrActFile(), '.mp3')>0)
            $strMimeType = 'audio/mpeg';
        if(strpos($act->getStrActFile(), '.wav')>0)
            $strMimeType = 'audio/x-wav';
        return $this->get('igorw_file_serve.response_factory')
            ->create('../web/uploads/gallery/'.$act->getStrActFile(), $strMimeType, $options);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/coop", name="_coop")
     */
    public function coopAction(Request $request)
    {
        $objORM = $this->getDoctrine()->getManager();
        $coops =
            $objORM->getRepository('AcmeFrontendBundle:Coop')->getArrCoopList();
        return new Response();
    }


}

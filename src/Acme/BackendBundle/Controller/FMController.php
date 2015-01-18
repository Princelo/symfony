<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Act;
use Acme\BackendBundle\Entity\Championlog;
use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Entity\Votelog;
use Acme\BackendBundle\Form\Type\ActType;
use Acme\BackendBundle\Form\Type\AdminWizardType;
use Acme\BackendBundle\Form\Type\EditFMType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\BackendBundle\Form\Type\AdminRegistrationType;
use Acme\BackendBundle\Form\Type\CorpRegistrationType;
use Acme\BackendBundle\Form\Type\FMRegistrationType;
use Acme\BackendBundle\Form\Model\Registration;
use Acme\BackendBundle\Form\Model\CorpRegistration;
use Acme\BackendBundle\Form\Model\FMRegistration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BackendBundle\Entity\Member;
use Acme\BackendBundle\Entity\Corp;
use Acme\BackendBundle\Entity\FM;
use Acme\BackendBundle\Entity\City;
use Acme\BackendBundle\Entity\Artist;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class FMController extends DefaultController
{

    /**
     * @return Response
     * @Route("/fm", name="_fm_index")
     */
    public function fmIndexAction()
    {
        parent::init();
        $arrMemberInfo = array(
            'short_name'    =>  $this->objMember->getStrShortName(),
            'ip'            =>  $this->get('request')->getClientIp(),
            'login_time'    =>  $this->objMember->getTimeLastLoginTime()->format('Y-m-d H:i:s'),
        );
        return $this->render('AcmeBackendBundle:FM:index.html.twig',
            array(
                'm' =>  $arrMemberInfo,
                'menu' => $this->menu,
            ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/fm/fm_info_edit", name="_fm_info_edit")
     */
    public function fmInfoEditAction(Request $request)
    {
        parent::init();

        $objORM = $this->getDoctrine()->getManager();
        $objFM = $this->getUser();
        $strOriLogo = $objFM->getStrLogo();
        $strOriAvatar = $objFM->getStrAvatar();
        $type = new EditFMType();
        $form = $this->createForm($type, $objFM, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($form->getData()->getStrLogo() != null){
                    $strLogo = $this->fileHandleUploadFileWithoutType($form, 'strLogo', 'uploads/fmlogo');
                    $objFM->setStrLogo($strLogo);
                }else{
                    $objFM->setStrLogo($strOriLogo);
                }
                if($form->getData()->getStrAvatar() != null){
                    $strAvatar = $this->fileHandleUploadFileWithoutType($form, 'strLogo', 'uploads/fmavatar');
                    $objFM->setStrLogo($strAvatar);
                }else{
                    $objFM->setStrLogo($strOriAvatar);
                }
                $objORM->persist($objFM);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_fm_info_edit'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:FM:info_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/fm/fm_prc_vote", name="_fm_prc_vote")
     */
    public function fmPRCVoteAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $intLatestTermNo = $objORM->getRepository('AcmeBackendBundle:RankLog')
            ->getIntLatestTermNo();
        $strWhere = "";
        /*$strWhere .= " AND s.intRankZone = " . Constant::PRCZONE;
        $strWhere .= " AND s.boolIsRank = true AND (
                            (CURRENT_DATE() BETWEEN s.timeRankTimeFrom AND s.timeRankTimeTo
                            AND s.timeRankTimeFrom IS NOT NULL AND s.timeRankTimeTo IS NOT NULL)
                            OR(
                            CURRENT_DATE() < DATE_ADD(s.timeRankTime, 60, 'DAY')
                            AND s.timeRankTimeFrom IS NULL AND s.timeRankTimeTo IS NULL
                            )
                            )";*/
        $arrSonglist = $objORM->getRepository('AcmeBackendBundle:Song')
            ->getArrRankingForVote($intLatestTermNo + 1, Constant::PRCZONE);
        $jsonSonglist = json_encode($arrSonglist);
        $arrVotedList = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotedList($session->get('current_term_no'), $this->objMember->getId(), 'ASC');

        return $this->render('AcmeBackendBundle:FM:prc_vote.html.twig',
            array(
                'menu' => $this->menu,
                //'temp_info'=>$temp_info,
                'songlist_json' => $jsonSonglist,
                'songlist' => $arrSonglist,
                'term_no' => $intLatestTermNo + 1,
                'voted_list_json' => json_encode($arrVotedList),
            ));
    }


    /**
     * @param Request $request
     * @return Response
     * @Route("/fm/fm_hktw_vote", name="_fm_hktw_vote")
     */
    public function fmHKTWVoteAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $intLatestTermNo = $objORM->getRepository('AcmeBackendBundle:RankLog')
            ->getIntLatestTermNo();
        $arrSonglist = $objORM->getRepository('AcmeBackendBundle:Song')
            ->getArrRankingForVote($intLatestTermNo + 1, Constant::HKTWZONE);
        $jsonSonglist = json_encode($arrSonglist);
        $arrVotedList = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotedList($session->get('current_term_no'), $this->objMember->getId(), 'ASC');

        return $this->render('AcmeBackendBundle:FM:hktw_vote.html.twig',
            array(
                'menu' => $this->menu,
                //'temp_info'=>$temp_info,
                'songlist_json' => $jsonSonglist,
                'songlist' => $arrSonglist,
                'term_no' => $intLatestTermNo + 1,
                'voted_list_json' => json_encode($arrVotedList),
            ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/fm/fm_votelog_persist", name="_fm_votelog_persist")
     */
    public function fmVotelogPersistAction(Request $request)
    {
        parent::init();
        if ($request->getMethod() == 'POST') {
            $objORM = $this->getDoctrine()->getManager();
            $intMemberId = $this->objMember->getId();
            $strSids = $request->request->get('sidlist');
            $arrStrSid = explode(",", $strSids);
            if(count($arrStrSid) > 10)
            {
                return new Response('歌曲数量错误!');
            }
            $session = $request->getSession();
            //---------remove votelogs-----------//
            $arrObjVoteLog = $objORM->getRepository('AcmeBackendBundle:Votelog')
                ->findAll(array(
                    'intMemberId' => $intMemberId,
                    'intTermNo' => $session->get('current_term_no')
                ));
            foreach($arrObjVoteLog as $k => $v)
            {
                $objORM->remove($v);
            }
            //---------remove championlogs-----------//
            $arrObjChampionLog = $objORM->getRepository('AcmeBackendBundle:Championlog')
                ->findAll(array(
                    'intTermNo' => $session->get('current_term_no'),
                    'intMemberId' => $intMemberId,
                    'intZone' => $request->request->get('zone'),
                ));
            foreach($arrObjChampionLog as $k => $v)
            {
                $objORM->remove($v);
            }
            $intIndex = 0;
            foreach($arrStrSid as $k => $v)
            {
                $intIndex ++;
                $objVoteLog = new Votelog();
                $objVoteLog->setIntTermNo($session->get('current_term_no'));
                $objVoteLog->setIntIndex($intIndex);
                $objVoteLog->setIntMemberId($intMemberId);
                $objVoteLog->setIntZone($request->request->get('zone'));
                $objVoteLog->setIntSongId($v);
                $objVoteLog->setTimeVoteDateTime(new \DateTime());
                $objORM->persist($objVoteLog);
                if($intIndex == 1)
                {
                    $objChampionLog = new Championlog();
                    $objChampionLog->setIntTermNo($session->get('current_term_no'));
                    $objChampionLog->setIntMemberId($intMemberId);
                    $objChampionLog->setIntZone($request->request->get('zone'));
                    $objChampionLog->setIntSongId($v);
                    $objChampionLog->setTimeDateTime(new \DateTime());
                    $objORM->persist($objChampionLog);
                }
            }
            $objORM->flush();
            return new Response("投票成功");
        }else{
            return new Response();
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/fm/act_add", name="_fm_act_add")
     */
    public function fmActAddAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $type = new ActType();
        $form = $this->createForm($type, new Act(), array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $objAct = $form->getData();
                $objAct->setTimeUploadDateTime(new \DateTime());
                $current_member = $this->getUser();
                $objAct->setMember($current_member);
                $objORM->persist($objAct);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_fm_act_add'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:FM:act_add.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
            )
        );
    }

}

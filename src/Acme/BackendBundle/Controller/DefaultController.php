<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Comment;
use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Entity\Forecast;
use Acme\BackendBundle\Form\Type\ForecastType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\BackendBundle\Entity\Menu;
use Acme\BackendBundle\Form\Type\CommentType;
use Acme\CoreBundle\Controller\CustomerController;
/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class DefaultController extends CustomerController
{
    protected $objMember;
    protected $intType;
    protected $menu;
    protected $objORM;
    public function __construct(){
        //$this->objMember = $this->getUser();
        //$this->intType = $this->objMember->getIntType();
    }

    public function init()
    {
        $this->objMember = $this->getUser();
        $this->intType = $this->objMember->getIntType();
        $this->menu = new Menu();
        $this->menu = $this->menu->getMenu($this->intType);
        $this->objORM = $this->getDoctrine()->getManager();
    }
    /**
     * @return Response
     * @Route("/index", name="_unvadmin_index")
     */
    public function indexAction()
    {
        $this->init();
        //$usr= $this->get('security.context')->getToken()->getUser();
        //$this->objMember = $this->getUser();
        //$this->intType = $this->objMember->getIntType();
        //$this->menu = new Menu();
        //$this->menu = $this->menu->getMenu($this->intType);
        if($this->intType == Constant::ADMIN)
            return $this->redirect('admin');
        if($this->intType == Constant::FM)
            return $this->redirect('fm');
        if($this->intType == Constant::CORP)
            return $this->redirect('corp');
        //return $this->render('AcmeBackendBundle:Default:index.html.twig');
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/password_edit", name="_unvadmin_password_edit")
     */
    public function passwordEditAction(Request $request)
    {
        $this->init();
        $objORM = $this->getDoctrine()->getManager();
        $objMember = $this->getUser();

        if($request->request->get('password') == $request->request->get('password_repeat')
            && $request->request->get('password') != null)
            {
                $objMember->setPassword($request->request->get('password'));
                $objORM->persist($objMember);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_unvadmin_password_edit'));
        }
        return $this->render(
            'AcmeBackendBundle:Default:password_edit.html.twig',
            array(
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param null $intTermNo
     * @return Response
     * @Route("/prc_rank", name="_unvadmin_prc_rank")
     */
    public function prcRankAction($intTermNo = null)
    {
        $this->init();
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        if($intTermNo == null)
            $intTermNo = $request->getSession()->get('last_term_no');
        $arrLastRankSongPRC = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::PRCZONE, 999, $intTermNo);
        return $this->render(
            'AcmeBackendBundle:Default:prc_rank.html.twig',
            array(
                'menu' => $this->menu,
                'list' => $arrLastRankSongPRC,
            )
        );
    }

    /**
     * @param null $intTermNo
     * @return Response
     * @Route("/hktw_rank", name="_unvadmin_hktw_rank")
     */
    public function hktwRankAction($intTermNo = null)
    {
        $this->init();
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        if($intTermNo == null)
            $intTermNo = $request->getSession()->get('last_term_no');
        $arrLastRankSongHKTW = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::HKTWZONE, 999, $intTermNo);
        return $this->render(
            'AcmeBackendBundle:Default:hktw_rank.html.twig',
            array(
                'menu' => $this->menu,
                'list' => $arrLastRankSongHKTW,
            )
        );
    }

    /**
     * @param $id
     * @return Response
     * @Route("/song_comment/{id}", name="_unvadmin_song_comment")
     */
    public function songCommentAction($id)
    {
        /*$objORM = $this->getDoctrine()->getManager();
        return new Response();*/
        $this->init();
        $request = $this->get('request');
        $objORM = $this->getDoctrine()->getManager();
        $type = new CommentType();
        $objComment = new Comment();
        $form = $this->createForm($type, $objComment, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objCurrentUser = $this->getUser();
                $objComment->setIntMemberId($objCurrentUser->getId());
                $song =
                    $objORM->getRepository('AcmeBackendBundle:Song')->find($id);
                $objComment->setSong($song);
                $objORM->persist($objComment);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_unvadmin_song_comment', array('id' => $id)));
            }
        }

        $objComments = $objORM->getRepository('AcmeBackendBundle:Comment')
            ->getArrCommentList($id);

        return $this->render(
            'AcmeBackendBundle:Default:song_comment.html.twig',
            array('form' => $form->createView(),
                'comment_list' => $objComments
            )
        );
    }

    /**
     * @param $id
     * @return Response
     * @Route("/member_comment/{id}", name="_unvadmin_member_comment")
     */
    public function memberCommentAction($id)
    {
        $this->init();
        $request = $this->get('request');
        $objORM = $this->getDoctrine()->getManager();
        $type = new CommentType();
        $objComment = new Comment();
        $form = $this->createForm($type, $objComment, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objCurrentUser = $this->getUser();
                $objComment->setIntMemberId($objCurrentUser->getId());
                $objMemberTo =
                    $objORM->getRepository('AcmeBackendBundle:Member')->find($id);
                $objComment->setMember($objMemberTo);
                $objORM->persist($objComment);
                if($objMemberTo->getIntLastCommentId() == null)
                    $objMemberTo->setIntLastCommentId($objComment->getId());
                $objORM->flush();

                return $this->redirect($this->generateUrl('_unvadmin_member_comment', array('id' => $id)));
            }
        }

        $objComments = $objORM->getRepository('AcmeBackendBundle:Comment')
            ->getArrMemberCommentList($id);

        return $this->render(
            'AcmeBackendBundle:Default:member_comment.html.twig',
            array('form' => $form->createView(),
                'comment_list' => $objComments
            )
        );
    }

    /**
     * @param $close
     * @return Response
     * @Route("/forecast/{close}", name="_unvadmin_forecast")
     */
    public function forecastAction($close = false)
    {
        /*$objORM = $this->getDoctrine()->getManager();
        return new Response();*/
        $this->init();
        $boolIsAdmin = false;
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            $boolIsAdmin = true;
        $request = $this->get('request');
        $objORM = $this->getDoctrine()->getManager();
        $type = new ForecastType();
        $objForecast = new Forecast();
        $form = $this->createForm($type->setBoolUppable($boolIsAdmin), $objForecast, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objCurrentUser = $this->getUser();
                $objForecast->setIntMemberId($objCurrentUser->getId());
                $objForecast->setTimeDateTime(new \DateTime());
                $objORM->persist($objForecast);
                $objORM->flush();
                if($objForecast->getId())
                    $boolClose = true;

                return $this->redirect($this->generateUrl('_unvadmin_forecast', array('close' => $boolClose)));
            }
        }


        return $this->render(
            'AcmeBackendBundle:Default:forecast.html.twig',
            array('form' => $form->createView(),
                  'close' => $close,
            )
        );
    }

    /**
     * @return Response
     * @Route("/fm_contact_list", name="_unvadmin_fm_contact_list")
     */
    public function fmContactListAction()
    {
        $this->init();
        $objORM = $this->getDoctrine()->getManager();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMDetailsList();
        return $this->render('AcmeBackendBundle:Default:fm_contact_list.html.twig',
            array(
                'menu' => $this->menu,
                'fms' => $arrFM,
            ));
    }

    /**
     * @return Response
     * @Route("corp_contact_list", name="_unvadmin_corp_contact_list")
     */
    public function corpContactListAction()
    {
        $this->init();
        $objORM = $this->getDoctrine()->getManager();
        $arrCorp = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrCorpDetailsList();
        return $this->render('AcmeBackendBundle:Default:corp_contact_list.html.twig',
            array(
                'menu' => $this->menu,
                'corps' => $arrCorp,
            ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/song_list", name="_unvadmin_song_list")
     */
    public function songListAction(Request $request, $page = 1, $strAlertJs = null)
    {
        $this->init();
        $objORM = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getStrSongSearchStr($request->query->get('search'),
                $request->query->get('zone'),
                $request->query->get('status'));
        }
        $querySonglist = $objORM->getRepository('AcmeBackendBundle:Song')
            ->getQuerySonglist($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querySonglist,
            $request->query->get('page', $page)/*page number*/,
            50/*limit per page*/
        );
        return $this->render('AcmeBackendBundle:Default:song_list.html.twig',
            array('pagination' => $pagination,
                'menu' => $this->menu,
                'alertjs'=>$strAlertJs));
    }

    /**
     * @param Request $request
     * @param int $page
     * @param null $strAlertJs
     * @return Response
     * @Route("/act_list", name="_unvadmin_act_list")
     */
    public function actListAction(Request $request, $page = 1, $strAlertJs = null)
    {
        $this->init();
        $objORM = $this->getDoctrine()->getManager();
        $strWhere = "";
        if ($request->getMethod() == 'GET') {
            $strWhere = $this->_getStrActSearchStr($request->query->get('search'),
                $request->query->get('type'));
        }
        $queryActlist = $objORM->getRepository('AcmeBackendBundle:Act')
            ->getQueryActlist($strWhere);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryActlist,
            $request->query->get('page', $page)/*page number*/,
            30/*limit per page*/
        );
        return $this->render('AcmeBackendBundle:Default:act_list.html.twig',
            array('pagination' => $pagination,
                'menu' => $this->menu,
                'alertjs'=>$strAlertJs));
    }

    /**
     * @param $type
     * @param $id
     * @return Response
     * @Route("/download/{type}/{id}", name="_unvadmin_download")
     */
    public function downloadFileAction($type, $id)
    {
        switch($type){
            case "song":
                return $this->getSongDownloadResponse($id);
            break;
            default:
            break;
        }

    }

    protected function getSongDownloadResponse($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $song =
            $objORM->getRepository('AcmeBackendBundle:Song')->find($id);

        $options = array(
            'serve_filename' => $song->getStrTitle().".".pathinfo($song->getStrSongFile(), PATHINFO_EXTENSION),
            'absolute_path' => false,
            'inline' => false,
        );
        return $this->get('igorw_file_serve.response_factory')
            ->create('../web/uploads/gallery/'.$song->getStrSongFile(), 'application/octet-stream', $options);
    }

    public function fileHandleUploadFileWithoutType($form, $strField, $strDir)
    {
        $fileOri = $form[$strField]->getData();
        if($fileOri=="")
            return "";
        $extension = $fileOri->guessExtension();
        if (!$extension) {
            $extension = 'bin';
        }
        $file = date('YmdHis').rand(1000, 9999).'.'.$extension;
        $fileOri->move($strDir, $file);
        @unlink($fileOri);
        return $file;
    }

    /**
     * @return Response
     * @Route("/info_edit", name="_unvadmin_info_edit")
     */
    public function redirectInfoEditAction(){
        if($this->getUser()->getIntType()==Constant::CORP)
            return $this->redirect($this->generateUrl('_corp_info_edit'));
        if($this->getUser()->getIntType()==Constant::FM)
            return $this->redirect($this->generateUrl('_fm_info_edit'));
        if($this->getUser()->getIntType()==Constant::ADMIN)
            return $this->redirect($this->generateUrl('_admin_info_edit'));
    }

}

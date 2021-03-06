<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Form\Type\ActType;
use Acme\BackendBundle\Form\Type\AdminType;
use Acme\BackendBundle\Form\Type\ArticleType;
use Acme\BackendBundle\Form\Type\CoopType;
use Acme\BackendBundle\Form\Type\EditCorpType;
use Acme\BackendBundle\Form\Type\EditFMType;
use Acme\BackendBundle\Form\Type\FlashType;
use Acme\BackendBundle\Form\Type\OtherInfoType;
use Acme\BackendBundle\Form\Type\SongModelType;
use Acme\BackendBundle\Form\Model\SongModel;
use Acme\BackendBundle\Form\Type\AdminWizardType;
use Acme\FrontendBundle\Entity\Article;
use Acme\FrontendBundle\Entity\Coop;
use Acme\FrontendBundle\Entity\Flash;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
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
use Acme\BackendBundle\Form\Type\BasicType;

/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class AdminController extends DefaultController
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/admin", name="_admin_index")
     */
    public function adminIndexAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $arrMemberInfo = array(
            'short_name'    =>  $this->objMember->getStrShortName(),
            'ip'            =>  $this->get('request')->getClientIp(),
            'login_time'    =>  $this->objMember->getTimeLastLoginTime()->format('Y-m-d H:i:s'),
        );
        $intRankWeekDay = $session->get('rank_week_day');
        $intNextRankTime = $session->get('next_rank_time');
        $arrObjChampionLogPRC =
            $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionLog(Constant::PRCZONE, 20);
        $arrObjChampionLogHKTW =
            $objORM->getRepository('AcmeBackendBundle:Championlog')
                ->getArrChampionLog(Constant::HKTWZONE, 20);
        $arrForecast = $objORM->getRepository('AcmeBackendBundle:Forecast')
            ->getArrForecastlist(100);

        return $this->render('AcmeBackendBundle:Admin:index.html.twig',
            array('m'=>$arrMemberInfo,
                'menu'=>$this->menu,
                'next_rank_time' => $intNextRankTime,
                'championlogs_prc' => $arrObjChampionLogPRC,
                'championlogs_hktw' => $arrObjChampionLogHKTW,
                'forecasts' => $arrForecast,
                'rank_week_day' => $intRankWeekDay,
                ));
    }

    /**
     * @param $request
     * @return Response
     * @Route("/admin/info_edit", name="_admin_info_edit")
     */
    public function adminInfoEditAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $type = new AdminType();
        $objMember = $this->getUser();
        $form = $this->createForm($type, $objMember, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                try {
                    $objMember = $form->getData();
                    $objMember->setStrFullName($objMember->getStrShortName());
                    $objORM->persist($objMember);
                    $objORM->flush();

                    $this->get('session')->getFlashBag()->add('message',"修改成功!");

                } catch (Exception $e) {
                    $this->get('session')->getFlashBag()->add('message',"修改不成功!");
                }

                return $this->redirect($this->generateUrl('_admin_info_edit'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:info_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/admin_edit", name="_admin_admin_edit")
     */
    public function adminAdminEditAction()
    {
        return new Response('未完成');
    }

    /**
     * @return Response
     * @Route("/admin/rank_setting", name="_admin_rank_setting")
     */
    public function adminRankSettingAction()
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objBasic =
            $objORM->getRepository('AcmeBackendBundle:Basic')->find(1);
        $type = new BasicType();
        $form = $this->createForm($type, $objBasic, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_rank_setting'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:rank_setting.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/admin/site_info_edit", name="_admin_site_info_edit")
     */
    public function adminSiteInfoEditAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $objOtherInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->find(1);
        $type = new OtherInfoType();
        $strOriTopImg = $objOtherInfo->getStrTopImg();
        $strOriADImg1 = $objOtherInfo->getStrADImg1();
        $strOriADImg2 = $objOtherInfo->getStrADImg2();
        $form = $this->createForm($type, $objOtherInfo);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($form->getData()->getStrTopImg() != null){
                    $strTopImg = $this->fileHandleUploadFileWithoutType($form, 'strTopImg', 'uploads/site_info');
                    $objOtherInfo->setStrTopImg($strTopImg);
                }else{
                    $objOtherInfo->setStrTopImg($strOriTopImg);
                }
                if($form->getData()->getStrADImg1() != null){
                    $strADImg1 = $this->fileHandleUploadFileWithoutType($form, 'strADImg1', 'uploads/site_info');
                    $objOtherInfo->setStrADImg1($strADImg1);
                }else{
                    $objOtherInfo->setStrADImg1($strOriADImg1);
                }
                if($form->getData()->getStrADImg2() != null){
                    $strADImg2 = $this->fileHandleUploadFileWithoutType($form, 'strADImg2', 'uploads/site_info');
                    $objOtherInfo->setStrADImg2($strADImg2);
                }else{
                    $objOtherInfo->setStrADImg2($strOriADImg2);
                }
                $objORM->persist($objOtherInfo);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_site_info_edit'));
            }
        }
        return $this->render(
            'AcmeBackendBundle:Admin:otherinfo.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/flash_list", name="_admin_flash_list")
     */
    public function adminFlashListAction()
    {
        parent::init();
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $arrFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findAll();

        return $this->render('AcmeBackendBundle:Admin:flash_list.html.twig',
            array(
                'menu' => $this->menu,
                'flashs' => $arrFlash,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            ));
    }

    /**
     * @return Response
     * @Route("/admin/flash_create", name="_admin_flash_create")
     */
    public function adminFlashCreateAction()
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objFlash = new Flash();
        $type = new FlashType();
        $form = $this->createForm($type, $objFlash, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objFlash = $form->getData();
                $strImg = $this->fileHandleUploadFileWithoutType($form, 'strImg', 'uploads/flash');
                $objFlash->setStrImg($strImg);
                $objORM->persist($objFlash);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_flash_list'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:flash_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/flash_edit/{id}", name="_admin_flash_edit")
     */
    public function adminFlashEditAction($id)
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->find($id);
        $strOriImg = $objFlash->getStrImg();
        $type = new FlashType();
        $form = $this->createForm($type, $objFlash, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($form->getData()->getStrImg() != null){
                    $strImg = $this->fileHandleUploadFileWithoutType($form, 'strImg', 'uploads/flash');
                    $objFlash->setStrImg($strImg);
                    $objORM->persist($objFlash);
                }else{
                    $objFlash->setStrImg($strOriImg);
                }
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_flash_edit', array('id' => $id)));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:flash_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/flash_delete/{id}", name="_admin_flash_delete")
     */
    public function adminFlashDeleteAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $obj = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->find($id);
        $objORM->remove($obj);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_flash_list',
            array(
                'message' => $this->get('session')->getFlashBag()->get('message'),
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/coop_delete/{id}", name="_admin_coop_delete")
     */
    public function adminCoopDeleteAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $obj = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->find($id);
        $objORM->remove($obj);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_coop',
            array(
                'message' => $this->get('session')->getFlashBag()->get('message'),
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @return Response
     * @Route("/admin/site_img_edit", name="_admin_site_img_edit")
     */
    public function adminSiteImgEditAction()
    {
        return new Response();
    }


    /**
     * @param $id
     * @return Response
     * @Route("/admin/article_edit/{id}", name="_admin_article_edit")
     */
    public function adminArticleEditAction($id)
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objArticle = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->find($id);
        $strOriThumb = $objArticle->getStrThumb();
        $strOriSongFile = $objArticle->getStrSongFile();
        $type = new ArticleType();
        $form = $this->createForm($type, $objArticle, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($form->getData()->getStrThumb() != null){
                    $strThumb = $this->fileHandleUploadFileWithoutType($form, 'strThumb', 'uploads/article_thumb');
                    $objArticle->setStrThumb($strThumb);
                }else{
                    $objArticle->setStrThumb($strOriThumb);
                }
                if($form->getData()->getStrSongFile() != null){
                    $strSongFile = $this->fileHandleUploadFileWithoutType($form, 'strSongFile', 'uploads/article_song');
                    $objArticle->setStrSongFile($strSongFile);
                }else{
                    $objArticle->setStrSongFile($strOriSongFile);
                }
                $objORM->persist($objArticle);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_article_edit', array('id' => $id)));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:article_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/article_create", name="_admin_article_create")
     */
    public function adminArticleCreateAction()
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objArticle = new Article();
        $type = new ArticleType();
        $form = $this->createForm($type, $objArticle, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objArticle = $form->getData();
                $objArticle->setTimeCreateTime(new \DateTime());
                $strThumb = $this->fileHandleUploadFileWithoutType($form, 'strThumb', 'uploads/article_thumb');
                $strSongFile = $this->fileHandleUploadFileWithoutType($form, 'strSongFile', 'uploads/article_song');
                $objArticle->setStrThumb($strThumb);
                $objArticle->setStrSongFile($strSongFile);
                $objORM->persist($objArticle);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_article_create'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:article_create.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param $id
     * @param $page
     * @return Response
     * @Route("/admin/article_delete/{id}/{page}", name="_admin_article_delete")
     */
    public function adminArticleDeleteAction($id, $page)
    {
        $objORM = $this->getDoctrine()->getManager();
        $where = null;
        $obj = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->find($id);
        $category = $obj->getIntCategory();
        $objORM->remove($obj);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_article_list',
            array(
                'category' => $category,
                'page' => $page,
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @param $category
     * @param $page
     * @return Response
     * @Route("/admin/article_list/{category}/{page}", name="_admin_article_list")
     */
    public function adminArticleListAction($category, $page)
    {
        parent::init();
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $strWhere = "";
        if ($request->getMethod() == 'GET') {
            $strWhere = $this->_getStrArticleSearchStr($request->query->get('search'),
                $request->query->get('category')
                );
        }
        $queryArticlelist = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getQueryArticleList($category, $strWhere);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryArticlelist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeBackendBundle:Admin:article_list.html.twig',
            array('pagination' => $pagination,
                'menu' => $this->menu,
                'category' => $category,
                'page' => $page,
                ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/admin/fm_contact_list", name="_admin_fm_contact_list")
     */
    public function adminFMContactListAction(Request $request)
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMDetailsList("");
        return $this->render('AcmeBackendBundle:Admin:fm_contact_list.html.twig',
            array(
                'menu' => $this->menu,
                'fms' => $arrFM,
                ));
    }

    /**
     * @return Response
     * @Route("/admin/corp_contact_list", name="_admin_corp_contact_list")
     */
    public function adminCorpContactListAction()
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $arrCorp = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrCorpDetailsList("");
        return $this->render('AcmeBackendBundle:Admin:corp_contact_list.html.twig',
            array(
                'menu' => $this->menu,
                'corps' => $arrCorp,
            ));
    }

    /**
     * @param $id
     * @return RedirectResponse|Response
     * @Route("/admin/fm_edit/{id}", name="_admin_fm_edit")
     */
    public function adminEditFMAction($id)
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->find($id);
        if($objFM->getIntType() != Constant::FM)
        {
            return new Response('非法操作');
        }
        $strOriLogo = $objFM->getStrLogo();
        $strOriAvatar = $objFM->getStrAvatar();
        $type = new EditFMType();
        $type->setBoolIsAdmin(true);
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
                    $strAvatar = $this->fileHandleUploadFileWithoutType($form, 'strAvatar', 'uploads/fmavatar');
                    $objFM->setStrAvatar($strAvatar);
                }else{
                    $objFM->setStrAvatar($strOriAvatar);
                }
                $objORM->persist($objFM);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_fm_edit', array("id"=>$id)));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:fm_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );

    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/fm_delete/{id}", name="_admin_fm_delete")
     */
    public function adminFMDeleteAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $where = null;
        $obj = $objORM->getRepository('AcmeBackendBundle:Member')
            ->find($id);
        $objORM->remove($obj);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_fm_contact_list',
            array(
                'strAlertJs' => $strAlertJs
            )));
    }


    /**
     * @param $id
     * @return RedirectResponse|Response
     * @Route("/admin/corp_edit/{id}", name="_admin_corp_edit")
     */
    public function adminEditCorpAction($id)
    {
        parent::init();
        $request = $this->get('request');

        $objORM = $this->getDoctrine()->getManager();
        $objCorp = $objORM->getRepository('AcmeBackendBundle:Member')
            ->find($id);
        if($objCorp->getIntType() != Constant::CORP)
        {
            return new Response('非法操作');
        }
        $strOriLogo = $objCorp->getStrLogo();
        $type = new EditCorpType();
        $type->setBoolIsAdmin(true);
        $form = $this->createForm($type, $objCorp, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($form->getData()->getStrLogo() != null){
                    $strLogo = $this->fileHandleUploadFileWithoutType($form, 'strLogo', 'uploads/corplogo');
                    $objCorp->setStrLogo($strLogo);
                }else{
                    $objCorp->setStrLogo($strOriLogo);
                }
                $objORM->persist($objCorp);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_corp_edit', array("id"=>$id)));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:corp_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );

    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/corp_delete/{id}", name="_admin_corp_delete")
     */
    public function adminCorpDeleteAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $where = null;
        $obj = $objORM->getRepository('AcmeBackendBundle:Member')
            ->find($id);
        $objORM->remove($obj);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_corp_contact_list',
            array(
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @param Request $request
     * @param $page
     * @param $strAlertJs
     * @return Response
     * @Route("/admin/song_list", name="_admin_song_list")
     */
    public function adminSongListAction(Request $request, $page = 1, $strAlertJs = null)
    {
        parent::init();
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
        return $this->render('AcmeBackendBundle:Admin:song_list.html.twig',
            array('pagination' => $pagination,
                'menu' => $this->menu,
                'alertjs'=>$strAlertJs));
    }

    /**
     * @param $id
     * @param $page
     * @return Response
     * @Route("/admin/song_delete/{id}/{page}", name="_admin_song_delete")
     */
    public function adminSongDeleteAction($id, $page)
    {
        $objORM = $this->getDoctrine()->getManager();
        $where = null;
        /*$query = $objORM->createQuery('DELETE
                                         FROM AcmeBackendBundle:Song s
                                         WHERE s.id = :id')
            ->setParameters(array('id'=>$id))
            ->execute();
        */
        $objSong = $objORM->getRepository('AcmeBackendBundle:Song')
            ->find($id);
        $objORM->remove($objSong);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_song_list',
            array(
                'page' => $page,
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/song_edit/{id}", name="_admin_song_edit")
     */
    public function adminSongEditAction($id)
    {
        parent::init();
        $request = $this->get('request');

        if (is_null($id)) {
            $postData = $request->get('form.song');
            $id = $postData['id'];
        }

        $objORM = $this->getDoctrine()->getManager();
        $type = new SongModelType();
        $type->setBoolIsEdit(true);
        $song =
            $objORM->getRepository('AcmeBackendBundle:Song')->find($id);
        $songModel = new SongModel();
        $songModel->setSong($song);
        $form = $this->createForm($type, $songModel, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if($song->getTimeRankTime() == null
                    && $song->getBoolIsRank())
                    $song->setTimeRankTime(new \DateTime('tomorrow'));
                elseif(!$song->getBoolIsRank())
                    $song->setTimeRankTime(null);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_song_list'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Corp:song_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
            )
        );
    }


    /**
     * @param Request $request
     * @param int $page
     * @param null $strAlertJs
     * @return Response
     * @Route("/admin/act_list", name="_admin_act_list")
     */
    public function adminActListAction(Request $request, $page = 1, $strAlertJs = null)
    {
        parent::init();
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
        return $this->render('AcmeBackendBundle:Admin:act_list.html.twig',
            array('pagination' => $pagination,
                'menu' => $this->menu,
                'alertjs'=>$strAlertJs));
    }

    /**
     * @param $id
     * @param $page
     * @return Response
     * @Route("/admin/act_delete/{id}/{page}", name="_admin_act_delete")
     */
    public function adminActDeleteAction($id, $page)
    {
        $objORM = $this->getDoctrine()->getManager();
        $where = null;
        $objSong = $objORM->getRepository('AcmeBackendBundle:Act')
            ->find($id);
        $objORM->remove($objSong);
        $objORM->flush();
        $strAlertJs = "<script>alert(\"刪除成功\");</script>";
        return $this->redirect($this->generateUrl('_admin_act_list',
            array(
                'page' => $page,
                'strAlertJs' => $strAlertJs
            )));
    }

    /**
     * @param $id
     * @return Response
     * @Route("/admin/act_edit/{id}", name="_admin_act_edit")
     */
    public function adminActEditAction($id)
    {
        parent::init();
        $request = $this->get('request');

        if (is_null($id)) {
            $postData = $request->get('form');
            $id = $postData['id'];
        }

        $objORM = $this->getDoctrine()->getManager();
        $type = new ActType();
        $type->setBoolIsEdit(true);
        $objAct =
            $objORM->getRepository('AcmeBackendBundle:Act')->find($id);
        $form = $this->createForm($type, $objAct, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_act_list'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:act_edit.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/coop", name="_admin_coop")
     */
    public function adminCoopAction()
    {
        parent::init();
        $objORM = $this->getDoctrine()->getManager();
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')->getArrCoopList(999);
        return $this->render(
            'AcmeBackendBundle:Admin:coop.html.twig',
            array(
                'message' => $this->get('session')->getFlashBag()->get('message'),
                'menu' => $this->menu,
                'coops' => $arrCoopList,
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/coop_add", name="_admin_coop_add")
     */
    public function adminCoopAddAction()
    {
        parent::init();
        $request = $this->get('request');
        $objORM = $this->getDoctrine()->getManager();
        $objCoop = new Coop();
        $type = new CoopType();
        $form = $this->createForm($type, $objCoop, array(
            //'validation_groups' => array('corp_song_add'),
        ));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $objCoop = $form->getData();
                $objCoop->setTimeUploadTime(new \DateTime());
                $strThumb = $this->fileHandleUploadFileWithoutType($form, 'strThumb', 'uploads/coop');
                $objCoop->setStrThumb($strThumb);
                $objORM->persist($objCoop);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_admin_coop'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Admin:coop_add.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
                'message' => $this->get('session')->getFlashBag()->get('message'),
            )
        );
    }

    /**
     * @param null $strSearch
     * @param null $intZone
     * @param null $intStatus
     * @return string
     */
    public function _getStrSongSearchStr($strSearch = null, $intZone = null, $intStatus = null)
    {
        $where = "";
        if($strSearch != "")
            $where .= " AND (s.strTitle LIKE '%{$strSearch}%' OR s.arrStrArtistName LIKE '%{$strSearch}%'
                    OR m.strShortName LIKE '%{$strSearch}%') ";
        if($intZone != "")
            $where .= " AND s.intRankZone = {$intZone} ";
        if($intStatus == Constant::RANKING)
            $where .= " AND s.boolIsRank = true AND (
                            (CURRENT_DATE() BETWEEN s.timeRankTimeFrom AND s.timeRankTimeTo
                            AND s.timeRankTimeFrom IS NOT NULL AND s.timeRankTimeTo IS NOT NULL)
                            OR(
                            CURRENT_DATE() < DATE_ADD(s.timeRankTime, 60, 'DAY')
                            AND s.timeRankTimeFrom IS NULL AND s.timeRankTimeTo IS NULL
                            )
                            )";
        if($intStatus == Constant::RANK_WAITING)
            $where .= " AND s.boolIsRank = true AND (CURRENT_DATE() < s.timeRankTimeFrom)";
        if($intStatus == Constant::RANK_EXPIRE)
            $where .= " AND s.boolIsRank = true AND (
                    (CURRENT_DATE() > s.timeRankTimeTo)
                    OR
                    (CURRENT_DATE() > DATE_ADD(s.timeRankTime, 60, 'DAY'))
                    )";
        if($intStatus == Constant::NOT_RANK)
            $where .= " AND s.boolIsRank = false ";
        return $where;
    }

    public function _getStrArticleSearchStr($strSearch = null, $intCategory = null)
    {
        $strWhere = "";
        if($strSearch != null)
            $strWhere .= " AND a.strTitle LIKE '%{$strSearch}%'";
        //if($intCategory != null)
        //    $strWhere .= " AND a.intCategory = {$intCategory}";
        return $strWhere;
    }

    public function _getStrActSearchStr($strSearch = null, $intType = null)
    {
        $strWhere = "";
        if($strSearch != null)
            $strWhere .= " AND a.strTitle LIKE '%{$strSearch}%'";
        if($intType != null)
            $strWhere .= " AND a.intType = {$intType}";
        return $strWhere;
    }
}

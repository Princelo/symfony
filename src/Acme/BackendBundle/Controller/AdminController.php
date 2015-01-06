<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Form\Type\SongModelType;
use Acme\BackendBundle\Form\Model\SongModel;
use Acme\BackendBundle\Form\Type\AdminWizardType;
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
use Acme\BackendBundle\Form\Type\BasicType;

/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class AdminController extends DefaultController
{

    /**
     * @return Response
     * @Route("/admin", name="_admin_index")
     */
    public function adminIndexAction()
    {
        parent::init();
        $arrMemberInfo = array(
            'short_name'    =>  $this->objMember->getStrShortName(),
            'ip'            =>  $this->get('request')->getClientIp(),
            'login_time'    =>  $this->objMember->getTimeLastLoginTime()->format('Y-m-d H:i:s'),
        );
        return $this->render('AcmeBackendBundle:Admin:index.html.twig',
            array('m'=>$arrMemberInfo,
                'menu'=>$this->menu,
                ));
    }

    /**
     * @return Response
     * @Route("/admin/info_edit", name="_admin_info_edit")
     */
    public function adminInfoEditAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/admin/admin_edit", name="_admin_admin_edit")
     */
    public function adminAdminEditAction()
    {
        return new Response();
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
            )
        );
    }

    /**
     * @return Response
     * @Route("/admin/site_info_edit", name="_admin_site_info_edit")
     */
    public function adminSiteInfoEditAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/admin/flash_edit", name="_admin_flash_edit")
     */
    public function adminFlashEditAction()
    {
        return new Response();
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
     * @return Response
     * @Route("/admin/article_edit", name="_admin_article_edit")
     */
    public function adminArticleEditAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/admin/fm_contact_list", name="_admin_fm_contact_list")
     */
    public function adminFMContactListAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/admin/corp_contact_list", name="_admin_corp_contact_list")
     */
    public function adminCorpContactListAction()
    {
        return new Response();
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

        $objORM = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getStrSearchStr($request->query->get('search'),
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
        $query = $objORM->createQuery('DELETE
                                         FROM AcmeBackendBundle:Song s
                                         WHERE s.id = :id')
            ->setParameters(array('id'=>$id))
            ->execute();
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
     * @return Response
     * @Route("/admin/act_list", name="_admin_act_list")
     */
    public function adminActListAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/admin/act_add", name="_admin_act_add")
     */
    public function adminActAddAction()
    {
        return new Response();
    }

    /**
     * @param null $strSearch
     * @param null $intZone
     * @param null $intStatus
     * @return string
     */
    public function _getStrSearchStr($strSearch = null, $intZone = null, $intStatus = null)
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
}

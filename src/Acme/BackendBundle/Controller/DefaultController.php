<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Comment;
use Acme\BackendBundle\Entity\Constant;
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
use Acme\BackendBundle\Entity\Menu;
use Acme\BackendBundle\Form\Type\CommentType;

/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class DefaultController extends Controller
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
     * @return Response
     * @Route("/password_edit", name="_unvadmin_password_edit")
     */
    public function passwordEditAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/prc_rank", name="_unvadmin_prc_rank")
     */
    public function prcRankAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/hktw_rank", name="_unvadmin_hktw_rank")
     */
    public function hktwRankAction()
    {
        return new Response();
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
            ->getObjCommentlist($id);

        return $this->render(
            'AcmeBackendBundle:Default:song_comment.html.twig',
            array('form' => $form->createView(),
                'comment_list' => $objComments
            )
        );
    }

    /**
     * @return Response
     * @Route("fm_contact_list", name="_unvadmin_fm_contact_list")
     */
    public function fmContactListAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("corp_contact_list", name="_unvadmin_corp_contact_list")
     */
    public function corpContactListAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("song_list", name="_unvadmin_song_list")
     */
    public function songListAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("act_list", name="_unvadmin_act_list")
     */
    public function actListAction()
    {
        return new Response();
    }

}

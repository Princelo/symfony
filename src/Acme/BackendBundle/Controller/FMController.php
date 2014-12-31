<?php

namespace Acme\BackendBundle\Controller;

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
     * @return Response
     * @Route("/fm/fm_info_edit", name="_fm_info_edit")
     */
    public function fmInfoEditAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/fm/fm_prc_vote", name="_fm_prc_vote")
     */
    public function fmPRCVoteAction()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/fm/fm_hktw_vote", name="_fm_hktw_vote")
     */
    public function fmHKTWVoteAction()
    {
        return new Response();
    }
}

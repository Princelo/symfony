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
class AdminController extends DefaultController
{

    /**
     * @return Response
     * @Route("/admin", name="_admin_index")
     */
    public function adminIndexAction()
    {
        return $this->render('AcmeBackendBundle:Admin:index.html.twig');
    }

}

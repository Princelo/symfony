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
use Acme\BackendBundle\Form\Model\Registration;
use Acme\BackendBundle\Form\Model\CorpRegistration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BackendBundle\Entity\Member;
use Acme\BackendBundle\Entity\Corp;
use Acme\BackendBundle\Entity\City;
use Acme\BackendBundle\Entity\Artist;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Route("/check_unique_email/", defaults={"slug" = ""})
     * @Route("/check_unique_email/{slug}", name="check_unique_email")
     */
    public function strCheckUniqueEmail($slug){
        $objORM = $this->getDoctrine()->getManager();
        $count = $objORM->getRepository('AcmeBackendBundle:Member')
            ->strCheckUniqueEmail($slug);
        if($count > 0)
            echo 'false';
        else
            echo 'true';
        return new Response();
    }

    public function jsonGetCity(){
        $city = new City();
        echo json_encode($city->getArrCity());
        return new Response();
    }
} 
<?php

namespace Acme\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeFrontendBundle:Default:index.html.twig', array('name' => $name));
    }
}

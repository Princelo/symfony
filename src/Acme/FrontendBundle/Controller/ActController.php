<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActController extends CustomerController
{

    /**
     * @return Response
     * @Route("/act", name="_act")
     */
    public function actListAction()
    {
        $objORM = $this->getDoctrine()->getManager();
        $arrActList = $objORM->getRepository('AcmeBackendBundle:Act')
            ->getArrActList(100, 'timeUploadDateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        return $this->render('AcmeFrontendBundle:Act:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'acts' => $arrActList,
            ));
    }


}

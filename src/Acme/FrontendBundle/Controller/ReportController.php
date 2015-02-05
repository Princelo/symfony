<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends CustomerController
{

    /**
     * @param $intTermNo
     * @param $strZone
     * @return Response
     * @Route("/report/{strZone}/{intTermNo}", name="_report")
     */
    public function reportListAction($strZone, $intTermNo)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $objORM = $this->getDoctrine()->getManager();
        if($strZone == 'prc')
            $arrLastRankSong = $objORM->getRepository('AcmeBackendBundle:Rank')
                ->getArrNewestRankList(Constant::PRCZONE, 999, $intTermNo);
        if($strZone == 'hktw')
            $arrLastRankSong = $objORM->getRepository('AcmeBackendBundle:Rank')
                ->getArrNewestRankList(Constant::HKTWZONE, 999, $intTermNo);
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $intLastTermNo = $session->get('last_term_no');
        return $this->render('AcmeFrontendBundle:Report:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'list' => $arrLastRankSong,
                'current_term_no' => $intLastTermNo,
            ));
    }
}

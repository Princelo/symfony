<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;

class DefaultController extends CustomerController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $objORM = $this->getDoctrine()->getManager();
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getObjFrontendInfo();
        $objFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->getObjFlashlist();
        $objRankInfoPRC = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getObjNewestRanklist(Constant::PRCZONE, Constant::GLOBALS);
        $objRankInfoHKTW = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getObjNewestRanklist(Constant::HKTWZONE, Constant::GLOBALS);
        $objChampionlogPRC = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getObjChampionlog(Constant::PRCZONE, 22);
        $objChampionlogHKTW = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getObjChampionlog(Constant::HKTWZONE, 22);
        $objStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getObjArticlelist(Constant::STARINTERVIEW, 4, 'timeCreateTime', 'DESC');
        $objFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getObjMemberlist(Constant::FM, 20, 'timeCreateTime', 'DESC');
        return $this->render('AcmeFrontendBundle:Default:index.html.twig',
            array(
                'otherinfo' => $objFrontendInfo,
                'flash' => $objFlash,
                'rank_prc'  => $objRankInfoPRC,
                'rank_hktw'  => $objRankInfoHKTW,
                'champion_log_prc' => $objChampionlogPRC,
                'champion_log_hktw' => $objChampionlogHKTW,
                'star_interview' => $objStarInterviewList,
                'fm' => $objFMList,
            ));
    }
}

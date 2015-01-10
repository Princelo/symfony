<?php

namespace AppBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;

class DefaultController extends CustomerController
{
    /**
     */
    public function indexAction()
    {
        $objORM = $this->getDoctrine()->getManager();
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->getArrFlashlist();
        $arrRankInfoPRC = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRanklist(Constant::PRCZONE, Constant::GLOBALS);
        $arrRankInfoHKTW = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRanklist(Constant::HKTWZONE, Constant::GLOBALS);
        $arrChampionlogPRC = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::PRCZONE, 22);
        $arrChampionlogHKTW = $objORM->getRepository('AcmeBackendBundle:Championlog')
            ->getArrChampionlog(Constant::HKTWZONE, 22);
        $arrStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticlelist(Constant::STARINTERVIEW, 4, 'timeCreateTime', 'DESC');
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrMemberlist(Constant::FM, 20, 'timeCreateTime', 'DESC');
        return $this->render('AcmeFrontendBundle:Default:index.html.twig',
                            array(
                                'otherinfo' => $arrFrontendInfo,
                                'flash' => $arrFlash,
                                'rank_prc'  => $arrRankInfoPRC,
                                'rank_hktw'  => $arrRankInfoHKTW,
                                'champion_log_prc' => $arrChampionlogPRC,
                                'champion_log_hktw' => $arrChampionlogHKTW,
                                'star_interview' => $arrStarInterviewList,
                                'fms' => $arrFMList,
                            ));
    }
}

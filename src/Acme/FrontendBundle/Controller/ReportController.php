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
     * @return Response
     * @Route("/report", name="_report")
     */
    public function reportListAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $objORM = $this->getDoctrine()->getManager();
        $intTermNo = $session->get('last_term_no');
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $intLastTermNo = $session->get('last_term_no');
        if ($request->getMethod() == 'GET'
            && $request->query->get('zone') != null && $request->query->get('term-no') != null) {
            $where = $this->_getStrSearchStr($request->query->get('search') );
            $arrLastRankSong = $objORM->getRepository('AcmeBackendBundle:Rank')
                ->getArrNewestRankList($request->query->get('zone'), 999, $request->query->get('term-no'), $where);
            return $this->render('AcmeFrontendBundle:Report:list.html.twig',
                array(
                    'otherinfo' => $arrFrontendInfo,
                    'fms' => $arrFMList,
                    'list' => $arrLastRankSong,
                    'current_term_no' => $intLastTermNo,
                    'search_term_no' => $request->query->get('term-no'),
                ));
        }
        //if($strZone == 'prc')
        $arrLastRankSong = $objORM->getRepository('AcmeBackendBundle:Rank')
            ->getArrNewestRankList(Constant::PRCZONE, 999, $intTermNo);
        //if($strZone == 'hktw')
        //    $arrLastRankSong = $objORM->getRepository('AcmeBackendBundle:Rank')
        //        ->getArrNewestRankList(Constant::HKTWZONE, 999, $intTermNo);
        return $this->render('AcmeFrontendBundle:Report:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'list' => $arrLastRankSong,
                'current_term_no' => $intLastTermNo,
                'search_term_no' => $intTermNo,
            ));
    }

    /**
     * @param $intTermNo
     * @param $intZone
     * @param $intSongId
     * @return Response
     * @Route("/report/details/{intTermNo}/{intZone}/{intSongId}", name="_report_details")
     */
    public function reportDetailsAction($intTermNo, $intZone, $intSongId)
    {
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrVoteDetails = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVoteDetails($intTermNo, $intZone, $intSongId);

        return $this->render('AcmeFrontendBundle:Report:details.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'list' => $arrVoteDetails,
            ));
    }

    private function _getStrSearchStr($search)
    {
        if($search != null)
            return " AND (s.strTitle like '%{$search}%' or s.arrStrArtistName like '%{$search}%') ";
        else
            return "";
    }
}

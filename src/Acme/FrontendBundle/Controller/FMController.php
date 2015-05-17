<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FMController extends CustomerController
{

    /**
     * @return Response
     * @Route("/fm", name="_fm")
     */
    public function fmListAction()
    {
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMFullName('timeCreateTime', 'DESC', 600);
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo(600);
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7, 600);
        $response = $this->render('AcmeFrontendBundle:FM:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'allfms' => $arrFMList,
                'coops' => $arrCoopList,
            ));
        $response->setETag(md5($response->getContent()));
        $response->setPublic(); // make sure the response is public/cacheable
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @param $id
     * @return Response
     * @Route("/fm/{id}", name="_fm_detail")
     */
    public function fmDetailAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $objFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->find($id);
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC', 600);
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo(600);
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7, 600);
        if ($request->query->get('prc-term-no') != null)
        {
            $intPrcTermNo = $request->query->get('prc-term-no');
        }else{
            $intPrcTermNo = $request->getSession()->get('current_term_no');
        }
        if ($request->query->get('hktw-term-no') != null)
        {
            $intHktwTermNo = $request->query->get('hktw-term-no');
        }else{
            $intHktwTermNo = $request->getSession()->get('current_term_no');
        }
        $arrPrcVotelog = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotelogInfo($id, $intPrcTermNo, Constant::PRCZONE);
        $arrHktwVotelog = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotelogInfo($id, $intHktwTermNo, Constant::HKTWZONE);
        $intNextRankTime = $request->getSession()->get('next_rank_time');
        $response = $this->render('AcmeFrontendBundle:FM:details.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'fm' => $objFM,
                'prc_votelog' => $arrPrcVotelog,
                'hktw_votelog' => $arrHktwVotelog,
                'next_rank_time' => $intNextRankTime,
                'prc_term_no' => $intPrcTermNo,
                'hktw_term_no' => $intHktwTermNo,
                'current_term_no' => $request->getSession()->get('last_term_no'),
                'coops' => $arrCoopList,
            ));
        $response->setETag(md5($response->getContent()));
        $response->setPublic(); // make sure the response is public/cacheable
        $response->isNotModified($request);

        return $response;
    }

}

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
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMFullName('timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        return $this->render('AcmeFrontendBundle:FM:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'allfms' => $arrFMList,
            ));
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
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        if ($request->query->get('prc-term-no') != null)
        {
            $intPrcTermNo = $request->query->get('prc-term-no');
        }else{
            $intPrcTermNo = $request->getSession()->get('current-term-no');
        }
        if ($request->query->get('hktw-term-no') != null)
        {
            $intHktwTermNo = $request->query->get('hktw-term-no');
        }else{
            $intHktwTermNo = $request->getSession()->get('current-term-no');
        }
        $arrPrcVotelog = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotelogInfo($id, $intPrcTermNo, Constant::PRCZONE);
        $arrHktwVotelog = $objORM->getRepository('AcmeBackendBundle:Votelog')
            ->getArrVotelogInfo($id, $intHktwTermNo, Constant::HKTWZONE);
        $intNextRankTime = $request->getSession()->get('next-rank-time');
        return $this->render('AcmeFrontendBundle:FM:details.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'fm' => $objFM,
                'prc-votelog' => $arrPrcVotelog,
                'hktw-votelog' => $arrHktwVotelog,
                'next_rank_time' => $intNextRankTime,
            ));
    }

}

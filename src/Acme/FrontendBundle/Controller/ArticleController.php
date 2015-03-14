<?php

namespace Acme\FrontendBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends CustomerController
{

    /**
     * @param $id
     * @return Response
     * @Route("/article_detail/{id}", name="_article_detail")
     */
    public function articleDetailAction($id)
    {
        $objORM = $this->getDoctrine()->getManager();
        $objArticle = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->find($id);
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrStarNewsList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(3, 8, 'timeCreateTime', 'DESC');
        $arrHotPic = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(4, 4, 'timeCreateTime', 'DESC');
        $arrHotNewsB = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(1, 4, 'timeCreateTime', 'DESC');
        $arrHotNewsA = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(2, 4, 'timeCreateTime', 'DESC');
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7);
        $arrTopFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findBy(array('intCategory' => 1));
        return $this->render('AcmeFrontendBundle:Article:detail.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'article' => $objArticle,
                'fms' => $arrFMList,
                'star_news' => $arrStarNewsList,
                'hot_pics' => $arrHotPic,
                'hot_news_b' => $arrHotNewsB,
                'hot_news_a' => $arrHotNewsA,
                'coops' => $arrCoopList,
                'top_flash' => $arrTopFlash,
            ));
    }

    /**
     * @return Response
     * @Route("/article", name="_article")
     */
    public function articleAllAction()
    {
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrStarNewsList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(3, 8, 'timeCreateTime', 'DESC');
        $arrHotPic = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(4, 4, 'timeCreateTime', 'DESC');
        $arrHotNewsB = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(1, 8, 'timeCreateTime', 'DESC');
        $arrHotNewsA = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(2, 8, 'timeCreateTime', 'DESC');
        $arrStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(5, 4, 'timeCreateTime', 'DESC');
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7);
        return $this->render('AcmeFrontendBundle:Article:all.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'star_news' => $arrStarNewsList,
                'hot_pics' => $arrHotPic,
                'hot_news_b' => $arrHotNewsB,
                'hot_news_a' => $arrHotNewsA,
                'star_interviews' => $arrStarInterviewList,
                'coops' => $arrCoopList,
            )
        );
    }

    /**
     * @param $category_id
     * @param $page
     * @return Response
     * @Route("article_img_list/{category_id}/{page}", name="_article_img_list")
     */
    public function articleImageListAction($category_id, $page = 1)
    {
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $queryActlist = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getQueryArticleList($category_id);
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7);
        switch($category_id)
        {
            case 1:
                $strListTitle = Constant::CATEGORY1;
                break;
            case 2:
                $strListTitle = Constant::CATEGORY2;
                break;
            case 3:
                $strListTitle = Constant::CATEGORY3;
                break;
            case 4:
                $strListTitle = Constant::CATEGORY4;
                break;
            case 5:
                $strListTitle = Constant::CATEGORY5;
                break;
            case 5:
                $strListTitle = Constant::CATEGORY6;
                break;
            default:
                $strListTitle = "category error";
                break;
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryActlist,
            $request->query->get('page', $page)/*page number*/,
            30/*limit per page*/
        );
        $arrTopFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findBy(array('intCategory' => 1));
        return $this->render('AcmeFrontendBundle:Article:img_list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'pagination' => $pagination,
                'list_title' => $strListTitle,
                'category_id' => $category_id,
                'coops' => $arrCoopList,
                'top_flash' => $arrTopFlash,
            )
        );
    }

    /**
     * @param $category_id
     * @param $page
     * @return Response
     * @Route("article_list/{category_id}/{page}", name="_article_list")
     */
    public function articleListAction($category_id, $page = 1)
    {
        $request = $this->getRequest();
        $objORM = $this->getDoctrine()->getManager();
        $arrFMList = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(20, 'timeCreateTime', 'DESC');
        $arrFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $queryActlist = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getQueryArticleList($category_id);
        $arrCoopList = $objORM->getRepository('AcmeFrontendBundle:Coop')
            ->getArrCoopList(7);
        switch($category_id)
        {
            case 1:
                $strListTitle = Constant::CATEGORY1;
                break;
            case 2:
                $strListTitle = Constant::CATEGORY2;
                break;
            case 3:
                $strListTitle = Constant::CATEGORY3;
                break;
            case 4:
                $strListTitle = Constant::CATEGORY4;
                break;
            case 5:
                $strListTitle = Constant::CATEGORY5;
                break;
            case 6:
                $strListTitle = Constant::CATEGORY6;
                break;
            default:
                $strListTitle = "category error";
                break;
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryActlist,
            $request->query->get('page', $page)/*page number*/,
            6/*limit per page*/
        );
        $arrStarNewsList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(3, 8, 'timeCreateTime', 'DESC');
        $arrHotPic = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(4, 4, 'timeCreateTime', 'DESC');
        $arrHotNewsB = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(1, 4, 'timeCreateTime', 'DESC');
        $arrHotNewsA = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(2, 4, 'timeCreateTime', 'DESC');
        $arrStarInterviewList = $objORM->getRepository('AcmeFrontendBundle:Article')
            ->getArrArticleList(5, 4, 'timeCreateTime', 'DESC');
        $arrTopFlash = $objORM->getRepository('AcmeFrontendBundle:Flash')
            ->findBy(array('intCategory' => 1));
        return $this->render('AcmeFrontendBundle:Article:list.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'fms' => $arrFMList,
                'pagination' => $pagination,
                'list_title' => $strListTitle,
                'star_news' => $arrStarNewsList,
                'hot_pics' => $arrHotPic,
                'hot_news_b' => $arrHotNewsB,
                'hot_news_a' => $arrHotNewsA,
                'star_interviews' => $arrStarInterviewList,
                'coops' => $arrCoopList,
                'top_flash' => $arrTopFlash,
            )
        );
    }

}

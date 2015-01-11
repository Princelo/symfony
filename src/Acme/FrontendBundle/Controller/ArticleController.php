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
     * @param $category
     * @return Response
     * @Route("/article_img_list/{category}", name="article_img_list")
     */
    public function articleImageListAction($category)
    {
        return new Response();
    }
    /**
     * @param $category
     * @return Response
     * @Route("/article_list/{category}", name="article_list")
     */
    public function articleListAction($category)
    {
        return new Response();
    }

    /**
     * @param $id
     * @return Response
     * @Route("/article_detail/{id}", name="article_detail")
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
        return $this->render('AcmeFrontendBundle:Article:detail.html.twig',
            array(
                'otherinfo' => $arrFrontendInfo,
                'article' => $objArticle,
                'fms' => $arrFMList,
                'star_news' => $arrStarNewsList,
                'hot_pics' => $arrHotPic,
                'hot_news_b' => $arrHotNewsB,
                'hot_news_a' => $arrHotNewsA,
            ));
    }
}

<?php

namespace Acme\TestBundle\Controller;

use Acme\CoreBundle\Controller\CustomerController;
use Acme\TestBundle\Entity\TestComment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/test_create", name="testpage")
     */
    public function indexAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $testComment1 = new TestComment();
//        $testComment1->setContent('test1');
//        $em->persist($testComment1);
//        $testComment2 = new TestComment();
//        $testComment2->setContent('test2');
//        $testComment2->setParent($testComment1);
//        $em->persist($testComment2);
//        $testComment4 = new TestComment();
//        $testComment4->setContent('test4');
//        $testComment4->setParent($testComment2);
//        $em->persist($testComment4);
//        $em->flush();
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('AcmeBackendBundle:Song')
            ->findOneBy(['id' => 6]);
        $test2 = $test->getComments();
        echo $test2[0]->getStrContent();
//        return new Response($test2[0]->getStrContent());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/test_read", name="testread")
     */
    public function readAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('AcmeTestBundle:Test')
            ->find(17);
    }


}

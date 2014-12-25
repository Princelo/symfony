<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        return new Response('Created product id '.$product->getId());
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Product')
            ->find($id);
        $categoryName = $product->getCategory()->getName();
        // prints "Proxies\AcmeStoreBundleEntityCategoryProxy" 8 echo get_class($category);
    }

    public function showProductAction($id)
    {
        $category = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Category')
            ->find($id);
        $products = $category->getProducts();
        // ...
    }

    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');
        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum dolor');
        // relate this product to the category
        $product->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();
        return new Response(
            'Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }
}

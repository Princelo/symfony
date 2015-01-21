<?php

namespace Acme\CoreBundle\Twig;

use Acme\BackendBundle\Entity\City;
use Acme\BackendBundle\Entity\Constant;

class AcmeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('md5', array($this, 'md5Filter')),
            new \Twig_SimpleFilter('province', array($this, 'provinceFilter')),
            new \Twig_SimpleFilter('city', array($this, 'cityFilter')),
            new \Twig_SimpleFilter('week', array($this, 'weekFilter')),
            new \Twig_SimpleFilter('article', array($this, 'articleFilter')),
        );
    }

    public function md5Filter($string)
    {
        $string = md5($string);

        return $string;
    }

    public  function provinceFilter($string)
    {
        $objCity = new City();
        $string = $objCity->getStrProvinceName($string);
        return $string;
    }

    public function cityFilter($string)
    {
        $objCity = new City();
        $string = $objCity->getStrCityName($string);
        return $string;
    }

    public function weekFilter($string)
    {
        switch($string){
            case '0':
                $string = '周日';
                break;
            case '1':
                $string = '周一';
                break;
            case '2':
                $string = '周二';
                break;
            case '3':
                $string = '周三';
                break;
            case '4':
                $string = '周四';
                break;
            case '5':
                $string = '周五';
                break;
            case '6':
                $string = '周六';
                break;
        }
        return $string;
    }

    public function articleFilter($string)
    {
        switch($string)
        {
            case '1':
                $string = Constant::CATEGORY1;
                break;
            case '2':
                $string = Constant::CATEGORY2;
                break;
            case '3':
                $string = Constant::CATEGORY3;
                break;
            case '4':
                $string = Constant::CATEGORY4;
                break;
            case '5':
                $string = Constant::CATEGORY5;
                break;
            default:
                break;
        }
        return $string;
    }

    public function getName()
    {
        return 'acme_extension';
    }
}
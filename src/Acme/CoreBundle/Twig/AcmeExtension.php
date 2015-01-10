<?php

namespace Acme\CoreBundle\Twig;

class AcmeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('md5', array($this, 'md5Filter')),
        );
    }

    public function md5Filter($string)
    {
        $string = md5($string);

        return $string;
    }

    public function getName()
    {
        return 'acme_extension';
    }
}
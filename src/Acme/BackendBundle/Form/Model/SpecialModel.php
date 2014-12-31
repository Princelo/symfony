<?php
namespace Acme\BackendBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Acme\BackendBundle\Entity\Special;
use Acme\BackendBundle\Entity\Constant;

class SpecialModel
{
    /**
     * @Assert\Type(type="Acme\BackendBundle\Entity\Special")
     * @Assert\Valid()
     */
    protected $special;


    public function setSpecial(Special $special)
    {
        $this->special = $special;
    }

    public function getSpecial()
    {
        return $this->special;
    }
}
<?php
namespace Acme\BackendBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Acme\BackendBundle\Entity\FM;
use Acme\BackendBundle\Entity\Constant;

class FMRegistration
{
    /**
     * @Assert\Type(type="Acme\BackendBundle\Entity\FM")
     * @Assert\Valid()
     */
    protected $fm;

    /*
     * @Assert\NotBlank()
     * @Assert\True()
     */
    //protected $termsAccepted;

    public function setFM(FM $fm)
    {
        $this->fm = $fm;
    }

    public function getFM()
    {
        return $this->fm;
    }

    /*public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }*/
}
<?php
namespace Acme\BackendBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Acme\BackendBundle\Entity\Corp;
use Acme\BackendBundle\Entity\Constant;

class CorpRegistration
{
    /**
     * @Assert\Type(type="Acme\BackendBundle\Entity\Corp")
     * @Assert\Valid()
     */
    protected $corp;

    /*
     * @Assert\NotBlank()
     * @Assert\True()
     */
    //protected $termsAccepted;

    public function setCorp(Corp $corp)
    {
        $this->corp = $corp;
    }

    public function getCorp()
    {
        return $this->corp;
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
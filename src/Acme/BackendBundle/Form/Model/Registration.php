<?php
namespace Acme\BackendBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Acme\BackendBundle\Entity\Member;
use Acme\BackendBundle\Entity\Constant;

class Registration
{
    /**
     * @Assert\Type(type="Acme\BackendBundle\Entity\Member")
     * @Assert\Valid()
     */
    protected $member;

    /*
     * @Assert\NotBlank()
     * @Assert\True()
     */
    //protected $termsAccepted;

    public function setMember(Member $member)
    {
        $this->member = $member;
    }

    public function getMember()
    {
        return $this->member;
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
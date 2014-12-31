<?php
namespace Acme\BackendBundle\Form\Type;

use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FMRegistrationType extends AbstractType
{
    public $step;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $fmType = new FMType();
        if($this->step != "")
            $fmType->setStep($this->step);
        $builder->add('fm', $fmType, array('label'=>false));
    }

    public function getName()
    {
        return 'fmregistration';
    }
    public function setStep($step)
    {
        $this->step = $step;
        return $this;
    }

    public function getStep(){
        return $this->step;
    }

}
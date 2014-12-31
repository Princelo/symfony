<?php
namespace Acme\BackendBundle\Form\Type;

use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CorpRegistrationType extends AbstractType
{
    public $step;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $corpType = new CorpType();
        if($this->step != "")
            $corpType->setStep($this->step);
        $builder->add('corp', $corpType, array('label'=>false));
    }

    public function getName()
    {
        return 'corpregistration';
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
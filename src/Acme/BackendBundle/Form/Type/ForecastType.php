<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class ForecastType extends AbstractType
{
    private $boolUppable;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('strContent', 'text', array('label'=>'公告内容',
            'attr' => array(
                'maxlength' => '50',
            ),
            ));
        if($this->boolUppable)
            $builder->add('boolIsUp', 'checkbox', array('label'=>'是否置顶'));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setBoolUppable($boolUppable)
    {
        $this->boolUppable = $boolUppable;
        return $this;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Forecast',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'forecast';
    }

}
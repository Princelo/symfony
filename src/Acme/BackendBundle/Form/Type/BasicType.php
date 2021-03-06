<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class BasicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        $builder->add('intWeekDay', 'choice', array('label'=>'放榜时间',
            'choices' => $choice->getWeeklist()));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Basic',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'basic';
    }

}
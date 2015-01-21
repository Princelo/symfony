<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('strShortName', 'text', array(
            'label' => '显示名称',
        ));
        $builder->add('strTel', 'text', array(
            'label' => '联系电话',
        ));
        $builder->add('完成', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Member'
        ));
    }

    public function getName()
    {
        return 'admin';
    }
}
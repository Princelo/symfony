<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class FlashType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        $builder->add('strImg', 'file', array('label'=>'图片',
            'data_class' => null));
        $builder->add('strLink', 'text', array('label'=>'LINK'));
        $builder->add('boolIsNewTab', 'checkbox', array('label'=>'是否跳转新页'));
        $builder->add('intCategory', 'choice', array(
            'choices' => $choice->getFlashCategories(),
            'label'   => '幻燈片位置',
        ));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FrontendBundle\Entity\Flash',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'flash';
    }

}
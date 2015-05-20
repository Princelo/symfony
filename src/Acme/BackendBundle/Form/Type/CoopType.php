<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CoopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('strTitle', 'text', array(
            'label' => "标题",
            'attr' => array(
                'maxlength' => '20',
            ),
        ));
        $builder->add('strThumb', 'file', array(
            'label' => '缩略图',
            'data_class' => null,
        ));
        $builder->add('strLink', 'text', array(
            'label' => "链接",
            'attr' => array(
                'maxlength' => '200',
            ),
        ));
        $builder->add('intWeight', 'text', array(
            'label' => "排序权重",
            'attr' => array(
                'maxlength' => '5',
            ),
        ));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FrontendBundle\Entity\Coop',
        ));
    }

    public function getName()
    {
        return 'coop';
    }

}
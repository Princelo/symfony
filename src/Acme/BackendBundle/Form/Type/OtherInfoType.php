<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class OtherInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        $builder->add('strSiteTitle', 'text', array('label'=>'网站标题'));
        $builder->add('strSiteSubTitle', 'text', array('label'=>'网站副标题'));
        $builder->add('strFootInfo', 'text', array('label'=>'脚部信息'));
        $builder->add('strADImg1', 'file', array('label'=>'广告位1 图片',
            'data_class' => null));
        $builder->add('strADLink1', 'text', array('label'=>'广告位1 LINK'));
        $builder->add('strADImg2', 'file', array('label'=>'广告位2 图片',
            'data_class' => null));
        $builder->add('strADLink2', 'text', array('label'=>'广告位2 LINK'));
        $builder->add('strTopImg', 'file', array('label'=>'网站顶部大图片',
            'data_class' => null));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FrontendBundle\Entity\OtherInfo',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'otherinfo';
    }

}
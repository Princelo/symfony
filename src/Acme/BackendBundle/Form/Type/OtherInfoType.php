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
        $builder->add('strSiteTitle', 'text', array('label'=>'网站标题',
            'attr' => array(
                'maxlength' => '20',
            ),
            ));
        $builder->add('strSiteSubTitle', 'text', array('label'=>'网站副标题',
            'attr' => array(
                'maxlength' => '20',
            ),
            ));
        $builder->add('strFootInfo', 'ckeditor', array('label'=>'脚部信息',
                'config' => array(
                    'font_names' => 'Microsoft YaHei;SimSun;PMingLiU;Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif',
                )
            )
        );
        $builder->add('strADImg1', 'file', array('label'=>'广告位1 图片',
            'data_class' => null));
        $builder->add('strADLink1', 'text', array('label'=>'广告位1 LINK',
            'attr' => array(
                'maxlength' => '200',
            ),
            ));
        $builder->add('strADImg2', 'file', array('label'=>'广告位2 图片',
            'data_class' => null));
        $builder->add('strADLink2', 'text', array('label'=>'广告位2 LINK',
            'attr' => array(
                'maxlength' => '200',
            ),
            ));
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
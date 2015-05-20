<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class ActType extends AbstractType
{
    public $strCompany;
    protected $boolIsEdit;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        $builder->add('intType', 'choice', array('label'=>'节目类型',
            'choices' => $choice->getActTypelist(),
            'attr' => array(
                'data-validate'=>'required'
            )));
        $builder->add('strTitle', 'text', array('label'=>'节目名称',
            'attr'=>array(
                'data-validate'=>'required',
                'maxlegnth' => '30'
            )));
        $builder->add('strIntro', 'text', array('label'=>'节目介绍'));
        $builder->add('strOtherLink', 'text', array('label'=>'外部链接',
            'attr' => array(
                'class' => 'otherlink',
                'maxlegnth' => '200'
            )
        ));

        if(!$this->boolIsEdit)
            $builder->add('strActFile', 'text', array('label'=>'上传文件',
                'attr' => array(
                    'class' => 'fileinput hidden'
                )));
        if(!$this->boolIsEdit)
            $builder->add('请上传文件或添加链接...', 'submit', array(
                'attr'=>array(
                    'disabled'=>'disabled',
                    'class' => 'btn btn-default'
                )));
        else
            $builder->add('提交', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Act',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'act';
    }


    public function setBoolIsEdit($boolIsEdit)
    {
        $this->boolIsEdit = $boolIsEdit;
        return $this;
    }
}
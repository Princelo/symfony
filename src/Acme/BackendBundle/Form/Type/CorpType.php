<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\City;
use Symfony\Component\Validator\Constraints\Choice;

class CorpType extends AbstractType
{
    protected $intStatus;
    protected $step;
    public $arrCity;
    protected $boolIsUpdate;
    public $Choice;

    public function __construct()
    {
        $this->Choice = new \Acme\BackendBundle\Entity\Choice();
    }

    public function getArrProvinces(){
        $city = new City();
        return $city->getArrProvinces();
    }
    public function getAvailableCities($intProvinceId){
        $city = new City();
        return $city->getAvailableCities($intProvinceId);
    }
    public function getAllCities(){
        $city = new City();
        return $city->getAllCities();
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($this->boolIsUpdate)
        {
            $builder->add('');
            $builder->add('完成', 'submit');
        }else{


            if($this->step=="" || $this->step == 0){
                $builder->add('email', 'email', array(
                    'label' => '邮件帐号',
                    'attr'  => array('data-validate'=>'required,email,uniqueemail'),
                ));
                $builder->add('password', 'repeated', array(
                    'first_options'  => array('label'=>'登录密码',
                        'attr' => array('data-validate'=>"required,mypassword"),
                    ),
                    'second_options' => array('label'=>'确认登录密码',
                        'attr' => array('data-validate'=>"required,myconfirm"),
                    ),
                    'type'        => 'password',
                ));
            }
            if($this->step==1){
                $builder->add('strLogo', 'file', array('label'=>'唱片公司LOGO',
                    'data_class'=>null));
                $builder->add('strFullName', 'text', array('label'=>'唱片公司全称',
                    'attr' => array(
                        'maxlength' => '30',
                    ),
                    ));
                $builder->add('strShortName',  'text', array('label'=>'公司简称',
                    'attr'=>array(
                        'data-validate'=>'required',
                        'maxlength' => '15',
                        )));
                $builder->add('intProvinceId',  'choice', array('label'=>false,
                    'attr'=>array('data-validate'=>'required',
                        'class'=>'provinceSelect',
                    ),
                    'choices'=>$this->getArrProvinces()));
                $builder->add('intCityId',  'choice', array('label'=>false,
                        'attr'=>array('data-validate'=>'required',
                            'class'=>'citySelect'),
                        'choices'=>$this->getAllCities(),)
                );
                /*$formModifier = function (FormInterface $form, $intProvinceId = null) {
                    $cities = null === $intProvinceId ? array() : $this->getAvailableCities($intProvinceId);

                    $form->add('intCityId', 'choice', array(
                        'attr' => array(
                            'data-validate' =>  'required',
                            'class' => 'citySelect',
                        ),
                        'choices'     => $cities,
                    ));
                };

                $builder->addEventListener(
                    FormEvents::PRE_SET_DATA,
                    function (FormEvent $event) use ($formModifier) {
                        $data = $event->getData();
                        $formModifier($event->getForm(), $data->getIntProvinceId());
                    }
                );

                $builder->get('intProvinceId')->addEventListener(
                    FormEvents::POST_SUBMIT,
                    function (FormEvent $event) use ($formModifier) {
                        $intProvinceId = $event->getForm()->getData();
                        $formModifier($event->getForm()->getParent(), $intProvinceId);
                    }
                );*/
                $builder->add('strAddressInfo',  'text', array('label'=>false,
                    'attr'=>array(
                        'data-validate'=>'required',
                        'maxlength' => '50',
                    )));
                $builder->add('strZipCode',  'text', array('label'=>'邮政编码',
                    'attr' => array(
                        'maxlength' => '20',
                    ),
                    ));
                $builder->add('strTel',  'text', array('label'=>'公司电话',
                    'attr'=>array(
                        'data-validate'=>'required',
                        'maxlength' => '20'
                        )));
                $builder->add('arrStrArtistName', 'collection',
                    array(
                        'type' => new ArtistType(),
                        'allow_add'    => true,
                        'label' => false,
                    ));
                $builder->add('strIntro',  'text', array('label'=>'公司简介',
                    'attr' => array(
                        'maxlength' => '50',
                    ),
                    ));
            }
            if($this->step==2){
                $builder->add('strUserName', 'text', array('label'=>'真实姓名',
                    'attr' => array(
                        'maxlength' => '10',
                    ),
                    ));
                $builder->add('strUserNickName', 'text', array('label'=>'艺名',
                    'attr'=>array(
                        'data-validate'=>'required',
                        'maxlength' => '15'
                        )));
                $builder->add('intUserGender', 'choice', array('label'=>'性别',
                    'choices'=>$this->Choice->getGenderlist()));
                $builder->add('strUserCitizenId', 'text', array('label'=>'身份证号',
                    'attr' => array(
                        'maxlength' => '20',
                    ),
                    ));
                $builder->add('strUserMobile', 'text', array('label'=>'移动电话',
                    'attr'=>array(
                        'data-validate'=>'required',
                        'maxlength' => '20'
                        )));
                $builder->add('strUserTel', 'text', array('label'=>'固定电话',
                    'attr' => array(
                        'maxlength' => '15',
                    ),
                    ));
                $builder->add('strUserQQ', 'text', array('label'=>'常用QQ',
                    'attr' => array(
                        'maxlength' => '15',
                    ),
                    ));
                $builder->add('strCardPhoto', 'file', array('label'=>false,
                    'data_class'=>null));
                $builder->add('strBodyPhoto', 'file', array('label'=>false,
                    'data_class'=>null));
            }
            if($this->step!=2)
                $builder->add('下一步', 'submit', array('label'=>false,
                    'attr' => array('class' => 'btn-large btn')));
            else
                $builder->add('完成', 'submit', array('label' => false,
                    'attr' => array('class' => 'btn-large btn')));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Corp',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'corp';
    }

    public function setIntStatus($intStatus){
        $this->intStatus = $intStatus;
        return $this;
    }

    public function setBoolIsUpdate($boolIsUpdate)
    {
        $this->boolIsUpdate = $boolIsUpdate;
        return $this;
    }

    public function getIntStatus(){
        return $this->intStatus;
    }

    public function setStep($step){
        $this->step = $step;
        return $this;
    }

    public function getStep(){
        return $this->step;
    }
}
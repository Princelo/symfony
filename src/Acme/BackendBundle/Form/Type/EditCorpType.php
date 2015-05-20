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

class EditCorpType extends AbstractType
{
    protected $intStatus;
    protected $step;
    public $arrCity;
    protected $boolIsAdmin;
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
        $builder->add('strLogo', 'file', array('label'=>'唱片公司LOGO',
            'data_class'=>null));
        $builder->add('strFullName', 'text', array('label'=>'唱片公司全称',
            'attr' => array(
                'maxlength' => '20',
            ),
            ));
        $builder->add('strShortName',  'text', array('label'=>'公司简称',
            'attr'=>array('data-validate'=>'required',
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
            'attr'=>array('data-validate'=>'required',
                'maxlength' => '50',
                )));
        $builder->add('strZipCode',  'text', array('label'=>'邮政编码',
            'attr' => array(
                'maxlength' => '10',
            ),
            ));
        $builder->add('strTel',  'text', array('label'=>'公司电话',
            'attr'=>array('data-validate'=>'required',
                'maxlength' => '15'
                )));
        $builder->add('arrStrArtistName', 'collection',
            array(
                'type' => new ArtistType(),
                'allow_add'    => true,
                'label' => false,
            ));
        $builder->add('strIntro',  'textarea', array('label'=>'公司简介',
            'attr' => array(
                'maxlength' => '50',
            ),
            ));
        $builder->add('strUserName', 'text', array('label'=>'真实姓名',
            'attr' => array(
                'maxlength' => '10',
            ),
            ));
        $builder->add('strUserNickName', 'text', array('label'=>'艺名',
            'attr'=>array('data-validate'=>'required',
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
            'attr'=>array('data-validate'=>'required',
                'maxlength' => '20',
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
        if($this->boolIsAdmin)
            $builder->add('boolIsValid', 'choice', array('label'=>'审核',
                'choices' => array(
                    0 => '未通过',
                    1 => '通过'
                )));
        $builder->add('完成', 'submit', array('label' => false,
            'attr' => array('class' => 'btn-large btn')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Member',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'editcorp';
    }

    public function setBoolIsAdmin($boolIsAdmin)
    {
        $this->boolIsAdmin = $boolIsAdmin;
        return $this;
    }
}
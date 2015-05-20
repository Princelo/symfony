<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\City;
use Acme\BackendBundle\Entity\Choice;

class EditFMType extends AbstractType
{
    protected $intStatus;
    protected $step;
    public $arrCity;
    public $Choice;
    public $boolIsAdmin;

    public function __construct()
    {
        $this->Choice = new Choice();
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
            $builder->add('strLogo', 'file', array('label'=>'电台LOGO',
                'data_class'=>null,
                'required'=>false));
            $builder->add('strFullName', 'text', array('label'=>'电台公司全称',
                'attr'=>array('data-validate'=>'required',
                    'maxlength' => '20',
                    )));
            $builder->add('strShortName',  'text', array('label'=>'公司简称',
                'attr'=>array('data-validate'=>'required',
                    'maxlength' => '50',
                    )));
            $builder->add('intLevel', 'choice', array('label'=>'电台等级',
                'attr'=>array('data-validate'=>'required'),
                'choices'=>$this->Choice->getLevellist()));
            $builder->add('intFMType', 'choice', array('label'=>'电台类型',
                'attr'=>array('data-validate'=>'required'),
                'choices'=>$this->Choice->getFMTypelist()));
            $builder->add('intFMValueType', 'choice', array('label'=>false,
                'attr'=>array('data-validate'=>'required'),
                'choices'=>$this->Choice->getFMValueTypelist()));
            $builder->add('floatFMValue', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'required,decimal')));
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
            $builder->add('strAddressInfo',  'text', array('label'=>false,
                'attr'=>array('data-validate'=>'required',
                    'maxlength'=>'50',
                    )));
            $builder->add('strFMFactor',  'text', array('label'=>'电台功率'));
            $builder->add('strSite',  'text', array('label'=>'官方网站',
                'maxlength' => '30',
                ));
            $builder->add('strFMFoundTime',  'text', array('label'=>'电台创建时间',
                'attr'=>array('data-validate'=>'required,mydate',
                    'class'=>'datepicker founddate')));
            $builder->add('strFMCoverPopular',  'text', array('label'=>'电台覆盖人口',
                'attr' => array(
                    'maxlength' => '20',
                ),
                ));
            $builder->add('strFMJoinAct',  'text', array('label'=>'电台加盟节目',
                'attr'=>array('data-validate'=>'required',
                    'maxlength'=>'30',
                    )));
            $builder->add('boolIsOneRank',  'checkbox', array('label'=>'是否为唯一含榜单节目'));
            $builder->add('intCastType', 'choice', array('label'=>'是否播出XX榜成品节目',
                'attr'=>array('data-validate'=>'required'),
                'choices'=>$this->Choice->getCastTypelist()));
            $builder->add('intCastWeekDay', 'choice', array('label'=>false,
                'attr'=>array('data-validate'=>'required'),
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strCastTimeFrom', 'text', array('label'=>false,
                'attr'=>array('class'=>'timepicker cast_time_from',
                    'maxlength'=>'5',
                    'data-validate'=>'mytime')));
            $builder->add('strCastTimeTo', 'text', array('label'=>false,
                'attr'=>array('class'=>'timepicker cast_time_to',
                    'maxlength'=>'5',
                    'data-validate'=>'mytime')));
            $builder->add('boolCastTimeToTomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'cast_time_to_tomorrow')));
            $builder->add('strAvatar', 'file', array('label'=>false,
                'data_class'=>null));
            $builder->add('strUserName', 'text', array('label'=>'主持人姓名',
                'attr' => array(
                    'maxlength' => '10',
                ),
                ));
            $builder->add('strUserNickName', 'text', array('label'=>'主持人艺名',
                'attr'=>array('data-validate'=>'required',
                    'maxlength' => '15',
                    )));
            $builder->add('intUserGender', 'choice', array('label'=>'性别',
                'choices'=>$this->Choice->getGenderlist()));
            $builder->add('strSeniority', 'text', array('label'=>'从事主持人时间',
                'attr'=>array('data-validate'=>'required',
                    'maxlength' => '30')));
            $builder->add('strUserCitizenId', 'text', array('label'=>'身份证号',
                'attr' => array(
                    'maxlength' => '20',
                ),
                ));
            $builder->add('strUserMobile', 'text', array('label'=>'移动电话',
                'attr'=>array('data-validate'=>'required',
                    'maxlength' => '20')));
            $builder->add('intBusyWeekDayFrom1', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('intBusyWeekDayTo1', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strBusyTimeFrom1', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime1',
                    'class'=>'timepicker busy_time_from_1')));
            $builder->add('strBusyTimeTo1', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime1',
                    'class'=>'timepicker busy_time_to_1')));
            $builder->add('boolBusyTimeTo1Tomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'busy_time_to_1_tomorrow')));
            $builder->add('intBusyWeekDayFrom2', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('intBusyWeekDayTo2', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strBusyTimeFrom2', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime2',
                    'class'=>'timepicker busy_time_from_2')));
            $builder->add('strBusyTimeTo2', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime2',
                    'class'=>'timepicker busy_time_to_2')));
            $builder->add('boolBusyTimeTo2Tomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'busy_time_to_2_tomorrow')));
            $builder->add('intBusyWeekDayFrom3', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('intBusyWeekDayTo3', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strBusyTimeFrom3', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime3',
                    'class'=>'timepicker busy_time_from_3')));
            $builder->add('strBusyTimeTo3', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime3',
                    'class'=>'timepicker busy_time_to_3')));
            $builder->add('boolBusyTimeTo3Tomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'busy_time_to_3_tomorrow')));
            $builder->add('intBusyWeekDayFrom4', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('intBusyWeekDayTo4', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strBusyTimeFrom4', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime4',
                    'class'=>'timepicker busy_time_from_4')));
            $builder->add('strBusyTimeTo4', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime4',
                    'class'=>'timepicker busy_time_to_4')));
            $builder->add('boolBusyTimeTo4Tomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'busy_time_to_4_tomorrow')));
            $builder->add('intBusyWeekDayFrom5', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('intBusyWeekDayTo5', 'choice', array('label'=>false,
                'choices'=>$this->Choice->getWeeklist()));
            $builder->add('strBusyTimeFrom5', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime5',
                    'class'=>'timepicker busy_time_from_5')));
            $builder->add('strBusyTimeTo5', 'text', array('label'=>false,
                'attr'=>array('data-validate'=>'mytime5',
                    'class'=>'timepicker busy_time_from_5')));
            $builder->add('boolBusyTimeTo5Tomorrow', 'checkbox', array('label'=>false,
                'attr'=>array('data-validate'=>'',
                    'class'=>'busy_time_to_5_tomorrow')));
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

            if($this->boolIsAdmin){
                $builder->add('boolIsValid', 'choice', array('label'=>'审核',
                    'choices' => array(
                        0   =>  '未通过',
                        1   =>  '通过'
                    )));
            }

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
        return 'editfm';
    }

    public function setBoolIsAdmin($boolIsAdmin)
    {
        $this->boolIsAdmin = $boolIsAdmin;
        return $this;
    }

}
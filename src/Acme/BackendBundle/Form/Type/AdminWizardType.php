<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 12/19/14
 * Time: 15:31
 */

namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Acme\BackendBundle\Form\Type\ArtistType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminWizardType extends AdminType {
    /**
     * @var boolean $isStepTwo
     */
    private $isStepOne = true;
    private $isStepTwo = false;
    private $isStepThree = false;

    /**
     * Builds the form.
     *
     * @param FormBuilderInterface $builder The builder
     * @param array $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('email', $this->isStepOne?'email':'hidden');
            $builder->add('username', $this->getStrIsHidden(1));
            $builder->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password',
            ));
            $builder->add('boolIsAcceptAuth', $this->getStrIsHidden(1));
            $builder->add('strFullName', $this->getStrIsHidden(2));
            $builder->add('strShortName', $this->getStrIsHidden(2));
            $builder->add('intProvinceId', $this->getStrIsHidden(2));
            $builder->add('intCityId', $this->getStrIsHidden(2));
            $builder->add('strAddressInfo', $this->getStrIsHidden(2));
            $builder->add('strZipCode', $this->getStrIsHidden(2));
            $builder->add('strTel', $this->getStrIsHidden(2));
            if($this->isStepTwo)
                $builder->add('arrStrArtistName', 'collection',
                    array(
                        'type' => new ArtistType(),
                        'allow_add'    => true,
                    ));
            else
                $builder->add('arrStrArtistName', 'collection',
                    array(
                        'type'      => new ArtistType(),
                        'allow_add' => true,
                        'attr'      => array('class' => 'hidden')
                    ));
            $builder->add('strIntro', $this->getStrIsHidden(2));
            $builder->add('strUserName', $this->getStrIsHidden(3));
            $builder->add('strUserNickName', $this->getStrIsHidden(3));
            $builder->add('intUserGender', $this->getStrIsHidden(3));
            $builder->add('strUserCitizenId', $this->getStrIsHidden(3));
            $builder->add('strUserMobile', $this->getStrIsHidden(3));
            $builder->add('strUserTel', $this->getStrIsHidden(3));
            $builder->add('strUserQQ', $this->getStrIsHidden(3));
            if($this->isStepThree)
                $builder->add('strLogo', 'file');
            else
                $builder->add('strLogo', 'hidden');
            if($this->isStepThree)
                $builder->add('strCardPhoto', 'file');
            else
                $builder->add('strCardPhoto', 'hidden');
            if($this->isStepThree)
                $builder->add('strBodyPhoto', 'file');
            else
                $builder->add('strBodyPhoto', 'hidden');
            if($this->isStepThree)
                $builder->add('提交', 'submit');
            else
                $builder->add('下一步', 'submit');
    }

    public function getStrIsHidden($step)
    {
        if($step == 1)
            return ($this->isStepOne != true)?'hidden':null;
        if($step == 2)
            return ($this->isStepTwo != true)?'hidden':null;
        if($step == 3)
            return ($this->isStepThree != true)?'hidden':null;
        return '';
    }

    /**
     * Sets whether or not the form should be configured for step one.
     *
     * @param boolean $value True if step one
     */
    public function setIsStepOne($value)
    {
        $this->isStepOne = $value;
    }

    /**
     * Sets whether or not the form should be configured for step two.
     *
     * @param boolean $value True if step two
     */
    public function setIsStepTwo($value)
    {
        $this->isStepTwo = $value;
    }

    /**
     * Sets whether or not the form should be configured for step three.
     *
     * @param boolean $value True if step three
     */
    public function setIsStepThree($value)
    {
        $this->isStepThree = $value;
    }

}
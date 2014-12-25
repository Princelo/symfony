<?php
namespace Acme\BackendBundle\Form\Type;

use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminRegistrationType extends AbstractType
{
    private $boolIsStepOne;
    private $boolIsStepTwo;
    private $boolIsStepThree;
    private $intMemberType;
    private $intStatus;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$typeAdminWizard = new AdminWizardType();
        $typeAdminWizard->setIsStepOne($this->boolIsStepOne);
        $typeAdminWizard->setIsStepTwo($this->boolIsStepTwo);
        $typeAdminWizard->setIsStepThree($this->boolIsStepThree);
        */
        if(Constant::CORP == $this->intMemberType)
            $typeAdmin = new CorpType();
        else
            $typeAdmin = new FMType();

        $builder->add('member', $typeAdmin);
        /*$builder->add(
            'terms',
            'checkbox',
            array('property_path' => 'termsAccepted')
        );*/
    }

    public function getName()
    {
        return 'registration';
    }

    public function setBoolIsStepOne($bool){
        $this->boolIsStepOne = $bool;
    }
    public function setBoolIsStepTwo($bool){
        $this->boolIsStepTwo = $bool;
    }
    public function setBoolIsStepThree($bool){
        $this->boolIsStepThree = $bool;
    }

    public function setIntMemberType($intMemberType)
    {
        $this->intMemberType = $intMemberType;
        return true;
    }

    public function getIntMemberType()
    {
        return $this->intMemberType;
    }

    public function setIntStatus($intStatus)
    {
        $this->intStatus = $intStatus;
    }

    public function getIntStatus()
    {
        return $this->intStatus;
    }
}
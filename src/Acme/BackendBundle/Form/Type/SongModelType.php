<?php
namespace Acme\BackendBundle\Form\Type;

use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SongModelType extends AbstractType
{
    public $strCompany;
    protected $boolIsEdit;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $songType = new SongType();
        $songType->setStrCompany($this->strCompany);
        $songType->setBoolIsEdit($this->boolIsEdit);
        $builder->add('song', $songType, array('label'=>false));
    }

    public function getName()
    {
        return 'songmodel';
    }
    public function setStrCompany($strCompany){
        $this->strCompany = $strCompany;
    }

    public function setBoolIsEdit($boolIsEdit)
    {
        $this->boolIsEdit = $boolIsEdit;
        return $this;
    }

}
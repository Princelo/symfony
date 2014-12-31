<?php
namespace Acme\BackendBundle\Form\Type;

use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SpecialModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $specialType = new SpecialType();
        $builder->add('special', $specialType, array('label'=>false));
    }

    public function getName()
    {
        return 'specialmodel';
    }

}
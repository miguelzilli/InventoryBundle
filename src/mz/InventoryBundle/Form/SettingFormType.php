<?php

namespace mz\InventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingFormType extends AbstractType
{
    private $addDisplayField = false;

    public function __construct($showDisplayField = false)
    {
        $this->addDisplayField = $showDisplayField;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');

        if ($this->addDisplayField){
            $builder->add('display', 'display', array(
                'empty_value' => 'Default',
                'required' => false
            ));
        }
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'mz\InventoryBundle\Entity\Category'
    //     ));
    // }

    public function getName()
    {
        return 'settingform';
    }
}
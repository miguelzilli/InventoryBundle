<?php
namespace mz\InventoryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DisplayType extends AbstractType
{
    private $displayChoices;

    public function __construct(array $displayChoices)
    {
        $this->displayChoices = $displayChoices;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->displayChoices,
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'display';
    }
}

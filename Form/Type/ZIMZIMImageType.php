<?php

namespace ZIMZIM\ToolsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZIMZIMImageType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array('required' => false)
        );
    }

    public function getParent()
    {
        return 'file';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_toolsbundle_zimzimimage';
    }
}

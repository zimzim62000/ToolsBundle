<?php

namespace ZIMZIM\ToolsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UploadTinymceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                null,
                array('label' => 'adminulploadtinymce.entity.name', 'translation_domain' => 'ZIMZIMTools')
            );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $uloadTinymce = $event->getData();
                $form = $event->getForm();

                $url = '';
                if ($uloadTinymce && $uloadTinymce->getId() !== null) {
                    $url = $uloadTinymce->getWebPath();
                }
                $form->add(
                    'file',
                    'zimzim_toolsbundle_zimzimimage',
                    array(
                        'label' => 'adminulploadtinymce.entity.image',
                        'translation_domain' => 'ZIMZIMTools',
                        'attr' => array(
                            'url' => $url,
                            'label-inline' => 'label-inline'
                        )
                    )
                );
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\ToolsBundle\Entity\UploadTinymce',
                'attr' => array(
                    'class' => 'zimzim-panel'
                ),
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_toolsbundle_uploadtinymcetype';
    }
}

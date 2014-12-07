<?php

namespace ZIMZIM\ToolsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ZIMZIMToolsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias().'.zimzimcollection_formtype', $config['zimzimcollection_formtype']);
        $container->setParameter($this->getAlias().'.zimzimimage_formtype', $config['zimzimimage_formtype']);
        $container->setParameter($this->getAlias().'.zimzimtinymce_formtype', $config['zimzimtinymce_formtype']);
        $container->setParameter($this->getAlias().'.uploadtinymce_class', $config['uploadtinymce_class']);
        $container->setParameter($this->getAlias().'.uploadtinymce_form', $config['uploadtinymce_form']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}

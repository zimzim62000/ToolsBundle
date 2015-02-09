<?php

namespace ZIMZIM\ToolsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zimzim_tools');

        $rootNode
            ->children()
            ->scalarNode('zimzimcollection_formtype')->defaultValue('ZIMZIM\ToolsBundle\Form\Type\ZIMZIMCollectionType')->end()
            ->scalarNode('zimzimimage_formtype')->defaultValue('ZIMZIM\ToolsBundle\Form\Type\ZIMZIMImageType')->end()
            ->scalarNode('zimzimupload_formtype')->defaultValue('ZIMZIM\ToolsBundle\Form\Type\ZIMZIMUploadType')->end()
            ->scalarNode('zimzimtinymce_formtype')->defaultValue('ZIMZIM\ToolsBundle\Form\Type\ZIMZIMTinymceType')->end()
            ->scalarNode('uploadtinymce_class')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('uploadtinymce_form')->defaultValue('zimzim_toolsbundle_uploadtinymcetype')->end()
        ->end();

        return $treeBuilder;
    }
}

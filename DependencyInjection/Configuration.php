<?php

namespace Glory\Bundle\ThemeBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('glory_theme');

        $rootNode
                ->fixXmlConfig('theme')
                ->children()
                    ->scalarNode('path')->defaultValue('%kernel.root_dir%/Resources/themes')->end()
                    ->variableNode('default')->defaultValue('')->end()
                    ->variableNode('switch')->defaultValue('')->end()
                    ->arrayNode('themes')
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('dir')->end()
                                ->scalarNode('condition')->end()
                                ->arrayNode('rewrite')
                                    ->useAttributeAsKey('name')
                                    ->prototype('scalar')
                                        //->normalizeKeys(true)->end()
                                    ->end()
                                ->end()
                                ->scalarNode('format')->end()
                            ->end()
                    ->end()
                ->end();
        return $treeBuilder;
    }

}

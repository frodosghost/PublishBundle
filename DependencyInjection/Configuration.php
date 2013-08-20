<?php

namespace Manhattan\PublishBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('manhattan_publish');

        $rootNode
            ->children()
                ->arrayNode('publish_states')
                    ->prototype('array')->end()
                    ->defaultValue(array(
                        1 => 'Draft',
                        2 => 'Publish',
                        4 => 'Archived',
                        8 => 'Locked'
                    ))
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

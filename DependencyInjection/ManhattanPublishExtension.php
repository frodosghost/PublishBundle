<?php

namespace Manhattan\PublishBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ManhattanPublishExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Publish States
        $this->remapPublishStates($config['publish_states'], $container);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * Remaps parsed array for default into Choices field
     *
     * @param  array            $config
     * @param  ContainerBuilder $container
     */
    protected function remapPublishStates(array $config, ContainerBuilder $container)
    {
        $publishStates = array();

        foreach ($config as $role) {
            $publishStates[$role['value']] = $role['name'];
        }

        $container->setParameter('manhattan.publish.states', $publishStates);
    }

    /**
     * Prepend extension to load in config file
     *
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        // Once Manhattan Console is registered include the additional configuration files
        if (isset($bundles['ManhattanPublishBundle'])) {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('config.yml');
        }
    }
}

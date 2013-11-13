<?php

namespace SekoiaLearn\CrocodocBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class CrocodocExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.xml');

        $container->setParameter('crocodoc.api_key', $config['api_key']);
    }
}
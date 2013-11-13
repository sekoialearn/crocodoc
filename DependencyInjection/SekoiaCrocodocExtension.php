<?php

namespace SekoiaLearn\CrocodocBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class SekoiaLearnCrocodocExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        /*$config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }*/


        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');

        if(! $config['api_key']){
            throw new \InvalidArgumentException("The Crocodoc API key must be set in the application's configuration");
        }

        $container->setParameter('crocodoc.api_key', $config['api_key']);
    }
}
<?php

namespace SekoiaLearn\CrocodocBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('crocodoc');

        $rootNode
            ->children()
            ->scalarNode('api_key')->isRequired()
            ->end();

        return $treeBuilder;
    }
}
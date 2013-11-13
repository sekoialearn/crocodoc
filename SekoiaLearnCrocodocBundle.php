<?php

namespace SekoiaLearn\CrocodocBundle;

use SekoiaLearn\CrocodocBundle\DependencyInjection\CrocodocExtension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SekoiaLearnCrocodocBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // register extensions that do not follow the conventions manually
        $container->registerExtension(new CrocodocExtension());
    }
}

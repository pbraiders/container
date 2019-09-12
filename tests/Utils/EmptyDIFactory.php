<?php

declare(strict_types=1);

namespace PbraidersTest\Utils;

use DI\ContainerBuilder;
use Pbraiders\Container\AbstractFactory;
use Psr\Container\ContainerInterface;

/**
 * Empty factory.
 */
class EmptyDIFactory extends AbstractFactory
{
    /**
     * Creates an empty PHP-DI container.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface
    {
        /** @var \DI\ContainerBuilder $pBuilder Helper to create and configure a Container. */
        $pBuilder = new ContainerBuilder();
        $pBuilder->writeProxiesToFile(false, '');
        $pBuilder->useAnnotations(false);
        $pBuilder->useAutowiring(false);
        $pContainer = $pBuilder->build();
        return $pContainer;
    }
}

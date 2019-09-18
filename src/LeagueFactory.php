<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Container
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container;

use League\Container\Container;
use Psr\Container\ContainerInterface;

/**
 * League container factory.
 * Creates and configures a Psr\Container.
 */
class LeagueFactory extends AbstractFactory
{

    /**
     * Creates and configures a League container.
     *
     * The definitions may be:
     *  - an array of class name. The class name should be class that may be directly instantiated
     *                         without any constructor arguments.
     *  - an array of service name/factory class name pairs. The factories should be any PHP callbacks.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface
    {

        /** @var \League\Container\Container $pContainer PSR-11 container. */
        $pContainer = new Container();

        // Add definitions.
        foreach ($this->aDefinitions as $aDefinitions) {
            if ($aDefinitions['service_provider']) {
                // Case: service provider.
                $this->registerProvider($pContainer, $aDefinitions['definition']);
            } else {
                // Case: invokable
                if ($aDefinitions['shared']) {
                    $this->registerSharedFactory($pContainer, $aDefinitions['definition']);
                } else {
                    $this->registerFactory($pContainer, $aDefinitions['definition']);
                }
            }
        }

        return $pContainer;
    }

    /**
     * Populates the container with service providers.
     *
     * @param \League\Container\Container $pContainer The container
     * @param array $aProviders Array of class name. The class name should be class that may be directly instantiated
     *                          without any constructor arguments.
     * @return void
     */
    protected function registerProvider(Container $pContainer, array $aProviders): void
    {
        foreach ($aProviders as $sProvider) {
            $pContainer->addServiceProvider($sProvider);
        }
    }

    /**
     * Populates the container with factories.
     *
     * @param \League\Container\Container $pContainer The container
     * @param array $aFactories An array of service name/factory class name pairs. The factories should be any PHP
     *                          callbacks.
     * @return void
     */
    protected function registerFactory(Container $pContainer, array $aFactories): void
    {
        foreach ($aFactories as $sServiceName => $sFactory) {
            $pContainer->add($sServiceName, $sFactory)->addArgument($pContainer);
        }
    }

    /**
     * Populates the container with factories.
     *
     * @param \League\Container\Container $pContainer The container
     * @param array $aFactories An array of service name/factory class name pairs. The factories should be any PHP
     *                          callbacks.
     * @return void
     */
    protected function registerSharedFactory(Container $pContainer, array $aFactories): void
    {
        foreach ($aFactories as $sServiceName => $sFactory) {
            $pContainer->share($sServiceName, $sFactory)->addArgument($pContainer);
        }
    }
}

<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Container
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container;

use Psr\Container\ContainerInterface;

/**
 * Simple container factory interface.
 */
interface FactoryInterface
{
    /**
     * Creates, configures and populates a PSR-11 dependency injection container factory.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface;


    /**
     * Registers definitions.
     *
     * The list of definitions is a key value paired like:
     * [
     *  'settings' => [
     *      'shared' => bool,
     *      'service_provider' => bool,
     *      'definition' => [...],
     *      ]
     * ]
     *
     * @param string $id Definition iD
     * @param array $definitions The definitions.
     * @param boolean $shared We can tell a definition to only resolve once and return the same instance every time it is resolved.
     * @param boolean $serviceprovider If the definition is a service provider.
     * @throws \InvalidArgumentException if $id is not valid
     * @return void
     */
    public function registerDefinition(string $id, array $definitions, bool $shared = false, bool $serviceprovider = false): void;
}

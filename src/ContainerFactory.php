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
interface ContainerFactory
{
    /**
     * Creates a PSR-11 dependency injection container factory.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface;
}

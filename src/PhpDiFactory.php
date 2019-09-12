<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Container
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * PHP-DI container factory.
 * Creates and configures a Psr\Container.
 */
class PhpDiFactory extends AbstractFactory
{

    /**
     * Configures the container compilation for optimum performances.
     * Be aware that the container is compiled once and never updated!
     * Therefore:
     * - in production you should clear that directory every time you deploy
     * - in development you should not compile the container
     *
     * @var boolean
     */
    protected $bCompilationEnabled = true;

    /**
     * Directory in which to put the compiled container.
     *
     * @var string
     */
    protected $sCompilationCacheDirectory = '';

    /**
     * Configure the proxy generation.
     * For dev environment, use false (default configuration)
     * For production environment, use true.
     *
     * @var boolean
     */
    protected $bProxyEnabled = true;

    /**
     *  Directory where to write the proxies.
     *
     * @var string
     */
    protected $sProxyDirectory = '';

    /**
     * Disables the container compilation.
     * @return self
     */
    public function disableCompilation(): self
    {
        $this->bCompilationEnabled = false;
        return $this;
    }

    /**
     * Defines the directory in which to put the compiled container.
     *
     * @param string $directory Directory in which to put the compiled container.
     * @return self
     */
    public function setCacheDirectory(string $directory): self
    {
        $this->sCompilationCacheDirectory = trim($directory);
        return $this;
    }

    /**
     * Defines the directory in which to put the compiled container.
     *
     * @param string $directory Directory where to write the proxies.
     * @return self
     */
    public function setProxyDirectory(string $directory): self
    {
        $this->sProxyDirectory = trim($directory);
        return $this;
    }

    /**
     * Disables the proxy generation.
     * @return self
     */
    public function disableProxy(): self
    {
        $this->bProxyEnabled = false;
        return $this;
    }

    /**
     * Creates and configures a PHP-DI container.
     *
     * @throws \RuntimeException If a directory does not exist or is not writable.
     * @throws \InvalidArgumentException when the proxy directory is null.
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface
    {

        /** @var \DI\ContainerBuilder $pBuilder Helper to create and configure a Container. */
        $pBuilder = new ContainerBuilder();

        // Compile the container for optimum performances.
        if ($this->bCompilationEnabled) {
            if (!\is_writable($this->sCompilationCacheDirectory)) {
                throw new \RuntimeException(
                    \sprintf(
                        "the directory %s does not exist or is not writable.",
                        $this->sCompilationCacheDirectory
                    )
                );
            }
            $pBuilder->enableCompilation($this->sCompilationCacheDirectory);
        }

        // Configure the proxy generation.
        if ($this->bProxyEnabled) {
            if (!\is_writable($this->sProxyDirectory)) {
                throw new \RuntimeException(
                    \sprintf(
                        "the directory %s does not exist or is not writable.",
                        $this->sProxyDirectory
                    )
                );
            }
            $pBuilder->writeProxiesToFile(true, $this->sProxyDirectory);
        }

        // Add definitions.
        foreach ($this->aDefinitions as $aDefinitions) {
            $pBuilder->addDefinitions($aDefinitions['definition']);
        }

        /**
         * Creates the container and loads all the needed services.
         * In order to use the dependency injection pattern.
         *
         * @var \Psr\Container\ContainerInterface $pContainer
         */
        $pContainer = $pBuilder->build();

        return $pContainer;
    }
}

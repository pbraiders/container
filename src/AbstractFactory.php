<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Container
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container;

use Pbraiders\Container\Exception\DefinitionIdNotUniqueException;
use Pbraiders\Container\Exception\InvalidDefinitionIdException;

/**
 * Abstract container factory class.
 * Implements the definitions registering.
 */
abstract class AbstractFactory implements FactoryInterface
{
    /**
     * List of definitions. Is a key value paired like:
     * [
     *  'settings' => [
     *      'shared' => bool,
     *      'service_provider' => bool,
     *      'definition' => [...],
     *      ]
     * ]
     *
     * @var array
     */
    protected $aDefinitions = [];

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
     * @throws InvalidDefinitionIdException if $id is not valid
     * @throws DefinitionIdNotUniqueException if $id is already set
     * @return void
     */
    public function registerDefinition(string $id, array $definitions, bool $shared = false, bool $serviceprovider = false): void
    {
        // Init
        $sId = trim($id);

        // Arguments must be valid
        if (strlen($sId) == 0) {
            throw new InvalidDefinitionIdException('The definition ID is not valid.');
        }

        // Id must be unique
        if (array_key_exists($sId, $this->aDefinitions)) {
            throw new DefinitionIdNotUniqueException(\sprintf('The definition with id: %s is already set.', $sId));
        }

        $this->aDefinitions[$sId] = ['shared' => $shared, 'service_provider' => $serviceprovider, 'definition' => $definitions];
    }
}

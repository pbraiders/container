<?php

/**
 * @package Pbraiders\Container\Exception
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container\Exception;

/**
 * Exception thrown if an argument does not match with the expected value.
 * This represents error in the program logic and should be detected at compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class DefinitionIdNotUniqueException extends \InvalidArgumentException implements ExceptionInterface
{
}

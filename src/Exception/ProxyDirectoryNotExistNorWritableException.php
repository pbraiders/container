<?php

/**
 * @package Pbraiders\Container\Exception
 * @link    https://github.com/pbraiders/container for the canonical source repository
 * @license https://github.com/pbraiders/container/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Container\Exception;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 */
class ProxyDirectoryNotExistNorWritableException extends \RuntimeException implements ExceptionInterface
{
}

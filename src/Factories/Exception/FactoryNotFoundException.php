<?php
declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage\Factories\Exception;

use Phauthentic\Infrastructure\Storage\Exception\StorageException;

/**
 * FactoryNotFoundException
 */
class FactoryNotFoundException extends StorageException
{
    public static function withName(string $name)
    {
        return new static(sprintf(
            'No factory found for %s',
            $name
        ));
    }
}

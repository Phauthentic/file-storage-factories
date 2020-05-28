<?php

namespace Phauthentic\Infrastructure\Storage\Exception;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
class PackageRequiredException extends StorageException
{
    public static function fromAdapterAndPackageNames(string $adapter, string $package)
    {
        return new self(sprintf(
            'Adapter %s requires package %s',
            $adapter,
            $package
        ));
    }
}

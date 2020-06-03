<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;
use Phauthentic\Infrastructure\Storage\Exception\AdapterNotSupportedException;
use Phauthentic\Infrastructure\Storage\Exception\StorageException;
use RuntimeException;
use InvalidArgumentException;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
class StorageAdapterFactory implements StorageAdapterFactoryInterface
{
    /**
     * Instantiates Flystem adapters.
     *
     * @param array $adapter
     * @return \League\Flysystem\AdapterInterface
     */
    public function buildStorageAdapter(
        string $adapterClass,
        array $options
    ): AdapterInterface {
        if (!class_exists($adapterClass)) {
            $adapterClass = '\Phauthentic\Infrastructure\Storage\Factories\\' . $adapterClass . 'Factory';
        }

        if (!class_exists($adapterClass)) {
            throw AdapterNotSupportedException::fromName($adapterClass);
        }

        return (new $adapterClass())->build($options);
    }
}

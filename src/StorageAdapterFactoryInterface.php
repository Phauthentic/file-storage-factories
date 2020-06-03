<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
interface StorageAdapterFactoryInterface
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
    ): AdapterInterface;
}

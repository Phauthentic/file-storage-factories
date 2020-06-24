<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;
use Phauthentic\Infrastructure\Storage\Factories\Exception\FactoryNotFoundException;
use Phauthentic\Infrastructure\Storage\Factories\LocalFactory;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
interface StorageServiceInterface
{
    /**
     * Adapter Factory
     *
     * @return \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface
     */
    public function adapterFactory(): StorageAdapterFactoryInterface;

    /**
     * @return \Phauthentic\Infrastructure\Storage\AdapterCollection
     */
    public function adapters(): AdapterCollection;

    /**
     * Gets an adapter instance, lazy loads it as needed.
     *
     * @param string $name
     * @return \League\Flysystem\AdapterInterface
     */
    public function adapter(string $name): AdapterInterface;

    /**
     * @param string $name
     * @param string $class
     * @param array $options
     */
    public function addAdapterConfig(string $name, string $class, array $options);

    /**
     * Loads adapter configuration to lazy load them later
     *
     * @param array
     * @return void
     */
    public function loadAdapterConfigFromArray(array $config): void;

    /**
     * @param string $adapter Adapter
     * @param string $path Path
     * @param resource $resource
     * @param \League\Flysystem\Config $config
     * @return bool
     */
    public function storeResource(string $adapter, string $path, $resource, ?Config $config);


    /**
     *
     */
    public function storeFile(string $adapter, string $path, string $file, ?Config $config);

    /**
     * @param string $adapter Adapter
     * @param string $path Path
     * @return bool
     */
    public function fileExists(string $adapter, string $path): bool;

    /**
     * @param string $adapter Name
     * @param string $path File to delete
     * @return bool
     */
    public function removeFile(string $adapter, string $path): bool;
}

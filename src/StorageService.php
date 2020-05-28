<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
class StorageService implements StorageServiceInterface
{
    /**
     * @var \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface
     */
    protected $adapterFactory;

    /**
     * Constructor
     *
     * @param \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface $adapterFactory Adapter Factory
     */
    public function __construct(
        StorageAdapterFactoryInterface $adapterFactory
    ) {
        $this->adapterFactory = $adapterFactory;
    }

    protected $adapters = [];

    /**
     * Adapter Factory
     *
     * @return \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface
     */
    public function adapterFactory(): StorageAdapterFactoryInterface
    {
        return $this->adapterFactory;
    }

    /**
     *
     */
    public function adapter($name): AdapterInterface
    {
        if (!isset($this->adapters[$name])) {

        }

        return $this->adapters[$name];
    }

    /**
     *
     */
    public function loadAdapter(string $name, array $options): AdapterInterface
    {
        $this->adapters[$name] = $this->adapterFactory->fromArray($options);

        return $this->adapters[$name];
    }

    /**
     * Loads adapters
     *
     * @param array
     * @return void
     */
    public function loadAdaptersFromArray(array $config): void
    {
        foreach ($config as $name => $options) {
            $this->loadAdapter($name, $options);
        }
    }

    /**
     *
     */
    public function storeResource(string $adapter, string $path, $resource, $config)
    {
        $this->adapter($adapter)->writeStream($path, $resource, $config);
    }

    /**
     *
     */
    public function storeFile(string $adapter, string $path, string $file, Config $config)
    {
        $this->adapter($adapter)->write($path, file_get_contents($file), $config);
    }

    /**
     *
     */
    public function removeFile($adapter, $file)
    {
        return $this->adapter($adapter)->delete($file);
    }
}

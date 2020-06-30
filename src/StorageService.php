<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

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
 * @copyright 2012 - 2020 Florian Krämer
 * @license MIT
 */
class StorageService implements StorageServiceInterface
{
    /**
     * @var array
     */
    protected array $adapterConfig = [
        'local' => [
            'class' => LocalFactory::class,
            'options' => []
        ]
    ];

    /**
     * @var \Phauthentic\Infrastructure\Storage\AdapterCollection
     */
    protected AdapterCollection $adapterCollection;

    /**
     * @var \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface
     */
    protected StorageAdapterFactoryInterface $adapterFactory;

    /**
     * Constructor
     *
     * @param \Phauthentic\Infrastructure\Storage\StorageAdapterFactoryInterface $adapterFactory Adapter Factory
     */
    public function __construct(
        StorageAdapterFactoryInterface $adapterFactory
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->adapterCollection = new AdapterCollection();
    }

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
     * @return \Phauthentic\Infrastructure\Storage\AdapterCollection
     */
    public function adapters(): AdapterCollection
    {
        return $this->adapterCollection;
    }

    /**
     * Gets an adapter instance, lazy loads it as needed.
     *
     * @param string $name
     * @return \League\Flysystem\AdapterInterface
     */
    public function adapter(string $name): AdapterInterface
    {
        if ($this->adapterCollection->has($name)) {
            return $this->adapterCollection->get($name);
        }

        if (!isset($this->adapterConfig[$name])) {
            throw FactoryNotFoundException::withName($name);
        }

        $options = $this->adapterConfig[$name];
        $adapter = $this->loadAdapter($name, $options['class'], $options['options']);
        $this->adapterCollection->add($name, $adapter);

        return $adapter;
    }

    /**
     * Loads an adapter instance using the factory
     *
     * @param string $name Name
     * @param string $adapter Adapter
     * @param array $options
     * @return \League\Flysystem\AdapterInterface
     */
    protected function loadAdapter(string $name, string $adapter, array $options): AdapterInterface
    {
        $this->adapters[$name] = $this->adapterFactory->buildStorageAdapter(
            $adapter,
            $options
        );

        return $this->adapters[$name];
    }

    /**
     * @param string $name
     * @param string $class
     * @param array $options
     */
    public function addAdapterConfig(string $name, string $class, array $options)
    {
        $this->adapterConfig[$name] = [
            'class' => $class,
            'options' => $options
        ];
    }

    /**
     * Loads adapter configuration to lazy load them later
     *
     * @param array
     * @return void
     */
    public function loadAdapterConfigFromArray(array $config): void
    {
        foreach ($config as $name => $options) {
            if (!isset($options['class'])) {
                throw new \RuntimeException('Adapter class or name is missing');
            }

            if (!isset($options['options']) || !is_array($options['options'])) {
                throw new \RuntimeException('Adapter options must be an array');
            }

            $this->adapterConfig[$name] = $options;
        }
    }

    /**
     * @param \League\Flysystem\Config|null $config Config
     * @return \League\Flysystem\Config
     */
    protected function makeConfigIfNeeded(?Config $config)
    {
        if ($config === null) {
            $config = new Config();
        }

        return $config;
    }

    /**
     * @param string $adapter Adapter
     * @param string $path Path
     * @param resource $resource
     * @param \League\Flysystem\Config $config
     * @return bool
     */
    public function storeResource(string $adapter, string $path, $resource, ?Config $config)
    {
        $config = $this->makeConfigIfNeeded($config);

        $this->adapter($adapter)->writeStream($path, $resource, $config);
    }

    /**
     * @param string $adapter Adapter
     * @param string $path Path
     * @param string $file File
     * @param \League\Flysystem\Config|null $config Config
     */
    public function storeFile(string $adapter, string $path, string $file, ?Config $config)
    {
        $config = $this->makeConfigIfNeeded($config);

        $this->adapter($adapter)->write($path, file_get_contents($file), $config);
    }

    /**
     * @param string $adapter Adapter
     * @param string $path Path
     * @return bool
     */
    public function fileExists(string $adapter, string $path): bool
    {
        return $this->adapter($name)->has($path);
    }

    /**
     * @param string $adapter Name
     * @param string $path File to delete
     * @return bool
     */
    public function removeFile(string $adapter, string $path): bool
    {
        return $this->adapter($adapter)->delete($path);
    }
}

<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;
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
     * Adapter configs
     *
     * @var array
     */
    protected $_adapterConfig = [
        'local' => [
            'adapter' => 'local',
            'options' => []
        ]
    ];

    /**
     * Return a singleton instance of the StorageFactory.
     *
     * @return self
     */
    public static function &getInstance(): self
    {
        static $instance = [];
        if (!$instance) {
            $instance[0] = new static();
        }

        return $instance[0];
    }

    /**
     * Gets the configuration array for an adapter.
     *
     * @param string $adapter Configuration name under which the config is stored.
     * @param array $options Adapter configuration.
     * @return mixed
     */
    public static function config($adapter, array $options = [])
    {
        $_this = self::getInstance();

        if (!empty($options)) {
            return $_this->_adapterConfig[$adapter] = $options;
        }

        if (isset($_this->_adapterConfig[$adapter])) {
            return $_this->_adapterConfig[$adapter];
        }

        return false;
    }

    /**
     * Flushes all configured adapters
     *
     * @return void
     */
    public static function flushAll(): void
    {
        $_this = self::getInstance();
        $_this->_adapterConfig = [];
    }

    /**
     * Flush all or a single adapter from the config.
     *
     * @param string $name Config name, if none all adapters are flushed.
     * @return boolean True on success
     * @throws RuntimeException
     */
    public static function flush(string $name): bool
    {
        $_this = self::getInstance();

        if (isset($_this->_adapterConfig[$name])) {
            unset($_this->_adapterConfig[$name]);

            return true;
        }

        return false;
    }

    /**
     * Gets an adapter or it's config from the adapter store.
     *
     * @param string $adapterName Name of the adapter config.
     * @return mixed
     * @throws \RuntimeException If no adapter config was found.
     */
    protected static function _getAdapter($adapterName)
    {
        $_this = self::getInstance();

        if (!empty($_this->_adapterConfig[$adapterName]['object'])) {
            return $_this->_adapterConfig[$adapterName]['object'];
        }

        if (!empty($_this->_adapterConfig[$adapterName])) {
            return $_this->_adapterConfig[$adapterName];
        }

        throw new RuntimeException(sprintf(
            'Invalid Storage Adapter %s!', $adapterName
        ));
    }

    /**
     * Get a storage adapter.
     *
     * If a string is passed it tries to get the instance based on the previous set
     * configuration. The object is stored internally and can be returned at any time
     * again by calling this method with the same adapter name.
     * If an array is passed a new adapter object is instantiated and returned. The
     * created object is NOT stored internally!
     *
     * @param mixed $adapterName string of adapter configuration or array of settings
     * @param boolean $renewObject Creates a new instance of the given adapter in the configuration
     * @return \League\Flysystem\AdapterInterface
     * @throws RuntimeException
     */
    public static function get($adapterName, $renewObject = false): AdapterInterface
    {
        if (is_string($adapterName)) {
            $adapter = self::_getAdapter($adapterName);
            if (is_object($adapter) && $renewObject === false) {
                return $adapter;
            }
        }

        $fromConfigStore = true;
        if (is_array($adapterName)) {
            $adapter = $adapterName;
            $fromConfigStore = false;
            if (empty($adapter['adapterClass'])) {
                throw new StorageException('No adapter class specified!');
            }
        }

        if (isset($adapter['adapterOptions']) && !is_array($adapter['adapterOptions'])) {
            throw new InvalidArgumentException(sprintf(
                'The adapter options must be an array!'
            ));
        }

        if (!isset($adapter['adapterOptions'])) {
            $adapter['adapterOptions'] = [];
        }

        $object = self::buildAdapter($adapter['adapterClass'], $adapter);

        if (isset($object)) {
            if ($fromConfigStore) {
                $_this = self::getInstance();
                $_this->_adapterConfig[$adapterName]['object'] = &$object;
            }

            return $object;
        }

        throw new StorageException(sprintf(
            'Invalid adapter config %s!',
            $adapterName
        ));
    }

    /**
     * Instantiates Flystem adapters.
     *
     * @param array $adapter
     * @return \League\Flysystem\AdapterInterface
     */
    public static function buildAdapter(
        string $adapterClass,
        array $options
    ): AdapterInterface {
        if (!class_exists($adapterClass)) {
            $alternateClass = '\Phauthentic\Infrastructure\Storage\Factories\\' . $adapterClass . 'Factory';;
            if (!class_exists($alternateClass)) {
                throw new InvalidArgumentException(sprintf(
                    'Unknown adapter %s',
                    $adapterClass
                ));
            }
            $adapterClass = $alternateClass;
        }

        return (new $adapterClass())->build($options);
    }
}

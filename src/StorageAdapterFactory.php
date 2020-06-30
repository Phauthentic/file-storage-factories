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
use Phauthentic\Infrastructure\Storage\Exception\AdapterFactoryNotFoundException;
use Phauthentic\Infrastructure\Storage\Exception\AdapterNotSupportedException;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 */
class StorageAdapterFactory implements StorageAdapterFactoryInterface
{
    /**
     * Instantiates Flystem adapters.
     *
     * @param string $adapterClass Adapter alias or classname
     * @param array $options Options
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
            throw AdapterFactoryNotFoundException::fromName($adapterClass);
        }

        return (new $adapterClass())->build($options);
    }
}

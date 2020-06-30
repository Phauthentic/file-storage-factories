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
use ArrayIterator;
use IteratorAggregate;
use RuntimeException;

/**
 * Adapter Collection
 */
class AdapterCollection implements IteratorAggregate
{
    /**
     * @var array
     */
    protected array $adapters = [];

    /**
     * @param string $name Name
     * @param \League\Flysystem\AdapterInterface $adapter Adapter
     */
    public function add($name, AdapterInterface $adapter)
    {
        if ($this->has($name)) {
            throw new RuntimeException(sprintf(
                'An adapter with the name %s already exists in the collection',
                $name
            ));
        }

        $this->adapters[$name] = $adapter;
    }

    /**
     * @param string $name Name
     * @return void
     */
    public function remove(string $name)
    {
        unset($this->adapters[$name]);
    }

    /**
     * @param string $name Name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->adapters[$name]);
    }

    /**
     * @param string $name
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
        }

        return $this->adapters[$name];
    }

    /**
     * Empties the collection
     *
     * @return void
     */
    public function empty(): void
    {
        unset($this->adapters);
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->adapters);
    }
}

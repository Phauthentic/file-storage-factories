<?php
declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;

use ArrayIterator;
use IteratorAggregate;

/**
 * Adapter Collection
 */
class AdapterCollection implements IteratorAggregate
{
    /**
     * @var array
     */
    protected array $adapters;

    /**
     *
     */
    public function add($name, AdapterInterface $adapter)
    {
        if ($this->has($name)) {
            throw new \RuntimeException(
                'An adapter with the name %s already exists in the collection'
            );
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

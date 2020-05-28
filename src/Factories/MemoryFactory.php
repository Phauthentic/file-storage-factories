<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Memory\MemoryAdapter;

/**
 * Memory
 */
class MemoryFactory extends AbstractFactory
{
    protected $alias = 'memory';
    protected $package = 'league/flysystem-memory';
    protected $className = Memo::class;

    public function build(array $config): AdapterInterface
    {
        return new MemoryAdapter();
    }
}

<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;

/**
 * LocalFactory
 */
class LocalFactory extends AbstractFactory
{
    protected $alias = 'local';
    protected $package = 'league/flysystem';
    protected $className = Local::class;

    public function build(array $config): AdapterInterface
    {
        $this->availabilityCheck();

        $config = array_merge(['root' => '/'], $config);

        return new Local($config['root']);
    }
}

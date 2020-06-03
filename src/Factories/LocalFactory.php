<?php

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;

/**
 * LocalFactory
 */
class LocalFactory extends AbstractFactory
{
    protected string $alias = 'local';
    protected ?string $package = 'league/flysystem';
    protected string $className = Local::class;

    public function build(array $config): AdapterInterface
    {
        $this->availabilityCheck();

        $config = array_merge(['root' => '/'], $config);

        return new Local($config['root']);
    }
}

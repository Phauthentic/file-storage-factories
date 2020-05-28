<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;
use Phauthentic\Infrastructure\Storage\Exception\PackageRequiredException;
use Phauthentic\Infrastructure\Storage\InstantiateTrait;

/**
 * AbstractFactory
 */
abstract class AbstractFactory implements FactoryInterface
{
    use InstantiateTrait;

    protected $alias = 'local';
    protected $package = 'league/flysystem';
    protected $className = Local::class;

    public function className(): string
    {
        return $this->className;
    }

    public function alias(): string
    {
        return $this->alias;
    }

    public function availabilityCheck(): void
    {
        if (!class_exists($this->className)) {
            throw PackageRequiredException::fromAdapterAndPackageNames(
                $this->alias,
                $this->package
            );
        }
    }

    abstract public function build(array $config): AdapterInterface;
}

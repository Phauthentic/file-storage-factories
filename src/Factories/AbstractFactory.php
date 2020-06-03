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
    /**
     * @var string
     */
    protected string $alias = 'local';

    /**
     * @var string|null
     */
    protected ?string $package = 'league/flysystem';

    /**
     * @var string
     */
    protected string $className = Local::class;

    /**
     * @return string
     */
    public function className(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function alias(): string
    {
        return $this->alias;
    }

    /**
     * @return void
     */
    public function availabilityCheck(): void
    {
        if (!class_exists($this->className)) {
            throw PackageRequiredException::fromAdapterAndPackageNames(
                $this->alias,
                $this->package
            );
        }
    }

    /**
     * @inheritDoc
     */
    abstract public function build(array $config): AdapterInterface;
}

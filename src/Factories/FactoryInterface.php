<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;

interface FactoryInterface
{
    public function className(): string;
    public function alias(): string;
    public function build(array $config): AdapterInterface;
    public function availabilityCheck(): void;
}

<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use Aws\S3\S3Client;
use League\Flysystem\Adapter\NullAdapter;
use League\Flysystem\AdapterInterface;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

/**
 * NullFactory
 */
class NullFactory extends AbstractFactory
{
    protected $alias = 'null';
    protected $package = 'league/flysystem';
    protected $className = AwsS3Adapter::class;

    public function build(array $config): AdapterInterface
    {
        return new NullAdapter();
    }
}

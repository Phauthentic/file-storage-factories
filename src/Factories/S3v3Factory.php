<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use Aws\S3\S3Client;
use League\Flysystem\AdapterInterface;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

/**
 * S3Factory
 */
class S3v3Factory extends AbstractFactory
{
    protected $alias = 's3';
    protected $package = 'league/flysystem-aws-s3-v3';
    protected $className = AwsS3Adapter::class;
    protected $defaults = [
        'bucket' => null,
        'prefix' => ''
    ];

    public function build(array $config): AdapterInterface
    {
        $this->availabilityCheck();
        $config = array_merge($this->defaults, $config);

        return new AwsS3Adapter(
            S3Client::factory($config),
            $config['bucket'],
            $config['prefix'],
            $config
        );
    }
}

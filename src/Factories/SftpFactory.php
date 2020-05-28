<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Sftp\SftpAdapter;

/**
 * SftpFactory
 */
class SftpFactory extends AbstractFactory
{
    protected $alias = 'sftp';
    protected $package = 'league/flysystem-sftp';
    protected $className = AwsS3Adapter::class;

    public function build(array $config): AdapterInterface
    {
        return new SftpAdapter($config);
    }
}

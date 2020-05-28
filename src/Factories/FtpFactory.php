<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Adapter\Ftp;

/**
 * SftpFactory
 */
class FtpFactory extends AbstractFactory
{
    protected $alias = 'sftp';
    protected $package = 'league/flysystem-sftp';
    protected $className = AwsS3Adapter::class;

    public function build(array $config): AdapterInterface
    {
        return new Ftp($config);
    }
}

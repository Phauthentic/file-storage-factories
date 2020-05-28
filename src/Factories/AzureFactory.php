<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;

/**
 * S3Factory
 */
class S3Factory extends AbstractFactory
{
    protected $alias = 'azure';
    protected $package = 'league/flysystem-azure-blob-storage';
    protected $className = AzureBlobStorageAdapter::class;

    public function build($config): AdapterInterface
    {
        $this->availabilityCheck();

        $endpoint = sprintf(
            'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s',
            $config['account-name'] ?? '',
            $config['api-key'] ?? ''
        );

        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($endpoint);

        return new AzureBlobStorageAdapter($blobRestProxy, 'my-container');
    }
}

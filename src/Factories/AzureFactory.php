<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Common\ServicesBuilder;

/**
 * AzureFactory
 */
class AzureFactory extends AbstractFactory
{
    protected string $alias = 'azure';
    protected ?string $package = 'league/flysystem-azure-blob-storage';
    protected string $className = AzureBlobStorageAdapter::class;

    protected $endpoint = 'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s';

    /**
     * @inheritDoc
     */
    public function build($config): AdapterInterface
    {
        $this->availabilityCheck();

        $endpoint = sprintf(
            $this->endpoint,
            base64_encode($config['accountName'] ?? ''),
            base64_encode($config['apiKey'] ?? '')
        );


        return new AzureBlobStorageAdapter(
            ServicesBuilder::getInstance()->createBlobService($endpoint),
            $config['container']
        );
    }
}

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
use League\Flysystem\Rackspace\RackspaceAdapter;
use OpenCloud\Rackspace;

/**
 * RackspaceFactory
 */
class RackspaceFactory extends AbstractFactory
{
    protected string $alias = 'rackspace';
    protected ?string $package = 'league/flysystem-rackspace';
    protected string $className = RackspaceAdapter::class;
    protected array $defaults = [
        'identityEndpoint' => '',
        'username' => '',
        'apiKey' => '',
        'serviceName' => '',
        'serviceRegion' => '',
    ];

    /**
     * @inheritDoc
     */
    public function build(array $config): AdapterInterface
    {
        $config = array_merge($this->defaults, $config);

        $client = $this->buildClient($config);
        $store = $client->objectStoreService($config['serviceName'], $config['serviceRegion']);

        $container = $store->getContainer('flysystem');

        return new RackspaceAdapter($container);
    }

    protected function buildClient(array $config): Rackspace
    {
        return new Rackspace($config['identityEndpoint'], array(
            'username' => $config['username'],
            'apiKey' => $config['apiKey'],
        ));
    }
}

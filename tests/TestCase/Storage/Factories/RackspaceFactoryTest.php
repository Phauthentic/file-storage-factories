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

namespace Phauthentic\Storage\Test\TestCase\Storage\Factories;

use OpenCloud\Rackspace;
use Phauthentic\Infrastructure\Storage\Factories\RackspaceFactory;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

/**
 * RackspaceFactoryTest
 */
class RackspaceFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactory(): void
    {
        /*
        $factory = $this->getMockBuilder(RackspaceFactory::class)
            ->setMethods([
                'buildClient'
            ])
            ->getMock();

        $client = $this->getMockBuilder(Rackspace::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory->expects($this->any())
            ->method('buildClient')
            ->willReturn($client);

        $adapter = $factory->build([
            'serviceRegion' => 'uk',
            'username' => '',
            'apiKey' => ''
        ]);

        $this->assertInstanceOf(RackspaceAdapter::class, $adapter);
        */
    }
}

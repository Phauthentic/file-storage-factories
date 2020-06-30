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

namespace Phauthentic\Storage\Test\TestCase\Storage;

use League\Flysystem\Adapter\Local;
use Phauthentic\Infrastructure\Storage\StorageAdapterFactory;
use Phauthentic\Infrastructure\Storage\StorageService;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

/**
 * StorageTest
 */
class StorageServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testStorage(): void
    {
        $service = new StorageService(
            new StorageAdapterFactory()
        );

        $this->assertFalse($service->adapters()->has('local'));

        $service->loadAdapterConfigFromArray([
            'local' => [
                'class' => 'Local',
                'options' => [
                    $this->tmp
                ]
            ]
        ]);

        $adapter = $service->adapter('local');
        $this->assertTrue($service->adapters()->has('local'));
        $this->assertInstanceOf(Local::class, $adapter);
    }
}

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

use League\Flysystem\Adapter\NullAdapter;
use League\Flysystem\Replicate\ReplicateAdapter;
use Phauthentic\Infrastructure\Storage\Factories\Exception\FactoryException;
use Phauthentic\Infrastructure\Storage\Factories\ReplicateFactory;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

/**
 * ReplicateFactoryTest
 */
class ReplicateFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactory(): void
    {
        $factory = new ReplicateFactory();
        $adapter = $factory->build([
            'source' => new NullAdapter(),
            'target' => new NullAdapter(),
        ]);
        $this->assertInstanceOf(ReplicateAdapter::class, $adapter);
    }

    /**
     * @return void
     */
    public function testMissingConfig(): void
    {
        $factory = new ReplicateFactory();

        $this->expectException(FactoryException::class);
        $factory->build([
            'target' => new NullAdapter(),
        ]);
    }

    /**
     * @return void
     */
    public function testMissingConfig2(): void
    {
        $factory = new ReplicateFactory();

        $this->expectException(FactoryException::class);
        $factory->build([
            'target' => new NullAdapter(),
        ]);
    }
}

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

use League\Flysystem\AdapterInterface;
use Phauthentic\Infrastructure\Storage\Exception\PackageRequiredException;
use Phauthentic\Infrastructure\Storage\Factories\AbstractFactory;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

class TestFactory extends AbstractFactory
{
    protected string $className = 'DoesNotExist';

    public function build(array $config): AdapterInterface
    {
        $this->availabilityCheck();
    }
}

/**
 * AwsS3FactoryTest
 */
class AbstractFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactory(): void
    {
        $factory = new TestFactory();
        $this->assertEquals('local', $factory->alias());
        $this->assertEquals('DoesNotExist', $factory->className());

        $this->expectException(PackageRequiredException::class);
        $factory->build([]);
    }
}

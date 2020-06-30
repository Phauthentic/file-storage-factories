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

use Phauthentic\Infrastructure\Storage\Exception\PackageRequiredException;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

/**
 * PackageRequiredExceptionTest
 */
class PackageRequiredExceptionTest extends TestCase
{
    /**
     * @return void
     */
    public function testException(): void
    {
        $exception = PackageRequiredException::fromAdapterAndPackageNames('Foo', 'FooPackage');

        $this->assertEquals('Adapter `Foo` requires package `FooPackage`', $exception->getMessage());
    }
}

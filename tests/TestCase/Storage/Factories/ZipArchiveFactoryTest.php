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

use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Phauthentic\Infrastructure\Storage\Factories\ZipArchiveFactory;
use Phauthentic\Storage\Test\TestCase\StorageTestCase as TestCase;

/**
 * ZipArchiveFactoryTest
 */
class ZipArchiveFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactory(): void
    {
        $file = $this->tmp . DIRECTORY_SEPARATOR . 'archive.test';
        touch($this->tmp . DIRECTORY_SEPARATOR . 'archive.test');

        $factory = new ZipArchiveFactory();
        $adapter = $factory->build([
            'location' => $file
        ]);
        $this->assertInstanceOf(ZipArchiveAdapter::class, $adapter);
    }
}

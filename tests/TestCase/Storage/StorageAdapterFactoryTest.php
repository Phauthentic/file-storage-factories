<?php

/**
 * StorageFactoryTest
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */

namespace Phauthentic\Storage\Test\TestCase\Storage;

use Phauthentic\Storage\Test\TestCase\StorageTestCase;
use Phauthentic\Infrastructure\Storage\StorageAdapterFactory;

/**
 * StorageAdapterFactoryTest
 */
class StorageAdapterFactoryTest extends StorageTestCase
{
    /**
     * testAdapter
     *
     * @return void
     */
    public function testAdapter()
    {
        $result = StorageAdapterFactory::get('Local');
        $this->assertEquals(get_class($result), 'League\Flysystem\Adapter\Local');

        try {
            StorageAdapterFactory::get('Does Not Exist');
            $this->fail('Exception not thrown!');
        } catch (\RuntimeException $e) {
        }
    }

    /**
     * testConfig
     *
     * @return void
     */
    public function testConfig()
    {
        $result = StorageAdapterFactory::config('Local', [
            'adapterOptions' => [$this->testPath],
            'adapterClass' => 'Local',
        ]);

        $expected = [
            'adapterOptions' => [$this->testPath],
            'adapterClass' => 'Local',
        ];

        $this->assertEquals($result, $expected);
        $this->assertFalse(StorageAdapterFactory::config('Does not exist'));
    }

    /**
     * testFlush
     *
     * @return void
     */
    public function testFlush()
    {
        $config = StorageAdapterFactory::config('Local');
        $result = StorageAdapterFactory::flush('Local');
        $this->assertTrue($result);
        $result = StorageAdapterFactory::flush('Does not exist');
        $this->assertFalse($result);
        StorageAdapterFactory::config('Local', $config);
    }
}

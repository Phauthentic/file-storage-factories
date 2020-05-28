<?php

namespace Phauthentic\Storage\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Phauthentic\Infrastructure\Storage\StorageAdapterFactory;

/**
 * StorageTestCase
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
class StorageTestCase extends TestCase
{

    /**
     * Setup test folders and files
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->testPath = TMP;

        StorageAdapterFactory::config('Local', [
            'adapterOptions' => [$this->testPath],
            'adapterClass' => 'Local',
        ]);

        StorageAdapterFactory::config('Local2', [
            'adapterOptions' => [$this->testPath],
            'adapterClass' => 'Local',
        ]);
    }
}

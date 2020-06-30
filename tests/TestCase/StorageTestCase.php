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

namespace Phauthentic\Storage\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Phauthentic\Infrastructure\Storage\StorageAdapterFactory;

/**
 * StorageTestCase
 */
class StorageTestCase extends TestCase
{
    /**
     * @var string
     */
    protected string $tmp;

    /**
     * Setup test folders and files
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->testPath = TMP;
        $this->tmp = TMP;
    }
}

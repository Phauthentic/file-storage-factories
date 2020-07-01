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
     * @var string
     */
    protected string $storageRoot = '';

    /**
     * @var string
     */
    protected string $fixtureRoot = '';

    /**
     * Setup test folders and files
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $ds = DIRECTORY_SEPARATOR;
        $this->storageRoot = __DIR__ . $ds . '..' . $ds . '..' . $ds . 'tmp' . $ds;
        $this->fixtureRoot = __DIR__ . $ds . '..' . $ds . 'Fixtures' . $ds;

        $this->testPath = TMP;
        $this->tmp = TMP;
    }

    /**
     * @param string $path Path
     * @return string
     */
    public function getFixtureFile($path): string
    {
        $ds = DIRECTORY_SEPARATOR;

        return __DIR__ . $ds . '..' . $ds . 'Fixtures' . $ds . $path;
    }
}

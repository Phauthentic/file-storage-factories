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

namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Adapter\Ftp;

/**
 * FtpFactory
 */
class FtpFactory extends AbstractFactory
{
    protected string $alias = 'sftp';
    protected ?string $package = 'league/flysystem';
    protected string $className = Ftp::class;

    /**
     * @inheritDoc
     */
    public function build(array $config): AdapterInterface
    {
        if (!defined('FTP_BINARY')) {
            define('FTP_BINARY', 'ftp.exe');
        }

        return new Ftp($config);
    }
}

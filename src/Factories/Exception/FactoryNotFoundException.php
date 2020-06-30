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

namespace Phauthentic\Infrastructure\Storage\Factories\Exception;

use Phauthentic\Infrastructure\Storage\Exception\StorageException;

/**
 * FactoryNotFoundException
 */
class FactoryNotFoundException extends StorageException
{
    public static function withName(string $name)
    {
        return new static(sprintf(
            'No factory found for %s',
            $name
        ));
    }
}

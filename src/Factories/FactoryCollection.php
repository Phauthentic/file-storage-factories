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

use Phauthentic\Infrastructure\Storage\Factories\Exception\FactoryNotFoundException;
use ArrayIterator;

/**
 * FactoryCollection
 */
class FactoryCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    protected $factories = [];

    /**
     * @param \Phauthentic\Infrastructure\Storage\Factories\FactoryInterface $factory Factory
     * @return void
     */
    public function add(FactoryInterface $factory): void
    {
        $this->factories[] = $factory;
    }

    /**
     * @param string $name Name
     * @return \Phauthentic\Infrastructure\Storage\Factories\FactoryInterface
     */
    public function get(string $name): FactoryInterface
    {
        /**
         * @var $factory \Phauthentic\Infrastructure\Storage\Factories\FactoryInterface
         */
        foreach ($this->factories as $factory) {
            if ($factory->alias() === $name || $factory->className() === $name) {
                return $factory;
            }
        }

        throw FactoryNotFoundException::withName($name);
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->factories);
    }
}

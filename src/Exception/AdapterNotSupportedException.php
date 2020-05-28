<?php

namespace Phauthentic\Infrastructure\Storage\Exception;

/**
 * StorageFactory - Manages and instantiates storage engine adapters.
 *
 * @author Florian Krämer
 * @copyright 2012 - 2015 Florian Krämer
 * @license MIT
 */
class AdapterNotSupportedException extends StorageException
{
    /**
     * @param string $name Name
     */
    public static function fromName(string $name)
    {
        return new static(sprintf(
            'Adapter %s is not supported',
            $name
        ));
    }
}

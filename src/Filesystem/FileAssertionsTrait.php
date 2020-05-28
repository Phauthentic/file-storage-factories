<?php
namespace Phauthentic\Infrastructure\Filesystem;

trait FileAssertionsTrait
{
    /**
     * @param string $file File
     * @return void
     */
    protected static function assertReadableFile(string $file): void
    {
        if (self::isReadable($file)) {
            throw new RuntimeException(sprintf(
                '%s is not readable',
                $file
            ));
        }
    }

    /**
     * @param string $file File
     * @return void
     */
    protected static function assertFileExists(string $file): void
    {
        if (!file_exists($file)) {
            throw new RuntimeException(sprintf(
                '%s does not exist',
                $file
            ));
        }
    }

    /**
     * @param string $file File
     * @return void
     */
    protected static function assertWriteableFile(string $file): void
    {
        if (!is_writable($file)) {
            throw new RuntimeException(sprintf(
                '%s is not writeable',
                $file
            ));
        }
    }

    /**
     * @param string $file File
     * @return void
     */
    protected static function assertExecutableFile(string $file): void
    {
        if (!is_writable($file)) {
            throw new RuntimeException(sprintf(
                '%s is not executable',
                $file
            ));
        }
    }
}

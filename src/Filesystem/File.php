<?php
namespace Phauthentic\Infrastructure\Filesystem;

use JsonSerializable;
use RuntimeException;

/**
 * File Object
 */
class File implements JsonSerializable
{
    use FileAssertionsTrait;

    protected $file;
    protected $size;
    protected $mimeTypes = [];
    protected $hash = [];
    protected $name = '';
    protected $resource;
    protected $path;

    public function copyTo(string $target)
    {
        copy($this->file, $target);

        return new static($target);
    }

    /**
     * @link https://www.php.net/manual/en/function.rename.php#97347
     */
    public function rename(string $newFileName)
    {
        $target = $this->path . $newFileName;

        rename($this->file, $target);

        $this->file = $target;
    }

    public function moveTo($target)
    {
        rename($this->file, $target);

        $this->file = $target;
    }

    public function delete(): bool
    {
        return unlink($this->file);
    }

    public function size(): int
    {
        if ($this->size) {
            return $this->size;
        }

        $this->size = filesize($this->file);

        return $this->size;
    }

    public function mimeType(): string
    {
        if (!extension_loaded('fileinfo')) {
            throw new \RuntimeException('You are missing the fileinfo extension');
        }

        return mime_content_type($this->file);
    }

    public function sha1Hash(): string
    {
        return $this->hash('sha1');
    }

    public function md5Hash(): string
    {
        return $this->hash('md5');
    }

    public function hash(string $type = 'sha1'): string
    {
        if (!empty($this->hash[$type])) {
            return $this->hash[$type];
        }

        switch ($type) {
            case 'sha1':
                $this->hash[$type] = sha1_file($this->file);

                return $this->hash[$type];
            case 'md5':
                $this->hash[$type] = md5_file($this->file);

                return $this->hash[$type];
        }

        throw new \RuntimeException(sprint(
            '%s is an unsupported hash type',
            $type
        ));
    }

    public function path(): string
    {
        return $this->path;
    }

    public function name(): string
    {
        return $this->filename;
    }

    public function resource($filename, $mode, $useIncludePath = null)
    {
        if ($this->resource) {
            return $this->resource;
        }

        $this->resource = fopen($filename, $mode, $useIncludePath);

        return $this->resource;
    }

    public function chmod(int $permissions): bool
    {
        return chmod($this->file, $permissions);
    }

    public function permissions(): int
    {
        return fileperms($this->file);
    }

    /**
     * @param string $file File
     * @return bool
     */
    public static function isReadable(string $file): bool
    {
        return is_readable($file);
    }

    /**
     * @param string $file File
     * @return bool
     */
    public static function isWriteable(string $file): bool
    {
        return is_writable($file);
    }

    /**
     * @param string $file File
     * @return bool
     */
    public static function isExecutable(string $file): bool
    {
        return is_executable($file);
    }

    public static function open(string $file)
    {
        static::assertFileExists($file);
        static::assertReadableFile($file);

        $instance = new static();
        $instance->file = $file;

        return $instance;
    }

    public static function fromUploadedFile(UploadedFileInterface $uploadedFile)
    {

    }

    public static function createTmpFile()
    {

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'filename' => $this->name(),
            'filesize' => $this->size(),
            'mimeType' => $this->mimeType(),
            'path' => $this->path()
        ];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\WebDAV\WebDAVAdapter;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;

/**
 * ZipArchiveFactory
 */
class ZipArchiveFactory extends AbstractFactory
{
    protected $alias = 'zip';
    protected $package = 'league/flysystem-ziparchive';
    protected $className = WebDAVAdapter::class;

    public function build(array $config): AdapterInterface
    {
        $defaults = [
            'location' => null,
            'archive' => null,
            'prefix' => null,
        ];

        $config = array_merge($defaults, $config);

        return new ZipArchiveAdapter(
            $config['location'],
            $config['archive'],
            $config['prefix']
        );
    }
}

<?php
namespace Phauthentic\Infrastructure\Storage\Factories;

use League\Flysystem\AdapterInterface;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client;

/**
 * WebdavFactory
 */
class WebDAVFactory extends AbstractFactory
{
    protected $alias = 'webdav';
    protected $package = 'league/flysystem-webdav';
    protected $className = WebDAVAdapter::class;

    public function build(array $config): AdapterInterface
    {
        return new WebDAVAdapter(new Client($config));
    }
}

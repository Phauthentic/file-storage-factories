# Storage Factories for Flysystem

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.txt)
[![Build Status](https://img.shields.io/travis/burzum/storage-factory/3.0.svg?style=flat-square)](https://travis-ci.org/burzum/storage-factory)
[![Coverage Status](https://img.shields.io/coveralls/burzum/storage-factory/3.0.svg?style=flat-square)](https://coveralls.io/r/burzum/storage-factory)

## How to use it

Configure the adapter instances:

```php
$basePath = '/your/base/path';
StorageFactory::config('LocalFlysystem', array(
	'adapterOptions' => [$basePath],
	'engine' => StorageFactory::FLYSYSTEM_ENGINE,
	'adapterClass' => 'Local',
));
```

And get instances of the adapters as you need them.

```php
$gaufretteLocalFSAdapter = StorageFactory::get('LocalFlysystem');
```

Flush or renews adapter objects:

```php
// Flushes a specific adapter based on the config name
StorageFactory::flush('LocalGaufrette');
// Flushes ALL adapters
StorageFactory::flush();

// Renews an adapter, set second arg to true
StorageFactory::get('LocalGaufrette', true);
```

## Support

For bugs and feature requests, please use the [issues](https://github.com/phauthentic/storage/issues) section of this repository.

## License

Copyright 2020, Florian Krämer

Licensed under The MIT License
Redistributions of files must retain the above copyright notice.

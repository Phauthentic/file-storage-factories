# Factories

## Introduction

In the underlying Flysystem implementation some adapters are more or less complex to build. Sometimes you have to compose multiple objects and feed them to an adapter. The factories take this burden away from you and provide you the same interface for all adapters. Just their config array options differ.

The factories will always return new instances. Use the `StorageService`, the `AdapterCollection` or your own way of keeping a list of instances.

For now the underlying Flysystem implementation is set to ^1.0 because it simply provides more adapters for now. This might change in a future major release of this library.

## Factories

If there are problems with the factories please create an issue ticket on Github and check the documentation of the adapter you're trying to use.

We are simply not able due to limited resources to monitor *all* the adapters and the libs they use for changes. So please report issues and create pull requests. :)

### Amazon AWS S3 v3

https://github.com/thephpleague/flysystem-aws-s3-v3

**Options**
 * **bucket**: Name of the bucket
 * **prefix**: Prefix
 * **client**
   * **region**: Region
   * **version**: Version

### Azure

https://github.com/thephpleague/flysystem-azure

**Options**
 * **accountName**: Name of the account
 * **apiKey**: Your API key

### Dropbox

https://github.com/spatie/flysystem-dropbox

**Options**
 * **authToken**: Auth Token

### FtpFactory

**Options**
 * **host**: Host, required
 * **username**: Username, required
 * **password**: Password, required
 * **port**: Port, default 21
 * **root**: Root folder
 * **passive**: Boolean, default true
 * **ssl**: Boolean, default true
 * **timeout**: Timeout in seconds, default 30
 * **ignorePassiveAddress**: Boolean, default false

### Local

**Options**
 * **root**: The root folder where the files are stored

### Memory

https://github.com/thephpleague/flysystem-memory

No options

### Null

https://flysystem.thephpleague.com/v1/docs/adapter/null-test/

No options

### Rackspace

https://github.com/thephpleague/flysystem-rackspace

**Options**
 * **username**: Required
 * **apiKey**: Required
 * **identityEndpoint**: Default Rackspace::UK_IDENTITY_ENDPOINT
 * **objectStoreService**: Default 'cloudFiles'
 * **serviceRegion**: Default 'LON'
 * **container**: Default 'flysystem'

### Replica

https://github.com/thephpleague/flysystem-replicate-adapter

**Options**:
 * **source** A source adapter instance
 * **target** The adapter to replicate to

### SFTP

https://github.com/thephpleague/flysystem-sftp

**Options**:
 * **host**: Required
 * **port**: Default, 22
 * **username**: Required
 * **password**: Required
 * **privateKey**: Required
 * **passphrase**: Required
 * **root**: Default '/'
 * **timeout**: => Dfault 10
 * **directoryPerm**: => Default 0755

### WebDAV

 * https://github.com/thephpleague/flysystem-webdav
 * https://sabre.io/dav/davclient/

**Options**:
 * **baseUri**: Required
 * **userName**: Required
 * **password**: Required
 * **proxy**: Required

### Zip Archive

https://flysystem.thephpleague.com/v1/docs/adapter/zip-archive/

No options

## Implementing your own Factory

Just implement [the FactoryInterface](../src/Factories/FactoryInterface.php).

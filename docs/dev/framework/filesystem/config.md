---
title: "Filesystem Config"
description: Mount adapters, set up DBAFS services and create virtual filesystem.
aliases:
  - /framework/filesystem/config/
---

{{< version "4.13" >}}

{{% notice warning %}}
The new filesystem capabilities are currently considered *experimental* and therefore not covered by Contao's BC
promise. Classes marked with `@experimental` should be considered internal for now. Although not likely, there could
also be some behavioral changes, so be prepared.
{{% /notice %}}


## Convenience configuration
The filesystem consist of many components:

* several storage adapters (`League\Flysystem\FilesystemAdapter`),
* a `Contao\CoreBundle\Filesystem\MountManager`, where adapters are *mounted*,
* one or more DBAFS services (`Contao\CoreBundle\Filesystem\Dbafs\DbafsInterface`),
* a `Contao\CoreBundle\Filesystem\Dbafs\DbafsManager`, where DBAFS services are registered,
* and finally some virtual filesystems (`Contao\CoreBundle\Filesystem\VirtualFilesystemInterface`) as consumer endpoints.

In case of our DBAFS implementation (`Contao\CoreBundle\Filesystem\Dbafs\Dbafs`), each instance also needs an individual
hash generator (`Contao\CoreBundle\Filesystem\Dbafs\Hashing\HashGeneratorInterface`).

We need this level of detail to support all use cases, but wanted to offer a convenient way to add and adjust the setup
in your extensions and applications. That's why we added a `FilesystemConfiguration` class, that gets constructed with a
`ContainerBuilder` instance and provides convenience methods that orchestrate everything you need in the background.

### In a Bundle
To use the `FilesystemConfiguration` in your bundle, implement the `ConfigureFilesystemInterface` in your extension
class:

```php
// src/DependencyInjection/MyFooBundleExtension.php
namespace My\FooBundle\DependencyInjection;

use Contao\CoreBundle\DependencyInjection\Filesystem\ConfigureFilesystemInterface;
use Contao\CoreBundle\DependencyInjection\Filesystem\FilesystemConfiguration;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MyFooBundleExtension extends Extension implements ConfigureFilesystemInterface 
{
    public function configureFilesystem(FilesystemConfiguration $config): void
    {
        // Configure the filesystem here
    }
    
    // …
}
```

### In your Application
In your application in the Contao Managed Edition, you'll need to adjust the global manager plugin instead by
implementing the `ConfigPluginInterface` and creating the `FilesystemConfiguration` yourself:
```php
// src/ContaoManager/Plugin.php
namespace App\ContaoManager;

use Contao\CoreBundle\DependencyInjection\Filesystem\FilesystemConfiguration;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Plugin implements ConfigPluginInterface
{
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig)
    {
        $loader->load(static function (ContainerBuilder $container) {
            $config = new FilesystemConfiguration($container);
            
            // Configure the filesystem here
        });
    }
}
```

## Reference
|  |  |
|-|-|
| `addVirtualFilesystem` | Add a new virtual filesystem. Setting the `$name` to 'foo' will create a `contao.filesystem.virtual.foo` service and additionally enable constructor injection with an argument `VirtualFilesystemInterface $fooStorage` if autowiring is available. The `$prefix` defines the directory the instance should be scoped to. Optionally setting `$readonly` to true, will prevent mutations being made to resources and metadata. |
| `mountAdapter` | Creates a new adapter and mounts it under the given `$mountPath` in the `MountManager`. The `$adapter` and `$options` can be set analogous to the configuration of the [Flysystem Symfony bundle][FlysystemBundle]. Alternatively you can pass in an id of an already existing filesystem adapter service. If you do not set a `$name`, the id/alias for the adapter service will be derived from the mount path. |
| `mountLocalAdapter` | Use this shortcut method if you want to create a local adapter. Internally this is using `mountAdapter` but already resolves project root relative paths and parameter placeholders for you. |
| `registerDbafs` | Registers a custom `$dbafs` service definition in the `DbafsManager` under a given `$pathPrefix`. |
| `addDefaultDbafs` | Creates a default DBAFS implementation as a service and internally calls `registerDbafs` on it. We recommend to use this method if the default implementation fits your needs. Set the `$tableName` and `$hashFunction` to be used and optionally disable tracking last modified states by setting `$useLastModified` to false. |

When using `addVirtualFilesystem` and `addDefaultDbafs()`, the preconfigured `Definition` is returned. If you want to
tweak it (e.g. if you want to adjust the DBAFS defaults), just add methods calls yourself:

```php
// Manually adjust a configuration, if needed
$config
  ->addDefaultDbafs(…)
  ->registerMethodCall('setMaxFileSize', [1048576])
;

```

### Example
Here is how you could make your automatic database backups be stored on a remote server via SFTP:
```php
// Mount an SFTP adapter to `/backups`.
$config->mountAdapter(
    'sftp',         
    ['host' => 'example.com', 'port' => 22, 'username' => 'foobar', 'password' => 's3cr3t'],
    'backups'
);
```

{{% notice note %}}
Currently there are a lot of filesystem operations in Contao that do not use the new filesystem abstraction, yet. So you
should not expect file operations to be routed to your adapter when remounting `/files` for instance. The backups from
the above example are an exception to this as they are already refactored.    
{{% /notice %}}


[FlysystemBundle]: https://github.com/thephpleague/flysystem-bundle

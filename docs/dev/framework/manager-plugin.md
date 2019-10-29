---
title: Manager Plugin
description: "A class that gives third party bundles the opportunity to configure a Contao Managed Edition."
aliases:
    - /framework/manager-plugin/
    - /framework/managed-edition/manager-plugin/
    - /getting-started/initial-setup/managed-edition/manager-plugin/
---


The `Manager Plugin` is one single PHP class that gives third party bundles the opportunity to 
configure a `Managed Edition`.
Every time a user of the `Managed Edition` runs a `composer update` or a `composer install`
the `Manager Plugin` instances of all packages are called and the application is then configured
accordingly.


## The package-specific Manager Plugin

The whole ecosystem of Contao is built in a way that any bundle should be installable and configurable
for any regular Symfony application.
So writing any extension to Contao basically also means you are writing an extension to a Symfony application.

The `Manager Plugin` adds logic on top of it which is completely optional. If you implement it, you provide support for
the `Contao Managed Edition` thus giving the users of it the opportunity to install it. That being said, if you do not
integrate the `Manager Plugin` in your Composer package, the `Contao Manager` won't be able to install it.

Because of that, we cannot `require` the `contao/manager-plugin` dependency in our `composer.json` as that would mean
in a regular Symfony application without Contao, nobody would use your bundle as it brings nonsense requirements with it.

Thus, what you do in your `composer.json` is this:

```json
{
    "conflict": {
        "contao/manager-plugin": "<2.0 || >=3.0"
    },
    "require-dev": {
        "contao/manager-plugin": "^2.0"
    }
}
```

This will make sure you get the right version in production while at the same time making it a completely optional
dependency.

Every Composer package can provide a `Manager Plugin`. Exposing it to the `Managed Edition` is as simple as 
providing the FQCN in the `extra` section of your `composer.json` like so:

```json
{
    "name": "your-vendor/your-package-name",
    "autoload": {
        "psr-4": {
            "YourVendor\\YourPackageName\\": "src"
        }
    },
    "conflict": {
        "contao/manager-plugin": "<2.0 || >=3.0"
    },
    "require-dev": {
        "contao/manager-plugin": "^2.0"
    },
    "extra": {
        "contao-manager-plugin": "YourVendor\\YourPackageName\\ContaoManager\\Plugin"
    }
}
```


{{% notice note %}}
If your Composer package is a monorepository, similar to `contao/contao`, it is also possible to register
multiple `Manager Plugins` for each subsequent package. You must not create multiple plugins for one package/bundle though!

```json
{
    "extra": {
        "contao-manager-plugin": {
            "your-vendor/feature1-bundle": "YourVendor\\Feature1Bundle\\ContaoManager\\Plugin",
            "your-vendor/feature2-bundle": "YourVendor\\Feature2Bundle\\ContaoManager\\Plugin"
        }
    }
}
```

{{% /notice %}}


As you can see, there is no technical requirement for you to call it `ManagerPlugin` or
`Plugin` and it does not have to reside within `ContaoManager`. All you have to do is make sure
the `autoload` section is correct so Composer can find the file and then provide the FQCN to the
plugin. However, it's best practice to name the class `Plugin` and place it in the `ContaoManager`
namespace of your package.


## The application-specific Manager Plugin

Even if you use the `Managed Edition` you might want to e.g. load additional bundles or adjust the config of your
application so you need a way to specify your app-specific `Manager Plugin`.
Here, you don't need to specify any `extra` key in your `composer.json` because that would be a bit too much for your
local app. After all, there can only be one anyway as you don't need multiple ones.
The `Manager Plugin` automatically loads the following classes.

* `\App\ContaoManager\Plugin` (recommended)
* `\ContaoManagerPlugin` (discouraged)


## The features

Currently, you can do the following with your `Manager Plugin`:

* Via the `Contao\ManagerPlugin\Bundle\BundlePluginInterface` you can register bundles to the application kernel.
  Usually this will be your own one but you can write a Composer package that provides multiple bundles.
* Via the `Contao\ManagerPlugin\Config\ConfigPluginInterface` you can load configuration for your own or
  other third party bundles to the kernel.
* Via the `Contao\ManagerPlugin\Config\ExtensionPluginInterface` you can modify configuration of other bundles.
* Via the `Contao\ManagerPlugin\Dependency\DependentPluginInterface` you can make sure other plugins (plugins, not bundles!) 
  are loaded before.
* Via the `Contao\ManagerPlugin\Routing\RoutingPluginInterface` you can add routes to the application.
  so you have the ability to override certain settings.


## The `BundlePluginInterface`

Because `Managed Edition` does not know what bundles exist and in what order they must be loaded,
the Manager Plugin needs to tell that to the application.

```php
namespace Vendor\SomeBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Knp\Bundle\MenuBundle\KnpMenuBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(KnpMenuBundle::class),
        ];
    }
}
```

If you want to make sure you're loaded after another bundle, it's as simple as specifing `setLoadAfter()`.
This is a very common case for Contao bundles because you usually want to be loaded after the Contao Core Bundle to 
extend its functionality:

```php
namespace Vendor\SomeBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Knp\Bundle\MenuBundle\KnpMenuBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(KnpMenuBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
```


## The `ConfigPluginInterface`

The `ConfigPluginInterface` allows you to configure your own or other bundles. E.g. you could write a Contao specific
bundle that integrates a third party Symfony bundle and depending on external configuration it could set the other
bundles configuration. 

{{% notice info %}}
Currently, the second argument `$config` is always an empty array. In a future version of the `Contao Manager` would like
to introduce configuration via the GUI. The day this is implemented, bundles will be able to provide information on
what's configurable and how (ideally it will be based on the existing Symfony bundle configuration so you don't have to
repeat yourself too much if you want to provide integration with the `Contao Manager`). The configuration array will then
be passed here so you can e.g. adjust services according to what the user configured in the GUI.
{{% /notice %}}

```php
namespace Vendor\SomeBundle\ContaoManager;

use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Symfony\Component\Config\Loader\LoaderInterface;

class Plugin implements ConfigPluginInterface
{
    public function registerContainerConfiguration(LoaderInterface $loader, array $config)
    {
        $loader->load('@VendorSomeBundle/Resources/config/config.yml');
    }
}
```


## The `ExtensionPluginInterface`

The easiest way to define bundle configuration is by using the
`ConfigPluginInterface`. It allows to register any bundle configuration, for the current bundle or any third party one.

This works in _most_ of the cases. The Symfony ContainerBuilder performs
a recursive array merge operation of all configurations. The result is:

1. Plugin configuration is loaded before the global config
   (`config/config.yml`), therefore the global config can override bundles.

2. Plugin configuration is loaded (and overridden) in order of the plugins.
   One plugin can override the bundle configuration set by another plugin by setting the same keys. The order of
   plugins can be adjusted using the `DependendPluginInterface`.

3. When merging configurations with multiple nodes (like `doctrine.dbal.connections`,
   `framework.cache.pools`), the nodes are merged. This is usually not a problem,
   because database connections etc. are named, so the order in the tree does not matter.

4. If the order of configuration matters (e.g. `security.firewalls`,
   `monolog.handlers`), it can be hard to get right. Also, some nodes prohibit merging
   (using [`disallowNewKeysInSubsequentConfigs()`][1]) which results in an exception if two plugins try to set
   the same configuration.


The `ExtensionPluginInterface` is **only** meant and necessary to work around
the issues mentioned in point 4.


### Examples


#### Adding a custom Symfony Firewall

A typical example for overriding previous bundle configuration would be the `security.firewalls` configuration. 
You might want to configure another firewall than the one Contao ships by default. As you know, the order matters
because the first firewall that matches a specific pattern or request is the one that Symfony is going to use.
That's why you cannot have a `config.yml` with your own `security.firewalls` configuration – the Symfony Config
component will tell you:

> You are not allowed to define new elements for path "security.firewalls".

Symfony makes sure that `security.firewalls` is specified only once. This is the only way it can ensure the order of
firewalls is correct.

Thanks to the `ExtensionPluginInterface` you can, however, modify the all extension configurations of all the other bundles
**before** that check is executed.

Here's an example of how you could add your own firewall in front of the Contao `frontend` firewall:

```php
namespace Vendor\MyBundle\ContaoManager;

use Contao\ManagerPlugin\Config\ContainerBuilder;
use Contao\ManagerPlugin\Config\ExtensionPluginInterface;

class Plugin implements ExtensionPluginInterface
{
    /**
     * Allows a plugin to override extension configuration.
     *
     * @param string           $extensionName
     * @param array            $extensionConfigs
     * @param ContainerBuilder $container
     *
     * @return array
     */
    public function getExtensionConfig($extensionName, array $extensionConfigs, ContainerBuilder $container)
    {
        if ('security' !== $extensionName) {
            return $extensionConfigs;
        }

        foreach ($extensionConfigs as &$extensionConfig) {
            if (isset($extensionConfig['firewalls'])) {
                
                // Add e.g. your own security authentication provider
                $extensionConfig['providers']['app.api_user_provider'] = [
                    'id' => 'app.security.api_user_provider'
                ];
                
                // Add your own firewall before the "frontend" firewall of Contao
                // Int-Cast position so "false" (not found) results in position 0.
                $offset = (int) array_search('frontend', array_keys($extensionConfig['firewalls']));
                
                $extensionConfig['firewalls'] = array_merge(
                    array_slice($extensionConfig['firewalls'], 0, $offset, true),
                    [
                        'api' => [
                            'pattern' => '/api/*',
                            'anonymous' => true,
                            'guard' => [
                                'authenticators' => [
                                    'app.security.api_guard_authenticator'
                                ],
                            ],
                        ],
                    ],
                    array_slice($extensionConfig['firewalls'], $offset+1, null, true)
                );
                
                break;
            }
        }

        return $extensionConfigs;
    }
}
```

{{% notice info %}}
Note that you receive an array of `$extensionConfigs` and you may have to apply your changes multiple times. This is
because of the way the Symfony Dependency Injection Container works. E.g. you have a configuration from `config.yml` one
from "Bundle X" and another one from "Bundle Y". The container then merges all these configurations into one
(which is exactly where that firewall error message comes from). Unfortunately, there is no way you can determine where
a certain configuration is coming from.
{{% /notice %}}


#### Allow a clickjacking path for NelmioSecurityBundle

Another example where order matters might be the `nelmio_security.clickjacking.paths` configuration. The reason there
is the same: the rules of the first path that matches are going to be applied. So to make sure that `/external` is
allowed, your plugin could look like this:

```php
namespace Vendor\MyModule\ContaoManager;

use Contao\ManagerPlugin\Config\ContainerBuilder;
use Contao\ManagerPlugin\Config\ExtensionPluginInterface;

class Plugin implements ExtensionPluginInterface
{

    /**
     * Allows a plugin to override extension configuration.
     *
     * @param string           $extensionName
     * @param array            $extensionConfigs
     * @param ContainerBuilder $container
     *
     * @return array
     */
    public function getExtensionConfig($extensionName, array $extensionConfigs, ContainerBuilder $container)
    {
        if ('nelmio_security' !== $extensionName) {
            return $extensionConfigs;
        }

        $customCors = [
            '^/external.*' => 'ALLOW'
        ];

        foreach ($extensionConfigs as &$extensionConfig) {

            if (isset($extensionConfig['clickjacking'])
                && is_array($extensionConfig['clickjacking']['paths'])
            ) {
                $extensionConfig['clickjacking']['paths'] = $customCors + $extensionConfig['clickjacking']['paths'];
            }
        }

        return $extensionConfigs;
    }
}
```


## The `DependentPluginInterface`

If your Composer package depends on one or more other Composer packages to be loaded first, so it can
override certain parts of them, you can ensure that the `Manager Plugin`s of these packages are loaded first by
implementing the `DependentPluginInterface`:

```php
namespace Vendor\SomeBundle\ContaoManager;

use Contao\ManagerPlugin\Dependency\DependentPluginInterface;

class Plugin implements DependentPluginInterface
{
    public function getPackageDependencies()
    {
        return ['contao/news-bundle'];
    }
}
```


## The `RoutingPluginInterface`

If your bundle adds custom routes to the Symfony router, you can implement the `RoutingPluginInterface`:

```php
namespace Vendor\SomeBundle\ContaoManager;

use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements RoutingPluginInterface
{
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        $file = '@VendorSomeBundle/Resources/config/routing.yml';

        return $resolver->resolve($file)->load($file);
    }
}
```


[1]: http://api.symfony.com/master/Symfony/Component/Config/Definition/Builder/ArrayNodeDefinition.html#method_disallowNewKeysInSubsequentConfigs

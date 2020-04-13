---
title: "Creating an Extension"
description: "How to create a re-usable extension for Contao."
weight: 900
aliases:
    - /getting-started/extension/
---


Like many other CMS, Contao's functionality can easily be extended by installing
extensions from third parties. This article will explain the basics on how to create
an extension of your own - for others to use or just yourself.

As Contao itself is just a Symfony bundle that's loaded to your Symfony application 
or Contao Managed Edition, writing your own bundle is very similar to writing a 
regular Symfony bundle. To learn more about bundles in general, you can read the 
[respective Symfony documentation][1] first.

{{% notice note %}}
Within this documentation, the terms _package_, _bundle_ and _extension_ are often
used interchangably. For Composer, everything is a _package_, while a `symfony-bundle`
or a `contao-bundle` is a specific type of package. _Contao bundles_ are referred 
to as _extensions_ within the Contao universe.
{{% /notice %}}


## Objectives

When creating an extension, the following objectives are relevant:

* The code of your extension will be managed via Git
* The extension will be installed via `composer.json`
* Development of the extension can be done within `vendor/`


## Initial Setup

The first thing you do is usually to decide on a _name_ for the extension and its 
package. For the package name, the usual convention is to use the vendor name identical 
to your or your organiztation's Git account name, plus the name of the extension 
in kebab case, prefixed with `contao-`, e.g.: `somevendor/contao-example-bundle`.

When starting an extension from scratch (i.e. you do not even have a remote Git
repository set up yet for your extension), you first create a folder for the source
of your extension. This can be anywhere in your file system, as it will be later 
on installed via Composer.


### Composer Setup

Within the previously created folder, you initialize a new `composer.json`, which 
you can do with the `composer init` command. During generation, set the package 
type to `contao-bundle`, as mentioned in the [Your First Extension][2] guide. Also 
choose the right [SPDX][3] for your license. During the interactive generation you 
can also already define your  dependencies. At the very least, you should require 
the Contao version, i.e. the version of the `contao/core-bundle` for which you are 
developing.

```bash
$ composer init


  Welcome to the Composer config generator



This command will guide you through creating your composer.json config.

Package name (<vendor>/<name>) [user/contao-example-bundle]: somevendor/contao-example-bundle
Description []: Lorem ipsum dolor sit amet.
Author [user <user@example.org>, n to skip]: n
Minimum Stability []:
Package Type (e.g. library, project, metapackage, composer-plugin) []: contao-bundle
License []: LGPL-3.0-or-later

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? yes
Search for a package: contao/core-bundle
Enter the version constraint to require (or leave blank to use the latest version): ^4.4
Search for a package:
Would you like to define your dev dependencies (require-dev) interactively [yes]? no

{
    "name": "somevendor/contao-example-bundle",
    "description": "Lorem ipsum dolor sit amet.",
    "type": "contao-bundle",
    "license": "LGPL-3.0-or-later",
    "require": {
        "contao/core-bundle": "^4.4"
    }
}

Do you confirm generation [yes]? yes
Would you like to install dependencies now [yes]? no
```


### Development Structure

Now it is time to set up your actual development structure. Typically, you will have
a `src/` folder containing all the sources of your extension, and a `test/` folder
for tests (if any). This is a common setup, though you are free to choose a different
one (e.g. no `src/` and `test/` subfolder, starting with the namespace folders directly).

Next you will choose a top-level namespace and extension related subnamespace for
your extension, e.g. `SomeVendor\ContaoExampleBundle`. Using the [PSR-4 Autoloading Standard][4]
the `src/` folder will be mapped as the namespace base folder for that namespace
in the autoloading part of your extension's `composer.json`:

```json
{
    "name": "somevendor/contao-example-bundle",
    "description": "Lorem ipsum dolor sit amet.",
    "type": "contao-bundle",
    "license": "LGPL-3.0-or-later",
    "require": {
        "contao/core-bundle": "^4.4"
    },
    "autoload": {
        "psr-4": {
            "SomeVendor\\ContaoExampleBundle\\": "src/"
        }
    }
}
```


### Installation

Now we can include the (still empty) extension into a Contao 4 installation. Since
this is still just a local directory (and not publicly available via a Git repository),
we will have to define this "repository" manually in the root `composer.json` of
the Contao 4 installation:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "/path/to/your/extension/directory"
        }
    ]
}
```

In the `require` part we can then request the installation of our extension, using
the defined package name and `dev-master` as the version.

```json
{
    "require": {
        "somevendor/contao-example-bundle": "dev-master"
    }
}
```

When running a `composer update`, Composer will now symlink the given path into the
vendor directory of the Contao 4 installation and everything is ready to go. You
can now continue developing within `vendor/somevendor/contao-example-bundle`.


## Creating the Bundle

Now it is time to do some ground work for the extension:

1. Create a bundle class.
2. Create a Contao Manager Plugin to load the bundle within a Contao Managed Edition.
3. Configure the `composer.json` for the Contao Manager Plugin.

Creating the bundle class is simple enough. The name of the bundle class can be freely
choosen - typically it will have the same name as your top-level subnamespace, or
even a combination of your complete top-level namespace. For example:

```php
// src/ContaoExampleBundle.php
namespace SomeVendor\ContaoExampleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoExampleBundle extends Bundle
{
}
```

The bundle class can be empty, but could contain additional bundle configurations
(see [Symfony's documentation][1] on how to create bundles).

Next up we create a [Manager Plugin][4], so that our bundle can be automatically
loaded within a Contao 4 Managed Edition. The following plugin will load our bundle
after the Contao Core Bundle (since the order of execution matters for certain things
like DCA or translation adjustments).

```php
// src/ContaoManager/Plugin.php
namespace SomeVendor\ContaoExampleBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use SomeVendor\ContaoExampleBundle\ContaoExampleBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoExampleBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
```

In order to expose the plugin to the Managed Edition, we need to reference it in
the extension's `composer.json`:

```json
{
    "extra": {
         "contao-manager-plugin": "SomeVendor\\ContaoExampleBundle\\ContaoManager\\Plugin"
    }
}
```

After running `composer update`, the Contao Manager Plugin will load this bundle
in the Contao Managed Edition. This will have no real effect yet, since
the extension is still pretty empty.


## Development

Within the extension, development is largely the same as [developing for the application][5].
There are some differences though. The Contao specific resources, which usually reside
in `contao/` for the application, will instead have to be in `src/Resources/contao/`.


### Service Configuration

Loading a service configuration will also be different. While the Contao Managed 
Edition (and also Symfony Skeleton Applications) will load certain YAML files automatically
for your application, an extension or bundle will have to load the service
configuration itself. The details are described in the [Symfony documentation][6].
However, the basic steps are:

1. Create a `services.yml` within `src/Resources/config/`.
2. [Create an extension class][7] in the `DependencyInjection` namespace.

The class name of the dependency injection extension needs to be the same as the 
bundle name, with `Bundle` replaced by `Extension`.

```php
// src/DependencyInjection/ContaoExampleExtension.php
namespace SomeVendor\ContaoExampleBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoExampleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
```

Now, services can be registered as usual in your `src/Resources/config/services.yml`.

{{% notice tip %}}
In order to take advantage of service annotations, enable [auto-configuration](https://symfony.com/doc/current/service_container.html#the-autoconfigure-option)
for your services. See also the README of the [Service Annotation Bundle](https://github.com/terminal42/service-annotation-bundle).
```yml
services:
    _defaults:
        autoconfigure: true
```
{{% /notice %}}


### Routing Configuration

In order to define routes within this extension for a Contao Managed Edition, the
Manager Plugin of the extension needs to provide the routing configuration. This
is done by implementing the `RoutingPluginInterface` in the Manager Plugin, as described
[in the documentation][8].

```php
// src/ContaoManager/Plugin.php
namespace SomeVendor\ContaoExampleBundle\ContaoManager;

use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements RoutingPluginInterface
{
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        $file = __DIR__.'/../Resources/config/routing.yml';
        return $resolver->resolve($file)->load($file);
    }
}
```

This will load the routing configuration located under `src/Resources/config/routing.yml`
of this extension.


## Versioning & Publishing

When ready, create a remote repository, e.g. on GitHub. You can initialize Git in 
your extension directly in vendor and push the code to that repository.

```bash
user@somemachine ~/www/contao4/vendor/somevendor/contao-example-bundle
$ git init
$ git add --all
$ git commit -m "initial commit"
$ git remote add origin git@github.com:somevendor/contao-example-bundle.git
$ git push origin master
```

Then the package can be published on the public Packagist by submitting the URL
to the repository at [packagist.org/packages/submit](https://packagist.org/packages/submit),
assuming you already [created an account](https://packagist.org/register/). In order
for Packagist to automatically update the information about your package, you need
to implement any of the solutions offered [here](https://packagist.org/about#how-to-update-packages).
For more information about publishing extensions within the Contao ecosystem, have
a look at the [dedicated article][9].

Once the package has been published to the public Packagist, the extension's repository
can actually be removed from the root `composer.json` of the Contao installation.
When requiring `dev-master` (or any `dev-` branch) of the extension, composer will
actually check out the code from the Git repository instead. This enables you to
push any changes you make back to the origin branch using your SSH key.


[1]: https://symfony.com/doc/current/bundles.html
[2]: /guides/first-bundle/
[3]: https://spdx.org/licenses/
[4]: /framework/manager-plugin/
[5]: /getting-started/starting-development/
[6]: https://symfony.com/doc/current/bundles/extension.html
[7]: https://symfony.com/doc/current/bundles/extension.html#creating-an-extension-class
[8]: /framework/manager-plugin/#the-routingplugininterface
[9]: /guides/publishing-bundles/

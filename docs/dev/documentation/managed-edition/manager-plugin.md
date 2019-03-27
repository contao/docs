---
title: The ManagerPlugin
---

The `ManagerPlugin` is one single PHP class that gives third party bundles the opportunity to 
configure a `Managed Edition`.
Simply put, every time a user of the `Managed Edition` runs a `composer update` or a `composer install`
the `ManagerPlugin` instances of all the bundles are called and the application is then configured
accordingly.

Every bundle can provide one or multiple `ManagerPlugin`s but we usually recommend to have just
one per Composer package. Exposing it to the `Managed Edition` is as simple as providing the fully
qualified class name in the `extra` section of your `composer.json` like so:

```json
{
    "name": "your-vendor/your-package-name",
    "autoload": {
        "psr-4": {
            "YourVendor\\YourPackageName\\": "src"
        }
    },
    "extra": {
        "contao-manager-plugin": "YourVendor\\YourPackageName\\ContaoManager\\Plugin"
    }
}
```

As you can see, there is no technical requirement for you to call it `ManagerPlugin` or
`Plugin` and it does not have to reside within `ContaoManager`. All you have to do is make sure
the `autoload` section is correct so Composer can find the file and then provide the FQCN to the
plugin. However, it's best practice to name the class `Plugin` and place it in the `ContaoManager`
namespace of your package.

{{% notice warning %}}
This is how you register a plugin in your bundle. To register a plugin for your app, things are a
bit different and need to be documented here.
{{% /notice %}}

Currently, you can do the following with your `ManagerPlugin`:

* Via the `BundlePluginInterface` you can register bundles to the application kernel. Usually this will be your own one
  but you can write a Composer package that provides multiple bundles.
 
{{% notice warning %}}
This list is not complete. There are more interfaces that need to be documented.
{{% /notice %}}


## The `BundlePluginInterface`

{{% notice warning %}}
Every interface should get its own section with examples here.
{{% /notice %}}
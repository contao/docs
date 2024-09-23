---
title: "Starting your Development"
description: "Short introduction on how to start your development within Contao."
weight: 3
aliases:
    - /getting-started/starting-development/
---


There are two main cases when developing within Contao: either you want to customize
your project-specific web application, or you want to create a re-usable extension -
either for your own purposes or for others. In either case, the principles are the
same. However, when creating an extension for Contao, there are some differences
in structure and procedure. This articles covers the former case and also assumes 
the usage of the Contao Managed Edition. [Another article][1] explains how to create 
a reusable extension.

The purpose of this article is to show the directory structure of Contao and explain
what goes where - and what to do initially for certain customization tasks.


## Structure

After a fresh install of Contao, your project will have a certain initial file &
directory structure (which is similar to the structure of a pure Symfony project
using the `symfony/skeleton` for example).

| File/Directory  | Explanation                                                                 |
| --------------- | --------------------------------------------------------------------------- |
| `assets/`       | JavaScript and CSS assets of the Contao framework and third parties.        |
| `config/`       | Application configuration files.                                            |
| `files/`        | Public or protected files manged by Contao's file manager.                  |
| `system/`       | Legacy folder for Contao 3 compatibility.                                   |
| `templates/`    | Customized Contao & Twig templates.                                         |
| `var/`          | Transient files like the application cache and log files.                   |
| `vendor/`       | Composer's vendor folder containing all dependencies (including Contao).    |
| `web/`          | Public entry points; contains symlinks to other public ressources.          |
| `composer.json` | `composer.json` of your project defining your dependencies and autoloading. |

When customizing your web application, the following files and folders will usually
be of interest. Some of those will need to be created manually:

| File/Directory  | Explanation                                                                    |
| --------------- | ------------------------------------------------------------------------------ |
| `config/`       | Application configuration.                                                     |
| `contao/`       | Contao configuration and translations.                                         |
| `src/`          | Your own PHP code: controllers, event listeners for hooks and other services.  |
| `templates/`    | Templates for your own modules and elements, or customized existing templates. |
| `composer.json` | Add dependencies, customize autoloading if required.                           |

{{% notice note %}}
Contao **4.4** still uses the Symfony 3 directory structure. The `config/` folder 
will be in `app/config/` and the `contao/` folder will be in `app/Resources/contao/`
instead.
{{% /notice %}}


### Application Configuration

The [configuration of a Symfony application][11] is done within the `config/` directory
through various YAML files. The Contao Managed Edition automatically loads the following
configurations, if present:

| File                     | Explanation                                                                                   |
| ------------------------ | --------------------------------------------------------------------------------------------- |
| `.env`                   | Defaults for environment variables or environment variables that are agnostic to the environment. This is typically comitted to your project's repository and thus should not contain any sensitive data. |
| `.env.local`             | Loaded if `.env` exists. Defines or overrides environment variables for the current environment (e.g. database and SMTP credentials). This should be added to your `.gitignore` as it typically contains sensitive data. |
| `config/config.yaml`      | Configuration of any bundle/package/extension.                                                |
| `config/config_dev.yaml`  | Configuration for the `dev` environment.                                                      |
| `config/config_prod.yaml` | Configuration for the `prod` environment.                                                     |
| `config/parameters.yaml`  | Parameters like database and SMTP server credentials.<sup>1</sup>                             |
| `config/routes.yaml`     | Definition of application specific routes.<sup>2</sup>                                                    |
| `config/services.yaml`    | {{< version-tag "4.9" >}} Definition of services.<sup>3</sup>                                 |

{{% notice info %}}
Contao versions _prior_ to **4.9** only support the `*.yml` file extension.
{{% /notice %}}

{{% notice note %}}
<sup>1</sup> Contao still supports the legacy way of defining parameters in a Symfony
application through the `parameters.yaml`. However it is best-practice to use the
`.env` files instead. See also [Symfony's documentation](https://symfony.com/doc/4.4/configuration.html#configuring-environment-variables-in-env-files)
for more information about the `.env*` files.
{{% /notice %}}

{{% notice note %}}
<sup>2</sup> Contao versions **4.6**, **4.7** and **4.8** only support the `routing.yml` file. Starting with Contao **4.9** all 4 variants 
(`routes.yaml`, `routing.yaml`, `routes.yml` and `routing.yml`) are supported. Prior to Contao **4.6** you will need to implement an 
[`App\ContaoManager\Plugin`](/framework/manager-plugin/#the-application-specific-manager-plugin) that implements the 
[`RoutingPluginInterface`](/framework/manager-plugin/#the-routingplugininterface).
{{% /notice %}}

{{% notice tip %}}
<sup>3</sup> While Contao versions prior to **4.9** do not load a `config/services.yml` automatically, 
you can still import it in your `config/config.yml` via

```yaml
imports:
    - { resource: services.yml }
```
{{% /notice %}}


### Contao Configuration & Translations

Contao has its own configuration files in the form of PHP arrays, as well as translation
files in the form of either PHP arrays or in an XLIFF format. These files are generally
defined within the `contao/` folder of your project's root directory (or `app/Resources/contao/`
in Contao **4.4**).

| File/Directory             | Explanation                                                       |
| -------------------------- | ----------------------------------------------------------------- |
| `contao/config/config.php` | Registering modules, content elements, models, hooks, crons, etc. |
| `contao/dca/`              | [Data Container Array][2] customizations and definitions.         |
| `contao/languages/`        | Contao translations - contains sub directories for each language. |
| `contao/languages/de/`     | German translations.                                              |
| `contao/languages/en/`     | English translations (also serves as the fallback).               |
| `contao/languages/…/`      | etc.                                                              |

Have a look at the [DCA documentation][2] on how to handle DCA files and the [translation documentation][3]
on how to handle translation files. The content of the `config.php` depends on the
use-case and its documentation is covered in the applicable topics of the [framework documentation][4].


## Autoloading, Services and Controllers

Any custom class that is needed for the web application - like a [Model][5], a [Content Element][6]
or a class for a [Hook][7] for example - needs to be loaded. Typically
the code for customizing the web application for Contao will be put in the `\App`
namespace. The default `composer.json` of the recent Contao Managed Edition versions
already contains the appropriate autoloading directive:

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

{{% notice tip %}}
This is actually not necessary since Contao **4.9** as the Contao Managed Edition automatically adds the  necessary 
autoloading for the `App\` namespace. However you can still add your own autoloading directives of course.
{{% /notice %}}

{{% notice info %}}
During development it is advisable to not optimize the Autoloader by Composer, otherwise
new classes that you created will not be available immediately. If you used the
`-o`/`--optimize-autoloader` option previously, or the Contao Manager (which optimizes
the Autoloader by default), execute `composer install` or `composer dump-autoload`
without the parameter again. Then in the production environment you should use the
parameter again for performance reasons.
{{% /notice %}}

Any of these classes can also be registered as Symfony services, which is necessary
if you want to use dependency injection and service tagging. Registering Contao 
hooks, content elements, front end modules, cron jobs and Data Container callbacks
is done via service tags.

For the application development it is recommended to use [autowiring][8] and [auto-configuration][9], 
which makes it easy to create new services and tag them automatically (through annotations
or class interfaces) - and thus enables quick development of Contao content elements, 
hooks, callbacks etc.

```yaml
# config/services.yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true

    App\:
        resource: ../src
```

If you want to implement regular controllers and define their routes via PHP attributes, you will also need to register
these routes via the automatically loaded `config/routes.yaml`:

```yaml
# config/routes.yaml
app.controller:
    resource: ../src/Controller
    type: attribute
```

Once this is configured, hooks, callbacks, content elements and front end modules
for example can be created without having to configure them in separate files by 
using annotations for service tagging.

All this is not needed, if you only need to change or extend the Data
Container Array definition of a table, or want to change a translation for
example.

{{% notice tip %}}
Starting with Contao **4.9** (Managed Edition), any class within the `App\` namespace 
within `src/` will be automatically registered as a service, with autowiring and
autoconfiguration enabled. Controllers as services will work as well. However, any class extending from a class from the legacy Contao 
framework will not be automatically registered as a service (as well as any class that would cause an error during compilation). You can 
still provide your own `services.yaml` in order to adjust the service registration to your 
needs. Keep in mind that you still need to provide your own `routes.yaml` in order 
to register your routes.
{{% /notice %}}

Next: [create your first DCA adjustment][12].


[1]: /getting-started/extension/
[2]: /framework/dca/
[3]: /framework/translations/
[4]: /framework/
[5]: /framework/models/
[6]: /framework/content-elements/
[7]: /framework/hooks/
[8]: https://symfony.com/doc/current/service_container/autowiring.html
[9]: https://symfony.com/doc/current/service_container.html#the-autoconfigure-option
[10]: /framework/hooks/#using-annotations
[11]: https://symfony.com/doc/current/configuration.html
[12]: ../dca/

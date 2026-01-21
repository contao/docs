---
title: Data Container Array
description: "Configuration of tables and record editing."
aliases:
    - /framework/dca/
---


Data Container Arrays (DCAs) are used to describe a _Data Container_ for holding
any type of record. The metadata in these DCAs is used by the Contao core engine
to determine how to list records, how to render back end forms for these records
and how to edit and save each record.

The actual data container can be anything and is implemented using a data container 
_Driver_. The three drivers available in the Contao core are _Table_ (used for any
database records), _File_ (used for the system configuration for example) and
_Folder_ (used for file listings). Each driver also offers specific configuration 
options, e.g. with the _Table_ driver you are able to define relations to other 
database tables. All examples in the Contao documentation usually refer to the _Table_ 
driver, as this is the most common use-case.

The DCA files of all active modules are loaded one after the other (according to 
the bundle configuration), so that every module can override the existing 
configuration.


## Creating a DCA

To create a DCA you must first decide on a table name. This table name is then used
throughout the configuration as well as within other places of the Contao framework
(e.g. [models][3]).

All table names managed by a DCA always start with the prefix `tl_` (which officially
stands for _tüdelü_). The name of the file containing the DCA configuration needs
to be the same name as the table and must be put in the `contao/dca/` folder (see
[Contao Configuration & Translations][contaoConfig]). 

Within that file you configure your Data Container Array within the `$GLOBALS['TL_DCA']`
array. So if your table name is `tl_example`, then your DCA will be created
like this:

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example'] = [
    'config' => […],
    'list' => […],
    'fields' => […],
    'palettes' => […],
];
```

See the [DCA reference][4] for all available configuration possibilities.


## Registering callbacks

Registering DCA callbacks is similar to [registering to hooks][1]. See the 
[callback reference][2] for all available callbacks in the DCA. Depending on the
callback you are subscribing to, your callback will receive a certain sets of
arguments and is expected to return certain data - or _void_.

There are three different ways of subscribing to a callback. The recommended way is using _PHP attributes_ together with 
[invokable services](#invokable-services). Which one you use depends on your setup. For example, if you still need to support PHP 7 you can
use _annotations_.

{{% notice tip %}}
Using attributes or annotations means it is only necessary to create one file for the respective adaptation when using Contao's default
way of automatically registering services under the `App\` namespace within the `src/` folder.
{{% /notice %}}

For a `list.label.group` callback for example a callback might look like this:

{{< tabs groupid="attribute-annotation-yaml-php" style="code" >}}
{{% tab title="Attribute" %}}
Contao implements [PHP attributes](https://www.php.net/manual/en/language.attributes.overview.php) with which you can tag your service to be registered as a callback.

```php
// src/EventListener/DataContainer/ModuleCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

class ModuleCallbackListener
{
    #[AsCallback(table: 'tl_module', target: 'list.label.group', priority: 100)]
    public function onGroupCallback(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Do something …

        return $group;
    }
}
```
{{% /tab %}}

{{% tab title="Annotation" %}}
Contao also supports its own annotation formats via the [Service Annotation Bundle](https://github.com/terminal42/service-annotation-bundle).

```php
// src/EventListener/DataContainer/ModuleCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;

class ModuleCallbackListener
{
    /**
     * @Callback(table="tl_module", target="list.label.group", priority=100)
     */
    public function onGroupCallback(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Do something …

        return $group;
    }
}
```
{{% /tab %}}

{{% tab title="YAML" %}}
Callbacks can be registered using the `contao.callback` service tag directly:

```yaml
# config/services.yaml
services:
    App\EventListener\DataContainer\ModuleCallbackListener:
        tags:
            - { name: contao.callback, table: tl_module, target: list.label.group, method: onGroupCallback, priority: 100 }
```

The service tag can have the following options:

| Option   | Type      | Description                                                                                                |
| -------- | --------- | ---------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.callback`.                                                                                 |
| table    | `string`  | The name of the data container for which the callback should be registered.                                |
| target   | `string`  | Which type of callback should be registered (see [reference](/reference/dca/callbacks/)).                  |
| method   | `string`  | _Optional:_ the method name in the service - otherwise infered from the target (e.g. `onGroupCallback`).   |
| priority | `integer` | _Optional:_ priority of the callback. By default it will be executed _after_ all legacy callbacks according to the loading order of the bundles, when using a default priority of `0`. |
{{% /tab %}}

{{< /tabs >}}


### Invokable Services

You can also use [invokable classes][invoke] for your services. If a service is
tagged with `contao.callback` and no method name is given, the `__invoke` method will
be called automatically. This also means that you can define the service annotation
on the class, instead of a method:

{{< tabs groupid="attribute-annotation-yaml-php" style="code" >}}
{{% tab title="Attribute" %}}
```php
// src/EventListener/DataContainer/ModuleCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback(table: 'tl_module', target: 'list.label.group', priority: 100)]
class ModuleCallbackListener
{
    public function __invoke(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Do something …

        return $group;
    }
}
```
{{% /tab %}}

{{% tab title="Annotation" %}}
```php
// src/EventListener/DataContainer/ModuleCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;

/**
 * @Callback(table="tl_module", target="list.label.group", priority=100)
 */
class ModuleCallbackListener
{
    public function __invoke(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Do something …

        return $group;
    }
}
```
{{% /tab %}}

{{% tab title="YAML" %}}
```yaml
# config/services.yaml
services:
    App\EventListener\DataContainer\ModuleCallbackListener:
        tags:
            - { name: contao.callback, table: tl_module, target: list.label.group, priority: 100 }
```
```php
// src/EventListener/DataContainer/ModuleCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\DataContainer;

class ModuleCallbackListener
{
    public function __invoke(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Do something …

        return $group;
    }
}
```
{{% /tab %}}

{{< /tabs >}}


## Custom Drivers

It is possible to create custom DCA drivers, which must extend from `\Contao\DataContainer`.

```php
// contao/tl_example.php
use Vendor\Driver\FoobarDriver;

$GLOBALS['TL_DCA']['tl_example'] = [
    'config' => [
        'dataContainer' => FoobarDriver::class,
    ],
];
```

The driver can implement any of the following interfaces:

* `\listable`
* `\editable`

When creating your own driver it is probably best to just have a look at the existing
drivers in order to get an idea on what is possible and how it needs to be done:

* [DC_File](https://github.com/contao/contao/blob/5.x/core-bundle/contao/drivers/DC_File.php)
* [DC_Folder](https://github.com/contao/contao/blob/5.x/core-bundle/contao/drivers/DC_Folder.php)
* [DC_Table](https://github.com/contao/contao/blob/5.x/core-bundle/contao/drivers/DC_Table.php)


[1]: /framework/hooks/
[2]: /reference/dca/callbacks/
[3]: /framework/models/
[4]: /reference/dca/
[invoke]: https://www.php.net/manual/en/language.oop5.magic.php#object.invoke
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations

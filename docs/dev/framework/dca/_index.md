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

As of Contao **4.13**, there are four different ways of subscribing to a hook. The recommended way is using _PHP attributes_ together with 
[invokable services](#invokable-services). Which one you use depends on your setup. For example, if you still need to support PHP 7 you can
use _annotations_. If you still develop callbacks for Contao **4.4** then you still need to use the _PHP array configuration_.

{{% notice tip %}}
Using attributes or annotations means it is only necessary to create one file for the respective adaptation when using Contao's default
way of automatically registering services under the `App\` namespace within the `src/` folder.
{{% /notice %}}

For a `list.label.group` callback for example a callback might look like this:

{{< tabs groupId="attribute-annotation-yaml-php" >}}
{{% tab name="Attribute" %}}
{{< version-tag "4.13" >}} Contao implements [PHP attributes](https://www.php.net/manual/en/language.attributes.overview.php) (available 
since **PHP 8**) with which you can tag your service to be registered as a callback.

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

{{% tab name="Annotation" %}}
{{% version-tag "4.8" %}} Contao also supports its own annotation formats via the [Service Annotation Bundle](https://github.com/terminal42/service-annotation-bundle).

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

{{% tab name="YAML" %}}
{{< version-tag "4.5" >}} Since Contao 4.5 callbacks can be registered using the `contao.callback` service tag.

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
| priority | `integer` | _Optional:_ priority of the callback. By default it will be executed _before_ all legacy callbacks according to the loading order of the bundles. Anything with higher than `0` will be executed before legacy callbacks. Anything with lower than `0` will be executed after legacy callbacks. In Contao **5.0** this has changed though so that these callbacks are executed _after_ all legacy callbacks according to the loading order of the bundles, when using a default priority of `0`. |
{{% /tab %}}

{{% tab name="PHP" %}}
This is the old way of using DCA callbacks prior to Contao **4.7**. The table
`tl_module` and target definition `list.label.group` translates to a PHP
array configuration in the following way for example:

```php
// contao/dca/tl_module.php
use App\EventListener\DataContainer\ModuleCallbackListener;

$GLOBALS['TL_DCA']['tl_module']['list']['label']['group_callback'] = [
    ModuleCallbackListener::class, 'onGroupCallback'
];
```

Note that you have to add the suffix `_callback` to the last key - _except_ for
these callbacks:

* `fields.field.wizard`
* `fields.field.xlabel`
* `list.sorting.panel_callback.subpanel`

Also note that the above example is a _singular_ callback, i.e. it only
supports _one_ subscriber. For callbacks that support multiple callback
subscribers you will have to append the callable:

```php
// contao/dca/tl_content.php
use App\EventListener\DataContainer\ContentCallbackListener;

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = [
    ContentCallbackListener::class, 'onLoadCallback'
];
```

See the [reference](/reference/dca/callbacks/) for which callbacks support multiple subscribers and
which do not.
{{% /tab %}}
{{< /tabs >}}


### Invokable Services

{{< version-tag "4.9" >}} You can also use [invokable classes][invoke] for your services. If a service is
tagged with `contao.callback` and no method name is given, the `__invoke` method will
be called automatically. This also means that you can define the service annotation
on the class, instead of a method:

{{< tabs groupId="attribute-annotation-yaml-php" >}}
{{% tab name="Attribute" %}}
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

{{% tab name="Annotation" %}}
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

{{% tab name="YAML" %}}
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

{{% tab name="PHP" %}}
```php
// contao/dca/tl_module.php
use App\EventListener\DataContainer\ModuleCallbackListener;

$GLOBALS['TL_DCA']['tl_module']['list']['label']['group_callback'] = [
    ModuleCallbackListener::class, '__invoke'
];
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

It is possible to create custom DCA drivers by following these requirements:

* The driver's class must start with `DC_`. <sup>1</sup>
* The driver's class must be available in the global namespace. <sup>1</sup>
* The driver must extend from `\Contao\DataContainer`.

{{% notice "note" %}}
<sup>1</sup> Since Contao **4.9.17** the driver is not required to be in the global namespace and does not need to be
prefixed with `DC_` anymore. Instead you can  reference the FQCN of the driver in your DCA:

```php
// contao/tl_example.php
use Vendor\Driver\FoobarDriver;

$GLOBALS['TL_DCA']['tl_example'] => [
    'config' => [
        'dataContainer' => FoobarDriver::class,
    ],
];
```
{{% /notice %}}

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

---
title: Data Container Array
description: "Configuration of tables and record editing."
---

Data Container Arrays (DCAs) are used to store table meta data. Each DCA
describes a particular table in terms of its configuration, its relations to
other tables and its fields. The Contao core engine determines by this meta data
how to list records, how to render back end forms and how to save data. The DCA
files of all active module are loaded one after the other (according to the
dependencies), so that every module can override the existing configuration.


## Creating a DCA

To create a DCA you must first decide on a table name. This table name is then used
throughout the configuration as well as within other places of the Contao framework
(e.g. [models][3]).

All table names managed by a DCA always start with the prefix `tl_` (which officially
stands for _tüdelü_). The name of the file containing the DCA configuration needs
to be the same name as the table and must be put in the `contao/dca` folder. 

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

For a `list.label.group` callback for example your callback might look like
this:

```php
<?php
// src/EventListener/Dca/ContentListener.php

namespace App\EventListener\Dca;

use Contao\DataContainer;

class ContentListener
{
    public function onGroupCallback(string $group, string $mode, string $field, array $record, DataContainer $dc): string
    {
        // Custom logic

        return $group;
    }
}
```


### Using service tagging

{{< version "4.7" >}}

Since Contao 4.7 DCA callbacks can be registered using the `contao.callback` service tag.
Callback listeners can be added to the service configuration in the following way:

```yml
services:
    App\EventListener\Dca\ContentListener:
        public: true
        tags:
            - { name: 'contao.callback', table: 'tl_content', target: 'config.onload', priority: -1 }
            - { name: 'contao.callback', table: 'tl_content', target: 'fields.module.options' }
```

Each tag can have the following options:

| Option   | Type      | Description                                                                                                           |
| -------- | --------- | --------------------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.callback`.                                                                                            |
| table    | `string`  | The target table of the DCA.                                                                                          |
| target   | `string`  | The target callback within the DCA with the array positions separated by periods. The last element is the callback name - however the `_callback` suffix is optional |
| method   | `string`  | _Optional:_ the method name in the service. Otherwise the method name will be `onCallbacknameCallback` automatically. |
| priority | `integer` | _Optional:_ priority of the callback. By default it will be executed after all other callbacks according to the loading order of the bundles. Anything with lower than `0` will be executed before legacy callbacks. |

The [callback reference][2] already lists the appropriate target names for the callbacks.


### Using the PHP array configuration

This is the old way of using DCA callbacks prior to Contao 4.7. The table
`tl_content` and target definition `fields.module.options` translates to a PHP
array configuration in the following way for example:

```php
<?php

// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['module']['options_callback'] = [
    \App\EventListener\Dca\ContentListener::class, 'onModuleOptionsCallback'
];
```

Note that you have to add the suffix `_callback` to the last key - _except_ for
these callbacks:

* `fields.field.wizard`
* `fields.field.xlabel`
* `list.sorting.panel_callback.subpanel`

Also note that the above example is a _singular_ callback, i.e. it only
supports _one_ subscriber. For callbacks that support multiple callback
subscribers you'll have to append the callable:

```php
<?php

// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = [
    \App\EventListener\Dca\ContentListener::class, 'onLoadCallback'
];
```

See the [reference][2] for which callbacks support multiple subscribers and
which do not.


[1]: ../hooks/
[2]: ../../reference/dca/callbacks/
[3]: ../models/
[4]: ../../reference/dca/

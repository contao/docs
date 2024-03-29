---
title: "CHMOD"
description: Not yet documented
---

This widget renders an interface where you can define access rights for the site structure. It allows you to define
which operations for a particular page are allowed for owners, users in a group and everybody else. As such, in Contao
this is only used in the settings of a page and also in the system settings (for the default access rights).

![The CHMOD widget]({{% asset "images/dev/reference/widgets/chmod.png" %}}?classes=shadow)

## Options

This widget has no options.

## Column Definition

The widget stores the data as a serialized array. As the data is predetermined, having a `VARCHAR(255)` field is enough.

## Example

```php
'myChmod' => [
    'label' => ['My CHMOD', 'My own CHMOD solution.'],
    'inputType' => 'chmod',
    'default' => Contao\Config::get('chmod'),
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];
```

## Usage in Contao

As mentioned in the introduction this widget is only used (and only really built for) the settings of a page (plus the
default access rights in the system settings).

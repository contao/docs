---
title: "Palette Manipulator"
description: The PaletteManipulator allows you to edit DCA palettes in a more convenient way.
---

The [PaletteManipulator](https://github.com/contao/contao/blob/master/core-bundle/src/DataContainer/PaletteManipulator.php) is the way to go if you want to edit the palette of a [DCA](../dca), e.g. add fields to the back end of an existing DCA.

## Introduction
Before we use the `PaletteManipulator`, lets have a look at how palettes are defined.
```php
// tl_user.php

$GLOBALS['TL_DCA']['tl_user'] = [
    ...
    // Palettes
	'palettes' => array
	(
        ...
        'default' => '{name_legend},username,name,email;{backend_legend:hide},language,uploader,showHelp,thumbnails,useRTE,useCE;{theme_legend:hide},backendTheme,fullscreen;{password_legend:hide},pwChange,password;{admin_legend},admin;{groups_legend},groups,inherit;{account_legend},disable,start,stop'
        ...
    ),
    ...
];
```

As you can see, the palette is just a string which means the `PaletteManipulator` is just a class to manipulate the palette string.

## Adding fields

Assuming you have the following DCA configuration:
```php
<?php

...

$GLOBALS['TL_DCA']['tl_user']['fields']['custom_field'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_user']['custom_field'],
    'inputType' => 'text',
    'eval' => [...],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
];
```

At this moment, the field is not visible in the back end. 
The field now has to be added to the palette. This could happen via concatenation or something like `str_replace()`:

```php 
// appending custom_field to the palette
$GLOBALS['TL_DCA']['tl_user']['palettes']['default'] .= ';{custom_legend},custom_field';

// using str_replace() to insert the field after the username
str_replace('username', 'username,custom_field', $GLOBALS['TL_DCA']['tl_user']['palettes']['default']);
```

As you can see, these two methods are a bit complicated and prone to error.

Another method is by using the PaletteManipulator:

```php
<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$paletteManipulator = PaletteManipulator::create();

$paletteManipulator
    // apply the field "custom_field" after the field "username"
    ->addField('custom_field', 'username')

    // now the field is registered in the PaletteManipulator
    // but it still has to be registered in the globals array:
    ->applyToPalette('admin', 'tl_user') 
;
```

Note: each time you call an `applyTo*()` method, the fields you applied for this instance will not be cleared.
If you do not want this behaviour, you can instantiate a new instance.

## Removing fields
{{< version "4.7" >}}

Removing a field is as easy as adding it:

```php
$paletteManipulator
    // remove the field "custom_field" from the "name_legend"
    ->removeField('custom_field', 'name_legend')

    // again, the change is registered in the PaletteManipulator
    // but it still has to be applied to the globals:
    ->applyToPalette('admin', 'tl_user')
;
```

## Working with subpalettes

The same logic can be applied to subpalettes. Let's assume `custom_field` is configured in `tl_content`:

```php
$paletteManipulator
    // adding the field as usual
    ->addField('custom_field', 'singleSRC')

    // applying the new configuration to the "addImage" subpalette
    ->applyToSubpalette('addImage', 'tl_content')
;
```

## Advanced configuration

By default, fields is added **after** the parent. You can alter the behaviour by using one of the predefined constants as third parameter:

| parameter                            | behaviour                                           |
|--------------------------------------|-----------------------------------------------------|
| PaletteManipulator::POSITION_BEFORE  | Adds the new field before the defined parent field  |
| PaletteManipulator::POSITION_AFTER   | Adds the new field after the defined parent field   |
| PaletteManipulator::POSITION_PREPEND | Adds the new field before the defined parent legend |
| PaletteManipulator::POSITION_APPEND  | Adds the new field after the defined parent legend  |


### Example

```php
$paletteManipulator
    ->addField('custom_field', 'username', PaletteManipulator::POSITION_AFTER)
    ->addField('custom_field_2', 'name_legend', PaletteManipulator::POSITION_APPEND)
    ...
;
```
---
title: "Palette Manipulator"
description: The PaletteManipulator allows you to edit DCA palettes in a more convenient way.
---

The [PaletteManipulator](https://github.com/contao/contao/blob/master/core-bundle/src/DataContainer/PaletteManipulator.php) is the way to go if you want to edit the palette of a [DCA](../dca), e.g. add fields to the backend of an existing DCA.

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

At this moment, the field is not visible in the backend. To make it accessible you implement the PaletteManipulator:

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
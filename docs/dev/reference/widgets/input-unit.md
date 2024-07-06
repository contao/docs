---
title: "Input Unit"
description: Text field with a small drop-down menu for the "unit".
---


This allows you to input some text or numbers and also define a "unit" for that input, all within the same widget.

![Input unit widget]({{% asset "images/dev/reference/widgets/input-unit.png" %}}?classes=shadow)

The value will be stored as a serialized associative array containing the keys `value` and `unit`, e.g.

```php
[
    'value' => 'Lorem ipsum', 
    'unit' => 'h2'
]
```


## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a 
[full field reference][FieldsReference].

| Key               | Value                       |
|-------------------|-----------------------------|---
| `inputType`       | `inputUnit` (string)        |
| `options`         | `array`                     | These are the options available in the drop-down. You can also use an [`options_callback`][OptionsCallback].
| `reference`       | `array`                     | Optional translation reference for the drop-down options.


## Usage in Contao

The input unit widget is mainly used for the headline input in content elements and modules. In the past it was also
used in the deprecated style manager and for the deprecated margin options of content elements. In those cases the units
were things like `px`, `em`, `rem`, etc.


[FieldsReference]: /reference/dca/fields
[OptionsCallback]: /reference/dca/callbacks#fields-field-options

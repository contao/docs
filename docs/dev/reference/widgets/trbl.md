---
title: Margins
description: Four text fields with a small unit drop-down menu.
---

{{% notice "note" %}}
This widget has been deprecated in Contao **5.7** in favor of the [_Row Wizard_]({{% relref "row-wizard" %}}) widget.
{{% /notice %}}

This widget renders four text input fields, plus a unit drop-down menu. Its main purpose is to provide the possibility
to enter margin values (top, right, bottom, left - hence the internal name `trbl`).

![Margins]({{% asset "images/dev/reference/widgets/trbl.png" %}}?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a
[full field reference]({{% relref "fields#reference" %}}). All options for the [`text`]({{% relref "text" %}}) widget
are also relevant.

| Key               | Value                       | Description
|-------------------|-----------------------------|-----------
| `inputType`       | `trbl` (string)             |
| `options`         | `array`                     | These are the options available in the unit drop-down. You can also use an [`options_callback`]({{% relref "callbacks#fields-field-options" %}}).
| `reference`       | `array`                     | Optional translation reference for the drop-down options.

## Column Definition

Typically, a `VARCHAR` field of sufficient length is used, with an `ascii_bin` collation, since this field does not need
full Unicode support.

## Example

```php
// …
'myMargins' => [
    'label' => ['Margins', 'The margins for this element.'],
    'inputType' => 'trbl',
    'options' => 'px', '%', 'em', 'rem',
    'sql' => [
        'type' => 'string',
        'length' => 128,
        'default' => '',
        'platformOptions' => [
            'collation' => 'ascii_bin',
        ],
    ],
],
// …
```
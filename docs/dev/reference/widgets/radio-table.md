---
title: Radio Table
description: Radio buttons with images.
---

This widget renders a set of radio buttons horizontally, each with an image label rather than a text label. This is used
for the image alignment settings in various places in Contao for example (left, right, top, bottom).

![Radio Table]({{% asset "images/dev/reference/widgets/radio-table.png" %}}?classes=shadow)

It is however possible to also use custom images and labels.

![Radio Table custom]({{% asset "images/dev/reference/widgets/radio-table-custom.png" %}}?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a
[full field reference]({{% relref "reference/dca/fields" %}}).

| Key   | Value | Description
| ----- | ----- | -----------
| `inputType` | `radioTable` |
| `options` | `array` | An options array. When using your own images, the option values must be a path to the image relative to the `public/` directory and without the `.svg` extension (only SVGs are supported). Otherwise the options are treated as icons from Contao's own icon set. |
| `options_callback` | `function\|callable` | A callback function that returns the options callback or an array  (use in combination with `eval.multiple`). You may define an anonymous function, but you should consider [registering them via service tags]({{% relref "framework/dca#registering-callbacks" %}}). |
| `reference` | `array` | Reference an array that will be used to translate the options. Contao will automatically match the options and reference array by key. |
| `eval.cols` | `integer` | The number of radio buttons to display. |

## Examples

{{< tabs groupid="radio-table-widget-examples" style="code" >}}

{{% tab title="Image alignment" %}}

The standard image alignment use case in Contao.

```php
// …
'floating' => [
    'label' => ['Image alignment', 'Please specify how to align the image.'],
    'inputType' => 'radioTable',
    'options' => ['above', 'left', 'right', 'below'],
    'eval' => ['cols' => 4, 'tl_class' => 'w50'],
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'sql' => [
        'type' => 'string',
        'length' => 8, // Must be large enough to store all possible values
        'default' => 'above',
    ],
],
// …
```

{{% /tab %}}

{{% tab title="Custom icons" %}}

A custom radio table widget with custom icons.

```php
// …
'alignment' => [
    'label' => ['Text alignment', 'Please specify how to align the text.'],
    'inputType' => 'radioTable',
    'options' => [
        'bundles/mybundle/align-left' => 'Left',
        'bundles/mybundle/align-center' => 'Center',
        'bundles/mybundle/align-right' => 'Right',
        'bundles/mybundle/align-justify' => 'Justify',
    ],
    'eval' => ['cols' => 4, 'tl_class' => 'w50'],
    'sql' => [
        'type' => 'string',
        'length' => 64, // Must be large enough to store all possible values
        'default' => 'bundles/mybundle/align-left',
    ],
],
// …
```

{{% /tab %}}

{{< /tabs >}}

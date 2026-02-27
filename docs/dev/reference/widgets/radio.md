---
title: Radio
description: Renders a radio button selection.
---

This widget renders a radio button selection.

![Radio buttons]({{% asset "images/dev/reference/widgets/radio.png" %}}?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a
[full field reference]({{% relref "fields" %}}).

| Key   | Value | Description
| ----- | ----- | --------------- |
| `inputType` | `select` | |
| `options` | `array` | An options array (use in combination with `eval.multiple`) |
| `options_callback` | `function\|callable` | A callback function that returns the options callback or an array  (use in combination with `eval.multiple`). You may define an anonymous function, but you should consider [registering them via service tagging]({{% relref "reference/dca#registering-callbacks" %}}). |
| `reference` | `array` | Reference an array that will be used to translate the options. Contao will automatically match the options and reference array by key. |
| `foreignKey` | `string` | Reference another table to generate options from. |
| `eval.includeBlankOption` | true/false (default) `bool` | Includes a blank option (useful in conjunction with `mandatory` fields) |
| `eval.blankOptionLabel` | `string` (default `-`) | The label of the blank option |
| `eval.disabled` | true/false (default) `bool` | Disables the input field |

## Examples

{{< tabs groupid="radio-widget-examples" style="code" >}}

{{% tab title="Simple radio buttons" %}}

If you simply want to select an option from a fixed set.

```php
// …
'example' => [
    'label' => ['Example', 'Example radio buttons.'],
    'inputType' => 'radio',
    'options' => [
        'lorem' => 'Lorem',
        'ipsum' => 'Ipsum',
        'dolor' => 'Dolor',
    ],
    'sql' => [
        'type' => 'string',
        'length' => 8, // Must be large enough to store all possible values
        'default' => 'lorem',
    ],
],
// …
```

{{% /tab %}}

{{% tab title="Options from a table" %}}

You can generate an options array from another table with the `foreignKey` property. 

```php
// …
'example' => [
    'label' => ['Example', 'Example radio buttons.'],
    'inputType' => 'radio',
    'foreignKey' => 'tl_user.name', // Will use `name` as label, and the user `id` as value
    'sql' => [
        'type' => 'integer',
        'unsigned' => true,
        'default' => 0,
    ],
],
// …
```

{{% /tab %}}

{{< /tabs >}}

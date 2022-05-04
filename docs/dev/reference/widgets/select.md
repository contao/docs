---
title: "Select Menu"
description: Renders a drop-down menu
---

This widget renders a drop-down menu.

A simple select menu with hard-coded options whether to show the current page in the HTML Sitemap:

![Select menu with hard-coded options](../images/select.png?classes=shadow)

A select menu enhanced with Chosen.js to allow the editor to limit the available options with a simple search box:

![Select menu enhanced with Chosen.js](../images/select-chosen.png?classes=shadow)

A grouped select menu enhanced with Chosen.js:

![Grouped select menu enhanced with Chosen.js](../images/select-grouped-chosen.png?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference](../../dca/fields).

| Key   | Value | Description
| ----- | ----- | --------------- |
| `inputType` | `select` | |
| `options` | `array` | An options array (use in combination with `eval.multiple`) |
| `options_callback` | `function\|callable` | A callback function that returns the options callback or an array  (use in combination with `eval.multiple`). You may define an anonymous function, but you should consider [registering them via annotations](../../../framework/dca/#registering-callbacks). |
| `reference` | `array` | Reference an array that will be used to translate the options. Contao will automatically match the options and reference array by key. |
| `foreignKey` | `string` | Reference another table to generate options from. |
| `eval.multiple` | true/false (default) `bool` | Set this to true if you want to provide multiple options via `options` or `options_callback` |
| `eval.includeBlankOption` | true/false (default) `bool` | Includes a blank option (useful in conjunction with `mandatory` fields) |
| `eval.blankOptionLabel` | `string` (default `-`) | The label of the blank option |
| `eval.chosen` | true/false (default) `bool` | Enhance the select menu with Chosen.js |

The `options` array – either set directly or returned by an options callback – can have different structures depending on what you are going for:

1. `[ 'label1' , 'label2' ]` where the values of the select options will be the regular array index.
2. `[ 'value' => 'label' ]` where `value` will be the value of the select option, and `label` the label.
3. `[ 'foo' => ['a', 'b'], 'bar' => ['c', 'd'] ]` which will render grouped select options `foo` and `bar`.

## Column Definition

Depending on the widget configuration, the widget persists different values to the database. You have to take care of the correct SQL column definition yourself. A **single** select will save the selected value as string. If you allow to select **multiple** options, they are stored as serialized array. Since you do not know the length in advance, a blob column is prefered. 

## Examples

{{< tabs >}}

{{% tab name="Simple select" %}}

If you simply want to select an option from a fixed set.

```php
// ...
'isVisible' => [
    'label' => ['Visibility', 'Whether this element is visible on the page'],

    'inputType' => 'select',
    'options' => ['always', 'never', 'auto'],

    'sql' => [
        'type' => 'string',
        'length' => 8, // Must be large enough to store all possible values
        'default' => 'auto',
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="Grouped select" %}}

If you simply want to select one option from a fixed set of grouped options.

```php
// ...
'mySelect' => [
    'label' => ['Select', 'Help text'],
    'inputType' => 'select',
    'options' => [
      'news' => [
        'news_reader',
        'news_list',
      ],
      'events' => [
        'event_reader',
        'event_list',
      ],
    ],
    'sql' => [
        'type' => 'string',
        'length' => 16, // Must be large enough to store all possible options
        'default' => '',
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="Dynamic options with search box" %}}

You can also dynamically generate the options array to filter them as you wish. See the [options callback](../../dca/callbacks#fields-field-options) for further examples. 

```php
// ...
'mySelect' => [
    'label' => ['Select', 'Help text'], // Or a reference to the global language array
    'inputType' => 'select',
    'options_callback' => [
        'Vendor\Class', 'getMySelectOptions' // Defines a method that returns the options array. Class can be a service. 
    ],
    'eval' => [
        'chosen' => true, // Adds a search box to filter the options
    ],
    'sql' => [
        'type' => 'string',
        'length' => 16, // Must be large enough to store all possible options
        'default' => '',
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="Options from a table" %}}

You can generate an options array from another table with the `foreignKey` property. 

```php
// ...
'myUsers' => [
    'label' => ['My Users', 'Help text'], // Or a reference to the global language array
    'inputType' => 'select',
    'foreignKey' => 'tl_user.name', // Will use `name` as label, and the user `id` as value
    'eval' => [
        'chosen' => true, // Adds a search box to filter the options
    ],
    'sql' => [
        'type' => 'string',
        'notnull' => false,
        'default' => '',
    ],
],
// ...
```

{{% /tab %}}

{{< /tabs >}}

## Usage in Contao

Basically everywhere, e.g. `tl_page` or `tl_module`
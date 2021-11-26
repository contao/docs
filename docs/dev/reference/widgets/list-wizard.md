---
title: "List Wizard"
description: Render an expandable list
---

This widget renders a list wizard which allows you to add, remove and reorder list items.


A simple list widget example:

![A simple list widget example](../images/list-wizard-simple.png?classes=shadow)

Usage in the list content element: 


![A simple list widget example](../images/list-wizard-ce.png?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference](../../dca/fields).

| Key   | Value | Description
| ----- | ----- | --------------- |
| `inputType` | `listWizard` | |
| `eval.allowHtml` | `bool` | If true the list fields will accept HTML input (see “Allowed HTML tags” in the back end System => Settings). |
| `eval.maxlength` | `integer` | Maximum number of characters that are allowed in list fields. |


## Examples

```php
// ...
'jobTitles' => [
    'inputType' => 'listWizard',
    'eval' => [
        'maxlength' => 32
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false
    ],

],
// ...
```

## Usage in Contao

Only used in the list content element.
---
title: "Key-Value-Wizard"
description: Renders an expandable list of keys and values.
---


This widget allows you to enter multiple "key & value" (or "value & label") combinations. It allows you to copy and 
delete individual entries as well as re-arrange the order of the entries.

![Key-Value-Wizard widget]({{% asset "images/dev/reference/widgets/key-value-wizard.png" %}}?classes=shadow)


## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a 
[full field reference][FieldsReference].

| Key               | Value                       |
|-------------------|-----------------------------|---
| `inputType`       | `keyValueWizard` (string)   |
| `eval.maxlength`  | `integer`                   | Maximum number of characters that are allowed in the individual input fields.
| `eval.keyLabel`   | `string`                    | The label for the "key" column of the wizard.
| `eval.valueLabel` | `string`                    | The label for the "value" column of the wizard.


## Examples

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'foobar' => [
    'inputType' => 'keyValueWizard',
    'eval' => [
        'maxlength' => 255,
        'keyLabel' => 'The key',
        'valueLabel' => 'The label',
    ],
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// …
```


## Usage in Contao

The key value wizard widget is used in the _Description list_ content element for example in order to be able to enter
the list of description terms (the "key") and description details (the "value").


[FieldsReference]: /reference/dca/fields

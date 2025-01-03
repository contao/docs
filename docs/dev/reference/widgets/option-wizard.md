---
title: Option Wizard
description: Renders an expandable list of options for select fields.
---


This widget allows you to enter multiple options for select fields. It allows you to copy and  delete individual entries
as well as re-arrange the order of the entries. Each option can also be defined as the default when not option was
selected yet. If you define an option to be a "group" all following options will be grouped under this option (until the
next group option).

![Option Wizard widget]({{% asset "images/dev/reference/widgets/option-wizard.png" %}}?classes=shadow)


## Options

This widget does not have any special options. See the DCA reference for a [full field reference][FieldsReference].


## Examples

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'foobar' => [
    'inputType' => 'optionWizard',
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// …
```


## Usage in Contao

The option wizard widget is used in the form generator for its select form fields. It allows the user to enter the
available options for the respective select field.


[FieldsReference]: /reference/dca/fields
[KeyValueWizard]: /reference/widgets/key-value-wizard

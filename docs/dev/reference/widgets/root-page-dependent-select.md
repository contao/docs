---
title: Root Page Dependent Select
description: Renders a module selection per root page.
---

This widget renders a module selection per root page of the site structure. This widget was specifically made for the
_Root page dependent modules_ front end module.

![Root Page Dependent Select]({{% asset "images/dev/reference/widgets/root-page-dependent-select.png" %}}?classes=shadow)

## Options

This widget has no special options. See the DCA reference for a
[full field reference]({{% relref "reference/dca/fields" %}}).

## Example

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'example' => [
    'inputType' => 'rootPageDependentSelect',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'w50'],
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// …
```

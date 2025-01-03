---
title: Section Wizard
description: Custom sections for your page layout.
---


The section wizard is specifically used within Contao's [page layouts][PageLayouts]. It allows you to define custom
sections in addition to the default ones. For each section you can define how and where it should be rendered within the
layout.

![Section Wizard]({{% asset "images/dev/reference/widgets/section-wizard.png" %}}?classes=shadow)


## Options

This widget does not have any special options. See the DCA reference for a [full field reference][FieldsReference].


## Example

This is the section wizard as used in the `tl_layout` DCA.


```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// ...
'modules' => [
    'search' => true,
    'inputType' => 'sectionWizard',
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// ...
```


[PageLayouts]: https://docs.contao.org/manual/en/layout/theme-manager/manage-page-layouts/

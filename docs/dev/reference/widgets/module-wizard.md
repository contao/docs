---
title: Module Wizard
description: Assigns front end modules to layout sections.
---


The module wizard is specifically used within Contao's [page layouts][PageLayouts]. It allows you to assign front end
modules to the available sections of your layout, so that they will be rendered in the respective section.

![Module Wizard]({{% asset "images/dev/reference/widgets/module-wizard.png" %}}?classes=shadow)


## Options

This widget does not have any special options. See the DCA reference for a [full field reference][FieldsReference].


## Example

This is the module wizard as used in the `tl_layout` DCA. It adds a module with the ID `0` in the `main` section by
default. The module with ID `0` is a special front end module (`\Contao\ModuleArticle`) that will render the content of
a page article of a specific section (e.g. `main` or `left`).

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// ...
'modules' => [
    'default' => [['mod' => 0, 'col' => 'main', 'enable' => 1]],
    'inputType' => 'moduleWizard',
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// ...
```


[PageLayouts]: https://docs.contao.org/manual/en/layout/theme-manager/manage-page-layouts/
[FieldsReference]: /reference/dca/fields

---
title: Page Tree
description: Provides a picker where you can select one or more pages from the site structure.
---

This widget allows you to select one or more pages from the site structure.

![Page Tree widget]({{% asset "images/dev/reference/widgets/page-tree.png" %}}?classes=shadow)

## Options

| Key               | Value                 | Description                                                                        |
|-------------------|-----------------------|------------------------------------------------------------------------------------|
| `inputType`       | `pageTree` (`string`) |                                                                                    |
| `eval.multiple`   | `bool`                | If true allows you to select several pages.                                        |
| `eval.fieldType`  | `string`              | Mandatory. Either `'checkbox'` or `'radio'` (for `multiple`).                      |
| `eval.isSortable` | `string`              | Allows you to sort the selected pages after making the selection (for `multiple`). |

## Examples

{{< tabs groupid="page-tree-widget-examples" style="code" >}}

{{% tab title="Single page" %}}

A single page picker.

```php
// …
'jumpTo' => [
    'exclude' => true,
    'inputType' => 'pageTree',
    'foreignKey' => 'tl_page.title',
    'eval' => [
        'fieldType'  => 'radio',
    ],
    'sql' => [
        'type' => 'integer',
        'unsigned' => true,
        'default' => 0,
    ],
    'relation' => [
        'type' => 'hasOne', 
        'load' => 'lazy',
    ],
],
// …
```
{{% /tab %}}

{{% tab title="Multiple pages" %}}

Allows you to select multiple pages and sort them afterwards.

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'pages' => [
    'exclude' => true,
    'inputType' => 'pageTree',
    'foreignKey' => 'tl_page.title',
    'eval' => [
        'multiple' => true,
        'fieldType' => 'checkbox',
        'isSortable' => true,
    ],
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
    'relation' => [
        'type' => 'hasMany', 
        'load' => 'lazy',
    ],
],
// …
```

{{% /tab %}}

{{< /tabs >}}

## Usage in Contao

The page tree widget is used very often in Contao. A few examples:

* Within the `navigation` module it is used to set the optional reference page.
* Within the `search` module it is used to set one ore more references pages to search through.
* Within the settings of a news archive or calendar it is used to define the detail page of news and event records.

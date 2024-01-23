---
title: "File tree"
description: Render a file picker
---

This widget renders a file picker allowing to choose one or more files from the file system.


The file tree widget in the contao download element:

![File tree widget]({{% asset "images/dev/reference/widgets/file-tree.png" %}}?classes=shadow)

The file tree with gallery option enabled (as in the contao gallery element):

![File tree widget]({{% asset "images/dev/reference/widgets/file-tree-gallery.png" %}}?classes=shadow)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference](../../dca/fields).

| Key               | Value                       | Description                                                                                                                                                                                                                                                                                                   |
|-------------------|-----------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `inputType`       | `fileTree` (string)         |                                                                                                                                                                                                                                                                                                               |
| `eval.extensions` | `string`                    | Limits the file tree to certain file types (comma separated list).                                                                                                                                                                                                                                            |
| `eval.fieldType`  | `checkbox`/`radio` (string) | **checkbox** allow multiple selections<br/>**radio** allow a single selection only                                                                                                                                                                                                                            |
| `eval.files`      | `bool`                      | If true files and folders will be shown. If false, only folders will be shown.                                                                                                                                                                                                                                |
| `eval.filesOnly`  | `bool`                      | Removes the radio buttons or checkboxes next to folders.                                                                                                                                                                                                                                                      |
| `eval.isGallery`  | `bool`                      | Displays selected files of a fileTree widget as an image gallery.                                                                                                                                                                                                                                             |
| `eval.isSortable` | `bool`                      | {{< version "4.10" >}} Enable sorting for the selected items.                                                                                                                                                                                                                                                 |
| `eval.multiple`   | `bool`                      | Make the input field multiple.                                                                                                                                                                                                                                                                                |
| `eval.orderField` | `string`                    | <div class="notices note"><p>Using "orderField" for the page tree has been deprecated and will <strong>no longer work in Contao 5.0</strong>. Use "isSortable" instead.</p></div>Database column where the order of the selected items gets stored. This is only required if isGallery or isDownloads is set. |
| `eval.path`       | `string`                    | Custom root directory for file trees.                                                                                                                                                                                                                                                                         |

## Examples

{{< tabs groupId="file-tree-widget-examples" >}}

{{% tab name="Image picker" %}}

A single image file picker.

```php
// ...
'singleSRC' => [
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => [
        'filesOnly'  => true,
        'fieldType'  => 'radio',
        'extensions' => 'jpg,png,gif',
    ],
    'sql'       => [
        'type' => 'binary',
        'length' => 16,
        'fixed' => true,
        'notnull' => false,
    ],
],
// ...
```
{{% /tab %}}

{{% tab name="Image gallery" %}}

An image gallery picker, allows picking multiple images, display them in the back end as gallery and be able to sort them.


```php
// ...
'multiSRC' => [
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => [
        'fieldType'  => 'checkbox',
        'files'      => true,
        'isGallery'  => true,
        'multiple'   => true,
        'orderField' => 'orderSRC',
    ],
    'sql'       => "blob NULL",
],
// ...
```

{{% /tab %}}

{{% tab name="Select folder" %}}

A folder picker.

```php
// ...
'folders' => [
    'inputType' => 'fileTree',
    'eval'      => [
        'files'     => false,
        'fieldType' => 'checkbox',
        'multiple'  => true,
    ],
    'sql'       => "blob NULL",
],
// ...
```

{{% /tab %}}

{{< /tabs >}}


## Usage in Contao

The file tree widget is used very often in contao. Examples are the text, download, image and gallery elements.

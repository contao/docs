---
title: "File tree"
description: Render a file picker
---

This widget renders a file picker allowing choosing one or more files from the file system.

The file tree widget in the contao download element:

![File tree widget](../images/file-tree.png?classes=shadow)

## Options

| Key          | Value                       | Description                                                                                                                                                                                                                                                                                                   |
|--------------|-----------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `inputType`  | `fileTree` (string)         |                                                                                                                                                                                                                                                                                                               |
| `fieldType`  | `checkbox`/`radio` (string) | **checkbox** allow multiple selections<br/>**radio** allow a single selection only                                                                                                                                                                                                                            |
| `extensions` | `string`                    | Limits the file tree to certain file types (comma separated list).                                                                                                                                                                                                                                            |
| `files`      | `bool`                      | If true files and folders will be shown. If false, only folders will be shown.                                                                                                                                                                                                                                |
| `filesOnly`  | `bool`                      | 	Removes the radio buttons or checkboxes next to folders.                                                                                                                                                                                                                                                     |
| `isGallery`  | `bool`                      | Displays selected files of a fileTree widget as an image gallery.                                                                                                                                                                                                                                             |
| `isSortable` | `bool`                      | {{< version "4.10" >}} Enable sorting for the selected items.                                                                                                                                                                                                                                                 |
| `orderField` | `string`                    | <div class="notices note"><p>Using "orderField" for the page tree has been deprecated and will <strong>no longer work in Contao 5.0</strong>. Use "isSortable" instead.</p></div>Database column where the order of the selected items gets stored. This is only required if isGallery or isDownloads is set. |
| `path`       | `string`                    | Custom root directory for file trees.                                                                                                                                                                                                                                                                         |

## Examples

{{< tabs >}}

{{% tab name="Image picker" %}}

A single image file picker.

```php
// ...
'singleSRC' =>
[
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => [
        'filesOnly'  => true,
        'fieldType'  => 'radio',
        'extensions' => 'jpg,png,gif',
    ],
    'sql'       => "binary(16) NULL"
],
// ...
```
{{% /tab %}}

{{% tab name="Image gallery" %}}

An image gallery picker, allows picking multiple images, display them in the backend as gallery and be able to sort them.

```php
// ...
'multiSRC' => [
    'exclude'       => true,
    'inputType'     => 'fileTree',
    'eval'          => [
        'fieldType' => 'checkbox', 
        'orderField' => 'orderSRC', 
        'files' => true,
        'isGallery' => true,
    ],
    'sql'           => "blob NULL",
],
// ...
```

{{% /tab %}}

{{% tab name="Select folder" %}}

A folder picker.

```php
// ...
'folders'         => [
    'inputType' => 'fileTree',
    'eval'      => [
        'files'     => false,
        'fieldType' => 'checkbox',
    ],
    'sql'       => "blob NULL",
],
// ...
```

{{% /tab %}}

{{< /tabs >}}



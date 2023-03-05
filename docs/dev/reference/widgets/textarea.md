---
title: "Textarea"
description: Renders a textarea input field for which you can also enable the Ace or TinyMCE editor.
---


In its most basic form this widget renders a `<textarea>` field which allows multi-line input.

![A simple textarea](../images/textarea.png?classes=shadow)

It also allows you to enable an editor like TinyMCE for HTML content:

![TinyMCE editor](../images/tinymce.png?classes=shadow)

Or the Ace editor for syntax highlighting of code input, e.g. PHP:

![Ace editor](../images/ace.png?classes=shadow)


## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference](../../dca/fields).

| Key   | Value | Description
| ----- | ----- | --------------- |
| `inputType` | `textarea` | |
| `eval.rte` | `tinyMCE`, `ace`, `ace\|html`, … | Enables a texteditor, e.g. `tinyMCE` for TinyMCE or `ace` for Ace. |
| `eval.rows` | `integer` | The `rows` attribute for the `<textarea>` |
| `eval.cols` | `integer` | The `cols` attribute for the `<textarea>` |

When using `tinyMCE` for the `rte` option Contao will use the `be_tinyMCE.html5` template which contains the initialisation of the editor.
You can also create custom TinyMCE initialisation templates and reference them there. For example if you create a `be_tinyNews.html5`
template you can reference this template in the DCA via `'rte' => 'tinyNews'`.

When using `ace` for the `rte` option you can optionally also pass a parameter for syntax highlighting. For example if your textarea input
is expected to be JSON you can use `ace|json`. If it is expected to be PHP you can use `ace|php` etc.

{{% notice "note" %}}
`allowHtml` and `decodeEntities` is automatically enabled if `rte` equals to `ace\|html` or if it starts with `tiny`. If `rte` starts with
`tiny` Contao will also convert any file pahts automatically into a `{{file::*}}` insert tag, if applicable.
{{% /notice %}}


## Column Definition

Typically the SQL column defintion for textarea fields will be `text NULL` (`['type' => 'text', 'notnull' => false]`) as it can contain
contents of arbitrary length.


## Examples

{{< tabs groupId="textarea-widget-examples" >}}

{{% tab name="Textarea" %}}

If you simply want to allow multi-line text input:

```php
// ...
'myTextarea' => [
    'label' => ['Textarea', 'Description'],
    'inputType' => 'textarea',
    'sql' => [
        'type' => 'text',
        'notnull' => false,
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="TinyMCE" %}}

If you want to provide a TinyMCE text editor for your textarea input:

```php
// ...
'myTextarea' => [
    'label' => ['Textarea', 'Description'],
    'inputType' => 'textarea',
    'eval' => [
        'rte' => 'tinyMCE',
        'helpwizard' => true,
    ],
    'sql' => [
        'type' => 'text',
        'notnull' => false,
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="Ace" %}}

If you want to provide the Ace editor with syntax highlighting for JavaScript for your textarea input:

```php
// ...
'myTextarea' => [
    'label' => ['Textarea', 'Description'],
    'inputType' => 'textarea',
    'eval' => [
        'rte' => 'ace|js',
    ],
    'sql' => [
        'type' => 'text',
        'notnull' => false,
    ],
],
// ...
```

{{% /tab %}}

{{< /tabs >}}


## Usage in Contao

The textarea widget is used for the text input in text content elements with TinyMCE enabled. It is also used to allow custom robots.txt
input in the settings of your website root. Together with the Ace editor the textarea widget is also used for the additional head tags 
settings in page layouts as well as for the template editor for example.

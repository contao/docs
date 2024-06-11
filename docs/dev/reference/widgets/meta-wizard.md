---
title: "Meta Wizard"
description: Allow to edit meta data fields.
---

The meta data widget allows to edit meta data fields. If multiple languages are enabled, the widget will create a row for each language.

![MetaWizard widget with two languages]({{% asset "images/dev/reference/widgets/meta-wizard.png" %}}?classes=shadow)

## Options

| Key                                  | Value                   | Description                                                                                                                  |
|--------------------------------------|-------------------------|------------------------------------------------------------------------------------------------------------------------------|
| `inputType`                          | `metaWizard` (`string`) |                                                                                                                              |
| `eval.metaFields`                    | `array`                 | An array of meta fields to be displayed. The array key is the field. Value can be an string of field attributes or an array. |
| `eval.metaFields.[field].type`       | `string`                | The field input type. Only supported value is `textarea`, otherwise a text input is shown.                                   |
| `eval.metaFields.[field].attributes` | `string`                | The field attributes.                                                                                                        |
| `eval.metaFields.[field].dcaPicker`  | `bool`                  | Show a dca picker                                                                                                            |
| `eval.metaFields.[field].rgxp`       | `string`                | A validation regex.                                                                                                          |
| `eval.metaFields.[field].rgxpErrMsg` | `string`                | Error message if regex validation failed.                                                                                    |

## Examples

{{< tabs groupId="meta-wizard-widget-examples" >}}

{{% tab name="File Manager" %}}

The Meta Wizard configuration in the file manager.

```php
// ...
'meta' => [
    'exclude' => true,
    'inputType' => 'metaWizard',
    'eval' =>
        [
            'allowHtml' => true,
            'multiple' => true,
            'metaFields' => [
                'title' => 'maxlength="255"',
                'alt' => 'maxlength="255"',
                'link' => ['attributes' => 'maxlength="2048"', 'dcaPicker' => true],
                'caption' => ['type' => 'textarea'],
                'license' => [
                    'attributes' => 'maxlength="255"',
                    'dcaPicker' => true,
                    'rgxp' => '#(^$|^{{link_url::.+$|^https?://.+$)#',
                    'rgxpErrMsg' => &$GLOBALS['TL_LANG']['tl_files']['licenseRgxpError']
                ]
            ]
        ],
    'sql' => "blob NULL"
],
// ...
```

{{% /tab %}}

{{< /tabs >}}
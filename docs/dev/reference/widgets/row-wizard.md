---
title: Row Wizard
description: Renders a configurable set of widgets as repeatable rows.
---

{{< version-tag "5.7" >}}

This widget allows you to render one or more rows of arbitrary DCA fields.
Each row consists of a configurable set of child widgets that are parsed and rendered directly by the core.
The widget validates each child field individually and stores the resulting rows as a serialized array.


![Key-Value-Wizard widget]({{% asset "images/dev/reference/widgets/key-value-wizard.png" %}}?classes=shadow)

## Features

- Parses and renders DCA field definitions directly
- Allows callbacks on the used widget fields
- Uses the existing backend Stimulus controllers
- Validation is handled by the individual child widgets
- Stores multiple rows as serialized data
- Optional drag & drop sorting (enabled by default)
- Configurable minimum and maximum number of rows
- Configurable row actions

## Supported widgets

Since the Row Wizard parses DCA field definitions directly, it works with most standard widgets.

### Known limitations

The following widget types do not work within the row wizard

- `color-picker`
- Widgets using `eval.rte` (e.g. TinyMCE-based fields) may require additional testing depending on the Contao version.
- Custom widgets provided by extensions that are dependent on JavaScript (Stimulus controllers may work)

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a 
[full field reference][FieldsReference].

| Key             | Value                | Description                                                                |
|-----------------|----------------------|----------------------------------------------------------------------------|
| `inputType`     | `rowWizard` (string) |                                                                            |
| `fields`        | `array`              | Associative array of DCA field definitions rendered per row.               |
| `eval.actions`  | `array`              | Allowed values: `copy`, `delete`, `enable`. Default: `['copy', 'delete']`. |
| `eval.sortable` | `bool`               | Enables or disables drag & drop sorting (default: `true`).                 |
| `eval.min`      | `int`                | Minimum number of rows.                                                    |
| `eval.max`      | `int`                | Maximum number of rows.                                                    |

## Column Definition

The Row Wizard stores its data as a serialized array containing all defined rows and their field values. Since the total length cannot be predicted, a `blob` column is recommended.


## Examples

### Usage within contao/core-bundle

- [tl_content.fields.data (contao/contao-core)](https://github.com/contao/contao/blob/436c51377f434a63af82f6a4c9dd7c2176b0071b/core-bundle/contao/dca/tl_content.php#L701-#L719)

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'data' => [
    'inputType' => 'rowWizard',
    'fields' => [
        'key' => [
            'label' => &$GLOBALS['TL_LANG']['MSC']['ow_key'],
            'inputType' => 'text'
        ],
        'value' => [
            'label' => &$GLOBALS['TL_LANG']['MSC']['ow_value'],
            'inputType' => 'text'
        ],
    ],
    'eval' => ['tl_class' => 'w66 clr'],
    'sql' => [
        'type' => 'text',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false
    ],
],
// …
```

### All options

```php
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;

// …
$GLOBALS['TL_DCA']['tl_content']['fields']['rowWizard'] = [
    'label' => ['rowWizardExample', 'And some random description'],
    'inputType' => 'rowWizard',
    'fields' => [
        'type' => [
            'label' => ['Type'],
            'inputType' => 'select',
            'options' => ['foo', 'bar', 'baz', 'quux'],
            'eval' => [
                'includeBlankOption' => true,
                'chosen' => true,
            ],
        ],
        'checkbox' => [
            'label' => ['Checkbox'],
            'inputType' => 'checkbox',
        ],
        'textarea' => [
            'label' => ['Textarea'],
            'inputType' => 'textarea',
        ],
        'text' => [
            'label' => ['Text'],
            'inputType' => 'text',
        ],
    ],
    'eval' => [
        'tl_class' => 'clr',
        'actions' => [
            'copy',
            'delete',
            'enable',
        ],
        'min' => 2, // minimum two rows
        'max' => 5, // maximum of five rows
        'sortable' => false, // disable the sorting, defaults to true
    ],
    'sql' => [
        'type' => 'blob',
        'length' => AbstractMySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
];
// …
```

## Callback

In some cases, you may not want to save any value if there is only one row and the first\* value is empty.
You can implement your own save callback for this case:

```php
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\StringUtil;

#[AsCallback(table: 'tl_content', target: 'fields.columnWizard.save')]
class ColumnWizardFieldSaveCallback
{
    public function __invoke($value, DataContainer $dc)
    {
        if ('' === $value) {
            return $value;
        }

        if (0 === \count($values = StringUtil::deserialize($value, true))) {
            return '';
        }

        // Do not reset if there is more than one row
        if (1 !== \count($values)) {
            return $value;
        }

        if (($values[0][array_key_first($values[0])] ?? '') === '') {
            return '';
        }

        return $value;
    }
}
```
*\* the provided example checks for the first value, you may be able to change your callback to any other field*      

## Usage in Contao

The row wizard widget is used in the _Description list_ content element for example in order to be able to enter
the list of description terms (the "key") and description details (the "value").

[FieldsReference]: /reference/dca/fields

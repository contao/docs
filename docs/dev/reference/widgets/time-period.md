---
title: Time Period
description: Text field with drop-down menu
---

This widget renders a text field with a drop-down menu and is proposed to be used with time periods.

![Time period widget]({{% asset "images/dev/reference/widgets/time_period.png" %}}?classes=shadow&width=600px)

## Options

| Key            | Value                | Description                                                              |
|----------------|----------------------|--------------------------------------------------------------------------|
| inputType      | `timePeriod`         |                                                                          |
| options        | array                | The options for select menu, typically time units like `['s', 'm', 'h']` |
| reference      | array                | The translation reference for the values.                                |
| eval.disabled  | bool (default false) | Disables the field                                                       |
| eval.maxlength | int                  | Maximum number of characters allowed in the current field.               |

Additionally, there are inherited [global options](../../dca/fields/) like: `label`, `default`, `exclude`, `search`, `sorting`, `filter`, `flag`, `sql`.

## Column Definition

Values are stored as a serialized array, so using blob is preferred.


## Example

```php
use Doctrine\DBAL\Platforms\MySQLPlatform;

// …
'time' => [
    'inputType' => 'timePeriod',
    'options' => [
        's', 'm', 'h'
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_foobar']['timePeriod'],
    'sql' => [
        'type' => 'blob',
        'length' => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
],
// …
```

```yaml
# translations/contao_tl_foobar.en.yaml
tl_foobar:
    s: Seconds
    m: Minutes
    h: Hours
```

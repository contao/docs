---
title: "Time Period"
description: Text field with drop-down menu
---

This widget renders a text field with a drop-down menu and is proposed to be used with time periods.

![Time period widget](../images/time_period.png?classes=shadow&width=600px)

## Options

| Key            | Value                | Description                                                                 |
|----------------|----------------------|-----------------------------------------------------------------------------|
| inputType      | 'timePeriod'         |                                                                             |
| options        | array                | The options for select menu, typically time units like `['s', 'm', 'h']`  |

| reference      | array                | The translation array (typically `&$GLOBALS['TL_LANG']['MSC']['timePeriod']`) |

| eval.disabled  | bool (default false) | Disables the field                                                          |
| eval.maxlength | int                  | Maximum number of characters allowed in the current field.          |



Additionally, there are inherited [global options](../../dca/fields/) like: `label`, `default`, `exclude`, `search`, `sorting`, `filter`, `flag`, `sql`.

## Column Definition

Values are stored as a serialized array, so using blob is preferred.


## Example

```php
'time' => [
    'inputType' => 'timePeriod',
    'options' => [
        's', 'm', 'h'
    ],
    'reference' => &$GLOBALS['TL_LANG']['MSC']['timePeriod'],
    'sql' => 'blob NULL'
],
```
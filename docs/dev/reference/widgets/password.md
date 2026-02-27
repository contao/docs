---
title: Password
description: Password text field.
---

This widget renders a `type="password"` text field, with the ability to show the otherwise obfuscated password (when
newly entered).

![Password]({{% asset "images/dev/reference/widgets/password.png" %}}?classes=shadow)

## Options

This widget has no special options, but all options for the [`text`]({{% relref "text" %}}) widget are also
relevant.

| Key               | Value                       | Description
|-------------------|-----------------------------|------------
| `inputType`       | `password` (string)         | -

## Example

```php
// …
'myPassword' => [
    'inputType' => 'password',
    'eval' => [
        'mandatory' => true,
        'minlength' => Config::get('minPasswordLength'),
        'tl_class' => 'w50'
    ],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
],
// …
```

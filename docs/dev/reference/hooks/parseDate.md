---
title: "parseDate"
description: "parseDate hook"
---


This hook is executed whenever `\Contao\Date::parse` is used. `\Contao\Date::parse`
allows you to format a date (timestamp) using the locale of the current request.
The hook allows you to customize the date format.


## Parameters

1. *string* `$formattedDate

    The already formatted date.

2. *string* `$format`

    The requested date format.

3. *int* `$timestamp`

    The given timestamp. Can be `null`.


## Return Values

A string containing the formatted date.


## Example

```php
// src/App/EventListener/ParseDateListener.php
namespace App\EventListener;

class ParseDateListener
{
    public function onParseDate(string $formattedDate, string $format, ?int $timestamp): string
    {
        // Modify or create your own formatted date …

        return $formattedDate;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ParseDateListener:
    public: true
    tags:
      - { name: contao.hook, hook: parseDate, method: onParseDate }
```


## References

* [\Contao\Date#L592-L599](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Date.php#L592-L599)

---
title: "parseDate"
description: "parseDate hook"
aliases:
    - /reference/hooks/parseDate/
    - /reference/hooks/parsedate/
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
// src/EventListener/ParseDateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("parseDate")
 */
class ParseDateListener
{
    public function __invoke(string $formattedDate, string $format, ?int $timestamp): string
    {
        // Modify or create your own formatted date …

        return $formattedDate;
    }
}
```


## References

* [\Contao\Date#L592-L599](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Date.php#L592-L599)
* https://github.com/contao/core/issues/4260

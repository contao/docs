---
title: "insertTagFlags"
description: "insertTagFlags hook"
tags: ["hook-custom"]
aliases:
    - /reference/hooks/insertTagFlags/
    - /reference/hooks/inserttagflags/
---


The `insertTagFlags` hook is triggered when unknown flags (filters) are passed
to an insert tag. It passes the arguments listed belows and expects the replacement
text as return value or `false` if the flag was not handled.


## Parameters

1. *string* `$flag`

    The name of the insert tag flag.

2. *string* `$flag`

    The name of the insert tag.

3. *string* `$cachedValue`

    The cached replacement for this insert tag (if there is any).

4. *array* `$flags`

    An array of flags used with this insert tag.

5. *bool* `$useCache`

    Indicates if we are supposed to cache.

6. *array* `$tags`

    Contains the result of spliting the page's content in order to replace the insert tags.

7. *array* `$cache`

    The cached replacements of insert tags found on the page so far.

8. *int* `$_rit`

    Counter used while iterating over the parts in `$tags`.

9. *int* `$_cnt`

    Number of elements in `$tags`.


## Return Values

The return value should be the replacement text or `false` if the flag was not handled.


## Example

If you use `{{date::D d. F Y|monthNamesAustria|utf8_strtoupper}}` Contao knows 
how to handle the `date` insert tag and the `utf8_strtoupper` flag. The unknown 
`monthNamesAustria` triggers the hook:


```php
// src/EventListener/InsertTagFlagsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class InsertTagFlagsListener
{
    /**
     * @Hook("insertTagFlags")
     */
    public function onInsertTagFlags(
        string $flag, 
        string $tag, 
        string $cachedValue, 
        array $flags, 
        bool $useCache, 
        array $tags, 
        array $cache, 
        int $_rit, 
        int $_cnt
    )
    {
        if ('monthNamesAustria' === $flag) {
            return str_replace(['Januar', 'Februar'], ['Jänner', 'Feber'], $cachedValue);
        }

         // Indicate that we did not handle that flag
        return false;
    }
}
```


## References

* [\Contao\InsertTags#L1112-L1132](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/InsertTags.php#L1112-L1132)

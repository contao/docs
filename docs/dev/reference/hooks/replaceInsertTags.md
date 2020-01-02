---
title: "replaceInsertTags"
description: "replaceInsertTags hook"
tags: ["hook-custom"]
aliases:
    - /reference/hooks/replaceInsertTags/
    - /reference/hooks/replaceinserttags/
---


The `replaceInsertTags` hook is triggered when an unknown insert tag is found.
It passes the insert tag as argument and expects the replacement value or
false as return value.


## Parameters

1. *string* `$insertTag`

    The unknown insert tag.

2. *bool* `$useCache`

    Indicates if we are supposed to cache.

3. *string* `$cachedValue`

    The cached replacement for this insert tag (if there is any).

4. *array* `$flags`

    An array of flags used with this insert tag.

5. *array* `$tags`

    Contains the result of spliting the page's content in order to replace the insert tags.

6. *array* `$cache`

    The cached replacements of insert tags found on the page so far.

7. *int* `$_rit`

    Counter used while iterating over the parts in `$tags`.

8. *int* `$_cnt`

    Number of elements in `$tags`.


## Return Values

Return a string if your function is taking care of this insert tag. The hook loop
will be stopped and your output is used as a replacement value.

If your function is not responsible for this insert tag, you **must** return
`false` to continue to the next hook callback.


## Example

```php
// src/EventListener/ReplaceInsertTagsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ReplaceInsertTagsListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("replaceInsertTags")
     */
    public function onReplaceInsertTags(
        string $insertTag,
        bool $useCache,
        string $cachedValue,
        array $flags,
        array $tags,
        array $cache,
        int $_rit,
        int $_cnt
    )
    {
        if ('mytag' === $insertTag) {
            return 'mytag replacement';
        }

        return false;
    }
}
```

* [\Contao\CalendarBundle\EventListener\InsertTagsListener#L33-L58](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/EventListener/InsertTagsListener.php#L33-L58)
* [\Contao\CoreBundle\EventListener\InsertTags\AssetListener#L29-L46](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/EventListener/InsertTags/AssetListener.php#L29-L46)
* [\Contao\CoreBundle\EventListener\InsertTags\TranslationListener#L29-L45](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/EventListener/InsertTags/TranslationListener.php#L29-L45)
* [\Contao\FaqBundle\EventListener\InsertTagsListener.php#L34-L67](https://github.com/contao/contao/blob/4.7.6/faq-bundle/src/EventListener/InsertTagsListener.php#L34-L67)
* [\Contao\NewsBundle\EventListener\InsertTagsListener#L33-L58](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/EventListener/InsertTagsListener.php#L33-L58)


## References

* [\Controller\InsertTags#L1016-L1035](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/InsertTags.php#L1016-L1035)

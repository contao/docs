---
title: "getPageIdFormUrl"
description: "getPageIdFormUrl hook"
tags: ["hook-routing"]
---

The `getPageIdFromUrl` hook is triggered when the URL fragments are evaluated.
It passes the array of URL fragments as argument and expects an array of URL
fragments as return value.

The first fragment returned will usually be the ID or alias of a Contao page.

{{% notice info %}}
Using the `getPageIdFromUrl` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *array* `$fragments`

    The URL fragments (current url exploded by slash). Be aware that previous hook
    callbacks could have modified this data.


## Return values

Return the (modified) array of URL fragments.


## Example

```php
// src/App/EventListener/GetPageIdFromUrlListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class GetPageIdFromUrlListener
{
    /**
     * @Hook("getPageIdFromUrl")
     */
    public function onGetPageIdFromUrl(array $fragments): array
    {
        // Analyze the fragments
        if (…) {
            \Contao\Input::setGet('myFirstCustomGetParameter', $fragments[1]);
            \Contao\Input::setGet('mySecondCustomGetParameter', $fragments[2]);

            return [$fragments[0]];
        }

        return $fragments;
    }
}
```


## References

* [\Contao\Frontend.php#L243-L250](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Frontend.php#L243-L250)
* [\Contao\CoreBundle\Routing\Matcher\LegacyMatcher#L150-L165](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Routing/Matcher/LegacyMatcher.php#L150-L165)

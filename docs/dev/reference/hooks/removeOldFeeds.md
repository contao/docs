---
title: "removeOldFeeds"
description: "removeOldFeeds hook"
tags: ["hook-automator"]
aliases:
    - /reference/hooks/removeOldFeeds/
    - /reference/hooks/removeoldfeeds/
---


The `removeOldFeeds` hook is triggered when old XML files are being removed from
the Contao root directory. It does not pass an argument and expects an array of
file names to preserve as return value.


## Return Values

Return an array of XML file names (**do not include** file extension!) that
**must not** be removed from the root directory. Return an empty array if you have
nothing to keep.


## Example

```php
// src/EventListener/RemoveOldFeedsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class RemoveOldFeedsListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("removeOldFeeds")
     */
    public function onRemoveOldFeeds(): array
    {
        // Return the names of your custom feeds which should not be removed
        return ['custom'];
    }
}
```

* [\Contao\Calendar#L555-L574](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Calendar.php#L555-L574)
* [\Contao\News#L477-L496](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/classes/News.php#L477-L496)


## References

* [\Contao\Automator#L257-L265](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Automator.php#L257-L265)

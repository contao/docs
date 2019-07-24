---
title: "getRootPageFromUrl"
description: "getRootPageFromUrl hook"
tags: ["hook-routing"]
---

The `getRootPageFromUrl` hook is triggered when searching the current root page.
It does not pass any parameters and expects a `\Contao\PageModel` instance as return
value or null.


## Return Values

Return a `\Contao\PageModel` instance if you want to override the default method
for searching the root page.


## Example

```php
// src/EventListener/GetRootPageFromUrlListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class GetRootPageFromUrlListener
{
    /**
     * @Hook("getRootPageFromUrl")
     */
    public function onGetRootPageFromUrl(): ?\Contao\PageModel
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Routing\RouteProvider#L507-L521](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Routing/RouteProvider.php#L507-L521)

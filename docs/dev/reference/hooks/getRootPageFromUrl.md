---
title: "getRootPageFromUrl"
description: "getRootPageFromUrl hook"
tags: ["hook-routing"]
aliases:
    - /reference/hooks/getRootPageFromUrl/
    - /reference/hooks/getrootpagefromurl/
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

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('getRootPageFromUrl')]
class GetRootPageFromUrlListener
{
    public function __invoke(): ?\Contao\PageModel
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Routing\RouteProvider#L507-L521](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Routing/RouteProvider.php#L507-L521)

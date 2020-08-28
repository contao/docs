---
title: "initializeSystem"
description: "initializeSystem hook"
tags: ["hook-system"]
aliases:
    - /reference/hooks/initializeSystem/
    - /reference/hooks/initializesystem/
---


The `initializeSystem` hook is triggered right after the system initialization
process is finished and before the request processing is started.


## Example

```php
// src/EventListener/InitializeSystemListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("initializeSystem")
 */
class InitializeSystemListener
{
    public function __invoke(): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Framework\ContaoFramework#L373-L377](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Framework/ContaoFramework.php#L373-L377)

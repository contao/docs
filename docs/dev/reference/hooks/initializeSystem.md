---
title: "initializeSystem"
description: "initializeSystem hook"
tags: ["hook-system"]
---


The `initializeSystem` hook is triggered right after the system initialization
process is finished and before the request processing is started.


## Example

```php
// src/App/EventListener/InitializeSystemListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class InitializeSystemListener
{
    /**
     * @Hook("initializeSystem")
     */
    public function onInitializeSystem(): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Framework\ContaoFramework#L373-L377](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Framework/ContaoFramework.php#L373-L377)

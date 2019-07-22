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

class InitializeSystemListener
{
    public function onInitializeSystem(): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\InitializeSystemListener:
    public: true
    tags:
      - { name: contao.hook, hook: initializeSystem, method: onInitializeSystem }
```


## References

* [\Contao\CoreBundle\Framework\ContaoFramework#L373-L377](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Framework/ContaoFramework.php#L373-L377)

---
title: "loadDataContainer"
description: "loadDataContainer hook"
tags: ["hook-dca", "hook-system"]
---


The `loadDataContainer` hook is triggered when a DCA file is loaded. It passes
the file name as argument and does not expect a return value.

> #### primary:: Available   
> from Contao 2.8.2.


## Parameters

1. *string* `$table`

    Name of the data container to be loaded (e.g. `tl_content`).


## Example

```php
// src/App/EventListener/LoadDataContainerListener.php
namespace App\EventListener;

class LoadDataContainerListener
{
    public function onLoadDataContainer(string $table): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\LoadDataContainerListener:
    public: true
    tags:
      - { name: contao.hook, hook: loadDataContainer, method: onLoadDataContainer }
```


## References

- [\Contao\DcaLoader#L98-L106](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/DcaLoader.php#L98-L106)

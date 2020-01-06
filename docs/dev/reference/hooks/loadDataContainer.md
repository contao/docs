---
title: "loadDataContainer"
description: "loadDataContainer hook"
tags: ["hook-dca", "hook-system"]
aliases:
    - /reference/hooks/loadDataContainer/
    - /reference/hooks/loaddatacontainer/
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
// src/EventListener/LoadDataContainerListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class LoadDataContainerListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("loadDataContainer")
     */
    public function onLoadDataContainer(string $table): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\DcaLoader#L98-L106](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/DcaLoader.php#L98-L106)

---
title: "executePostActions"
description: "executePostActions hook"
tags: ["hook-dca"]
aliases:
    - /reference/hooks/customizeSearch/
    - /reference/hooks/customizesearch/
---


The `executePostActions` hook is triggered on Ajax requests that require a DCA 
object. It passes the name of the action and the data container object as arguments 
and does not expect a return value.


## Parameters

1. *string* `$action`

    The name of the action.

2. *\Contao\DataContainer* `$dc`

    Data container object of the current DCA instance.


## Example

```php
// src/EventListener/ExecutePostActionsListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\DataContainer;

#[AsHook('executePostActions')]
class ExecutePostActionsListener
{
    public function __invoke(string $action, DataContainer $dc): void
    {
        if ('update' === $action) {
            // Do something …
        }
    }
}
```


## References

* [\Contao\Ajax.php#L183](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L183)
* [\Contao\Ajax.php#L437-L439](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L437-L439)
* [\Contao\Ajax.php#L444-L459](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L444-L459)

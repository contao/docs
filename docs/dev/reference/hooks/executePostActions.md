---
title: "executePostActions"
description: "executePostActions hook"
tags: ["hook-dca"]
---

The `executePostActions` hook is triggered on Ajax requests that require a DCA 
object. It passes the name of the action and the data container object as arguments 
and does not expect a return value.

## Example

```php
// src/App/EventListener/ExecutePostActionsListener.php
namespace App\EventListener;

class ExecutePostActionsListener
{
    public function onExecutePostActions(string $action, \Contao\DataContainer $dc): void
    {
        if ('update' === $action) {
            // Do something …
        }
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ExecutePostActionsListener:
    public: true
    tags:
      - { name: contao.hook, hook: executePostActions, method: onExecutePostActions }
```

## References

* [\Contao\Ajax.php#L183](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L183)
* [\Contao\Ajax.php#L437-L439](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L437-L439)
* [\Contao\Ajax.php#L444-L459](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L444-L459)

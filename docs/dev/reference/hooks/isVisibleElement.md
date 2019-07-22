---
title: "isVisibleElement"
description: "isVisibleElement hook"
tags: ["hook-controller"]
---


The `isVisibleElement` hook is triggered when checking if an element should be
visible in the front end or not. An "element" in this case means either an article,
a front end module or a content element. In contrast to the other three hooks
`getArticle`, `getFrontendModule` and `getContentElement` one can prevent generating
the complete markup. The hook passes the model of the instance and the current
visibility state as arguments and expects the new visibility state as return value.


## Parameters

1. *Database_Result* `$element`

    The database result from table `tl_article` or `tl_content` or `tl_module`.

2. *boolean* `$isVisible`

    The current visibility state.


## Return Values

Add some custom checks and return `true`, if the element should be visible in the front end.
Return `false` if the element should not be visible in the front end.


## Example

```php
// src/App/EventListener/IsVisibleElementListener.php
namespace App\EventListener;

class IsVisibleElementListener
{
    public function onIsVisibleElement(object $element, bool $isVisible): bool
    {
        if ($element instanceof \Contao\ContentElement) {
            // Check if this content element can be shown
            if ($this->myElementCanBeShownInFrontend($element)) {
                return true;
            }
        }

        // Otherwise we don't want to change the visibility state
        return $isVisible;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\IsVisibleElementListener:
    public: true
    tags:
      - { name: contao.hook, hook: isVisibleElement, method: onIsVisibleElement }
```

## References

* [\Contao\Controller#L674-L681](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L674-L681)

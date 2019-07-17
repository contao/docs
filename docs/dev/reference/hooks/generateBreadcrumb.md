---
title: "generateBreadcrumb"
description: "generateBreadcrumb hook"
tags: ["hook-module", "hook-navigation"]
---

The `generateBreadcrumb` hook is used to manipulate the breadcrumb navigation 
(from breadcrumb front end module). It passes the breadcrumb items as an array
and the front end module object as arguments and expects an array (the breadcrumb
items) as return value.

## Example

```php
// src/App/EventListener/GenerateBreadcrumbListener.php
namespace App\EventListener;

class GenerateBreadcrumbListener
{
    public function onGenerateBreadcrumb(array $items, \Contao\Module $module): array
    {
        // Modify $items …

        return $items;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GenerateBreadcrumbListener:
    public: true
    tags:
      - { name: contao.hook, hook: generateBreadcrumb, method: onGenerateBreadcrumb }
```

## References

* [\Contao\ModuleBreadcrumb.php#L212-L220](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleBreadcrumb.php#L212-L220)

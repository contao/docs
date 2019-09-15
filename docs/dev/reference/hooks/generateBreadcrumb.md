---
title: "generateBreadcrumb"
description: "generateBreadcrumb hook"
tags: ["hook-module", "hook-navigation"]
---

The `generateBreadcrumb` hook is used to manipulate the breadcrumb navigation 
(from breadcrumb front end module). It passes the breadcrumb items as an array
and the front end module object as arguments and expects an array (the breadcrumb
items) as return value.


## Parameters

1. *array* `$items`

    The breadcrumb navigation items.

2. *\Contao\Modul* `$module`

    The front end module instance executing the hook.


## Return Values

An array containing associative array items with the following information
for the breadcrumb item:

* *bool* `isRoot` Whether this is the root item.
* *bool* `isActive` Whether this is an active item.
* *string* `href` The URL for this breadcrumb item.
* *string* `title` The title attribute for this breadcrumb item.
* *string* `link` The text for this breadcrumb item.
* *array* `data` Associative array containing the data of `tl_page`.
* *string* `class` The CSS classes for this breadcrumb item.


## Example

```php
// src/EventListener/GenerateBreadcrumbListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GenerateBreadcrumbListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("generateBreadcrumb")
     */
    public function onGenerateBreadcrumb(array $items, \Contao\Module $module): array
    {
        // Modify $items …

        return $items;
    }
}
```


## References

* [\Contao\ModuleBreadcrumb.php#L212-L220](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleBreadcrumb.php#L212-L220)

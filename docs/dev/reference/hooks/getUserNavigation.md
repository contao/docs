---
title: "getUserNavigation"
description: "getUserNavigation hook"
tags: ["hook-backend"]
aliases:
    - /reference/hooks/getUserNavigation/
    - /reference/hooks/getusernavigation/
---


The `getUserNavigation` hook allows to manipulate the back end user navigation.
It passes the back end modules and a flag wether to show collapsed navigation
items. Expects the array of modules as return value.


## Parameters

1. *array* `$modules`

    The compiled list of back end modules.

2. *boolean* `$showAll`

    Wether to show all modules even if the group is collapsed.


## Return Values

Add your custom modules to the list and return the array of back end modules.


## Example

```php
// src/EventListener/GetUserNavigationListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class GetUserNavigationListener
{
    /**
     * @Hook("getUserNavigation")
     */
    public function onGetUserNavigation(array $modules, bool $showAll): array
    {
        // Add custom navigation item to the Contao website
        $modules['system']['modules']['contao'] = [
            'label' => 'Contao homepage',
            'title' => 'Visit the Contao CMS website',
            'class' => 'navigation contao',
            'href' => 'https://contao.org/en/',
        ];

        return $modules;
    }
}
```


## References

* [\Contao\BackendUser#L538-L546](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/BackendUser.php#L538-L546)

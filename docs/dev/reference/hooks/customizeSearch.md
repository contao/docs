---
title: "customizeSearch"
description: "customizeSearch hook"
tags: ["hook-module", "hook-search"]
---

The `customizeSearch` hook is triggered when a user is using the search module
in the front end. With this hook you can customize which pages should get searched.
The hook passes the current page IDs as an array, the search keywords, the query 
type (`and` or `or`), whether the search is "fuzzy" and the module object as
arguments. The hook does not expect a return value.

## Example

```php
// src/App/EventListener/CustomizeSearchListener.php
namespace App\EventListener;

class CustomizeSearchListener
{
    public function onCustomizeSearch(array &$pageIds, string $keywords, string $queryType, bool $fuzzy, \Contao\Module $module): void
    {
        // Change the $pageIds array here or do some other adjustments …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CustomizeSearchHook:
    public: true
    tags:
      - { name: contao.hook, hook: customizeSearch, method: onCustomizeSearch }
```

## References

* [\Contao\ModuleSearch#L132-L140](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleSearch.php#L132-L140)

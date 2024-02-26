---
title: "newsListCountItems"
description: "newsListCountItems hook"
tags: ["hook-news", "hook-module"]
aliases:
    - /reference/hooks/newsListCountItems/
    - /reference/hooks/newslistcountitems/
---


When you use custom news sorting or filtering using the [`newsListFetchItems`](../newsListFetchItems)
hook, you might also need to use the `newsListCountItems` hook, so that the pagination
works correctly. With this hook you return the number of news items, that would
be shown in the current request.


## Parameters

1. *array* `$newsArchives`

    The IDs of the news archives shown in this news list.

2. *bool* `$featuredOnly`

    Whether or not to show only featured news.

3. *\Contao\Module* `$module`

    The front end module instance executing this hook.


## Return Values

Return `false` if this hook should not be considered. Return an integer otherwise. Return `0` if no news entries are found.

If the return value is other than `false`, no further hooks of type `newsListCountItems` will be executed!

## Example

```php
// src/EventListener/NewsListCountItemsListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Module;

#[AsHook('newsListCountItems')]
class NewsListCountItemsListener
{
    public function __invoke(array $newsArchives, bool $featuredOnly, Module $module)
    {
        if (…) {
            // Query the database and return the number of records
            return $numberOfRecords;
        }

        return false;
    }
}
```


## References

* [\Contao\ModuleNewsList#L173-L188](https://github.com/contao/contao/blob/5.3.0/news-bundle/contao/modules/ModuleNewsList.php#L173-L188)

---
title: "newsListFetchItems"
description: "newsListFetchItems hook"
tags: ["hook-news", "hook-module"]
---


This hook allows you to return a custom collection of `\Contao\NewsModel` instances
to be used by the news list module. It allows you to implement custom filtering or
sorting for a news list.


## Parameters

1. *array* `$newsArchives`

    The IDs of the news archives shown in this news list.

2. *bool* `$featuredOnly`

    Whether or not to show only featured news.

3. *int* `$limit`

    The limit as defined in the news list module.

4. *int* `$offset`

    The offset as defined in the news list module.

3. *\Contao\Module* `$module`

    The front end module instance executing this hook.


## Return Values

Return `false` if this hook should not be considered. Return a `\Contao\Model\Collection`
otherwise. Return `null` if no news entries are found.


## Example

```php
// src/EventListener/NewsListFetchItemsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class NewsListFetchItemsListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("newsListFetchItems")
     */
    public function onNewsListFetchItems(array $newsArchives, bool $featuredOnly, int $limit, int $offset, Module $module): mixed
    {
        if (…) {
            // Query the database and return the records
            return \Contao\NewsModel::findBy(…);
        }

        return false;
    }
}
```


## References

* [\Contao\ModuleNewsList#L200-L215](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/modules/ModuleNewsList.php#L200-L215)

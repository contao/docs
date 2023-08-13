---
title: "parseArticles"
description: "parseArticles hook"
tags: ["hook-news", "hook-template", "hook-module"]
aliases:
    - /reference/hooks/parseArticles/
    - /reference/hooks/parsearticles/
---


The `parseArticles` hook is triggered when parsing news articles. It passes the
front end template, the current article and the news module instance as arguments
and does not expect a return value.


## Parameters

1. *\Contao\FrontendTemplate* `$template`

    The front end template instance for the news article (e.g. `news_full`).

2. *array* `$newsEntry`

    The current news item database result.

3. *\Contao\Module* `$module`

    The module instance (e.g. `\Contao\ModuleNewsList`).


## Example

```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\UserModel;

#[AsHook('parseArticles')]
class ParseArticlesListener
{
    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Remove the default "by …" from Contao
        $template->author = UserModel::findByPk($newsEntry['author'])->name;
    }
}
```


## References

* [\Contao\ModuleNews#L217-L225](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/modules/ModuleNews.php#L217-L225)

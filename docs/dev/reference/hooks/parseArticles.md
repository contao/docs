---
title: "parseArticles"
description: "parseArticles hook"
tags: ["hook-news", "hook-template"]
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
// src/App/EventListener/ParseArticlesListener.php
namespace App\EventListener;

class ParseArticlesListener
{
    public function onParseArticles(\Contao\FrontendTemplate $template, array $newsEntry, \Contao\Module $module): void
    {
        // Remove the default "by …" from Contao
        $template->author = $newsEntry['author'];
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ParseArticlesListener:
    public: true
    tags:
      - { name: contao.hook, hook: parseArticles, method: onParseArticles }
```


## References

- [\Contao\ModuleNews#L217-L225](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/modules/ModuleNews.php#L217-L225)

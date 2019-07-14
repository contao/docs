---
title: "compileArticle"
description: "compileArticle hook"
tags: ["hook-module", "hook-template"]
---

The `compileArticle` hook is triggered after the article module has been compiled. 
It passes the template object, the module configuration, and the module object as 
arguments and does not expect a return value. It can be used e.g. to add additional 
data to the template.

## Example

```php
// src/App/EventListener/CompileArticleListener.php
namespace App\EventListener;

class CompileArticleListener
{
    public function onCompileArticle(\Contao\FrontendTemplate $template, array $data, \Contao\Module $module): string
    {
        $template->customContent = '<p>This will be available in mod_article.html5 via $this->customContent</p>';
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CompileArticleHook:
    public: true
    tags:
      - { name: contao.hook, hook: compileArticle, method: onCompileArticle }
```

## References

* [\Contao\ModuleArticle#L258-L266](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleArticle.php#L258-L266)

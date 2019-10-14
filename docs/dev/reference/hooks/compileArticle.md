---
title: "compileArticle"
description: "compileArticle hook"
tags: ["hook-module", "hook-template", "hook-article"]
---


The `compileArticle` hook is triggered after the article module has been compiled. 
It passes the template object, the module configuration, and the module object as 
arguments and does not expect a return value. It can be used e.g. to add additional 
data to the template.


## Parameters

1. *\Contao\FrontendTemplate* `$template`

    The current front end template instance for the article module

2. *array* `$data`

    An associative array with the module configuration

3. *\Contao\Module* `$module`

    The current module instance


## Example

```php
// src/EventListener/CompileArticleListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Contao\FrontendTemplate;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class CompileArticleListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("compileArticle")
     */
    public function onCompileArticle(FrontendTemplate $template, array $data, Module $module): void
    {
        $template->customContent = '<p>This will be available in mod_article.html5 via $this->customContent</p>';
    }
}
```


## References

* [\Contao\ModuleArticle#L258-L266](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleArticle.php#L258-L266)

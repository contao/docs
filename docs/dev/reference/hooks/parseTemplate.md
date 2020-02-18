---
title: "parseTemplate"
description: "parseTemplate hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/parseTemplate/
    - /reference/hooks/parsetemplate/
---


The `parseTemplate` hook is triggered before parsing a template. It passes the
template object and does not expect a return value.


## Parameters

1. *Template* `$template`

    The front end or back end template instance.


## Example

```php
// src/EventListener/ParseTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Template;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ParseTemplateListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("parseTemplate")
     */
    public function onParseTemplate(Template $template): void
    {
        if ('fe_page' === $template->getName()) {
            // Do something …
        }
    }
}
```


## References

* [\Contao\Template#L258-L266](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Template.php#L258-L266)

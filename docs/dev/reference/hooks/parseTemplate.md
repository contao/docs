---
title: "parseTemplate"
description: "parseTemplate hook"
tags: ["hook-template"]
---


The `parseTemplate` hook is triggered before parsing a template. It passes the
template object and does not expect a return value.


## Parameters

1. *Template* `$template`

    The front end or back end template instance.


## Example

```php
// src/App/EventListener/ParseTemplateListener.php
namespace App\EventListener;

class ParseTemplateListener
{
    public function onParseTemplate($template): void
    {
        if ('fe_page' === $template->getName() {
            // Do something …
        }
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ParseTemplateListener:
    public: true
    tags:
      - { name: contao.hook, hook: parseTemplate, method: onParseTemplate }
```


## References

- [\Contao\Template#L258-L266](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Template.php#L258-L266)

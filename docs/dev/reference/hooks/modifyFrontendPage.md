---
title: "modifyFrontendPage"
description: "modifyFrontendPage hook"
tags: ["hook-template"]
---


The `modifyFrontendPage` hook is triggered when a front end template is
printed to the screen. It passes the template content and the template name as
arguments and expects the template content as return value.

{{% notice note %}}
This hook is applied after insert tags have been
replaced. If you want to apply your logic before the replacement of
insert tags, use the [`outputFrontendTemplate`](../outputFrontendTemplate) hook instead.
{{% /notice %}}


## Parameters

1. *string* `$buffer`

    Content of the rendered front end template.

2. *string* `$templateName`

    The template name (e.g. `fe_page`) without file extension.


## Return Values

Return the original `$buffer` or override with your custom modification.


## Example


```php
// src/App/EventListener/ModifyFrontendPageListener.php
namespace App\EventListener;

class ModifyFrontendPageListener
{
    public function onModifyFrontendPage(string $buffer, string $templateName): string
    {
        if ('fe_page' === $templateName) {
            // Modify $buffer
        }

        return $buffer;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ModifyFrontendPageListener:
    public: true
    tags:
      - { name: contao.hook, hook: modifyFrontendPage, method: onModifyFrontendPage }
```


## References

* [\Contao\FrontendTemplate#L132-L140](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/FrontendTemplate.php#L132-L140)
* https://github.com/contao/core/issues/4291

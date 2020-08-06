---
title: "modifyFrontendPage"
description: "modifyFrontendPage hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/modifyFrontendPage/
    - /reference/hooks/modifyfrontendpage/
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
// src/EventListener/ModifyFrontendPageListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class ModifyFrontendPageListener
{
    /**
     * @Hook("modifyFrontendPage")
     */
    public function onModifyFrontendPage(string $buffer, string $templateName): string
    {
        if ('fe_page' === $templateName) {
            // Modify $buffer
        }

        return $buffer;
    }
}
```


## References

* [\Contao\FrontendTemplate#L132-L140](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/FrontendTemplate.php#L132-L140)
* https://github.com/contao/core/issues/4291

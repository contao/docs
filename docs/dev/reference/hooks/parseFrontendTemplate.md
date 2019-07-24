---
title: "parseFrontendTemplate"
description: "parseFrontendTemplate hook"
tags: ["hook-template"]
---


The `parseFrontendTemplate` hook is triggered when a front end template is
parsed. It passes the template content and the template name as arguments
and expects the template content as return value.


## Parameters

1. *string* `$buffer`

    Content of the parsed front end template.

2. *string* `$template`

    The template name (e.g. `nav_default`) without file extension.


## Return Values

Return the original `$buffer` or override the template with your custom
modification.


## Example

```php
// src/EventListener/ParseFrontendTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class ParseFrontendTemplateListener
{
    /**
     * @Hook("parseFrontendTemplate")
     */
    public function onParseFrontendTemplate(string $buffer, string $template): string
    {
        if ('ce_text' === $template) {
            // Modify $buffer
        }

        return $buffer;
    }
}
```


## References

* [\Contao\FrontendTemplate#L47-L55](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/FrontendTemplate.php#L47-L55)

---
title: "parseFrontendTemplate"
description: "parseFrontendTemplate hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/parseFrontendTemplate/
    - /reference/hooks/parsefrontendtemplate/
---


The `parseFrontendTemplate` hook is triggered when a front end template is
parsed. It passes the template content and the template name as arguments
and expects the template content as return value.


## Parameters

1. *string* `$buffer`

    Content of the parsed front end template.

2. *string* `$template`

    The template name (e.g. `nav_default`) without file extension.

3. {{< version-tag "4.9.21" >}} *\Contao\FrontendTemplate* `$template`

    The front end template instance.


## Return Values

Return the original `$buffer` or override the template with your custom
modification.


## Example

```php
// src/EventListener/ParseFrontendTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;

/**
 * @Hook("parseFrontendTemplate")
 */
class ParseFrontendTemplateListener
{
    public function __invoke(string $buffer, string $templateName, FrontendTemplate $template): string
    {
        if ('ce_text' === $templateName) {
            // Modify $buffer
        }

        return $buffer;
    }
}
```


## References

* [\Contao\FrontendTemplate#L45-L53](https://github.com/contao/contao/blob/1525618c3b8aea3c1aec97c3c1629f72475d93bd/core-bundle/src/Resources/contao/classes/FrontendTemplate.php#L45-L53)

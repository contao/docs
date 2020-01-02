---
title: "parseBackendTemplate"
description: "parseBackendTemplate hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/parseBackendTemplate/
    - /reference/hooks/parsebackendtemplate/
---


The `parseBackendTemplate` hook is triggered when a back end template is parsed.
It passes the template content and the template name as arguments and expects
the template content as return value.


## Parameters

1. *string* `$buffer`

    Content of the parsed back end template.

2. *string* `$template`

    The template name (e.g. `be_widget`) without file extension.


## Return Values

Return the original `$buffer` or override with your custom modification.


## Example

```php
// src/EventListener/ParseBackendTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ParseBackendTemplateListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("parseBackendTemplate")
     */
    public function onParseBackendTemplate(string $buffer, string $template): string
    {
        if ('be_main' === $template) {
            // Modify $buffer
        }

        return $buffer;
    }
}
```


## References

* [\Contao\BackendTemplate#L35-L43](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/BackendTemplate.php#L35-L43)

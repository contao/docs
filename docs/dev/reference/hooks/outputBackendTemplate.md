---
title: "outputBackendTemplate"
description: "outputBackendTemplate hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/outputBackendTemplate/
    - /reference/hooks/outputbackendtemplate/
---


The `outputBackendTemplate` hook is triggered when a back end template is printed
to the screen. It passes the template content and the template name as arguments
and expects the template content as return value.


## Parameters

1. *string* `$buffer`

    Content of the rendered back end template.

2. *string* `$template`

    The template name (e.g. `be_main`) without file extension.


## Return Values

Return the original `$buffer` or return your custom modification.


## Example

```php
// src/EventListener/OutputBackendTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class OutputBackendTemplateListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("outputBackendTemplate")
     */
    public function onOutputBackendTemplate(string $buffer, string $template): string
    {
        if ($template === 'be_main') {
            // Modify $buffer
        }

        return $buffer;
    }
```


## References

* [\Contao\BackendTemplate#L141-L149](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/BackendTemplate.php#L141-L149)

---
title: "outputBackendTemplate"
description: "outputBackendTemplate hook"
tags: ["hook-template"]
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
// src/App/EventListener/OutputBackendTemplateListener.php
namespace App\EventListener;

class OutputBackendTemplateListener
{
    public function onOutputBackendTemplate(string $buffer, string $template): string
    {
        if ($template === 'be_main') {
            // Modify $buffer
        }

        return $buffer;
    }
```

```yml
# config/services.yml
services:
  App\EventListener\OutputBackendTemplateListener:
    public: true
    tags:
      - { name: contao.hook, hook: outputBackendTemplate, method: onOutputBackendTemplate }
```


## References

- [\Contao\BackendTemplate#L141-L149](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/BackendTemplate.php#L141-L149)

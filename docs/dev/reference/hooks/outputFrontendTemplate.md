---
title: "outputFrontendTemplate"
description: "outputFrontendTemplate hook"
tags: ["hook-template"]
---


The `outputFrontendTemplate` hook is triggered when a front end template is
printed to the screen. It passes the template content and the template name as
arguments and expects the template content as return value. 

{{% notice note %}}
This hook is applied before the replacement of insert tags 
whereas the corresponding [`modifyFrontendPage`](../modifyFrontendPage) is applied after 
insert tags have been replaced.
{{% /notice %}}


## Parameters

1. *string* `$buffer`

    Content of the rendered front end template.

2. *string* `$template`

    The template name (e.g. `fe_page`) without file extension.


## Return Values

Return the original `$buffer` or override with your custom modification.


## Example

```php
// src/App/EventListener/OutputFrontendTemplateListener.php
namespace App\EventListener;

class OutputFrontendTemplateListener
{
    public function onOutputFrontendTemplate(string $buffer, string $template): string
    {
        if ($template === 'fe_page') {
            // Modify $buffer
        }

        return $buffer;
    }
```

```yml
# config/services.yml
services:
  App\EventListener\OutputFrontendTemplateListener:
    public: true
    tags:
      - { name: contao.hook, hook: outputFrontendTemplate, method: onOutputFrontendTemplate }
```


## References

- [\Contao\FrontendTemplate#L118-L126](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/FrontendTemplate.php#L118-L126)

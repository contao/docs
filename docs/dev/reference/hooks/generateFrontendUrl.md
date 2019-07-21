---
title: "generateFrontendUrl"
description: "generateFrontendUrl hook"
tags: ["hook-controller", "hook-page"]
---

The `generateFrontendUrl` hook is triggered when a front end URL is recreated. 
It passes the page object, the parameter string and the default URL as arguments 
and expects a string as return value.

{{% notice info %}}
'Using the `generateFrontendUrl` hook has been deprecated and will no longer work in Contao 5.0.'
{{% /notice %}}


## Example

```php
// src/App/EventListener/GenerateFrontendUrlListener.php
namespace App\EventListener;

class GenerateFrontendUrlListener
{
    public function onGenerateFrontendUrl(array $page, string $params, string $url): string
    {
        // Create or modify $url …

        return $url;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GenerateFrontendUrlListener:
    public: true
    tags:
      - { name: contao.hook, hook: generateFrontendUrl, method: onGenerateFrontendUrl }
```

## References

* [\Contao\Controller.php#L1163-L1170](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L1163-L1170)
* [\Contao\PageModel.php#L1140-L1151](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/models/PageModel.php#L1140-L1151)

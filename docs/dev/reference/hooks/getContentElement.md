---
title: "getContentElement"
description: "getContentElement hook"
tags: ["hook-controller"]
---

The `getContentElement` hook is triggered when a content element is rendered. 
It passes the database object, the buffer string and the content element object
as arguments and expects a buffer string as return value.

## Example

```php
// src/App/EventListener/GetContentElementListener.php
namespace App\EventListener;

class GetContentElementListener
{
    public function onGetContentElement(\Contao\ContentModel $contentModel, string $buffer, \Contao\ContentElement $contentElement): string
    {
        // Modify or create new $buffer here …

        return $buffer;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetContentElementHook:
    public: true
    tags:
      - { name: contao.hook, hook: getContentElement, method: onGetContentElement }
```

## References

* [\Contao\Controller#L476-L483](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L476-L483)

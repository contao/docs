---
title: "compareThemeFiles"
description: "compareThemeFiles hook"
tags: ["hook-theme"]
---

TODO

## Example

```php
// src/App/EventListener/CompareThemeFilesListener.php
namespace App\EventListener;

class CompareThemeFilesListener
{
    public function onCompareThemeFiles(\DOMDocument $xml, \Contao\ZipReader $zip): string
    {
        // Do something …
        
        return $label;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CompareThemeFilesHook:
    public: true
    tags:
      - { name: contao.hook, hook: compareThemeFiles, method: onCompareThemeFiles }
```

## References

* [\Contao\tl_log#L93-L101](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L278-L285)

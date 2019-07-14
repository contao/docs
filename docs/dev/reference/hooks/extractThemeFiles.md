---
title: "extractThemeFiles"
description: "extractThemeFiles hook"
tags: ["hook-theme"]
---

The `extractThemeFiles` hook is triggered on whenever a theme is extracted during
the theme import. The hook enables you to add execute additional logic (e.g. placing
additional files or executing additional database queries). It passes the XML object, 
the ZIP archive object, the theme's and the databse mapping data as arguments and 
expects no return value.

## Example

```php
// src/App/EventListener/ExtractThemeFilesListener.php
namespace App\EventListener;

class ExtractThemeFilesListener
{
    public function onExtractThemeFiles(\DOMDocument $xml, \Contao\ZipReader $zipArchive, int $themeId, array $mapper): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ExtractThemeFilesHook:
    public: true
    tags:
      - { name: contao.hook, hook: extractThemeFiles, method: onExtractThemeFiles }
```

## References

* [\Contao\Theme.php#L683-L692](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L683-L692)

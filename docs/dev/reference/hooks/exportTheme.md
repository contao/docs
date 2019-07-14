---
title: "exportTheme"
description: "exportTheme hook"
tags: ["hook-theme"]
---

The `exportTheme` hook is triggered on whenever a theme gets exported via the 
back end. The hook enables you to add additional data to the XML as well as the
ZIP archive. It passes the XML object, the ZIP archive object and the theme's 
id as arguments and expects no return value.

## Example

```php
// src/App/EventListener/ExportThemeListener.php
namespace App\EventListener;

class ExportThemeListener
{
    public function onExportTheme(\DOMDocument $xml, \Contao\ZipWriter $zipArchive, int $themeId): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ExportThemeHook:
    public: true
    tags:
      - { name: contao.hook, hook: exportTheme, method: onExportTheme }
```

## References

* [\Contao\Theme.php#L757-L764](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L757-L764)

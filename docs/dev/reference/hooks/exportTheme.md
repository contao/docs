---
title: "exportTheme"
description: "exportTheme hook"
tags: ["hook-theme"]
---

The `exportTheme` hook is triggered on whenever a theme gets exported via the 
back end. The hook enables you to add additional data to the XML as well as the
ZIP archive. It passes the XML object, the ZIP archive object and the theme's 
id as arguments and expects no return value.


## Parameters

1. *\DOMDocument* `$xml`

    The XML object containing the theme's data.

2. *\Contao\ZipWriter* `$zipArchive`

    The ZIP archive object containing the theme's files.

3. *int* `$themeId`

    The ID of the theme.


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
  App\EventListener\ExportThemeListener:
    public: true
    tags:
      - { name: contao.hook, hook: exportTheme, method: onExportTheme }
```


## References

* [\Contao\Theme.php#L757-L764](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L757-L764)
* https://github.com/contao/core/pull/7341

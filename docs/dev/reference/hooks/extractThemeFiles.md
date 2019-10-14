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


## Parameters

1. *\DOMDocument* `$xml`

    The XML object containing the theme's data.

2. *\Contao\ZipReader* `$zipArchive`

    The ZIP archive object containing the theme's files.

3. *int* `$themeId`

    The ID of the theme.

4. *array* `$mapper`

    Database mapping data.


## Example

```php
// src/EventListener/ExtractThemeFilesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ZipReader;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ExtractThemeFilesListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("extractThemeFiles")
     */
    public function onExtractThemeFiles(\DOMDocument $xml, ZipReader $zipArchive, int $themeId, array $mapper): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\Theme.php#L683-L692](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L683-L692)
* https://github.com/contao/core/pull/7341

---
title: "loadLanguageFile"
description: "loadLanguageFile hook"
tags: ["hook-system"]
aliases:
    - /reference/hooks/loadLanguageFile/
    - /reference/hooks/loadlanguagefile/
---


The `loadLanguageFile` hook is triggered when a language file is loaded. It
passes the file name and the language as arguments and does not expect a
return value.


## Parameters

1. *string* `$name`

    The language file to be loaded (e.g. `tl_content`), without file extension.

2. *string* `$currentLanguage`

    The language, usually the same as `$GLOBALS['TL_LANGUAGE']` but the call to
    `\Contao\System::loadLanguageFile` accepts a language parameter.

3. *string* `$cacheKey`

    The internal cache key.


## Example

```php
// src/EventListener/LoadLanguageFileListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("loadLanguageFile")
 */
class LoadLanguageFileListener
{
    public function __invoke(string $name, string $currentLanguage, string $cacheKey): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\System#L438-L445](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/System.php#L438-L445)

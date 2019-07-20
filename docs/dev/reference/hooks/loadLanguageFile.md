---
title: "loadLanguageFile"
description: "loadLanguageFile hook"
tags: ["hook-system"]
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
// src/App/EventListener/LoadLanguageFileListener.php
namespace App\EventListener;

class LoadLanguageFileListener
{
    public function onLoadLanguageFile(string $name, string $currentLanguage, string $cacheKey): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\LoadLanguageFileListener:
    public: true
    tags:
      - { name: contao.hook, hook: loadLanguageFile, method: onLoadLanguageFile }
```


## References

- [\Contao\System#L438-L445](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/System.php#L438-L445)

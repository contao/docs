---
title: "getCombinedFile"
description: "getCombinedFile hook"
---

The `getCombinedFile` hook is triggered when combining CSS or JavaScript files. 
It passes the file content, a unique key for the temporary file, the mode (e.g. 
`'.js'` or `'.css'`) and an array containing information about the file and expects 
the content as return value.

## Example

```php
// src/App/EventListener/GetCombinedFileListener.php
namespace App\EventListener;

class GetCombinedFileListener
{
    public function onGetCombinedFile(string $content, string $key, string $mode, array $file): string
    {
        // Modify $content here …

        return $content;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetCombinedFileHook:
    public: true
    tags:
      - { name: contao.hook, hook: getCombinedFile, method: onGetCombinedFile }
```

## References

* [\Contao\Combiner#L341-L349](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Combiner.php#L341-L349)

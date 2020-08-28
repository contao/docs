---
title: "getCombinedFile"
description: "getCombinedFile hook"
aliases:
    - /reference/hooks/getCombinedFile/
    - /reference/hooks/getcombinedfile/
---


The `getCombinedFile` hook is triggered when combining CSS or JavaScript files. 
It passes the file content, a unique key for the temporary file, the mode (e.g. 
`'.js'` or `'.css'`) and an array containing information about the file and expects 
the content as return value.


## Parameters

1. *string* `$content`

    Content of the file which will be added to the combiner.

2. *string* `$key`

    A unique key that represents the current combiner. A file with this name will
    be stored in `system/scripts/`.

3. *string* `$mode`

    The combiner mode (constant), either `Combiner::CSS` or `Combiner::JS`.

4. *array* `$file`

    Detailed information about the file to be combined.


## Return Values

The contents of the combined file as a string.


## Example

```php
// src/EventListener/GetCombinedFileListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("getCombinedFile")
 */
class GetCombinedFileListener
{
    public function __invoke(string $content, string $key, string $mode, array $file): string
    {
        // Modify $content here …

        return $content;
    }
}
```


## References

* [\Contao\Combiner#L341-L349](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Combiner.php#L341-L349)

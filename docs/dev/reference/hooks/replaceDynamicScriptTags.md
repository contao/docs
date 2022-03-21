---
title: "replaceDynamicScriptTags"
description: "replaceDynamicScriptTags hook"
tags: ["hook-controller"]
aliases:
    - /reference/hooks/replaceDynamicScriptTags/
    - /reference/hooks/replacedynamicscripttags/
---


This hook is executed before Contao replaces the so called "script tags", i.e.

- `[[TL_JQUERY]]`
- `[[TL_MOOTOOLS]]`
- `[[TL_BODY]]`
- `[[TL_CSS]]`
- `[[TL_HEAD]]`

These tags will be replaced according to the global arrays containing all the necessary
JavaScript & CSS files etc. for the current page.

The hook allows you to replace these script tags yourself, or execute other custom
code before the replacement.

{{% notice info %}}
Since Contao 4.13 a nonce value is added to the tag names resulting in tag names like `[[TL_CSS_686b97e15f9e04213c87e53db3d7a8bd]]`. The nonce value value can be retrieved from `ContaoFramework::getNonce()`.
{{% /notice %}}


## Parameters

1. *string* `$buffer`

    The buffer containing the current page output, with the dynamic script tags 
    still in place.


## Return Values

A string containing the (modified) bufffer content.


## Example

```php
// src/EventListener/ReplaceDynamicScriptTagsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("replaceDynamicScriptTags")
 */
class ReplaceDynamicScriptTagsListener
{
    public function __invoke(string $buffer): string
    {
        $nonce = '';
        if (method_exists(ContaoFramework::class, 'getNonce')) {
            $nonce = '_'.ContaoFramework::getNonce();
        }
        return str_replace("[[TL_CSS$nonce]]", "[[TL_CSS$nonce]]".'<link rel="stylesheet" href="assets/custom.css">', $buffer);
    }
}
```


## References

* [\Contao\Controller#L710-L717](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L710-L717)

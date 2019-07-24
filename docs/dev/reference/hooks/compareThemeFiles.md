---
title: "compareThemeFiles"
description: "compareThemeFiles hook"
tags: ["hook-theme"]
---


When importing a theme Contao will show you a comparison about which database
fields are currently missing in the Contao installation and which template files
will be overwritten etc. The `compareThemeFiles` hook allows you to do additional
comparisons and show the user the appropriate HTML output.


## Parameters

1. *\DOMDocument* `$xml`

    The XML object containing the theme's data.

2. *\Contao\ZipReader* `$zip`

    The ZIP archive object containing the theme's files.


## Return Values

A string containing additional HTML for the back end, showing the user the result
of the custom comparison. Or an empty string.


## Example

```php
// src/App/EventListener/CompareThemeFilesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class CompareThemeFilesListener
{
    /**
     * @Hook("compareThemeFiles")
     */
    public function onCompareThemeFiles(\DOMDocument $xml, \Contao\ZipReader $zip): string
    {
        // Execute your custom theme comparison
        if ($this->doCustomComparison()) {
            return $customComparison;
        }
        
        return '';
    }
}
```


## References

* [\Contao\Theme.php#L278-L285](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Theme.php#L278-L285)
* https://github.com/contao/core/pull/7341

---
title: "generateXmlFiles"
description: "generateXmlFiles hook"
tags: ["hook-automator"]
aliases:
    - /reference/hooks/generateXmlFiles/
    - /reference/hooks/generatexmlfiles/
---


The `generateXmlFiles` hook is triggered when the XML files are (re)generated e.g. 
by clicking "System » Maintenance » Recreate the XML files" in the back end. 
It has no parameters and does not expect a return value.


## Example

```php
// src/EventListener/GenerateXmlFilesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("generateXmlFiles")
 */
class GenerateXmlFilesListener
{
    public function __invoke(): void
    {
        // Do something …
    }
}
```

* [\Contao\Calendar.php#L58-L77](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Calendar.php#L58-L77)
* [\Contao\News.php#L58-L77](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/classes/News.php#L58-L77)


## References

* [\Contao\Automator.php#L412-L420](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Automator.php#L412-L420)

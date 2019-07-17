---
title: "generateXmlFiles"
description: "generateXmlFiles hook"
tags: ["hook-automator"]
---

The `generateXmlFiles` hook is triggered when the XML files are (re)generated e.g. 
by clicking "System » Maintenance » Recreate the XML files" in the back end. 
It has no parameters and does not expect a return value.

## Example

```php
// src/App/EventListener/GenerateXmlFilesListener.php
namespace App\EventListener;

class GenerateXmlFilesListener
{
    public function onGenerateXmlFiles(): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GenerateXmlFilesListener:
    public: true
    tags:
      - { name: contao.hook, hook: generateXmlFiles, method: onGenerateXmlFiles }
```

* [\Contao\Calendar.php#L58-L77](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Calendar.php#L58-L77)
* [\Contao\News.php#L58-L77](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/classes/News.php#L58-L77)

## References

* [\Contao\Automator.php#L412-L420](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Automator.php#L412-L420)

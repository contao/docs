---
title: "Changing Translations"
description: "Changing label translations for specific languages."
weight: 500
aliases:
  - /getting-started/translations/
---


Another common task is to change existing translations and labels for the front 
or back end. Any translation changes or additional translations are done in the
`contao/languages/<language>/` folder. Within each language's folder a file needs
to be created according to the translation's _domain_.

Assume you want to change the translation of _"Read more …"_ for the English language
(used for the detail link of a news or calendar entry for example) to just _"more"_. 
The translation key for this particular label is `MSC.more` in the `default` translation 
domain. Thus you need to create a file with the following content:

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['MSC']['more'] = 'more';
```

Alternatively you can also create an XLIFF file (`.xlf`) instead of using the PHP
array notation. Finding the right translation key and domain can only be done by 
searching through the source of the translations. Read more about translations in 
the [framework documentation][1].


Next: [implementing your first Hook][2].


[1]: /framework/translations/
[2]: /getting-started/hook/

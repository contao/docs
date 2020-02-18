---
title: "addCustomRegexp"
description: "addCustomRegexp hook"
tags: ["hook-custom", "hook-widget"]
aliases:
    - /reference/hooks/addCustomRegexp/
    - /reference/hooks/addcustomregexp/
---


The `addCustomRegexp` hook is triggered when an unknown regular expression is 
found. It passes the name of the regexp, the current value and the widget 
object as arguments and expects a boolean return value. If you return `true`,
the result of the hook will be final and no other hooks of the same type will
be executed. If you return `false`, other hooks will continue to process the
regular expression.


## Parameters

1. *string* `$regexp`

    The unknown regular expression string.

2. `$input`

    The input value to be validated.

3. *\Contao\Widget* `$widget`

    Form widget which is handling this input value.
    Use the widget's properties to retrieve information about the field configuration.


## Return Values

If you return `true`, no other hooks of the same type will be executed further. If
you return `false`, other hooks will continue to process the regular expression.


## Example

```php
// src/EventListener/AddCustomRegexpListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Widget;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class AddCustomRegexpListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("addCustomRegexp")
     */
    public function onAddCustomRegexp(string $regexp, $input, Widget $widget): bool
    {
        if ('myregexp' === $regexp) {
            // Do something …

            return true;
        }

        // Next example: check german PLZ.
        if ('plz' === $regexp) {
            $regexp = '\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b';
            if (!preg_match('/' . $regexp . '/', $input)) {
                $widget->addError('Field ' . $widget->label . ' should be a postal code.');
            }

            return true;
        }

        return false;
    }
}
```

If the Regexp check is to be available as a selection in a form in the text
widget, the following DCA files must also be created:

```php
// src/Resources/contao/dca/tl_form_field.php
$GLOBALS['TL_DCA']['tl_form_field']['fields']['rgxp']['options'][] = 'plz';
```

and add a language key:

```php
// src/Resources/contao/languages/en/tl_form_field.php
$GLOBALS['TL_LANG']['tl_form_field']['plz'] = ['PLZ', 'Enter a valid postal code.'];
```

## References

* [\Contao\Widget#L1078-L1094](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L1078-L1094)

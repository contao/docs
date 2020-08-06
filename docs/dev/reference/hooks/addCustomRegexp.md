---
title: "addCustomRegexp"
description: "addCustomRegexp hook"
tags: ["hook-custom", "hook-widget"]
aliases:
    - /reference/hooks/addCustomRegexp/
    - /reference/hooks/addcustomregexp/
---


The `addCustomRegexp` hook is triggered when an unknown validation option (`rgxp`)
is found. These validation options can be used for DCA fields in the back end, but
also for text fields of the form generator in the front end.

The hook passes the name of the `rgxp`, the current value and the widget 
object as arguments and expects a boolean return value. If you return `true`,
the result of the hook will be final and no other hooks of the same type will
be executed. If you return `false`, other hooks will continue to process the
regular expression.

If the given value should not validate according to the given custom validation
type, an error must be added to the passed widget via `$widget->addError(…)`.


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

The following example implements a check for a German postal code.

```php
// src/EventListener/AddCustomRegexpListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Widget;

class AddCustomRegexpListener
{
    /**
     * @Hook("addCustomRegexp")
     */
    public function onAddCustomRegexp(string $regexp, $input, Widget $widget): bool
    {
        if ('plz' === $regexp) {
            $exp = '\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b';
 
            if (!preg_match('/' . $exp . '/', $input)) {
                $widget->addError('Invalid postal code.');
            }

            return true;
        }

        return false;
    }
}
```

To make this check available in the validation options of the form element in the 
form generator, the DCA of `tl_form_field` must be extended in the following way:

```php
// contao/dca/tl_form_field.php
$GLOBALS['TL_DCA']['tl_form_field']['fields']['rgxp']['options'][] = 'plz';
```

The following also adds a translation for this validation option in the back end:

```php
// contao/languages/en/tl_form_field.php
$GLOBALS['TL_LANG']['tl_form_field']['plz'] = ['PLZ', 'Enter a valid postal code.'];
```


## References

* [\Contao\Widget#L1078-L1094](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L1078-L1094)

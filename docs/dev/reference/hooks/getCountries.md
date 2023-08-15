---
title: "getCountries"
description: "getCountries hook"
tags: ["hook-config", "hook-system"]
aliases:
    - /reference/hooks/getCountries/
    - /reference/hooks/getcountries/
---


The `getCountries` hook allows to modify the system's list of countries.

{{% notice info %}}
Using the `getCountries` hook has been deprecated and will no longer work in Contao 5.0. Decorate the `Contao\CoreBundle\Intl\Countries` 
service instead.
{{% /notice %}}


## Parameters

1. *array* `$translatedCountries`

    The array containing the countries as filled by `\Contao\System::getCountries()` according to the 
    system's configuration. This parameter has to be passed by reference if you want your changes
     to become effective.

2. *array* `$allCountries`

    The list of countries from the system config file `countries.php`.


## Example

```php
// src/EventListener/GetCountriesListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('getCountries')]
class GetCountriesListener
{
    public function __invoke(array &$translatedCountries, array $allCountries): void
    {
        // Codes for the european countries
        $europeanCountryCodes = ['de', 'at', 'ch' /*, … */];
    
        // Remove all non-european countries
        $translatedCountries = array_intersect_key($translatedCountries, array_flip($europeanCountryCodes));
    }
}
```


## References

* [\Contao\System#L521-L528](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/System.php#L521-L528)
* [countries.php](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/config/countries.php)

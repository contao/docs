---
title: "setCookie"
description: "setCookie hook"
tags: ["hook-system"]
aliases:
    - /reference/hooks/setCookie/
    - /reference/hooks/setcookie/
---


The `setCookie` hook is triggered when sending a cookie to the browser. It passes
a standard object with all cookie properties and expects the same as return value.


## Parameters

1. *object* `$cookie`

    A stdClass instance that contains the properties of the cookie. See PHP's
    [setcookie](http://php.net/setcookie) documentation for detailed information.
    - $cookie->strName       *– the cookie name*
    - $cookie->varValue      *– the cookie value*
    - $cookie->intExpires    *– the expiration time (in seconds, from now)*
    - $cookie->strPath       *– the relative path (if Contao is installed in a subfolder)*
    - $cookie->strDomain     *– the current domain for the cookie*
    - $cookie->blnSecure     *– if the cookie should only be stored for https access*
    - $cookie->blnHttpOnly   *– if the httponly flag should be set*


## Return Values

Return `$cookie` or a custom object with all properties.


## Example

```php
// src/EventListener/SetCookieListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('setCookie')]
class SetCookieListener
{
    public function __invoke($cookie)
    {
        // Make sure the cookie is also valid for the whole domain
        $cookie->strPath = '/';

        return $cookie;
    }
}
```


## References

* [\Contao\System#L664-L671](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/System.php#L664-L671)

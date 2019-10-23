---
title: "Back End Modules"
description: Writing a back end module for Contao
---

A back end module in Contao is essentially a new back end navigation entry.
So by default, Contao ships with a few back end modules pre-installed:

* Content
    * Articles
    * Form generator
* Layout
    * Themes
    * Site structure
* [...]

The first level ("Content" and "Layout" in that example) represent what we call "categories".
The second level are the back end modules.

Historically, back end modules have always existed in Contao so registering a new one is done
by extending the `$GLOBALS['BE_MOD']` array:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['my_module'] = [
    'tables' => ['tl_my_module'],
];
```

As you can see, we're extending the `content` category by a new module called `my_module`.
Adding the translation for your new `my_module` is as simple as having a `modules.xlf` file
at `Resources/contao/languages/<ISO-language-key>/modules.xlf`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<xliff version="1.1">
  <file datatype="php" original="src/Resources/contao/languages/en/modules.php" source-language="en">
    <body>
      <trans-unit id="MOD.my_module.0">
        <source>My Module</source>
      </trans-unit>
      <trans-unit id="MOD.my_module.1">
        <source>Manage entries of my module</source>
      </trans-unit>
    </body>
  </file>
</xliff>
```

The `$GLOBALS['BE_MOD']` array takes a few different keys.
Here's a list of all the supported keys in no particular order:

* `tables`
* `stylesheet`
* `javascript`
* `callback`
* `disablePermissionChecks`
* `hideInNavigation`
* `<custom-key>`


The first key we're going to learn more about and which is likely also the most important one, is the `tables` key.
The back end of Contao is mainly designed to work on top of database tables although that's not required.
Basically, in our `my_module` example we've configured only one table called `tl_my_module`. So when the user clicks
on our newly created back end navigation module `My Module`, Contao loads the DCA file of `tl_my_module`. Depending on the
DCA you can determine what happens from then on. Checkout the [DCA documentation](./dca.md) and
the [DCA reference](../reference/dca) for more information.

The `tables` key takes an array because if that module manages multiple tables (so if your `tl_my_module` table e.g. had
child table definitions), they all have to be listed here.

Both, the `stylesheet` and `javascript` keys allow you to load additional CSS and/or JavaScript files whenever the user
works within the context of that back end module. Use them as follows:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['my_module'] = [
    'tables' => ['tl_my_module'],
    'javascript' => ['bundles/mymodule/scripts.js'],
    'stylesheet' => ['bundles/mymodule/styles.css'],
];
```

The `callback` key allows you to render whatever content you would like into the content window. It's a simple class
that expects to have a `public function generate()` that's then called like so:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['my_module'] = [
    'callback' => 'MyVendor/MyModule/MyClass'
];

// src/MyClass.php
namespace MyVendor/MyModule;

class MyClass
{
    public function generate()
    {
        return 'string content';
    }
}
```

This is a very simple, old and thus not very flexible way of specifying your own output. If you would like to use
Dependency Injection etc. you're likely better off using [Custom back end routes](../../guides/backend-routes.md).

Both, the `disablePermissionChecks` and the `hideInNavigation` just take a boolean value. By default they are both set to
`false` which means, permission checks are always executed and the module is always shown in the navigation.
The permission check is referring to the user permission settings where you can restrict the access to certain modules for
certain users or user groups. However, if you set `disablePermissionChecks` to `true`, that module cannot be selected
in the permission settings and the checks are not executed. The Contao core uses this feature for example for the `undo`
module as every user has access to their own undo view.
The `hideInNavigation` may be useful if you want to develop a back end module but link to it from anywhere else but the
main back end navigation.

The `<custom-key>` may be used for any custom callback you want to have executed when the user requests a certain action.
Requesting a certain action is done by having `&key=foobar` in the query parameters.
As an example you might want to checkout the theme export functionality the Contao core provides. Every single theme
gets an export operation which is specified in the respective DCA file `tl_theme` as follows:

```php
// contao/dca/tl_theme.php
$GLOBALS['TL_DCA']['tl_theme']['list']['operations']['exportTheme'] = [
    'href' => 'key=exportTheme',
    [...]
];
```

As you can see, we're specifying `key=exportTheme` in the `href` section which will generate something
like `contao?do=themes&key=exportTheme&id=1...` for the theme with database ID 1. When the user now clicks on that link,
Contao searches for the key `exportTheme` in the back end module definition of `themes` and execute this callback.
The corresponding back end module definition thus looks like this:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['themes'] = [
    'exportTheme' => ['Contao\Theme', 'exportTheme'],
];
```

You don't have to specify a class name, you can also specify a service ID as the first array element.

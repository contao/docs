---
title: "Customize maintenance template"
description: "Customize maintenance template in an update-safe manner"
aliases:
    - /en/guides/customize-maintenance-template/
weight: 10
tags: 
   - "maintenance template"
---

## Activate maintenance mode

The maintenance mode can be activated via the menu item System Maintenance. As soon as you log out of the backend and open your website in the frontend, it will look like this:

![Contao maintenance mode]({{% asset "images/manual/guides/de/maintenance/wartungsmodus.jpg" %}}?classes=shadow)

In the core of Contao 4.9, the following files are responsible for the frontend output in maintenance mode:

- `service_unavailable.html.twig` - maintenance template
- `layout.html.twig` - layout template for all error templates
- `exception.xlf` - language files for error messages


## Adapt texts of the maintenance template

We first want to customize the text output for the maintenance mode.

The text output for the maintenance page is controlled by language variables. You can find the original language files at:
`vendor/contao/core-bundle/src/Resources/contao/languages`.

For all error messages this is the file `exception.xlf`.

We will first take a closer look at the maintenance template `service_unavailable.html.twig`.

```html
{% trans_default_domain 'contao_exception' %}
{% extends "@ContaoCore/Error/layout.html.twig" %}
{% block title %}
{{ 'XPT.unavailable'|trans }}
{% endblock %}
{% block matter %}
<p>{{ 'XPT.maintenance'|trans }}</p>
{% endblock %}
```

There we find the language variable `XPT.unavailable` and `XPT.maintenance`. Now we look for these in the `exception.xlf`.

Now we create a new file named `exception.xlf` and put it under `/contao/languages/en/`, copy the needed lines from the original `exception.xlf` and adjust the texts according to our wishes.

{{% notice note %}}
If the folder `/contao` does not exist yet, you have to create it and the corresponding subfolders.
{{% /notice %}}

Example of a customized language file:

```xml
<?xml version="1.0" ?><xliff version="1.1">
  <file>
    <body>
      <trans-unit id="XPT.unavailable">
        <target>Maintenance mode</target>
      </trans-unit>
      <trans-unit id="XPT.maintenance">
        <target>Therefore, the website is currently unavailable. Please try again later. We will try to finish the maintenance work as soon as possible.</target>
      </trans-unit>
    </body>
  </file>
</xliff>
```

Alternatively, you can also use the PHP notation. To do this, you create an exception.php, which then looks something like this:

```php
$GLOBALS['TL_LANG']['XPT']['unavailable'] = 'Maintenance mode';
$GLOBALS['TL_LANG']['XPT']['maintenance'] = 'Therefore, the website is currently unavailable. Please try again later. We will try to finish the maintenance work as soon as possible.';
```

To make the new texts visible now, the production cache must be cleared via the Contao Manager or the command line.

Of course, other texts such as the footer can also be overwritten via `XPT.hint`.

{{% notice note %}}
IMPORTANT: All changes affect the maintenance template as well as all other error templates of Contao.
{{% /notice %}}


## Customize logo

In this example we do this for all error templates. For an update-safe adaptation we copy the original template `vendor/contao/core-bundle/src/Resources/views/Error/layout.html.twig` to `/templates/bundles/ContaoCoreBundle/Error/`.

{{< version-tag "5.1" >}} the original template is located at `vendor/contao/core-bundle/templates/Error/layout.html.twig`

There we put our own logo inside the DIV with the class `header-logo`. You can use a normal image tag for this or an inline SVG like in the original template.

Example of a customized logo:

```html
{% trans_default_domain 'contao_exception' %}
<!DOCTYPE html>
<html lang="{{ language }}">
...
<body>
<div id="header">
    <div class="wrap">
        <div class="header-logo">
            <img src="/files/layout/images/logo.png" alt="My logo">
        </div>
    </div>
</div>
...
</body>
</html>
```

To make the changes visible, you have to clear the production cache via the Contao Manager or the command line.

For more information about customizing Twig templates, please refer to the [Twig documentation of Symfony](https://twig.symfony.com/doc/3.x/).


## Overwrite complete service template

Instead of just changing some texts, you can simply overwrite the whole template `service_unavailable.html.twig` with your own HTML and CSS.
To make the whole thing update-safe, you have to save the file in the folder `/templates/bundles/ContaoCoreBundle/Error/`.

Finally you have to refresh the production cache.

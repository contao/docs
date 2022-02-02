---
title: "Extensions"
description: "Twig Extensions."
url: "layout/templates/twig/extensions"
aliases:
    - /en/layout/templates/twig/extensions/
weight: 90
---


In Twig you can easily use extensions. The Contao core for instance
uses the [KnpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle) to format dates/time in a nice way ("5 minutes ago").
As this bundle provides a Twig extension with an `|ago` filter, you can
directly use this functionality in your templates:  

```twig
<p>Last edited: {{ modified_at|ago }}</p>

{# <p>Last edited: 5 minutes ago</p> #}
```


### Using twig-extra bundles

In fact, there are already a lot of Twig extensions in the wild, including some
[official ones](https://github.com/twigphp/Twig/tree/3.x/extra). These "[twig-extra](https://extensions.contao.org/?q=twig&pages=1)" bundles 
can simply be installed with composer or with the Contao Manager (see [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)) 
and are directly ready to be used.

```twig
{# using twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}

{# €1,000,000.00 #}
```
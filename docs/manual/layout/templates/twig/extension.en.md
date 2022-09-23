---
title: "Twig Extensions"
description: "Details about Twig Extensions."
url: "layout/templates/twig/extensions"
aliases:
    - /en/layout/templates/twig/extensions/
weight: 90
---


You can use Twig extensions without any problems. The Contao core for instance uses the [KnpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle) 
to format dates/time in a nice way.


## Using twig-extra bundles

In fact, there are already a lot of Twig extensions in the wild, including some
[official ones](https://github.com/twigphp/Twig/tree/3.x/extra). These "[twig-extra](https://extensions.contao.org/?q=twig&pages=1)" bundles 
can simply be installed with composer or with the Contao Manager (see [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)) 
and are ready to be used.

```twig
{# need twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}
{# 1,000,000.00 € #}
```
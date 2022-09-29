---
title: "Twig Extensions"
description: "Details about Twig Extensions."
url: "layout/templates/twig/extensions"
aliases:
    - /en/layout/templates/twig/extensions/
weight: 90
---


Extension developers can easily add more features to Twig, that you can then use in every template. This typically includes new `|filters` and `functions()`.


## Using twig-extra bundles

In fact, there are already some [offical extensions by the Twig project](https://github.com/twigphp/Twig/tree/3.x/extra) 
called the "[twig-extra](https://extensions.contao.org/?q=twig&pages=1)" bundles which can be installed with composer or the 
Contao Manager (see [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)).

```twig
{# after installing twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}
{# 1,000,000.00 € #}
```

{{% notice tip %}}
The command `vendor/bin/contao-console debug:twig` shows you, among other things, a list of available Twig functions and filters.
{{% /notice %}}
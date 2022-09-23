---
title: "Twig Erweiterungen"
description: "Informationen zu offiziellen Twig Erweiterungen."
url: "layout/templates/twig/extensions"
aliases:
    - /de/layout/templates/twig/extensions/
weight: 90
---


Du kannst problemlos Twig Erweiterungen verwenden. Der Contao-Kern beinhaltet beispielsweise das 
[KnpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle), um Datums- und Zeitangaben zu formatieren.


## Weitere Erweiterungen verwenden

Tatsächlich gibt es bereits eine Menge Twig-Erweiterungen, darunter einige
[offizielle](https://github.com/twigphp/Twig/tree/3.x/extra). Diese »[twig-extra](https://extensions.contao.org/?q=twig&pages=1)« Bundles 
können einfach mit Composer oder über den Contao Manager (siehe [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)) 
installiert werden und sind dann einsatzbereit.

```twig
{# needs twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}
{# 1,000,000.00 € #}
```
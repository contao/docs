---
title: "Twig Erweiterungen"
description: "Informationen zu offiziellen Twig Erweiterungen."
url: "layout/templates/twig/extensions"
aliases:
    - /de/layout/templates/twig/extensions/
weight: 90
---


In Twig kannst du problemlos Erweiterungen verwenden. Der Contao-Kern beinhaltet beispielsweise das 
[KnpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle), um Datums- und Zeitangaben zu formatieren ("vor 5 Minuten").
Da dieses Bundle eine Twig-Erweiterung mit einem `|ago`-Filter bereitstellt, kannst du diese Funktionalität direkt im Templates verwenden:

```twig
<p>Last edited: {{ modified_at|ago }}</p>

{# <p>Last edited: 5 minutes ago</p> #}
```


### Weitere Erweiterungen verwenden

Tatsächlich gibt es bereits eine Menge Twig-Erweiterungen, darunter einige
[offizielle](https://github.com/twigphp/Twig/tree/3.x/extra). Diese »[twig-extra](https://extensions.contao.org/?q=twig&pages=1)« Bundles 
können einfach mit Composer oder über den Contao Manager (siehe [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)) 
installiert werden und sind dann einsatzbereit.

```twig
{# using twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}

{# €1,000,000.00 #}
```
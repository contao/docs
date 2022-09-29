---
title: "Twig Erweiterungen"
description: "Informationen zu offiziellen Twig Erweiterungen."
url: "layout/templates/twig/extensions"
aliases:
    - /de/layout/templates/twig/extensions/
weight: 90
---


Entwickler können Twig problemlos weitere Funktionen hinzufügen, die du in jeder Vorlage verwenden kanst. Dazu gehören typischerweise 
neue `|filter` und `funktionen()`.


## Weitere Erweiterungen verwenden

Tatsächlich gibt es bereits einige [offizielle Erweiterungen des Twig-Projekts](https://github.com/twigphp/Twig/tree/3.x/extra) 
namens "[twig-extra](https://extensions.contao.org/?q=twig&pages=1)", die mit Composer oder dem Contao Manager installiert werden können 
(siehe [extensions.contao.org](https://extensions.contao.org/?q=twig&pages=1)).

```twig
{# after installing twig/intl-extra #}

{{ '1000000'|format_currency('EUR') }}
{# 1,000,000.00 € #}
```

{{% notice tip %}}
Der Befehl `vendor/bin/contao-console debug:twig` zeigt dir u. a. eine Liste der verfügbaren Twig Funktionen und Filter an.
{{% /notice %}}
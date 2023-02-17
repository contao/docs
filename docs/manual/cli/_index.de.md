---
title: "Kommandozeilenbefehle"
description: "Contao kennt die verschiedensten Kommandozeilenbefehle, die du für deine Anwendung nutzen kannst"
url: "cli"
aliases:
    - /de/cli/
weight: 91
---

Die Kommandozeile ist nicht furchteinflössend, sondern bietet dir eine Vielzahl an Möglichkeiten, um deine Produktivität
zu steigern. Der Contao Manager ist die grafische Oberfläche für unsere Kommandozeile. Es stehen im Contao Manager
aber nur ein Bruchteil aller in Contao implementierten Funktionen zur Verfügung.

Viele Befehle sind relativ selbsterklärend. Wie beispielsweise `contao:user:create` welcher dich einen Backend-Benutzer
anlegen lässt. Einfach aufrufen und den Anweisungen folgen.

Eine Liste aller zur Verfügung stehenden Befehle erhältst du so:

```bash
php vendor/bin/contao-console list
```

Du kannst ausserdem auch für jeden Befehl den Hilfetext anzeigen lassen. Bei `contao:user:create` würde das so aussehen:

```bash
php vendor/bin/contao-console contao:user:create --help
```


Manche Befehle bedürfen etwas ausführlicheren Erklärungen. Diese werden in diesem Kapitel entsprechend behandelt:

{{% children %}}

---
title: "Kommandozeilenbefehle"
description: "Contao kennt die verschiedensten Kommandozeilenbefehle, die du für deine Anwendung nutzen kannst"
url: "cli"
aliases:
    - /de/cli/
weight: 91
---

Die Kommandozeile braucht nicht furchteinflössend zu sein. Im Gegenteil, sie ist sogar sehr nützlich. Der Contao
Manager ist die grafische Oberfläche für unsere Kommandozeile. Folglich kann die Kommandozeile alles, was der Contao Manager
auch kann. Es ist andersrum: Der Manager bietet nur einen Bruchteil der Funktionen an, die auf der Kommandozeile zur
Verfügung stehen.

Viele Befehle sind relativ selbsterklärend. Wie beispielsweise `contao:user:create` welcher dich einen Backend-Benutzer
anlegen lässt. Einfach aufrufen und den Anweisungen folgen.

Für eine Liste aller zur Verfügung stehenden Befehle, kannst du folgenden Befehl ausführen:

```bash
vendor/bin/contao-console list
```

Du kannst ausserdem auch für jeden Befehl den Hilfetext anzeigen lassen. Bei `contao:user:create` würde das so aussehen:

```bash
vendor/bin/contao-console contao:user:create --help
```


Manche Befehle bedürfen etwas ausführlicheren Erklärungen. Diese werden in diesem Kapitel entsprechend behandelt:

{{% children %}}

---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/twig/data"
aliases:
    - /de/layout/templates/twig/data/
weight: 60
---


Die verfügbaren Template-Daten variieren je nach Quelle der Vorlage. Innerhalb von Twig-Templates kannst du dir alle verfügbaren oder 
gezielt einzelne Variablen anzeigen lassen.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```

{{% notice warning %}}
Dies funktioniert nur bei aktiviertem [Debug-Modus](/de/system/debug-modus/).
{{% /notice %}}


## Kommandozeilenbefehle für Twig

Auf der Kommandozeile findest du über den Befehl `vendor/bin/contao-console list debug` zwei nützliche Befehle hinsichtlich der 
Twig-Templates. 

{{% notice note %}}
Die Möglichkeiten können sich in den Contao Versionen unterscheiden. Zu jedem Befehl erhälst du daher Details über die verfügbaren 
Optionen mit der Angabe von `--help`. Du kannst darüber z. B. feststellen, das die Option `--tree` in `debug:contao-twig`, 
erst ab der Contao Version 5.0.2 unterstützt wird.
{{% /notice %}}


### debug:twig

Der Befehl zeigt dir u. a. eine Liste der verfügbaren Twig Funktionen und Filter an.

```bash
php vendor/bin/contao-console debug:twig --help
```


### debug:contao-twig

Der Befehl zeigt dir u. a. Details und weitere Infos bez. der Hierarchie deiner Templates an.

```bash
php vendor/bin/contao-console debug:contao-twig --help
```

{{% notice tip %}}
Beide Befehle unterstützen die Option `--env` zwecks Berücksichtigung der Umgebung: `prod` (Standard Einstelung) oder `dev`.
{{% /notice %}}
---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/twig/data"
aliases:
    - /de/layout/templates/twig/data/
weight: 60
---


Zur Anzeige der Daten in einer Vorlage (wir nennen es den »Kontext«), kannst du die Funktion `dump()` verwenden. 
Wenn du nur etwas über einen bestimmten Teil des »Kontext« wissen möchtest, kannst du diesen als Argument übergeben:

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```

{{% notice info %}}
Da die ausgewerteten Daten sicherheitskritische Informationen über das System enthalten können, ist dies nur möglich, wenn der 
[Debug-Modus](/de/system/debug-modus/) aktiviert ist.
{{% /notice %}}


## Kommandozeilenbefehle für Twig

Verwende die folgenden Befehle auf der Kommandozeile, um mehr über die aktuellen Twig Einstellungen herauszufinden:


### debug:contao-twig

Du kannst den Befehl `vendor/bin/contao-console debug:contao-twig` verwenden, um herauszufinden, welche Vorlagen verfügbar sind 
und im System verwendet werden. Durch die Übergabe eines Namenspräfix als Argument kannst du nach bestimmten Gruppen filtern: z. B. 
`vendor/bin/contao-console debug:contao-twig content_element/h` zeigt sowohl die `headline` als auch die `html` Vorlagen (und andere) an. 


{{% notice note %}}
Ab Contao 5.0.2 gibt es auch eine Option `--tree`, die die Vorlagen in Baumform der Verzeichnisstruktur folgend anzeigt. Dies ist 
besonders hilfreich, wenn es sich um Varianten handelt, die sich in Unterverzeichnissen befinden, wie `content_element/text/special.html.twig` 
oder `content_element/text/info.html.twig`. Die Filterung nach `content_element/text` gruppiert dann die `special` und `info` Variante unter 
der Standardvorlage `text`.
{{% /notice %}}


### debug:twig

Der Befehl `vendor/bin/contao-console debug:twig` zeigt dir u. a. eine Liste der verfügbaren Twig Funktionen und Filter an.


{{% notice tip %}}
Zu jedem Befehl erhältst du Details über die verfügbaren Optionen mit der Angabe von `--help`. Beide Befehle unterstützen die 
Option `--env` zwecks Berücksichtigung der Umgebung: `prod` (Standard Einstellung) oder `dev`.
{{% /notice %}}


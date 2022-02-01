---
title: "Debug-Modus"
description: "Der Debug-Modus ist während der Entwicklung der Web-Applikation hilfreich und nützlich, um Fehler zu finden."
weight: 30
url: "system/debug-modus"
aliases:
    - /de/system/debug-modus/
---


Während der Entwicklung der Web-Applikation kann es hilfreich sein, den sogenannten
»Debug-Modus« (auch _Entwickler Modus_ oder _Entwickler Umgebung_ genannt) zu aktivieren.
Damit kann zum Beispiel folgendes erreicht werden:

* Der Stack Trace von Fehlern wird ausgegeben.
* Der Seitencache wird nicht benutzt.
* Der Symfony Profiler und die Toolbar sind verfügbar.
* CSS und JavaScript Assets werden nicht kombiniert.
* Template Namen werden im HTML Quellcode als Kommentare ausgegeben.

## Zugriff auf den Debug-Modus

In Contao wird der Debug-Modus entweder über eine Umgebungsvariable
oder ein spezielles Cookie aktiviert.


### Umgebungsvariable

Die Umgebungsvariable, die den Debug-Modus steuert, heißt `APP_ENV` und der Inhalt
dieser Variable muss `dev` lauten, damit der Debug-Modus aktiviert ist. Diese Umgebungsvariable
könnte z. B. global im System gesetzt sein oder direkt im Web Server der jeweiligen
Web-Applikation. Eine weitere Möglichkeit ist, diese Umgebungsvariable über eine
`.env` Datei im Wurzelverzeichnis des Projektes zu setzen. Der Inhalt dieser Datei
muss dann so aussehen:

```none
APP_ENV=dev
```

Es ist auch möglich, eine (initial) leere `.env` Datei anzulegen und daneben eine
`.env.local` mit dem erwähnten Inhalt. Normalerweise würde man dann die `.env` Datei
in das Git Repository des jeweiligen Projektes committen, während man die `.env.local`
jedoch ignorieren lässt.

{{% notice warning %}}
Diese Datei auf _keinen Fall_ auf den Live Server kopieren! Das würde ein großes
Sicherheitsrisiko darstellen.
{{% /notice %}}

{{% notice info %}}
Auf gleichem Weg können weitere Umgebungsvariablen gesetzt werden. Eine Beschreibung der 
Variablen findet sich in der [Entwicklerdokumentation](/../dev/reference/config/#environment-variables-for-the-contao-managed-edition).
{{% /notice %}}


### Backend Einstellung

Der Debug-Modus kann von Administratoren auch über das Contao Backend aktiviert
werden. Dazu befindet sich ein Button gleich neben dem Vorschau Button. Dieser Button
setzt dann ein spezielles Cookie, welches den Debug-Modus nur für den aktuellen
Benutzer aktiviert.

{{% notice info %}}
Der Button wird nur angezeigt, wenn du keine App Umgebung in deiner `.env` Datei definiert hast. 
{{% /notice %}}


## Symfony Profiler

Der Symfony Profiler und die Toolbar geben detaillierte Informationen über die Ausführung
jeder Server-Anfrage. Die Toolbar erscheint am unteren Rand des Browser-Fensters,
wenn der Debug-Modus aktiv ist. Sie kann über das Symfony Logo geschlossen und geöffnet
werden.

![Symfony toolbar](/de/system/images/de/symfony-toolbar.png?classes=shadow)

Unter den Informationen, die abgefragt werden können befindet sich zum Beispiel:

* Symfony, Contao & PHP Version
* Zusammengefasste Debug Ausgaben des `VarDumper` (`dump()`)
* Speicherauslastung
* Datenbank Abfragezeiten
* Informationen über den gerade eingeloggten Benutzer
* Fehler, Warnungen und Deprecations


## Stack Trace

Wenn ein Fehler auftritt, wird dieser im `var/logs` Verzeichnis festgehalten. Um
die Ursache des Fehlers zu finden, kann es jedoch hilfreich sein den kompletten Stack
Trace der Fehlermeldung zu bekommen. Mit aktivem Debug-Modus kann man den Fehler
nochmals reproduzieren und bekommt dann direkt im Browser Fenster den Stack Trace.
Dieser ist dann auch im Symfony Profiler abrufbar.

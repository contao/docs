---
title: "Themes verwalten"
description: "Ein fertiges Design wird in Contao als »Theme« bezeichnet, was auf Deutsch so viel wie »Thema« oder 
»Motiv« heißt."
url: "layout/theme-manager/themes-verwalten"
aliases:
    - /de/theme-manager/themes-verwalten/
    - /de/layout/theme-manager/themes-verwalten/
weight: 10
---

Ein fertiges Design wird in Contao als »Theme« bezeichnet, was auf Deutsch so viel wie »Thema« oder »Motiv« heißt. 
Tatsächlich wird jedoch auch hierzulande für grafische Benutzeroberflächen hauptsächlich der englische Begriff »Theme« 
verwendet, sodass es keine wirklich adäquate deutsche Übersetzung gibt. Du verwaltest daher dein Contao-Themes mit dem 
Theme-Manager.


## Bestandteile eines Themes

Ein Theme fasst alle designrelevanten Elemente einer Webseite zusammen:

- das Theme selbst
- die enthaltenen Stylesheets
- die eingebundenen Frontend-Module
- die enthaltenen Seitenlayouts
- die enthaltenen Bildgrößen
- die verwendeten Dateien
- eventuell angepasste Templates

Im Gegensatz zu Stylesheets, Frontend-Modulen, Seitenlayouts und Bildgrößen, die in der Datenbank gespeichert werden, 
befinden sich Dateien und Templates in einem Unterverzeichnis deiner Contao-Installation. Ein Template ist übrigens 
eine PHP-Datei, mit der du die HTML-Ausgabe eines bestimmten Elements oder Moduls vorgeben kannst.

Achte bei der Auswahl der Dateien darauf, dass du nur diejenigen mit dem Theme verknüpfst, die auch tatsächlich zum 
Design gehören. Im Contao-Upload-Verzeichnis liegen sämtliche Benutzerdateien, also neben Hintergrundbildern und Icons 
auch Fotos, Videos, PDF-Dokumente, Word-Dateien etc. Die Abgrenzung zwischen Design und Inhalt obliegt im Dateisystem 
allein deinem bevorzugten Organisationsansatz.


## Themes konfigurieren

Die Bedienung des Theme-Managers funktioniert genau wie die der meisten anderen Backend-Module, nämlich mithilfe von 
Navigationssymbolen.

![Navigationssymbole im Theme-Manager](/de/layout/theme-manager/images/de/navigationssymbole-im-theme-manager.png?classes=shadow)

- ![Theme bearbeiten](/de/icons/edit.svg?classes=icon) Theme bearbeiten
- ![Theme löschen](/de/icons/delete.svg?classes=icon) Theme löschen
- ![Details des Theme anzeigen](/de/icons/show.svg?classes=icon) Details des Theme anzeigen
- ![Die Stylesheets des Theme bearbeiten](/de/icons/css.svg?classes=icon) Die Stylesheets des Theme bearbeiten
- ![Die Frontend-Module des Theme bearbeiten](/de/icons/modules.svg?classes=icon) Die Frontend-Module des Theme 
bearbeiten
- ![Die Seitenlayouts des Theme bearbeiten](/de/icons/layout.svg?classes=icon) Die Seitenlayouts des Theme 
bearbeiten
- ![Die Bildgrößen des Theme bearbeiten](/de/icons/sizes.svg?classes=icon) Die Bildgrößen des Theme bearbeiten
- ![Theme exportieren](/de/icons/theme_export.svg?classes=icon) Theme exportieren

**Theme-Titel**: Hier gibst du den Theme-Titel ein.

Der Titel eines Themes wird sowohl in der Backend-Übersicht angezeigt als auch beim Theme-Export als Dateiname 
verwendet. Es empfiehlt sich daher, im Titel auch die Versionsnummer eines Themes anzugeben – natürlich nur, sofern 
Versionierung für dich in diesem Zusammenhang eine Rolle spielt.

**Autor**: Hier kannst du den Namen des Theme-Designers eingeben.

**Ordner**: Hier wählst du aus, welche Ordner aus dem Contao-Upload-Verzeichnis zu dem Theme gehören. Die hier 
verknüpften Ressourcen werden beim Theme-Export mit exportiert.

**Bildschirmfoto**: Hier kannst du ein Bildschirmfoto für die Theme-Übersicht auswählen.

**Templates-Ordner**: Hier kannst du einen bestimmten Unterordner aus dem Templates-Verzeichnis mit dem Theme 
verknüpfen. Die darin enthaltenen angepassten Templates werden dann ebenfalls mit exportiert.


## Themes exportieren

Der Export eines Themes wird über das entsprechende Navigationssymbol in der Theme-Übersicht angestoßen. Contao bietet 
dir anschließend eine `.cto`-Datei zum Download an, die du auf deinem lokalen Rechner speichern kannst. Die 
Dateiendung »cto« ist proprietär, es handelt sich dabei aber um ein ganz normales ZIP-Archiv, das du mit jedem 
ZIP-Dienstprogramm entpacken kannst.

Die Theme-Datei enthält folgende Ressourcen:

| Name       | Erklärung                                                                                           |
|:-----------|:----------------------------------------------------------------------------------------------------|
| theme.xml  | In dieser XML-Datei sind alle Datensätze aus der Contao-Datenbank enthalten, die mit dem Theme oder dessen Bestandteilen zu tun haben. |
| files      | In diesem Ordner sind alle Dateien aus dem Contao-Upload-Verzeichnis enthalten, die mit dem Theme verknüpft wurden. Es spielt dabei keine Rolle, ob das Upload-Verzeichnis in deiner Installation tatsächlich `files` heißt oder nicht. |
| templates  | In diesem Ordner sind alle Dateien aus dem Templates-Verzeichnis enthalten, die mit dem Theme verknüpft wurden. Sind keine angepassten Templates vorhanden, erscheint der Ordner auch nicht in der Exportdatei. |


## Themes importieren

Der Import eines Themes erfolgt, indem du im Theme-Manager auf die Schaltfläche **Theme importieren** klickst. Wähle 
die Datei aus und starte den Importvorgang.

Contao führt dann eine Reihe von Prüfungen durch, um eventuelle Inkompatibilitäten zwischen dem Theme und deiner 
Contao-Installation zu entdecken.

![Die Theme-Daten werden überprüft](/de/layout/theme-manager/images/de/die-theme-daten-werden-ueberprueft.png?classes=shadow)

Die Überprüfung beinhaltet insbesondere:

- die Prüfung der Tabellen auf fehlende Felder
- die Prüfung auf nicht vorhandene Layoutbereiche
- die Prüfung auf bereits vorhandene Templates

Enthält ein Theme Tabellen oder Felder, die es in deiner Contao-Datenbank nicht gibt (beispielsweise weil eine 
bestimmte Third-Party-Erweiterung nicht installiert ist), werden diese Daten beim Import ignoriert. Achte also darauf, 
dass alle im Theme eingebundenen Erweiterungen zum Zeitpunkt des Imports installiert und aktuell sind.

Auch angepasste Templates bieten etliches an Konfliktpotenzial, sofern sie nicht in einem eindeutigen Unterordner 
separat verwaltet werden. Bereits bestehende Templates werden beim Theme-Import nämlich – nach entsprechender Warnung – 
überschrieben.


## Themes aktivieren

Nachdem ein Theme erfolgreich importiert wurde, musst du es nur noch aktivieren, damit es im Frontend angezeigt wird. 
Mit »aktivieren« ist die Zuweisung eines der Seitenlayouts des neuen Themes zu einer Seite in der Seitenstruktur 
gemeint. Aus den bisherigen Anleitungen weißt du ja bereits, dass die Zusammenführung von Design und Inhalten in der 
[Seitenstruktur](../../seitenstruktur/seiten-konfigurieren/#layout-einstellungen) erfolgt und dass das Seitenlayout den 
Aufbau einer Seite festlegt.

Zur Veranschaulichung wurde hier das Theme »[Contao Official Demo](https://packagist.org/packages/contao/official-demo)« 
importiert und das Seitenlayout »2 columns - [ default ]« dem Startpunkt der Webseite in der Seitenstruktur zugewiesen.

![Contao Official Demo](/de/layout/theme-manager/images/de/contao-official-demo.png?classes=shadow)


## Bezugsquellen für Themes

Kommerzielle Themes findest du am einfachsten über Google, z. B. unter dem Suchbegriff »Contao-Themes« (mit oder ohne 
Bindestrich). Die Firma Feyer Media GmbH & Co. KG vom Contao-Initiator Leo Feyer bietet kommerzielle Themes an, die 
teilweise von ihm selbst und teilweise von anderen Anbietern erstellt wurden. Zu diesen Themes gibt es auch eine 
[Online-Demo](https://themes.contao.org/de/), in der du dir schnell einen Eindruck von den Designs verschaffen kannst. 
Ein weiterer Anbieter von Themes ist die Firma [RockSolid Themes](https://rocksolidthemes.com/de/contao/themes) vom 
Core-Entwickler Martin Auswöger.

Bei all der Theme-Euphorie sei jedoch auch gesagt, dass Themes – genau wie Third-Party-Erweiterungen – immer auch ein 
potenzielles Einfallstor für Hacker sind. Schließlich lädst du dir dabei ja Dateien von fremden Erstellern auf deinen 
Server, ohne genau zu wissen, was dort im Einzelnen gespeichert ist. Installiere daher nur Themes von vertrauenswürdigen
Herstellern, und lese unbedingt vorab die 
[Sicherheitshinweise im Contao-Blog](https://contao.org/de/news/sicherheitshinweise-zu-contao-themes.html).

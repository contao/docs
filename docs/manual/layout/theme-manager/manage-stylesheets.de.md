---
title: "Stylesheets verwalten"
description: "In Contao steht für die Verwaltung von Stylesheets ein komfortables Backend-Modul zur Verfügung, mit dem 
du alle Formatdefinitionen in einer Eingabemaske erfassen kannst."
url: "layout/theme-manager/stylesheets-verwalten"
aliases:
    - /de/theme-manager/stylesheets-verwalten/
    - /de/layout/theme-manager/stylesheets-verwalten/
weight: 20
---

Wie schon im Abschnitt, [Contao im Schnelldurchlauf](../../../einleitung/contao-im-schnelldurchlauf/), erwähnt 
wurde, sind Cascading Stylesheets, kurz CSS, das Mittel der Wahl bei der Formatierung von Webseiten. Falls du also 
nicht zumindest über Grundkenntnisse in CSS verfügst, solltest du dir diese spätestens jetzt aneignen, denn die 
Erstellung bzw. Anpassung eines Themes ist ohne CSS-Kenntnisse nicht möglich. Eine sehr gute Einführung in die Thematik 
bietet beispielsweise die Buchreihe »[Little Boxes](https://www.little-boxes.de/little-boxes-teil1-online.html)« 
von Peter Müller.

In Contao steht für die Verwaltung von Stylesheets ein komfortables Backend-Modul zur Verfügung, mit dem du alle 
Formatdefinitionen in einer Eingabemaske erfassen kannst. Die Erstellung der eigentlichen CSS-Datei erfolgt dabei 
automatisch im Hintergrund.

{{% notice info %}}
Der interne CSS-Editor ist veraltet und wird in einer der nächsten Contao-Versionen entfernt!  
Bitte [exportiere deine vorhandenen Stylesheets](#stylesheets-exportieren) und füge sie als externe Stylesheets zum 
Seitenlayout hinzu.
{{% /notice %}}


## Medientypen festlegen

Der Medientyp eines Stylesheets legt fest, für welche Art von Endgerät es gültig ist. Wenn du z. B. ein Stylesheet vom 
Medientyp *handheld* erstellst, wird es nur dann eingebunden, wenn du die Seite mit einem Handheld-PC aufrufst. Rufst 
du die Seite hingegen mit deinem Browser auf, wird es automatisch übersprungen. Folgende Medientypen stehen dir zur 
Verfügung:

| Medientyp    | Erklärung                                                                                           |
|:-------------|:----------------------------------------------------------------------------------------------------|
| all          | Das Stylesheet gilt für sämtliche genannten Medientypen.                                            |
| aural        | Das Stylesheet gilt für computergesteuerte Sprachausgaben.                                          |
| braille      | Das Stylesheet gilt für Ausgabegeräte mit einer Braille-Zeile für blinde Nutzer.                    |
| embossed     | Das Stylesheet gilt für Braille-Drucker.                                                            |
| handheld     | Das Stylesheet gilt für Handheld-PCs und Smartphones. Allerdings fordern nicht alle Endgeräte diesen Medientyp an; das iPhone verwendet beispielsweise grundsätzlich die Stylesheets vom Typ _screen_. |
| print        | Das Stylesheet gilt für die Druckausgabe der Webseite.                                              |
| projection   | Das Stylesheet gilt für die Darstellung mit Beamern und ähnlichen Geräten.                          |
| screen       | Das Stylesheet gilt für die Bildschirmausgabe (Standard für Webseiten).                             |
| tty          | Das Stylesheet gilt für nicht-grafische Ausgabemedien mit fester Zeichenbreite.                     |
| tv           | Das Stylesheet gilt für TV-ähnliche Ausgabemedien mit grober Auflösung.                             |

Den Medientyp eines Stylesheets legst du in den Stylesheet-Einstellungen fest.

Die für Webseiten relevanten Medientypen sind *screen* und *print*.


## Conditional Comments

Conditional Comments sind proprietäre Anweisungen, die nur vom Internet Explorer verstanden werden und unter anderem 
das Einbinden von spezifischen Stylesheets und anderen Scripts ermöglichen. In einem solchen Stylesheet kannst du 
beispielsweise Darstellungsfehler gesondert beheben, die vor allem in älteren Versionen des Internet Explorer leider 
reichlich vorhanden sind.

Die Bedingung (Condition) eines Conditional Comment ist wie folgt zu lesen:

| Bedingung       | Erklärung                                                                          |
|:----------------|:-----------------------------------------------------------------------------------|
| `if IE`         | Gilt für alle Internet Explorer-Versionen.                                         |
| `if IE 6`       | Gilt nur für die Version 6.                                                        |
| `if lt IE 6`    | Gilt für alle Versionen kleiner 6 (**l**ess **t**han).                             |
| `if lte IE 6`   | Gilt für alle Versionen kleiner oder gleich 6 (**l**ess **t**han or **e**quals).   |
| `if gt IE 6`    | Gilt für alle Versionen größer 6 (**g**reater **t**han).                           |
| `if gte IE 6`   | Gilt für alle Versionen größer oder gleich 6 (**g**reater **t**han or **e**quals). |

Nachdem die Behebung der Internet Explorer-Fehler inzwischen zum Arbeitsalltag eines Webdesigners gehört, wurde die 
Einbindung von Stylesheets mittels Conditional Comments in die Stylesheet-Verwaltung integriert.


## Formatdefinitionen anlegen

Um Formatdefinitionen anlegen zu können, musst du zwei Dinge wissen: Wie lauten die Klassennamen der Contao-Elemente 
(die sogenannten Selektoren), und in welcher Reihenfolge werden die Formatdefinitionen gespeichert?


### Klassennamen der Contao-Elemente

Die CSS-Klassennamen der Contao-Elemente sind durchgehend logisch aufgebaut. Inhaltselemente beginnen mit dem Präfix 
`ce_` (für **c**ontent **e**lement), gefolgt von dem Typ des Inhaltselements. Ein Textelement beispielsweise 
hat die Klasse `ce_text`, ein Bildelement die Klasse `ce_image`.

Dasselbe gilt für Module, nur dass diese mit dem Präfix `mod_` (für **mod**ules) beginnen. Das Modul 
»Navigationsmenü« hat beispielsweise die Klasse `mod_navigation`, das Modul »Nachrichtenliste« die Klasse 
`mod_newslist`. Wenn du dir bezüglich der Klasse eines Elements nicht sicher bist, schaue einfach im 
Quelltext der Webseite nach.

In deinem Stylesheet kannst du den Klassennamen eines Elements dann dazu verwenden, ihm ein Format zuzuweisen. Folgende 
CSS-Anweisung setzt beispielsweise den Außenabstand eines Contao-Textelements auf 24 Pixel:

```css
.ce_text {
    margin: 24px;
}
```

In Contao kannst du mit dieser Schreibweise allerdings so gar nicht in Berührung, da du alle Formate über die 
Eingabemaske festlegen kannst. Lediglich den Teil vor den geschweiften Klammern, den sogenannten Selektor, musst du von 
Hand in das dafür vorgesehene Feld eingeben.

![Den Außenabstand im Stylesheet-Editor festlegen](/de/layout/theme-manager/images/de/den-aussenabstand-im-stylesheet-editor-festlegen.png?classes=shadow)


### Reihenfolge der Formatdefinitionen

Die Reihenfolge der Formatdefinitionen spielt bei Cascading Stylesheets eine wichtige Rolle, weil jede Anweisung in 
einer nachfolgenden Formatdefinition überschrieben werden kann. Dieses Feature eignet sich besonders gut, um 
beispielsweise browserspezifische Eigenarten auszugleichen:

```css
/* Außenabstand für alle Browser */
.mod_search {
    margin: 24px;
}

/* Korrektur im Internet Explorer 6 */
html .mod_search {
    margin: 18px;
}
```

Wäre die Reihenfolge der Formatdefinitionen umgekehrt, würde zuerst das spezifische Format für den Internet Explorer 
geladen und danach wieder durch das allgemeingültige Format für alle Browser überschrieben. Die spezifische Anweisung 
käme also niemals zur Anwendung, und der Außenabstand betrüge immer 24 Pixel.

Du kannst die Reihenfolge der Datensätze in Contao über die Navigationsicons 
![Formatdefinition verschieben](/de/icons/drag.svg?classes=icon) **Drag&Drop** oder 
![Formatdefinition verschieben](/de/icons/cut.svg?classes=icon) **Verschieben** und 
![Nach der Formatdefinition einfügen](/de/icons/pasteafter.svg?classes=icon) **Danach einfügen** ändern.

Zudem hast du die Möglichkeit, Formatdefinitionen eine Kategorie zuzuweisen, um die Datensätze später nach dieser 
Kategorie filtern und zusammengehörende Definitionen leichter erkennen zu können. Diese Kategorien dienen lediglich der 
besseren Übersicht im Backend und werden nicht für die Sortierung im Stylesheet selbst verwendet.


## Stylesheets exportieren

Du kannst einzelne Stylesheets exportieren, indem du hinter dem Stylesheet auf das Navigationsicons 
![Stylesheet exportieren](/de/icons/theme_export.svg?classes=icon) **Stylesheet exportieren** klickst.


## Stylesheets importieren

Damit du bereits bestehende Stylesheets ebenfalls mit dem internen Stylesheet-Editor bearbeiten kannst, bietet dir das 
»Stylesheets«-Modul die Möglichkeit, CSS-Dateien zu importieren. Übertrage dazu deine CSS-Datei zuerst in das 
Contao-Upload-Verzeichnis, und klicke dann auf die Schaltfläche CSS-Import. Es öffnet sich eine Seite mit einem 
Dateibrowser, aus dem du die zu importierenden Stylesheets auswählen kannst.

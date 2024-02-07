---
title: "Frontend-Module"
description: "Die »Kalender«-Erweiterung enthält vier neue Frontend-Module, die du wie gewohnt über die Modulverwaltung 
konfigurieren kannst."
url: "core-erweiterung/kalender/frontend-module"
aliases:
    - /de/core-erweiterung/kalender/frontend-module/
weight: 20
---

Nachdem du nun weißt, wie Kalender und Events im Backend verwaltet werden, wird dir nun erklärt, wie du diese Inhalte 
im Frontend darstellen kannst. Die »Kalender«-Erweiterung enthält vier neue Frontend-Module, die du wie gewohnt über 
die Modulverwaltung konfigurieren kannst.

![Kalender-Module]({{% asset "images/manual/core-extensions/calendar/de/kalender-module.png" %}}?classes=shadow)


## Kalender

Das Frontend-Modul »Kalender« fügt der Webseite einen Kalender hinzu, in dem die Events eines oder mehrerer Kalender 
dargestellt werden.

**Standard Kalender-Modul `cal_default`**

![Das Standard Kalender-Modul im Frontend]({{% asset "images/manual/core-extensions/calendar/de/das-standard-kalender-modul-im-frontend.png" %}}?classes=shadow)

**Mini Kalender-Modul `cal_mini`**

![Das Mini Kalender-Modul im Frontend]({{% asset "images/manual/core-extensions/calendar/de/das-mini-kalender-modul-im-frontend.png" %}}?classes=shadow)


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchem Kalender Beiträge aufgelistet werden sollen. 

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.

**Erster Wochentag:** Hier legst du den ersten Tag der Woche fest.

**Hervorgehobene Events:** Hier kannst du festlegen, wie hervorgehobene Events gehandhabt werden. Es stehen folgende
Möglichkeiten zur Verfügung: »Alle Events anzeigen«, »Nur hervorgehobene Events anzeigen« und »Hervorgehobene Events
überspringen«.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du die Seite fest, zu der ein Besucher beim Anklicken eines Links im Mini-Kalender 
weitergeleitet wird. Auf der Zielseite sollte das Frontend-Modul »Eventliste« oder »Kalender« eingebunden sein.


### Template-Einstellungen

**Kalender-Template:** Hier wählst du das Template für den Kalender aus.

Folgende Kalender-Templates stehen dir standardmäßig zur Verfügung:

| Template                 | Erklärung                                                                                                                                                                                                                                                                                                                                         |
|:-------------------------|:--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `cal_default`            | Dieses Template stellt einen großen Kalender dar, in dem die einzelnen Events aufgelistet sind und direkt angeklickt werden können.                                                                                                                                                                                                               |
| `cal_mini`               | Dieses Template stellt einen Mini-Kalender dar, der im Gegensatz zum großen Kalender keine direkten Links auf einzelne Events, sondern nur Links auf einzelne Tage enthält. Der Mini-Kalender wurde ursprünglich für die Navigation der Eventliste verwendet; mittlerweile erfolgt diese jedoch mit dem flexibleren Modul »Eventliste-Menü«.   |

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


## Eventleser

Das Frontend-Modul »Eventleser« dient dazu, ein bestimmtes Event darzustellen. Den Alias des Eintrags bezieht das Modul 
über die URL, sodass Events mit sogenannten [Permalinks](https://de.wikipedia.org/wiki/Permalink) gezielt verlinkt 
werden können:

`www.example.com/event/european-design-awards.html`

Das Schlüsselwort des Eventlesers lautet *event* und teilt dem Modul mit, dass es ein bestimmtes Event suchen und 
ausgeben soll. Existiert der gesuchte Eintrag nicht, gibt der Eventleser eine Fehlermeldung und den HTTP-Status-Code 
»404 Not found« zurück. Der Status-Code ist wichtig für die Suchmaschinenoptimierung.

{{% notice info %}}
Auf einer einzelnen Seite darf sich immer nur ein »Lesermodul« befinden, egal welchen Typs. Andernfalls würde das eine 
oder andere Modul eine 404 Seite auslösen, da zum Beispiel der Alias einer Nachricht nicht in einem Kalender gefunden 
wird, oder umgekehrt der Alias eines Events in einem Nachrichtenarchiv.
{{% /notice %}}


### Modul-Konfiguration

**Kalender:** Hier legst du fest, in welchen Kalendern nach dem angeforderten Event gesucht werden soll. Events aus 
nicht ausgewählten Kalendern werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und der Eintrag 
existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.

**Laufende Events ausblenden:** Hier kannst du die laufenden Events in der Liste der zukünftigen Events nicht anzeigen 
lassen.

{{< version-tag "5.3" >}} **Aktuelle URL für kanonische Links verwenden:** Hier kannst du einstellen, dass die aktuelle URL anstelle der
konfigurierten Leseseite für kanonische Links verwendet wird.


### Übersichtsseite

**Übersichtsseite:** Hier kannst du eine Seite auswählen, um in der Detailansicht des Events einen Link zurück zur 
Übersichtsseite zu setzen.

**Individuelle Bezeichnung:** Hier kannst du die Bezeichnung für den Link zur Übersichtsseite ändern.


### Template-Einstellungen

**Event-Template:** Hier wählst du das Event-Template aus.

| Template                 | Erklärung                                                                                                                      |
|:-------------------------|:-------------------------------------------------------------------------------------------------------------------------------|
| `event_full`             | Dieses Template stellt das vollständige Event dar und wird deswegen zur Verwendung mit dem Eventleser empfohlen.               |
| `event_list`             | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit sowie den Event-Text für die Eventliste aus.     |
| `event_teaser`           | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit, den Teasertext und einen Weiterlesen-Link aus.   |
| `event_upcoming`         | Dieses Template gibt das Datum und die Überschrift eines Events aus.                                                           |

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |


### Kommentareinstellungen

**Kommentartemplate:** Hier kannst du das Kommentartemplate auswählen.

Details zum Markup der Kommentare findest du im Abschnitt
[Kommentare](/de/artikelverwaltung/inhaltselemente/include-elemente/#kommentare).


## Eventliste

Das Frontend-Modul »Eventliste« dient dazu, alle Events eines bestimmten Zeitraums aufzulisten. In Verbindung mit dem 
Modul »Eventliste-Menü« kannst du so tages-, monats- oder jahresweise alle vorhandenen Events durchsuchen.


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchen Kalendern Events aufgelistet werden sollen. Die Events werden aufsteigend 
nach Datum sortiert.

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.

**Anzeigeformat:** Hier legst du den Zeitraum der Anzeige fest. Über das Anzeigeformat definierst du gleichzeitig auch 
den Betriebsmodus der Eventliste.

| Betriebsmodus              | Erklärung                                                                                                                   |
|----------------------------|-----------------------------------------------------------------------------------------------------------------------------|
| Eventliste                 | Die Eventliste listet alle Events eines bestimmten Zeitraums auf, den du mit dem Modul »Eventliste-Menü« vorgeben kannst.   |
| Zukünftige Events          | Die Eventliste listet nur zukünftige Events auf (Vorschau).                                                                 |
| Vergangene&nbsp;Events     | Die Eventliste listet nur vergangene Events auf (Rückblick).                                                                |


**Hervorgehobene Events:** Hier kannst du festlegen, wie hervorgehobene Events gehandhabt werden. Es stehen folgende
Möglichkeiten zur Verfügung: »Alle Events anzeigen«, »Nur hervorgehobene Events anzeigen« und »Hervorgehobene Events
überspringen«.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge der Events ändern.

**Eventleser:** Hier kannst du festlegen ob automatisch das ausgewählte Eventleser-Modul anstatt dem Eventlisten-Modul angezeigt
werden soll, wenn ein Event ausgewählt wurde. Dadurch ist es möglich die Eventliste und den Eventleser auf der selben Seite
mit nur einem Modul unterzubringen, anstatt eine eigene Seite für den Eventleser zu haben.

{{% notice info %}}
**Vorsicht:** in den meisten Fällen sollte diese Funktionalität nicht für Eventlisten benutzt werden, die im Seitenlayout
platziert werden. Andernfalls hätte man dann auf jeder Seite des Seitenlayouts automatisch auch einen Eventleser an der 
jeweiligen Stelle im Layout. Dies würde die Funktionalität anderer »Lesermodule« auf der selben Seite verhindern.
{{% /notice %}}

**Anzahl an Events:** Wenn du hier einen Wert größer 0 eingibst, wird die Anzahl der Events der Eventliste automatisch 
auf diesen Wert limitiert.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Events automatisch auf mehrere 
Seiten – eine entsprechende Anzahl vorausgesetzt.

**URL-Parameter ignorieren:** Wenn du hier URL-Parameter ignorieren auswählst, wird der Zeitraum nicht anhand der 
date/month/year-Parameter in der URL geändert.

**Laufende Events ausblenden:** Hier kannst du die laufenden Events in der Liste der zukünftigen Events nicht anzeigen 
lassen.


### Template-Einstellungen

**Event-Template:** Hier wählst du das Event-Template aus.

| Template                 | Erklärung                                                                                                                      |
|:-------------------------|:-------------------------------------------------------------------------------------------------------------------------------|
| `event_full`             | Dieses Template stellt das vollständige Event dar und wird deswegen zur Verwendung mit dem Eventleser empfohlen.               |
| `event_list`             | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit sowie den Event-Text für die Eventliste aus.     |
| `event_teaser`           | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit, den Teasertext und einen Weiterlesen-Link aus.   |
| `event_upcoming`         | Dieses Template gibt das Datum und die Überschrift eines Events aus.                                                           |

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |


## Eventliste-Menü {#eventliste-menue}

Das Frontend-Modul »Eventliste-Menü« fügt der Webseite ein Menü hinzu, mit dem du die Events der einzelnen Tage, Monate 
oder Jahre aufrufen kannst.


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchen Kalendern Events verlinkt werden sollen. Diese Auswahl sollte mit der der 
Eventliste übereinstimmen.

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.

**Anzeigeformat:** Hier legst du das Anzeigeformat (Tag, Monat oder Jahr) fest.

**Hervorgehobene Events:** Hier kannst du festlegen, wie hervorgehobene Events gehandhabt werden. Es stehen folgende
Möglichkeiten zur Verfügung: »Alle Events anzeigen«, »Nur hervorgehobene Events anzeigen« und »Hervorgehobene Events
überspringen«.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge des Menüs ändern.

**Anzahl der Events anzeigen:** Wenn du diese Option auswählst, wird die Anzahl der Events jedes Monats bzw. Jahres im 
Menü angezeigt.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher nach dem Anklicken eines Menüpunkts 
(Tag, Monat oder Jahr) weitergeleitet wird.


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" title="Januar 2020">&lt;</a></th>
                <th class="head current" colspan="5" >Februar 2020</th>
                <th class="head next"><a href="…" title="März 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label weekend">So<span class="invisible">nntag</span></th>
                <th class="label">Mo<span class="invisible">ntag</span></th>
                <th class="label">Di<span class="invisible">enstag</span></th>
                <th class="label">Mi<span class="invisible">ttwoch</span></th>
                <th class="label">Do<span class="invisible">nnerstag</span></th>
                <th class="label">Fr<span class="invisible">eitag</span></th>
                <th class="label weekend">Sa<span class="invisible">mstag</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0">
                <td class="days weekend empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days weekend">1</td>
            </tr>
            <tr class="week_1">
                <td class="days weekend active"><a href="…" title="…">2</a></td>
                <td class="days">3</td>
                <td class="days">4</td>
                <td class="days">5</td>
                <td class="days">6</td>
                <td class="days">7</td>
                <td class="days weekend"><a href="…" title="…">8</a></td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```

Im Anzeigeformat »Monat« sieht das HTML-Markup wie folgt aus:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <ul class="level_1">
        <li class="year submenu">
            <a href="…">…</a>
            <ul class="level_2">
                <li><a href="…" title="…">März 2020</a></li>
                <li><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">Mai 2020</a></li>
            </ul>
        </li>
        …
    </ul>
</div>
<!-- indexer::continue -->
```

Im Anzeigeformat »Jahr« mit Anzahl der Beiträge anzeigen sieht das HTML-Markup wie folgt aus:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <ul class="level_1">
        <li><a href="…" title="…">2020 (2 Einträge)</a></li>
        <li><a href="…" title="…">2021 (5 Einträge)</a></li>
        <li><a href="…" title="…">2022 (4 Einträge)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

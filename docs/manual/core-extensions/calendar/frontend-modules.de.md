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

![Kalender-Module](/de/core-extensions/calendar/images/de/kalender-module.png?classes=shadow)


## Kalender

Das Frontend-Modul »Kalender« fügt der Webseite einen Kalender hinzu, in dem die Events eines oder mehrerer Kalender 
dargestellt werden.

![Das Kalender-Modul im Frontend](/de/core-extensions/calendar/images/de/das-kalender-modul-im-frontend.png?classes=shadow)


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchem Kalender Beiträge aufgelistet werden sollen. 

**Erster Wochentag:** Hier legst du den ersten Tag der Woche fest.

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option 
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du die Seite fest, zu der ein Besucher beim Anklicken eines Links im Mini-Kalender 
weitergeleitet wird. Auf der Zielseite sollte das Frontend-Modul »Eventliste« oder »Kalender« eingebunden sein.


### Template-Einstellungen

**Kalender-Template:** Hier wählst du das Template für den Kalender aus.

Folgende Kalender-Templates stehen dir standardmäßig zur Verfügung:

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `cal_default`            | Dieses Template stellt einen großen Kalender dar, in dem die einzelnen Events aufgelistet sind und direkt angeklickt werden können. |
| `cal_mini`               | Dieses Template stellt einen Mini-Kalender dar, der im Gegensatz zum großen Kalender keine direkten Links auf einzelne Events, sondern nur Links auf einzelne Tage enthält. Der Mini-Kalender wurde ursprünglich für die Navigation der Eventliste verwendet; mittlerweile erfolgt diese jedoch mit dem flexibleren Modul »Eventliste-Menü«. |

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_calendar block">
    <table class="calendar">
        <thead>
            <tr>
                <th colspan="2" class="head previous"><a href="…" title="…">&lt; April 2020</a></th>
                <th colspan="3" class="head current">Mai 2020</th>
                <th colspan="2" class="head next"><a href="…" title="…">Juni 2020 &gt;</a></th>
            </tr>
            <tr>
                <th class="label col_first weekend">So<span>nntag</span></th>
                <th class="label">Mo<span>ntag</span></th>
                <th class="label">Di<span>enstag</span></th>
                <th class="label">Mi<span>ttwoch</span></th>
                <th class="label">Do<span>nnerstag</span></th>
                <th class="label">Fr<span>eitag</span></th>
                <th class="label col_last weekend">Sa<span>mstag</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0 first">
                <td class="days empty weekend col_first"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days"><div class="header">1</div></td>
                <td class="days weekend col_last"><div class="header">2</div></td>
            </tr>
            <tr class="week_1">
                <td class="days weekend col_first"><div class="header">3</div></td>
                <td class="days"><div class="header">4</div></td>
                <td class="days"><div class="header">5</div></td>
                <td class="days"><div class="header">6</div></td>
                <td class="days"><div class="header">7</div></td>
                <td class="days"><div class="header">8</div></td>
                <td class="days active weekend col_last">
                    <div class="header">9</div>
                    <div class="event cal_3 upcoming" itemscope itemtype="http://schema.org/Event">
                        <a href="…" title="…" itemprop="url"><span itemprop="name">…</span></a>
                    </div>
                </td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```


## Eventleser

Das Frontend-Modul »Eventleser« dient dazu, ein bestimmtes Event darzustellen. Den Alias des Eintrags bezieht das Modul 
über die URL, sodass Events mit sogenannten [Permalinks](https://de.wikipedia.org/wiki/Permalink) gezielt verlinkt 
werden können:

`www.domain.de/event/european-design-awards.html`

Das Schlüsselwort des Eventlesers lautet *event* und teilt dem Modul mit, dass es ein bestimmtes Event suchen und 
ausgeben soll. Existiert der gesuchte Eintrag nicht, gibt der Eventleser eine Fehlermeldung und den HTTP-Status-Code 
»404 Not found« zurück. Der Status-Code ist wichtig für die Suchmaschinenoptimierung.


### Modul-Konfiguration

**Kalender:** Hier legst du fest, in welchen Kalendern nach dem angeforderten Event gesucht werden soll. Events aus 
nicht ausgewählten Kalendern werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und der Eintrag 
existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.

{{< version "4.7" >}}

**Laufende Events ausblenden:** Hier kannst du die laufenden Events in der Liste der zukünftigen Events nicht anzeigen 
lassen.


### Template-Einstellungen

**Event-Template:** Hier wählst du das Event-Template aus.

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `event_full`             | Dieses Template stellt das vollständige Event dar und wird deswegen zur Verwendung mit dem Eventleser empfohlen.              |
| `event_list`             | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit sowie den Event-Text für die Eventliste aus.     |
| `event_teaser`           | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit, den Teasertext und einen Weiterlesen-Link aus.  |
| `event_upcoming`         | Dieses Template gibt das Datum und die Überschrift eines Events aus.                     |

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.


### Kommentareinstellungen

**Kommentartemplate:** Hier kannst du das Kommentartemplate auswählen.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<div class="mod_eventreader block">
    <div class="event layout_full block upcoming" itemscope itemtype="http://schema.org/Event">
        <h1 itemprop="name">…</h1>
        <p class="info"><time datetime="…" itemprop="startDate"…</time></p>
        <div class="ce_text block">
            <p>…</p>  
        </div>
     </div>
    
    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->
    
    <div class="ce_comments block">
        …
    </div>
</div>
```

Details zum Markup der Kommentare findest du im Abschnitt 
[Kommentare](../../../artikelverwaltung/inhaltselemente/#kommentare).


## Eventliste

Das Frontend-Modul »Eventliste« dient dazu, alle Events eines bestimmten Zeitraums aufzulisten. In Verbindung mit dem 
Modul »Eventliste-Menü« kannst du so tages-, monats- oder jahresweise alle vorhandenen Events durchsuchen.


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchen Kalendern Events aufgelistet werden sollen. Die Events werden aufsteigend 
nach Datum sortiert.

**Anzeigeformat:** Hier legst du den Zeitraum der Anzeige fest. Über das Anzeigeformat definierst du gleichzeitig auch 
den Betriebsmodus der Eventliste.

| Betriebsmodus            | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| Eventliste               | Die Eventliste listet alle Events eines bestimmten Zeitraums auf, den du mit dem Modul »Eventliste-Menü« vorgeben kannst. |
| Zukünftige Events        | Die Eventliste listet nur zukünftige Events auf (Vorschau).                              |
| Vergangene&nbsp;Events   | Die Eventliste listet nur vergangene Events auf (Rückblick).                             |

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option 
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge der Events ändern.

**Eventleser:** Hier kannst du festlegen ob automatisch zum Eventleser gewechselt werden soll, wenn ein Event 
ausgewählt wurde. Damit würden alternativ die Eventliste und die Eventdetails auf derselben Seite angezeigt.

**Anzahl an Events:** Wenn du hier einen Wert größer 0 eingibst, wird die Anzahl der Events der Eventliste automatisch 
auf diesen Wert limitiert.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Events automatisch auf mehrere 
Seiten – eine entsprechende Anzahl vorausgesetzt.

**URL-Parameter ignorieren:** Wenn du hier URL-Parameter ignorieren auswählst, wird der Zeitraum nicht anhand der 
date/month/year-Parameter in der URL geändern.

{{< version "4.7" >}}

**Laufende Events ausblenden:** Hier kannst du die laufenden Events in der Liste der zukünftigen Events nicht anzeigen 
lassen.


### Template-Einstellungen

**Event-Template:** Hier wählst du das Event-Template aus.

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `event_full`             | Dieses Template stellt das vollständige Event dar und wird deswegen zur Verwendung mit dem Eventleser empfohlen.               |
| `event_list`             | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit sowie den Event-Text für die Eventliste aus.      |
| `event_teaser`           | Dieses Template gibt die Überschrift eines Events, das Datum und die Uhrzeit, den Teasertext und einen Weiterlesen-Link aus.   |
| `event_upcoming`         | Dieses Template gibt das Datum und die Überschrift eines Events aus.                     |

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_eventlist example block">

    <div class="header even first">
        <span class="day">… </span><span class="date">…</span>
    </div>
    <div class="event layout_teaser upcoming even first last cal_3" itemscope itemtype="http://schema.org/Event">
        <h2 itemprop="name"><a href="…" title="…" itemprop="url">…</a></h2>
        <p class="time"><time datetime="…" itemprop="startDate">…</time></p>
        <div class="ce_text block" itemprop="description">
            <p>…</p>    
        </div>
        <p class="more">
            <a href="…" title="…" itemprop="url">Weiterlesen …<span class="invisible"> …</span></a>
        </p>
    </div>

    <div class="header odd last">
        <span class="day">… </span><span class="date">…</span>
    </div>
    <div class="event layout_teaser upcoming even first last cal_3" itemscope itemtype="http://schema.org/Event">
        <h2 itemprop="name"><a href="…" title="…" itemprop="url">…</a></h2>
        <p class="time"><time datetime="…" itemprop="startDate">…</time></p>
        <div class="ce_text block" itemprop="description">
            <p>…</p>
        </div>
        <p class="more">
            <a href="…" title="…" itemprop="url">Weiterlesen …<span class="invisible"> …</span></a>
        </p>
    </div>

</div>
<!-- indexer::continue -->
```


## Eventliste-Menü {#eventliste-menue}

Das Frontend-Modul »Eventliste-Menü« fügt der Webseite ein Menü hinzu, mit dem du die Events der einzelnen Tage, Monate 
oder Jahre aufrufen kannst.


### Modul-Konfiguration

**Kalender:** Hier legst du fest, aus welchen Kalendern Events verlinkt werden sollen. Diese Auswahl sollte mit der der 
Eventliste übereinstimmen.

**Anzeigeformat:** Hier legst du das Anzeigeformat (Tag, Monat oder Jahr) fest.

**Verkürzte Darstellung:** Standardmäßig zeigt Contao mehrtägige Events an jedem Tag einzeln an. Wenn du diese Option 
auswählst, wird die Darstellung verkürzt, und das Event erscheint nur einmal am ersten Tag.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge des Menüs ändern.

**Anzahl der Events anzeigen:** Wenn du diese Option auswählst, wird die Anzahl der Events jedes Monats bzw. Jahres im 
Menü angezeigt.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher nach dem Anklicken eines Menüpunkts 
(Tag, Monat oder Jahr) weitergeleitet wird.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" rel="nofollow" title="April 2020">&lt;</a></th>
                <th colspan="5" class="head current">Mai 2020</th>
                <th class="head next"><a href="…" rel="nofollow" title="Juni 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label col_first">Mo<span class="invisible">ntag</span></th>
                <th class="label">Di<span class="invisible">enstag</span></th>
                <th class="label">Mi<span class="invisible">ttwoch</span></th>
                <th class="label">Do<span class="invisible">nnerstag</span></th>
                <th class="label">Fr<span class="invisible">eitag</span></th>
                <th class="label weekend">Sa<span class="invisible">mstag</span></th>
                <th class="label col_last weekend">So<span class="invisible">nntag</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0 first">
                <td class="days empty col_first">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days">1</td>
                <td class="days weekend">2</td>
                <td class="days weekend col_last">3</td>
            </tr>
            <tr class="week_1">
                <td class="days col_first">4</td>
                <td class="days">5</td>
                <td class="days">6</td>
                <td class="days">7</td>
                <td class="days">8</td>
                <td class="days active weekend"><a href="…" title="…">9</a></td>
                <td class="days active weekend col_last"><a href="…" title="…">10</a></td>
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
                <li class="first"><a href="…" title="…">März 2020</a></li>
                <li><a href="…" title="…">April 2020</a></li>
                <li class="last"><a href="…" title="…">Mai 2020</a></li>
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
        <li class="first"><a href="…" title="…">2020 (2 Einträge)</a></li>
        <li><a href="…" title="…">2021 (5 Einträge)</a></li>
        <li class="last"><a href="…" title="…">2022 (4 Einträge)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

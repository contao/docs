---
title: "Frontend-Module"
description: "Die Nachrichtenerweiterung enthält vier neue Frontend-Module, die du wie gewohnt über die Modulverwaltung 
konfigurieren kannst."
url: "core-erweiterung/nachrichten/frontend-module"
aliases:
    - /de/core-erweiterung/nachrichten/frontend-module/
weight: 20
---

Nachdem du nun weißt, wie Archive und Beiträge im Backend verwaltet werden, wird dir jetzt erklärt, wie du diese 
Inhalte im Frontend darstellen kannst. Die Nachrichtenerweiterung enthält vier neue Frontend-Module, die du wie 
gewohnt über die Modulverwaltung konfigurieren kannst.

![News/Blog-Module]({{% asset "images/manual/core-extensions/news/de/news-blog-module.png" %}}?classes=shadow)


## Nachrichtenliste

Das Frontend-Modul »Nachrichtenliste« stellt eine beliebige Anzahl an Beiträgen aus einem oder mehreren 
Nachrichtenarchiven im Frontend dar. Welche Teile eines Nachrichtenbeitrags angezeigt werden, hängt von dem jeweiligen 
Template ab. Möglich ist alles von der einfachen Überschrift bis hin zum kompletten Beitrag.


### Modul-Konfiguration

**Nachrichtenarchive:** Hier legst du fest, aus welchen Archiven Beiträge aufgelistet werden sollen. Die Beiträge 
werden standardmäßig absteigend nach Datum sortiert.

**Nachrichtenleser:** Hier kannst du festlegen ob automatisch zum Nachrichtenleser gewechselt werden soll, wenn ein 
Beitrag ausgewählt wurde.

{{% notice info %}}
**Vorsicht:** in den meisten Fällen sollte diese Funktionalität nicht für Nachrichtenlisten benutzt werden, die im Seitenlayout
platziert werden. Andernfalls hätte man dann auf jeder Seite des Seitenlayouts automatisch auch einen Nachrichtenleser an 
der jeweiligen Stelle im Layout. Dies würde die Funktionalität anderer »Lesermodule« auf der selben Seite verhindern.
{{% /notice %}}

**Anzahl an Elementen:** Wenn du hier einen Wert größer 0 eingibst, wird die Anzahl der Nachrichten bzw. 
Blog-Beiträge automatisch auf diesen Wert limitiert.

**Hervorgehobene Beiträge:** Hier kannst du festlegen, wie hervorgehobene Beiträge gehandhabt werden. Es stehen folgende 
Möglichkeiten zur Verfügung: »Alle Beiträge anzeigen«, »Nur hervorgehobene Beiträge anzeigen«, »Hervorgehobene Beiträge 
überspringen« und »Hervorgehobene Beiträge zuerst anzeigen«.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge festlegen. Es stehen folgende Sortierreihenfolgen 
zur Verfügung: »Datum aufsteigend«, »Datum absteigend«, »Überschrift aufsteigend«, »Überschrift absteigend« und 
»Zufällige Reihenfolge«.

**Elemente überspringen:** Hier legst du die Anzahl der zu überspringenden Beiträge fest.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Beiträge automatisch auf mehrere 
Seiten – eine entsprechende Anzahl vorausgesetzt.


### Template-Einstellungen

{{< version-tag "Contao 5 nicht mehr verfügbar" >}} **Meta-Felder:** Hier legst du fest, welche Meta-Informationen 
(Datum des Beitrags, Autor des Beitrags und Anzahl der Kommentare) angezeigt werden.

**Nachrichtentemplate:** Hier wählst du das Template für die Beiträge aus. Folgende Nachrichtentemplates stehen dir 
standardmäßig zur Verfügung:

| Template                 | Erklärung                                                                                                                                                        |
|:-------------------------|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `news_full`              | Dieses Template stellt den vollständigen Beitrag dar und wird deswegen zur Verwendung mit dem Nachrichtenleser empfohlen.                                        |
| `news_latest`            | Dieses Template gibt die Meta-Informationen eines Beitrags, ein eventuell hinzugefügtes Bild, die Überschrift, den Teasertext und einen Weiterlesen-Link aus.   |
| `news_short`             | Dieses Template gibt die Meta-Informationen eines Beitrags, die Überschrift, den Teasertext und einen Weiterlesen-Link aus.                                      |
| `news_simple`            | Dieses Template gibt das Datum und die Überschrift eines Beitrags aus.                                                                                           |

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |


## Nachrichtenleser

Das Frontend-Modul »Nachrichtenleser« dient dazu, einen bestimmten Nachrichtenbeitrag darzustellen. Den Alias des 
Beitrags bezieht das Modul über die URL, sodass Nachrichten mit sogenannten 
[Permalinks](https://de.wikipedia.org/wiki/Permalink) gezielt verlinkt werden können:

`www.example.com/nachricht/form-folgt-funktion.html`

In diesem Beispiel wird die Nachricht mit dem Alias »form-folgt-funktion« über die Seite »nachricht« aufgerufen. 
Existiert die gesuchte Nachricht nicht, gibt der Nachrichtenleser eine Fehlermeldung und den HTTP-Status-Code »404 Not
found« zurück. Der Status-Code ist wichtig für die Suchmaschinenoptimierung.

{{% notice info %}}
Auf einer einzelnen Seite darf sich immer nur ein »Lesermodul« befinden, egal welchen Typs. Andernfalls würde das eine 
oder andere Modul eine 404 Seite auslösen, da zum Beispiel der Alias einer Nachricht nicht in einem Kalender gefunden 
wird, oder umgekehrt der Alias eines Events in einem Nachrichtenarchiv.
{{% /notice %}}


### Modul-Konfiguration

**Nachrichtenarchive:** Hier legst du fest, in welchen Archiven nach dem angeforderten Beitrag gesucht werden soll. 
Beiträge aus nicht ausgewählten Archiven werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und die 
Nachricht existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.

**Die aktuelle URL für kanonische Links verwenden:** Hier kannst du einstellen, dass die aktuelle URL anstelle der 
konfigurierten Leseseite für kanonische Links verwendet wird.


### Übersichtsseite

**Übersichtsseite:** Hier kannst du eine Seite auswählen, um in der Detailansicht der News einen Link zurück zur 
Übersichtsseite zu setzen. 

**Individuelle Bezeichnung:** Hier kannst du die Bezeichnung für den Link zur Übersichtsseite ändern.


### Template-Einstellungen

{{< version-tag "Contao 5 nicht mehr" >}} **Meta-Felder:** Hier legst du fest, welche Meta-Informationen (Datum des 
Beitrags, Autor des Beitrags und Anzahl der Kommentare) angezeigt werden.

**Nachrichtentemplate:** Hier wählst du das Nachrichtentemplate aus. Das Template `news_full` stellt 
standardmäßig den vollständigen Beitrag dar.

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |


## Nachrichtenarchiv

Das Frontend-Modul »Nachrichtenarchiv« dient dazu, alle Nachrichtenbeiträge eines bestimmten Zeitraums aufzulisten. In 
Verbindung mit dem Modul »Nachrichtenarchiv-Menü« kannst du so tages-, monats- oder jahresweise alle vorhandenen 
Beiträge durchsuchen.


### Modul-Konfiguration

**Nachrichtenarchive:** Hier legst du fest, aus welchen Archiven Beiträge aufgelistet werden sollen. Die Beiträge 
werden standardmäßig absteigend nach Datum sortiert.

**Nachrichtenleser:** Hier kannst du festlegen ob automatisch zum Nachrichtenleser gewechselt werden soll, wenn ein 
Beitrag ausgewählt wurde.

**Archivformat:** Hier legst du das Archivformat (Tag, Monat oder Jahr) fest.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge festlegen. Es stehen folgende Sortierreihenfolgen
zur Verfügung: »Datum aufsteigend«, »Datum absteigend«, »Überschrift aufsteigend«, »Überschrift absteigend« und
»Zufällige Reihenfolge«.

**Kein Zeitraum ausgewählt:** Hier legst du fest, was das Frontend-Modul darstellen soll, wenn kein bestimmter Zeitraum 
ausgewählt wurde.

| Option                                           | Erklärung                                                                                                                        |
|:-------------------------------------------------|:---------------------------------------------------------------------------------------------------------------------------------|
| Das Modul ausblenden                             | Das Modul wird komplett ausgeblendet, wenn kein Zeitraum ausgewählt ist.                                                         |
| Zum&nbsp;aktuellen&nbsp;Zeitraum&nbsp;springen   | Es werden automatisch die Beiträge des aktuellen Zeitraums (Tag, Monat oder Jahr) angezeigt, wenn kein Zeitraum ausgewählt ist.  |
| Alle Beiträge anzeigen                           | Es werden alle Beiträge des Archivs angezeigt, wenn kein Zeitraum ausgewählt ist.                                                |

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Beiträge automatisch auf mehrere 
Seiten – eine entsprechende Anzahl vorausgesetzt.


### Template-Einstellungen

{{< version-tag "Contao 5 nicht mehr" >}} **Meta-Felder:** Hier legst du fest, welche Meta-Informationen (Datum des Beitrags, Autor des Beitrags und Anzahl der 
Kommentare) angezeigt werden.

**Nachrichtentemplate:** Hier wählst du das Template aus.

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |


## Nachrichtenarchiv-Menü {#nachrichtenarchiv-menue}

Das Frontend-Modul »Nachrichtenarchiv-Menü« fügt der Webseite ein Menü hinzu, mit dem du die Beiträge der einzelnen 
Tage, Monate oder Jahre aufrufen kannst.


### Modul-Konfiguration

**Nachrichtenarchive:** Hier legst du fest, aus welchen Archiven Beiträge verlinkt werden sollen. Diese Auswahl sollte 
mit der des Nachrichtenarchivs übereinstimmen.

**Anzahl der Beiträge anzeigen:** Wenn du diese Option auswählst, wird die Anzahl der Beiträge jedes Monats bzw. Jahres 
im Menü angezeigt.

**Archivformat:** Hier legst du das Archivformat (Tag, Monat oder Jahr) fest.

**Erster Wochentag:** Hier legst du fest, mit welchem Tag die Woche beginnt.

**Sortierreihenfolge:** Hier kannst du die Sortierreihenfolge festlegen. Es stehen folgende Sortierreihenfolgen
zur Verfügung: »Datum aufsteigend«, »Datum absteigend«, »Überschrift aufsteigend«, »Überschrift absteigend« und
»Zufällige Reihenfolge«.

### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher nach dem Anklicken eines Menüpunkts (Tag, 
Monat oder Jahr) weitergeleitet wird.


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Modul-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li class="year submenu"><a href="…">2020</a>
            <ul class="level_2">
                <li><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">März 2020</a></li>
                <li><a href="…" title="…">Februar 2020</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- indexer::continue -->
```

Im Archivformat »Jahr« mit Anzahl der Beiträge anzeigen sieht das HTML-Markup wie folgt aus:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li><a href="…" title="…">2019 (3 Einträge)</a></li>
        <li><a href="…" title="…">2018 (6 Einträge)</a></li>
        <li><a href="…" title="…">2017 (2 Einträge)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

Im Archivformat »Tag« sieht das HTML-Markup wie folgt aus:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" title="Januar 2020">&lt;</a></th>
                <th class="head current" colspan="5" >Februar 2020</th>
                <th class="head next"><a href="…" title="März 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label">So</th>
                <th class="label">Mo</th>
                <th class="label">Di</th>
                <th class="label">Mi</th>
                <th class="label">Do</th>
                <th class="label">Fr</th>
                <th class="label">Sa</th>
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
                <td class="days weekend">8</td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```

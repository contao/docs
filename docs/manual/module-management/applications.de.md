---
title: "Anwendungen"
description: "In diesem Abschnitt werden dir die übrigen Core-Module im Bereich »Anwendungen« vorgestellt."
url: "modulverwaltung/anwendungen"
weight: 40
---

In diesem Abschnitt stelle ich dir die übrigen Core-Module im Bereich »Anwendungen« vor. Die Liste der Frontend-Module 
kann darüber hinaus durch (Third-Party-)Erweiterungen beliebig verlängert werden.


## Formular

Mit dem Modultyp »Formular« kann ein Formular auf einer Seite hinzugefügt werden. Informationen zur Erstellung und 
Verwaltung von Formularen findest du auf der Seite [Formulargenerator](../../formulargenerator/).

**Formular:** Hier kannst du ein Formular auswählen


## Auflistung

Das Frontend-Modul »Auflistung« fügt der Webseite eine Liste von Datensätzen hinzu, die im Frontend sortiert, gefiltert 
und durchsucht werden können. Als Grundlage für die Auflistung dient eine beliebige Tabelle der Datenbank, wie z. B. 
die Mitgliedertabelle `tl_member`.

![Das Auflistungsmodul konfigurieren](/de/module-management/images/de/das-auflistungsmodul-konfigurieren.png)

**Tabelle:** Hier legst du die Tabelle fest, deren Datensätze aufgelistet werden sollen.

**Felder:** Gebe hier die Felder ein, die in der Auflistung dargestellt werden sollen. Trenne die einzelnen Felder mit 
einem Komma.

**Bedingung:** Hier kannst du eine Bedingung eingeben, nach der die Datensätze gefiltert werden. Da das Modul 
prinzipiell nichts anderes als eine Datenbankabfrage macht, kannst du hier SQL-konformen Code wie z. B. 
`published=1` verwenden. Auch der Einsatz von Insert-Tags ist möglich, z. B. `user={{user::id}}`.

**Durchsuchbare Felder:** Wenn du bestimmte Felder als durchsuchbar definierst, erstellt Contao automatisch ein 
Formular, mit dem diese durchsucht werden können.

**Sortieren nach:** Hier kannst du festlegen, nach welchen Spalten die Auflistung standardmäßig sortiert wird. Trenne 
mehrere Felder durch Kommata.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Ergebnisse automatisch auf 
mehrere Seiten – eine entsprechende Anzahl vorausgesetzt.

**Felder der Detailseite:** Wenn du hier ein oder mehrere Felder erfasst, fügt Contao jeder Zeile der Auflistung ein 
kleines Icon hinzu, mit dem du die Detailansicht eines Datensatzes aufrufen kannst. Auf der Detailseite kannst du 
zusätzliche Felder eines Datensatzes ausgeben, die in der Liste vielleicht keinen Platz haben.

**Detailseitenbedingung:** Hier kannst du eine Bedingung eingeben, nach der die Datensätze der Detailseite gefiltert 
werden (vgl. oben Bedingung).

**Listentemplate:** Hier wählst du das Template für die Listenansicht aus.

**Detailseitentemplate:** Hier wählst du das Template für die Detailseite aus.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<div class="mod_listing ce_table listing block">

    <div class="list_search">
        <form action="content-elements.html" method="get">
            <div class="formbody">
                <input type="hidden" name="order_by" value="">
                <input type="hidden" name="sort" value="asc">
                <input type="hidden" name="per_page" value="5">
                <div class="widget widget-select">
                    <label for="ctrl_search" class="invisible">Vorhandene Felder</label>
                    <select name="search" id="ctrl_search" class="select">
                        <option value="firstname">Vorname</option>
                        <option value="lastname">Nachname</option>
                    </select>
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_for" class="invisible">Suchbegriffe</label>
                    <input type="text" name="for" id="ctrl_for" class="text" value="">
                </div>
                <div class="widget widget-submit">
                    <button type="submit" class="submit">Suchen</button>
                </div>
            </div>
        </form>
    </div>

    <div class="list_per_page">
        <form action="content-elements.html" method="get">
            <div class="formbody">
                <input type="hidden" name="order_by" value="">
                <input type="hidden" name="sort" value="asc">
                <input type="hidden" name="search" value="">
                <input type="hidden" name="for" value="">
                <div class="widget widget-select">
                    <label for="ctrl_per_page" class="invisible">Ergebnisse pro Seite</label>
                    <select name="per_page" id="ctrl_per_page" class="select">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                </div>
                <div class="widget widget-submit">
                    <button type="submit" class="submit">Ergebnisse pro Seite</button>
                </div>
            </div>
        </form>
    </div>

    <table class="all_records">
        <thead>
            <tr>
            <th class="head col_first">
                <a href="…" title="Sortiere nach Vorname">Vorname</a>
            </th>
            <th class="head">
                <a href="…" title="Sortiere nach Nachname">Nachname</a>
            </th>
            <th class="head col_last">
                <a href="…" title="Sortiere nach E-Mail-Adresse">E-Mail-Adresse</a>
            </th>
            <th class="head col_last">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr class="row_0 row_first even">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
            <tr class="row_1 odd">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
            <tr class="row_2 row_last even">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
        </tbody>
    </table>
  
</div>
```

Das HTML-Markup der Detailseite sieht wie folgt aus:

```html
<div class="mod_listing listing block">
  
    <table class="single_record">
        <tbody>
            <tr class="row_0 row_first even">
                <td class="label">Benutzername</td>
                <td class="value">j.doe</td>
            </tr>
            <tr class="row_1 odd">
                <td class="label">Vorname</td>
                <td class="value">John</td>
            </tr>
            <tr class="row_2 even">
                <td class="label">Nachname</td>
                <td class="value">Doe</td>
            </tr>
            <tr class="row_3 odd">
                <td class="label">E-Mail-Adresse</td>
                <td class="value"><a href="…">…</a></td>
            </tr>
            <tr class="row_4 row_last even">
                <td class="label">Sprache</td>
                <td class="value">en</td>
            </tr>
        </tbody>
    </table>
    
    <!-- indexer::stop -->
        <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->

</div>
```

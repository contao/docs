---
title: "Navigationsmodule"
description: "Navigationsmodule sind mit die wichtigsten Frontend-Module überhaupt und kommen auf fast jeder Webseite 
in irgendeiner Form zum Einsatz."
url: "modulverwaltung/navigationsmodule"
weight: 1
---

Navigationsmodule sind mit die wichtigsten Frontend-Module überhaupt und kommen auf fast jeder Webseite in irgendeiner 
Form zum Einsatz. Ein Navigationsmodul erstellt aus der hierarchischen Seitenstruktur ein Navigationsmenü, das je nach 
Bedarf entweder den ganzen Seitenbaum oder bestimmte Teile davon abbildet. Deine Besucher können sich dann anhand 
dieses Navigationsmenüs durch die Seiten der Webseite klicken.


## Navigationsmenü

Das Frontend-Modul »Navigationsmenü« fügt der Webseite ein hierarchisches Navigationsmenü hinzu, das alle 
veröffentlichten und nicht versteckten Seiten inklusive deren Unterseiten enthält. Bei Bedarf kannst du das Modul so 
konfigurieren, dass nur die Hauptseiten oder nur die Unterseiten ab einer bestimmten Tiefe – in Contao »Level« genannt 
– ausgegeben werden, um so Haupt- und Untermenüs zu erstellen.

**Startlevel:** Standardmäßig beginnt das Navigationsmenü bei der höchsten Ebene und arbeitet sich durch alle 
Unterebenen bis zur am tiefsten verschachtelten Ebene. Das Startlevel bietet dir die Möglichkeit, das Navigationsmenü 
beispielsweise von der zweiten Ebene aus starten zu lassen, sodass nur ein Teil des Seitenbaums ausgegeben wird 
(Untermenü).

![Die Navigationsmenüs im Frontend](/de/module-management/images/de/die-navigationsmenues-im-frontend.png)

**Stoplevel:** Im Gegensatz zum Startlevel, das die Einstiegsebene des Navigationsmenüs vorgibt, bestimmt das Stoplevel 
die Ausstiegsebene, also die maximale Tiefe der Verschachtelung. Das Hauptmenü unserer Webseite soll beispielsweise nur 
die Hauptseiten darstellen, daher wurde die Ausgabe der Unterseiten mittels Stoplevel 1 auf die erste Ebene der 
Seitenstruktur beschränkt.

Das funktioniert so weit aber erst einmal nur für die Seiten der ersten Ebene. Wenn du eine Seite der zweiten oder 
dritten Ebene aufrufst, taucht diese inklusive aller ihr übergeordneten Seiten trotz des Stoplevels im Navigationsmenü 
auf. Dieses Verhalten ist auch so gewollt, denn der Pfad zur aktiven Seite soll immer vollständig im Navigationsmenü 
abgebildet werden.

Für eine echte Hauptnavigation wie auf unser Website ist dieses Verhalten aber eher kontraproduktiv, da hier 
tatsächlich nur die Seiten des ersten Levels benötigt werden und eventuell vorhandene Unterseiten in einem separaten 
Untermenü ausgegeben werden. Aus diesem Grund gibt es die Option **Hard Limit**, die dafür sorgt, dass niemals 
Unterseiten jenseits des Stoplevels angezeigt werden.

**Geschützte Seiten anzeigen:** Wenn du diese Option auswählst, werden geschützte Seiten immer im Navigationsmenü 
angezeigt. Standardmäßig sind solche Seiten nur sichtbar, wenn ein Frontend-Benutzer angemeldet ist.

**Versteckte Seiten anzeigen:** Wenn du diese Option auswählst, werden Menüpunkte angezeigt, die sonst in der 
Navigation nicht sichtbar sind.

**Eine Referenzseite festlegen:** Im Normalfall beginnt ein Navigationsmenü bei der Wurzelseite der Seitenstruktur 
(Startpunkt einer Webseite). Um hingegen nur einen Teilbaum abzubilden, kannst du hier einen individuellen Startpunkt 
festlegen.

**Navigationstemplate:** Hier wählst du das Template für die Navigation aus.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_navigation` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<nav class="mod_navigation block" itemscope itemtype="http://schema.org/SiteNavigationElement">
    
    <a href="#skipNavigation1" class="invisible">Navigation überspringen</a>
    
    <ul class="level_1">
        <li class="active start first">
            <strong class="active first" itemprop="name">…</strong>
        </li>
        <li class="submenu sibling">
            <a href="…" class="submenu sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>
            
            <ul class="level_2">
                <li class="noprevlink first">
                    <a href="…" class="noprevlink first" itemprop="url"><span itemprop="name">…</span></a>
                </li>            
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
                </li>
            </ul>
            
        </li>
        <li class="sibling last">
            <a href="…" class="sibling last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>
    
    <a id="skipNavigation1" class="invisible">&nbsp;</a>
    
</nav>
<!-- indexer::continue -->
```

Beachte, dass die CSS-Klassen jeweils dem `<li>`-Element und dem `<a>` bzw. `<strong>`-Element zugewiesen werden. 
Definiere in deinen Selektoren also genau, welche Elemente du meinst, z. B. `li.first` anstatt nur `.first`. Die 
jeweils aktive Seite wird gemäß den Anforderungen der Barrierefreiheit nicht als aktiver Link dargestellt, sondern als 
`<strong>`-Element.


## Individuelle Navigation

Das Frontend-Modul »Individuelle Navigation« fügt der Webseite ein Navigationsmenü aus beliebigen Seiten hinzu, das 
keine hierarchischen Abhängigkeiten berücksichtigt.

**Seiten:** Hier wählst du aus, welche Seiten in dem Menü enthalten sein sollen.

**Geschützte Seiten anzeigen:** Wenn du diese Option auswählst, werden geschützte Seiten in der individuellen 
Navigation angezeigt. Standardmäßig sind solche Seiten nur sichtbar, wenn ein Frontend-Benutzer angemeldet ist.

**Navigationstemplate:** Hier wählst du das Template für die Navigation aus.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_customnav` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<nav class="mod_customnav block" itemscope itemtype="http://schema.org/SiteNavigationElement">
    
    <a href="#skipNavigation1" class="invisible">Navigation überspringen</a>
    
    <ul class="level_1">
        <li class="active first">
            <strong class="active first" itemprop="name">…</strong>
        </li>
        <li class="last">
            <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>
    
    <a id="skipNavigation1" class="invisible">&nbsp;</a>
    
</nav>
<!-- indexer::continue -->
```


## Navigationspfad

**Versteckte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch versteckte Seiten im Navigationspfad 
angezeigt, die normalerweise übersprungen würden.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_breadcrumb` überschreiben.

![Der Navigationspfad im Frontend](/de/module-management/images/de/der-navigationspfad-im-frontend.png)

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_breadcrumb block">
    
    <ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li class="first" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="…" itemprop="item"><span itemprop="name">…</span></a><meta itemprop="position" content="1">
        </li>
        <li class="active last"> … </li>
    </ul>
    
</div>
<!-- indexer::continue -->
```


## Quicknavigation

Das Frontend-Modul »Quicknavigation« fügt der Webseite ein Drop-Down-Menü hinzu, mit dem ein Besucher direkt zu einer 
bestimmten Seite springen kann.

**Individuelle Bezeichnung:** Hier kannst du eine individuelle Bezeichnung für die erste Option der Quicknavigation 
eingeben.

**Stoplevel:** Hier legst de fest, bis zu welcher Verschachtelungstiefe Unterseiten in der Quicknavigation angezeigt 
werden (vgl. [Navigationsmenü](#navigationsmenu)).

**Hard Limit:** Wenn du diese Option auswählst, werden Menüpunkte jenseits des Stoplevels niemals anzeigt.

**Geschützte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch geschützte Seiten angezeigt, die sonst nur 
für angemeldete Mitglieder verfügbar sind.

**Versteckte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch versteckte Seiten in der Quicknavigation 
angezeigt, die normalerweise übersprungen würden.

**Referenzseite:** Hier legst du die Ausgangsseite der Quicknavigation fest.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_quicknav` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_quicknav block">

    <form method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_quicknav">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-select">
                <label for="ctrl_target" class="invisible">Zielseite</label>
                <select name="target" id="ctrl_target" class="select">
                    <option value="…">…</option>
                    <option value="…">…</option>
                </select>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Los</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Quicklink

Das Frontend-Modul »Quicklink« fügt der Webseite ein ein Drop-Down-Menü aus beliebigen Seiten hinzu, das 
keine hierarchischen Abhängigkeiten berücksichtigt.

**Seiten:** Hier wählst du aus, welche Seiten in dem Menü enthalten sein sollen.

**Individuelle Bezeichnung:** Hier kannst du eine individuelle Bezeichnung für die erste Option der Quicknavigation 
eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_quicklink` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_quicklink block">

    <form action="…" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_quicklink">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-select">
                <select name="target" class="select">
                <option value="…">…</option>
                <option value="…">…</option>
                <option value="…">…/option>
                </select>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Los</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Buchnavigation

Das Frontend-Modul »Buchnavigation« fügt der Webseite ein Navigationsmenü hinzu, mit dem du innerhalb der 
Seitenstruktur vorwärts, zurück oder eine Ebene nach oben navigieren kannst. Die einzelnen Seiten werden dabei wie bei 
einem Buch quasi umgeblättert, daher der Name des Moduls.

![Die Buchnavigation im Frontend](/de/module-management/images/de/die-buchnavigation-im-frontend.png)

**Referenzseite:** Die Referenzseite legt den Ausgangspunkt der Buchnavigation fest. Übergeordnete Seiten werden nicht 
in der Buchnavigation angezeigt.

**Geschützte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch geschützte Seiten angezeigt, die sonst nur 
für angemeldete Mitglieder verfügbar sind.

**Versteckte Seiten anzeigen:** Bei Auswahl dieser Option werden auch versteckte Seiten in der Buchnavigation 
angezeigt, die normalerweise übersprungen würden.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_booknav` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_booknav block">

    <ul>
        <li class="previous"><a href="…" >…</a></li>
        <li class="up"><a href="…">…</a></li>
        <li class="next"><a href="…">…</a></li>
    </ul>

</div>
<!-- indexer::continue -->
```


## Artikelnavigation

Das Modul »Artikelnavigation« fügt der Webseite ein Navigationsmenü hinzu, mit dem du ähnlich wie bei einer 
Buchnavigation die Artikel einer bestimmten Seite vorwärts- und rückwärts durchblättern kannst.

![Die Artikelnavigation im Frontend](/de/module-management/images/de/die-artikelnavigation-im-frontend.png)

**Erstes Element laden:** Wenn du diese Option auswählst, wird automatisch der erste Artikel geladen, wenn kein 
bestimmter Artikel angefordert wurde.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_articlenav` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_articlenav pagination block">

    <ul>
        <li class="active"><strong class="active">1</strong></li>
        <li class="link"><a href="…" class="link">2</a></li>
        <li class="link"><a href="…" class="link">3</a></li>
        <li class="next"><a href="…" class="next">Vorwärts</a></li>
        <li class="last"><a href="…" class="last">Ende</a></li>
    </ul>

</div>
<!-- indexer::continue -->
```

Beachte, dass das aktive Element als `<strong>` und nicht als Link ausgegeben wird.


## Sitemap

Das Frontend-Modul »Sitemap« fügt der Webseite eine Übersicht aller veröffentlichten und nicht versteckten Seiten 
hinzu. Die einzelnen Einträge werden als Links ausgegeben, sodass Besucher direkt zu einer bestimmten Seite springen 
können. Ob eine Seite in der Sitemap angezeigt wird oder nicht, hängt auch von ihrer Konfiguration in der 
Seitenstruktur ab (vgl. [Experten-Einstellungen](../../seitenstruktur/seiten-konfigurieren/#experten-einstellungen)).

**Geschützte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch geschützte Seiten angezeigt, die sonst nur 
für angemeldete Mitglieder verfügbar sind.

**Versteckte Seiten anzeigen:** Wenn du diese Option auswählst, werden auch versteckte Seiten in der Sitemap angezeigt, 
die normalerweise übersprungen würden.

**Referenzseite:** Hier legst du die Ausgangsseite der Sitemap fest.

**Navigationstemplate:** Hier wählst du das Template für das Modul aus.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_sitemap` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_sitemap block">

    <ul class="level_1">
        <li class="sibling first">
            <a href="…" class="sibling first" accesskey="1" itemprop="url"><span itemprop="name">…</span></a>
        </li>
        <li class="submenu trail sibling">
            <a href="…" class="submenu trail sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>
            
            <ul class="level_2">
                <li class="first">
                    <a href="…" class="first" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a></li>
            </ul>
            
        </li>
        <li class="submenu sibling">
            <a href="…" class="submenu sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>
            
            <ul class="level_2">
                <li class="first">
                    <a href="…" class="first" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
                </li>
            </ul>
            
        </li>
        <li class="sibling last">
            <a href="…" class="sibling last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>

</div>
<!-- indexer::continue -->
```

Das HTML-Markup entspricht weitestgehend dem des Navigationsmenüs.

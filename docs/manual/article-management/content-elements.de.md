---
title: "Inhaltselemente"
description: "Um das Anlegen von Inhalten möglichst intuitiv zu gestalten, gibt es in Contao für jeden Inhaltstyp ein 
Inhaltselement, das genau auf dessen Anforderungen abgestimmt ist."
url: "artikelverwaltung/inhaltselemente"
weight: 20
---

Um das Anlegen von Inhalten möglichst intuitiv zu gestalten, gibt es in Contao für jeden Inhaltstyp ein Inhaltselement, 
das genau auf dessen Anforderungen abgestimmt ist. Du kannst unbegrenzt viele Inhaltselemente pro Artikel anlegen und 
den Zugriff auf einzelne Elemente bei Bedarf einschränken.

![Den Zugriff auf ein Inhaltselement einschränken](/de/article-management/images/de/den-zugriff-auf-ein-modul-einschraenken.png?classes=shadow)

**Element schützen:** Das Inhaltselement ist standardmäßig unsichtbar und wird erst eingeblendet, nachdem sich ein 
Mitglied im Frontend angemeldet hat.

**Erlaubte Mitgliedergruppen:** Hier legst du fest, wer Zugriff auf das Inhaltselement hat.

**Nur Gästen anzeigen:** Das Inhaltselement ist standardmäßig sichtbar und wird ausgeblendet, sobald sich ein Mitglied 
im Frontend angemeldet hat.


## Überschrift {#ueberschrift}

Das Inhaltselement »Überschrift« fügt dem Artikel eine Überschrift hinzu. Die meisten Inhaltselemente unterstützen die 
direkte Eingabe einer Überschrift, sodass du das Element nicht jedes Mal separat verwenden musst.

**Überschrift:** Hier kannst du die Überschrift eingeben.

Mit dem Select-Menü rechts daneben kannst du die semantische Hierarchie dieser Überschrift festlegen. Die wichtigste 
Überschrift der Seite wird als `h1` angegeben (meist nur eine pro Seite), während die Werte `h2` bis `h6` hierarchisch 
niedrigere Überschriften abbilden und natürlich mehrfach vorkommen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_headline` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<h1 class="ce_headline first last">…</h1>
```


## Text

Das Inhaltselement »Text« fügt dem Artikel einen formatierten Text hinzu. Die Eingabe erfolgt über einen sogenannten 
Rich Text Editor, der es dir ähnlich wie in einem Textverarbeitungsprogramm erlaubt, bestimmte Formatierungen auf 
Knopfdruck zu setzen. Contao verwendet [TinyMCE](https://www.tiny.cloud/), einen Open Source Editor der schwedischen 
Firma Moxiecode, der sich gut an die Erfordernisse der Barrierefreiheit anpassen lässt.

![Der Rich Text Editor TinyMCE](/de/article-management/images/de/der-rich-text-editor-tinymce.png?classes=shadow)

**Überschrift:** Hier kannst du eine Überschrift eingeben.

Mit dem Select-Menü rechts daneben kannst du die semantische Hierarchie dieser Überschrift festlegen. Die wichtigste 
Überschrift der Seite wird als `h1` angegeben (meist nur eine pro Seite), während die Werte `h2` bis `h6` hierarchisch 
niedrigere Überschriften abbilden und natürlich mehrfach vorkommen.

**Text:** Hier gibst du den Text des Inhaltselements ein.

**Ein Bild hinzufügen**

Du kannst dem Textelement ein Bild hinzufügen, das dann von deinem Text umflossen wird. Folgende Optionen stehen dir 
dabei zur Verfügung:

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast, 
kannst du den Upload hier nachholen, ohne die Eingabemaske zu verlassen.

![Einem Text ein Bild hinzufügen](/de/article-management/images/de/einem-text-ein-bild-hinzufuegen.png?classes=shadow)

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi 
auswählen:

| Relatives Format               |                                                                                                                    |
|:-------------------------------|:-------------------------------------------------------------------------------------------------------------------|
| Proportional                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |
| An&nbsp;Rahmen&nbsp;anpassen   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |

&nbsp;

| Exaktes Format    |                                                                                                    |
|:------------------|:---------------------------------------------------------------------------------------------------|
| Wichtiger Teil    | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben.                         |
| Links / Oben      | Erhält den linken Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.        |
| Mitte / Oben      | Erhält den mittleren Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.     |
| Rechts / Oben     | Erhält den rechten Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.       |
| Links / Mitte     | Erhält den linken Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.     |
| Mitte / Mitte     | Erhält den mittleren Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.  |
| Rechts / Mitte    | Erhält den rechten Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.    |
| Links / Unten     | Erhält den linken Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.       |
| Mitte / Unten     | Erhält den mittleren Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.    |
| Rechts / Unten    | Erhält den rechten Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.      |

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird er 
![oberhalb](/de/icons/above.svg?classes=icon) **oberhalb**, 
![unterhalb](/de/icons/below.svg?classes=icon) **unterhalb**, 
![linksbündig](/de/icons/left.svg?classes=icon) **linksbündig** oder 
![rechtsbündig](/de/icons/right.svg?classes=icon) **rechtsbündig** eingefügt der Text umfließt das Bild.

**Bildabstand:** Hier legst du den Abstand des Bilds zum Text fest. Die Reihenfolge der Eingabefelder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße 
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

**Metadaten überschreiben:**  Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Hier kannst du einen alternativen Text für das Bild eingeben *(alt-Attribut)*. Eine 
barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die angezeigt wird, wenn das Objekt 
selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von Suchmaschinen ausgewertet und sind daher 
ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben *(title-Attribut)*.

**Bildlink-Adresse:** Bei einem Klick auf ein verlinktes Bild wirst du direkt zu der angegebenen Zielseite 
weitergeleitet (entspricht einem Bildlink). Beachte, dass für ein verlinktes Bild keine Lightbox-Großansicht mehr 
möglich ist.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_text` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_text first last block">
    <h2>…</h2>
    <p>…</p>
</div>
```

Wurde dem Text ein Bild hinzugefügt, sieht die HTML-Ausgabe wie folgt aus:

```html
<div class="ce_text first last block">
    <h2>…</h2>
    <figure class="image_container float_above">
        <img src="…" alt="…" title="…" itemprop="image">
        <figcaption class="caption">…</figcaption>
    </figure>
    <p>…</p> 
</div>
```


## HTML

Das Inhaltselement »HTML« fügt dem Artikel beliebigen HTML-Code hinzu. Beachte, dass nicht alle HTML-Tags standardmäßig 
erlaubt sind. Die Liste der erlaubten Tags findest du in den Backend-Einstellungen.

**HTML-Code:** Hier kannst du den HTML-Code eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_html` überschreiben.

Das Inhaltselement hat kein umschließenden HTML-Markup.


## Aufzählung {#aufzaehlung}

Das Inhaltselement »Aufzählung« fügt dem Artikel eine nicht verschachtelte Liste hinzu. Du kannst zwischen einer 
nummerierten (»ordered list«) und einer umnummerierten (»unordered list«) Aufzählung wählen. Beim Anlegen und 
Bearbeiten der Listenpunkte unterstützt dich ein JavaScript-Assistent.

![JavaScript-Assistent für Auflistungen](/de/article-management/images/de/javascript-assistent-fuer-auflistungen.png?classes=shadow)

Mit einem Klick auf das Icon ![Listendaten aus einer CSV-Datei importieren](/de/icons/tablewizard.svg?classes=icon) 
neben der Feldbezeichnung »Listeneinträge« öffnest du den CSV-Import-Wizard, mit dem du Listendaten aus einer CSV-Datei 
importieren kannst. Die CSV-Datei musst du vorher in das Upload-Verzeichnis übertragen haben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_list` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_list first last block">
    <ul>
        <li class="first">…</li>
        <li>…</li>
        <li class="last">…</li>
    </ul>
</div>
```

Eine nummerierte Aufzählung verwendet das `<ol>`-Tag statt des `<ul>`-Tags.


## Tabelle

Das Inhaltselement »Tabelle« fügt dem Artikel eine Tabelle hinzu. Beim Anlegen der Reihen und Spalten unterstützt dich 
ein JavaScript-Assistent. Mit den folgenden Navigationsicons kannst du die Tabelle bearbeiten:

- ![Die Eingabefelder verkleinern](/de/icons/demagnify.svg?classes=icon) **Die Eingabefelder verkleinern**
- ![Die Eingabefelder vergrößern](/de/icons/magnify.svg?classes=icon) **Die Eingabefelder vergrößern**
- ![Die Spalte/Reihe duplizieren](/de/icons/copy.svg?classes=icon) **Die Spalte/Reihe duplizieren**
- ![Die Spalte eine Position nach links verschieben](/de/icons/movel.svg?classes=icon) 
**Die Spalte eine Position nach links verschieben**
- ![Die Spalte eine Position nach rechts verschieben](/de/icons/mover.svg?classes=icon) 
**Die Spalte eine Position nach rechts verschieben**
- ![Die Spalte/Reihe löschen](/de/icons/delete.svg?classes=icon) **Die Spalte/Reihe löschen**
- ![Das Element durch Ziehen und Ablegen verschieben](/de/icons/drag.svg?classes=icon) 
**Das Element durch Ziehen und Ablegen verschieben**

![JavaScript-Assistent für Tabellen](/de/article-management/images/de/javascript-assistent-fuer-tabellen.png?classes=shadow)

Mit einem Klick auf das Icon ![Listendaten aus einer CSV-Datei importieren](/de/icons/tablewizard.svg?classes=icon) 
neben der Feldbezeichnung »Tabelleneinträge« öffnest du den CSV-Import-Wizard, mit dem du Tabellendaten aus einer 
CSV-Datei importieren kannst. Die CSV-Datei musst du vorher in das Upload-Verzeichnis übertragen haben.

**Zusammenfassung:** Eine barrierefreie Webseite sollte für jede Tabelle eine kurze Zusammenfassung des Inhalts 
enthalten, die du hier eingeben kannst.

**Kopfzeile hinzufügen:** Wenn du diese Option auswählst, wird die erste Reihe der Tabelle mithilfe des 
`<thead>`-Tags als Kopfzeile formatiert.

**Fusszeile hinzufügen:** Wenn du diese Option auswählst, wird die letzte Reihe der Tabelle mithilfe des 
`<tfoot>`-Tags als Fußzeile formatiert.

**Reihenüberschriften hinzufügen:** Wenn du diese Option auswählst, wird die erste Reihe der Tabelle mithilfe des 
`<th>`-Tags als Reihenüberschriften formatiert.

**Sortierbare Tabelle:** Macht die Tabelle im Frontend mittels JavaScript sortierbar. Das *moo_tablesort*- oder 
*j_tablesort*-Template muss im Seitenlayout eingebunden sein.

**Sortierindex:** Die Nummer der Spalte nach der standardmäßig sortiert werden soll, solange der Besucher noch keine 
Auswahl getroffen hat. Die Zählung beginnt bei 0.

**Sortierreihenfolge:** Die Reihenfolge der Standardsortierung (auf- oder absteigend).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_table` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_table first last block">
    <table id="table" class="sortable" data-sort-default="0|asc">
    <caption>…</caption>
    
    <thead>
        <tr>
            <th class="head_0 col_first unsortable">…</th>
            <th class="head_1">…</th>
            <th class="head_2">…</th>
            <th class="head_3 col_last">…</th>
        </tr>
    </thead>
    
    <tfoot>
        <tr>
            <td class="foot_0 col_first">…</td>
            <td class="foot_1">…</td>
            <td class="foot_2">…</td>
            <td class="foot_3 col_last">…</td>
        </tr>
    </tfoot>
    
    <tbody>
        <tr class="row_0 row_first odd">
            <th scope="row" class="col_0 col_first">…</th>
            <td class="col_1">…</td>
            <td class="col_2">…</td>
            <td class="col_3 col_last">…</td>
        </tr>
        <tr class="row_1 row_last even">
            <th scope="row" class="col_0 col_first">…</th>
            <td class="col_1">…</td>
            <td class="col_2">…</td>
            <td class="col_3 col_last">…</td>
        </tr>
    </tbody>
    
    </table>
</div>
```


## Code

Das Inhaltselement »Code« fügt dem Artikel formatierten Code hinzu. Die Eingabe erfolgt über einen sogenannten 
Code-Editor. Contao verwendet den Open Source Code-Editor von [Ace](https://ace.c9.io/). 

Damit die Ausgabe im Frontend funktioniert, muss das *js_highlight*-Template im Seitenlayout eingebunden sein.

**Syntaxhervorhebung:** Hier kannst du die gewünschte Skriptsprache auswählen. Folgende Skriptsprache stehen zur 
Verfügung:

- Apache
- Bash
- C#
- C++
- CSS
- Diff
- HTML
- HTTP
- Ini
- JSON
- Java
- JavaScript
- Markdown
- Nginx
- Perl
- PHP
- PowerShell
- Python
- Ruby
- SCSS
- SQL
- YAML
- XML

**Code:** Hier kannst du den gewünschten Code eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_code` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_code first last block">
    <pre><code class="apache">…</code></pre>
</div>
```


## Markdown

Mit dem Inhaltselement »Markdown« wird aus einem Markdown-Text HTML-Code erzeugt.

**Code:** Hier kannst du den gewünschten Code eingeben. Beachte, dass der Code nicht ausgeführt wird.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_markdown` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_markdown first last block">
    <div>
        <h1>…</h1>
        <p>…</p>
    </div>
</div>
```

Nachfolgend einige Beispiele für die Markdown-Syntax:


### Syntax


#### Paragrafen

Absätze werden durch eine Leerzeile erstellt:

```md
Erster Absatz

Zweiter Absatz
``` 


#### Überschriften

Es sind sechs Ebenen für Überschriften möglich:

```md
# Überschrift 1
## Überschrift 2
### Überschrift 3
#### Überschrift 4
##### Überschrift 5
###### Überschrift 6
```


#### Wichtig

Um wichtigen Text zu markieren:

```md
**strong**
__strong__
```

Wird zu folgendem HTML-Code konvertiert: 
```html
<strong>strong</strong>
```


#### Hervorhebung

Um Text hervor zu heben:

```md
*emphasize*
_emphasize_
```

Wird zu folgendem HTML-Code konvertiert:
```html
<em>emphasize</em>
```

#### Code

Um einen Text als Computercode zu markieren:

```md
`monospaced font`
```

Wird zu folgendem HTML-Code konvertiert: 
```html
<code>monospaced font</code>
```

#### Code-Blöcke

Um einen ganzen Absatz in Code zu konvertieren, den Text mit vier Leerzeichen einrücken.

```md
Schrift mit fester Laufweite ...
... über mehrere Zeilen
```

#### Zitat-Block

Zitatblöcke können durch eine rechte spitze Klammer am Beginn der Zeile erstellt werden.

```md
> Dies ist ein Zitat.
```


#### Zeilenumbruch

Durch zwei oder mehr Leerzeichen am Ende einer Zeile wird ein Umbruch erzeugt:

```md
Contao ist ein barrierefreies Open Source  
content management system.
```


#### Links

Es gibt zwei Möglichkeiten für Links: **inline** und **als Referenz**.

Ein Inline-Link sieht wie folgt aus:

```md
[Contao](https://contao.org/de)
```

oder optional auch mit einem Titel:

```md
[Contao](https://contao.org/de "Offizielle Contao-Webseite")
```

Ein Referenz-Link sieht wie folgt aus:

```md
[Offizielle Contao-Webseite][1]

[1]:https://contao.org/de
```

Die Referenz kann an beliebiger Stelle im Dokument platziert werden.


#### Bilder

Wie für Links gibt es auch für Bilder zwei Syntax-Möglichkeiten.

Ein Inline-Bild sieht wie folgt aus:

```md
![Alt text](/de/pfad/zum/bild.jpg "Optionaler Titel")
```

Ein Bild im Referenz-Stil wird durch folgende Syntax erreicht:

```md
![Alternativer Text][id]

[id]: /pfad/zum/bild.jpg "Optionaler Titel"
```

Die Referenz kann an beliebiger Stelle im Dokument platziert werden.


#### Aufzählungslisten

**Unsortierte Listen**

Unsortierte Listen verwenden Sternzeichen oder Trennstriche:

```md
* Listeneintrag  
* Listeneintrag  
    * Verschachtelter Listeneintrag
    * Verschachtelter Listeneintrag
* Listeneintrag

- Listeneintrag  
- Listeneintrag  
- Listeneintrag
```

**Sortierte Listen**

Sortierte Listen verwenden Zahlen:

```md
1. Listeneintrag  
2. Listeneintrag  
3. Listeneintrag
```


### Erweiterter Syntax

Nicht alle HTML-Element wie beispielsweise Tabellen oder Fußnoten können mit normalem Markdown beschrieben werden. 
Aus diesem Grund gibt es ein Projekt für »Markdown Extra« um die Syntax zu erweitern.

Nachfolgend einige Beispiele für die erweiterte Syntax:


#### Tabellen

Eine Tabelle kann wie folgt erstellt werden:

```md
Erste Kopfzeile | Zweite Kopfzeile | Dritte Kopfzeile  
--------------- | ---------------- | ----------------  
Zelleninhalt    | Zelleninhalt     | Zelleninhalt  
Zelleninhalt    | Zelleninhalt     | Zelleninhalt  
```

Die Textausrichtung kann durch Doppelpunkte gesteuert werden:

```md
Erste Kopfzeile | Zweite Kopfzeile | Dritte Kopfzeile  
:-------------- | :--------------: | ---------------:  
Linksbündig     | Zentriert        | Rechtsbündig  
Linksbündig     | Zentriert        | Rechtsbündig  
```


#### Fußnoten

Fußnoten werden wie folgt erstellt:

```md
Dies ist ein Text mit Fußnote.[^1]

[^1]: Und dies ist die Fußnote.
```

Die Fußnoten-Definition kann an beliebiger Stelle im Dokument platziert werden.


### Weitere Informationen

Für eine komplette Dokumentation zu Markdown, besuche die 
[offizielle Webseite](http://daringfireball.net/projects/markdown/syntax).

Für eine komplette Dokumentation zu Markdown Extra, besuche die 
[offizielle Webseite](http://michelf.ca/projects/php-markdown/extra).


## Akkordeon

Der Akkordeon-Effekt erlaubt das Anlegen mehrerer Abschnitte, von denen jeweils nur einer geöffnet ist. Wird ein 
anderer Abschnitt ausgewählt, schließt sich der erste automatisch.

**Betriebsart:** Hier wählst du die Betriebsart des Akkordeon-Elements aus.

| Betriebsart              | Erklärung                                                                                                                                  |
|:-------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------|
| Einzelnes&nbsp;Element   | In diesem Modus legt das Element einen einzelnen Akkordeon-Abschnitt mit einem Textelement und einem optionalen Bild an.                   |
| Umschlag Anfang          | In diesem Modus eröffnet das Element einen neuen Akkordeon-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können.    |
| Umschlag Ende            | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Akkordeon-Abschnitt.                                 |

**Bereichsüberschrift:** Jeder Akkordeon-Abschnitt hat eine immer sichtbare Überschrift, über die er geöffnet werden 
kann. HTML-Eingaben sind hier erlaubt.

**CSS-Format:** Falls du die Bereichsüberschrift mittels CSS-Code formatieren möchtest, kannst du hier eine 
Formatdefinition erfassen.

**Klassennamen:** Lasse das Feld leer, um die Standard-Klassennamen zu verwenden, oder gib eigene Toggler- und 
Accordion-Klassen ein.

**Text:** Hier kannst du den Text des Akkordeon-Abschnitts eingeben. Die Eingabe erfolgt wie beim Textelement über den 
Rich Text Editor.

**Ein Bild hinzufügen:** Hier kannst du dem Element ein Bild hinzufügen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_accordionSingle` bzw. `ce_accordionStart` 
überschreiben.

**HTML-Ausgabe**  
Das Element generiert bei einem »Einzelnes Element« folgenden HTML-Code:

```html
<section class="ce_accordionSingle first ce_accordion ce_text block">

    <div class="toggler">…</div>
    
    <div class="accordion">
        <div>
            <p>…</p>
        </div>
    </div>

</section>
```

Ansonsten sieht der generierte HTML-Code wie folgt aus:

```html
<section class="ce_accordionStart first ce_accordion block">

    <div class="toggler">…</div>
    
    <div class="accordion">
        <div>
            <div class="ce_text block">
                <p>…</p> 
            </div>
        </div>
    </div>

</section>
```

Beachte, dass die Inhalte jedes Akkordeon-Abschnitts von jeweils zwei (!) `&lt;div&gt;`-Elementen 
umschlossen werden. Das ist notwendig, damit der Effekt browserübergreifend funktioniert und formatiert werden kann.


## Content-Slider

Mit dem Inhaltselement »Content-Slider« wird aus verschiedenen Inhaltselementen ein Slider erstellt.  

Damit der Slider funktioniert muss das *js_slider*-Template im Seitenlayout eingebunden sein.

**Betriebsart:** Hier wählst du die Betriebsart des Slider-Elements aus.

| Betriebsart             | Erklärung                                                                                                                            |
|:------------------------|:-------------------------------------------------------------------------------------------------------------------------------------|
| Umschlag&nbsp;Anfang    | In diesem Modus eröffnet das Element einen neuen Slider-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können. |
| Umschlag Ende           | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Slider-Abschnitt.                              |

**Slide-Intervall:** Hier kannst du den Zeitraum in Millisekunden zwischen den Slides (1000 = 1s) bestimmen. 0 
deaktiviert den automatischen Wechsel.

**Übergangsgeschwindigkeit:** Hier kannst du die Übergangsgeschwindigkeit in Millisekunden (1000 = 1s) bestimmen.

**Slide-Versatz:** Hier kannst du den Slider mit einer bestimmten Folie beginnen (die Zählung beginnt bei 0).

**Kontinuierlich:** Einen kontinuierlichen Slider erstellen (beim Erreichen des Endes von vorne beginnen).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_sliderStart` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_sliderStart first block">

    <div class="content-slider" data-config="5000,300,0,1">
        <div class="slider-wrapper">    
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
        </div>
    </div>
    
    <nav class="slider-control">
        <a href="#" class="slider-prev">Zurück</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Vorwärts</a>
    </nav>

</div>
```


## Hyperlink

Das Inhaltselement »Hyperlink« fügt dem Artikel einen Link auf eine externe Webseite oder eine E-Mail-Adresse hinzu. Du 
kannst Hyperlinks natürlich auch über den Rich Text Editor im Textelement eingeben.

![Einen Hyperlink anlegen](/de/article-management/images/de/einen-hyperlink-anlegen.png?classes=shadow)

**Link-Adresse:** Gebe die Link-Adresse inklusive des Netzwerkprotokolls ein. Für Webseiten lautet das 
Netzwerkprotokoll normalerweise `http://` oder `https://`, für E-Mail-Adressen `mailto:` und für Telefonnummern `tel:`. 
Contao verschlüsselt E-Mail-Adressen automatisch, sodass sie nicht von Spambots ausgelesen werden können.

**In neuem Fester öffnen:** Öffnet den Link in einem neuen Browserfenster. 

**Link-Text:** Der Link-Text wird anstelle der Link-Adresse angezeigt.

**Den Link einbetten:** Um nur bestimmte Wörter eines Satzes in einen Hyperlink zu verwandeln, kannst du den Link in 
den Satz einbetten. Lautet der Titel des Links beispielsweise »Firmenseite«, kannst du ihn in den Satz »Besuchen Sie 
unsere %s!« einbetten. Der Platzhalter %s wird bei der Ausgabe durch den Link ersetzt, sodass im Frontend schließlich 
der Satz »Besuchen Sie unsere Firmenseite!« steht.

**Link-Titel:** Der Link-Titel wird als `title`-Attribut im HTML-Markup eingefügt.

**Lightbox:** Hier kannst du das `data-lightbox`-Attribut des Links festlegen, das zur Steuerung der Lightbox verwendet wird.

**Bildlink-Einstellungen**

Wenn du die Option **Einen Bildlink erstellen** auswählst, kannst du statt eines Textlinks einen Bildlink erstellen. 
Alternativ dazu kannst du auch ein Bildelement erstellen und mit einem Link versehen.

![Einen Bildlink erstellen](/de/article-management/images/de/einen-bildlink-erstellen.png?classes=shadow)

**Quelldatei:** Hier wählst du das zu verwendende Bild aus.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
[Text](#text).

**Metadaten überschreiben:** Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Eine barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die 
angezeigt wird, wenn das Objekt selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von 
Suchmaschinen ausgewertet und sind daher ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben (title-Attribut).

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_hyperlink` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_hyperlink first last block">
    … <a href="…" class="hyperlink_txt" title="…" data-lightbox="…" target="_blank" rel="noreferrer noopener">…</a> …
</div>
```

Wird ein Bildlink verwendet, sieht die HTML-Ausgabe wie folgt aus:

```html
<div class="ce_hyperlink first last block">

    <figure class="image_container">
        <a href="… class="hyperlink_img" target="_blank" rel="noreferrer noopener">
            <img src="…" alt="…" title="…" itemprop="image">
        </a>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
```


## Top-Link

Das Inhaltselement »Top-Link« fügt dem Artikel einen Link hinzu, mit dem du an den Anfang der Seite springen kannst. 
Das ist speziell bei langen Seiten sinnvoll.

**Link-Text:** Hier kannst du eine Bezeichnung für den Link eingeben. Wenn du das Feld leer lässt, wird die 
Standardbezeichnung »Nach oben« verwendet.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_text` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="ce_toplink first last block">
    <a href="#top" title="Nach oben">Nach oben</a>
</div>
<!-- indexer::continue -->
```


## Bild

Das Inhaltselement »Bild« fügt dem Artikel ein Bild hinzu. Ein Bild kann eine Großansicht haben oder als Bildlink auf 
eine bestimmte URL verweisen.

![Ein Bildelement anlegen](/de/article-management/images/de/ein-bildelement-anlegen.png?classes=shadow)

**Quelldatei:** Hier wählst du das zu verwendende Bild aus.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

*Bildabstand:* Hier legst du den Abstand des Bilds zum Text fest. Die Reihenfolge der Eingabefelder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße 
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

**Metadaten überschreiben:** Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Eine barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die 
angezeigt wird, wenn das Objekt selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von 
Suchmaschinen ausgewertet und sind daher ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben (title-Attribut).

**Bildlink-Adresse:** Bei einem Klick auf ein verlinktes Bild wirst du direkt zu der angegebenen Zielseite 
weitergeleitet (entspricht einem Bildlink). Beachte, dass für ein verlinktes Bild keine Lightbox-Großansicht mehr 
möglich ist.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_image` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
div class="ce_image first last block">
    <figure class="image_container">
        <a href=…" title="…" data-lightbox="…">
            <img src="…" alt="…" itemprop="image">
        </a>
        <figcaption class="caption">…</figcaption>
    </figure>
</div>
```


## Galerie

Das Inhaltselement »Bildergalerie« fügt dem Artikel eine Bildergalerie hinzu, also eine Sammlung mehrerer 
Vorschaubilder (engl. »Thumbnails«), die in einer Liste aufgelistet sind und beim Anklicken vergrößert werden. Bei 
sehr vielen Bildern kann die Galerie auf mehrere Seiten verteilt werden.

![Die Bildergalerie im Frontend](/de/article-management/images/de/die-bildergalerie-im-frontend.png?classes=shadow)

**Quelldateien:** Hier wählst du einen oder mehrere Ordner bzw. Dateien aus, die in der Bildergalerie enthalten sein 
sollen. Wenn du einen Ordner auswählst, übernimmt Contao automatisch alle darin enthaltenen Bilder in die Galerie. Die 
einzelnen Bilder können durch Ziehen umsortiert werden.

**Sortieren nach:** Hier wählst du die Sortierreihenfolge aus. Es stehen folgende Sortierreihenfolgen zur Verfügung:

- Individuelle Reihenfolge
- Dateiname (aufsteigend)
- Dateiname (absteigend)
- Datum (aufsteigend)
- Datum (absteigend)
- Zufällige Reihenfolge

**Dateien ohne Metadaten ignorieren:** Wenn bei den Dateien keine Metadaten zur passenden Seitensprache eingepflegt 
wurden, werden sie bei der Aktivierung nicht angezeigt.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Bildabstand:** Hier kannst du den Abstand des Bilds zum Text festlegen. Die Reihenfolge der Felder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Vorschaubilder pro Reihe:** Hier legst du die Anzahl der Vorschaubilder pro Reihe fest.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße in der 
Lightbox geöffnet (dazu ist JavaScript erforderlich).

**Elemente pro Seite:** Contao kann große Bildergalerien automatisch auf mehrere Seiten verteilen, sodass sich die 
Ladezeit der Galerie verringert. Lege hier fest, wie viele Vorschaubilder pro Seite maximal angezeigt werden sollen.

**Gesamtzahl der Bilder:** Hier kannst du die Gesamtzahl der Bilder begrenzen. Gebe 0 ein, um alle anzuzeigen.

**Galerietemplate:** Hier kannst du das Galerietemplate überschreiben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_gallery` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_gallery first last block">

    <ul class="cols_2" itemscope itemtype="http://schema.org/ImageGallery">
        <li class="row_0 row_first row_last even col_0 col_first">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
        <li class="row_0 row_first row_last even col_1 col_last">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
    </ul>

    <!-- indexer::stop -->
    <nav class="pagination block" aria-label="Seitenumbruch-Menü">
        <p>Seite 1 von 2</p>
        <ul>
            <li><strong class="active">1</strong></li>
            <li><a href="…" class="link" title="Gehe zu Seite 2">2</a></li>
            <li class="next"><a href="…" class="next" title="Gehe zu Seite 2">Vorwärts</a></li>
        </ul>
    </nav>
    <!-- indexer::continue -->

</div>
```


## Video/Audio

Das Inhaltselement »Video/Audio« fügt dem Artikel eine Video- bzw. Audio-Datei hinzu. 

**Video-/Audio-Dateien:** Hier kannst du die Video-/Audio-Datei bzw. – wenn du verschiedene Codecs verwendest – die 
Video-/Audio-Dateien hinzufügen.

{{< version "4.6" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- Steuerelemente verbergen
- In einer Schleife abspielen
- Inline abspielen (kein Vollbildmodus)
- Die Audioausgabe stummschalten

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Stopp bei:** Die Wiedergabe wird bei der festgelegten Anzahl an Sekunden beendet. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Preloading:** Hier kannst du dem Browser empfehlen, wie der Browser das Video vorab laden soll. Es stehen folgende 
drei Möglichkeiten zur Verfügung »Auto (das ganze Video vorab laden)«, »Metadata (nur die Metadaten vorab laden)« und 
»None (nichts vorab laden)«

**Vorschaubild:** Das Bild statt des ersten Frame des Videos vor dem Abspielen anzeigen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_player` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_player first last block">

    <figure class="video_container">
        <video width="…" height="…" autoplay loop playsinline muted>
            <source type="video/mp4" src="…" title="…">
        </video>
        <figcaption class="caption">……</figcaption>
    </figure>

</div>
```


## YouTube

Das Inhaltselement »YouTube« fügt dem Artikel ein YouTube-Video hinzu. 

**YouTube-ID:** Bitte gebe die YouTube-Video-ID für dein Video ein (z. B. rOGhp63Lvbo).

{{< version "4.5" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- Steuerelemente verbergen
- Untertitel standardmäßig anzeigen
- Den Fullscreen-Button ausblenden
- Die Contao-Seitensprache verwenden
- Anmerkungen verstecken
- Das YouTube-Logo ausblenden
- Keine ähnlichen Videos am Ende zeigen
- Die Linkleiste in der Vorschau ausblenden
- Die youtube-nocookie.com-Domain verwenden

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Stopp bei:** Die Wiedergabe wird bei der festgelegten Anzahl an Sekunden beendet. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Seitenverhältnis:** Hier kannst du das 
[Seitenverhältnis des Videos](https://de.wikipedia.org/wiki/Bildaufl%C3%B6sung#Video) bestimmen, um es responsive zu 
machen.

{{< version "4.8" >}}

**Verwenden Sie ein Startbild:** Das Video wird erst geladen, nachdem der Benutzer auf das Startbild geklickt hat.

**Quelldatei:** Hier wählst du ein Bild aus der Dateiübersicht.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_youtube` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="ce_youtube first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://www.youtube-nocookie.com/embed/rOGhp63Lvbo?autoplay=1&amp;controls=0&amp;cc_load_policy=1&amp;fs=0&amp;hl=de&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;start=10">
                <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```


## Vimeo

Das Inhaltselement »Vimeo« fügt dem Artikel ein Vimeo-Video hinzu. 

**Vimeo-ID:** Bitte gebe die Vimeo-Video-ID ein (z. B. 275028611).

{{< version "4.5" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- In einer Schleife abspielen
- Das Profilbild ausblenden
- Den Titel ausblenden
- Den Autor ausblenden

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Farben der Steuererlemente:** Hier kannst du einen hexadezimalen Farbcode (z. B. ff0000) für die Steuerelemente 
eingeben.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Seitenverhältnis:** Hier kannst du das 
[Seitenverhältnis des Videos](https://de.wikipedia.org/wiki/Bildaufl%C3%B6sung#Video) bestimmen, um es responsive zu 
machen.

{{< version "4.8" >}}

**Verwenden Sie ein Startbild:** Das Video wird erst geladen, nachdem der Benutzer auf das Startbild geklickt hat.

**Quelldatei:** Hier wählst du ein Bild aus der Dateiübersicht.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_vimeo` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="ce_vimeo first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://player.vimeo.com/video/275028611?autoplay=1&amp;loop=1&amp;portrait=0&amp;title=0&amp;byline=0&amp;color=ff0000#t=10s">
            <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```


## Download

Das Inhaltselement »Download« fügt dem Artikel einen Download-Link hinzu. Beim Anklicken des Links öffnet sich der 
»Datei speichern unter …«-Dialog und du kannst die verlinkte Datei auf deinem lokalen Rechner speichern.

Die Besonderheit in Contao ist, dass dieser Download-Link auch mit geschützten Dateien funktioniert, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst im Abschnitt [Dateiverwaltung](../../dateiverwaltung/).

**Quelldatei:** Hier kannst du die Download-Datei auswählen.

{{< version "4.8" >}}

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Link-Text:** Der Link-Text wird anstelle des Dateinamens angezeigt.

**Link-Titel:** Der Link-Titel wird als `title`-Attribut im HTML-Markup eingefügt.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_download` überschreiben.

Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte 
Download-Dateitypen« festgelegt hast.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_download first last block">
    <p class="download-element ext-pdf">
        <a href="…" title="…">… <span class="size">(…)</span></a>
    </p>
</div>
```


## Downloads

Das Inhaltselement »Downloads« fügt dem Artikel mehrere Download-Links hinzu. Beim Anklicken eines Links öffnet sich 
der »Datei speichern unter …«-Dialog, und du kannst die Datei auf deinem lokalen Rechner speichern.

![Das Downloads-Element im Frontend](/de/article-management/images/de/das-downloads-element-im-frontend.png?classes=shadow)

Die Besonderheit in Contao ist, dass diese Download-Links auch mit geschützten Dateien funktionieren, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst du im Abschnitt [Dateiverwaltung](../../dateiverwaltung/).

**Quelldateien:** Hier wählst du einen oder mehrere Ordner bzw. Dateien aus, die in dem Donwloads-Element enthalten 
sein sollen. Wenn du einen Ordner auswählst, übernimmt Contao automatisch alle darin enthaltenen herunterladbaren 
Dateien.

{{< version "4.8" >}}

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Sortieren nach:** Hier wählst du die Sortierreihenfolge aus. Es stehen folgende Sortierreihenfolgen zur Verfügung:

- Individuelle Reihenfolge
- Dateiname (aufsteigend)
- Dateiname (absteigend)
- Datum (aufsteigend)
- Datum (absteigend)
- Zufällige Reihenfolge

**Dateien ohne Metadaten ignorieren:** Wenn bei den Dateien keine Metadaten zur passenden Seitensprache eingepflegt 
wurden, werden sie bei der Aktivierung nicht angezeigt.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_downloads` überschreiben.

Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte 
Download-Dateitypen« festgelegt hast.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_downloads first last block">
    <ul>
        <li class="download-element ext-jpg">
            <a href="…" title="…">… <span class="size">(…)</span></a>
        </li>
        <li class="download-element ext-jpg">
            <a href="…" title="…">… <span class="size">(…)</span></a>
        </li>
        <li class="download-element ext-jpg">
            <a href="…" title="…">… <span class="size">(…)</span></a>
        </li>
    </ul>
</div>
```


## Artikel

Das Inhaltselement »Artikel« ermöglicht die mehrfache Einbindung eines Artikels, ohne dass dieser dafür kopiert werden 
muss. Beachte, dass nur die Inhaltselemente und nicht der Artikel-Header übernommen werden.

**Bezogener Artikel:** Hier wählst du den Originalartikel aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Inhaltselement

Das Inhaltselement »Inhaltselement« dient dazu, ein vorhandenes Inhaltselement ein zweites Mal einzufügen, ohne es 
dafür kopieren zu müssen. Der Vorteil dieser Methode ist, dass du eventuelle Änderungen nur in dem originalen 
Inhaltselement erfassen musst und diese automatisch in allen Aliaselementen übernommen werden.

**Bezogenes Inhaltselement:** Hier wählst du das Originalelement aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Formular

Das Inhaltselement »Formular« fügt dem Artikel ein Formular hinzu. Informationen zur Erstellung und Verwaltung von 
Formularen findest du im Abschnitt [Formulargenerator](../../formulargenerator/).

**Formular:** Wähle hier das Formular aus, das du einfügen möchtest.


## Modul

Das Inhaltselement »Modul« fügt dem Artikel ein Frontend-Modul hinzu. Wie du Module erstellst und konfigurierst, weißt 
du ja bereits aus dem Abschnitt [Modulverwaltung](../../modulverwaltung/).

**Modul:** Hier wählst du das Modul aus, das du einfügen möchtest.

Die HTML-Ausgabe richtet sich nach dem jeweiligen Modultyp.


## Artikelteaser

Das Inhaltselement »Artikelteaser« fügt dem Artikel den Teasertext eines anderen Artikels, gefolgt von einem 
Weiterlesen-Link, hinzu. Beim Anklicken dieses Links wirst du direkt zu dem verlinkten Artikel weitergeleitet.

**Artikel:** Hier wählst du den Originalartikel aus.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_teaser` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_teaser first last ce_text block">
    <h1>…</h1>
    <p class="more"><a href="…" title="…">Weiterlesen …<span class="invisible"> …</span></a></p>
</div>
```


## Kommentare

Das Inhaltselement »Kommentare« bietet Besuchern die Möglichkeit, Kommentare auf deiner Webseite zu hinterlassen. Du 
kannst auch ein Gästebuch damit betreiben.

**Sortierreihenfolge:** Hier legst du die Reihenfolge der Kommentare fest. Gästebücher zeigen normalerweise den 
neuesten Eintrag zuerst (absteigende Sortierung), Kommentare hingegen den ältesten (aufsteigende Sortierung).

**Elemente pro Seite:** Hier kannst die Anzahl der Kommentare pro Seite festlegen. Contao erzeugt bei Bedarf 
automatisch einen Seitenumbruch. Gebe 0 ein, um den automatischen Seitenumbruch zu deaktivieren.

**Moderieren:** Wenn du diese Option wählst, erscheinen Kommentare nicht sofort auf der Webseite, sondern erst, nachdem 
du sie im Backend freigegeben hast.

**BBCode erlauben:** Wenn du diese Option wählst, können deine Besucher [BBCode](https://de.wikipedia.org/wiki/BBCode) 
zur Formatierung ihrer Kommentare verwenden. Folgende Tags werden unterstützt:

| Tag                                  | Erklärung                                   |
|:-------------------------------------|:--------------------------------------------|
| `[b][/b]`                            | Fettschrift                                 |
| `[i][/i]`                            | Kursivschrift                               |
| `[u][/u]`                            | Unterstrichen                               |
| `[img][/img]`                        | Bild einfügen                               |
| `[code][/code]`                      | Programmcode einfügen                       |
| `[color=#f00][/color]`               | Farbiger Text                               |
| `[quote][/quote]`                    | Zitat einfügen                              |
| `[quote=Tim][/quote]`                | Zitat mit Nennung des Urhebers einfügen     |
| `[url][/url]`                        | Link einfügen                               |
| `[url=http://example.com][/url]`     | Link mit Linktitel einfügen                 |
| `[email][email]`                     | E-Mail-Adresse einfügen                     |
| `[email=info@example.com][/email]`   | E-Mail-Adresse mit Titel einfügen           |

**Login zum Kommentieren benötigt:** Wenn du diese Option auswählst, können nur angemeldete Mitglieder Kommentare 
hinzufügen. Die bereits abgegebenen Kommentare sind aber weiterhin für alle Besucher der Webseite sichtbar.

**Sicherheitsfrage deaktivieren:** Hier kannst du die Sicherheitsfrage deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.

**Kommentartemplate:** Hier kannst du das Template für die einzelnen Beiträge auswählen. Mehr zu diesem Thema erfährst 
du im Abschnitt [Templates](../../eigene-seitenlayouts/templates/).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_comments` überschreiben.

**Kommentarverwaltung**

Die Verwaltung der Kommentare, die deine Besucher abgeben, erfolgt zentral im Backend mit dem Modul »Kommentare«, das 
du in der Navigation in der Gruppe Inhalte findest. Dort werden sämtliche Kommentare angezeigt, egal ob sie sich auf 
ein Inhaltselement, einen Artikel oder einen Blog-Beitrag beziehen. Bei Bedarf kannst du die Liste der Kommentare nach 
ihrem Ursprung oder ihrem Elternelement filtern.

![Kommentare nach ihrem Ursprung filtern](/de/article-management/images/de/kommentare-nach-ihrem-ursprung-filtern.png?classes=shadow)

Falls du die Option »Kommentare moderieren« aktiviert hast, kannst du neue Kommentare in der Kommentarverwaltung 
prüfen, bevor sie auf der Webseite erscheinen. So verhinderst du z. B. eventuelle Spamversuche.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_comments first last block">
    
    <div class="comment_default first even" id="c1">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>

    <div class="comment_default last odd" id="c2">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>
    
    <!-- indexer::stop -->
        <div class="form">
            <form action="…" id="com_tl_content" method="post">
                <div class="formbody">                  
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_name" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Name<span class="mandatory">*</span>
                        </label>
                        <input type="text" name="name" id="ctrl_name" class="text mandatory" value="" required maxlength="64">
                    </div>
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_email" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>E-Mail (wird nicht veröffentlicht)<span class="mandatory">*</span>
                        </label>
                        <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                    </div>
                    <div class="widget widget-text">
                        <label for="ctrl_website">Webseite</label>
                        <input type="url" name="website" id="ctrl_website" class="text" value="" maxlength="128">
                    </div>
                    <div class="widget widget-textarea mandatory">
                        <label for="ctrl_comment" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Kommentar<span class="mandatory">*</span>
                        </label>
                        <textarea name="comment" id="ctrl_comment" class="textarea mandatory" rows="4" cols="40" required></textarea>
                    </div>
                    <div class="widget widget-checkbox">
                        <fieldset id="ctrl_notify" class="checkbox_container">
                            <input type="hidden" name="notify" value="">
                            <span>
                                <input type="checkbox" name="notify" id="opt_notify_0" class="checkbox" value="1"> 
                                <label id="lbl_notify_0" for="opt_notify_0">…</label>
                            </span>
                        </fieldset>
                    </div>
                    <div class="widget widget-submit">
                        <button type="submit" class="submit">Kommentar absenden</button>
                    </div>
                </div>
            </form>
        </div>
    <!-- indexer::continue -->

</div>
```

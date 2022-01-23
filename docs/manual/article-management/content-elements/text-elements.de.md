---
title: "Text-Elemente"
description: "Inhaltselement im Bereich Text-Elemente"
url: "artikelverwaltung/inhaltselemente/text-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/text-elemente/
weight: 21
---


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

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird es
![oberhalb](/de/icons/above.svg?classes=icon) **oberhalb**, 
![unterhalb](/de/icons/below.svg?classes=icon) **unterhalb**, 
![linksbündig](/de/icons/left.svg?classes=icon) **linksbündig** oder 
![rechtsbündig](/de/icons/right.svg?classes=icon) **rechtsbündig** eingefügt. Bei **links-** oder **rechtsbündig** 
umfließt der Text das Bild (wie im Icon symbolisiert).

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

**Reihenüberschriften hinzufügen:** Wenn du diese Option auswählst, wird die erste Spalte der Tabelle mithilfe des 
`<th>`-Tags als Reihenüberschrift formatiert.

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

**Code:** Hier kannst du den gewünschten Code eingeben. Beachte, dass der Code nicht ausgeführt wird.

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

| Markdown-Quelle |   |
| --------------- | - |
| **Text:** | Hier kannst du den gewünschten Inhalt im Bereich »Code« eingeben. |
| **Datei:** | Hier kannst du den gewünschten Inhalt aus einer Markdown Datei einfügen. {{< version-tag "4.12" >}} |

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

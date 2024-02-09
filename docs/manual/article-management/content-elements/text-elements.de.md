---
title: "Text-Elemente"
description: "Inhaltselement im Bereich Text-Elemente"
url: "artikelverwaltung/inhaltselemente/text-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/text-elemente/
weight: 21
---


## Code

Das Inhaltselement »Code« fügt dem Artikel formatierten Code hinzu. Die Eingabe erfolgt über einen sogenannten
Code-Editor. Contao verwendet den Open Source Code-Editor von [Ace](https://ace.c9.io/).


### Text/HTML/Code

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
- Twig
- YAML
- XML

**Code:** Hier kannst du den gewünschten Code eingeben. Beachte, dass der Code nicht ausgeführt wird.


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_code` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_code block">
    <pre>
        <code class="hljs css">…</code>
    </pre>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/code` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-code">
    <pre>
        <code class="hljs css">…</code>
    </pre>
</div>
```
{{% /tab %}}
{{</tabs>}}



## Beschreibungsliste

{{< version "5.3" >}}

Das Inhaltselement »Beschreibungsliste« fügt dem Artikel eine Beschreibungsliste hinzu, diese wird häufig zur 
Implementierung eines Glossars oder zur Anzeige von Metadaten (eine Liste von Schlüssel-Wert-Paaren) verwendet.

![Beschreibungsliste]({{% asset "images/manual/article-management/de/beschreibungsliste.png" %}}?classes=shadow)


### Listeneinträge

**Listeneinträge:** Du kannst eine Liste von Begriffen und Details zur Beschreibungsliste hinzufügen.
Falls du das Feld für den Begriff leer lässt, kannst du mehrere Details für einen Begriff erstellen.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/description_list` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-description-list">
    <dl>
        <dt>…</dt>
        <dd>…</dd>
    </dl>
</div>
```



## Überschrift {#ueberschrift}

Das Inhaltselement »Überschrift« fügt dem Artikel eine Überschrift hinzu. Die meisten Inhaltselemente unterstützen die 
direkte Eingabe einer Überschrift, sodass du das Element nicht jedes Mal separat verwenden musst.

**Überschrift:** Hier kannst du die Überschrift eingeben.

Mit dem Select-Menü rechts daneben kannst du die semantische Hierarchie dieser Überschrift festlegen. Die wichtigste 
Überschrift der Seite wird als `h1` angegeben (meist nur eine pro Seite), während die Werte `h2` bis `h6` hierarchisch 
niedrigere Überschriften abbilden und natürlich mehrfach vorkommen.


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_headline` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<h1 class="ce_headline">…</h1>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/headline` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<h1 class="content-headline">…</h1>
```
{{% /tab %}}
{{</tabs>}}



## HTML

Das Inhaltselement »HTML« fügt dem Artikel beliebigen HTML-Code hinzu. Beachte, dass nicht alle HTML-Tags standardmäßig
erlaubt sind. Die Liste der erlaubten Tags findest du in den Backend-Einstellungen.


### Text/HTML/Code

**HTML-Code:** Hier kannst du den HTML-Code eingeben.


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_html` überschreiben.
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/html` überschreiben.
{{% /tab %}}
{{</tabs>}}

Das Inhaltselement hat kein umschließenden HTML-Markup.



## Aufzählung {#aufzaehlung}

Das Inhaltselement »Aufzählung« fügt dem Artikel eine nicht verschachtelte Liste hinzu. Du kannst zwischen einer
nummerierten (»ordered list«) und einer umnummerierten (»unordered list«) Aufzählung wählen. Beim Anlegen und
Bearbeiten der Listenpunkte unterstützt dich ein JavaScript-Assistent.

![JavaScript-Assistent für Auflistungen]({{% asset "images/manual/article-management/de/javascript-assistent-fuer-auflistungen.png" %}}?classes=shadow)

Mit einem Klick auf das Icon ![Listendaten aus einer CSV-Datei importieren]({{% asset "icons/tablewizard.svg" %}}?classes=icon)
neben der Feldbezeichnung »Listeneinträge« öffnest du den CSV-Import-Wizard, mit dem du Listendaten aus einer CSV-Datei
importieren kannst. Die CSV-Datei musst du vorher in das Upload-Verzeichnis übertragen haben.


### Listeneinträge

**Listentyp:** Bitte wähle zwischen einer nummerierten oder unnummerierten Liste.

**Listeneinträge:** Tage einen Eintrag in die Liste ein.


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_list` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_list block">
    <ul>
        <li class="first">…</li>
        <li>…</li>
        <li class="last">…</li>
    </ul>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/list` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-list">
    <ul>
        <li>…</li>
        <li>…</li>
        <li>…</li>
    </ul>
</div>
```
{{% /tab %}}
{{</tabs>}}

Eine nummerierte Aufzählung verwendet das `<ol>`-Tag statt des `<ul>`-Tags.



## Markdown

Mit dem Inhaltselement »Markdown« wird aus einem Markdown-Text HTML-Code erzeugt.


### Text/HTML/Code

**Markdown-Quelle:** Bitte wähle die Markdown-Quelle aus.

| Markdown-Quelle |                                                                             |
|-----------------|-----------------------------------------------------------------------------|
| **Text:**       | Hier kannst du den gewünschten Inhalt im Bereich »Code« eingeben.           |
| **Datei:**      | Hier kannst du den gewünschten Inhalt aus einer Markdown Datei einfügen.    |

**Code:** Beachte, dass der Code nicht ausgeführt wird.


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_markdown` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_markdown block">
    <div>
        <h1>…</h1>
        <p>…</p>
    </div>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/markdown` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-markdown">
    <h1>…</h1>
    <p>…</p>
</div>
```
{{% /tab %}}
{{</tabs>}}

Nachfolgend einige Beispiele für die Markdown-Syntax:


{{%expand "Syntax" %}}
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
{{% /expand%}}


{{%expand "Erweiterter Syntax" %}}
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
:--------------  :--------------: | ---------------:  
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
{{% /expand%}}


{{%expand "Weitere Informationen" %}}
Für eine komplette Dokumentation zu Markdown, besuche die
[offizielle Webseite](http://daringfireball.net/projects/markdown/syntax).

Für eine komplette Dokumentation zu Markdown Extra, besuche die
[offizielle Webseite](http://michelf.ca/projects/php-markdown/extra).
{{% /expand%}}



## Tabelle

Das Inhaltselement »Tabelle« fügt dem Artikel eine Tabelle hinzu. Beim Anlegen der Reihen und Spalten unterstützt dich 
ein JavaScript-Assistent. Mit den folgenden Navigationsicons kannst du die Tabelle bearbeiten:

- ![Die Eingabefelder verkleinern]({{% asset "icons/demagnify.svg" %}}?classes=icon) **Die Eingabefelder verkleinern**
- ![Die Eingabefelder vergrößern]({{% asset "icons/magnify.svg" %}}?classes=icon) **Die Eingabefelder vergrößern**
- ![Die Spalte/Reihe duplizieren]({{% asset "icons/copy.svg" %}}?classes=icon) **Die Spalte/Reihe duplizieren**
- ![Die Spalte eine Position nach links verschieben]({{% asset "icons/movel.svg" %}}?classes=icon) 
**Die Spalte eine Position nach links verschieben**
- ![Die Spalte eine Position nach rechts verschieben]({{% asset "icons/mover.svg" %}}?classes=icon) 
**Die Spalte eine Position nach rechts verschieben**
- ![Die Spalte/Reihe löschen]({{% asset "icons/delete.svg" %}}?classes=icon) **Die Spalte/Reihe löschen**
- ![Das Element durch Ziehen und Ablegen verschieben]({{% asset "icons/drag.svg" %}}?classes=icon) 
**Das Element durch Ziehen und Ablegen verschieben**

![JavaScript-Assistent für Tabellen]({{% asset "images/manual/article-management/de/javascript-assistent-fuer-tabellen.png" %}}?classes=shadow)

Mit einem Klick auf das Icon ![Listendaten aus einer CSV-Datei importieren]({{% asset "icons/tablewizard.svg" %}}?classes=icon) 
neben der Feldbezeichnung »Tabelleneinträge« öffnest du den CSV-Import-Wizard, mit dem du Tabellendaten aus einer 
CSV-Datei importieren kannst. Die CSV-Datei musst du vorher in das Upload-Verzeichnis übertragen haben.


### Tabellenkonfiguration

**Zusammenfassung:** Eine barrierefreie Webseite sollte für jede Tabelle eine kurze Zusammenfassung des Inhalts 
enthalten, die du hier eingeben kannst.

**Kopfzeile hinzufügen:** Wenn du diese Option auswählst, wird die erste Reihe der Tabelle mithilfe des 
`<thead>`-Tags als Kopfzeile formatiert.

**Fusszeile hinzufügen:** Wenn du diese Option auswählst, wird die letzte Reihe der Tabelle mithilfe des 
`<tfoot>`-Tags als Fußzeile formatiert.

**Reihenüberschriften hinzufügen:** Wenn du diese Option auswählst, wird die erste Spalte der Tabelle mithilfe des 
`<th>`-Tags als Reihenüberschrift formatiert.


### Sortieroptionen

**Sortierbare Tabelle:** Macht die Tabelle im Frontend mittels JavaScript sortierbar. Das *j_tablesort*-Template muss im 
Seitenlayout eingebunden sein.

**Sortierindex:** Die Nummer der Spalte nach der standardmäßig sortiert werden soll, solange der Besucher noch keine 
Auswahl getroffen hat. Die Zählung beginnt bei 0.

**Sortierreihenfolge:** Die Reihenfolge der Standardsortierung (auf- oder absteigend).


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_table` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_table block">
    <table class="sortable" data-sort-default="0|asc">
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
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/table` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-table">
    <table data-sortable-table="{&quot;descending&quot;:false}">
    <caption>…</caption>
    
    <thead>
        <tr>
            <th data-sort-method="none" role="columnheader">…</th>
            <th role="columnheader">…</th>
            <th role="columnheader">…</th>
            <th role="columnheader">…</th>
        </tr>
    </thead>
    
    <tfoot>
        <tr>
            <td>…</td>
            <td>…</td>
            <td>…</td>
            <td>…</td>
        </tr>
    </tfoot>
    
    <tbody>
        <tr >
            <th scope="row">…</th>
            <td>…</td>
            <td>…</td>
            <td>…</td>
        </tr>
        <tr>
            <th scope="row">…</th>
            <td>…</td>
            <td>…</td>
            <td>…</td>
        </tr>
    </tbody>
    
    </table>
</div>
```
{{% /tab %}}
{{</tabs>}}



## Text

Das Inhaltselement »Text« fügt dem Artikel einen formatierten Text hinzu. Die Eingabe erfolgt über einen sogenannten
Rich Text Editor, der es dir ähnlich wie in einem Textverarbeitungsprogramm erlaubt, bestimmte Formatierungen auf
Knopfdruck zu setzen. Contao verwendet [TinyMCE](https://www.tiny.cloud/), einen Open Source Editor der schwedischen
Firma Moxiecode, der sich gut an die Erfordernisse der Barrierefreiheit anpassen lässt.

![Der Rich Text Editor TinyMCE]({{% asset "images/manual/article-management/de/der-rich-text-editor-tinymce.png" %}}?classes=shadow)

**Überschrift:** Hier kannst du eine Überschrift eingeben.

Mit dem Select-Menü rechts daneben kannst du die semantische Hierarchie dieser Überschrift festlegen. Die wichtigste
Überschrift der Seite wird als `h1` angegeben (meist nur eine pro Seite), während die Werte `h2` bis `h6` hierarchisch
niedrigere Überschriften abbilden und natürlich mehrfach vorkommen.


### Text/HTML/Code

**Text:** Hier gibst du den Text des Inhaltselements ein.


### Bildeinstellungen

**Ein Bild hinzufügen**

Du kannst dem Textelement ein Bild hinzufügen, das dann von deinem Text umflossen wird. Folgende Optionen stehen dir
dabei zur Verfügung:

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast,
kannst du den Upload hier nachholen, ohne die Eingabemaske zu verlassen.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

![Einem Text ein Bild hinzufügen]({{% asset "images/manual/article-management/de/einem-text-ein-bild-hinzufuegen.png" %}}?classes=shadow)

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird es
![oberhalb]({{% asset "icons/above.svg" %}}?classes=icon) **oberhalb**,
![unterhalb]({{% asset "icons/below.svg" %}}?classes=icon) **unterhalb**,
![linksbündig]({{% asset "icons/left.svg" %}}?classes=icon) **linksbündig** oder
![rechtsbündig]({{% asset "icons/right.svg" %}}?classes=icon) **rechtsbündig** eingefügt. Bei **links-** oder **rechtsbündig**
umfließt der Text das Bild (wie im Icon symbolisiert).

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


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_text` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_text block">
    <h2>…</h2>
    <p>…</p>
</div>
```

Wurde dem Text ein Bild hinzugefügt, sieht die HTML-Ausgabe wie folgt aus:

```html
<div class="ce_text block">
    <h2>…</h2>
    <figure class="image_container float_above">
        <img src="…" alt="…" itemprop="image">
        <figcaption class="caption">…</figcaption>
    </figure>
    <p>…</p> 
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/text` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-text">
    <h2>…</h2>
    <div class="rte">
        <p>…</p>
    </div>
</div>
```

Wurde dem Text ein Bild hinzugefügt, sieht die HTML-Ausgabe wie folgt aus:

```html
<div class="media media--above content-text">
    <h2>…</h2>
    <figure>
        <img src="…" alt="…">
        <figcaption>…</figcaption>
    </figure>
    <div class="rte">
        <p>…</p>
    </div>
</div>
```
{{% /tab %}}
{{</tabs>}}



## Ungefiltertes HTML

{{< version "5.3" >}}

Das Inhaltselement »Ungefiltertes HTML« fügt dem Artikel ein ungefiltertes HTML hinzu. Bitte sei vorsichtig, wenn du 
Dinge einfügst, die du nicht verstehst. Dies könnte Angreifern ermöglichen, deine Identität zu stehlen oder die 
Kontrolle über das gesamte System zu übernehmen.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/unfiltered_html` überschreiben.

Das Inhaltselement hat kein umschließenden HTML-Markup.
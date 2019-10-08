---
title: "Verschiedenes"
description: "In diesem Abschnitt werden dir die übrigen Core-Module im Bereich »Verschiedenes« vorgestellt."
url: "modulverwaltung/verschiedenes"
weight: 5
---

In diesem Abschnitt werden dir die übrigen Core-Module im Bereich »Verschiedenes« vorgestellt. Die Liste der 
Frontend-Module kann darüber hinaus durch (Third-Party-)Erweiterungen beliebig verlängert werden.


## Artikelliste

Mit dem Frontend-Modul »Artikelliste« kannst du eine Liste aller Artikel einer Spalte ausgeben.

**Elemente überspringen:** Hier legst du fest, wie viele Elemente übersprungen werden sollen.

**Spalte:** Hier kannst du die Spalte, deren Artikel du auflisten möchtest auswählen.

**Eine Referenzseite festlegen:** Hier kannst du dem Modul eine individuelle Quell- oder Zielseite zuweisen.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_articlelist` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_articlelist block">

<ul>
    <li><a href="…#article-01" title="…">…</a></li>
    <li><a href="…#article-02" title="…">…</a></li>
    <li><a href="…#article-03" title="…">…</a></li>
</ul>

</div>
<!-- indexer::continue -->
```


## Zufallsbild

Das Frontend-Modul »Zufallsbild« fügt der Webseite ein zufälliges Bild aus einer bestimmten Auswahl an Bildern hinzu. 
Du kannst sowohl einzelne Bilder als auch ganze Ordner als Quelle auswählen. Vorhandene Meta-Dateien werden ausgewertet.

**Quelldateien:** Hier kannst du mehrere Dateien bzw. Ordner auswählen. Die in einem Ordner enthaltenen Bilder werden 
automatisch bei der Auswahl berücksichtigt.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes und den Skalierungsmodus festlegen.

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

**Grossansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße 
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

**Bildunterschrift anzeigen:** Wenn du diese Option auswählst, wird entweder die entsprechende Bildunterschrift aus der 
Metadaten angezeigt oder eine automatische Bildunterschrift aus dem Namen der Datei generiert.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_randomImage` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_randomImage block">

    <figure class="image_container">
        <a href="…" title="…" data-lightbox="8e0a5c">
            <img src="…" alt="" itemprop="image">
        </a>
    </figure>

</div>
<!-- indexer::continue -->
```


## Eigener HTML-Code

Das Frontend-Modul »Eigener HTML-Code« fügt der Webseite beliebigen HTML-Code hinzu.

**HTML Code:** Hier kannst du den HTML-Code eingeben. Beachte, dass nur die HTML-Tags verwendet werden können, die du 
in den Backend-Einstellungen unter »Erlaubte HTML-Tags« freigegeben hast.

Das Modul hat kein umschließendes HTML-Markup.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_html` überschreiben.


## RSS -Reader

Mit dem Frontend-Modul »RSS-Reader« kannst du einen beliebigen RSS-Feed abonnieren und in deine Webseite einfügen. 
Damit kannst du z. B. den Nachrichtenfeed von contao.org einbinden.

Öffne die Modulverwaltung im Backend, und wähle das Modul »RSS-Leser« aus. Nachfolgend werden dir die einzelnen Eingabefelder 
näher erklärt.

**Feed-URLs:** Hier kannst du eine oder mehrere RSS-Feed-URLs eingeben.

**Gesamtzahl der Beiträge:** Hier legst du fest, wie viele Beiträge angezeigt werden.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, verteilt Contao die Beiträge automatisch auf mehrere 
Seiten – eine entsprechende Anzahl vorausgesetzt.

**Elemente überspringen:** Hier kannst du festlegen, dass eine bestimmte Anzahl an Beiträgen vom jüngsten Beitrag des 
RSS-Feeds aus gesehen übersprungen wird.

**Cache-Verfallszeit:** Hier legst du fest, wie lange ein RSS-Feed im lokalen Cache gespeichert wird, bevor eine 
erneute Anfrage gestellt wird.

**Feed-Template:** Hier wählst du das Feed-Template aus.

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `rss_default`            | Es werden sowohl der Header des RSS-Feeds als auch die Beiträge dargestellt.             |
| `rss_items_only`         | Es werden nur die Beiträge des RSS-Feeds dargestellt.                                    |

**HTML-Ausgabe**  
Das Frontend-Modul generiert mit `rss_default` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_rssReader block">

    <div class="rss_default_header">
        <h1><a href="…" target="_blank" rel="noreferrer noopener">…</a></h1>
        <div class="description">…</div>
    </div>
    
    <div class="rss_default first even">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_default odd">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_default last even">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
     </div>

</div>
<!-- indexer::continue -->
```

Das Frontend-Modul generiert mit `rss_items_only` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_rssReader block">

    <div class="rss_items_only first even">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_items_only odd">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_items_only last even">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>

</div>
<!-- indexer::continue -->
```

---
title: "Frontend-Module"
description: "Die FAQ-Erweiterung enthält drei neue Frontend-Module, die du wie gewohnt über die Modulverwaltung 
konfigurieren kannst."
url: "core-erweiterung/faq/frontend-module"
aliases:
    - /de/core-erweiterung/faq/frontend-module/
weight: 20
---

Nachdem du nun weißt, wie Kategorien und Fragen im Backend verwaltet werden, wird dir jetzt erklärt, wie du diese 
Inhalte im Frontend darstellen kannst. Die FAQ-Erweiterung enthält drei neue Frontend-Module, die du wie gewohnt über 
die Modulverwaltung konfigurieren kannst.

![FAQ-Module]({{% asset "images/manual/core-extensions/faq/de/faq-module.png" %}}?classes=shadow)


## FAQ-Liste

Das Frontend-Modul »FAQ-Liste« fügt der Webseite eine Liste von Fragen hinzu, die aus einer oder mehreren Kategorien 
stammen können.


### Modul-Konfiguration

**FAQ-Kategorien:** Hier legst du fest, aus welchen Kategorien Fragen angezeigt werden. Du kannst die Reihenfolge der 
Kategorien mithilfe vom Navigationssymbol ![Frage verschieben]({{% asset "icons/drag.svg" %}}?classes=icon "Frage verschieben") 
anpassen.
  
**FAQ-Leser:** Hier kannst du festlegen ob automatisch zum FAQ-Leser gewechselt werden soll, wenn ein Beitrag 
ausgewählt wurde.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_faqlist block">
    <h2>FAQ</h2>
    <ul class="first last even">
        <li class="first even"><a href="…" title="…">…</a></li>
        <li class="odd"><a href="…" title="…">…</a></li>
        <li class="last even"><a href="…" title="…">…</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```


## FAQ-Leser

Das Frontend-Modul »FAQ-Leser« dient dazu, die Antwort zu einer bestimmten Frage darzustellen. Den Alias der Frage 
bezieht das Modul über die URL, sodass FAQs mit sogenannten [Permalinks](https://de.wikipedia.org/wiki/Permalink) 
gezielt verlinkt werden können:

<code>example.com/frage/kann-ich-eigene-php-skripte-verwen-den.html</code>

Das Schlüsselwort des FAQ-Lesers lautet *frage* und teilt dem Modul mit, dass es eine bestimmte Frage suchen und 
ausgeben soll. Existiert die gesuchte Frage nicht, gibt der FAQ-Leser eine Fehlermeldung und den HTTP-Status-Code 
»404 Not found« zurück. Der Status-Code ist wichtig für die Suchmaschinenoptimierung.

{{% notice info %}}
Auf einer einzelnen Seite darf sich immer nur ein »Lesermodul« befinden, egal welchen Typs. Andernfalls würde das eine 
oder andere Modul eine 404 Seite auslösen, da zum Beispiel der Alias einer FAQ nicht in einem Kalender gefunden 
wird, oder umgekehrt der Alias eines Events in einer FAQ-Kategorie.
{{% /notice %}}


### Modul-Konfiguration

**FAQ-Kategorien:** Hier legst du fest, in welchen Kategorien nach der angeforderten Frage gesucht werden soll. Fragen 
aus nicht ausgewählten Kategorien werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und der Eintrag 
existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.


### Kommentareinstellungen

**Kommentartemplate:** Hier kannst du das Kommentartemplate auswählen.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<div class="mod_faqreader block">
    <h1>…</h1>
    <div class="ce_text block">
        <p>…</p> 
    </div>
    <p class="info">…</p>
    
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


## FAQ-Seite

Das Frontend-Modul »FAQ-Seite« fügt der Webseite alle Fragen und Antworten hinzu, die aus einer oder mehreren 
Kategorien stammen können.

### Modul-Konfiguration

**FAQ-Kategorien:** Hier legst du fest, in welchen Kategorien nach der angeforderten Frage gesucht werden soll. Fragen 
aus nicht ausgewählten Kategorien werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und der Eintrag 
existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_faqpage block">
    <article class="first last even">
    <h2>FAQ</h2>
    
    <section class="first even">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>
    
    <section class="odd">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>
    
    <section class="last even">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>
    
    <p class="toplink"><a href="#top">Nach oben</a></p>
    </article>
</div>
<!-- indexer::continue -->
```

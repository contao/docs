---
title: "Website-Suche"
description: "Contao indiziert die Seiten deiner Webpräsenz automatisch, sobald sie aufgerufen werden, und speichert 
die darauf zu findenden Wörter als Suchbegriffe in einer Tabelle in der Datenbank."
url: "de/modulverwaltung/website-suche"
weight: 3
---

Contao indiziert die Seiten deiner Webpräsenz automatisch, sobald sie aufgerufen werden, und speichert die darauf zu 
findenden Wörter als Suchbegriffe in einer Tabelle in der Datenbank. Das Suchmodul durchsucht diese Tabelle und liefert 
die Seiten zurück, die den gesuchten Begriff bzw. die gesuchten Begriffe enthalten.

![Die On-Site-Suche im Frontend](/module-management/images/de/die-on-site-suche-im-frontend.png)

Beachte jedoch, dass deine Webseite aus Sicherheitsgründen nicht indiziert wird, wenn du im Backend angemeldet bist und 
die Frontend-Vorschau aufrufst. Es könnte ja sein, dass sich dort noch nicht veröffentlichte Inhalte befinden, die vor 
ihrer Veröffentlichung natürlich auch nicht im Suchindex auftauchen sollen.


## Suchsyntax

Mit der Contao-Suchmaschine kannst du mehr als nur einzelne Wörter finden. Die sogenannte Suchsyntax unterstützt neben 
der UND/ODER-Suche beispielsweise auch die Phrasensuche und die Verwendung von Platzhaltern.

Dieses Feature ist keineswegs Contao-spezifisch. Auch Google und andere Suchmaschinen unterstützen die Suche nach 
Phrasen oder das Erzwingen bzw. Ausschließen von Suchbegriffen. Die meisten großen Anbieter bieten sogar noch 
wesentlich mehr Optionen an, z. B. das Suchen nach bestimmten Dateitypen, Sprachen oder Zeiträumen.


### UND/ODER-Suche

Die einfache Suche nach z. B. »web design« ergibt fünf Treffer.

Contao sucht standardmäßig nur nach Seiten, die alle Suchbegriffe enthalten (UND-Suche). Wenn du hingegen die Option 
*finde irgendein Wort* auswählst, werden auch die Seiten zurückgegeben, die nur eines der beiden Wörter enthalten 
(ODER-Suche). Die Zahl der Treffer erhöht sich dadurch auf sieben.


### Phrasensuche

Bei der Phrasensuche wird nicht nur nach einzelnen Wörtern gesucht, sondern nach Wortkombinationen, die in einer 
bestimmten Reihenfolge stehen. Um nach einer Phrase zu suchen, musst du lediglich die entsprechenden Wörter in 
Anführungszeichen setzen. Die Suche nach "web design" (in diesem Fall musst du die Anführungszeichen mit eingeben!)
ergibt im Vergleich zur UND/ODER-Suche nur drei Treffer, nämlich die Seiten, die tatsächlich
den Begriff »Web Design« enthalten.


### Suche mit Platzhaltern

Vielleicht interessierst du dich gar nicht nur für Web Design, sondern auch für alle möglichen anderen Dinge zum Thema 
Web, wie z. B. Web Hosting. Aus diesem Grund möchtest du am liebsten alles finden, was mit dem Wort »Web« beginnt. Für 
genau diesen Fall bietet Contao die Suche mit Platzhaltern.

Starte eine neue Suche, und gebe »web*« in das Suchfeld ein. Der Stern dient als Platzhalter und steht für beliebige 
weitere Zeichen. Wie du siehst, gibt diese Suche mit 32 Treffern deutlich mehr Ergebnisse zurück als die beiden 
vorherigen. Sie enthält jetzt auch Wörter wie »Webanwendung«, »Webhosting« oder »Webtechnologie«.


### Suchbegriffe erzwingen

Das Erzwingen von Suchbegriffen ist ein gutes Mittel, um ODER-Suchen weiter zu verfeinern. Nehmen wir an, du möchtest 
alle Seiten finden, auf denen die Begriffe »Web«, »Hosting« oder »Design« vorkommen (acht Treffer), sind aber an Design 
nur in Verbindung mit dem Web interessiert. Das Design von Industrieprodukten ist für dich nicht relevant und soll 
daher auch nicht in den Ergebnissen erscheinen.

Sicherlich hast du sofort erkannt, dass du das mit zwei UND-Suchen nach »Web Design« und »Web Hosting« erreichen 
kannst. Diese Lösung ist jedoch recht unkomfortabel, da die beiden Trefferlisten getrennt durchsucht werden müssen und 
nicht nach einer gemeinsamen Relevanz sortiert werden können.

Eine bessere Möglichkeit ist die Suche nach »+web hosting design«, was so viel bedeutet wie: »Suche nach den Wörtern 
›Hosting‹ und ›Design‹, aber nur auf den Seiten, auf denen auch das Wort Web vorkommt«. An dem Pluszeichen erkennt 
Contao, dass ein Suchbegriff auf jeden Fall enthalten sein muss. Beachte, dass zwischen dem Pluszeichen und dem
Suchbegriff kein Leerzeichen stehen darf.

Die verfeinerte Suche ergibt jetzt nur noch fünf Treffer.


### Suchbegriff ausschließen

Das Ausschließen eines Suchbegriffs ist das Gegenstück zum Erzwingen eines Suchbegriffs und bewirkt, dass nur die 
Seiten gefunden werden, die einen bestimmten Begriff nicht enthalten. Im obigen Beispiel hast du durch das Erzwingen 
des Wortes »Web« die Anzahl der Ergebnisse von acht auf fünf reduziert. Wenn du nun das Wort »Web« ausschließt, wirst
du genau die drei weggefallenen Seiten finden.

Starte einen letzten Suchvorgang, und gebe »-web hosting design« in das Suchfeld ein. An dem Minuszeichen erkennt 
Contao, dass ein Suchbegriff auf keinen Fall auf der Seite vorkommen darf. Beachte, dass zwischen dem Minuszeichen und 
dem Suchbegriff kein Leerzeichen stehen darf.

Wie erwartet ergibt die Suche jetzt genau drei Treffer.


## Konfiguration des Suchmoduls

Nachdem du nun weißt, wie das Modul im Frontend benutzt wird, wird dir nun kurz erklärt, wie du es im Backend 
konfigurierst. Öffne dazu die Modulverwaltung, und wähle das Modul »Anwendung – Suchmaschine« aus.

**Standard-Abfragetyp:** Hier legst du fest, ob standardmäßig die UND-Suche (finde alle Wörter) oder die ODER-Suche 
(finde irgendein Wort) aktiv ist.

**Ungenaue Suche:** Bei einer ungenauen Suche nach z. B. »Design« liefert das Suchmodul nicht nur Seiten mit dem 
Begriff »Design« zurück, sondern auch Seiten mit den Begriffen »Webdesign« oder »Designer« (entspricht einer Suche mit 
Platzhaltern).

**Kontext-Spannweite:** Bei der Darstellung der Suchergebnisse zeigt Contao nicht nur den gefundenen Begriff an, 
sondern auch den Kontext rechts und links davon. Hier legst du fest, wie viele Zeichen rechts und links eines 
gefundenen Begriffs als Kontext verwendet werden sollen.

{{< version "4.8" >}}

**Minimale Suchwort-Länge:** Suchwörter, die die Mindestlänge überschreiten, werden in den Suchergebnissen ignoriert. 
Zum Deaktivieren auf 0 setzen.

**Elemente pro Seite:** Wenn du hier einen Wert größer 0 eingibst, umbricht Contao die Seite automatisch nach dieser 
Anzahl Suchergebnisse.

**Suchformular-Layout:** Hier legst du das Layout des Suchformulars fest.

| Layout                    | Erklärung                                                                                |
|:--------------------------|:-----------------------------------------------------------------------------------------|
| Einfaches Formular        | Das einfache Suchformular besteht aus einem Textfeld für die Eingabe der Suchbegriffe und einer Schaltfläche zum Absenden des Formulars.                             |
| Erweitertes&nbsp;Formular | Das erweiterte Suchformular bietet darüber hinaus zwei Radio-Buttons zur Auswahl der Optionen »finde alle Wörter« und »finde irgendein Wort« (UND- bzw. ODER-Suche). |

**Weiterleitungsseite:** Hier kannst du eine Seite angeben, zu der Besucher nach dem Abschicken des Suchformulars 
weitergeleitet werden.

**Referenzseite:** Hier kannst du die Suche auf einen Teilbereich der Seitenstruktur beschränken. Es erscheinen nur die 
Seiten unterhalb der Referenzseite in den Ergebnissen.

**Ergebnistemplate:** Hier wählst du das Template für die Suchergebnisse aus.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_search` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_search block">

    <form action="…" method="get">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="ctrl_keywords" class="invisible">Suchbegriffe</label>
                <input type="search" name="keywords" id="ctrl_keywords" class="text" value="contao">
            </div>
            <div class="widget widget-submit">
                <button type="submit" id="ctrl_submit" class="submit">Suchen</button>
            </div>
            <div class="widget widget-radio">
                <fieldset class="radio_container">
                    <legend class="invisible">Optionen</legend>
                    <span>
                        <input type="radio" name="query_type" id="matchAll" class="radio" value="and" checked> 
                        <label for="matchAll">finde alle Wörter</label>
                    </span>
                    <span>
                        <input type="radio" name="query_type" id="matchAny" class="radio" value="or"> 
                        <label for="matchAny">finde irgendein Wort</label>
                    </span>
                </fieldset>
            </div>
        </div>
    </form>

    <p class="header"> … </p>
  
    <div class="first even">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <div class="odd">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <div class="last even">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <!-- indexer::stop -->
    <nav class="pagination block" aria-label="Seitenumbruch-Menü">
        <p>Seite 1 von 3</p>
        <ul>
        <li><strong class="active">1</strong></li>
            <li><a href="…" class="link" title="Gehe zu Seite 2">2</a></li>
            <li><a href="…" class="link" title="Gehe zu Seite 3">3</a></li>
            <li class="next"><a href="…" class="next" title="Gehe zu Seite 2">Vorwärts</a></li>
            <li class="last"><a href="…" class="last" title="Gehe zu Seite 3">Ende</a></li>
        </ul>
    </nav>
    <!-- indexer::continue -->

</div>
<!-- indexer::continue -->
```

Das `<nav>`-Element mit der Klasse pagination enthält das Markup des Seitenumbruch-Menüs, das beispielsweise auch bei 
Bildergalerien zum Einsatz kommt.


## Eigene Suchformulare

Bestimmt ist dir aufgefallen, dass das Modul »Suchmaschine« sowohl das Suchformular als auch die Ergebnisliste enthält. 
Auf vielen Webseiten werden diese Elemente jedoch getrennt verwendet, um ein Suchfeld in der Kopfzeile anzeigen zu 
können. Dafür gibt es in Contao drei Lösungen:

1. Du erstellst ein zweites Suchmodul, in dem du mithilfe der Weiterleitungsseite auf die eigentliche Suchseite 
verweist, und bindest dieses in die Kopfzeile ein.

2. Du erstellst ein Suchformular mit dem Formulargenerator. Diese Variante ist im Abschnitt 
[Ein Suchformular erstellen](../../formulargenerator/ein-suuchformular-erstellen/), beschrieben.

3. Du erstellst ein Suchformular mit dem Modul »Eigener HTML-Code«.

**Ein Suchformular mit dem HTML-Modul erstellen**

Das Frontend-Modul »Eigener HTML-Code« werde ich dir am Ende dieser Seite vorstellen. Das Markup für das Suchformular 
sieht folgendermaßen aus:

```html
<!-- indexer::stop -->
<form action="{{link_url::10}}" method="get" enctype="application/x-www-form-urlencoded">
    <div class="formbody">
        <div class="widget widget-text">
            <input type="text" name="keywords" class="text" value="" placeholder="Suche">
        </div>
        <div class="widget widget-submit">
            <button type="submit" class="submit">Suchen</button>
        </div>
    </div>
</form>
<!-- indexer::continue -->
```

Die Zielseite, die beim Abschicken des Formulars aufgerufen wird, wurde hier über einen Inserttag erfasst, damit das 
Formular auch dann noch funktioniert, wenn sich der Alias der Zielseite im Laufe der Zeit ändert. Als 
Übertragungsmethode wurde »GET« ausgewählt, und dem Suchfeld den Feldnamen »keywords« gegeben.


## Bereiche von der Suche ausnehmen

Bestimmt hast du dich gerade gefragt, was die beiden seltsamen Kommentare zu bedeuten haben, von denen der HTML-Code 
unseres Suchformulars umschlossen wird. Diese im Frontend unsichtbaren Kommentare weisen die Suchmaschine an, den darin 
befindlichen Inhalt nicht zu indizieren.

```html
<!-- indexer::stop -->
Was hier steht, wird nicht indiziert.
<!-- indexer::continue -->
```

Die Kommentare funktionieren übrigens nicht nur mit dem HTML-Modul, sondern können überall in Contao verwendet werden. 
Fast alle Modul-Templates beginnen beispielsweise mit einem solchen Kommentar, da ein Frontend-Modul, das mittels 
Seitenlayout auf allen Seiten eingebunden ist, kein eindeutiges Suchergebnis brächte und deswegen nicht in den 
Suchindex gehört.

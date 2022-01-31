---
title: "Datei-Elemente"
description: "Inhaltselemente im Bereich Datei-Elemente"
url: "artikelverwaltung/inhaltselemente/datei-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/datei-elemente/
weight: 26
---


## Download

Das Inhaltselement »Download« fügt dem Artikel einen Download-Link hinzu. Beim Anklicken des Links öffnet sich der 
»Datei speichern unter …«-Dialog und du kannst die verlinkte Datei auf deinem lokalen Rechner speichern.

Die Besonderheit in Contao ist, dass dieser Download-Link auch mit geschützten Dateien funktioniert, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst im Abschnitt [Dateiverwaltung](../../../dateiverwaltung/).

**Quelldatei:** Hier kannst du die Download-Datei auswählen.

{{< version "4.8" >}}

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Metadaten überschreiben:** Die Metadaten aus der Dateiverwaltung überschreiben.

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

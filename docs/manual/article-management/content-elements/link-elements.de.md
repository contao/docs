---
title: "Link-Elemente"
description: "Inhaltselemente im Bereich Link-Elemente"
url: "artikelverwaltung/inhaltselemente/link-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/link-elemente/
weight: 24
---


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
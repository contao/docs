---
title: "Metadaten"
description: "In Contao kannst du zu jeder Art von Datei sogenannte Metadaten erfassen."
url: "dateiverwaltung/metadaten"
aliases:
    - /de/dateiverwaltung/metadaten/
weight: 20
---

In Contao kannst du zu jeder Art von Datei sogenannte Metadaten erfassen. Metadaten werden hauptsächlich in 
Bildergalerien und Downloads ausgewertet, um zu jeder Datei eine kurze Beschreibung oder Bildunterschrift darstellen 
zu können. In einem mehrsprachigen Projekt kannst du für jede Sprache separate Metadaten anlegen.

Contao unterstützt folgende Metadaten:

- Titel
- Alternativer Text
- Link
- Bildunterschrift
- Lizenz-URL

![Pflegen der Metadaten](/de/file-manager/images/de/pflegen-der-metadaten.png?classes=shadow)

**HTML-Ausgabe**  
Das Inhaltselement vom Elementtyp »Bild« generiert folgenden HTML-Code:

```html
<div class="ce_image first block">
    <figure class="image_container">
        <a href="https://contao.org/de/" title="Contao CMS">
            <img src="…" width="…" height="…" alt="Contao CMS" itemprop="image">
        </a>
        <figcaption class="caption">Contao CMS</figcaption>
    </figure>
</div>
```

{{< version "4.13" >}}

Die Lizenz-URL wird auf der entsprechenden Seite, auf der das Bild eingebunden ist, im [JSON-LD-Format](https://de.wikipedia.org/wiki/ JSON-LD "JSON-LD-Format") als [SCHEMA-ImageObject-Eintrag](https://schema.org/ImageObject "SCHEMA-ImageObject") eingebunden, um Lizensierungshinweisen gerecht zu werden.

**HTML-Ausgabe**
Die Lizenz-URL generiert folgenden HTML-Code:

```html
<script type="application/ld+json">
[
    {
        "@context": "https:\/\/schema.org",
        "@graph": [
        ...
            {
                "@id": "#\/schema\/image\/406494fa-4de4-11ed-abcf-001a4a0502b4",
                "@type": "ImageObject",
                "caption": "Contao CMS",
                "contentUrl": "assets\/images\/c\/contao_extensions-c6607fb7.png",
                "license": "https:\/\/www.gnu.org\/licenses\/lgpl-3.0.html",
                "name": "Contao CMS"
            }
        ]
    },
    ...
]
</script>
```

Um die Lizenz-URL unter dem Bild auf der Seite anzugeben, kann man im Template image.html5 folgenden Code einfügen:

```php
<?php if($this->license): ?><p class="ce_image__license" ><?= $this->license ?></p><?php endif; ?>
```

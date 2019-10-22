---
title: "Metadaten"
description: "In Contao kannst du zu jeder Art von Datei sogenannte Metadaten erfassen."
url: "dateiverwaltung/metadaten"
weight: 2
---

In Contao kannst du zu jeder Art von Datei sogenannte Metadaten erfassen. Metadaten werden hauptsächlich in 
Bildergalerien und Downloads ausgewertet, um zu jeder Datei eine kurze Beschreibung oder Bildunterschrift darstellen 
zu können. In einem mehrsprachigen Projekt kannst du für jede Sprache separate Metadaten anlegen.

Contao unterstützt folgende Metadaten:

- Titel
- Alternativer Text
- Link
- Bildunterschrift

![Pflegen der Metadaten](/de/file-manager/images/de/pflegen-der-metadaten.png)

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

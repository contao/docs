---
title: Metadata
description: 'In Contao, you can add Metadata to any kind of file.'
aliases:
    - /en/file-manager/meta-data/
weight: 20
---


In Contao, you can add metadata to any kind of file. Metadata is mainly used as a universal site-wide way to display 
a short description or caption for each file in image galleries and downloads. In a multilingual project, you can create 
separate metadata for each language.

Contao supports the following metadata:

- Title
- Alternative text
- Link
- Caption

![Maintaining the metadata](/de/file-manager/images/en/maintaining_the_metadata.jpg?classes=shadow)

**The HTML output**  
 Content element of type "Image" generates the following HTML code:

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

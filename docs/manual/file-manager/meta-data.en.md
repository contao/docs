---
title: Metadata
description: 'In Contao, you can add so-called metadata to any kind of file.'
aliases:
    - /en/file-manager/meta-data/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In Contao, you can add so-called metadata to any kind of file. Metadata is mainly used in image galleries and downloads to display a short description or caption for each file. In a multilingual project you can create separate metadata for each language.

Contao supports the following metadata:

- Title
- Alternative text
- Link
- Caption

![Maintaining the metadata](/de/file-manager/images/de/pflegen-der-metadaten.png?classes=shadow)

**HTML output**   
 The content element of element type "Image" generates the following HTML code:

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

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
- License URL

![Maintaining the metadata]({{% asset "images/manual/file-manager/en/maintaining_the_metadata.jpg" %}}?classes=shadow)

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

**License URL**
{{< version "4.13" >}}

On the page on which the image is embedded the license URL is used in the [SCHEMA-ImageObject](https://schema.org/ImageObject "SCHEMA-ImageObject") of the [JSON-LD](https://en.wikipedia.org/wiki/JSON-LD) to comply with licensing notices.

**The HTML output**
The license URL generates the following HTML code:

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

To display the license URL under the image on the page you can add the following code to the `image.html5` template:

```php
<?php if ($this->license): ?><p class="ce_image__license" ><?= $this->license ?></p><?php endif; ?>
```


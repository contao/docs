---
title: 'Link elements'
description: 'Content elements in the area link elements.'
aliases:
    - /en/article-management/content-elements/link-elements/
weight: 24
---


## Hyperlink

The Hyperlink content element adds a link to an external Web page or e-mail address to the article. Of course, you can also enter hyperlinks in the text element using the Rich Text Editor.

![Creating a hyperlink](/de/article-management/images/en/create-a-hyperlink.png?classes=shadow)

**Link target:** Enter the link target including the network protocol. For web pages, the network protocol usually is `http://` or `https://`, for e-mail addresses use `mailto:` and for phone numbers use `tel:`. Contao automatically encrypts e-mail addresses so that they cannot be read by spambots.

**Open in new window:** Opens the link in a new browser window.

**Link text:** The link text is displayed instead of the link address.

**Embed the link:** To turn only certain words of a sentence into a hyperlink, you can embed the link into the sentence. For example, if the title of the link is "Company page", you can embed it in the sentence "Visit our %s! The placeholder %s will be replaced by the link in the output, so that the sentence "Visit our company page!

**Link title:** The link title is inserted as `title`-attribute in the HTML markup.

**Lightbox:** Here you can set the `data-lightbox`-attribute of the link that is used to control the lightbox.

**Image link settings**

If you select the **Create an image link** option, you can create an image link instead of a text link, or alternatively, you can create an image element and link to it.

![Create an image link](/de/article-management/images/en/create-an-image-link.png?classes=shadow)

**Source file:** Here you select the image to be used.

**Image size**: Here you can specify the dimensions of the image. You can find more information in the text.

**Overwrite meta data:** Here you can overwrite the meta data from the file manager.

**Alternate text:** An accessible website should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative text is also evaluated by search engines and is therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image (title attribute).

**Image caption:** Here you can enter a caption for the image.

**Content element template:** Here you can overwrite the standard `ce_hyperlink` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_hyperlink first last block">
    … <a href="…" class="hyperlink_txt" title="…" data-lightbox="…" target="_blank" rel="noreferrer noopener">…</a> …
</div>
```

If an image link is used, the HTML output looks like this:

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


## Top link

The content element "Top-Link" adds a link to the article, with which you can jump to the top of the page, which is especially useful for long pages.

**Link text:** Here you can enter a name for the link. If you leave this field empty, the default name "Top" will be used.

**Individual template**: Here you can overwrite the standard `ce_text` template.

**HTML output**  
The element generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="ce_toplink first last block">
    <a href="#top" title="Nach oben">Nach oben</a>
</div>
<!-- indexer::continue -->
```
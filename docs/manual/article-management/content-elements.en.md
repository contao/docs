---
title: 'Content elements'
description: 'To make the creation of content as intuitive as possible, Contao provides a content element for each content type that is tailored to its requirements.'
aliases:
    - /en/article-management/content-elements/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

To make the creation of content as intuitive as possible, Contao provides a content element for each content type that is tailored to its requirements. You can create an unlimited number of content elements per article and restrict access to individual elements if needed.

![Restrict access to a content element](/de/article-management/images/de/den-zugriff-auf-ein-modul-einschraenken.png?classes=shadow)

**Protect element:** The content element is invisible by default and is only displayed after a member has logged on to the frontend.

**Allowed member groups:** Here you define who has access to the content element.

**Show guests only:** The content element is visible by default and is hidden as soon as a member has logged on to the frontend.

## Heading {#heading}

The content element "Heading" adds a heading to the article. Most content elements support entering a heading directly, so you don't have to use the element separately each time.

**Heading:** Here you can enter the headline.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is given as `h1` (usually only one per page), while the values `h2` to `h6` represent hierarchically lower headlines and occur several times, of course.

**Individual template:** Here you can overwrite the standard template `ce_headline`.

**HTML output**   
 The element generates the following HTML code:

```html
<h1 class="ce_headline first last">…</h1>
```

## Text

The content element "Text" adds a formatted text to the article. The input is done via a so-called Rich Text Editor, which allows you to set certain formatting at the push of a button, similar to a word processing program. Contao uses [TinyMCE](https://www.tiny.cloud/) , an open source editor from the Swedish company Moxiecode that can be easily adapted to the requirements of accessibility.

![The Rich Text Editor TinyMCE](/de/article-management/images/de/der-rich-text-editor-tinymce.png?classes=shadow)

**Heading:** Here you can enter a headline.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is given as `h1` (usually only one per page), while the values `h2` to `h6` represent hierarchically lower headlines and occur several times, of course.

**Text:** Here you enter the text of the content element.

**Add an image**

You can add an image to the text element, which is then surrounded by your text. The following options are available:

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can upload it here without leaving the input mask.

![Adding an image to a text](/de/article-management/images/de/einem-text-ein-bild-hinzufuegen.png?classes=shadow)

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Relative format |  |
| --------------- | --- |
| Proportional | The longer side of the image is adapted to the given dimensions and the image is proportionally reduced. |
| Fit to frame | The shorter side of the image is adjusted to the given dimensions and the image is proportionally reduced. |

| Exact format |  |
| ------------ | --- |
| Important part | Preserves the important part of the image as specified in the file manager. |
| Left / Top | Preserves the left part of a landscape image and the upper part of a portrait image. |
| Middle / Top | Preserves the central part of a landscape image and the upper part of a portrait image. |
| Right / Top | Preserves the right part of a landscape image and the upper part of a portrait image. |
| Left / Middle | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Preserves the central part of a landscape image and the central part of a portrait image. |
| Right / middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Preserves the left part of a landscape image and the lower part of a portrait image. |
| Middle / Bottom | Preserves the central part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |

**Image Alignment:** Here you set the alignment of the image. If it is ![right-justified](/de/icons/right.svg?classes=icon)inserted **above**, **below**, **left-aligned** or ![right-justified](/de/icons/right.svg?classes=icon)**right-aligned**. If **left-** or **right-aligned**, the text flows around the image (as symbolized by the icon).

**Image distance:** Here you define the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternative text:** Here you can enter an alternative text for the image *(alt attribute)*. A barrier-free website should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Picture title:** Here you can enter the title of the image *(title attribute)* .

**Image link address:** When you click on a linked image, you will be redirected to the specified target page (corresponds to an image link). Please note that for a linked image a lightbox large view is no longer possible.

**Caption:** Here you can enter a caption.

**Individual template:** Here you can overwrite the standard template `ce_text`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_text first last block">
    <h2>…</h2>
    <p>…</p>
</div>
```

If an image was added to the text, the HTML output looks like this:

```html
<div class="ce_text first last block">
    <h2>…</h2>
    <figure class="image_container float_above">
        <img src="…" alt="…" title="…" itemprop="image">
        <figcaption class="caption">…</figcaption>
    </figure>
    <p>…</p> 
</div>
```

## HTML

The content element "HTML" adds any HTML code to the article. Note that not all HTML tags are allowed by default. The list of allowed tags can be found in the backend settings.

**HTML code:** Here you can enter the HTML code.

**Individual template:** Here you can overwrite the default template `ce_html`.

The content element has no enclosing HTML markup.

## enumeration {#enumeration}

The content element "Enumeration" adds a non-nested list to the article. You can choose between a numbered ("ordered list") and an unnumbered ("unordered list") enumeration. A JavaScript wizard helps you to create and edit the list items.

![JavaScript wizard for listings](/de/article-management/images/de/javascript-assistent-fuer-auflistungen.png?classes=shadow)

With a click on the icon ![Import list data from a CSV file](/de/icons/tablewizard.svg?classes=icon)next to the field label "List entries" you open the CSV import wizard, which allows you to import list data from a CSV file. The CSV file must have been transferred to the upload directory before.

**Individual template:** Here you can overwrite the default template `ce_list`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_list first last block">
    <ul>
        <li class="first">…</li>
        <li>…</li>
        <li class="last">…</li>
    </ul>
</div>
```

A numbered enumeration uses the `<ol> tag` instead of the &lt;ul&gt; `tag.`

## Table

The content element "Table" adds a table to the article. A JavaScript wizard helps you to create the rows and columns. With the following navigation icons you can edit the table:

- ![Reduce the size of the input fields](/de/icons/demagnify.svg?classes=icon) **Reduce the size of the input fields**
- ![Enlarge the input fields](/de/icons/magnify.svg?classes=icon) **Enlarge the input fields**
- ![Duplicate the column/row](/de/icons/copy.svg?classes=icon) **Duplicate the column/row**
- ![Move the column one position to the left](/de/icons/movel.svg?classes=icon) **Move the column one position to the left**
- ![Move the column one position to the right](/de/icons/mover.svg?classes=icon) **Move the column one position to the right**
- ![Delete the column/row](/de/icons/delete.svg?classes=icon) **Delete the column/row**
- ![Move the element by dragging and dropping it](/de/icons/drag.svg?classes=icon) **Move the element by dragging and dropping it**

![JavaScript wizard for tables](/de/article-management/images/de/javascript-assistent-fuer-tabellen.png?classes=shadow)

With a click on the icon ![Import list data from a CSV file](/de/icons/tablewizard.svg?classes=icon)next to the field label "Table entries" you open the CSV import wizard, which allows you to import table data from a CSV file. The CSV file has to be transferred to the upload directory first.

**Summary:** An accessible website should contain a short summary of the content for each table, which you can enter here.

**Add header:** If you select this option, the first row of the table is formatted as a header using the `<thead> tag`.

**Add footer:** If you select this option, the last row of the table is formatted as a footer using the `<foot> tag`.

**Add series headings:** If you select this option, the first column of the table is formatted as a row header using the `<th> tag`.

**Sortable table:** Makes the table sortable in the frontend using JavaScript. The *moo\_tablesort* or *j\_tablesort* template must be included in the page layout.

**Sorting index:** The number of the column to be sorted by default, as long as the visitor has not made a selection. The count starts at 0.

**Sort order:** The order of the default sort (ascending or descending).

**Individual template:** Here you can overwrite the default template `ce_table`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_table first last block">
    <table id="table" class="sortable" data-sort-default="0|asc">
    <caption>…</caption>

    <thead>
        <tr>
            <th class="head_0 col_first unsortable">…</th>
            <th class="head_1">…</th>
            <th class="head_2">…</th>
            <th class="head_3 col_last">…</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <td class="foot_0 col_first">…</td>
            <td class="foot_1">…</td>
            <td class="foot_2">…</td>
            <td class="foot_3 col_last">…</td>
        </tr>
    </tfoot>

    <tbody>
        <tr class="row_0 row_first odd">
            <th scope="row" class="col_0 col_first">…</th>
            <td class="col_1">…</td>
            <td class="col_2">…</td>
            <td class="col_3 col_last">…</td>
        </tr>
        <tr class="row_1 row_last even">
            <th scope="row" class="col_0 col_first">…</th>
            <td class="col_1">…</td>
            <td class="col_2">…</td>
            <td class="col_3 col_last">…</td>
        </tr>
    </tbody>

    </table>
</div>
```

## Code

The content element "Code" adds formatted code to the article. The input is done via a so-called code editor. Contao uses the open source code editor of [Ace](https://ace.c9.io/) .

For the frontend output to work, the *js\_highlight* template must be included in the page layout.

**Syntax highlighting:** Here you can select the desired script language. The following script languages are available:

- Apache
- Bash
- C#
- C++
- CSS
- Diff
- HTML
- HTTP
- Ini
- JSON
- Java
- JavaScript
- Markdown
- Nginx
- Perl
- PHP
- PowerShell
- Python
- Ruby
- SCSS
- SQL
- YAML
- XML

**Code:** Here you can enter the desired code.

**Individual template:** Here you can overwrite the standard template `ce_code`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_code first last block">
    …
</div>
```

## Markdown

The content element "Markdown" is used to generate HTML code from a markdown text.

**Code:** Here you can enter the desired code. Note that the code will not be executed.

**Individual template:** Here you can overwrite the default template `ce_markdown`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_markdown first last block">
    <div>
        <h1>…</h1>
        <p>…</p>
    </div>
</div>
```

Below are some examples of markdown syntax:

### Syntax

#### Paragraphs

Paragraphs are created by a blank line:

```md
Erster Absatz

Zweiter Absatz
```

#### Headlines

Six levels of headings are possible:

```md
# Überschrift 1
## Überschrift 2
### Überschrift 3
#### Überschrift 4
##### Überschrift 5
###### Überschrift 6
```

#### Important

To highlight important text:

```md
**strong**
__strong__
```

Will be converted to the following HTML code:

```html
<strong>strong</strong>
```

#### Highlighting

To highlight text:

```md
*emphasize*
_emphasize_
```

Will be converted to the following HTML code:

```html
<em>emphasize</em>
```

#### Code

To mark a text as computer code:

```md
`monospaced font`
```

Will be converted to the following HTML code:

```html
monospaced font
```

#### Code blocks

To convert an entire paragraph to code, indent the text with four spaces.

```md
Schrift mit fester Laufweite …
… über mehrere Zeilen
```

#### Quote block

Blocks of quotations can be created by placing a right angle bracket at the beginning of the line.

```md
> Dies ist ein Zitat.
```

#### Line break

Two or more blanks at the end of a line create a wrap:

```md
Contao ist ein barrierefreies Open Source  
content management system.
```

#### Links

There are two possibilities for links: **inline** and **for reference**.

An inline link looks like this:

```md
[Contao](https://contao.org/de)
```

or optionally also with a title:

```md
[Contao](https://contao.org/de "Offizielle Contao-Webseite")
```

A reference link looks like this:

```md
[Offizielle Contao-Webseite][1]

[1]:https://contao.org/de
```

The reference can be placed anywhere in the document.

#### pictures

As for links, there are two syntax options for images.

An inline image looks like this:

```md
![Alt text](/de/pfad/zum/bild.jpg "Optionaler Titel")
```

An image in reference style is achieved by the following syntax:

```md
![Alternativer Text][id]

[id]: /pfad/zum/bild.jpg "Optionaler Titel"
```

The reference can be placed anywhere in the document.

#### Enumeration lists

**Unsorted lists**

Unsorted lists use asterisks or hyphens:

```md
* Listeneintrag  
* Listeneintrag  
    * Verschachtelter Listeneintrag
    * Verschachtelter Listeneintrag
* Listeneintrag

- Listeneintrag  
- Listeneintrag  
- Listeneintrag
```

**Sorted lists**

Sorted lists use numbers:

```md
1. Listeneintrag  
2. Listeneintrag  
3. Listeneintrag
```

### Extended syntax

Not all HTML elements such as tables or footnotes can be described with normal markdown. For this reason there is a project for "Markdown Extra" to extend the syntax.

Below are some examples of the extended syntax:

#### Tables

A table can be created as follows:

```md
Erste Kopfzeile | Zweite Kopfzeile | Dritte Kopfzeile  
--------------- | ---------------- | ----------------  
Zelleninhalt    | Zelleninhalt     | Zelleninhalt  
Zelleninhalt    | Zelleninhalt     | Zelleninhalt  
```

Text alignment can be controlled by colons:

```md
Erste Kopfzeile | Zweite Kopfzeile | Dritte Kopfzeile  
:-------------- | :--------------: | ---------------:  
Linksbündig     | Zentriert        | Rechtsbündig  
Linksbündig     | Zentriert        | Rechtsbündig  
```

#### Footnotes

Footnotes are created as follows:

```md
Dies ist ein Text mit Fußnote.[^1]

[^1]: Und dies ist die Fußnote.
```

The footnote definition can be placed anywhere in the document.

### Further Information

For complete documentation on Markdown, visit the [official website](http://daringfireball.net/projects/markdown/syntax) .

For complete documentation on Markdown Extra, visit the [official website](http://michelf.ca/projects/php-markdown/extra) .

## Accordion

The accordion effect allows you to create several sections, of which only one is open at a time. If another section is selected, the first one closes automatically.

**Operating mode:** Here you select the operating mode of the accordion element.

| Operating mode | Declaration |
| -------------- | ----------- |
| Single element | In this mode the element creates a single accordion section with a text element and an optional image. |
| Envelope beginning | In this mode the element opens a new accordion section into which any other content elements can be inserted. |
| Envelope end | In this mode, the element closes an accordion section previously opened using "Envelope Beginning". |

**Area heading:** Each accordion section has a heading that is always visible and can be opened. HTML input is allowed here.

**CSS format:** If you want to format the area header using CSS code, you can enter a format definition here.

**Class names:** Leave this field empty to use the default class names or enter your own toggler and accordion classes.

**Text:** Here you can enter the text of the accordion section. The input is done in the same way as for the text element using the Rich Text Editor.

**Add an image:** Here you can add an image to the element.

**Individual template:** Here you can overwrite the standard template `ce_accordionSingle` or `ce_accordionStart`.

**HTML output**   
 The element generates the following HTML code for a "Single Element":

```html
<section class="ce_accordionSingle first ce_accordion ce_text block">

    <div class="toggler">…</div>

    <div class="accordion">
        <div>
            <p>…</p>
        </div>
    </div>

</section>
```

Otherwise the generated HTML code looks like this:

```html
<section class="ce_accordionStart first ce_accordion block">

    <div class="toggler">…</div>

    <div class="accordion">
        <div>
            <div class="ce_text block">
                <p>…</p> 
            </div>
        </div>
    </div>

</section>
```

Note that the contents of each accordion section are enclosed by two (!) `<div> elements`. This is necessary for the effect to work and be formatted across browsers.

## Content slider

With the content element "Content Slider" a slider is created from different content elements.

For the slider to work, the *js\_slider* template must be included in the page layout.

**Operating mode:** Here you select the operating mode of the slider element.

| Operating mode | Declaration |
| -------------- | ----------- |
| Envelope beginning | In this mode the element opens a new slider section into which any other content elements can be inserted. |
| Envelope end | In this mode, the element closes a slider section previously opened using "Envelope Start". |

**Slide Interval:** Here you can define the time interval in milliseconds between slides (1000 = 1s). 0 disables the automatic change.

**Transition Speed:** Here you can set the transition speed in milliseconds (1000 = 1s).

**Slide offset:** Here you can start the slider with a specific slide (counting starts at 0).

**Continuous:** Create a continuous slider (start over when the end is reached).

**Individual template:** Here you can overwrite the default template `ce_sliderStart`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_sliderStart first block">

    <div class="content-slider" data-config="5000,300,0,1">
        <div class="slider-wrapper">    
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
        </div>
    </div>

    <nav class="slider-control">
        <a href="#" class="slider-prev">Zurück</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Vorwärts</a>
    </nav>

</div>
```

## Hyperlink

The Hyperlink content element adds a link to an external Web page or e-mail address to the article. Of course, you can also enter hyperlinks using the Rich Text Editor in the text element.

![Creating a hyperlink](/de/article-management/images/de/einen-hyperlink-anlegen.png?classes=shadow)

**Link address:** Enter the link address including the network protocol. For web pages the network protocol is usually `http://` or `https://` , for e-mail addresses `mailto:` and for telephone numbers `tel:` . Contao automatically encrypts email addresses so that they cannot be read by spambots.

**Open in a new window:** Opens the link in a new browser window.

**Link text:** The link text is displayed instead of the link address.

**Embed the link:** To turn only certain words in a sentence into a hyperlink, you can embed the link in the sentence. For example, if the title of the link is "Company page", you can embed it in the sentence "Visit our %s! The placeholder %s will be replaced by the link in the output, so that the sentence "Visit our company page!

**Link title:** The link title is inserted as a `title` attribute in the HTML markup.

**Lightbox:** Here you can set the `data-lightbox` attribute of the link used to control the lightbox.

**Image link settings**

If you select the **Create an image link** option, you can create an image link instead of a text link. Alternatively, you can also create an image element and link it.

![Create an image link](/de/article-management/images/de/einen-bildlink-erstellen.png?classes=shadow)

**Source file:** Here you select the image to be used.

**Image size:** Here you can specify the dimensions of the image. You can find more information in the [text](#text) .

**Overwrite metadata:** Here you can overwrite the metadata from the file manager.

**Alternative text:** A barrier-free website should contain a short description for each object. This description is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Picture title:** Here you can enter the title of the image (title attribute).

**Caption:** Here you can enter a caption.

**Individual template:** Here you can overwrite the default template `ce_hyperlink`.

**HTML output**   
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

The content element "Top-Link" adds a link to the article, with which you can jump to the top of the page. This is especially useful for long pages.

**Link text:** Here you can enter a name for the link. If you leave this field empty, the default name "Up" will be used.

**Individual template:** Here you can overwrite the standard template `ce_text`.

**HTML output**   
 The element generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="ce_toplink first last block">
    <a href="#top" title="Nach oben">Nach oben</a>
</div>
<!-- indexer::continue -->
```

## Picture

The content element "Image" adds an image to the article. An image can have a large view or it can be an image link to a specific URL.

![Create a screen element](/de/article-management/images/de/ein-bildelement-anlegen.png?classes=shadow)

**Source file:** Here you select the image to be used.

**Image size:** Here you can specify the dimensions of the image. For more information, see the [Text](#text) section.

*Image distance:* Here you define the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite metadata:** Here you can overwrite the metadata from the file manager.

**Alternative text:** A barrier-free website should contain a short description for each object. This description is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Picture title:** Here you can enter the title of the image (title attribute).

**Image link address:** When you click on a linked image, you will be redirected to the specified target page (corresponds to an image link). Please note that for a linked image a lightbox large view is no longer possible.

**Caption:** Here you can enter a caption.

**Individual template:** Here you can overwrite the default template `ce_image`.

**HTML output**   
 The element generates the following HTML code:

```html
div class="ce_image first last block">
    <figure class="image_container">
        <a href=…" title="…" data-lightbox="…">
            <img src="…" alt="…" itemprop="image">
        </a>
        <figcaption class="caption">…</figcaption>
    </figure>
</div>
```

## Gallery

The content element "Picture gallery" adds a picture gallery to the article, i.e. a collection of several thumbnails that are listed in a list and are enlarged when clicked. If there are a lot of images, the gallery can be spread over several pages.

![The picture gallery in the frontend](/de/article-management/images/de/die-bildergalerie-im-frontend.png?classes=shadow)

**Source files:** Here you select one or more folders or files to be included in the image gallery. If you select a folder, Contao automatically transfers all images contained in the folder to the gallery. You can rearrange the images by dragging them.

**Sort by:** Here you select the sort order. The following sort orders are available:

- Individual sequence
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without metadata:** If no metadata for the appropriate page language has been entered for the files, they are not displayed when activated.

**Image size:** Here you can specify the dimensions of the image. For more information, see the [Text](#text) section.

**Image distance:** Here you can set the distance between the image and the text. The order of the fields is clockwise "top, right, bottom, left".

**Thumbnails per row:** Here you define the number of thumbnails per row.

**Large view/New window:** If this option is selected, the image will be opened in its original size in the lightbox when clicked (JavaScript is required for this).

**Elements per page:** Contao can automatically spread large image galleries across multiple pages to reduce the loading time of the gallery. Set the maximum number of thumbnails per page here.

**Total number of images:** Here you can limit the total number of pictures. Enter 0 to display all.

**Gallery template:** Here you can overwrite the gallery template.

**Individual template:** Here you can overwrite the default template `ce_gallery`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_gallery first last block">

    <ul class="cols_2" itemscope itemtype="http://schema.org/ImageGallery">
        <li class="row_0 row_first row_last even col_0 col_first">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
        <li class="row_0 row_first row_last even col_1 col_last">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
    </ul>

    <!-- indexer::stop -->
    <nav class="pagination block" aria-label="Seitenumbruch-Menü">
        <p>Seite 1 von 2</p>
        <ul>
            <li><strong class="active">1</strong></li>
            <li><a href="…" class="link" title="Gehe zu Seite 2">2</a></li>
            <li class="next"><a href="…" class="next" title="Gehe zu Seite 2">Vorwärts</a></li>
        </ul>
    </nav>
    <!-- indexer::continue -->

</div>
```

## Video/Audio

The content element "Video/Audio" adds a video or audio file to the article.

**Video/audio files:** Here you can add the video/audio file or - if you use different codecs - the video/audio files.

{{< version "4.6" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Hide controls
- Playing in a loop
- Play inline (no full screen mode)
- Mute the audio output

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Stop at:** Playback will stop at the specified number of seconds. Enter 0 to disable the feature.

**Caption:** Here you can enter a caption.

**Preloading:** Here you can recommend to the browser how the browser should preload the video. There are the following three options "Auto (preload the whole video)", "Metadata (preload only the metadata)" and "None (preload nothing)

**Preview image:** Display the image instead of the first frame of the video before playing.

**Individual template:** Here you can overwrite the standard template `ce_player`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_player first last block">

    <figure class="video_container">
        <video width="…" height="…" autoplay loop playsinline muted>
            <source type="video/mp4" src="…" title="…">
        </video>
        <figcaption class="caption">……</figcaption>
    </figure>

</div>
```

## YouTube

The YouTube content element adds a YouTube video to the article.

**YouTube ID:** Please enter the YouTube video ID for your video (e.g. rOGhp63Lvbo).

{{< version "4.5" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Hide controls
- Show subtitles by default
- Hide the fullscreen button
- Using the Contao page language
- Hide annotations
- Hide the YouTube logo
- Do not show similar videos at the end
- Hide the link bar in the preview
- Use the youtube-nocookie.com domain

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Stop at:** Playback will stop at the specified number of seconds. Enter 0 to disable the feature.

**Caption:** Here you can enter a caption.

**Aspect ratio:** Here you can set the [aspect ratio of the video](https://de.wikipedia.org/wiki/Bildaufl%C3%B6sung#Video) to make it responsive.

{{< version "4.8" >}}

**Use a startup image:** The video will not load until the user clicks on the startup image.

**Source file:** Here you select an image from the file overview.

**Image size:** Here you can specify the dimensions of the image. For more information, see the [Text](#text) section.

**Individual template:** Here you can overwrite the standard template `ce_youtube`.

**HTML output**   
 The element generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="ce_youtube first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://www.youtube-nocookie.com/embed/rOGhp63Lvbo?autoplay=1&amp;controls=0&amp;cc_load_policy=1&amp;fs=0&amp;hl=de&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;start=10">
                <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```

## Vimeo

The content element "Vimeo" adds a Vimeo video to the article.

**Vimeo ID:** Please enter the Vimeo video ID (e.g. 275028611).

{{< version "4.5" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Playing in a loop
- Hide the profile picture
- Hide the title
- Hide the author

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Colors of the control elements:** Here you can enter a hexadecimal color code (e.g. ff0000) for the control elements.

**Caption:** Here you can enter a caption.

**Aspect ratio:** Here you can set the [aspect ratio of the video](https://de.wikipedia.org/wiki/Bildaufl%C3%B6sung#Video) to make it responsive.

{{< version "4.8" >}}

**Use a startup image:** The video will not load until the user clicks on the startup image.

**Source file:** Here you select an image from the file overview.

**Image size:** Here you can specify the dimensions of the image. For more information, see the [Text](#text) section.

**Individual template:** Here you can overwrite the default template `ce_vimeo`.

**HTML output**   
 The element generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="ce_vimeo first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://player.vimeo.com/video/275028611?autoplay=1&amp;loop=1&amp;portrait=0&amp;title=0&amp;byline=0&amp;color=ff0000#t=10s">
            <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```

## Download

The content element "Download" adds a download link to the article. Clicking on the link opens the "Save file as ..." dialog and you can save the linked file on your local computer.

The special feature of Contao is that this download link also works with protected files that you cannot access directly from your browser. This way you can easily create a protected download area. For more information, see the section [File management](../../dateiverwaltung/) .

**Source file:** Here you can select the download file.

{{< version "4.8" >}}

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Link text:** The link text is displayed instead of the file name.

**Link title:** The link title is inserted as a `title` attribute in the HTML markup.

**Individual template:** Here you can overwrite the default template `ce_download`.

Note that only the file types you have specified in the backend settings under "Allowed download file types" can be downloaded.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_download first last block">
    <p class="download-element ext-pdf">
        <a href="…" title="…">… <span class="size">(…)</span></a>
    </p>
</div>
```

## Downloads

The content element "Downloads" adds several download links to the article. Clicking on a link opens the "Save file as ..." dialog and you can save the file on your local computer.

![The Downloads element in the frontend](/de/article-management/images/de/das-downloads-element-im-frontend.png?classes=shadow)

The special feature of Contao is that these download links also work with protected files that you cannot access directly from your browser. This way you can easily create a protected download area. For more information, see the section [File management](../../dateiverwaltung/) .

**Source files:** Here you select one or more folders or files to be included in the Donwloads item. When you select a folder, Contao automatically takes all downloadable files contained in it.

{{< version "4.8" >}}

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Sort by:** Here you select the sort order. The following sort orders are available:

- Individual sequence
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without metadata:** If no metadata for the appropriate page language has been entered for the files, they are not displayed when activated.

**Individual template:** Here you can overwrite the default template `ce_downloads`.

Note that only the file types you have specified in the backend settings under "Allowed download file types" can be downloaded.

**HTML output**   
 The element generates the following HTML code:

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

## Article

The content element "Article" allows the multiple integration of an article without having to copy it. Note that only the content elements and not the article header are copied.

**Article referred to:** Here you choose the original article.

Alias elements use the same HTML markup as the original element.

## Content element

The content element "Content element" is used to insert an existing content element a second time without having to copy it. The advantage of this method is that you only have to enter any changes in the original content element and these changes are automatically copied to all alias elements.

**Related content element:** Here you select the original element.

Alias elements use the same HTML markup as the original element.

## Form

The content element "Form" adds a form to the article. For information on creating and managing forms, see the [Form Generator](../../formulargenerator/) section.

**Form:** Select the form you want to insert here.

## Module

The content element "Module" adds a frontend module to the article. You already know how to create and configure modules from the section [Module Management](../../modulverwaltung/) .

**Module:** Here you select the module you want to insert.

The HTML output depends on the respective module type.

## Article teaser

The content element "Article teaser" adds the teaser text of another article to the article, followed by a read more link. Clicking on this link will take you directly to the linked article.

**Article:** Here you choose the original article.

**Individual template:** Here you can overwrite the standard template `ce_teaser`.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_teaser first last ce_text block">
    <h1>…</h1>
    <p class="more"><a href="…" title="…">Weiterlesen …<span class="invisible"> …</span></a></p>
</div>
```

## Comments

The content element "Comments" offers visitors the possibility to leave comments on your website. You can also run a guestbook with it.

**Sorting order:** Here you define the order of the comments. Guestbooks normally show the newest entry first (descending order), comments on the other hand show the oldest (ascending order).

**Elements per page:** Here you can define the number of comments per page. Contao automatically generates a page break if required. Enter 0 to disable the automatic page break.

**Moderate:** If you choose this option, comments will not appear on the website immediately, but only after you have approved them in the backend.

**Allow BBCode:** If you select this option, your visitors can use [BBCode](https://de.wikipedia.org/wiki/BBCode) to format their comments. The following tags are supported:

| Tag | Explanation |
| --- | ----------- |
| `[b][/b]` | Boldface |
| `[i][/i]` | Italics |
| `[u][/u]` | Underlined |
| `[img][/img]` | Insert picture |
| `[code][/code]` | Insert program code |
| `[color=#f00][/color]` | Coloured text |
| `[quota][/quote]` | Insert quote |
| `[quote=time][/quote]` | Insert quote with mention of the author |
| `[url][/url]` | Insert link |
| `[url=http://example.com][/url]` | Insert link with link title |
| `[email] [email]` | Insert e-mail address |
| `[email=info@example.com][/email]` | Insert e-mail address with title |

**Login required for commenting:** If you select this option, only logged in members can add comments. However, comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** Here you can disable the spam protection (not recommended). Since Contao 4.4, this question is only "displayed" to spambots. Without a security question, it is possible that spammers automatically create user accounts and abuse your website.

**Comment template:** Here you can select the template for the individual posts.

**Individual template:** Here you can overwrite the default template `ce_comments`.

**Comment management**

The management of the comments your visitors make is done centrally in the backend with the module "Comments", which you can find in the navigation in the group Content. All comments are displayed there, no matter if they refer to a content element, an article or a blog post. If you want, you can filter the list of comments by their origin or parent element.

![Filter comments by origin](/de/article-management/images/de/kommentare-nach-ihrem-ursprung-filtern.png?classes=shadow)

If you have enabled the "Moderate comments" option, you can check new comments in the comment management before they appear on the website. In this way, you can prevent spam attempts, for example.

**HTML output**   
 The element generates the following HTML code:

```html
<div class="ce_comments first last block">

    <div class="comment_default first even" id="c1">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>

    <div class="comment_default last odd" id="c2">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>

    <!-- indexer::stop -->
        <div class="form">
            <form action="…" id="com_tl_content" method="post">
                <div class="formbody">                  
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_name" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Name<span class="mandatory">*</span>
                        </label>
                        <input type="text" name="name" id="ctrl_name" class="text mandatory" value="" required maxlength="64">
                    </div>
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_email" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>E-Mail (wird nicht veröffentlicht)<span class="mandatory">*</span>
                        </label>
                        <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                    </div>
                    <div class="widget widget-text">
                        <label for="ctrl_website">Webseite</label>
                        <input type="url" name="website" id="ctrl_website" class="text" value="" maxlength="128">
                    </div>
                    <div class="widget widget-textarea mandatory">
                        <label for="ctrl_comment" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Kommentar<span class="mandatory">*</span>
                        </label>
                        <textarea name="comment" id="ctrl_comment" class="textarea mandatory" rows="4" cols="40" required></textarea>
                    </div>
                    <div class="widget widget-checkbox">
                        <fieldset id="ctrl_notify" class="checkbox_container">
                            <input type="hidden" name="notify" value="">
                            <span>
                                <input type="checkbox" name="notify" id="opt_notify_0" class="checkbox" value="1"> 
                                <label id="lbl_notify_0" for="opt_notify_0">…</label>
                            </span>
                        </fieldset>
                    </div>
                    <div class="widget widget-submit">
                        <button type="submit" class="submit">Kommentar absenden</button>
                    </div>
                </div>
            </form>
        </div>
    <!-- indexer::continue -->

</div>
```

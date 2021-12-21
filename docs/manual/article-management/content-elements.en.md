---
title: 'Content elements'
description: 'To make the creation of content as intuitive as possible, Contao provides a content element for each content type that is tailored to its requirements.'
aliases:
    - /en/article-management/content-elements/
weight: 20
---

To make the creation of content as intuitive as possible, Contao provides a content element for each content type that is tailored to its requirements. You can create an unlimited number of content elements per article and restrict access to individual elements as needed.

![Restrict access to a content element](/de/article-management/images/en/restrict-access-to-a-module.png?classes=shadow)

| Info |
| ----- | - |
| **Protect element:** | The content element is invisible by default and is only displayed after a member has logged in to the frontend. |
| **Allowed member groups:** | Here you define who has access to the content element. |
| **Show guests only:** | The content element is visible by default and is hidden as soon as a member has logged in to the frontend. |


## Overview

{{% expand "Text elements" %}}
[Header](#title)<br>
[Text](#text)<br>
[HTML](#html)<br>
[List](#list)<br>
[Table](#table)<br>
[Code](#code)<br>
[Markdown](#markdown)
{{% /expand %}}

{{% expand "Accordion" %}}
[Single element](#accordion)<br>
[Wrapper start](#accordion)<br>
[Wrapper stop](#accordion)
{{% /expand %}}

{{% expand "Content slider" %}}
[Wrapper start](#content-slider)<br>
[Wrapper stop](#content-slider)
{{% /expand %}}

{{% expand "Link elements" %}}
[Hyperlink](#hyperlink)<br>
[Top Link](#top-link)
{{% /expand %}}

{{% expand "Media elements" %}}
[Image](#image)<br>
[Gallery](#gallery)<br>
[Video/Audio](#video-audio)<br>
[YouTube](#youtube)<br>
[Vimeo](#vimeo)
{{% /expand %}}

{{% expand "File elements" %}}
[Download](#download)<br>
[Downloads](#downloads)
{{% /expand %}}

{{% expand "Include elements" %}}
[Article](#article)<br>
[Content element](#content-element)<br>
[Form](#form)<br>
[Module](#module)<br>
[Article teaser](#article-teaser)<br>
[Comments](#comments)<br>
[Custom template](#template)
{{% /expand %}}


## Header {#title}

The content element "Heading" adds a heading to the article. Most content elements support entering a heading directly, so you don't have to use the element separately each time.

**heading:** Here you can enter the heading.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is shown as `h1` (usually only one per page), while the values `h2` up to `h6` create hierarchically lower headlines and of course can occur several times on a page.

**Individual template:** Here you can overwrite the standard `ce_headline` template.

**HTML output**  
The element generates the following HTML code:

```html
<h1 class="ce_headline first last">…</h1>
```


## Text {#text}

The content element "Text" adds formatted text to the article. The input takes place via a so-called Rich Text Editor, which allows you to apply some formatting, similar to a word processing program. Contao uses [TinyMCE](https://www.tiny.cloud/), an Open Source editor by the Swedish company Moxiecode that can be easily adapted to the requirements of accessibility.

![The Rich Text Editor TinyMCE](/de/article-management/images/en/the-tinymce-rich-text-editor.png?classes=shadow)

**Heading:** Here you can enter a headline.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is shown as `h1` (usually only one per page), while the values `h2` up to `h6` create hierarchically lower headlines and of course can occur several times on a page.

**text:** Here you enter the text of the content element.

**Add an image**

You can add an image to the text element, which is then surrounded by your text. The following options are available:

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can upload it here without leaving the input mask.

![Adding an image to a text](/de/article-management/images/en/add-an-image-to-a-text.png?classes=shadow)

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
| Right / Top | Get the right part of a landscape image and the upper part of a portrait image. |
| Left / Middle | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Preserves the central part of a landscape image and the central part of a portrait image. |
| Right / Middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Contains the left part of a landscape image and the lower part of a portrait image. |
| Middle / Bottom | Preserves the central part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |

**Image alignment:** Here you can set the alignment of the image. If it is inserted ![above](/de/icons/above.svg?classes=icon) **above**, ![under](/de/icons/below.svg?classes=icon) **below**, ![left-justified](/de/icons/left.svg?classes=icon) **left-aligned** or ![right-justified](/de/icons/right.svg?classes=icon) **right-aligned**. When **left-** or **right-aligned**, the text **flows around** the image (as symbolized by the icon).

**Image margin:** Here you can define the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite meta data:**  Here you can overwrite the meta data from the file manager.

**Alternate text:** Here you can enter an alternative text for the image *(alt attribute)*. Accessible web pages should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image *(title attribute)*.

**Image link target:** When you click on a linked image, you will be redirected to the specified destination page (corresponds to an image link). Please note that a lightbox large view is no longer possible for a linked image.

**Image caption:** Here you can enter a caption.

**Individual template:** Here you can overwrite the standard `ce_text` template.

  
**HTML Output** 
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


## HTML {#html}

The content element "HTML" adds arbitrary HTML code to the article. Note that not all HTML tags are allowed by default. The list of allowed tags can be configured in the backend settings.

**HTML code:** Here you can enter the HTML code.

**Individual template:** Here you can overwrite the standard `ce_html` template.

The content element has no enclosing HTML markup.


## List {#list}

The content element "List" adds a non-nested list to the article. You can choose between an ordered list and an unordered list enumeration. A JavaScript assistant supports you in creating and editing the list items.

![JavaScript wizard for listings](/de/article-management/images/en/javascript-assistant-for-lists.png?classes=shadow)

With a click on the icon next ![Import list data from a CSV file](/de/icons/tablewizard.svg?classes=icon) to the field name "List entries" you open the CSV import wizard, with which you can import list data from a CSV file. The CSV file must have been transferred to the upload directory before.

**Individual Template**: Here you can overwrite the standard `ce_list` template.

  
**HTML Output**
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

A numbered enumeration uses the `<ol>` tag instead of the `<ul>` tag.


## Table {#table}

The content element "Table" adds a table to the article. A JavaScript assistant supports you in creating the rows and columns. You can edit the table with the following navigation icons:

- ![Reduce the size of the input fields](/de/icons/demagnify.svg?classes=icon) **Reduce the size of the input fields**
- ![Enlarge the input fields](/de/icons/magnify.svg?classes=icon) **Enlarge the input fields**
- ![Duplicate the column/row](/de/icons/copy.svg?classes=icon) **Duplicate the column/row**
- ![Move the column one position to the left](/de/icons/movel.svg?classes=icon)**Move the column one position to the left**
- ![Move the column one position to the right](/de/icons/mover.svg?classes=icon)**Move the column one position to the right**
- ![Delete the column/row](/de/icons/delete.svg?classes=icon) **Delete the column/row**
- ![Move the element by dragging and dropping it](/de/icons/drag.svg?classes=icon)**Move the row by dragging and dropping it**

![JavaScript wizard for tables](/de/article-management/images/en/javascript-assistant-for-tables.png?classes=shadow)

With a click on the icon next ![Import list data from a CSV file](/de/icons/tablewizard.svg?classes=icon) to the field label "Table entries" you open the CSV import wizard, with which you can import table data from a CSV file. The CSV file has to be transferred to the upload directory first.

**Summary:** An accessible website should contain a short summary of the content of each table, which you can enter here.

**Add header:** If you select this option, the first row of the table is formatted as a header using the tag `<thead>`.

**Add footer:** If you select this option, the last row of the table is formatted as a footer using the tag `<tfoot>`.

**Add row headings:** If you select this option, the first column of the table is formatted as a row header using the tag `<th>`.

**Sortable table:** Makes the table sortable in the frontend using JavaScript. The `moo_tablesort` or `j_tablesort` template must be included in the page layout.

**Sorting index:** The number of the column to be sorted by default, as long as the visitor has not made a selection. The count starts at 0.

**Sort order:** The order of the default sort (ascending or descending).

**Individual template:** Here you can overwrite the standard `ce_table` template.

**HTML Output**  
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


## Code {#code}

The content element "Code" adds formatted code to the article. You enter the code with a so-called code editor. Contao uses the Open Source code editor from [Ace](https://ace.c9.io/).

For the output in the frontend to be properly formatted, the `js_highlight` template must be included in the page layout.

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

**code:** Here you can enter the desired code. Note that the code will not be executed.

**Individual template**: Here you can overwrite the standard `ce_code` template.

  
**HTML OutputThe** element generates the following HTML code:

```html
<div class="ce_code first last block">
    …
</div>
```


## Markdown {#markdown}

The content element "Markdown" is used to generate HTML code from a markdown text.

**code:** Here you can enter the desired markdown code. 

**Individual template**: Here you can `ce_markdown` overwrite the default template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_markdown first last block">
    <div>
        <h1>…</h1>
        <p>…</p>
    </div>
</div>
```

Below are some examples of Markdown syntax:

### Syntax

#### Paragraphs

Paragraphs are created by a blank line:

```md
First paragraph

Second paragraph
```

#### Headlines

Six levels of headings are possible:

```md
# Headline 1
## Headline 2
### Headline 3
#### Headline 4
##### Headline 5
###### Headline 6
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

Converts to the following HTML code:

```html
<em>emphasize</em>
```

#### Code

To mark a text as computer code:

```md
`monospaced font`
```

Is converted to the following HTML code:

```html
<code>monospaced font</code>
```

#### Code blocks

To convert an entire paragraph to code, indent the text with four spaces.

```md
    Monospac font ...
    ... spanning several lines
```

#### Quote block

Citation blocks can be created by placing a right angle bracket at the beginning of the line.

```md
> This is a quotation.
```

#### Line break

Two or more blanks at the end of a line create a line wrap:

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

or optionally with a title:

```md
[Contao](https://contao.org/de "Offizielle Contao-Webseite")
```

A reference link looks like this:

```md
[Offizielle Contao-Webseite][1]

[1]:https://contao.org/de
```

The reference can be placed anywhere in the document.

#### Images

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

**Unordered lists**

Unordered lists use asterisks or hyphens:

```md
* List entry  
* List entry  
    * Nested entry
    * Nested entry
* List entry

- List entry  
- List entry  
- List entry
```

**Ordered lists**

Ordered lists use numbers:

```md
1. List entry  
2. List entry  
3. List entry
```

### Extended Syntax

Not all HTML elements like tables or footnotes can be described with regular Markdown, so there is a project for "Markdown Extra" to extend the syntax.

Below are some examples of the extended syntax:

#### Tables

A table can be created as follows:

```md
First Headline  | Second Headline  | Third Headline  
--------------- | ---------------- | ----------------  
cell content    | cell content     | cell content  
cell content    | cell content     | cell content  
```

Text alignment can be controlled by colons:

```md
First Headline  | Second Headline  | Third Headline  
:-------------- | :--------------: | ---------------:  
left aligned    | centered         | right aligned  
left aligned    | centered         | right aligned  
```

#### Footnotes

Footnotes are created as follows:

```md
This is a text with a footnote.[^1]

[^1]: And this is the footnote.
```

The footnote definition can be placed anywhere in the document.

### Further information about footnotes

For complete documentation on Markdown, visit [the official website](http://daringfireball.net/projects/markdown/syntax).

For complete documentation on Markdown Extra, visit [the official website](http://michelf.ca/projects/php-markdown/extra).


## Accordion {#accordion}

The accordion effect allows you to create several sections, of which only one is open at a time. If one section is selected, the first one closes automatically.

**Operating mode:** Here you select the operating mode of the accordion element.

| Operating mode | Declaration |
| -------------- | ----------- |
| Single element | In this mode the element creates a single accordion section with a text element and an optional image. |
| Start envelope | In this mode the element opens a new accordion section into which any other content elements can be inserted. |
| Envelope end | In this mode, the element closes an accordion section previously opened using "Envelope Beginning". |

**Section Heading:** Each accordion section has an always visible heading, which can be used to open it. HTML input is allowed here.

**CSS-Format:** If you want to format the section headline with CSS code, you can enter a format definition here.

**Class names:** Leave this field empty to use the default class names or enter your own toggler and accordion classes.

**Text:** Here you can enter the text of the accordion section. The input is done in the same way as for the text element using the Rich Text Editor.

**Add an image:** Here you can add an image to the element.

**Individual Template**: Here you can overwrite `ce_accordionStart` the standard `ce_accordionSingle` template.

**HTML Output**  
The element generates the following HTML code for a Single Element:

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

Note that the contents of each accordion section is enclosed by two (!) `<div>` elements. This is necessary for the effect to work and be formatted across browsers.


## Content slider {#content-slider}

With the content element "Content Slider" a slider is created from different content elements.

For the slider to work, the `js_slider` template must be included in the page layout.

**Operation mode:** Here you select the operation mode of the slider element.

| Operating mode | Declaration |
| -------------- | ----------- |
| Envelope beginning | In this mode the element opens a new slider section into which any other content elements can be inserted. |
| End envelope | In this mode, the element closes a slider section previously opened using "Envelope Start". |

**Slide Interval:** Here you can define the time interval between slides in milliseconds (1000 = 1s). 0 disables the automatic change.

**Transition Speed:** Here you can set the transition speed in milliseconds (1000 = 1s).

**Slide offset:** Here you can start the slider with a specific slide (counting starts at 0).

**Continuous:** Create a continuous slider (start over when the end is reached).

**Individual template:** Here you can overwrite the default `ce_sliderStart` template.

**HTML Output**  
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


## Hyperlink {#hyperlink}

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


## Top link {#top-link}

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


## Image {#image}

The content element "Image" adds an image to the article. An image can have a large view or it can be an image link to a specific URL.

![Create a screen element](/de/article-management/images/en/create-an-imageelement.png?classes=shadow)

**Source file:** Here you select the image to be used.

**Image size**: Here you can specify the dimensions of the image. See the [Text](#text) section for more information.

*Image margin*: Here you can set the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Full-sizeview/new window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite meta data:** Here you can overwrite the meta data from the file manager.

**Alternate text:** An accessible web page should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative text is also evaluated by search engines and is therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image (title attribute).

**Image link target:** When clicking on a linked image, you will be redirected to the specified target page (corresponds to an image link). Please note that for a linked image a lightbox full view is no longer possible.

**Image caption:** Here you can enter a caption.

**Individual template**: Here you can overwrite the standard `ce_image` template.

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


## Gallery {#gallery}

The content element "Gallery" adds a picture gallery to the article, i.e. a collection of several thumbnails that are listed in a list and are enlarged when clicked. With so many images, the gallery can be spread over several pages.

![The gallery in the frontend](/de/article-management/images/en/the-gallery-in-the-frontend.png?classes=shadow)

**Source files:** Here you can select one or more folders or files to be included in the gallery. If you select a folder, Contao will automatically add all images in the folder to the gallery. You can rearrange the individual images by dragging them.

**Sort by:** Here you can choose the sort order. The following sort orders are available:

- Custom order
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without meta data:** If no meta data for the appropriate page language has been entered for the files, they are not displayed when activated.

**Image size:** Here you can specify the dimensions of the image. See the [Text](#text) section for more information.

**Image margin**: Here you can set the distance between the image and the text. The order of the fields is clockwise "top, right, bottom, left".

**Thumbnails per row:** Here you can set the number of thumbnails per row.

**Full-size view/new window:** If this option is selected, the image will be opened in its original size in the Lightbox when clicked (JavaScript is required for this).

**Items per page:** Contao can automatically spread large image galleries over multiple pages to reduce the loading time of the gallery. Set the maximum number of thumbnails per page here.

**Total number of images:** Here you can limit the total number of images. Enter 0 to display all.

**Gallery template**: Here you can overwrite the gallery template.

**Content element template**: Here you can overwrite the default `ce_gallery` template.

**HTML Output**  
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


## Video/Audio {#video-audio}

The content element "Video/Audio" adds a video or audio file to the article.

**video/audio files:** Here you can add the video/audio file or, if you use different codecs, the video/audio files.

{{< version "4.6" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Hide the controls
- Playing in a loop
- Play inline (no fullscreen mode)
- Mute the audio output

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Stop at:** Playback will stop at the specified number of seconds. Enter 0 to disable the feature.

**Caption:** You can enter a caption here.

**Preloading:** Here you can tell the browser how to preload the video. There are three options "Auto (preload the entire video)", "Metadata (preload the metadata only)" and "None (do not preload anything)

**Preview image:** Show this image instead of the first frame of the video before playback.

**Content element template:** Here you can overwrite the default `ce_player` template.

**HTML Output**  
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


## YouTube {#youtube}

The YouTube content element adds a YouTube video to the article.

**YouTube ID:** Please enter the YouTube video ID for your video (e.g. rOGhp63Lvbo).

{{< version "4.5" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Hide the controls
- Show captions by default
- Hide the fullscreen button
- Using the Contao page language
- Hide annotations
- Hide the YouTube logo
- Limit related videos to the same channel
- Hide the top bar in the preview
- Use the youtube-nocookie.com domain

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Stop at:** Playback will stop at the specified number of seconds. Enter 0 to disable the feature.

**Caption:** You can enter a caption here.

**Aspect Ratio**: Here you can set [the aspect ratio of the video](https://en.wikipedia.org/wiki/Aspect_ratio_(image)#Current_video_standards) to make it responsive.

{{< version "4.8" >}}

**Use a splash image:** The video will not load until the user clicks on the splash image.

**Source file:** Here you select an image from the file overview.

**Image size:** Here you can specify the dimensions of the image. See the [Text](#text) section for more information.

**Content element template**: Here you can overwrite the standard `ce_youtube` template.

  
**HTML Output**
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


## Vimeo {#vimeo}

The content element "Vimeo" adds a Vimeo video to the article.

**Vimeo ID:** Please enter the Vimeo video ID (for example, 275028611).

{{< version "4.5" >}}

**Player size:** Here you can set the width and height of the media player in pixels (e.g. 640x480).

**Player options:** Here you can select the different player options.

- Autoplay
- Play in a loop
- Hide the profile image
- Hide the title
- Hide the author

**Start at:** Playback starts at the specified number of seconds. Enter 0 to disable the feature.

**Controls color:** Here you can enter a hexadecimal color code (for example, ff0000) for the controls.

**Caption:** Here you can enter a caption for the image.

**Aspect ratio**: Here you can set [the aspect ratio of the video](https://en.wikipedia.org/wiki/Aspect_ratio_(image)#Current_video_standards) to make it responsive.

{{< version "4.8" >}}

**Use a splash image:** The video will not load until the user clicks on the splash image.

**Source file:** Here you select an image from the file overview.

**Image size**: Here you can specify the dimensions of the image. See the [Text](#text) section for more information.

**Content element template**: Here you can overwrite the standard `ce_vimeo` template.

**HTML Output**  
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


## Download {#download}

The content element "Download" adds a download link to the article. Clicking on the link opens the "Save file as ..." dialog and you can save the linked file to your local computer.

The special feature of Contao is that this download link also works with protected files that you cannot access directly from your browser. This way you can easily create a protected download area. For more information, see the section [File management](/en/file-manager/).

**Source file:** Here you can select the download file.

{{< version "4.8" >}}

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Overwrite meta data:** Overwrite the meta data from the file manager.

**Link text:** The link text is displayed instead of the file name.

**Link title:** The link title is inserted as an `title` attribute in the HTML markup.

**Content element template:** Here you can overwrite the default `ce_download` template.

Note that only those file types can be downloaded that you have specified in the backend settings under "Download file types".

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_download first last block">
    <p class="download-element ext-pdf">
        <a href="…" title="…">… <span class="size">(…)</span></a>
    </p>
</div>
```


## Downloads {#downloads}

The content element "Downloads" adds several download links to the article. Clicking on a link opens the "Save file as ..." dialog and you can save the file on your local computer.

![The Downloads element in the frontend](/de/article-management/images/en/the-downloads-element-in-frontend.png?classes=shadow)

The special feature of Contao is that these download links also work with protected files that you cannot access directly from your browser. This way, you can easily create a protected download area. For more information, see the section [File management](/en/file-manager/).

**Source files:** Here you select one or more folders or files to be included in the donwloads item. If you select a folder, Contao automatically takes all downloadable files contained in it.

{{< version "4.8" >}}

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Sort by:** Here you select the sort order. The following sort orders are available:

- Custom order
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without meta data:** If no metadata for the appropriate page language has been entered for the files, they are not displayed when activated.

**Content element template:** Here you can overwrite the default `ce_downloads` template.

Note that only those file types can be downloaded that you have specified in the backend settings under "Download file types".

**HTML Output**  
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


## Article {#article}

The content element "Article" allows multiple integration of an article without having to copy it. Note that only the content elements and not the article header are copied.

**Referenced article:** Here you select the original article.

Alias elements use the same HTML markup as the original element.


## Content element {#content-element}

The content element "Content element" is used to insert an existing content element a second time without having to copy it. The advantage of this method is that you only need to make changes in the original content element and these changes are automatically reflected in all alias elements.

**Referenced element:** Here you select the original content element.

Alias elements use the same HTML markup as the original element.


## Form {#form}

The content element "Form" adds a form to the article. For information on creating and managing forms, see the [Form Generator](/en/form-generator/) section.

**Form:** Select the form you want to insert.


## Module {#module}

The content element "Module" adds a frontend module to the article. You already know how to create and configure modules from the section [Module Management](/en/layout/module-management/).

**Module:** Here you select the module you want to insert.

The HTML output depends on the module type.


## Article teaser {#article-teaser}

The content element "Article teaser" adds the teaser text of another article to the article, followed by a read more link. Clicking on this link will take you directly to the linked article.

**Article:** Here you select the original article.

**Individual template:** Here you can overwrite the standard `ce_teaser` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_teaser first last ce_text block">
    <h1>…</h1>
    <p class="more"><a href="…" title="…">Weiterlesen …<span class="invisible"> …</span></a></p>
</div>
```


## Comments {#comments}

The content element "Comments" offers visitors the possibility to leave comments on your website. You can also run a guestbook with it.

**Sort order:** Here you can determine the order of the comments. Guestbooks usually show the newest entry first (descending order), comments show the oldest (ascending order).

**Items per page:** Here you can define the number of comments per page. Contao automatically creates a page break when needed. Enter 0 to disable the automatic page break.

**Moderate:** If you select this option, comments do not appear on the website immediately but only after you have enabled them in the back end.

**Allow BBCode:** If you select this option, your visitors can use [BBCode](https://en.wikipedia.org/wiki/BBCode) to format their comments. The following tags are supported:

| tag | Declaration |
| --- | ----------- |
| `[b][/b]` | Boldface |
| `[i][/i]` | Italics |
| `[u][/u]` | Underlined |
| `[img][/img]` | Insert picture |
| `[code][/code]` | Insert program code |
| `[color=#f00][/color]` | Coloured text |
| `[quote][/quote]` | Insert quote |
| `[quote=Tim][/quote]` | Insert quote and mention the author |
| `[url][/url]` | Insert link |
| `[url=http://example.com][/url]` | Insert link with link title |
| `[email][email]` | Insert e-mail address |
| `[email=info@example.com][/email]` | Insert e-mail address with title |

**Require login to comment:** If you select this option, only logged in members can add comments. However, comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** Here you can disable the spam protection (not recommended). Since Contao 4.4, this question is only "displayed" to spambots. Without a security question, it is possible that spammers automatically create user accounts and abuse your website.

**Comments template:** Here you can choose the template for the individual posts.

**Content element templatee**: Here you can overwrite the default `ce_comments` template.

**Comment management**

The management of the comments your visitors make is done centrally in the backend with the module "Comments", which you can find in the navigation in the group Content. All comments are displayed there, no matter if they refer to a content element, an article or a blog post. If you want, you can filter the list of comments by their origin or parent element.

![Filter comments by origin](/de/article-management/images/en/filter-comments-by-origin.png?classes=shadow)

If you have enabled the "Moderate Comments" option, you can check and approve new comments in the comment manager before they appear on the website. This will help you to prevent spam attempts, for example.

**HTML Output**  
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


## Custom Template {#template}

The content element »Custom template« offers the possibility to select any template and to define your own, 
individual placeholders which can be output in the respective template.

| Info |   |
| ---- | - |
| **Template data:** | Specification of one or more key/value pairs. |
| **Content element template:** | Here you can overwrite the default template `ce_template`. |

{{< version "4.13" >}}


---
title: 'Text elements'
description: 'Content elements in the area Text elements'
aliases:
    - /en/article-management/content-elements/text-elements/
weight: 21
---

## Heading

The content element "Heading" adds a heading to the article. Most content elements support entering a heading directly, so you don't have to use the element separately each time.

**heading:** Here you can enter the heading.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is shown as `h1` (usually only one per page), while the values `h2` up to `h6` create hierarchically lower headlines and of course can occur several times on a page.

**Individual template:** Here you can overwrite the standard `ce_headline` template.

**HTML output**  
The element generates the following HTML code:

```html
<h1 class="ce_headline first last">…</h1>
```


## Text

The content element "Text" adds formatted text to the article. The input takes place via a so-called Rich Text Editor, which allows you to apply some formatting, similar to a word processing program. Contao uses [TinyMCE](https://www.tiny.cloud/), an Open Source editor by the Swedish company Moxiecode that can be easily adapted to the requirements of accessibility.

![The Rich Text Editor TinyMCE]({{% asset "images/manual/article-management/en/the-tinymce-rich-text-editor.png" %}}?classes=shadow)

**Heading:** Here you can enter a headline.

With the select menu to the right you can define the semantic hierarchy of this heading. The most important headline of the page is shown as `h1` (usually only one per page), while the values `h2` up to `h6` create hierarchically lower headlines and of course can occur several times on a page.

**text:** Here you enter the text of the content element.

**Add an image**

You can add an image to the text element, which is then surrounded by your text. The following options are available:

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can upload it here without leaving the input mask.

![Adding an image to a text]({{% asset "images/manual/article-management/en/add-an-image-to-a-text.png" %}}?classes=shadow)

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

**Image alignment:** Here you can set the alignment of the image. If it is inserted ![above]({{% asset "icons/above.svg" %}}?classes=icon) **above**, ![under]({{% asset "icons/below.svg" %}}?classes=icon) **below**, ![left-justified]({{% asset "icons/left.svg" %}}?classes=icon) **left-aligned** or ![right-justified]({{% asset "icons/right.svg" %}}?classes=icon) **right-aligned**. When **left-** or **right-aligned**, the text **flows around** the image (as symbolized by the icon).

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


## HTML

The content element "HTML" adds arbitrary HTML code to the article. Note that not all HTML tags are allowed by default. The list of allowed tags can be configured in the backend settings.

**HTML code:** Here you can enter the HTML code.

**Individual template:** Here you can overwrite the standard `ce_html` template.

The content element has no enclosing HTML markup.


## List

The content element "List" adds a non-nested list to the article. You can choose between an ordered list and an unordered list enumeration. A JavaScript assistant supports you in creating and editing the list items.

![JavaScript wizard for listings]({{% asset "images/manual/article-management/en/javascript-assistant-for-lists.png" %}}?classes=shadow)

With a click on the icon next ![Import list data from a CSV file]({{% asset "icons/tablewizard.svg" %}}?classes=icon) to the field name "List entries" you open the CSV import wizard, with which you can import list data from a CSV file. The CSV file must have been transferred to the upload directory before.

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


## Table

The content element "Table" adds a table to the article. A JavaScript assistant supports you in creating the rows and columns. You can edit the table with the following navigation icons:

- ![Reduce the size of the input fields]({{% asset "icons/demagnify.svg" %}}?classes=icon) **Reduce the size of the input fields**
- ![Enlarge the input fields]({{% asset "icons/magnify.svg" %}}?classes=icon) **Enlarge the input fields**
- ![Duplicate the column/row]({{% asset "icons/copy.svg" %}}?classes=icon) **Duplicate the column/row**
- ![Move the column one position to the left]({{% asset "icons/movel.svg" %}}?classes=icon)**Move the column one position to the left**
- ![Move the column one position to the right]({{% asset "icons/mover.svg" %}}?classes=icon)**Move the column one position to the right**
- ![Delete the column/row]({{% asset "icons/delete.svg" %}}?classes=icon) **Delete the column/row**
- ![Move the element by dragging and dropping it]({{% asset "icons/drag.svg" %}}?classes=icon)**Move the row by dragging and dropping it**

![JavaScript wizard for tables]({{% asset "images/manual/article-management/en/javascript-assistant-for-tables.png" %}}?classes=shadow)

With a click on the icon next ![Import list data from a CSV file]({{% asset "icons/tablewizard.svg" %}}?classes=icon) to the field label "Table entries" you open the CSV import wizard, with which you can import table data from a CSV file. The CSV file has to be transferred to the upload directory first.

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


## Code

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


## Markdown

The content element "Markdown" is used to generate HTML code from a markdown text.

| Markdown source |   |
| --------------- | - |
| **Text:** | Here you can enter the desired markdown code. |
| **File:** | {{< version-tag "4.12" >}} Here you can select a Markdown file and use it as content. |


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
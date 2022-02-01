---
title: 'File elements'
description: 'Content elements in the area file elements.'
aliases:
    - /en/article-management/content-elements/file-elements/
weight: 26
---


## Download

The content element "Download" adds a download link to the article. Clicking on the link opens the "Save file as ..." dialog and you can save the linked file to your local computer.

The special feature of Contao is that this download link also works with protected files that you cannot access directly from your browser. This way you can easily create a protected download area. For more information, see the section [File management](/en/file-manager/).

**Source file:** Here you can select the download file.

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


## Downloads

The content element "Downloads" adds several download links to the article. Clicking on a link opens the "Save file as ..." dialog and you can save the file on your local computer.

![The Downloads element in the frontend](/de/article-management/images/en/the-downloads-element-in-frontend.png?classes=shadow)

The special feature of Contao is that these download links also work with protected files that you cannot access directly from your browser. This way, you can easily create a protected download area. For more information, see the section [File management](/en/file-manager/).

**Source files:** Here you select one or more folders or files to be included in the donwloads item. If you select a folder, Contao automatically takes all downloadable files contained in it.

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
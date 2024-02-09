---
title: 'File elements'
description: 'Content elements in the area file elements.'
aliases:
    - /en/article-management/content-elements/file-elements/
weight: 25
---


## Download

The content element "Download" adds a download link to the article. Clicking on the link opens the "Save file as ..." 
dialog and you can save the linked file to your local computer.

The special feature of Contao is that this download link also works with protected files that you cannot access directly 
from your browser. This way you can easily create a protected download area. For more information, see the section 
[File management](/en/file-manager/).


### Source

**Source file:** Here you can select the download file.


### Download settings

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Overwrite link:** Overwrite the link text and link title from the file manager.

**Link text:** The link text is displayed instead of the file name.

**Link title:** The link title is inserted as an `title` attribute in the HTML markup.


### Preview settings

{{% notice info %}}
The PHP extension Imagick or Gmagick must be installed on the server to enjoy this feature.
{{% /notice %}}

**Show preview images:** Here you can view the preview images of the selected files.

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked.

**Number of items:** For example, if you include a 10-page PDF, you can specify how many thumbnails will be generated. 
With 0 all thumbnails are generated in our case so 10. If you want to output only the first page of your PDF as a 
preview image, enter 1 in the field.

{{% notice info %}}
Note that only those file types can be downloaded that you have specified in the backend settings under "Download
file types".
{{% /notice %}}


### Template settings


{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Content element template:** Here you can overwrite the content element `ce_download` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_download block">
    <figure class="image_container">
        <a href="…" data-lightbox="lb3">
            <img src="…" width="…" height="…" alt="">
        </a>
    </figure>
    <p class="download-element ext-pdf">
        <a href="…" title="Die Datei … herunterladen" type="application/pdf">… <span class="size">(…)</span></a>
    </p>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Content element template:** Here you can overwrite the content element `content_element/download` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="download-element ext-pdf content-download">
    <a href="…" title="Die Datei … herunterladen" type="application/pdf">…</a>
    <figure>
        <a href="…" data-lightbox="…" class="cboxElement">                                                                                   
            <img src="…" alt="" srcset="…" sizes="…" width="…" height="…" loading="lazy" class="…">
        </a>
    </figure>
</div>
```
{{% /tab %}}
{{</tabs>}}


## Downloads

The content element "Downloads" adds several download links to the article. Clicking on a link opens the "Save file as 
..." dialog and you can save the file on your local computer.

![The Downloads element in the frontend]({{% asset "images/manual/article-management/en/the-downloads-element-in-frontend.png" %}}?classes=shadow)

The special feature of Contao is that these download links also work with protected files that you cannot access 
directly from your browser. This way, you can easily create a protected download area. For more information, see the 
section [File management](/en/file-manager/).


### Source

**Source files:** Here you select one or more folders or files to be included in the donwloads item. If you select a 
folder, Contao automatically takes all downloadable files contained in it.


### Download settings

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Order by:** Here you select the sort order. The following sort orders are available:

- Custom order
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without metadata:** If no metadata for the appropriate page language has been entered for the files, 
they are not displayed when activated.


### Preview settings

{{% notice info %}}
The PHP extension Imagick or Gmagick must be installed on the server to enjoy this feature.
{{% /notice %}}

**Show preview images:** Here you can view the preview images of the selected files.

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked.

**Number of items:** For example, if you include a 10-page PDF, you can specify how many thumbnails will be generated.
With 0 all thumbnails are generated in our case so 10. If you want to output only the first page of your PDF as a
preview image, enter 1 in the field.

{{% notice info %}}
Note that only those file types can be downloaded that you have specified in the backend settings under "Download file 
types".
{{% /notice %}}


### Template settings

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Content element template:** Here you can overwrite the content element `ce_downloads` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_downloads block">
    <ul>
        <li class="download-element ext-jpg">
            <figure class="image_container">
                <a href="…" data-lightbox="lb3">
                    <img src="…" width="…" height="…" alt="">
                </a>
            </figure>
            <a href="…" title="Die Datei … herunterladen" type="application/jpeg">… <span class="size">(…)</span></a>
        </li>
    </ul>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Content element template:** Here you can overwrite the content element `content_elements/downloads` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="content-downloads">
    <ul>
        <li class="download-element ext-jpg">
            <a href="…" title="Die Datei … herunterladen" type="image/jpeg">…</a>
            <figure>
                <a href="…" data-lightbox="…" class="cboxElement">
                    <img src="…" alt="" srcset="…" sizes="…" width="…" height="…" loading="lazy" class="…">
                </a>
            </figure>
        </li>
    </ul>
</div>
```
{{% /tab %}}
{{</tabs>}}
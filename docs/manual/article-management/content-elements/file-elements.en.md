---
title: 'File elements'
description: 'Content elements in the area file elements.'
aliases:
    - /en/article-management/content-elements/file-elements/
weight: 26
---


## Download

The content element "Download" adds a download link to the article. Clicking on the link opens the "Save file as ..." 
dialog and you can save the linked file to your local computer.

The special feature of Contao is that this download link also works with protected files that you cannot access directly 
from your browser. This way you can easily create a protected download area. For more information, see the section 
[File management](/en/file-manager/).


### Source

**Source file:** Here you can select the download file.


{{< version "4.8" >}}

### Download settings

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Overwrite meta data:** Overwrite the meta data from the file manager.

**Link text:** The link text is displayed instead of the file name.

**Link title:** The link title is inserted as an `title` attribute in the HTML markup.


{{< version "4.13" >}}

### Preview settings

{{% notice info %}}
The PHP extension Imagick must be installed on the server to enjoy this feature.
{{% /notice %}}

**Show preview images:** Here you can view the preview images of the selected files.

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

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked.

**Number of items:** For example, if you include a 10-page PDF, you can specify how many thumbnails will be generated. 
With 0 all thumbnails are generated in our case so 10. If you want to output only the first page of your PDF as a 
preview image, enter 1 in the field.


### Template settings

**Content element template:** Here you can overwrite the default `ce_download` template.

Note that only those file types can be downloaded that you have specified in the backend settings under "Download 
file types".

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_download block">
    <figure class="image_container">
        <a href="assets/previews/…/file-page1.png" data-lightbox="lb3">
            <img src="assets/images/…/file-page1.png" width="177" height="250" alt="">
        </a>
    </figure>
    <figure class="image_container">
        <a href="assets/previews/…/file-page2.png" data-lightbox="lb3">
            <img src="assets/images/…/file-page2.png" width="177" height="250" alt="">
        </a>
    </figure>
    <p class="download-element ext-pdf">
        <a href="download.html?file=files/download/file.pdf&amp;cid=3" title="Download …" type="application/pdf">… <span class="size">(…)</span></a>
    </p>
</div>
```


## Downloads

The content element "Downloads" adds several download links to the article. Clicking on a link opens the "Save file as 
..." dialog and you can save the file on your local computer.

![The Downloads element in the frontend](/de/article-management/images/en/the-downloads-element-in-frontend.png?classes=shadow)

The special feature of Contao is that these download links also work with protected files that you cannot access 
directly from your browser. This way, you can easily create a protected download area. For more information, see the 
section [File management](/en/file-manager/).


### Source

**Source files:** Here you select one or more folders or files to be included in the donwloads item. If you select a 
folder, Contao automatically takes all downloadable files contained in it.


{{< version "4.8" >}}

### Download settings

**Show in browser:** Display the file in the browser instead of opening the download dialog.

**Sort by:** Here you select the sort order. The following sort orders are available:

- Custom order
- File name (ascending)
- File name (descending)
- Date (ascending)
- Date (descending)
- Random order

**Ignore files without meta data:** If no metadata for the appropriate page language has been entered for the files, 
they are not displayed when activated.


{{< version "4.13" >}}

### Preview settings

{{% notice info %}}
The PHP extension Imagick must be installed on the server to enjoy this feature.
{{% /notice %}}

**Show preview images:** Here you can view the preview images of the selected files.

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

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked.

**Number of items:** For example, if you include a 10-page PDF, you can specify how many thumbnails will be generated.
With 0 all thumbnails are generated in our case so 10. If you want to output only the first page of your PDF as a
preview image, enter 1 in the field.


### Template settings

**Content element template:** Here you can overwrite the default `ce_downloads` template.

Note that only those file types can be downloaded that you have specified in the backend settings under "Download file types".

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_downloads block">
    <ul>
        <li class="download-element ext-docx">
            <figure class="image_container">
                <a href="assets/previews/…/file1.svg" data-lightbox="lb3">
                    <img src="assets/images/…file1.svg" width="250" height="250" alt="">
                </a>
            </figure>
            <a href="downloads.html?file=files/download/file1.docx&amp;cid=3" title="Download …" type="application/msword">… <span class="size">(…)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <figure class="image_container">
                <a href="assets/previews/…/file2-page1.png" data-lightbox="lb3">
                    <img src="assets/images/…/file2-page1.png" width="177" height="250" alt="">
                </a>
            </figure>
            <figure class="image_container">
                <a href="assets/previews/…/file2-page2.png" data-lightbox="lb3">
                    <img src="assets/images/…/file2-page2.png" width="177" height="250" alt="">
                </a>
            </figure>
            <a href="downloads.html?file=files/download/file2.pdf&amp;cid=3" title="Download …" type="application/pdf">… <span class="size">(…)</span></a>
        </li>
    </ul>
</div>
```
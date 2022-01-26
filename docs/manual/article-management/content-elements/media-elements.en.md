---
title: 'Media elements'
description: 'Content elements in the area media elements.'
aliases:
    - /en/article-management/content-elements/media-elements/
weight: 25
---


## Image

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


## Gallery

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


## Video/Audio

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


## YouTube

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


## Vimeo

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
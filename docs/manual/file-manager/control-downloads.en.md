---
title: 'Download Controls'
description: 'With Contao, you can easily restrict access to certain files and define exactly who can and cannot download them.'
aliases:
    - /en/file-manager/control-downloads/
weight: 30
---

With Contao, you can easily restrict access to certain files and define permissions for exactly who can and cannot 
download them. This way you can e.g. create a protected download area for members.


## Protect directory

When you create a new folder in Contao's File Manager, it is accessible via HTTP by default including all subfolders.
If you want to protect a folder, make sure that "Public" is not selected when you create the folder. If a directory is 
made public, all the folders and files within it cannot be protected.

![Protect a directory]({{% asset "images/manual/file-manager/en/protect_directory.jpg" %}}?classes=shadow)

If a folder is public, a `web/files/` symlink will be placed in the directory `files`, without this symlink the data 
would not be accessible to visitors.

![Private/public folders]({{% asset "images/manual/layout/file-manager/en/private_public_folders.jpg" %}}?classes=shadow)

If the folder is not made public, no one can access the files with their internet browser and download them directly. 
However, the files can still be accessed via either of the content elements "Download" or "Downloads".

## Protected download element

You may need to restrict access to downloadable files to certain members or groups, which will still allow them to 
download the files as before. To do this, either set up a protected page in the site structure, or create a protected content element that can 
only be accessed by registered members.

Since downloads are only available through the Download and Downloads content elements, and you have restricted access 
to these content elements, only registered members will be able to download files. This protection can be further refined 
by using different member groups and different download elements.

![Content element Downloads]({{% asset "images/manual/file-manager/en/downloads_content_element.jpg" %}}?classes=shadow)

**The HTML output**  
 Content element type "Downloads" will generate the following HTML code:

```html
<div class="ce_downloads first block">
    <ul>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Download the file …">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Download the file …">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Download the file …">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Download the file …">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Download the file …">… <span class="size">(… KiB)</span></a>
        </li>
    </ul>
</div>
```

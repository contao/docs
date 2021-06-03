---
title: 'Check downloads'
description: 'With Contao, you can easily restrict access to certain files and define exactly who can and cannot download them.'
aliases:
    - /en/file-manager/control-downloads/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

With Contao, you can easily restrict access to certain files and define permissions for exactly who can and cannot 
download them. This way you can e.g. create a protected download area for members.


## Protect directory {#protect directory}

When you create a new folder in Contao's file manager, it is accessible via HTTP by default including all subfolders.
If you want to protect a folder, make sure that "Public" is not selected when you create the folder. If a directory is 
made public, all the folders and files within it cannot be protected.

![Protect directory](/de/file-manager/images/de/verzeichnis-schuetzen.png?classes=shadow)

If a folder is public, a `web/files/`symlink will be placed in the directory`files`, without this symlink the data would not be accessible for visitors.

![non-public folder](/de/file-manager/images/de/nicht-oeffentlicher-ordner.png?classes=shadow)

If the folder is not public, nobody can access the files with his internet browser and download them directly. However, the files can still be accessed via the content elements "Download" or "Downloads".

## Protect download element {#protect download element}

Next, you will need to restrict access to the download items that will allow you to download the files as before. To do this, either set up a protected page in the site structure or a protected content element that can only be accessed by registered members.

Since downloads are only available through the Download and Downloads content elements, and you have restricted access to these content elements, only registered members will be able to download files. This protection can be further refined by using different member groups and different download elements.

![Content elements Downloads](/de/file-manager/images/de/inhaltselemente-downloads.png?classes=shadow)

**HTML outputThe**  
 content element of element type "Downloads" generates the following HTML code:

```html
<div class="ce_downloads first block">
    <ul>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
    </ul>
</div>
```

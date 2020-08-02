---
title: 'Manage files and folders'
description: 'The file manager maps the directory structure in a hierarchical tree.'
aliases:
    - /en/file-manager/file-manager/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The file manager maps the directory structure in a hierarchical tree. Each subfolder is a separate node, which you ![Minus symbol](/de/icons/folMinus.svg?classes=icon)can expand or collapse using the plus and ![Minus symbol](/de/icons/folMinus.svg?classes=icon)minus symbols. Within each subfolder, the files it contains are listed. If they are images, a preview is automatically displayed. If you have a large number of pictures, you can disable the preview in your user profile to speed up the page loading.

## The navigation icons

Navigation is done like everywhere else in Contao using navigation icons. The options are different for folders and files.

![The file management](/de/file-manager/images/de/der-dateimanager.png?classes=shadow)

**![Edit file or directory](/de/icons/edit.svg?classes=icon) Edit:** Opens an input mask for renaming a file or folder. In addition, metadata of files can be added in the appropriate language or folders can be published or excluded before synchronization.

**![Duplicate file or directory](/de/icons/copy.svg?classes=icon) Duplicate:** Copies a file or folder.

**![Move file or directory](/de/icons/cut.svg?classes=icon) Postpone:** Moves a file or folder.

**![Delete file or directory](/de/icons/delete.svg?classes=icon) Delete a file or folder:** Deletes a file or folder.

**![Show details of the file or folder](/de/icons/show.svg?classes=icon) Information:** Display details of the file or folder.

**![Upload files to the folder](/de/icons/new.svg?classes=icon) Uploading:** Upload files to the folder.

**![Edit file](/de/icons/editor.svg?classes=icon) Edit file:** Opens an input mask for editing the contents of a file with a text editor. Which files may be edited can be defined in the configuration file [`config/config.yml`](../../system/einstellungen/#config-yml) define under the key `editable_files`<sup>1</sup> .

{{% notice note %}}
<sup>1</sup> Up to version 4.6 of Contao, this could be set in the system settings under "Files and images -&gt; Editable files". 
{{% /notice %}}

**![Move file or directory](/de/icons/drag.svg?classes=icon) Postpone:** Move a file or folder using drag and drop.

## Transfer files {#transfer files}

Call up the file manager and click on the link **![Upload files to the server](/de/icons/new.svg?classes=icon) File Upload** to transfer files to the server. Using the navigation icon **![Add to the folder](/de/icons/pasteinto.svg?classes=icon) Insert into** you can select the target directory. Alternatively, you can ![Upload files to the server](/de/icons/new.svg?classes=icon)click on the navigation icon directly at the desired folder.

You can also activate [DropZone](https://www.dropzonejs.com/) in the user settings.

![Transferring files](/de/file-manager/images/de/dateien-uebertragen.png?classes=shadow)

In both cases, the file manager checks the size of the file to be transferred during upload, and - if it is an image - also its dimensions. By default, files up to 2 MB and images up to 3000x3000 pixels are accepted. If a file is too large or an image is too wide or too high, Contao will refuse the upload or automatically resize the image to the maximum allowed dimensions.

Note that only the file types you have specified in the backend settings under "Allowed upload file types" can be uploaded.

## Transfer files via FTP {#transfer files per ftp}

Contao can process files that have been transferred to the server with the file manager as well as files or folders that you have uploaded with an FTP program. To make sure that the resources are stored in the database-supported file system of Contao, you have to click the link **![Synchronize file system and database](/de/icons/sync.svg?classes=icon) Synchronize** click.

However, there is a small restriction when uploading via FTP: The file names should not contain any special characters. Many servers or FTP programs use a different character encoding than Contao internally, so there may be problems when uploading files with special characters in the file name via FTP. Therefore, you should **not** name your files in the following way:

`Wies`n-Festzug München (Sonnenstraße).jpg`

`Hend`l + Maß im Schützenfestzelt.jpg`

For the Web, it is generally better to avoid special characters in file names altogether. This avoids possible compatibility problems as well as unsightly encoded URLs and cryptic file names. The following names are optimal:

`Wiesn-Festzug-Muenchen-Sonnenstrasse.jpg`

`Hendl-und-Mass-im-Schuetzenfestzelt.jpg`

When uploading files via the file manager, Contao checks the file names and adjusts them automatically if necessary to avoid problems with incorrectly encoded special characters in the name.

---
title: "Manage files and folders"
description: "The File Manager maps the directory structure in a hierarchical tree."
aliases:
    - /en/file-manager/file-manager/
weight: 10
---

The File Manager displays the directory structure in a hierarchical tree. Each subfolder is a separate node that you can 
expand and collapse with the ![Plus symbol](/de/icons/folPlus.svg?classes=icon) plus and ![Minus symbol](/de/icons/folMinus.svg?classes=icon) 
minus symbol. Within each subfolder, you will see a list of the files contained there. If they are images, a 
preview thumbnail is automatically displayed.
If you have a large number of images, you can disable the thumbnail preview in your user profile to speed up the page 
loading.

## The navigation icons

Navigation is done similar to everywhere else in Contao using navigation icons. The options are different for folders 
and files.

![The File Manager](/de/file-manager/images/en/the_file_manager.jpg?classes=shadow)

**![Edit file or directory](/de/icons/edit.svg?classes=icon) Edit:** Opens an input mask for renaming a file or folder. You can also add metadata of files in the appropriate language or publish folders or exclude them before synchronization.

**![Duplicate file or directory](/de/icons/copy.svg?classes=icon) Duplicate:** Copies a file or folder.

**![Move file or directory](/de/icons/cut.svg?classes=icon) Move:** Moves a file or folder.

**![Delete file or directory](/de/icons/delete.svg?classes=icon) Delete:** Deletes a file or folder.

**![Show details of the file or folder](/de/icons/show.svg?classes=icon) information:** Show details of the file or folder.

**![Upload files to the folder](/de/icons/new.svg?classes=icon) Upload:** Upload files to the folder.

**![Edit file](/de/icons/editor.svg?classes=icon) Edit file:** Opens a form to edit the contents of a file with a text editor. Which files may be edited can be defined in the configuration file [`config/config.yml`](/en/system/settings/#config-yml) under the key `editable_files`.

**![Move file or directory](/de/icons/drag.svg?classes=icon) Move:** Move a file or folder using drag and drop.

## Transferring files

Go to the File Manager and click the **![Upload files to the server](/de/icons/new.svg?classes=icon) File Upload** 
link to transfer files to the server. Use the navigation icon **![Add to folder](/de/icons/pasteinto.svg?classes=icon) Insert into** 
and select the destination directory. Alternatively, you can click the **![Upload files to the server](/de/icons/new.svg?classes=icon) navigation icon** 
at the desired folder in order to upload there directly.

You can also activate [DropZone](https://www.dropzonejs.com/) in the user settings.

![Transferring files](/de/file-manager/images/en/transfer_files.jpg?classes=shadow)

In both cases, the File Manager checks the size of the file to be transferred during upload, and - if it is an image 
- also its dimensions. By default, files up to 2 MB and images up to 3000x3000 pixels are accepted. If a file is too 
  large or an image is too wide or too tall, Contao automatically refuses the upload or reduces the image to the 
  maximum allowed dimensions.

Note that you can only upload the file types that you have specified in the back end settings under "Allowed upload file types".

If you upload a file to a folder where there is a file with the same name already, the existing file will be updated, keeping the existing UUID. This way
you may update existing files without having to reassign the file in any content element etc. 

## Transferring files via FTP

Contao can process files that have been transferred to the server with the File Manager as well as files or folders 
that you have uploaded with an FTP program. To make sure that the resources are stored in Contao's database-driven 
filesystem, you have to click on the **![Synchronize file system and database](/de/icons/sync.svg?classes=icon) Synchronize** link.

When uploading via FTP, there is a small restriction: The file names should not contain special characters. Many servers or FTP programs use a different character encoding than Contao internally, so there may be problems when uploading files with special characters in the file name. Therefore, you should **not** name your files like this:

`Hav'n Fun in New York (with Piñatas).jpg`

`Mork + Mindy in Spåce.jpg`

For anywhere on the web, it is generally better to avoid using special characters in file names altogether. This avoids 
possible compatibility problems as well as unsightly encoded URLs and cryptic file names. The following names are optimal:

`Havn-fun-in-New-York-with-Pinatas.jpg`

`Mork-and-Mindy-in-Space.jpg`

When uploading files via the File Manager, Contao checks the filenames and adjusts them automatically if necessary to avoid problems with incorrectly encoded special characters in the name.

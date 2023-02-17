---
title: 'File Manager'
description: 'With the File Manager you can manage files and folders on your server and transfer files from your 
local computer to the server.'
aliases:
    - /en/file-manager/
weight: 12
---

With the File Manager you can manage files and folders on your server and transfer files from your local computer to 
the server. By default, user resources are stored in the Contao folder `files`. Contao's database-driven filesystem 
stores file information in the database and references the entries by their 
[UUIDs (Universally Unique Identifier)](https://de.wikipedia.org/wiki/Universally_Unique_Identifier). A UUID is unique 
across systems and looks like this: `bb643d42-0026-ba97-11e3-ccd717221c8a`.


## New folder

You can create a new directory using the "New folder" button. The following options are available:

**Public:** Make the folder and its sub-folders accessible via HTTP.

**Do not synchronize:** Do not synchronize the folder and its subfolders with the database.


### Create nested folders

{{< version-tag "4.13" >}} Nested folders can be created directly by entering e. g. "FolderA/FolderB".

![Create nested folders](/de/file-manager/images/en/folder-name.gif?classes=shadow)

{{% notice note %}}
If you select "Public", only the last folder will be marked as public.
{{% /notice %}}


{{% children %}}

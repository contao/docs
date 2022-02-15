---
title: "Filesystem"
description: Working with files in Contao.
aliases:
    - /framework/filesystem/
---

This section describes the modern way to interact with files and folders in Contao. Please note, the legacy classes
`\Contao\File`, `\Contao\Folder`, `\Contao\FilesModel` and `\Contao\Dbafs` still work, but aren't covered here.   

{{< version "4.13" >}}

{{% notice "warning" %}}
The new filesystem capabilities are currently considered *experimental* and therefore not covered by Contao's BC
promise. Classes marked with `@experimental` should be considered internal for now. Although not likely, there could
also be some behavioral changes, so be prepared.
{{% /notice %}}


## Overview

Our filesystem implementation is an abstraction for the real filesystem based on the popular [Flysystem][Flysystem].
With Flysystem we can interface with different storage adapters behind the scenes: in the simplest form this is your
local filesystem, but it could for instance also be a Dropbox share, an AWS bucket or an FTP remote.

We're composing these storage adapters in a `MountManager` by *mounting* each adapter under a certain path. So, if you
access a file `files/images/cat.jpg`, we might not look at your local filesystem, but deliver the file `cat.jpg` from
your Dropbox adapter which was mounted under `files/images`. Both sides are decoupled, which offers a great flexibility
in configuring the system: The code consuming the image does not need to know about the used adapter and the adapter
does not need to know anything about the filesystem structure it sits in. The idea behind this abstraction is to allow
both extensions as well as the application to reconfigure and outsource the filesystem without the need to change any
code.

In a CMS context, we also want to enrich some of our files with *extra metadata*. Say, author, license, alt and caption
information for images or maybe searchable attributes for your documents. We can store this information in a database
table like `tl_files` but then we need to make sure both sources - database and filesystem - are in sync. This is no
easy task, but we built a *DBAFS* (Database assisted filesystem) service that does exactly that. And because you can now
have more than one DBAFS, there is a `DbafsManager` instance that leverages access to the individual services similar to
the `MountManager`. Each resource stored in the database can also be accessed by a globally unique identifier, a
*UUID*. For that reason, UUIDs are a first level citizen in the `DbafsManager` when accessing resources. 

### Virtual Filesystem

The filesystem is a complex machinery under the hood, but we got you covered. We build the **Virtual Filesystem**, an
abstraction that allows to read and write files without the need to know any internals. See the [Virtual filesystem][VirtualFilesystem]
section for real world examples on how to use the system.

| Component | What is it good for? | Abstraction level |
|-|-|-|
| `VirtualFilesystem` | Your primary gateway to read and write resources from the filesystem, that uses the `MountManager` and `DbafsManager` under the hood. | high
| `MountManager` | Service, that allows to read from and write to a filesystem adapter whose mount path matches the resource's path prefix. Read more about mounting your own adapters in the [Config section](Config). | low  
| `DbafsManager` | Service, that allows to access and modify metadata of a DBAFS that matches the resource's path prefix or UUID. Read more about setting up your own DBAFS service in the [Config section](Config). | low  

{{% notice "info" %}}
In an application, there will typically be **one** `MountManager` and **one** `DbafsManager` but **multiple** virtual
filesystems. Each virtual filesystem instance can be scoped to a certain path and can be set to disallow modifications
(readonly mode). In Contao we're for instance already shipping a `$filesStorage` and a `$backupsStorage` that are scoped
to `/files` and `/backups`.
{{% /notice %}}

[Flysystem]: https://flysystem.thephpleague.com/docs/
[VirtualFilesystem]: /framework/filesystem/virtual-filesystem/
[c]: /framework/filesystem/config/

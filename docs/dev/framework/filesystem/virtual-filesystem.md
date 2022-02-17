---
title: "Virtual filesystem"
description: Extra metadata from the database for your file resources.
aliases:
  - /framework/filesystem/dbafs/
---

{{< version "4.13" >}}

{{% notice "warning" %}}
The new filesystem capabilities are currently considered *experimental* and therefore not covered by Contao's BC
promise. Classes marked with `@experimental` should be considered internal for now. Although not likely, there could
also be some behavioral changes, so be prepared.
{{% /notice %}}


## Names and autowiring

Each virtual filesystem instance has a unique name which is used to generate a [named autowiring alias][NamedAliases].
If you want to work with the `documents` filesystem, you would inject a variable named `$documentsStorage` (note the
suffix 'Storage'):

```php
class Example {
    public function __construct(private VirtualFilesystemInterface $documentsStorage) {}
}
```

{{% notice "tip" %}}
If you cannot use autowiring, you would explicitly inject the `contao.filesystem.virtual.documents` service instead.
{{% /notice %}}


## Working with files and directories

### Example

Let's build a simple content element that displays the contents of a single directory in the filesystem. Our goal is to
list *files only* and show their *path*, *file size* and - if set in the back end file manager - metadata *title*.

For this example we're using the virtual filesystem named `files` that is already configured by default in Contao. If
you want to play along, this will be a good starting point: 

{{< tabs groupId="service-config">}}
{{% tab name="Annotation" %}}
```php
<?php
// src/App/Controller/FilesListController.php
namespace App\Controller;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\File\Metadata;
use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement(category="files")
 */
class FilesListController extends AbstractContentElementController
{
    private VirtualFilesystemInterface $filesStorage;
    
    // We inject the 'files' virtual filesystem instance, that is scoped to the
    // 'files' directory.
    public function __construct(VirtualFilesystemInterface $filesStorage) 
    {
        $this->filesStorage = $filesStorage; 
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $template->elements = $this->describeDirectory('images');

        return $template->getResponse();
    }

    /** 
     * @return array<string> 
     */
    private function describeDirectory(string $directory): array {
        // Check if the directory exists
        if(!$this->filesStorage->directoryExists($directory)) {
            return [];
        }

        $files = [];

        // Read the contents of the directory. As we're only interested in
        // files, we add the "->files()" filter.
        foreach($this->filesStorage->listContents($directory)->files() as $item) {
            // The full path and filesize in kB
            $name = $item->getPath();
            $size = $item->getFileSize() / 1000;

            // Read the "extra metadata" - let's use the title as the
            // name instead if one one was defined in the metadata array.
            $fileMetadata = $item->getExtraMetadata()['metadata']['en'] ?? null;

            if($fileMetadata instanceof Metadata && ($title = $fileMetadata->getTitle()) !== '') {
                $name = "'$title' ($name)";
            }

            $files[] = "$name has a size of {$size}kB.";
        }

        return $files;
    }
}
```
{{% /tab %}}
{{% tab name="Attribute" %}}
```php
<?php
// src/App/Controller/FilesListController.php
namespace App\Controller;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\File\Metadata;
use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'files')]
class FilesListController extends AbstractContentElementController
{
    // We inject the 'files' virtual filesystem instance, that is scoped to the
    // 'files' directory.
    public function __construct(private VirtualFilesystemInterface $filesStorage) {}

    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $template->elements = $this->describeDirectory('images');

        return $template->getResponse();
    }

    /** 
     * @return array<string> 
     */
    private function describeDirectory(string $directory): array {
        // Check if the directory exists
        if(!$this->filesStorage->directoryExists($directory)) {
            return [];
        }

        $files = [];

        // Read the contents of the directory. As we're only interested in
        // files, we add the "->files()" filter.
        foreach($this->filesStorage->listContents($directory)->files() as $item) {
            // The full path and filesize in kB
            $name = $item->getPath();
            $size = $item->getFileSize() / 1000;

            // Read the "extra metadata" - let's use the title as the
            // name instead if one one was defined in the metadata array.
            $fileMetadata = $item->getExtraMetadata()['metadata']['en'] ?? null;

            if($fileMetadata instanceof Metadata && ($title = $fileMetadata->getTitle()) !== '') {
                $name = "'$title' ($name)";
            }

            $files[] = "$name has a size of {$size}kB.";
        }

        return $files;
    }
}
```
{{% /tab %}}
{{< /tabs >}}

```twig
{# templates/ce_files_list.html.twig #}

<ul>
  {% for element in elements %}<li>{{ element }}</li>
</ul>
```

We then add our newly created content element in an article, add some images to the `files/images` directory and finally
define a title for one of the images in the back end file manager. If we now open the frontend, we should get an output
like so:

<ul style="background-color: #eee; padding: 1em 2.5em;">
  <li>images/bear.jpg has a size of 476.673kB.</li>
  <li>'The Cat on a sofa' (images/sofa-cat.jpg) has a size of 750.382kB.</li>
  <li>images/zebra.jpg has a size of 188.732kB.</li>
</ul>

#### What happened behind the scenes?

Quite a lot, let's have a closer look:

1) ```php
    public function __construct(private VirtualFilesystemInterface $filesStorage) {}
    ```
    The container injects an instance of `VirtualFilesystemInterface $filesStorage` into the constructor of our class by
    resolving the [named autowiring alias][NamedAliases] to the `files` virtual filesystem instance. This instance was 
    configured in the [extension class of the core-bundle][CoreBundleExtension]. The scope for this instance is set to
    the `files` directory: this marks the "root" of our filesystem, that all paths have to be relative to. 

2) ```php
    $this->filesStorage->directoryExists($directory)
    ```
    Internally, the call to `directoryExists()` leads to a subsequent call to `DbafsManager#directoryExists()`. In there
    a DBAFS implementation is found that can answer the request (namely, the `contao.filesystem.dbafs.files` DBAFS).
    This service then looks in the database (or the internal cache) and confirms: Yes, the directory exists.

3) ```php
    $this->filesStorage->listContents($directory)->files()
    ```
    We're then listing the contents of the given directory. Similarly to before, it's the `DbafsManager` that is queried
    first and that, again, can answer the request. The virtual filesystem returns a special object of type
    `FilesystemItemIterator` which behaves like a `\Generator` but has extra features.

    One, being, that you can apply filters inline. In fact we're using this here with the call to `->files()`, which
    returns another `FilesystemItemIterator` instance that only yields file items (so no directories).

4) ```php
    $name = $item->getPath();
    $size = $item->getFileSize() / 1000;
    ``` 
    The items, that are yielded by our generator are of the type `FilesystemItem`. This class is a container for file
    properties including the last modified date, file size, mime type and additional metadata from the DBAFS.

    But wait, you might ask: How can we read the file size here? That's something the DBAFS doesn't know and wasn't it
    the DBAFS answering our request? You're right, but the `FilesystemItem` has a trick up its sleeve: When the virtual
    filesystem builds the element, all properties that aren't known at that point, are defined via a closure that gets
    only evaluated on demand and that then loads them.

    So when calling `$item->getFileSize()`, now the `MountManager` gets asked the first time, finds the right adapter
    (the local adapter mounted to `files` in this case), reads the data from disk and returns it. Here you can see the
    beauty of the promise based abstraction: Until this very call, we didn't have to issue a single filesystem operation 
    but we could still use everything as if it was already there. To improve things even more, we could move the logic
    to the template, so that it will only ever get executed if really needed.

    By the way, if for some reason you want to skip the DBAFS and force reading from the `MountManager` in the first
    place, you can also do this: Read more about the [access flags](#access-flags) further down.

6) ```php
    $item->getExtraMetadata();
    ``` 
   Finally, we're reading the DBAFS metadata. Our `Dbafs` service did read the raw data from the matching record in the
   database and then issued a `RetrieveDbafsMetadataEvent`. The core bundle's `DbafsMetadataSubscriber` listening to
   this event, then enhanced the data by replacing the raw arrays with objects for the `ImportantPart` and
   `File\Metadata`. Nice!
 
   A typical set of "extra metadata" could look like the following (though you should always check before use):
   ```txt
    Array (
        [importantPart] => Contao\Image\ImportantPart Object (…)
        [metadata] => Array (
            [en] => Contao\CoreBundle\File\Metadata Object(…)
        )
    )
   ```

### UUIDs

UUIDs are a concept we're using in our DBAFS storages to uniquely identify a file independent of current path and
storage. In the virtual filesystem, UUIDs are a first class citizen as well. Every method allows to either pass in a 
path as a string or a UUID as a `Symfony\Component\Uid\Uuid`. Behind the scenes, we're using the `DbafsManager` to
resolve these to paths again.

If you do not have a `Uuid` object yet, you can construct it on the fly:

```php
use Symfony\Component\Uid\Uuid;

// by path
$fooStorage->read('my/file.txt');

// by UUID
$fooStorage->read(new Uuid('94cc007c-8cc0-11ec-a8a3-0242ac120002'));
```


## Operation reference

#### Tests ####

|  |  |
|-|-|
| `fileExists` | Check if the given UUID or path points to an existing file. |
| `directoryExists` | Check if the given UUID or path points to an existing directory<sup>*)</sup>. |
| `has` | Check if the given UUID or path points to any existing resource. |

The test operations allow passing in optional `$accessFlags` to bypass the DBAFS and/or force a sync. Refer to the
[access flags](#access-flags) section for more details. 

{{% notice tip %}}
<sup>*)</sup> The ability to test directories was only reintroduced in Flysystem (`league/flysystem`) v3 which was
shortly released after v2. Although, we're using a workaround in our abstraction layer, we strongly suggest to install
v3 if possible for better performance. If you're using at least PHP 8.0, this should already gotten installed by
default.
{{% /notice %}}

#### Reading, writing and deleting resources #### 

|  |  |
|-|-|
| `read` | Read the file contents from a resource found at the given path or UUID. |
| `readStream` | Stream the file contents from a resource found at a path or UUID. |
| `write` | Write content into a resource found at the given path or UUID. |
| `writeStream` | Write a stream into a resource found at the given path or UUID. |
| `delete` | Delete the file found at the given path or UUID. |
| `deleteDirectory` | Delete the directory found at the given path or UUID. |

#### Creating and moving resources ####

|  |  |
|-|-|
| `createDirectory` | Create a new directory at the given path. |
| `copy` | Create a copy a resource found at the given path or UUID at another path. |
| `move` | Move a resource found at the given path or UUID to another path. |

All of the operations above allow to pass in an array of `$options`, that will be passed on to the underlying adapter.
This is for specialised use cases only and typically only works in applications where you can be sure that nobody will
mount another adapter not supporting these options later on.

#### Listing content

|  |  |
|-|-|
| `listContents` | Lists the contents of a directory found at the given path or UUID by returning a generator of `FilesystemItems`. When setting `$deep` to true, resources in subdirectories will also get listed (disabled by default). |

The list operation allows passing in optional `$accessFlags` to bypass the DBAFS and/or force a sync. Refer to the
[access flags](#access-flags) section for more details.

#### Getting metadata

|  |  |
|-|-|
| `getLastModified` | Get the last modified timestamp (`int`) of a file found at the given path or UUID. |
| `getFileSize` | Get the file size in bytes (`int`) of a file found at the given path or UUID. |
| `getMimeType` | Get the mime type (`string`) of a file found at the given path or UUID. |
| `getExtraMetadata` | Get an array of additional metadata of a file found at the given path or UUID. |

The metadata operations allow passing in optional `$accessFlags` to bypass the DBAFS and/or force a sync. Refer to the
[access flags](#access-flags) section for more details.

#### Setting DBAFS metadata

|  |  |
|-|-|
| `setExtraMetadata` | Set an array of metadata to a file found at the given path or UUID. The data should be set in the denormalized form (e.g. objects instead of raw array data) like it is retrieved when using `getExtraMetadata()`. It will be normalized by listeners of the `StoreDbafsMetadataEvent` when storing. |


{{% notice info %}}
All filesystem operations will throw a `VirtualFilesystemException` if the filesystem operation failed for any reason
(see message for more details). All operations except for those listed under "Tests" will also throw an
`UnableToResolveUuidException` in case a non-resolvable UUID was provided.
{{% /notice %}}


### Access Flags

Operations allowing to pass in `$accessFlags` can be advised to deviate from the default behavior, which is to prefer
the DBAFS over filesystem access wherever possible:

|  |  |
|-|-|
| `VirtualFilesystemInterface::BYPASS_DBAFS` | Bypasses the DBAFS and directly reads from the filesystem (or rather the `MountManager`, that then finds the matching adapter). |
| `VirtualFilesystemInterface::FORCE_SYNC` | Forces the DBAFS to be synchronized. If the DBAFS supports partial synchronization - which our default implementation does - only the affected file or directory will get synchronized. |

Flags can be combined by using the *bitwise OR*: `VirtualFilesystemInterface::FORCE_SYNC|VirtualFilesystemInterface::BYPASS_DBAFS`. 


[NamedAliases]: https://symfony.com/doc/current/service_container/autowiring.html#dealing-with-multiple-implementations-of-the-same-type
[CoreBundleExtension]: https://github.com/contao/contao/blob/4.13/core-bundle/src/DependencyInjection/ContaoCoreExtension.php#L207
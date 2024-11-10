---
title: Purge Task
description: "Implementing a custom purge action for the respective maintenance section in the back end."
---


Contao has a special [maintenance module](/framework/maintenance-module/) with which you can execute various "purging"
tasks. By default it contains tasks like purging the search index tables, clearing the asset caches, purging the shared
HTTP cache etc.

This article documents how to extend this maintenance module with your own purge actions.

Purging tasks are divided into 3 categories:

* `tables` - for purging database tables.
* `folders` - for purging the contents of filesystem folders.
* `custom` - for anything else (e.g. clearing the HTTP cache, or recreating symlinks).

Registration of purge task are done via the `$GLOBALS['TL_PURGE']` table. Each task needs to have a `callback` that
defines the class and method that runs the purge task. The `tables` and `folders` purge tasks also need to define their
`affected` tables and folders with that registration.

The registered callback can be a service. However, that service needs to be public.


## Purging Tables

If you crated your own database tables (via a DCA or Doctrine entities) that need to be able to be purged by back end
administrators, you can register a purge task for that in the following way:

```php
// contao/config/config.php
use App\Maintenance\PurgeFoobarTable;

$GLOBALS['TL_PURGE']['tables']['foobar'] = [
    'callback' => [PurgeFoobarTable::class, '__invoke'],
    'affected' => ['tl_foobar'],
];
```

```php
// src/Maintenance/PurgeFoobarTable.php
namespace App\Maintenance;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PurgeFoobarTable
{
    public function __construct(private readonly Connection $db)
    {
    }

    public function __invoke(): void
    {
        $this->db->executeQuery('TRUNCATE tl_foobar');
    }
}
```

The `callback` key references the class and method to be run while the `affected` key references the database tables
that will be affected by this purge task. This will also make the purge maintenance module show the current amount of
records within that table.

You will also need translation labels:

```yaml
// translations/contao_tl_maintenance.en.yaml
tl_maintenance_jobs:
    foobar:
        - Purge foobar
        - Truncates the <code>tl_foobar</code> table.
```

This will then show the following for the purge module:

![Custom table purge]({{% asset "images/dev/framework/custom-table-purge.png" %}}?classes=shadow)


## Purging Folders

If your application writes some files into specific directories which back end administrators need to be able to purge,
you can register a purge task for that in the following way:

```php
// contao/config/config.php
use App\Maintenance\PurgeFoobarFolder;

$GLOBALS['TL_PURGE']['folders']['foobar'] = [
    'callback' => [PurgeFoobarFolder::class, '__invoke'],
    'affected' => ['%kernel.cache_dir%/foobar'],
];
```

```php
// src/Maintenance/PurgeFoobarFolder.php
namespace App\Maintenance;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PurgeFoobarFolder
{
    public function __construct(
        private readonly Filesystem $filesystem,
        #[Autowire('%kernel.cache_dir%')]
        private readonly string $cacheDir,
    ) {
    }

    public function __invoke(): void
    {
        $files = (new Finder())
            ->in(Path::join($this->cacheDir, 'foobar'))
            ->files()
        ;

        $this->filesystem->remove($files);
    }
}
```

The `callback` key references the class and method to be run while the `affected` key references the folders that will
be affected by this purge task. This will also make the purge maintenance module show the current amount of files within
those folders.

You will also need translation labels:

```yaml
// translations/contao_tl_maintenance.en.yaml
tl_maintenance_jobs:
    foobar:
        - Purge foobar
        - Deletes the foobar entries.
```

This will then show the following for the purge module:

![Custom folder purge]({{% asset "images/dev/framework/custom-folder-purge.png" %}}?classes=shadow)


## Custom Action

Other purge tasks that do not fall into the `tables` or `folders` category can be put into the `custom` category, where
you only have to define the `callback`:

```php
// contao/config/config.php
use App\Maintenance\PurgeFoobarCustom;

$GLOBALS['TL_PURGE']['custom']['foobar'] = [
    'callback' => [PurgeFoobarCustom::class, '__invoke'],
];
```

```php
// src/Maintenance/PurgeFoobarCustom.php
namespace App\Maintenance;

use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PurgeFoobarCustom
{
    public function __invoke(): void
    {
        // Execute your custom purgin task here
    }
}
```

You will also need translation labels:

```yaml
// translations/contao_tl_maintenance.en.yaml
tl_maintenance_jobs:
    foobar:
        - Purge foobar
        - Executes a custom purging task.
```

This will then show the following for the purge module:

![Custom purge task]({{% asset "images/dev/framework/custom-purge-task.png" %}}?classes=shadow)

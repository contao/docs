---
title: "Commands"
---

Contao uses the Console component of Symfony and provides a few commands.

`contao:automator` - This command is an interface to the `Automator` class
of Contao, which provides a user with common tasks around the maintenance
of a Contao installation.

```
$> php bin/console contao:automator [<task>]
```

The command itself can be executed without providing a task. It will then
ask for it.

The following tasks are available.

| Task                    | Description                                                                                                                       |
|-------------------------|-----------------------------------------------------------------------------------------------------------------------------------|
| `purgeSearchTables`     | Cleans the search index by deleting the tables `tl_search` and `tl_search_index`.                                                 |
| `purgeUndoTable`        | Removes the temporarily stored undo entries, which allows for restoring deleted entries.                                          |
| `purgeVersionTable`     | Purges the version table `tl_version` which holds different versions for rows in tables that have the versioning feature enabled. |
| `purgeSystemLog`        | Deletes entries in the system log.                                                                                                |
| `purgeImageCache`       | Purges the image cache by deleting all processed and resized images in the configurable `image.target_dir`.                       |
| `purgeScriptCache`      | Removes processed and/or minified JavaScript files and Stylesheets.                                                               |
| `purgePageCache`        | Cleans the page cache by removing cached html responses.                                                                          |
| `purgeSearchCache`      | Cleans the search result cache.                                                                                                   |
| `purgeInternalCache`    | |
| `purgeTempFolder`       | Purges the complete temporary folder.                                                                                             |
| `purgeRegistrations`    | |
| `purgeOptInTokens`      | |
| `purgeXmlFiles`         | |
| `generateSitemap`       | |
| `generateXmlFiles`      | |
| `generateSymlinks`      | |
| `generateInternalCache` | |
| `rotateLogs`            | |


## Automator

## File synchronisation

## Contao Install

## Lock and Unlock an installation

## Generate symlinks

## Change a user password

To manually change a user password in the shell, use the `contao:user:passowrd`
command. It prompts for the password.

```sh
> php bin/console contao:user:password admin
```


      contao:automator              
      contao:filesync               
      contao:install                
      contao:install:lock           
      contao:install:unlock         
      contao:symlinks               
      contao:user:password          
      contao:version

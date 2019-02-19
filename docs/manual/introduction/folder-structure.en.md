---
title: "Folder structure"
weight: 1
---

Below, a representation of the folder structure of Contao and some files
 commonly used.
 
 ```bash
 ├── app
 │   └── config
 ├── assets
 ├── files
 ├── system
 │   ├── config
 │   │   └── localconfig.php
 │   └── modules
 ├── templates
 ├── var
 │   ├── cache
 │   └── logs
 ├── vendor
 └── web
     ├── assets (symbolic link)
     ├── bundles
     ├── share
     ├── system
     ├── app_dev.php
     ├── app.php
     ├── robots.txt
     └── .htaccess (hidden file)
 ```
 
 
### app/
 
This is the application folder which includes Symfony configuration files.
 
 
### assets/
 
`assets/` contains components such as jQuery or TinyMCE. Contao CSS and JS
source files are also located in this folder as well as the combined and
minified CSS and JS files and resized images. It is available from the `web/`
folder through a [symbolic link][1].
 
 
### files/
 
`files/` contains public files such as images, CSS, JavaScript, etc. It is
available from the `web/` folder through a [symbolic link][1].
 
 
### system/
 
`system/` contains Contao configuration files, the back end theme(s) and
[Contao modules][2].
 
 
### templates/
 
`templates/` contains customized templates.
 
 
### vendor/
 
This is the location of external libraries as well as the source code of Contao
and Symfony. This folder also includes Contao's [bundles][3] such as the
newsletter, the core, the news, etc. and bundles developed by the community.
 
 
### web/
 
This is the web root folder that contains public files, the
[front controllers][4] and the access to the Contao install tool.
 
`app.php` and `app_dev.php` are the front controllers. `app.php` is used in a
production environment and all the pages requested by visitors go through this
single entry point. `app_dev.php` has the same goal as `app.php` but for a
development environment. This mode displays a toolbar with some debugging
options.
 
`share/` contains shared files such as XML files (e.g. sitemaps or RSS feeds).
 
{{% notice info %}}
For security purpose, the `web/` folder should be the only one to be
accessible by visitors.
{{% /notice %}}
 
 
### Symbolic link

Public files (CSS, JavaScript, images, etc.) are only available from the `web/`
folder. If some folders must be publicly available and are located outside the
`web/` folder, the system generates [symbolic links][5] (also written symlink)
for each of them. For example, the `web/assets` folder is a reference that
targets the original folder `assets` placed at the same level as the `web/`
folder.

Public files of each bundle are located in the `web/bundles` folder through
symlinks. These can be regenerated from the back end under maintenance.
 
 
### Contao modules
 
Existing extensions developed for Contao 3.5 and lower can be used with Contao
4 if they fulfill the compatibility requirements. You can see if an extension is
compatible by checking its `composer.json` file in the section `require` (e.g.
`contao/core-bundle":"~3.2 || ~4.1`).
 
 
 [1]: #symbolic-link
 [2]: #contao-modules
 [3]: http://symfony.com/doc/current/glossary.html#term-bundle
 [4]: https://en.wikipedia.org/wiki/Front_Controller_pattern
 [5]: https://en.wikipedia.org/wiki/Symbolic_link

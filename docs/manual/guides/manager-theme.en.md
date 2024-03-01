---
title: "Create an installable theme"
description: "Create an installable theme for the Contao Manager."
aliases:
  - /en/guides/manager-theme/
weight: 100
tags: 
  - "Theme"
---


When installing via the [Contao Manager](/en/installation/contao-manager/), you can optionally specify an available theme.
We will show you here how to create this theme. This is not only interesting for theme providers. You can 
basically create your own page structure, including extensions and layout, and use it during the Manager [Installation](/en/installation/install-contao/). 

![Contao per Contao Manager installieren]({{% asset "images/manual/guides/en/manager-theme-en.png" %}}?classes=shadow)


## Theme Manager

You can use the "[Theme Manager](/en/layout/theme-manager/)" in the backend to [export and import](/en/layout/theme-manager/manage-themes/) 
existing themes as a `.cto` file. However, this exported `.cto` is not suitable for use in the Contao Manager! It requires further information.


## Theme Structure for the Manager

In addition to the actual "`assets`", a theme for the Contao Manager requires a "`theme.xml`" file, the respective "`composer.json`" and a
"`SQL dump`". This data can be summarized as a "`.zip`" archive and then be used in the Contao Manager. As an orientation of the structure 
the "`.zip`" [archive](https://github.com/contao/contao-demo/tags) of the "Contao Demo" is helpful.

```bash
>files
>templates
>var/backups
composer.json
theme.xml
```

Each file and directory within the archive is imported into the Contao root directory (except for "theme.xml"). Therefore, you could also add your 
"config/config.yml" with further settings, such as "[legacy_routing: false](/en/site-structure/website-root/#legacy-routing-mode)". You 
can find another example in the [Isotope eCommerce Demo](https://github.com/isotope/isotope-demo).


### Assets and the "theme.xml"

You can obtain this data from your existing installation via the "[Theme Manager](/en/layout/theme-manager/)" in the back end. The exported
"`.cto`" file is actually a "`.zip`" archive. You can therefore rename the file accordingly and then unzip it. Afterwards
you will find the directories "files", "templates" and the file "theme.xml".


### SQL-Dump

You must create the current SQL-Dump of your theme installation via the [backup command](/en/cli/database-backups/) on the console or 
via the [Contao Manager](/en/installation/contao-manager/) (see `Maintenance - Database Migrations and Backups`). A normal PHPMyAdmin export, 
for example, would not be sufficient. Then copy the "var/backups" directory with your current SQL-Dump into the unzipped directory above. 
Only one SQL-Dump may exist in this directory. 

The SQL-Dump is always optional. Without this, only the files are installed.


```bash
php vendor/bin/contao-console contao:backup:create
```

{{% notice tip %}}
You can also use the [configuration options](/en/cli/db-backups/#configuration) to exclude various database tables such as "tl_log". 
{{% /notice %}}


### The "composer.json"

Finally, copy the current "composer.json" of your theme installation into the unpacked directory. If you wish,
you could add optional information to it (see also: [Contao Demo](https://github.com/contao/contao-demo/blob/5.3.x/composer.json)).

The label `"type": "contao-theme"` is mandatory and necessary for the Contao Manager.


## Your Theme

Your theme directory now contains all the necessary information. You can now archive this as a "`.zip`" file and 
use it for a new installation via the Contao Manager. Please make sure that the directory is not compressed, but only the files.

{{% notice note %}}
You can easily add other files such as a "README.md" or license details.
{{% /notice %}}

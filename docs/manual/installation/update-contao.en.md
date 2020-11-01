---
title: 'Update Contao'
description: 'Like most Open Source projects, Contao is continuously being developed.'
aliases:
    - /en/installation/update-contao/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Like most Open Source projects, Contao is under continuous development. With each update, components are updated, bugs are fixed, new features are added or performance is improved. It is therefore recommended to always use the latest version.


### The Contao update cycle

Contao follows the concept of [Semantic Versioning](https://semver.org) for the version numbers, which sounds a bit technical so we will quickly get familiar with the terminology used:


#### Major release

A major release is a completely new version of the software where many basic things have been changed and existing pages may not work anymore. The current major release of Contao is **version 4** when writing these lines.


#### minor release

A minor release is a kind of milestone on the development path where new features have been added. Minor changes to existing pages might therefore be necessary. When writing these lines, the current minor version of Contao is **version 4.8**.


#### Bugfix release

A bugfix release is a maintenance release whose primary purpose is to fix bugs; the current bugfix version of Contao when writing these lines is **version 4.8.4**.


#### Long-Term Support Versions

With version 2.11, the [release cycle of Contao](https://contao.org/de/release-plan.html) has been adjusted and Long-Term Support (LTS) versions have been introduced that are supported and updated for 24 months, even if newer Contao versions have been released in the meantime. An overview of all Contao versions is available on Wikipedia.


### Updating with the Contao Manager {#update-via-the-contao-manager}

{{% notice note %}}
 Before updating Contao, it is recommended to create a backup of the `composer.json`, `composer.lock`and the database. 
{{% /notice %}}

Log on to Contao Manager and start it.

If you are updating for a [bugfix release](#bugfix-release), just click on "Update packages".

Special feature when updating for a [minor release](#minor-release): Click on the cogwheel icon at "Contao Open Source CMS" and enter the desired version. Click the "Update packages" button and then "Apply changes" to push the update.

![Start update for minor release](/de/installation/images/de/aktualisierung-fuer-minor-release-starten.png?classes=shadow)

The update can now take several minutes. Details of the update process can be displayed by clicking the following icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Update for minor release completed](/de/installation/images/de/aktualisierung-fuer-minor-release-abgeschlossen.png?classes=shadow)


#### Update database tables

Open the [Contao install tool](../contao-installtool/) and check if any changes to your database are necessary after the update. If necessary, make the suggested changes and then close the install tool.

Your Contao installation is now up to date.


### Updating from the command line {#update-via-the-command-line}

{{% notice note %}}
 Before updating Contao, I recommend that you make a backup of the `composer.json`database `composer.lock`and the database creation. 
{{% /notice %}}

When updating via the command line, a `composer update`is executed. This will cause some hosters to fail to complete the process due to excessive system load, and the installation will fail. In this case you should use the [Contao Manager](##aktualisierung-mit-dem-contao-manager).

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

On the console, change to the directory of your Contao installation that you want to update.

```bash
cd www/example/
```

When updating for a [bugfix release](#bugfix-release), it is sufficient to issue the following command.

```bash
php composer.phar update
```

If you are updating for a [minor release](#minor-release), you need to install the version of the program that is listed in `contao/manager-bundle`the`composer.json`

```json
{
    …
    "require": {
        "contao/manager-bundle": "4.8.*",
        …
    },
    …
}
```

Now trigger the update on the command line.

```bash
php composer.phar update
```

#### Update database tables

Open the [Contao install tool](../contao-installtool/) and check if any changes to your database are necessary after the update. If necessary, make the suggested changes and then close the install tool.

Instead of using the Contao install tool, you can (since Contao 4.9) use the command

```bash
$ vendor/bin/contao-console contao:migrate
```

use.

Your Contao installation is now up to date.


### Local update without the Composer Resolver Cloud

The procedures described above in [Updating from the command line](#update-via-the-command-line) 
and [Update with Contao Manager](#update-via-the-contao-manager), you can
can also be carried out locally. This has the advantage that, unlike the environment at a hoster, you have no problems with 
unfulfilled system requirements, such as insufficient memory, because you can adjust the configuration yourself as required.


{{% notice tip %}}
The procedure is not limited to updating. You can also use it for a new Contao installation.
{{% /notice %}}


#### Requirements when using the command line

What do you need on your computer?

- Any directory you work in (your working directory)
- PHP, ideally in the same version as used on your hosting
- Composer (we assume here that you install Composer in your working directory)
- Copies of the `composer.json` and `composer.lock` of the Contao installation at your hoster

What do you _not_ need?

- MySQL
- A local Contao installation


#### Performing the update

Copy the `composer.json` and `composer.lock` from your hosting to your working directory.
You then do essentially the same as described above in [Updating from the command line](#update-via-the-command-line):
 
Open a terminal and change to the working directory. Lead there

```bash
php composer.phar update
```

out. After the update has been successfully completed, copy the updated `composer.lock`.
(and the `composer.json` if you made changes there) back to the Contao installation on your hosting. 

After that you either log in via `ssh` on your server (hosting)

```bash
ssh benutzername@example.com
```

and lets Composer install the updated packages

```bash
php composer.phar install
```

or you use the Contao Manager. There, under "System maintenance", select the item »Composer dependencies«, »Installer 
execute«.

![Paketinstallation mit dem Contao-Manager](/de/installation/images/de/composer-install-mit-dem-contao-manager.png?classes=shadow)

Finally you have to update the database tables. 


#### Update database tables

Open the [Contao-Installtool](/en/installation/contao-installtool/) and check if any changes have been made to your 
database are necessary. If necessary, make the suggested changes and then close the install tool.

Instead of the Contao install tool, you can (from Contao 4.9 on) use the Command line the command 

```bash
$ vendor/bin/contao-console contao:migrate
``` 

Your Contao installation is now up to date.


#### Different PHP versions

If the PHP version used locally is different from the one you have hosted, you need to change the `composer.json` file 
to a different one. Specify which PHP version should be used:

```json 
    ...
    "config": {
        "platform": {
            "php": "7.4.99"
        }
    },
    "require": {
        ...
    }
    ...
```


#### Local updates with the Contao Manager

You need a local Contao installation. In this installation, you install the Contao Manager and run the update like
described in the section [Updating with the Contao Manager](#update-via-the-contao-manager). 

Make sure that the Composer Resolver Cloud is not used. You do not need it, because you are on 
can provide your own server with enough memory and thus relieve the cloud.

You can find the setting in the »System check« in the »Server configuration« section.

![Deactivation of the Composer Resolver Cloud](/de/installation/images/de/cloud_resolver_abschalten.png?classes=shadow)

After the successful update you transfer the `composer.json` and `composer.lock` back to the Contao installation on 
your hosting. The next steps on your hosting are the same as described above.

---
title: 'Update Contao'
description: 'Like most Open Source projects, Contao is continuously being developed.'
aliases:
    - /en/installation/update-contao/
weight: 40
---


Like most Open Source projects, Contao is under continuous development. With each update, components are updated, 
bugs are fixed, new features are added or performance is improved. It is therefore recommended to always use the latest 
version.


### The Contao update cycle

Contao follows the concept of [Semantic Versioning](https://semver.org) for the version numbers, which sounds a bit 
technical so we will quickly get familiar with the terminology used:


#### Major release

A major release is a completely new version of the software where many basic things have been changed and existing pages 
may not work anymore. The current major release of Contao is **version 4** when writing these lines.


#### Minor release

A minor release is a kind of milestone on the development path where new features have been added. Minor changes to 
existing pages might therefore be necessary. When writing these lines, the current minor version of Contao 
is **version 4.10**.


#### Bugfix release

A bugfix release is a maintenance release whose primary purpose is to fix bugs; the current bugfix version of Contao 
when writing these lines is **version 4.10.4**.


#### Long-Term Support Versions

With version 2.11, the [release cycle of Contao](https://contao.org/de/release-plan.html) has been adjusted and 
Long-Term Support (LTS) versions have been introduced that are supported and updated for 24 months, even if newer Contao 
versions have been released in the meantime. An overview of all Contao versions is available on Wikipedia.


### Updating with the Contao Manager

{{% notice note %}}
 Before updating Contao, it is recommended to create a backup of the `composer.json`, `composer.lock` files and the 
 database. 
{{% /notice %}}

Log on to Contao Manager and start it.

If you are updating for a [bugfix release](#bugfix-release), just click on "update packages".

Special feature when updating for a [minor release](#minor-release): Click on the cogwheel icon at 
"Contao Open Source CMS" and enter the desired version. Click the "Update packages" button and then "Apply changes" to 
push the update.

![Start update for minor release](/de/installation/images/de/aktualisierung-fuer-minor-release-starten.png?classes=shadow)

The update can now take several minutes. Details of the update process can be displayed by clicking the following 
icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Update for minor release completed](/de/installation/images/de/aktualisierung-fuer-minor-release-abgeschlossen.png?classes=shadow)


#### Update database tables

Open the [Contao install tool](../contao-installtool/) and check if any changes to your database are necessary after 
the update. If necessary, make the suggested changes and then close the install tool.

Your Contao installation is now up to date.

### Updating via the command line {#update-via-the-command-line}

{{% notice note %}}
 To update Contao via the command line you need to have Composer [installed](../install-contao/#install-composer). 
 {{% /notice %}}

{{% notice note %}}
 Before updating Contao, I recommend that you make a backup of the `composer.json` and `composer.lock` files and the 
 database. 
{{% /notice %}}

When updating via the command line, a `composer update` is executed. This will fail to complete on some hosters due to 
excessive system load, and thus the installation will fail. In this case you should use the 
[Contao Manager](#updating-with-the-contao-manager).

You have logged on to your server with your user name and domain.

```bash
$ ssh benutzername@example.com
```

On the console, change to the directory of your Contao installation that you want to update.

```bash
$ cd www/example/
```

When updating for a [bugfix release](#bugfix-release), it is sufficient to issue the following command.

```bash
$ composer update
```

If you are updating for a [minor release](#minor-release), you need to specify the desired version of the 
`contao/manager-bundle` in the `composer.json` file

```json
{
    …
    "require": {
        "contao/manager-bundle": "4.10.*",
        …
    },
    …
}
```

Now trigger the update on the command line.

```bash
$ composer update
```

#### Update database tables

Open the [Contao install tool](../contao-installtool/) and check if any changes to your database are necessary after 
the update. If necessary, make the suggested changes and then close the install tool.

Instead of using the Contao install tool, (with Contao 4.9 or later) you can use the command

```bash
$ vendor/bin/contao-console contao:migrate
```

Your Contao installation is now up to date.


### Update locally without the Composer Resolver Cloud

The procedures described above in [Updating via the command line](#update-via-the-command-line) 
and [Update with the Contao Manager](#updating-with-the-contao-manager), can also be used locally. 
This has the advantage that, unlike the environment at your hosting, you have no problems with 
unfulfilled system requirements such as insufficient memory, because you can set the corresponding 
configuration as required yourself.


#### Requirements for using the command line

What do you need on your computer?

- any directory you work in (your working directory)
- PHP, ideally in the same version as used on your hosting
- Composer (we assume here that you [install](../install-contao/#install-composer) Composer globally)
- copies of the `composer.json` and `composer.lock` of the Contao installation at your hoster

What do you _not_ need?

- MySQL
- A local Contao installation


#### Perform the update

Copy the `composer.json` and `composer.lock` from your hosting to your working directory.
You then do essentially the same as described above in
[Updating via the command line](#update-via-the-command-line):
 
Open a terminal and change to the working directory. There run

```bash
$ composer update
```

After the update has been successfully completed, copy the updated `composer.lock`.
(and the `composer.json` if you made changes there) back to the Contao installation 
on your hosting. 

After that you either log in via `ssh` onto your server (hosting)

```bash
$ ssh username@example.com
```

and let Composer install the updated packages

```bash
$ composer install
```

or you use the Contao Manager. There you select "System maintenance", "Composer dependencies", "Installer 
execute".

![composer install with the Contao Manager](/de/installation/images/de/composer-install-mit-dem-contao-manager.png?classes=shadow)

Finally you have to update the database tables. 


#### Update database tables

Open the [Contao-Installtool](../contao-installtool/) and check if changes to your database are necessary. If necessary, 
make the suggested changes and then close the install tool.

Instead of the Contao install tool, (with Contao 4.9 or later) you can use the command line and run the command 
```bash
$ vendor/bin/contao-console contao:migrate
``` 
use.

Your Contao installation is now up to date.


#### Different PHP versions

If the PHP version used locally is different from the one on your hosting, you need to specify which PHP version should 
be used in your `composer.json` file:

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
described in the section [Updating with the Contao Manager](#updating-with-the-contao-manager). 

Before doing so, make sure that the Composer Resolver Cloud is not used! You do not need it, because you you can provide 
your own server with enough memory and thus reduce the load of the resolver cloud.

You can find the setting in the "System Check" in the "Server Configuration" section.

![Disabling the Composer Resolver Cloud](/de/installation/images/de/cloud_resolver_abschalten.png?classes=shadow)

After the successful update, transfer the `composer.json` and `composer.lock` files back to the Contao installation on 
your hosting. The next steps on your hosting are the same as described above.
 

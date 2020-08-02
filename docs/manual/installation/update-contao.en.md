---
title: 'Update Contao'
description: 'Like most open source projects, Contao is continuously being developed.'
aliases:
    - /en/installation/update-contao/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Like most open source projects, Contao is continuously being developed. With each update, components are updated, bugs are fixed, new features are added or performance is improved. It is therefore recommended to always use a current version.

### The Contao update cycle

Contao follows the concept of [Semantic Versioning](https://semver.org) for the version names, which sounds a bit technical so we will quickly get familiar with the terminology used:

#### Major release

A major release is a completely new version of the software where many basic things have been changed and may not work with existing pages. When writing these lines, the current major release of Contao is **version 4**.

#### minor release

A minor release is a kind of milestone on the development path where new features have been added. Minor adjustments to existing pages may therefore be necessary. When writing these lines, the current minor version of Contao is **version 4.8**.

#### Bugfix release

A bugfix release is a maintenance release whose primary purpose is to fix bugs; the current bugfix version of Contao when writing these lines is **version 4.8.4**.

#### Long term support versions

With version 2.11, the [release cycle of Contao](https://contao.org/de/release-plan.html) was adjusted and Long-Term Support (LTS) versions were introduced that are supported and updated for 24 months, even if newer versions of Contao have been released in the meantime. An overview of all Contao versions is available on Wikipedia.

### Updating with the Contao Manager

{{% notice note %}}
Before updating Contao, it is recommended to create a backup of the `composer.json`database `composer.lock`and the database creation. 
{{% /notice %}}

Log on to Contao Manager and start it.

When updating for a [bugfix release](#bugfix-release), just click on "Update packages".

Special feature when updating for a [minor release](#minor-release): Click on the cogwheel icon at "Contao Open Source CMS" and enter the desired version. Click on the "Update packages" button and then "Apply changes" to start the update.

![Start update for minor release](/de/installation/images/de/aktualisierung-fuer-minor-release-starten.png?classes=shadow)

The update can now take several minutes. Details of the update process can be displayed by clicking the following icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Update for minor release completed](/de/installation/images/de/aktualisierung-fuer-minor-release-abgeschlossen.png?classes=shadow)

#### Update database tables

Open the [Contao install tool](../contao-installtool/) and check if any changes to your database are necessary after the update. Make the suggested changes if necessary and then close the install tool.

Your Contao installation is now up to date.

### Updating via the command line {#update via the command line}

{{% notice note %}}
 Before updating Contao, I recommend that you make a backup of the `composer.json`database `composer.lock`and the database creation. 
{{% /notice %}}

When updating from the command line, a `composer update`is executed. On some hosters, this will cause the process to fail because the system requirements are too high and the installation will fail. In this case you should use the [Contao Manager](##aktualisierung-mit-dem-contao-manager).

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

When updating for a [minor release](#minor-release), the desired version of the program must be `composer.json`entered in `contao/manager-bundle`the

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

Instead of using the Contao install tool, you can (since Contao 4.9) update the database tables on the command line with the command

```bash
$ vendor/bin/contao-console contao:migrate
```

use.

Your Contao installation is now up to date.

---
title: 'Uninstalling extensions'
description: 'To find a suitable extension for a desired function, you have three options.'
aliases:
    - /en/installation/uninstalling-extensions/
weight: 80
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## Uninstalling with Contao Manager

You first need to log back in to Contao Manager. To do so, you need to`/contao-manager.phar.php` access your domain again and enter your access data.

If you want to uninstall the extension "terminal42/contao-easy\_themes", go to the "Packages" tab and click on the "Remove" button next to the extension. Of course you can also reserve other extensions for uninstallation.

![Mark extensions in Contao Manager for uninstallation](/de/installation/images/de/erweiterungen-im-contao-manager-zur-deinstallation-vormerken.png?classes=shadow)

Click on "Apply changes" to start the uninstallation. The uninstallation can now take several minutes. Details of the uninstallation process can be displayed by clicking on the following icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Uninstalling extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-deinstallieren.png?classes=shadow)

Once the Contao Manager has uninstalled the extension(s), you have to [run](../contao-installtool/) the [Contao installation tool](../contao-installtool/) to update the database if necessary.

## Uninstalling from the command line {#deinstallation-using the command line}

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

Then change to the directory of your Contao installation on the console.

```bash
cd www/example/
```

The command `remove`removes the extension from the `composer.json`and deletes the code from the project.

To remove an extension and update it`composer.lock`, the command is `remove`executed. This will cause some hosters to not be able to finish the process because of the high system load and the update will fail. In this case you should use theContao[ Manager](#aktualisierung-mit-dem-contao-manager).

**Uninstall a single extension:**

```bash
php composer.phar remove terminal42/contao-easy_themes
```

**Uninstall multiple extensions:**

```bash
php composer.phar remove terminal42/notification_center terminal42/contao-leads
```

Once the uninstallation of the extension(s) is complete, you have to run the [Contao install tool](../contao-installtool/) to update the database if necessary.

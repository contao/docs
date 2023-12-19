---
title: 'Uninstalling extensions'
description: 'Uninstalling Extensions with the Contao Manager or via command line'
aliases:
    - /en/installation/uninstalling-extensions/
weight: 80
---

## Uninstalling with Contao Manager

You first need to log in to Contao Manager. To do so, call up your domain again with the addition `/contao-manager.phar.php` and enter your access data.

If you want to uninstall the extension "terminal42/contao-easy\_themes", go to the "Packages" tab and click on the "Remove" button next to the extension. Of course you can also reserve other extensions for uninstallation.

![Mark extensions in Contao Manager for uninstallation]({{% asset "images/manual/installation/en/mark-extensions-in-contao-manager-for-uninstallation.png" %}}?classes=shadow)

Click on "Apply changes" to start the uninstallation. The uninstallation can take several minutes. Details of the uninstallation process can be displayed by clicking on the following icon![Show/Hide Console Output]({{% asset "icons/konsolenausgabe.png" %}}?classes=icon).

![Uninstalling extensions in Contao Manager]({{% asset "images/manual/installation/en/uninstalling-extensions-in-contao-manager.png" %}}?classes=shadow)

Once the Contao Manager has uninstalled the extension(s), you have to run the [Contao-Installtool](../contao-installtool/) to update the database if necessary.

## Uninstalling using the command line

You have logged on to your server with your username and domain.

```bash
ssh username@example.com
```

Then go to the directory of your Contao installation.

```bash
cd www/example/
```

The command `remove`removes the extension from the `composer.json`and deletes the code from the project.

To remove an extension and update the `composer.lock`, the command `remove` is executed. This will cause some hosters to not be able to finish the process because of the high system load and the update will fail. In this case you should use the [Contao Manager](#uninstalling-with-contao-manager).

**Uninstall a single extension:**

```bash
php composer.phar remove terminal42/contao-easy_themes
```

**Uninstall multiple extensions:**

```bash
php composer.phar remove terminal42/notification_center terminal42/contao-leads
```

Once the uninstallation of the extension(s) is complete, you have to run the [Contao-Installtool](../contao-installtool/) to update the database if necessary.

---
title: 'Update extensions'
description: 'To find a suitable extension for a desired function, you have three options.'
aliases:
    - /en/installation/update-extensions/
weight: 70
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## Update with the Contao Manager

You first need to log back in to Contao Manager. To do so, you need to`/contao-manager.phar.php` access your domain again and enter your access data.

If you want to update the extension "terminal42/contao-easy\_themes", switch to the "Packages" tab and click on the "Update" button next to the extension. Of course you can also select other extensions to update. Click on "Apply changes" to start the update. The update can take several minutes. Details of the update process can be displayed by clicking on the following icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Update extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-aktualisieren.png?classes=shadow)

Once Contao Manager has updated the extension(s), you have to [call](../contao-installtool/) the [Contao installer](../contao-installtool/) to update the database if necessary.

## Updating from the command line {#update via the command line}

You have logged on to your server with your user name and your domain.

```bash
ssh benutzername@example.com
```

To do this, change to the directory of your Contao installation on the console.

```bash
cd www/example/
```

To get the latest version of an extension and update it`composer.lock`, the command is`update` executed. On some hosters, this will cause the process to fail and the update will fail because the system requirements are too high. In this case you should use theContao[ Manager](#aktualisierung-mit-dem-contao-manager).

**Update a single extension:**

```bash
php composer.phar update terminal42/contao-easy_themes
```

**Update multiple extensions:**

```bash
php composer.phar update terminal42/notification_center terminal42/contao-leads
```

You can also use the command `outdated`to display a list of installed extensions for which updates are available, including their current and latest versions, in advance of the update.

```bash
php composer.phar outdated
```

**Result of the query:**

```bash
doctrine/dbal               v2.8.1 v2.9.2  Database Abstraction Layer
knplabs/knp-menu            2.6.0  v3.0.1  An object oriented menu library
monolog/monolog             1.25.1 2.0.0   Sends your logs to files, sockets, inboxes, databases …
php-http/client-common      1.9.1  2.0.0   Common HTTP Client implementations and tools for HTTPlug
php-http/guzzle6-adapter    v1.1.1 v2.0.1  Guzzle 6 HTTP Adapter
php-http/httplug            v1.1.0 v2.0.0  HTTPlug, the HTTP client abstraction for PHP
sensiolabs/security-checker v5.0.3 v6.0.2  A security checker for your composer.lock
```

Once the update of the extension(s) is complete, you have to [call](../contao-installtool/) the [Contao install tool](../contao-installtool/) to update the database if necessary.

---
title: 'Update extensions'
description: 'Updating Extensions with the Contao Manager or via command line'
aliases:
    - /en/installation/update-extensions/
weight: 70
---

## Updating with the Contao Manager

You first need to log in to Contao Manager. To do so, call up your domain again with the addition `/contao-manager.phar.php` and enter your access data.

If you want to update the extension "terminal42/contao-easy\_themes", switch to the "Packages" tab and click the "Update" button next to the extension. Of course you can also reserve other extensions to update. Click on "Apply changes" to start the update. The update can take several minutes. Details of the update process can be displayed by clicking on the following icon![Show/Hide Console Output]({{% asset "icons/konsolenausgabe.png" %}}?classes=icon).

![Update extensions in Contao Manager]({{% asset "images/manual/installation/en/update-extensions-in-contao-manager.png" %}}?classes=shadow)

Once the Contao Manager has updated the extension(s), you have to run the [Contao-Installtool](../contao-installtool/) to update the database if necessary.

## Update via the command line

You have logged in to your server with your username and domain.

```bash
ssh username@example.com
```

Go to the directory of your Contao installation.

```bash
cd www/example/
```

To get the latest version of an extension and update the `composer.lock`, the command `update` is executed. On some hosters, this will cause the process to fail because the system requirements are too high and the update will fail. In this case you should use the [Contao Manager](#updating-with-the-contao-manager).

**Update a single extension:**

```bash
php composer.phar update terminal42/contao-easy_themes
```

**Update multiple extensions:**

```bash
php composer.phar update terminal42/notification_center terminal42/contao-leads
```

To display a list of installed extensions for which updates are available, including their current and latest versions, you can also use the command `outdated`.

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

Once the update of the extension(s) is complete, you need to  run the [Contao-Installtool](../contao-installtool/) to update the database if necessary.

---
title: 'Install extensions'
description: 'To find a suitable extension for a desired function, you have three options.'
aliases:
    - /en/installation/install-extensions/
weight: 60
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## Search for extensions

To find a suitable extension for a desired function, you have three options.

### website

You can search for an extension on the website [extensions.contao.org](https://extensions.contao.org/).

![Extensions search on extensions.contao.org](/de/installation/images/de/erweiterungssuche-extensions-contao-org.png?classes=shadow)

### Contao Manager

You can search for an extension in the Contao Manager of your installation.

![Advanced search in Contao Manager](/de/installation/images/de/erweiterungssuche-im-contao-manager.png?classes=shadow)

### Command line

You can search for an extension via the command line.

**Search e.g. for extensions of the company "codefog":**

```bash
php composer.phar search codefog
```

**Result of the search:**

```bash
codefog/contao-haste haste extension for Contao Open Source CMS
codefog/contao-cookiebar cookiebar extension for Contao Open Source CMS
codefog/contao-news_categories News Categories bundle for Contao Open Source CMS
codefog/tags-bundle Tags bundle for Contao Open Source CMS
codefog/contao-social_images social_images extension for Contao Open Source CMS
codefog/contao-mobile_menu mobile_menu extension for Contao Open Source CMS
codefog/contao-bootstrap Bootstrap extension for Contao Open Source CMS
codefog/contao-widget_tree_picker widget_tree_picker extension for Contao Open Source CMS
codefog/contao-polls polls extension for Contao Open Source CMS
codefog/contao-member_export Member Export bundle for Contao Open Source CMS
codefog/contao-link-registry Link Registry bundle for Contao Open Source CMS
codefog/contao-instagram Instagram for Contao Open Source CMS
codefog/contao-events_subscriptions events_subscriptions extension for Contao Open Source CMS
codefog/contao-template_override template_override extension for Contao Open Source CMS
codefog/contao-elements-filter elements-filter extension for Contao Open Source CMS
```

Once you have found the desired extension, you can [install](#installation-ueber-die-kommandozeile) it using the Contao[ Manager](#installation-mit-dem-contao-manager) or the [command line](#installation-ueber-die-kommandozeile).

## Install extensions

### Installation with the Contao Manager

You need to log back in to Contao Manager first. To do so, call up your domain with the extension`/contao-manager.phar.php` again and enter your login data.

If you want to install the extension "terminal42/contao-easy\_themes", enter "EasyThemes" in the search field and click on "Add". Repeat the search if you want to find more extensions and mark them for installation.

![Search for extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-suchen.png?classes=shadow)

Afterwards, change to the "Packages" tab and click on "Apply changes" to start the installation. The installation can now take several minutes. Details about the installation process can be displayed by clicking on the icon ![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon)below.

![Installing extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-installieren.png?classes=shadow)

Once Contao Manager has installed the extension(s), you have to [run](../contao-installtool/) the [Contao installer](../contao-installtool/) to update the database.

![Extensions installed in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-installiert.png?classes=shadow)

### Installation via the command line {#installation-over-the-command line}

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

To do this, change to the directory of your Contao installation on the console.

```bash
cd www/example/
```

With this command `require`you add the new package to the file `composer.json`and download it, as well as all packages this package is pending from.

**Install a single extension:**

```bash
php composer.phar require terminal42/contao-easy_themes
```

**Install multiple extensions:**

```bash
php composer.phar require terminal42/notification_center terminal42/contao-leads
```

Once the installation of the extension(s) is complete, you need to [run](../contao-installtool/) the [Contao install tool](../contao-installtool/) to update the database.

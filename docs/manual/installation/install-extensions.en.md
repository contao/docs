---
title: 'Install extensions'
description: 'To find a suitable extension for a desired function, you have three options.'
aliases:
    - /en/installation/install-extensions/
weight: 60
---

## Search for extensions

To find a suitable extension for a desired function, you have three options.

### Website

You can search for an extension on the [extensions.contao.org](https://extensions.contao.org/) website.

![Extensions search on extensions.contao.org](/de/installation/images/de/erweiterungssuche-extensions-contao-org.png?classes=shadow)

### Contao Manager

You can search for an extension directly within the Contao Manager of your installation.

![Advanced search in Contao Manager](/de/installation/images/de/erweiterungssuche-im-contao-manager.png?classes=shadow)

### Command line

You can search for an extension via the command line.

**Search e.g. for extensions of the vendor "codefog":**

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

Once you have found an extension, you can install it via the [Contao Manager](#installation-via-the-contao-manager) or
the [command line](#installation-via-the-command-line).

## Install extensions

### Installation via the Contao Manager

1. Open the Contao Manager (`my-domain.com/contao-manager.phar.php`) and enter your login data.
2. Search for the extension you want to install, then click "Add".
3. Repeat step 2 if you want to add more extensions.
4. Open the "Packages" tab and click "Apply changes" to start the installation process.
5. Once finished, run the [Contao install tool](../contao-installtool/) to update the database.

{{% notice info %}}
The installation process may take several minutes. Details about the running process can be displayed by clicking on the
![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon) icon.
{{% /notice %}}

#### Example

If you want to install the extension `terminal42/contao-easy\_themes`, enter "EasyThemes" in the search field, click
"Add", …

![Search for extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-suchen.png?classes=shadow)

… then go to "Packages" and apply the changes.

![Installing extensions in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-installieren.png?classes=shadow)

Once finished, run the [Contao install tool](../contao-installtool/) to update the database. The extension is now ready
to be used.

![Extensions installed in Contao Manager](/de/installation/images/de/erweiterungen-im-contao-manager-installiert.png?classes=shadow)

### Installation via the command line

1. Log into your server via `ssh`.
2. Navigate to your project's root directory.
3. Run `php composer.phar require <extension>` to install a single extension or `php composer.phar require <extension1> <extension2> …`
   to install multiple extensions.
4. Once finished, run `contao:migrate` or use the [Contao install tool](../contao-installtool/) to update the database.

#### Example
We log in and navigate to the project root.

```bash
ssh user@example.com
```

```bash
cd www/my-project/
```

Let's install `terminal42/contao-easy_themes`.

```bash
php composer.phar require terminal42/contao-easy_themes
php vendor/bin/contao-console contao:migrate
```

{{% notice note %}}
The `contao:migrate` command is available in versions **4.9** and up. You can alternatively use the [Contao install tool](../contao-installtool/).
{{% /notice %}}

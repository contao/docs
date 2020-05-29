---
title: Contao News Sync
menuTitle: News Sync
description: Contao News Sync is a commercial extension for synchronising news articles between Contao installations.
---

**[inspiredminds/contao-news-sync](https://extensions.contao.org/?p=inspiredminds%2Fcontao-news-sync)**

_von [inspiredminds](https://www.inspiredminds.at/)_

_Project web site: [Contao News Sync](https://www.inspiredminds.at/contao-news-sync)_

This extension allows you to synchronsize news articles between different Contao instances. The direction of synchronisation
can be configured freely (i.e. A to B, B to A, or bi-directional). The extension can also be used to import news articles
from another Contao installation just once, e.g. when relaunching a website. Since the extension is compatible with Contao
**3.5** and **4.4+**, it can also be used to import news articles from older Contao versions into newer ones.


## Installation

To install this extension, the `composer.json` of your Contao installation has to be modified first. Two adjustments have
to be done: adding the private repository & adding the dependency. 

To add the repository, add the following to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```

Replace `<YOUR_TOKEN>` with the repository token you received from inspiredminds.

To add the dependency, add the following to your `composer.json`:

```json
{
    "require": {
        "inspiredminds/contao-news-sync": "^3.0"
    }
}
```

{{% expand "View a full example" %}}
```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "license": "LGPL-3.0-or-later",
    "authors": [
        {
            "name": "Leo Feyer",
            "homepage": "https://github.com/leofeyer"
        }
    ],
    "require": {
        "php": "^7.1",
        "contao/conflicts": "@dev",
        "contao/manager-bundle": "4.9.*",
        "inspiredminds/contao-news-sync": "^3.0"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.2"
        }
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```
{{% /expand %}}

After making this adjustment, run a `composer update` on the command line or update your packages via the Contao 
Manager. Then open the Contao Install Tool to update the database as usual.


### Contao 3

In order to install this extension in Contao 3, you need to use the Composer package management extension for Contao 3. You
will find the `composer.json` within the `composer/` subdirectory of your Contao 3 installation. Make sure to use `"^1.0"`
as the version requirement of this extension for Contao 3.

If the Composer package management for Contao 3 is not used yet, it needs to be installed first. One way to do it is to 
install it without migration, especially if you only need it for a one time synchronisation. In that case you can use the
following steps:

{{% expand "Composer package management in Contao 3 - expert installation" %}}
#### Install Composer Extension

First, the `composer` extension needs to be installed. Go to the _Extension manager_ and click on _Install extension_. Search
for _composer_ and confirm the installation of version **0.16.6** with _Continue_ (multiple times).

![Extension manager](/de/extensions/images/en/extension-manager-composer-en.png?classes=shadow)

#### Composer Installation

After successfully installing the extension you will be redirected to the new _Package management_ within the back end.
There you have to confirm the installation of Composer.

![Composer installation](/de/extensions/images/en/composer-client-composer-installation-en.png?classes=shadow)

#### Skip Migration

Afterwards the Composer package management extension would propose to do a migration of all existing extensions from the
old Contao Extension Repository to the new package management. This step is not required for our purposes, so we can skip
it by clicking on _skip migration (only if you know what you do)_.

![Migration](/de/extensions/images/en/composer-client-skip-migration-en.png?classes=shadow)

#### Change settings

Within the package management, go to _Settings_ in the upper right and change the **Minimum stability** setting to _Stable_.
Confirm with _Save_ afterwards.

![Einstellungen](/de/extensions/images/en/composer-client-min-stability-en.png?classes=shadow)

#### Expert Mode

Then go to the _Expert mode_ in the top right, where you can edit the contents of the `composer.json` directly. Here you
can make the necessary changes as described in [Installation](#installation). Save your changes afterwards. The `composer.json`
should look like this:

```json
{
    "name": "local/website",
    "description": "A local website project",
    "type": "project",
    "license": "proprietary",
    "require": {
        "contao-community-alliance/composer-client": "~0.14",
        "inspiredminds/contao-news-sync": "^3.0"
    },
    "prefer-stable": true,
    "minimum-stability": "stable",
    "config": {
        "preferred-install": "dist",
        "cache-dir": "cache",
        "component-dir": "../assets/components"
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://legacy-packages-via.contao-community-alliance.org"
        },
        {
            "type": "artifact",
            "url": "packages"
        },
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ],
    "extra": {
        "contao": {
            "migrated": "skipped"
        }
    }
}
```


#### Composer Settings

One of the next step is to execute a package update. If you want to execute this operation from within the back end, it
is recommended to configure the [detached mode](https://github.com/contao-community-alliance/composer-client/wiki/Execution-modes#as-standalone-process-detached) 
under _System_ » _Settings_ » _Composer settings_.

![Composer settings](/de/extensions/images/en/composer-settings-en.png?classes=shadow)

The exact path for the PHP CLI vary and depend on the server environment and the used PHP version. Suggestions
for possible PHP paths can be found in the [Wiki of the composer extension](https://github.com/contao-community-alliance/composer-client/wiki/Execution-modes#compatibility-with-hosters)
and the [Wiki of the Contao Manager](https://github.com/contao/contao-manager/wiki). The `memory_limit` parameter must be
adjsuted as well. Depending on the server environment it might be recommended to set it to `-1`, `4G` or you need to remove
it completely.


#### Update Composer

The composer extension downloads the latest `composer.phar` automatically. However, it downlaods a development version,
that will likely be incompatible. Thus it is necessary to manually replace the `composer.phar`. You need to download the
newest `1.x` version of Composer from [getcomposer.org/download/](https://getcomposer.org/download/) and then replace the
existing `composer/composer.phar` with that.


#### Execute Package Update

Now the package update can be executed, which will actually install the News Sync extension. This ist the most critical
part as it consumes a lot of working memory. The package update can be executed directly from the back end or from the
command line.


**Back end**

Assuming the correct [composer settings](#composer-settings) have been done, the package update can be triggered with a
click on _Update packages_ within the package management. During the first usage, the package update needs to be executed
three times.

![Composer Update 1](/de/extensions/images/en/en-composer-client-update-1.png?classes=shadow)

![Composer Update 2](/de/extensions/images/en/en-composer-client-update-2.png?classes=shadow)

![Composer Update 3](/de/extensions/images/en/en-composer-client-update-3.png?classes=shadow)

The extension will be installed afterwards. The pcakage management will offer you to also execute the necessary database
updates. Alternatively these updates can also be done in the Contao Install Tool as usual.


**Command line**

In order to execute the package update on the command line, you need to navigate to the `composer/` subdirectory of the
Contao installation. The command to be executed is

```none
php composer.phar update --optimize-autoloader
```

{{% notice info %}}
The `php` part of the command may need to be exchanged with the actual path to a suitable PHP CLI. This depends on the
server environment. See also the [composer settings](#composer-settings) section.
{{% /notice %}}

During first use, the command needs to be executed three times in total:

```sh
$ php composer.phar update --optimize-autoloader
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 27 installs, 0 updates, 0 removals
  - Installing contao-community-alliance/composer-plugin (2.4.3): Loading from cache
  - Installing swiftmailer/swiftmailer (v5.4.12): Loading from cache
  - Installing matthiasmullie/path-converter (1.1.3): Loading from cache
  - Installing matthiasmullie/minify (1.3.63): Loading from cache
  - Installing contao-components/compass (0.12.2.1): Loading from cache
  - Installing true/punycode (1.1.0): Loading from cache
  - Installing tecnick.com/tcpdf (6.3.5): Loading from cache
  - Installing simplepie/simplepie (1.5.5): Loading from cache
  - Installing phpspec/php-diff (v1.1.0): Loading from cache
  - Installing oyejorge/less.php (v1.7.0.14): Loading from cache
  - Installing michelf/php-markdown (1.9.0): Loading from cache
  - Installing leafo/scssphp (v0.8.4): Loading from cache


  [ContaoCommunityAlliance\Composer\Plugin\DuplicateContaoException]
  Warning: Contao core 3.5.40 was about to get installed but 3.5.40 has been found in project root, to recover from this problem please restart the operation
```

```sh
$ php composer.phar update --optimize-autoloader


  [ContaoCommunityAlliance\Composer\Plugin\ConfigUpdateException]  
  legacy packages repository was added to root composer.json
```

```sh
$ php composer.phar update --optimize-autoloader
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 14 installs, 0 updates, 11 removals
  - Removing true/punycode (1.1.0)
  - Removing tecnick.com/tcpdf (6.3.5)
  - Removing swiftmailer/swiftmailer (v5.4.12)
  - Removing simplepie/simplepie (1.5.5)
  - Removing phpspec/php-diff (v1.1.0)
  - Removing oyejorge/less.php (v1.7.0.14)
  - Removing michelf/php-markdown (1.9.0)
  - Removing matthiasmullie/path-converter (1.1.3)
  - Removing matthiasmullie/minify (1.3.63)
  - Removing leafo/scssphp (v0.8.4)
  - Removing contao-components/compass (0.12.2.1)
  - Installing contao-community-alliance/composer-client (0.17.0): Loading from cache
  - removed 114 files
  - created 1 links
  - Installing symfony/polyfill-mbstring (v1.17.0): Loading from cache
  - Installing paragonie/random_compat (v9.99.99): Loading from cache
  - Installing symfony/polyfill-php70 (v1.17.0): Loading from cache
  - Installing symfony/http-foundation (v3.4.40): Loading from cache
  - Installing symfony/polyfill-ctype (v1.17.0): Loading from cache
  - Installing symfony/event-dispatcher (v2.8.52): Loading from cache
  - Installing ramsey/uuid (3.9.3): Loading from cache
  - Installing pimple/pimple (v1.1.1): Loading from cache
  - Installing contao-community-alliance/dependency-container (1.8.3): Loading from cache
  - created 1 links
  - Installing contao-community-alliance/event-dispatcher (1.3.0): Loading from cache
  - created 1 links
  - Installing richardhj/contao-simple-ajax (v1.2.1): Loading from cache
  - removed 2 files
  - created 3 links
  - Installing codefog/contao-haste (4.24.6): Loading from cache
  - created 1 links
  - Installing inspiredminds/contao-news-sync (1.8.4): Loading from cache
  - created 1 links
Package richardhj/contao-simple-ajax is abandoned, you should avoid using it. Use symfony/routing instead.
Writing lock file
Generating optimized autoload files
4 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
Runonce created with 1 updates
```

Afterwards the Contao Install Tool needs to be opened as usual, in order to execute the necessary database updates.
{{% /expand %}}


## Configuration

The extension needs to be installed in all Contao instances that are involved in the synchronisation. After installation
additional settings will be available under the _Synchronisation_ section within the settings of a news archive.

In order to make the news of a news archive available as the source for snychronisation, the setting **Source for synchronisation**
needs to be enabled.

![News Sync settings](/de/extensions/images/en/contao-news-sync-1-en.png?classes=shadow)

In order to fetch news from a news archive of a remote source the **Target for synchronisation** setting must be enabled.
This will provide additional settings. First, the URL of the remote source needs to be configured in **Source URL**. After
saving, the news archives enabled for synchronisation will be available in the **News archives** setting.

![News Sync settings](/de/extensions/images/en/contao-news-sync-2-en.png?classes=shadow)

* **News archives** - this will enable the news archives from which news should be fetched from the remote source and put into this news archive.
* **Limit to categories** - the synchronisation can be limited to these categories, if the `codefog/contao-news_categories` extension is used in both installation.<sup>1</sup>
* **Ignore duplicate aliases** - there might be situations where you already have news articles with the same alias as in the source. With this option you can skip these. Otherwise a duplicate will be created.
* **Sync periodically** - this enabled the periodic synchronisation via Contao's cronjob. The synchronisation will be done hourly.
* **Update existing entries** - with this setting, any changes in the source of already synchronised entries will also be updated in the target.
* **Target directory** - a directory for the synchronised images and attachments needs to be set here.

{{% notice note %}}
<sup>1</sup> Currently this only works with version `2.x` of the `news_categories` extension.
{{% /notice %}}


## Synchronisation

The synchronisation on the target can be triggered in three ways.

* **Command:** on the command line you can use the `vendor/bin/contao-console contao_news_sync:import` command.
* **Backend:** there is a global operation called _Fetch news_ in the news archive record list.
* **Cronjob:** all news archives with enabled periodic synchronisation will be synchronised hourly via Contao's cronjob.


## Security note

All news articles and content elements of all news archives that have been enabled as a source for synchronisation will
be publicly available through the extension's API.

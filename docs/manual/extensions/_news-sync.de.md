---
title: Contao News Sync
menuTitle: News Sync
description: Contao News Sync ist eine kostenpflichtige Erweiterungen zur Synchronisierung von Nachrichtenartikeln zwischen Contao Installationen.
url: erweiterungen/news-sync
---

**[inspiredminds/contao-news-sync](https://extensions.contao.org/?p=inspiredminds%2Fcontao-news-sync)**

_von [inspiredminds](https://www.inspiredminds.at/)_

_Projekt Webseite unter [Contao News Sync](https://www.inspiredminds.at/contao-news-sync)_

Mit dieser Extension können automatisch Nachrichtenartikel zwischen verschiedenen Contao Installationen synchronisiert werden.
Die Synchronisationsrichtung kann dabei beliebig festgelegt werden (etwa A nach B, B nach A oder beide Richtungen). Die
Extension kann auch dazu verwendet werden, Nachrichtenartikel einmalig aus einer Contao Installation in eine andere Contao
Installation zu importieren, etwa für den Relaunch einer Website. Da die Extension die Contao Versionen **3.5** und **4.4+**
unterstützt, können damit auch Nachrichten aus älteren Contao Versionen in die neueste Contao Version übertragen werden.


## Installation

Um diese Erweiterung zu installieren, muss zuerst die `composer.json` der eigenen Contao Installation modifiziert werden.
Dabei sind zwei Anpassungen notwendig: das private Repository hinzufügen und die Abhängigkeit hinzufügen.

Um das Repository hinzuzufügen, muss folgendes in der `composer.json` eingefügt werden:

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

`<YOUR_TOKEN>` muss mit dem Repository Token ersetzt werden, welches von inspiredminds geschickt wurde.

Um die Abhängigkeit hinzuzufügen, muss folgendes in der `composer.json` eingefügt werden:
```json
{
    "require": {
        "inspiredminds/contao-news-sync": "^3.0"
    }
}
```

{{% expand "Komplettes Beispiel anzeigen" %}}
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

Nachdem diese Änderungen gemacht wurden, kann nun ein `composer update` auf der Kommandozeile oder eine
Paketaktualisierung im Contao Manager durchgeführt werden. Danach wie gewohnt das Contao Install Tool aufrufen, um die
Datenbank zu aktualisieren.


### Contao 3

Die Installation unter Contao 3 setzt die Verwendung der Composer Paketverwaltung voraus. Ansonsten ist die Vorgehensweise
gleich. Die von der Composer Paketverwaltung verwendete `composer.json` befindet sich im `composer/` Unterordner der
Contao 3 Installation. Als Versionsangabe muss `"^1.0"` verwendet werden.

Falls die Composer Paketverwaltung in Contao 3 noch nicht eingesetzt wird, kann diese natürlich jederzeit installiert werden.
Falls die Composer Paketverwaltung nur für diese Extension, und nur einmalig gebraucht wird (eben etwa um alle Nachrichten
einmalig in eine andere Contao Installation zu übertragen), kann folgende Anleitung benutzt werden:

{{% expand "Composer Paketverwaltung in Contao 3 - Experteninstallation" %}}
#### Composer Erweiterung installieren

Zuerst muss die `composer` Erweiterung installiert werden. In der _Erweiterungsverwaltung_ unter _Erweiterung installieren_
nach _composer_ suchen. Die Installation von Version **0.16.6** mit _Weiter_ mehrmals bestätigen.

![Erweiterungsverwaltung](/de/extensions/images/de/extension-manager-composer-de.png?classes=shadow)

#### Composer-Installation

Nach erfolgreicher Installation der Erweiterung wird automatisch auf die neue Paketverwaltung im Backend weitergeleitet.
Dort bestätigt man nun die Installation von Composer.

![Composer-Installation](/de/extensions/images/de/composer-client-composer-installation-de.png?classes=shadow)

#### Migration überspringen

Danach würde die Composer Paketverwaltung eine Migration der bestehenden Extensions vom alten Contao Extension Repository
auf die neue Paketverwaltung durchführen. Diese Migration ist allerdings nicht notwendig für die einmalige Benutzung der
News Sync Extension. Daher kann die Migration mit _Migration überspringen (Nur wenn du weißt was du tust)_ übersprungen
werden.

![Migration](/de/extensions/images/de/composer-client-skip-migration-de.png?classes=shadow)

#### Einstellungen ändern

In der Paketverwaltung sollte man nun rechts oben unter _Einstellungen_ die Einstellung **Minimale Stabilität** auf _Stabil_
ändern und speichern.

![Einstellungen](/de/extensions/images/de/composer-client-min-stability-de.png?classes=shadow)

#### Expertenmodus

Danach kann man direkt in den Einstellungen rechts oben auf den _Expertenmodus_ gehen, wo man die `composer.json` der Paketverwaltung
editiert. Hier kann nun die `composer.json` wie im Punkt [Installation](#installation) beschrieben angepasst werden. Danach
die Änderungen speichern. Insgesamt würde die `composer.json` dann so aussehen:

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


#### Composer-Einstellungen

Wenn man die nachfolgende `composer update` Operation über das Backend durchführen möchte, statt über die Kommandozeile,
dann empfiehlt es sich unter _System_ » _Einstellungen_ » _Composer-Einstellungen_ den 
[Detached Mode](https://github.com/contao-community-alliance/composer-client/wiki/Execution-modes#as-standalone-process-detached)
einzustellen.

![Composer-Einstellungen](/de/extensions/images/de/composer-settings-de.png?classes=shadow)

Die genauen Angaben zum PHP CLI Pfad variieren je nach Serverumgebung und eingesetzter PHP Version und können daher hier 
nicht festgelegt werden. Mögliche Angaben zum PHP Pfad je nach Hoster bekommt man im 
[Wiki der Composer Erweiterung](https://github.com/contao-community-alliance/composer-client/wiki/Execution-modes#compatibility-with-hosters)
oder auch im [Wiki des Contao Managers](https://github.com/contao/contao-manager/wiki). Auch die Angabe zum `memory_limit`
Parameter muss individuell eingestellt werden. Je nach Serverumgebung ist es am besten den Parameter auf `-1` zu setzen, 
oder auf `4G`, oder gar ganz zu entfernen.


#### Composer Aktualisieren

Die Composer Erweiterung lädt automatisch die neueste `composer.phar`. Allerdings handelt es sich dabei um eine Entwicklerversion,
die vermutlich nicht mit der Extension kompatibel sein wird. Daher muss diese Datei manuell ersetzt werden. Die neueste 
`1.x` Version des Composers erhält man unter [getcomposer.org/download/](https://getcomposer.org/download/). 
Die bestehende `composer/composer.phar` im Contao Installationsverzeichnis ersetzt man dann mit der heruntergeladenen Datei.


#### Paketaktualisierung durchführen

Nun kann die Paketaktualisierung durchgeführt werden, womit die News Sync Extension tatsächlich installiert wird. Dies ist 
der problematischste Punkt, denn diese Operation braucht viel Arbeitsspeicher. Die Paketaktualisierung kann direkt über
das Backend oder auf der Kommandozeile angestoßen werden.


**Backend**

Hat man die entsprechenden [Composer-Einstellungen](#composer-einstellungen) zuvor getroffen, kann die Paketaktualisierung
in der Paketverwaltung mit einem Klick auf _Pakete Aktualisieren_ angestoßen werden. Die Paketaktualisierung muss, bei der
ersten Benutzung, insgesamt drei mal durchgeführt werden.

![Composer Update 1](/de/extensions/images/de/de-composer-client-update-1.png?classes=shadow)

![Composer Update 2](/de/extensions/images/de/de-composer-client-update-2.png?classes=shadow)

![Composer Update 3](/de/extensions/images/de/de-composer-client-update-3.png?classes=shadow)

Danach ist die Extension installiert. Im Anschluss bietet die Paketverwaltung gleich direkt an, die Datenbank-Updates durchführen
zu lassen. Alternativ kann man dies auch wie gewohnt im Contao Install Tool durchführen lassen.


**Kommandozeile**

Um die Paketaktualisierung auf der Kommandozeile durchzuführen, begibt man sich auf der Konsole in den `composer/` Unterordner
der Contao Installation. Das auszuführende Kommando lautet:

```none
php composer.phar update --optimize-autoloader
```

{{% notice info %}}
Im angegebenen Kommando muss `php` mit dem Pfad zum passenden PHP CLI ersetzt werden. Dies hängt von der jeweiligen Serverumgebung
ab. Siehe dazu auch der Punkt [Composer-Einstellungen](#composer-einstellungen).
{{% /notice %}}

Das Kommando muss insgesamt drei mal ausgeführt werden:

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

Danach muss wie gewohnt das Contao Install Tool aufgerufen werden, um die Datenbank zu aktualisieren.
{{% /expand %}}


## Konfiguration

Die Extension muss in allen Contao Installationen installiert werden, die in die Synchronisation der Nachrichten involviert
sein sollen. Nach der Installation stehen zusätzliche Einstellungen in den Nachrichtenarchiven unter dem Punkt _Synchronisation_
zur Verfügung. 

Um die Nachrichten eines Nachrichtenarchivs als Quelle für die Synchronisation zur Verfügung zu stellen, muss die Einstellung
**Quelle für Synchronisation** aktiviert werden.

![News Sync Einstellungen](/de/extensions/images/de/contao-news-sync-1-de.png?classes=shadow)

Um Nachrichten in einem Nachrichtenarchiv von einer Quelle holen zu lassen muss die Einstellung **Ziel für Synchronisation**
aktiviert werden. Danach stehen zusätzliche Einstellungen zur Verfügung. Unter **Quell-URL** muss zunächst die URL eingetragen
werden, unter die andere Contao Installation erreichbar ist. Speichert man die Einstellungen danach, stehen unter 
**News Archive** alle Nachrichtenarchive zur Auswahl, die auf der Quell-Installation für die Synchronisation freigegeben.

![News Sync Einstellungen](/de/extensions/images/de/contao-news-sync-2-de.png?classes=shadow)

* **News Archive** - damit aktiviert man die Nachrichtenarchive, aus denen Nachrichten aus der Quell-Installation geholt werden sollen.
* **Auf Kategorien beschränken** - ist in beiden Installationen die `codefog/contao-news_categories` Extension installiert, kann die Synchronisation auf bestimmte Kategorien beschränkt werden.<sup>1</sup>
* **Alias-Duplikate ignorieren** - in manchen Situationen kann es sein, dass man bereits Nachrichten mit dem selben Alias in der Ziel-Installation hat. Mit aktivierte Option werden diese Nachrichten übersprungen. Andernfalls wird ein Duplikat angelegt.
* **Periodisch synchronisieren** - dies aktiviert die periodische Synchronisation über den Contao Cronjob. Die Synchronisierung erfolgt stündlich.
* **Einträge aktualisieren** - ist diese Einstellung aktiv, werden Änderungen in der Quell-Installation bereits synchronisierter Nachrichten in der Ziel-Installation übernommen.
* **Zielverzeichnis** - hier muss ein Verzeichnis für die synchronisierten Bilddaten und Anhänge angegeben werden.

{{% notice note %}}
<sup>1</sup> Dies funktioniert derzeit noch nur mit Version `2.x` der `news_categories` Extension.
{{% /notice %}}


## Synchronisation

Die Aktualisierung der Nachrichten kann auf der Ziel-Installation auf drei verschiedene Arten ausgelöst werden.

* **Kommando:** auf der Kommandozeile kann folgendes Kommando benutzt werden: `vendor/bin/contao-console contao_news_sync:import`
* **Backend:** in der Übersicht der Nachrichtenarchive gibt es bei den globalen Operationen einen zusätzlichen _News holen_ Link.
* **Cronjob:** bei allen Nachrichtenarchiven, wo die periodische Synchronisierung aktiviert worden ist, werden die Nachrichten stündlich über den Contao Cronjob abgeholt.


## Sicherheitshinweis

Die Nachrichten und Inhaltselemente aller Nachrichtenarchive, die als Quelle für die Synchronisierung freigegeben wurden,
sind öffentlich über die API der News Sync Extension erreichbar.

---
title: "Deployment mit Deployer"
description: "Wie du dein Contao-Projekt mit Deployer deployen kannst."
aliases:
    - /de/anleitungen/deployer/
weight: 80
tags: 
    - "Deployer"
    - "Deployment"
---

{{% notice note %}}
Diese Anleitung bezieht sich auf die Deployer-Version >=7.0 und Contao-Version >=4.13.
{{% /notice %}}


## Install Deployer

Zuerst musst du Deployer installieren: [https://deployer.org/docs/][1]

```bash
composer require --dev deployer/deployer
```

Bevor du weitermachst, stelle sicher, dass du mindestens Version _7.0_ installiert hast (`vendor/bin/dep --version`).

Jetzt kannst du deine `deploy.php`-Datei in dem Projekt erstellen:

```bash
touch deploy.php
```


## `deploy.php`-Datei schreiben

Es gibt zwei Möglichkeiten, das Projekt auf dem Webserver zu installieren. Standardmäßig verwendet Deployer dafür das
Git-Repository.


### Option 1: Deployment mit Git

Um loszulegen, erstelle die folgende `deploy.php` in deinem Projekt:

```php
// deploy.php

namespace Deployer;

import('recipe/contao.php');

host('example.org')
    ->set('remote_user', 'foobar')
    ->set('deploy_path', '/var/www/{{remote_user}}/html/{{hostname}}')
    ->set('bin/php', 'php8.1')
    ->set('bin/composer', '{{bin/php}} /var/www/{{remote_user}}/composer.phar')
;

set('repository', 'git@github.com:acme/example.org.git');

set('keep_releases', 10);

after('deploy:failed', 'deploy:unlock');
```

Vergesse nicht, die Konfiguration des Hosts (siehe [Dokumentation][2]) und die URL des Git-Repositories anzupassen.

Das Deployment mit Git hat allerdings einige Nachteile. Zum Einen, musst du deinen lokalen Arbeitsstand immer committed
und gepusht haben. Außerdem, wenn Agent Forwarding nicht funktioniert, musst du deinem Webserver Zugriff auf das
Git-Repository geben (entweder mittels HTTPS oder SSH). Deswegen ist es oft einfacher, die notwendigen Dateien mit
`rsync` auf den Webserver hochzuladen.


### Option 2: Deployment mit `rsync`

Um `rsync` anstelle des Git-Checkouts zu verwenden, müssen wir den Task  `deploy:update_code` überschreiben:

```php
// deploy.php

/* Bestehende Einstellungen von »Option 1« */

// Dies brauchen wir nicht mehr
//-set('repository', 'git@github.com:acme/example.org.git');

desc('Upload project files');
task('deploy:update_code', function () {
    foreach([
        'config',
        'contao',
        'public/layout',
        'public/favicon.ico',
        'src',
        '.env',
        'composer.json',
        'composer.lock',
    ] as $src) {
        upload($src, '{{release_path}}/', ['options' => ['--recursive', '--relative']]);
    }
});
```

-----

Zur Info: Anstatt jede Datei, die du auf dem Webserver brauchst, manuell zu konfigurieren, kannst du auch den
eingebauten `rsync`-Task verwenden. Der `rsync`-Task impliziert eine _»Exclude«-Strategie_ statt einer
_»Include«-Strategie_, was bedeutet, dass du die Dateien definierst, die _nicht_ hochgeladen werden sollen. Ein Beispiel
für die Konfiguration findest du hier: [nutshell-framework/deployer-recipes][4]


## Webserver einrichten

Wie du aus der [Contao-Doku][5] weißt, musst du den Document-Root auf `/public` (bzw. `/web`) einstellen. Die Idee
hinter Deployer ist, dass es keine Downtime bei Updates gibt. Deswegen werden rollierende Symlinks eingesetzt. Den
Document-Root von deinem vHost musst du entsprechend auf `/current/public` (bzw. `/current/web`) einstellen. Ein
komplettes Beispiel für einen Document-Root wäre: `/var/www/foobar/html/example.org/current/public`.

{{% notice "info" %}}
Contao verwendet standardmäßig den `/public`-Ordner als Web-Root. Wenn deine Contao-Installation noch den alten `/web`-Ordner
verwendet, dann definiere diesen entsprechend in `composer.json`, damit Deployer das auch weiß.

```json
{
  "extra": {
    "public-dir": "web"
  }
}
```
{{% /notice %}}

## Projektspezifische Tasks

Sehr oft gibt es spezifische Tasks für dein Projekt. Diese kannst du in deinem Deployment ergänzen:

```php
// deploy.php

/* Your existing config */

// Task to build the assets, i.e., run `yarn run build` on the local machine
desc('Build assets')
task('encore:compile', function () {
    runLocally('yarn run build');
});

// Define that the assets should be generated before the project is going to be deployed
before('deploy', 'encore:compile');
```


## Und nun: Deployen!

Nachdem wir alles konfiguriert haben, können wir jetzt `vendor/bin/dep deploy` ausführen und das Projekt auf den Webserver
deployen.


## Tipps

### Eigene »Recipes«

Du kannst bestehende Recipes verwenden oder eigene Recipes erstellen, wenn du Logik extrahieren und wiederverwenden
möchtest. Hier sind einige Beispiele dafür:

- https://github.com/nutshell-framework/deployer-recipes/
- https://github.com/terminal42/deployer-recipes/


### Contao-Manager

Du kannst mit einem Task den Contao-Manager auf dem Webserver installieren:

```php
// deploy.php

/* Your existing deploy.php */

before('deploy:publish', 'contao:manager:download');
// Optionally lock the Contao Manager if you don't use the UI
after('contao:manager:download', 'contao:manager:lock');
```

Verwendest du Contao Manager nicht, dann kannst du den leeren Ordner von "Shared folders" ausschließen:

```php
// deploy.php

set('shared_dirs', array_diff(get('shared_dirs'), ['contao-manager']));
```


### Probleme mit dem Symlink und OPCache / APCu

Weil Deployer einen Symlink für die Document-Root verwendet (siehe oben), kann es Probleme mit internen Caches wie z. B.
OpCode Caching geben. [Mehr Infos.][6]

Schaue zuerst, welche Caches auf deinem Webserver aktiviert sind. Öffne dafür die Symfony-Toolbar, wenn die Website im
Debug-Modus ist. Die aktiven Caches findest du in der unteren rechten Ecke mit einem grünen Haken (✅).

Zum Leeren dieser Caches kannst du das »Cachetool«-Recipe verwenden:

```php
// deploy.php

// Add this recipe
require 'contrib/cachetool.php';

host('www.example.com')
    // Add this option, change {{hostname}} to the actual URL when the hostname does not match the URL.
    ->set('cachetool_args', '--web=SymfonyHttpClient --web-path=./{{public_path}} --web-url=https://{{hostname}}')
;

after('deploy:success', 'cachetool:clear:opcache');
// bzw.
after('deploy:success', 'cachetool:clear:apcu');
```


### Fehlerhafte Deployments

Deployer aktiviert ein Release nur dann, wenn es fehlerfrei durchgelaufen ist. Wenn ein Deployment nun fehlerhaft ist,
kann es sein, dass Contao im Wartungsmodus festsitzt. So kannst du die Installation automatisch wieder »freischalten«:

```php
// deploy.php

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'contao:maintenance:disable');
```

[1]: https://deployer.org/docs/7.x/installation
[2]: https://deployer.org/docs/7.x/hosts
[3]: https://github.com/terminal42/deployer-recipes
[4]: https://github.com/nutshell-framework/deployer-recipes/blob/main/recipe/contao-rsync.php
[5]: /de/installation/systemvoraussetzungen/#hosting-konfiguration
[6]: https://ma.ttias.be/php-opcache-and-symlink-based-deploys

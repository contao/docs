---
title: "Deploy with Deployer"
description: "Learn how to deploy your project with Deployer."
aliases:
    - /en/guides/deployer/
weight: 80
tags: 
    - "Deployer"
    - "Deployment"
---

{{% notice note %}}
The Deployer recipe is part of Deployer 7 and is intended to work for Contao 4.13 and higher.
{{% /notice %}}

## Install Deployer

If not done yet, install Deployer as described here: [https://deployer.org/docs/][1]

You can either install Deployer globally or per project and use the command `dep` or `./vendor/bin/dep` respectively.

Verify that you are running Deployer in the minimum version _7.0_ by running `dep --version`.

Once done, you can create a `deploy.php` file in your project:

```bash
touch deploy.php
```

## Write deploy.php file

There are two ways to deploy your project to the remote site. The default approach to deploy files in Deployer is to
check out the Git repository with the current project on the remote server.

### Option 1: Deploy with Repository

To get started with Deployer, use the following file contents for the `deploy.php` in your project root:

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

Make sure to adjust the host configuration (see the [Documentation][2]) and repository URL as required.

The deployment with Git repo has some downsides, though. First, you always need to have your local files committed and
pushed. Second, in case your SSH environments do not support agent forwarding, your remote site needs to have
read-access on the Git repository, which requires storing the HTTPS credentials or configuring SSH. Therefore, another
favored approach is to use `rsync` instead of Git to deploy the project.

### Option 2: Deploy with rsync

To use `rsync` instead of a Git checkout, we need to override the `deploy:update_code` task:

```php
// deploy.php

/* Your existing config from "Option 1" */

// Not needed anymore
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

For the sake of completeness, instead of defining every(!) file and folder in `upload()`, you can also use the `rsync`
task. The `rsync` task implies an _exclude strategy_ rather than an _include strategy_. You can find an example and the
`contao-rsync.php` recipe here: [nutshell-framework/deployer-recipes][4]

## Provision web server

As you know [from the Contao documentation][5], you have to set the document root of the server to `/public` (or
`/web` in older versions) of the project. The idea of Deployer is to provide updates without downtime, and to realize
this, Deployer utilizes rolling symlink releases. Consequently, you have to set the document root of your vHost to
`/current/public` (or `/current/web` respectively). A full example for the document root might look like
`/var/www/foobar/html/example.org/current/public`.

{{% notice "info" %}}
By default, Contao uses the `/public` folder of the project as the document root. If your Contao
installation is still using the legacy `/web` folder as public directory, please explicitly set it in the `composer.json`
of the project:

```json
{
  "extra": {
    "public-dir": "web"
  }
}
```
{{% /notice %}}

## Add build-task to deployment

Often you have some additional build tasks tailored to your project. You can quickly add those tasks to the deployment
process:

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

## Finally: Deploy

You are now all set to run `dep deploy`.

## Tips

### Custom recipes

You can use one or many recipes in your project, and you are free to extract logic for your projects into own recipes.
Here is a collection of Deployer recipes that might give you an inspiration (and can use as a start for your own
recipes):

- https://github.com/nutshell-framework/deployer-recipes
- https://github.com/terminal42/deployer-recipes/

### Contao Manager

You can also provide a task to download the Contao Manager on each deploy:

```php
// deploy.php

/* Your existing deploy.php */

before('deploy:publish', 'contao:manager:download');
// Optionally lock the Contao Manager if you don't use the UI
after('contao:manager:download', 'contao:manager:lock');
```

If you don't use Contao Manager, you can prevent empty folder from being deployed by excluding it from shared folders:

```php
// deploy.php

set('shared_dirs', array_diff(get('shared_dirs'), ['contao-manager']));
```

### Symlink issues with OPCache / APCu

As Deployer is using a symlink for the document root (as read above), issues might occur with internal caches like the
OPCode Caching. [Read more here.][6]

To check what caches are in place, you can check the Symfony toolbar (lower right corner) which should show a green tick
(✅) for OPCache.

For the caches being in place, this is an example to clear the caches:

```php
// deploy.php

// Add this recipe
require 'contrib/cachetool.php';

host('www.example.com')
    // Add this option, change {{hostname}} to the actual URL when the hostname does not match the URL.
    ->set('cachetool_args', '--web=SymfonyHttpClient --web-path=./{{public_path}} --web-url=https://{{hostname}}')
;

after('deploy:success', 'cachetool:clear:opcache');
// or
after('deploy:success', 'cachetool:clear:apcu');
```

### Handle failed deployments

Deployer only activates the new build when the deployment is without errors. However, when a deployment fails, you might
find your deployment in a locked state and the Contao installation in maintenance mode. Therefore, you can unlock the
deployment (to allow follow-up deployments) automatically and disable the Contao maintenance mode after failed
deployments:

```php
// deploy.php

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'contao:maintenance:disable');
```

[1]: https://deployer.org/docs/7.x/installation
[2]: https://deployer.org/docs/7.x/hosts
[3]: https://github.com/terminal42/deployer-recipes
[4]: https://github.com/nutshell-framework/deployer-recipes/blob/main/recipe/contao-rsync.php
[5]: /en/installation/system-requirements/#hosting-configuration
[6]: https://ma.ttias.be/php-opcache-and-symlink-based-deploys

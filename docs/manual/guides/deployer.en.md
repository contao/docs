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
The Deployer recipe is part of Deployer 7 and is intended to work for Contao 4.13 and greater.

## Install Deployer

If not done yet, install Deployer as described here: [https://deployer.org/docs/][1]

Verify that you are running Deployer in the minimum version _7.0.0-rc.5_ by running `dep --version`.

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
<?php // /deploy.php

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

Make sure to adjust the host configuration ([Documentation][2]) and repository URL as required.

The deployment with Git repo has some downsides, though. First, you always need to have your local files committed
and pushed. Second, your remote site needs to have read-access on Git repository, which requires storing the HTTPS
credentials or configuring SSH. Therefore, another favored approach is to use `rsync` instead of Git to deploy the
project.

### Option 2: Deploy with rsync

To use `rsync` instead of a Git checkout, we need to use the rsync recipe and add further configuration to the
`deploy.php` file.

First we create a new recipe solely for the rsync functionality:

```bash
touch deploy-rsync.php
```

```php
<?php // /deploy-rsync.php

namespace Deployer;

import('contrib/rsync.php');

set('rsync_dest','{{release_path}}');

// The files in your Contao installation that should not be uploaded
set('exclude', [
    '.git',
    '/.github',
    '/.idea',
    '/deploy.php',
    '/.env.local',
    '/.gitignore',
    '/config/parameters.yml',
    '/contao-manager',
    '/tests',
    '/var',
    '/vendor',
    '/app/Resources/contao/config/runonce*',
    '/assets',
    '/files',
    '/system',
    '/{{public_path}}/bundles',
    '/{{public_path}}/assets',
    '/{{public_path}}/files',
    '/{{public_path}}/share',
    '/{{public_path}}/system',
    '/{{public_path}}/app.php',
    '/{{public_path}}/app_dev.php',
    '/{{public_path}}/index.php',
    '/{{public_path}}/preview.php',
    '/{{public_path}}/robots.txt',
]);

set('rsync', function () {
    return [
        'exclude' => array_unique(get('exclude', [])),
        'exclude-file' => false,
        'include' => [],
        'include-file' => false,
        'filter' => [],
        'filter-file' => false,
        'filter-perdir' => false,
        'flags' => 'rz',
        'options' => ['delete'],
        'timeout' => 300,
    ];
});

desc('Use rsync task to pull project files');
task('deploy:update_code', function () {
    invoke('rsync');
});
```

Then we make the following changes to the project’s `deploy.php`:

```php
<?php // /deploy.php

// Add this recipe, do not remove the contao.php recipe
require __DIR__.'/deploy-rsync.php';

/* Your existing config */

// Not needed anymore
//-set('repository', 'git@github.com:acme/example.org.git');

// Set current dir (project root)
set('rsync_src', __DIR__);

// Project-specific files and folders that shall not be uploaded on deployment
add('exclude', [
   '/README.md',
]);
```

**Pro tip:** You can create your own set of re-usable Deployer recipes, and when doing so, you can move the 
`contao-rsync.php` respectively. The [terminal42/deployer-recipes][3] repository is an excellent example of how to
create re-usable recipes for your Contao projects.

### Provision web server

As you know [from the Contao documentation]([4]), you have to set the document root of the server to `/public` (or
`/web` in older versions) of the project. The idea of Deployer is to provide updates without downtime, and to realize
this, Deployer utilizes rolling symlink releases. Consequently, you have to set the document root of your vHost to 
`/current/public` (or `/current/web` respectively). A full example for the document root might look like 
`/var/www/foobar/html/example.org/current/public`.

---

Contao is slowly migrating to use the “public” folder of the project as the document root. When your Contao 4.13
installation is still using the folder “web” as public directory, please explicitly set it in the `composer.json`
of the project:

```json
{
  "extra": {
    "public-dir": "web"
  }
}
```

### Finally: Deploy

You are now all set to run `dep deploy`.

## Add build-task to deployment

Often you have some additional build tasks tailored to your project. You can quickly add those tasks to the deployment
process:

```php
<?php // /deploy.php

/* Your existing config */

// Task to build the assets, i.e., run `yarn run build` on the local machine
desc('Build assets')
task('encore:compile', function () {
    runLocally('yarn run build');
});

// Define that the assets should be generated before the project is going to be deployed
before('deploy', 'encore:compile');

// When using rsync, we do not want to upload those files
add('exclude', [
    'package.json',
    'package-lock.json',
    'yarn.lock',
    '/node_modules',
]);
```

## Tips

### Custom recipes

terminal42 provides some additional recipes under [terminal42/deployer-recipes/][3]. You can use one or many recipes in
your project, and you are free to extract logic for your projects into own recipes as well (as described above for the
rsync recipe).

### Contao Manager

You can also provide a task to download the Contao Manager on each deploy:

```php
<?php

/* Your existing deploy.php */

before('deploy:publish', 'contao:manager:download');
// Optionally lock the Contao Manager if you don't use the UI
after('contao:manager:download', 'contao:manager:lock');
```

### Symlink issues with OPCache / APCu

As Deployer is using a symlink for the document root (as read above), issues might occur with internal caches like the
OPCode Caching. [Read more here.][5]

To check what caches are in place, you can check the Symfony toolbar (lower right corner) which should show a green tick
(✅) for OPCache.

For the caches being in place, this is an example to clear the caches:

```php
<?php

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
find your deployment in a locked state and the Contao installation in maintenance mode. Therefore, feel free to unlock
the deployment (to allow follow-up deployments) automatically and disable the Contao maintenance mode after failed 
deployments:

```php
after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'contao:maintenance:disable');
```

[1]: https://deployer.org/docs/7.x/getting-started
[2]: https://deployer.org/docs/7.x/hosts
[3]: https://github.com/terminal42/deployer-recipes
[4]: /en/installation/system-requirements/#hosting-configuration
[5]: https://ma.ttias.be/php-opcache-and-symlink-based-deploys

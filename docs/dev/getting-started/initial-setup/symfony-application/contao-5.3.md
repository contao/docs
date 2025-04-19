---
title: "Use Contao 5.3 in Symfony Application"
linkTitle: "Contao 5.3 LTS"
description: "How to integrate Contao 5.3 into a Symfony application."
weight: 3
aliases:
  - /getting-started/initial-setup/symfony-application/contao-5.3/
---


The Contao Open Source CMS can be integrated into a regular Symfony application.
It needs a few installation steps in order to be properly set up. The following
documentation leads you through them.


## Install and set up your Symfony application

If you already have a full stack Symfony application set up, you can skip
this step and go directly to the installation procedure for the Contao bundles.
First of all we need a full stack Symfony application installed. You can
find further information about this subject in the [Symfony documentation](https://symfony.com/doc/current/setup.html).

```
$ composer create-project symfony/skeleton:"6.4.*" contao-example
```

This command creates the directory `contao-example`, containing a bare bone
Symfony application in it.

The Contao core bundle has a recipe in the [symfony/recipes-contrib](https://github.com/symfony/recipes-contrib/tree/main/contao) repository. 
Be sure to either enable contrib recipes for your project by running the following command or follow the 
instructions to use the contrib recipe during the installation process.
```
$ composer config extra.symfony.allow-contrib true
```

Add the `contao-component-dir` to the `extra` section of your `composer.json file.
```
composer config extra.contao-component-dir assets
```

In order to complete our installation copy the `.env` file to `.env.local` and
change the environment values accordingly. In this case, we only need the
`DATABASE_URL` changed, so our `.env.local` will also only contain this configuration
value.

```env
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=9.0&charset=utf8
```

At this point `contao-example` should contain a working Symfony application and
you can proceed to the second step, the installation of Contao itself.

### Prepare the application for the next step

Contao uses features of third party bundles. Most of them are configured automatically if you use
[Symfony flex](https://symfony.com/doc/current/setup/flex.html), except the 2FA bundle. If you skip this step, your
`composer require` task will fail. Therefore, you need to create a basic config yourself.

Create (or edit if the file already exists) the file `config/packages/scheb_2fa.yaml` and add the following entries:

```yaml
# Scheb 2FA configuration
scheb_two_factor:
    trusted_device:
        enabled: true
    backup_codes:
        enabled: true
```

Contao relies heavily on the security component of Symfony, which needs to be
configured accordingly. Replace the contents of the file `config/packages/security.yaml`
with the following lines.

```yaml
security:
    password_hashers:
        Contao\User: auto
        Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: auto

    providers:
        contao.security.backend_user_provider:
            id: contao.security.backend_user_provider

        contao.security.frontend_user_provider:
            id: contao.security.frontend_user_provider

    firewalls:
        contao_backend:
            request_matcher: contao.routing.backend_matcher
            provider: contao.security.backend_user_provider
            user_checker: contao.security.user_checker
            switch_user: true
            login_throttling: ~

            login_link:
                check_route: contao_backend_login_link
                signature_properties: [username, lastLogin]
                success_handler: contao.security.authentication_success_handler

            contao_login:
                remember_me: false

            logout:
                path: contao_backend_logout

        contao_frontend:
            request_matcher: contao.routing.frontend_matcher
            provider: contao.security.frontend_user_provider
            user_checker: contao.security.user_checker
            access_denied_handler: contao.security.access_denied_handler
            switch_user: false
            login_throttling: ~

            contao_login:
                remember_me: true

            remember_me:
                secret: '%kernel.secret%'
                remember_me_parameter: autologin
                token_provider:
                    doctrine: true

            logout:
                path: contao_frontend_logout

    access_control:
        - { path: ^%contao.backend.route_prefix%/login$, roles: PUBLIC_ACCESS }
        - { path: ^%contao.backend.route_prefix%/logout$, roles: PUBLIC_ACCESS }
        - { path: ^%contao.backend.route_prefix%(/|$), roles: ROLE_USER }
        - { path: ^/, roles: [PUBLIC_ACCESS] }
```

Last part of this mandatory configuration is for the logging component. There is a development and a production configuration.
The development configuration is located in `config/packages/monolog.yaml`.

{{% notice tip %}}
This is an example configuration and you can adjust this to your custom needs if required.
{{% /notice %}}

```yaml
monolog:
    handlers:
        contao:
            type: service
            id: contao.monolog.handler

        main:
            type: rotating_file
            max_files: 10
            path: '%kernel.logs_dir%/%kernel.environment%.log'
            level: debug
            channels: ['!doctrine', '!event', '!php']

        console:
            type: console
            bubble: false
            verbosity_levels:
                VERBOSITY_VERBOSE: INFO
                VERBOSITY_VERY_VERBOSE: DEBUG
            channels: ["!event", "!doctrine", "!console"]

        console_very_verbose:
            type: console
            bubble: false
            verbosity_levels:
                VERBOSITY_VERBOSE: NOTICE
                VERBOSITY_VERY_VERBOSE: NOTICE
                VERBOSITY_DEBUG: DEBUG
            channels: ["!event", "!doctrine", "!console"]

when@prod:
    monolog:
        handlers:
            contao:
                type: service
                id: contao.monolog.handler

            main:
                type: fingers_crossed
                action_level: error
                handler: nested
                excluded_http_codes: [400, 401, 403, 404]

            nested:
                type: rotating_file
                max_files: 10
                path: '%kernel.logs_dir%/%kernel.environment%.log'
                level: info

            console:
                type: console
                process_psr_3_messages: false
                channels: ["!event", "!doctrine"]
```

Now you're good to install the Contao Core bundle.

## Install the Contao Core Bundle

```
$ composer require --with-all-dependencies \
    contao/conflicts:@dev \
    contao/core-bundle:"5.3.*" \
    symfony/monolog-bundle:^3.1 \
    php-http/guzzle7-adapter \
    terminal42/service-annotation-bundle:^1.1 \
    toflar/psr6-symfony-http-cache-store:^4.0 \
    twig/twig:^3.11
```

As long as the Symfony flex plugin is installed you will be asked to execute
contrib recipes for several packages. Answering `a` on those question sets you
up faster.

{{% notice tip %}}
Check your `composer.json` file look for this following lines if they exist. 
Add or enhance the section `auto-scripts` if they're missing.
{{% /notice %}}

```json
{
    "…": "…",
    "scripts": {
        "…": "…",
        "auto-scripts": {
            "cache:clear": "symfony-cmd",
            "assets:install %PUBLIC_DIR%": "symfony-cmd",
            "contao:install %PUBLIC_DIR%": "symfony-cmd",
            "contao:symlinks %PUBLIC_DIR%": "symfony-cmd"
        }
    }
}

```

Finish and apply these changes by running another Composer update.

```
$ composer update
```

After the installation through Composer, a few configuration values needs to be
changed and added.

First of all, make sure all bundles are properly loaded. You should find the
following lines in your `config/bundles.php` file.

```php
return [
    // …
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    FOS\HttpCacheBundle\FOSHttpCacheBundle::class => ['all' => true],
    Scheb\TwoFactorBundle\SchebTwoFactorBundle::class => ['all' => true],
    Nelmio\CorsBundle\NelmioCorsBundle::class => ['all' => true],
    Nelmio\SecurityBundle\NelmioSecurityBundle::class => ['all' => true],
    Knp\Bundle\TimeBundle\KnpTimeBundle::class => ['all' => true],
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => ['all' => true],
    Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle::class => ['all' => true],
    Contao\CoreBundle\ContaoCoreBundle::class => ['all' => true],
    Terminal42\ServiceAnnotationBundle\Terminal42ServiceAnnotationBundle::class => ['all' => true],
];
```

## Configure your Contao installation

You can configure the `Contao Core Bundle` with the config file in `config/packages/contao_core.yaml`. Create (or edit
if the file already exists) the file and adjust it to your needs.

```yaml
contao:
    preview_script: '/preview.php'
    upload_path: files
    csrf_token_name: contao_csrf_token
    pretty_error_screens: true

when@dev:
    contao:
        pretty_error_screens: false

```

Make sure all the Contao routes are loaded by your application. Add the following
lines to `config/routes.yaml`. The Contao core bundle will provide a catch-all route.

```yaml
ContaoCoreBundle:
    resource: "@ContaoCoreBundle/Resources/config/routes.yaml"
```

Add the `binary_string` type to the list of Doctrine types.
Edit the file `config/packages/doctrine.yaml`. Be sure to merge the following configuration
into the existing one.

```yaml
doctrine:
    dbal:
        types:
            binary_string:
                class: 'Contao\CoreBundle\Doctrine\DBAL\Types\BinaryStringType'
```

Be sure to add the following configuration key/values to the `config/packages/framework.yaml`
file, leaving the already existing lines there.

```yaml
framework:
    assets: true
    esi: true
    csrf_protection: ~
    lock: ~
    fragments: { path: /_fragment }
    cache:
```

Depending on the language of your choice, change the default and fallback language to e.g. `de`. 
In order to do so, change `en` to `de` in `config/packages/translation.yaml`.

```yaml
framework:
    default_locale: de
    translator:
        fallbacks:
            - de
```

The next step is to install the database schema to the configured database.
Run the `contao:migrate` command and follow the instructions there.

```
$ php bin/console contao:migrate

```

Since everything is configured correctly, add a admin user through the CLI interface by
running the `contao:user:create` command and follow the instructions given to you.

```
$ php bin/console contao:user:create
```

You can now start a local server and open up the installation tool in your browser.
For example, if you're using the [Symfony CLI](https://github.com/symfony-cli/symfony-cli), start the server like this:

```
$ symfony serve
```

## Enable Cache and Front End Preview

At this point you have set up a working Symfony application and added the Contao
Core Bundle. A few last steps are required to properly set up the caching and
the front end preview.

First, we need to install and configure the `FOSHttpCacheBundle`. To do so, install the package with composer, create (or edit
if the file already exists) the file `config/packages/fos_http_cache.yaml` and add the following entries:

```
$ composer require friendsofsymfony/http-cache ^2.15
```

```yaml
# FOS HttpCache configuration
fos_http_cache:
    invalidation:
        enabled: false

when@prod:
    fos_http_cache:
        proxy_client:
            symfony:
                use_kernel_dispatcher: true
        cache_manager:
            enabled: true
        tags:
            enabled: true
            annotations:
                enabled: false
            max_header_value_length: 4096
```

Replace your `public/index.php` with the following version to enable the caching
capabilities from Contao.

```php
<?php

use App\HttpKernel\AppKernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Suppress error messages (see #1422)
@ini_set('display_errors', '0');

// Disable the phar stream wrapper for security reasons (see #105)
if (in_array('phar', stream_get_wrappers(), true)) {
    stream_wrapper_unregister('phar');
}

// System maintenance mode comes first as it has to work even if the vendor directory does not exist
if (file_exists(__DIR__.'/../var/maintenance.html')) {
    $contents = file_get_contents(__DIR__.'/../var/maintenance.html');

    http_response_code(503);
    header('Content-Type: text/html; charset=UTF-8');
    header('Content-Length: '.strlen($contents));
    header('Cache-Control: no-store');

    die($contents);
}

return function (array $context) {
    return new AppKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
```

The front end preview is an entry script on its own and needs to be placed in
`public/preview.php` containing the following lines:

```php
<?php

use App\HttpKernel\AppKernel;
use FOS\HttpCache\TagHeaderFormatter\TagHeaderFormatter;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Suppress error messages (see #1422)
@ini_set('display_errors', '0');

// Disable the phar stream wrapper for security reasons (see #105)
if (in_array('phar', stream_get_wrappers(), true)) {
    stream_wrapper_unregister('phar');
}

// System maintenance mode comes first as it has to work even if the vendor directory does not exist
if (file_exists(__DIR__.'/../var/maintenance.html')) {
    $contents = file_get_contents(__DIR__.'/../var/maintenance.html');

    http_response_code(503);
    header('Content-Type: text/html; charset=UTF-8');
    header('Content-Length: '.strlen($contents));
    header('Cache-Control: no-store');

    die($contents);
}

return function (array $context, Request $request) {
    $request->attributes->set('_preview', true);

    $kernel = new AppKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    $response = $kernel->handle($request);

    // Prevent preview URLs from being indexed
    $response->headers->set('X-Robots-Tag', 'noindex');

    // Force no-cache on all responses in the preview front controller
    $response->headers->set('Cache-Control', 'no-store');

    // Strip all tag headers from the response
    $response->headers->remove(TagHeaderFormatter::DEFAULT_HEADER_NAME);

    return $response;
};
```

And finally, we need to replace the applications `Kernel`.
Remove `src/Kernel.php` and a new file `src/HttpKernel/AppKernel.php`.

```php
// src/HttpKernel/AppKernel.php

<?php

declare(strict_types=1);

namespace App\HttpKernel;

use FOS\HttpCache\SymfonyCache\HttpCacheProvider;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class AppKernel extends BaseKernel implements HttpCacheProvider
{
    use MicroKernelTrait;

    private ?AppCache $httpCache = null;

    public function getHttpCache(): AppCache
    {
        if (null !== $this->httpCache) {
            return $this->httpCache;
        }

        return $this->httpCache = new AppCache($this, $this->getProjectDir() . '/var/cache/prod/http_cache');
    }
}
```

In the same directory create the file `src/HttpKernel/AppCache.php`.and

```php
// src/HttpKernel/AppCache.php

<?php

declare(strict_types=1);

namespace App\HttpKernel;

use Contao\CoreBundle\EventListener\HttpCache\StripCookiesSubscriber;
use FOS\HttpCache\SymfonyCache\CacheInvalidation;
use FOS\HttpCache\SymfonyCache\CleanupCacheTagsListener;
use FOS\HttpCache\SymfonyCache\EventDispatchingHttpCache;
use FOS\HttpCache\SymfonyCache\PurgeListener;
use FOS\HttpCache\SymfonyCache\PurgeTagsListener;
use FOS\HttpCache\TagHeaderFormatter\TagHeaderFormatter;
use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Toflar\Psr6HttpCacheStore\Psr6Store;

class AppCache extends HttpCache implements CacheInvalidation
{
    use EventDispatchingHttpCache;

    public function __construct(AppKernel $kernel, string $cacheDir = null)
    {
        $this->addSubscriber(new StripCookiesSubscriber(array_filter(explode(',', $_SERVER['COOKIE_ALLOW_LIST'] ?? ''))));
        $this->addSubscriber(new PurgeListener());
        $this->addSubscriber(new PurgeTagsListener());
        $this->addSubscriber(new CleanupCacheTagsListener());

        parent::__construct($kernel, $cacheDir);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(Request $request, $catch = false): Response
    {
        return parent::fetch($request, $catch);
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();

        // Only works as of Symfony 4.3+
        $options['trace_level'] = $_SERVER['TRACE_LEVEL'] ?? 'short';
        $options['trace_header'] = 'Contao-Cache';

        return $options;
    }

    protected function createStore(): Psr6Store
    {
        $cacheDir = $this->cacheDir ?: $this->kernel->getCacheDir() . '/http_cache';

        return new Psr6Store([
            'cache_directory' => $cacheDir,
            'cache' => new TagAwareAdapter(new FilesystemAdapter('', 0, $cacheDir)),
            'cache_tags_header' => TagHeaderFormatter::DEFAULT_HEADER_NAME,
            'prune_threshold' => 5000,
        ]);
    }
}
```

The last thing now is to adjust the config for the routing via annotations.
If the file `config/routes/annotations.yaml` and a config for `kernel` exists, change it to this:

```yaml
kernel:
    resource: ../../src/HttpKernel/AppKernel.php
    type: annotation
```

And the last thing to fix is the cli entrypoint `bin/console` which should reflect our new
`AppKernel`.

```php
// bin/console

#!/usr/bin/env php
<?php

use App\HttpKernel\AppKernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;

if (!is_file(dirname(__DIR__).'/vendor/autoload_runtime.php')) {
    throw new LogicException('Symfony Runtime is missing. Try running "composer require symfony/runtime".');
}

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $kernel = new AppKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);

    return new Application($kernel);
};
```

And that's it. You have successfully set up a Symfony application and/or installed
the Contao Core Bundle.

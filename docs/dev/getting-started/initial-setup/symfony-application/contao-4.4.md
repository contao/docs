---
title: "Use Contao 4.4 in Symfony Application"
menuTitle: "Contao 4.4 LTS"
description: "How to integrate Contao 4.4 into a Symfony application."
weight: 2
aliases:
  - /getting-started/initial-setup/symfony-application/contao-4.4/
---


The Contao Open Source CMS can be integrated into a regular Symfony application.
It needs a few installation steps in order to be properly set up. The following
documentation leads you through them.


## Install and set up your Symfony application

If you already have a full stack Symfony application set up, you can skip
this step and go directly to installation procedure for the Contao bundles.
First of all we need a full stack Symfony application installed. You can
find further information about this subject in the [Symfony documentation](https://symfony.com/doc/current/setup.html).

```
$ composer create-project symfony/website-skeleton contao-example ^3.4
```

This command creates the directory `contao-example`, containing a bare bone
Symfony application in it.
In order to complete our installation copy the `.env` file to `.env.local` and
change the environment values accordingly. In this case, we only need the
`DATABASE_URL` changed, so our `.env.local` will also only contain this configuration
value.

```env
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

At this point `contao-example` should contain a working Symfony application and
you can proceed to the second step, the installation of Contao itself.


## Install the Contao Core Bundle
```
$ composer require \
    doctrine/dbal:^2.5 \
    doctrine/doctrine-bundle ^1.6 \
    doctrine/migrations:^1.1 \
    doctrine/doctrine-migrations-bundle:^1.3 \
    contao/conflicts:@dev \
    contao/core-bundle:4.4.* \
    contao/installation-bundle:4.4.* \
    php-http/guzzle6-adapter \
    sensio/framework-extra-bundle:^3.0.2 \
    symfony/console:^3.3.7 \
    symfony/swiftmailer-bundle:^2.3 \
    swiftmailer/swiftmailer:^5.0 \
    toflar/psr6-symfony-http-cache-store \
    twig/twig ^1.26
```

If the installation request fails, try to check for conflicting packages in
the `contao/conflicts` meta-package. This is exactly the reason why `doctrine/dbal`
and `doctrine/migrations` need to be installed in another version than the default
one.

As long as the Symfony flex plugin is installed you will be asked to execute
contrib recipes for several packages. Answering `a` on those question sets you
up faster.

After this step, it is time to edit our `composer.json` file and add a few lines
which Contao uses to set itself up.

```json
{
    "…": "…",
    "extra": {
        "contao-component-dir": "assets",
        "…": "…"
    },
    "scripts": {
        "…": "…",
        "auto-scripts": {
            "cache:clear --no-warmup": "symfony-cmd",
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
    Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],ue],
    FOS\HttpCacheBundle\FOSHttpCacheBundle::class => ['all' => true],
    Terminal42\HeaderReplay\HeaderReplayBundle::class => ['all' => true],
    Nelmio\CorsBundle\NelmioCorsBundle::class => ['all' => true],
    Knp\Bundle\TimeBundle\KnpTimeBundle::class => ['all' => true],
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => ['all' => true],
    Contao\CoreBundle\ContaoCoreBundle::class => ['all' => true],
    Contao\InstallationBundle\ContaoInstallationBundle::class => ['all' => true],
];
```


## Configure your Contao installation

First, we need to configure the `ContaoCoreBundle`. To do so, create (or edit
if the file already exists) the file config/contao_core.yaml and add the following entries:

```yaml
contao:
    web_dir: "%kernel.project_dir%/public"
```

Make sure all the Contao routes are loaded by your application. Add the following
lines to `config/routes.yaml`. The Contao core bundle will provide a catch-all route.
Since the order of those lines matter, make sure to load the `ContaoCoreBundle`
at the end after the `ContaoInstallationBundle`.

```yaml
ContaoInstallationBundle:
    resource: "@ContaoInstallationBundle/Resources/config/routing.yml"

ContaoCoreBundle:
    resource: "@ContaoCoreBundle/Resources/config/routing.yml"
```

Add the `binary_string` type to the list of Doctrine types.
Edit the file `config/doctrine.yaml`. Be sure to merge the following configuration
into the existing one.

```yaml
doctrine:
    dbal:
        types:
            binary_string:
                class: 'Contao\CoreBundle\Doctrine\DBAL\Types\BinaryStringType'
```

Be sure to add the following configuration key/values to the `config/framework.yaml`
file, leaving the already existing lines there.

```yaml
framework:
    esi: { enabled: true }

    csrf_protection: ~
    lock: ~

    fragments: { path: /_fragment }

    cache:

    profiler:
        only_master_requests: true
```

Depending on the language of your choice, change the default and fallback language to e.g. `de`, so the install tool comes
up translated in German. In order to do so, change `en` to `de` in `config/translation.yaml`.


```yaml
framework:
    default_locale: de
    translator:
        fallbacks:
            - de
```

Contao relies heavily on the security component of Symfony, which needs to be
configured accordingly. Replace the contents of the file `config/security.yaml`
with the following lines.

```yaml
security:
    providers:
        contao.security.user_provider:
            id: contao.security.user_provider

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt|error)|css|images|js)/
            security: false

        install:
            pattern: ^/(contao/install|install\.php)
            security: false

        backend:
            request_matcher: contao.routing.backend_matcher
            stateless: true
            simple_preauth:
                authenticator: contao.security.authenticator

        frontend:
            request_matcher: contao.routing.frontend_matcher
            stateless: true
            simple_preauth:
                authenticator: contao.security.authenticator
```

You can now start a local server and open up the installation tool in your browser.
For example, if you're using the [Symfony binary](https://symfony.com/doc/current/setup/symfony_server.html), start the server like this:

```
$ symfony serve
```

Point your browser to the installation tool (for example https://localhost:8000/contao/install)
and follow the usual installation procedure.


## Enable Cache and Front End Preview

At this point you have set up a working Symfony application and added the Contao
Core Bundle. A few last steps are required to properly set up the caching and
the front end preview.

First, we need to configure the `FOSHttpCacheBundle`. To do so, create (or edit
if the file already exists) the file `config/fos_http_cache.yaml` and add the following entries:

```yaml
# FOS HttpCache configuration
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

declare(strict_types=1);

use App\HttpKernel\AppKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\TerminableInterface;

// Disable the phar stream wrapper for security reasons (see #105)
if (in_array('phar', stream_get_wrappers(), true)) {
    stream_wrapper_unregister('phar');
}

require dirname(__DIR__) . '/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new AppKernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();

if (!$kernel->isDebug()) {
    $cache = $kernel->getHttpCache();

    // Enable the Symfony reverse proxy if request has no surrogate capability
    if (null !== $cache->getSurrogate() && !$cache->getSurrogate()->hasSurrogateCapability($request)) {
        $kernel = $cache;
    }
}

$response = $kernel->handle($request);
$response->send();

if ($kernel instanceof TerminableInterface) {
    $kernel->terminate($request, $response);
}
```

The front end preview is an entry script on its own and needs to be placed in
`public/preview.php` containing the following lines:

```php
<?php

declare(strict_types=1);

use App\HttpKernel\AppKernel;
use FOS\HttpCache\TagHeaderFormatter\TagHeaderFormatter;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\TerminableInterface;

// Suppress error messages (see #1422)
@ini_set('display_errors', '0');

// Disable the phar stream wrapper for security reasons (see #105)
if (in_array('phar', stream_get_wrappers(), true)) {
    stream_wrapper_unregister('phar');
}

require dirname(__DIR__) . '/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
    Debug::enable();
}

$kernel = new AppKernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);

// Force no-cache on all responses in the preview front controller
$response->headers->set('Cache-Control', 'no-store');

// Strip all tag headers from the response
$response->headers->remove(TagHeaderFormatter::DEFAULT_HEADER_NAME);
$response->send();

if ($kernel instanceof TerminableInterface) {
    $kernel->terminate($request, $response);
}
```

Moreover you need to enable the front end preview by adding the following line
to the `config/packages/contao_core.yaml` (be sure not just overwrite all the lines
but add the needed ones).

```
contao:
    preview_script: '/preview.php'
```

And finally, we need to replace the applications `Kernel`.
Remove `src/Kernel.php` and a new file `src/HttpKernel/AppKernel.php`.

```php
// src/HttpKernel/AppKernel.php

<?php

declare(strict_types=1);

namespace App\HttpKernel;

use Contao\CoreBundle\HttpKernel\Bundle\ContaoModuleBundle;
use FOS\HttpCache\SymfonyCache\HttpCacheProvider;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class AppKernel extends BaseKernel implements HttpCacheProvider
{
    use MicroKernelTrait;

    const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    /**
     * @var AppCache
     */
    private $httpCache;

    public function getCacheDir()
    {
        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return $this->getProjectDir().'/var/log';
    }

    public function registerBundles()
    {
        $contents = require $this->getProjectDir().'/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }

        // Look for Contao 3 style modules in <project-root>/system/modules
        try {
            /** @var array<SplFileInfo> $modules */
            $modules = Finder::create()
                ->directories()
                ->depth(0)
                ->in($this->getProjectDir() . '/system/modules/')
            ;
        } catch (DirectoryNotFoundException $e){
            $modules  = [];
        }

        // Load Contao 3 style modules if available
        /** @var SplFileInfo $module */
        foreach ($modules as $module) {
            yield new ContaoModuleBundle($module->getFilename(), $this->getProjectDir() . '/src');
        }
    }

    public function getHttpCache(): AppCache
    {
        if (null !== $this->httpCache) {
            return $this->httpCache;
        }

        return $this->httpCache = new AppCache($this, $this->getProjectDir() . '/var/cache/prod/http_cache');
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $container->addResource(new FileResource($this->getProjectDir().'/config/bundles.php'));
        // Feel free to remove the "container.autowiring.strict_mode" parameter
        // if you are using symfony/dependency-injection 4.0+ as it's the default behavior
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir().'/config';

        $loader->load($confDir.'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{packages}/'.$this->environment.'/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}_'.$this->environment.self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $confDir = $this->getProjectDir().'/config';

        $routes->import($confDir.'/{routes}/'.$this->environment.'/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}'.self::CONFIG_EXTS, '/', 'glob');
    }
}

```

In the same directory create the file `src/HttpKernel/AppCache.php`.and

```php
// src/HttpKernel/AppCache.php

<?php

declare(strict_types=1);

namespace App\HttpKernel;

use FOS\HttpCache\SymfonyCache\CacheInvalidation;
use FOS\HttpCache\SymfonyCache\EventDispatchingHttpCache;
use FOS\HttpCache\TagHeaderFormatter\TagHeaderFormatter;
use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Terminal42\HeaderReplay\SymfonyCache\HeaderReplaySubscriber;
use Toflar\Psr6HttpCacheStore\Psr6Store;

class AppCache extends HttpCache implements CacheInvalidation
{
    use EventDispatchingHttpCache;

    /**
     * Constructor.
     *
     * @param KernelInterface $kernel
     * @param null            $cacheDir
     */
    public function __construct(KernelInterface $kernel, $cacheDir = null)
    {
        parent::__construct($kernel, $cacheDir);

        $this->addSubscriber(new HeaderReplaySubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(Request $request, $catch = false)
    {
        return parent::fetch($request, $catch);
    }

    /**
     * {@inheritdoc}
     */
    protected function createStore()
    {
        return new Psr6Store([
            'cache_directory' => $this->cacheDir ?: $this->kernel->getCacheDir().'/http_cache',
            'cache_tags_header' => TagHeaderFormatter::DEFAULT_HEADER_NAME,
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

And that's it. You have successfully set up a Symfony application and/or installed
the Contao Core Bundle.

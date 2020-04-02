---
title: "Config"
description: Contao's configuration options.
---


## Contao Bundle Configuration

Contao's configuration options can be reviewed by running the following command:

```bash
$ vendor/bin/contao-console config:dump-reference contao
```

```yaml
# Default configuration for extension with alias: "contao"
contao:
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token
    encryption_key:       '%kernel.secret%'

    # The error reporting level set when the framework is initialized. Defaults to E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED.      
    error_level:          8183

    # Allows to set TL_CONFIG variables, overriding settings stored in localconfig.php. Changes in the Contao back end will not have any effect.
    localconfig:          ~

    # Allows to configure which languages can be used within Contao. Defaults to all languages for which a translation exists.
    locales:

        # Defaults:
        - en
        - cs
        - de
        - es
        - fa
        - fr
        - it
        - ja
        - lv
        - nl
        - pt
        - ru
        - sr
        - zh

    # Whether or not to add the page language to the URL.
    prepend_locale:       false

    # Show customizable, pretty error screens instead of the default PHP error messages.
    pretty_error_screens: false

    # An optional entry point script that bypasses the front end cache for previewing changes (e.g. preview.php).
    preview_script:       ''

    # The folder used by the file manager.
    upload_path:          files
    editable_files:       'css,csv,html,ini,js,json,less,md,scss,svg,svgz,txt,xliff,xml,yml,yaml'
    url_suffix:           .html

    # Absolute path to the web directory. Defaults to %kernel.project_dir%/web.
    web_dir:              '%kernel.project_dir%/web'
    image:

        # Bypass the image cache and always regenerate images when requested. This also disables deferred image resizing.
        bypass_cache:         false
        imagine_options:
            jpeg_quality:         80
            jpeg_sampling_factors:

                # Defaults:
                - 2
                - 1
                - 1
            png_compression_level: ~
            png_compression_filter: ~
            webp_quality:         ~
            webp_lossless:        ~
            interlace:            plane

        # Contao automatically uses an Imagine service out of Gmagick, Imagick and Gd (in this order). Set a service ID here to override.        
        imagine_service:      null

        # Reject uploaded images exceeding the localconfig.gdMaxImgWidth and localconfig.gdMaxImgHeight dimensions.
        reject_large_uploads: false

        # Allows to define image sizes in the configuration file in addition to in the Contao back end.
        sizes:

            # Prototype
            name:
                width:                ~
                height:               ~
                resize_mode:          ~ # One of "crop"; "box"; "proportional"
                zoom:                 ~
                css_class:            ~
                lazy_loading:         ~
                densities:            ~
                sizes:                ~

                # If the output dimensions match the source dimensions, the image will not be processed. Instead, the original file will be used.
                skip_if_dimensions_match: ~

                # Allows to convert one image format to another or to provide additional image formats for an image (e.g. WebP).
                formats:

                    # Examples:
                    jpg:
                        - webp
                        - jpg
                    gif:
                        - png

                    # Prototype
                    source:               []
                items:

                    # Prototype
                    -
                        width:                ~
                        height:               ~
                        resize_mode:          ~ # One of "crop"; "box"; "proportional"
                        zoom:                 ~
                        media:                ~
                        densities:            ~
                        sizes:                ~

        # The target directory for the cached images processed by Contao.
        target_dir:           '%kernel.project_dir%/assets/images'
        valid_extensions:

            # Defaults:
            - jpg
            - jpeg
            - gif
            - png
            - tif
            - tiff
            - bmp
            - svg
            - svgz
            - webp
    security:
        two_factor:
            enforce_backend:      false
    search:

        # The default search indexer, which indexes pages in the database.
        default_indexer:
            enable:               true

        # Enables indexing of protected pages.
        index_protected:      false

        # The search index listener can index valid and delete invalid responses upon every request. You may limit it to one of the features or disable it completely.
        listener:

            # Enables indexing successful responses.
            index:                true

            # Enables deleting unsuccessful responses from the index.
            delete:               true
    crawl:

        # Additional URIs to crawl. By default, only the ones defined in the root pages are crawled.
        additional_uris:      []

        # Allows to configure the default HttpClient options (useful for proxy settings, SSL certificate validation and more).
        default_http_client_options: []
```


## Environment variables for the Contao Managed Edition

{{< version "4.9" >}}

If you use Contao together with the [Contao Managed Edition][Contao_ME], you can use environment variables to influence
the behaviour of the Managed Edition, similar to [Symfony Flex][SymfonyFlex].
The reason why they are environment variables is because these settings affect the setup before the dependency injection
container is even built. Settings like trusted proxies or caching are considered very early in the application boot process
(if it even needs to be booted thanks to the cache) so they cannot be part of the application itself:

* `APP_ENV`

    The `APP_ENV` environment variable can contain either `prod` or `dev`. By default, the Contao Managed Edition runs
    in the `prod` mode, optimizing everything for production. If you want to put your installation in permanent development
    mode to have additional logging and debugging output, set `APP_ENV` to `dev`. Never do this for production sites!
    If you set the environment manually, you will no longer be able to toggle the debug mode from the back end as a
    Contao administrator.
    
* `APP_SECRET`

    The `APP_SECRET` environment variable is required e.g. to generate CSRF tokens. This is a string that should be 
    unique to your application and it's commonly used to add more entropy to security related operations. Its value 
    should be a series of characters, numbers and symbols chosen randomly and the recommended length is around 
    32 characters. As with any other security-related parameter, it is a good practice to change this value from time
    to time. However, keep in mind that changing this value will invalidate all signed URIs and Remember Me cookies. 
    That's why, after changing this value, you should regenerate the application cache and log out all the application
    users. For more information please visit the [Symfony documentation](https://symfony.com/doc/current/reference/configuration/framework.html#secret). 
    
* `DATABASE_URL`

    The database connection information is stored as an environment variable called `DATABASE_URL`. It defines 
    the database user name, database password, host name, port and database name that will be used by your Contao system. 
    The format of this variable is the following: `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`.
    It is used by default for the Doctrine configuration: `doctrine.dbal.url: '%env(DATABASE_URL)%'`.
    
* `TRUSTED_PROXIES`

    When you deploy your application, you may be behind a load balancer or a reverse proxy (e.g. Varnish for caching).
    For the most part, this doesn't cause any problems with the Managed Edition. But, when a request passes through a
    proxy, certain request information is sent using either the standard `Forwarded` header or `X-Forwarded-*` headers.
    For example, instead of reading the `REMOTE_ADDR` header (which will now be the IP address of your reverse proxy),
    the user's true IP will be stored in a standard `Forwarded: for="…"` header or a `X-Forwarded-For` header.
    If you don't configure the Managed Edition to look for these headers, you'll get incorrect information about the
    client's IP address, whether or not the client is connecting via HTTPS, the client's port and the hostname being
    requested. Let's say your load balancer runs on IP `192.0.2.1`. You can trust that IP by setting `TRUSTED_PROXIES` 
    to `192.0.2.1`. You can also trust a whole IP range if you like to: `TRUSTED_PROXIES=192.0.2.0/24`. See the
    [Symfony Documentation on Proxies][SymfonyProxies] for more information.
    
* `TRUSTED_HOSTS`

    The same explanation as for `TRUSTED_PROXIES` and the IP example, also applies to `TRUSTED_HOSTS` when fetching the
    originally sent `Host` HTTP header. You would get the host name of your proxy but if you add your proxy host name
    to the list of trusted proxies, you will get the host name that was requested in the original request:
    `TRUSTED_HOSTS=my.proxy.com`
    
* `COOKIE_WHITELIST`

    This is a special environment variable related to the default caching proxy which is shipped with the Contao Managed
    Edition by default.
    Contao disables any HTTP caching as soon as there is either a `Cookie` or an `Authorization` header present in the
    request. That's because these headers can potentially authenticate a user and thus cause personalized content to
    be generated in which case, we never want to serve any content from the cache.
    However, unfortunately, the web consists of tons of different cookies. Most of which are completely irrelevant to
    the application itself and are only used in JavaScript (although there are better alternatives such as LocalStorage,
    SessionStorage or IndexedDB). You will find that e.g. Google Analytics, Matomo, Facebook etc. all set cookies your
    application (Contao in this case) is not interested in at all. However, because the HTTP cache has to decide whether to
    serve a response from the cache or not before the application is even started, there's no way it can now which cookies
    are relevant and which ones are not.
    So, we have to tell it.
    The Contao Managed Edition ships with a blacklist of cookies that are ignored by default to increase the hit rate
    but if you want to optimize it even more, you can disable the blacklist by providing an explicit whitelist.
    These are the cookies you know are **relevant** to the application and in this case, the cache must be **omitted**.
    By default, Contao only uses the PHP session ID cookie to authenticate users and members, the CSRF cookie to
    protect visitors from CSRF attacks when submitting forms and the trusted devices cookie for two-factor authentication.
    So in most cases, the following configuration will score the maximum cache hits but you may have to allow additional
    cookies of extensions you installed:
    
    `COOKIE_WHITELIST=PHPSESSID,csrf_https-contao_csrf_token,trusted_device`
        
    {{% notice note %}}
The name of the PHP session cookie is configurable through the `php.ini` so you might want to check if it's `PHPSESSID`
for you too. Moreover, the CSRF cookie is different for `http` and `https` for security reasons. If you serve your
website over `http`, note that the cookie name will be `csrf_http-contao_csrf_token`.
However, protecting your users from CSRF attacks but let them submit the form via unsecured `http` connections is
not really a valid use case. 
    {{% /notice %}}

{{% notice info %}}
Some of the environment variables, like `DATABASE_URL` and `APP_SECRET` replace their respective counterparts of the
`config/parameters.yml` and thus you should not use these parameters, if you are using the environment variable instead.
{{% /notice %}}
        

[Contao_ME]: ../../getting-started/initial-setup/managed-edition
[SymfonyFlex]: https://symfony.com/doc/current/setup.html#symfony-flex
[SymfonyProxies]: https://symfony.com/doc/current/deployment/proxies.html

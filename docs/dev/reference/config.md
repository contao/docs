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

    # Absolute path to the web directory. Make sure to use the %kernel.project_dir% parameter for the absolute path prefix.
    web_dir:              '…/web' # Example: %kernel.project_dir%/web

    # Whether or not to prefix URLs with the root page language.
    prepend_locale:       false
    encryption_key:       '%kernel.secret%'
    url_suffix:           .html

    # Folder used by the file manager.
    upload_path:          files

    # Entry point script that bypasses the front end cache for preview features, if necessary. The Contao Managed Edition uses "preview.php" here, but it can be customized for a regular Symfony application.
    preview_script:       ''
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token

    # Enables pretty error screens, for which custom templates can be created.
    pretty_error_screens: false

    # The error reporting level set when the framework is initialized. Defaults to E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED.
    error_level:          8183

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
        - pl
        - ru
        - sl
        - sr
        - zh
    image:

        # When true, images will always be regenerated when requested. This also disables deferred image resizing.
        bypass_cache:         false
        target_path:          null # Deprecated (Use the "contao.image.target_dir" parameter instead.)

        # The target directory for the cached images processed by Contao.
        target_dir:           '…/assets/images'
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

        # Contao automatically detects the best Imagine service out of Gmagick, Imagick and Gd (in this order). To use a specific service, set its service ID here.
        imagine_service:      null
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

        # Allows to reject images uploaded via Contao's file manager, if they exceed the dimensions of localconfig.gdMaxImgWidth and localconfig.gdMaxImgHeight.
        reject_large_uploads: false

        # This allows to define image sizes directly in the configuration in addition to the Contao back end (tl_image_size table).
        sizes:

            # Prototype
            name:
                width:                ~
                height:               ~
                resizeMode:           ~ # One of "crop"; "box"; "proportional"
                zoom:                 ~
                cssClass:             ~
                densities:            ~
                sizes:                ~

                # If the output dimensions match the source dimensions, the image will not be processed. Instead, the original file will be used.
                skipIfDimensionsMatch: ~

                # Allows to convert an image format to another, or to provide additional image formats for an image (e.g. WebP).
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
                        resizeMode:           ~ # One of "crop"; "box"; "proportional"
                        zoom:                 ~
                        media:                ~
                        densities:            ~
                        sizes:                ~
    security:
        two_factor:
            enforce_backend:      false

    # Allows to set TL_CONFIG variables. Note that any property set here will override the localconfig.php file, so changing these in the Contao back end will not have any effect.
    localconfig:          ~
```


## Environment variables for the Contao Managed Edition

If you use Contao together with the [Contao Managed Edition][Contao_ME], you can use environment variables to influence
the behaviour of the Managed Edition.
The reason why they are environment variables is because these settings affect the setup before the dependency injection
container is even built. Settings like trusted proxies or caching are considered very early in the application boot process
(if it even needs to be booted thanks to the cache) so they cannot be part of the application itself:

* `APP_ENV`

    The `APP_ENV` environment variable can contain either `prod` or `dev`. By default, the Contao Managed Edition runs
    in the `prod` mode, optimizing everything for production. If you want to put your installation in permanent development
    mode to have additional logging and debugging output, set `APP_ENV` to `dev`. Never do this for production sites!
    If you set the environment manually, you will no longer be able to toggle the debug mode from the back end as a
    Contao administrator.
    
* `TRUSTED_PROXIES`

    When you deploy your application, you may be behind a load balancer or a reverse proxy (e.g. Varnish for caching).
    For the most part, this doesn't cause any problems with the Managed Edition. But, when a request passes through a
    proxy, certain request information is sent using either the standard `Forwarded` header or `X-Forwarded-*` headers.
    For example, instead of reading the `REMOTE_ADDR` header (which will now be the IP address of your reverse proxy),
    the user's true IP will be stored in a standard `Forwarded: for="..."` header or a `X-Forwarded-For` header.
    If you don't configure the Managed Edition to look for these headers, you'll get incorrect information about the
    client's IP address, whether or not the client is connecting via HTTPS, the client's port and the hostname being
    requested.
    Let's say your load balancer runs on IP `192.0.2.1`. You can trust that IP by setting `TRUSTED_PROXIES` to `192.0.2.1`.
    You can also trust a whole IP range if you like to: `TRUSTED_PROXIES=192.0.2.0/24`
    
* `TRUSTED_HOSTS`

    The same explanation as for `TRUSTED_PROXIES` and the IP example, also applies to `TRUSTED_HOSTS` when fetching the
    originally sent `Host` HTTP header. You would get the host name of your proxy but if you add your proxy host name
    to the list of trusted proxies, you will get the host name that was requested in the original request:
    `TRUSTED_HOSTS=my.proxy.com`
    
* `COOKIE_WHITELIST`

    {{< version "4.8" >}}

    This is a special environment variable related to the default caching proxy which is shipped with the Contao Managed
    Edition by default.
    Contao disables any HTTP caching as soon as there is either a `Cookie` or an `Authorization` header present in the
    request. That's because these headers can potentially authenticate a user and thus cause personalized content to
    be generated in which case, we never want to serve any content from the cache.
    However, unfortunately, the web consists of tons of different cookies. Most of which are completely irrelevant to
    the application itself an are only used in JavaScript (although there are better alternatives such as LocalStorage,
    SessionStorage or IndexedDB). You will find that e.g. Google Analytics, Matomo, Facebook etc. all set cookies your
    application (Contao in this case) is not interested in at all. However, because the HTTP cache has to decide whether to
    serve a response from the cache or not before the application is even started, there's no way it can now which cookies
    are relevant and which ones are not.
    So, we have to tell it.
    The Contao Managed Edition ships with a blacklist of cookies that are ignored by default to increase the hit rate
    but if you want to optimize it even more, you can disable the blacklist by providing an explicit whitelist.
    These are the cookies you know are **relevant** to the application and in this case, the cache must be **omitted**.
    By default, Contao only uses the PHP session ID cookie to authenticate users and members plus the CSRF cookie to
    protect visitors from CSRF attacks when submitting forms.
    So in most cases, the following configuration will score the maximum cache hits but you may have to allow additional
    cookies of extensions you installed:
    
    `COOKIE_WHITELIST=PHPSESSID,csrf_https-contao_csrf_token`
        
    {{% notice note %}}
The name of the PHP session cookie is configurable through the `php.ini` so you might want to check if it's `PHPSESSID`
for you too. Moreover, the CSRF cookie is different for `http` and `https` for security reasons. If you serve your
website over `http`, note that the cookie name will be `csrf_http-contao_csrf_token`.
However, protecting your users from CSRF attacks but let them submit the form via unsecured `http` connections is
not really a valid use case. 
    {{% /notice %}}
        

[Contao_ME]: ../../getting-started/initial-setup/managed-edition

---
title: "Config"
description: Contao's configuration options.
---


## Contao Bundle Configuration

Contao's configuration options can be reviewed by running the following command:

```bash
$ vendor/bin/contao-console config:dump-reference contao
```

The following is a dump of the configuration reference.

{{< tabs groupid="bundle-config" style="code" >}}
{{% tab title="Contao 5" %}}
```yaml
# Default configuration for extension with alias: "contao"
contao:
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token

    # The error reporting level set when the framework is initialized. Defaults to E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED.
    error_level:          8183
    intl:

        # Adds, removes or overwrites the list of ICU locale IDs. Defaults to all locale IDs known to the system.
        locales:

            # Examples:
            - +de
            - '-de_AT'
            - gsw_CH

        # Adds, removes or overwrites the list of enabled locale IDs that can be used in the Backend for example. Defaults to all languages for which a translation exists.
        enabled_locales:

            # Examples:
            - +de
            - '-de_AT'
            - gsw_CH

        # Adds, removes or overwrites the list of ISO 3166-1 alpha-2 country codes.
        countries:

            # Examples:
            - +DE
            - '-AT'
            - CH

    # Allows to set TL_CONFIG variables, overriding settings stored in localconfig.php. Changes in the Contao back end will not have any effect.
    localconfig:          ~

    # Allows to configure which languages can be used in the Contao back end. Defaults to all languages for which a translation exists.
    locales:              [] # Deprecated (Since contao/core-bundle 4.12: Using contao.locales is deprecated. Please use contao.intl.enabled_locales instead.)

    # Show customizable, pretty error screens instead of the default PHP error messages.
    pretty_error_screens: false

    # An optional entry point script that bypasses the front end cache for previewing changes (e.g. "/preview.php").
    preview_script:       ''

    # The folder used by the file manager.
    upload_path:          files
    editable_files:       'css,csv,html,ini,js,json,less,md,scss,svg,svgz,ts,txt,xliff,xml,yml,yaml'

    # Absolute path to the web directory. Defaults to %kernel.project_dir%/public.
    web_dir:              public # Deprecated (Since contao/core-bundle 4.13: Setting the web directory in a config file is deprecated. Use the "extra.public-dir" config key in your root composer.json instead.)

    # The path to the Symfony console. Defaults to %kernel.project_dir%/bin/console.
    console_path:         '%kernel.project_dir%/bin/console'

    # Allows to define Symfony Messenger workers (messenger:consume). Workers are started every minute using the Contao cron job framework.
    messenger:
        # Contao provides a way to work on Messenger transports in the web process (kernel.terminate) if there is no real "messenger:consume" worker. You can configure its behavior here.'
        web_worker:

          # The transports to apply the web worker logic to.
          transports:     []
          grace_period:   PT10M # Must be a valid string for \DateInterval()

        workers:

            # Prototype
            -

                # The transports/receivers you would like to consume from.
                transports:

                    # Examples:
                    - foobar_transport
                    - foobar2_transport

                # messenger:consume options. Make sure to always include "--time-limit=60".
                options:

                    # Default:
                    - --time-limit=60

                    # Examples:
                    - '--sleep=5'
                    - '--time-limit=60'

                # Enables autoscaling.
                autoscale:
                    enabled:              false

                    # Contao will automatically autoscale the number of workers to meet this queue size. Logic: desiredWorkers = ceil(currentSize / desiredSize)
                    desired_size:         ~ # Required

                    # Contao will never scale down to less than this configured number of workers.
                    min:                  1

                    # Contao will never scale up to more than this configured number of workers.
                    max:                  ~ # Required
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
            avif_quality:         ~
            avif_lossless:        ~
            heic_quality:         ~
            heic_lossless:        ~
            jxl_quality:          ~
            jxl_lossless:         ~

            # Allows to disable the layer flattening of animated images. Set this option to false to support animations. It has no effect with Gd as Imagine service.
            flatten:              ~

            # One of the Imagine\Image\ImageInterface::INTERLACE_* constants.
            interlace:            plane

            # Filter used when downsampling images. One of the Imagine\Image\ImageInterface::FILTER_* constants. It has no effect with Gd or SVG as Imagine service.
            resampling-filter:    ~

        # Contao automatically uses an Imagine service out of Gmagick, Imagick and Gd (in this order). Set a service ID here to override.
        imagine_service:      null

        # Reject uploaded images exceeding the localconfig.imageWidth and localconfig.imageHeight dimensions.
        reject_large_uploads: false

        # Allows to define image sizes in the configuration file in addition to in the Contao back end. Use the special name "_defaults" to preset values for all sizes of the configuration file.
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
                    jpg:                 [jxl, webp, jpg]
                    gif:                 [avif, png]

                    # Prototype
                    source:               []

                # Which metadata fields to preserve when resizing images.
                preserve_metadata_fields:

                    # Examples:
                    exif:                { IFD0: [Copyright, Artist] }
                    iptc:                ['2#116', '2#080', '2#115', '2#110']

                    # Prototype
                    format:               []
                imagine_options:
                    jpeg_quality:         ~
                    jpeg_sampling_factors: []
                    png_compression_level: ~
                    png_compression_filter: ~
                    webp_quality:         ~
                    webp_lossless:        ~
                    avif_quality:         ~
                    avif_lossless:        ~
                    heic_quality:         ~
                    heic_lossless:        ~
                    jxl_quality:          ~
                    jxl_lossless:         ~

                    # Allows to disable the layer flattening of animated images. Set this option to false to support animations. It has no effect with Gd as Imagine service.
                    flatten:              ~
                    interlace:            ~
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
                        resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.items.resizeMode is deprecated. Please use contao.image.sizes.*.items.resize_mode instead.)
                resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.resizeMode is deprecated. Please use contao.image.sizes.*.resize_mode instead.)
                cssClass:             ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.cssClass is deprecated. Please use contao.image.sizes.*.css_class instead.)
                lazyLoading:          ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.lazyLoading is deprecated. Please use contao.image.sizes.*.lazy_loading instead.)
                skipIfDimensionsMatch: ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.skipIfDimensionsMatch is deprecated. Please use contao.image.sizes.*.skip_if_dimensions_match instead.)

        # The target directory for the cached images processed by Contao.
        target_dir:           '%kernel.project_dir%/assets/images' # Example: '%kernel.project_dir%/assets/images'
        target_path:          null # Deprecated (Since contao/core-bundle 4.9: Use the "contao.image.target_dir" parameter instead.)
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
            - avif
        preview:

            # The target directory for the cached previews.
            target_dir:           '%kernel.project_dir%/assets/previews' # Example: '%kernel.project_dir%/assets/previews'
            default_size:         512
            max_size:             1024

            # Whether or not to generate previews for unsupported file types that show a file icon containing the file type.
            enable_fallback_images: true

        # Which metadata fields to preserve when resizing images.
        preserve_metadata_fields:

            # Examples:
            exif:                { IFD0: [Copyright, Artist] }
            iptc:                ['2#116', '2#080', '2#115', '2#110']

            # Prototype
            format:               []
    security:
        two_factor:
            enforce_backend:      false

        # Enables sending the HTTP Strict Transport Security (HSTS) header for secure requests.
        hsts:
            enabled:              true
            ttl:                  31536000
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
    mailer:

        # Specifies the mailer transports available for selection within Contao.
        transports:

            # Prototype
            name:

                # Overrides the "From" address for any e-mails sent with this mailer transport.
                from:                 null
    backend:

        # Adds HTML attributes to the <body> tag in the back end.
        attributes:

            # Examples:
            app-name:            'My App'
            app-version:         1.2.3

            # Prototype
            name:                 ~

        # Adds custom style sheets to the back end.
        custom_css:

            # Example:
            - files/backend/custom.css

        # Adds custom JavaScript files to the back end.
        custom_js:

            # Example:
            - files/backend/custom.js

        # Configures the title of the badge in the back end and the Contao Manager.
        badge_title:          '' # Example: develop

        # Defines the path of the Contao backend.
        route_prefix:         /contao # Example: /admin

        # The number of concurrent requests that are executed. Defaults to 5.
        crawl_concurrency:    5
    insert_tags:

        # A list of allowed insert tags.
        allowed_tags:

            # Default:
            - *

            # Examples:
            - '*_url'
            - request_token
    backup:

        # These tables are ignored by default when creating and restoring backups.
        ignore_tables:

            # Defaults:
            - tl_crawl_queue
            - tl_log
            - tl_search
            - tl_search_index
            - tl_search_term

        # The maximum number of backups to keep. Use 0 to keep all the backups forever.
        keep_max:             5

        # The latest backup plus the oldest of every configured interval will be kept. Intervals have to be specified as documented in https://www.php.net/manual/en/dateinterval.construct.php without the P prefix.
        keep_intervals:

            # Defaults:
            - 1D
            - 7D
            - 14D
            - 1M
    sanitizer:
        allowed_url_protocols:

            # Defaults:
            - http
            - https
            - ftp
            - mailto
            - tel
            - data
            - skype
            - whatsapp
    cron:

        # Allows to enable or disable the kernel.terminate listener that executes cron jobs within the web process. "auto" will auto-disable it if a CLI cron is running.
        web_listener:         auto # One of "auto"; true; false
    csp:

        # Contao provides an "csp_inline_styles" Twig filter which is able to automatically generate CSP hashes for inline style attributes of WYSIWYG editors. For security reasons, the supported properties and their regex value have to be specified here.
        allowed_inline_styles:

            # Prototype
            property:             ~

        # Do not increase this value beyond the allowed response header size of your web server, as this will result in a 500 server error.
        max_header_size:      3072
```
{{% /tab %}}
{{% tab title="Contao 4" %}}
```yaml
# Default configuration for extension with alias: "contao"
contao:
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token
    encryption_key:       '%kernel.secret%'

    # The error reporting level set when the framework is initialized. Defaults to E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED.
    error_level:          8183
    intl:

        # Adds, removes or overwrites the list of ICU locale IDs. Defaults to all locale IDs known to the system.
        locales:

            # Examples:
            - +de
            - '-de_AT'
            - gsw_CH

        # Adds, removes or overwrites the list of enabled locale IDs that can be used in the Backend for example. Defaults to all languages for which a translation exists.
        enabled_locales:

            # Examples:
            - +de
            - '-de_AT'
            - gsw_CH

        # Adds, removes or overwrites the list of ISO 3166-1 alpha-2 country codes.
        countries:

            # Examples:
            - +DE
            - '-AT'
            - CH

    # Disabling legacy routing allows to configure the URL prefix and suffix per root page. However, it might not be compatible with third-party extensions.
    legacy_routing:       true

    # Allows to set TL_CONFIG variables, overriding settings stored in localconfig.php. Changes in the Contao back end will not have any effect.
    localconfig:          ~

    # Allows to configure which languages can be used in the Contao back end. Defaults to all languages for which a translation exists.
    locales:              [] # Deprecated (Since contao/core-bundle 4.12: Using contao.locales is deprecated. Please use contao.intl.enabled_locales instead.)

    # Whether or not to add the page language to the URL.
    prepend_locale:       false # Deprecated (Since contao/core-bundle 4.10: The URL prefix is configured per root page since Contao 4.10. Using this option requires legacy routing.)

    # Show customizable, pretty error screens instead of the default PHP error messages.
    pretty_error_screens: false

    # An optional entry point script that bypasses the front end cache for previewing changes (e.g. "/preview.php").
    preview_script:       ''

    # The folder used by the file manager.
    upload_path:          files
    editable_files:       'css,csv,html,ini,js,json,less,md,scss,svg,svgz,ts,txt,xliff,xml,yml,yaml'
    url_suffix:           .html # Deprecated (Since contao/core-bundle 4.10: The URL suffix is configured per root page since Contao 4.10. Using this option requires legacy routing.)

    # Absolute path to the web directory. Defaults to %kernel.project_dir%/public.
    web_dir:              '%kernel.project_dir%/public' # Deprecated (Since contao/core-bundle 4.13: Setting the web directory in a config file is deprecated. Use the "extra.public-dir" config key in your root composer.json instead.)
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
            avif_quality:         ~
            avif_lossless:        ~
            heic_quality:         ~
            heic_lossless:        ~
            jxl_quality:          ~
            jxl_lossless:         ~

            # Allows to disable the layer flattening of animated images. Set this option to false to support animations. It has no effect with Gd as Imagine service.
            flatten:              ~

            # One of the Imagine\Image\ImageInterface::INTERLACE_* constants.
            interlace:            plane

            # Filter used when downsampling images. One of the Imagine\Image\ImageInterface::FILTER_* constants. It has no effect with Gd or SVG as Imagine service.
            resampling-filter:    ~

        # Contao automatically uses an Imagine service out of Gmagick, Imagick and Gd (in this order). Set a service ID here to override.
        imagine_service:      null

        # Reject uploaded images exceeding the localconfig.gdMaxImgWidth and localconfig.gdMaxImgHeight dimensions.
        reject_large_uploads: false

        # Allows to define image sizes in the configuration file in addition to in the Contao back end. Use the special name "_defaults" to preset values for all sizes of the configuration file.
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
                    jpg:                 [jxl, webp, jpg]
                    gif:                 [avif, png]

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
                        resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.items.resizeMode is deprecated. Please use contao.image.sizes.*.items.resize_mode instead.)
                resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.resizeMode is deprecated. Please use contao.image.sizes.*.resize_mode instead.)
                cssClass:             ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.cssClass is deprecated. Please use contao.image.sizes.*.css_class instead.)
                lazyLoading:          ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.lazyLoading is deprecated. Please use contao.image.sizes.*.lazy_loading instead.)
                skipIfDimensionsMatch: ~ # Deprecated (Since contao/core-bundle 4.9: Using contao.image.sizes.*.skipIfDimensionsMatch is deprecated. Please use contao.image.sizes.*.skip_if_dimensions_match instead.)

        # The target directory for the cached images processed by Contao.
        target_dir:           '%kernel.project_dir%/assets/images' # Example: '%kernel.project_dir%/assets/images'
        target_path:          null # Deprecated (Since contao/core-bundle 4.9: Use the "contao.image.target_dir" parameter instead.)
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
        preview:

            # The target directory for the cached previews.
            target_dir:           '%kernel.project_dir%/assets/previews' # Example: '%kernel.project_dir%/assets/previews'
            default_size:         512
            max_size:             1024

            # Whether or not to generate previews for unsupported file types that show a file icon containing the file type.
            enable_fallback_images: true
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
    mailer:

        # Specifies the mailer transports available for selection within Contao.
        transports:

            # Prototype
            name:

                # Overrides the "From" address for any e-mails sent with this mailer transport.
                from:                 null
    backend:

        # Adds HTML attributes to the <body> tag in the back end.
        attributes:

            # Examples:
            app-name:            'My App'
            app-version:         1.2.3

            # Prototype
            name:                 ~

        # Adds custom style sheets to the back end.
        custom_css:

            # Example:
            - files/backend/custom.css

        # Adds custom JavaScript files to the back end.
        custom_js:

            # Example:
            - files/backend/custom.js

        # Configures the title of the badge in the back end and the Contao Manager.
        badge_title:          '' # Example: develop

        # Defines the path of the Contao backend.
        route_prefix:         /contao # Example: /admin
    insert_tags:

        # A list of allowed insert tags.
        allowed_tags:

            # Default:
            - *

            # Examples:
            - '*_url'
            - request_token
    backup:

        # These tables are ignored by default when creating and restoring backups.
        ignore_tables:

            # Defaults:
            - tl_crawl_queue
            - tl_log
            - tl_search
            - tl_search_index
            - tl_search_term

        # The maximum number of backups to keep. Use 0 to keep all the backups forever.
        keep_max:             5

        # The latest backup plus the oldest of every configured interval will be kept. Intervals have to be specified as documented in https://www.php.net/manual/en/dateinterval.construct.php without the P prefix.
        keep_intervals:

            # Defaults:
            - 1D
            - 7D
            - 14D
            - 1M
    sanitizer:
        allowed_url_protocols:

            # Defaults:
            - http
            - https
            - ftp
            - mailto
            - tel
            - data
            - skype
            - whatsapp
```
{{% /tab %}}
{{< /tabs >}}


## Environment variables for the Contao Managed Edition

{{< version "4.9" >}}

If you use Contao together with the [Contao Managed Edition][Contao_ME], you can use environment variables to influence
the behaviour of the Managed Edition, similar to [Symfony Flex][SymfonyFlex].
The reason why they are environment variables is because these settings affect the setup before the dependency injection
container is even built. Settings like trusted proxies or caching are considered very early in the application boot process
(if it even needs to be booted thanks to the cache) so they cannot be part of the application itself.

{{% notice note %}}
Some of the environment variables, like `APP_SECRET`, `DATABASE_URL` and `MAILER_DSN` replace their respective counterparts 
of the `config/parameters.yaml` and thus you should not use these parameters, if you are using the environment variable instead.
{{% /notice %}}


### `APP_ENV`

The `APP_ENV` environment variable can contain either `prod` or `dev`. By default, the Contao Managed Edition runs
in the `prod` mode, optimizing everything for production. If you want to put your installation in permanent development
mode to have additional logging and debugging output, set `APP_ENV` to `dev`. Never do this for production sites!
If you set the environment manually, you will no longer be able to toggle the debug mode from the back end as a
Contao administrator.
    

### `APP_SECRET`

The `APP_SECRET` environment variable is required e.g. to generate CSRF tokens. This is a string that should be 
unique to your application and it's commonly used to add more entropy to security related operations. Its value 
should be a series of characters, numbers and symbols chosen randomly and the recommended length is around 
32 characters. As with any other security-related parameter, it is a good practice to change this value from time
to time. However, keep in mind that changing this value will invalidate all signed URIs and Remember Me cookies. 
That is why, after changing this value, you should regenerate the application cache and log out all the application
users. For more information please visit the [Symfony documentation](https://symfony.com/doc/current/reference/configuration/framework.html#secret).


### `DISABLE_HTTP_CACHE`

The `DISABLE_HTTP_CACHE` environment variable allows you to disable the default caching proxy that is shipped with the
Contao Managed Edition. Note that if you set this to `true`, none of the following environment variables will have any
effect anymore as they are designed to configure said proxy that you have just disabled:

* `COOKIE_ALLOW_LIST`
* `COOKIE_REMOVE_FROM_DENY_LIST`
* `QUERY_PARAMS_ALLOW_LIST`
* `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`


### `COOKIE_ALLOW_LIST`

{{% notice note %}}
In Contao **4.9** this environment variable is called `COOKIE_WHITELIST`.
{{% /notice %}}

This is a special environment variable related to the default caching proxy which is shipped with the Contao Managed
Edition by default.
Contao disables any HTTP caching as soon as there is either a `Cookie` or an `Authorization` header present in the
request. That is because these headers can potentially authenticate a user and thus cause personalized content to
be generated in which case, we never want to serve any content from the cache.
However, unfortunately, the web consists of tons of different cookies. Most of which are completely irrelevant to
the application itself and are only used in JavaScript (although there are better alternatives such as LocalStorage,
SessionStorage or IndexedDB). You will find that e.g. Google Analytics, Matomo, Facebook etc. all set cookies your
application (Contao in this case) is not interested in at all. However, because the HTTP cache has to decide whether to
serve a response from the cache or not before the application is even started, there's no way it can know which cookies
are relevant and which ones are not.
So, we have to tell it.
The Contao Managed Edition ships with a list of irrelevant cookies that are ignored by default to increase the hit rate
but if you want to optimize it even more, you can disable the default list by providing an explicit list of cookies
you need.
These are the cookies you know are **relevant** to the application and in this case, the cache must be **omitted**.
By default, Contao only uses the PHP session ID cookie to authenticate users and members, the CSRF cookie to
protect visitors from CSRF attacks when submitting forms, the trusted devices cookie for two-factor authentication and
the remember me cookie to automatically log in users if desired.
So in most cases, the following configuration will score the maximum cache hits but you may have to allow additional
cookies of extensions you installed:

```
COOKIE_ALLOW_LIST=PHPSESSID,csrf_https-contao_csrf_token,csrf_contao_csrf_token,trusted_device,REMEMBERME
```
    
{{% notice info %}}
The name of the PHP session cookie is configurable through the `php.ini` so you might want to check if it's `PHPSESSID`
for you too. Moreover, the CSRF cookie is different for `http` and `https` for security reasons. If you serve your
website over `http`, note that the cookie name will be `csrf_http-contao_csrf_token`.
However, protecting your users from CSRF attacks but let them submit the form via unsecured `http` connections is
not really a valid use case. 
{{% /notice %}}

### `COOKIE_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

In case you don't want to manage the whole `COOKIE_ALLOW_LIST` because you are unsure what your application needs but
you want to disable one or more of the existing entries on the deny list that is managed by Contao, you can specify this
using:

```
COOKIE_REMOVE_FROM_DENY_LIST=__utm.+,AMP_TOKEN
```

### `QUERY_PARAMS_ALLOW_LIST`

{{< version "4.10" >}}

For the very same reason we strip irrelevant cookies, we also strip irrelevant query parameters. E.g. you might be
familiar with the typical `?utm_*>=<randomtoken>` query parameters that are added to links of your website. Because they
change the URL every single time, they also generate new cache entries every single time, eventually maybe even flooding
your cache.

As with the irrelevant cookies, Contao also manages a list of irrelevant query parameters which again, you may completely
override by providing a list of allowed query parameters if you know all the query parameters your application ever
needs. This is highly unlikely which is why there is also `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`.

### `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

As with `COOKIE_REMOVE_FROM_DENY_LIST`, you can use `QUERY_PARAMS_REMOVE_FROM_DENY_LIST` to remove an entry from the
default deny list shipped with Contao. If you e.g. need the Facebook click identifier (`fbclid`) in your server side
code, you may update your list like so:

```
QUERY_PARAMS_REMOVE_FROM_DENY_LIST=fbclid
```

{{% notice warning %}}
If you do so, make sure to disable caching by e.g. setting `Cache-Control: no-store` on this response if `fbclid` is
present as otherwise you are back to having thousands of cache entries in your cache proxy.
{{% /notice %}}

### `DATABASE_URL`

The database connection information is stored as an environment variable called `DATABASE_URL`. It defines 
the database user name, database password, host name, port and database name that will be used by your Contao system. 
The format of this variable is the following: `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`.
It is used by default for the Doctrine configuration: `doctrine.dbal.url: '%env(DATABASE_URL)%'`.


### `MAILER_DSN`

The mailer connection information is stored as an environment variable called `MAILER_DSN`. It defines the transport to
be used for sending emails, as well as the login credentials, host name and port for an SMTP server for example, if 
applicable. The format of this variable is the following: `MAILER_DSN=smtp://username:password@smtp.example.com:465?encryption=ssl`.
See the [Symfony Swiftmailer Bundle Documentation][SymfonySwiftmailer] for more information.

{{% notice info %}}
The variable was previously called `MAILER_URL`. Since Contao 5.0 only `MAILER_DSN` will be supported.
{{% /notice %}}
    

### `TRUSTED_PROXIES`

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
    

### `TRUSTED_HOSTS`

The same explanation as for `TRUSTED_PROXIES` and the IP example, also applies to `TRUSTED_HOSTS` when fetching the
originally sent `Host` HTTP header. You would get the host name of your proxy but if you add your proxy host name
to the list of trusted proxies, you will get the host name that was requested in the original request:
`TRUSTED_HOSTS=my.proxy.com`
        

### `DNS_MAPPING`

{{< version "5.3" >}}

When creating a website in Contao you define the website's domain in the website root's settings - or in each website
root respectively in a multi-domain setup. In order to not have to manually change the domain every time you copy the
database from or to different hosting environments (for example from live to your local environment) you can use the `DNS_MAPPING` environment variable:

```env
# .env.local in your local environment
DNS_MAPPING='{
    "www.example.com": "example.local",
    "www.foobar.org": "foobar.local",
    "www.lorem.at": "lorem.local"
}'
```

```env
# .env.local in your staging environment
DNS_MAPPING='{
    "www.example.com": "staging.example.com",
    "www.foobar.org": "staging.foobar.org",
    "www.lorem.at": "staging.lorem.at"
}'
```

After executing the `contao:migrate` console command this will automatically change the domains in the database according to the mapping in the respective environment.

You can also migrate the `useSSL` setting to different settings in the respective environment, which might be
useful if you haven't set up an SSL certificate in your local development environment.

```env
DNS_MAPPING='{
    "www.example.com": "http://example.local",
    "www.foobar.org": "http://foobar.local",
    "www.lorem.at": "http://lorem.local"
}'
```

This also works if you do not use a `dns` name in some of your website roots (although that is not a recommended setup).

```.env
DNS_MAPPING='{
    "": "http://",
    "www.foobar.org": "http://foobar.local",
    "www.lorem.at": "http://lorem.local"
}'
```

```.env
DNS_MAPPING='{
    "": "example.local",
    "www.foobar.org": "foobar.local",
    "www.lorem.at": "lorem.local"
}'
```

Instead of the environment variable, you can also directly set the parameter in your `parameters.yaml`, if you prefer:

```yaml
parameters:
    contao.dns_mapping:
        www.example.com: http://example.local
        www.foobar.org: http://foobar.local
        www.lorem.at: http://lorem.local
```


[Contao_ME]: ../../getting-started/initial-setup/managed-edition
[SymfonyFlex]: https://symfony.com/doc/current/setup.html#symfony-flex
[SymfonyProxies]: https://symfony.com/doc/current/deployment/proxies.html
[SymfonySwiftmailer]: https://symfony.com/doc/4.4/reference/configuration/swiftmailer.html

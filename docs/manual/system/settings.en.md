---
title: Settings
aliases:
    - /en/system/settings/
weight: 10
---

The system settings slowly but surely leave the backend. Basic system settings influence Contao as an application and 
therefore there is a chance that a wrong setting will render the system non-functional. If this happens, you will not 
be able to undo the settings and restore the system because you will not be able to log in anymore. For this reason, 
most settings are configured outside of Contao via the `config.yaml`, or can be configured via the Contao Manager in the future.


## Settings


### Global configuration

**E-mail address of the system administrator:** This is the address to which notifications about e.g. locked accounts or 
newly registered users are sent. You can also use the following notation to add a name to the email address:

```text
Kevin Jones [kevin.jones@example.com]
```


### Date and time

**Date and time format:** All date and time formats must be entered as used with the PHP 
[date](https://www.php.net/manual/de/function.date.php) function. Contao processes only numeric formats in the backend, 
i.e. the letters j, d, m, n, y, Y, g, G, h, H, i and s.

Here are some examples of valid date and time specifications:

| Information | Explanation |
| ----------- | ----------- |
| Y-m-d | YYYY-MM-DD, international ISO-8601, for example `2005-01-28` |
| m/d/Y | MM/DD/YYYY, English format, for example `01/28/2005` |
| d.m.Y | DD.MM.YYYY, German format, for example `28.01.2005` |
| y-n-j | YY-M-D, without leading zeros, e.g. `05-1-28` |
| Ymd | YYYYMMDD, Unix timestamp, for example `20050128` |
| H:i:s | 24 hours, minutes and seconds, e.g. `20:36:59` |
| g:i | 12 hours without leading zeros and minutes, e.g. `8:36` |

**Time zone:** You should set the timezone before you create your website because Contao stores all dates as 
[Unix timestamps](https://www.php.net/time) and Contao will not adjust these, if the timezone is changed.


### Back end configuration

**Do not collapse elements:** In the "Parent View", Contao displays the elements in a shortened form for clarity 
reasons. Individual elements can be unfolded using a navigation icon if needed. Select this option to disable the 
feature completely.

**Items per page:** In the [Listing Records](/en/administration-area/list-data-records/#sort-and-filter-records) 
section, you learned that Contao limits the number of records per page to 30 by default. You can change this value here. 
Higher values mean a longer loading time.

**Maximum items per page:** To prevent an inexperienced user from displaying 5000 records at once and thus 
exceeding the PHP memory limit, you can specify the maximum number of records that can be displayed per page.

#### Additional back end settings:

{{< version "4.11" >}}

Some additional parameters can be configured via the `config/config.yaml`.

| Key | Description |
| --- | --- |
| `attributes` | Adds HTML attributes to the `<body>` tag in the back end. The attribute name must be a valid HTML attribute name - it is automatically prefixed with `data-`. |
| `custom_css` | Adds custom style sheets to the back end. The assets must be publicly accessible via URL! |
| `custom_js` | Adds custom JavaScript files to the back end. The assets must be publicly accessible via URL! |
| `badge_title` | Configures the title of the badge in the back end. |
| `route_prefix` | {{< version-tag "4.13" >}} Configures the path to the Contao back end, e.g., `/admin` instead of `/contao`. |

The following config defines some example values: 

```yaml
# config/config.yaml
contao:
    backend:
        attributes:
            app-name: 'My App'
            app-version: 1.2.3
        custom_css:
            - files/backend/custom.css
        custom_js:
            - files/backend/custom.js
        badge_title: develop
        route_prefix: '/admin'
```

### Front end configuration

{{% notice note %}}
Starting with version **4.10** this setting can be changed in the settings of the website root instead:
{{% /notice %}}

**Enable folder URLs:** Here you can activate folder structures in page aliases. This will add the aliases that exist in 
the page hierarchy to the alias, e.g. the page "Download" in the page path "Docs &gt; Install" will use the alias 
`docs/install/download.html` instead of just `download.html`.

{{% notice note %}}
This setting does not exist anymore in Contao **4.10** and higher:
{{% /notice %}}

**Do not redirect empty URLs:** Allows you to disable the redirect of the "empty URL" to the start page of the browser's 
language respective website root when using the [legacy routing mode][LegacyRouting] without `contao.prepend_locale: true` 
*(not recommended)*.


### Security settings

**Disable request tokens:** Here you can activate that the request tokens are not checked when submitting a form 
*(insecure!)*.

**Allowed HTML tags:** By default, Contao does not allow HTML tags in forms and removes them automatically when saving. 
For input fields where the use of HTML is desired, you can specify a list of allowed HTML tags here.

{{< version-tag "4.11.7, 4.9.18 and 4.4.56" >}} **Allowed HTML attributes:** You can extend the list of allowed HTML attributes for input fields here. If an HTML 
attribute is not present in the list, it will be automatically removed when saving. The tag or attribute name * stands for 
all tags or attributes. For attributes with hyphens, placeholders such as data-* can be used.

**Password hash:** By default, Contao uses the defaut of the current PHP version, but you can also set a value. This 
is necessary if you want to sync the password to another system like LDAP.

The following configuration defines some example values:

```yaml
# config/config.yaml
security:
  password_hashers:
      Contao\User: 'auto' # Hash function: bcrypt, sha256, sha512 ...
```


**Examples:**  
`<iframe>` is not present in the allowed HTML tags, but can easily be inserted under key.

{{% notice note %}}  
In order to better recognise the HTML tags added by the user, these should be entered at the beginning of the list.
{{% /notice %}}  

In the permitted HTML attributes, the attribute must then also be inserted as a value for this.    

`<nav>` and `<input>` are, for example, already present in the permitted HTML tags and can thus be easily extended with permitted attributes. 
Enter `nav` or `input` as the key and the desired value as the value - in our example `role` or `type`.

If you trust all backend users 100%, you can also enter `*` as the key and `*` as the value. This will allow all attributes for all elements.

![Security settings]({{% asset "images/manual/system/en/security-settings-en.png" %}}?classes=shadow)


### Files and images

**Download file types:** Here you can define which file types may be downloaded from your server.

**Maximum GD image width:** Here you can define the maximum width of images that can still be processed via the GD image
process library. Any image exceeding this value will not be processed.

**Maximum GD image height:** Here you can define the maximum height of images that can still be processed via the GD image
process library. Any image exceeding this value will not be processed.


### Upload settings

**Upload file types:** Here you can define which file types can be uploaded to your server.

**Maximum upload file size:** Here you can define the maximum size of a file that can be uploaded to your server using 
the file manager. The entry is in bytes (1 MiB = 1024 KiB = 1,048,576 bytes). Larger files will be rejected.

**Maximum image width:** When uploading images, the file manager automatically checks the width of the image and 
compares it with the width you set here. If an image exceeds the maximum width, it will be reduced automatically.

**Maximum image height:** When uploading images, the file manager automatically checks their height and compares it with 
your default value. If an image exceeds the maximum height, it will be resized automatically.


### Search engine settings

**Enable searching:** If you select this option, Contao indexes the finished pages of your website and creates a search 
index from them. With the frontend module 
"[search engine](/en/layout/module-management/website-search/#configuration-of-the-search-module)", you can search this 
index.

**Index protected pages:** Select this option to index protected pages for your search. Use this feature with care and 
make sure to exclude personalized pages from the search.

{{% notice note %}}
Starting with version **4.9** a new search indexer is used. The settings **Enable searching** and 
**Index protected pages** are now configured via the `config/config.yaml`.

```yaml
contao:
    search:
        default_indexer:
            enable: true
        index_protected: false
```
{{% /notice %}}


### Cron job settings

**Deactivate the command scheduler:** Here you can disable the Periodic Command Scheduler and run the route 
`_contao/cron` using a real cron job (which you have to set up yourself). Starting with Contao **4.9** you can also
use the following command:

```
php vendor/bin/contao-console contao:cron
```


### Default access rights

**Default page owner:** Here you can specify the default owner of the pages for which no access rights have been 
defined. For more information, see the Access Rights section.

**Default page group**: Here you can define to which group the pages for which no access rights are defined belong by 
default. For more information, see the Access Rights section.

**Default access rights:** Here you can set the default access rights for the pages for which no special access rights 
are defined. For more information, see the Access Rights section.


## parameters.yaml

In the Contao Managed Edition, the parameters (e.g. database credentials) are stored in the `parameters.yaml` file that 
is generated by the Contao installation tool. This file is usually excluded from the versioning process and can also 
contain additional entries such as the credentials for sending e-mails via SMTP.

The file `parameters.yaml` is located in the folder `config/` and is created automatically when you install Contao.

{{% notice note %}}
Before version **4.8** of Contao, the file was located in `app/config/`.
{{% /notice %}}

The `parameters.yaml` contains the following after installing Contao:

```yaml
# This file has been auto-generated during installation
parameters:
    database_host: …
    database_port: …
    database_user: …
    database_password: …
    database_name: …
    secret: …
```

{{% notice note %}} Database passwords that consist only of digits must be set in quotation marks. {{% /notice %}}

## config.yaml

The bundle configuration belongs in the `config.yaml` and is located in the folder `config/`. If the file does not 
exist yet, it must be created. Contao automatically loads the `config_prod.yaml` or `config_dev.yaml` and if not available 
the `config.yaml`.

This allows you to realize different configurations for your test or production environment (dev/prod) (e.g. more 
logging in debug mode). In addition, you can commit the `config.yaml` configuration files to your repository, if your
project is versioned via Git for example.

{{% notice note %}}
In Contao versions prior to **4.9** the file is located under `app/config/`.
{{% /notice %}}

{{% notice info %}}
Contao versions _prior_ to **4.9** only support the `*.yml` file extension.
{{% /notice %}}

You can access the default configuration for Contao from the command line:

```bash
php vendor/bin/contao-console config:dump-reference contao
```

You can get information about the current configuration this way:

```bash
php vendor/bin/contao-console debug:config contao
```

{{< tabs groupId="bundle-config" >}}
{{% tab name="Contao 5" %}}
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
            interlace:            plane

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

        # Configures the title of the badge in the back end.
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
{{% tab name="Contao 4" %}}
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
            interlace:            plane

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

        # Configures the title of the badge in the back end.
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


### localconfig

As mentioned in the config reference above the configuration key `contao.localconfig` allows you to set any configuration
that is defined via `$GLOBALS['TL_CONFIG']`, the default values of which can be overwritten via the 
`system/config/localconfig.php`. This is where Contao stores any settings that have been customised in the back end, i.e.
under _System_ » _Settings_. This form of storing settings is being phased out step by step. Some of the settings now
have a counterpart in the bundle configuration, others are e.g. set in the website root or within the back end user's
settings. 

However depending on the Contao version you are using there are still settings being used from the localconfig. Thus it 
can be useful to define them directly in your applications configuration (i.e. the `config.yaml`) rather than the legacy 
`localconfig.php`. Not only because you might need it for your deployment flow, but also because some settings can _only_ 
be set manually - because they neither have a bundle configuration counterpart, nor is there another mean of setting them 
via the back end.

The following example defines the administrator's e-mail address via an environment variable and increases the undo period
to 60 days:

```yaml
# config/config.yaml
contao:
    localconfig:
        adminEmail: '%env(ADMIN_EMAIL)%'
        undoPeriod: 5184000
```

The following is a comprehensive list of localconfig configurations still in use and their description.

| Key | Description |
| --- | --- |
| `adminEmail` | [E-mail address of the system administrator](#global-configuration). |
| `allowedDownload` | [Download file types](#files-and-images). |
| `allowedAttributes` | [Allowed HTML attributes](#security-settings). |
| `allowedTags` | [Allowed HTML tags](#security-settings). |
| `characterSet` | Character set used by Contao. _(deprecated)_ Use the parameter `kernel.charset` instead. Default: `UTF-8` |
| `dateFormat` | [Date format](#date-and-time). |
| `datimFormat` | [Date and time format](#date-and-time). |
| `defaultChmod` | [Default access rights](#default-access-rights). |
| `defaultGroup` | [Default page group](#default-access-rights). |
| `defaultUser` | [Default page owner](#default-access-rights). |
| `disableCron` | [Deactivate the command scheduler](#front-end-configuration). |
| `disableInsertTags` | Allows you to disable the replacement of [insert tags][InsertTags] globally. |
| `disableRefererCheck` | Allows you to disable the [request token check][RequestTokens] entirely _(deprecated)_. |
| `doNotCollapse` | [Do not collapse elements](#back-end-configuration). |
| `doNotRedirectEmpty` | [Do not redirect empty URLs](#front-end-configuration). |
| `folderUrl` | [Enable folder URLs](#front-end-configuration). |
| `gdMaxImgHeight` | [Maximum GD image height](#files-and-images). |
| `gdMaxImgWidth` | [Maximum GD image width](#files-and-images). |
| `imageHeight` | [Maximum image height](#upload-settings). |
| `imageWidth` | [Maximum image width](#upload-settings). |
| `installPassword` | Stores the hashed value of the Contao Install Tool password. |
| `licenseAccepted` | Stores whether the license in the Contao Install Tool has been accepted. |
| `logPeriod` | Duration in seconds for how long entries in the Contao back end system log should be kept. Default: `604800`. |
| `maxFileSize` | [Maximum upload file size](#upload-settings). |
| `maxImageWidth` | Allows you to define a maximum image width for the front end _(deprecated)_. |
| `maxPaginationLinks` | Allows you define the number links shown in the automatically generated front end paginations. Default: `7`. |
| `maxResultsPerPage` | [Maximum items per page](#back-end-configuration). |
| `minPasswordLength` | Allows you to define the minimum password length for front end members and back end users. Default: `8`. |
| `requestTokenWhitelist` | Allows you to disable the [request token check][RequestTokens] for requests coming from the the hosts in this array _(deprecated)_. |
| `resultsPerPage` | [Items per page](#back-end-configuration). |
| `sessionTimeout` | Duration in seconds for how long a user session (front and back end) should stay valid. If you increase this value, you also might need to increase PHP's [session timeouts][PhpSessionSettings] (`session.cookie_lifetime` and `session.gc_maxlifetime`). Default: `3600`. |
| `timeFormat` | [Time format](#date-and-time). |
| `timeZone` | [Time zone](#date-and-time). |
| `undoPeriod` | Duration in seconds for how long deleted entries can still be restored. Default: `2592000`. |
| `uploadTypes` | [Upload file types](#upload-settings). |
| `useAutoItem` | Allows you to disable the usage of the so called _auto item_ _(not recommended)_. |
| `versionPeriod` | Duration in seconds for how long previous versions of edited entries should be kept. Default: `7776000`. |


## Environment variables

{{< version "4.9" >}}

Environment variables are variables that can be defined at the operating system level, per user or even process. You can learn more about the concept at Wikipedia (https://en.wikipedia.org/wiki/Environment_variable). The big advantage of using environment variables is that an application like Contao is prepared to run inside containers. We will not discuss the operation in containers further at this point. The important thing is that Contao can be operated in this environment. For operation without the possibility to set environment variables, such as on a common shared hosting, Contao provides the possibility to define environment variables in an `.env` file. Contao then interprets these as if they were real environment variables. This way, Contao combines the best of both worlds: It is prepared for professional operation inside containers with environment variables, but can just as well be operated on a shared hosting platform.

The variables are defined in the file `.env` and this file must be located in the root directory of the Contao installation. The usage and name of the following variables are predefined. However, you can also define arbitrary variables and then reference them e.g. in the `config.yaml`. If an additional `.env.local` file exists in the same directory, it will be used automatically.

{{% notice info %}}
Some of the environment variables, like `APP_SECRET`, `DATABASE_URL` and `MAILER_DSN` replace their respective counterparts 
of the `config/parameters.yaml` and thus you should not use these parameters, if you are using the environment variable instead.
{{% /notice %}}


### Custom Environment Variable

The following example shows how to define the system administrator's e-mail address using a custom environment variable in the `.env` file and referencing it in the `config.yaml` file.

```ini
# .env
MYADMIN_EMAIL=admin@demo.com
```

```yaml
# config/config.yaml
contao:
    localconfig:
        adminEmail: '%env(MYADMIN_EMAIL)%'
```


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


### `DATABASE_URL`

The database connection information is stored as an environment variable called `DATABASE_URL`. It defines 
the database user name, database password, host name, port and database name that will be used by your Contao system. 
The format of this variable is the following: `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`.
It is used by default for the Doctrine configuration: `doctrine.dbal.url: '%env(DATABASE_URL)%'`.

#### Convert your database parameters

The following tool runs in your browser and helps you to convert the variables of the parameters.yaml or the DATABASE_URL. No data will be transmitted.

<form autocomplete="off" class="env-converter">
  <div class="env-widget">
    <input type="text" id="database_user" name="user" autocapitalize="none" placeholder=" ">
    <label for="database_user">Username</label>
  </div>
  <div class="env-widget">
    <input type="password" id="database_password" name="password" autocapitalize="none" placeholder=" ">
    <label for="database_password">Password</label>
  </div>
  <div class="env-widget">
    <input type="text" id="database_host" name="server" required="required" autocapitalize="none" placeholder=" ">
    <label for="database_host">Server (:Port)</label>
  </div>
  <div class="env-widget separator">
    <input type="text" id="database_name" name="database" required="required" autocapitalize="none" placeholder=" ">
    <label for="database_name">Database Name</label>
  </div>
  <div class="env-widget">
    <input type="url" id="database_url" name="url" placeholder="mysql://user:password@server:port/database" required="required" autocapitalize="none">
    <label for="database_url" class="placeholder-active">DATABASE_URL</label>
  </div>
</form>

### `MAILER_DSN`

The mailer connection information is stored as an environment variable called `MAILER_DSN`. It defines the transport to
be used for sending emails, as well as the login credentials, host name and port for an SMTP server for example, if 
applicable. The format of this variable is the following: `MAILER_DSN=smtp://username:password@smtp.example.com:465?encryption=ssl`.
See the [Symfony Mailer Documentation][SymfonyMailer] for more information.

{{% notice note %}}
The variable was previously called `MAILER_URL`. Since Contao **5.0** only `MAILER_DSN` will be supported.
{{% /notice %}}

#### Convert your mail parameters

The following tool runs in your browser and helps you to convert your mail parameters into the `MAILER_DSN` or the `config.yaml`-variant. No data will be transmitted.

<form autocomplete="off" class="env-converter">
  <div class="env-widget">
    <input type="text" id="mailer_user" name="mailer_user" autocapitalize="none" placeholder=" ">
    <label for="mailer_user">Username</label>
  </div>
  <div class="env-widget">
    <input type="password" id="mailer_password" name="mailer_password" autocapitalize="none" placeholder=" ">
    <label for="mailer_password">Password</label>
  </div>
  <div class="env-widget">
    <input type="text" id="mailer_host" name="mailer_host" required="required" autocapitalize="none" placeholder=" ">
    <label for="mailer_host">Host</label>
  </div>
  <div class="env-widget separator">
    <input type="number" id="mailer_port" name="mailer_port" min="25" max="65535" required="required" placeholder=" ">
    <label for="mailer_port">Port</label>
  </div>
  <div class="env-widget">
    <input type="url" id="mailer_dsn" name="mailer_dsn" placeholder="smtp://user:pass@smtp.example.com:port"
           required="required" autocapitalize="none" readonly>
    <label for="mailer_dsn" class="placeholder-active">MAILER_DSN</label>
  </div>
  <div class="env-widget">
    <input type="url" id="mail_config_value" name="mail_config_value" placeholder="smtp://user:pass@smtp.example.com:port"
           required="required" autocapitalize="none" readonly>
    <label for="mail_config_value" class="placeholder-active">config.yaml</label>
  </div>
</form>

### `COOKIE_ALLOW_LIST`

{{% notice info %}}
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
    
{{% notice note %}}
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
database from or to different hosting environments you can use the `DNS_MAPPING` environment variable:

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

This allows you to - for example - copy the live database to your staging or local environment and then automatically 
change the domains according to the mapping in the respective environment during `contao:migrate`.

You can also migrate the protocol setting to different settings in the respective environment, which might be
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

Instead of the environment variable, you can also directly set the `contao.dns_mapping` parameter in your 
`parameters.yaml`, if you prefer:

```yaml
parameters:
    contao.dns_mapping:
        www.example.com: http://example.local
        www.foobar.org: http://foobar.local
        www.lorem.at: http://lorem.local
```


## E-Mail sending configuration

To set up the sending of e-mails via an SMTP server, you need the following information from your host (some of these might be optional,
depending on the server):

- The **hostname** of the SMTP server.
- The **user name** for the SMTP server.
- The **password** for the SMTP server.
- The **port number of** the SMTP server (587 / 465).
- The **encryption method** for the SMTP server (tls / ssl).

These credentials can then either be added in the `parameters.yaml` or configured via the [`MAILER_DSN`](#mailer-dsn) environment variable,
e.g. via the `.env.local` of your Contao instance.

{{< tabs groupId="smtp-config" >}}

{{% tab name=".env.local" %}}
{{< version-tag "4.9" >}} You can define the SMTP server via the [`.env.local`](https://symfony.com/doc/current/configuration.html#overriding-environment-values-via-env-local)
of your Contao instance (note that the `.env` file must also exist in order for the `.env.local` to take effect). In Contao **4.9** you need
to use the `MAILER_URL` environment variable, while in Contao **4.10** and up the [`MAILER_DSN`](#mailer-dsn) variable can be used. In 
Contao **5.0** and up only the `MAILER_DSN` environment variable will work.

```ini
# .env.local
MAILER_DSN=smtp://username:password@smtp.example.com:465?encryption=ssl
```

Keep in mind that the _username_ and _password_ (individually) need to be [URL encoded](https://www.urlencoder.org/).
{{% /tab %}}

{{% tab name="parameters.yaml" %}}
When using the `parameters.yaml` the SMTP credentials can be added via the following parameters:

```yaml
# This file has been auto-generated during installation
parameters:
    …
    mailer_transport: smtp
    mailer_host: host.example.com
    mailer_user: mail@example.com
    mailer_password: 'my-password'
    mailer_port: 465
    mailer_encryption: ssl
```
{{% /tab %}}

{{< /tabs >}}

{{% notice warning %}}
**Clear cache:** In order to enable these changes, the application cache must be rebuilt using the Contao Manager ("Maintenance" &gt; "Rebuild Production Cache") or alternatively via the command line. To do the latter you have to execute the following in the Contao installation directory:

```bash
php vendor/bin/contao-console cache:clear --env=prod --no-warmup
php vendor/bin/contao-console cache:warmup --env=prod
```
{{% /notice %}}

After that you can test the mail dispatch on the command line.

{{< tabs groupId="mailer-test" >}}

{{% tab name="Contao 4.0 to 4.9" %}}
```bash
php vendor/bin/contao-console swiftmailer:email:send --from=sender@example.com --to=recipient@example.com --subject=testmail --body=testmail
```
{{% /tab %}}

{{% tab name="Contao 4.13" %}}
First you need to install the [`inspiredminds/contao-mailer-command`](https://packagist.org/packages/inspiredminds/contao-mailer-command)
package. Then the following command can be used:

```bash
php vendor/bin/contao-console mailer:send --from=sender@example.com --to=recipient@example.com --subject=testmail --body=testmail
```
{{% /tab %}}

{{% tab name="Contao 5.0 and up" %}}
```bash
php vendor/bin/contao-console mailer:test --from=sender@example.com --subject=testmail --body=testmail recipient@example.com
```
{{% /tab %}}

{{< /tabs >}}

You can also omit the parameters. The command will then ask you for each parameter interactively.


### Different e-mail configurations and sender addresses

{{< version "4.10" >}}

In many cases, SMTP servers do not allow sending from any sender address. Oftentimes the sender address must match 
the SMTP server credentials. Especially in multi-domain installations of Contao it might be important that the 
sender address of the emails that Contao sends matches the domain. Or you might want to have different sender
addresses for different front end forms created via the Contao form generator.

Since Contao **4.10**, it is possible to use multiple email configurations in Contao. These configurations can be 
selected per website root, per form and per newsletter channel. For each e-mail configuration, you can also set the 
sender that will be used for each e-mail sent by the selected e-mail configuration.

The configuration requires two steps. First, the available e-mail sending methods have to be set in the Symfony 
framework configuration in the `config.yaml` so-called. One or more SMTP servers can be defined using the so-called "DSN" syntax:

```
smtp://<USERNAME>:<PASSWORD>@<HOSTNAME>:<PORT>
```

Replace the `<PLACEHOLDER>` with the information of the SMTP server used, or remove them accordingly. See also the 
information in the official [Symfony documentation][SymfonyMailer].

You can use this [Tool](#convert-your-mail-parameters) to encode your parameters. 

{{% notice warning %}}
If your username or password contains special characters, they need to be "url encoded". There are several online
services you can use to quickly url encode any string, e.g. [urlencoder.org](https://www.urlencoder.org/). Make sure to
encode the username and password separately (not together with the colon). When using `config.yaml`, the respective encoding of a special character must be prefixed with `%`: So e. g. `%%40` for the special character `@`.
{{% /notice %}}

{{% notice tip %}}
Instead of using `smtp://` you can also `smtps://` to automatically use SSL encryption over port `465`.
{{% /notice %}}

```yaml
# config/config.yaml
framework:
    mailer:
        transports:
            application: smtps://exampleuser:examplepassword@example.com
            website1: smtps://email%%40example.org:foobar@example.org
            website2: smtps://email%%40example.de:foobar@example.de
```

In the second step, the configured transports can be made available in the back end via the Contao framework 
configuration. In the following example, the transports `website1` and `website2` are made available:

```yaml
# config/config.yaml
contao:
    mailer:
        transports:
            website1: ~
            website2: ~
```

If the symfony application cache has been refreshed afterwards, these email configurations will be available for 
selection in the Contao back end.

{{% notice note %}}
If no transport is configured, the information from the `parameters.yaml` is used. If a transport is configured but no transport 
is selected in the Contao back end, the first defined transport is used automatically.
{{% /notice %}}

Optionally, you can now overwrite the sender address for each transport:

```yaml
# config/config.yaml
contao:
    mailer:
        transports:
            website1:
                from: email@example.org
            website2:
                from: Lorem Ipsum <email@example.de>
```

It is also possible to define translations for the descriptions of the options in the back end:

```yaml
# translations/mailer_transports.en.yaml
website1: 'SMTP for Website 1'
website2: 'SMTP for Website 2'
```

```yaml
# translations/mailer_transports.de.yaml
website1: 'SMTP für Webseite 1'
website2: 'SMTP für Webseite 2'
```

{{% notice warning %}}
**Clear cache** 
In order to enable these changes, the application cache must be rebuilt using the Contao Manager ("Maintenance" &gt; 
"Rebuild Production Cache") or alternatively via the command line. To do the latter you have to execute the following in 
the Contao installation directory:

```bash
php vendor/bin/contao-console cache:clear --env=prod --no-warmup
php vendor/bin/contao-console cache:warmup --env=prod
```
{{% /notice %}}


### Send Emails Asynchronously

Instead of letting Contao send emails immediately when a request is processed (e.g. when a form was submitted) the email can be sent 
asynchronously by the server later. There are several reasons why this can be important:

* It reduces the server response time of such requests (in some cases sending via a defined SMTP server can take several seconds).
* It can reduce the load on the web server on high volume sites that also send a lot of emails.
* It allows you to control the amount of emails in a given unit of time (e.g. if the SMTP server imposes a limit on that).
* No emails will be lost in case the SMTP server happens to be unreachable at the moment.


#### Email Spooling via Swiftmailer

You can use the [Swiftmailer bundle's spooling feature][SwiftmaielrSpooling] in Contao **4.9**. In order to enable spooling the following
needs to be configurted in your `config/config.yaml`:

```yaml
# config/config.yaml
swiftmailer:
    spool:
        type: file
        path: '%kernel.project_dir%/var/spool'
```

In this case we are using the _file_ spool. This means that when Contao sends an email it will be first stored in the given folder,
`var/spool/` within the Contao installation folder in this case (keep in mind to not lose this folder if you are using deployments, so that
no emails get lost).

In order to actually send the emails the following command can be used:

```bash
php vendor/bin/contao-console swiftmailer:spool:send
```

Instead of manually executing this command a minutely cronjob should be configured on the server. If you want to limit the amount of emails
per call you can use the `--message-limit` option:

```bash
php vendor/bin/contao-console swiftmailer:spool:send --message-limit=10
```

With a minutely cronjob this would mean that at most 600 emails are sent per hour in this case.


#### Asynchronous Emails with Symfony Mailer

{{< version "4.10" >}}

The Swiftmailer Bundle is not available anymore by default since Contao **4.10**. Instead the [Symfony Mailer][SymfonyMailer] component is
used. In order to send emails asynchronously in this case we can make use of the [Symfony Messenger][SymfonyMessenger] component, which must
be installed first via Composer:

```bash
composer require symfony/messenger
```

Now we can define a Messenger transport and routing for email messages. First we need to decide on the type of Messenger transport though.
The component already provides different [transport types][SymfonyMessengerTransports]. In this case the 
[Doctrine transport][SymfonyMessengerDoctrine] is a good fit since it will save our emails in the database first for later consumption.
In order to enable asynchronous emails via Symfony Mailer [the following needs to be configured][SymfonyMailerMessenger]:

```yaml
# config/config.yaml
framework:
    messenger:
        transports:
            async: 'doctrine://default'

        routing:
            'Symfony\Component\Mailer\Messenger\SendEmailMessage': async
```

{{% notice "note" %}}
Instead of defining the Messenger transport directly we can also use environment variables as usual, in case you want to use different
transports in different environments (e.g. using the 
[In Memory transport](https://symfony.com/doc/current/messenger.html#in-memory-transport) locally for testing).

```yaml
# config/config.yaml
framework:
    messenger:
        transports:
            async: "%env(MESSENGER_TRANSPORT_DSN)%"

        routing:
            'Symfony\Component\Mailer\Messenger\SendEmailMessage': async
```
{{% /notice %}}

In order to let the Messenger actually send the emails now we can use the following command:

```bash
php vendor/bin/contao-console messenger:consume --time-limit=1
```

Instead of manually executing this command a minutely cronjob should be configured on the server. If you want to limit the amount of emails
per call you can use the `--limit` option:

```bash
php vendor/bin/contao-console messenger:consume --limit=10 --time-limit=1
```

With a minutely cronjob this would mean that at most 600 emails are sent per hour in this case.

{{% notice "info" %}}
The commands described above use the `--time-limit=1` option. By default the `messenger:consume` process will run indefinitely, processing
any new messages continuously. Therefore you would not need to run a separate cronjob. In order to make sure that this process is always
running and is restarted on demand, different tools can be used on the server. However, in shared hosting environments such tools are
usually not available. Thus, when using a cronjob you need to make sure that the process will only run a limited time when executed. The
aforementioned `--time-limit=1` option will cause the process to exit after one second. You can find more details in the 
[Symfony documentation](https://symfony.com/doc/current/messenger.html#consuming-messages-running-the-worker).
{{% /notice %}}

{{% notice "note" %}}
It may be that mails are processed with a time delay,
if the cronjob doesn't have any specification for the timezone and then uses the default `UTC`.
Therefore, the local time zone should either be set globally on the server or explicitly in the cronjob.
{{% /notice %}}


[SymfonyMailer]: https://symfony.com/doc/4.4/mailer.html#transport-setup
[InsertTags]: /en/article-management/insert-tags/
[RequestTokens]: https://docs.contao.org/dev/framework/request-tokens/
[LegacyRouting]: /en/site-structure/website-root/#legacy-routing-mode
[PhpSessionSettings]: https://www.php.net/manual/en/session.configuration.php
[SwiftmailerSpooling]: https://symfony.com/doc/4.2/email/spool.html
[SymfonyMessenger]: https://symfony.com/doc/current/messenger.html
[SymfonyMessengerTransports]: https://symfony.com/doc/current/messenger.html#transport-configuration
[SymfonyMessengerDoctrine]: https://symfony.com/doc/current/messenger.html#doctrine-transport
[SymfonyMailerMessenger]: https://symfony.com/doc/current/mailer.html#sending-messages-async
[SymfonyProxies]: https://symfony.com/doc/current/deployment/proxies.html

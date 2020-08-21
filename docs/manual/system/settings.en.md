---
title: Settings
aliases:
    - /en/system/settings/
weight: 10
---


The system settings slowly but surely leave the backend. Basic system settings influence Contao as an application and 
therefore there is a chance that a wrong setting will render the system non-functional. If this happens, you will not 
be able to undo the settings and restore the system because you will not be able to log in anymore. For this reason, 
most settings are configured outside of Contao via the `config.yml`, or can be configured via the Contao Manager in the future.


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


### Front end configuration

**Enable folder URLs:** Here you can activate folder structures in page aliases. This will add the aliases that exist in 
the page hierarchy to the alias, e.g. the page "Download" in the page path "Docs &gt; Install" will use the alias 
`docs/install/download.html` instead of just `download.html`.

**Do not redirect empty URLs:** If the URL is empty, display the web page instead of redirecting to the starting point 
of the language redirection *(not recommended)*.

**Deactivate the command scheduler:** Here you can disable the Periodic Command Scheduler and run the route 
`_contao/cron` using a real cron job (which you have to set up yourself). Starting with Contao **4.9** you can also
use the following command:

```
php vendor/bin/contao-console contao:cron
```


### Security settings

**Disable request tokens:** Here you can activate that the request tokens are not checked when submitting a form 
*(insecure!)*.

**Allowed HTML tags:** By default, Contao does not allow HTML tags in forms and removes them automatically when saving. 
For input fields where the use of HTML is desired, you can specify a list of allowed HTML tags here.


### Files and images

**Download file types:** Here you can define which file types may be downloaded from your server.

**Maximum GD image width:** Here you can define the maximum width of images that can still be processed via the GD image
process library. Any image exceeding this value will not be processed.

**Maximum GD image height:** Here you can define the maximum height of images that can still be processed via the GD image
process library. Any image exceeding this value will not be processed.


### Upload settings

**Upload file types:** Here you can define which file types can be uploaded to your server.

**Maximum upload file size:** Here you can define the maximum size of a file that can be uploaded to your server using 
the file manager. The entry is in bytes (1 MiB = 1024 KiB = 1,048,567 bytes). Larger files will be rejected.

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
**Index protected pages** are now configured via the `config/config.yml`.

```yml
contao:
    search:
        default_indexer:
            enable: true
        index_protected: false
```
{{% /notice %}}


### Default6 access rights

**Default page owner:** Here you can specify the default owner of the pages for which no access rights have been 
defined. For more information, see the Access Rights section.

**Default page group**: Here you can define to which group the pages for which no access rights are defined belong by 
default. For more information, see the Access Rights section.

**Default access rights:** Here you can set the default access rights for the pages for which no special access rights 
are defined. For more information, see the Access Rights section.


## parameters.yml

In the Contao Managed Edition, the parameters (e.g. database credentials) are stored in the `parameters.yml` file that 
is generated by the Contao installation tool. This file is usually excluded from the versioning process and can also 
contain additional entries such as the credentials for sending e-mails via SMTP.

The file `parameters.yml` is located in the folder `app/config/` and is created automatically when you install Contao.

{{% notice note %}}
From version **4.8** of Contao, the file is located directly in the root directory of the installation under `config/`.
{{% /notice %}}

The `parameters.yml` contains the following after installing Contao:

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


## config.yml

The bundle configuration belongs in the `config.yml` and is located in the folder `app/config/`. If the file does not 
exist yet, it must be created. Contao automatically loads the `config_prod.yml` or `config_dev.yml` and if not available 
the `config.yml`.

This allows you to realize different configurations for your test or production environment (dev/prod) (e.g. more 
logging in debug mode). In addition, you can commit the `config.yml` configuration files to your repository, if your
project is versioned via Git for example.

{{% notice note %}}
From version **4.8** of Contao, the file is located directly in the root directory of the installation under `config/`.
{{% /notice %}}

You can access the default configuration for Contao from the command line:

```bash
php vendor/bin/contao-console config:dump-reference contao
```

You can get information about the current configuration this way:

```bash
php vendor/bin/contao-console debug:config contao
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
        - pl
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
                        resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Using contao.image.sizes.*.items.resizeMode is deprecated. Please use contao.image.sizes.*.items.resize_mode instead.)
                resizeMode:           ~ # One of "crop"; "box"; "proportional", Deprecated (Using contao.image.sizes.*.resizeMode is deprecated. Please use contao.image.sizes.*.resize_mode instead.)
                cssClass:             ~ # Deprecated (Using contao.image.sizes.*.cssClass is deprecated. Please use contao.image.sizes.*.css_class instead.)
                lazyLoading:          ~ # Deprecated (Using contao.image.sizes.*.lazyLoading is deprecated. Please use contao.image.sizes.*.lazy_loading instead.)
                skipIfDimensionsMatch: ~ # Deprecated (Using contao.image.sizes.*.skipIfDimensionsMatch is deprecated. Please use contao.image.sizes.*.skip_if_dimensions_match instead.)

        # The target directory for the cached images processed by Contao.
        target_dir:           '%kernel.project_dir%/assets/images' # Example: %kernel.project_dir%/assets/images
        target_path:          null # Deprecated (Use the "contao.image.target_dir" parameter instead.)
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


## E-Mail sending configuration

To set up the sending of e-mails via an SMTP server, you need the following information from your host:

- The **hostname** of the SMTP server.
- The **user name** for the SMTP server.
- The **password** for the SMTP server.
- The **port number of** the SMTP server (587 / 465)
- The **encryption method** for the SMTP server (tls / ssl)

You will then insert this below the existing data in the `parameters.yml`

```yaml
# This file has been auto-generated during installation
parameters:
    …
    mailer_transport: smtp
    mailer_host: host.example.com
    mailer_user: mail@example.com
    mailer_password: 'mein-passwort'
    mailer_port: 465
    mailer_encryption: ssl
```

{{% notice warning %}}
**Clear cache** 
In order to enable these changes, the application cache must be rebuilt using the Contao Manager ("Maintenance" &gt; "Rebuild Production Cache") or alternatively via the command line. To do the latter you have to execute the following in the Contao installation directory:

```bash
php vendor/bin/contao-console cache:clear --env=prod --no-warmup
```
{{% /notice %}}

After that you can test the mail dispatch on the command line.

```bash
php vendor/bin/contao-console swiftmailer:email:send --from=absender@example.com --to=empfaenger@example.com --subject=testmail --body=testmail
```

{{% notice info %}}
This command is no longer available in Contao **4.10** and later.
{{% /notice %}}


### Different e-mail configurations and sender addresses

{{< version "4.10" >}}

In many cases, SMTP servers do not allow sending from any sender address. In most cases, the sender address must match 
the SMTP server access data used. Especially in multi-domain installations of Contao it might be important that the 
sender address of the emails that Contao sends matches the domain.

Since Contao **4.10**, it is possible to use multiple email configurations in Contao. These configurations can be 
selected per website root, per form and per newsletter channel. For each e-mail configuration, you can also set the 
sender that will be used for each e-mail sent by the selected e-mail configuration.

The configuration requires two steps. First, the available e-mail sending methods have to be set in the Symfony 
framework configuration in the `config.yml` so-called. One or more SMTP servers can be defined using the so-called "DSN" syntax:

```
smtp://<USERNAME>:<PASSWORD>@<HOSTNAME>:<PORT>
```

Replace the `<PLACEHOLDER>` with the information of the SMTP server used, or remove them accordingly. See also the 
information in the official [Symfony documentation](https://symfony.com/doc/4.4/mailer.html#transport-setup).

{{% notice warning %}}
If your username or password contains special characters, they need to be "url encoded". There are several online
services you can use to quickly url encode any string, e.g. [urlencoder.org](https://www.urlencoder.org/). Make sure to
encode the username and password separately (not together with the colon).
{{% /notice %}}

{{% notice tip %}}
Instead of using `smtp://` you can also `smtps://` to automatically use SSL encryption over port `465`.
{{% /notice %}}

```yml
# config/config.yml
framework:
    mailer:
        transports:
            application: smtps://exampleuser:examplepassword@example.com
            website1: smtps://email@example.org:foobar@example.org
            website2: smtps://email@example.de:foobar@example.de
```

In the second step, the configured transports can be made available in the back end via the Contao framework 
configuration. In the following example, the transports `website1` and `website2` are made available:

```yml
# config/config.yml
contao:
    mailer:
        transports:
            website1: ~
            website2: ~
```

If the symfony application cache has been refreshed afterwards, these email configurations will be available for 
selection in the Contao back end.

{{% notice note %}}
If no transport is configured, the information from the `parameters.yml`. If a transport is configured but no transport 
is selected in the Contao back end, the first defined transport is used automatically.
{{% /notice %}}

Optionally, you can now overwrite the sender address for each transport:

```yml
# config/config.yml
contao:
    mailer:
        transports:
            website1:
                from: email@example.org
            website2:
                from: Lorem Ipsum <email@example.de>
```

It is also possible to define translations for the descriptions of the options in the back end:

```yml
# translations/mailer_transports.en.yml
website1: 'SMTP for Website 1'
website2: 'SMTP for Website 2'
```

```yml
# translations/mailer_transports.de.yml
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
```
{{% /notice %}}

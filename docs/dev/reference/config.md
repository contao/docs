---
title: "Config"
description: Contao's configuration options.
---


Contao's configuration options can be reviewed by running the following command:

```bash
$ vendor/bin/contao-console config:dump-reference contao
```

```yaml
# Default configuration for extension with alias: "contao"
contao:

    # Absolute path to the web directory. Make sure to use the %kernel.project_dir% parameter for the absolute path prefix.
    web_dir:              'C:\Users\Spooky\www\c48dev/web' # Example: %kernel.project_dir%/web

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
        target_dir:           'C:\Users\Spooky\www\c48dev/assets/images'
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
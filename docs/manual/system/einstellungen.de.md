---
title: "Einstellungen"
description: ""
weight: 1
---

Die Einstellungen verabschieden sich langsam aber sicher aus dem Backend und werden zukünftig über den Contao Manager 
konfigurierbar sein. Bis der Manager soweit ist können diese Einstellungen über die `config.yml` vorgenommen werden.

## Einstellungen

### Globale Einstellungen

**E-Mail-Adresse des Systemadministrators:** An diese Adresse werden z. B. Benachrichtigungen über gesperrte Konten 
oder neu registrierte Benutzer geschickt. Du kannst auch folgende Notation verwenden, um einen Namen zur E-Mail-Adresse 
hinzuzufügen:

```text
Kevin Jones [kevin.jones@example.com]
```


## parameters.yml

In der Contao Managed Edition werden die Parameter (z. B. Datenbankdaten) in der `parameters.yml` abgelegt. 
Auf diese Daten greift auch das Contao-Installtool zurück. Diese Datei wird normalerweise von der Versionierung 
ausgenommen und kann auch zusätzliche Einträge wie z. B. das Install-Passwort oder die Angaben für den E-Mail-Versand 
über SMTP enthalten.

Die Datei `parameters.yml` findest du im Ordner `app/config/` und wird bei der Installation von Contao automatisch 
angelegt.

{{% notice note %}}
Ab der Version 4.8 von Contao befindet sich die Datei im Ordner `config`.
{{% /notice %}}

Die `parameters.yml` nach der Installation von Contao:

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


### SMTP-Versand

Um den SMTP-Versand einzurichten brauchst du folgende Angaben von deinem Hoster.

- Den **Hostnamen** des SMTP-Servers.
- Den **Benutzernamen** für den SMTP-Server.
- Das **Passwort** für den SMTP-Server.
- Die **Portnummer** des SMTP-Servers (587 / 465).
- Die **Verschlüsselungsmethode** für den SMTP-Server (tls / ssl).

Diese fügst du dann unterhalb der bereits bestehenden Daten in die `parameters.yml` ein:

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


## config.yml

Die normale Bundle Config gehört in die `config.yml` und befindet sich im Ordner `app/config/`. 
Falls die Datei noch nicht vorhanden ist, muss diese angelegt werden. Contao lädt automatisch die `config_prod.yml` 
bzw. `config_dev.yml` und falls nicht vorhanden die `config.yml`.

Damit kannst du unterschiedliche Konfigurationen für deine Test- bzw. Produktionsumgebung (dev/prod) realisieren (z. B. 
mehr Logging im Debug Modus). Ausserdem committest du die `config.yml` im Gegensatz zur `parameters.yml` in dein 
[Repository](https://de.wikipedia.org/wiki/Repository).

{{% notice note %}}
Ab der Version 4.8 von Contao befindet sich die Datei im Ordner `config`.
{{% /notice %}}

Über die Kommandozeile kommst du an die Standard-Konfiguration für Contao:
```shell script
vendor/bin/contao-console config:dump-reference contao
```

```yaml
# Default configuration for extension with alias: "contao"
contao:
    web_dir:              /contao/web
    prepend_locale:       false
    encryption_key:       '%kernel.secret%'
    url_suffix:           .html
    upload_path:          files
    preview_script:       ''
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token
    pretty_error_screens: false
    error_level:          8183
    locales:

        # Defaults:
        - en
        - pl
        - ja
        - it
        - cs
        - ru
        - pt
        - zh
        - sr
        - nl
        - de
        - fr
        - es
        - fa
    image:
        bypass_cache:         false
        target_path:          null
        target_dir:           /contao/assets/images
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

        # Contao automatically detects the best Imagine service out of Gmagick, Imagick and Gd (in this order). 
        # To use a specific service, set its service ID here.
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
        reject_large_uploads: false
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
                skipIfDimensionsMatch: ~
                formats:

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
    localconfig:          ~
```

{{% notice warning %}}
**Cache leeren**  
Damit die Änderungen aktiv werden muss am Ende der Anwendungs-Cache über den Contao Manager (»Systemwartung« > 
»Prod.-Cache erneuern«) oder alternativ über die Kommandozeile geleert werden.
```shell script
vendor/bin/contao-console cache:clear --env=prod --no-warmup
```
{{% /notice %}}

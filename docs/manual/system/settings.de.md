---
title: "Einstellungen"
description: ""
url: "system/einstellungen"
aliases:
    - /de/system/einstellungen/
weight: 10
---

Die Systemeinstellungen verabschieden sich langsam aber sicher aus dem Backend. Grundlegende Systemeinstellungen
beeinflussen Contao als Applikation und somit besteht auch die Chance, dass durch eine falsche Einstellung das System
in einen funktionsuntüchtigen Zustand gebracht wird. Sollte dies geschehen, hast du keine Möglichkeit mehr,
die Einstellungen rückgängig zu machen und das System wiederherzustellen, da du dich nicht mehr einloggen kannst.
Aus diesem Grund werden die meisten Einstellungen außerhalb von Contao über die `config.yml` vorgenommen bzw. können 
zukünftig über den Contao Manager vorgenommen werden.

## Einstellungen

### Globale Einstellungen

**E-Mail-Adresse des Systemadministrators:** An diese Adresse werden z. B. Benachrichtigungen über gesperrte Konten 
oder neu registrierte Benutzer geschickt. Du kannst auch folgende Notation verwenden, um einen Namen zur E-Mail-Adresse 
hinzuzufügen:

```text
Kevin Jones [kevin.jones@example.com]
```

### Datum und Zeit

**Datums- und Zeitformat:** Alle Datums- und Zeitformate müssen wie in der 
[PHP-Funktion date](https://www.php.net/manual/de/function.date.php) eingegeben werden. Contao verarbeitet im Backend 
ausschließlich numerische Formate, also die Buchstaben j, d, m, n, y, Y, g, G, h, H, i und s.

Hier sind einige Beispiele gültiger Datums- und Zeitangaben:

| Angaben  | Erklärung                                                     |
|:---------|:--------------------------------------------------------------|
| Y-m-d    | JJJJ-MM-TT, international ISO-8601, z. B. `2005-01-28`        |
| m/d/Y    | MM/TT/JJJJ, Englisches Format, z. B. `01/28/2005`             |
| d.m.Y    | TT.MM.JJJJ, Deutsches Format, z. B. `28.01.2005`              |
| y-n-j    | JJ-M-T, ohne führende Nullen, z. B. `05-1-28`                 |
| Ymd      | JJJJMMTT, Zeitstempel, z. B. `20050128`                       |
| H:i:s    | 24 Stunden, Minuten und Sekunden, z. B. `20:36:59`            |
| g:i      | 12 Stunden ohne führende Nullen sowie Minuten, z. B. `8:36`   |

**Zeitzone:** Die Zeitzone solltest du unbedingt vor dem Erstellen deiner Webseite einstellen, da Contao alle 
Zeitangaben als [Unix-Zeitstempel](https://www.php.net/time) speichert und Contao diese Zeitstempel bei einer Änderung 
der Zeitzone nicht automatisch anpasst.


### Backend-Einstellungen

**Elemente nicht verkürzen:** Im »Parent View« stellt Contao die Elemente aus Gründen der Übersichtlichkeit verkürzt 
dar, wobei einzelne Elemente über ein Navigationsicon bei Bedarf ausgeklappt werden können. Wähle diese Option, um das 
Feature komplett zu deaktivieren.

**Elemente pro Seite:** Im Abschnitt [Datensätze auflisten](../../administrationsbereich/datensaetze-auflisten/#datensaetze-sortieren-und-filtern) 
hast du gelernt, dass Contao die Anzahl der Datensätze pro Seite standardmäßig auf 30 begrenzt. Diesen Wert kannst du 
hier beliebig anpassen. Höhere Werte bedeuten jedoch eine längere Ladezeit.

**Maximum Datensätze pro Seite:** Um zu verhindern, dass ein unbedarfter Benutzer sich 5000 Datensätze auf einmal 
anzeigen lässt und damit das PHP Memory Limit überschreitet, kannst du festlegen, wie viele Datensätze maximal pro Seite 
angezeigt werden dürfen.

#### Zusätzliche Backend-Einstellungen:

{{< version "4.11" >}}

Ein paar zusätzliche Parameter können über die `config/config.yml` konfiguriert werden.

| Key | Description |
| --- | --- |
| `attributes` | Fügt dem `<body>`-Tag im Backend HTML-Attribute hinzu. Der Attributname muss ein gültiger HTML-Attributname sein - ihm wird automatisch `data-` vorangestellt. |
| `custom_css` | Fügt dem Backend individuelle Stylesheets hinzu. Die Assets müssen per URL öffentlich zugänglich sein! |
| `custom_js` | Fügt dem Backend individuelle JavaScript-Dateien hinzu. Die Assets müssen per URL öffentlich zugänglich sein! |
| `badge_title` | Konfiguriert den Titel des Badge im Backend. |
| `route_prefix` | {{< version-tag "4.13" >}} Konfiguriert den Pfad des Contao-Backends, z. B., `/admin` an Stelle von `/contao`. |

Die folgende Konfiguration definiert einige Beispielwerte:

```yml
# config/config.yaml
contao:
    backend:
        attributes:
            app-name: 'Meine App'
            app-version: 1.2.3
        custom_css:
            - files/backend/custom.css
        custom_js:
            - files/backend/custom.js
        badge_title: develop
        route_prefix: '/admin'
```

### Frontend-Einstellungen

{{% notice note %}}
Ab Version **4.10** wird die folgende Einstellung im Startpunkt der Webseite vorgenommen:
{{% /notice %}}

**Ordner-URLs verwenden:** Hier kannst du Ordnerstrukturen in Seitenaliasen aktivieren. Damit werden die in der
Seitenhierarchie vorhandenen Aliase in den Alias mit übernommen z. B. die Seite »Download« im Seitenpfad 
»Docs > Install« zu `docs/install/download.html` anstatt nur `download.html`.

{{% notice note %}}
Ab Version **4.10** ist diese Einstellung entfallen:
{{% /notice %}}

**Leere URLs nicht umleiten:** Bei einer leeren URL die Webseite anzeigen anstatt auf den Startpunkt der Sprache 
weiterzuleiten _(nicht empfohlen)_.

### Sicherheitseinstellungen

**Anfrage-Tokens deaktivieren:** Hier kannst du aktivieren, dass die Anfrage-Token beim Absenden eines Formulars nicht 
geprüft werden _(unsicher!)_.

**Erlaubte HTML-Tags:** Standardmäßig erlaubt Contao keine HTML-Tags in Formularen und entfernt diese beim Speichern 
automatisch. Für Eingabefelder, bei denen die Nutzung von HTML erwünscht ist, kannst du hier eine Liste erlaubter 
HTML-Tags festlegen.

{{< version-tag "4.11.7, 4.9.18 und 4.4.56" >}}  
**Erlaubte HTML-Attribute:** Die Liste der erlaubten HTML-Attribute für Eingabefelder kannst du hier beliebig erweitern. 
Wenn ein HTML-Attribute in der Liste nicht vorhanden ist, wird es beim Abspeichern automatisch entfernt. Das Tag bzw. 
der Attributname * steht für alle Tags bzw. Attribute. Für Attribute mit Bindestrichen können Platzhalter wie z. B. 
data-* benutzt werden.

**Passwort-Hash:** Standardmäßig verwendet Contao den Default der aktuellen PHP-Version, hier kannst du aber auch einen Wert festlegen. Dieses ist z. B. nötig, wenn du das Passwort in ein weiteres System wie LDAP synchronisieren möchtest.

Die folgende Konfiguration definiert einige Beispielwerte:

```yml
# config/config.yaml
security:
  password_hashers:
      Contao\User: 'auto' # Hash function: bcrypt, sha256, sha512 ...
```

**Beispiele:**  
`<iframe>` ist in den erlaubten HTML-Tags nicht vorhanden, kann aber einfach unter Schlüssel eingefügt werden. 

{{% notice note %}}  
Um die selbst hinzugefügten HTML-Tags besser zu erkennen, sollten diese zu Beginn der Liste eingetragen werden.  
{{% /notice %}}  

In den erlaubten HTML-Attributen, als Wert muss hierzu dann auch noch das Attribut mit eingefügt werden.  

`<nav>` und `<input>` sind beispielsweise bereits in den erlaubten HTML-Tags vorhanden und können damit einfach mit erlaubten Attributen erweitert werden.  
Dazu als Schlüssel `nav` bzw. `input` eintragen und als Wert der gewünschte Wert - in unserem Beispiel `role` bzw. `type`.

Falls du allen Backend-Benutzern zu 100% vertraust, kannst du auch als Schlüssel `*` und als Wert `*` eintragen. Hierdurch sind alle Attribute für alle Elemente erlaubt.  

![Sicherheitseinstellungen](/de/system/images/de/security-settings-de.png?classes=shadow)


### Dateien und Bilder

**Erlaubte Download-Dateitypen:** Hier kannst du festlegen, welche Dateitypen von deinem Server heruntergeladen werden 
dürfen (Download).

**Maximale GD-Bildbreite:** Hier kannst du festlegen, wie breit Bilder sein dürfen, damit sie von der GD 
Bildbearbeitungs-Bibliothek noch verarbeitet werden können. Jegliche Bilder, die diesen Wert übersteigen, werden nicht
verarbeitet.

**Maximale GD-Bildhöhe:** Hier kannst du festlegen, wie hoch Bilder sein dürften, damit sie von der GD 
Bildbearbeitungs-Bibliothek noch verarbeitet werden können. Jegliche Bilder, die diesen Wert übersteigen, werden nicht
verarbeitet.


### Datei-Uploads

**Erlaubte Upload-Dateitypen:** Hier kannst du festlegen, welche Dateitypen auf deinen Server übertragen werden dürfen 
(Upload).

**Maximale Upload-Dateigröße:** Hier kannst du festlegen, wie groß eine mit der Dateiverwaltung auf deinen Server 
übertragene Datei maximal sein darf. Die Eingabe erfolgt in Bytes (1 MiB = 1024 KiB = 1.048.567 Bytes). Größere Dateien 
werden abgelehnt.

**Maximale Bildbreite:** Beim Upload von Bildern prüft die Dateiverwaltung automatisch deren Breite und vergleicht diese 
Werte mit deiner hier festgelegten Vorgabe. Überschreitet ein Bild die maximale Breite, wird es automatisch 
verkleinert.

**Maximale Bildhöhe:** Beim Upload von Bildern prüft die Dateiverwaltung automatisch deren Höhe und vergleicht diese Werte 
mit deiner hier festgelegten Vorgabe. Überschreitet ein Bild die maximale Höhe, wird es automatisch verkleinert.


### Website-Suche

**Suche aktivieren:** Wenn du diese Option auswählst, indiziert Contao die fertigen Seiten deiner Webseite und erstellt 
daraus einen Suchindex. Mit dem Frontend-Modul 
»[Suchmaschine](../../modulverwaltung/website-suche/#konfiguration-des-suchmoduls)« kannst du diesen Index dann 
durchsuchen.

**Geschützte Seiten indizieren:** Wähle diese Option, um auch geschützte Seiten für die Suche zu indizieren. Nutze 
dieses Feature mit Bedacht, und achte darauf, personalisierte Seiten grundsätzlich von der Suche auszuschließen.

{{% notice note %}}
Ab Version **4.9** kommt ein neuer Such-Indexer zum Einsatz. Die Einstellungen **Suche aktivieren** und 
**Geschützte Seiten indizieren** werden nun über die `config/config.yml` konfiguriert:

```yml
contao:
    search:
        default_indexer:
            enable: true
        index_protected: false
```
{{% /notice %}}


### Cronjob-Einstellungen

**Den Command-Scheduler deaktivieren:** Hier kannst du den Periodic Command Scheduler deaktivieren und die 
`_contao/cron`-Route mittels eines echten Cronjobs (den du selbst einrichten musst) ausführen. Seit Contao **4.9** kann
auch folgendes Kommando benutzt werden:

```
php vendor/bin/contao-console contao:cron
```

### Standard-Zugriffsrechte

**Standardbesitzer:** Hier kannst du vorgeben, welchem Benutzer standardmäßig die Seiten gehören, für die keine 
Zugriffsrechte definiert wurden. Weitere Informationen dazu findest du im Abschnitt 
[Zugriffsrechte](../../seitenstruktur/seiten-konfigurieren/#zugriffsrechte).

**Standardgruppe:** Hier kannst du festlegen, welcher Gruppe standardmäßig die Seiten gehören, für die keine 
Zugriffsrechte definiert wurden. Weitere Informationen dazu findest du im Abschnitt 
[Zugriffsrechte](../../seitenstruktur/seiten-konfigurieren/#zugriffsrechte).

**Standardzugriffsrechte:** Hier kannst du festlegen, welche Zugriffsrechte standardmäßig für die Seiten gelten, für 
die keine speziellen Zugriffsrechte definiert wurden. Weitere Informationen dazu findest du im Abschnitt 
[Zugriffsrechte](../../seitenstruktur/seiten-konfigurieren/#zugriffsrechte).



## parameters.yml

In der Contao Managed Edition werden die Parameter (z. B. Datenbankdaten) in der `parameters.yml` abgelegt. 
Auf diese Daten greift auch das Contao-Installtool zurück. Diese Datei wird normalerweise von der Versionierung 
ausgenommen und kann auch zusätzliche Einträge wie z. B. die Angaben für den E-Mail-Versand über SMTP enthalten.

Die Datei `parameters.yml` findest du im Ordner `app/config/` und wird bei der Installation von Contao automatisch 
angelegt.

{{% notice note %}}
Ab der Version **4.8** von Contao befindet sich die Datei direkt im Wurzelverzeichnis der Installation unter `config/`.
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
{{% notice note %}}
Datenbankpasswörter, die nur aus Ziffern bestehen oder gewisse Sonderzeichen enthalten, müssen in Hochkommatas gesetzt werden.
{{% /notice %}}

## config.yml

Die normale Bundle Config gehört in die `config.yml` und befindet sich im Ordner `app/config/`. 
Falls die Datei noch nicht vorhanden ist, muss diese angelegt werden. Contao lädt automatisch die `config_prod.yml` 
bzw. `config_dev.yml` und falls nicht vorhanden die `config.yml`.

Damit kannst du unterschiedliche Konfigurationen für deine Test- bzw. Produktionsumgebung (dev/prod) realisieren (z. B. 
mehr Logging im Debug Modus). Außerdem committest du die `config.yml` im Gegensatz zur `parameters.yml` in dein 
[Repository](https://de.wikipedia.org/wiki/Repository). Ein Repository kannst du verwenden, um deine Projekt-Versionen abzulegen, z. B. mit Git.

{{% notice note %}}
Ab der Version **4.8** von Contao befindet sich die Datei direkt im Wurzelverzeichnis der Installation unter `config/`.
{{% /notice %}}

Über die Kommandozeile kommst du an die Standard-Konfiguration für Contao:

```bash
php vendor/bin/contao-console config:dump-reference contao
```

Informationen zur aktuelle Konfiguration erhältst du so:

```bash
php vendor/bin/contao-console debug:config contao
```

```yaml
# Default configuration for extension with alias: "contao"
contao:
    csrf_cookie_prefix:   csrf_
    csrf_token_name:      contao_csrf_token
    encryption_key:       '%kernel.secret%'

    # The error reporting level set when the framework is initialized.
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
        - sl
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


### localconfig

Wie bereits in der oben stehenden Referenz erwähnt erlaubt `contao.localconfig` jegliche Variablen einzustellen, die über
`$GLOBALS['TL_CONFIG']` definiert sind. Diese Werte können teilweise über das Contao-Backend in den Systemeinstellungen
überschrieben und in der `system/config/localconfig.php` gespeichert werden. Allerdings wird diese Art der Speicherung
Schritt für Schritt aus Contao entfernt. Einige der Einstellungen haben bereits ein Pendant in der Bundle Konfiguration
während andere Einstellungen nun bspw. in den Benutzereinstellungen oder im Startpunkt einer Webseite vorgenommen werden
können.

Je nach Contao-Version werden aber immer noch Einstellungen aus der `localconfig` benutzt. Daher kann es nützlich sein zu
wissen, wie man diese Einstellungen über die Applikationskonfiguration (also die `config.yml`) überschreiben könnte, 
anstatt die veraltete `localconfig.php` dafür zu benutzen. Dies kann für den eigenen Deployment-Flow wichtig sein, aber
auch weil es gewisse Einstellungen gibt, die _nur_ manuell gesetzt werden können, weil diese weder eine Bundle Einstellung
noch eine andere Einstellungsmöglichkeit im Backend haben.

Das folgende Beispiel zeigt, wie man die E-Mail-Adresse des Systemadministrators über eine Umgebungsvariable definieren und die
Wiederherstellungsperiode auf 60 Tage verlängern könnte:

```yaml
# config/config.yaml
contao:
    localconfig:
        adminEmail: '%env(ADMIN_EMAIL)%'
        undoPeriod: 5184000
```

Im Folgenden befindet sich eine vollständige Liste an localconfig Konfigurationen, die noch benutzt werden, und deren
Beschreibung.

| Key | Description |
| --- | --- |
| `adminEmail` | [E-Mail-Adresse des Systemadministrators](#globale-einstellungen). |
| `allowedDownload` | [Erlaubte Download-Dateitypen](#dateien-und-bilder). |
| `allowedTags` | [Erlaubte HTML-Tags](#sicherheitseinstellungen). |
| `characterSet` | Der von Contao benutzte Zeichensatz. _(veraltet)_ Nutze den Parameter `kernel.charset` stattdessen. Standard: `UTF-8`. |
| `dateFormat` | [Datumsformat](#datum-und-zeit). |
| `datimFormat` | [Datums- und Zeitformat](#datum-und-zeit). |
| `defaultChmod` | [Standard-Zugriffsrechte](#standard-zugriffsrechte). |
| `defaultGroup` | [Standardgruppe](#standard-zugriffsrechte). |
| `defaultUser` | [Standardbesitzer](#standard-zugriffsrechte). |
| `disableCron` | [Den Command-Scheduler deaktivieren](#frontend-einstellungen). |
| `disableInsertTags` | Erlaubt es das Ersetzen von [Insert-Tags][InsertTags] global zu deaktivieren. |
| `disableRefererCheck` | Erlaubt es die [Request Token Überprüfung][RequestTokens] komplett zu deaktivieren _(veraltet)_. |
| `doNotCollapse` | [Elemente nicht verkürzen](#backend-einstellungen). |
| `doNotRedirectEmpty` | [Leere URLs nicht umleiten](#frontend-einstellungen). |
| `folderUrl` | [Ordner-URLs verwenden](#frontend-einstellungen). |
| `gdMaxImgHeight` | [Maximale GD-Bildhöhe](#dateien-und-bilder). |
| `gdMaxImgWidth` | [Maximale GD-Bildbreite](#dateien-und-bilder). |
| `imageHeight` | [Maximale Bildhöhe](#datei-uploads). |
| `imageWidth` | [Maximale Bildbreite](#datei-uploads). |
| `installPassword` | Speichert den Hash-Wert des Passwortes für das Contao-Installtool. |
| `licenseAccepted` | Speichert ob die Lizenz im Contao-Installtool bereits akzeptiert wurde. |
| `logPeriod` | Zeitspanne in Sekunden wie lange Einträge im System-Log behalten werden sollen. Standard: `604800`. |
| `maxFileSize` | [Maximale Upload-Dateigröße](#datei-uploads). |
| `maxImageWidth` | Erlaubt es eine maximale Bildbreite für das Frontend zu setzen _(veraltet)_. |
| `maxPaginationLinks` | Erlaubt es die Anzahl an Links in den automatisch generierten Blätternavigationen zu ändern. Standard: `7`. |
| `maxResultsPerPage` | [Maximum Datensätze pro Seite](#backend-einstellungen). |
| `minPasswordLength` | Erlaubt es die minimale Passwortlänge für Frontend-Mitglieder und Backend-Nutzer zu ändern. Standard: `8`. |
| `requestTokenWhitelist` | Erlaubt es die [Request Token Überprüfung][RequestTokens] für Anfragen von den definierten Hosts zu deaktivieren _(veraltet)_. |
| `resultsPerPage` | [Elemente pro Seite](#backend-einstellungen). |
| `sessionTimeout` | Zeitspanne in Sekunden wie lange eine Nutzer-Session (Frontend und Backend) gültig bleiben soll. Falls dieser Wert erhöht wird müssen ggf. auch die [Session-Einstellungen][PhpSessionSettings] von PHP geändert werden (`session.cookie_lifetime` und `session.gc_maxlifetime`). Standard: `3600`. |
| `timeFormat` | [Zeitformat](#datum-und-zeit). |
| `timeZone` | [Zeitzone](#datum-und-zeit). |
| `undoPeriod` | Zeitspanne in Sekunden wie lange gelöschte Einträge wiederhergestellt werden können. Standard: `2592000`. |
| `uploadTypes` | [Upload-Dateitypen](#datei-uploads). |
| `useAutoItem` | Erlaubt es das sogenannte »Auto Item« zu deaktivieren _(nicht empfohlen)_. |
| `versionPeriod` | Zeitspanne in Sekunden wie lange ältere Versionen von geänderten Einträgen behalten werden sollen. Standard: `7776000`. |


## E-Mail Versand Konfiguration

Um den E-Mail Versand über einen SMTP-Server einzurichten, brauchst du folgende Angaben von deinem Hoster:

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

{{% notice warning %}}
**Cache leeren**  
Damit die Änderungen aktiv werden, muss am Ende der Anwendungs-Cache über den Contao Manager (»Systemwartung« > 
»Prod.-Cache erneuern«) oder alternativ über die Kommandozeile geleert werden. Dazu muss man sich im Contao 
Installationsverzeichnis befinden.

```bash
php vendor/bin/contao-console cache:clear --env=prod --no-warmup
php vendor/bin/contao-console cache:warmup --env=prod
```
{{% /notice %}}

Danach kannst du den Mailversand auf der Kommandozeile testen.

```bash
php vendor/bin/contao-console swiftmailer:email:send --from=absender@example.com --to=empfaenger@example.com --subject=testmail --body=testmail
```

{{% notice info %}}
Dieses Kommando steht ab Contao **4.10** nicht mehr zur Verfügung.
{{% /notice %}}


### Verschiedene E-Mail Konfigurationen und Absenderadressen

{{< version "4.10" >}}

In vielen Fällen erlauben SMTP-Server nicht den Versand von beliebigen Absenderadressen. Meist muss die Absenderadresse
zu den verwendeten SMTP-Server Zugangsdaten passen. Vor allem in Multidomain-Installationen von Contao kann es jedoch
wichtig sein, dass die Absenderadresse der E-Mails, die Contao verschickt, zur jeweiligen Domain passt.

Ab Contao **4.10** besteht daher die Möglichkeit, mehrere E-Mail Konfigurationen in Contao zu benutzen. Diese 
Konfigurationen können dann pro Webseiten-Startpunkt, pro Formular und pro Newsletter-Kanal ausgewählt werden. Pro E-Mail 
Konfiguration kann dann außerdem auch der Absender gesetzt werden, welcher dann für jede E-Mail benutzt wird, die über
die ausgewählte E-Mail Konfiguration gesendet wird.

Die Konfiguration benötigt zwei Schritte. Zuerst müssen die verfügbaren E-Mail Versandmethoden über die Symfony Framework
Konfiguration in der `config.yml` als sogenannte »Transports« eingestellt werden. Dabei können bspw. ein oder mehrere 
SMTP-Server über die sogenannte »DSN«-Syntax definiert werden. Diese Syntax ist grundsätzlich sehr einfach aufgebaut:

```
smtp://<BENUTZERNAME>:<PASSWORT>@<HOSTNAME>:<PORT>
```

Man ersetzt die `<PLATZHALTER>` mit den Angaben des verwendeten SMTP-Servers, oder entfernt sie dementsprechend. Siehe 
dazu auch die Informationen in der offiziellen [Symfony Dokumentation][SymfonyMailer].

{{% notice warning %}}
Falls der Benutzername oder das Passwort Sonderzeichen verwendet, müssen diese "URL enkodiert" werden. Es gibt
verschiedene Online-Services, mit denen man auf einfache Weise eine beliebige Zeichenfolgen URL-encoden kann, z. B.
[urlencoder.org](https://www.urlencoder.org/). Enkodiere den Benutzernamen und das Passwort separat, nicht gemeinsam
mit dem Doppelpunkt.
{{% /notice %}}

{{% notice tip %}}
Anstatt `smtp://` kann auch `smtps://` verwendet werden, um automatisch SSL Verschlüsselung über Port `465` zu verwenden.
{{% /notice %}} 

```yml
# config/config.yml
framework:
    mailer:
        transports:
            application: smtps://exampleuser:examplepassword@example.com
            website1: smtps://email%%40example.org:foobar@example.org
            website2: smtps://email%%40example.de:foobar@example.de
```

Im zweiten Schritt können die konfigurierten Transports über die Contao Framework Konfiguration im Backend verfügbar
gemacht werden. Im folgenden Beispiel werden die Transports `website1` und `website2` verfügbar gemacht:

```yml
# config/config.yml
contao:
    mailer:
        transports:
            website1: ~
            website2: ~
```

Wenn danach der Symfony Application Cache erneuert wurde, stehen diese E-Mail Konfigurationen zur Selektion im Contao
Backend zur Verfügung.

{{% notice note %}}
Wird kein Transport konfiguriert, gelten nach wie vor die Informationen aus der `parameters.yml`. Werden Transports
konfiguriert, aber es wird kein Transport im Contao Backend ausgewählt, wird automatisch der erste definierte Transport 
verwendet.
{{% /notice %}}

Optional kann man nun pro Transport auch die Absenderadresse überschreiben:

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

Es besteht außerdem die Möglichkeit, für die Beschreibungen der Optionen für die Selektion im Backend über Übersetzungen
pro Sprache zu definieren:

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
**Cache leeren**  
Damit die Änderungen im Backend sichtbar werden, muss am Ende der Anwendungs-Cache über den Contao Manager (»Systemwartung« > 
»Prod.-Cache erneuern«) oder alternativ über die Kommandozeile geleert werden. Dazu muss man sich im Contao 
Installationsverzeichnis befinden.

```bash
php vendor/bin/contao-console cache:clear --env=prod --no-warmup
php vendor/bin/contao-console cache:warmup --env=prod
```
{{% /notice %}}


### E-Mails asynchron senden

Anstatt Contao E-Mails sofort im Zuge einer Server-Anfrage senden zu lassen (bspw. wenn ein Formular abgeschickt wird) besteht die
Möglichkeit diese E-Mails stattdessen später asynchron vom Server versenden zu lassen. Dies könnte man aus folgenden Gründen brauchen:

* Die Antwort-Zeit der Anfrage verringern (in manchen Fällen kann der SMTP-Versand ein paar Sekunden beanspruchen).
* Die Server-Last verringern, wenn eine stark frequentierte Website auch viele E-Mails versendet.
* Kontrolle über die Menge an E-Mails pro Zeiteinheit (falls das in der jeweiligen Server-Umgebung limitiert ist).
* Kein Verlust von E-Mails, falls der SMTP-Server gerade nicht zur Verfügung steht.


#### E-Mail Spooling via Swiftmailer

In Contao **4.9** kann das [Spooling Feature des Symfony Swiftmailer Bundles][SwiftmailerSpooling] benutzt werden. Um das E-Mail Spooling zu
aktivieren muss folgendes in die `config/config.yaml` eingetragen werden:

```yaml
# config/config.yaml
swiftmailer:
    spool:
        type: file
        path: '%kernel.project_dir%/var/spool'
``` 

In diesem Fall bedienen wir uns dem _File_ Spool, das heißt wenn Contao eine E-Mail sendet wird diese zuerst als Datei in das angegebene
Verzeichnis abgelegt. In der beschriebenen Konfiguration wird der Ordner `var/spool/` der Contao Installation benutzt (beachte, dass dieser
Ordner nicht verloren geht, wenn Deployments benutzt werden, damit dabei auch keine E-Mails verloren gehen).

Um die E-Mails nun tatsächlich senden lassen zu können, muss folgendes Kommando auf der Kommandozeile ausgeführt werden:

```bash
php vendor/bin/contao-console swiftmailer:spool:send
```

Anstatt dies manuell aufzurufen sollte dieses Kommando als minütlicher Cronjob am Server eingerichtet werden. Will man pro Aufruf bspw. nur
10 E-Mails verschicken, kann die `--message-limit` Option benutzt werden:

```bash
php vendor/bin/contao-console swiftmailer:spool:send --message-limit=10
```

Bei einem minütlichen Aufruf würde das also den E-Mail Versand auf 600 E-Mails pro Stunde beschränken.


#### Asynchrone E-Mails mit Symfony Mailer

{{< version "4.10" >}}

Ab Contao **4.10** steht das Swiftmailer Bundle nicht mehr von Haus aus zur Verfügung, statt dessen nutzt Contao 
[Symfony Mailer][SymfonyMailer]. Um E-Mail asnychron senden zu können wird in diesem Fall die [Symfony Messenger][SymfonyMessenger]
Komponente benötigt. Diese muss zuerst via Composer installiert werden:

```bash
composer require symfony/messenger
```

Danach können wir einen Messenger Transport definieren und das Routing für E-Mail Messages festlegen. Zuerst müssen wir uns jedoch dafür
entscheiden, welchen Messenger Transport wir nutzen wollen. Symfony Messenger stellt verschiedene [Transports][SymfonyMessengerTransports]
von Haus aus zur Verfügung. Für unsere Zwecke eignet sich der [Doctrine Transport][SymfonyMessengerDoctrine], damit werden die E-Mails
zuerst in der Datenbank gespeichert und können später abgearbeitet werden. Um nun den asynchronen Versand über Symfony Mailer zu aktivieren
muss [folgendes konfiguriert werden][SmyonfyMailerMessenger]:

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
Anstatt den Messenger Transport direkt zu definieren können wie immer auch Umgebungsvariablen benutzt werden, falls man in verschiedenen
Umgebungen verschiedene Transports haben möchte (bspw. lokal zum testen den 
[In Memory Transport](https://symfony.com/doc/current/messenger.html#in-memory-transport)).

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

Um den Symfony Messenger die E-Mails nun tatsächlich senden zu lassen, muss folgendes Kommando ausgeführt werden:

```bash
php vendor/bin/contao-console messenger:consume --time-limit=1
```

Anstatt dies manuell aufzurufen sollte dieses Kommando als minütlicher Cronjob am Server eingerichtet werden. Will man pro Aufruf bspw. nur
10 E-Mails verschicken, kann die `--limit` Option benutzt werden:

```bash
php vendor/bin/contao-console messenger:consume --limit=10 --time-limit=1
```

Bei einem minütlichen Aufruf würde das also den E-Mail Versand auf 600 E-Mails pro Stunde beschränken.

{{% notice "info" %}}
In den Kommandos wird die Option `--time-limit=1` benutzt. Von Haus aus läuft der `messenger:consume` Prozess unendlich lang und verarbeitet
alle E-Mails in dieser Zeit automatisch - und es müsste daher auch kein Cronjob eingerichtet werden. Um sicherzustellen, dass dieser 
Prozess läuft und ggf. neu gestartet wird könnten entsprechende Tools am Server verwendet werden. In Shared Hosting Umgebungen hat man diese
Möglichkeit meist jedoch nicht, daher muss in der Cronjob Variante sichergestellt werden, dass der Prozess nur einmalig läuft. Mit der
bereits erwähnten `--time-limit=1` Option wird der Prozess nach spätestens einer Sekunde beendet. Nähere Details dazu findet man in der 
[Symfony Dokumentation](https://symfony.com/doc/current/messenger.html#consuming-messages-running-the-worker).
{{% /notice %}}


[SymfonyMailer]: https://symfony.com/doc/4.4/mailer.html#transport-setup
[InsertTags]: /de/artikelverwaltung/insert-tags/
[RequestTokens]: https://docs.contao.org/dev/framework/request-tokens/
[LegacyRouting]: /de/layout/seitenstruktur/seiten-konfigurieren/#legacy-routing-modus
[PhpSessionSettings]: https://www.php.net/manual/de/session.configuration.php
[SwiftmailerSpooling]: https://symfony.com/doc/4.2/email/spool.html
[SymfonyMessenger]: https://symfony.com/doc/current/messenger.html
[SymfonyMessengerTransports]: https://symfony.com/doc/current/messenger.html#transport-configuration
[SymfonyMessengerDoctrine]: https://symfony.com/doc/current/messenger.html#doctrine-transport
[SmyonfyMailerMessenger]: https://symfony.com/doc/current/mailer.html#sending-messages-async

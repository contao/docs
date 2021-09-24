---
title: "Systemvoraussetzungen"
description: ""
url: "installation/systemvoraussetzungen"
aliases:
    - /de/installation/systemvoraussetzungen/
weight: 10
---

Um Contao erfolgreich auszuführen, muss der Webserver diese Systemvoraussetzungen erfüllen. Contao wurde ursprünglich 
für den vertrauten [LAMP](https://en.wikipedia.org/wiki/LAMP_(software_bundle))-Stack entwickelt, läuft jedoch auf 
jedem Webserver, der eine aktuelle Version von PHP und MySQL bereitstellt.


## Software-Empfehlungen

Die Mindestanforderungen hängen davon ab, ob du die neueste oder die _Long Term Support-Version_ installierst. Alle 
gepflegten Versionen von Contao sind mit den neuesten PHP- und MySQL-Versionen kompatibel. Daher wird grundsätzlich 
empfohlen, diese immer zu verwenden.

- **PHP:** Version 7.4+ (neueste Patch-Version)
- **MySQL:** Version 8.0+ oder gleichwertiger **MariaDB** Server


#### PHP-Erweiterungen

| Name der Erweiterung                      | Contao 4.4                   | Contao 4.9                                     |
|:------------------------------------------|:-----------------------------|:-----------------------------------------------|
| [DOM][ext-dom] (`ext-dom`)                | **erforderlich**             | **erforderlich**                               |
| [PCRE][ext-pcre] (`ext-pcre`)             | **erforderlich**             | **erforderlich**                               |
| [Intl][ext-intl] (`ext-intl`)             | empfohlen                    | **erforderlich**                               |
| [PDO][ext-pdo] (`ext-pdo`)                | **erforderlich**             | **erforderlich**                               |
| [ZLIB][ext-zlib] (`ext-zlib`)             | **erforderlich**             | **erforderlich**                               |
| [JSON][ext-json] (`ext-json`)             | **erforderlich**             | **erforderlich**                               |
| [Curl][ext-curl] (`ext-curl`)             | **erforderlich**             | **erforderlich**                               |
| [Mbstring][ext-mbstring] (`ext-mbstring`) | **erforderlich**             | **erforderlich**                               |
| [GD][ext-gd] (`ext-gd`)                   | **erforderlich**<sup>1</sup> | **erforderlich**<sup>1</sup> |
| [Imagick][ext-imagick] (`ext-imagick`)    | empfohlen<sup>1</sup>        | erfordert GD, Imagick oder Gmagick<sup>1</sup> |
| [Gmagick][ext-gmagick] (`ext-gmagick`)    | empfohlen<sup>1</sup>        | erfordert GD, Imagick oder Gmagick<sup>1</sup> |

{{% notice note %}}
<sup>1</sup> Contao wählt automatisch eine Bildverarbeitungsbibliothek je nach Verfügbarkeit aus.
Die PHP GD Bibliothek muss allerdings trotzdem noch zusätzlich zur Verfügung stehen.
Die Verwendung von ImageMagick über die PHP Imagick oder Gmagick Bibliothek ist in allen Fällen empfohlen. ImageMagick
bietet bessere Performance und Qualität. Um herauszufinden, welche Bibliothek von Contao nun tatsächlich benutzt wird,
kann folgendes Kommando ausgeführt werden:
```bash
$ vendor/bin/contao-console debug:container contao.image.imagine
```
{{% /notice %}}

[ext-zlib]: https://www.php.net/manual/en/book.zlib.php
[ext-dom]: https://www.php.net/manual/en/book.dom.php
[ext-pcre]: https://www.php.net/manual/en/book.pcre.php
[ext-intl]: https://www.php.net/manual/en/book.intl.php
[ext-pdo]: https://www.php.net/manual/en/book.pdo.php
[ext-json]: https://www.php.net/manual/en/book.json.php
[ext-curl]: https://www.php.net/manual/en/book.curl.php
[ext-mbstring]: https://www.php.net/manual/en/book.mbstring.php
[ext-gd]: https://www.php.net/manual/en/book.image.php
[ext-imagick]: https://www.php.net/manual/en/book.imagick.php
[ext-gmagick]: https://www.php.net/manual/en/book.gmagick.php

Alle erforderlichen Erweiterungen sind in aktuellen PHP-Versionen standardmäßig aktiviert. Einige Hosting-Anbieter 
deaktivieren sie jedoch explizit. Die Anforderungen werden bei der Installation durch 
[Contao Manager](../../installation/contao-manager) oder [Composer](https://getcomposer.org) automatisch überprüft.


#### PHP-Konfiguration (`php.ini`)

Diese Einstellungen sind die Empfehlungen für den idealen Betrieb von Contao. Eine andere Konfiguration bedeutet nicht, 
dass Contao nicht funktioniert, kann jedoch zu unerwartetem Verhalten oder Leistungseinbußen/langsamen Reaktionen 
führen.

| Konfigurationsname              | Webprozess                   | Kommandozeile           | Anmerkungen                                                                                                                                               |
|:--------------------------------|:-----------------------------|:------------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------|
| `memory_limit`                  | Minimum `256M`               | `-1`&nbsp;(unbegrenzt)  |                                                                                                                                                           |
| `max_execution_time`            | Minimum `30`                 | `0` (unbegrenzt)        |                                                                                                                                                           |
| `file_uploads`                  | `On`                         | _nicht anwendbar_       |                                                                                                                                                           |
| `upload_max_filesize`           | Minimum `32M`                | _nicht anwendbar_       |                                                                                                                                                           |
| `post_max_size`                 | wie `upload_max_filesize`    | _nicht anwendbar_       |                                                                                                                                                           |
| `max_input_vars`                | `1000`                       | _nicht anwendbar_       | Benötigt möglicherweise mehr, wenn viele Erweiterungen installiert sind. Erhöhe, wenn die Benutzerzugriffsrechte nicht korrekt gespeichert werden können. |
| `opcache.enable`                | `1` (aktiviert)              | `0` (deaktiviert)       | Das Deaktivieren des Opcode-Cache wirkt sich stark auf die Leistung aus.                                                                                  |
| `opcache.enable_cli`            | `0` (deaktiviert)            | `0` (deaktiviert)       |                                                                                                                                                           |
| `opcache.max_accelerated_files` | `16000` empfohlen            | _nicht anwendbar_       | Ein niedrigerer Wert kann zu einer unnötigen Verlangsamung führen.                                                                                        |
| `safe_mode`                     | `Off`                        | `Off`                   |                                                                                                                                                           |
| `open_basedir`                  | `NULL`                       | `NULL`                  | Wenn aktiv, stelle sicher, dass auf das temporäre Verzeichnis des Systems zugegriffen werden kann.                                                   |


#### MySQL-Konfiguration

- **MySQL** Tabellenformat `InnoDB` (Standard seit MySQL 5.7)
- **MySQL** Option `innodb_large_prefix = 1` (standardmäßig aktiviert seit MySQL 5.7.7)
- **MySQL** Option `innodb_file_format = Barracuda` (nicht mehr notwendig seit MySQL 8.0)
- **MySQL** Option `innodb_file_per_table = 1` (standardmäßig aktiviert seit MySQL 5.6.7)
- **MySQL** Zeichensatz `utf8mb4`


### Mindestanforderungen an PHP

#### Contao 4.11 und später

- **PHP** Version 7.3.0 oder höher ist erforderlich.


#### Contao 4.9 (LTS)

- **PHP** Version 7.2.0 oder höher ist erforderlich.
- Bilder können mit den PHP-Erweiterungen GD (`ext-gd`), Imagick (`ext-imagick`) oder Gmagick (`ext-gmagick`) 
verarbeitet werden.  
Contao erkennt und verwendet automatisch die beste verfügbare Erweiterung.


#### Contao 4.4 (LTS)

- **PHP** Version 5.6.0 oder höher ist erforderlich.
- Die GD-Erweiterung (`ext-gd`) wird für die Bildverarbeitung benötigt.

{{% notice info %}}
Wird ein MySQL Server in Version **8.0.17** oder höher eingesetzt, ist mindestens 
PHP **7.2.0** erforderlich.
{{% /notice %}}


### MySQL-Mindestanforderungen 

Obwohl Contao die [Doctrine DBAL](https://www.doctrine-project.org/projects/dbal.html) Datenbank-Abstraktionsschicht 
verwendet, werden derzeit keine anderen Datenbankserver als MySQL (oder ein kompatibler Fork wie MariaDB) unterstützt.

Contao wurde erfolgreich auf MySQL-Servern der Version 5.1 / 5.5 mit `MyISAM`-Tabellenformat getestet. Die Verwendung 
von `utf8_general_*` anstelle des `utf8mb4`-Zeichensatzes führt zu einer verschlechterten UTF8-Unterstützung (z. B. 
kein Emojis).

Wenn die oben empfohlenen Optionen auf deinem Server nicht aktiviert werden können, konfiguriere bitte eine andere 
Datenbank-Engine und einen anderen Zeichensatz in deiner `app/config/config.yml`-Datei:

{{% notice note %}}
Ab **Contao 4.8** findest du die Datei unter [`config/config.yml`](../../system/einstellungen/#config-yml).  
{{% /notice %}}

```yml
doctrine:
    dbal:
        connections:
            default:
                default_table_options:
                    charset: utf8
                    collate: utf8_unicode_ci
                    engine: MyISAM
```

Es wird außerdem empfohlen, MySQL im "Strict Mode" zu betreiben, um korrupte oder abgeschnittene
Daten zu verhindern und die Datenintegrität zu gewährleisten.

{{% notice note %}}
Ab **Contao 4.9** zeigt das Install-Tool eine Warnmeldung an, wenn der Datenbankserver nicht im
"Strict Mode" läuft.
{{% /notice %}}

Um den "Strict Mode" zu aktivieren, ergänze folgendes in deiner `my.cnf` oder `my.ini` Datei
bzw. stelle sicher, dass die Einstellung entsprechend angepasst oder erweitert wird:

```
[mysqld]
…
sql_mode="TRADITIONAL"
…
```

Wenn die oben empfohlene Einstellung auf deinem Server nicht aktiviert werden kann, konfiguriere
die Verbindungsoptionen bitte in deiner `app/config/config.yml`-Datei ({{< version-tag "4.8" >}} `config/config.yml`-Datei):

```yml
doctrine:
    dbal:
        connections:
            default:
                options:
                    # Depending on the DB driver, the option key is either 1002 (pdo_mysql) or 3 (mysqli)
                    1002: "SET SESSION sql_mode=(SELECT CONCAT(@@sql_mode, ',TRADITIONAL'))"
```


## Webserver

- Ein modernes Hosting ermöglicht es Kunden heute, über ein SSH-Terminal auf ihr Konto zuzugreifen. Dies ist nicht nur 
eine sicherere Verbindung als herkömmliches unverschlüsseltes FTP, sondern ermöglicht auch ein effizientes Debugging 
oder die Entwicklung der Anwendung.

- Es wird empfohlen, den PHP-Stack für die Verwendung von [PHP-FPM](https://php-fpm.org) oder einem ähnlichen 
FastCGI-Setup zu konfigurieren. Durch die Verwendung von 
[`fastcgi_finish_request()`](https://www.php.net/manual/en/function.fastcgi-finish-request.php) kann Contao 
Hintergrundaufgaben (wie die Indizierung des Seiteninhalts) ausführen, ohne dass der Browser auf die Antwort wartet.

### Hosting-Konfiguration

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterordner `web/` der Installation. Setze das 
Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel des Hosting-Providers auf diesen 
Unterordner und richte bei dieser Gelegenheit noch eine Datenbank ein.

Beispiel: `example.com` zeigt auf das Verzeichnis `/www/example/web` 

({{< version-tag "4.12" >}} Dem Standard von Symfony folgend, wurde der öffentlich erreichbare Unterordner von `/web`
in `/public` umbenannt. Falls in deiner Installation ein Verzeichnis `/web` existiert, wird dieses von Contao
automatisch anstelle von `/public` verwendet.)

{{% notice note %}}
Pro Contao-Installation wird deshalb eine eigene (Sub)Domain benötigt.
{{% /notice %}}

## Providerspezifische Einstellungen

Es gibt ein paar wenige große Internet Service Provider, die spezielle Einstellungen für den Betrieb von Contao 
erfordern. Zum Glück sind sie nur die Ausnahme von der Regel. Die Provider-spezifische Einstellungen findest du im 
[Contao-Forum](https://community.contao.org/de/forumdisplay.php?67-Erfahrungen-mit-Webhostern). Sorgenfreies 
Contao-Hosting erhältst du bei den [Contao-Partnern](https://contao.org/de/contao-partner.html) in der 
Leistungskategorie »Webhosting«.

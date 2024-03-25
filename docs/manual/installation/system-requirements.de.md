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


### PHP-Erweiterungen

| Name der Erweiterung                      | ab Contao 4.4                | ab Contao 4.9                                  | ab Contao 4.13                                 |
|:------------------------------------------|:-----------------------------|:-----------------------------------------------|:-----------------------------------------------|
| [DOM][ext-dom] (`ext-dom`)                | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [PCRE][ext-pcre] (`ext-pcre`)             | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [Intl][ext-intl] (`ext-intl`)             | empfohlen                    | **erforderlich**                               | **erforderlich**                               |
| [PDO][ext-pdo] (`ext-pdo`)                | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [ZLIB][ext-zlib] (`ext-zlib`)             | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [JSON][ext-json] (`ext-json`)             | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [Curl][ext-curl] (`ext-curl`)             | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [Mbstring][ext-mbstring] (`ext-mbstring`) | **erforderlich**             | **erforderlich**                               | **erforderlich**                               |
| [GD][ext-gd] (`ext-gd`)                   | **erforderlich**<sup>1</sup> | **erforderlich**<sup>1</sup>                   | **erforderlich**<sup>1</sup>                   |
| [Imagick][ext-imagick] (`ext-imagick`)    | empfohlen<sup>1</sup>        | erfordert GD, Imagick oder Gmagick<sup>1</sup> | erfordert GD, Imagick oder Gmagick<sup>1</sup> |
| [Gmagick][ext-gmagick] (`ext-gmagick`)    | empfohlen<sup>1</sup>        | erfordert GD, Imagick oder Gmagick<sup>1</sup> | erfordert GD, Imagick oder Gmagick<sup>1</sup> |
| [File Information][ext-fileinfo] (`ext-fileinfo`) | -                    | -                                              | **erforderlich**                               |

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

[ext-zlib]: https://www.php.net/manual/de/book.zlib.php
[ext-dom]: https://www.php.net/manual/de/book.dom.php
[ext-pcre]: https://www.php.net/manual/de/book.pcre.php
[ext-intl]: https://www.php.net/manual/de/book.intl.php
[ext-pdo]: https://www.php.net/manual/de/book.pdo.php
[ext-json]: https://www.php.net/manual/de/book.json.php
[ext-curl]: https://www.php.net/manual/de/book.curl.php
[ext-mbstring]: https://www.php.net/manual/de/book.mbstring.php
[ext-gd]: https://www.php.net/manual/de/book.image.php
[ext-imagick]: https://www.php.net/manual/de/book.imagick.php
[ext-gmagick]: https://www.php.net/manual/de/book.gmagick.php
[ext-fileinfo]: https://www.php.net/manual/de/book.fileinfo.php

Alle erforderlichen Erweiterungen sind in aktuellen PHP-Versionen standardmäßig aktiviert. Einige Hosting-Anbieter 
deaktivieren sie jedoch explizit. Die Anforderungen werden bei der Installation durch 
[Contao Manager](../../installation/contao-manager) oder [Composer](https://getcomposer.org) automatisch überprüft.


### PHP-Konfiguration (`php.ini`)

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


### MySQL-Konfiguration

- **MySQL** Tabellenformat `InnoDB` (Standard seit MySQL 5.7)
- **MySQL** Option `innodb_large_prefix = 1` (standardmäßig aktiviert seit MySQL 5.7.7)
- **MySQL** Option `innodb_file_format = Barracuda` (nicht mehr notwendig seit MySQL 8.0)
- **MySQL** Option `innodb_file_per_table = 1` (standardmäßig aktiviert seit MySQL 5.6.7)
- **MySQL** Zeichensatz `utf8mb4`


### Mindestanforderungen an PHP

#### Contao 5.0 and später

- **PHP** Version 8.1.0 oder höher ist erforderlich.


#### Contao 4.13 (LTS)

- **PHP** Version 7.4.0 oder höher ist erforderlich.


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


### Wechsel der PHP-Version

Falls die PHP-Version einer laufenden Contao-Instanz geändert werden soll, sollte immer ein volles `composer update` nach dem Wechsel
durchgeführt werden. Dies ist besonders dann wichtig, wenn zwischen Haupt-Versionen gewechselt wird, z. B. von PHP 7.x zu PHP 8.x - oder
umgekehrt. Dadurch wird für die installierten Pakete die Kompatibilität zu der jeweiligen PHP-Version sichergestellt, da jedes Paket
(inklusive Contao selbst, installierte Contao-Extensions oder Dritt-Pakete) nach spezifischen PHP-Versionen und PHP-Extensions verlangen
kann.

Unter Verwendung des Contao Managers kann das `composer update` in der Systemwartung unter _Composer-Abhängigkeiten_ ausgeführt werden:

![Composer Update im Contao Manager]({{% asset "images/manual/installation/de/composer-update.png" %}}?classes=shadow)


### MySQL-Mindestanforderungen 

Obwohl Contao die [Doctrine DBAL](https://www.doctrine-project.org/projects/dbal.html) Datenbank-Abstraktionsschicht 
verwendet, werden derzeit keine anderen Datenbankserver als MySQL (oder ein kompatibler Fork wie MariaDB) unterstützt.

Contao wurde erfolgreich auf MySQL-Servern der Version 5.7 / 8.0 (und gleichwertigen MariaDB Versionen) mit `InnoDB`-Tabellenformat
getestet. Die Verwendung von `utf8` anstelle des `utf8mb4`-Zeichensatzes führt zu einer verschlechterten UTF8-Unterstützung (z. B. 
keine Emojis).

Wenn die oben empfohlenen Optionen auf deinem Server nicht aktiviert werden können, konfiguriere bitte einen anderen 
Zeichensatz in deiner [`config/config.yml`](../../system/einstellungen/#config-yml)-Datei:

{{% notice note %}}
Vor **Contao 4.8** findest du die Datei unter `app/config/config.yml`.  
{{% /notice %}}

```yml
doctrine:
    dbal:
        connections:
            default:
                default_table_options:
                    charset: utf8
                    collate: utf8_unicode_ci
                    collation: utf8_unicode_ci
```

Es wird außerdem empfohlen, MySQL im "Strict Mode" zu betreiben, um korrupte oder abgeschnittene
Daten zu verhindern und die Datenintegrität zu gewährleisten.

{{% notice note %}}
{{< version-tag "4.9" >}} Das Install-Tool zeigt jetzt eine Warnmeldung an, wenn der Datenbankserver nicht im
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
die Verbindungsoptionen bitte in deiner `config/config.yml`-Datei:

```yml
doctrine:
    dbal:
        connections:
            default:
                options:
                    # Depending on the DB driver, the option key is either 1002 (pdo_mysql) or 3 (mysqli)
                    1002: "SET SESSION sql_mode=(SELECT CONCAT(@@sql_mode, ',TRADITIONAL'))"
```

{{% notice "note" %}}
Der [`TRADITIONAL` SQL Modus](https://dev.mysql.com/doc/refman/8.0/en/sql-mode.html#sqlmode_traditional) ist ein Kombinations-Modus
welcher unter anderem aus den Modi `STRICT_TRANS_TABLES` und `STRICT_ALL_TABLES` besteht. Der »[Strict SQL Modus](https://dev.mysql.com/doc/refman/8.0/en/sql-mode.html#sql-mode-strict)« 
ist aktiv wenn einer dieser Modi aktiviert ist. Der »Strict Modus« ist in aktuellen MySQL und MariaDB Versionen über die Einstellung 
`STRICT_TRANS_TABLES` der Standard, jedoch nutzen viele Shared Hosting Umgebungen eigene Einstellungen. Der Vorteil des Strict Modus ist,
dass fehlerhafte Datenbankoperationen auch tatsächlich einen Fehler verursachen, anstatt ohne Meldung vom Datenbankserver ignoriert zu
werden. Dies führt zu einer verbesserten Datenintegrität und Sicherheit.
{{% /notice %}}


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

{{< version-tag "4.13" >}} Wenn du noch den `/web`-Ordner verwendest,
dann definiere diesen entsprechend, um für zukünftige Contao Versionen gerüstet zu sein:

```json
{
  "extra": {
    "public-dir": "web"
  }
}
```

siehe auch: https://symfony.com/doc/current/configuration/override_dir_structure.html#override-the-public-directory


### Webserver-Konfiguration

In der Konfiguration des Webservers muss sichergestellt sein, dass alle Anfragen von der Applikation über die `index.php` im öffentlichen
Verzeichnis verarbeitet werden (via »URL-Rewriting«). Wie diese Konfiguration aussehen muss hängt von der eingesetzten Webserver-Software 
ab. Weit verbreitete Beispiele sind Apache und NGINX:

{{< tabs groupId="web-server-config" >}}

{{% tab name="Apache" %}}
Für Apache stellt Contao eine [Standard `.htaccess`](https://github.com/contao/contao/blob/5.0.7/manager-bundle/skeleton/public/.htaccess) 
Datei im öffentlichen Verzeichnis zur Verfügung. Damit diese Datei von Apache verarbeitet wird muss sichergestellt sein, dass die Direktive
`AllowOverride All` für das `Directory` in der `VirtualHost` Definition der Webserver-Konfiguration vorhanden ist. Darüberhinaus muss das
Apache-Modul `mod_rewrite` aktiv sein, damit URLs wie `https://example.com/contao/install` möglich sind. Falls beides nicht zutrifft würden
nur URLs wie `https://example.com/index.php/contao/install` möglich sein.

Für Contao muss auch die Einstellung `Options SymLinksIfOwnerMatch` in der `Directory` Konfiguration aktiv sein, da Symlinks zum Einsatz kommen.

Eine minimale `VirtualHost` Konfiguration für den Apache-Webserver könnte also z. B. so aussehen (`…/public` mit `…/web` austauschen für
Contao 4.9 oder älter):

```
<VirtualHost *:80>
    ServerName domain.tld
    ServerAlias www.domain.tld
    DocumentRoot /var/www/project/public

    <Directory /var/www/project/public>
        AllowOverride All
        Require all granted
        Options SymLinksIfOwnerMatch
    </Directory>
</VirtualHost>
```

{{% /tab %}}

{{% tab name="NGINX" %}}
Am wichtigsten ist es sicherzustellen, dass alle Anfragen die nicht an eine existierende Datei gehen an die PHP-Applikation zur Verarbeitung
weitergegeben werden. Dies passiert über die Anweisung `try_files $uri /index.php$is_args$args;`.

Eine minimale `server` Definition für den NGINX könnte so aussehen (`…/public` mit `…/web` austauschen für
Contao 4.9 oder älter):

```
server {
    server_name domain.tld www.domain.tld;
    root /var/www/project/public;

    location / {
        try_files $uri /index.php$is_args$args;
    }

    # Haupt Einstiegspunkt
    location ~ ^/index\.php(/|$) {
        # the exact FastCGI configuration depends on your environment
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi.conf;
        internal;
    }

    # preview.php und contao-manager.phar.php auch zur Verarbeitung erlauben
    location ~ ^/(preview|contao-manager\.phar)\.php(/|$) {
        # the exact FastCGI configuration depends on your environment
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi.conf;
    }
}
```

Eine vollständige NGINX Konfiguration enthält normalerweise mehr Einträge, bspw. um das "not found logging" für statische Ressourcen wie
Bilder oder das `favicon.ico` im Root abzuschalten. In vielen Fällen befinden sich in einer Standard NGINX `server` Konfiguration allerdings
auch Direktiven speziell für die Verarbeitung von Bildern. Hier ist es wichtig auch `try_files $uri /index.php$is_args$args;` am Ende
einzufügen um sicherzustellen, dass Anfragen auf (noch) nicht existierende Bilder von Contao verarbeitet werden. Andernfalls würde die
»Deferred Image Generation« von Contao nicht funktionieren.
{{% /tab %}}

{{< /tabs >}}

Mehr Informationen über die Konfiguration des Webservers können auch aus der [Symfony Dokumentation][SymfonyWebServerConfiguration]
entnommen werden.


## Providerspezifische Einstellungen

Es gibt ein paar wenige große Internet Service Provider, die spezielle Einstellungen für den Betrieb von Contao 
erfordern. Zum Glück sind sie nur die Ausnahme von der Regel. Die Provider-spezifische Einstellungen findest du im 
[Contao-Forum](https://community.contao.org/de/forumdisplay.php?67-Erfahrungen-mit-Webhostern). Sorgenfreies 
Contao-Hosting erhältst du bei den [Contao-Partnern](https://contao.org/de/contao-partner.html) in der 
Leistungskategorie »Webhosting«.

{{% notice "note" %}}
Einige Hosting-Anbieter bieten 1-Klick-Installationen an. Für das beste Nutzungserlebnis empfehlen wir jedoch, bei der 
Installation von Contao den Contao Manager oder die Konsole zu verwenden.
{{% /notice %}}


[SymfonyWebServerConfiguration]: https://symfony.com/doc/current/setup/web_server_configuration.html

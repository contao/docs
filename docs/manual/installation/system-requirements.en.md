---
title: "System Requirements"
description: "Learn about the system requirements to successfully run Contao"
weight: 1
---

To successfully run Contao, the web server needs to meet these system requirements.
Contao was originally built for the familiar [LAMP][LAMP] stack, but it 
runs on any webserver providing a recent version PHP and MySQL.


## Software recommendations

The minimum requirements differ depending on whether you choose to install the
latest or _Long Term Support_ version. All maintained versions of Contao
are compatible with the latest PHP and MySQL versions, so it is basically
recommended to always use those.

- **PHP:** version 7.3+ (latest patch version)
- **MySQL:** version 5.7+ or equivalent **MariaDB** server 


#### PHP extensions

| Extension Name                                      | Contao 4.4   | Contao 4.8           |
|:----------------------------------------------------|:-------------|:---------------------|
| 1. [DOM][ext-dom] (`ext-dom`)             | **required** | **required**         |
| 2. [PCRE][ext-pcre] (`ext-pcre`)          | **required** | **required**         |
| 3. [Intl][ext-intl] (`ext-intl`)          | recommended  | **required**         |
| 4. [PDO][ext-pdo] (`ext-pdo`)             | **required** | **required**         |
| 5. [ZLIB][ext-zlib] (`ext-zlib`)          | **required** | **required**         |
| 6. [JSON][ext-json] (`ext-json`)          | **required** | **required**         |
| 7. [GD][ext-gd] (`ext-gd`)                | **required** | requires 7 or 8 or 9 |
| 8. [Imagick][ext-imagick] (`ext-imagick`) | _not used_   | requires 7 or 8 or 9 |
| 9. [Gmagick][ext-gmagick] (`ext-gmagick`) | _not used_   | requires 7 or 8 or 9 |


All required extensions are enabled by default in current PHP versions. 
Some hosting provider however do disable them explicitly.
The requirements are automatically verified on installation
(through [Contao Manager][Manager] / [Composer][Composer]).


#### PHP configuration (`php.ini`)

These settings are the recommendations for an ideal setup of Contao.
A different configuration will not mean that Contao will not work, but it 
might result in unexpected behavior or degraded performance/slow responses.


| Config Name                     | Web Process                   | Command&nbsp;Line     | Notes                                                                                                                |
|:--------------------------------|:------------------------------|:-----------------|:---------------------------------------------------------------------------------------------------------------------|
| `memory_limit`                  | minimum `256M`                | `-1` (unlimited) |                                                                                                                      |
| `max_execution_time`            | minimum `30`                  | `0` (unlimited)  |                                                                                                                      |
| `file_uploads`                  | `On`                          | _not applicable_ |                                                                                                                      |
| `upload_max_filesize`           | minimum `32M`                 | _not applicable_ |                                                                                                                      |
| `post_max_size`                 | same as `upload_max_filesize` | _not applicable_ |                                                                                                                      |
| `max_input_vars`                | `1000`                        | _not applicable_ | Might need more if a lot of extensions are installed. Increase if the user access rights cannot be stored correctly. |
| `opcache.enable`                | `1` (enabled)                 | `0` (disabled)   | Disabling Opcode Cache will greatly impact performance.                                                              |
| `opcache.enable_cli`            | `0` (disabled)                | `0` (disabled)   |                                                                                                                      |
| `opcache.max_accelerated_files` | `16000` recommended           | _not applicable_ | A lower value can result in unnecessary slowdown.                                                                    |
| `safe_mode`                     | `Off`                         | `Off`            |                                                                                                                      |
| `open_basedir`                  | `NULL`                        | `NULL`           | If active, make sure the system's temporary directory is accessible.                                                 |


#### MySQL configuration

- **MySQL** `InnoDB` table format
- **MySQL** option `innodb_large_prefix = 1` (enabled by default since MySQL 5.7.7)
- **MySQL** option `innodb_file_format = Barracuda`
- **MySQL** option `innodb_file_per_table = 1`
- **MySQL** `utf8mb4` character set


### Minimum PHP requirements

#### Contao 4.5 and later

- **PHP** version 7.1.0 or later is required.
- Images can be processed with the GD (`ext-gd`), Imagick (`ext-imagick`) or Gmagick (`ext-gmagick`) PHP extensions.
  Contao will automatically detect and use the best available extension.


#### Contao 4.4 (LTS)

- **PHP** version 5.6.0 or later is required.
- The GD extension (`ext-gd`) is required to process images.


### Minimum MySQL requirements

Event thought Contao 4 uses the [Doctrine DBAL][DBAL] database abstraction layer,
it currently does not support any other database server than MySQL
(or a compatible fork like MariaDB).

Contao has been successfully tested on MySQL version 5.1 / 5.5 servers with 
`MyISAM` table format. Using `utf8_general_*` instead of the `utf8mb4` 
character set will result in degraded UTF8-support (e.g. no Emojis).
 
If the recommended options above cannot be enabled on
your server, please configure a different database engine and character set
in your `app/config/config.yml` file:

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


## Web Server

- A state-of-the-art hosting today allows customers to access
  their account through an SSH terminal. Not only will this be a more
  secure connection than plain-old unencrypted FTP, it also allows for 
  efficient debugging or development of the application.

- Configuring the PHP stack to use [PHP-FPM][FPM] or a similar FastCGI
  setup is recommended. By using [`fastcgi_finish_request()`][fcgi], Contao can
  run background tasks (like indexing the page content) without having
  the browser wait on the response.


[LAMP]: https://en.wikipedia.org/wiki/LAMP_(software_bundle)
[FPM]: https://php-fpm.org
[DBAL]: https://www.doctrine-project.org/projects/dbal.html
[Manager]: https://contao.org/de/download.html
[Composer]: https://getcomposer.org
[ext-zlib]: https://www.php.net/manual/en/book.zlib.php
[ext-dom]: https://www.php.net/manual/en/book.dom.php
[ext-pcre]: https://www.php.net/manual/en/book.pcre.php
[ext-intl]: https://www.php.net/manual/en/book.intl.php
[ext-pdo]: https://www.php.net/manual/en/book.pdo.php
[ext-json]: https://www.php.net/manual/en/book.json.php
[ext-gd]: https://www.php.net/manual/en/book.image.php
[ext-imagick]: https://www.php.net/manual/en/book.imagick.php
[ext-gmagick]: https://www.php.net/manual/en/book.gmagick.php
[fcgi]: https://www.php.net/manual/en/function.fastcgi-finish-request.php

---
title: 'PHP setup'
description: 'Ideal PHP setup for Contao.'
aliases:
    - /en/performance/php-setup/
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In general, you should always use the latest PHP version supported by Contao. PHP itself is constantly being improved and this usually leads to better performance.

## SAPI

The Server API (SAPI) of PHP is often directly related to the web server used. In the core of PHP itself, 8 SAPIs are currently maintained, of which only 4 can be used to run Contao:

- mod\_php (apache2handler)
- cgi
- fpm (php-fpm)
- litespeed

The SAPI is given with `mod_php`and`litespeed`, since it runs directly as a module of the respective server. Otherwise, the choice should be `fpm`(`php-fpm`) whenever possible because it is currently the only SAPI that supports ( ) `fastcgi_finish_request()`and allows Contao to do some cleanup work after sending the response to the client, which does not reduce the actual runtime of the PHP process but can improve the response time for the visitor.

## OPcache

The greatest performance gain can be achieved by using the PHP OPcache.

Since PHP is an interpreted scripting language, any PHP script is usually interpreted at runtime. The following steps are performed for each file:

1. Lexing (lexical analysis: splits source code into logically related units (so-called tokens))
2. Parsing (semantic analysis: "understands" a lot of tokens. So defines what is valid syntax)
3. Compilation (translates PHP into direct instructions, also called bytecode, which can then be executed by the PHP virtual machine)
4. Execution (the execution of the bytecode)

If a PHP file does not change, steps 1 - 3 are identical every time. Especially the "compilation" is very complex, because PHP makes several checks and optimizations during this step.

The OPcache is a bytecode cache. The OPcache is a bytecode cache. It stores (either in RAM or on the file system) the bytecode generated after step 3 and executes only the already compiled bytecode for each subsequent request.

The OPcache can be configured very finely to the individual needs. There is no general, perfect setup, but here are a few recommendations and explanations:

```ini
; php.ini
; Konfiguriert die maximale Anzahl an Megabytes die für den OPcache verwendet werden dürfen.
; Je höher, desto mehr kann gespeichert werden. 128 MB sollten in den meisten Fällen ausreichen.
; Denk daran: Mehr Extensions = mehr Code = mehr Speicherbedarf
opcache.memory_consumption = 128

; Konfiguriert die maximale Anzahl an Dateien welche der OPcache behandelt.
; Hier gilt das gleiche: Je höher, desto mehr kann gespeichert werden.
; Denk daran: Mehr Extensions = mehr Code = mehr Speicherbedarf
opcache.max_accelerated_files = 20000

; Standardmässig prüft PHP bei jeder Ausführung, ob sich eine Datei seit dem letzten Aufruf verändert hat.
; Das ist praktisch, verlangsamt aber natürlich den Zugriff.
; Wenn du dieses Verhalten deaktivierst, wird sich die Performance verbessern.
; Du musst danach aber auch dafür sorgen, dass der OPcache bei jeder Änderung geleert wird.
opcache.validate_timestamps = 0
```

You can empty the OPcache easily via Contao Manager under the menu item "System maintenance" If you use deployment tools, remember to clear the OPcache after each deployment. Since theCLI process and the web process do not share the OPcode, you cannot delete the OPcode by executing a command, there are several solutions like the [cachetool](https://github.com/gordalina/cachetool) or dassmart-core/accelerator-cache-bundle.

## realpath cache

The Realpath Cache is an often underestimated cache in PHP.

Whenever a file is accessed, a lot of things happen under the hood, because especially with Unix [everything is a file](https://de.wikipedia.org/wiki/Everything_is_a_file), so the kernel must first check whether it is a real file, a directory or a symlink etc. These so-called `stat()`calls are relatively expensive.

PHP caches the result of these calls so that subsequent requests within the same process have the information available without having to access the file system again. For example, if we call one `is_file('/pfad/zum/verzeichnis')``is_dir('/pfad/zum/verzeichnis')`and later on, the second call would be free of charge, because PHP knows from the first call whether it is a file or a directory.

PHP is even smart enough to cache the information for the parent path parts. In our example, this would also `/pfad`be stored `/pfad/zum`in the cache.

File system accesses are very common in Contao. A clean configuration of the realpath cache can make a noticeable difference!

You can configure the TTL and the maximum number of files in yours`php.ini`. Here is a recommendation:

```ini
; php.ini
realpath_cache_size = 4096K
realpath_cache_ttl = 600
```

{{% notice warning %}}
If `open_basedir`configuration is enabled in PHP, [PHP will disable the realpath cache at runtime](https://github.com/php/php-src/blob/4b77a158ef2850582aeb4834c588aba49942776c/main/main.c#L1765), regardless of what is `realpath_cache_size`configured at Unfortunately, many hosters still consider it a necessary security measure, `open_basedir`even though [PHP itself officially rejects its use for security purposes](https://www.php.net/security-note.php) and recommends appropriate measures at the operating system level.
{{% /notice %}}

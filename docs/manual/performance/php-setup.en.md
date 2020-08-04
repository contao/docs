---
title: 'PHP Setup'
description: 'PHP setup recommendations for Contao.'
aliases:
    - /en/performance/php-setup/
---

In general, you should always use the latest PHP version supported by Contao. PHP itself is constantly being improved
and this usually also leads to better performance.

## SAPI

The Server API (SAPI) of PHP is often directly related to the web server used. 8 SAPIs are currently maintained in
PHP itself, only 4 of which can be used to run Contao:

- mod\_php (apache2handler)
- cgi
- fpm (php-fpm)
- litespeed

The SAPI is given with `mod_php` and `litespeed`, since it runs directly as a module of the respective server.
Otherwise, your choice should be `fpm` (`php-fpm`) whenever possible because it is currently the only SAPI
that supports `fastcgi_finish_request()` and thus allows Contao to do some cleanup work after the response is sent back
to the client, which does not reduce the actual runtime of the PHP process but can improve the response time for the visitor.

## OPcache

The greatest performance gain can be achieved by using the PHP OPcache.

Since PHP is an interpreted scripting language, any PHP script is usually interpreted at runtime. The following steps
are performed for every file:

1. Lexing (lexical analysis: splits source code into logically related units (so-called tokens))
2. Parsing (semantic analysis: "understands" a set of tokens. This defines what is valid syntax)
3. Compilation (translates PHP into direct instructions, also called bytecode, which can then be executed by the PHP virtual machine)
4. Execution (the execution of the bytecode)

If a PHP file does not change, steps 1 - 3 are identical every single time. Especially the "compilation" step is very
complex, because PHP applies several checks and optimizations during this step.

The OPcache is a bytecode cache. It stores (either in RAM or on the file system) the bytecode generated after step 3
and executes only the already compiled bytecode for each subsequent request.

The OPcache can be configured very finely to the individual needs. There is no general, perfect setup, but here are a
few recommendations and explanations:

```ini
; php.ini
: Configures the maximum number of megabytes that can be used for the OPcache.
; The higher, the more can be stored. 128 MB should be sufficient in most cases.
; Remember: More extensions = more code = more memory
opcache.memory_consumption = 128

; Configures the maximum number of files the OPcache can handle.
; The same applies here: The higher it is, the more you can store.
; Remember: More extensions = more code = more memory
opcache.max_accelerated_files = 20000

; By default, PHP checks whether a file has changed since the last time it was called every time it is executed.
; This is handy especially during development, but of course it slows down the process.
; If you disable this behavior, performance will improve.
; You will also need to make sure that the OPcache is cleared every time you make a change.
opcache.validate_timestamps = 0
```

You can empty the OPcache easily via Contao Manager under the menu item "System maintenance". If you use deployment tools,
remember to clear the OPcache after each deployment. Since the CLI process and the web process do not share the OPcode,
you cannot delete the OPcode by executing a command. There are several solutions like the [cachetool](https://github.com/gordalina/cachetool)
or the [smart-core/accelerator-cache-bundle](https://github.com/Smart-Core/AcceleratorCacheBundle).

## Realpath Cache

The Realpath Cache is an often underestimated cache in PHP.

Whenever a file is accessed, a lot of things happen under the hood, because especially with Unix
[everything is a file](https://de.wikipedia.org/wiki/Everything_is_a_file), so the kernel must first check whether it
is a real file, a directory or a symlink etc. These so-called `stat()` calls are relatively expensive.

PHP caches the result of these calls so that subsequent requests within the same process have the information available
without having to access the file system again. For example, if we call `is_file('/path/to/directory')` and later on
`is_dir('/path/to/directory')`, the second call would be free, because PHP already knows whether it is a file or a
directory from the earlier call.

PHP is even smart enough to cache the information for the parent path parts. In our example, the information of `/path`
as well as `/path/to` would also be stored in the cache.

File system accesses are very common in Contao. A clean configuration of the Realpath Cache can make a
noticeable difference!

You can configure the TTL and the maximum number of files in your `php.ini`. Here is a recommendation:

```ini
; php.ini
realpath_cache_size = 4096K
realpath_cache_ttl = 600
```

{{% notice warning %}}
If the `open_basedir` configuration is enabled in PHP, [PHP will disable the realpath cache at runtime](https://github.com/php/php-src/blob/4b77a158ef2850582aeb4834c588aba49942776c/main/main.c#L1765),
regardless of what is configured in `realpath_cache_size`. Unfortunately, many hosting providers still consider this a
necessary security measure, even though [PHP itself officially rejects its use for security purposes](https://www.php.net/security-note.php)
and recommends appropriate measures at the operating system level.
{{% /notice %}}

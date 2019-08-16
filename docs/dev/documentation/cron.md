---
title: Cron
description: "Contao's cron functionality."
---


Contao periodically executes some tasks via its own cron functionality. The following
is a list of tasks executed by Contao's own bundles: 

| Task                                   | Interval |
|----------------------------------------|----------|
| Generate calendar RSS feeds            | daily    |
| Purge expired comment subscriptions    | daily    |
| Purge temp folder                      | daily    |
| Purge search cache                     | daily    |
| Generate XML sitemap                   | daily    |
| Purge expired regigstrations           | daily    |
| Purge expired Opt-In tokens            | daily    |
| Generate news RSS feeds                | daily    |
| Purge expired newsletter subscriptions | daily    |


## Configuring the Cron job

By default the cron tasks are executed after a response is sent back to the visitor 
when a request to the Contao site has been made.

{{% notice info %}}
It is recommended to run PHP via PHP-FPM, otherwise cron execution and search indexing
will block any subsequent request by the same user.
{{% /notice %}}

You can disable the front end cron by going to _System_ » _Settings_ » _Cron job 
settings_ and enabling the setting __Disable the command scheduler__. After disabling
the front end cron you should periodically make a request to the `_contao/cron`
route via your own cron job. In a Linux crontab you could use the following for
example:

```none
* * * * * wget -q -O /dev/null https://example.org/_contao/cron
```


## Register Custom Cron Jobs

You can register your own cron jobs using the `$GLOBALS['TL_CRON']` arrays. It is
an associative array with the following keys, representing the available intervals:

* `minutely`
* `hourly`
* `daily`
* `weekly`
* `monthly`

To register simply add another array item with the class and method
of your cron job to one of the intervals in your `contao/config/config.php`:

```php
// contao/config/config.php
$GLOBALS['TL_CRON']['hourly'][] = [
    \App\EventListener\CronListener::class,
    'onHourly'
];
```

```php
// src/EventListener/CronListener.php
namespace App\EventListener;

class CronListener
{
    public function onHourly(): void
    {
        // Do something …
    }
}
```

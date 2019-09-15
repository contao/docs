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
| Purge expired registrations            | daily    |
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


## Registering Cron Jobs

Registering custom cron jobs is similar to [registering to hooks][1].


### Using the PHP array configuration

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
$GLOBALS['TL_CRON']['hourly'][] = [\App\Cron\ExampleCron::class, 'onHourly'];
```

```php
// src/Cron/ExampleCron.php
namespace App\Cron;

class ExampleCron
{
    public function onHourly(): void
    {
        // Do something …
    }
}
```


### Using service tagging

{{< version "4.9" >}}

Cron jobs can also be registered using the `contao.cron` service tag  with the following 
options:

| Option   | Type      | Description                                                                                                                                                             |
| -------- | --------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.cron`.                                                                                                                                                  |
| interval | `string`  | One of the supported intervals: `minutely`, `hourly`, `daily`, `weekly` or `monthly`.                                                                                   |
| method   | `string`  | _Optional:_ the method name in the service. Otherwise the method name will be `onInterval` automatically.                                                               |
| priority | `integer` | _Optional:_ priority of the cron job. By default it will be executed before the legacy cron jobs. Anything with lower than `0` will be executed after legacy callbacks. |
| cli      | `boolean` | _Optional:_ If `true` the cron job will be executed only when the Contao Cron has been invoked via the `contao:cron` command on the command line.                                   |

```yml
# config/services.yaml
services:
    App\Cron\ExampleCron:
        tags:
            -
                name: contao.cron
                interval: daily    # minutely, hourly, daily, weekly, monthly
                method: onDaily    # optional, auto generated from the interval, e.g.: onDaily
                priority: 100      # optional, >0: before $GLOBALS['TL_CRON'], <0: after $GLOBALS['TL_CRON']
                cli: true          # optional, job will only be executed via the contao:cron command
```

You can also use the `Contao\CoreBundle\ServiceAnnotation\Cron` service annotation
together with the `Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface`:

```php
// src/Cron/ExampleCron.php
namespace App\Cron;

use Contao\CoreBundle\ServiceAnnotation\Cron;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ExampleCron implements ServiceAnnotationInterface
{
    /**
     * @Cron("minutely", priority=-1)
     */
    public function onMinutely(): void
    {
        // Do something
    }

    /**
     * @Cron("hourly", priority=32, cli=true)
     */
    public function onHourly(): void
    {
        // Do something on CLI only
    }
}
```


[1]: /framework/hooks/

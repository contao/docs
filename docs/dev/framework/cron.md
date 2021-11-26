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


## Configuring the Cron Job

By default the cron tasks are executed after a response is sent back to the visitor 
when a request to the Contao site has been made.

{{% notice info %}}
It is recommended to run PHP via PHP-FPM, otherwise cron execution and search indexing
will block any subsequent request by the same user.
{{% /notice %}}

You can disable the front end cron by going to _System_ » _Settings_ » _Cron job 
settings_ and enabling the setting __Disable the command scheduler__. After disabling
the front end cron you should periodically let Contao executes its cron jobs, by
either making a request to a web URL, or by executing them via the command line.


### Web URL

In order to trigger cron job execution via a web URL, a request to the `_contao/cron`,
route, e.g. `https://example.org/_contao/cron`, needs to be made. In a Linux crontab 
you could use the following instructions for example:

```none
* * * * * wget -q -O /dev/null https://example.org/_contao/cron
```


### Command Line

{{< version "4.9" >}}

You can also execute the cron jobs directly via the command line:

```bash
$ vendor/bin/contao-console contao:cron
```

This is also the recommended way of periodically executing Contao's cron jobs. In
a Linux crontab you could use the following instructions for example:

```none
* * * * * php /path/to/contao/vendor/bin/contao-console contao:cron
```

{{% notice tip %}}
There is no HTTP request context available on the command line. However, Contao needs
this to generate the sitemap for example. You can set the domain either in the settings of
your website roots or you can define a default domain in your application configuration.
See the [Symfony Routing Documentation](https://symfony.com/doc/4.4/routing.html#generating-urls-in-commands)
for more details.

```yml
# config/parameters.yaml
parameters:
    router.request_context.host: 'example.org'
    router.request_context.scheme: 'https'
```
{{% /notice %}}


## Registering Cron Jobs

Registering custom cron jobs is similar to [registering to hooks][1].


### Using the PHP Array Configuration

You can register your own cron jobs using the `$GLOBALS['TL_CRON']` arrays. It is
an associative array with the following keys, representing the available intervals:

* `minutely`
* `hourly`
* `daily`
* `weekly`
* `monthly`

To register your own job, add another array item with the class and method
of your cron job to one of the intervals in your [`config.php`][contaoConfig]:

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


### Using Service Tagging

{{< version "4.9" >}}

Cron jobs can also be registered using the `contao.cronjob` service tag  with the following 
options:

| Option | Description |
| --- | --- |
| `interval` | Can be `minutely`, `hourly`, `daily`, `weekly`, `monthly`, `yearly` or a full CRON expression, like `*/5 * * * *`. |
| `method` | Will default to `__invoke` or `onMinutely` etc. when a named interval is used. Otherwise a method name has to be defined. |

```yml
# config/services.yaml
services:
    App\Cron\ExampleCron:
        tags:
            -
                name: contao.cronjob
                interval: '0 */2 * * *'
                method: onEveryTwoHours
```


### Using Service Annotation

You can also use the `Contao\CoreBundle\ServiceAnnotation\CronJob` service annotation
to tag the service accordingly:

```php
// src/Cron/ExampleCron.php
namespace App\Cron;

use Contao\CoreBundle\ServiceAnnotation\CronJob;

/**
 * @CronJob("hourly")
 */
class ExampleCron
{
    public function __invoke(): void
    {
        // Do something
    }
}
```

The annotation can either be used on the class or on individual methods. When it 
is used on the class, either the `__invoke` method will be used - or an auto generated 
method name (e.g. `onMinutely`), if present.

{{% notice note %}}
If you need an interval like `*/5 * * *` you need to escape either the `*` or `/` 
with `\`, since `*/` would close the PHP comment.
{{% /notice %}}


### Scope

In some cases a cron job might want to know in which "scope" it is executed in - 
i.e. as part of a front end request or as part of the cron command on the command 
line interface. The `Cron` service will pass a scope parameter to the cron job's 
method.

```php
namespace App\Cron;

use Contao\CoreBundle\Cron\Cron;

class HourlyCron
{
    public function __invoke(string $scope): void
    {
        // Do not execute this cron job in the web scope
        if (Cron::SCOPE_WEB === $scope) {
            return;
        }

        // …
    }
}
```


### Testing

Contao keeps track of a cronjob's last execution in the `tl_cron_job` table. Thus,
if you want to test a cron job even though it has already been executed within
its defined interval, either truncate the whole table or delete the entry for the
specific cron job you want to test. If the table is empty every cronjob will be 
executed on the first cron call. After that only on its defined interval.

{{% notice note %}}
In Contao **4.4**, the table is called `tl_cron` and it contains only the last execution
times of the named intervals, not the last execution time of individual cron jobs.
{{% /notice %}}


[1]: /framework/hooks/
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations

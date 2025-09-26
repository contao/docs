---
title: Cron
description: "Contao's cron functionality."
---

Contao periodically executes some tasks via its own cron functionality. These include mainly cleanup tasks such as

* Purge expired comment subscriptions
* Purge expired registrations
* Purge expired Opt-In tokens
* etc.

Cronjobs that are registered via the the `contao.cronjob` service tag can be listed using the following command:

```bash
$ vendor/bin/contao-console debug:container --tag contao.cronjob
```

However, keep in mind that this will not find cronjobs that are registered via the legacy `config.php` (see below). Unfortunately there is no convenient way in Contao 4 to display registered legacy cronjobs. If you want to look these up
you could either search for any `$GLOBALS['TL_CRON']` definitions in your Contao instance via your IDE, or use Xdebug
for example in order to inspect the `$GLOBALS['TL_CRON']` array.


## Configuring the Cron Job

By default the cron tasks are executed after a response is sent back to the visitor 
when a request to the Contao site has been made.

{{% notice note %}}
It is recommended to run PHP via PHP-FPM, otherwise cron execution and search indexing
will block any subsequent request by the same user.
{{% /notice %}}

In Contao 4 you can disable the front end cron by going to _System_ » _Settings_ » _Cron job 
settings_ and enabling the setting __Disable the command scheduler__. You can also force this setting via your application's config:

```yaml
# config/config.yaml
contao:
    localconfig:
        disableCron: true
```

After disabling the front end cron you should periodically let Contao execute its cron jobs, either via the command line (recommended)
or by making a request to the web URL.


### Command Line

{{< version "4.9" >}}

Executing the cron jobs via the command line is done via the `contao:cron` command:

```bash
$ vendor/bin/contao-console contao:cron
```

This is also the recommended way of periodically executing Contao's cron jobs. In
a Linux crontab you could use the following instructions for example:

```bash
* * * * * /usr/bin/php /path/to/contao/vendor/bin/contao-console contao:cron
```

{{% notice tip %}}
There is no HTTP request context available on the command line. However, Contao needs
this to generate the sitemap for example. You can set the domain either in the settings of
your website roots or you can define a default domain in your application configuration.
See the [Symfony Routing Documentation](https://symfony.com/doc/4.4/routing.html#generating-urls-in-commands)
for more details.

```yaml
# config/parameters.yaml
parameters:
    router.request_context.host: 'example.org'
    router.request_context.scheme: 'https'
```
{{% /notice %}}


### Web URL

In order to trigger the execution of cron jobs via a web URL, a request to the `_contao/cron`
route, e.g. `https://example.org/_contao/cron`, needs to be made. In a Linux crontab 
you could use the following instructions for example:

```bash
* * * * * wget -q -O /dev/null https://example.org/_contao/cron
```


## Registering Cron Jobs

Registering custom cron jobs is similar to [registering to hooks][1]. As of Contao **4.13**, there are four different ways of registering
a cron job. The recommended way is using _PHP attributes_. Which one you use depends on your setup. For example, if you still need to 
support PHP 7 you can use _annotations_. If you still develop cron jobs for Contao **4.4** then you still need to use the _PHP array configuration_.

{{% notice tip %}}
Using attributes or annotations means it is only necessary to create one file for the respective adaptation when using Contao's default
way of automatically registering services under the `App\` namespace within the `src/` folder.
{{% /notice %}}

Generally cron jobs can be registered through the `contao.cronjob` service tag. The following options are supported for this service tag:

| Option | Description |
| --- | --- |
| `interval` | Can be `minutely`, `hourly`, `daily`, `weekly`, `monthly`, `yearly` or a full CRON expression, like `*/5 * * * *`. |
| `method` | Will default to `__invoke` or `onMinutely` etc. when a named interval is used. Otherwise a method name has to be defined. |

{{< tabs groupid="attribute-annotation-yaml-php" style="code" >}}
{{% tab title="Attribute" %}}
{{< version-tag "4.13" >}} Contao implements [PHP attributes](https://www.php.net/manual/en/language.attributes.overview.php) (available 
since **PHP 8**) with which you can tag your service to be registered as a cron job.

```php
// src/Cron/ExampleCron.php
namespace App\Cron;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCronJob;

#[AsCronJob('hourly')]
class ExampleCron
{
    public function __invoke()
    {
        // Do something …
    }
}
```

In this case the cron job is executed once per hour. As mentioned before this parameter can also be a full CRON expression, e.g. 
`*/5 * * * *` for "every 5 minutes".
{{% /tab %}}

{{% tab title="Annotation" %}}
{{< version-tag "4.9" >}} Contao also supports its own annotation formats via the [Service Annotation Bundle](https://github.com/terminal42/service-annotation-bundle).

```php
// src/Cron/ExampleCron.php
namespace App\Cron;

use Contao\CoreBundle\ServiceAnnotation\CronJob;

/** 
 * @CronJob("hourly")
 */
class ExampleCron
{
    public function __invoke()
    {
        // Do something …
    }
}
```

In this case the cron job is executed once per hour. As mentioned before this parameter can also be a full CRON expression, e.g. 
`*/5 * * * *` for "every 5 minutes".

{{% notice info %}}
If you need an interval like `*/5 * * * *` you need to escape either the `*` or `/` 
with `\`, since `*/` would close the PHP comment.
{{% /notice %}}
{{% /tab %}}

{{% tab title="YAML" %}}
{{< version-tag "4.9" >}} As mentioned before you can manually add the `contao.cronjob` service tag in your service configuration.

```yaml
# config/services.yaml
services:
    App\Cron\ExampleCron:
        tags:
            - { name: contao.cronjob, interval: hourly }
```
```php
// src/Cron/ExampleCron.php
namespace App\Cron;

class ExampleCron
{
    public function __invoke()
    {
        // Do something …
    }
}
```

Only the `interval` parameter is required. In this case the cron job is executed once per hour. As mentioned before this parameter can also
be a full CRON expression, e.g. `*/5 * * * *` for "every 5 minutes".
{{% /tab %}}

{{% tab title="PHP" %}}

{{% notice "note" %}}
This method is deprecated since Contao **4.13** and will not work in Contao **5** anymore.
{{% /notice %}}

You can register your own cron jobs using the `$GLOBALS['TL_CRON']` arrays. It is
an associative array with the following keys, representing the available intervals:

* `minutely`
* `hourly`
* `daily`
* `weekly`
* `monthly`

To register your own job, add another array item with the class and method
of your cron job to one of the intervals in your `config.php`:

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
{{% /tab %}}

{{< /tabs >}}


### Scope

In some cases a cron job might want to know in which "scope" it is executed in - 
i.e. as part of a front end request or as part of the cron command on the command 
line interface. The `Cron` service will pass a scope parameter to the cron job's 
method.

```php
// src/Cron/HourlyCron.php
namespace App\Cron;

use Contao\CoreBundle\Cron\Cron;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCronJob;
use Contao\CoreBundle\Exception\CronExecutionSkippedException;

#[AsCronJob('hourly')]
class HourlyCron
{
    public function __invoke(string $scope): void
    {
        // Skip this cron job in the web scope
        if (Cron::SCOPE_WEB === $scope) {
            throw new CronExecutionSkippedException();
        }

        // …
    }
}
```

{{% notice "info" %}}
The above example uses the `CronExecutionSkippedException` (available since Contao **4.9.38** and **5.0.8**) which will tell Contao's Cron 
service that the excution of this cron job was skipped and thus the last run time will stay untouched in the database. Thus the cron job 
will be executed again at the next opportunity, ensuring that its logic is always executed within the CLI scope in this case.
{{% /notice %}}


### Testing

Contao keeps track of a cronjob's last execution in the `tl_cron_job` table. Thus,
if you want to test a cron job even though it has already been executed within
its defined interval, either truncate the whole table or delete the entry for the
specific cron job you want to test. If the table is empty every cronjob will be 
executed on the first cron call. After that only on its defined interval.

{{% notice "tip" %}}
You can use the `doctrine:query:sql` command to quickly execute a query on your database, e.g.:

```
vendor/bin/contao-console doctrine:query:sql "TRUNCATE tl_cron_job"
```
{{% /notice %}}

{{% notice info %}}
In Contao **4.4**, the table is called `tl_cron` and it contains only the last execution
times of the named intervals, not the last execution time of individual cron jobs.
{{% /notice %}}


[1]: /framework/hooks/
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations
[AsyncMessaging]: /framework/async-messaging/

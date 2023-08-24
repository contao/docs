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
the front end cron you should periodically let Contao execute its cron jobs, either by
executing them via the command line or by making a request to a web URL.


### Command Line

{{< version "4.9" >}}

You can also execute the cron jobs directly via the command line:

```bash
$ vendor/bin/contao-console contao:cron
```

This is also the recommended way of periodically executing Contao's cron jobs. In
a Linux crontab you could use the following instructions for example:

```bash
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

{{< version-tag "5.0" >}} You are also able to force the the execution of cron jobs via the `--force` parameter:

```bash
$ vendor/bin/contao-console contao:cron --force
```

{{< version-tag "5.0" >}} You can also execute just one specific cron job from the command line:

```bash
$ vendor/bin/contao-console contao:cron "App\Cron\ExampleCron"
```

The latter can also be combined with the `--force` option.


### Web URL

In order to trigger cron job execution via a web URL, a request to the `_contao/cron`,
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

{{< tabs groupId="attribute-annotation-yaml-php" >}}
{{% tab name="Attribute" %}}
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

{{% tab name="Annotation" %}}
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

{{% notice note %}}
If you need an interval like `*/5 * * *` you need to escape either the `*` or `/` 
with `\`, since `*/` would close the PHP comment.
{{% /notice %}}
{{% /tab %}}

{{% tab name="YAML" %}}
{{< version-tag "4.9" >}} 

As mentioned before you can manually add the `contao.hook` service tag in your service configuration.

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

{{% tab name="PHP" %}}

{{% notice "info" %}}
This method is deprecated since Contao **4.13** and does not work in Contao **5** anymore.
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
namespace App\Cron;

use Contao\CoreBundle\Cron\Cron;
use Contao\CoreBundle\Exception\CronExecutionSkippedException;

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

{{% notice "note" %}}
The above example uses the `CronExecutionSkippedException` (available since Contao **4.9.38** and **5.0.8**) which will tell Contao's Cron 
service that the excution of this cron job was skipped and thus the last run time will stay untouched in the database. Thus the cron job 
will be executed again at the next opportunity, ensuring that its logic is always executed within the CLI scope in this case.
{{% /notice %}}

### Asynchronous cron jobs

{{< version "5.1" >}}

The cron job framework executes jobs synchronously in the order they were tagged (normal service priority tags). 
This means that if you e.g. have 10 cron jobs, and they all take 20 seconds to run, it will take the framework 200 
seconds to complete. For most cron jobs, this is not a problem because they don't usually run 20 seconds.

However, if you have cron jobs that trigger child processes or are asynchronous in any other way, you would want 
them to start immediately in parallel without blocking the other cron jobs. You can do this by returning a 
`GuzzleHttp\Promise\PromiseInterface`:

```php
namespace App\Cron;

use Contao\CoreBundle\Cron\Cron;
use Contao\CoreBundle\Exception\CronExecutionSkippedException;
use GuzzleHttp\Promise\Promise;

class HourlyCron
{
    public function __invoke(string $scope): void
    {
        // Skip this cron job in the web scope
        if (Cron::SCOPE_WEB === $scope) {
            throw new CronExecutionSkippedException();
        }

        return new Promise(static function () use (&$promise): void {
            // Do something that is asynchronous
            $promise->resolve('Done with asynchronous process.');
        });
    }
}
```

Because most asynchronous processes are most likely things like a spawned child process using Symfony's `Process` 
component, Contao also provides a utility service for that:

```php
namespace App\Cron;

use Contao\CoreBundle\Cron\Cron;
use Contao\CoreBundle\Exception\CronExecutionSkippedException;
use Contao\CoreBundle\Util\ProcessUtil;

class HourlyCron
{
    public function __construct(private ProcessUtil $processUtil) {}

    public function __invoke(string $scope): void
    {
        // Skip this cron job in the web scope
        if (Cron::SCOPE_WEB === $scope) {
            throw new CronExecutionSkippedException();
        }

        // Long-running process - probably not "ls" :-)
        $promise = $this->processUtil->createPromise(new Process(['ls']));
        
        // There's even a helper for another application command, so you don't have to worry about
        // finding the right PHP binary etc.:
        $promise = $this->processUtil->createSymfonyConsoleProcess('app:my-command', '--option-1', 'argument-1');
        
        return $promise;
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

{{% notice tip %}}
This is not necessary anymore in Contao **5.0** and up as you can use the `--force` command line option as explained [above](#command-line).
{{% /notice %}}


[1]: /framework/hooks/
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations

---
title: Logging
description: "Use Monolog and custom log channels in Contao."
---

Contao uses [Monolog][Monolog] and the [Symfony Monolog Bundle][MonologBundle]. 
Monolog provides a standardized and simple, yet flexible and extensible solution
to log messages and process them through a variety of sources.

You can use all features of Monolog and the Monolog Bundle in your Contao application.

## Log Channels

In more complex applications, log channels are used to group related messages and
optionally process them differently.

A Symfony application typically uses channels such as `request` or `security`
to assign messages to the appropriate parts of the application.

Contao itself uses the `contao` channel for all Contao-specific messages.

{{% notice note %}}
Contao also creates additional log channels for sending messages with a specific context.
For more information, see [Contao channels](#contao-channels-convenience-loggers).
{{% /notice %}}

## Log Contexts & Contao's System Log

The system log in the Contao back end lists all log entries that have been specifically flagged for Contao.
This flagging is done via a special context that is attached to a particular log entry:

```php
use Contao\CoreBundle\Monolog\ContaoContext;

$logger->info(
    'This message is intended for the Contao system log', 
    ['contao' => new ContaoContext(__METHOD__, ContaoContext::GENERAL)]
);
```

All messages with this `ContaoContext` are automatically sent to the system log
and do not appear in the regular log files of the application.

In addition to the mere tagging, the `ContaoContext` also offers the possibility to add
custom meta information to a message.

In the example shown above, a reference to the triggering method `__METHOD__` and the action 
`ContaoContext::GENERAL` are added alongside the text message.

## Contao Channels & Convenience Loggers

{{< version "4.13" >}}

To conveniently create log entries without having to manually define the appropriate
context, Contao provides pre-configured logger services.

For example, to log messages with a proper `ContaoContext` and the action `CRON`,
you have the following options:

### Service Tagging

You can tag your service with the appropriate [Monolog tag][MonologBundle.channels]
to automatically receive a logger that sends messages to a specified channel.

```yaml
# config/services.yaml
services:
    App\MyService:
        arguments:
            - '@?logger'
        tags:
            - { name: monolog.logger, channel: contao.cron }
```

If the channel of the logger starts with `contao.`, messages to the channel are
automatically assigned a matching `ContaoContext`.
The text after the `contao.` part determines the action of the `ContaoContext`.

In addition to the action, log messages in these channels are automatically supplied
with a reference to the triggering method.

**Example:**  
The channel `contao.cron` configures all messages with the action `ContaoContext::CRON`
and a reference to the triggering method. Thus, messages within this channel will appear
in the system log with the action `CRON`.

### Injecting the Correct Logger Service

If you don't want to tag your service or if your service has to send messages to multiple
log channels you may also use [Autowiring][MonologBundle.autowire]
to get one or multiple matching logger service(s):

```php
use Psr\Log\LoggerInterface;

// Parameter must match Psr\Log\LoggerInterface $<camelCased channel name> + Logger
public function __construct(
    private readonly LoggerInterface $contaoCronLogger,
    private readonly LoggerInterface $contaoErrorLogger,
) {
}
```

If you do not want to use autowiring, you can also define the appropriate logger(s)
in the service configuration:

```yaml 
# config/services.yaml
services:
    App\MyService:
        arguments:
            - '@monolog.logger.contao.cron'
            - '@monolog.logger.contao.error'
```

Please note that you can only use existing log channels in this way. 
The following channels are provided by Contao out of the box:

* `contao.access`
* `contao.configuration`
* `contao.cron`
* `contao.email`
* `contao.error`
* `contao.files`
* `contao.forms`
* `contao.general`

You may add additional channels in your [application configuration][MonologBundle.additional_channels].

## Extensibility

Thanks to Monolog, all log actions are fully customizable. 
Depending on your requirements, you may add your own [handlers, formatters or processors][Monolog.extension].

For a start, you can take a look at `Contao\CoreBundle\Monolog\ContaoTableProcessor`
and `Contao\CoreBundle\Monolog\ContaoTableHandler` to see how Contao prepares certain
messages for the system log (processor) and writes them to the `tl_log` table (handler).

## Testing

Generally, a logger should always be configured as an [optional dependency][OptionalDependencies].
This way you can simply ignore the logger in tests.

If you still need a logger in your tests, there are two options:

1. If you don't care if and how the logger is called, you can simply use a `Psr\Log\NullLogger`.
2. To check the usage of the logger within your test subject,
  you can use a mock object of `Psr\Log\LoggerInterface`.


[Monolog]: https://seldaek.github.io/monolog/
[MonologBundle]: https://symfony.com/doc/current/logging.html
[MonologBundle.channels]: https://symfony.com/doc/current/logging/channels_handlers.html
[MonologBundle.autowire]: https://symfony.com/doc/current/logging/channels_handlers.html#how-to-autowire-logger-channels
[MonologBundle.additional_channels]: https://symfony.com/doc/current/logging/channels_handlers.html#configure-additional-channels-without-tagged-services
[OptionalDependencies]: https://symfony.com/doc/current/service_container/optional_dependencies.html
[Monolog.extension]: https://seldaek.github.io/monolog/doc/02-handlers-formatters-processors.html

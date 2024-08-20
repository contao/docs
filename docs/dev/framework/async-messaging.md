---
title: "Asynchronous Messaging"
description: Asynchronous Messaging using the Symfony Messenger integration
---

{{% notice note %}}
The feature has been around since Contao 5.1, but we're describing how it works as of version 5.3.10 where it was
revamped in order to address various issues with the previous implementation.
{{% /notice %}}

Contao provides an integration of the Symfony Messenger in the [Contao Managed Edition][Managed_Edition] which is 
documented here. This chapter assumes thorough understanding of the [Symfony Messenger Component][Symfony_Messenger] 
and its concepts. So in case you do not understand the concepts of

- Messages
- Message Buses
- Message Handlers
- Transports (Senders and Receivers)
- Transport Serialization
- Message Routing
- Consuming messages using `messenger:consume`

please stop reading here and [head to the Symfony documentation][Symfony_Messenger]. We also recommend, you have 
worked with the Symfony Messenger in the context of a regular Symfony application before. It will help you 
differentiate between what is specific to Contao and what's not.

## The transport configuration

The default Contao Managed Edition Symfony Messenger configuration looks like this:

```yaml
framework:
    messenger:
        buses:
            messenger.bus.default:
                middleware:
                    - doctrine_ping_connection
                    - doctrine_close_connection
        failure_transport: contao_failure
        transports:
            sync: sync://
            contao_failure: doctrine://default?table_name=tl_message_queue&queue_name=failure&auto_setup=false
            contao_prio_high: doctrine://default?table_name=tl_message_queue&queue_name=prio_high&auto_setup=false
            contao_prio_normal: doctrine://default?table_name=tl_message_queue&queue_name=prio_normal&auto_setup=false
            contao_prio_low: doctrine://default?table_name=tl_message_queue&queue_name=prio_low&auto_setup=false
```

The `sync` transport as well as the `contao_failure` transport are not special in any way. The only thing you'll 
notice is that we use the Doctrine Transport and store messages in the `tl_message_queue` table. This table does not 
have any DCA assigned as we'd need to stay up to date with the changes in Symfony. If they added another column for 
example, it would fail. That's why the table is dynamically added and configured in our 
`Contao\CoreBundle\EventListener\DoctrineSchemaListener` meaning that anytime you run `contao:migrate`, any schema 
changes will be detected and your database will get updated. Hence, we use `auto_setup=false`.

Then, we define 3 default transports that represent priorities:

* contao_prio_high
* contao_prio_normal
* contao_prio_low

## The `WebWorker`

For the Contao Managed Edition, we cannot assume that every user is able to have a `messenger:consume` worker
running all the time. It's fair to assume that probably most of the Contao setups run on some shared hosting
provider without any access to any process manager like `Supervisor`, `systemd`, `launchd`, `runit` and Co.

So when you as an extension developer want to use the Symfony Messenger integration, we somehow have to make sure,
your messages aren't lost and being worked on , even if the Contao user installs Contao somewhere where no 
`messenger:consume` worker is running.
This is exactly what the `WebWorker` is all about. The `WebWorker` uses the Symfony `kernel.terminate` event to work 
on the messages that are on the queue. This is how it works:

1. It will not do this for all transports but only for the ones configured. In the Contao Managed Edition, this is 
   enabled by default for all our 3 default transports, like so:

   ```yaml
   contao:
      messenger:
         web_worker:
            transports:
               - contao_prio_high
               - contao_prio_normal
               - contao_prio_low
   ```
   
   If you define an additional transport and want to make sure, the `WebWorker` takes care of your transport as 
   well, make sure to add it to `contao.messenger.web_worker.transports`.
2. It will try to be smart about working on those defined transports. If it detects that there is actually a real worker
   working on one of those queues, it will not work on any message from that transport during the web request. For 
   this, the `WebWorker` listens to the `WorkerStartedEvent` as well as the `WorkerRunningEvent` and remembers that the 
   given transport is running using a cache entry that is valid for a grace period of `10` minutes (configurable). On 
   `kernel.terminate`, if that cache entry is still valid, it will conclude that a real worker is working on this 
   transport and thus do nothing. If, however, that cache entry does not exist (never did or the grace period has 
   expired) it will conclude that no worker is running, and thus it will start consuming messages from that 
   transport within the web process. This is basically as if you had the `sync` transport configured with one additional advantage: As this happens in `kernel.terminate`, depending on your PHP setup, it is deferred to after the response has been sent to the client 
   (`fastcgi_finish_request()`). So it is a win for you in any case!
3. The `WebWorker` always limits its inline `messenger:consume` logic to a maximum of `30` seconds (not configurable)
   in order to make sure the web process does not run forever.

The grace period to determine whether a worker is running or not is needed because if there's only one worker 
working on e.g. `contao_prio_high` and the message the worker is currently working on takes - say - 15 minutes to 
process, no `WorkerRunningEvent` is going to be dispatched for `contao_prio_high` which would in turn force the 
`WebWorker` to fall back to the `kernel.terminate` logic. This might be the desired behavior after the default grace 
period of `10` minutes but probably also not - this very much depends on the type of messages and the number of real 
workers you have configured. You may adjust the grace period like so (use the `\DateInterval` duration specification):

```yaml
contao:
   messenger:
      web_worker:
         grace_period: 'PT5M' # 5 minutes
```

## The built-in cron job process manager

Contao wouldn't be Contao if it didn't try to find an ingenious solution for the missing process manager on shared 
hosting providers problem. Sure, most of them do not - and probably never will - provide an option for you to 
register e.g. `php bin/console messenger:consume contao_prio_high`.

But what most of them have is - you guessed it - cron jobs!

In the Contao Managed Edition - in case you [configured the Contao Cron job Framework with a real, minutely
cronjob][Minutely_Cron] - Contao will automatically start asynchronous `messenger:consume` commands which are configured to 
stop after `60` seconds effectively resulting in having continuously running workers that are running for a minute. 
Then the minutely cron job comes back around and our workes are started again - as if we had a real process manager 
running! The workers even support simple autoscaling! Here's the default configuration of the Contao Managed Edition:

```yaml
contao:
    messenger:
        workers:
            -
                # Read: Start "messenger:consume contao_prio_high --time-limit=60 --sleep=5",
                # try to achieve a low  number of messages pending on the queue (5) and make
                # sure, you never start more than 10 of these processes.
                transports:
                    - contao_prio_high
                options:
                    - --time-limit=60
                    - --sleep=5
                autoscale:
                    desired_size: 5
                    max: 10
            -
                # Read: Start "messenger:consume contao_prio_normal --time-limit=60 --sleep=10",
                # try to achieve a low number of messages pending on the queue (10) and make
                # sure, you never start more than 10 of these processes.
                transports:
                    - contao_prio_normal
                options:
                    - --time-limit=60
                    - --sleep=10
                autoscale:
                    desired_size: 10
                    max: 10
            -
                # Read: Start "messenger:consume contao_prio_low --time-limit=60 --sleep=20",
                # try to achieve a normal number of messages pending on the queue (20) and make
                # sure, you never start more than 10 of these processes.
                transports:
                    - contao_prio_low
                options:
                    - --time-limit=60
                    - --sleep=20
                autoscale:
                    desired_size: 20
                    max: 10
```

{{% notice note %}}
In reality, things are a bit more complex than just starting the `messenger:consume` commands every minute because as 
messages could take longer than one minute to finish being processed, we also have to supervise how many processes are running 
and not blindly start them as we might accumulate too many processes like that. But this would go beyond the scope 
of the documentation. Just know that Contao has your back and takes care of that problem for you! 😎
{{% /notice %}}

{{% notice idea %}}
You don't need `Supervisor`, `systemd` or the likes when using the Contao Managed Edition! Just configure a real 
minutely cron job triggering `contao:cron` and you're good to go!
{{% /notice %}}

## The priority message interfaces

So we know how the `WebWorker` fallback works, and we have a solution for running the `messenger:consume` commands. One 
piece is missing, though: How does Contao know that your message (let's assume a `CreateAsyncZipFileMessage` in this example) 
should be routed to the `contao_prio_low`, `contao_prio_normal` or `contao_prio_high` transports? The routing part is missing!
So as an extension developer, you would need to specify the target like so:

```yaml
framework:
    messenger:
        routing:
            'App\Messenger\CreateAsyncZipFileMessage': contao_prio_high
```

This would be totally doable using a `Contao Manager Plugin` and adjusting the Symfony Framework configuration, 
appending your entry. However, because Contao ships with the 3 default priorities, there are also built-in 
interfaces for those 3 which are then routed automatically:

```yaml
framework:
    messenger:
        routing:
            'Contao\CoreBundle\Messenger\Message\HighPriorityMessageInterface': contao_prio_high
            'Contao\CoreBundle\Messenger\Message\NormalPriorityMessageInterface': contao_prio_normal
            'Contao\CoreBundle\Messenger\Message\LowPriorityMessageInterface': contao_prio_low
```

{{% notice idea %}}
Instead of fiddling with the container and the configuration, all you need to do is implement one of the priority
interfaces and the routing is configured.
{{% /notice %}}

## Using the entire Contao Managed Edition framework as a developer

The entire setup presented above ensures that - as a developer - you can enjoy a zero-configuration asynchronous 
message processing setup, provided you have the Contao cronjob framework running. You only need your message and the 
respective message handler:

1. Register a minutely cronjob for `contao:cron` - aka configure the Contao cron job framework.
2. Create your message:
    ```php
    namespace App\Messenger;
    
    use Contao\CoreBundle\Messenger\Message\HighPriorityMessageInterface;
   
    class CreateAsyncZipFileMessage implements HighPriorityMessageInterface
    {
        public function __construct(public array $fileIds)
        {
        }
    }
    ```
3. Create your message handler:
    ```php
    namespace App\Messenger;
        
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;

    #[AsMessageHandler]
    class CreateAsyncZipFileMessageHandler
    {
        public function __invoke(CreateAsyncZipFileMessage $message): void
        {
            foreach ($message->fileIds as $fileId) {
                // Create your zip file asynchronously which can take a long while now 🔥
            }
        }
    }
    ```
4. Dispatch the message from e.g. your controller and watch as the magic unfolds.
5. Done! 🎉

{{% notice tip %}}
For a working example, take a look at the `SearchIndexMessage`, `SearchIndexMessageHandler` and `SearchIndexListener` 
classes to see how Contao uses the Messenger to create and update the search index outside the actual HTTP 
request to serve responses to the users faster.
{{% /notice %}}

## Adjusting the configuration 

In case you want to work with a real process manager, there is no point in using built-in cron job workers.
You can disable them by adjusting the configuration:

```yaml
contao:
    messenger:
        workers: [] # No workers will disable the cron job worker feature
```

The `WebWorker` will automatically detect that you have real workers running. This means you don't have to adjust the
configuration. It will only kick in if your grace period is over because e.g. a worker takes too long to process a 
message or something on your infrastructure failed and thus no workers are running. Having this fallback 
solution to ensure your messages are always being worked on might be even a desirable state! If you want to absolutely
avoid having any messages being worked on in the web process, however, you can easily disable this behavior as well by
having the `WebWorker` listen to no transport at all:

```yaml
contao:
   messenger:
      web_worker:
         transports: [] # No transports will disable the web worker feature
```

{{% notice tip %}}
Because PHP (or your code) might leak memory, it's usually a good idea to use any of the limit options (see Symfony 
docs) and have the `messenger:consume` process stop after some time or RAM usage to free those resources. Just have 
your process manager respawn the process again.
{{% /notice %}}


[Managed_Edition]: /getting-started/initial-setup/managed-edition
[Symfony_Messenger]: https://symfony.com/doc/current/messenger.html
[Minutely_Cron]: /framework/cron#command-line

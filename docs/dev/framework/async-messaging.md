---
title: "Asynchronous Messaging"
description: Asynchronous Messaging using the Symfony Messenger integration
---

{{< version "5.1" >}}

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
            contao_prio_high: contao-auto-fallback://contao_prio_high?target=contao_prio_high_doctrine&fallback=sync
            contao_prio_normal: contao-auto-fallback://contao_prio_normal?target=contao_prio_normal_doctrine&fallback=sync
            contao_prio_low: contao-auto-fallback://contao_prio_low?target=contao_prio_low_doctrine&fallback=sync
            contao_prio_high_doctrine: doctrine://default?table_name=tl_message_queue&queue_name=prio_high&auto_setup=false
            contao_prio_normal_doctrine: doctrine://default?table_name=tl_message_queue&queue_name=prio_normal&auto_setup=false
            contao_prio_low_doctrine: doctrine://default?table_name=tl_message_queue&queue_name=prio_low&auto_setup=false
```

The `sync` transport as well as the `contao_failure` transport are not special in any way. The only thing you'll 
notice is that we use the Doctrine Transport and store messages in the `tl_message_queue` table. This table does not 
have any DCA assigned as we'd need to stay up to date with the changes in Symfony. If they added another column for 
example, it would fail. That's why the table is dynamically added and configured in our 
`Contao\CoreBundle\EventListener\DoctrineSchemaListener` meaning that anytime you run `contao:migrate`, any schema 
changes will be detected and your database will get updated. Hence, we use `auto_setup=false`.

Then, we have 3 default transports that represent priorities:

* contao_prio_high
* contao_prio_normal
* contao_prio_low

They use the `contao-auto-fallback` transport, which is a transport specific to Contao. We'll get to this transport 
in a second but let's look at the meaning of the configuration:

```none
contao-auto-fallback://%current-transport%?target=%target-transport%&fallback=%fallback-transport%
```

* `%current-transport%` must be the same as the transport name itself. It is required so the `AutoFallbackTransport` 
  can get information about the transport.
* `%target-transport%` is the transport name that we would like to send the message to.
* `%fallback-transport%` is the transport name that the message is sent to in case the target is not "available" 
  (we'll get to that)

So this section reads as follows:

```yaml
framework:
    messenger:
        transports:
            # Create new transport named "contao_prio_high". It should use the "contao-auto-fallback"
            # transport, and we instruct it about the fact that we are "contao_prio_high" and we target 
            # "contao_prio_high_doctrine" and in case this should not be available, fall back to the
            # "sync" transport.
            contao_prio_high: contao-auto-fallback://contao_prio_high?target=contao_prio_high_doctrine&fallback=sync

            # Create new transport named "contao_prio_normal". It should use the "contao-auto-fallback"
            # transport, and we instruct it about the fact that we are "contao_prio_normal" and we target 
            # "contao_prio_normal_doctrine" and in case this should not be available, fall back to the
            # "sync" transport.
            contao_prio_normal: contao-auto-fallback://contao_prio_normal?target=contao_prio_normal_doctrine&fallback=sync

            # Create new transport named "contao_prio_low". It should use the "contao-auto-fallback"
            # transport,  and we instruct it about the fact that we are "contao_prio_low" and we target 
            # "contao_prio_low_doctrine" and in case this should not be available, fall back to the
            # "sync" transport.
            contao_prio_low: contao-auto-fallback://contao_prio_low?target=contao_prio_low_doctrine&fallback=sync
```

The 3 target transports `contao_prio_high_doctrine`, `contao_prio_normal_doctrine` and `contao_prio_low_doctrine` 
use the default Doctrine Transport again, which you should be familiar with. The only thing special here is that we 
use `auto_setup=false`. This is, as already mentioned, because we update our database schema ourselves during 
`contao:migrate`. 

So what about this `contao-auto-fallback` transport?

## The `AutoFallbackTransport`

For the Contao Managed Edition, we cannot assume that every user is able to have a `messenger:consume` worker 
running all the time. It's fair to assume that probably most of the Contao setups run on some shared hosting 
provider without any access to any process manager like `Supervisor`, `systemd`, `launchd`, `runit` and Co.

So when you as an extension developer want to use the Symfony Messenger integration, we somehow have to make sure, 
your messages aren't lost, even if the Contao user installs Contao somewhere where no `messenger:consume` worker is 
running. 
This is exactly what the `AutoFallbackTransport` is all about. It works as follows:

1. When you start `messenger:consume contao_prio_high contao_prio_normal contao_prio_low`, our 
   `EventListenerWorkerListener` listens to the `WorkerStartedEvent` as well as the 
   `WorkerRunningEvent` and pings the `AutoFallbackNotifier` for each of those 3 transports.
2. The `AutoFallbackNotifier` stores that the transport is running in cache and saves 
   this state for `60` seconds (it does so for all the 3 of them).
3. The `AutoFallbackTransport` asks the `AutoFallbackNotifier` whether the passed `%current-transport%` is running 
   (hence we have to pass this in the configuration). If so, it will forward the message to the `%target-transport%`.
   If not, it will fall back to the `%fallback-transport%` which in the Contao Managed Edition (and probably most 
   cases if you want to override the configuration) is `sync`.

{{% notice warning %}}
This means that there might be a gap of 60 seconds where messages could in theory get lost. That would happen if 
your worker once ran and Contao only detects after 60 seconds that it doesn't anymore, and you have sent a message 
within those 60 seconds. If you have a real process manager, you may omit the `AutoFallbackTransport` entirely. See 
[Adjusting the configuration](#adjusting-the-configuration).
{{% /notice %}}

## The built-in cron job process manager

Contao wouldn't be Contao if it didn't try to find an ingenious solution for the missing process manager on shared 
hosting providers problem. Sure, most of them do not - and probably never will - provide an option for you to 
register `php bin/console messenger:consume contao_prio_high contao_prio_normal contao_prio_low` but what most of 
them have, is - you guessed it - cron jobs!

In the Contao Managed Edition - in case you [configured the Contao Cron job Framework with a real, minutely
cronjob][Minutely_Cron] - Contao will automatically start asynchronous `messenger:consume` commands which are configured to 
stop after `60` seconds effectively resulting in having continously running workers that are running for a minute. 
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
                # try to achieve a normal  number of messages pending on the queue (20) and make
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

{{% notice idea %}}
You don't need `Supervisor`, `systemd` or the likes when using the Contao Managed Edition! Just configure a real 
minutely cron job triggering `contao:cron` and you're good to go!
{{% /notice %}}

## The priority message interfaces

So we know how the transport works, and we have a solution for running the `messenger:consume` commands. One piece is 
missing, though: How does Contao know that your message (let's assume a `CreateAsyncZipFileMessage` in this example) 
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
    class SearchIndexMessageHandler
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

In case you want to work with a real process manager, there is no point in using the `AutoFallbackTransport` or the 
built-in cron job workers. You can disable it by adjusting the configuration:

```yaml
framework:
    messenger:
        transports:
            # How about RabbitMQ?
            contao_prio_high: amqp://guest:guest@localhost:5672/%2f/messages
            # Or keep the existing Doctrine integration
            # (note the missing "_doctrine" suffix in the transport name)
            contao_prio_normal: doctrine://default?table_name=tl_message_queue&queue_name=prio_normal&auto_setup=false
            contao_prio_low: ...
contao:
    messenger:
        workers: [] # No workers will disable the cron job worker feature
```

Now ensure that you run `messenger:consume` for all 3 built-in transports plus your own additional ones, in case you 
configured any.

{{% notice tip %}}
Because PHP (or your code) might leak memory, it's usually a good idea to use any of the limit options (see Symfony 
docs) and have the `messenger:consume` process stop after some time or RAM usage to free those resources. Just have 
your process manager respawn the process again.
{{% /notice %}}


[Managed_Edition]: ./../getting-started/initial-setup/managed-edition
[Symfony_Messenger]: https://symfony.com/doc/current/messenger.html
[Minutely_Cron]: ./cron.md#command-line
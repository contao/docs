---
title: Jobs
description: "Contao's jobs framework."
---

{{< version "5.7" >}}

{{% notice "warning" %}}
The entire jobs framework is currently considered *experimental* and therefore not covered by Contao's BC promise. Classes marked with `@experimental` should be considered internal for now.
Use the framework and help it get better by providing pull requests or feedback on GitHub. However,
be prepared for behavioral changes.
{{% /notice %}}

The Jobs framework provides a way to create, persist, and manage background jobs in Contao.
It is designed for both **system-owned** and **user-owned** jobs, and integrates with Contao's back end user system.

The entry point is the `Contao\CoreBundle\Job\Jobs` service , which acts as the primary API for job creation and retrieval. The idea is that you interact with this service and Contao will take over the tedious work of displaying the jobs, their status, live-updates etc. in the Contao back end.

## Overview

Jobs are represented as immutable `Job` DTOs.
Every job consists of:

- **UUID** — a unique identifier
- **Type** — a string describing the purpose or category of the job
- **Status** — a `Status` enum (`new`, `pending`, `completed`, etc.)
- **Owner** — an `Owner` value object representing either the system or a back end user
- **Timestamp** — creation timestamp
- **Public** — whether the job is visible to others or not (only available for system jobs)

## Creating Jobs

The `Jobs` service offers multiple ways to create jobs:

```php
use Contao\CoreBundle\Job\Jobs;
use Contao\CoreBundle\Job\Job;

// Injected via dependency injection
public function __construct(private Jobs $jobs) {}

// Create a job for the current back end user if logged in, otherwise it's a system job automatically
$job = $this->jobs->createJob('data_export');

// Create a job owned by the system and list it also for other users
$job = $this->jobs->createSystemJob('cache_clear', public: true);

// Create a job for a specific user only visible to themselves
$job = $this->jobs->createUserJob('import_task', $userId);
```

## Retrieving Jobs

```php
// Find all jobs for the current user that are new or pending
$jobs = $this->jobs->findMyNewOrPending();

// Fetch a specific job by UUID
$job = $this->jobs->getByUuid($uuid);
```

## Persisting Jobs

After creating or updating a `Job` object, you must persist it:

```php
$job = $job->markPending();
$this->jobs->persist($job);
```

## Working with a Job

The `Job` class is a **data transfer object** with the following key methods:

```php
$job->getUuid();         // string
$job->getType();         // string
$job->getStatus();       // Status enum
$job->getOwner();        // Owner object
$job->getCreatedAt();    // \DateTimeImmutable
$job->isPublic();        // bool
```

Jobs are immutable — use the provided methods that return modified copies rather than mutating the object directly:

```php
// When you start working on a job, mark it pending
$job = $job->markPending();

// When the job is completed successfully, mark it as such
$job = $job->markCompleted();

// When the job failed, you may want to add an error
$job = $job->markFailed(['my_error']); // internally also calls ->withErrors()

// Add warning translation keys to a job (Future: to be displayed in the back end)
$job = $job->withWarnings(['my_warning']);

// Add error translation keys to a job (Future: to be displayed in the back end)
// Also see markFailed()
$job = $job->withErrors(['my_error']);

// Update the progress (Future: to be displayed in the back end)
$job = $job->withProgress(42); // 42% completed

// Add any metadata to a job (must be serializable). Not used to display in the back end but for
// you to store intermediate steps, additional information, etc.
$job = $job->withMetadata(['api_key' => 'foobar', 'iteration_offset' => 11]);

// A lot of jobs will require a real background worker on CLI to run, so there's a
// simple helper you can use if that was not the case
$job = $job->markFailedBecauseRequiresCLI();
```

## Managing progress of a job

A `Job` stores progress as a percentage (0–100).

```php
// If you already know the percentage, you can set it manually.
// Progress must be between 0 and 100.
$job = $job->withProgress(42.5);

// If you know how many items you processed already and the total,
// you can let the job itself calculate the percentage.
$job = $job->withProgressFromAmounts(50, 200); // => progress becomes 25.0

// Sometimes you don't know the total amount of work up front.
// In that case, pass null as $total (default, you can also just leave it empty).
// This internally uses a logarithmic curve to show monotonic progress
// (it always increases), but caps at 95% so it never reaches 100%
// until the job is actually completed. This guarantees that the user
// sees progress (so the job is still running) but it's never done
$job = $job->withProgressFromAmounts(10, null);

// Once the job is finished, mark it as completed.
// This automatically sets progress to 100%.
$job = $job->markCompleted();
```

## Adding attachments to jobs

You can add attachments to jobs, and you don't have to worry how the users will be able to download them. Contao handles
all that for you transparently in the Jobs overview.

```php
// Add a simple text attachment (string contents):
$this->jobs->addAttachment($job, 'report.txt', "Export finished.\nRows: 123\n");

// Add a binary attachment via stream (recommended for large files):
$stream = fopen('/path/to/export.zip', 'rb');
$this->jobs->addAttachment($job, 'export.zip', $stream);
fclose($stream);
```

## Example

This is a full example how to use the jobs framework within an asynchronous message, handled via the [asynchronous
messaging framework][Async_Messaging].

```php
#[AsMessageHandler]
class MyMessageHandler
{
    public function __construct private readonly Jobs $jobs, private readonly Connection $connection) {
    }

    public function __invoke(MyMessage $message): void
    {
        $job = $this->jobs->getByUuid($message->getJobId());

        // Job gone or already completed
        if (!$job || $job->isCompleted()) {
            return;
        }
        
        // Mark a job pending as soon as you start processing it:
        $job = $job->markPending();
        $this->jobs->persist($job);
        
        // In this example, the total is unknown, but we want to show progress to the user.
        foreach ($this->connection->fetchAllAssociative('SELECT * FROM foo') as $i => $item) {
            // Do heavy work
            $job = $job->withProgressFromAmounts($i + 1);
            $this->jobs->persist($job);
        }
        
        // Add an attachment and mark the job done
        $this->jobs->addAttachment($job, 'report.txt', "Export finished.\nRows: 123\n");
        $job = $job->markCompleted();
        $this->jobs->persist($job);
    }
}
```

[Async_Messaging]: /framework/async-messaging
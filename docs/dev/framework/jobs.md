---
title: Jobs
description: "Contao's jobs framework."
---

{{< version "5.6" >}}

{{% notice "warning" %}}
The entire jobs framework is currently considered *experimental* and therefore not covered by Contao's BC promise. Classes marked with `@experimental` should be considered internal for now.
Use the framework and help it get better by providing pull requests or feedback on GitHub. However,
be prepared for behavioral changes.
{{% /notice %}}

The Jobs framework provides a way to create, persist, and manage background jobs in Contao.
It is designed for both **system-owned** and **user-owned** jobs, and integrates with Contao's backend user system.

The entry point is the `Contao\CoreBundle\Job\Jobs` service , which acts as the primary API for job creation and retrieval. The idea is that you interact with this service and Contao will take over the tedious work of displaying the jobs, their status, live-updates etc. in the Contao backend.

## Overview

Jobs are represented as immutable `Job` DTOs.
Every job consists of:

- **UUID** — a unique identifier
- **Type** — a string describing the purpose or category of the job
- **Status** — a `Status` enum (`new`, `pending`, `completed`, etc.)
- **Owner** — an `Owner` value object representing either the system or a backend user
- **Timestamp** — creation timestamp
- **Public** — whether the job is visible to others or not (only available for system jobs)

## Creating Jobs

The `Jobs` service offers multiple ways to create jobs:

```php
use Contao\CoreBundle\Job\Jobs;
use Contao\CoreBundle\Job\Job;

// Injected via dependency injection
public function __construct(private Jobs $jobs) {}

// Create a job for the current backend user if logged in, otherwise it's a system job automatically
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

// Add warning translation keys to a job (Future: to be displayed in the backend)
$job = $job->withWarnings(['my_warning']);

// Add error translation keys to a job (Future: to be displayed in the backend)
// Also see markFailed()
$job = $job->withErrors(['my_error']);

// Update the progress (Future: to be displayed in the backend)
$job = $job->withProgress(42); // 42% completed

// Add any metadata to a job (must be serializable). Not used to display in the backend but for
// you to store intermediate steps, additional information, etc.
$job = $job->withMetadata(['api_key' => 'foobar', 'iteration_offset' => 11]);

// A lot of jobs will require a real background worker on CLI to run, so there's a
// simple helper you can use if that was not the case
$job = $job->markFailedBecauseRequiresCLI();
```


## Plans for the future

Here's a short list of what is certainly planned for the framework in future versions:

- Display the progress using a progress bar
- Display and translate warnings
- Display and translate errors
- Add helpers for attaching file downloads
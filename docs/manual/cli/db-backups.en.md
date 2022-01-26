---
title: "Database Backups"
description: "Creating database backups made easy"
aliases:
    - /en/cli/database-backups/
---

{{< version "4.13" >}}

Contao provides everything you need for a reliable database backup. Once configured, you can enjoy your good night
sleep, because whatever happens to the database, you have your backups ready and can restore the latest one
with just a single command!

By default, the backups are stored and managed in `var/backups`. The following commands are available
for managing them:

## contao:backup:create

Of course, the most important command. Without having a backup, we can do very little with the other commands. 
The simplest form of use is without any arguments:

```bash
vendor/bin/contao-console contao:backup:create
```

Done. Contao will now create a backup in `var/backups` and add the current date and time to it.
By default, it is also compressed directly to avoid wasting space on your system.

Backups always start with an arbitrary name (`backup` by default) and are separated from the date/time information by `__`.
So you will have a file in `var/backups` which looks like this: `backup__20220126153243.sql.gz`.

If you want, you can change the name and thus the time yourself by specifying the complete backup name. By omitting
`.gz` you also conveniently disable compression:

```bash
vendor/bin/contao-console contao:backup:create my_super_backup_name__20220101000000.sql
```

{{% notice tip %}}
Every time a new backup is created, Contao automatically cleans up obsolete backups. See
section "[Configuration](#configuration)" for more information.
{{% /notice %}}

## contao:backup:list

This command lets us display the existing backups. The output should look something like this:

```bash
--------------------- ----------- ------------------------------- 
Created               Size        Name
--------------------- ----------- ------------------------------- 
2022-01-26 15:32:43   73.14 KiB   backup__20220126153243.sql.gz
--------------------- ----------- -------------------------------
```

## contao:backup:restore

This command lets you restore one of the existing backups. By default, the most recent backup is restored.
However, you can also specify a specific backup:

```bash
# The most recent backup
vendor/bin/contao-console contao:backup:restore

# Any given backup
vendor/bin/contao-console contao:backup:restore backup__20220126153243.sql.gz
```

{{% notice warning %}}
The database must be completely emptied before restoring a backup.
{{% /notice %}}

## Have backups created automatically

Since Contao manages the backup directory automatically, you can use a cron job to create your backups at any time 
of your choice. For example, how about creating one daily at 23:10? An entry in the `crontab`
could look like this:

```
10 23 * * * /pfad/zum/system/vendor/bin/contao-console contao:backup:create
```

## Configuration {#configuration}

You can configure which database tables should be ignored during a backup, as well as the retention policy.
The retention policy defines how long older backups remain stored on the system.

The default settings are as follows:

```yml
# config/config.yml
contao:
    backup:
        ignore_tables: ['tl_crawl_queue', 'tl_log', 'tl_search', 'tl_search_index', 'tl_search_term']
        keep_max: 5
        keep_intervals: ['1D', '7D', '14D', '1M']
```

So the configured tables are ignored during a backup and a maximum of `5` backups are retained.
However, not the most recent five, but the ones matching the `keep_intervals` configuration. Using `keep_intervals`
you can define any number of intervals. For each of these intervals the **oldest** backup will be kept.
If you have defined a cronjob that triggers a daily backup, as shown in this article, then the system will keep
5 backups by default. Namely

1) The newest backup just created
2) The oldest backup of the last 24 hours (`1D` = now - 1 day).
3) The oldest backup of the last 7 days (`7D` = now - 7 days)
4) The oldest backup of the last 14 days (`14D` = now - 14 days)
5) The oldest backup of the last month (`1M` = now - 1 month)

The following descriptors are available:

* `Y` for years
* `M` for months
* `D` for days
* `W` for weeks
* `H` for hours
* `M` for minutes
* `S` for seconds

Descriptors can also be combined: One year, two months and 5 hours would be `1Y2M5H`.

{{% notice warning %}}
Note that if you configure both `keep_max` and `keep_intervals`, `keep_max` should always be at least 1 greater
than the number of `keep_intervals` (the newest plus the oldest per interval). `keep_max` always wins. It serves
as a kind of safety setting, so that never more than `keep_max` backups are kept.
{{% /notice %}}
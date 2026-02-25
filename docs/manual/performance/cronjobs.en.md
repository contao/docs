---
title: 'Cronjob Framework'
description: 'Setting up the Contao Cronjob framework.'
aliases:
    - /en/performance/cronjobs/
---

Contao ships with a cronjob framework out of the box. In short, this allows developers to register cronjobs 
for their own extensions in a simpler and consistent way.

By default, cronjobs are executed whenever someone visits the website. This can negatively affect the
performance of your website, which is why it is recommended to set up real cronjobs on the server.

{{% notice note %}}
Cron jobs triggered by a website visit or the `_contao/cron` route do not execute all registered jobs, only
those designed for this trigger. The back end search index, for example, is only built via a real CLI cron job.
This is another reason to set up a real cron job on the server.
{{% /notice %}}

This is very easy to achieve thanks to Contao's cronjob framework. All that is needed is a single minutely
cronjob that initializes the framework. Contao then automatically takes care of running all registered cronjobs 
of the extensions at the correct intervals.

So we achieve a big advantage with a relatively small effort.

The cronjob for this must look like this:

```
* * * * * <php-binary> <contao-directory>/vendor/bin/contao-console contao:cron
```

Replace `<php-binary>` with the path to the PHP CLI binary of your current version. A complete
example could look like this:

```
* * * * * /opt/plesk/php/8.2/bin/php /var/www/vhosts/my.host.com/vendor/bin/contao-console contao:cron
```

{{% notice tip %}}
Additional information can be found in [the developer documentation](https://docs.contao.org/dev/framework/cron/).
{{% /notice %}}

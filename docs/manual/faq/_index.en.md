---
title: "Questions and answers"
description: "Answers to the most frequently asked questions"
aliases:
    - /en/faq/
weight: 90
---

Here you will find a collection of the most frequently asked questions with the appropriate answers.

If you have a suggestion for this section, use the "Edit this page" link in the top right-hand corner.
If you have a GitHub account and are logged in, GitHub automatically creates a forum where you can add your suggestions. 
You can then use GitHub to create a pull request.


## General

{{% faq "I have forgotten my administrator password, how can I reset it?" %}}
If there are multiple records in the database table "tl_user" for which the admin flag is set, you can reset the first 
value for all of them to create a new administrator in the Contao [install toolbar](/en/installation/contao-installtool/).
{{% /faq %}}

{{% faq "I have forgotten the Install Tool password, how can I reset it?" %}}
Remove the line in the file "system/config/localconfig.php" starting with `$GLOBALS['TL_CONFIG']['installPassword']`. 
Afterwards you can set a new password with the [Install-Tool](/en/installation/contao-installtool/).
{{% /faq %}}

{{% faq "Can I maintain multiple websites with Contao?" %}}
Yes Contao supports [multi-domain operation](/en/layout/site-structure/multi-domain-operation/) and 
multilingual [websites](/en/layout/site-structure/multilingual-websites/).
{{% /faq %}}

{{% faq "Can I maintain multilingual websites with Contao?" %}}
Yes Contao supports [multilingual websites](/en/layout/site-structure/multilingual-websites/).
{{% /faq %}}

{{% faq "How do I enable the Contao debug mode?" %}}
You can activate the [Contao debug mode](/en/system/debug-mode/) via the backend.
{{% /faq %}}

{{% faq "Where can I find more Contao resources?" %}}
You can find more Contao resources on the [project website](https://contao.org/en/network.html).
{{% /faq %}}

{{% faq "May I use Contao for commercial projects?" %}}
Yes, the [GNU Lesser General Public License](https://www.gnu.org/licenses/old-licenses/lgpl-2.1.html) (LGPL), 
under which Contao has been licensed since version 2.5, allows you to use the system for commercial projects. 
Please note that the copyright notices in the Contao files may not be removed or changed according to the license terms.
{{% /faq %}}

{{% faq "How can I refresh the »Application Cache« from the console?" %}}
If you want to refresh the »Application Cache« you can do this via the 
[Console](https://docs.contao.org/dev/reference/commands/): 

```php
vendor/bin/contao-console cache:clear --no-warmup
vendor/bin/contao-console cache:warmup
```
{{% /faq %}}



## Template

{{% faq "How can I display all variables of my template?" %}}
The information about this can be found under [Show Template Data](/en/layout/templates/php/template-data/).
{{% /faq %}}

{{% faq "How can I configure the TinyMCE editor?" %}}
The information about this can be found under [TinyMCE Editor Configuration](/en/guides/tinymce-configuration/).
{{% /faq %}}


## Installation

{{% faq "Notification: The database server is not running in strict mode!" %}}
This is a hint how to activate the strict mode. More information can be found [here](../installation/system-requirements/).
{{% /faq %}}


## Configuration and adjustment

{{% faq "Can I change the directory »web« to »public«?" %}}
Yes. You have to rename the directory. Check if the entry `"public-dir": "web"` exists in the "composer.json" and remove it or change it to
`public`. Then set this directory as the document root via the admin panel of your hosting provider. Afterwards execute `composer install` 
from the manager or the console. 
{{% /faq %}}

{{% faq "How can I change the Contao backend path?" %}}
{{< version-tag "4.13" >}} You can add the entry `route_prefix` in config.yaml and then you have to empty the application cache once using the Contao Manager or the console.

```yaml
# config/config.yaml
contao:
    backend:
        route_prefix: '/myadmin'
```
{{% /faq %}}

{{% faq "No e-mail is sent via my Form, what do I have to do?" %}}
Check the [SMTP details](/en/system/settings/#e-mail-sending-configuration) of your hoster in your `parameters.yaml` or add them if missing.
Then you have to empty the application cache once via Contao Manager ("Maintenance" &gt; "Application Cache" &gt; "Rebuild Production Cache") 
or via the console.
{{% /faq %}}

{{% faq "Can I use a different e-mail Address as sender for forms?" %}}
The e-mail address set in "Settings &gt; E-mail address of the system administrator" is also used as the sender for e-mails sent by the form generator. 
You can enter an additional e-mail address in the "Site structure" section for the "Starting point of a website" page type. 
This E-Mail address will then be used as the sender.
Since Contao 4.10 you can [set different e-mail configurations](/en/system/settings/#different-e-mail-configurations-and-sender-addresses) per website starting point, form and newsletter channel.
{{% /faq %}}

{{% faq "How can I add the language parameter to the URL?" %}}
You can add the entry `prepend_locale: true` in [config.yaml](/en/system/settings/#config-yml) and then you have to 
empty the application cache once using the Contao Manager ("Maintenance" &gt; "Application Cache" &gt; "Rebuild Production Cache") or the console.
Since Contao 4.10, you can freely define the URL prefix, independently of the language.
```yaml
# config/config.yaml
contao:
    prepend_locale: true
```
{{% /faq %}}

{{% faq "Can the URL suffix .html be removed?" %}}
You can add the entry `url_suffix: ''` in [config.yaml](/en/system/settings/#config-yml) and then you have to 
empty the application cache once using the Contao Manager ("Maintenance" &gt; "Application Cache" &gt; "Rebuild Production Cache") or the console. 
```yaml
# config/config.yaml
contao:
    url_suffix: ''
```
{{% /faq %}}

{{% faq "Why is my HTML code not applied in the TinyMCE editor?" %}}
Answers can be found in the [TinyMCE Editor Configuration](/en/guides/tinymce-configuration/) section.
{{% /faq %}}


## File management

{{% faq "My pictures are not displayed in the frontend, what can I do?" %}}
Check in the [file manager](/en/file-manager/) if the directory with your images is marked as "Public". Also make sure that there is no outdated `.htaccess` file in the `/web` folder or a parent folder of your installation.
{{% /faq %}}

{{% faq "Is it possible to hide the search in the file manager?" %}}
Yes. Via a DCA entry:

```php
    //contao/dca/tl_files.php
    unset($GLOBALS['TL_DCA']['tl_files']['list']['sorting']['panelLayout']);
```
{{% /faq %}}


## Theme

{{% faq "Why are changes to my SCSS files not applied?" %}}
If you make changes to a [SCSS partial file](/en/guides/sass-less-integration/), 
you must then empty the script cache in "System Maintenance". 
{{% /faq %}}


## Contao Manager

{{% faq "Why do I need the Contao Manager?" %}}
You need the Contao Manager to install/upgrade/uninstall Contao and extensions. You can find more information 
under [About Contao Manager](/en/installation/contao-manager/).
{{% /faq %}}

{{% faq "Can I add the Contao Manager to an existing installation?" %}}
Yes, the [Contao Manager recognizes](/en/installation/contao-manager/#can-contao-manager-be-added-to-an-existing-installation) 
your existing Contao installation during the installation process. 
{{% /faq %}}

{{% faq "How to update the Contao Manager?" %}}
The [Contao Manager](/en/installation/contao-manager/#how-to-update-the-contao-manager) automatically performs 
an update check when it is accessed. If a new version is available, Contao Manager will update itself.
{{% /faq %}}

{{% faq "What is the Composer Resolver Cloud?" %}}
The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows you to install Composer dependencies 
via the [Contao Manager](/en/installation/contao-manager/) even if your server does not have enough memory.
{{% /faq %}}

{{% faq "How can I renew the »Application Cache« via Contao Manager?" %}}
If you want to refresh the »Application Cache« you can do this in the 
[Contao Manager](/en/installation/contao-manager/) »Maintenance/Application Cache« area.
{{% /faq %}}

{{% faq "The Contao Manager has hung up" %}}
If the Contao Manager stops responding, the console output window does not close, or after a reload of the manager page
or after a reload of the manager page you always get the same output, delete the file `contao-manager` in the directory `task.json`.
delete the file `task.json`.

After that, the Contao Manager should run again.
{{% /faq %}}

{{% faq "Can I rename the ».phar« file?" %}}
Yes. You can use any file name you want. However, the Contao Manager is no longer accessible from the Backend. 
In this case, you can change the [config.yaml](/en/system/settings/#config-yml) accordingly. Afterwards, you have to empty the application cache 
once using the Contao Manager ("Maintenance" &gt; "Application Cache" &gt; "Rebuild Production Cache") or the console.
```yaml
# config/config.yaml
contao_manager:
    manager_path: your-name.phar.php
```
{{% /faq %}}

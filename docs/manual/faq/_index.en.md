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

{{% expand "I have forgotten my administrator password, how can I reset it?" %}}
If there are multiple records in the database table "tl_user" for which the admin flag is set, you can reset the first 
value for all of them to create a new administrator in the Contao [install toolbar](/en/installation/contao-installtool/).
{{% /expand %}}

{{% expand "I have forgotten the Install Tool password, how can I reset it?" %}}
Remove the line in the file "system/config/localconfig.php" starting with complete`$GLOBALS['TL_CONFIG']['installPassword']`. 
Afterwards you can set a new password with the [Install-Tool](/en/installation/contao-installtool/).
{{% /expand %}}

{{% expand "Can I maintain multiple websites with Contao?" %}}
Yes Contao supports [multi-domain operation](/en/layout/site-structure/multi-domain-operation/) and 
multilingual [ websites](/en/layout/site-structure/multilingual-websites/).
{{% /expand %}}

{{% expand "Can I maintain multilingual websites with Contao?" %}}
Yes Contao supports [multilingual websites](/en/layout/site-structure/multilingual-websites/).
{{% /expand %}}

{{% expand "How do I enable the Contao debug mode?" %}}
You can activate the [Contao debug mode](/en/system/debug-mode/) via the backend.
{{% /expand %}}

{{% expand "Where can I find more Contao resources?" %}}
You can find more Contao resources on the [project website](https://contao.org/de/netzwerk.html).
{{% /expand %}}

{{% expand "May I use Contao for commercial projects?" %}}
Yes, the [GNU Lesser General Public License](https://www.gnu.org/licenses/old-licenses/lgpl-2.1.html) (LGPL), 
under which Contao has been licensed since version 2.5, allows you to use the system for commercial projects. 
Please note that the copyright notices in the Contao files may not be removed or changed according to the license terms.
{{% /expand %}}


## Template

{{% expand "How can I display all variables of my template?" %}}
The information about this can be found under [Show Template Data](/en/layout/templates/template-data/).
{{% /expand %}}

{{% expand "How can I use an insert tag in my template?" %}}
To use an [Insert-Tag](/en/article-management/insert-tags/) `{{date}}` in your template you have to insert 
`$this->replaceInsertTags('{{date}}')`.
{{% /expand %}}

{{% expand "How can I configure the TinyMCE editor?" %}}
The information about this can be found under [TinyMCE Editor Configuration](/en/guides/tinymce-configuration/).
{{% /expand %}}


## Configuration and adjustment

{{% expand "No e-mail is sent via my Form, what do I have to do?" %}}
Check in or add `parameters.yml` the [SMTP details](/en/system/settings/#e-mail-sending-configuration) of your hoster. 
Then you have to empty the application cache once via Contao Manager ("System maintenance" &gt; "Replace product cache") 
or via the console.
{{% /expand %}}

{{% expand "Can I use a different e-mail Address as sender for forms?" %}}
The e-mail address set in the "Settings &gt; System administrator's e-mail address" area is also used as the sender of forms. 
You can enter an additional e-mail address in the "Page structure" section for the "Starting point of a website" page type. 
This E-Mail address will then be used as the sender.
Since Contao 4.10 you can [configure](/en/system/settings/#different-e-mail-configurations-and-sender-addresses) this.
{{% /expand %}}

{{% expand "How can I add the language abbreviation to the URL?" %}}
You can add the entry `prepend_locale: true` in [config.yml](/en/system/settings/#config-yml) and then you have to 
empty the application cache once using the Contao Manager ("System Maintenance" &gt; "Replace Prod. cache") or the console.
{{% /expand %}}

{{% expand "Can the URL suffix .html be removed?" %}}
You can add the entry `url_suffix: ''` in [config.yml](/en/system/settings/#config-yml) and then you have to 
empty the application cache once using the Contao Manager ("System Maintenance" &gt; "Replace Prod. cache") or the console. 
{{% /expand %}}

{{% expand "Why is my HTML information not transferred in the TinyMCE editor?" %}}
Answers can be found in the [TinyMCE Editor Configuration](/en/guides/tinymce-configuration/) section.
{{% /expand %}}


## File management

{{% expand "My pictures are not displayed in the frontend, what can I do?" %}}
Check in the [file manager](/en/file-manager/) if the directory with your images is marked as "Public". 
{{% /expand %}}


## Theme

{{% expand "Why are changes to my SCSS files not applied?" %}}
If you make changes to a [SCSS partial file](/en/guides/sass-less-integration/), 
you must then empty the script cache in "System Maintenance". 
{{% /expand %}}


## Contao Manager

{{% expand "Why do I need the Contao Manager?" %}}
You need Contao Manager to install/upgrade/uninstall Contao and extensions. You can find more information 
under [About Contao Manager](/en/installation/contao-manager/).
{{% /expand %}}

{{% expand "Can I add Contao Manager to an existing installation?" %}}
Yes, the [Contao Manager recognizes](/en/installation/contao-manager/#can-contao-manager-be-added-to-an-existing-installation) 
your existing Contao installation during the installation process. 
{{% /expand %}}

{{% expand "How to update the Contao Manager?" %}}
The [Contao Manager](/en/installation/contao-manager/#how-to-update-the-contao-manager) automatically performs 
a background check when it is called. If a new version is available, Contao Manager will update itself.
{{% /expand %}}

{{% expand "What is the Composer Resolver Cloud?" %}}
The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows you to install Composer dependencies 
via [Contao Manager](/en/installation/contao-manager/) even if your server does not have enough memory.
{{% /expand %}}

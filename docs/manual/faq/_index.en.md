---
title: 'Questions and answers'
description: 'Answers to the most frequently asked questions.'
aliases:
    - /en/faq/
weight: 90
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Here you will find a collection of the most frequently asked questions with the appropriate answers.

If you have a suggestion for this section, use the "Edit this page" link in the top right-hand corner If you have a GitHub account and are logged in, GitHub automatically creates a forum where you can add your suggestions. You can then use GitHub to create a pull request.

## General

{{% expand "Ich habe mein Administrator-Passwort vergessen, wie kann ich es zurücksetzen?" %}}
If there are multiple records in the database table "tl\_user" for which the admin flag is set, you can reset the first value for all of them to create a new administrator in the Contao [install toolbar](/de/installation/contao-installtool/).

{{% expand "Ich habe das Install-Tool Passwort vergessen, wie kann ich es zurücksetzen?" %}}
Remove the line in the file "system/config/localconfig.php" starting with complete`$GLOBALS['TL_CONFIG']['installPassword']`. Afterwards you can set a new password with the [Install-Tool](/de/installation/contao-installtool/).
{{% /expand %}}

{{% expand "Kann ich mit Contao mehrere Webseiten pflegen?" %}}
Yes Contao supports [multi-domain operation](/de/layout/seitenstruktur/multidomain-betrieb/) and multilingual[ websites](/de/layout/seitenstruktur/mehrsprachige-webseiten/).
{{% /expand %}}

{{% expand "Kann ich mit Contao »Mehrsprachige Webseiten« pflegen?" %}}
Yes Contao supports [multilingual websites](/de/layout/seitenstruktur/mehrsprachige-webseiten/).
{{% /expand %}}

{{% expand "Wie aktiviere ich den Contao Debug-Modus?" %}}
You can activate the [Contao debug mode](/de/system/debug-modus/) via the backend.
{{% /expand %}}

{{% expand "Wo finde ich weitere Contao-Ressourcen?" %}}
You can find more Contao resources on the [project website](https://contao.org/de/netzwerk.html).
{{% /expand %}}

{{% expand "Darf ich Contao für kommerzielle Projekte verwenden?" %}}
Yes, the [GNU Lesser General Public License](https://www.gnu.org/licenses/old-licenses/lgpl-2.1.html) (LGPL), under which Contao has been licensed since version 2.5, allows you to use the system for commercial projects. Please note that the copyright notices in the Contao files may not be removed or changed according to the license terms.
{{% /expand %}}

## Template

{{% expand "Wie kann ich alle Variablen meines Templates anzeigen?" %}}
The information about this can be found under [Show Template Data](/de/templates/data/).
{{% /expand %}}

{{% expand "Wie kann ich ein Insert-Tag in meinem Template verwenden?" %}}
To use an [Insert-Tag](/de/artikelverwaltung/insert-tags/)`{{date}}` in your template you have to insert it over `$this->replaceInsertTags('{{date}}')`it.
{{% /expand %}}

{{% expand "Wie kann ich den TinyMCE-Editor konfigurieren?" %}}
The information about this can be found under [TinyMCE Editor Configuration](/de/anleitungen/tinymce-konfiguration/).
{{% /expand %}}

## Configuration and adjustment

{{% expand "Es wird keine E-Mail über mein Formular versendet, was muss ich machen?" %}}
Check in or add `parameters.yml` the [SMTP details](/de/system/einstellungen/#smtp-versand) of your hoster Then you have to empty the application cache once via Contao Manager ("System maintenance" &gt; "Replace product cache") or via the console.

{{% expand "Kann ich eine andere E-Mail-Adresse als Absender für Formulare benutzen?" %}}
The e-mail address set in the "Settings &gt; System administrator's e-mail address" area is also used as the sender of forms. You can enter an additional e-mail address in the "Page structure" section for the "Starting point of a website" page type. This e-mail address will then be used as the sender.
{{% /expand %}}

{{% expand "Wie kann ich das Sprachkürzel der URL hinzufügen?" %}}
You can add the entry `prepend_locale: true` in [config.yml](/de/system/einstellungen/#config-yml) and then you have to empty the application cache once using the Contao Manager ("System Maintenance" &gt; "Replace Prod. cache") or the console.

{{% expand "Kann man die URL Suffix ».html« entfernen?" %}}
You can add the entry `url_suffix: ''` in [config.yml](/de/system/einstellungen/#config-yml) and then you have to empty the application cache once using the Contao Manager ("System Maintenance" &gt; "Replace Prod. cache") or the console. 
{{% /expand %}}

{{% expand "Warum werden meine HTML-Angaben im TinyMCE-Editor nicht übernommen?" %}}
Answers can be found in the [TinyMCE Editor Configuration](/de/anleitungen/tinymce-konfiguration/) section.
{{% /expand %}}

## File management

{{% expand "Meine Bilder werden im Frontend nicht angezeigt, was kann ich machen?" %}}
Check in the [file manager](/de/dateiverwaltung/) if the directory with your images is marked as "Public". 
{{% /expand %}}

## Theme

{{% expand "Warum werden Änderungen an meinen SCSS-Dateien nicht übernommen?" %}}
If you make changes to a [SCSS partial file](/de/anleitungen/sass-less-integration#hinweis-i-umgang-mit-partials), you must then empty the script cache in "System Maintenance". 
{{% /expand %}}

## Contao Manager

{{% expand "Wozu benötige ich den Contao Manager?" %}}
You need Contao Manager to install/upgrade/uninstall Contao and extensions. You can find more information under [About Contao Manager](/de/installation/contao-manager/).
{{% /expand %}}

{{% expand "Kann ich den Contao Manager einer bestehenden Installation hinzufügen?" %}}
%Yes, the [Contao Manager recognizes](/de/installation/contao-manager/#kann-der-contao-manager-zu-einer-bestehenden-installation-hinzugefuegt-werden) your existing Contao installation during the installation process. 
{{% /expand %}}

{{% expand "Wie kann man den Contao Manager aktualisieren?" %}}
The [Contao Manager](/de/installation/contao-manager/#haeufige-fragen-zum-contao-manager) automatically performs a background check when it is called. If a new version is available, Contao Manager will update itself.
{{% /expand %}}

{{% expand "Was ist die Composer Resolver Cloud?" %}}
The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows you to install Composer dependencies via [Contao Manager](/de/installation/contao-manager/) even if your server does not have enough memory.
{{% /expand %}}

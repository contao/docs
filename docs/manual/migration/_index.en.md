---
title: "Update and Migration"
description: "Update and migration of a Contao installation to a higher major version."
url: "migration"
aliases:
    - /en/migration/
weight: 3
---

This section explains how to update and migrate existing Contao instances to higher "major versions" - e.g. updating from Contao 3 to 4 or
4 to 5, etc.


## General

Generally you always need to make sure to update to the newest version of your _current_ major version first, before trying to update to the
next major version. You also must not skip major versions. For example if the version of your current Contao instance is `3.2.10` then you
need to update first to Contao `3.5.40` (the newest Contao 3 version) before you can update to Contao `4.13.x`. If your current version is
`4.10.2` then you need to first update to `4.13.x` bevor you can update to Contao `5.x`, etc. This ensures that all necessary migrations are
automatically executed in order to upgrade a Contao version properly (mainly regarding the database).

Each Contao version update (major as well as minor) can include updates to template files. However, when updating to a new major version it
is particulary important to check your customised templates within the `templates/` folder as it is likely that they will need to be
adjusted.

There can also be backwards breaking changes regarding the PHP framework itself, so you might need to adjust your own PHP code as well.
Usually such changes are documented in the `UPGRADE.md` of the `contao/core-bundle`. You will also see deprecation notices when running your
Contao instance in the debug mode.


## Contao `3.5` to `4.x`

1. Create a copy of your Contao 3.5 database.
2. Create a new [Contao 4 installation][ContaoInstallation].
3. Use the database credentials for the previously created copy.
4. Copy the following files from the original Contao 3 instance:
    * `files/`
    * `system/config/dcaconfig.php`
    * `system/config/langconfig.php`
    * `system/config/initconfig.php`
    * `system/config/localconfig.php`
    * `templates/`
5. Point the domain of your Contao installation to the `public/` folder in your web server's settings
(see [hosting configuration][HostingConfig]).
6. Open the [Contao Install Tool][ContaoInstallTool] in your browser or use the `vendor/bin/contao-console contao:migrate` command on the 
console in order to start the database migration. _Note:_ do not delete any tables or fields at this point.


### Extensions

Contao 4 still supports Contao 3 extensions, so these could be copied over from `system/modules/`. However, for such an upgrade you should
check whether there are more current versions of these extensions available directly via Composer (or the Contao Manager). Failing that you
should evaluate whether any given extension is still necessary and could otherwise be discarded.

After installing one more more extensions you can again open the Install Tool or use the `contao:migrate` command in order to run any
migrations and database updates that these extensions might provide.


## Contao `4.13` to `5.x`

Structurally there aren't many changes between Contao 4 and 5. Even the `composer.json` of the `contao/managed-edition` is largely
identical with Contao `4.13`. However, depending on which Contao versions your current instance was started with and which customisations
have been made, there might be some additional steps to take before you can update to Contao 5.


### Change Version Requirement

In principal you only need to update the version requirement of the Contao packages in your `composer.json` to `^5.0` or `5.0.*` 
respectively, in order to update from Contao `4.13` to `5.0`. e.g. you will have to change `"contao/news-bundle": "^4.13"` to
`"contao/news-bundle": "^5.0"` etc., whereas `"contao/manager-bundle": "4.13.*"` must be changed to `"contao/manager-bundle": "5.0.*"`.

```json
{
    "require": {
        "contao/calendar-bundle": "^5.0",
        "contao/comments-bundle": "^5.0",
        "contao/conflicts": "@dev",
        "contao/faq-bundle": "^5.0",
        "contao/listing-bundle": "^5.0",
        "contao/manager-bundle": "5.0.*",
        "contao/news-bundle": "^5.0",
        "contao/newsletter-bundle": "^5.0"
    }
}
```

{{% notice "note" %}}
The `contao/managed-edition` uses the `^5.0` notation for the version requirement for most of the core packages. This means that each
package can be installed in at least version `5.0.0`, but not in versions `6.x`. This notation also allows `5.1.x`, `5.2.x` etc. However,
the version requirement of the `contao/manager-bundle` is set to `5.0.*` by default. This is done so that Composer will not automatically
update to a new minor version of Contao, without you specifically allowing it, i.e. by changing the version requirement to `5.1.*` for
example. See also [Composer's documentation](https://getcomposer.org/doc/articles/versions.md) on this topic.
{{% /notice %}}


### Adjust Composer Scripts

If your Contao instance was started with an older version then your `composer.json` might still contain a reference to a `ScriptHandler`
class that does not exist anymore in Contao 5. This section will need to be changed to use `@php vendor/bin/contao-setup` instead:

```json
{
    "scripts": {
        "post-install-cmd": [
            "@php vendor/bin/contao-setup"
        ],
        "post-update-cmd": [
            "@php vendor/bin/contao-setup"
        ]
    }
}
```


### Document Root

Contao 4.13 and 5 use the `public/` folder as its entry point. Contao 4.13 still contains an automatic detection in case you are still
using the `web/` folder instead (which was the standard in previous Contao versions). However, Contao 5 does not have that anymore and thus
you should rename your existing `web/` folder to `public/` before you update and adjust your web server's configuration accordingly.
Alternatively you can also set the folder to be used as the public directory in your `composer.json` 
(see [hosting configuration][HostingConfig]).


### Adjust Folder Structure

Previous Contao versions used the `app/` folder for ressources and other application adjustments. Newer versions use a new structure, but
still had support for the old one - but Contao 5 does not not. The following files and folders will need to be moved, in case they are still
in use:

| Old | New |
|---|---|
| `app/config/` | `config/` |
| `app/Resources/contao/` | `contao/` |
| `app/Resources/public/` | `public/` |
| `app/Resources/translations/` | `translations/` |
| `app/Resources/views/` | `templates/bundles/` |


### Application Adjustments

Contao 4 still had support for adjustments in the `system/config/` folder from Contao 3. This support has been dropped in Contao 5 and thus
any such adjsutments will need to be moved to the correct location now. See the [developer documentation][ConfigTranslations] for more
details.


### Export Internal Stylesheets

Contao 5 drops the [internal CSS editor][ManageStylesheets]. If you are still using such internal stylesheets you will need to 
[export][ExportStylesheets] them before upgrading to Contao 5 and then select them as [external stylesheets][LayoutStylesheets] in your page 
layout again.


### Extensions

After implementing the previously mentioned adjustments you will now be able to execute a full Composer package update in order to upgrade 
to Contao 5. However, Composer might prevent you from doing so if you still require extension that haven't been unlocked for Contao 5 - or 
if other dependencies are not compatible with Contao 5.

In this case you should evaluate whether if newer major versions of these packages exist that might be compatible, or if the respective 
extension is still required for your Contao instance and thus could otherwise be removed.


### Templates

As mentioned previously you will always need to check whether any of your customised templates will need to be adjusted. There is however
one thing in particular to note in Contao 5: all content elements (and also front end modules in the future) have been modernised and use
[Twig-Templates][TwigTemplates] now, along with a new template file structure. If you had a customised `templates/ce_text.html5` template
for example then this adjustment will not have any effect by default in Contao 5 (unless you switch the respective content element back to
its old implementation, which is still possible in Contao 5).


### Run Migrations and Database Updates

In case the Composer package update to Contao 5 was successful you can now update the database. Contao 5 does not have the Install Tool
anymore. Instead the database migration and update must be run from the command line - or via the respective method within the Contao
Manager itself. In order to start the process on the command line you can use the following command:

```shell
vendor/bin/contao-console contao:migrate
```


[ContaoInstallation]: /en/installation/install-contao/
[ContaoInstallTool]: /en/installation/contao-installtool/
[HostingConfig]: /en/installation/system-requirements/#hosting-configuration
[ContaoManager]: /en/installation/contao-manager/
[TwigTemplates]: /en/layout/templates/twig/
[ConfigTranslations]: https://docs.contao.org/dev/getting-started/starting-development/#contao-configuration-translations
[ManageStylesheets]: /en/layout/theme-manager/manage-stylesheets/
[ExportStylesheets]: /en/layout/theme-manager/manage-stylesheets/#stylesheets-exportieren
[LayoutStylesheets]: /en/layout/theme-manager/manage-page-layouts/#stylesheets

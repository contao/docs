---
title: 'Manage Themes'
description: 'In Contao, a finished design is called a "theme".'
aliases:
    - /en/layout/theme-manager/manage-themes/
weight: 10
---

In Contao, a finished design is called a "theme".


## Components of a theme

A theme combines all design relevant elements of a website:

- the theme itself
- The contained stylesheets
- the integrated front end modules
- the included page layouts
- the included image sizes
- the used files
- possibly customized templates

Unlike stylesheets, front end modules, page layouts and image sizes that are stored in the database, files and 
templates are located in a subdirectory of your Contao installation. A template is a PHP file that you can use to 
specify the HTML output of a certain element or module.

When selecting the files, make sure that you only link those files to the theme that actually belong to the design. 
The Contao upload directory contains all user files, including background images and icons as well as photos, videos, 
PDF documents, Word files, etc. The distinction between design and content is up to you in the file system alone in 
your preferred organizational approach.


## Configuring Themes

The operation of the Theme Manager works just like most other back end modules, using navigation icons.

![Navigation icons in the Theme Manager]({{% asset "images/manual/layout/theme-manager/en/navigation-icons-in-the-theme-manager.png" %}}?classes=shadow)

- ![Edit Theme]({{% asset "icons/edit.svg" %}}?classes=icon) Edit Theme
- ![Delete Theme]({{% asset "icons/delete.svg" %}}?classes=icon) Delete a theme
- ![Show details of the theme]({{% asset "icons/show.svg" %}}?classes=icon) Show details of the theme
- ![Edit the stylesheets of the theme]({{% asset "icons/css.svg" %}}?classes=icon) [Edit the stylesheets of the theme](../../theme-manager/manage-stylesheets/)
- ![Editing the front end modules of the Theme]({{% asset "icons/modules.svg" %}}?classes=icon) [The front end modules of the theme editing](../../module-management/)
- ![Edit the page layouts of the theme]({{% asset "icons/layout.svg" %}}?classes=icon) [The page layouts of the theme editing](../../theme-manager/manage-page-layouts/)
- ![Edit the image sizes of the theme]({{% asset "icons/sizes.svg" %}}?classes=icon) Edit the image sizes of the theme
- ![Export Theme]({{% asset "icons/theme_export.svg" %}}?classes=icon) Export Theme

**Theme title**: Here you enter the theme title.

The title of a theme is displayed in the back end overview and is also used as the file name during theme export. It is 
therefore advisable to include the version number of a theme in the title - of course only if versioning is important 
to you in this context.

**Author**: Here you can enter the name of the theme designer.

**Folders**: Here you can select which folders from the Contao upload directory belong to the theme. The resources 
linked here are exported with the theme export.

**Screenshot**: Here you can select a screenshot for the theme overview.

**Templates folder**: Here you can link a specific subfolder from the templates folder to the theme. The customized 
templates contained in this folder will then also be exported.


## Export Themes

The export of a theme is triggered by clicking on the corresponding navigation icon in the theme overview. Contao 
offers you a `.cto` file for download that you can save on your local computer. The file extension "cto" is 
proprietary, but it is a normal ZIP archive that you can unpack with any ZIP utility.

The theme file contains the following resources:

| Name | Declaration |
| ---- | ----------- |
| theme.xml | This XML file contains all records from the Contao database that are related to the theme or its components. |
| files | This folder contains all files from the Contao upload directory that have been associated with the theme. It does not matter whether the upload directory in your installation is actually `files` called Contao or not. |
| templates | This folder contains all the files from the Templates directory that have been linked to the theme. If there are no customized templates, the folder does not appear in the export file. |


## Importing Themes

To import a theme, click on the **Import Theme** button in the Theme Manager, select the file and start the import 
process.

Contao then performs a series of checks to detect possible incompatibilities between the theme and your Contao 
installation.

![The theme data is checked]({{% asset "images/manual/layout/theme-manager/en/the-theme-data-is-checked.png" %}}?classes=shadow)

The review shall include in particular

- checking the tables for missing fields
- the check for non-existent layout areas
- the check for already existing templates

If a theme contains tables or fields that do not exist in your Contao database (e.g. because a certain third-party 
extension is not installed), these data will be ignored during import. So make sure that all extensions included in 
the theme are installed and up to date at the time of import.

Customized templates also offer a lot of potential for conflict, unless they are managed in a unique subfolder 
separation. Existing templates are overwritten during the theme import - after a warning.


## Activate themes

After a theme has been successfully imported, all you need to do is activate it so that it is displayed in the front 
end: "Activate" refers to the assignment of one of the page layouts of the new theme to a page in the page structure. 
As you already know from the previous instructions, the merging of design and content takes place in the Page 
Structure, and the Page Layout determines the layout of a page.

For illustration purposes, the "[Contao Demo](https://github.com/contao/contao-demo)" theme.

![Contao Official Demo]({{% asset "images/manual/layout/theme-manager/en/contao-official-demo.png" %}}?classes=shadow)


## Sources of supply for themes

The easiest way to find commercial themes is to use Google, for example by using the search term "Contao themes" (with 
or without a hyphen). The company Feyer Media GmbH &amp; Co KG by Contao initiator Leo Feyer offers commercial themes 
that were partly created by himself and partly by other providers. There is also an online demo of these themes where 
you can quickly get an impression of the designs. Another provider of themes is the company 
[RockSolid Themes](https://rocksolidthemes.com/en/contao/themes) from core developer Martin Auswöger.

Despite all the theme euphoria, it should also be said that themes - just like third-party extensions - are always a 
potential gateway for hackers. After all, you upload files from other people to your server without knowing exactly 
what is stored there. Therefore, only install themes from trusted vendors and make sure to read the security 
advisories [in the Contao blog](https://contao.org/de/news/sicherheitshinweise-zu-contao-themes.html).

---
title: 'Create the first start page'
description: 'Create a theme with page layout and publish the first page.'
aliases:
    - /en/guides/add-first-index-page/
weight: 10
tags:
    - Theme
    - Seitenstruktur
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

You have completed the [Contao installation](../../installation) and can now create your homepage. You only need three steps to do this: Create a [theme](../../theme-manager/themes-verwalten) with a [page layout](../../theme-manager/seitenlayouts-verwalten), link the [web page starting point](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen) to your page layout and finally create the start page with content.

## Creating a new theme

First you need a Contao theme. The first time you start the [theme manager](../../theme-manager) after installation, no themes should exist yet. You can create the theme using the icon `Neu` ![New](/de/icons/new.svg?classes=icon). For more information, see [Configuring themes](../../theme-manager/themes-verwalten/#themes-konfigurieren) .

For our first theme here are only the information `Theme-Titel` and `Autor` necessary. As an example we create a theme with the name `Demo` . Afterwards you can [manage](../../theme-manager/themes-verwalten) your existing theme and make changes at any time.

![New Theme in the Theme Manager](/de/guides/images/de/first-page/neues-theme-im-theme-manager.png?classes=shadow)

## Creating a new page layout in the theme

You must now create a [page layout](../../theme-manager/seitenlayouts-verwalten) within your theme. You can access the settings via the icon ![Edit the page layouts of the theme](/de/icons/layout.svg?classes=icon)for `Seitenlayouts` .

![Call up the page layouts of the theme](/de/guides/images/de/first-page/die-seitenlayouts-des-themes-aufrufen.png?classes=shadow)

A theme can contain several page layouts. You create your first page layout by clicking on the icon `Neu` ![New](/de/icons/new.svg?classes=icon).

![Create a new page layout](/de/guides/images/de/first-page/neues-seitenlayout-anlegen.png?classes=shadow)

## Configure the page layout

You are now in the settings for page layouts. Just set the (e.g `Titel` . to `Standard`) and select the first option in the area `Zeilen` and `Spalten` the first option ("Main line only" or "Main column only").

You can simply accept the other settings and confirm your entries with `Speichern und schließen` . You can change the settings of a page layout at any time.

![Configure the page layout](/de/guides/images/de/first-page/das-seitenlayout-konfigurieren.png?classes=shadow)

## Creating the starting point of a web page

Switch to `Seitenstruktur` the area `Layout` and select the icon `Neu` ![New](/de/icons/new.svg?classes=icon). Contao will ask you for the position. Now accept the suggestion Contao offers.

![Configure the page structure](/de/guides/images/de/first-page/die-seitenstruktur-konfigurieren.png?classes=shadow)

You are now in the page settings. Just set the following information here:

| Setting | Value |
| ------- | ----- |
| **Site name** | z. e. g. My Demo Website |
| **Page type** | Selection "Starting point of a web page |
| **Language** | en |
| **Language fallback** | Activate option |
| **Assign a layout** | Activate option |
| **Publish page** | Activate option |

### Select the page layout at the start point of a web page {#select the page layout at the start point of a web page}

If you activate this option `Ein Layout zuweisen` , you will receive a selection of existing page layouts by theme. In our example the page layout `Standard` of the theme `Demo` .

![Assign a layout](/de/guides/images/de/first-page/ein-layout-zuweisen.png?classes=shadow)

Confirm your entries with the button `Speichern und schließen` . Your page structure should now look like this:

![The page structure with starting point of a web page](/de/guides/images/de/first-page/die-seitenstruktur-mit-dem-neuen-startpunkt.png?classes=shadow)

{{% notice info %}}
 You can create and maintain multiple websites with Contao within one installation. These websites are listed under separate starting points. Even if you only want to maintain a single website, you have to create a page of the type `Startpunkt einer Webseite` first. 
{{% /notice %}}

## Create the start page

You can now create your actual homepage in the page structure. Click on the icon `Neu` ![New](/de/icons/new.svg?classes=icon)in the page structure. Contao will ask you for the position where your new page should be added. We want to add the new page "below" the existing page of the type `Startpunkt einer Webseite` .

![Set the position of the page](/de/guides/images/de/first-page/position-der-seite-festlegen.png?classes=shadow)

Afterwards you will find yourself back in the settings of this page type. For our example, we only set the relevant specifications. As always, you can change them at any time.

| Setting | Value |
| ------- | ----- |
| **Site name** | Welcome |
| **Page aliases** | index |
| **Publish page** | Activate option |

The list in the page structure should now look as follows:

![List of the site structure](/de/guides/images/de/first-page/liste-der-seitenstruktur.png?classes=shadow)

{{% notice note %}}
 The entry `index` for the `Seitenalias` should only be used for your actual homepage. You can name your other pages according to your wishes: e.g. "contact" or "imprint". 
{{% /notice %}}

## Edit the article on the home page

Select the link `Artikel` in the left navigation in the area `Inhalte` . With the selection `Alle umschalten` you get the lower representation. Contao has created an [article](../../artikelverwaltung/artikel) with the same name below your homepage. In the article, select the icon ![Edit](/de/icons/edit.svg?classes=icon)for `Artikel bearbeiten` to create new content.

![Edit the article](/de/guides/images/de/first-page/den-artikel-bearbeiten.png?classes=shadow)

{{% notice note %}}
 In the above list display, the article is grayed out, including the `Augen` icon. You could already [publish](#den-artikel-veroeffentlichen) the article now or continue with the following steps first. 
{{% /notice %}}

## Create new content in the article

You are now in the area `Inhaltselemente` of the `Artikels` . Select the icon ![New](/de/icons/new.svg?classes=icon) `Neu` to create a new [content element](../../artikelverwaltung/inhaltselemente). Contao asks you for the position where you want to insert the content element. Choose the selection that Contao suggests.

The available content elements `Elementtyp` can be selected using this. The default setting is of type `Text` . For our example, just fill in the information `Überschrift` and `Text` confirm with `Speichern und zurück`.

![The content element Text](/de/guides/images/de/first-page/das-inhaltselement-text.png?classes=shadow)

## Publish the article {#publish the article}

If the article is still grayed out in the list view (including the `Augen` icon), you have not yet published the article. In this status, the contents of the article will simply not be displayed on your site.

To publish the article select the `Augen` icon. The icon is then ![Publish](/de/icons/published.svg?classes=icon)displayed in green. Now you can open your website in your browser.

![Publish article](/de/guides/images/de/first-page/artikel-veroeffentlichen.png?classes=shadow)

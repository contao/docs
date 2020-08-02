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

You have completed the [Contao installation](../../installation) and can now create your homepage in three steps: Create a [theme](../../theme-manager/themes-verwalten) with a page layout, link the[ starting point of](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen) the website to your page layout and finally create the start page with content.

## Creating a new theme

First you need a Contao theme. The first time you start the [theme manager](../../theme-manager) after installation, no themes should exist. You create the theme by clicking the icon. For more ![New](/de/icons/new.svg?classes=icon)`Neu`information, see [Configuring themes](../../theme-manager/themes-verwalten/#themes-konfigurieren).

For our first theme here are only the information `Theme-Titel`and `Autor`necessary. As an example we will create a theme named `Demo`. Afterwards, you can manage your existing theme and make changes here at any time.

![New Theme in the Theme Manager](/de/guides/images/de/first-page/neues-theme-im-theme-manager.png?classes=shadow)

## Create a new page layout in the theme

Now you have to create a [page layout](../../theme-manager/seitenlayouts-verwalten) within your theme. You can access the settings via the icon ![Edit the page layouts of the theme](/de/icons/layout.svg?classes=icon)for `Seitenlayouts`.

![Call up the page layouts of the theme](/de/guides/images/de/first-page/die-seitenlayouts-des-themes-aufrufen.png?classes=shadow)

A theme can contain several page layouts. You create your first page layout by clicking on the icon ![New](/de/icons/new.svg?classes=icon)`Neu`.

![Create a new page layout](/de/guides/images/de/first-page/neues-seitenlayout-anlegen.png?classes=shadow)

## Configure the page layout

You are now in the settings for page layouts. Just set the (e.g`Titel`. to ) `Standard`and select the first option in the area `Zeilen`and `Spalten`the first option ("Main line only" or "Main column only").

You can simply accept the other settings and confirm your entries with `Speichern und schließen`. You can change the settings of a page layout at any time.

![Configure the page layout](/de/guides/images/de/first-page/das-seitenlayout-konfigurieren.png?classes=shadow)

## Create the starting point of a website

Switch to `Seitenstruktur`the area `Layout`and select the icon and Contao will ![New](/de/icons/new.svg?classes=icon)`Neu`ask you for the position. Now accept the suggestion that Contao offers.

![Configure the page structure](/de/guides/images/de/first-page/die-seitenstruktur-konfigurieren.png?classes=shadow)

You are now in the page settings. Just set the following information here:

| Setting | Value |
| ------- | ----- |
| **Page name** | z. e. g. My Demo Website |
| **Page type** | Selection "Starting point of a web page |
| **Language** | en |
| **Language fallback** | Activate option |
| **Assign a layout** | Activate option |
| **Publish page** | Activate option |

### Select the page layout at the start point of a website {#select the page layout at the start point of a website}

If you activate this option`Ein Layout zuweisen`, you will receive a selection of the existing page layouts per Theme, in our example the page layout `Standard`of the Theme `Demo`.

![Assign a layout](/de/guides/images/de/first-page/ein-layout-zuweisen.png?classes=shadow)

Confirm your entries with the button `Speichern und schließen`. Your page structure should now look like this:

![The page structure with starting point of a web page](/de/guides/images/de/first-page/die-seitenstruktur-mit-dem-neuen-startpunkt.png?classes=shadow)

{{% notice info %}}
You can create and maintain multiple websites with Contao within one installation. These websites are listed under separate starting points. Even if you only want to maintain a single website, you have to create a new page of the type `Startpunkt einer Webseite`%
{{% /notice %}}

## Create the start page

You can now create your actual homepage in the page structure. Click on the icon ![New](/de/icons/new.svg?classes=icon)`Neu`in the page structure. Contao will ask you for the position where your new page should be added. We want to add the new page "below" the existing page of the type`Startpunkt einer Webseite`.

![Set the position of the page](/de/guides/images/de/first-page/position-der-seite-festlegen.png?classes=shadow)

Afterwards, you are back in the settings of this page type. For our example, we will only set the relevant settings for this page type. As always, you can change these at any time.

| Setting | Value |
| ------- | ----- |
| **Page name** | Welcome to |
| **Page aliases** | index |
| **Publish page** | Activate option |

The list in the page structure should now look like this:

![List of the site structure](/de/guides/images/de/first-page/liste-der-seitenstruktur.png?classes=shadow)

{{% notice note %}}
The entry `index`for the `Seitenalias`should only be used for your actual homepage. You can name your other pages according to your wishes: e.g. "contact" or "imprint".
{{% /notice %}}

## Edit the article on the home page

Select the link `Artikel`in the left navigation in the area `Inhalte`. With the selection `Alle umschalten`you get the lower representation. Contao has created an [article](../../artikelverwaltung/artikel) with the same name below your homepage. In the article, select the icon ![Edit](/de/icons/edit.svg?classes=icon)for `Artikel bearbeiten`creating new content.

![Edit the article](/de/guides/images/de/first-page/den-artikel-bearbeiten.png?classes=shadow)

{{% notice note %}}
In the above list display, the article is grayed out, including the `Augen`icon. You could [publish](#den-artikel-veroeffentlichen) the article now or continue with the following steps first. 
{{% /notice %}}

## Create new content in the article

You are now in the area `Inhaltselemente`of the `Artikels`. Select the icon ,to ![New](/de/icons/new.svg?classes=icon)`Neu`create a new [content element](../../artikelverwaltung/inhaltselemente). Contao asks you for the position where you want to insert the content element. Choose the selection that Contao suggests.

This icon `Elementtyp`can be used to select the available content elements. The default setting is of type `Text`. For our example, just fill in the information `Überschrift`and `Text`confirm with `Speichern und zurück`.

![The content element Text](/de/guides/images/de/first-page/das-inhaltselement-text.png?classes=shadow)

## Publish the article {#publish the article}

If the article is still grayed out in the list view (including the `Augen`icon), you have not yet published the article. In this status the content of the article will simply not be displayed on your site.

To publish the article, select the `Augen`icon. The icon will then be displayed in ![Publish](/de/icons/published.svg?classes=icon)green. Now you can open your website in your browser.

![Publish article](/de/guides/images/de/first-page/artikel-veroeffentlichen.png?classes=shadow)

---
title: "Create the first start page"
description: "Create a theme and page layout and publish your first page."
aliases:
    - /en/guides/add-first-index-page/
weight: 10
tags:
    - "Theme"
    - "Site Structure"
---

You have completed the [Contao installation](/en/installation/) and can now create your first page in three steps: 
Create a [theme](/en/layout/theme-manager/) with a page layout, link the 
[starting point of a website](/en/layout/site-structure/pages-as-central-elements/#page-types) to your page 
layout and finally create the start page with content.


## Creating a new theme

First you need a Contao theme. The first time you start the [theme manager](/en/layout/theme-manager/) 
after installation, no themes should exist. You create the theme by clicking the ![New]({{% asset "icons/new.svg" %}}?classes=icon) 
*New* icon. For more information see [configuring themes](/en/layout/theme-manager/manage-themes/).

For our first theme we only need a **Theme title** and **Author**. 
As an example we will create a theme named *Demo*. Afterwards, you can manage your existing theme 
and make changes here at any time.

![New Theme in the Theme Manager]({{% asset "images/manual/guides/en/first-page/new-theme.png" %}}?classes=shadow)


## Create a new page layout in the theme

Now you have to create a [page layout](/en/layout/theme-manager/manage-page-layouts/) within your theme. 
You can access the settings via the icon ![Edit the page layouts of the theme]({{% asset "icons/layout.svg" %}}?classes=icon) 
for *page layouts*.

![Access page layouts of the theme]({{% asset "images/manual/guides/en/first-page/page-layout.png" %}}?classes=shadow)

A theme can contain several page layouts. You create your first page layout 
by clicking on the ![New]({{% asset "icons/new.svg" %}}?classes=icon) *New* icon.

![Create a new page layout]({{% asset "images/manual/guides/en/first-page/new-page-layout.png" %}}?classes=shadow)


## Configure the page layout

You are now in the settings for page layouts. Just set the **Title** to e. .g. _Standard_ and select the first option 
for **Rows** and **Columns** ("Main row only" and "Main column only").

Confirm all settings with _Save and close_. You can change the settings of a page layout at any time.

![Configure the page layout]({{% asset "images/manual/guides/en/first-page/configure-page-layout.png" %}}?classes=shadow)


## Create the starting point of a website

Switch to _Layout_ > _Site structure_ and select the ![New]({{% asset "icons/new.svg" %}}?classes=icon) _New_ icon.
Contao will ask you for the position. Accept the suggestion that Contao offers.

![Configure the page structure]({{% asset "images/manual/guides/en/first-page/new-website-root.png" %}}?classes=shadow)

You are now in the settings of the [site structure](/en/layout/site-structure/). Just set the following information here:

| Setting | Value |
| ------- | ----- |
| **Page name** | e.g. My Demo Website |
| **Page type** | Select "Website root" |
| **Language** | en |
| **Language fallback** | Activate option |
| **Assign a layout** | Activate option |
| **Publish page** | Activate option |


### Select the page layout

If you activate the option **Assign a layout**, you are able to select one of the existing page layouts of each theme. 
In our example we will choose the page layout _Standard_ of the Theme _Demo_.

![Assign a layout]({{% asset "images/manual/guides/en/first-page/select-page-layout.png" %}}?classes=shadow)

Confirm the settings with the button _Save and close_. Your page structure should now look like this:

![The page structure with starting point of a web page]({{% asset "images/manual/guides/en/first-page/list-site-structur.png" %}}?classes=shadow)

{{% notice info %}}
You can create and maintain multiple websites with Contao within one installation. 
Even if you only want to maintain a single website, you have to create a new page of the type "Website root".
{{% /notice %}}


## Create the start page

You can now create your actual homepage in the page structure. Click on the ![New]({{% asset "icons/new.svg" %}}?classes=icon) 
_New_ icon in the site structure. Contao will ask you for the position where your new page should be added. 
We want to add the new page "below" the existing page of the type _Website root_.

![Set the position of the page]({{% asset "images/manual/guides/en/first-page/position-page.png" %}}?classes=shadow)

Afterwards, you are back in the settings of this page type. For our example, 
we will only set the relevant settings for this page type. As always, you can change these at any time.

| Setting | Value |
| ------- | ----- |
| **Page name** | Welcome |
| **Page type** | Regular page |
| **Page alias** | index |
| **Publish page** | Activate option |

The list in the page structure should now look like this:

![List of the site structure]({{% asset "images/manual/guides/en/first-page/list-site-structure-with-home-page.png" %}}?classes=shadow)

{{% notice note %}}
The entry `index` for the **Page alias** should only be used for your actual start page. 
You can name the alias of your other pages according to your liking: e.g. "contact" or "imprint".
{{% /notice %}}


## Edit the article on the home page

Select the link _Articles_ in the left navigation under the _Content_ area. With the selection _Toggle all_ you get 
the representation as seen below. Contao has created an [article](/en/article-management/articles/) with the same name below 
within your new start page. In the article, select the ![Edit]({{% asset "icons/edit.svg" %}}?classes=icon) icon for _Edit article_.

![Edit the article]({{% asset "images/manual/guides/en/first-page/edit-article.png" %}}?classes=shadow)

{{% notice note %}}
In the above list, the article is grayed out, including the "eye" icon. You could publish the article now 
or continue with the following steps first. 
{{% /notice %}}


## Create new content in the article

You are now in the area _Content elements_ of the _Article_. Select the ![New]({{% asset "icons/new.svg" %}}?classes=icon) 
_Neu_ icon to create a new [content element](/en/article-management/content-elements/). Contao asks you for the position where 
you want to insert the content element. Choose the selection that Contao suggests.

In **Element type** you can select the available content elements. The default setting is _Text_. 
For our example, just fill in the information **Headline**, **Text** and confirm with _Save and go back_.

![The content element Text]({{% asset "images/manual/guides/en/first-page/content-type-text.png" %}}?classes=shadow)


## Publish the article

If the article is still grayed out in the list view (including the "eye" icon), 
you have not yet published the article. In this state the content of the article will simply not be displayed on your site.

To publish the article, click on the "eye" icon. The icon will then be displayed in green ![Publish]({{% asset "icons/published.svg" %}}?classes=icon). 
Now you can open your website in your browser.

![Publish article]({{% asset "images/manual/guides/en/first-page/publish-article.png" %}}?classes=shadow)

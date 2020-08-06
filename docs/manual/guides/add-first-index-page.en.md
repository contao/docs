---
title: "Create the first start page"
description: "Create a theme with page layout and publish the first page."
aliases:
    - /en/guides/add-first-index-page/
weight: 10
tags:
    - "Theme"
    - "Site Structure"
---

You have completed the [Contao installation](/en/installation/) and can now create your homepage in three steps: 
Create a [theme](/en/layout/theme-manager/) with a page layout, link the 
[starting point of a website](/en/layout/site-structure/pages-as-central-elements/#page-types) to your page 
layout and finally create the start page with content.


## Creating a new theme

First you need a Contao theme. The first time you start the [theme manager](/en/layout/theme-manager/) 
after installation, no themes should exist. You create the theme by clicking the icon ![New](/de/icons/new.svg?classes=icon) 
`New`. For more information see [Configuring themes](/en/layout/theme-manager/manage-themes/).

For our first theme here are only the information `Theme title` and `Author` necessary. 
As an example we will create a theme named `Demo`. Afterwards, you can manage your existing theme 
and make changes here at any time.

![New Theme in the Theme Manager](/de/guides/images/en/first-page/new-theme.png?classes=shadow)


## Create a new page layout in the theme

Now you have to create a [page layout](/en/layout/theme-manager/manage-page-layouts/) within your theme. 
You can access the settings via the icon ![Edit the page layouts of the theme](/de/icons/layout.svg?classes=icon) 
for `page Layout`.

![Call up the page layouts of the theme](/de/guides/images/en/first-page/page-layout.png?classes=shadow)

A theme can contain several page layouts. You create your first page layout 
by clicking on the icon ![New](/de/icons/new.svg?classes=icon) `New`.

![Create a new page layout](/de/guides/images/en/first-page/new-page-layout.png?classes=shadow)


## Configure the page layout

You are now in the settings for page layouts. Just set the `Title` to (e .g. `Standard`) and select the first option 
in the area `Rows` and `Columns` ("Main row only" and "Main column only").

Accept the other settings and confirm your entries with `Save and close`. 
You can change the settings of a page layout at any time.

![Configure the page layout](/de/guides/images/en/first-page/configure-page-layout.png?classes=shadow)


## Create the starting point of a website

Switch to `Layout > Site structure` and select the icon ![New](/de/icons/new.svg?classes=icon) `New`.
Contao will ask you for the position. Accept the suggestion that Contao offers.

![Configure the page structure](/de/guides/images/en/first-page/new-website-root.png?classes=shadow)

You are now in the settings of the [Site structure](/en/layout/site-structure/). Just set the following information here:

| Setting | Value |
| ------- | ----- |
| **Page name** | e. g. My Demo Website |
| **Page type** | Selection "Website root" |
| **Language** | en |
| **Language fallback** | Activate option |
| **Assign a layout** | Activate option |
| **Publish page** | Activate option |


### Select the page layout

If you activate the option `Assign a layout`, you will receive a selection of the existing page layouts per Theme. 
In our example the page layout `Standard` of the Theme `Demo`.

![Assign a layout](/de/guides/images/en/first-page/select-page-layout.png?classes=shadow)

Confirm your entries with the button `Save and close`. Your page structure should now look like this:

![The page structure with starting point of a web page](/de/guides/images/en/first-page/list-site-structur.png?classes=shadow)

{{% notice info %}}
You can create and maintain multiple websites with Contao within one installation. 
Even if you only want to maintain a single website, you have to create a new page of the type "Website root".
{{% /notice %}}


## Create the start page

You can now create your actual homepage in the page structure. Click on the icon ![New](/de/icons/new.svg?classes=icon) 
`New` in the page structure. Contao will ask you for the position where your new page should be added. 
We want to add the new page "below" the existing page of the type `Website root`.

![Set the position of the page](/de/guides/images/en/first-page/position-page.png?classes=shadow)

Afterwards, you are back in the settings of this page type. For our example, 
we will only set the relevant settings for this page type. As always, you can change these at any time.

| Setting | Value |
| ------- | ----- |
| **Page name** | Welcome |
| **Page type** | Regular page |
| **Page alias** | index |
| **Publish page** | Activate option |

The list in the page structure should now look like this:

![List of the site structure](/de/guides/images/en/first-page/list-site-structure-with-home-page.png?classes=shadow)

{{% notice note %}}
The entry `index` for the `Page alias` should only be used for your actual homepage. 
You can name your other pages according to your wishes: e.g. "contact" or "imprint".
{{% /notice %}}


## Edit the article on the home page

Select the link `Articles` in the left navigation under the `Content` area. With the selection `Toggle all` you get 
the lower representation. Contao has created an [article](/en/article-management/articles/) with the same name below 
your homepage. In the article, select the icon ![Edit](/de/icons/edit.svg?classes=icon) for `Edit article`.

![Edit the article](/de/guides/images/en/first-page/edit-article.png?classes=shadow)

{{% notice note %}}
In the above list, the article is grayed out, including the `eye` icon. You could publish the article now 
or continue with the following steps first. 
{{% /notice %}}


## Create new content in the article

You are now in the area `Content elements` of the `Article`. Select the icon ![New](/de/icons/new.svg?classes=icon) 
`Neu` to create a new [content element](/en/article-management/content-elements/). Contao asks you for the position where 
you want to insert the content element. Choose the selection that Contao suggests.

In `Element type` you can select the available content elements. The default setting is of type `Text`. 
For our example, just fill in the information `Headline`, `Text` and confirm with `Save and go back`.

![The content element Text](/de/guides/images/en/first-page/content-type-text.png?classes=shadow)


## Publish the article

If the article is still grayed out in the list view (including the `eye` icon, 
you have not yet published the article. In this status the content of the article will simply not be displayed on your site.

To publish the article, select the `eye` icon. The icon will then be displayed in green ![Publish](/de/icons/published.svg?classes=icon). 
Now you can open your website in your browser.

![Publish article](/de/guides/images/en/first-page/publish-article.png?classes=shadow)

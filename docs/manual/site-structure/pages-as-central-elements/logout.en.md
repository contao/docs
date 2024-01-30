---
title: 'Logout'
description: 'This page type creates a logout link for a protected area. After logging out, you can redirect visitors to 
any page or to the last page they visited.'
url: "site-structure/logout"
aliases:
    - /en/site-structure/pages-as-central-elements/logout/
    - /en/layout/site-structure/pages-as-central-elements/logout/
weight: 50
---


This page type creates a logout link for a protected area. After logging out, you can redirect visitors to any page or 
to the last page they visited.


## Name and type

**Page name:** The page name is displayed in the navigation and used as a fallback for the page title.

**Page type:** Here you can define the type of page.


## Routing

**Page aliases:** The alias of a page is a unique and meaningful reference that you can use to access a page in your
browser. If you leave this field empty when creating a page, Contao will automatically generate the alias.

**Route path:** The preview of the final path (possibly with placeholders) to match this page.

**Route priority:** Optionally configure the priority to affect the order of routes.


## Auto-forward

**Redirect page:** Here you can select the page to which the member will be redirected after logging out. If you do not 
select a target page, the member will automatically be redirected to the first regular subpage.

**Redirect to last page visited:** Redirect the member back to the last visited page instead of the redirect page.


## Access rights

Via access rights you define which users in the back end (!) are allowed to access a page and what they can do with this
page and the articles it contains. Similar to the Unix permissions system, each page belongs to a specific user and
user group and has three levels of access:

- Access as owner of a page
- Access as member of the group of a page
- Access as any other back end user

For example, the "Company" page is assigned access rights and belongs to the user h.lewis and the user group _News_.
Both the user and everyone in the user group can edit articles on the page, but only the owner, h.lewis, and you the
administrator can edit the page and change its title.

![Assign access rights]({{% asset "images/manual/layout/site-structure/en/assign-access-rights.png" %}}?classes=shadow)

**Assign access rights:** Here you can assign access rights to a page. If you do not select this option, the access
rights will be inherited from a parent page.

**Owner:** Here you can set the owner of the page.

**Group:** Here you define the group of the page.

**Access rights**: Here you assign the rights to the individual access levels.

For more information on the permissions system and the configuration of users and user groups, see the
[system settings](/en/system/settings/) page.


## Expert settings

**CSS class:** Here you assign a CSS class to the page, which is used in the body tag of the HTML page as well as in
the navigation modules. This way you can create CSS formatting for a specific page or menu item.

**Show in HTML sitemap:** Here you can determine whether the page is displayed in the HTML Sitemap. By default, all
public pages and pages not hidden in the menu are included. If necessary, this behavior can be adjusted per page:

- **Default:** Use the default settings.
- **Always display:** The page is always displayed in the HTML Sitemap, even if, for example, it is hidden in the menu
  and would not normally be displayed.
- **Never display:** The page is excluded from the HTML Sitemap.

{{% notice info %}}
Do not confuse the HTML sitemap with the XML sitemap: The HTML sitemap is a FE-Module, you can submit the XML sitemap 
e.g. to Google.
{{% /notice %}}

**Hide in menu:** If you select this option, the page will not be displayed in the menu of your website, but you can
still access the page - if it has been published - via a direct link or in a front end module.


## Keyboard navigation

From section [Back end shortcuts](/de/administrationsbereich/backend-tastaturkuerzel/) you already know that Contao
supports navigation using shortcuts. This not only has a positive effect on accessibility but also speeds up the
workflow. For this reason, the feature is also available in the front end and each page can optionally be provided with
a keyboard shortcut and a tab index.

**Shortcut keys:** A shortcut key is a single character associated with a page. Visitors to your site can then access
that page directly from the keyboard. This function is especially required for accessible websites.


## Publication

As long as a page is not published, it practically does not exist in the front end and cannot be accessed by visitors.
In addition to manual publishing, Contao also offers the possibility to activate pages automatically on a specific
date. This way you can, for example, apply for a limited time offer.

**Publish page:** Here you can publish a page.

**Show from:** Here you activate a page on a specific date.

**Show until:** Here you deactivate a page at a certain date.

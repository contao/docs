---
title: 'Configure pages'
description: 'After you have selected the right page types for your pages, you can configure them to suit your needs. The configuration options vary depending on the page type.'
aliases:
    - /en/layout/site-structure/configure-pages/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

After you have selected the right page types for your pages, you can configure them to suit your needs. The configuration options vary depending on the page type.

## Page aliases

The **alias of** a page is a unique and meaningful reference that you can use to call up a page in your browser. If you leave this field empty when creating a page, Contao will automatically assign the alias. Each alias must be unique within the domain used, i.e. it can only occur once.

{{% notice warning %}}
The alias of the home page should always be `index`. Only then the generated URL for this page will be an empty request. 
{{% /notice %}}

## Metadata

The metadata of a page mostly refers to the corresponding meta tags in the header area of the HTML page. You can use them to define the title and description of a page, among other things.

**Page title:** The page title is used in the `<title>` tag of the website and often appears in search results of Google and Co. It should not contain more than 65 characters, because many search engine longer titles simply cut off.

**Output in source code:**

```html
<title>Seitentitel</title>
```

**Robots tag:** The robots tag defines how search engines treat a page.

- *index:* add the page to the search index
- *follow:* follow the links on the page
- *noindex:* do not include the page in the search index
- *nofollow:* do not follow the links on the page

The default case is *index,follow*, because we want Google to include our pages as comprehensive as possible in the search index. However, certain pages, such as the imprint or the registration page, can be excluded from indexing using the statement index*,follow*.

{{% notice note %}}
The Robots tag setting has no effect on Contao's search index for website search.
{{% /notice %}}

**Output in source code:**

```html
<meta name="robots" content="index,follow">
```

**Description of the page:** The description of a page is indexed by all common search engines just like the page title and is displayed in the search results, for example, if no context information is available for the search term. The recommended length of a description is between 150 and 300 characters. The meta description of a page is an important tool for search engine optimization, so you should take the time to provide each page with a unique description.

**Output in source code:**

```html
<meta name="description" content="Beschreibung der Seite (150 und 300 Zeichen).">
```

## Further settings for starting points

For pages of the type "Starting point of a web page" there are additional input fields available, with which you can overwrite certain global settings per web page.

**E-mail address of the website administrator:** Here you can overwrite the e-mail address of the system administrator defined in the backend settings for a specific website. This address is used to send notifications about blocked accounts or newly registered users, for example. If you have multiple websites within the site structure, it may be useful to set a separate administrator for each website, who will only receive notifications from his website. You can also use the following notation to add a name to your email address:

```text
Kevin Jones [kevin.jones@example.com]
```

**Date format:** Here you can overwrite the date format defined in the backend settings. In contrast to the backend, which only supports numeric formats, you can also use text formats in the frontend.

**Time format:** Here you can overwrite the time format defined in the backend settings. Text formats are also supported in the frontend.

**Date and Time Format:** Here you can override the date and time format defined in the backend settings. Text formats are supported.

Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/de/function.date.php). To convert all input into aUNIX timestamp, only numeric formats (j, d, m, n, y, Y, g, G, h, H, i, s) are allowed in the back end.

Here are some examples of valid dates and times:

| Specifications | Declaration |
| -------------- | ----------- |
| Y-m-d | YYYY-MM-DD, international ISO-8601, for example `2005-01-28` |
| m/d/Y | MM/DD/YYYY, English format, for example `01/28/2005` |
| d.m.Y | DD.MM.YYYY, German format, for example `28.01.2005` |
| y-n-j | JJ-M-T, without leading zeros, e.g. `05-1-28` |
| Ymd | YYYYMMDD, time stamp, for example `20050128` |
| H:i:s | 24 hours, minutes and seconds, for example `20:36:59` |
| g:i | 12 hours without leading zeros and minutes, for example `8:36` |

{{< version "4.5" >}}

**Alias settings:** The slug generator allows you to select an individual character set for automatically generated aliases.

| Alias Settings | Declaration |
| -------------- | ----------- |
| Unicode numbers and small letters | The alias `über-uns` is generated from the page name "About us". |
| Unicode numbers and letters | The alias `Über-uns` is generated from the page name "About us". |
| ASCII numbers and small letters | The alias `ueber-uns` is generated from the page name "About us". |
| ASCII numbers and letters | The alias `Ueber-uns` is generated from the page name "About us". |

For the creation of the alias, the set language is also relevant in some cases. So we convert a German "Über" to "über" but a Finnish "eläinkö" to "elainko".

{{< version "4.8" >}}

**Two-factor authentication:** Here you can force two-factor authentication for all members (frontend). Select a page that visitors will be redirected to when they set up the two-factor authentication.

## Layout settings

A page layout is a prerequisite for Contao to be able to display a page in the frontend at all. If no page layout has been assigned or inherited, Contao confirms the service with a short "No layout specified".

**Assign a layout:** Here you can assign a page layout to a page. The assignment automatically applies to all sub pages without a page layout.

**Page layout:** Here you can see all available page layouts grouped by themes. You activate a theme by assigning a page layout.

## Cache settings

In the cache settings you can define if and how long a page should be cached. Cached pages load much faster because they do not have to be generated by Contao and they do not need a connection to the database for delivery.

**Set the cache time:** Here you can assign a cache time to a page. If you do not select this option, the cache settings are inherited from a parent page.

**Private Cache (client cache time)**: Allows you to assign a cache time to a page. This sets the time in seconds after which the browser will consider the page out of date.

**Shared Cache (server cache time):** Here you can assign a cache time to a page. This defines the time in seconds after which the page is considered obsolete by a shared cache.

Note that for security reasons, pages are only cached if they are not protected and no user is logged on to the backend. Otherwise, there is a risk that confidential data is written to the cache and accidentally displayed in the frontend. So don't be surprised if your password-protected pages don't show up in the cache despite their assigned expiration time.

{{< version "4.8" >}}

**Always load from the shared cache:** Always load this page from the shared cache, even if no member is logged in. Note that in this case you will not be able to personalize the page for logged in members.

## Access rights

In the access rights you define which users in the backend (!) are allowed to access a page and what they can do with this page and the articles it contains. Similar to the Unix permissions system, each page belongs to a specific user and user group and has three levels of access:

- Access as owner of a page
- Access as member of the group of a page
- Access as other backend user

For example, the "Company" page is assigned access rights and belongs to the user h.lewis and the user group News. Both the user and everyone in the user group can edit articles on the page, but only the owner, h.lewis, and you the administrator can edit the page and change its title.

![Assign access rights](/de/layout/site-structure/images/de/zugriffsrechte-zuweisen.png?classes=shadow)

**Assign access rights:** Here you can assign access rights to a page. If you do not select this option, the access rights will be inherited from a parent page.

**Owner:** Here you can set the owner of the page.

**Group:** Here you define the group of the page.

**Access rights**: Here you assign the rights to the individual access levels.

For more information on the permissions system and the configuration of users and user groups, see the [System Administration](/de/system/einstellungen/) page.

## Access protection

In contrast to access rights, which define the rights in the back end, access protection refers to the protection of a page from access in the front end. Visitors must first log in with their username and password before they can access the page. Otherwise they would only see an error page.

**Protect page:** Here you can restrict access to a page. If you do not select this option, access protection is inherited from a parent page.

**Allowed member groups:** Here you can define which member groups are allowed to access the page. To configure members and member groups, see the System Administration page.

## Expert settings

There may be pages within your site structure that are available in the frontend but should not appear in the menu. Or there could be pages that should only be displayed until a user logs in (for example, the registration page). You can configure such special wishes in the expert settings.

**CSS class:** Here you assign a CSS class to the page, which is used in the body tag of the HTML page as well as in the navigation modules. This way you can create CSS formatting for a specific page or menu item.

**Show in the sitemap:** If desired, Contao creates an XML sitemap for each website that you can submit to Google[ (XML sitemap](#xml-sitemap)). By default, this includes all public pages and not those hidden in the menu. You can change this behavior per page if needed:

- **Default:** Use the default settings.
- **Always display:** The page is always displayed in the XML Sitemap, even if, for example, it is hidden in the menu and would not normally be displayed.
- **Never display:** The page is excluded from the XML Sitemap.

**Hide in menu:** If you select this option, the page will not be displayed in the menu of your website, but you can still access the page - if it has been published - via a direct link or in a frontend module.

Contao indexes the finished pages of your website and creates a search index that you can search with the frontend module "search engine". With this setting, you can exclude certain pages from the indexing process. In the backend settings, you can also disable the search function completely.

**Do not search:** Here you can exclude a page from the search.

**Show only guests:** If you select this option, the link to the page will be automatically hidden from the navigation menu of the website once a member has logged in. This is useful for the Login and Registration pages, for example.

{{< version "4.5" >}}

**Element required:** If you select this option, this page will show error page 404 if the URL does not contain an alias for an element.

## Keyboard navigation

From section [Backend shortcuts](/de/administrationsbereich/backend-tastaturkuerzel/) you already know that Contao supports navigation using shortcuts. This not only has a positive effect on accessibility but also speeds up the workflow. For this reason, the feature is also available in the frontend and each page can optionally be provided with a keyboard shortcut and a tab index.

**Tab Index:** By default, you can use the Tab key to jump from top to bottom through the navigation menu. However, you can specify an individual order by assigning a number between 1 and 32,767 to each page, and the tab will then follow your sorting in ascending order instead of the default order.

**Shortcut keys:** A shortcut key is a single character associated with a page. Visitors to your site can then access that page directly from the keyboard. This function is especially required for accessible websites.

## DNS Settings

DNS settings are only available for pages of type "Starting point of a website". You determine which starting pointContao loads depending on the domain called and the language set in the visitor's browser.

**Domain name:** If you want a website in your site structure to be accessible under a specific domain such as "company.com", you can enter it here. If a visitor then calls up "company.de" in his browser, he will be automatically redirected to the corresponding starting point of a website.

**Use HTTPS:** Activate this checkbox if your website is available via HTTPS.

**Language**: Here you can set the language of the starting point. Languages are recorded via their primary subtag according to ISO 639-1, e.g. `de` for German or `en` for English.

**Language fallback:** Contao always searches for a starting point in the language that a visitor has selected in his browser. If there is only a German starting point, an English visitor would only see the error message "No pages found" because there is no website in his language.

To avoid this, you can define a certain starting point as a fallback, which freely translated means "welcome page" or "alternative page". This fallback page will then catch all visitors who cannot be assigned to a starting point due to their language settings.

So make sure to always define a starting point as language fallback. Otherwise your website can only be accessed by German visitors! Also the robots of the search engines that index your website usually speak English and would also be excluded without language fallback. Your pages would then never appear on Google despite careful optimization.

## XML Sitemap

Contao automatically creates an XML sitemap from the page structure of the website that can be read and analyzed by Google. To sign up the sitemap with Google, you need a Google account.

**Create an XML Sitemap:** Here you activate the creation of the XML Sitemap.

**Filename:** Enter the name of the Sitemap file here without the file extension `.xml`. Contao will automatically add the file extension when saving the file.

The settings are only available for pages of type "Starting point of a web page".

## Forwarding

The following settings are only available for redirect pages. Contao distinguishes between internal and external redirects [(page types](/en/layout/site-structure/pages-as-central-elements/#page-types).

**Forwarding type:** Here you can specify whether the forwarding is temporary (HTTP 302) or permanent (HTTP 301). The redirection type is especially important for search engine optimization.

**Forwarding page:** Here you specify the target page for internal forwarding.

**Link address:** Here you can enter the destination URL in case of external redirection. You must use the protocol `https://` for redirection to another website, the protocol for linking an e-mail address `mailto:` and the protocol `tel:` for linking a phone number.

**Open in a new window:** The target page will open in a new browser window.

**Further settings for error pages**

With error pages, you can optionally redirect visitors to another page instead of displaying a message. For example, if an unregistered visitor comes across the error 403 page when trying to access a protected page, you could redirect them directly to the login page.

**Redirect to another page:** Here you activate the auto-redirect.

## Publication

As long as a page is not published, it practically does not exist in the frontend and cannot be accessed by visitors. In addition to manual publishing, Contao also offers the possibility to activate pages automatically on a specific date. This way you can, for example, apply for a limited time offer.

**Publish a page:** Here you can publish a page.

**Show from:** Here you activate a page on a specific date.

**Show until:** Here you deactivate a page at a certain date.

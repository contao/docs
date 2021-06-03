---
title: 'Accessing and structure of the back end'
description: 'In the administration area, the so-called back end, you can do all the work related to the administration of your website.'
aliases:
- /en/administration-area/call-and-structure-of-the-backend/
weight: 10
---

## Accessing the back end

You can access the back end of your Contao installation by appending `/contao` the URL of your website. The complete address looks like this:

`https://www.example.com/contao/`

Enter your `Username` and your `Password`. The default language of the browser is also used for the back end. Confirm your entries by clicking the button `Continue`.

![Registration in the Contao back end](/de/administration-area/images/en/contao-call-the-backend.png?classes=shadow)

The back end login is [protected](https://en.wikipedia.org/wiki/Brute-force_search) against [brute force attacks](https://en.wikipedia.org/wiki/Brute-force_attack) with a time delay mechanism. If you enter an incorrect password more than three times in a row, your account will automatically be locked for 5 minutes. This prevents a hacker from trying a large number of passwords in succession until he finds the right one.

## Structure of the back end

The back end is divided into three areas. At the top is the info area, on the left is the navigation and on the right is the work area.

![Distribution of the Contao back end](/de/administration-area/images/en/contao-dashboard.png?classes=shadow)

### The information area

The info area shows some important links that are needed when working with Contao.

**Homepage:** A click on the Contao logo takes you back to the homepage of the back end.

**Notes:** Clicking on this link opens a modal and displays possible hints (e.g. maintenance mode).

**Debug Mode:** Clicking on this link will switch the [debug mode](/en/system/debug-mode/) on or off.{{< version "4.8" >}}

**Preview:** This link opens the frontend, i.e. the actual website, in a new window. If you edit a specific page or article in the back end, you will be automatically forwarded to the corresponding page in the frontend.

**User:** When you click on User, the following links are displayed:

**Profile:** This link leads to the personal settings of your user account. There you can change your password or change the language.

**Log out:** Log out of the back end here.

**Security:** Activate the two-factor authentication for your back end.{{< version "4.6" >}}

### The navigation area

The navigation area contains links to the different back end modules, each of which fulfills a specific task. For a better overview, the modules are organized in groups that you can expand and collapse as needed.

**Contents:** This group contains all modules that manage any kind of content. In Contao, content includes not only articles, but also e.g. news items, events, comments or forms.

**Layout:** This group contains all design-relevant modules that you can use to define the look and structure of your website.

**User management:** This group contains all modules that are related to the management of users and user groups. In Contao, we distinguish between "users" (back end users) and "members" (frontend users).

**System:** This group contains different modules for the configuration and maintenance of your Contao installation and the file management.

### The workspace

In the workspace, you do all your work within Contao. Depending on the module, different functions are available.

Immediately after logging in, the back end homepage will show you the date of your last login, an overview of the back end keyboard shortcuts and the versions of the last edited content.

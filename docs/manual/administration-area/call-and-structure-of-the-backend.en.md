---
title: 'Call and structure of the backend'
description: 'In the administration area, the so-called backend, you can do all the work related to the administration of your website.'
aliases:
    - /en/administration-area/call-and-structure-of-the-backend/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## Call of the backend

You can reach the backend of your Contao installation by adding `/contao` to the URL of your website. The complete address looks like this:

`https://www.example.com/contao/`

Enter your `username` and `password`. The default language of your internet browser is also used for the backend. Confirm your entries by clicking the `Next` button.

![Registration in the Contao backend](/de/administration-area/images/de/contao-backend-anmeldung.png?classes=shadow)

The backend login is protected against [brute force attacks](https://de.wikipedia.org/wiki/Brute-Force-Methode) with a time delay mechanism. If you enter an incorrect password more than three times in a row, your account will automatically be locked for 5 minutes. This prevents a hacker from trying a large number of passwords in succession until he finds the right one.

## Structure of the backend

The backend is divided into three areas. At the top is the info area, on the left is the navigation area and on the right is the work area.

![Distribution of the Contao backend](/de/administration-area/images/de/contao-backend-aufteilung.png?classes=shadow)

### The information area

The notification area shows some important links that are needed when working with Contao.

**Home page:** A click on the Contao logo takes you back to the home page of the backend.

**Clues:** When you click on this link, a modal opens and displays possible hints (e.g. maintenance mode).

**Debug Mode:** Clicking this link will enable or disable the [debug mode](../../system/debug-modus/). {{< version "4.8" >}}

**Preview:** This link opens the frontend, that is, the actual Web page, in a new window. If you edit a specific page or article in the backend, you will be automatically redirected to the corresponding page in the frontend.

**Users:** When you click on Users, the following links are displayed:

**Profile:** This link leads to the personal settings of your user account. There you can change your password or change the language.

**Log out:** With this link you can log out of the backend.

**Security:** With this link you can activate the [two-factor authentication](https://de.wikipedia.org/wiki/Zwei-Faktor-Authentisierung) for your backend. {{< version "4.6" >}}

### The Navigation Area

The navigation area contains links to the various backend modules, each of which performs a specific task. For a better overview, the modules are grouped together in groups that you can expand and collapse as needed.

**Contents:** This group contains all modules that manage any kind of content. In Contao, content includes not only articles, but also e.g. news items, events, comments or forms.

**Layout:** This group contains all design-relevant modules that you can use to define the look and structure of your website.

**User administration:** This group contains all modules that are related to the administration of users and user groups. In Contao, we distinguish between "users" (backend users) and "members" (frontend users).

**System:** This group contains various modules for configuring and maintaining your Contao installation. The file management is also included here.

### The work area

In the workspace, you do all your work within Contao. Depending on the module, different functions are available.

Immediately after logging in, the backend homepage will show you the date of your last login, an overview of the backend keyboard shortcuts and the versions of the last edited content.

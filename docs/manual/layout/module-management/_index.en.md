---
title: 'Module management'
description: 'Frontend modules generate the HTML code of the web page. They belong to the design-relevant elements and are therefore subordinate to the Theme Manager.'
aliases:
    - /en/layout/module-management/_index/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

On the previous pages, you learned that the layout of a page is determined by the page layout assigned to it. Among other things, this defines various layout areas in which you can place any frontend module, which in turn generates the HTML code for your website.

This page is now concerned with the creation and configuration of these frontend modules, which are subordinate to theTheme Manager as part of the design. Each module that you create is therefore automatically assigned to a particular theme and can be exported with that theme and reused in another installation.

Therefore, you can access the module manager via the Theme Manager, as described in the[ Configuring](../theme-manager/themes-verwalten/#themes-konfigurieren) Themes section.

{{% children %}}

As with content elements, you can restrict access to a front-end module to specific groups of members under **Access Protection**.

![Restrict access to a module](/de/layout/module-management/images/de/den-zugriff-auf-ein-modul-einschraenken.png?classes=shadow)

**Protect module:** The module is invisible by default and is only displayed after a member has logged on to the frontend.

**Allowed member groups**: Here you define who has access to the module.

In the **expert settings** the module can only be displayed for guests.

**Show guests only:** The module is visible by default and is hidden as soon as a member has logged on to the frontend.

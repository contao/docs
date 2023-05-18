---
title: EasyThemes
description: 'Easier management of themes with EasyThemes.'
aliases:
    - /en/extensions/contao-easy_themes/
---

**[terminal42/contao-easy\_themes](https://packagist.org/packages/terminal42/contao-easy_themes)**

*from [terminal42 gmbh](https://www.terminal42.ch/de/)*

Enables direct access to stylesheets, modules, page layouts and image sizes - reduces the number of clicks even if only 
one theme is used.

After successful installation, log in to the back end and go to the "Users" tab in "User Management". From the user 
list, select the user who is to benefit from EasyThemes. Click on the 
[Edit User]({{% asset "icons/edit.svg" %}}?classes=icon "Edit User") edit symbol and then check the box "**Enable EasyTheme**" in 
the last section of the user administration.

![Enable EasyTheme]({{% asset "images/manual/extensions/en/enable-contao-easy_themes.png" %}}?classes=shadow)

Under **Active Modules** you determine which modules are to be displayed.

The following modules are available:

- **Edit Theme:** Here you can edit the settings of the theme.
- **Style sheets:** Here you can create new stylesheets and edit existing ones.
- **Front end modules:** Here you can create new front end modules and edit existing ones.
- **Page Layouts**: Here you can create new page layouts and edit existing ones.
- **Image sizes:** Here you can create new image sizes and edit existing ones.

{{% notice note %}}
The internal CSS editor is deprecated and will be removed in one of the next Contao versions!
{{% /notice %}}

In **EasyTheme Mode** you have to choose one of four display types.

**Contextmenu:** The selection menu appears when you right-click on themes.

![EasyTheme Mode: Contextmenu]({{% asset "images/manual/layout/extensions/en/contao-easy_themes-mode-contextmenu.png" %}}?classes=shadow)

**Mouseover**: The selection menu appears when you mouse over themes.

![EasyTheme Mode: Mouseover]({{% asset "images/manual/layout/extensions/en/contao-easy_themes-mode-mouseover.png" %}}?classes=shadow)

**DOM-Inject:** The selection menu is displayed directly under Themes.

![EasyTheme Mode: DOM-Inject]({{% asset "images/manual/layout/extensions/en/contao-easy_themes-mode-dom-inject.png" %}}?classes=shadow)

**Back end modules (without selecting a reference group):** Creates an additional back end module above the "Contents" 
section.

![EasyTheme mode: Back end modules (without selecting a reference group)]({{% asset "images/manual/layout/extensions/en/contao-easy_themes-mode-back-end-modules-without-reference.png" %}}?classes=shadow)

**Back end Module (with selection of a reference group):** Creates an additional back end module under the selected 
section.

![EasyTheme mode: Back end modules (with selection of a reference group)]({{% asset "images/manual/layout/extensions/en/contao-easy_themes-mode-back" %}}%20end-module-with-reference.png?classes=shadow)

Take your time and still be faster.

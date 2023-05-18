---
title: 'Navigation modules'
description: 'Navigation modules are among the most important front end modules at all and are used on almost every 
website in some form or another.'
aliases:
    - /en/layout/module-management/navigation-modules/
weight: 10
---

Navigation modules are one of the most important front end modules and are used on almost every website in any form. A 
navigation module creates a navigation menu out of the hierarchical page structure, which, depending on your needs, 
either displays the whole page tree or certain parts of it. Your visitors can then click through the pages of the 
website using this navigation menu.


## Navigation menu

The front end module "Navigation menu" adds a hierarchical navigation menu to the Web page, which contains all 
published and non-hidden pages including their subpages. If needed, you can reconfigure the module to display only the 
main pages or only the subpages above a certain depth - called "level" in Contao - to create main and sub menus.

**Start level:** By default the navigation menu starts at the highest level and works its way through all sublevels to 
the lowest nested level. The start level offers you the possibility to start the navigation menu from the second level, 
for example, so that only a part of the page tree is displayed (submenu).

![The navigation menus in the front end]({{% asset "images/manual/layout/module-management/en/the-navigation-menus-in-the-front-end.png" %}}?classes=shadow)

**Stop level:** In contrast to the start level, which determines the entry level of the navigation menu, the stop level 
determines the exit level, i.e. the maximum depth of the nesting. The main menu of our website, for example, should 
only display the main pages, so the output of the subpages has been limited to the first level of the page structure by 
means of stoplevel 1.

This only works for the pages of the first level. If you call up a page of the second or third level, it will appear in 
the navigation menu, including all its parent pages, despite the stop level. This behaviour is intentional, because 
the path to the active page should always be displayed completely in the navigation menu.

For a real main navigation like on our website, this behaviour is rather counterproductive, since only the pages of the 
first level are needed here and any subpages are displayed in a separate submenu. For this reason, there is the 
**Hard Limit** option, which ensures that subpages beyond the top level are never displayed.

**Show protected items:** If you select this option, protected pages are always displayed in the navigation menu. By 
default, such pages are only visible if a front end user is logged on.

**Show hidden items:** If you select this option, menu items are displayed which are otherwise not visible in the 
navigation.

**Set a reference page:** Normally a navigation menu starts at the root page of the page structure (starting point of 
a web page). If you only want to display a subtree, you can define an individual starting point here.

**Navigation template:** Here you choose the template for the navigation.

**Module template:** Here you can overwrite the standard `mod_navigation` template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<nav class="mod_navigation block" itemscope itemtype="http://schema.org/SiteNavigationElement">

    <a href="#skipNavigation1" class="invisible">Skip navigation</a>

    <ul class="level_1">
        <li class="active start first">
            <strong class="active first" itemprop="name">…</strong>
        </li>
        <li class="submenu sibling">
            <a href="…" class="submenu sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>

            <ul class="level_2">
                <li class="noprevlink first">
                    <a href="…" class="noprevlink first" itemprop="url"><span itemprop="name">…</span></a>
                </li>            
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
                </li>
            </ul>

        </li>
        <li class="sibling last">
            <a href="…" class="sibling last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>

    <a id="skipNavigation1" class="invisible">&nbsp;</a>

</nav>
<!-- indexer::continue -->
```

Note that the CSS classes are assigned to both the `<li>` element and the `<a>` respectively `<strong>`, so define in 
your selectors exactly which elements you mean, for example `li.first` instead of just `.first`. The currently active 
page is not displayed as an active link, but as an element `<strong>` in accordance with accessibility requirements.


## Custom navigation

The front end module "Custom navigation" adds a navigation menu to the Web page from any number of pages that does not 
take hierarchical dependencies into account.

**Pages:** Here you select which pages should be included in the menu.

**Show protected items:** If you select this option, protected pages are displayed in the individual navigation. By 
default, such pages are only visible if a front end user is logged on.

**Navigation template:** Here you select the template for the navigation.

**Module template:** Here you can overwrite the default `mod_customnav` template.

**The HTML Output** 
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<nav class="mod_customnav block" itemscope itemtype="http://schema.org/SiteNavigationElement">

    <a href="#skipNavigation1" class="invisible">Skip navigation</a>

    <ul class="level_1">
        <li class="active first">
            <strong class="active first" itemprop="name">…</strong>
        </li>
        <li class="last">
            <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>

    <a id="skipNavigation1" class="invisible">&nbsp;</a>

</nav>
<!-- indexer::continue -->
```


## Breadcrumb navigation

**Show hidden items:** If you select this option, hidden pages that would normally be skipped are also displayed in the 
navigation path.

**Module template:** Here you can overwrite the standard `mod_breadcrumb` template.

![The breadcrumb navigation in the front end]({{% asset "images/manual/layout/module-management/en/the-breadcrumb-navigation-in-the-front-end.png" %}}?classes=shadow)

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_breadcrumb block">

    <ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li class="first" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="…" itemprop="item"><span itemprop="name">…</span></a><meta itemprop="position" content="1">
        </li>
        <li class="active last"> … </li>
    </ul>

</div>
<!-- indexer::continue -->
```


## Quick navigation

The front end module "Quick navigation" adds a drop-down menu to the website, with which a visitor can jump directly to 
a specific page.

**Custom label:** Here you can enter an individual name for the first option of the quick navigation.

**Stop level**: Here you can define the level of nesting to which subpages are displayed in the quick navigation (see 
[navigation menu](#navigation-menu).

**Hard Limit:** If you select this option, menu items beyond the top level will never be displayed.

**Show protected items:** If you select this option, protected pages will also be displayed, which are otherwise only 
available to logged in members.

**Show hidden items:** If you select this option, hidden pages that would normally be skipped are also displayed in the 
quick navigation.

**Reference page:** Here you define the starting page of the quick-navigation.

**Module template:** Here you can overwrite the standard `mod_quicknav` template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_quicknav block">

    <form method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_quicknav">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-select">
                <label for="ctrl_target" class="invisible">Target page</label>
                <select name="target" id="ctrl_target" class="select">
                    <option value="…">…</option>
                    <option value="…">…</option>
                </select>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Los</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Quick link

The front end module "Quick link" adds a drop-down menu of any pages to the website, which does not consider any 
hierarchical dependencies.

**Pages:** Here you select which pages should be included in the menu.

**Custom label:** Here you can enter an individual name for the first option of the quick-navigation.

**Module template:** Here you can overwrite the default `mod_quicklink` template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_quicklink block">

    <form action="…" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_quicklink">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-select">
                <select name="target" class="select">
                <option value="…">…</option>
                <option value="…">…</option>
                <option value="…">…/option>
                </select>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Go</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Book navigation

The front end module "Book navigation" adds a navigation menu to the website, which allows you to navigate forward, 
backward or one level up within the page structure. The individual pages are turned like a book, hence the name of the 
module.

![The book navigation in the frontend]({{% asset "images/manual/layout/module-management/en/the-book-navigation-in-the-frontend.png" %}}?classes=shadow)

**Reference page**: The reference page defines the starting point of the book navigation. Parent pages are not 
displayed in the book navigation.

**Show protected items:** If you select this option, protected pages will also be displayed, which are otherwise only 
available to registered members.

**Show hidden items:** If you select this option, hidden pages that would normally be skipped are also displayed in the 
book navigation.

**Module template:** Here you can overwrite the default `mod_booknav` template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_booknav block">

    <ul>
        <li class="previous"><a href="…" >…</a></li>
        <li class="up"><a href="…">…</a></li>
        <li class="next"><a href="…">…</a></li>
    </ul>

</div>
<!-- indexer::continue -->
```


## Article navigation

The "Article navigation" module adds a navigation menu to the website, which allows you to browse forward and backward 
through the articles on a particular page, similar to book navigation.

![The article navigation in the front end]({{% asset "images/manual/layout/module-management/en/the-article-navigation-in-the-front-end.png" %}}?classes=shadow)

**Load the first item:** If you select this option, the first item is automatically loaded if no specific item has been 
requested.

**Module template**: Here you can overwrite the default `mod_articlenav` template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_articlenav pagination block">

    <ul>
        <li class="active"><strong class="active">1</strong></li>
        <li class="link"><a href="…" class="link">2</a></li>
        <li class="link"><a href="…" class="link">3</a></li>
        <li class="next"><a href="…" class="next">Next</a></li>
        <li class="last"><a href="…" class="last">End</a></li>
    </ul>

</div>
<!-- indexer::continue -->
```

Note that the active element is displayed as `<strong>` a link and not as a link.


## HTML sitemap

The front end module "HTML sitemap" adds an overview of all published and not hidden pages to the website. The 
individual entries are displayed as links so that visitors can jump directly to a specific page. Whether or not a page 
is displayed in the HTML sitemap also depends on its configuration in the page structure (see 
[Expert Settings](/en/layout/site-structure/configure-pages/#expert-settings).

**Show protected items:** If you select this option, protected pages will also be displayed, which are otherwise only 
available to registered members.

**Show hidden items:** If you select this option, hidden pages that would normally be skipped are also displayed in the 
HTML sitemap.

**Reference page:** Here you specify the initial page of the HTML sitemap.

**Navigation template:** Here you choose the template for the module.

**Module template**: Here you can overwrite the standard `mod_sitemap` template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_sitemap block">

    <ul class="level_1">
        <li class="sibling first">
            <a href="…" class="sibling first" accesskey="1" itemprop="url"><span itemprop="name">…</span></a>
        </li>
        <li class="submenu trail sibling">
            <a href="…" class="submenu trail sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>

            <ul class="level_2">
                <li class="first">
                    <a href="…" class="first" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a></li>
            </ul>

        </li>
        <li class="submenu sibling">
            <a href="…" class="submenu sibling" aria-haspopup="true" itemprop="url"><span itemprop="name">…</span></a>

            <ul class="level_2">
                <li class="first">
                    <a href="…" class="first" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li>
                    <a href="…" itemprop="url"><span itemprop="name">…</span></a>
                </li>
                <li class="last">
                    <a href="…" class="last" itemprop="url"><span itemprop="name">…</span></a>
                </li>
            </ul>

        </li>
        <li class="sibling last">
            <a href="…" class="sibling last" itemprop="url"><span itemprop="name">…</span></a>
        </li>
    </ul>

</div>
<!-- indexer::continue -->
```

The HTML markup is very similar to that of the navigation menu.

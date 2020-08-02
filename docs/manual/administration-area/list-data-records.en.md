---
title: 'List data records'
description: 'Contao stores all information about your website in its database. This includes back end data like users, modules, pages or articles as well as front end data like guestbook entries or comments.'
aliases:
    - /en/administration-area/list-data-records/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Contao stores all information about your website in the database. This includes backend data like users, modules, pages or articles as well as frontend data like guestbook entries or comments. All this data is collected in different tables and can be listed, searched, copied, moved, deleted or edited in the back end.

## The different views

The three most common types of listings, which are called views below, are the simple list view ("List View"), the list grouped by the parent table ("Parent View") and the tree view ("Tree View").

### list view

These are records from a single table, which are listed in a certain order, usually alphabetically, and the rows are grouped by their first letter.

![Der List View](/de/administration-area/images/de/der-list-view.png?classes=shadow)

### parent view

These are records that have a parent-child relationship with the records in a second table. Imagine two shopping baskets and the products they contain. In each shopping basket, i.e. parent element, there can be any number of products, i.e. child elements.

In Contao, such parent-child relationships are very common, for example

- Articles and content elements,
- Archives and news items or
- Image sizes and media queries.

When you list the contents of a shopping cart, you only want to see the products in one cart, not the products in the other. Therefore, Contao shows you only the child elements of the selected parent element in the Parent View.

![Der Parent View](/de/administration-area/images/de/der-parent-view.png?classes=shadow)

### tree view

These are data records that are hierarchically interdependent and are therefore displayed in a tree structure. Typically, this is the case for a file system where there are directories and subdirectories, so the Contao file manager also uses this view. Hierarchical structures can also be displayed within a table, like the page structure of your website.

![Der Tree View](/de/administration-area/images/de/der-tree-view.png?classes=shadow)

## Sort and filter records {#sort-and-filter records}

To keep track of tables with many records, Contao offers you several ways to sort and filter the listings. Most listings can be filtered so that you only see the records that you really need for a specific action.

![Datensätze sortieren und filtern](/de/administration-area/images/de/datensaetze-sortieren-und-filtern.png?classes=shadow)

**Filtering:** Here you can set one or more filters to display only those members who are male and speak English, for example.

**Sort:** Here you define the field by which the listing is sorted.

**Search:** Here you can search a field for a specific value so that only records containing the term you are looking for are displayed. The query supports so-called regular [expressions](https://wiki.selfhtml.org/wiki/Perl/Regul%C3%A4re_Ausdr%C3%BCcke#zeichen) , which means you can search for a term. B. Retrieve `^a`all records that begin with the letter A, or similarly, `a$`all records that end with the letter A. The search for `meier|schmidt`, which finds both Mr. Meier's and Mr. Schmidt's accounts, is also extremely helpful.

**Display:** Here you can limit the number of records per page. This filter is always active by default and set to 30 records, because listing several hundred records can take quite some time.

All filters can be combined with each other as desired. Active filters are highlighted in yellow, so you can see at a glance which filters you have set. To deactivate a filter, select the top entry from the drop-down menu or delete the search term from the search field.

By clicking on the following icons the filters can be applied or reset:

![Filter anwenden](/de/icons/filter-apply.svg?classes=icon)  **Apply filters:** set the filters and then apply them.

![Filter zurücksetzen](/de/icons/filter-reset.svg?classes=icon)  **Reset filter:** the filter selection reset.

## The navigation icons

You may have noticed the colorful icons that appear to the right of each record in each view. With these navigation icons you can edit, copy, move or delete single data records.

### Standard Icons

The following navigation icons appear in almost all views. For reasons of clarity, they do not contain additional text. However, if you position the pointer of your mouse over an icon, the corresponding description is displayed.

![Bearbeiten](/de/icons/edit.svg?classes=icon)  **Edit:** calls up a specific record in edit mode.

![Duplizieren](/de/icons/copy.svg?classes=icon)  **Duplicate:** creates a copy of an existing record.

![Löschen](/de/icons/delete.svg?classes=icon)  **Delete:** deletes a record ([this process can be revoked](#geloeschte-datensaetze-wiederherstellen) ).

![Veröffentlichen/unveröffentlichen](/de/icons/visible.svg?classes=icon)  **Publish/unpublish:** show or hide in the frontend

![Info](/de/icons/show.svg?classes=icon)  **Info:** shows information about a record.

### Icons in the List View

In addition to the basic commands, the List View can offer the following additional commands.

![Icons im List View](/de/administration-area/images/de/icons-im-list-view.png?classes=shadow)

![Einstellungen bearbeiten](/de/icons/header.svg?classes=icon)  **Edit settings:** adjust the settings for the parent element.

### Icons in the Parent View

The Parent View offers two additional icons to define the order of the records. The order can also be changed by drag &amp; drop. Simply click on the Drag &amp; Drop icon and ![Verschieben](/de/icons/drag.svg?classes=icon)move to the new position.

![Icons im Parent View](/de/administration-area/images/de/icons-im-parent-view.png?classes=shadow)

![Verschieben](/de/icons/cut.svg?classes=icon)  **Move:** moves a record to another position.

![Neues Element](/de/icons/new.svg?classes=icon)  **New Item:** creates a new record after the current record.

![Einfügen](/de/icons/pasteafter.svg?classes=icon)  **Insert:** inserts a new record after the current record.

**![Datei oder Verzeichnis verschieben](/de/icons/drag.svg?classes=icon) postpone:**  Move a file or folder using drag &amp; drop.

### Icons in Tree View

In the tree view, there are other icons that are necessary because of the hierarchical relationships between the records. For example, when moving or duplicating records, you need a way to specify whether they should be inserted after a record in the same level or below a record in a new level.

![Icons im Tree View](/de/administration-area/images/de/icons-im-tree-view.png?classes=shadow)

![Unterseiten duplizieren](/de/icons/copychilds.svg?classes=icon)  **Duplicate subpages:** duplicates a page including all subpages.

![Seite bearbeiten](/de/icons/article.svg?classes=icon)  **Edit page:** edit the page.

![Dahinter einfügen](/de/icons/pasteafter.svg?classes=icon)  **Insert after:** inserts a page after the current page.

![Darunter einfügen](/de/icons/pasteinto.svg?classes=icon)  **Insert below:** inserts a page below the current page.

![Artikel bearbeiten](/de/icons/article.svg?classes=icon)  **Edit Article** : edit the article on the page.

## The clipboard

The clipboard is not a separate application that you can call and view anywhere. It is automatically active in the background and remembers the records you want to duplicate or move. This makes it possible to move records beyond the boundaries of a parent element.

You can think of the clipboard as the clipboard on your computer, where you can copy `[Ctrl]+[c]`certain data to and paste them `[Ctrl]+[v]`to another place. In Contao, you can move content elements from one article to another.

![Inhaltselemente mittels Klemmbrett verschieben](/de/administration-area/images/de/inhaltselemente-mittels-klemmbrett-verschieben.png?classes=shadow)

## Recover deleted records {#deleted-records-recover}

Whenever you delete one or more records, they are not immediately removed from the database, but moved to a virtual trashcan. You can retrieve the data from this recycle bin at any time and restore it to its original location.

You can find the "Recycle Bin" in the navigation area in the group System under the item Restore. There you will see a dueine list of all deleted records, which you can sort either by the date of deletion or by the origin of the record. You can undo a deletion by clicking on the corresponding navigation icon ![Eintrag wiederherstellen](/de/icons/undo.svg?classes=icon).

![Einen Löschvorgang rückgängig machen](/de/administration-area/images/de/einen-loeschvorgang-rueckgaengig-machen.png?classes=shadow)

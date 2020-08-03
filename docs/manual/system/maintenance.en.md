---
title: 'System maintenance'
description: 'Most maintenance tasks in Contao are automated so you can concentrate on your real work.'
aliases:
    - /en/system/maintenance/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Most maintenance tasks in Contao are automated so that you can concentrate on your real work. Sometimes, however, it might be necessary to manually start the system maintenance tasks that are otherwise performed automatically.

## Clean up data

In addition to the user-generated content, Contao stores various system data that is used to search for or restore deleted records or previous versions. You can manually clean this data, for example to remove old thumbnails or to update the XML sitemaps after a change in the page structure.

![Clean up data manually](/de/system/images/de/daten-manuell-bereinigen.png?classes=shadow)

## Rebuild search index

Pages are automatically indexed when you access them in the frontend (unless you are logged into the backend at the same time), so you don't normally have to worry about the search index. However, if you have updated many pages at once, it is more convenient to rebuild the search index manually than to call up all changed pages one by one in the browser.

![Build the search index automatically](/de/system/images/de/den-suchindex-automatisch-aufbauen.png?classes=shadow)

## Indexing protected pages

To allow the search of protected pages, you must first enable this feature in the backend settings. Use this feature very carefully and always exclude personalized pages from the search!

Then create a new front-end user and allow him or her to access the protected pages to be indexed.

Later during the search, the protected pages will of course only appear in the results if the registered frontend user is allowed to access them.

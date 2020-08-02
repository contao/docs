---
title: Applications
description: 'In this section you will be introduced to the other core modules in the "Applications" section.'
aliases:
    - /en/layout/module-management/applications/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In this section I will introduce the other core modules in the "Applications" section. The list of frontend modules can be extended by (third party) extensions.

## Form

With the module type "Form" a form can be added to a page. For information on creating and managing forms, see the [Form Generator](../../../formulargenerator/) page.

**form:** Here you can select a form

## Listing

The frontend module "Listing" adds a list of records to the website that can be sorted, filtered and searched in the frontend. The basis for the listing is any table in the database, such as the member `tl_member`table .

![Configuring the Listing Module](/de/layout/module-management/images/de/das-auflistungsmodul-konfigurieren.png?classes=shadow)

**table:** Here you specify the table whose records should be listed.

**Fields:** Enter here the fields that should be displayed in the list. Separate the individual fields with a comma.

**condition:** Here you can enter a condition for filtering the records. Since the module principle does nothing else than a database query, you can`published=1` use SQL-compliant code such as It is also possible to use insert tags, e.g. `user={{user::id}}`.

**Searchable fields:** If you define certain fields as searchable, Contao automatically creates a form to search them.

**Sort by:** Here you can specify the columns by which the list is sorted by default. Separate several fields with commas.

**Elements per page:** If you enter a value greater than 0 here, Contao will automatically distribute the results to multiple pages - assuming there are enough of them.

**Fields of the detail page:** If you enter one or more fields here, Contao adds a small icon to each line of the listing which you can use to open the detail view of a record. On the detail page, you can display additional fields of a record that might not fit in the list.

**Detail page condition:** Here you can enter a condition for filtering the records of the detail page (see above condition).

**List template:** Here you select the template for the list view.

**Detail page template:** Here you select the template for the detail page.

**HTML outputThe**  
 frontend module generates the following HTML code:

```html
<div class="mod_listing ce_table listing block">

    <div class="list_search">
        <form action="content-elements.html" method="get">
            <div class="formbody">
                <input type="hidden" name="order_by" value="">
                <input type="hidden" name="sort" value="asc">
                <input type="hidden" name="per_page" value="5">
                <div class="widget widget-select">
                    <label for="ctrl_search" class="invisible">Vorhandene Felder</label>
                    <select name="search" id="ctrl_search" class="select">
                        <option value="firstname">Vorname</option>
                        <option value="lastname">Nachname</option>
                    </select>
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_for" class="invisible">Suchbegriffe</label>
                    <input type="text" name="for" id="ctrl_for" class="text" value="">
                </div>
                <div class="widget widget-submit">
                    <button type="submit" class="submit">Suchen</button>
                </div>
            </div>
        </form>
    </div>

    <div class="list_per_page">
        <form action="content-elements.html" method="get">
            <div class="formbody">
                <input type="hidden" name="order_by" value="">
                <input type="hidden" name="sort" value="asc">
                <input type="hidden" name="search" value="">
                <input type="hidden" name="for" value="">
                <div class="widget widget-select">
                    <label for="ctrl_per_page" class="invisible">Ergebnisse pro Seite</label>
                    <select name="per_page" id="ctrl_per_page" class="select">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                </div>
                <div class="widget widget-submit">
                    <button type="submit" class="submit">Ergebnisse pro Seite</button>
                </div>
            </div>
        </form>
    </div>

    <table class="all_records">
        <thead>
            <tr>
            <th class="head col_first">
                <a href="…" title="Sortiere nach Vorname">Vorname</a>
            </th>
            <th class="head">
                <a href="…" title="Sortiere nach Nachname">Nachname</a>
            </th>
            <th class="head col_last">
                <a href="…" title="Sortiere nach E-Mail-Adresse">E-Mail-Adresse</a>
            </th>
            <th class="head col_last">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr class="row_0 row_first even">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
            <tr class="row_1 odd">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
            <tr class="row_2 row_last even">
                <td class="body col_0 col_first">…</td>
                <td class="body col_1">…</td>
                <td class="body col_2"><a href="…">…</a></td>
                <td class="body col_3 col_last"><a href="…"><img src="…" width="16" height="16" alt=""></a></td>
            </tr>
        </tbody>
    </table>

</div>
```

The HTML markup of the detail page looks like this:

```html
<div class="mod_listing listing block">

    <table class="single_record">
        <tbody>
            <tr class="row_0 row_first even">
                <td class="label">Benutzername</td>
                <td class="value">j.doe</td>
            </tr>
            <tr class="row_1 odd">
                <td class="label">Vorname</td>
                <td class="value">John</td>
            </tr>
            <tr class="row_2 even">
                <td class="label">Nachname</td>
                <td class="value">Doe</td>
            </tr>
            <tr class="row_3 odd">
                <td class="label">E-Mail-Adresse</td>
                <td class="value"><a href="…">…</a></td>
            </tr>
            <tr class="row_4 row_last even">
                <td class="label">Sprache</td>
                <td class="value">en</td>
            </tr>
        </tbody>
    </table>

    <!-- indexer::stop -->
        <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->

</div>
```

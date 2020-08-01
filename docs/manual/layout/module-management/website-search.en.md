---
title: 'Website search'
description: 'Contao automatically indexes the pages of your website as soon as they are accessed and stores the words found on them as search terms in a table in the database.'
aliases:
    - /en/layout/module-management/website-search/
weight: 30
---

Contao automatically indexes the pages of your website as soon as they are accessed and stores the words found on them as search terms in a table in the database. The search module searches this table and returns the pages that contain the term(s) you are looking for.

![The On-Site-search-in-frontend](/en/layout/module-management/images/en/the-on-site-search-in-frontend.png?classes=shadow)

Note, however, that for security reasons your website will not be indexed if you are logged into the backend and access the frontend preview. It could be that there is some unpublished content on your website, which should not appear in the search index before it is published.

## Search syntax

With the Contao search engine you can find more than just words. The so-called search syntax supports the AND/OR search as well as the phrase search and the use of wildcards.

This feature is by no means specific to Contao. Google and other search engines also support searching for phrases or forcing or excluding search terms. Most major providers offer even more options, for example, searching for specific file types, languages or time periods.

### AND/OR search

The simple search for e.g. "web design" results in five hits.

By default, Contao only searches for pages that contain all search terms (AND search). However, if you select the option find any word, pages that contain only one of the two words will be returned (OR search). This increases the number of hits to seven.

### Phrase search

Phrase searches are not only carried out for individual words, but also for word combinations that are in a specific order. To search for a phrase, all you have to do is put the corresponding words in quotation marks. The search for "web design" (in this case, you have to enter the quotation marks as well!) only results in three hits compared to the AND/OR search, namely the pages that actually contain the term "web design".

### Search with wildcards

Maybe you are not only interested in web design, but also in all kinds of other things related to the web, such as web hosting. That's why you would like to find everything that starts with the word "web". For exactly this case, Contao offers a wildcard search.

Start a new search and enter "web\*" in the search field. The asterisk is a wildcard and stands for any other characters. As you can see, with 32 hits this search returns significantly more results than the previous two. It now includes words like "web application," "web hosting," or "web technology.

### Force search terms

Enforcing search terms is a good way to further refine OR searches. Let's say you want to find all pages where the terms "web", "hosting" or "design" appear (eight hits), but you are interested in design only in connection with the web. The design of industrial products is not relevant to you and should therefore not appear in the results.

Surely you immediately realized that you can achieve this with two AND searches for "Web Design" and "Web Hosting". However, this solution is quite uncomfortable, because the two hit lists have to be searched separately and cannot be sorted by a common relevance.

A better option is to search for "+web hosting design", which means: "Search for the words 'hosting' and 'design', but only on those pages where the word web appears". The plus sign tells Contao that a search term must be included in any case. Note that there must not be a space between the plus sign and the search term.

The refined search now yields only five hits.

### Exclude search term

Excluding a search term is the counterpart to forcing a search term and has the effect that only those pages are found which do not contain a specific term. In the example above, by forcing the word "Web", you have reduced the number of results from eight to five. If you now exclude the word "Web", you will find exactly the three pages that have been omitted.

Start a final search and enter "-web hosting design" in the search field. The minus sign tells Contao that a search term must not appear on the page. Note that there must not be a space between the minus sign and the search term.

As expected, the search now returns exactly three hits.

## Configuration of the search module

Now that you know how to use the module in the frontend, we will now explain how to configure it in the backend. Open the module manager and select the module "Application - Search Engine".

Default query type: Here you define whether the AND search (find all words) or the OR search (find any word) is active by default.

Inaccurate search: In case of an inaccurate search for e.g. "design", the search module will not only return pages with the term "design", but also pages with the terms "web design" or "designer" (corresponds to a search with wildcards).

Context-Span: When displaying the search results, Contao not only shows the found term, but also the context to the right and left of it. Here you define how many characters to the right and left of a found term should be used as context.

{{< version "4.8" >}}

Minimum keyword length: Keywords that exceed the minimum length will be ignored in the search results. set to 0 to deactivate

Elements per page: If you enter a value greater than 0 here, Contao will automatically wrap the page after this number of search results.

Search form layout: Here you define the layout of the search form.

| Layout | Declaration |
| ------ | ----------- |
| Simple form | The simple search form consists of a text field for entering the search terms and a button for submitting the form. |
| Extended form | The advanced search form also offers two radio buttons to select the options "find all words" and "find any word" (AND or OR search). |

Forward page: Here you can specify a page to which visitors will be redirected after submitting the search form.

Reference page: Here you can limit the search to a part of the page structure. Only the pages below the reference page will appear in the results.

Result template: Here you choose the template for the search results.

Individual template: Here you can overwrite the default template `mod_search`.

 HTML output   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_search block">

    <form action="…" method="get">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="ctrl_keywords" class="invisible">Suchbegriffe</label>
                <input type="search" name="keywords" id="ctrl_keywords" class="text" value="contao">
            </div>
            <div class="widget widget-submit">
                <button type="submit" id="ctrl_submit" class="submit">Suchen</button>
            </div>
            <div class="widget widget-radio">
                <fieldset class="radio_container">
                    <legend class="invisible">Optionen</legend>
                    <span>
                        <input type="radio" name="query_type" id="matchAll" class="radio" value="and" checked> 
                        <label for="matchAll">finde alle Wörter</label>
                    </span>
                    <span>
                        <input type="radio" name="query_type" id="matchAny" class="radio" value="or"> 
                        <label for="matchAny">finde irgendein Wort</label>
                    </span>
                </fieldset>
            </div>
        </div>
    </form>

    <p class="header"> … </p>

    <div class="first even">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <div class="odd">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <div class="last even">
        <h3><a href="…" title="…"> … </a> <span class="relevance">[… Relevanz]</span></h3>
        <p class="context">… <mark class="highlight">…</mark> … <mark class="highlight">…</mark> …</p>
        <p class="url">…<span class="filesize"> - …</span></p>
    </div>

    <!-- indexer::stop -->
    <nav class="pagination block" aria-label="Seitenumbruch-Menü">
        <p>Seite 1 von 3</p>
        <ul>
        <li><strong class="active">1</strong></li>
            <li><a href="…" class="link" title="Gehe zu Seite 2">2</a></li>
            <li><a href="…" class="link" title="Gehe zu Seite 3">3</a></li>
            <li class="next"><a href="…" class="next" title="Gehe zu Seite 2">Vorwärts</a></li>
            <li class="last"><a href="…" class="last" title="Gehe zu Seite 3">Ende</a></li>
        </ul>
    </nav>
    <!-- indexer::continue -->

</div>
<!-- indexer::continue -->
```

The `<nav>` element with the class pagination contains the markup of the page break menu, which is also used for example in picture galleries.

## Own search forms

You've probably noticed that the Search Engine module contains both the search form and the results list, but many webpages use these elements separately to display a search box in the header. There are three solutions for this in Contao:

1. You create a second search module, in which you use the redirect page to refer to the actual search page, and include it in the header.
2. You create a search form with the form generator. This variant is described in the section [create a search form](../../../form%20generator/create%20a%20search%20form/) ,.
3. You create a search form with the module "Own HTML code".

Create a search form with the HTML module

I will introduce the frontend module "Own HTML code" at the end of this page. The markup for the search form looks like this:

```html
<!-- indexer::stop -->
<form action="{{link_url::10}}" method="get" enctype="application/x-www-form-urlencoded">
    <div class="formbody">
        <div class="widget widget-text">
            <input type="text" name="keywords" class="text" value="" placeholder="Suche">
        </div>
        <div class="widget widget-submit">
            <button type="submit" class="submit">Suchen</button>
        </div>
    </div>
</form>
<!-- indexer::continue -->
```

The target page, which is called when the form is submitted, has been entered here using a [insert-tag](../../../article%20management/insert-tags/), so that the form will still work even if the alias of the target page changes over time. GET" was selected as the transfer method, and the search field was given the field name "keywords".

## Exclude areas from the search

You must have just wondered what the two strange comments that surround the HTML code of our search form mean. These comments, invisible in the frontend, tell the search engine not to index the content it contains.

```html
<!-- indexer::stop -->
Was hier steht, wird nicht indiziert.
<!-- indexer::continue -->
```

The comments do not only work with the HTML module, but can be used everywhere in Contao, for example, because a frontend module that is included on all pages by page layout would not produce unique search results and therefore does not belong in the search index.
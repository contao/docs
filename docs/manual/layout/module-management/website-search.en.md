---
title: 'Website search'
description: 'Contao automatically indexes the pages of your website as soon as they are accessed and stores the words found on them as search terms in a table in the database.'
aliases:
    - /en/layout/module-management/website-search/
weight: 30
---

Contao automatically indexes the pages of your website as soon as they are accessed and stores the words that match the search criteria in a table in the database. The search module searches this table and returns the pages that contain the term(s) you are looking for.

![The on-site search in the front end](/de/layout/module-management/images/de/die-on-site-suche-im-frontend.png?classes=shadow)

Note, however, that for security reasons your website will not be indexed if you are logged into the back end and access the front end preview. It could be that there is unpublished content on your website, which should not appear in the search index before you publish it.

## Search syntax

With the Contao search engine, you can find more than just words. The search syntax supports the AND/OR search as well as the phrase search and the use of wildcards.

This feature is by no means specific to Contao. Google and other search engines also support searching for phrases or forcing or excluding search terms. Most of the major search engines offer even more options, for example, searching for specific file types, languages or time periods.

### AND/OR search

Let's assume a simple search for "web design" will return five hits.

By default, Contao only searches for pages that contain all search terms (AND search). If you select the "Find *any word*" option, pages that contain only one of the two words will be returned (OR search). This increases the number of hits to seven in our example.

### Phrase search

Phrase searches are not just looking for single words, but for word combinations that are in a certain order. To search for a phrase, you just have to put the corresponding words in quotation marks. The search for "web design" only returns three hits compared to the AND/OR search, namely the pages that actually contain the term "web design".

### Search with wildcards

Maybe you are not only interested in web design, but also in all kinds of other things related to the web, such as web hosting. That's why you want to find everything that starts with the word "web". This is exactly what Contao offers the wildcard search.

Start a new search, and enter "web\*" in the search input field. The asterisk acts as a wildcard and stands for any other character(s). As you will see, this search will return significantly more results than the previous two. It now includes results that contain expressions like "web application", "web hosting" or "web technology".

### Force search terms

Enforcing search terms is a good way to further refine OR searches. Let's say you want to find all pages that contain the terms "web", "hosting" or "design" but you are only interested in design related to the web. The design of industrial products is not relevant for you and should therefore not appear in the results.

Surely you immediately realized that you can achieve this with two AND searches for "web design" and "web hosting". However, this solution is quite uncomfortable, as the two hit lists must be searched separately and cannot be sorted by a common relevance.

A better option is to search for "+web hosting design", which means: "Search for the words 'hosting' and 'design', but only on pages where the word web occurs". From the plus sign, Contao recognizes that a search term must be included in any case. Note that there must be no space between the plus sign and the search term.

### Exclude search term

Excluding a search term is the counterpart to forcing a search term and has the effect that only those pages are found which do not contain a certain term. In the example above, you have reduced the number of results from eight to five by using the enforcing word "Web". If you now exclude the word "Web", you will find exactly the three missing pages.

Start a last search and enter "-web hosting design" in the search field. The minus sign tells Contao that a search term must never appear on the page. Note that there must not be any space between the minus sign and the search term.

## Configuration of the search module

Now that you know how to use the module in the front end, we will now explain briefly how to configure it in the back end. Open the module manager and select the module "Application - Search Engine".

**Default query type:** Here you can specify whether AND search (find all words) or OR search (find any word) is active by default.

**Fuzzy search:** If a fuzzy search for e.g. "design" is executed, the search module will not only return pages with the term "design", but also pages with the terms "web design" or "designer" (corresponds to a search with wildcards).

**Context length:** When displaying the search results, Contao not only displays the term found, but also the context to the right and left of it. Here you can specify how many characters to the right and left of a found term should be used as context.

**Minimum search word length:** Search words that exceed the minimum length are ignored in the search results; set to 0 to deactivate.

**Elements per page:** If you enter a value greater than 0, Contao will automatically wrap the page after this number of search results.

**Search form layout:** Here you define the layout of the search form.

| Layout | Explanation |
| ------ | ----------- |
| Simple form | The simple search form consists of a text field for entering the search terms and a button for submitting the form. |
| Extended form | The advanced search form also offers two radio buttons to select the options "find all words" and "find any word" (AND or OR search). |

**Forwarding page:** Here you can specify a page to which visitors are forwarded after submitting the search form. If a redirect page is selected, this module will not display any search results. This configuration is useful if you include this search module in the page layout.

**Reference page:** Here you can limit the search to a part of the page structure. Only the pages below the reference page will appear in the results.

**Result template:** Here you select the template for the search results.

**Custom template:** Here you can override the default `mod_search` template.

The `<nav>`-element with the CSS class `pagination` contains the markup of the page break menu, which is also used for example in picture galleries.

## Own search forms

You may have noticed that the search engine module contains both the search form, and the result list. However, on many websites, these elements are used separately to display a search field in the header. There are three solutions for this in Contao:

1. You create a second search module, in which you use the redirect page to refer to the actual search page, and include it in the header.
2. You create a search form with the form generator. This variant is described in section [Creating a search form](/en/form-generator/create-a-search-form/).
3. You create a search form with the "Custom HTML code" module.

**Create a search form with the HTML module**

The markup for the search form may look like this:

```html
<!-- indexer::stop -->
<form action="{{link_url::10}}" method="get" enctype="application/x-www-form-urlencoded">
    <div class="formbody">
        <div class="widget widget-text">
            <input type="text" name="keywords" class="text" value="" placeholder="Search term">
        </div>
        <div class="widget widget-submit">
            <button type="submit" class="submit">Search now</button>
        </div>
    </div>
</form>
<!-- indexer::continue -->
```

The target page that is called when the form is submitted has been entered here using an insert tag so that the form still works even if the alias of the target page changes over time. "GET" was selected as the transmission method and the search field was given the field name "keywords".
That's all you need to do!

## Exclude areas from the search

You might have just wondered what the two strange comments that enclose the HTML code of our search form mean. These comments, invisible in the front end, tell the search engine not to index the content.

```html
<!-- indexer::stop -->
Whatever is put in between here will not be indexed by the search engine.
<!-- indexer::continue -->
```

The comments do not only work with the HTML module, but can be used everywhere in Contao, for example, because a front end module that is included in the page layout of all pages would not produce unique search results and therefore does not belong in the search index.

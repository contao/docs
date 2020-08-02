---
title: 'Front-end modules'
description: 'The FAQ extension contains three new frontend modules which you can configure as usual via the module management.'
aliases:
    - /en/core-extensions/faq/frontend-modules/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Now that you know how categories and questions are managed in the backend, we will explain how to display this content in the frontend. The FAQ extension contains three new frontend modules which you can configure as usual via the module management.

![FAQ modules](/de/core-extensions/faq/images/de/faq-module.png?classes=shadow)

## FAQ list

The front-end module "FAQ list" adds a list of questions to the website, which can be from one or more categories.

### Module configuration

**FAQ categories:** Here you define the categories from which questions are displayed. You can change ![Move question](/de/icons/drag.svg?classes=icon "Frage verschieben")the order of the categories using the navigation icon.

**FAQ reader:** Here you can define if the system should automatically switch to the FAQ reader when a post is selected.

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML OutputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_faqlist block">
    <h2>FAQ</h2>
    <ul class="first last even">
        <li class="first even"><a href="…" title="…">…</a></li>
        <li class="odd"><a href="…" title="…">…</a></li>
        <li class="last even"><a href="…" title="…">…</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

## FAQ reader

The frontend module "FAQ reader" is used to display the answer to a specific question. The module obtains the alias of the question via the URL, so that FAQs can be linked with so-called [permalinks](https://de.wikipedia.org/wiki/Permalink):

`example.com/frage/kann-ich-eigene-php-skripte-verwen-den.html`

The keyword of the FAQ reader is *frage fra*ge and tells the module to search and output a specific question. If the searched question does not exist, the FAQ reader returns an error message and the HTTP status code "404 Not found". The status code is important for search engine optimization.

{{% notice info %}}
On a single page there may only be one "reader module" at a time, regardless of the type. Otherwise, one or the other module would trigger a 404 page, because, for example, the alias of a FAQ cannot be found in a calendar, or vice versa the alias of an event in a FAQ category.
{{% /notice %}}

### Module configuration

**FAQ categories:** Here you define the categories in which the requested question should be searched. Questions from unselected categories will not be displayed, even if the URL is correct and the entry is correct. This feature is especially important in multi-domain operation with several independent websites.

### Template settings

**Individual template:** Here you can overwrite the default template.

### Comments settings

**Comment template:** Here you can select the comment template.

**HTML outputThe**  
 frontend module generates **the** following HTML code:

```html
<div class="mod_faqreader block">
    <h1>…</h1>
    <div class="ce_text block">
        <p>…</p> 
    </div>
    <p class="info">…</p>

    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->

    <div class="ce_comments block">
    …
    </div>
</div>
```

For details on comment markup, see theComments section.

## FAQ page

The frontend module "FAQ page" adds all questions and answers to the website, which can be from one or more categories.

### Module configuration

**FAQ categories:** Here you define the categories in which the requested question should be searched. Questions from unselected categories will not be displayed, even if the URL is correct and the entry is entered correctly. This feature is especially important in multi-domain operation with several independent websites.

### Template settings

**Individual template:** Here you can overwrite the default template.

**HTML outputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_faqpage block">
    <article class="first last even">
    <h2>FAQ</h2>

    <section class="first even">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>

    <section class="odd">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>

    <section class="last even">
        <h3 id="…">…</h3>
        <div class="ce_text block">
            <p>…</p>
        </div>
        <p class="info">…</p>
    </section>

    <p class="toplink"><a href="#top">Nach oben</a></p>
    </article>
</div>
<!-- indexer::continue -->
```

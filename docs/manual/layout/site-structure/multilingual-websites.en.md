---
title: 'Multilingual websites'
description: 'Multilingual websites are also realized in Contao by using different websites in the site structure. In contrast to multi-domain operation, the websites do not differ by domain name but by language.'
aliases:
    - /en/layout/site-structure/multilingual-websites/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Multilingual websites are also realized in Contao by using different websites in the site structure. Unlike the multi-domain operation, this is not distinguished by the domain name but by the language.

In general, there are two ways to display multilingual websites:

1. A separate web page is created per language within the page structure. The structure of the web pages can be completely different. For example, the German website does not have to have the same pages and menu items as the English website.
2. There is only one web page in the site structure, whose contents are available in different languages. This approach gets by with significantly fewer pages in the page structure, but requires an additional abstraction level for the management of multilingual content.

In Contao, only the first variant is supported (except for some third party extensions that differ from this concept for managing your own content).

In order for the language to be added to the URL (e.g. `www.example.com/de/`), you need to add the following lines to the one in the `config.yml`folder`app/config/`. If the file does not yet exist, you must create it.

{{% notice note %}}
From version 4.8 of Contao the file is located in the folder `config`.
{{% /notice %}}

```yaml
contao:
    prepend_locale: true
```

**{{% notice info %}}
Empty cacheTo**  
 activate the changes, the application cache must be refreshed via the Contao Manager ("System maintenance" &gt; "Refresh product cache") or alternatively via the command line.

```bash
vendor/bin/contao-console cache:clear --env=prod --no-warmup
```

{{% /notice %}}

## Finding the right starting point

The combination of domain name, language and language fallback creates four possibilities that Contao has to check with every frontend call:

- Is there a page that matches the domain and language of the visitor?
- Is there a page that matches the domain and is marked as language fallback?
- Is there a page without a domain entry that matches the visitor's language?
- Is there a page without a domain entry that is marked as a language fallback?

The check is carried out from the most specific case, where both the domain and the browser language match, to the most general case, where neither the domain nor the browser language match and therefore the welcome page is loaded. Let us illustrate this with a concrete example scenario.

**Example of use**

Let's say you have two domains, one business and one private:

- `www.firma.de`
- `www.privat.de`

The business site is bilingual, so you need a total of three starting points:

**DNS settings for the different starting points**

| Page | domain name | Language | Language fallback |
| ---- | ----------- | -------- | ----------------- |
| Company German | - | en | - |
| Company English | - | en | yes |
| Private | private.com | en | yes |

Depending on the domain called up and the language set in the browser, visitors are then forwarded as follows:

**Forwarding of the visitors to the different starting points**

| Domain | Browser language | Objective | Compliance |
| ------ | ---------------- | --------- | ---------- |
| www.firma.de | German | Company German | Language |
| www.firma.de | English | Company English | Language |
| www.firma.de | Spanish | Company English | - |
| www.privat.de | (never mind) | Private | Domain |

The first three cases all lead to the company page, even if the domain `firma.de`is not explicitly stored in theDNS settings. This is not necessary at all, because the company page is in this case the starting page for unknown domains.

The first two cases could be clearly assigned to a starting point based on the browser language, only in the third case the language fallback page had to be loaded. The third case is therefore the most general case, which catches all requests that cannot be uniquely assigned.

The fourth case belongs to the private website, no matter what language the visitor speaks, thanks to the language fallback, surfers all over the world have access to the website. And here you can see the importance of a language fallback: without it, the private website would only be available for German speaking visitors! all others would only see a "No pages found".

---
title: 'Multilingual websites'
description: 'Multilingual websites are also implemented in Contao by using different websites in the site structure. In contrast to multidomain setups, the websites do not differ by domain name but by language.'
aliases:
    - /en/layout/site-structure/multilingual-websites/
weight: 40
---

Multilingual websites are also implemented in Contao by using different websites in the site structure. In contrast to the multi-domain mode, the domain name is not used to differentiate between websites but the language.

In general, there are two ways to display multilingual websites:

1. For each language, a separate website is created within the page structure. The structure of the websites can be completely different. For example, the German website does not have to have the same pages and menu items as the English website.
2. There is only one web page in the site structure, whose contents are available in different languages. This approach gets by with significantly fewer pages in the page structure, but requires an additional abstraction level for the management of multilingual content.

In Contao, only the first variant is supported (except for some third party extensions that differ from this concept for managing your own content).

In order for the language to be added to the URL (e.g. `www.example.com/de/`), you must add the following lines in the `config.yml` located in the `app/config/` directory. If the file does not exist yet, you have to create it.

{{% notice note %}}
From version **4.8** of Contao the file is located in the `config/` directory.
{{% /notice %}}

```yaml
contao:
    prepend_locale: true
```

{{% notice info %}}
**Empty cache**  
For the changes to take effect, the application cache must be refreshed via the Contao Manager ("System maintenance" &gt; "Refresh product cache") or alternatively via the command line.

```bash
vendor/bin/contao-console cache:clear --env=prod --no-warmup
```
{{% /notice %}}

Starting with Contao **4.10** the URL prefix can also be defined for each website root individually and independently of
the language of the website root. This way it is also possible have one website root without an URL prefix, while the other
website roots of the same domain still have one. For example: `example.com` for the English version of the website and
`example.com/de` for the German version. In order to be able to configure this setting the »[legacy routing][LegacyRouting]« 
mode must be disabled:

```yaml
# config/config.yml
contao:
    legacy_routing: false
```

## Matching the website root

The combination of domain name, language and language fallback creates four possibilities that Contao has to check with every frontend call:

- Is there a page that matches the domain and language of the visitor?
- Is there a page that matches the domain and is marked as the language fallback?
- Is there a page without a domain entry that matches the visitor's language?
- Is there a page without a domain entry that is marked as the language fallback?

The check is carried out from the most specific case, in which both the domain and the browser language match, to the most general case, in which neither the domain nor the browser language match and therefore the home page is loaded. Let us illustrate this with a concrete example scenario.

**Example**

Let's assume you have two domains, one business and one private:

- `www.company.com`
- `www.private.com`

The business side is bilingual, so you need a total of three website roots:

**DNS settings for the different website roots**

| Page | Domain name | Language | Language fallback |
| ---- | ----------- | -------- | ----------------- |
| Company German | - | en | - |
| Company English | - | en | yes |
| Private | private.com | en | yes |

Depending on the accessed domain and the defined language in the browser, visitors will be redirected as follows:

**Forwarding of visitors to the different website roots**

| Domain | Browser language | Target | Matching |
| ------ | ---------------- | --------- | ---------- |
| www.company.com | German | Company German | Language |
| www.company.com | English | Company English | language |
| www.company.com | Spanish | Company English | - |
| www.private.com | (any) | Private | Domain |

The first three cases all lead to the company page, even if the domain `company.com` is not explicitly stored in the DNS settings. This is not necessary at all, because the company page is in this case the starting page for unknown domains.

The first two cases could be clearly assigned to a website root based on the browser language, only in the third case the language fallback page had to be loaded. The third case is therefore the most general case, which catches all requests that cannot be uniquely assigned.

The fourth case clearly belongs to the private website because of the domain, no matter what language the visitor speaks, and thanks to the language fallback, visitors from all over the world have access to the website. And here you can see the importance of a language fallback: without it, the private website would only be available for German speaking visitors! All others would only see a "No pages found" error message.


[LegacyRouting]: /en/layout/site-structure/configure-pages/#legacy-routing-mode

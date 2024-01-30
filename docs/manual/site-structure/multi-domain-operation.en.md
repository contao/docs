---
title: 'Multi-domain operation'
description: 'Multi-domain operation means that a Contao installation can be accessed via more than one domain whereas each of them produces a different output.'
aliases:
    - /en/layout/site-structure/multi-domain-operation/
weight: 30
---

Multi-domain operation means that a Contao installation can be accessed via more than one domain whereas each of them produces a different output. The latter is a very important detail because you can theoretically make the same website available via different domains. This, however, is not a good idea in terms of search engine optimization (think about "duplicate content") nor does it have anything to do with the multi-domain operation of Contao.

For a real multi-domain operation, you need several root pages in your Contao site structure plus multiple domains.
In case you only have one root page which should be accessible using multiple domains, it is best to choose a main domain and redirect the other domains to it. This redirection can usually be set up in the control panel of your server or the `.htaccess` in case you're using Apache webserver.

**Redirection from example.com to example.org via .htaccess**

```apacheconf
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www\.example\.com [NC]
RewriteRule (.*) http://www.example.org/$1 [R=301,L]
```

**Application example**

Let's assume that an agency is looking after a company with several websites and wants to manage them with a central Contao installation. For this purpose, the following domains were registered:

- `company.org`
- `company.com`
- `company.us`

All domains are routed to the central installation, which means that Contao can be accessed via all three domains. To ensure that the front end loads the appropriate website for the domain, three root pages must be created in the site structure and the corresponding domain must entered in the **"DNS settings"** section.

After that, Contao will only show the website for `company.com` when you actually visit the `company.com` website. This also means that the URL

`www.company.com/products.html`

will result in a 404 error (page not found) if the "Products" page exists in the site structure but is assigned to the website for `company.org`.

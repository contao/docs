---
title: 'Multi-domain operation'
description: 'Multi-domain operation means that a Contao installation can be reached under several domains and each of them produces a different output.'
aliases:
    - /en/layout/site-structure/multi-domain-operation/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Multi-domain operation means that a Contao installation can be accessed under several domains and each of them produces a different output. The latter is a very important detail because you can theoretically make the same website available under different domains. This is not a good idea in terms of search engine optimization (keyword "duplicate content") nor does it have anything to do with the multi-domain operation of Contao.

For a real multi-domain operation, you need several starting points in yourContao site structure in addition to several domains. If you only have one starting point, your installation is only accessible under several domains. In this case, it is best to choose a main domain and redirect the other domains to it. This redirection can usually be set up in the control panel of your server or in a file`.htaccess`.

**Redirection from example.com to example.org via .htaccess**

```apacheconf
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www\.example\.com [NC]
RewriteRule (.*) http://www.example.org/$1 [R=301,L]
```

**Application example**

Let's assume that an agency is looking after a company with several websites and wants to manage them with a central Contao installation. For this purpose, the following domains were registered:

- `firma.at`
- `firma.ch`
- `firma.de`

All domains are routed to the central installation, which means that Contao can be reached under all three domains. To ensure that the frontend loads the appropriate website for the domain, three start points of a website must be created in the site structure and the domain must be`Domainname` entered in the **"DNS settings"** section.

After that, Contao will only show the website for Austria when you visit the `firma.at`website. This also means that the URL

`www.firma.at/produkte.html`

will result in a 404 error (page not found) if the "Products" page exists in the site structure but is assigned to the website for Switzerland.

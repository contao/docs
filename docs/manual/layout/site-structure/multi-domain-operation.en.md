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

Multi-domain operation means that a Contao installation can be reached under several domains and each domain has a different output. The latter is a crucial detail because you can theoretically make the same website available under different domains. This is not a good idea in terms of search engine optimization (keyword "duplicate content") nor does it have anything to do with the multi-domain operation of Contao.

For a true multi-domain operation, you need several starting points in yourContao site structure in addition to several domains. If you only have one starting point, your installation is only accessible under several domains. In this case, it is best to choose a main domain and redirect the other domains to it. This redirection can usually be set up in the control panel of your server or in a file`.htaccess`.

**Redirection from example.com to example.org via .htaccess**

```apacheconf
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www\.example\.com [NC]
RewriteRule (.*) http://www.example.org/$1 [R=301,L]
```

**Application example**

Let's assume that an agency looks after a company with several websites and wants to manage them via a central Contao installation. The following domains were registered for this purpose:

- `firma.at`
- `firma.ch`
- `firma.de`

All domains are routed to the central installation, i.e. Contao is available under all three domains. To ensure that the frontend loads the appropriate website for the domain, three start points of a website must be created in the site structure and the domain must be`Domainname` entered in the **"DNS settings"** section.

After that, Contao will only show the website for Austria when you open the `firma.at`domain. This also means that the URL

`www.firma.at/produkte.html`

leads to a 404 error (page not found) if the page "Products" exists in the page structure but is assigned to the website for Switzerland.

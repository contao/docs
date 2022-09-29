---
title: 'Namespaces'
description: 'Namespaces for Twig templates'
aliases:
    - /en/layout/templates/twig/namespace/
weight: 80
---


In Twig templates live in "namespaces". If you want to reference another template, e.g. when extending or including/embedding it, you need 
to include the namespace in the "fully qualified template name".

Our Contao templates are all inside the `@Contao` namespace, so that's why for instance the text content element's 
fully qualified template name is `@Contao/content_element/text.html.twig` and why you would extend from it with 
`{% extends "@Contao/content_element/text.html.twig" %}`.

The `@Contao` namespace is a "managed namespace" and has a special feature in contrast to standard Twig: The same template can be 
extended from various sources. This way an extension can, for instance, add a new feature to a core template while you can still adjust it 
in your application.
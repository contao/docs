---
title: "Content Elements & Modules"
description: "Providing your application with custom made content elements and modules."
weight: 700
aliases:
  - /getting-started/content-elements-modules/
---


_Content Elements_ are the fundamental content blocks within Contao, while 
_Front end Modules_ provide (reusable) functionality for your web application. Implementation 
and handling of these is fairly similar, thus examples for this getting-started article 
will only cover content elements.

To create a custom content element or front end module, three basic things need 
to be defined or created at the very least:

* class
* palette
* template

Using annotations for service tagging, the PHP class can provide the complete configuration - 
like the template name, content element name, the category under which the content 
element or front end module should be visible in the back end and other attributes.

Content elements and front end modules are implemented as _fragment controllers_.
The following class shows a custom content element, which passes the fields
`text` and `url` to its template.

```php
// src/Controller/ContentElement/MyContentElementController.php
namespace App\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class MyContentElementController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $template->text = $model->text;
        $template->url = $model->url;
        
        return $template->getResponse();
    }
}
```

This content element will then show up in the back end under the _Texts_ category
in the type drop down. Its name will be derived from its class name, transformed
to snake case: `my_content_element`. Thus we can create a simple palette for this
content element like so:

```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['palettes']['my_content_element'] = '
    {type_legend},type,headline;
    {text_legend},text,url;
';
```

The template name on the other hand is derived from the element's type. Content element templates reside in
`templates/content_elment/` by default and the template's name will be `my_content_element.html.twig` in this case.

```twig
{# templates/content_element/my_content_element.html.twig #}
{% extends "@Contao/content_element/_base.html.twig" %}

{% block content %}
    {{ text }}

    {% if url %}
        <a href="{{ url }}">Read more</a>
    {% endif %}
{% endblock %}
```

Finally we add a label for our new content element, so it is nicely displayed in the back end:

```yaml
# translations/contao_default.en.yaml
CTE:
    my_content_element:
        - My Content Element
        - A short description for my new Content Element
```

Find out more about [content elements][1] and [front end modules][2] in the framework
documentation.

{{% notice "tip" %}}
You can also install the `contao/maker-bundle` with

```bash
composer require contao/maker-bundle --save-dev
```

and use commands like `bin/console make:contao:content-element` or `make:contao:frontend-module` which will generate
these files for your for a new content element or front end module.
{{% /notice %}}

Next: [creating an extension][3].


[1]: /framework/content-elements/
[2]: /framework/front-end-modules/
[3]: /getting-started/extension/

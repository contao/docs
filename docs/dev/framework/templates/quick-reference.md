---
title: "Quick reference handbook"
description: How to quickly get going with the most typical Twig scenarios.
weight: 500
aliases:

- /framework/templates/quick-reference/

---

{{< version-tag "5.0" >}} Here are some examples to quickly get you started. We only target Contao 5 in the examples,
but with some tweaking you might be able to apply them to Contao 4.13 as well.


#### How to…
 * …create a [fragment controller](#fragment-controller) for a content element/frontend module and use variant
   templates?
 * …render a [dynamic template](#dynamically-render-templates) from a controller extending the
  `AbstractFragmentController`?
 * …add a custom attribute to [all content elements](#adjust-the-base-template)?


## Examples
#### Fragment controller
We create a content element controller in this example. If you want to create a module, these work very similar: you
then need to use`AbstractFrontendModuleController` as the abstract base class, `[#AsFrontendModule]` as the attribute
and `frontend_module/_base.html.twig` as the parent template, instead. If you want to make DCA adjustments, also target
`tl_module` instead of `tl_content`. 

{{% example %}}
Create a `src/Controller/FruitSaladController.php` controller that sets renders the default template with some fruits:
```php
<?php
declare(strict_types=1);

namespace App\Controller;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'food')]
class FruitSaladController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->set('fruits', [
            'acai', 'blackberry', 'currant', 'durian', 'elderberry', 'fig', 'grape'
        ]);
        
        return $template->getResponse();
    }
}
```

Create or adjust the `contao/dca/tl_content.php` file:
```php
// Define the palette for the back end edit mask; we are only using a minimal set for now
$GLOBALS['TL_DCA']['tl_content']['palettes']['fruit_salad'] = 
    '{type_legend},type,headline;' .    // add the type selector and headline field 
    '{template_legend:hide},customTpl;' // allow selecting template variants    
;
```

Create a `content_element/fruit_salad.html.twig` template:
```twig
{% extends "@Contao/content_element/_base.html.twig" %}

{% block content %}
    <p>We put fruit like {{ fruits|join(', ') }} in our tropical salads.</p>
{% endblock %}
```

Create a `content_element/fruit_salad/random.html.twig` variant template — here we want to output the fruits as a
randomized list instead of a block of text:
```twig
{% extends "@Contao/content_element/_base.html.twig" %}
{% use "@Contao/component/_list.html.twig" %}

{# For this, we use the "list" component, that already brings the functionality
   to randomize the order (client-side)… #}
{% block content %}
    <b>Why we like our salads? It's all about the ingredients:</b>
    {% with {items: fruits, randomize_order: true} %}
        {{ block('list_component') }}
    {% endwith %}
{% endblock %}

{# … and overwrite the "list_item" block to output our fruit inside the <li> tag: #}
{% block list_item %}     
    <span class="fruit--{{item}}">{{ item|capitalize }}</span> is an amazing fruit. 
{% endblock %}
```
{{% /example %}}


#### Dynamically render templates 
Sometimes you might want to dynamically decide which template you want to render from inside your fragment controller.
There are two ways of doing it, by using the given `FragmentTemplate` or by calling `render()` yourself. For brevity, we
only focus on the implementation of the `getReponse()` method.

{{% example "Setting the template name" %}}
```php
// …

protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
{
    // Work with the FragmentTemplate like usual but also overwrite the
    // inferred template name
    $template->set('foo', 'bar')
    $template->setName('@Contao/content_element/custom/thing.html.twig');
    
    return $template->getResponse();       
}
```
{{% /example %}}

{{% example "Calling render() yourself" %}}
```php
// …

protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
{
    $parameters = [
        'foo' => 'bar',
        // Merge in the pre-built data like type, headline or CSS classes
        // information when compiling the template parameters
        ...$template->getData()
    ];

    return $this->render('@Contao/content_element/amazing_fruit.html.twig', $parameters);        
}
```
{{% /example %}}

{{% notice info %}}
When calling `$template->getResponse()`, internally, `$this->render(null, $template->getData())` will get executed — by
using `null` as the first argument, our abstract controller class will use the inferred default template name. This
makes both variants effectively equivalent.
{{% /notice %}}


#### Adjust the base template
We want to add a custom data attribute that contains the element's ID (e.g. `data-element="42"`) to the div, that wraps
each content element. Overwriting the `content_element/_base.html.twig` is the way to go. For this example, we don't
even have to adjust a block. The way `HtmlAttributes` are set up, it is enough to extend from the original template and
define our own attribute.
{{% example %}}
```twig
{% extends "@Contao/content_element/_base.html.twig" %}

{% set attributes = attrs(attributes|default).set('data-element', data.id) %}
```
{{% /example %}}

{{% notice tip %}}
If you would need more data, that was not set by the abstract base class, you could create your own filter or function
and then either use the element's ID as an argument or make the filter/function context-aware, to get the information to
your template.
{{% /notice %}}
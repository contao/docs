---
title: "3. Creating templates"
description: Writing good templates and making use of components
aliases:

- /framework/templates/creating-templates/

---

We talked about the general [architecture](../architecture) in the last part. Now we are focusing on what is or should
be inside the templates themselves and how to use the various features Twig ships with.

1) How to make [extends, embeds and uses](#reusing-template-parts) work?
2) What's so special with [components](#contao-components) and how to use them?
3) How to use the various template features like [insert tag rendering, images or translations](#template-features)?
4) How should I [name my templates](#naming-convention)?


## Reusing template parts
Twig supports a lot of different ways how to reuse Template parts and Contao enhances nearly all of them as well with
the [managed namespace](../architecture#managed-namespace) concept: [Extends](#extends), [includes](#includes),
[embeds](#embeds), [horizontal reuse](#horizontal-reuse) and [macros](#macros). 

#### Extends
A template can extend another one, called the *parent* or more general the *base template*. When extending a template,
your template **cannot contain content outside blocks**, anymore, but you **can adjust blocks** of the parent template.

  * Typically, you want to replace and extend at the same time. This means, you name your template like the parent to
    make the [loader](../architecture#contao-filesystem-loader) choose yours when rendering, and then you reuse as much
    as possible from the parent by extending it.
  
  * This isn't mandatory, though — [variant templates](../architecture#variant-templates) are a good example for when 
    you would want to create a new template but still only adjust things from the original one.
  
  * You can also use base templates like abstract base classes if you want to share a basic markup (implementation)
    across multiple children. The `content_element/_base.html.twig` is an example for this. Although this template does
    not contain a lot of markup, having it adds another handy use-case: If you want to adjust **all** content elements,
    e.g. by adding something to the wrapper, you now only need to adjust a **single** file.

Read more about the original implementation of the [extends tag][Twig Docs extends tag] in the official Twig
documentation.

{{% example "Extend another template" %}}
The original template `@Contao/product.html.twig` that displays a (fictive) product entity:
```twig
{# Outputs a product with title and some details. #}
<section class="product">
    {% block title %}<h1>{{ product.title }}</h1>{% endblock %}
    
    {% block details %}
        <ul class="product--details">
            {% for detail in product.details %}
                <li>{{ detail }}</li>
            {% endfor %}
        </ul>            
    {% endblock %}
</section>
```

We want to enhance the product title with an image:
```twig
{% extends "@Contao/foo.html.twig" %}

{% block title %}
    {{ parent() }}
    <img scr="{{ product.imageSrc }}" alt="{{ product.title }}" />
{% endblock %}
```

With some demo data, you would then get the following HTML:
```html
<section class="product">
    <h1>Fair-trade Coffee</h1>
    <img src="assets/images/coffee_package.jpg" title="Fair-trade Coffee"/>
    <ul class="product--details">
        <li>Nice aroma</li>
        <li>Lots of caffeine</li>
    </ul>            
</section>
```
{{% /example %}}

With the `{{ parent() }}` function you can insert the content of the current block as it was defined in the parent
template.

{{% best-practice %}}
Unless you are replacing a block with something completely different, always try to include the parent's content. This
way multiple extensions can contribute things to the same block, and you automatically profit from their improvements
and additions as well.
{{% /best-practice %}}


#### Includes
If you want to *include* a whole template in another one, you can either use the `{% include %}` tag or the `include()`
function. While the tag looks analogous to when [embedding](#embeds) templates, the function returns the template as a
string, which might come handy in rare cases, where you need to further process the result before outputting. Which one
you choose is a matter of taste.

Read more about the original implementation of the [include tag][Twig Docs include tag] or the
[include function][Twig Docs include function] in the official Twig documentation.

{{% example "Include a template partial" %}}
Assume you want to have a reusable call-to-action button. We create a simple `@Contao/_action_button.html.twig`
template — we can enhance it later on without having to touch the places we are using it: 
```twig
{% block button_container %}
    <div class="call-to-action">    
        <button>
            {% block button_inside %}
                {{ title|default('Click me!') }}
            {% endblock %}
        </button>
    </div>
{% endblock %}
```

Now we can include it anywhere:
```twig
<div class="advertisement">
    <quote>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    </quote>
    
    {% include "@Contao/_action_button.html.twig" with {title: 'Buy this poetry on a shirt!'} %}
</div>
```
{{% /example %}}

{{% best-practice %}}
Templates, that are only used by or inside others, but never directly rendered, are called *partial templates* or just
*partials*. To make their usage directly obvious, prefix the filename with an underscore (`_`) like we did in the above
example.
{{% /best-practice %}}

#### Embeds
Sometimes you want to include a template, but at the same time adjust some of its blocks. For this, you can *embed* the
template.

Read more about the original implementation of the [embed tag][Twig Docs embed tag] in the official Twig documentation.

{{% example "Embed a template partial" %}}
We continue the example from the [includes section](#includes). But now, when inserting the button, we want to add an
icon in front of the title. We overwrite the `button_inside` block of the embedded template **just for this usage**: 
```twig
<div class="advertisement">
    <quote>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    </quote>
    
    {% embed "@Contao/_action_button.html.twig" with {title: 'Buy this poetry on a shirt!'} %}
        {% block button_inside %}
            <img src="files/poetry.svg" alt="Poetry"> {{ parent() }}
        {% endblock %}
    {% endembed %}
</div>
```
{{% /example %}}

#### Horizontal reuse
Similar to what traits are for classes in PHP, in Twig the `{% use %}` tag allows to reuse blocks of other templates
without extending them. Used blocks are not output by default, but instead made available to the `block()` function.

{{% notice warning %}}
While [includes](#includes) and [embeds](#embeds) are very powerful, there is a hidden pitfall when using them to build
reusable templates. Whenever you use these functions, Twig creates a new *isolated scope* in the template, that won't be
accessible from outside. So, if a template `A` extends from a template `B`, that includes/embeds another template `C`,
you won't be able to access or adjust blocks of `C` inside `A`. Here, horizontal reuse comes to the rescue.
{{% /notice %}}

Horizontal reuse is one of the most powerful parts of Twig. At the same time it's the most complex one. So let's dissect
the various parts needed for it to work.
 
 * The `block()` function renders a block, that is available to the current template. Available means: defined in the
   same file, any parent template or manually imported by a `{% use %}` statement (see below).

   ```twig  
   {% block foo %}Foo {{ bar }}{% endblock %}
   
   {# Output the "foo" block again #}
   {{ block('foo') }}
   ```
   
 * When using `block()`, the function renders the given block with the current template parameters. To render it in a 
   **different context**, you can surround it with the `{% with %} … {% endwith %}` block tag, which allows defining
   template parameters, that are scoped to just this block. By default, the defined parameters are merged with the
   current ones, to suppress merging, you can add the `only` keyword.

   ```twig
   {# Output the "foo" block with the "bar" parameter being set to "baz" #}
   {% with {bar: 'baz'} only %}
     {{ block('foo') }}
   {% endwith %}
   ```
   
 * Finally, the `{% use %}` statement imports all blocks of the given template **without outputting** them. They will  
   then be available to be output using a combination of `{% with %}` and the `block()` function. When importing, it 
   could potentially happen, that there are blocks with identical names. To work around this, you can rename the blocks 
   while importing.
 
   ```twig
   {% use "@Contao/_foo.html.twig" %}
   {% use "@Contao/_cat.html.twig" with sound as meow  %}
   {% use "@Contao/_dog.html.twig" with sound as bark %}

   {# Output the "sound" block of the cat template, that was imported as "meow" #}
   {{ block('meow') }}
   ``` 

Read more about the original implementation of the [use tag][Twig Docs use tag], the [with tag][Twig Docs with tag] and
the [block function][Twig Docs block function] the in the official Twig documentation.


{{% example "Make blocks available with horizontal reuse" %}}
We again build on top of the example of a button partial from the [includes section](#includes). But this time, we
make it into an abstract reusable `@Contao/_advertisement.html.twig` template:

```twig
{% use "@Contao/_action_button.html.twig" %}

<div class="advertisement">
    {% block description %}{% block %}
    {{ block('button_container') }}
</div>
```

Now, let's actually use it in our `@Contao/poetry_advertisement.html.twig`. We are extending the just created template
and adjust its own and its used blocks to get the same result as in the [embed example](#embeds):
```twig
{% extends "@Contao/_advertisement.html.twig" %}

{% block description %}
    <quote>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    </quote>
{% endblock %}

{% block button_inside %}
    <img src="files/poetry.svg" alt="Poetry"> {{ parent() }}
{% endblock %}
```

Did you note, how we were also able to adjust the `button_inside` block, here? We can either adjust this block in
the original `@Contao/_action_button.html.twig` template (to affect all action buttons), in the
`@Contao/_advertisement.html.twig` (to affect all buttons in advertisements) or, like we did here, in the
`@Contao/poetry_advertisement.html.twig` (to only effect this special advertisement). Neat!
{{% /example %}}

{{% best-practice %}}
In Contao we are using the term *component* when we mean a piece of reusable template logic, that is intended to be
imported with the `{% use %}` statement. In order for it to be output in the `block()` function, we make sure our
whole component code is **wrapped into a single block**. As a convention, we call the block `<name>_component`. We also 
put each component in its own file inside the `component` directory.

*Example:* The `figure` component lives in the `@Contao/component/_figure.html.twig` file and is wrapped in a
`figure_component` block. Read more about this in the section about [Contao components](#contao-components).
{{% /best-practice %}}

#### Macros
Twig also features macros via the `{% macro %}` tag. These are very similar to how PHP functions work and also allow to
reuse template logic. Head over to the Twig docs, to read more about how the [macro tag][Twig Docs macro tag] works in
detail.

{{% example "Using macros to render a recursive structure" %}}
Macros behave like functions, they are well suited if you want to encapsulate a certain logic. Here we want to render a
recursive tree structure (like a menu). Each node can contain more child nodes, and only the leafs contain values:  
```twig
{% macro tree(node) %}
    <ul>
        {% for child_node in node.children %}
            <li>
                {% if child_node.children|length %}
                    {{ _self.tree(child_node) }}
                {% else %}
                    {{ child_node.value }}
                {% endif %}
            </li>
        {% endfor %}
    </ul>
{% endmacro %}

<div class="tree">
    {{ _self.tree_node(tree) }}
</div> 
```
{{% /example %}}

{{% notice note %}}
**Do not overuse macros**, especially in extensions. They can help avoid duplication in your code, but they are way less
adjustable for others. Many things can also be done by using blocks and the `block()` function instead.
{{% /notice %}}


## Contao components
By understanding how components work in Contao, you can get the most out of the core templates. You also might want to
reuse them in your own code. Please familiarize yourself with the concept of [horizontal reuse](#horizontal-reuse) as we
are heavily going to make use of it.

Let's look at a real world example first. In Contao, a template component could look like this (taken from
`@Contao/component/_figure.html.twig`, a bit simplified):
```twig
{% use "@Contao/component/_picture.html.twig" %}

{% block figure_component %}
    {% set figure_attributes = attrs()
        .mergeWith(figure.options.attr|default)
        .mergeWith(figure_attributes|default)
    %}
    <figure{{ figure_attributes }}>
        {% if not figure.linkHref|default %}
            {# Media #}
            {% block media %}
                {{ block('picture_component') }}
            {% endblock %}
        {% else %}
            {# Media wrapped with link #}
            {% block media_link %}
                {% set link_attributes = attrs(figure.linkAttributes(true)|default)
                    .set('title', figure.metadata.title)
                    .mergeWith(figure.options.link_attr|default)
                    .mergeWith(link_attributes|default)
                %}
                <a{{ link_attributes }}>{{ block('media') }}</a>
            {% endblock %}
        {% endif %}

        {# Caption #}
        {% block caption %}
            {% if figure.metadata and figure.metadata.caption %}
                {% set caption_attributes = attrs()
                    .mergeWith(figure.options.caption_attr|default)
                    .mergeWith(caption_attributes|default)
                %}
                <figcaption{{ caption_attributes }}>
                    {%- block caption_inner -%}
                        {{- figure.metadata.caption|raw -}}
                    {%- endblock -%}
                </figcaption>
            {% endif %}
        {% endblock %}
    </figure>
{% endblock %}
```

Wow, there is **a lot** going on. For a moment, let's remove the [HTML attributes](../architecture#html-attributes) and
strip the example further down. 

It is no easier to see the `<figure>` HTML tag with a `<figcaption>` and some media, optionally wrapped in an `a` tag. 
Everything is placed in a block called `figure_component`.
```twig
{% block figure_component %}
    <figure>
        {# Media, optionally wrapped in a link #}
        {% if not figure.linkHref|default %}
            {% block media %}
                … here would be some media, like a picture …
            {% endblock %}
        {% else %}
            <a>{{ block('media') }}</a>
        {% endif %}

        {# Caption #}
        <figcaption>
            … here goes the caption …
        </figcaption>
    </figure>
{% endblock %}
```

Now, try going back to the original version. You'll find, that the "media" bit isn't implemented in the template, but
instead uses and renders another component, the `picture` component (yes we've got template reuse everywhere). You also
see the ["set and merge" pattern](#html-attributes) being heavily in use (more on that further down). And we've got a
lot of blocks. All this makes the template look more complex, but extremely adjustable on the other hand.

{{% notice info %}}
Don't worry — your templates do not have to feature the same level of adjustability. Consider it, when creating an
extension that ships components, though. For the Contao core, we try to value adjustability a bit higher in general, as
these templates are likely to be handled by a lot of parties.
{{% /notice %}}

#### Adjusting components
Talking about adjusting: You saw in the examples earlier in this article how you would adjust blocks introduced by
components. But how would you adjust a component itself (globally)?

{{% notice note %}}
**You cannot extend components!** In general: Twig does not allow to extend from templates that are being "used" at the
same time. Use and overwrite the component's blocks instead (see example below).
{{% /notice %}}

{{% example "Globally adjusting the picture component" %}}
Let's assume you want to add a custom class to every `<img>` tag and also wrap it in a div container. Luckily, this can
be done with minimal effort — you would overwrite the `@Contao/component/_picture.html.twig` template, import the
original templates' blocks, and then make the needed adjustments:
```twig
{% use "@Contao/component/_picture.html.twig" %}

{% block image %}
    {% set img_attributes = attrs(img_attributes|default).addClass('my-image) %}
    <div>{{ parent() }}</div>
{% endblock %}
```

Although, we are overwriting a block without extending a template, we can use the `parent()` function. It works as
expected outputting the original block's content. The rest of our adjustments is basic `HtmlAttributes` behavior — we
set a variable, we know the parent block is going to merge and use, and we're done. 
{{% /example %}}

#### Grouped parameters
Until now, we only looked at the `figure` and `picture` components. They are special in a way, that every data they
output, comes from a single `Figure` object (note the `figure` template parameter being used everywhere). Most of the
time, you want to use several parameters, though.

If you dare, take a look at the `list` component, another very powerful, yet complex component: 
[source code][List component source code]. Don't worry about the javascript magic to sort and randomize lists at the
moment but instead focus at the very beginning. Here is a stripped down version:
```twig
{% block list_component %}
    {% set list = list|default(_context) %}
    …
    
    <{{ tag_name }}>
        …
    </{{ tag_name }}>
{% endblock %}
```

The component begins with a variable declaration for a variable called `list` (not by accident: like the component),
that, if not already existing, will be set to the current context using the special `_context` variable. Inside the
component, everytime a parameter is used, the `list` version is used: `list.items`, `list.randomize_order`, and so on.

This effectively allows passing parameters **individually or grouped** under a Twig object. But why? When outputting
multiple components, you can neatly group the data (already in the controller). By using the default names (here
rendering with `parameters: ['headline' => […], 'list' => […]]`), you can omit any mapping needed with a `{% with %}`
block. More importantly, the component's parameters will never collide if named the same.  
```twig
{# Output a headline and a list #} 
{{ block('headline_component') }}
{{ block('list_component') }}
``` 

On the other hand, manually outputting blocks is less cumbersome without the additional group:
```twig
{% with {tag_name: 'h2', headline: 'My headline' } %}
    {{ block('headline_component') }}
{% endwith %}
```

{{% best-practice %}}
When creating components, allow grouping their parameters under a single object named like the component. For this add
a `{% set <name> = <name>|default(_context) %}` variable definition to the beginning of your component and then only use
the defined variable further down. Bonus points are given, if you add a little doc block to your file, listing the
available parameters and how to use them (look at the core's components for some inspiration).  
{{% /best-practice %}}


## Template features
The Contao Twig extension does most of the setup needed to provide our custom functionality, like the managed namespace,
the input encoding tolerant escapers, the legacy interoperability, or several filters and functions to make your life
easier. On top of that, many Twig features just work out of the box for us.

* Replacing and handling [insert tags](#insert-tags)
* Handling [HTML attributes](#html-attributes)
* Adding [shared page content](#response-context) such as scripts, styles or schema information
* Generating [images](#images) on the fly
* [Formatting](#formatting) and enhancing text
* Handling [translations](#translations)
* Generating and manipulating [URLs](#urls)

#### Insert tags
{{% notice warning %}}
Make sure you read and understood the section about [encoding](#encoding) before continuing!
{{% /notice %}}

If you want to output a string, that contains insert tags, you, as the template designer, need to decide if and how it
should get treated. In case insert tags should get replaced, you can precisely control what to encode and what to keep
raw (see table below): Everything, all but the result of evaluating the insert tags, or nothing at all. This way you
can keep the security risk low while still allowing features.

The examples in the following table use the context `['text' => 'This is some <b>very</b> {{br}} rich text.]` that both
includes some user input HTML and the `{{br}}` insert tag (which evaluates to `<br>` if being replaced). The given
output examples were generated using the escaping strategy for HTML.

| Handling | Usage | Example output in a HTML context
|-|-|-|
| plain text<br><small style="color:gray">treat insert tags as text,<br>encode everything</small> | `{{ text }}` | `This is some &lt;b&gt;very&lt;/b&gt; {{br}} rich text.` |
| replace<br><small style="color:gray">encode everything</small> | `{{ text\|insert_tag }}` | `This is some &lt;b&gt;very&lt;/b&gt; &lt;br&gt; rich text.` |
| replace and trust insert tags<br><small style="color:gray"><span style="filter:grayscale(1)">⚠️</span> only encode the text around the insert tags</small> | `{{ text\|insert_tag_raw }}`| `This is some &lt;b&gt;very&lt;/b&gt; <br> rich text.` |
| raw text<br><small style="color:gray">treat insert tags as text,<br>⚠️ encode nothing</small> | `{{ text\|raw }}` | `This is some<b>very</b> {{br}} rich text.` |
| replace and trust everything<br><small style="color:gray">⚠️ encode nothing</small>| `{{ text\|insert_tag\|raw }}` | `This is some <b>very</b> <br> rich text.` |

Think about your scenario, before deciding which option to use. Should insert tags even be replaced? If so, they might
for instance output HTML. Do you trust this? And, sticking to the HTML example, should a user be able to write HTML?
With `|insert_tag_raw` you can for example allow an editor to use the `{{br}}` insert tag while still disallowing the
use of any custom HTML around it.

{{% best-practice %}}
There is also an `insert_tag()` function to directly render an insert tag, but you should avoid using it if possible.
Use proper template functions and filters instead. Keep in mind, that insert tags are meant to be used by editors inside
back end and not to structure content in templates.
{{% /best-practice %}}

#### Response context
Sometimes a template only includes part of a page, like a content element, but still wants to contribute content that is
global to the page.

{{< version-tag "5.0" >}} For this, you can use the `add` tag in Contao. It allows adding content to the end of the
document head or body. If you want the block to be output only once (no matter how often the template is rendered on
the current page), you can provide a name. This is especially helpful when adding a generic javascript code or styles,
that do not make sense getting inserted multiple times.

```twig
{# Add code to the end of the document body #}
{% add to body %} … {% endadd %}

{# Add code to the end of the document head #}
{% add to head %} … {% endadd %}

{# Add code to the end of the document body once #}
{% add "foo" to body %} … {% endadd %}

{# Add code to the end of the document head once #}
{% add "bar" to head %} … {% endadd %}
```

If you want to add JSON-LD metadata to the current page, you can use the `add_schema_org` function. It expects an array
of data and returns nothing. For this, you will typically want to wrap a call to it in Twig's `do` tag:

```twig
{% do add_schema_org(…) %}
```

{{% notice info %}}
Behind the scenes, these features build on top of the [response context](../../response-context) concept. It is the
responsibility of the page template (like `fe_page`) to ultimately output the gathered data.
{{% /notice %}}

#### HTML Attributes
{{< version-tag "5.0" >}} HTML attributes are a heavily used feature in HTML. In the context of templates, they are also
one of the primary things, that people want to adjust. This is why we created the `HtmlAttributes` class together with
the `attrs()` function to create an instance of said class.

The `HtmlAttributes` class features a lot of helper methods in a fluent API style. With it, you can easily parse, merge
and compose attributes on the fly. Anything you pass to the `attrs()` function will be passed to the classes'
constructor: This could either be an associative array of attributes, a string of attributes that will get parsed or
another `HTMLAttributes` object that will get merged.

{{% example "Using the HtmlAttributes class in Twig (Part 1)" %}}
You can transpose the following…
```twig
<div id="main" class="{{ classes|join(' ') }}"{% if tooltip|default %} data-tooltip="{{ tooltip }}{% endif %}">
    {{ text }}
</div>
```
into an equivalent chain of calls:
```twig  
<div{{ attrs().set('id', 'main').addClass(classes).setIfExists('data-tooltip', tooltip|default) }}>
    {{ text }}
</div>
```

Using `{{ }}`, you can directly output the class. It implements a `__toString()` method, already encodes the output and
is registered as a so-called "safe class" in our Twig extension, that the escaper filters are skipped on.
{{% /example %}}

We are heavily using a pattern, that we call "**set and merge**", in the core's templates. Here, instead of outputting
the attributes directly, a variable is assigned first and the same variable (falling back to an empty string) is used
when constructing the attributes, effectively merging any previously set data. With this change, extenders of the
template, that only want to adjust attributes, do not have to overwrite anything. As their code gets executed first,
they can simply create the variable with the same pattern, and it will then get merged by the parent.

{{% example "Making HtmlAttributes better adjustable (Part 2)" %}}
Let's use the "set and merge" pattern:
```twig
{% set text_attributes = attrs(text_attributes|default)
    .set('id', 'main')
    .addClass(classes)
    .setIfExists('data-tooltip', tooltip|default)
%}
<div{{ text_attributes }}>
    {{ text }}
</div>
```
The magic really shows, when we want to adjust this template. For instance to add a custom class:
```twig
{% extends "@Contao/text_example.html.twig" %}

{% set text_attributes = attrs(text_attributes|default).addClass('custom-class') %}
```

{{% notice tip %}}
We could have omitted the constructor argument in the last example. If you cannot be sure, that the template you are
editing is always the first one to be executed (for instance in an extension), using the "set and merge" pattern again
is the way to go. This way it also works with multiple extenders that want to change things.
{{% /notice %}}
{{% /example %}}

{{% notice info %}}
Please refer to the doc block comments on each of the fluent interface methods of the `HtmlAttributes` class for details
on how to use it.
{{% /notice %}}

#### Images
{{< version-tag "5.0" >}} The `figure` and `picture` components are suited to render any built `Figure` object. In case
you cannot or don't want to create a `Figure` in the controller, you can alternatively use the `figure` function to
build a `Figure` instance on the fly. Internally, this uses the `FigureBuilder` from the Contao
[image studio](../../image-processing/image-studio#twig). In case you also want to create a picture/resize configuration
on the fly, you can use the respective `picture_configuration` function.

```twig
{# It's enough to specifiy the resource and size… #}
{% set figure = figure('path/to/my/image.png', '_my_size') %}

{# …but you can also go wild with the options: #}
{% set figure = figure(id, [200, 200, 'proportional'], { 
  metadata: { alt: 'Contao Logo', caption: 'Look at this CMS!' },
  enableLightbox: true,
  lightboxGroupIdentifier: 'logos',
  lightboxSize: '_big_size',
  linkHref: 'https://contao.org',
  options: { attr: { class: 'logo-container' } }
}) %}

{# You can even use a custom - on the fly - picture configuration: #} 
{% set special_size = picture_config({
    width: 400,
    height: 400,
    resizeMode: 'proportional',
    sizes: '0.75,1,1.5,2',
    items: [{
        width: 200,
        height: 100,
        media: '(max-width: 140px)',
    }]
}) %}
{% set figure = figure(uuid, special_size) %}
```

You can then query the object for things like metadata or sizes and/or output it as an image, for example using the
pre-made `_figure` component:

```twig
{% use "@Contao/component/_figure.html.twig" %}

{# Create the figure inline or use the one already in our context #}
{% set my_figure = figure(…) %}

{# Output it using the figure component #}
{% with {figure: my_figure} %}{{ block('figure_component') }}{% endwith %}
```

{{% notice note %}}
In Contao **4.13** you need to use the `contao_figure` instead of the `figure` function. While allowing the same
arguments, this function will directly render the (default or given) image template instead of returning a `Figure`
object. Note, that this function is deprecated since Contao **5.0**.
{{% /notice %}}

#### Formatting
{{< version-tag "5.0" >}} You can use the `highlight` and `highlight_auto` filters to generate code highlighting with
the `scrivo/highlight.php` library. You can either pass a language to use or let the library guess the language
(`highlight_auto`). In the latter case, you can optionally constrain the selection to a given subset of languages.

```twig
{# Output code directly as a string… #}
<pre><code>{{ code|highlight(language) }}</code></pre>

{# … and/or query the result properties: #}
{% set highlighted = code|highlight_auto %}
The detected language was {{ highlighted.language }} with a relevance of {{ highlighted.relevance }}.
```

{{< version-tag "5.0" >}} The `format_bytes` filter transforms a number representing a file size in bytes into a
human-readable form. It therefore uses the `MSC.decimalSeparator`, `MSC.thousandsSeparator` and `UNITS` declarations
from the global translation catalogue.

```twig
{# outputs 1536 #} 
{{ size }}

{# outputs "1.5 KiB" #}
{{ size|format_bytes }}

{# outputs "1.500 KiB" #}
{{ size|format_bytes(3) }}
```

#### Translations
The Symfony Twig bridge includes a `trans` tag and function to handle and output translations. If you want to define the
default translation domain, that is used in the whole template, you can use the `trans_default_domain` tag. Read more
about this in the [Symfony Twig documentation][Symfony Twig Docs trans tag].

```twig
{% trans_default_domain "contao_default" %}

<div>
    {# Output a translation using the default domain: #}
    <a href="more.html">{{ 'MSC.readMore'|trans }}</a>

    {# Output a translation containing placeholders and a custom domain. You
       can either use an array with unnamed parameters, or an object, that
       explicitly defines replacements: #}
    {{ 'tl_race.result'|trans([best_time], 'contao_race') }}
    {{ 'tl_race.result'|trans({'%best%': best_time}, 'contao_race') }}
</div>
```

{{% notice tip %}}
If you need a translation in a certain locale, this is also possible by passing the locale as an argument to the
function. For example `trans([], 'contao_default', 'de')` or  `trans(locale='it')`.
{{% /notice %}}


#### URLs
To generate URLs from within Twig templates, you can use the `path()` function, that is shipped with the Symfony Twig
bridge. Read more about this function in the [Symfony Twig documentation][Symfony Twig Docs path function].
```twig
<a href="{{ path('my_custom_route', {id: 42}) }}">Watch for this!</a>
```

{{% notice warning %}}
As of writing this, there is unfortunately no replacement for `PageModel::getFrontendUrl()`, yet. If you need this, for
now, stick to generating the URLs in your controller and then pass them to your template (where they are only output).
{{% /notice %}}

{{< version-tag "5.0" >}} The `prefix_url` filter prefixes relative URLs with the request base path. This is needed when
dealing with relative URLs on a page that does not set a `<base>` tag.

```twig
{# will outpuot something like "https://example.com/some/relative/url.html" #}
{{ 'some/relative/url.html'|prefix_url }}
```


## Naming convention
Because of the shared `@Contao` namespace, it is important, that the Contao ecosystem tries to stick to a common naming
convention. For the sake of readability, we are omitting the `@Contao/` prefix to the logical name in the following
examples.

{{% best-practice %}}
Here are some general rules to consider for directory as well as template file names:
 * Use snake_case, such as `content_element` or `foo_bar_baz`.
 * Only use lowercase characters and avoid special characters. Don't use dots except for the file extension.
 * Always include the file type and `.twig` as a file extension, e.g. `cat.svg.twig` or `slider.html.twig`.
 * The name already includes the directory/subdirectory, never repeat any directory name in the file name
   (~~`content_element/text/text_highlight.html.twig`~~ &rarr; `content_element/text/highlight.html.twig`). 
{{% /best-practice %}}

#### Directory structure
Twig allows the usage of directories as part of the template name. For extensions or if you want to use the
application's main template directory, you might want to read the part about how to properly set up the
[Twig root](../architecture#twig-root) first.

{{% best-practice %}}
We strongly suggest, that you organize your templates like outlined below. Especially extensions should stick to these
conventions, so that users do not have to mix different structures in their application's template directory!  

Put your templates in one of the following directories in your Twig root. Only create further subdirectories inside
these directories, if there is a justified need for it. You might want to pitch your idea
on [GitHub][New Contao Docs issue] first, so that we can potentially make it available here for others to use as well.

|Category|Directory|Template example (`@Contao/…`) |
|-|-|-|
|Reusable components|`component`|`backend/module_wildcard.html.twig`
|Content elements|`content_element`|`content_element/gallery.html.twig`
|Frontend modules|`frontend_module`|`frontend_module/feed_reader.html.twig`
|Anything related to the back end<br><small style="color:gray">Until we further refactor the back end, this directory is reserved for the Contao core.</small>|`backend`|`@Contao/backend/module_wildcard.html.twig`
|Forward compatibility<br><small style="color:gray">This directory is reserved for extensions, that need to provide templates in order to be forward compatible. You should never extend from these templates, nor render them directly.</small>|`compat`|`compat/content_element/code.html.twig`
|Extension-specific things|`<extension>`<sup>*)</sup>|`notification_center/mail.html.twig`

<sup>*)</sup> Only put things in an extension-specific directory, if it won't fit in any other category. If your
extension includes a lot of templates, it is fine to create a subdirectory `<extension>` (e.g. several content element
templates for the `foo` extension: `content_element/foo/…`). **Do not** use a vendor prefix if your extension has a
unique name (e.g. `notification_center`) or only makes sense to have one of a kind to be installed at the same time
(e.g. `opengraph` for an extension that adds opengraph tags). The same holds true for the template file names
themselves. 
{{% /best-practice %}}

#### Variants
In Contao, you can create templates in multiple variants and let back end users pick the one they need. Read more about
the architecture and how they are used in the [template variants section](../architecture#variant-templates).

{{% best-practice %}}
Variant templates should be put in a directory named like the template's file name excluding the file extension.

Example: A variant to the `content_element/gallery.html.twig` template, should be placed in the
`content_element/gallery` directory. The file name should describe what the variant is about, e.g.:
`content_element/gallery/carousel.html.twig` if images get displayed in a carousel instead.
{{% /best-practice %}}

{{< version-tag 5.2 >}} If you want to change the display names of the templates, that are selectable in the back end
dropdowns for content elements or frontend modules, you can create translations for them in the `templates` translation
domain. The translation ID is equal to the template identifier:
```yaml
# translations/templates.en.yaml
content_element/text: 'Default text'
content_element/text/special: 'Special text'

```



#### Partials and components
Partials are files that will never be rendered directly but included/embedded/used or extended from only. There is no
difference in how they work, but the convention to distinguish them allows to easier find the main controller templates. 

{{% best-practice %}}
Include a leading underscore to a partial's name. For instance: `content_element/_base.html.twig`. The same applies for
component files, such as `component/_list.html.twig`. Follow the rules about directories to decide where to put your
partial. It's fine, and also quite typical, that they coexist in the same directory as the files that are using them. 
{{% /best-practice %}}


[Twig Docs extends tag]: https://twig.symfony.com/doc/3.x/tags/extends.html
[Twig Docs include tag]: https://twig.symfony.com/doc/3.x/tags/include.html
[Twig Docs embed tag]: https://twig.symfony.com/doc/3.x/tags/embed.html
[Twig Docs use tag]: https://twig.symfony.com/doc/3.x/tags/use.html
[Twig Docs macro tag]: https://twig.symfony.com/doc/3.x/tags/macro.html
[Twig Docs with tag]: https://twig.symfony.com/doc/3.x/tags/with.html
[Twig Docs include function]: https://twig.symfony.com/doc/3.x/functions/include.html
[Twig Docs block function]: https://twig.symfony.com/doc/3.x/functions/block.html
[Symfony Twig Docs trans tag]: https://symfony.com/doc/current/reference/twig_reference.html#trans
[Symfony Twig Docs path function]: https://symfony.com/doc/current/reference/twig_reference.html#path
[List component source code]: https://github.com/contao/contao/blob/5.x/core-bundle/contao/templates/_new/component/_list.html.twig
[New Contao Docs issue]: https://github.com/contao/docs/issues/new
---
title: "Twig Support (Preview)"
description: Write Twig templates, use them in Contao and extend the system.
aliases:
  - /framework/templates/twig/
---

{{< version "4.12" >}}

Do you want to try Contao with Twig templates? On this page you'll find a quick
start how to…
 
 - create your [first Twig template](#getting-started-with-twig), 
 - use Twig templates in [Contao's ecosystem](#twig-in-contao)
 - and briefly how to [write your own extensions](#extending-twig).

Please provide feedback on [Github] or the Contao Slack channel in case you
notice bugs, unwanted behavior or have suggestions how to improve the
experience. 🙏

{{% notice warning %}}
Twig support is currently *experimental* and therefore not covered by Contao's
BC promise. Classes marked with `@experimental` should be considered internal
for now. Although not likely, there could also be some behavioral changes, so
be prepared. 
{{% /notice %}}

## Getting started with Twig
If you're already familiar with Twig, you might want to skip this step.

Twig templates have their own syntax, but don't be afraid, you'll quickly
find your way. Switch between the following tabs to see how an example PHP
template would translate to an analog Twig template:

{{< tabs groupId="twig">}}
{{% tab name="PHP" %}}
```html
<div class="about-me">
    <h2><?php echo $this->name; ?></h2>
    <p>I am <?php echo round($this->age); ?> years old.</p>

    <ul class="hobby-list">
        <?php foreach $this->hobbies as $hobby: ?>
          <li><?php echo ucfirst($hobby); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
<div class="about-me">
    <h2>{{ name }}</h2>
    <p>I am {{ age|round }} years old.</p>

    <ul class="hobby-list">
        {% for hobby in hobbies %}
          <li>{{ hobby|capitalize }}</li>
        {% endfor %}
    </ul>
</div>
```
{{% /tab %}}
{{< /tabs >}}

#### Learning the syntax
To output variables wrap their name in curly braces `{{ foo }}`, to use keywords
like `for` wrap them in `{%` and `%}`, to further process any output, use [filters][TwigFilters]
`|foo` and [functions][TwigFunctions] `bar()`.

Twig is very [well documented][TwigDocs] - a good place to start is the
[Twig for template designers][TemplateDesignersDocs] section that covers syntax
details as well as helpful IDE plugins for autocompletion and syntax highlighting.

For quickly trying something out, you can use [Twig fiddle][TwigFiddle] - an
online playground. Take a look at this [demo fiddle](https://twigfiddle.com/kctdqs)
for instance.

#### But why?
Twig is Symfony's default way to write templates. It's fast, safe and easily
extensible. Contrary to PHP templates, Twig templates won't contain business
logic which allows to share them more easily between designers and programmers.
This fact also helps you maintain a clean separation between your presentation
and data/logic layer.

Twig also features a lot of powerful methods to structure your templates like
including, embedding, inheriting, reusing blocks or macros, eases accessing
objects with "property access", has whitespace control, string interpolation
features and a ton more… Give it a try!

## Twig in Contao

### Overwriting and extending

You can use Twig templates at any place you would use a Contao PHP template,
just with a different file extension (`.html.twig` instead of `.html5`). It's
even possible to extend Contao PHP templates from within your Twig templates.


Go ahead and place a `fe_page.html.twig` in your template directory - this 
example will add a friendly headline above the main section and keep everything
else the same: 

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
    <h1>Hello from Twig!</h1>
    {{ parent() }}
{% endblock %}
```

1. Name your Twig templates like your Contao counterpart (except for the file 
   extension) and put them in a regular Contao template directory. There can
   **either** be a Twig **or** a PHP variant of the same template in the same
   location.

2. To extend an existing template (instead of completely replacing it) use the
   `extends` keyword and the special `@Contao` namespace (more about this, see
   below).

3. Use the same block names as in the original template.

{{% notice note %}}
You cannot extend Twig templates from within PHP templates only the other way
round.
{{% /notice %}}

#### Namespace magic
Twig templates live in namespaces like `@Foo/my_template.html.twig` (*Foo*) or
`@ContaoCore/Image/Studio/figure.html.twig` (*ContaoCore*). We are
automatically registering templates from the various Contao template
directories in their respective namespaces:

| Folder | Namespace | | Prio.<sup>*)</sup>
|-|-|-|-|
| `/vendor/…/templates`<br>`/vendor/foo/bar/contao/templates` | `@Contao_<bundle>`<br>`@Contao_FooBarBundle` | Any bundle template/views directory. | 1 |
| `/contao/templates`<br>`/src/Resources/contao/templates`<br>`/app/Resources/contao/templates` | `@Contao_App` | Template directory of the application. | 2 |
| `/templates` | `@Contao_Global` | Global template directory. | 3 |
| `/templates/<theme>`<br>`/templates/foo/theme` | `@Contao_Theme_<theme>`<br>`@Contao_Theme_foo_theme` | Any theme directory. The path (`foo/theme`) will be a transformed into a slug (`foo_theme`) and appended as a suffix. | 4 |

<sup>*) Higher values mean higher priority.</sup>

{{% notice info %}}
You can run `contao-console debug:contao-twig` to get a list of all registered
namespaces. If you want to list theme templates as well add the `-t` option with
your theme path or slug. To filter for certain templates enter their name or
prefix as an argument, e.g.: `contao-console debug:contao-twig ce_text -t my/theme`.
{{% /notice %}}

On top, we're also providing a **managed `@Contao` namespace** which you should
use whenever you do not know the exact namespace beforehand. This namespace
will be substituted with a specific namespace when the templates are compiled.
In each situation we're choosing the **next available** template that has a 
**lower priority** than the current one.

And yes, you can totally use this to extend, embed or include templates. Have a
look at the following example to get an idea.

#### Template hierarchy example
In this example, we're dealing with four manifestations of the same
`card.html.twig` template: two in bundles, two more in the application.  

{{< tabs groupId="template-hierarchy-example">}}
{{% tab name="a) card-bundle" %}}
The original template of the `card-bundle`:

```twig
{# /vendor/foo/card-bundle/contao/templates/card.html.twig #}

{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  {% block card %}
    <header class="title">
      {% block title %}{{ title }}{% endblock %}
    </header>     
    <main>
      {% block content %}
        {{ studio.figure(figure) }}
        {{ description|raw }}
      {% endblock %}
    </main>
    <footer>
      {% block footer %}<p class="author">by {{ author }}</p>{% endblock %}
    </footer
  {% endblock %}
</section>
```
{{% /tab %}}

{{% tab name="b) card-time-bundle" %}} 
A `card-time-bundle` extending the original bundle and adding information to
the footer - this bundle was loaded *after* the `card-bundle`, therefore it is
further up in our template hierarchy:

```twig
{# /vendor/bar/card-time-bundle/contao/templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block footer %}
  {{ parent() }}
  <p class="last-modified">edited at {{ modified_at|ago }}</p>
{% endblock %}
```
{{% /tab %}}

{{% tab name="c) global template" %}}
The `card` template of the global template folder adding some wrappers, 
because, you know, you can't have enough *divs*.

```twig
{# /templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block title %}<div class="inner">{{ parent() }}</div>{% endblock %}
{% block card %}<div class="inner">{{ parent() }}</div>{% endblock %}
```
{{% /tab %}}

{{% tab name="d) emoji theme" %}}
And finally the application's `emoji` theme adding, well, …

```twig
{# /templates/emoji/card.html.twig #}
   
{% extends '@Contao/card' %}
{% block title %}🤩 {{ parent() }} 🤯{% endblock %}
```
{{% /tab %}}
{{< /tabs >}}

Resolving all *extends* in the right order would effectively yield the
following template - note how each stage can adjust/contribute to blocks
without the need to know about the others because every *extend* uses the
managed `@Contao` namespace:

```twig
{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  <div class="inner">
    <header class="title">
      🤩 <div class="inner">{{ title }}</div> 🤯
    </header>     
    <main>
        {{ studio.figure(figure) }}
        {{ description|raw }}
    </main>
    <footer>
       <p class="author">by {{ author }}</p>
       <p class="last-modified">edited at {{ modified_at|ago }}</p>
    </footer
  </div>>
</section>
```


### Template context 

If you are implementing your own modules or content elements (fragment
controllers), you can follow Symfony's way to do it. Create a Twig template
instead of your usual PHP template (e.g. `ce_my_content_element.html.twig`)
and render it from inside your controller:

```php
/**
 * @ContentElement(category="texts")
 */
class MyContentElementController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        return $this->render('@Contao/ce_my_content_element.html.twig', [
            'text' => $model->text,
            'my_variable' => 'foobar',
        ]);
    }
}
```

You have full control over the template *context*, i.e. the array passed as
second argument. If you are rendering or replacing Contao templates, we are
creating the context for you based on the template data of the original
template.

⚠️ There is a small difference when it comes to callables like anonymous functions
or closures. Every element in Twig's context needs to be a literal or an object,
so we're wrapping functions into objects with `__toString()` functionality.
In case you need to supply arguments or you need anything else than the string
output, you'll need to add `.invoke()` to the variable name:

{{< tabs groupId="twig">}}
{{% tab name="PHP" %}}
```html
<?php echo $this->normalValue; ?>
<?php echo $this->lazyValue1(); ?>
<?php echo $this->lazyValue2('foo'); ?>
<?php echo implode(', ', $this->lazyArray()); ?>
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
{{ normalValue }}
{{ lazyValue1 }}
{{ lazyValue2.invoke('foo') }}
{{ lazyArray.invoke()|join(', ') }}
```
{{% /tab %}}
{{< /tabs >}}


### Encoding/escaping

For historic reasons Contao uses *input* encoding, but Twig embraces the more
sane *output* encoding. You can read more about the topic (and why you should
favor output encoding) in this [OWASP article][OWASPCheatSheet] about
preventing Cross Site Scripting (XSS) attacks.


#### Why you should care

The gist: You, as a template designer, have to decide how things should be
output, because *you* know the context and which content you trust or not. The
*exact same* data can be dangerous in one context and harmless in another:

{{< tabs groupId="output-encoding-example">}}
{{% tab name="Input encoding" %}}
Assume you have a variable `color` that should contain color names (like `red`,
`green`, `rebeccapurple`, …) and a template that should output the name of the
color inside a box with a background of this color. Maybe like so:

```php
<style>
  .box { background: <?php echo $this->color; ?> }
</style>

[…]

<div class="box"><?php echo $this->color; ?></div>
```

⚡ **This is dangerous.** The content of the variable has a different
meaning when output in CSS or HTML! This gets particularly bad if the
sanitization logic treating the input does not know about the different cases. 

<div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: .5em; padding: .5em; border: 3px solid red">
<div>

```text
red; } { body: display:none;
```
A perfectly valid, safe value for `color` in the HTML context would effectively
produce this style - certainly not what we want:

```php
<style>
  .box { background: red; } body { display: none; }
</style>
```
</div>
<div>

```text
<script>alert(1)</script>
```
Similar, stripping/encoding seemingly dangerous characters in CSS like `;`, `}`
or `{` would still allow an input like this which again would produce unwanted
HTML:

```php
<div class="box"><script>alert(1)</script></div>
``` 
</div>
</div>

This is a dilemma. The logic storing and processing data typically cannot know
(or only assume) how the data will be used. Will this end up in an HTML
document or inside an HTML tag? Or as a property in JSON-LD? Or as a value in a
CSV file? … 

{{% /tab %}}
{{% tab name="Output encoding" %}}
With Twig we can be specific how a certain variable should be treated. Use the
`|escape` or - short - `|e` filter for this:

```twig
<style>
  .box { background: {{ color|e('css') }} }
</style>

[…]

<div class="box">{{ color|e('html') }}</div>
```

✔️ Now, our "bad" input will be properly escaped for CSS or HTML and wouldn't
do any harm anymore:

<div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: .5em; padding: .5em; border: 3px solid green">
<div>

```css
.box { background: red\3B \20 \7D \20 \7B \20 body\3A \20 display\3A none\3B  }
```
</div>
<div>

```html
<div class="box">&lt;script&gt;alert(1)&lt;/script&gt;</div>
```

</div>
</div>

**Note:** By default Twig encodes **all** variables. The chosen escaper
strategy will depend on the template's file extension: your `.html.twig`
templates will automatically get the `|e('html')` treatment, so you could omit
this part in the above example.

Try it our for yourself in this [TwigFiddle](https://twigfiddle.com/d0w2yt).

{{% /tab %}}
{{< /tabs >}}

#### Trusted raw data
If you intentionally **do** want to output a variable containing raw HTML, like 
`<b>nice</b>`, you need to add the `|raw` escaper filter to your variable
`{{ tiny_mce_content|raw }}` which tells Twig to skip escaping this value.
Otherwise `&lt;b&gt;nice&lt;/b&gt;` will be output, i.e. a text saying
*&lt;b&gt;nice&lt;/b&gt;* and not a bold word <b>nice</b>. Just keep in mind,
that you only add `|raw` to trusted input!

{{% notice info %}}
Our Twig implementation makes sure you can use Twig templates as you would
with output encoding! So this strategy will be the same when we're completely 
switching to output encoding one day.<br>
In case you're wondering how we achieve this: Under the hood we use our own
`contao_html` and `contao_html_attr` escaper variants. These prevent double
encoding and are used instead of the original ones for all `@Contao*`
namespaced templates.
{{% /notice %}}


## Extending Twig
In Twig you can easily use and write extensions. The Contao core for instance
uses the [KnpTimeBundle] to format dates/time in a nice way ("5 minutes ago").
As this bundle provides a Twig extension with an `|ago` filter, you can
directly use this functionality in your templates:  

```twig
<p>Last edited: {{ modified_at|ago }}</p>

{# <p>Last edited: 5 minutes ago</p> #}
```

#### Using twig-extra bundles
In fact, there are already a lot of Twig extensions in the wild, including some
[official ones][TwigExtra]. These "twig-extra" bundles can simply be installed
with composer and are directly ready to be used (no need to configure or
register in the kernel).

```bash
composer require twig/intl-extra
```

```twig
{{ '1000000'|format_currency('EUR') }}

{# €1,000,000.00 #}
```

#### Make it your own
Twig has lots of extension points. The easiest things to add are filters and
functions. Have a look at the [offical docs][ExtendingTwigDocs] where things
are explained in detail. For fun, we are now going to implement a simple
`|reverse` filter in our application that will turn strings upside down
(`abc` &rarr; `cba`).

If you are using the [Symfony maker bundle][MakerBundle] you can use the command
`make:twig-extension` to create a new extension. Otherwise, go ahead and create
a class extending `AbstractExtension` in your `src/Twig` folder yourself. You
can have as many extensions as you want but in an application you would
typically use a single `AppExtension` until things get too crowded: 

```php
// src/Twig/AppExtension.php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('reverse', [$this, 'reverseString']),
        ];
    }

    public function reverseString(string $value): string
    {
        return strrev($value);
    }
}
```

That's it - our filter is now ready to be used in any template:

```twig
{% set my_cms = 'Contao' %}

This is {{ my_cms }} backwards: {{ my_cms|reverse }}

{# This is Contao backwards: oatnoC #}
```


[Github]: https://github.com/contao/contao/issues
[TwigFiddle]: https://twigfiddle.com/
[TwigDocs]: https://twig.symfony.com/doc/3.x/
[TemplateDesignersDocs]: https://twig.symfony.com/doc/3.x/templates.html
[TwigFilters]: https://twig.symfony.com/doc/3.x/filters/index.html
[TwigFunctions]: https://twig.symfony.com/doc/3.x/functions/index.html
[ExtendingTwigDocs]: https://twig.symfony.com/doc/3.x/advanced.html#extending-twig
[MakerBundle]: https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html
[TwigExtra]: https://github.com/twigphp/Twig/tree/3.x/extra
[KnpTimeBundle]: https://github.com/KnpLabs/KnpTimeBundle
[OWASPCheatSheet]: https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#rule-0-never-insert-untrusted-data-except-in-allowed-locations

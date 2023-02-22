---
title: "Architecture"
description: How the Contao Twig integration works.
weight: 200
aliases:

- /framework/templates/architecture/

---

Rendering a Twig template requires several things: First, the template needs to be found by a loader, that knows where
to look for the template based on the given name. Then, the template's source code is put through a parsing and
compilation stage, which translates it to PHP code. Finally, the resulting PHP document is executed with the given
parameters as context. 

For a more detailed description of the Twig internals, head over to the official [Twig docs][How does Twig work]. In
this article, we are focusing on the various Contao-specific changes and extensions, that take place in every of these
steps:

 1) How does our own [loader](#contao-filesystem-loader), the `ContaoFilesystemLoader`, work?
 2) Where to put templates and how to [name and structure](#naming-and-structure) them?
 3) What does [encoding](#encoding) mean and what is special in this regard with Contao?
 4) What about [interoperability](#legacy-interoperability) with legacy templates?
 5) Can I use modern templates in a [4.13/5.* extension](#version-compatibility)? 


## Contao Filesystem Loader

The core of Twig is the `Twig\Environment` class. You get an instance of it, when using the `@twig` service in Symfony
and you typically use it to render a certain template, identified by a distinct name, together with an array of
parameters:

<pre>
$twig->render("<span style="color:bisque">@Foo/bar/baz.html.twig</span>", <span style="color: lightcoral">$params</span>);
                        ↑                 ↑
                   <span style="color:bisque">Logical name</span>       <span style="color: lightcoral">Parameters</span>
</pre>

The environment class itself does not know anything about your template files. Instead, it delegates retrieving the
template source to a *loader*. Looking closer, you find, that there is a special loader, called a [chain loader][ChainLoader]
in Symfony, which holds a list of multiple loaders and asks one after another until the request can be answered. Contao
makes use of this and adds its own `ContaoFilesystemLoader` to the chain, that reads template files from Contao specific
locations on the filesystem.

Templates are identified by the *logical name* (the fully qualified template name, you could say). In order to make them
unique across different vendors, namespaces are used. Namespaces are denoted by an `@` sign and form the first part of
the logical name.

<pre>
$twig->render("<span style="color:lightblue">@Foo</span>/<span style="color:orange">bar/baz</span>.<span style="color:yellowgreen">html.twig</span><span></span>", $params);
                ↑        ↑         ↑  
           <span style="color:lightblue">Namespace</span> <span style="color:orange">Identifier</span> <span style="color:yellowgreen">Extension</span>
</pre>

{{% notice info %}}
*Logical name* is a Symfony term. Additionally, we use the term *identifier*, which means everything after the namespace
except for the file extension. We use this term when talking about templates from the special managed [@Contao namespace](#managed-namespace).
{{% /notice %}}

#### Default Symfony behavior

The default filesystem loader in a typical Symfony application looks at the root `templates` directory and groups all
files found there under an app-specific `@__main__` namespace. Also, the contents of directories inside
`templates/bundles` will each be put under a `@<directory>` namespace. And finally, templates from bundles are also each
put under a `@<bundle-name>` namespace. 

There is a specific order and the loader will only use the first template that fits the requested logical name. That is
why you can overwrite templates of the `FooBundle` by putting them in the `templates/bundles/FooBundle` directory: you
made the loader return early when finding your template instead of the original one in said namespace.

{{% notice note %}}
For Contao extensions, you do not need the `bundles` directory. We use the `@Contao` namespace, that is shared across
the ecosystem. Read on for more details about this.
{{% /notice %}}

You might have noticed, that bundle templates also get put under a second `@!<bundle-name>` namespace
(prefixed with an exclamation mark). In Symfony, this is used to allow overwriting a template while **also** extending
the original one. Think about how you would reference the original template: Without the second namespace, the loader
would always return the replacement, as it wins over the original one. But now, what happens if two extensions (or an
extension and the application) use this trick without knowing each other? Spoiler alert: it's an issue and the reason
why we invented the *managed namespace* concept.

#### Managed namespace

Symfony's standard way has a big drawback for us: If multiple parties (e.g. extensions and/or the application) want to
adjust the same template, they **must know each other** and explicitly target their namespaces. Otherwise, when
overwriting, only the first party would win. Contao's answer to that is called the "managed namespace" or `@Contao`
namespace, where this problem does not occur.

Our `ContaoFilesystemLoader` puts every template from a Contao template directory under the following namespaces (don't
worry, you don't have to remember this):

| Directory | Namespace | Order
|-|-|-|
| Any bundle's template directory:<br>`/vendor/…/templates`<br>`/vendor/foo/bar/contao/templates` | `@Contao_<bundle>`<br>`@Contao_FooBarBundle` | 1 |
| Main template directory of the application:<br>`/contao/templates`<br>(`/src/Resources/contao/templates`)<br>(`/app/Resources/contao/templates`) | `@Contao_App` | 2 |
| Global template directory:<br>`/templates` | `@Contao_Global` | 3 |
| Any theme directory:<br>`/templates/<theme>`<br>`/templates/foo/theme` | `@Contao_Theme_<theme>`<br>`@Contao_Theme_foo_theme` | 4 |

{{% notice info %}}
For theme directories (e.g. `foo/bar/theme`), the path will be transformed into a snake-case slug (`foo_bar_theme`),
which is used inside the theme namespace name (`@Contao_Theme_foo_bar_theme`). For this reason, underscores are
forbidden characters in any directory name contributing to the slug.
{{% /notice %}}

But, you guessed it, there is yet another namespace called `@Contao`, and that is the one primarily used in Contao.
The loader also puts every template from the above Contao namespace directories into this namespace but this is mainly
for better static analysis. The real magic happens at [compile time][How does Twig work]: We **replace** each usage of
the `@Contao` namespace inside any `extends`, `include`, `embed` or `use` tag **with a more specific namespace** from
the above table. This happens automatically — you don't have to do anything for it.

<pre>
 {% extends "<span style="color:lightblue">@Contao</span>/content_element/text.html.twig" %}
                 ↓
 {% extends "<span style="color:lightblue">@Contao_ContaoCoreBundle</span>/content_element/text.html.twig" %}
</pre>

Instead of one single unique template per logical name, you now get a *hierarchy* of templates. First come the app's
global and main template directory (see above), then those of all bundles in inverse loading order (if you are loaded
later, you're first). The [replacement logic][Contao Twig Inheritance Code] uses the hierarchy to always choose the
next logical representation that exists (potentially skipping over levels). 

By the way: Theme templates, though considered the most specific, are somewhat special in that regard. For more details,
please refer to their [own section](#themes) further down.

{{% notice tip %}}
You can use the `debug:contao-twig` command to browse and better understand the built hierarchy. Read more on this in
the article about [debugging](../debugging/#debug-contao-twig-command) strategies. 
{{% /notice %}}

{{% example "Independent inheritance" %}}
Let's see the effect of the namespace replacements once again in a simplified example. We assume the core ships a
`@Contao/simple_text.html.twig` template and two independent bundles want to adjust this same template.

The original template of the `ContaoCoreBundle`:
```twig
<h1>Some simple text</h1>
{% block content %}
    <p>{{ text }}</p>
{% endblock %}
```

The `FooterBundle` ships a `simple_text.html.twig` template that adds a paragraph to the simple text. During
compilation, the reference in line 1 will be replaced with `@Contao_CoreBundle/simple_text.html.twig`.
```twig
{% extends "@Contao/simple_text.html.twig" %}

{% block text %}
  {{ parent() }}
  <p class="footer">Here is a footer.</p>
{% endblock %}
```

The `BoxBundle` wraps the simple text content in a div with a border in its version of the `simple_text.html.twig` file.
During compilation, the reference in line 1 will be replaced with `@ContaoFooterBundle/simple_text.html.twig`.
```twig
{% extends "@Contao/simple_text.html.twig" %}

{% block text %}
<div style="border: 1px solid black">
  {{ parent() }}
</div>
{% endblock %}
```

In an application setup like this, a render call
```php
$this->render('@Contao/simple_text.html.twig', ['text' => 'Hello world!']);
```
will result in the following output:
```html
<h1>Some simple text</h1>
<div style="border: 1px solid black">
    <p>Hello world!</p>
    <p>Here is a footer.</p>
</div>
```

Note, that neither the caller, nor the extenders need to know which bundles are installed in the application. Moreover,
you could also overwrite the same template again in the application, independent of having the extensions installed or
not.
{{% /example %}}

#### Themes

In Contao, there is the option to create theme-specific representations of templates. The `A` theme and `B` theme could
both contain a `content_element/text.html.twig` template. They can also both extend from any existing base template.
Whether the `A`, `B` or global version of the template gets rendered, is a runtime decision, though. And this makes them
behave a bit differently than the other templates.

If a page object is available in the current request, the theme can be derived from the (inherited) page layout setting.
In case a theme was identified and contains a more specific version of a template, the `ContaoFilesystemLoader` will
use it instead. From a template hierarchy perspective, these theme templates **do not exist**. This is a design decision
to keep the template hierarchy static, render calls stable (and yourself sane).

{{% notice note %}}
Theme templates are runtime representations of otherwise existing templates. They are not part of the template
hierarchy. 
{{% /notice %}}

These are the implications that follow from this setup:

1) Theme templates can only be theme-specific representations of otherwise existing templates. They will, for instance,
   never show up in any template selection dropdown.

2) As a matter of fact, you cannot create a [variant template](#variant-templates) in a theme directory and make it show
   up in the template selection. You can, however, create a theme-specific representation of an existing variant
   template. By creating a selectable non-theme variant template as a basis, you also make sure that, there will
   **always** be an available template when rendering.

3) When debugging templates via the [`debug:contao-twig` command](../debugging#debug--contao-twig-command), you need to
   explicitly pass a theme (slug) to make the respective theme templates show up in the result. 


## Naming and structure

In this section we're talking about how templates should be named and structured and why it might be more important than
in the typical Symfony ecosystem.

{{% best-practice %}}
When creating templates, you now got the option to use the `@Contao` namespace over the bundle namespace. So when to
choose what? As a rule of thumb: If external adjustments are not intended, feel free to use basic Symfony
behavior/bundle namespaces, but stick to the `@Contao` namespace for anything belonging to the Contao ecosystem. Only
this way others can safely reuse/extend your output.
{{% /best-practice %}}

> Won't using the `@Contao` namespace lead to naming collisions if every vendor is using it?

This is a good point and intuitively kind of works against the idea of namespaces. But Contao has proven, it isn't that
big of a problem, either: In the old days, Contao's templating engine did neither use any namespaces nor
subdirectories<sup>*)</sup> to structure templates. We instead added vendor or type prefixes to the template names based
on a naming convention. This worked surprisingly well, but lead to a lot of files in one place. With Twig templates, the
path, i.e. the directories and subdirectories the template files are placed in, is now part of the template name. This
means we can structure by category or vendor by creating a filesystem structure.

<sup>*) Well, there could be subdirectories on the filesystem, but they did not affect the template name.</sup>

Let's do exactly that:

<pre style="margin-top:-.5em">
 <span style="color:#ffe8c3">templates</span> ← Twig root
 │
 ├─<span style="color:#ffc75d">content_element</span>
 │  ├─<span style="color:#ffa500">text.html.twig</span>
 │  └─<span style="color:#ffa500">image.html.twig</span> 
 ├─<span style="color:#ffc75d">foo</span>
 │  └─<span style="color:#ffa500">bar</span>
 │     └─<span style="color:#d38900">baz.json.twig</span>
 …
</pre>

We call the topmost directory in the above example our *Twig root*, because all subdirectories in there contribute to
the template name: There is a `content_element/text` template and a `foo/bar/baz` template. As you can tell, you can
also introduce more subdirectory layers if needed.

{{% best-practice %}}
When users want to override/adjust templates from various sources, they need to replicate the filesystem structure. To
make this a pleasant experience, please stick to the [naming conventions](../creating-templates#naming-convention), so
that multiple structures do not mix.
{{% /notice %}}

Above, we referred to `@Contao/content_element/text.html.twig` by just writing `content_element/text`. In fact, in
the `@Contao` namespace, these two things both uniquely identify the same template. When using
the [identifier](#contao-filesystem-loader), we imply the namespace and find the right file extension. The latter is
guaranteed to be unique per identifier by our loader — if there would for instance also be a `text.xml.twig` (note the
different file extension) in a `content_element` directory, an exception would be thrown when the filesystem gets
scanned.

{{% notice info %}}
We treat everything after the last `.` in a file name as *file extension*. If this last bit is `twig`, we also include
the part before it. So a `foo.bar.baz.html.twig` file has the extension `html.twig` while it would be just `baz` for
`foo.bar.baz`. Even though possible, it's considered a good practice to include the filetype **and** the `.twig` suffix
and avoid extra dots: e.g. `my_file.svg.twig` for a svg file, or `foo_bar_baz.html.twig` for a HTML file.
{{% /notice %}}


#### Twig Root

Because we made it possible to overwrite existing legacy PHP templates with Twig templates, and because the old template
system does handle directories differently, the loader cannot always safely determine if your template directory (or
maybe a subdirectory) should be treated as the Twig root. In Contao 6, all the
[Contao template directories](#managed-namespace) will implicitly be Twig roots — until then **only the global template
directory and the theme directories** are.

For any other place, such as the main template directory (`contao/templates`) and inside bundles, you need to add a
special marker file `.twig-root` to denote that *this* directory should be used as the naming root.

{{% example "Using a .twig-root file in a bundle" %}}
Assume the `FooBundle` has the following structure inside its Contao template directory:
<pre style="margin-top:-.5em">
 <span style="color:#ffe8c3">vendor/…/FooBundle/contao/templates</span>
 ├─<span style="color:#ffc75d">bar</span>
 │  └─<span style="color:#ffc75d">baz.html.twig</span>
 └─<span style="color:#ffc75d">my_root</span>
    ├─<span style="color:#ffa500">.twig-root</span> 
    └─<span style="color:#ffc75d">content_element</span>
       └─<span style="color:#ffa500">foobar.html.twig</span>
</pre>

Now, a `@Contao/baz.html.twig` template would be available (note the ignored directory structure like with the legacy
template engine) as well as a `@Contao/content_element/foobar.html.twig`, that includes the directory names under the
Twig root in the template name.
{{% /example %}}

#### Variant templates

One of Contao's features is the ability to provide variants to an existing template and let editors choose which one to
use in the back end on a per-element basis. You could for instance have a bunch of specialized templates for the text
content element — maybe one that can be used, when something should stand out in the design and one that wraps lengthy
side notes in an expandable section.

{{% example "Creating variant templates" %}}
To get what we outlined above, we need to create two new templates. In order to not repeat ourselves and to
potentially profit from adjustments made by others, we are going to extend the original text content element template
(`@Contao/content_element/text.html.twig`) and only tweak some blocks.

The first variant template, `content_element/text/highlight.html.twig`, adds a big red border around the text — no-one
will miss that:
```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block text %}
    <div style="border: 5px red; padding: 1em;">{{ parent() }}</div>
{% endblock %}
```

For the second variant, `content_element/text/side_note.html.twig`, we wrap the whole content in
a [details disclosure HTML element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details), which displays
it in a closed/collapsed state until someone clicks on it.
```twig
{% extends "@Contao/simple_text.html.twig" %}

{% block content %}
<details>
  <summary>Here is an interesting side note…</summary>
  {{ parent() }}
</details>  
{% endblock %}
```

We deliberately put both variant templates in a directory that follows the original template's name. This way, it is
automatically picked up by the template `Finder` and provided in the respective template options dropdown in the back
end.
{{% /example %}}

#### Finder

If, in your own code, you need to compile a list of templates, it can get quite cumbersome to loop through and filter
the template hierarchy. For your convenience, there is a `contao.twig.finder_factory` service, that makes this process
easy.

```php
// Inject the factory service, then create a new template finder instance.
$finder = $this->finderFactory->create();

// Configure it using its fluent interface; here we only want to find templates
// named "foo/bar.json.twig" including related variants, like "foo/bar/baz.json.twig":
$finder = $finder
    ->identifier('foo/bar')
    ->extension('json.twig')
    ->withVariants()
;

// Then, iterate over the results…
foreach ($finder as $identifier => $extension) {
    // …
}

// …or directly generate template options with labels, that can be returned in
// a DCA options listener. 
$options = $finder->asTemplateOptions();
```

{{% notice info %}}
Please refer to the doc block comments on each of the fluent interface methods of the `Finder` class for details on how
to use it.
{{% /notice %}}


## Encoding

For historic reasons Contao uses *input* encoding, but Twig embraces the more sane *output* encoding. You can read more
about the topic (and why you should favor output encoding) in this [OWASP article][OWASPCheatSheet] about preventing
Cross Site Scripting (XSS) attacks. We outline further down, how we want to achieve the switch in Contao 6 and how you
can already write modern template code. 

#### Why you should care

The gist: You, as the template designer, have to decide how things should be output, because *only you* know the context
in which content can be trusted or not. The *exact same* data can be dangerous in one context and harmless in another!

{{< tabs groupId="output-encoding-example">}}
{{% tab name="Input encoding" %}}
Assume you have a variable `color` that should contain color names (like `red`, `green`, `rebeccapurple`, …) and a
template that should output the name of the color inside a box with a background of this color. Maybe like so:

```html
<style>
  .box { background: <?= $this->color ?> }
</style>

[…]

<div class="box"><?= $this->color ?></div>
```

⚡ **This is dangerous.** The content of the variable has a different meaning when output in CSS or HTML! This gets
particularly bad if the sanitization logic treating the input does not know about the different cases.

<div style="display:grid;grid-template-columns:1fr 1fr;grid-gap:.5em;padding:.5em;border:4px solid #d9534f">
<div>

```text
red; } { body: display:none;
```
A perfectly valid and safe value for `color` in the HTML context, would produce this unwanted result in the CSS context.
This is certainly not what we want:

```html
<style>
  .box { background: red; } body { display: none; }
</style>
```
</div>
<div>

```text
<script>alert(1)</script>
```
Likewise, even if you would strip or encode special CSS characters (like `;`, `}` or `{`), you would not solve the
problem. A string, such as the one above, would pass but now gets dangerous in the HTML context:

```html
<div class="box"><script>alert(1)</script></div>
``` 
</div>
</div>

This is a dilemma. The logic storing and processing data **can never know** in which context the data will be used. Will
this text end up in an HTML document or inside an HTML tag? Or as a property in JSON-LD? Or as a value in a CSV
file? And even when there is likely only one use case, making the input side responsible for the security, is a very bad
idea. You won't be able to fix mistakes made when "input encoding", neither will you be able to safely add another
output context later on.

{{% /tab %}}
{{% tab name="Output encoding" %}}
With Twig, we can be specific how a certain variable should be treated, depending on the context! Use the `|escape` (or
short `|e`) filter for this:

```twig
<style>
  .box { background: {{ color|e('css') }} }
</style>

[…]

<div class="box">{{ color|e('html') }}</div>
```

Now, our "bad" input will be properly escaped for CSS or HTML and wouldn't do any harm anymore:

<div style="display:grid;grid-template-columns:1fr 1fr;grid-gap:.5em;padding:.5em;border:4px solid #9acd32">
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

And because this feature is essential for secure templates, **Twig will — by default — encode all parameters.** It
selects the default escaper strategy depending on the template's file extension: your `.html.twig` templates will
automatically get the `|e('html')` treatment, so you could omit this part in the above example.

Try it out for yourself in this [TwigFiddle](https://twigfiddle.com/d0w2yt) or read more about the 
[escaper extension](https://twig.symfony.com/doc/3.x/api.html#escaper-extension) in the official Twig documentation.

{{% /tab %}}
{{< /tabs >}}

{{% notice warning %}}
Heads up: Literals and expressions which result in a literal, are never automatically escaped! For more details, please
refer to the [official Twig documentation](https://twig.symfony.com/doc/3.x/api.html#escaper-extension).
```twig
{# The following terms will not be escaped! #}
{{ "Twig<br>" }}
{{ foo ? "Twig<br>" : "<br>Twig" }}
```
{{% /notice %}}

#### Trusted raw data

If you intentionally **do** want to output a variable without encoding, such as some raw HTML (`<b>nice</b>`) in a
`.html.twig` template, you need to add the `|raw` filter to your variable `{{ my_content|raw }}`. This tells Twig to
skip the escaper filters for this value. Otherwise, here, the encoded form `&lt;b&gt;nice&lt;/b&gt;` would be output and
the browser would display a text saying *&lt;b&gt;nice&lt;/b&gt;* instead of the boldly written word <b>nice</b>.

You typically have this situation with text from the back end's tinyMCE rich text editor. Here, Contao already sanitizes
the HTML with the aim to remove unwanted or potentially dangerous HTML. This depends on your `contao.sanitizer` settings
including the allowed tags and attributes, though. With a too lax configuration, you are open to XSS injections if this
data is output in an unencoded form!

{{% notice warning %}}
Only ever add `|raw` to things you trust! Using `|raw` on anything else may result in severe XSS vulnerabilities!
{{% /notice %}}

#### Double encoding prevention

Our Twig implementation makes sure you can use Twig templates as you would with output encoding (only). The intention
hereby is, that your templates can stay the same and are already safe, when we're removing the input encoding part in
Contao 6. 

In case you're wondering, how we achieve this: Under the hood, we added our own `contao_html` and `contao_html_attr` 
escaper variants for the HTML context. These work very similar to the original versions (`html` and `html_attr`), except
they prevent double encoding using `htmlspecialchars(double_encode: false)`. At template compile time, we then exchange
escaper calls to point to ours instead. 

In order to not cause unwanted output for any other Symfony bundle or your app's custom templates, we only do this for
the `@Contao` and `@Contao_*` namespaces. If you want this behavior for other templates as well, you can add your own
escaper rule. A rule is a regular expression — if it matches the template's logical name, the Contao escapers will be
enabled.  

```php
// Do this in your kernel or in a compiler pass 
$contaoExtension = $twig->getExtension(ContaoExtension::class);
$contaoExtension->addContaoEscaperRule('%^@MyNamespace/%');
```


## Legacy interoperability

To make the transition to Twig as easy as possible, we build the ability to overwrite and extend existing PHP templates
with Twig counterparts. There are a lot of things happening in the background to make this work, and we are going to
drop this complexity together with the whole legacy template engine in the future. You should not use this feature as an
excuse to create new PHP templates if there is a modern alternative.

To overwrite a PHP template with a Twig template, name it exactly like the PHP template, but use `.html.twig` as the
file extension. To adjust the `fe_page.html5` template, you would create a `fe_page.html.twig` template in a Contao
template directory. If there are both versions, the legacy template will be ignored.

{{% example "Extending a legacy template" %}}
The `fe_page` template is still an old one where there is no modern replacement, yet. We can still adjust it by writing
a Twig template. Assume we want to add a style block to the head. We would create a file `fe_page.html.twig` in our
template directory and add the following contents:

```twig
{% extends "@Contao/fe_page.html5" %}

{% block head %}
    {{ parent() }}
    <style>
        .thing { color: orange; }
    </style>
{% endblock %}
```

Here we target existing blocks and use the `parent()` function as we would in a regular Twig template.
{{% /example %}}

{{% notice note %}}
You can only use Twig templates to extend from the legacy PHP templates, not the other way round. This also means, that
an extension doing this for a template, would force everyone to change there versions to Twig as well. In this case, the
behavior is likely not what you want, and you should use the legacy template, still. 
{{% /notice %}}

#### Context transformation

The data passed to the legacy templates gets transformed and passed to the environment's `render()` function as an 
array. In most cases you would not note a difference, but there is a small caveat if callables like anonymous functions
or closures were used.

Every element in Twig's context needs to be a literal or an object, so when transforming, we're wrapping functions in
anonymous objects, that implement a `__toString()` function. In case you need to supply arguments, or you need anything
else than string output, you'll need to utilize the object's `invoke()` function.

{{% example "Accessing legacy callables" %}}
Assume you got a legacy template, that includes callables in its template data…

```php
$this->Template->setData([
    'normalValue' => 'foo',
    'lazyValue' => static function(): string {
        return 'foo';
    },
    'fooFunction' => static function(string $value): string {
        return "foo-$value";
    },
     'lazyArray' => static function(): array {
        return [1, 2, 3, 4, 5];
    },
]);
```
… you would then access this data/evaluate the functions like so:

<div class="from-to">
<div>

```html
<?= $this->normalValue ?>
<?= $this->lazyValue ?>
<?= $this->fooFunction('bar') ?>
<?= implode(', ', $this->lazyArray) ?>
```
</div>
<div>

```twig
{{ normalValue }}
{{ lazyValue }}
{{ fooFunction.invoke('bar') }}
{{ lazyArray.invoke()|join(', ') }}
```
</div>
</div>
{{% /example %}}

{{% notice note %}}
The context transformation is done by the `@contao.twig.interop.context_factory` service. Although, you could use it to
make callables work with your own templates, we do not advice in doing so. Most times it is better to create a real
object for this use case — in doing so, you can also profit from getting autocompletion by type hinting the variable in
your template (if your IDE supports this). We likely want to drop this service in the future after removing support for
legacy templates together with everything else in the `Contao\CoreBundle\Twig\Interop` namespace.
{{% /notice %}}


## Version compatibility

🟢 As an extension developer you might ask yourself which Contao versions your extension can be compatible with. As
a rule of thumb, we suggest to stick to **Contao 5 only** for new extensions, *if you can*.

🟡 Alternatively, you might want to **support Contao 5 and Contao 4.13 LTS at the same time**. In general, this should
be doable without maintaining a completely different branch but there are some pitfalls. Read more about that in the
following section.

🔴 From a Twig support perspective, supporting Contao 4.9 LTS is not feasible, as native support for it was only added
to the core in Contao 4.12. Also note, that Contao 4.9 is in the [security-only phase][Release plan] as of mid february
2023 and will not be maintained anymore a year after that.

#### Considerations when also supporting Contao 4.13

In Contao 5.0, a new structure for content elements was introduced, that features directories (`content_element`),
instead of prefixes (`ce_`). Since then, several changes have been back ported to Contao 4.13. In the latest release,
you can now do the following things (Twig only):

* Use directories as part of template names.
* Use arbitrary file extensions (e.g. `foo.json.twig`).
* Use the template `Finder` via the `contao.twig.finder_factory` service.

{{% best-practice %}}
For new major releases, we strongly suggest to follow the **new** template directory structure, even in Contao 4.13.
Otherwise, you likely need to release another major version when doing the change in the future (due to everyone having
to migrate their templates.) For people creating new applications with Contao 5, the added benefit is a clean
homogeneous template structure from the get-go.  
{{% /best-practice %}}

Depending on where you make your templates available, you might need to curate the template options yourself. Using the
`Finder`, this should be straight-forward, though.

{{% notice warning %}}
When using fragment controllers, please note, that the template name, that is auto-generated from the type and class
name, will be different in Contao 4.13 and Contao 5! A `FooController` content element would use a `ce_foo` template in
Contao 4.13 and a `content_element/foo` template in Contao 5. Make sure to **explicitly define** the template identifier
in the controller annotation/service tag, in case you want to use the new version with Contao 4.13:

```php
/**
 * @ContentElement(category="bar", template="content_element/foo") 
 */
class FooController extends AbstractContentElement
{
    …
}
```
{{% /notice %}}

You might need to get a bit creative when you want to use templates, that were only added in Contao 5. One way of
working around that issue, is, to provide the missing template(s) yourself and make the usage forward compatible.

1) Put the template in the `compat` directory. Templates inside this directory are never meant to be extended by
   others, so the structure is not important. You might want to copy the structure you are missing, though. For example,
   create a `compat/content_element/code.html.twig` template as a replacement for the `content_element/code.html.twig`
   template, that is available in Contao 5.

2) Use [dynamic inheritance][Twig Docs dynamic inheritance] to tell Twig, that it should use your compat template if
   the original one isn't available. When referencing the compat template, use the
   [extension-specific namespace](#managed-namespace), so that *your* template is targeted, even if another extension
   used the same name:
   ```twig
   {# Twig will use the first available template, when providing an array of options #}
   {% extends [
       "@Contao/content_element/_base.html.twig",
       "@Contao_FooBarBundle/compat/content_element/_base.html.twig"
   ] %}
   ```


[How does Twig work]: https://twig.symfony.com/doc/3.x/internals.html#how-does-twig-work
[Twig Docs dynamic inheritance]: https://twig.symfony.com/doc/3.x/tags/extends.html#dynamic-inheritance
[ChainLoader]: https://github.com/symfony/symfony/blob/5.4/src/Symfony/Component/Templating/Loader/ChainLoader.php
[Contao Twig Inheritance Code]: https://github.com/contao/contao/tree/5.x/core-bundle/src/Twig/Inheritance
[OWASPCheatSheet]: https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#rule-0-never-insert-untrusted-data-except-in-allowed-locations
[Release plan]: https://contao.org/en/release-plan.html

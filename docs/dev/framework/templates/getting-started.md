---
title: "Getting started"
description: How to quickly get going with the most typical Twig use cases.
weight: 100
aliases:

- /framework/templates/quick-reference/

---

If you are already familiar with writing Twig templates, you might want to skip this part and directly head over to the
[next chapter](../architecture). For everyone else, here comes a quick *Twig 101*.


## Why Twig in Contao?

Twig is the standard way to write templates in Symfony. And that is for a reason: It features a wide range of powerful
methods to structure and reuse templates, has an easy-to-use syntax to access objects, helpers to transform data,
built-in whitespace control, string interpolation features, macros, and — really — a ton more…

But ultimately, the biggest selling point for us is security. Twig embraces *output encoding*, something that we
desperately try to move to for a long time. That is, why Twig has been made a core requirement and will replace our old
existing template system and also why you should familiarize yourself with it.


## Learning the syntax

Twig templates have their own syntax, but don't be afraid, you'll quickly find your way. Here, is an example of a PHP
template, that was translated into an equivalent Twig template. (In case you're new to Contao, you might want to directly
focus on the right side and ignore the old stuff on the left. 😉)

<div style="display:grid;grid-template-columns:1fr 40px 1fr;margin:-20px 0">
<div>

```html
<?php */ Old stuff */ ?>
<div class="about-me">
  <h2><?= $this->name ?></h2>
  <p>I am <?= round($this->age) ?> years old.</p>

  <ul class="hobby-list">
    <?php foreach $this->hobbies as $hobby: ?>
      <li><?= ucfirst($hobby) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
```
</div>
<div style="align-self: center;justify-self:center;color:#282c34">➔</div>
<div>

```twig
{# New stuff! #}
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
</div>
</div>

* To output parameters, we wrap their name in curly braces `{{ foo }}`,
* to use keywords — like `for` to loop over an array — we wrap them in `{%` and `%}`,
* to further process any output, we use [filters][Twig Filters] `|foo` and [functions][Twig Functions] `bar()`.
* Finally, to add comments, we put them between `{#` and `#}`.

Twig is very [well documented][Twig Docs]. A good place to start is the [Twig for template designers][Twig Template Designers Docs]
section that covers syntax details as well as helpful IDE plugins for autocompletion and syntax highlighting.

{{% notice tip %}}
For quickly trying something out, you can use [Twig fiddle](https://twigfiddle.com/), an online playground. Take a look
at this [demo fiddle](https://twigfiddle.com/qq1kml) for instance.
{{% /notice %}}


## Extending Twig

Extending Twig yourself is easy but there are also already a lot of Twig extensions in the wild, including some official
ones, called the [twig-extra][TwigExtra] bundles. In Contao, the latter can simply be installed with Composer or the
Contao Manager and are directly ready to be used (no need to configure or register anything).

```bash
composer require twig/intl-extra
```

```twig
{{ '1000000'|format_currency('EUR') }}

{# €1,000,000.00 #}
```

#### Custom code

We also encourage you to extend Twig yourself. There are a lot of extension points with filters and functions being the
easiest to start with. Have a look in the [official docs][Extending Twig Docs], where things are explained in more
detail. 

{{% notice note %}}
If you created PHP templates in the past, and are missing functionality that you previously would have implemented
directly in the templates, using filters and functions is the way to go. As a nice side effect, you can now make use of
your custom implementation in *any* template. 
{{% /notice %}}


{{% example "Creating your first Twig filter" %}}
Let's implement a simple `|rot13` filter in our application, that will scramble strings by shifting every letter by 13
places in the alphabet (`Abcd` &rarr; `Nopq`). That's apparently so useful, that PHP already has a built-in function for
this: `str_rot13()`. Nice.

Go ahead and create a class, that is extending `Twig\Extension\AbstractExtension` in the `src/Twig` folder of your
application. You can have as many extensions as you want but in an application, you would typically only use a single
`AppExtension`. Then, override the `getFilters()` function and register a new filter:

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
            // Register a new filter named "rot13" and tell Twig which method to execute
            new TwigFilter('rot13', [$this, 'rotateString']),
        ];
    }

    // The first argument ($value) is the string, the filter is applied on
    public function rotateString(string $value): string
    {
        return str_rot13($value);
    }
}
```

And… that's all there is to it. Our filter is now ready and can be used in **any** template:
```twig
{% set secret_cms = 'Pbagnb' %}

Turns out "{{ secret_cms }}" means "{{ secret_cms|rot13 }}".

{# Turns out "Pbagnb" means "Contao". #}
```
{{% /example %}}


[Twig Docs]: https://twig.symfony.com/doc/3.x/
[Twig Template Designers Docs]: https://twig.symfony.com/doc/3.x/templates.html
[Twig Filters]: https://twig.symfony.com/doc/3.x/filters/index.html
[Extending Twig Docs]: https://twig.symfony.com/doc/3.x/advanced.html#extending-twig
[Twig Functions]: https://twig.symfony.com/doc/3.x/functions/index.html
[TwigExtra]: https://github.com/twigphp/Twig/tree/3.x/extra
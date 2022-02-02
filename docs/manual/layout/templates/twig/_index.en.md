---
title: "Twig templates"
description: "Overview Twig templates."
aliases:
    - /en/layout/templates/twig/
weight: 15
---


{{< version "4.12" >}}

{{% notice warning %}}
Twig support is currently *experimental* and therefore not covered by Contao's BC promise. Classes marked with `@experimental` should be 
considered internal for now. Although not likely, there could also be some behavioral changes, so be prepared. 
{{% /notice %}}

Twig is Symfony’s default way to write templates. It’s fast, safe and easily extensible. Contrary to PHP templates, Twig templates won’t 
contain business logic which allows to share them more easily between designers and programmers. 

{{% children %}}


## Getting started with Twig

If you're already familiar with Twig, you might want to skip this step.

Twig templates have their own syntax, but don't be afraid, you'll quickly
find your way. Switch between the following tabs to see how an example PHP
template would translate to an analog Twig template:

{{< tabs groupId="twig">}}
{{% tab name="PHP" %}}
```html
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


### Learning the syntax

To output variables wrap their name in curly braces `{{ foo }}`, to use keywords
like `for` wrap them in `{%` and `%}`, to further process any output, use [filters](https://twig.symfony.com/doc/3.x/filters/index.html)
`|foo` and [functions](https://twig.symfony.com/doc/3.x/functions/index.html) `bar()`.

Twig is very [well documented](https://twig.symfony.com/doc/3.x/) - a good place to start is the
[Twig for template designers](https://twig.symfony.com/doc/3.x/templates.html) section that covers syntax
details as well as helpful IDE plugins for autocompletion and syntax highlighting. For quickly trying something out, you can 
use [Twig fiddle](https://twigfiddle.com/).
---
title: "Twig syntax"
description: "Syntax of Twig."
url: "layout/templates/twig/syntax"
weight: 20
---

Twig templates have their own syntax. We present here only the most important rules necessary for a basic understanding
of Twig.

{{% notice info %}}
The Twig syntax is [well documented](https://twig.symfony.com/doc/3.x/). As a starting point the
section [Twig for template designers](https://twig.symfony.com/doc/3.x/templates.html) is recommended.
{{% /notice %}}


## Identifier

In Twig, the following three identifiers are used.

* `{# ... #}` - [Comments](#comments)
* `{{ ... }}` - [Output of variable](#output-of-variables)
* `{% ... %}` - [Commands and control structures](#commands-and-control-structures)


### Comments

A comment can be single-line or multi-line. Everything between `{#` and `#}` is commented out.

{{% example "Single-line comment" %}}
```twig
{# my comment #}
```
{{% /example %}}

It is also possible to comment out parts of the code.

{{% example "Multiline comment with commented out code" %}}
```twig
{# commented out code - the code will not be executed
{{ variable }}
#}
```
{{% /example %}}


### Output of variables

You can output a variable with `{{ name_of_variable }}`.

{{% example "Output of a variable" %}}
```twig
<p>output: {{ name_of_variable }} </p>
```
{{% /example %}}


### Commands and control structures

In the broadest sense, this refers to everything that is connected with control when variables are output.
is connected.   
Only the most common ones are presented here, which are also often used in Contao templates.


#### If query

When you want certain output to occur only when a condition is met, you use the If query.

{{% example "If query" %}}
```twig
{% if my_variable %}
<p>The variable has the following content:</p>
<p>{{ my_variable }}</p>
{% endif %}
```
{{% /example %}}


#### For loop

A For loop is used to execute code repeatedly. A typical application example is the
output of the contents of an array.

{{% example "For loop" %}}
```twig
<ul>
    {% for item in items %}
        <li>{{ item }}</li>
    {% endfor %}
</ul>
```
{{% /example %}}


### Filter

Filters are applied to variables. They specify how a variable should be processed.

{{% example "filter" %}}
```twig
{{name of variable|name_of_filter }}
```
{{% /example %}}

Filters in Twig are extremely powerful and versatile. Twig brings many
[Filters](https://twig.symfony.com/doc/3.x/filters/index.html) out of the box. Developers can also create their own
create their own filters.  
If you are interested in creating your own filters please have a look at the
[Developer Documentation](https://docs.contao.org/dev/framework/templates/getting-started/#extending-twig).

{{% notice tip %}}
Do you want to try something? You can use [Twig fiddle](https://twigfiddle.com/) for that.
{{% /notice %}}

---
title: attrs - Twig Function
linkTitle: attrs
description: "Use the attrs() Twig function to fluently manage HTML attributes using the HtmlAttributes class."
tags: [Twig]
---

The `attrs()` function in Twig gives you access to a powerful utility class called `HtmlAttributes`, which provides a
fluent, expressive, and safe way to manipulate HTML attributes directly within your templates.

This function returns a `HtmlAttributes` object that can be chained to construct complex attribute sets — with full 
support for conditional logic, class and style manipulation, JSON serialization, and more.

## Basic Usage

```twig
{% set block_attributes = attrs()
    .addClass('my-div')
    .addClass(cssClasses|default([]))
%}
<div{{ block_attributes }}>
```

This would render something like (assuming `cssClasses = ['extra-class', 'another-class']`):

```html
<div class="my-div extra-class another-class">
```

## Features of `HtmlAttributes`

Add and remove CSS classes:

```twig
attrs().addClass('foo')                  {# <div class="foo"> #}
attrs().addClass(['foo', 'bar'])         {# <div class="foo bar"> #}
attrs().removeClass('foo')               {# Removes class 'foo' if present #}
```

Supports conditional addition:

```twig
attrs().addClass('admin', isAdmin)       {# Only adds if isAdmin is truthy #}
```

Add and remove styles

```twig
attrs().addStyle('color: red')                          {# <div style="color: red;"> #}
attrs().addStyle({'color': 'red', 'margin': '1em'})
attrs().removeStyle('color')                            {# Removes just the color style #}
```

Set and unset arbitrary attributes:

```twig
attrs().set('id', 'my-id')               {# <div id="my-id"> #}
attrs().set('data-foo', 'bar')           {# <div data-foo="bar"> #}
attrs().unset('id')                      {# Removes the 'id' attribute #}
```

Attributes can be merged from strings, arrays, or other `HtmlAttributes` instances:

```twig
attrs().mergeWith('disabled hidden')              {# <div disabled hidden> #}
attrs().mergeWith({'aria-label': 'Close'})        {# <div aria-label="Close"> #}
```

You can also conditionally set a value, which is very useful so you don't have to wrap your statements into `{% if`
statements:

```twig
attrs().set('disabled', true, isDisabled)       {# Only if isDisabled is true #}
attrs().setIfExists('title', maybeTitle)        {# Only sets if maybeTitle is truthy #}
```


## Adding and removing list values

{{< version "6.1" >}}

Use `add()` and `remove()` to modify individual values in a list-valued attribute, such as `data-controller`,
without replacing the entire attribute with `set()` or removing it with `unset()`.
Both methods accept a string or an array of values and return the attribute object for further chaining.

```twig
<div{{ attrs()
    .add('data-controller', 'foo')
    .add('data-controller', ['bar', 'baz'])
    .remove('data-controller', 'bar') }}>
```

This renders:

```html
<div data-controller="foo baz">
```

`add()` appends values without removing duplicates. `remove()` removes all occurrences of the specified whole
list items, not substrings, and unsets the attribute if no values remain. Empty strings, empty arrays and `null`
do not change the attribute.

The separator is selected by attribute name:

| Attributes | Separator |
| --- | --- |
| `accept`, `exportparts`, `imagesizes`, `imagesrcset`, `media`, `sizes`, `srcset` | Comma followed by a space (`, `) |
| `allow`, `csp` | Semicolon followed by a space (`; `) |
| `coords` | Comma (`,`) |
| Other attributes, e.g. `data-controller`, `rel`, `aria-describedby` | Single space (` `) |

For `class` and `style`, the methods use the existing class and style helpers instead. For example,
`add('class', 'foo')` behaves like `addClass('foo')`, including duplicate removal, and
`remove('style', 'color')` behaves like `removeStyle('color')`.

The optional third argument is a condition. If it is falsy, the operation is skipped. The optional fourth argument
overrides the separator:

```twig
{% set attributes = attrs()
    .add('data-controller', 'details', showDetails)
    .remove('data-controller', 'preview', not showPreview)
    .add('accept', ['image/png', 'image/jpeg'])
    .add('data-tags', ['news', 'events'], true, ', ')
    .remove('data-tags', 'news', true, ', ')
%}
```

When removing values with a separator such as `, `, whitespace around the comma is ignored. Supply the same
custom separator to both `add()` and `remove()` when modifying a custom list format.


## Modifying attributes from a parent template

{{< version "6.1" >}}

`attrs()` returns a `RecordingHtmlAttributes` instance, a subclass of `HtmlAttributes` that records operations.
When merged into another attribute object, these operations are applied in their original order to the target
attributes. This allows a child template to add or remove list items defined by its parent.

```twig
{# Parent template #}
{% set attributes = attrs()
    .addClass('wrap')
    .add('data-controller', 'foo bar')
    .mergeWith(attributes|default)
%}
<div{{ attributes }}>
```

```twig
{# Child template extending the parent template #}
{% extends 'parent.html.twig' %}
{% set attributes = attrs()
    .removeClass('wrap')
    .remove('data-controller', 'foo')
    .add('data-controller', 'baz')
    .mergeWith(attributes|default)
%}
```

The resulting opening tag is `<div data-controller="bar baz">`.

See also the [set and merge pattern]({{% relref "framework/templates/creating-templates#html-attributes" %}}).


## Examples

What about a dynamic button?

```twig
<button{{ attrs()
    .addClass(['btn', 'btn-primary'])
    .set('disabled', true, not isActive)
    .set('type', 'submit') }}>
    Save
</button>
```

Inline styles with conditions?

```twig
<div{{ attrs()
    .addStyle({'background': bgColor})
    .addStyle('border: 1px solid red;', hasError) }}>
    Content
</div>
```

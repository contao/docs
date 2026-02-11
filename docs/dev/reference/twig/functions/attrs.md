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

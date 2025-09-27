---
title: slot - Twig Function
linkTitle: slot
description: Defines layout sections with optional default content 
tags: [Twig]
---

{{< version "5.6" >}}

The `slot` tag allows you to define layout sections for composed content. When selecting a layout template with slots, the respective layout will offer to place content elements or modules in said slots. This also affects the "layout section" property of articles in pages using the same layout.

## Defining slots

To define a slot with name `main`, add the following to your template - when content was defined for the slot, it will get output at this place:
```twig
{% slot main %}{% endslot %}
```

Alternatively, slots can provide additional markup, which is only output if non-empty content was set. To define the place the content will get inserted, use the `slot()` function:
```twig
{% slot main %}
  <main>{{ slot() }}</main>
{% endslot %}
```

If you want to define fallback content you can use an *else* statement similar to the `for` tag:
```twig
{% slot main %}
  […]
{% else %}
  This will get output, when the slot is empty.
{% endslot %}
```

## Assigning slots
Use the `setSlot` function on a `LayoutTemplate` to define content for slots:

```php
/** @var \Contao\CoreBundle\Twig\LayoutTemplate $template */
$template->setSlot('main', 'Trusted content for the <b>main</b> block.');
```

{{% notice warning %}}
Slot content is implicitly trusted by design. Make sure the defined content is properly encoded for the context the slot is placed in (e.g. by having it be the rendered output of another template with the same output context).
{{% /notice %}}

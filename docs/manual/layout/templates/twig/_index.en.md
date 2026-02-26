---
title: "Twig templates"
description: "Overview of Twig templates."
url: "layout/templates/twig"
weight: 10
tags: [Twig]
---

{{% notice note %}}
This entire section covers the use of Twig templates in Contao since version 5.0.  
Although Twig templates can be used in Contao since version 4.12, Twig templates are only used in Contao core since
Contao 5.0. We did not document the different use of Twig templates in older versions in the manual.
{{% /notice %}}

Twig is a template engine for PHP and the default template engine of Symfony. It is fast, secure and easily extensible.  
With Twig templates, design can be strictly separated from programming.

Like a PHP template, a Twig template is used to output a module, content element, form, or other component.

{{% notice info %}}
Twig templates consistently rely on the powerful template structuring and reuse methods, such as
[Extend](reuse/#extend),
[Include](https://docs.contao.org/dev/framework/templates/creating-templates/#includes),
[Embed](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds),
[Horizontal reuse](reuse/#horizontal-reuse) or
[Macros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros).
Therefore, templates should no longer be completely overwritten, as was often common or necessary with PHP templates.   
Within the manual, we will only cover the most important technique - extending Twig templates for Contao in more detail.
More information about Twig templates in Contao can be found in the
[developer documentation](https://docs.contao.org/dev/framework/templates/).
{{% /notice %}}

{{% children %}}


## Twig templates in Contao core

{{< version-tag "5.7" >}} Every `.html5` template has a Twig equivalent. Twig is now the new standard and
fully replaces the HTML5 templates.

By default, the Twig version of a template is always used. However, if a `.html5` template with the same
name exists in your `templates` directory, it takes precedence over the Twig template.

**Example:** `news_full.html.twig` is used as long as no `news_full.html5` exists in the `templates` folder.

For a transition period, you can still fall back to PHP templates. Information on using the legacy
content elements (`ce_*.html5`) can be found in the
[upgrade instructions](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements).

{{% notice warning %}}
We strongly recommend avoiding HTML5 templates and the legacy content elements (prefix `ce_`).
Use this option only in exceptional cases, e.g. to have more time for the necessary adjustments
after an upgrade to Contao 5.
Keep in mind that extensions for Contao 5 may no longer support the use of PHP templates.
{{% /notice %}}


## File extensions

Twig templates have the file extension `.twig`. Additionally, the output type is specified.
For an HTML output, the file extension `.html.twig` is used.

---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/twig/template-data/
weight: 60
---


To see what data is a available in a template (we call it the "context"), you can use the `dump()` function. If you only want to 
know more about a specific part of the context, you can pass it as an argument:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

	{% set varA = 'My first <br> Text' %}
	{% set varB = 'My second Text' %}

	{{ dump(varA, varB) }}

	{% set myDebugBlock %}{{ text|insert_tag_raw }}{% endset %}

	{{ dump(myDebugBlock) }}

	{{ dump() }}

{% endblock %}
```

{{% notice info %}}
Because the dumped data can contain security critical information about your system, it is only possible while the 
[debug mode](/en/system/debug-mode/) is enabled.
{{% /notice %}}


## Command Line

On the command line, you can use the command `vendor/bin/contao-console list debug` to find two useful commands:


### debug:contao-twig

You can use the command `vendor/bin/contao-console debug:contao-twig` to find out which templates are available 
and used in the system. By passing a template name prefix as argument you can filter for certain groups: e.g. 
`vendor/bin/contao-console debug:contao-twig content_element/h` will show the `headline` as well as `html` content element templates (and others). 

{{% notice note %}}
Since Contao 5.0.2 there is also a `--tree` option that displays the templates in tree form following the directory structure. This is 
especially helpful when dealing with variant templates that reside in sub directories, like `content_element/text/special.html.twig` 
or `content_element/text/info.html.twig`. Filtering for `content_element/text` then neatly groups the `special` and `info` variant under 
the default `text` template.
{{% /notice %}}


### debug:twig

The command `vendor/bin/contao-console debug:twig` shows you, among other things, a list of available Twig functions and filters.

{{% notice tip %}}
For each command you can get details about the available options by specifying `--help`. Both commands support the `--env` option to 
take the environment into account : `prod` (default setting) or `dev`.
{{% /notice %}}
---
title: "Template mischen"
description: "Ein Template mischen."
url: "layout/templates/twig/einfuegen"
aliases:
    - /de/layout/templates/twig/einfuegen/
weight: 110
---


Ein Template kann in ein anderes Template über die Twig [include](https://twig.symfony.com/doc/3.x/tags/include.html) Angabe eingefügt werden. 
Wir erstellen ein Template `_copyright.html.twig`:

```twig
{# /templates/_copyright.html.twig #}

<small>Fotografiert von {{ name }}, lizenziert als {{ license }}.</small>
```

Dieses Template kann beliebig oft verwendet werden. Als Beispiel für ein Inhaltselement vom Typ »Bild«:


{{< tabs groupId="sample_a" >}}

{{% tab name="Contao 4.13" %}}

```twig
{# /templates/ce_image.html.twig #}

{% extends '@Contao/ce_image' %}

{% block content %}
  {{ parent() }}
  
  {% include '@Contao/_copyright.html.twig' with {name: 'Dona Evans', license: 'Creative Commons'} only %}

{% endblock %}
```

{{% /tab %}}

{{% tab name="Contao 5.0" %}}

```twig
{# /templates/content_element/image.html.twig #}

{% extends "@Contao/content_element/image.html.twig" %}

{% block content %}
  {{ parent() }}
  
  {% include '@Contao/_copyright.html.twig' with {name: 'Dona Evans', license: 'Creative Commons'} only %}

{% endblock %}
```

{{% /tab %}}

{{< /tabs >}}

{{% notice tip %}}
Als Alternative zum obigen Beispiel könntest du hier auch die Twig Funktion [include()](https://twig.symfony.com/doc/3.x/functions/include.html) 
verwenden: `{{ include('@Contao/_copyright.html.twig', {name: 'Dona Evans', license: 'Creative Commons'}) }}`.
{{% /notice %}}
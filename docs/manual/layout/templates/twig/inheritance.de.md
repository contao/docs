---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/twig/vererbung"
aliases:
    - /de/layout/templates/twig/vererbung/
weight: 100
---


Du kannst ein Twig Template nicht nur komplett überschreiben, sondern auch gezielt einzelne Teilbereiche (Blöcke) updatesicher erweitern. 

Um ein bestehendes Template zu erweitern (anstatt diese komplett zu ersetzen), verwende Twig 
[extends](https://twig.symfony.com/doc/3.x/tags/extends.html). Anzupassende Blöcke können dann angegeben, die bestehenden Inhalte 
mittels `{{ parent() }}` übernommen und mit zusätzlichen Angaben erweitert werden. 


{{< tabs groupId="sample_a" >}}

{{% tab name="Contao 4.13" %}}

```twig
{# /templates/ce_text.html.twig #}

{% extends '@Contao/ce_text' %}

{% block content %}
  {{ parent() }}
  
  <p>Mein zusätzlicher Inhalt.</p>
{% endblock %}
```

{{% /tab %}}

{{% tab name="Contao 5.0" %}}

```twig
{# /templates/content_element/text.html.twig #}

{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}
  {{ parent() }}
  
  <p>Mein zusätzlicher Inhalt.</p>
{% endblock %}
```

{{% /tab %}}

{{< /tabs >}}
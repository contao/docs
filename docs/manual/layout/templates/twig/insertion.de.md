---
title: "Template mischen"
description: "Ein Template mischen."
url: "layout/templates/twig/insertion"
aliases:
    - /de/layout/templates/twig/insertion/
weight: 50
---


Ein Template kann in ein anderes Template eingefügt werden. Wir erstellen ein Template `image_copyright.html.twig` mit folgendem Inhalt:

```twig
{# /templates/image_copyright.html.twig #}

<small>Fotografiert von {{ name }}, lizenziert als {{ license }}.</small>
```

Dieses Template lässt sich nun an beliebiger Stelle wiederverwenden. Hier fügen wir z.&nbsp;B. dem `content` Block des
`ce_image.html.twig` Templates unseren Copyright-Hinweis (`image_copyright.html.twig`) hinzu:


```twig
{# templates/ce_image.html.twig #}

{% extends '@Contao/ce_image' %}

{% block content %}
    {{ parent() }}
    
    {% include 'image_copyright.html.twig' with {name: 'Dona Evans A', license: 'Creative Commons B'} only %}

{% endblock %}
```

### Ausgabe

Wird das Template ausgegeben, erscheint nun unter dem Bild:

```html
Fotografiert von Donna Evans, lizenziert als Creative Commons.
```
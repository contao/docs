---
title: "Template mischen"
description: "Ein Template mischen."
url: "layout/templates/insertion"
aliases:
    - /de/layout/templates/insertion/
weight: 40
---


Ein Template kann in ein anderes Template eingefügt werden. 


{{< tabs groupId="templateGroup">}}
{{% tab name="PHP" %}}


Mit Hilfe der `insert()`-Funktion kann ein Template in ein anderes Template eingefügt werden. Die Funktion akzeptiert 
die Übergabe von Variablen als optionalen zweiten Parameter.

```php
<?php $this->insert('template_name', array('key'=>'value')); ?>

<?php // Übergibt alle Variablen aus dem aktuellen Template ?>
<?php $this->insert('template_name', $this->getData()); ?>
```

Wir erstellen ein Template `image_copyright.html5` mit folgendem Inhalt:

```php
<?php // image_copyright.html5 ?>

<small>Fotografiert von <?php echo $this->name; ?>, lizenziert als <?php echo $this->license; ?>.</small>
```

Dieses Template lässt sich nun an beliebiger Stelle wiederverwenden. Hier fügen wir z.&nbsp;B. dem `content` Block des
`ce_image.html5` Templates unseren Copyright-Hinweis (`image_copyright.html5`) hinzu:

```php
<?php // ce_image_copyright.html5 ?>

<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>
  
  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```


{{% /tab %}}
{{% tab name="Twig" %}}



{{< version "4.12" >}}

Wir erstellen ein Template `image_copyright.html.twig` mit folgendem Inhalt:

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

{{% notice info %}}
Twig-Vorlagen befinden sich in Namespaces wie »@Contao_Global/ce_text.html.twig (/templates Verzeichnis)«. Weitere 
Informationen zu verfügbaren Namespaces findest du [hier](https://docs.contao.org/dev/framework/templates/twig/#namespace-magic).
{{% /notice %}}


{{% /tab %}}
{{< /tabs >}}


### Ausgabe

Wird das Template ausgegeben, erscheint nun unter dem Bild:

```html
Fotografiert von Donna Evans, lizenziert als Creative Commons.
```

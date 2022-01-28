---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/vererbung"
aliases:
    - /de/layout/templates/vererbung/
weight: 30
---


Contao erlaubt das Vererben von Templates. Dabei wird ein Template nicht komplett überschrieben, sondern nur gezielt
einzelne Teilbereiche (Blöcke) angepasst. 


### Blöcke anpassen

Zur Gliederung umschließen viele Templates ihre Inhalte bereits in Teilbereiche (Blöcke). 
Nur Inhalte, die in solchen Blöcken liegen, können angepasst werden.


{{< tabs groupId="templateGroup">}}
{{% tab name="PHP" %}}


Zur Gliederung umschließen viele Templates ihre Inhalte bereits in `$this->block('name-des-blocks')` und
`$this->endblock()` Ausdrücke. Nur Inhalte, die in solchen Blöcken liegen, können angepasst werden.

Zunächst muss das Basis-Template mittels `$this->extend('name-des-templates')` angegeben werden. Anzupassende Blöcke
können dann, wie im originalen Template, durch Einschließen in `$this->block('name-des-blocks')` und `$this->endblock()`
angegeben und ihre Inhalte überschrieben werden.

Mittels `$this->parent()` lässt sich der originale Inhalt des Blocks ausgeben.


```html
<!-- templates/fe_page.html5 -->

<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>
  
  <meta name="author" content="Max Muster">
<?php $this->endblock(); ?>
```


{{% /tab %}}
{{% tab name="Twig" %}}


{{< version "4.12" >}}

Zunächst muss das Basis-Template mittels `{% extends '@Contao/fe_page' %}` angegeben werden. Anzupassende Blöcke
können dann, wie im originalen Template, durch Einschließen in `{% block name-des-blocks %}` 
und `{% endblock %}` angegeben und ihre Inhalte überschrieben werden.

Mittels `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.


```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block meta %}
  {{ parent() }}

  <meta name="author" content="Max Muster">
{% endblock %}
```

{{% notice info %}}
Twig-Vorlagen befinden sich in Namespaces wie »@Contao_Global/ce_text.html.twig (/templates Verzeichnis)«. Weitere 
Informationen zu verfügbaren Namespaces findest du [hier](https://docs.contao.org/dev/framework/templates/twig/#namespace-magic).
{{% /notice %}}


{{% /tab %}}
{{< /tabs >}}
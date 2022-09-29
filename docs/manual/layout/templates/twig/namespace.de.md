---
title: "Namensräume"
description: "Namensräume für Twig-Templates."
url: "layout/templates/twig/namespace"
aliases:
    - /de/layout/templates/twig/namespace/
weight: 80
---


Der vollständige Name eines Templates in Twig enthält einen »Namensraum«. Und ein »Namensraum« könnte 
so `@ContaoCore/Image/Studio/figure.html.twig` aussehen.

Die Contao Templates befinden sich alle im `@Contao` Namensraum, deshalb lautet zum Beispiel der »vollqualifizierte Template Name« 
des Inhaltselements vom Typ »Text« `@Contao/content_element/text.html.twig` und kann daher mit `{% extends "@Contao/content_element/text.html.twig" %}`
erweitert werden.

Der `@Contao`-Namensraum ist ein »verwalteter Namensraum« und hat im Gegensatz zu Standard-Twig eine Besonderheit: Das gleiche Template kann 
aus verschiedenen Quellen erweitert werden. Auf diese Weise kann eine Erweiterung z. B. eine neue Funktion zu einem Kern-Template hinzufügen 
und du kannst diese dann anpassen. 


{{% notice tip %}}
Du kannst auf der Konsole `contao-console debug:contao-twig` ausführen, um eine Liste aller registrierten Namensräume zu erhalten.
{{% /notice %}}


## Hierarchie Beispiel

In diesem Beispiel haben wir es mit vier Manifestationen der gleichen Vorlage `card.html.twig` zu tun.

{{< tabs groupId="template-hierarchy-example">}}
{{% tab name="a) card-bundle" %}}
Die ursprüngliche Vorlage `card-bundle`:

```twig
{# /vendor/foo/card-bundle/contao/templates/card.html.twig #}

{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  {% block card %}
    <header class="title">
      {% block title %}{{ title }}{% endblock %}
    </header>     
    <main>
      {% block content %}
        {{ studio.figure(figure) }}
        {{ description|raw }}
      {% endblock %}
    </main>
    <footer>
      {% block footer %}<p class="author">by {{ author }}</p>{% endblock %}
    </footer
  {% endblock %}
</section>
```
{{% /tab %}}

{{% tab name="b) card-time-bundle" %}} 
Ein `card-time-bundle`, das das Original erweitert und Informationen in der Fußzeile hinzufügt.
Dieses Bundle wurde *nach* dem `card-bundle` geladen, daher ist es weiter oben in unserer Vorlagen-Hierarchie:

```twig
{# /vendor/bar/card-time-bundle/contao/templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block footer %}
  {{ parent() }}
  <p class="last-modified">edited at {{ modified_at|ago }}</p>
{% endblock %}
```
{{% /tab %}}

{{% tab name="c) global template" %}}
Die `card` Vorlage des globalen Vorlagen Ordners, die einige Wrapper hinzufügt, denn man kann nicht genug *Divs* haben.

```twig
{# /templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block title %}<div class="inner">{{ parent() }}</div>{% endblock %}
{% block card %}<div class="inner">{{ parent() }}</div>{% endblock %}
```
{{% /tab %}}

{{% tab name="d) emoji theme" %}}
Und schließlich das "Emoji"-Thema der Anwendung.

```twig
{# /templates/emoji/card.html.twig #}
   
{% extends '@Contao/card' %}

{% block title %}🤩 {{ parent() }} 🤯{% endblock %}
```
{{% /tab %}}
{{< /tabs >}}

Wenn man alles in der richtigen Reihenfolge auflöst, erhält man die folgende Vorlage. Beachte, dass jede Stufe Blöcke anpassen/mitgestalten 
kann ohne die anderen kennen zu müssen, denn es wird der verwaltete `@Contao`-Namensraum verwendet:


```twig
{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  <div class="inner">
    <header class="title">
      🤩 <div class="inner">{{ title }}</div> 🤯
    </header>     
    <main>
      {{ studio.figure(figure) }}
      {{ description|raw }}
    </main>
    <footer>
     <p class="author">by {{ author }}</p>
     <p class="last-modified">edited at {{ modified_at|ago }}</p>
    </footer
  </div>>
</section>
```

{{% notice note %}}
Beim Erweitern, Einfügen oder Einbetten von Vorlagen aus dem `@Contao`-Namensraum, wird die Dateierweiterung nicht berücksichtigt. 
Das bedeutet, dass `@Contao/card.html.twig` auf die gleiche Vorlage zeigt wie `@Contao/card.html5`. Aus diesem Grund kannst du die 
Dateierweiterung in diesem Fall komplett weglassen.
{{% /notice %}}
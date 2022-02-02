---
title: "Namensräume"
description: "Namensräume für Twig-Templates."
url: "layout/templates/twig/namespace"
aliases:
    - /de/layout/templates/twig/namespace/
weight: 80
---


Twig-Vorlagen existieren in Namensräumen wie `@Foo/my_template.html.twig` (*Foo*) oder
`@ContaoCore/Image/Studio/figure.html.twig` (*ContaoCore*). Contao registriert automatisch die Vorlagen aus den verschiedenen 
Verzeichnissen in ihren jeweiligen Namensräumen:


| Verzeichnis | Namensraum | | Prio.<sup>*</sup>
|-|-|-|-|
| `/vendor/…/templates`<br>`/vendor/foo/bar/contao/templates` | `@Contao_<bundle>`<br>`@Contao_FooBarBundle` | Jedes Bundle-Vorlagen/Views-Verzeichnis. | 1 |
| `/contao/templates`<br>`/src/Resources/contao/templates`<br>`/app/Resources/contao/templates` | `@Contao_App` | Vorlagen-Verzeichnis der Anwendung. | 2 |
| `/templates` | `@Contao_Global` | Globales Vorlagen-Verzeichnis. | 3 |
| `/templates/<theme>`<br>`/templates/foo/theme` | `@Contao_Theme_<theme>`<br>`@Contao_Theme_foo_theme` | Ein beliebiges Theme-Verzeichnis. Der Pfad (`foo/theme`) wird in einen Slug (`foo_theme`) umgewandelt und als Suffix angehängt. | 4 |

<sup>* Höhere Prioritätswerte bedeuten "Zuerst als Vorlagenkandidat betrachten".</sup>

{{% notice note %}}
Du kannst auf der Konsole `contao-console debug:contao-twig` ausführen, um eine Liste aller registrierten Namensräume zu erhalten. Wenn du auch Theme-Vorlagen auflisten möchtest, füge die Option `-t` mit dem Pfad oder Slug des Themes hinzu. Um nach bestimmten Vorlagen zu filtern, gebe deren Namen oder Präfix als Argument an, z. B.: `contao-console debug:contao-twig ce_text -t my/theme`.
{{% /notice %}}

Darüber hinaus existiert ein **verwalteter `@Contao`-Namensraum**, den du verwenden solltest, wenn du den genauen Namensraum nicht kennst. 
Dieser Namensraum wird beim Kompilieren der Templates durch einen bestimmten Namensraum ersetzt. In jeder Situation wählen wir die **nächste verfügbare** Vorlage, die eine **niedrigere Priorität** hat als die aktuelle.

Du könntest dies durchaus zum Erweitern, Einbetten oder Einfügen von Vorlagen verwenden. Schau dir das folgende Beispiel an.


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
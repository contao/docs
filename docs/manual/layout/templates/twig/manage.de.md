---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
    - /de/layout/templates/twig/verwaltung/
weight: 20
---


Twig-Templates werden gegenüber den bisherigen PHP-Templates anders gekennzeichnet: (`.html.twig` statt `.html5`).

{{% notice tip %}}
Contao 5 beinhaltet fertige Twig Templates und diese werden favorisiert. Du kannst aber auch weitehin die entsprechenden PHP-Templates gezielt
aktivieren und nutzen. Weitere Informationen hierzu findest du [hier](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements).
{{% /notice %}}


## Templates erstellen

{{< tabs groupId="creation">}}

{{% tab name="Ab Contao 4.13.10" %}}

Fertige Twig Temlates sind in dieser Version nicht vorhanden und können auch nicht über das Backend erstellt werden. Du mußt dazu 
im Verzeichnis `templates` eine Datei, z. B. `ce_text.html.twig`, manuell anlegen. Dieses Twig Template wird anschließend im Backend
angezeigt (könnte hier kopiert und umbenannt werden) und steht dann im jeweiligen Inhaltselement als Auswahl zur Verfügung.

Es ist möglich, bestehende PHP-Templates aus den Twig-Templates heraus zu erweitern. Lege dir z. B. eine `fe_page.html.twig` in deinem 
Template-Verzeichnis an. In diesem Beispiel wird eine Überschrift über dem Hauptabschnitt hinzugefügt und alles andere bleibt gleich:

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

{{% notice info %}}
Es kann entweder **eine** Twig- **oder** eine PHP-Variante des gleichen Templates am gleichen Ort geben. Du kannst Twig-Templates 
nicht aus PHP-Templates heraus erweitern, nur umgekehrt.
{{% /notice %}}

{{% /tab %}}

{{% tab name="Ab Contao 5.0.2" %}}

Diese Version beinhaltet fertige Twig Templates und diese können über das Backend, zwecks Anpassung, ausgewählt und erstellt werden. 
Die entsprechenden Templates werden standardmäßig erweitert und die jeweiligen Abschnitte können dann überschrieben werden. 
Du kannst hier aber auch beliebigen, eigenen Code eintragen. 

Ein Beispiel für das Inhaltselement »Text«:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{#
  ** Add changes to the base template here. **

  Hint: Try adjusting blocks and attributes instead of
  overwriting the whole template. This way your version
  can remain compatible with future changes to the base
  template as well as adjustments made by extensions.

  Currently available blocks:
    "picture_component", "image", "sources", "source",
    "schema_org", "figure_component", "media",
    "media_link", "caption", "caption_inner",
    "content", "text_media", "text",
    "text_attributes", "headline_component",
    "headline_attributes", "headline_inner",
    "wrapper", "wrapper_tag", "attributes", "inner"

  Example:
    {% block picture_component %}
       {{ parent() }}
       My additional content for 'picture_component'…
    {% endblock %}
#}
```

{{% notice note %}}
Eventuell steht noch nicht für jedes Modul/Inhaltselement ein Twig Template zur Verfügung. In diesen Fällen werden weiterhin die 
bisherigen (PHP/Legacy) Templates herangezogen.
{{% /notice %}}

{{% /tab %}}

{{< /tabs >}}


## Template Varianten

{{< tabs groupId="variant">}}

{{% tab name="Ab Contao 4.13.10" %}}

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement (**c**ontent **e**lement) hin. Möchte man z. B. die Ausgabe des Inhaltselements vom Typ »Text« ändern, kann man 
das Template `ce_text.html.twig` hierzu verwenden. In diesem Fall haben die Template-Änderungen Auswirkung auf alle 
Inhaltselemente vom Typ »Text«. 

Dies ist nicht immer erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die 
jeweils vorgegebene Template-Bezeichnung beibehalten und lediglich erweitert werden: 

Du kannst demnach z. B. `ce_text.html.twig` umbenennen nach `ce_text_individuell.html.twig`. Dieses Template kann dann gezielt zur Ausgabe 
für ein (o. mehrere) Inhaltselement(e) vom Typ »Text« genutzt werden.

{{% /tab %}}

{{% tab name="Ab Contao 5.0.2" %}}

Möchstest du eine oder mehrere Varianten zu einem Template anbieten, die im Backend ausgewählt werden können, so erstelle einen Unterordner analog 
zum Dateinamen des Templates und lege die angepasste Datei darin ab. 

Beispiel: Eine Text-Variante `highlight` zu `content_element/text.html.twig` legst du unter `content_element/text/highlight.html.twig` ab. 
Diese ist dann als individuelles Template `content_element/text/highlight` zur Auswahl im Inhaltselement verfügbar. 

{{% /tab %}}

{{< /tabs >}}
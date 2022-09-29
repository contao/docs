---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
    - /de/layout/templates/twig/verwaltung/
weight: 20
---


Twig-Templates werden gegenüber den bisherigen PHP-Templates anders gekennzeichnet: (`.html.twig` statt `.html5`).

{{% notice info %}}
Zm Wechsel auf Contao 5 solltest du zuvor die [Upgrade-Anleitung](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements) 
lesen. Viele Elemente wurden umgeschrieben und verfügen nun über neue Vorlagen, aber es gibt eine Möglichkeit, diese schrittweise zu aktivieren, 
um mehr Zeit für die Überarbeitung zu ermöglichen.
{{% /notice %}}


## Templates erstellen

{{< tabs groupId="creation" >}}

{{% tab name="Contao 4.13" %}}

Du kannst Twig Templates verwenden, um PHP Templates zu überschreiben oder zu erweitern. Behalte den Dateinamen wie bisher bei, passe 
aber die Dateierweiterung an. Erstelle zum Beispiel eine `fe_page.html.twig` in dem `Template` Verzeichnis und füge eine weitere Überschrift 
über dem Hauptabschnitt hinzu:

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

{{% tab name="Contao 5.0" %}}

Mit Contao 5.0 haben wir begonnen, unsere Core Templates durch Twig Templates zu ersetzen. Diese neuen Templates haben nicht nur neue Funktionen, 
sondern auch die neue Verzeichnisstruktur, die du beim Überschreiben/Erweitern beachten mußt - z. B.: 
`content_element/gallery.html.twig` bedeutet eine `gallery.html.twig` Datei im Verzeichnis `content_element`.

Du kannst nun auch von bestehenden Twig Vorlagen im Abschnitt »Layout > Templates« im Backend ableiten. Dann wird automatisch 
eine `extends`-Anweisung für die Basisvorlage zusammen mit einigen erklärenden Kommentaren in die neu erstellte Datei eingefügt. Du solltest 
das Erweitern, d. h. nur die benötigten Teile anpassen, dem Überschreiben in fast allen Fällen vorziehen. Auf diese Weise bleiben Änderungen 
kompatibel.

Ein Beispiel für das Inhaltselement »Text«:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}
  {{ parent() }}
  <p>Mein zusätzlicher Inhalt.</p>
{% endblock %}
```

{{% notice note %}}
Eventuell steht noch nicht für jedes Modul/Inhaltselement ein Twig Template zur Verfügung. In diesen Fällen werden weiterhin die 
bisherigen (PHP/Legacy) Templates herangezogen.
{{% /notice %}}

{{% /tab %}}

{{< /tabs >}}


## Template Varianten

{{< tabs groupId="variant" >}}

{{% tab name="Contao 4.13" %}}

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement (**c**ontent **e**lement) hin. Möchte man z. B. die Ausgabe des Inhaltselements vom Typ »Text« ändern, kann man 
das Template `ce_text.html.twig` hierzu verwenden. In diesem Fall haben die Template-Änderungen Auswirkung auf alle 
Inhaltselemente vom Typ »Text«. 

Dies ist nicht immer erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die 
jeweils vorgegebene Template-Bezeichnung beibehalten und lediglich erweitert werden: 

Du kannst demnach z. B. `ce_text.html.twig` umbenennen nach `ce_text_individuell.html.twig`. Dieses Template kann dann gezielt zur Ausgabe 
für ein (o. mehrere) Inhaltselement(e) vom Typ »Text« genutzt werden.

{{% /tab %}}

{{% tab name="Contao 5.0" %}}

Wenn du eine oder mehrere Varianten eines Templates benötigst, die im Backend ausgewählt werden können, dann erstelle ein Unterverzeichnis 
analog zum Dateinamen des Basis Templates und lege die angepasste Datei darin ab.  

Beispiel: Du kannst eine Textvariante `highlight` unter `content_element/text/highlight.html.twig` ablegen. Im Inhaltselement vom Typ »Text« 
kann dann `content_element/text/highlight` als »Individuelle Vorlage« ausgewählt werden.

{{% /tab %}}

{{< /tabs >}}
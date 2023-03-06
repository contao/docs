---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---


{{< version "4.12" >}}

{{% notice warning %}}
Die Unterstützung von Twig ist derzeit *experimentell* und daher nicht durch das Contao BC-Versprechen abgedeckt. Klassen, die mit 
`@experimental` gekennzeichnet sind, sollten vorerst als intern betrachtet werden. Obwohl es nicht wahrscheinlich ist, könnte es auch 
einige Änderungen geben, also sei darauf vorbereitet.
{{% /notice %}}

Twig ist Symfony's Standardmethode zum Schreiben von Templates. Es ist schnell, sicher und leicht erweiterbar. Im Gegensatz zu 
PHP-Templates enthalten Twig-Templates keine Geschäftslogik, was die gemeinsame Nutzung durch Designer und Programmierer erleichtert. 
Diese Tatsache hilft, eine saubere Trennung zwischen der Präsentations- und der Daten-/Logikschicht aufrechtzuerhalten.

Twig bietet außerdem viele leistungsstarke Methoden zur Strukturierung von Vorlagen, wie z. B. das Einbinden, Vererben, Wiederverwenden 
von Blöcken oder Makros, den erleichterten Zugriff auf Objekte mit »Property Access«, verfügt über Leerzeichenkontrolle, 
String-Interpolationsfunktionen und vieles mehr.

{{% notice info %}}
Eine Auswahl vorhandener Twig-Templates, z. B. über ein Inhaltselement, ist derzeit noch nicht möglich. Die Dokumentation der Twig Nutzung in Contao wird ständig erweitert. Bis dahin findest du in [diesem Beitrag](https://docs.contao.org/dev/framework/templates/) weitere, detaillierte Informationen zum Thema.
{{% /notice %}}


## Erste Schritte

Du kannst Twig-Templates überall dort verwenden, wo du auch eine PHP-Vorlage verwenden würdest, nur mit einer anderen Dateierweiterung 
(`.html.twig` statt `.html5`). Es ist sogar möglich, PHP-Templates aus den Twig-Templates heraus zu erweitern.

Lege dir eine `fe_page.html.twig` in deinem Template-Verzeichnis an. In diesem Beispiel wird eine Überschrift über dem Hauptabschnitt 
hinzugefügt und alles andere bleibt gleich:

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

1. Benenne dein Twig-Template wie das Contao-Pendant (mit Ausnahme der Dateierweiterung) und lege dieses in einem normalen 
Contao Template Verzeichnis ab. Es kann derzeit **entweder** eine Twig- **oder** eine PHP-Variante des gleichen Templates am gleichen Ort geben.

2. Um eine bestehende Vorlage zu erweitern (anstatt diese komplett zu ersetzen), verwende das Schlüsselwort `extends` und den 
speziellen `@Contao` [Namensraum](https://docs.contao.org/dev/framework/templates/architecture/#naming-and-structure).

3. Verwende den gleichen Blocknamen wie in der ursprünglichen Vorlage.

{{% notice note %}}
Du kannst Twig-Templates nicht aus PHP-Templates heraus erweitern, nur umgekehrt.
{{% /notice %}}

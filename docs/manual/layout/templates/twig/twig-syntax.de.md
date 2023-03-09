---
title: "Twig-Syntax"
description: "Syntax von Twig."
url: "layout/templates/twig/syntax"
aliases:
    - /de/layout/templates/twig/syntax
weight: 20
---

Twig-Templates haben ihre eigene Syntax.

## Bezeichner

In Twig werden folgende drei Bezeichner verwendet
* `{# ... #}` - Kommentare
* `{{ ... }}` - Variable ausgeben
* `{% ... %}` - Kommandos und Kontrollstrukturen z. B. If-Abfragen

### Kommentare

```twig
{# mein Kommentar #}
```

Ein Kommentar kann ein- oder mehrzeilig sein. Alles was zwischen `{#` und `#}` steht, wird auskommentiert.<br>
Damit ist es auch möglich Teile des Code auszukommentieren.

```twig
{# auskommentierter Code - der Code wird nicht ausgeführt
{{ variable }}
 #}
```

### Ausgabe von Variablen
Eine Variable kannst Du mit `{{ name_der_variablen }}` ausgeben.

```twig
<p>Ausgabe: {{ name_der_variablen }} </p>
```

### If-Abfrage
Wenn bestimmte Ausgaben nur dann erfolgen sollen, wenn eine Bedingung erfüllt ist, verwendest Du die If-Abfrage.

```twig
{% if meine_variable %}
    <p>Die Variable hat folgenden Inhalt:</p>
    <p>{{ meine_variable }}</p>
{% endif %}
```


### For-Schleife
Eine For-Schleife wird verwendet, um Code wiederholt auszuführen. Ein typisches Anwendungsbeispiel ist die 
Ausgabe von Inhalte eines Arrays.

```twig
<ul>
    {% for item in items %}
        <li>{{ item }}</li>
    {% endfor %}
</ul>
```

### Filter
Filter werden auf Variable angewendet. Sie geben an wie eine Variable verarbeitet werden soll.

```twig
{{ name der variable|name_des_filters }}
```

Filter in Twig sind extrem leistungsfähig und vielseitig. Twig bringt viele 
[Filter](https://twig.symfony.com/doc/3.x/filters/index.html) von Haus aus mit. Entwickler können eigene Filter 
erstellen.<br> 
Wer sich für die Erstellung eigener Filter interessiert schaut bitte in die
[Entwicklerdoku](https://docs.contao.org/dev/framework/templates/getting-started/#extending-twig).

{{% notice info %}}
Die Twig Syntax ist [gut dokumentiert](https://twig.symfony.com/doc/3.x/). Als Startpunkt ist der
Abschnitt [Twig für Template-Designer](https://twig.symfony.com/doc/3.x/templates.html) zu empfehlen.
{{% /notice %}}

{{% notice tip %}}
Du möchtest schnell etwas ausprobieren? Dazu kannst Du [Twig fiddle](https://twigfiddle.com/) verwenden.
{{% /notice %}}

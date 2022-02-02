---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/twig/data"
aliases:
    - /de/layout/templates/twig/data/
weight: 60
---


Die verfügbaren Template-Daten variieren je nach Quelle der Vorlage. 

Innerhalb von Twig-Templates kannst du dir alle verfügbaren oder gezielt einzelne Template-Daten anzeigen lassen.
Dies funktioniert allerdings nur bei aktiviertem Debug-Modus.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```
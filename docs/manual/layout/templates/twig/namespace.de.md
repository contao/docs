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
Verzeichnissen in ihren jeweiligen Namensräumen.

Darüber hinaus existiert ein **verwalteter** `@Contao`-Namensraum, den du immer verwenden solltest, wenn du den genauen Namensraum nicht kennst. 
Detaillierte Informationen hierzu findest du in der [Entwickler Dokumentation](https://docs.contao.org/dev/framework/templates/twig/#namespace-magic).

Beim Erweitern, Einfügen oder Einbetten von Vorlagen aus dem `@Contao`-Namensraum, wird die Dateierweiterung nicht berücksichtigt. 
Das bedeutet, dass `@Contao/card.html.twig` auf die gleiche Vorlage zeigt wie `@Contao/card.html5`. Aus diesem Grund kannst du die 
Dateierweiterung in diesem Fall komplett weglassen.

{{% notice note %}}
Du kannst auf der Konsole `contao-console debug:contao-twig` ausführen, um eine Liste aller registrierten Namensräume zu erhalten. 
Wenn du auch Theme-Vorlagen auflisten möchtest, füge die Option `-t` mit dem Theme-Namen hinzu. Mit der Option `--tree` werden die 
vorhandenen Vorlagen zusätzlich sortiert und in einem Präfix-Baum angezeigt.
{{% /notice %}}
---
title: "Namensräume"
description: "Namensräume für Twig-Templates."
url: "layout/templates/twig/namespace"
aliases:
    - /de/layout/templates/twig/namespace/
weight: 80
---

In Twig existieren Templates in »Namensräumen«. Wenn du auf ein anderes Template verweisen möchtest, z. B. zwecks Erweitern/Einbinden, 
muss der »Namensraum« in den »voll qualifizierten Template Namen« aufgenommen werden..

Die Contao Templates befinden sich alle im `@Contao` Namensraum, deshalb lautet zum Beispiel der vollqualifizierte Template Name des 
Inhaltselements vom Typ »Text« `@Contao/content_element/text.html.twig` und kann daher mit `{% extends "@Contao/content_element/text.html.twig" %}`
erweitert werden.

Der `@Contao`-Namensraum ist ein »verwalteter Namensraum« und hat im Gegensatz zu Standard-Twig eine Besonderheit: Das gleiche Template kann 
aus verschiedenen Quellen erweitert werden. Auf diese Weise kann eine Erweiterung z. B. eine neue Funktion zu einem Kern-Template hinzufügen 
und du kannst diese dann anpassen.
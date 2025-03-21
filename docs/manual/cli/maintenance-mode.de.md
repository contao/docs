---
title: "contao:maintenance-mode"
description: "Back- und Frontend in den Wartungsmodus versetzten."
aliases:
    - /de/cli/maintenance-mode/
---


{{< version "4.13" >}}

Der Wartungsmodus wurde für diese Contao-Version neugeschrieben. Über die Kommandozeile kann die komplette Contao-Installation 
(Back- und Frontend) in den Wartungsmodus versetzt werden. Diese Funktion ist sehr nützlich, wenn du eine 
Aktualisierung an deinem System vornehmen möchtest.

Ausserdem hast du die Möglichkeit das Frontend für jeden 
[Startpunkt einer Website](/de/seitenstruktur/website-startseite/#website-einstellungen) in den 
Wartungsmodus zu versetzen.


```bash
php vendor/bin/contao-console contao:maintenance-mode [options] [<state>]
```

| Option                          | Beschreibung                                                                                                                                                             |
|---------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `--template=TEMPLATE`           | Ermöglicht die Verwendung eines anderen [Twig-Templates-Namens](https://docs.contao.org/dev/framework/templates/architecture/#naming-and-structure), wenn der Wartungsmodus aktiviert wird. Standard ist `@ContaoCore/Error/service_unavailable.html.twig` |
| `--templateVars[=TEMPLATEVARS]` | Füge dem Twig-Template benutzerdefinierte Template-Variablen hinzu, wenn der Wartungsmodus aktiviert wird (als JSON bereitstellen). Standard ist `{}`                    |

&nbsp;

| State                | Beschreibung                                            |
|----------------------|---------------------------------------------------------|
| `enable` oder `on`   | Versetzt die Contao-Installation in den Wartungsmodus.  |
| `disable` oder `off` | Hebt den Wartungsmodus für die Contao-Installation auf. |

{{% notice note %}}
Wie du das Wartungstemplate anpassen kannst, erfährst du in unserer [Anleitung](../../anleitungen/wartungstemplate-anpassen/).
{{% /notice %}}

{{% notice tip %}}
Der globale Wartungsmodus kann statt über das Kommando alternativ auch durch das Löschen der Datei
`var/maintenance.html` manuell deaktiviert werden. Dies kann hilfreich sein, falls das Kommando aus irgendeinem Grund
nicht funktioniert.
{{% /notice %}}

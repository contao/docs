---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/data"
aliases:
    - /de/layout/templates/data/
weight: 50
---


Die verfügbaren Template-Daten variieren je nach Quelle der Vorlage. 


{{< tabs groupId="templateGroup">}}
{{% tab name="PHP" %}}


In der Regel ist der vollständige Datensatz im Template über die Angabe von `$this->…` erreichbar.

```php
<?php $this->dumpTemplateVars() ?>
```

Die Anweisung verwendet die [Symfony VarDumper-Komponente](https://symfony.com/doc/current/components/var_dumper.html) 
zur Anzeige der Template-Daten. Im Debug-Modus wird die Ausgabe dabei an die Symfony Debug Toolbar umgeleitet.  

{{% notice info %}}
Falls du [Template-Vererbung]({{< ref "template-inheritance.de.md" >}}) nutzt, wird der Auszug der Template-Daten nur im 
[Debug-Modus]({{< ref "debug-mode.de.md" >}}) angezeigt oder wenn sich die Anweisung zwischen `$this->block(…)` und
`$this->endblock()` befindet.
{{% /notice %}}


{{% /tab %}}
{{% tab name="Twig" %}}


{{< version "4.13" >}}

Innerhalb von Twig Templates kannst du dir alle verfügbaren oder gezielt einzelne Template-Daten anzeigen lassen.
Die Ausgabe erfolgt lediglich bei aktivierten Debug-Modus.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```

{{% /tab %}}
{{< /tabs >}}
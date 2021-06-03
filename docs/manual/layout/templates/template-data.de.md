---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/data"
aliases:
    - /de/layout/templates/data/
weight: 50
---

Die verfügbaren Template-Daten variieren je nach Quelle der Vorlage. In der Regel ist der vollständige 
Datensatz im Template über die Angabe von `$this->…` erreichbar.

Du kannst dir alle verfügbaren Daten eines Templates anzeigen lassen: 

```php
<?php $this->dumpTemplateVars() ?>
```

Die Anweisung verwendet die [Symfony VarDumper-Komponente](https://symfony.com/doc/current/components/var_dumper.html) 
zur Anzeige der Template-Daten – im Debug-Modus wird die Ausgabe dabei an die Symfony Debug Toolbar umgeleitet.  

{{% notice info %}}
Falls du [Template-Vererbung]({{< ref "template-inheritance.de.md" >}}) nutzt, wird der Auszug der Template-Daten nur im 
[Debug-Modus]({{< ref "debug-mode.de.md" >}}) angezeigt oder wenn sich die Anweisung zwischen `$this->block(…)` und
`$this->endblock()` befindet.
{{% /notice %}}

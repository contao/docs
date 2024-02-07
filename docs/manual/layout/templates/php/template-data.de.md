---
title: "Template-Variablen anzeigen"
description: "Alle Template-Variablen bzw. Template-Daten anzeigen."
url: "layout/templates/php/data"
aliases:
    - /de/layout/templates/php/data/
weight: 60
---

Die verfügbaren Daten im Template (die Template-Variablen) variieren je nach Quelle der Vorlage. In der Regel ist der vollständige 
Datensatz der im Template verfügbaren Variablen über die Angabe von `$this->…` erreichbar.

Du kannst dir alle verfügbaren Variablen eines Templates anzeigen lassen: 

```php
<?php $this->dumpTemplateVars() ?>
```

Die Anweisung verwendet die [Symfony VarDumper-Komponente](https://symfony.com/doc/current/components/var_dumper.html) 
zur Anzeige der Template-Variablen – im Debug-Modus wird die Ausgabe dabei an die Symfony Debug Toolbar umgeleitet.  

{{% notice info %}}
Falls du [Template-Vererbung]({{< ref "template-inheritance.de.md" >}}) nutzt, wird der Auszug der Template-Variablen nur im 
[Debug-Modus]({{< ref "debug-mode.de.md" >}}) angezeigt oder wenn sich die Anweisung zwischen `$this->block(…)` und
`$this->endblock()` befindet.
{{% /notice %}}

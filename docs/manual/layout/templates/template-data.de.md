---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/data"
aliases:
    - /de/layout/templates/data/
weight: 50
---

Die verfügbaren Template-Daten variieren je nach Quelle der Vorlage. In der Regel ist der vollständige 
Datensatz im Template verfügbar. Die einzelnen Datensätze entsprechen den jeweiligen Datenbankeinträgen und 
sind im Template über die Angabe von `$this->…` erreichbar. 

Du kannst dir alle verfügbaren Template-Daten eines Templates anzeigen lassen. Entweder über 

```php
<?php $this->dumpTemplateVars() ?>
```

oder über 

```php
<?php dump($this) ?>
```

Beide Anweisungen verwenden die [Symfony VarDumper-Komponente](https://symfony.com/doc/current/components/var_dumper.html) 
zur Anzeige der Template-Daten.

{{% notice info %}}
Falls du die [Template-Vererbung]({{< ref "template-inheritance.de.md" >}}) nutzt, wird der Auszug der Template-Daten nur im 
[Debug-Modus]({{< ref "debug-mode.de.md" >}}) angezeigt oder wenn sich die Anweisung zwischen `$this->block(…)` und `$this->endblock()` befindet.
{{% /notice %}}

---
title: "contao:migrate"
description: "Durchführung von Datenbankaktualisierungen und -Migrationen."
aliases:
    - /de/cli/migrate/
weight: 25
---


{{< version "4.9" >}}

Mit diesem Befehl können Datenbank-Updates und Migrationen nach einer Neuinstallation, einem Contao Update oder einer 
Erweiterung durchgeführt werden. Die Migrationen, die ausgeführt werden, sind Contao Update-Skripte, registrierte Migrationen von Erweiterungen, 
Legacy `runonce.php`-Dateien und das Datenbank-Update.


```sh
$> php vendor/bin/contao-console contao:migrate [options]
```

| Option | Beschreibung |
| --- | --- |
| `--with-deletes`   | Führt alle Datenbankmigrationen einschließlich `DROP`-Abfragen aus. |
| `--schema-only`    | Führt nur die Migration des Datenbankschemas aus. Update-Skripte, registrierte Migrationen und `runonce.php`-Dateien werden übersprungen. |
| `--no-interaction` | Wenn diese Option aktiviert ist, werden alle Bestätigungsfragen automatisch mit "Ja" beantwortet. Dies ist nützlich, wenn die Migrationen in einem automatisierten System durchgeführt werden sollen. |
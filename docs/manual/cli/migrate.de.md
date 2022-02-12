---
title: "contao:migrate"
description: "Durchführung von Datenbankaktualisierungen und -Migrationen."
aliases:
    - /de/cli/migrate/
weight: 40
---


{{< version "4.9" >}}

Mit diesem Befehl können Datenbank-Updates und Migrationen nach einer Neuinstallation, einem Contao Update oder einer 
Erweiterung durchgeführt werden. Die Migrationen, die ausgeführt werden, sind Contao Update-Skripte, registrierte Migrationen von Erweiterungen, 
Legacy `runonce.php`-Dateien und das Datenbank-Update.


```bash
php vendor/bin/contao-console contao:migrate [options]
```

| Option | Beschreibung |
| --- | --- |
| `--with-deletes`   | Führt alle Datenbankmigrationen einschließlich `DROP`-Befehlen aus. |
| `--schema-only`    | Führt nur die Migration des Datenbankschemas aus. Update-Skripte, registrierte Migrationen und `runonce.php`-Dateien werden übersprungen. |
| `--migrations-only` | Führt nur die Migrationen aus, ohne die Datenbanktabellen und -Felder zu aktualisieren. |
| `--dry-run` | Zeigt anstehende Migrationen und Schemaaktualisierungen an, ohne sie tatsächlich auszuführen. |
| `--no-interaction` | Wenn diese Option aktiviert ist, werden alle Bestätigungsfragen automatisch mit »Ja« beantwortet. Dies ist nützlich, wenn die Migrationen in einem automatisierten System durchgeführt werden sollen. |
| `--no-backup` | {{< version-tag "4.13" >}} Deaktiviert das Datenbank-Backup, das standardmäßig vor der Ausführung der Migrationen erstellt wird. |

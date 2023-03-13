---
title: "contao:backup"
description: "Ganz einfach Backups der Datenbank erstellen"
url: "cli/datenbank-backups"
---

{{< version "4.13" >}}

Contao liefert alles mit, was du für ein zuverlässiges Datenbank-Backup brauchst. Einmal konfiguriert und du kannst
nachts beruhigt schlafen, denn was auch immer mit der Datenbank geschieht, du hast deine Backups und kannst das neuste
mit nur einem Befehl direkt wieder einspielen!

Standardmässig werden die Backups in `var/backups` gespeichert und dort auch verwaltet. Folgende Befehle stehen dir
für die Verwaltung der Backups zur Verfügung:

## contao:backup:create

Natürlich der wichtigste Befehl. Ohne dass wir ein Backup haben, können wir mit den anderen Befehlen herzlich wenig
anfangen. Die einfachste Form der Nutzung erfolgt ohne jegliche Argumente:

```bash
php vendor/bin/contao-console contao:backup:create
```

Fertig. Contao erstellt dir jetzt ein Backup in `var/backups` und versieht es mit dem aktuellen Datum und der Uhrzeit.
Standardmässig wird es auch direkt komprimiert, damit nicht unnötig Speicherplatz auf deinem System verschwendet wird.

Backups beginnen immer mit einem beliebigen Namen (standardmässig `backup`) und werden vom Datum mit `__` getrennt.
Du wirst also eine Datei `var/backups` liegen haben, die z. B. so aussieht: `backup__20220126153243.sql.gz`.

Wenn du möchtest, kannst du den Namen und somit die Uhrzeit selber beeinflussen, indem du den kompletten Backup-Namen
als Argument angibst. Durch das Weglassen von `.gz` deaktivierst du ausserdem bequem die Komprimierung:

```bash
php vendor/bin/contao-console contao:backup:create mein_super_backup_name__20220101000000.sql
```

{{% notice tip %}}
Jedes Mal, wenn ein neues Backup erstellt wird, räumt Contao veraltete Backups automatisiert auf. Siehe
Abschnitt »[Konfigurationsmöglichkeiten](#konfigurationsmoeglichkeiten)«.
{{% /notice %}}

## contao:backup:list

Dieses Kommando lässt uns die bestehenden Backups anzeigen. Die Ausgabe dürfte ungefähr so aussehen:

```bash
--------------------- ----------- ------------------------------- 
Created               Size        Name
--------------------- ----------- ------------------------------- 
2022-01-26 15:32:43   73.14 KiB   backup__20220126153243.sql.gz
--------------------- ----------- -------------------------------
```

## contao:backup:restore

Dieses Kommando lässt dich eines der vorhandenen Backups wiederherstellen. Standardmässig wird einfach das jüngste
Backup verwendet. Du kannst aber wiederum auch ein bestimmtes Backup angeben:

```bash
# Das jüngste Backup
php vendor/bin/contao-console contao:backup:restore

# Ein bestimmtes Backup
php vendor/bin/contao-console contao:backup:restore backup__20220126153243.sql.gz
```


## Automatisiert Backups erstellen lassen

Dadurch, dass Contao das Backup-Verzeichnis automatisch verwaltet, kannst du mittels eines Cronjobs deine Backups
zu einem beliebigen Zeitpunkt erstellen lassen. Wie wäre es beispielsweise immer abends um 23:10 Uhr? Ein Eintrag
in der `crontab` könnte dann so aussehen:

```
10 23 * * * /pfad/zum/system/vendor/bin/contao-console contao:backup:create
```

## Konfigurationsmöglichkeiten {#konfigurationsmoeglichkeiten}

Konfigurieren lässt sich sowohl, welche Datenbanktabellen bei einem Backup ignoriert werden sollen, wie auch
die sog. »Retention Policy«, also wie bzw. bis wann, ältere Backups noch gespeichert bleiben.

Die Standardeinstellungen lauten wie folgt:

```yml
# config/config.yml
contao:
    backup:
        ignore_tables: ['tl_crawl_queue', 'tl_log', 'tl_search', 'tl_search_index', 'tl_search_term']
        keep_max: 5
        keep_intervals: ['1D', '7D', '14D', '1M']
```

Es werden also die konfigurierten Tabellen bei einem Backup ignoriert und maximal `5` Backups zurückbehalten.
Allerdings nicht die neusten fünf, sondern gem. der `keep_intervals` Konfiguration. Mittels `keep_intervals` kannst du
eine beliebige Anzahl Intervalle definieren. Für jedes dieser Intervalle wird dann das jeweils **älteste** Backup behalten.
Hast du also wie in diesem Artikel aufgezeigt einen Cronjob definiert, der täglich ein Backup auslöst, dann werden
standardmässig 5 Backups behalten. Und zwar

1) Das neuste, soeben erstellte Backup
2) Das älteste Backup der letzten 24 Stunden (`1D` = jetzt - 1 Tag)
3) Das älteste Backup der letzten 7 Tage (`7D` = jetzt - 7 Tage)
4) Das älteste Backup der letzten 14 Tage (`14D` = jetzt - 14 Tage)
5) Das älteste Backup des letzten Monats (`1M` = jetzt - 1 Monat)

Zur Verfügung stehen die folgenden Bezeichner:

* `Y` für Jahre
* `M` für Monate
* `D` für Tage
* `W` für Wochen
* `H` für Stunden
* `M` für Minuten
* `S` für Sekunden

Zeitelemente (`H`, `M` und `S`) müssen dabei mit dem Präfix `T` versehen werden. Ansonsten hätte `M` eine doppelte 
Bedeutung. 5 Stunden wären also nicht `5H` sondern `T5H`.

Bezeichner können auch kombiniert werden: Ein Jahr, zwei Monate und 5 Stunden wäre `1Y2MT5H`. Weitere Informationen 
können [der PHP-Dokumentation][DateInterval_Docs] entnommen werden. Der dort 
dokumentierte Präfix `P` kann weggelassen werden. Dieser 
muss ohnehin immer hinzugefügt werden, entsprechend macht das Contao automatisch für dich.

{{% notice warning %}}
Beachte, dass wenn du sowohl `keep_max` als auch `keep_intervals` konfigurierst, sollte `keep_max` immer mind. 1 grösser
sein, als die Anzahl der `keep_intervals` (das neuste plus pro Interval das älteste). `keep_max` gewinnt immer. Es dient
als eine Art Sicherheitseinstellung, so dass niemals mehr als `keep_max` Backups zurückbehalten werden.
{{% /notice %}}

[DateInterval_Docs]: https://www.php.net/manual/en/dateinterval.construct.php

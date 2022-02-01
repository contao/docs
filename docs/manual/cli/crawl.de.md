---
title: "contao:crawl"
description: "Indiziert die Seiten deiner Webseite und erstellt daraus einen Suchindex."
aliases:
    - /de/cli/crawl/
weight: 20
---

Contao ist mit einem HTTP-Crawler ausgestattet. Intern basiert dieser auf [Escargot](https://github.com/terminal42/escargot).
Der Crawler durchforstet im wesentlichen alle von Contao generierten URLs, wie jede andere Suchmaschine. Er folgt Links, 
die Teil der `sitemap.xml` sind, respektiert `robots.txt` Informationen, das `rel`-Attribut bei Links und vieles mehr.
Dabei können eine beliebige Anzahl von sogenannten »Subscribern« die Ergebnisse der HTTP-Anfragen abonnieren und 
grundsätzlich beliebig weiterverarbeiten. Zum jetzigen Zeitpunkt kennt Contao zwei Abonnenten:

* `search-index` - Aktualisiert den integrierten Suchindex (nur verfügbar, wenn die Suche überhaupt aktiviert wurde)
* `broken-link-checker` - Überprüft alle Seiten auf fehlerhafte Links

Jede Erweiterung kann weitere »Subscriber« bereitstellen, so dass diese Liste nicht unbedingt abschließend ist.

```bash
php vendor/bin/contao-console contao:crawl [options] [<job>]
```

Es gibt nur ein Argument für diesen Befehl, nämlich `job`. Dieses ist optional und steht für eine Auftragskennung. Crawling kann eine sehr 
langwierige Aufgabe sein. Wenn man also aufhören und später dort weitermachen will, wo man aufgehört hat, muss man sich die Job-ID merken, 
die bei der ersten Ausführung des Befehls zugewiesen wurde, damit diese später mit dieser Job-ID fortgeführt werden kann. Da es jedoch 
in der Regel keine Speicher- oder Laufzeitbeschränkungen auf der Konsole gibt, wird diese Möglichkeit wahrscheinlich nicht sehr oft genutzt werden.

Die Optionen sind viel wichtiger:


| Option               | Beschreibung |
| --- | --- |
| `--subscribers (-s)` | Standardmäßig sind alle »Subscriber« aktiviert. Aber du kannst eine, durch Komma getrennte, Liste von »Subscribern« angeben. Wenn du z. B. nur auf defekte Links prüfen möchtest, gibts du hier nur `broken-link-checker` an. |
| `--concurrency (-c)` | Mit dieser Option konfigurierst du die Anzahl der gleichzeitigen Anfragen. Je höher die Zahl, desto schneller wird der Prozess abgeschlossen. Aber Webserver können nur eine bestimmte Anzahl gleichzeitiger Anfragen verarbeiten, daher sollte der Wert mit Bedacht gewählt werden. |
| `--delay`            | Um sicherzustellen, dass der Webserver nicht überlastet wird, kannst du eine Verzögerung konfigurieren. Diese wird in Mikrosekunden angegeben und bewirkt lediglich, dass der Crawler zwischen den Anfragen `n` Mikrosekunden wartet. |
| `--max-requests`     | Standardmäßig ist kein Limit konfiguriert. Aber wenn du nur eine bestimmte Anzahl von Anfragen insgesamt ausführen möchtest, kannst du dies mit dieser Option erreichen. Zur weiteren, späteren Ausführung berücksichtige das Argument `job`. |
| `--max-depth`        | Dies ist die Tiefe der Hierarchie, die der Crawler durchsuchen wird. Die Wurzelseite ist im Grunde Ebene 1 und alle dort gefundenen Links gehören zur Ebene 2. Alle Links, die auf Ebene 2 gefunden werden, gehören zur Ebene 3 und so weiter. Standardmäßig ist keine maximale Tiefe konfiguriert. Je höher die Zahl, desto tiefer wird der Crawler suchen, aber es wird auch länger dauern. |
| `--enable-debug-csv` | Standardmäßig werden die Ergebnisse in die Standardausgabe geschrieben. Du kannst hierüber alles in eine CSV-Datei schreiben lassen. |
| `--debug-csv-path`   | Mit dieser Option kannst du den Standard-CSV-Dateipfad überschreiben, wenn du `--enable-debug-csv` verwendet hast. |
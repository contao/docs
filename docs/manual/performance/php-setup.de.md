---
title: "PHP Setup"
description: "Ideales PHP Setup für Contao."
url: "performance/php-setup"
aliases:
    - /de/performance/php-setup/
---

Grundsätzlich sollte immer die jüngste, von Contao unterstützte, PHP-Version eingesetzt werden. PHP selbst
erfährt laufend Verbesserungen und das wiederum sorgt meistens auch für bessere Performance.

## SAPI

Die Server API (SAPI) von PHP hängt oft direkt mit dem eingesetzten Webserver zusammen. Im Core von PHP selbst werden
zurzeit 8 SAPIs gepflegt, wovon für den Betrieb von Contao wohl nur deren 4 in Frage kommen:

* mod_php (apache2handler)
* cgi
* fpm (php-fpm)
* litespeed

Bei `mod_php` und `litespeed` ist die SAPI gegeben, da sie als Modul des jeweiligen Servers direkt läuft. Ansonsten
sollte die Wahl wann immer möglich auf `fpm` (`php-fpm`) fallen.
Dies deshalb, weil es zurzeit die einzige aller SAPIs ist, welche Unterstützung für `fastcgi_finish_request()` bietet
und es Contao somit erlaubt, gewisse Aufräumarbeiten nach dem Senden der Antwort zum Client zu erledigen.
Dadurch wird die eigentliche Laufzeit des PHP-Prozesses zwar nicht kürzer, aber die Antwortzeit für den Besucher kann
sich erheblich verbessern.

## OPcache

Der grösste Performance-Gewinn lässt sich durch den Einsatz des PHP OPcache erzielen.

Da es sich bei PHP um eine interpretierte Skript-Sprache handelt, wird jedes PHP-Skript normalerweise zur Laufzeit
interpretiert. Dabei werden für jede Datei folgende Schritte durchlaufen:

1. Lexing (lexikalische Analyse: zerlegt Quellcode in logisch zusammengehörige Einheiten (sog. Tokens))
2. Parsing (semantische Analyse: »versteht« eine Menge an Tokens. Definiert also was valide Syntax ist)
3. Compilation (übersetzt PHP in direkte Instruktionen, auch Bytecode genannt, welche dann durch die PHP Virtual Machine ausgeführt werden können)
4. Execution (die Ausführung des Bytecodes)

Sofern sich eine PHP-Datei nicht verändert, sind die Schritte 1 - 3 jedes Mal identisch. Besonders die »Compilation« ist
sehr aufwändig, da PHP bei diesem Schritt etliche Checks vornimmt und Optimierungen anbringt.

Der OPcache ist ein Bytecode-Cache. Er speichert sich also (wahlweise im RAM oder auf dem Dateisystem) den nach Schritt
3 generierten Bytecode und führt bei jedem darauffolgenden Request nur noch den bereits fertig kompilierten Bytecode
aus.

Der OPcache lässt sich sehr fein auf die individuellen Bedürfnisse konfigurieren. Ein allgemeingültiges, perfektes Setup
gibt es daher nicht, aber hier ein paar Empfehlungen und Erklärungen dazu:

```ini
; php.ini
; Konfiguriert die maximale Anzahl an Megabytes die für den OPcache verwendet werden dürfen.
; Je höher, desto mehr kann gespeichert werden. 128 MB sollten in den meisten Fällen ausreichen.
; Denk daran: Mehr Extensions = mehr Code = mehr Speicherbedarf
opcache.memory_consumption = 128

; Konfiguriert die maximale Anzahl an Dateien welche der OPcache behandelt.
; Hier gilt das gleiche: Je höher, desto mehr kann gespeichert werden.
; Denk daran: Mehr Extensions = mehr Code = mehr Speicherbedarf
opcache.max_accelerated_files = 20000

; Standardmässig prüft PHP bei jeder Ausführung, ob sich eine Datei seit dem letzten Aufruf verändert hat.
; Das ist praktisch, verlangsamt aber natürlich den Zugriff.
; Wenn du dieses Verhalten deaktivierst, wird sich die Performance verbessern.
; Du musst danach aber auch dafür sorgen, dass der OPcache bei jeder Änderung geleert wird.
opcache.validate_timestamps = 0
```

Den OPcache leeren kannst du bequem via Contao Manager unter dem Menüpunkt »Systemwartung«.
Solltest du Deployment Tools nutzen, denk daran, den OPcache nach jedem Deployment zu löschen. Da der 
CLI-Prozess und der Web-Prozess sich den OPcode nicht teilen, kannst du ihn nicht durch das Ausführen eines Kommandos
löschen.
Dafür gibt es verschiedene Lösungen wie bspw. das [cachetool](https://github.com/gordalina/cachetool) oder das
[smart-core/accelerator-cache-bundle](https://github.com/Smart-Core/AcceleratorCacheBundle).

## Realpath Cache

Der Realpath Cache ist ein oft unterschätzter Cache in PHP.

Wann immer der Zugriff auf eine Datei stattfindet, geschieht so einiges unter der Haube.
Denn gerade bei Unix [ist alles eine Datei](https://de.wikipedia.org/wiki/Everything_is_a_file).
Der Kernel muss also erstmal grundsätzlich prüfen, ob es sich um eine echte Datei, ein Verzeichnis oder ein Symlink etc. handelt. Diese sog. `stat()`-Aufrufe sind relativ kostspielig.

PHP cached das Resultat dieser Aufrufe, so dass nachfolgende Anfragen innerhalb des selben Prozesses die Informationen ohne erneuten Dateisystemzugriff zur Verfügung haben. Rufen wir bspw. ein `is_dir('/pfad/zum/verzeichnis')` und später ein `is_file('/pfad/zum/verzeichnis')` auf, so wäre der zweite Aufruf quasi kostenlos, weil PHP weiss ja bereits aus dem ersten Aufruf, ob es sich dabei um eine Datei oder ein Verzeichnis handelt.

PHP ist sogar so schlau und speichert sich zusätzlich die Informationen für die übergeordneten Pfadteile im Cache. In unserem Beispiel wären dann also auch `/pfad` und `/pfad/zum` im Cache abgelegt.

Dateisystemzugriffe sind in Contao sehr häufig. Man denke schon nur an die Dateiverwaltung.
Eine saubere Konfiguration des Realpath Caches kann da einen deutlich spürbaren Unterschied machen!

Du kannst in deiner `php.ini` die TTL und die maximale Anzahl Dateien konfigurieren. Hier eine Empfehlung:

```ini
; php.ini
realpath_cache_size = 4096K
realpath_cache_ttl = 600
```

{{% notice warning %}}
Wenn in PHP die `open_basedir` Konfiguration aktiviert ist, [deaktiviert PHP den Realpath Cache zur Laufzeit](https://github.com/php/php-src/blob/4b77a158ef2850582aeb4834c588aba49942776c/main/main.c#L1765), unabhängig davon, was bei `realpath_cache_size` konfiguriert wurde. Leider wird `open_basedir` auch heute noch von vielen Hostern als notwendige Sicherheitsmassnahme angesehen, obwohl [PHP selber offiziell dessen Einsatz zu Sicherheitszwecken ablehnt und entsprechende Massnahmen auf Betriebssystem-Ebene empfiehlt](https://www.php.net/security-note.php).
{{% /notice %}}

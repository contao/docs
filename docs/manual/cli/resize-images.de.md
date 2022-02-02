---
title: "contao:resize-images"
description: "Process deferred images that were not resized."
aliases:
    - /de/cli/resize-images/
weight: 30
---


{{< version "4.8" >}}

Mit diesem Befehl können alle fehlenden, verzögert erzeugten Bilder erstellt werden.

```bash
php vendor/bin/contao-console contao:resize-images [options]
```

| Option | Beschreibung |
| --- | --- |
| `--concurrent`     | Führt mehrere Prozesse gleichzeitig aus, wenn der Wert größer als 1 ist, oder pausiert zwischen den Größenänderungen, um die CPU-Auslastung zu begrenzen, wenn der Wert kleiner als 1,0 ist. In einer Hosting-Umgebung kann es sinnvoll sein, einen Wert unter 0,5 zu verwenden, um den CPU-Verbrauch auf 50% zu begrenzen. |
| `--time-limit`     | Zeitlimit in Sekunden, nach dem der Befehl beendet werden soll, auch wenn noch nicht alle Bilder erzeugt wurden. |
| `--image=IMAGE`    | Übergebe einen Bildpfad wie `1/foobar-f6eac395d.jpg` (ohne das Präfix `assets/images`), um nur ein bestimmtes Bild zu erzeugen. |
| `--no-sub-process` | Deaktiviert die Verwendung eines Unterprozesses für jede Bildgrößenänderung. Verwende diese Option mit Vorsicht, da es zu einem extrem hohen Speicherverbrauch führen kann. |
| `--preserve-missing` | Entfernt keine latenten Bildreferenzen auf Bilder, die nicht mehr existieren. |
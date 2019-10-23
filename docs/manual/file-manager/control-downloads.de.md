---
title: "Downloads kontrollieren"
description: "Mit Contao kannst du ganz einfach den Zugriff auf bestimmte Dateien beschränken und genau festlegen, wer 
diese herunterladen darf und wer nicht."
url: "dateiverwaltung/downloads-kontrollieren"
weight: 30
---

Mit Contao kannst du ganz einfach den Zugriff auf bestimmte Dateien beschränken und genau festlegen, wer diese 
herunterladen darf und wer nicht. Auf diese Weise kannst du z. B. einen geschützten Download-Bereich für Mitglieder 
einrichten.


## Verzeichnis schützen {#verzeichnis-schuetzen}

Wenn du in Contao einen neuen Ordner anlegst, ist dieser standardmäßig inklusive aller Unterordner über HTTP erreichbar. 
Möchtest du ein Verzeichnis schützen, musst du beim Anlegen des Ordners darauf achten, dass »Öffentlich« nicht 
ausgewählt ist. Ist ein Verzeichnis öffentlich, können die darin befindlichen Ordner und Dateien nicht geschützt werden.

![Verzeichnis schützen](/de/file-manager/images/de/verzeichnis-schuetzen.png)

Ist ein Ordner öffentlich wird unter `web/files/` ein 
[Symlink](https://de.wikipedia.org/wiki/Symbolische_Verkn%C3%BCpfung) in das Verzeichnis `files` gesetzt. 
Ohne diese Symlinks wären die Daten für Besucher nicht erreichbar.

![nicht öffentlicher Ordner](/de/file-manager/images/de/nicht-oeffentlicher-ordner.png)

Ist der Ordner nicht öffentlich kann nun niemand mehr mit seinem Internetbrowser auf die Dateien zugreifen und sie 
direkt herunterladen. Über die Inhaltselemente »Download« bzw. »Downloads« sind die Dateien aber weiterhin erreichbar.


## Download-Element schützen {#download-element-schuetzen}

Als Nächstes musst du den Zugriff auf die Download-Elemente beschränken, über die du die Dateien nach wie vor 
herunterladen kannst. Richte dazu entweder eine geschützte Seite in der Seitenstruktur oder ein geschütztes 
Inhaltselement ein, das nur noch von angemeldeten Mitgliedern aufgerufen werden kann.

Da der Download ausschließlich über die Inhaltselemente »Download« und »Downloads« möglich ist und du den Zugriff auf 
diese Inhaltselemente eingeschränkt hast, können jetzt nur noch angemeldete Mitglieder Dateien herunterladen. Dieser 
Schutz lässt sich durch verschiedene Mitgliedergruppen und unterschiedliche Download-Elemente beliebig weiter 
verfeinern.

![Inhaltselemente Downloads](/de/file-manager/images/de/inhaltselemente-downloads.png)


**HTML-Ausgabe**  
Das Inhaltselement vom Elementtyp »Downloads« generiert folgenden HTML-Code:

```html
<div class="ce_downloads first block">
    <ul>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <a href="?file=files/….pdf" title="Die Datei … herunterladen">… <span class="size">(… KiB)</span></a>
        </li>
    </ul>
</div>
```

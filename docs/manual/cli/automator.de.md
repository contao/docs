---
title: "contao:automator"
description: "Allgemeine Aufgaben rund um die Wartung einer Contao-Installation."
aliases:
    - /de/cli/automator/
weight: 15    
---


Dieser Befehl ist eine Schnittstelle zur Contao Klasse `Automator`. Er besteht hauptsächlich aus allgemeinen Aufgaben 
rund um die Wartung einer Contao-Installation.

```bash
php vendor/bin/contao-console contao:automator [<task>]
```

Der Befehl selbst kann ohne Angabe einer Aufgabe ausgeführt werden. Es wird dann nach einer Aufgabe gefragt. 
Die folgenden Aufgaben sind verfügbar.

| Aufgabe | Beschreibung |
| --- | --- |
| `purgeSearchTables`     | Löscht den Suchindex durch löschen der Tabellen `tl_search` und `tl_search_index`. |
| `purgeUndoTable`        | Löscht die Tabelle `tl_undo` |
| `purgeVersionTable`     | Löscht die Tabelle `tl_version`, die verschiedene Versionen für Zeilen in Tabellen enthält, die die Versionierungsfunktion aktiviert haben. |
| `purgeSystemLog`        | Löscht die Einträge im Systemprotokoll. |
| `purgeImageCache`       | Bereinigt den Bild-Cache, indem alle verarbeiteten und in der Größe veränderten Bilder im konfigurierbaren `image.target_dir` gelöscht werden. |
| `purgeScriptCache`      | Entfernt verarbeitete und/oder verkleinerte JavaScript- und Stylesheets-Dateien. |
| `purgePageCache`        | Löscht den Seiten-Cache, indem zwischengespeicherte HTML-Seiten entfernt werden. |
| `purgeSearchCache`      | Löscht den Cache der Suchergebnisse. |
| `purgeInternalCache`    | Löscht den internen Cache von Contao. |
| `purgeTempFolder`       | Löscht den Inhalt von `system/tmp`. |
| `purgeRegistrations`    | Die nicht aktivierten Mitgliederregistrierungen werden bereinigt. |
| `purgeOptInTokens`      | Die abgelaufenen Double-Opt-In-Tokens werden gelöscht. |
| `purgeXmlFiles`         | Entfernt die von `generateXmlFiles` erzeugten xml-Dateien. |
| `generateSitemap`       | Erzeugt die sitemap.xml-Dateien auf der Grundlage des Seitenbaums und der Einstellungen auf der Stammseite. |
| `generateXmlFiles`      | Erzeugt die sitemap.xml-Dateien und ruft den Hook `generateXmlFiles` auf, den andere Bundles nutzen können. Das `ContaoNewsBundle` verwendet ihn, um RSS-Feeds zu erzeugen. |
| `generateSymlinks`      | Erzeugt verschiedene Symlinks zum Web-Verzeichnis, z. B. öffentlich erreichbare Dateiverzeichnisse, das Verzeichnis assets oder `system/themes`. |
| `generateInternalCache` | Wärmt den internen Cache auf. |

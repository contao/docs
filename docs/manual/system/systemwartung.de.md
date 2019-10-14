---
title: "Systemwartung"
description: "Die meisten Wartungsaufgaben in Contao sind automatisiert, sodass du dich auf deine eigentliche Arbeit 
konzentrieren kannst."
weight: 2
---

Die meisten Wartungsaufgaben in Contao sind automatisiert, sodass du dich auf deine eigentliche Arbeit konzentrieren 
kannst. Manchmal kann es jedoch notwendig sein, die sonst automatisch ausgeführten Aufgaben der Systemwartung manuell 
zu starten.

## Daten bereinigen

Neben den benutzergenerierten Inhalten speichert Contao verschiedene Systemdaten, die für die Suche oder das 
Wiederherstellen gelöschter Datensätze oder früherer Versionen verwendet werden. Du kannst diese Daten manuell 
bereinigen, um z. B. alte Vorschaubilder zu entfernen oder die XML-Sitemaps nach einer Änderung an der Seitenstruktur 
zu aktualisieren.

![Daten manuell bereinigen](/system/images/de/daten-manuell-bereinigen.png)


## Suchindex neu aufbauen

Seiten werden automatisch beim Aufruf im Frontend indiziert (es sei denn du bist parallel im Backend angemeldet), daher 
musst du dich um den Suchindex normalerweise keine Gedanken machen. Wenn du allerdings viele Seiten auf einmal 
aktualisiert hast, ist es bequemer, den Suchindex manuell neu aufzubauen, als alle geänderten Seiten einzeln im Browser 
aufzurufen.

![Den Suchindex automatisch aufbauen](/system/images/de/den-suchindex-automatisch-aufbauen.png)


## Geschützte Seiten indizieren

Um das Durchsuchen von geschützten Seiten zu erlauben, musst du die Funktion zunächst in den Backend-Einstellungen 
aktivieren. Benutze dieses Feature sehr sorgfältig, und schließe personalisierte Seiten immer von der Suche aus!

Lege danach einen neuen Frontend-Benutzer an, und erlaube ihm den Zugriff auf die zu indizierenden geschützten Seiten. 
Beim Aufbauen des Suchindexes wird dieser Benutzer dann automatisch angemeldet.

Später bei der Suche erscheinen die geschützten Seiten natürlich nur in den Ergebnissen, wenn der angemeldete 
Frontend-Benutzer auch auf sie zugreifen darf.

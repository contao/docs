---
title: "Dateiverwaltung"
description: "Mit der Dateiverwaltung kannst du Dateien und Ordner auf deinem Server verwalten und Dateien von deinem 
lokalen Rechner auf den Server übertragen."
url: "dateiverwaltung"
aliases:
    - /de/dateiverwaltung/
weight: 12
---

Mit der Dateiverwaltung kannst du Dateien und Ordner auf deinem Server verwalten und Dateien von deinem lokalen Rechner 
auf den Server übertragen. Benutzerressourcen werden standardmäßig im Contao-Ordner `files` gespeichert. 
Das datenbankgestützte Dateisystem von Contao speichert Dateiinformationen in der Datenbank und referenziert die 
Einträge über deren [UUIDs (Universally Unique Identifier)](https://de.wikipedia.org/wiki/Universally_Unique_Identifier). 
Eine UUID ist systemübergreifend eindeutig und sieht zum Beispiel so aus: `bb643d42-0026-ba97-11e3-ccd717221c8a`.


## Neuen Ordner erstellen

Über die Schaltfläche »Neuer Ordner« kannst du ein neues Verzeichnis erstellen. Folgende Optionen stehen hierbei zur Verfügung:

**Öffentlich:** Macht den Ordner inklusive aller Unterordner über HTTP erreichbar.

**Nicht synchronisieren:** Den Ordner und seine Unterordner nicht mit der Datenbank synchronisieren.


### Verschachtelte Ordner erstellen

{{< version-tag "4.13" >}} Verschachtelte Ordner können direkt über Eingabe von z. B. »OrdnerA/OrdnerB« erstellt werden.

![Verschachtelte Ordner anlegen](/de/file-manager/images/de/folder-name.gif?classes=shadow)

{{% notice note %}}
Mit Auswahl »Öffentlich« wird hierbei lediglich der letzte Ordner entsprechend öffentlich markiert.
{{% /notice %}}


{{% children %}}

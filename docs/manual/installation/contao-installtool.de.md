---
title: "Contao-Installtool"
description: "Mit dem Contao-Installtool kannst du eine Datenbankverbindung herstellen, Tabellen aktualisieren, ein 
Template importieren und ein Administratorkonto anlegen."
weight: 9
---

Rufe in deinem Internetbrowser die URL deiner Contao-Installation auf, und hängen `/contao/install` hinten 
dran, um das Installtool zu starten.

z. B. `www.example.com/contao/install`

Akzeptiere die Lizenz und vergebe ein Passwort.


## Datenbankverbindung herstellen

Das Contao-Installtool kann selbst keine neuen Datenbanken erstellen, da das bei den meisten Shared-Hosting-Paketen 
sowieso nur über die Verwaltungssoftware (z. B. Confixx, Plesk oder cPanel) möglich ist. Rufe also die 
Verwaltungsoberfläche deines Servers auf, und lege dort eine neue Datenbank an. Gebe danach die Anmeldeinformationen
für die Datenbank im Contao-Installtool ein.

![Datenbankverbindung für Contao eingeben](/installation/images/de/datenbankverbindung-fuer-contao-eingeben.png)

**Host:** Hier gibst du die Domain oder IP-Adresse des Datenbankservers ein.

**Portnummer:** Hier kannst du die Portnummer des Datenbankservers ändern.

**Benutzername:** Hier gibst du den Benutzernamen für deine Datenbank ein.

**Passwort:** Hier gibst du das dazugehörige Passwort ein.

**Datenbank:** Hier gibst du den Namen der Datenbank ein.


## Tabellen aktualisieren

Nachdem du die Datenbankzugangsdaten gespeichert hast, baut das Installtool eine Verbindung zur Datenbank auf und 
vergleicht die darin enthaltenen Tabellen mit den Vorgaben der aktuellen Contao-Version. Ist eine Aktualisierung 
notwendig, präsentiert dir das Installtool automatisch eine Liste der durchzuführenden Änderungen, die du bestätigen 
oder ablehnen kannst.

![Datenbankänderungen bestätigen](/installation/images/de/datenbankaenderungen-bestaetigen.png)

In der Regel solltest du die angebotenen Änderungen übernehmen, damit deine Tabellen immer auf dem neuesten Stand sind 
und Contao später nicht versucht, auf fehlende Felder zuzugreifen. Bei einer neuen Installation ist die Liste der 
Änderungen für gewöhnlich sehr lang, da erst einmal alle Tabellen neu angelegt werden müssen.

Achte darauf, eventuelle Löschaufträge besonders sorgfältig zu prüfen, denn Contao kennt nur seine eigenen Tabellen! 
Wenn sich auf deinem Server mehrere Anwendungen eine Datenbank teilen, bietet dir das Installtool an, die vermeintlich 
nicht benötigten Tabellen der anderen Programme »aufzuräumen«.

{{% notice warning %}}
Auch wenn es technisch möglich ist, solltest du für jede Anwendung eine eigene Datenbank verwenden.
{{% /notice %}}


## Ein Template importieren

An dieser Stelle kannst du eine `.sql`-Datei aus dem `/templates`-Verzeichnis importieren. Dabei werden alle 
bestehenden Daten gelöscht! Wenn du stattdessen lediglich ein Theme importieren willst, nutze bitte den 
[Theme-Manager](../../theme-manager/) im Contao-Backend.

{{% notice warning %}}
Beim Import eines Templates werden bestehende Daten überschrieben!
{{% /notice %}}


## Ein Administratorkonto anlegen

Wenn du auf den Import eines Templates verzichtet hast, weil du beispielsweise eine neue Webseite mit Contao erstellen 
möchtest, musst du einen Administrator-Benutzer anlegen, mit dem du dich später im Contao-Backend anmelden kannst.

![Ein Administratorkonto anlegen](/installation/images/de/ein-administratorkonto-anlegen.png)

**Benutzername:** Hier legst du den Benutzernamen des Administrators fest.

**Name:** Hier gibst du den Vor- und Nachnamen des Administrators ein.

**E-Mail-Adresse:** Hier gibst du die E-Mail-Adresse des Administrators ein.

**Passwort:** Hier legst du das Passwort des Administrators fest und bestätigst es.

Nachdem du den Administrator-Benutzer erstellt hast, ist die Installation von Contao abgeschlossen.  
Der Link am rechten unteren Rand bringt dich zum Backend.


## Das Installtool zurücksetzen {#das-installtool-zuruecksetzen}

Es gibt zwei Gründe, warum du das Installtool eventuell zurücksetzen willst:

1. Das Installtool wurde gesperrt.
2. Du hast das Installtool-Passwort vergessen.

Das Installtool ist gegen [Brute-Force-Attacken](https://de.wikipedia.org/wiki/Brute-Force-Methode) geschützt und wird 
automatisch gesperrt, wenn mehr als dreimal hintereinander ein falsches Passwort eingegeben wurde. 

Du hast drei Möglichkeiten das Installtool zu entsperren:

- Über den Contao Manager, indem du unter Systemwartung auf »Installtool entsperren« klickst.
![Das Installtool zurücksetzen](/installation/images/de/das-installtool-zuruecksetzen.png)
- Über die Kommandozeile, indem du im Hauptverzeichnis deiner Contao-Installation folgendes Kommando absetzt:

```bash
php vendor/bin/contao-console contao:install:unlock
```

- Indem du auf dem Webserver die Datei `install_lock` im Verzeichnis `/var` löschst.


Ein vergessenes Passwort lässt sich in der lokalen Konfigurationsdatei `/system/config/localconfig.php` zurücksetzen.

Suche dazu die Zeile mit der Anweisung `$GLOBALS['TL_CONFIG']['installPassword'] = '…';` und entferne diese komplett 
aus der Datei. Danach kannst du beim erneuten Aufruf des Installtools ein neues Passwort vergeben.


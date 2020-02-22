---
title: "Erweiterungen aktualisieren"
description: "Um eine passende Erweiterung für eine gewünschte Funktion zu finden, hast du drei Möglichkeiten."
url: "installation/erweiterungen-aktualisieren"
weight: 70
---


## Aktualisierung mit dem Contao Manager

Du musst dich zunächst wieder am Contao Manager anmelden. Dazu rufst du erneut deine Domain mit dem Zusatz 
`/contao-manager.phar.php` auf und gibst deine Zugangsdaten ein.

Wenn du die Erweiterung »terminal42/contao-easy_themes« aktualisieren möchtest, wechsle in den Reiter »Pakete« und klicke auf die 
Schaltfläche »Aktualisieren« neben der Erweiterung. Du kannst natürlich auch noch weitere Erweiterung zur 
Aktualisierung vormerken. Klicke auf »Änderungen anwenden« um die Aktualisierung zu starten. Die Aktualisierung kann 
nun mehrere Minuten in Anspruch nehmen. Details zum Aktualisierungsprozess können durch Klick auf folgendes Symbol 
![Konsolenausgabe anzeigen/verstecken](/de/icons/konsolenausgabe.png?classes=icon) angezeigt werden.

![Erweiterungen im Contao Manager aktualisieren](/de/installation/images/de/erweiterungen-im-contao-manager-aktualisieren.png)

Sobald der Contao Manager die Erweiterung(en) aktualisiert hat, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen, um die Datenbank, falls nötig, zu aktualisieren.


## Aktualisierung über die Kommandozeile {#aktualisierung-ueber-die-kommandozeile}

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
ssh benutzername@example.com
```

Wechsle dazu auf der Konsole in das Verzeichnis deiner Contao-Installation.

```bash
cd www/example/
```

Um die neueste Versionen einer Erweiterung zu erhalten und die `composer.lock` zu aktualisieren, wird der Befehl 
`update` ausgeführt, dass wird bei einigen Hostern dazu führen, dass der Prozess wegen der zu hohen Systemanforderung 
nicht beendet werden kann und die Aktualisierung dadurch fehlschlägt. In diesem Fall solltest du den 
[Contao Manager](#aktualisierung-mit-dem-contao-manager) nutzen.

**Ein einzelne Erweiterung aktualisieren:**

```bash
php composer.phar update terminal42/contao-easy_themes
```

**Mehrere Erweiterungen aktualisieren:**

```bash
php composer.phar update terminal42/notification_center terminal42/contao-leads
```

Du kannst auch im Vorfeld der Aktualisierung mit dem Befehl `outdated` eine Liste der installierten Erweiterungen, für 
die Aktualisierungen verfügbar sind, einschliesslich ihrer aktuellen und neusten Version anzeigen lassen.

```bash
php composer.phar outdated
```

**Resultat der Abfrage:**

```bash
doctrine/dbal               v2.8.1 v2.9.2  Database Abstraction Layer
knplabs/knp-menu            2.6.0  v3.0.1  An object oriented menu library
monolog/monolog             1.25.1 2.0.0   Sends your logs to files, sockets, inboxes, databases …
php-http/client-common      1.9.1  2.0.0   Common HTTP Client implementations and tools for HTTPlug
php-http/guzzle6-adapter    v1.1.1 v2.0.1  Guzzle 6 HTTP Adapter
php-http/httplug            v1.1.0 v2.0.0  HTTPlug, the HTTP client abstraction for PHP
sensiolabs/security-checker v5.0.3 v6.0.2  A security checker for your composer.lock
``` 

Sobald die Aktualisierung der Erweiterung(en) abgeschlossen ist, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen um die Datenbank, falls nötig, zu aktualisieren.

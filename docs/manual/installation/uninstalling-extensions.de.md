---
title: "Erweiterungen deinstallieren"
description: "Erweiterungen mit dem Contao Manager oder via Kommandozeile deinstallieren"
url: "installation/erweiterungen-deinstallieren"
aliases:
    - /de/installation/erweiterungen-deinstallieren/
weight: 80
---


## Deinstallation mit dem Contao Manager

Du musst dich zunächst wieder am Contao Manager anmelden. Dazu rufst du erneut deine Domain mit dem Zusatz 
`/contao-manager.phar.php` auf und gibst deine Zugangsdaten ein.

Wenn du die Erweiterung »terminal42/contao-easy_themes« deinstallieren möchtest, wechsle in den Reiter »Pakete« und klicke auf die 
Schaltfläche »Entfernen« neben der Erweiterung. Du kannst natürlich auch noch weitere Erweiterung zur Deinstallation 
vormerken.

![Erweiterungen im Contao Manager zur Deinstallation vormerken]({{% asset "images/manual/installation/de/erweiterungen-im-contao-manager-zur-deinstallation-vormerken.png" %}}?classes=shadow)

Klicke auf »Änderungen anwenden« um die Deinstallation zu starten. Die Deinstallation kann nun mehrere Minuten in 
Anspruch nehmen. Details zum Deinstallationsprozess können durch Klick auf folgendes Symbol 
![Konsolenausgabe anzeigen/verstecken]({{% asset "icons/konsolenausgabe.png" %}}?classes=icon) angezeigt werden.

![Erweiterungen im Contao Manager deinstallieren]({{% asset "images/manual/installation/de/erweiterungen-im-contao-manager-deinstallieren.png" %}}?classes=shadow)

Sobald der Contao Manager die Erweiterung(en) deinstalliert hat, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen, um die Datenbank, falls nötig, zu aktualisieren.


## Deinstallation über die Kommandozeile {#deinstallation-ueber-die-kommandozeile}

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
ssh benutzername@example.com
```

Wechsle dann auf der Konsole in das Verzeichnis deiner Contao-Installation.

```bash
cd www/example/
```

Der Befehl `remove` entfernt die Erweiterung aus der `composer.json` und löscht den Code aus dem Projekt.

Um eine Erweiterung zu entfernen und die `composer.lock` zu aktualisieren, wird der Befehl `remove` ausgeführt, 
das wird bei einigen Hostern dazu führen, dass der Prozess wegen der zu hohen Systemanforderung nicht beendet werden 
kann und die Aktualisierung dadurch fehlschlägt. In diesem Fall solltest du den 
[Contao Manager](#deinstallation-mit-dem-contao-manager) nutzen.

**Eine einzelne Erweiterung deinstallieren:**

```bash
php composer.phar remove terminal42/contao-easy_themes
```

**Mehrere Erweiterungen deinstallieren:**

```bash
php composer.phar remove terminal42/notification_center terminal42/contao-leads
```

Sobald die Deinstallation der Erweiterung(en) abgeschlossen ist, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen um die Datenbank, falls nötig, zu aktualisieren.

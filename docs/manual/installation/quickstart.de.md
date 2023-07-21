---
title: "Contao Installieren – Quickstart"
description: "Die ersten Schritte zur Contao Installation mit dem Contao Manager."
url: "installation/quickstart"
aliases:
- /de/installation/quickstart/
weight: 90
hidden: true
---

Wir gehen hier davon aus, dass du entweder die aktuellste Version oder die [Long Term Support Version](https://docs.contao.org/manual/de/installation/contao-aktualisieren/#long-term-support-versionen) mit dem Contao Manager
installieren willst. Das ist der einfachste und für Einsteiger empfohlene Weg.


## Hosting Konfiguration

Das Hosting konfigurierst du über das Admin-Panel deines Hosting-Providers.

### Wurzelverzeichnis (Document Root)

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterordner `/public` der Installation. Erstelle
dazu den Ordner `public` und setze das Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel
des Hosting-Providers auf diesen Unterordner.

**Beispiel:** `example.com` zeigt auf das Verzeichnis `/www/example/public`

### Datenbank

Contao benötigt für den Betrieb eine Datenbank 
([MySQL](../../installation/systemvoraussetzungen/#mysql-mindestanforderungen)), die Du idealerweise auch gleich 
anlegst. Die Zugangsdaten werden später benötigt.


## Den Contao Manager installieren

Der [Contao Manager](../../installation/contao-manager/) besteht aus einer einzelnen Datei, welche über 
[contao.org](https://contao.org/de/download.html) heruntergeladen werden kann. Nach erfolgreichem Download erhältst 
du eine Datei `contao-manager.phar`. Übertrage diese Datei in das Verzeichnis `public` auf deinem Webserver.

{{% notice info %}}
`.phar`-Dateien werden nicht von allen Hosting-Anbietern ausgeführt. Für beste Kompatibilität füge die
Dateiendung `.php` <b>nach dem Upload</b> hinzu (benenne die Datei <b>auf dem Server</b> in `contao-manager.phar.php` um).
{{% /notice %}}

## Contao Manager aufrufen

Rufe anschließend mit deinem Browser die URL `www.example.com/contao-manager.phar.php` auf, wobei du `www.example.com`
durch deine Domain ersetzt. Du solltest nun die Willkommensseite des Contao Managers sehen.

![Willkommensseite des Contao Managers]({{% asset "images/manual/installation/de/willkommensseite-des-contao-managers.png" %}}?classes=shadow)

### Grundkonfiguration

Bevor du nun Contao installierst, muss der Manager selbst konfiguriert werden. Lege dazu einen neuen Benutzer an, indem
du einen Benutzernamen und ein Passwort vergibst. Benutzername und Passwort sind unabhängig von der späteren Contao Installation!


### Serverkonfiguration

Der Contao Manager benötigt den Pfad zum PHP-Binary und weitere Server-Informationen, um Hintergrund-Prozesse korrekt
auszuführen. In der Regel werden diese Informationen automatisch erkannt.

![Serverkonfiguration]({{% asset "images/manual/installation/de/serverkonfiguration.png" %}}?classes=shadow)


### Composer Resolver Cloud

Die [Composer Resolver Cloud](https://composer-resolver.cloud/) erlaubt die Installation von Composer-Abhängigkeiten,
selbst wenn der Server nicht über genug Arbeitsspeicher verfügt. Bitte beachte, dass deine Paketinformationen für die
Auflösung der Abhängigkeiten an einen Cloud-Dienst der [Contao Association](https://association.contao.org/)
übermittelt werden.

### Contao mit dem Contao Manager installieren

Nach der erfolgreichen Grundkonfiguration kann nun Contao installiert werden. Dazu wählst du die gewünschte Version
sowie die initiale Konfiguration aus und klickst auf die Schaltfläche »Installieren«.

![Contao per Contao Manager installieren]({{% asset "images/manual/installation/de/contao-per-contao-manager-installieren.png" %}}?classes=shadow)

Die Installation kann nun mehrere Minuten in Anspruch nehmen. Details zum Installationsprozess können durch Klick auf
folgendes Symbol ![Konsolenausgabe anzeigen/verstecken](/de/icons/konsolenausgabe.png?classes=icon) angezeigt
werden.

![Contao wird installiert]({{% asset "images/manual/installation/de/contao-wird-installiert.png" %}}?classes=shadow)


### Datenbanktabellen aktualisieren

Sobald der Contao Manager alle Pakete installiert hat, muss die Datenbank aktualisiert werden. Dazu 
muss das [Contao-Installtool](../contao-installtool/) gestartet werden (Contao 4.13 LTS) bzw. die benötigten Informationen 
direkt im Contao Manager erfasst werden (Contao 5.x). 


## Ein Administratorkonto anlegen

Zuletzt musst du einen Administrator-Benutzer anlegen, mit dem du dich später im Contao-Backend anmelden kannst.

![Ein Administratorkonto anlegen]({{% asset "images/manual/installation/de/ein-administratorkonto-anlegen.png" %}}?classes=shadow)

**Benutzername:** Hier legst du den Benutzernamen des Administrators fest.

**Name:** Hier gibst du den Vor- und Nachnamen des Administrators ein.

**E-Mail-Adresse:** Hier gibst du die E-Mail-Adresse des Administrators ein.

**Passwort:** Hier legst du das Passwort des Administrators fest und bestätigst es.

Nachdem du den Administrator-Benutzer erstellt hast, ist die Installation von Contao abgeschlossen.  
Der Link am rechten unteren Rand bringt dich zum Backend. Dort legst Du dann 
[die erste Startseite an](../../anleitungen/die-erste-startseite/).

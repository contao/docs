---
title: "Contao umziehen"
description: "Der Umzug einer lokalen Installation auf einen Live-Server läuft fast genauso ab wie eine Neuinstallation."
url: "installation/contao-umziehen"
aliases:
    - /de/installation/contao-umziehen/
weight: 50
---

Der Umzug einer lokalen Installation auf einen Live-Server läuft fast genauso ab wie eine Neuinstallation.

{{% notice warning %}}
Um Unannehmlichkeiten beim Umzug zu verhindern, sollte auf deinem lokalen Server die 
**[selbe PHP-Version](../systemvoraussetzungen/#mindestanforderungen-an-php)** wie auf dem Live-Server laufen.
{{% /notice %}}

## Contao mit dem Contao Manager umziehen

### Datenbank auf dem lokalen Server exportieren

Ein MySQL-Dump lässt sich am einfachsten mit der Datenbankverwaltung »[phpMyAdmin](https://www.phpmyadmin.net/)« 
erstellen. Melde dich in »phpMyAdmin« an, wähle die zu exportierende Datenbank und klicke die 
»Export«-Schaltfläche im oberen Menü.

![Datenbank exportieren](/de/installation/images/de/datenbank-exportieren.png?classes=shadow)

### Datenbank auf dem Live-Server importieren

Öffne »phpMyAdmin« auf dem Zielserver und erstelle eine neue Datenbank für Contao. Je nach Serverkonfiguration ist das 
eventuell nur über die Verwaltungsoberfläche (z. B. Confixx, Plesk oder cPanel) möglich. Wähle die neue leere Datenbank 
aus und klicke auf die »Import«-Schaltfläche im oberen Menü. Lade dann den SQL-Dump der lokalen Datenbank hoch und 
starte den Import.

![Datenbank importieren](/de/installation/images/de/datenbank-importieren.png?classes=shadow)


### Contao Manager auf dem Live-Server installieren

Bevor du Contao auf deinen Server umziehen kannst, musst du den 
[Contao Manager installieren und konfigurieren](../contao-manager#contao-manager-installieren).


### Dateien auf den Live-Server übertragen {#dateien-auf-den-server-uebertragen}

Öffne dein FTP-Programm, und stelle eine Verbindung zu deinem Server her. Kopiere die folgenden Dateien und Ordner aus dem lokalen 
Contao-Verzeichnis auf den Server.

- `files`
- `templates`
- `composer.json`
- `composer.lock`

Falls du noch alte Erweiterungen unter `system/modules` abgelegt hast, eine `config.yml` im Verzeichnis `config/` 
bzw. **vor Contao 4.8** `app/config/` oder Contao Anpassungen unter `contao/` bzw. **vor Contao 4.8** `app/Resources/contao/` angelegt 
hast, müssen diese auch auf deinen Server übertragen werden.


### Contao auf dem Live-Server installieren

Melde dich im Contao Manager an. Dazu rufst du deine Domain mit dem Zusatz `/contao-manager.phar.php` auf und gibst 
deine Zugangsdaten ein.

Der Contao Manager erkennt automatisch die von dir im Hauptverzeichnis abgelegten `composer.json` und `composer.lock`. 
Wenn du auf die Schaltfläche »Installieren« klickst, führt der Manager im Hintergrund ein `composer install` aus und 
installiert Contao und die von dir in der lokalen Installation verwendeten Erweiterungen.


![Composer-Abhängigkeiten installieren](/de/installation/images/de/composer-abhaengigkeiten-installieren.png?classes=shadow)

Die Installation kann nun mehrere Minuten in Anspruch nehmen. Details zum Installationsprozess können durch Klick auf 
das Symbol ![Konsolenausgabe anzeigen/verstecken](/de/icons/konsolenausgabe.png?classes=icon) angezeigt 
werden.

![Umzug abgeschlossen](/de/installation/images/de/umzug-abgeschlossen.png?classes=shadow)

Öffne danach das [Contao-Installtool](../contao-installtool/), und gebe die Zugangsdaten zur neuen Datenbank an.


## Contao über die Kommandozeile umziehen {#contao-ueber-die-kommandozeile-umziehen}

### Datenbank auf dem lokalen Server exportieren

Ein MySQL-Dump lässt sich auf der Kommandozeile am einfachsten mit folgendem Befehl gefolgt vom Passwort erstellen.

```bash
mysqldump -h localhost -u Benutzer -p --opt Datenbankname | gzip -c > mysqldump.sql.gz
```

Die Datei wird in dem Verzeichnis abgelegt, in welchem du dich beim Absenden des Befehls befindest.


### Dateien auf den Server übertragen

Jetzt kannst du die Daten per `secure copy` auf deinen Server übertragen.

```bash
scp -r /pfad/lokal/files/ /pfad/lokal/templates/ /pfad/lokal/composer.json /pfad/lokal/composer.lock 
/pfad/lokal/mysqldump.sql.gz benutzername@example.com:server/www/example/
```


### Hosting-Konfiguration

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterorder `/web` der Installation. Setze das 
Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel des Hosting-Providers auf diesen 
Unterordner und richte bei dieser Gelegenheit noch eine Datenbank ein.

Beispiel: `example.com` zeigt auf das Verzeichnis `/www/example/web`

{{% notice note %}}
Pro Contao-Installation wird deshalb eine eigene (Sub)Domain benötigt.
{{% /notice %}}


### Datenbank auf dem Live-Server importieren

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
ssh benutzername@example.com
```

Wechsle dazu auf der Konsole in das Verzeichnis in welchem du Contao installieren willst.

```bash
cd www/example/
```

Falls [Composer noch nicht installiert](../contao-installieren/#composer-installieren) worden ist, holen 
wir das nach.

Im nächsten Schritt kannst du das MySQL-Dump mit folgendem Befehl gefolgt vom Passwort importieren.

```bash
gunzip < mysqldump.sql.gz | mysql -h localhost -u Benutzer -p Datenbankname
```


### Contao auf dem Live-Server installieren

Nachdem wir alle Vorbereitungsarbeiten erfolgreich abgeschlossen haben, installieren wir Contao mit `composer install`. 
Beim `install` werden im Gegensatz zum `update` keine Abhängigkeiten aufgelöst, diese befinden sich in der 
mitgelieferten `composer.lock`. Deshalb wird dieser Prozess auch nicht wegen zu hohen Systemanforderung schief laufen.

```bash
php composer.phar install
```

Öffne danach das [Contao-Installtool](../contao-installtool/), und gebe die Zugangsdaten zur neuen Datenbank an.

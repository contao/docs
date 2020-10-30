---
title: "Contao installieren"
description: "Es gibt zwei Wege um Contao auf deinem Server zu installieren, zum einen über die grafische Oberfläche 
des Contao Managers und zum anderen über die Kommandozeile."
url: "installation/contao-installieren"
aliases:
    - /de/installation/contao-installieren/
weight: 30
---

Nachdem du alle Voraussetzungen geprüft und deinen Webserver eingerichtet hast, kannst du nun mit der Installation 
beginnen.

Es gibt zwei Wege um Contao auf deinem Server zu installieren, zum einen über die grafische Oberfläche des [Contao 
Managers](#installation-mit-dem-contao-manager) und zum anderen über die 
[Kommandozeile](#installation-ueber-die-kommandozeile).


## Installation mit dem Contao Manager


### Contao Manager installieren

Bevor du Contao auf deinem Server installieren kannst, musst du den
[Contao Manager installieren und konfigurieren](../../installation/contao-manager/#contao-manager-installieren).


### Contao mit dem Contao Manager installieren

Nach der erfolgreichen Grundkonfiguration kann nun Contao installiert werden. Dazu wählst du die gewünschte Version 
sowie die initiale Konfiguration aus und klickst auf die Schaltfläche »Fertigstellen«. 

![Contao per Contao Manager installieren](/de/installation/images/de/contao-per-contao-manager-installieren.png?classes=shadow)

Die Installation kann nun mehrere Minuten in Anspruch nehmen. Details zum Installationsprozess können durch Klick auf 
folgendes Symbol ![Konsolenausgabe anzeigen/verstecken](/de/icons/konsolenausgabe.png?classes=icon) angezeigt 
werden.

![Contao wird installiert](/de/installation/images/de/contao-wird-installiert.png?classes=shadow)


### Datenbanktabellen aktualisieren

Sobald der Contao Manager alle Pakete installiert hat, musst du das [Contao-Installtool](../contao-installtool/)
aufrufen um die Datenbank zu aktualisieren.


## Installation über die Kommandozeile {#installation-ueber-die-kommandozeile}

Bei der Installation über die Kommandozeile wird während dem `create-project` ein `composer update` ausgeführt. Das 
wird bei einigen Hostern dazu führen, dass der Prozess wegen der zu hohen Systemanforderung nicht beendet werden kann 
und die Installation dadurch fehlschlägt. In diesem Fall solltest du den 
[Contao Manager](#installation-mit-dem-contao-manager) nutzen.


Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
ssh benutzername@example.com
```

Wechsle in das öffentliche Verzeichnis deines Webhosting.

```bash
cd www
```


### Composer installieren

[Composer](https://de.wikipedia.org/wiki/Composer_(Paketverwaltung)) ist ein anwendungsorientierter Paketmanager für 
die Programmiersprache PHP und installiert Abhängigkeiten.

Um Composer zu installieren, folge bitte der Anleitung auf der [Composer-Website](https://getcomposer.org/download/) 
und kopiere die Kommandos auch von dort, denn der SHA-Hash zum Verifizieren des Downloads ändert sich mit jeder 
Composer-Version. Zum jetzigen Zeitpunkt sehen die Kommandos wie folgt aus.

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```


### Contao über die Kommandozeile installieren

Im zweiten Schritt installierst du Contao über den Composer. Dabei steht »example« für das gewünschte 
Installations-Verzeichnis und die 4.8 für die zu [installierende Contao-Version](https://contao.org/de/download.html). 

```bash
php composer.phar create-project contao/managed-edition example 4.8
```


### Hosting-Konfiguration

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterordner `/web` der Installation. Setze das 
Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel des Hosting-Providers auf diesen 
Unterordner und richte bei dieser Gelegenheit noch eine Datenbank ein.

Beispiel: `example.com` zeigt auf das Verzeichnis `/www/example/web`

{{% notice note %}}
Pro Contao-Installation wird deshalb eine eigene (Sub)Domain benötigt.
{{% /notice %}}


### Datenbanktabellen aktualisieren

Nach der Installation kannst du die Datenbank Aktualisierung über das [Contao-Installtool](/de/installation/contao-installtool/) 
durchführen. 

Ab Contao 4.9 steht dir hierzu der folgende Befehl auf der Kommandozeile zur Verfügung:

```bash
php vendor/bin/contao-console contao:migrate
``` 

{{% notice tip %}}
Du kannst dir auf der Kommandozeile auch zuvor eine Datenbank erstellen:<br>
`php vendor/bin/contao-console doctrine:database:create`
{{% /notice %}}

{{% notice info %}}
Contao muss hierzu die entsprechenden Verbindungsdaten deiner Datenbank kennen. Diese Information kann entweder über 
eine vorhandene »config/parameters.yml« (Wird zur Zeit über das [Contao-Installtool](/de/installation/contao-installtool/) 
erstellt) oder über eine »[.env](https://docs.contao.org/dev/getting-started/starting-development/#application-configuration)« 
Datei im Hauptverzeichnis deiner Installation bereit gestellt werden.<br><br> 
Weitere Details für die notwendigen Umgebungsvariablen ([DATABASE_URL](https://docs.contao.org/dev/reference/config/#database-url) 
und [APP_SECRET](https://docs.contao.org/dev/reference/config/#app-secret)) in einer ».env« Datei findest du 
[hier](https://docs.contao.org/dev/getting-started/starting-development/#application-configuration).
{{% /notice %}}


### Contao Backend-Benutzer erstellen

Im Anschluss kannst du über folgenden Konsolen Befehl einen neuen Backend Benutzer mit Administrator Rechten anlegen:

```bash
php vendor/bin/contao-console contao:user:create --username=h.lewis --email=hlewis@demo.de --password=meinkennwort --language=de --admin
``` 


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
sowie die initiale Konfiguration aus und klickst auf die Schaltfläche »Installieren«. 

![Contao per Contao Manager installieren]({{% asset "images/manual/installation/de/contao-per-contao-manager-installieren.png" %}}?classes=shadow)

Die Installation kann nun mehrere Minuten in Anspruch nehmen. Details zum Installationsprozess können durch Klick auf 
folgendes Symbol ![Konsolenausgabe anzeigen/verstecken]({{% asset "icons/konsolenausgabe.png" %}}?classes=icon) angezeigt 
werden.

![Contao wird installiert]({{% asset "images/manual/installation/de/contao-wird-installiert.png" %}}?classes=shadow)


### Datenbanktabellen aktualisieren

Sobald der Contao Manager alle Pakete installiert hat, muss die Datenbank aktualisiert werden. Dazu kannst du das 
[Contao Install Tool]({{% relref"/installation/contao-installtool" %}}) (Contao 4.13 LTS) verwenden. Ab Contao 5 ist dies nicht mehr notwendig, 
da die Datenbank direkt über den [Contao Manager]({{% relref"installation/contao-manager" %}}) aktualisiert werden kann.


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

{{% notice info %}}
Du kannst Composer entweder [lokal](https://getcomposer.org/doc/00-intro.md#locally) 
oder [global](https://getcomposer.org/doc/00-intro.md#globally) installieren.<br>
Wenn du Composer lokal installierst, befindet sich die Datei `composer.phar` in deinem Arbeitsverzeichnis (d. h. dort, wo
auch die Dateien `composer.json` und `composer.lock` deines Projekts gespeichert sind). In diesem Fall rufst du Composer 
über `php composer.phar` auf.<br> 
Wenn du Composer global installierst, kannst du den Befehl `composer` in jedem Verzeichnis verwenden. 
{{% /notice %}}


### Contao über die Kommandozeile installieren {#contao-ueber-die-kommandozeile-installieren}

Im zweiten Schritt installierst du Contao über den Composer. Dabei steht »example« für das gewünschte 
Installations-Verzeichnis und die {{< current-version >}} für die zu [installierende Contao-Version](https://to.contao.org/release-plan).

```bash
php composer.phar create-project contao/managed-edition example {{< current-version >}}
```


### Hosting-Konfiguration

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterordner `/web` der Installation. Erstelle diesen Ordner und setze das 
Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel des Hosting-Providers auf diesen 
Unterordner und richte bei dieser Gelegenheit noch eine Datenbank ein.

Beispiel: `example.com` zeigt auf das Verzeichnis `/www/example/web`

({{< version-tag "4.12" >}} Dem Standard von Symfony folgend, wurde der öffentlich erreichbare Unterordner von `/web`
in `/public` umbenannt. Falls in deiner Installation ein Verzeichnis `/web` existiert, wird dieses von Contao
automatisch anstelle von `/public` verwendet.)

{{% notice info %}}
Pro Contao-Installation wird deshalb eine eigene (Sub)Domain benötigt.
{{% /notice %}}


### Datenbanktabellen aktualisieren

Sobald der Contao Manager alle Pakete installiert hat, muss die Datenbank aktualisiert werden. Dazu kannst du das 
[Contao Install Tool]({{% relref"/installation/contao-installtool" %}}) (Contao 4.13 LTS) verwenden. Ab Contao 5 ist dies nicht mehr notwendig, 
da die Datenbank direkt über den [Contao Manager]({{% relref"installation/contao-manager" %}}) aktualisiert werden kann.

Ab Contao 4.9 steht dir hierzu der folgende Befehl auf der Kommandozeile zur Verfügung:

```bash
php vendor/bin/contao-console contao:migrate
``` 

{{% notice tip %}}
Du kannst dir auf der Kommandozeile auch zuvor eine Datenbank erstellen:<br>
`php vendor/bin/contao-console doctrine:database:create`
{{% /notice %}}

{{% notice note %}}
Contao muss hierzu die entsprechenden Verbindungsdaten deiner Datenbank kennen. Diese Information kann entweder über 
eine vorhandene »config/parameters.yaml« (wird zur Zeit über das [Contao-Installtool](/de/installation/contao-installtool/) 
erstellt) oder über eine »[.env](https://docs.contao.org/dev/getting-started/starting-development/#application-configuration)« 
Datei im Hauptverzeichnis deiner Installation bereit gestellt werden.<br><br> 
Weitere Details für die notwendigen Umgebungsvariablen ([DATABASE_URL](https://docs.contao.org/dev/reference/config/#database-url) 
und [APP_SECRET](https://docs.contao.org/dev/reference/config/#app-secret)) in einer ».env« Datei findest du 
[hier](https://docs.contao.org/dev/getting-started/starting-development/#application-configuration).
{{% /notice %}}


### Contao Backend-Benutzer erstellen

Über den [Contao Manager]({{% relref"installation/contao-manager" %}}) kannst du dir deinen Backend Benutzer anlegen.

Ab Contao **4.10** kannst du hierzu den folgenden [Befehl]({{% relref"/cli/user" %}}) auf der [Kommandozeile]({{% relref"/cli" %}}) 
benutzen. Die notwendigen Angaben werden dann auf der Kommandozeile abgefragt:


```bash
php vendor/bin/contao-console contao:user:create
``` 

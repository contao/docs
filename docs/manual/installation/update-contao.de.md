---
title: "Contao aktualisieren"
description: "Wie die meisten Open-Source-Projekte wird auch Contao kontinuierlich weiterentwickelt."
url: "installation/contao-aktualisieren"
aliases:
    - /de/installation/contao-aktualisieren/
weight: 40
---

Wie die meisten Open-Source-Projekte wird auch Contao kontinuierlich weiterentwickelt. Mit jedem Update werden 
Komponenten aktualisiert, Fehler behoben, neue Funktionen hinzugefügt oder die Performance verbessert. Es wird daher
empfohlen, immer eine aktuelle Version zu verwenden.


### Der Contao-Update-Zyklus

Contao folgt für die Versionsbezeichnungen dem Konzept von [Semantic Versioning](https://semver.org).
Das klingt etwas gar technisch weshalb wir uns schnell gemeinsam mit der verwendeten Terminologie vertraut machen:


#### Major-Release

Bei einem Major-Release handelt es sich um eine komplett neue Version der Software, bei der viele grundlegende Dinge 
geändert wurden und mit der bereits bestehende Seiten unter Umständen nicht mehr funktionieren. Die aktuelle 
Major-Version von Contao ist beim Schreiben dieser Zeilen die **Version 4**.


#### Minor-Release

Bei einem Minor-Release handelt es sich um eine Art Meilenstein auf dem Weg der Entwicklung, bei dem neue Funktionen 
hinzugefügt wurden. Kleinere Anpassungen bestehender Seiten können daher notwendig sein. Die aktuelle Minor-Version von 
Contao ist beim Schreiben dieser Zeilen die **Version 4.8**.


#### Bugfix-Release

Bei einem Bugfix-Release handelt es sich um ein Wartungsrelease, dessen primärer Zweck die Behebung von Fehlern ist. 
Die aktuelle Bugfix-Version von Contao ist beim Schreiben dieser Zeilen die **Version 4.8.4**.


#### Long-Term-Support-Versionen

Mit Version 2.11 wurde der [Release-Zyklus von Contao](https://contao.org/de/release-plan.html) angepasst und 
[Long-Term-Support](https://de.wikipedia.org/wiki/Support_(Dienstleistung)#Long_Term_Support)-Versionen (LTS) 
eingeführt, die 24 Monate lang unterstützt und mit Updates versorgt werden, auch wenn zwischenzeitlich schon neuere 
Contao-Versionen veröffentlicht wurden. Eine Übersicht aller Contao Versionen gibt es auf 
[Wikipedia](https://de.wikipedia.org/wiki/Contao#Versionen).


### Aktualisierung mit dem Contao Manager

{{% notice note %}}
Vor der Aktualisierung von Contao wird empfohlen, ein Backup der `composer.json`,  `composer.lock` sowie der Datenbank 
anzulegen.
{{% /notice %}}

Melde dich im Contao Manager an und starte ihn.

Bei einer Aktualisierung für ein [Bugfix-Release](#bugfix-release) genügt es auf »Pakete aktualisieren« zu klicken.

Besonderheit bei einer Aktualisierung für ein [Minor-Release](#minor-release): Klicke bei »Contao Open Source CMS« auf das 
Zahnrad-Symbol und gebe die gewünschte Version ein. Durch einen Klick auf die Schaltfläche  »Pakete aktualisieren« und danach »Änderungen anwenden« schiebst du die Aktualisierung an.

![Aktualisierung für Minor-Release starten](/de/installation/images/de/aktualisierung-fuer-minor-release-starten.png?classes=shadow)

Die Aktualisierung kann nun mehrere Minuten in Anspruch nehmen. Details zum Aktualisierungsprozess können durch Klick 
auf folgendes Symbol ![Konsolenausgabe anzeigen/verstecken](/de/icons/konsolenausgabe.png?classes=icon) angezeigt 
werden.

![Aktualisierung für Minor-Release abgeschloßen](/de/installation/images/de/aktualisierung-fuer-minor-release-abgeschlossen.png?classes=shadow)


#### Datenbanktabellen aktualisieren

Öffne das [Contao-Installtool](../contao-installtool/), und überprüfe, ob nach der Aktualisierung irgendwelche 
Änderungen an deiner Datenbank notwendig sind. Führe gegebenenfalls die vorgeschlagenen Änderungen durch, und schließe 
dann das Installtool.

Deine Contao-Installation ist jetzt auf dem neuesten Stand.


### Aktualisierung über die Kommandozeile {#aktualisierung-ueber-die-kommandozeile}

{{% notice note %}}
Vor der Aktualisierung von Contao empfehle ich dir ein Backup der `composer.json`, `composer.lock` sowie der Datenbank 
anzulegen.
{{% /notice %}}

Bei der Aktualisierung über die Kommandozeile wird ein `composer update` ausgeführt. Das wird bei einigen Hostern dazu 
führen, dass der Prozess wegen der zu hohen Systemanforderung nicht beendet werden kann und die Installation dadurch 
fehlschlägt. In diesem Fall solltest du den [Contao Manager](##aktualisierung-mit-dem-contao-manager) nutzen.

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
ssh benutzername@example.com
```

Wechsle dann auf der Konsole in das Verzeichnis deiner zu aktualisierenden Contao-Installation.

```bash
cd www/example/
```

Bei einer Aktualisierung für ein [Bugfix-Release](#bugfix-release) genügt es, folgendes Kommando abzusetzen.

```bash
php composer.phar update
```

Bei einer Aktualisierung für ein [Minor-Release](#minor-release) muss die gewünschte Version des `contao/manager-bundle` 
in der `composer.json` eingetragen werden.

```json
{
    …
    "require": {
        "contao/manager-bundle": "4.8.*",
        …
    },
    …
}
```

Jetzt noch die Aktualisierung auf der Kommandozeile anstoßen.

```bash
php composer.phar update
```


#### Datenbanktabellen aktualisieren

Öffne das [Contao-Installtool](../contao-installtool/), und überprüfe, ob nach der Aktualisierung irgendwelche 
Änderungen an deiner Datenbank notwendig sind. Führe gegebenenfalls die vorgeschlagenen Änderungen durch, und schließe 
dann das Installtool.

Anstelle des Contao-Installtools kannst Du (ab Contao 4.9) zur Aktualisierung der Datenbanktabellen auf der 
Kommandozeile das Command 
```bash
$ vendor/bin/contao-console contao:migrate
``` 
verwenden.

Deine Contao-Installation ist jetzt auf dem neuesten Stand.


### Lokale Aktualisierung ohne die Composer Resolver Cloud

Das Vorgehen, das oben in ["Aktualisierung über die Kommandozeile"](#aktualisierung-ueber-die-kommandozeile) beschrieben wurde, kannst du auch lokal durchführen.
Dies hat den Vorteil, dass du im Gegensatz zur Umgebung bei einem Hoster keine Probleme mit nicht erfüllten
Systemanforderungen wie z.B. ungenügendem Arbeitsspeicher bekommst, denn du kannst die entsprechende Konfiguration
selbst nach Bedarf anpassen.


#### Voraussetzungen

Was benötigst Du auf deinem Computer?

- ein beliebiges Verzeichnis, in dem Du arbeitest (dein Arbeitsverzeichnis)
- PHP, idealerweise in der gleichen Version, wie sie auf deinem Hosting verwendet wird.  
- Composer (wir gehen hier davon aus, dass du Composer in deinem Arbeitsverzeichnis installierst)
- Kopien der `composer.json` und `composer.lock` der Contao-Installation bei deinem Hoster

Was benötigst du _nicht_?

- MySQL
- Eine lokale Contao-Installation


#### Die Aktualisierung durchführen

Kopiere die `composer.json` und `composer.lock` von deinem Hosting in dein Arbeitsverzeichnis.
Im Wesentlichen machst du dann das Gleiche, wie oben unter
["Aktualisierung über die Kommandozeile"](#aktualisierung-ueber-die-kommandozeile) beschrieben:
 
Öffne ein Terminal und wechsle in das Arbeitsverzeichnis. Führe dort

```bash
php composer.phar update
```

aus. Nach dem erfolgreichen Abschluss der Aktualisierung kopierst du die aktualisierte `composer.lock`
(und die `composer.json`, falls du dort Änderungen gemacht hast) zurück in die Contao-Installation 
auf deinem Hosting. 

Danach meldest du dich entweder per `ssh` auf deinem Server (Hosting) an

```bash
ssh benutzername@example.com
```

und lässt Composer die aktualisierten Pakete installieren

```bash
php composer.phar install
```

oder du verwendest den Contao Manager. Dort wählts du unter Systemwartung den Punkt Composer-Abhängigkeiten, Installer ausführen

![Paketinstallation mit demContao-Manager](/de/installation/images/de/composer-install-mit-dem-contao-manager.png?classes=shadow)

Zum Abschluss musst du noch die Datenbanktabellen aktualisieren. 


#### Datenbanktabellen aktualisieren

Öffne das [Contao-Installtool](../contao-installtool/), und überprüfe, ob nach der Aktualisierung irgendwelche 
Änderungen an deiner Datenbank notwendig sind. Führe gegebenenfalls die vorgeschlagenen Änderungen durch und schließe 
dann das Installtool.

Anstelle des Contao-Installtools kannst du (ab Contao 4.9) zur Aktualisierung der Datenbanktabellen auf der 
Kommandozeile das Command 
```bash
$ vendor/bin/contao-console contao:migrate
``` 
verwenden.

Deine Contao-Installation ist jetzt auf dem neuesten Stand.


#### Verschiedene PHP-Versionen

Wenn die lokal verwendete PHP-Version eine andere ist, als bei deinem Hosting, musst du in der `composer.json`
angeben, welche PHP-Version verwendet werden soll:

```json
    ...
    "config": {
        "platform": {
            "php": "7.4"
        }
    },
    "require": {
        ...
```

#### Ausblick

Wenn dir das zu viele Einzelschritte sind, kannst du den Prozess auch per Skript ausführen lassen. Das könnte in etwa
so aussehen:

```bash
# Der Pfad zur Contao-Installation auf deinem Hosting
REMOTE_PATH=/mein/installationsverzeichnis/beim/hoster

# composer.json und composer.lock vom Hosting holen
scp user@host:${REMOTE_PATH}/composer.json composer.json
scp user@host:${REMOTE_PATH}/composer.lock composer.lock

# lokales Update
php composer update

# composer.json und composer.lock zurück zum Hosting
scp composer.json user@host:${REMOTE_PATH}/composer.json
scp composer.lock user@host:${REMOTE_PATH}/composer.lock

# composer install auf dem Hosting
ssh user@host "cd ${REMOTE_PATH} && php composer.phar install"
ssh user@host "cd ${REMOTE_PATH} && vendor/bin/contao-console contao:migrate --no-interaction --with-deletes"
```

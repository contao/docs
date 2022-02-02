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


## Der Contao-Update-Zyklus

Contao folgt für die Versionsbezeichnungen dem Konzept von [Semantic Versioning](https://semver.org).
Das klingt etwas gar technisch weshalb wir uns schnell gemeinsam mit der verwendeten Terminologie vertraut machen:


### Major-Release

Bei einem Major-Release handelt es sich um eine komplett neue Version der Software, bei der viele grundlegende Dinge 
geändert wurden und mit der bereits bestehende Seiten unter Umständen nicht mehr funktionieren. Die aktuelle 
Major-Version von Contao ist beim Schreiben dieser Zeilen die **Version 4**.


### Minor-Release

Bei einem Minor-Release handelt es sich um eine Art Meilenstein auf dem Weg der Entwicklung, bei dem neue Funktionen 
hinzugefügt wurden. Kleinere Anpassungen bestehender Seiten können daher notwendig sein. Die aktuelle Minor-Version von 
Contao ist beim Schreiben dieser Zeilen die **Version 4.8**.


### Bugfix-Release

Bei einem Bugfix-Release handelt es sich um ein Wartungsrelease, dessen primärer Zweck die Behebung von Fehlern ist. 
Die aktuelle Bugfix-Version von Contao ist beim Schreiben dieser Zeilen die **Version 4.8.4**.


### Long-Term-Support-Versionen

Der [Release-Zyklus](https://contao.org/de/release-plan.html) von Contao beinhaltet auch Versionen mit 
[Long Term Support](https://de.wikipedia.org/wiki/Support_(Dienstleistung)#Long_Term_Support). Die Contao-Versionen mit verlängertem Supportzeitraum werden während 3 Jahren mit Bugfixes und 1 Jahr mit  sicherheitsrelevante Updates
versorgt, auch wenn zwischenzeitlich schon neuere Contao-Versionen veröffentlicht wurden. Eine Übersicht 
aller Contao-Versionen gibt es auf [Wikipedia](https://de.wikipedia.org/wiki/Contao#Versionen).


## Aktualisierung mit dem Contao Manager

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


### Datenbanktabellen aktualisieren

Öffne das [Contao-Installtool](../contao-installtool/), und überprüfe, ob nach der Aktualisierung irgendwelche 
Änderungen an deiner Datenbank notwendig sind. Führe gegebenenfalls die vorgeschlagenen Änderungen durch, und schließe 
dann das Installtool.

Deine Contao-Installation ist jetzt auf dem neuesten Stand.


## Aktualisierung über die Kommandozeile {#aktualisierung-ueber-die-kommandozeile}

{{% notice note %}}
 Um Contao über die Kommandozeile aktualisieren zu können, muss Composer 
 [installiert](/de/installation/contao-installieren/#composer-installieren) sein. 
{{% /notice %}}

{{% notice note %}}
Vor der Aktualisierung von Contao empfehle ich dir ein Backup der `composer.json`, `composer.lock` sowie der Datenbank 
anzulegen.
{{% /notice %}}

Bei der Aktualisierung über die Kommandozeile wird ein `composer update` ausgeführt. Das wird bei einigen Hostern dazu 
führen, dass der Prozess wegen der zu hohen Systemanforderung nicht beendet werden kann und die Installation dadurch 
fehlschlägt. In diesem Fall solltest du den [Contao Manager](##aktualisierung-mit-dem-contao-manager) nutzen.

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```bash
$ ssh benutzername@example.com
```

Wechsle dann auf der Konsole in das Verzeichnis deiner zu aktualisierenden Contao-Installation.

```bash
$ cd www/example/
```

Bei einer Aktualisierung für ein [Bugfix-Release](#bugfix-release) genügt es, folgendes Kommando abzusetzen.

```bash
$ composer update
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
$ composer update
```


### Datenbanktabellen aktualisieren

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


## Lokale Aktualisierung ohne die Composer Resolver Cloud

Die Vorgehensweisen, die oben in [Aktualisierung über die Kommandozeile](#aktualisierung-ueber-die-kommandozeile) 
und [Aktualisierung mit dem Contao Manager](#aktualisierung-mit-dem-contao-manager) beschrieben wurden, kannst du
auch lokal durchführen. Dies hat den Vorteil, dass du im Gegensatz zur Umgebung bei einem Hoster keine Probleme mit 
nicht erfüllten Systemanforderungen wie z. B. ungenügendem Arbeitsspeicher bekommst, denn du kannst die entsprechende 
Konfiguration selbst nach Bedarf anpassen.



### Voraussetzungen bei Verwendung der Kommandozeile

Was benötigst du auf deinem Computer?

- ein beliebiges Verzeichnis, in dem du arbeitest (dein Arbeitsverzeichnis)
- PHP, idealerweise in der gleichen Version, wie sie auf deinem Hosting verwendet wird.  
- Composer (wir gehen hier davon aus, dass du Composer global [installierst](../contao-installieren/#composer-installieren)
- Kopien der `composer.json` und `composer.lock` der Contao-Installation bei deinem Hoster

Was benötigst du _nicht_?

- MySQL
- Eine lokale Contao-Installation


### Die Aktualisierung durchführen

Kopiere die `composer.json` und `composer.lock` von deinem Hosting in dein Arbeitsverzeichnis.
Im Wesentlichen machst du dann das Gleiche, wie oben unter
[Aktualisierung über die Kommandozeile](#aktualisierung-ueber-die-kommandozeile) beschrieben:
 
Öffne ein Terminal und wechsle in das Arbeitsverzeichnis. Führe dort

```bash
$ composer update
```

aus. Nach dem erfolgreichen Abschluss der Aktualisierung kopierst du die aktualisierte `composer.lock`
(und die `composer.json`, falls du dort Änderungen gemacht hast) zurück in die Contao-Installation 
auf deinem Hosting. 

Danach meldest du dich entweder per `ssh` auf deinem Server (Hosting) an

```bash
$ ssh benutzername@example.com
```

und lässt Composer die aktualisierten Pakete installieren

```bash
$ composer install
```

oder du verwendest den Contao Manager. Dort wählst du unter »Systemwartung« den Punkt »Composer-Abhängigkeiten«, »Installer 
ausführen«.

![composer install mit dem Contao-Manager](/de/installation/images/de/composer-install-mit-dem-contao-manager.png?classes=shadow)

Zum Abschluss musst du noch die Datenbanktabellen aktualisieren. 


### Datenbanktabellen aktualisieren

Öffne das [Contao-Installtool](../contao-installtool/) und überprüfe, ob nach der Aktualisierung Änderungen an deiner 
Datenbank notwendig sind. Führe gegebenenfalls die vorgeschlagenen Änderungen durch und schließe dann das Installtool.

Anstelle des Contao-Installtools kannst du (ab Contao 4.9) zur Aktualisierung der Datenbanktabellen auf der 
Kommandozeile das Command 
```bash
$ vendor/bin/contao-console contao:migrate
``` 
verwenden.

Deine Contao-Installation ist jetzt auf dem neuesten Stand.


### Verschiedene PHP-Versionen

Wenn die lokal verwendete PHP-Version eine andere ist, als bei deinem Hosting, musst du in der `composer.json`
angeben, welche PHP-Version verwendet werden soll:

```json 
    ...
    "config": {
        "platform": {
            "php": "7.4.99"
        }
    },
    "require": {
        ...
    }
    ...
```

### Lokale Updates mit dem Contao Manager

Du benötigst eine lokale Contao-Installation. In dieser installierst du den Contao Manager und führst das Update wie
im Abschnitt [Aktualisierung mit dem Contao Manager](#aktualisierung-mit-dem-contao-manager) beschrieben durch. 

Stelle zuvor jedoch sicher, daß die Composer Resolver Cloud nicht verwendet wird. Du benötigst sie nicht, da du auf 
deinem eigenen Server genügend Arbeitsspeicher bereitstellen kannst und entlastest so die Cloud.

Die Einstellung findest du in der »Systemprüfung« im Bereich »Serverkonfiguration«.

![Deaktivierung der Composer Resolver Cloud](/de/installation/images/de/cloud_resolver_abschalten.png?classes=shadow)

Nach dem erfolgreichen Update überträgst du wie im vorherigen Abschnitt beschrieben die `composer.json` und 
`composer.lock` zurück in die Contao-Installation auf deinem Hosting. Die weiteren Schritte auf deinem Hosting sind die 
gleichen wie oben beschrieben.
 
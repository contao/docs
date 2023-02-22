---
title: "Contao umziehen"
description: "Der Umzug einer Contao-Installation läuft fast genauso ab wie eine Neuinstallation."
url: "installation/contao-umziehen"
aliases:
    - /de/installation/contao-umziehen/
weight: 50
---

Der Umzug einer Contao Installation (z.&nbsp;B. vom lokalen System auf den Live-Server) läuft fast genauso ab wie eine
[Neuinstallation](../contao-installieren/). Hinzu kommen der Transfer der bestehenden Datenbank sowie anwendungsspezifische
Dateien.

1. [Datenbank übertragen](#datenbank-übertragen)
2. [Dateien übertragen](#dateien-übertragen)
3. [Contao installieren](#contao-installieren)

{{% notice warning %}}
Um Unannehmlichkeiten beim Umzug zu verhindern, sollte auf deinem lokalen Server die 
**[selbe PHP-Version](../systemvoraussetzungen/#mindestanforderungen-an-php)** wie auf dem Live-Server laufen.
{{% /notice %}}


## Datenbank übertragen
### Export der Datenbank (Quelle)
Ein Abbild der Datenbank (SQL-Dump) lässt sich entweder mit der grafischen Datenbankverwaltung »[phpMyAdmin](https://www.phpmyadmin.net/)« 
oder über das `mysqldump` Programm auf der Kommandozeile erstellen.

{{< tabs groupId="mysql-transfer" >}}
{{% tab name="phpMyAdmin" %}}
Melde dich in "phpMyAdmin" an und wähle die zu exportierende Datenbank aus. Wechsle dann in den "Exportieren"-Tab im 
oberen Menü und bestätige mit "Ok".

Du erhälst eine `sql`-Datei, die du im nächsten Schritt importieren kannst.

![Exporting the database](/de/installation/images/de/datenbank-exportieren.png?classes=shadow)
{{% /tab %}}
{{% tab name="Command line" %}}
Stelle sicher, dass `mysqldump` und `gzip` installiert sind, dann führe folgendes Kommando aus (dabei ersetzt du 
"my_user" mit deinem Datenbank-Benutzernamen sowie "my_db_name" mit dem Namen der Datenbank):

```bash
mysqldump --host=localhost --user=my_user --password --hex-blob --opt my_db_name | gzip -c > my_dump.sql.gz
```

Gib dein Passwort ein, wenn du danach gefragt wirst.

Alle Inhalte der Datenbank wurden nun in die Datei `my_dump.sql.gz` geschrieben – verwende diese im nächsten Schritt.
{{% /tab %}}
{{< /tabs >}}


### Import der Datenbank (Ziel)
{{< tabs groupId="mysql-transfer" >}}
{{% tab name="phpMyAdmin" %}}
Öffne »phpMyAdmin« auf dem Zielserver und wähle die neue leere Datenbank aus.

Klicke auf die »Import«-Schaltfläche im oberen Menü, lade dann den zuvor erstellten SQL-Dump hoch und starte den Import.

![Importing the database](/de/installation/images/de/datenbank-importieren.png?classes=shadow)

{{% /tab %}}
{{% tab name="Command line" %}}
Kopiere den zuvor erstellten SQL-Dump auf den Zielserver und navigiere zur Datei. 

Stelle sicher, dass `mysql` und `gunzip` installiert sind und führe das folgende Kommando aus (dabei ersetzt du 
"my_user" mit deinem Datenbank-Benutzernamen, "my_db_name" mit dem Namen der Datenbank und "my_dump.sql.gz" mit dem
Dateinamen des kopierten SQL-Dumps):

```bash
gunzip < my_dump.sql.gz | mysql --host=localhost --user=my_user --password my_db_name
```

Gib dein Passwort ein, wenn du danach gefragt wirst.

{{% /tab %}}
{{< /tabs >}}


## Einstellungen notieren
Deine Einstellungen unter `System / Einstellungen` oder im Seitenroot notierst du dir am besten und trägst sie später erneut ein.

{{% notice tip %}}
Wenn du deine [Einstellungen in einer Umgebungsvariablen ablegst](https://docs.contao.org/manual/de/system/einstellungen/#umgebungsvariablen), entfällt dieser Schritt.
{{% /notice %}} 

## Dateien übertragen
Die folgenden Dateien und Ordner müssen vom Quell- zum Zielserver übertragen werden:

- `files`
- `templates`
- `composer.json`

Die folgenden Dateien und Ordner sollten - sofern genutzt - vom Quell- zum Zielserver übertragen werden:

- `config`  (bzw. **vor Contao 4.8** `app/config/`)
- `contao`  (bzw. **vor Contao 4.8** `app/Resources/contao/`
- `src`
- `.env*`

Falls du noch alte Erweiterungen unter `system/modules` abgelegt hast, alte Konfigurationen unter `system/config` angelegt hast, müssen diese auch auf deinen Server übertragen werden.

Du kannst dazu entweder einen FTP-Client verwenden oder – falls du die Konsole bevorzugst – das Programm `scp`:

```bash
cd /path/to/project

scp -r files/ templates/ composer.json composer.lock your_server:/www/project/
```

## Contao installieren

1. Stelle sicher, dass deine  [Hosting-Konfiguration](../contao-installieren/#hosting-konfiguration) korrekt ist.
2. Führe dann eine Installation mit *Composer* aus – da du zuvor auch die `composer.lock`-Datei übertragen hast, die
   Details über alle installierten Paket-Versionen enthält, wird Composer den identischen Stand wie auf dem Quellsystem
   herstellen.
   Nutze dazu entweder den [Contao Manager](../contao-installieren/#installation-mit-dem-contao-manager) oder die [Kommandozeile](../contao-installieren/#installation-ueber-die-kommandozeile).
3. Führe dann das [Contao-Installtool](../contao-installtool) aus, um die neue Datenbankverbindung einzurichten.

Das war's! Du kannst deine Contao Installation jetzt am neuen Ort nutzen. 

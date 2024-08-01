---
title: "contao:user"
description: "Contao Benutzer anlegen und auflisten."
aliases:
    - /de/cli/user/
---


Hierüber können, nachdem die [Datenbank](/de/cli/migrate/) erstellt wurde, Contao-[Benutzer](/de/benutzerverwaltung/benutzer/) angelegt, 
aufgelistet und Passwörter geändert werden. 


## contao:user:list

Listet bestehende Contao-Benutzer auf:

| Option | Beschreibung |
| --- | --- |
| `--help`   | Übersicht der Optionen |
| `--admins` | Nur Administratoren zeigen |
| `--column=SPALTE` | Die in der Tabelle anzuzeigende Spalte (mehrere Werte sind zulässig)  |
| `--format=FORMAT` | Ausgabeformat ( txt, json ) |

```bash
php vendor/bin/contao-console contao:user:list --help
```


## contao:user:create

Erstellt einen Contao-Benutzer. Es wird interaktiv nach allen Angaben des Benutzers gefragt, wenn der Befehl ohne Optionen ausgeführt wird.

| Option | Beschreibung |
| --- | --- |
| `--help`   | Übersicht der Optionen |
| `--username` | Der Benutzer Name |
| `--name` | Der vollständige Benutzer Name |
| `--email` | Die Benutzer E-Mail Adresse |
| `--password` | Das Benutzer Passwort |
| `--admin` | Benutzer ist Administrator |
| `--group` | Gruppen, die dem Benutzer zugewiesen werden sollen (mehrere Werte sind zulässig) |
| `--change-password` | Benutzer auffordern, das Passwort bei der ersten Anmeldung im Backend zu ändern |

```bash
php vendor/bin/contao-console contao:user:create --help
```


## contao:user:password

Änderung eines Benutzer-Passwortes (Erfordert einen Benutzernamen als Argument). Es wird interaktiv nach allen Angaben gefragt, 
wenn der Befehl ohne Optionen ausgeführt wird.

```bash
php vendor/bin/contao-console contao:user:password --help
```

| Option | Beschreibung |
| --- | --- |
| `--help`   | Übersicht der Optionen |
| `--username` | Angabe des Benutzernamen |
| `--password` | Das neue Passwort ( die Verwendung dieser Option wird aus Sicherheitsgründen nicht empfohlen ) |
| `--require-change` | Mit Aufforderung, das Passwort bei der nächsten Anmeldung zu ändern |


{{% notice warning %}}
Aus Sicherheitsgründen sollte außerhalb einer [lokalen Installation](/de/anleitungen/lokale-installation/) ein Passwort nicht als 
Option direkt auf der Konsole übergeben werden, da das Passwort dann im Klartext in der Bash-History gespeichert wird.
{{% /notice %}}
---
title: "contao:user"
description: "Contao Benutzer anlegen und auflisten."
aliases:
    - /de/cli/user/
---


Hierüber können, nachdem die [Datenbank](/de/cli/migrate/) erstellt wurde, Contao [Benutzer](/de/benutzerverwaltung/benutzer/) angelegt, 
aufgelistet und Paswörter geändert werden. Eine Übersicht der Befehle erhälst du über:

```bash
php vendor/bin/contao-console contao:user --help
```

## contao:user:list

Listet bestehende Contao Benutzer auf:

| Option | Beschreibung |
| --- | --- |
| `--help`   | Übersicht der Optionen |
| `--admins` | Nur Administratoren zeigen |

```bash
php vendor/bin/contao-console contao:user:list --help
```


## contao:user:create

Erstellt einen Contao Benutzer:

| Option | Beschreibung |
| --- | --- |
| `--help`   | Übersicht der Optionen |
| `--username` | Der Benutzer Name |
| `--name` | Der vollständige Benutzer Name |
| `--email` | Die Benutzer E-Mail Adresse |
| `--password` | Das Benutzer Passwort |
| `--admin` | Benutzer ist Administrator |
| `--group` | Gruppen, die dem Benutzer zugewiesen werden sollen |
| `--change-password` | Benutzer auffordern, das Passwort bei der ersten Anmeldung im Backend zu ändern |

```bash
php vendor/bin/contao-console contao:user:create --help
```


## contao:user:password

Änderung eines Benutzer Passwortes:

```bash
php vendor/bin/contao-console contao:user:password --help
```

---
title: "contao:user"
description: "Create and list Contao users."
aliases:
    - /en/cli/user/
---


After the [database](/en/cli/migrate/) has been created, Contao [users](/en/user-management/users/) can be created here. You can get 
an overview of the commands via:

```bash
php vendor/bin/contao-console contao:user --help
```

## contao:user:list

Lists existing Contao users:

| Option | Beschreibung |
| --- | --- |
| `--help`   | Options overview |
| `--admins` | Show administrators only |

```bash
php vendor/bin/contao-console contao:user:list --help
```


## contao:user:create

Creates a Contao user:

| Option | Beschreibung |
| --- | --- |
| `--help`   | Options overview |
| `--username` | User name |
| `--name` | Full user name |
| `--email` | The user e-mail address |
| `--password` | User password |
| `--admin` | User is administrator |
| `--group` | Groups to be assigned to the user |
| `--change-password` | Prompt users to change their password when they first log in to the backend |

```bash
php vendor/bin/contao-console contao:user:create --help
```


## contao:user:password

Change of a user password:

```bash
php vendor/bin/contao-console contao:user:password --help
```

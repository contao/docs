---
title: "contao:user"
description: "Create and list Contao users."
aliases:
    - /en/cli/user/
---


After the [database](/en/cli/migrate/) has been created, Contao [users](/en/user-management/users/) can be created here.


## contao:user:list

Lists existing Contao users:

| Option | Description |
| --- | --- |
| `--help`   | Options overview |
| `--admins` | Show administrators only |
| `--column=COLUMN` | The columns display in the table (multiple values are allowed) |
| `--format=FORMAT` | Output format ( txt, json ) |

```bash
php vendor/bin/contao-console contao:user:list --help
```


## contao:user:create

Creates a Contao user. If the command is executed without options, the user is interactively prompted for all details.

| Option | Description |
| --- | --- |
| `--help`   | Options overview |
| `--username` | User name |
| `--name` | Full user name |
| `--email` | The user e-mail address |
| `--password` | User password |
| `--admin` | User is administrator |
| `--group` | Groups to be assigned to the user (multiple values are allowed) |
| `--change-password` | Prompt users to change their password when they first log in to the backend |

```bash
php vendor/bin/contao-console contao:user:create --help
```


## contao:user:password

Change of a user password ( requires a username as an argument ). If the command is executed without options, 
the required information is requested interactively.

```bash
php vendor/bin/contao-console contao:user:password --help
```

| Option | Description |
| --- | --- |
| `--help`   | Options overview |
| `--username` | The username of the back end user |
| `--password` | The new password ( using this option is not recommended for security reasons ) |
| `--require-change` | Require the user to change the password on their next login |


{{% notice warning %}}
For security reasons, outside of a [local installation](/en/guides/local-installation/), a password should not be passed 
as an option directly on the CLI, as the password is then saved in plain text in the bash history.
{{% /notice %}}
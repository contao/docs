---
title: "Composer"
description: 
weight: 2
---

## Installing with Composer


### Install Composer

You can also install Contao with Composer using the [contao/managed-edition][1] 
repository.

Follow the instructions on the [Composer website][2] and copy the commands from
there as well, because the SHA hash to verify the download changes with each
version of Composer. Below you will find the commands that were current at the
time this has been written.

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

On Windows, you can download and run the [installer][3].


### Install Contao

Now, you can run the installation process of Contao with the following command:

````bash
php composer.phar create-project contao/managed-edition <target>
````

You have to replace the `<target>` parameter with a path to a folder where
the Contao files will be created. If the target folder does not exist, it
will be created automatically.

{{% notice note %}}
The command above always installs the latest stable version. If you want to
install a specific version, you must insert it in the command as for example: 
<code>php composer.phar create-project contao/managed-edition <ziel> '4.7.*'</code>
{{% /notice %}}

{{% notice note %}}
On Windows, depending on the setup (e.g. default XAMPP), you might need run this
command as an administrator.
{{% /notice %}}


### Document root

In production, make sure to specify the `web/` directory as the document root
of your website (e.g. using the admin panel of your web hosting provider).

{{% notice note %}}
More detailed information relating to the folder structure can be found on
this [page]( ../../introduction/folder-structure/).
{{% /notice %}}




[1]: https://github.com/contao/managed-edition
[2]: https://getcomposer.org/download/
[3]: https://getcomposer.org/doc/00-intro.md#using-the-installer

---
title: 'Contao Manager error'
description: ''
url: "installation/contao-manager-error"
aliases:
    - /en/installation/contao-manager-error/
---

## The Contao Manager cannot be accessed

You have downloaded the Contao Manager, consisting of a single file, from [contao.org](https://contao.org/de/download.html) 
and transferred the file `contao-manager.phar.php` to the `public` directory on your web server.

The download file `contao-manager.phar.php` is a PHP script that downloads the required file in the background
and then overwrites itself.

However, when you call up the URL `www.example.com/contao-manager.phar.php`, the welcome page of the Contao
Manager does not appear.

In this case, you can try uploading the [`.phar` file](https://download.contao.org/contao-manager.phar) directly.


{{% notice note %}}
`.phar` files are not executed by all hosting providers. For best compatibility, add the file extension `.php`(final
file name: `contao-manager.phar.php`).
{{% /notice %}}

{{% notice warning %}}
`.php` files are transferred by most FTP programs in text mode instead of binary mode, which destroys the manager file.
Therefore, add the file extension `.php` only after the upload.
{{% /notice %}}
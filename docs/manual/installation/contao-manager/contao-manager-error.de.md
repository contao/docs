---
title: "Contao Manager Fehler"
description: ""
url: "installation/contao-manager-error"
aliases:
    - /de/installation/contao-manager-fehler/
---

## Der Contao Manager kann nicht aufgerufen werden

Du hast den Contao Manager, bestehend aus einer einzelnen Datei, über [contao.org](https://contao.org/de/download.html)
heruntergeladen. Die Datei `contao-manager.phar.php` hast du in das Verzeichnis `public` auf deinem Webserver übertragen.

Die Download-Datei `contao-manager.phar.php` ist ein PHP-Script, welches dir im Hintergrund die benötigte Datei
herunterlädt und sich danach selber überschreibt.

Beim Aufruf der URL `www.example.com/contao-manager.phar.php` erscheint jedoch nicht die Willkommensseite des Contao 
Managers.

In diesem Fall kannst du versuchen, die [`.phar`-Datei](https://download.contao.org/contao-manager.phar) direkt 
hochzuladen.


{{% notice note %}}
`.phar`-Dateien werden nicht von allen Hosting-Anbietern ausgeführt. Für beste Kompatibilität füge die
Dateiendung `.php` hinzu (Finaler Dateiname: `contao-manager.phar.php`).
{{% /notice %}}

{{% notice warning %}}
`.php`-Dateien werden von den meisten FTP-Programmen im Text- statt Binär-Modus übertragen, was die
Manager-Datei zerstört. Füge deshalb die Dateiendung `.php` erst nach dem Upload hinzu.
{{% /notice %}}
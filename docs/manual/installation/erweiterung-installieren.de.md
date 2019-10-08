---
title: "Erweiterungen installieren"
description: "Um eine passende Erweiterung für eine gewünschte Funktion zu finden, hast du drei Möglichkeiten."
weight: 6
---


## Erweiterungen suchen

Um eine passende Erweiterung für eine gewünschte Funktion zu finden, hast du drei Möglichkeiten.

- Du kannst auf der Website [extensions.contao.org](https://extensions.contao.org/) ein Erweiterung suchen.  
![Erweiterungssuche auf extensions.contao.org](/installation/images/de/erweiterungssuche-extensions-contao-org.png)
- Du kannst im Contao Manager deiner Installation eine Erweiterung suchen.  
![Erweiterungssuche im Contao Manager](/installation/images/de/erweiterungssuche-im-contao-manager.png)
- Du kannst über die Kommandozeile eine Erweiterung suchen.  
**Suche z. B. nach Erweiterungen der Firma »codefog«:**
```shell script
php composer.phar search codefog
```
**Resultat der Suche:**
```shell script
codefog/contao-haste haste extension for Contao Open Source CMS
codefog/contao-cookiebar cookiebar extension for Contao Open Source CMS
codefog/contao-news_categories News Categories bundle for Contao Open Source CMS
codefog/tags-bundle Tags bundle for Contao Open Source CMS
codefog/contao-social_images social_images extension for Contao Open Source CMS
codefog/contao-mobile_menu mobile_menu extension for Contao Open Source CMS
codefog/contao-bootstrap Bootstrap extension for Contao Open Source CMS
codefog/contao-widget_tree_picker widget_tree_picker extension for Contao Open Source CMS
codefog/contao-polls polls extension for Contao Open Source CMS
codefog/contao-member_export Member Export bundle for Contao Open Source CMS
codefog/contao-link-registry Link Registry bundle for Contao Open Source CMS
codefog/contao-instagram Instagram for Contao Open Source CMS
codefog/contao-events_subscriptions events_subscriptions extension for Contao Open Source CMS
codefog/contao-template_override template_override extension for Contao Open Source CMS
codefog/contao-elements-filter elements-filter extension for Contao Open Source CMS
```

Hast du die gewünschte Erweiterung gefunden, kannst du diese über den 
[Contao Manager](#installation-mit-dem-contao-manager) oder die [Kommandozeile](#installation-ueber-die-kommandozeile) 
installieren.


## Erweiterungen installieren

### Installation mit dem Contao Manager 

Du musst dich zunächst wieder am Contao Manager anmelden. Dazu rufst du erneut deine Domain mit dem Zusatz 
`/contao-manager.phar.php` auf und gibst deine Zugangsdaten ein.

Wenn du die Erweiterung »contao-easy_themes« installieren möchtest, gebe »EasyThemes« im Suchschlitz ein und klicke auf 
»Hinzufügen«. Wiederhole die Suche, wenn du weitere Erweiterungen finden und zur Installation vormerken möchtest.

![Erweiterungen im Contao Manager suchen](/installation/images/de/erweiterungen-im-contao-manager-suchen.png)

Wechsle danach in den Reiter »Pakete« und klicke auf »Änderungen anwenden« un die Installation zu starten. Die 
Installation kann nun mehrere Minuten in Anspruch nehmen. Details zum Installationsprozess können durch Klick auf 
folgendes Symbol ![Konsolenausgabe anzeigen/verstecken](/icons/konsolenausgabe.png?classes=icon) angezeigt werden.

![Erweiterungen im Contao Manager installieren](/installation/images/de/erweiterungen-im-contao-manager-installieren.png)

Sobald der Contao Manager die Erweiterungen installiert hat, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen um die Datenbank zu aktualisieren.

![Erweiterungen im Contao Manager installiert](/installation/images/de/erweiterungen-im-contao-manager-installiert.png)




### Installation über die Kommandozeile {#installation-ueber-die-kommandozeile}

Du hast dich mit deinem Benutzernamen und deiner Domain auf deinem Server angemeldet.

```shell script
ssh benutzername@example.com
```

Wechsle dazu auf der Konsole in das Verzeichnis deiner Contao-Installation.

```shell script
cd www/example/
```

Mit dem Befehl `require` fügst du der Datei `composer.json` das neue Paket hinzu und lädst diese, sowie alle Pakete, 
von der dieses Paket anhängig sind, herunter.

**Ein einzelne Erweiterung installieren:**
```shell script
php composer.phar require terminal42/contao-easy_themes
```

**Mehrere Erweiterungen installieren:**
```shell script
php composer.phar require terminal42/notification_center terminal42/contao-leads
```

Sobald die Erweiterungen installiert worden sind, musst du das [Contao-Installtool](../contao-installtool/) 
aufrufen um die Datenbank zu aktualisieren.

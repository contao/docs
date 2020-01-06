---
title: Contao News Facebook Sync
menuTitle: News Facebook Sync
description: Contao News Facebook Sync ist eine kostenpflichtige Erweiterungen zur Synchronisierung von Facebook Posts mit einem Nachrichtenarchiv.
url: erweiterungen/news-facebook
---

**[inspiredminds/contao-news-facebook](https://extensions.contao.org/?q=news%20face&pages=1&p=inspiredminds%2Fcontao-news-facebook)**

_von [inspiredminds](https://www.inspiredminds.at/)_

_Projekt Webseite unter [Contao News Facebook Sync](https://www.inspiredminds.at/contao-news-facebook)_

Mit dieser Extension können automatisch Posts von Facebook Pages (oder Gruppen) als Nachrichten in Nachrichtenarchive
importiert werden. Es können außerdem automatisch Nachrichten auf Facebook Seiten gepostet werden. Dadurch ist es
möglich, ein Nachrichtenarchiv mit einer Facebook Seite synchron zu halten.


## Installation

Um diese Erweiterung zu installieren, muss zuerst die `composer.json` der eigenen Contao Installation modifiziert werden.
Dabei sind zwei Anpassungen notwendig: das private Repository hinzufügen und die Abhängigkeit hinzufügen.

Um das Repository hinzuzufügen, muss folgendes in der `composer.json` eingefügt werden:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```

`<YOUR_TOKEN>` muss mit dem Repository Token ersetzt werden, welches von inspiredminds geschickt wurde.

Um die Abhängigkeit hinzuzufügen, muss folgendes in der `composer.json` eingefügt werden:

```json
{
    "require": {
        "inspiredminds/contao-news-facebook": "^6.0"
    }
}
```

{{% expand "Komplettes Beispiel anzeigen" %}}
```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "license": "LGPL-3.0-or-later",
    "authors": [
        {
            "name": "Leo Feyer",
            "homepage": "https://github.com/leofeyer"
        }
    ],
    "require": {
        "php": "^7.1",
        "contao/conflicts": "@dev",
        "contao/manager-bundle": "4.9.*",
        "inspiredminds/contao-news-facebook": "^6.0"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.2"
        }
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```
{{% /expand %}}

Nachdem diese Änderungen gemacht wurden, kann nun ein `composer update` auf der Kommandozeile oder eine
Paketaktualisierung im Contao Manager durchgeführt werden. Danach wie gewohnt das Contao Install Tool aufrufen, um die
Datenbank zu aktualisieren.


## Konfiguration

Um diese Erweiterung zu konfigurieren, muss zuerst eine sogennante »Facebook App« erzeugt werden. Die Details dieser App
werden dann für die Konfiguration im Backend benötigt.


### Facebook App anlegen

1. Gehe zuerst zu [developers.facebook.com](https://developers.facebook.com). Wenn noch kein Facebook Developer Account
existiert, muss nun einer angelegt werden (bzw. der Developer Account muss für einen existierenden Facebook Benutzer
freigeschalten werden).
2. Unter _Meine Apps_ auf _App erstellen_ klicken.
3. Einen _Anzeige Name_ für die App eingeben (z. B. der Titel der Webseite) und eine Kontakt E-Mail Adresse angeben. 
Dann auf _App-ID erstellen_ klicken.
4. Auf der nächsten Seite können _Produkte_ zur App hinzugefügt werden. Füge das _Facebook Login_ Produkt hinzu, indem 
dem du drt auf _Einrichten_ klickst.
5. Auf der nächsten Seite _Web_ auswählen, dann die URL der Webseite eingeben (inklusive `https://`). Danach auf _Save_
klicken.
6. Auf der linken Seite auf _Facebook Login_ » _Einstellungen_ clicken. Unter _Gültige OAuth Redirect URIs_ die 
folgende URL eingeben: `https://example.org/system/modules/news_facebook/public/callback.php`. `example.org` muss mit 
der Domain deiner Webseite ersetzt werden. Dann auf _Änderungen speichern_ klicken.
7. Auf der linken Seite auf _Einstellungen_ » _Allgemeines_ klicken und die Domain der Webseite unter _App Domains_ 
eingeben. Danach wieder auf _Änderungen speichern_ klicken.

{{% notice info %}}
Der Facebook Account unter diesem man die App anlegt muss die Berechtigung haben auf der timeline der jeweiligen
Facebook Page, mit der synchronisiert werden soll, Posts machen zu dürfen (dies ist optional, wenn nur Posts von
der Page in das Nachrichtenarchiv geholt werden sollen). Alternativ können aber auch weitere Administrator oder
Developer zur Facebook App unter _Rollen_ hinzugefügt werden.
{{% /notice %}}


### App ID und App Secret in Contao konfigurieren

Gehe im Contao Backend zu _System_ » _Einstellungen_. Dort unter _Facebook App_ müssen die__App ID__ und das 
__App Secret__ eingegeben werden. Diese Informationen können in den Facebook App Einstellungen unter _Einstellungen_ » 
_Allgemeines_ gefunden werden.

![Facebook App Einstellungen](/de/extensions/images/de/contao-news-facebook_app_settings_de.png?classes=shadow)


### Contao Nachrichtenarchiv konfigurieren

Gehe zu dein Einstellungen deines Nachrichtenarchivs. In der Sektion _Facebook sync_ kann der __Facebook sync__
aktiviert werden. Danach kann die _numerische_ ID der Facebook Page eingegeben werden, mit der das Nachrichtenarchiv
syncrhonisiert werden soll. Die ID findet man in den Einstellungen der Facebook Page, oder über Services wie z. B.
[findmyfbid.com](http://findmyfbid.com/). Wenn automatisch Facebook Page Posts als Nachrichtenbeiträge angelegt werden
sollen, dann muss die Einstellung __Page Posts holen__ aktiviert werden. Optional kann auch ein 
__Page Post Datum Limit__ eingestellt werden.

Das Selbe kann auch für eine Facebook Gruppe gemacht werden, wenn Posts dieser Gruppe zum Nachrichtenarchiv importiert
werden sollen. Allerdings können keine Nachrichtenbeiträge automatisch in Gruppen gepostet werden.

Nun muss ein __Access Token__ von Facebook geholt werden. Dazu Kann die _Facebook connect_ Schaltfläche benutzt werden.
Dadurch wird man bei Facebook eingeloggt und es werden Berechtigungen für den eingeloggten Facebook Benutzer 
angefordert. Nachdem dies bestätigt wurde wird ein sogenannter »Long Term Access Token« von Facebook geholt.

{{% notice info %}}
Falls Nachrichtenbeiträge automatisch auf der Facebook Page geposetet werden sollen, dann muss in diesem Prozess erlaubt
werden, dass die Facebook App __öffentliche__ Posts in deinem Namen machen darf. Der Facebook Account, mit dem man sich
hier anmeldet muss außerdem die Berechtigung haben Posts auf der Timeline der jeweiligen Facebook Page posten zu dürfen.
{{% /notice %}}

![Nachrichtenarchiv Einstellungen](/de/extensions/images/de/contao-news-facebook_archive_settings_de.png?classes=shadow)

Heruntergeladene Bilder werden im eingestellten Ordner gespeichert (Standard: `files/facebook_images`). Dieser Ordner
muss in Contao 4 veröffentlicht werden!


### Zusätzliche Einstellungen

Seit Version `3.0.0` können folgende Einstellungen in den System Einstellungen von Contao unter _Facebook Sync_
getroffen werden:

__Keine OpenGraph Meta Tags__: seit Version `3.0.0` der Extension wird automatisch ein `og:image` `meta` Tag im 
`<head>` eingefügt, wenn ein Nachrichtenartikel verarbeitet wird, damit das Teaserbild auch auf Facebook automatisch
ausgegeben wird, wenn der Link zu der Nachricht geteilt wird. Mit dieser Einstellung kann dies deaktiviert werden.

__Als Fotos posten__: seit Version `3.0.0` werden Nachrichtenbeiträge nicht mehr automatisch als Photos geposetet,
wenn der Nachrichtenbeitrag ein Teaserbild hat. Mit der Einstellung kann dies wieder aktiviert werden.

![Backend Einstellungen](/de/extensions/images/de/contao-news-facebook_backend_settings_de.png?classes=shadow)

Falls kein Hook benutzt wird, kann die Standard Überschriftenlänge über

```php
$GLOBALS['FACEBOOK_TITLE_LENGTH'] = …;
```

in der eingenen `config.php` eingestellt werden.


## Benutzung


### Facebook Page/Group posts holen

Sobald das Nachrichtenarchiv konfiguriert ist und die __Page Posts holen__ bzw. __Group Posts holen__ Option aktiv ist,
überprüft die Erweiterung stündlich auf neue Facebook Posts über den Cronjob von Contao.


### Facebook Posts veröffentlichen

Contao Nachrichtenbeiträge werden auf Facebook unter zwei Bedingungen veröffentlicht:

- In den Einstellungen der jeweiligen Nachricht wurde unter der _Facebook sync_ Sektion die Einstellung 
__Auf Facebook Page posten__ aktiviert.
- Der Nachrichtenbeitrag wurde veröffentlicht.

In den Einstellungen der Nachricht kann außerdem ein abweichender Text für den Facebook Post angegeben werden.
Andernfalls wird der Teaser Text benutzt.

Die Erweiterung überprüft minütlich auf neue Nachrichten, die auf neue Nachrichten, die auf Facebook veröffentlicht
werden sollen.

![Nachrichten Einstellungen](/de/extensions/images/de/contao-news-facebook_news_settings_de.png?classes=shadow)


### Synchronisation manuell auslösen

Es gibt eine Schaltfläche zur manuellen Auslösung der Synchronisation im Backend. Oben bei den globalen Operationen
für Nachrichtenarchive.

![Globale Operationen für Nachrichtenarchive](/de/extensions/images/de/contao-news-facebook_news_global_operations_de.png?classes=shadow)


## Hooks

### `processFacebookPost`

Die Erweiterung prozessiert einen Facebook Post und versucht diesen zu einem passenden Contao Nachrichtenbeitrag 
umzuwandeln. Dieser Prozess kann mit dem `processFacebookPost` selbst angepasst werden. Als Rückgabewert wird
ein Array erwartet, mit den finalen Daten für den Datenbankeintrag eines Nachrichtenbeitrags. Wenn der Rückgabewert
`false` ist, wird kein Nachrichtenbeitrag erzeugt.

#### Parameter

1. _array_ `$arrData` Die bereits prozessierten Daten, die für den Nachrichtenbeitrag benutzt werden.
2. _object_ `$objPost` Die originalen Daten des Posts von Facebook.
3. _object_ `$objArchive` Das Newsarchiv Objekt.

### `changeFacebookMessage`

Wenn ein Contao Nachrichtenbeitrag als Facebook Post vorbereitet wird, wird entweder der Teaser oder der bei der 
Nachricht angegebene Text verwendet. Falls aber automatisch dieser Text angepasst werden soll, kann dies mit dem
`changeFacebookMessage` gemacht werden. Als Rückgabewert wird der finale Text erwartet.

#### Parameter

1. _string_ `$message` Die bereits vorgefertigte Nachricht.
2. _object_ `$objArticle` Der originale Contao Nachrichtenbeitrag.
3. _object_ `$objArchive` Das Newsarchiv Objekt.


## Template Daten

In den Nachrichtentemplates stehen zusätzliche Daten zur Verfügung:

- _object_ `fbData` Die originalen Daten des Posts von Facebook.
- _string_ `fbPostId` Die Facebook ID des verknüpften Facebook Posts.
- _char_ `fromFb` Gibt an ob der Nachrichtenbeitrag ursprünglich von Facebook importiert wurde.

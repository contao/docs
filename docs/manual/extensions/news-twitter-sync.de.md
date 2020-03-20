---
title: Contao News Twitter
menuTitle: News Twitter
description: Contao News Twitter ist eine kostenpflichtige Erweiterung zur Synchronisierung von Tweets mit einem Nachrichtenarchiv.
url: erweiterungen/news-twitter-sync
---

**[inspiredminds/contao-news-twitter](https://extensions.contao.org/?p=inspiredminds%2Fcontao-news-twitter)**

_von [inspiredminds](https://www.inspiredminds.at/)_

_Projekt Webseite unter [Contao News Twitter Sync](https://www.inspiredminds.at/contao-news-twitter)_

Mit dieser Extension können automatisch Tweets von einem Twitter Profil als Nachrichten 
in Nachrichtenarchive importiert werden. Es können außerdem automatisch Nachrichten 
auf einem Twitter Profil als Tweet veröffentlicht werden. Dadurch ist es möglich, 
ein Nachrichtenarchiv mit einem Twitter Profil synchron zu halten.


## Installation

Um diese Erweiterung zu installieren, muss zuerst die `composer.json` der eigenen 
Contao Installation modifiziert werden. Dabei sind zwei Anpassungen notwendig: das 
private Repository hinzufügen und die Abhängigkeit hinzufügen.

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

`<YOUR_TOKEN>` muss mit dem Repository Token ersetzt werden, welches von inspiredminds 
geschickt wurde.

Um die Abhängigkeit hinzuzufügen, muss folgendes in der `composer.json` eingefügt 
werden:

```json
{
    "require": {
        "inspiredminds/contao-news-twitter": "^2.0"
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
        "inspiredminds/contao-news-twitter": "^2.0"
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

Nachdem diese Änderungen gemacht wurden, kann nun ein `composer update` auf der 
Kommandozeile oder eine Paketaktualisierung im Contao Manager durchgeführt werden. 
Danach wie gewohnt das Contao Install Tool aufrufen, um die Datenbank zu aktualisieren.


## Konfiguration

Um diese Erweiterung zu konfigurieren, muss zuerst eine sogenannte »Twitter App« erzeugt 
werden. Die Details dieser App werden dann für die Konfiguration im Backend benötigt.


### Twitter App anlegen

1. Gehe zu [apps.twitter.com](https://apps.twitter.com/).
2. Klicke auf _Create New App_.
3. Fülle die Basisinformationen aus.
4. Befülle die _Callback URL_ mit der Contao Backend URL, z. B. `https://www.example.org/contao`.
5. Klicke auf _Create your Twitter application_.


### Configure the Consumer Key and Consumer Secret in Contao

Gehe im Contao Backend zu _System_ » _Einstellungen_. Dort unter _Twitter App_ müssen 
__Consumer Key__ und  __Consumer Secret__ eingegeben werden. Diese Informationen 
können in den Twitter App Einstellungen unter _Keys and tokens_ gefunden werden.


### Configure the Contao News Archive

Öffne die Einstellungen deines Nachrichtenarchivs. In der Sektion _Twitter sync_ 
kann __Twitter sync__ aktiviert werden. Nun stehen folgende Optionen zur Verfügung:

__Authentifizierung__: Bei Klick auf das Profilbild bzw. Fragezeichen kann man sich
bei Twitter (re-)authentifizieren. Dies ist notwendig, wenn man Nachrichten automatisch
zu Twitter posten lassen möchte. Es ist _nicht_ notwendig sich zu authentifizieren,
wenn man nur Tweets von einem Profil oder einem Hashtag holen möchte.

__Profil__: Das Twitter Profil, von dem Tweets geholt oder Tweets gepostet werden 
sollen.

__Hasthtags__: Liste an Hashtags durch Leerzeichen oder Komma getrennt, welche von
Twitter geholt werden sollen. _Achtung:_ wenn auch ein Twitter Profil definiert 
wurde, dann agiert diese Liste als Filter für die Tweets des Profiles. Ohne Angabe
eines Profils werden alle Tweets zu den angegebenen Hashtags geholt.

__Tweets holen__: Nur wenn diese Option aktiv ist, werden Tweets vom angegebenen
Profil bzw. von den angegebenen Hashtags geholt.

__Tweets veröffentlichen__: Nur wenn dies Option aktiv ist, werden Nachrichten auch 
automatisch veröffentlicht, wenn sie von Twitter geholt wurden.


## Benutzung

### Tweets holen

Sobald ein Nachrichtenarchiv mit der Option __Tweets holen__ konfiguriert ist, wird
über den Contao Cronjob stündlich auf neue Tweets überprüft.


### Tweets posten

Contao Nachrichten werden automatisch als Tweet gepostet, wenn folgendes zutrifft:

* Im Nachrichtenbeitrag muss die Option __Auf Twitter Profil posten__ aktiv sein.
* Der Nachrichtenbeitrag muss veröffentlicht sein.

Es kann auch eine alternative Nachricht für den Tweet definiert werden. Falls keine
Nachricht definiert wird, wird die Überschrift der Nachricht als Text benutzt.

Falls die Nachricht ein Teaserbild hat, wird dieses Bild auch zum Tweet hinzugefügt.

Die Nachrichten werden minütlich über den Contao Cronjob als Tweets veröffentlicht.


### Manuelle Auslösung der Synchronisation

In der Übersicht der Nachrichtenarchive gibt es einen Link, mit dem man die Synchronisation
der Nachrichtenarchive manuell anstoßen kann.


## Hooks

### `processTweet`

Die Erweiterung prozessiert Tweets und versucht den Tweet in ein passendes Format
für eine Contao Nachricht zu verwandeln. Falls die finalen Daten für die Nachricht
angepasst werden sollen, kann der `processTweet` Hook benutzt werden. Als Rückgabewert
wird ein Array erwartet, das die finalen Daten enthält. Soll ein Tweet nicht als
Nachricht gespeichert werden, kann etwas leeres zurückgegeben werden.


#### Parameters

1. _array_ `$arrData` Die bereits prozessierten Daten für die Nachricht.
2. _object_ `$objTweet` Die originalen Daten des Tweets.
3. _object_ `$objArchive` Das Nachrichtenarchiv Objekt.


### `changeTwitterMessage`

Wenn eine Contao Nachricht als Tweet gepostet werden soll, wird entweder die Überschrift
oder der angegebene Text verwendet. Über den `changeTwitterMessage` Hook kann diese
Nachricht aber nochmal automatisiert angepasst werden. Als Rückgabewert wird der
finale Text als String erwartet.

#### Parameters

1. _string_ `$message` Die bereits vorbereitete Nachricht.
2. _object_ `$objArticle` Der originale Nachrichtenbeitrag.
3. _object_ `$objArchive` Das Nachrichtenarchiv Objekt.


## Template data

In den Nachrichtentemplates stehen zusätzliche Daten zur Verfügung:

- _object_ `twitterData` Die Originaldaten des Tweets.
- _string_ `tweetId` Die Tweet ID.
- _char_ `fromTwitter` Gibt an, ob diese Nachricht ursprünglich von Twitter kommt.

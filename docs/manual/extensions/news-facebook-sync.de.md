---
title: Contao News Facebook Sync
linkTitle: News Facebook Sync
description: Contao News Facebook Sync ist eine kostenpflichtige Erweiterungen zur Synchronisierung von Facebook Posts mit einem Nachrichtenarchiv.
url: erweiterungen/news-facebook-sync
---

**[inspiredminds/contao-news-facebook](https://extensions.contao.org/?q=news%20face&pages=1&p=inspiredminds%2Fcontao-news-facebook)**

_by [INSPIRED MINDS](https://www.inspiredminds.at/)_

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
            "url": "https://<YOUR_USERNAME>:<YOUR_TOKEN>@packeton.inspiredminds.at"
        }
    ]
}
```

`<YOUR_USERNAME>` und `<YOUR_TOKEN>` muss mit den Informationen ersetzt werden, welche von INSPIRED MINDS geschickt wurden.

Um die Abhängigkeit hinzuzufügen, muss folgendes in der `composer.json` eingefügt werden:

```json
{
    "require": {
        "inspiredminds/contao-news-facebook": "^9.0"
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
        "contao/conflicts": "@dev",
        "contao/manager-bundle": "5.3.*",
        "inspiredminds/contao-news-facebook": "^9.0"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
    },
    "scripts": {
        "post-install-cmd": [
            "@php vendor/bin/contao-setup"
        ],
        "post-update-cmd": [
            "@php vendor/bin/contao-setup"
        ]
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://<YOUR_USERNAME>:<YOUR_TOKEN>@packeton.inspiredminds.at"
        }
    ]
}
```
{{% /expand %}}

Nachdem diese Änderungen gemacht wurden, kann nun ein `composer update` auf der Kommandozeile oder eine
Paketaktualisierung im Contao Manager durchgeführt werden. Danach wie gewohnt das die Datenbank aktualisieren.


## Konfiguration

### Facebook App anlegen

Zuerst muss eine sogenannte »Facebook App« erzeugt werden. Die Details dieser App werden dann für die Konfiguration im
Backend benötigt.

{{% notice "tip" %}}
Dieser Schritt kann übersprungen werden, wenn deine Facebook Page _nicht_ mit einem Meta Business Account assoziiert ist.
In diesem Fall bringt die Extension ihre eigene Facebook App mit, welche die nötigen Berechtigungen hat.

Facebook erlaubt den Zugriff zu Facebook Pages, die mit einem Meta Business Account verbunden sind, nicht mehr ohne der
`business_management` Berechtigung. Die integrierte Facebook App hat diese Berechtigung nicht von Facebook erhalten.
{{% /notice %}}

1. Gehe zuerst zu [developers.facebook.com](https://developers.facebook.com). Wenn noch kein Facebook Developer Account
existiert, muss nun einer angelegt werden (bzw. der Developer Account muss für einen existierenden Facebook Benutzer
freigeschalten werden).
2. Unter _Meine Apps_ auf _App erstellen_ klicken.
3. Einen Namen für die App unter _Name der App_ eingeben (z. B. der Titel der Webseite) und eine 
_Kontakt-E-Mail-Adresse der App_ angeben.
4. Auf der nächsten Seite können Anwendungsfälle zur App hinzugefügt werden. Wähle ganz unten _Sonstiges_ aus.
5. Auf der nächsten Seite muss ein App-Typ ausgewählt werden. Wähle dort _Business_ aus.
6. Auf der nächsten Seite dann _App erstellen_ klicken.
7. Danach können "Produkte" zur App hinzugefügt werden. Klicke weiter unten bei  _Facebook Login for Business_ auf _Einrichten_.
8. Unter **Client-OAuth-Einstellungen** bei _Gültige OAuth Redirect URIs_ muss folgende URL eingegeben werden:
`https://example.org/_facebook/callback`. Ersetze `example.org` mit der Domain deiner Website. Dann _Änderungen speichern_.

{{% notice note %}}
Der Facebook Account, unter dem man die App anlegt, muss die Berechtigung haben, auf der timeline der jeweiligen
Facebook Page, mit der synchronisiert werden soll, Posts machen zu dürfen (dies ist optional, wenn nur Posts von
der Page in das Nachrichtenarchiv geholt werden sollen). Alternativ können aber auch weitere Administratoren oder
Developer zur Facebook App unter _Rollen_ hinzugefügt werden.
{{% /notice %}}


### App ID und App Secret in Contao konfigurieren

{{% notice "tip" %}}
Dieser Schritt kann übersprungen werden, wenn die intern zur Verfügung gestellte Facebook App benutzt wird.
{{% /notice %}}

Gehen zu _App-Einstellungen_ » _Allgemeines_ in der Facebook App. Kopiere die _App-ID_ und das _App-Secret_ und
konfiguriere es in deiner `config/config.yaml`:

```yaml
# config/config.yaml
contao_news_facebook:
    app_id: '123456789123456'
    app_secret: 'abc123abc123abc123abc123abc123ab'
```

Für geheime Daten wie diese ist es allerdings empfohlen sie nicht direkt in der `config.yaml` zu speichern, wodurch
diese Daten möglicherweise im Git-Repository deines Projektes landen. Stattdessen solltest du Umgebungsvariablen nutzen:

```env
# .env
# Leere Standardwerte anlegen
FACEBOOK_APP_ID=
FACEBOOK_APP_SECRET=
```

```env
# .env.local
# Die eigentlichen Werte setzen
FACEBOOK_APP_ID=123456789123456
FACEBOOK_APP_SECRET=abc123abc123abc123abc123abc123ab
```

```yaml
# config/config.yaml
# Die Umgebungsvariablen referenzieren
contao_news_facebook:
    app_id: '%env(FACEBOOK_APP_ID)%'
    app_secret: '%env(FACEBOOK_APP_SECRET)%'
```


### Contao Nachrichtenarchiv konfigurieren

Öffne die Einstellungen deines Nachrichtenarchivs. In der Sektion _Facebook sync_ kann der __Facebook sync__
aktiviert werden. Danach kann die _numerische_ ID der Facebook Page eingegeben werden, mit der das Nachrichtenarchiv
synchronisiert werden soll. Wenn automatisch Facebook Page Posts als Nachrichtenbeiträge angelegt werden
sollen, dann muss die Einstellung __Page Posts holen__ aktiviert werden. Optional kann auch ein 
__Page Post Datum Limit__ eingestellt werden.

Dasselbe kann auch für eine Facebook Gruppe gemacht werden, wenn Posts dieser Gruppe zum Nachrichtenarchiv importiert
werden sollen. Allerdings können keine Nachrichtenbeiträge automatisch in Gruppen gepostet werden.

Nun muss ein __Access Token__ von Facebook geholt werden. Dazu kann die _Facebook connect_ Schaltfläche benutzt werden.
Dadurch wird man bei Facebook eingeloggt und es werden Berechtigungen für den eingeloggten Facebook Benutzer 
angefordert. Nachdem dies bestätigt wurde, wird ein sogenannter »Long Term Access Token« von Facebook geholt.

{{% notice note %}}
Falls Nachrichtenbeiträge automatisch auf der Facebook Page gepostet werden sollen, dann muss in diesem Prozess erlaubt
werden, dass die Facebook App __öffentliche__ Posts in deinem Namen machen darf. Der Facebook Account, mit dem man sich
hier anmeldet, muss außerdem die Berechtigung haben, Posts auf der Timeline der jeweiligen Facebook Page posten zu dürfen.
{{% /notice %}}

![Nachrichtenarchiv Einstellungen]({{% asset "images/manual/extensions/de/contao-news-facebook_archive_settings_de.png" %}}?classes=shadow)

Heruntergeladene Bilder werden im eingestellten Ordner gespeichert (Standard: `files/facebook_images`). Dieser Ordner
muss in Contao 4 veröffentlicht werden!


### Zusätzliche Einstellungen

Seit Version `3.0.0` können folgende Einstellungen in den Systemeinstellungen von Contao unter _Facebook Sync_
getroffen werden:

__Keine OpenGraph Meta Tags__: seit Version `3.0.0` der Extension wird automatisch ein `og:image` `meta` Tag im 
`<head>` eingefügt, wenn ein Nachrichtenartikel verarbeitet wird, damit das Teaserbild auch auf Facebook automatisch
ausgegeben wird, wenn der Link zu der Nachricht geteilt wird. Mit dieser Einstellung kann dies deaktiviert werden.

__Als Fotos posten__: seit Version `3.0.0` werden Nachrichtenbeiträge nicht mehr automatisch als Fotos gepostet,
wenn der Nachrichtenbeitrag ein Teaserbild hat. Mit der Einstellung kann dies wieder aktiviert werden.

![Backend Einstellungen]({{% asset "images/manual/extensions/de/contao-news-facebook_backend_settings_de.png" %}}?classes=shadow)

Falls kein Hook benutzt wird, kann die Standard Überschriftenlänge folgendermaßen geändert werden:

```yaml
# config/config.yaml
contao_news_facebook:
    headline_length: 64
```


## Benutzung


### Facebook Page/Group Posts holen

Sobald das Nachrichtenarchiv konfiguriert ist und die __Page Posts holen__ bzw. __Group Posts holen__ Option aktiv ist,
überprüft die Erweiterung stündlich auf neue Facebook Posts über den Cronjob von Contao.


### Facebook Posts veröffentlichen

Contao Nachrichtenbeiträge werden auf Facebook unter zwei Bedingungen veröffentlicht:

- In den Einstellungen der jeweiligen Nachricht wurde unter der _Facebook sync_ Sektion die Einstellung 
__Auf Facebook Page posten__ aktiviert.
- Der Nachrichtenbeitrag wurde veröffentlicht.

In den Einstellungen der Nachricht kann außerdem ein abweichender Text für den Facebook Post angegeben werden.
Andernfalls wird der Teaser Text benutzt.

Die Erweiterung überprüft minütlich auf neue Nachrichten, die auf Facebook veröffentlicht
werden sollen.

![Nachrichten Einstellungen]({{% asset "images/manual/extensions/de/contao-news-facebook_news_settings_de.png" %}}?classes=shadow)


### Synchronisation manuell auslösen

Es gibt eine Schaltfläche zur manuellen Auslösung der Synchronisation im Backend. Oben bei den globalen Operationen
für Nachrichtenarchive.

![Globale Operationen für Nachrichtenarchive]({{% asset "images/manual/extensions/de/contao-news-facebook_news_global_operations_de.png" %}}?classes=shadow)


## Hooks

Die Extension stellt einige [Hooks][Hooks] zur Verfügung, welche das Verhalten beeinflussen können, wenn zu Facebook gepostet, oder
ein Post von Facebook zu Contao geholt wird.

### `processFacebookPost`

Die Erweiterung prozessiert einen Facebook-Post und versucht diesen zu einem passenden Contao Nachrichtenbeitrag 
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
`changeFacebookMessage` Hook gemacht werden. Als Rückgabewert wird der finale Text erwartet.


#### Parameter

1. _string_ `$message` Die bereits vorgefertigte Nachricht.
2. _object_ `$objArticle` Der originale Contao Nachrichtenbeitrag.
3. _object_ `$objArchive` Das Newsarchiv Objekt.


#### Beispiel

Das folgende Beispiel implementiert einen Hook, der die URL zum Nachrichtenbeitrag an den Text des Facebook-Posts anhängt:

```php
// src/EventListener/ChangeFacebookMessageListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\NewsArchiveModel;
use Contao\NewsModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsHook('changeFacebookMessage')]
class ChangeFacebookMessageListener
{
    public function __construct(private readonly ContentUrlGenerator $contentUrlGenerator)
    {
    }

    public function __invoke(string $message, NewsModel $news, NewsArchiveModel $archive): string
    {
        // Append the URL to photo posts
        if ($news->addImage && $news->fbPostAsPhoto) {
            $message .= "\n\n".$this->contentUrlGenerator->generate($news, [], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return $message;
    }
}
```


## Template Daten

In den Nachrichtentemplates stehen zusätzliche Daten zur Verfügung:

- _object_ `fbData` Die originalen Daten des Posts von Facebook.
- _string_ `fbPostId` Die Facebook ID des verknüpften Facebook Posts.
- _char_ `fromFb` Gibt an, ob der Nachrichtenbeitrag ursprünglich von Facebook importiert wurde.


[Hooks]: https://docs.contao.org/dev/framework/hooks/

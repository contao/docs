---
title: "Testversionen installieren"
description: "Anleitung zur Installation von Entwicklungsversionen und Release Candidates."
url: "anleitungen/testversionen-installieren"
weight: 20
---


Das Entwicklerteam von Contao hält sich an einen festgelegten [Release-Plan][releasePlan]
bei der Entwicklung neuer Versionen (bzw. dem Support bestehender). Vor jeder geplanten
neuen Version gibt es einen gewissen Zeitraum, in dem aktiv an dieser Version entwickelt
wird. Neue Features werden hinzugefügt, bis ein gewisser Zeitpunkt erreicht ist.
Danach werden die ersten »Release Candidates« veröffentlicht. Wenn während der Tests
keine weiteren Probleme gefunden werden, wird die erste stabile Version veröffentlicht.

Auch wenn Contao Unit Testing einsetzt, können immer unvorhergesehene Probleme und
Fehler auftauchen, nachdem neue Features hinzugefügt oder bestehende Dinge
geändert wurden. Daher müssen neue Versionen von tatsächlichen Benutzern getestet 
werden. Als Open Source Software kann Contao dabei aber vom Engagement der Community 
profitieren.

Im Folgenden wird erklärt, wie man neue Versionen von Contao selbst installieren
und testen kann, entweder durch die Installation eines Release Candidates oder sogar 
einer aktuellen Entwicklerversion.

Bei der Aktualisierung von Paketen über den Composer (entweder direkt auf der Kommandozeile
oder über den Contao Manager) werden normalerweise immer nur _stabile_ Pakete installiert,
zumindest mit den vorgegebenen Einstellungen der _Contao Managed Edition_. Daher
muss die `composer.json` des Projektes entsprechend angepasst werden, damit auch
Release Candidates oder Entwicklerversionen installiert werden. Nach der Änderung 
der `composer.json` muss natürlich eine komplette Paketaktualisierung durchgeführt 
werden. 


## Release Candidates installieren

Release Candidates nutzen eine spezifische Form von sogenannten »Release-Tags«.
Der erste Release Candidate von Contao `4.9` heißt z. B. `4.9.0-RC1`. Mit Hilfe
der »[Version Requirement Syntax][composerVersions]« von Composer können wir verlangen,
dass solche Versionen ebenfalls installiert werden sollen, und nicht nur die stabilen
Versionen. Diese Angabe erfolgt z. B. mit `4.9@RC`, und muss bei _allen_ Bundles
des Contao Cores angewandt werden, _inklusive_ dem `contao/core-bundle` und dem
`contao/installation-bundle`, welche normalerweise nicht direkt in der eigenen `composer.json`
angefordert werden.

Hier ist ein komplettes Beispiel, um die neueste Contao `4.9` Version installieren
zu lassen, _inklusive_ den neuesten Release Candidates (wenn vorhanden):

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "^4.9@RC",
        "contao/comments-bundle": "^4.9@RC",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "^4.9@RC",
        "contao/faq-bundle": "^4.9@RC",
        "contao/installation-bundle": "^4.9@RC",
        "contao/listing-bundle": "^4.9@RC",
        "contao/manager-bundle": "4.9.*@RC",
        "contao/news-bundle": "^4.9@RC",
        "contao/newsletter-bundle": "^4.9@RC"
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
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    }
}
```

Beachte, dass dabei später auch die stabilen Versionen installiert 
werden (wie z. B. `4.9.0`, `4.9.1` etc.), wenn eine Paketaktualisierung durchgeführt wird.


## Entwicklerversionen installieren

Während der Release Candidate und davor auch während der Entwicklungsphase einer
Contao Version kann auch die Entwicklerversion zum Testen installiert werden. Auf
diese Weise können die neuesten Änderungen sofort getestet werden, ohne auf einen
neuen Release Candidate warten zu müssen. Natürlich kann dies auch instabilen Programmcode
enthalten.

Statt einer spezifischen _Version_ wird nun ein spezifischer _Branch_ aus dem öffentlichen
Git Repository von Contao verlangt. Jede »Minor« Version von Contao hat ihren eigenen
Entwicklungs-Branch, z. B. `4.9.x-dev` für Contao `4.9`. Der Branch für die neueste,
sich gerade in Entwicklung befindliche, _zukünftige_ Version von Contao befindet 
sich immer im `dev-master` Branch.

Eine komplettes Beispiel einer `composer.json`, wo der Entwicklungs-Branch von
Contao `4.9` installiert wird, sieht so aus:

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "4.9.x-dev",
        "contao/comments-bundle": "4.9.x-dev",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "4.9.x-dev",
        "contao/faq-bundle": "4.9.x-dev",
        "contao/installation-bundle": "4.9.x-dev",
        "contao/listing-bundle": "4.9.x-dev",
        "contao/manager-bundle": "4.9.x-dev",
        "contao/news-bundle": "4.9.x-dev",
        "contao/newsletter-bundle": "4.9.x-dev"
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
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    }
}
```

Jedes mal, wenn eine Paketaktualisierung durchgeführt wird, wird der neueste Programmcode
aus diesem Branch des öffentlichen Git Repositorys von Contao geholt.


[releasePlan]: https://contao.org/en/release-plan.html
[composerVersions]: https://getcomposer.org/doc/articles/versions.md

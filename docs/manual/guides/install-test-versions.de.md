---
title: "Testversionen installieren"
description: "Anleitung zur Installation von Entwicklungsversionen und Release Candidates."
url: "anleitungen/testversionen-installieren"
aliases:
    - /de/anleitungen/testversionen-installieren/
weight: 5
tags: 
   - "Installation"
---


Das Entwicklerteam von Contao hält sich an einen festgelegten [Release-Plan][releasePlan]
bei der Entwicklung neuer Versionen (bzw. dem Support bestehender). Vor jeder geplanten
neuen »Major« oder »Minor«<sup>1</sup> Version gibt es einen gewissen Zeitraum, 
in dem aktiv an dieser Version entwickelt wird. Neue Funktionen werden hinzugefügt, 
bis ein gewisser Zeitpunkt erreicht ist. Danach werden die ersten »Release Candidates« 
veröffentlicht. Wenn während der Tests keine weiteren Probleme gefunden werden, 
wird die erste stabile Version veröffentlicht.

{{% notice note %}}
<sup>1</sup> Contao verwendet für die Versionierung der Software »[Semantic Versioning](https://semver.org/)«.
Eine »Major« Version bezeichnet die erste Stelle der Versionsangabe. Das sind Versionen,
wo neue Funktionen oder strukturelle Änderungen in der Software hinzugefügt wurden,
die aber nicht mehr rückwärtskompatibel zu vorherigen Versionen sind, bzw. sein
können. Eine »Minor« Version bezeichnet die zweite Stelle einer Versionsangabe. Das sind 
Versionen, in denen der Software neue Funktionen in einer rückwärtskompatiblen Art 
hinzugefügt werden.
{{% /notice %}}

Auch wenn Contao über tausende an automatisierten Tests verfügt, können immer unvorhergesehene 
Probleme und Fehler auftauchen, nachdem neue Funktionen hinzugefügt oder bestehende 
Dinge geändert wurden. Daher müssen neue Versionen von tatsächlichen Benutzern getestet 
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
der `composer.json` muss eine komplette Paketaktualisierung durchgeführt 
werden. 


## Release Candidates installieren

Release Candidates nutzen eine spezifische Form von sogenannten »Release-Tags«.
Der erste Release Candidate von Contao `4.9` heißt z. B. `4.9.0-RC1`. Normalerweise
würde Composer nur _stabile_ Versionen installieren und daher solche Release Candidates
nicht beachten.

Um die Installation von Release Candidates zu erlauben, muss die `minimum-stability`
auf `RC` in der `composer.json` runter gesetzt werden. Außerdem sollte man Composer
anweisen, dass bei jedem Paket _stabile_ Versionen bevorzugt werden, damit die auch
die offiziell veröffentlichten Versionen von Contao automatisch installiert werden,
sobald verfügbar. Schließlich muss noch die angeforderte Version von Contao selbst,
also genau genommen des `contao/manager-bundle` auf `4.9.*` geändert werden, so
wie bei jedem Update auf eine neuere Contao Version.

```json
{
    "require": {
        "contao/manager-bundle": "4.9.*"
    },
    "minimum-stability": "RC",
    "prefer-stable": true
}
```

Hier ist ein komplettes Beispiel, um die neueste Contao `4.9` Version installieren
zu lassen, _inklusive_ den neuesten Release Candidates (wenn vorhanden):

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "^4.9",
        "contao/comments-bundle": "^4.9",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "^4.9",
        "contao/faq-bundle": "^4.9",
        "contao/installation-bundle": "^4.9",
        "contao/listing-bundle": "^4.9",
        "contao/manager-bundle": "4.9.*",
        "contao/news-bundle": "^4.9",
        "contao/newsletter-bundle": "^4.9"
    },
    "minimum-stability": "RC",
    "prefer-stable": true,
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.4"
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

{{% notice tip %}}
Die angeforderten Versionen der anderen Contao Bundles muss nicht unbedingt von
deren ursprünglichen Angaben geändert werden. Zum Beispiel erlaubt eine Angabe von
`^4.9` (wie es der Fall wäre, wenn man von einer Contao 4.9 LTS Version aktualisieren
würde) auch die Installation aller `4.13` Versionen. Siehe dazu auch die Dokumentation
von Composer über diese spezielle [Versions Syntax](https://getcomposer.org/doc/articles/versions.md).
Nur die Version des `contao/manager-bundle` muss angepasst werden.
{{% /notice %}}


## Entwicklerversionen installieren

Während der Release Candidate und davor auch während der Entwicklungsphase einer
Contao Version kann auch die Entwicklerversion zum Testen installiert werden. Auf
diese Weise können die neuesten Änderungen sofort getestet werden, ohne auf einen
neuen Release Candidate warten zu müssen. Natürlich kann dies auch instabilen Programmcode
enthalten.

Statt einer spezifischen _Version_ wird nun ein spezifischer _Branch_ aus dem öffentlichen
Git Repository von Contao verlangt. Jede »Minor« Version von Contao hat ihren eigenen
»Entwicklungszweig (Branch)«, z. B. `4.9.x-dev` für Contao `4.9`.

Eine komplettes Beispiel einer `composer.json`, wo der Entwicklungszweig von Contao 
`4.9` installiert wird, sieht so aus:

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

Zu beachten ist hier, dass diesmal auch das `contao/core-bundle` und das `contao/installation-bundle`
angefordert wird, welches normalerweise nicht in der `composer.json` des eigenen
Contao Projekts eingetragen wird. Das ist notwendig, weil Entwicklerversionen der
Pakete installiert werden sollen, ohne die `minimum-stability` auf `dev` zu senken
(das würde andernfalls die Berechnungszeit und Speicherauslastung während einer
Update-Operation drastisch erhöhen).

Jedes mal, wenn eine Paketaktualisierung durchgeführt wird, wird der neueste Programmcode
aus diesem Branch des öffentlichen Git Repositorys von Contao geholt.


## Contao Manager

Die Testversionen können auch ohne manuelle Änderung der `composer.json` direkt
über den Contao Manager installiert werden. Dazu editiert man bei »Contao Open Source
CMS« die angeforderte Versionsangabe entweder auf bspw. `4.9.*@RC`, um Release
Candidates, oder `4.9.x-dev` um Entwicklerversionen installieren 
zu lassen.

![Contao Manager Versionsangabe](/de/guides/images/de/install-version/contao-manager-versionseingabe.gif?classes=shadow)

Wenn man keine bestehende Contao-Installation nutzen will, sondern mit einer frischen Installation starten möchte, dann geht man wie folgt vor.

Zuerst führt man wie gewohnt die Grundkonfiguration des Contao Managers durch. Wenn man beim Schritt »Contao-Installation« angekommen ist, setzt man den Haken bei »Installation überspringen (Expertenmodus!)« und klickt auf »Fertigstellen«.

Anschließend wechselt man zum Menüpunkt »Pakete« und editiert bei »Contao Open Source
CMS« die Versionsangabe wie oben beschrieben. Abschließend klickt man auf »Änderungen anwenden« und wartet die Aktualisierung der Pakete ab.

[releasePlan]: https://contao.org/de/release-plan.html

## Weblinks ##
Videoanleitung: [Contao 4 – Testversion | Entwicklerversion | Release Candidate installieren](https://youtu.be/0nUROGy_jLU)

---
title: "Update und Migration"
description: "Update und Migration einer Contao Installation zu einer höheren Major-Version."
url: "migration"
aliases:
    - /de/migration/
weight: 3
---

Dieser Abschnitt behandelt das Update und Migration einer Contao Installation zu höheren »Major-Versionen« - also bspw. von Contao 3 auf 4,
oder 4 auf 5, etc.


## Allgemeines

Bei einem solchen Update ist generell zu beachten, dass man zuerst immer auf die neueste Version der aktuell verwendeten Major-Version 
aktualisieren muss, bevor man auf die nächsthöhere Major-Version aktualisiert. Man kann auch keine Major-Versionen überspringen. Befindet 
man sich z. B. auf Contao `3.2.10` muss man zuerst auf Contao `3.5.40` aktualisieren, bevor man auf Contao `4.13.x` aktualisieren kann. 
Befindet man sich z. B. auf Contao `4.10.2` muss man zuerst auf Contao `4.13.x` aktualisieren, bevor man auf Contao `5.x` aktualisieren 
kann, usw. Nur so ist sichergestellt, dass auch alle automatisierten Migrationen die Contao Version korrekt anheben (hauptsächlich die 
Datenbank betreffend).

Grundsätzlich können sich bei jedem Update die Template-Dateien ändern (auch bei Minor-Versionen). Bei einem Update auf eine höhere
Major-Version ist es aber besonders wichtig die in `templates/` abgelegten, überschriebenen Templates zu prüfen, da es in vielen Fällen
notwendig sein wird Anpassungen durchzuführen.

Darüberhinaus kann es nicht rückwärts-kompatible Änderungen geben, auf die man in seinem eigenen PHP-Code Acht geben muss. In der Regel
sind solche Änderungen in der `UPGRADE.md` des `contao/core-bundle` verzeichnet.


## Contao `3.5` auf `4.x`

1. Eine Kopie der Contao 3.5 Datenbank erzeugen.
2. Eine neue [Contao 4 Installation][ContaoInstallation] erzeugen.
3. Die Datenbank-Zugangsdaten für die vorher erzeugte Kopie nutzen.
4. Aus der Contao 3 Installation folgende Dateien kopieren:
    * `files/`
    * `system/config/dcaconfig.php`
    * `system/config/langconfig.php`
    * `system/config/initconfig.php`
    * `system/config/localconfig.php`
    * `templates/`
5. In der Konfiguration des Webservers die Domain auf den `public/` Unterordner zeigen lassen 
(siehe [Hosting Konfiguration][HostingConfig]).
6. Das [Contao-Installtool][ContaoInstallTool] im Browser oder `vendor/bin/contao-console contao:migrate` auf der Konsole aufrufen, um
die Datenbankmigration durchführen zu lassen. _Hinweis:_ vorerst keine Tabellen oder Felder löschen lassen.


### Extensions

Grundsätzlich können Extensions direkt aus `system/modules/` aus der Contao 3 Installation übernommen werden. Allerdings sollte im Zuge
eines solchen Updates überprüft werden, ob es nicht neuere, dediziert für Contao 4 freigegebene Versionen der verwendeten Extensions gibt -
oder kompatible Alternativen - welche dann direkt über Composer oder dem Contao Manager installiert werden können. Im Zweifelsfall sollte 
man prüfen, ob die jeweilige Extension tatsächlich noch gebraucht wird und ansonsten ausgebaut werden kann.

Hat man eine oder mehrere Extensions nachinstalliert, kann danach wieder das Installtool im Browser oder `contao:migrate` auf der Konsole
aufgerufen werden, um wiederum Migrationen durchführen zu lassen die die jeweilige Extension evt. mitbringt.


## Contao `4.13` auf `5.x`

Zwischen Contao 4 und 5 ändert sich nichts an der grundsätzlichen Struktur. Auch die `composer.json` der `contao/managed-edition` ist (bis
auf die Versions-Anforderungen) identisch mit `4.13`. Je nach dem mit welcher Contao Version die zu aktualisierende Instanz begonnen wurde
und welchen Anpassungen vorgenommen wurden können jedoch verschiedene Schritte notwendig sein.


### Versions-Anforderungen ändern

Für ein Update von `4.13` auf `5.0` müssen in der `composer.json` nur die Versions-Anforderungen auf `^5.0` bzw. `5.0.*` geändert werden.
Aus `"contao/news-bundle": "^4.13"` wird also `"contao/news-bundle": "^5.0"` etc. und aus `"contao/manager-bundle": "4.13.*"` wird
`"contao/manager-bundle": "5.0.*"`.

```json
{
    "require": {
        "contao/calendar-bundle": "^5.0",
        "contao/comments-bundle": "^5.0",
        "contao/conflicts": "@dev",
        "contao/faq-bundle": "^5.0",
        "contao/listing-bundle": "^5.0",
        "contao/manager-bundle": "5.0.*",
        "contao/news-bundle": "^5.0",
        "contao/newsletter-bundle": "^5.0"
    }
}
```

{{% notice "note" %}}
Die `contao/managed-edition` nutzt für die einzelnen Core-Pakete die Versions-Anforderung `^5.0`. Dies bedeutet dass die einzelnen Pakete
mindestens in Version `5.0.0` installiert werden, aber nicht in den Versionen `6.x` - `^5.0` erlaubt also auf `5.1.x`, `5.2.x` etc. Damit
eine Paketaktualisierung aber nicht ungefragt auf eine höhere Minor-Version aktualisiert, setzt die `contao/managed-edition` die
Versions-Anforderung des `contao/manager-bundle` auf `5.0.*` - und somit sind die Contao-Pakete auf eine gewisse Minor-Version festgesetzt
(in diesem Fall `5.0.x`). Bei einem Update auf eine höhere Minor-Version muss dann also die Versions-Anforderung des `contao/manager-bundle`
auf bspw. `5.1.*` gesetzt werden. Siehe auch die [Composer Dokumentation](https://getcomposer.org/doc/articles/versions.md) dazu.
{{% /notice %}}


### Composer Scripts anpassen

Wurde mit der Contao-Installation schon in etwas älteren Versionen begonnen, dann befindet sich möglicherweise im `script` Teil der
`composer.json` eine Referenz auf den alten `ScriptHandler`, welcher in Contao 5 nicht mehr existiert. Dieser Abschnitt muss auf 
`@php vendor/bin/contao-setup` geändert werden, also:

```json
{
    "scripts": {
        "post-install-cmd": [
            "@php vendor/bin/contao-setup"
        ],
        "post-update-cmd": [
            "@php vendor/bin/contao-setup"
        ]
    }
}
```


### Zielverzeichnis ändern oder festlegen

Contao 5 sowie auch schon Contao 4.13 nutzen den `public/` Ordner als Einstiegspunkt. Während in Contao 4.13 noch eine automatische
Erkennung für die Nutzung des alten `web/` Ordners eingebaut ist, fehlt eine solche automatische Erkennung in Contao 5. Daher sollte muss
man vor dem Update den bestehenden `web/` Ordner auf `public/` umbenennen und das Zielverzeichnis der Domain entsprechend ändern. Alternativ
kann das Verzeichnis über die `composer.json` geändert werden - siehe dazu die [Hosting-Konfiguration][HostingConfig].


### Ordnerstruktur anpassen

In älteren Contao Versionen wurde der Ordner `app/` für diverse Ressourcen und Anpassungen an der Applikation genutzt. In neueren Versionen hat
sich die Nutzung geändert wobei die alte Struktur weiterhin unterstützt war. In Contao 5 jedoch fällt diese Unterstützung weg. Folgende
Ordner bzw. Dateien müssen daher verschoben werden, falls diese noch benutzt wurden:

| Alt | Neu |
|---|---|
| `app/config/` | `config/` |
| `app/Resources/contao/` | `contao/` |
| `app/Resources/public/` | `public/` |
| `app/Resources/translations/` | `translations/` |
| `app/Resources/views/` | `templates/bundles/` |


### Extensions

Nach den vorherigen Anpassungen an die `composer.json` kann nun eine vollständige Paketaktualisierung durchgeführt werden, um das Update zu
vollziehen. Allerdings wird Composer das Update verweigern, wenn man noch nach Extensions verlangt, die noch nicht für Contao 5 freigegeben
sind (oder deren Abhängigkeiten nicht mit Contao 5 kompatibel sind).

In so einem Fall muss man daher analysieren ob es für die jeweilige Extension auch eine neuere Major-Version gibt, die kompatibel ist - oder
ansonsten abwägen, ob die Extension noch gebraucht wird und daher entfernt werden kann.


### Templates

Wie schon erwähnt müssen immer die angepassten Templates überprüft werden. Allerdings gibt es in Contao 5 generell etwas Neues zu beachten:
alle Inhaltselemente (und in Zukunft auch Module) sind neu implementiert und nutzen nun [Twig-Templates][TwigTemplates] in einer neuen 
Struktur. Hatte man bspw. ein angepasstes `templates/ce_text.html5` Template würde dieses in Contao 5 nicht mehr greifen (es sei denn man 
schaltet das jeweilige Inhaltselement auf die alte Version um).


### Applikationsanpassungen

In Contao 4 wurden noch die Anpassungsmöglichkeiten aus Contao 3 im Ordner `system/config/` unterstützt. Eine solche Unterstützung gibt es
in Contao 5 nicht mehr - daher muss dies nun an den richtigen Ort übertragen werden. Siehe dazu den entsprechenden Eintrag in der
[Entwickler-Dokumentation][ConfigTranslations].


### Migrationen und Datenbank-Updates starten

Ist die Paketaktualisierung auf Contao 5 erfolgreich durchgelaufen kann nun die Datenbank aktualisiert. In Contao 5 gibt es kein
Installtool mehr, die Migration erfolgt vollständig auf der Kommandozeile bzw. über eine entsprechende Funktion im Contao Manager. Um die
Migration auf der Kommandozeile zu starten, muss folgendes Kommando benutzt werden:

```shell
vendor/bin/contao-console contao:migrate
```


[ContaoInstallation]: /de/installation/contao-installieren/
[ContaoInstallTool]: /de/installation/contao-installtool/
[HostingConfig]: /de/installation/systemvoraussetzungen#hosting-konfiguration
[ContaoManager]: /de/installation/contao-manager/
[TwigTemplates]: /de/layout/templates/twig/
[ConfigTranslations]: https://docs.contao.org/dev/getting-started/starting-development/#contao-configuration-translations

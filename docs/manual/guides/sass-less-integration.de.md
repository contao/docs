---
title: "Sass/Less Integration"
description: "Anleitung zur Nutzung von CSS-Präprozessoren."
url: "anleitungen/sass-less-integration"
weight: 30
---


In den Seitenlayouts deines Themes werden u. a. die fertigen CSS-Stylesheets eingebunden. Zur Erstellung von 
CSS Dateien werden oftmals CSS-Präprozessoren wie [Sass bzw. SCSS](https://sass-lang.com/) 
oder [Less](http://lesscss.org/) eingesetzt. Für die folgenden Beispiele nutzen wir Sass/SCSS. Die Vorgehensweise 
für Less ist ansonsten, abgesehen von der unterschiedlichen Sprach-Syntax, identisch.


## Umsetzung innerhalb von Contao

Die Nutzung der Präprozessoren setzt normalerweise eine lokale Installation voraus. Mit Contao kannst du `.scss` 
oder `.less` Dateien direkt im Seitenlayout einbinden. Die entsprechenden CSS-Dateien werden dann automatisch erstellt.

{{% notice note %}}
Auch wenn die direkte Nutzung in Contao funktioniert wird dennoch die Einbindung fertiger CSS-Dateien bzw. deren 
lokale Erstellung über CSS-Präprozessoren empfohlen.
{{% /notice %}}

Für unser einfaches Beispiel erstellen wir uns im `files` Ordner zwei Dateien: `theme.scss` und `_elements.scss`.
In der `theme.scss` wird lediglich eine Variable mit einem Farbwert und die Datei `_elements.scss` (Sass-Partial)
über die [@import](https://sass-lang.com/documentation/at-rules/import) Anweisung inkludiert. In der Datei `_elements.scss`
setzen wir für das H1 Element den Farbwert über die Variable `$main-color` und einen separaten Farbwert für einen Absatz.


```php
// theme.scss

$mainCol: rgb(255, 0, 0) !default;

@import '_elements';
```

```php
// _elements.scss

h1 { color: $mainCol; }

p { color: rgb(0, 255, 0); }
```

Selbstverständlich bieten die CSS-Präprozessoren viel mehr Möglichkeiten. Für unsere Beispiel reicht es aber aus.

Du kannst nun die Datei `theme.scss` in deinem Seitenlayout einbinden, analog zur üblichen Vorgehensweise mit 
.css Dateien. Die Datei `_elements.scss` muß hierbei nicht zusätzlich ausgewählt werden. Deine Webseite sollte im Anschluß 
rote H1-Überschriften und blaue Absatz Texte anzeigen.

Du kannst nun über die Contao [Dateiverwaltung](../../dateiverwaltung) die Datei `theme.scss` direkt bearbeiten. 
Setze für die Variable `$main-color` einen anderen Farbwert und speichere die Änderung ab. Die H1-Überschrift wird mit 
dem geänderten Farbwert ausgegeben.


### Hinweis I - Umgang mit Partials

Trage nun über die Contao [Dateiverwaltung](../../dateiverwaltung) in der Datei `_elements.scss` einen anderen Farbwert 
für den Absatz ein und speichere die Änderung ab. Leider wird diese Änderung im Frontend nicht sofort übernommen! 

Damit deine Änderung in der Sass-Partial Datei wirksam wird musst du im Anschluss die `theme.scss` bearbeiten (Einfach
eine Leerzeile einfügen und speichern). Erst jetzt wird auch diese Änderung im Frontend dargestellt.


### Hinweis II - CSS-Präprozessor Version

Die Contao Integration der CSS-Präprozessoren erfolgt über eigenständige, freie PHP-Bibliotheken. Im Falle von Sass
nutzt Contao [scssphp/scssphp](https://github.com/scssphp/scssphp). Welche Version hierbei aktuell 
herangezogen wird kann man der jeweiligen Contao [composer.json](https://github.com/contao/contao/blob/master/composer.json#L78) entnehmen.

Hierbei handelt es sich also hinsichtlich des Sass-Funktionsumfangs um eine eigenständige Umsetzung die nicht unbedingt 
immer der tatsächlichen [Sass-Version](https://sass-lang.com/install) entspricht. Falls du also in deinen .scss Dateien 
Funktionalitäten entsprechend der aktuellen [Sass-Dokumentation](https://sass-lang.com/documentation) benutzen willst, werden 
diese evtl. über die Contao Integration gar nicht unterstützt. In diesem Fall hilft nur der Vergleich mit den jeweiligen 
Angaben des [scssphp/scssphp Entwicklers](https://github.com/scssphp/scssphp/blob/master/tests/specs/sass-spec-exclude.txt).


## Fazit

Wenn du obige Hinweise berücksichtigst kannst du ohne weiteres mit `.scss` oder `.less` in Contao arbeiten. Dies gilt 
besonders wenn du hauptsächlich Variablen o. Partials verwendest. Der Vorteil liegt hierbei in der Möglichkeit der 
direkten Bearbeitung über den Contao [Dateimanager](../../dateiverwaltung). 

Andererseits stehen dir möglicherweise nicht alle aktuellen Funktionen der CSS-Präprozessor-Versionen zur Verfügung. 
Eine Fehlersuche ist dann aufwendig.


## Empfehlung

Wie bereits eingangs erwähnt, wäre daher der lokale Umgang mit CSS-Präprozessoren empfehlenswert. Du bist dabei 
unabhängig hinsichtlich des Einsatzes der jeweiligen Präprozessor-Versionen. In Contao bindest du lediglich deine 
finalen .css -Dateien ein.

---
title: "Webfont Nutzung"
description: "Informationen zur Einbindung von Schriftarten."
aliases:
    - /de/anleitungen/webfont/
weight: 80
tags: 
    - "Theme"
---


Analog zum Druckbereich kannst du mit Schriftarten Aussagen hervorheben, Emotionen transportieren und passend zur Branche 
beziehungsweise zum Erscheinungsbild deines Unternehmen die Präsentation der Webseite individualisieren. 


## Kommerziell oder Open Source?

Neben kommerziellen Dienstleistern wie »[Adobe-Fonts](https://fonts.adobe.com/)« oder 
»[fonts.com](https://www.fonts.com/)» existieren auch kostenfreie Angebote. Bei den meisten kostenpflichtigen Anbietern 
werden die Webfonts »vermietet« und über eigene Server gehostet. Nur wenige bieten die Webfonts darüber hinaus zum Download an.

Der wohl bekannteste, kostenfreie Anbieter ist Google mit den »[Google Fonts](https://fonts.google.com/)». Du findest 
aber auch Alternativen z. B. auf [GitHub](https://github.com/adobe-fonts/). Bei den Open Source Angeboten solltest du 
darauf achten, dass diese beispielsweise deutsche Sonderzeichen beinhalten. Auch sind hierbei möglicherweise nur wenige
oder sogar keine weiteren Schriftschnitte vorhanden.


## Dateiformate

Historisch bedingt existieren verschiedene Dateiformate wie »[.eot](https://caniuse.com/?search=eot)«, »[.ttf](https://caniuse.com/?search=ttf)«, »[.woff](https://caniuse.com/?search=woff)« oder »[.woff2](https://caniuse.com/?search=woff2)«. Mittlerweile haben 
sich die Formate ».woff« oder ».woff2« zur Nutzung 
in aktuellen Browser Versionen etabliert. 

Möchtest du ältere Browser unterstützen, kannst du die weiteren Dateiformate zusätzlich einsetzen. Ansonsten wird 
auf die in deiner CSS-Datei eingetragenen Systemschriften zurückgegriffen.


## Contao Integration

<style>
/* vollkorn-600 - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: normal;
  font-weight: 600;
  font-display: swap;
  src: url('src-webfont/vollkorn-v12-latin-600.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('src-webfont/vollkorn-v12-latin-600.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('src-webfont/vollkorn-v12-latin-600.woff2') format('woff2'), /* Super Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-600.woff') format('woff'), /* Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-600.ttf') format('truetype'), /* Safari, Android, iOS */
       url('src-webfont/vollkorn-v12-latin-600.svg#Vollkorn') format('svg'); /* Legacy iOS */
}
/* vollkorn-700italic - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: italic;
  font-weight: 700;
  font-display: swap;
  src: url('src-webfont/vollkorn-v12-latin-700italic.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('src-webfont/vollkorn-v12-latin-700italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('src-webfont/vollkorn-v12-latin-700italic.woff2') format('woff2'), /* Super Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-700italic.woff') format('woff'), /* Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-700italic.ttf') format('truetype'), /* Safari, Android, iOS */
       url('src-webfont/vollkorn-v12-latin-700italic.svg#Vollkorn') format('svg'); /* Legacy iOS */
}

.fontDemoLyric {
  font-family: 'Vollkorn', serif;
  background-color: #F0B37E;
  border-radius: 8px;
  color: #ffffff;
  font-style: italic;
  font-weight: 700;
  font-size: 40px;
  line-height: 30px;
  padding: 20px 20px;
  margin: 10px 0 10px 0;
}

.fontDemoAuthor {
  font-family: 'Vollkorn', serif;
  color: #666666;
  font-style: normal;
  font-weight: 600;
  font-size: 20px;
  padding: 0;
  margin: 0;
}
</style>

Im folgenden verwenden wir den Google Webfont »[Vollkorn](https://fonts.google.com/specimen/Vollkorn)«.<br>
Hier beispielsweise mit den Schriftschnitten »Bold 700 italic« und »Semi-bold 600«:

<p class="fontDemoLyric">"Life is a journey, not a destination."<br>
<span class="fontDemoAuthor">Ralph Waldo Emerson</span></p>


### Über externes Google Hosting  {#ueber-externes-google-hosting}

Über »[Google Fonts](https://fonts.google.com/specimen/Vollkorn)« kannst du dir die benötigten Schriftschnitte 
der Schriftart »Vollkorn« auswählen und erhältst im Anschluss eine entsprechende »Embed« Anweisung zwecks Einbindung. 
Diese könnte z. B. wie folgt aussehen:

```html
<link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,600;1,700&display=swap" rel="stylesheet">
```

Trage diese Anweisung im Bereich »Experten-Einstellungen -> Zusätzliche `<head>`-Tags« des 
[Seitenlayouts](/de/layout/theme-manager/seitenlayouts-verwalten/#experten-einstellungen) deines 
[Themes](/de/layout/theme-manager/) ein. Google liefert hierüber die vom jeweiligen Browser benötigten Informationen 
und es Bedarf diesbezüglich keiner weiteren Zuwendung deinerseits. Anschließend kannst du die ausgewählten 
»Schriftart(en) / Schriftschnitt(e)« in deinen CSS-Angaben verwenden:

```CSS
h1, h2 {
  font-family: 'Vollkorn', serif;
  font-style: italic;
  font-weight: 700;
}
```

{{% notice note %}}
In den [Seitenlayouts](/de/layout/theme-manager/seitenlayouts-verwalten/) findest du u. U. noch direkte 
Eingabemöglichkeiten für die Google Webfonts. Diese Option wird in zukünftigen Contao Versionen nicht mehr zur 
Verfügung stehen! Es wird daher die beschriebene Vorgehensweise empfohlen.
{{% /notice %}}


### Lokale Einbindung

Du kannst Webfonts auch »lokal« einbinden. Im Sinne von: Über dein eigenes Hosting.  
Hierbei benötigst du die jeweiligen Dateien (s. o.) und stellst diese in einem öffentlich zugänglichen Verzeichnis 
deiner Contao Installation unterhalb von »files» zur Verfügung.

Im Falle von »Google Fonts« wird dir hierzu zwar eine Download-Option angeboten, allerdings beinhaltet das jeweilige Download-
Archiv lediglich Dateien in den Formaten ».ttf«. 

Die Webapplikation »[Google Webfonts Helper](https://google-webfonts-helper.herokuapp.com/fonts)» stellt die Google 
Webfonts in verschiedenen Dateiformaten zur Verfügung. Darüber hinaus werden, abhängig von deiner Auswahl, die passenden 
CSS Angaben via »`@font-face`« mitgeliefert. Diese CSS Angaben müssen deiner eigenen ».css« Datei hinzugefügt werden. 
Dabei ist es gleichgültig ob du direkt mit CSS-Dateien arbeitest oder ob du diese 
über [Präprozessoren](/de/anleitungen/sass-less-integration/) wie »Sass/Less« erstellst. 

Du bindest dann die CSS-Datei als externes Stylesheet im Bereich »Experten-Einstellungen -> Stylesheets« 
des [Seitenlayouts](/de/layout/theme-manager/seitenlayouts-verwalten/#stylesheets) deines [Themes](/de/layout/theme-manager/)
ein.

{{% notice note %}}
Die Pfadangaben `url()` auf die Webfont-Dateien innerhalb der CSS `@font-face` Direktive erfolgen relativ zur
Position der CSS-Datei. Dies ist abhängig von deiner Verzeichnisstruktur.
{{% /notice  %}}

Angenommen, du hast die Webfont-Dateien in ein Verzeichnis »files/theme/fonts« kopiert und deine CSS-Datei liegt im 
Verzeichnis »files/theme/css«, dann wären die korrekten relativen Pfadangaben demnach:

```CSS
/* vollkorn-600 - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: normal;
  font-weight: 600;
  src: url('../fonts/vollkorn-v12-latin-600.eot');
  src: local(''),
       url('../fonts/vollkorn-v12-latin-600.eot?#iefix') format('embedded-opentype'),
       url('../fonts/vollkorn-v12-latin-600.woff2') format('woff2'),
       url('../fonts/vollkorn-v12-latin-600.woff') format('woff'),
       url('../fonts/vollkorn-v12-latin-600.ttf') format('truetype'),
       url('../fonts/vollkorn-v12-latin-600.svg#Vollkorn') format('svg');
}
```

{{% notice info %}}
Im [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/#stylesheets) kannst du die Option 
»Skripte zusammenfassen« aktivieren. Hierbei werden alle CSS-Angaben der ausgewählten internen und externen CSS- 
Dateien in eine einzige, neue Datei zusammengefaßt und von Contao im Verzeichnis »assets/css« abgelegt.<br><br>
Da sich die neue CSS-Datei nun im Verzeichnis »assets/css« befindet, passt Contao die Pfade zu den Schriften automatisch an.  
`... url('../../files/theme/fonts/vollkorn-v12-latin-600.woff2') format('woff2'), ...`.
{{% /notice  %}}


## Die CSS »font-display« Eigenschaft

Eine Webfont-Datei, sofern sich diese nicht bereits im Browser-Cache befindet, muss zunächst vom Browser vollständig 
geladen werden bevor diese genutzt werden kann. Entsprechend muss der Browser beim Laden der Webseite hinsichtlich 
der Darstellung reagieren. Das führt zu folgenden Unschönheiten:

* Solange eine Webfont-Datei nicht komplett vorliegt, versteckt der Browser diese. Nach dem vollständigen Laden wird 
die Webfont ausgegeben: »Flash Of Invisible Text-Effekt (FOIT)«.

* Bei einer längeren Ladezeit wird zunächst eine Fallback-Schrift ausgegeben.

Eine Zeit lang wurde versucht hierbei mit clientseitigen JavaScript-Lösungen entgegenzuwirken. Mittlerweile kannst du 
über die CSS-Eigenschaft [`font-display`](https://www.w3.org/TR/css-fonts-4/#font-display-desc) zumindest das Browser-
Verhalten einheitlich steuern 
(s. a.: [developer.mozilla.org](https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display)). Eingesetzt 
wird `font-display` innerhalb einer CSS `@font-face` Deklaration und bietet vier verschiedene Werte:  
»auto«, »swap«, »fallback« und »optional«.

Der Wert `swap` wird in den meisten Fällen verwendet und du findest diesen auch in den Google Fonts-Embed- 
Anweisungen vor (s. o.). Entsprechend kannst du bei einer lokalen Nutzung deine CSS Angaben erweitern:

```CSS
@font-face {
  font-display: swap;
...
}
```

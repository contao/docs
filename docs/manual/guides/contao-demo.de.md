---
title: "Die Contao Demo anpassen"
description: "Die Contao Demo nutzen und anpassen."
url: "anleitungen/contao-demo"
aliases:
    - /de/anleitungen/contao-demo/
weight: 11
tags: 
   - "Demo"
---


Die [Contao Demo](https://demo.contao.org/contao) repräsentiert eine vollständige Website zwecks Darstellung der Contao Möglichkeiten. 
Du kannst auf [contao.org](https://contao.org/) die Demo einsehen und inkl. Backend Zugang testen oder du installierst dir die Contao Demo 
und erweiterst diese nach deinen Bedürfnissen.

Bei den folgenden Angaben handelt es sich nicht um ein vollständiges Tutorial bez. einer
[lokalen Contao Installation](/de/anleitungen/lokale-installation/), CSS oder [SASS/SCSS Nutzung](/de/anleitungen/sass-less-integration/).
Es werden hierbei lediglich einige der zahlreichen Optionen aufgeführt, die du zur weiteren Anpassung nutzen könntest.


## Installation

Die Contao Demo kannst du über den Contao-Manager, bei einer Neuinstallation, bequem installieren. Weiterhin 
besteht die Möglichkeit der Installation über die Konsole. Informationen hierzu findest du auf der entsprechenden 
[GitHub Seite](https://github.com/contao/contao-demo). Im Anschluss kannst du im Contao Backend die vollständige Umsetzung der Contao Demo 
Website nachvollziehen.


## Layout Anpassungen

Die Contao Demo benutzt `.scss` Dateien für die Gestaltung. Diese (bzw. nur die `app.scss`) werden direkt in den jeweiligen Contao 
Theme Einstellungen genutzt und dann über Contao als finale `.css` Datei kompiliert und bereit gestellt. 

{{% notice note %}}
Was du hierbei berücksichtigen solltest, wird im Beitrag »[Sass/Less Integration](/de/anleitungen/sass-less-integration/)« näher beschrieben.
{{% /notice %}}


### Beispiel

Mit dem Wissen obiger Contao Möglichkeiten (via »[scssphp/scssphp](https://github.com/scssphp/scssphp)«) kannst du direkt im Contao Backend 
die `.scss` Dateien bearbeiten. Möchtest du z. B. die Farbwerte der Demo anpassen, kannst du über die Contao [Dateiverwaltung](/de/dateiverwaltung/)
in der Datei »`contaodemo/theme/src/scss/variables/_colors.scss`« Änderungen vornehmen und speichern. Weitere SASS Variablen findest du 
in den Dateien »`_sizes.scss`«, »`_fonts.scss`« und »`_animation.scss`« vor.  

Damit die Änderungen an diesen ([SASS-Partial](https://sass-lang.com/guide/#partials)) Dateien übernommen werden, musst du allerdings im 
Anschluss die »`app.scss`« einmalig anfassen und speichern (s. a.: »[Sass/Less Integration](/de/anleitungen/sass-less-integration/)«).


## Dart Sass

Die von Contao genutzte »[scssphp/scssphp](https://github.com/scssphp/scssphp)« Bibliothek unterstützt u. U. keine 
aktuellen »[Dart Sass](https://sass-lang.com/dart-sass/)« Leistungsmerkmale wie z. B. »[@use](https://sass-lang.com/documentation/at-rules/use/)«, 
[@forward](https://sass-lang.com/documentation/at-rules/forward/) oder weitere »Dart Sass« [Module](https://sass-lang.com/documentation/modules/).

{{% notice note %}}
Das gilt u. U. auch für existierende SASS Erweiterungen z. B. für den »[Visual Studio Code](https://code.visualstudio.com/)« Editor etc. 
{{% /notice %}}

In diesem Fall ist es, in Verbindung mit einer [lokalen Contao Installation](/de/anleitungen/lokale-installation/) und einer puren »Dart Sass« 
Installation (s. u.), daher optimaler, die `.scss` Dateien, den Anforderungen entsprechend, lokal zu kompilieren und dann nur die final 
vorliegende `.css` Datei (demnach `app.css`) in Contao zu referenzieren.


### Vorbereitungen

Die Vorgehensweise zur »Dart Sass« Installation findest du [hier](https://sass-lang.com/install/). Anleitungen und Tutorials sind zahlreich 
vorhanden, daher werden wir hier nicht im Detail darauf eingehen. 

In Verbindung mit »[Node.js](https://nodejs.org/)« ist es günstig, die »`package.json`« außerhalb der Contao Verzeichnisse anzulegen. So 
könntest du später auch weitere Contao Installationen bedienen und musst dabei nur die jeweiligen Pfade der SCSS und CSS Verzeichnisse, relativ
zur »`package.json`«, anpassen. Weiterhin besteht die hilfreiche Möglichkeit, die »[SASS Anweisungen](https://sass-lang.com/documentation/cli/dart-sass/)« 
über »[nodescripts](https://docs.npmjs.com/cli/v10/using-npm/scripts)« einmalig zu definieren und bequem zu starten.

Wenn du die generierte »`app.css`« der Demo in den Contao Theme-Einstellungen nutzt, fehlen in den Browser Dev-Tools die Referenzen zu den 
jeweiligen `.scss` Abschnitten. Daher werden hierzu »[Source Maps](https://sass-lang.com/documentation/cli/dart-sass/#source-maps)« benötigt, 
die du automatisch über SASS erstellen und während der lokalen Entwicklung nutzen kannst. Liegt die jeweilige »Source Map« (`.map`) neben der
»`app.css`« vor, zeigen die Browser Dev-Tools dann direkt auf die passenden Einträge in den `.scss` Dateien. 

{{% notice tip %}}
Dies ist hilfreich für den nächsten Schritt. Mit dem SASS Flag »[--watch](https://sass-lang.com/documentation/cli/dart-sass/#watch)« wird
die Erstellung einer `.css` Datei automatisch angestoßen, sobald du Änderungen an den `.scss` Dateien (inkl. SASS Partials) speicherst, auch 
über die Browser Dev-Tools (mit Workspace Freigaben). Einmalig aktiviert, kannst du jetzt direkt Auswirkungen deiner `.scss` Anpassungen in 
den Browser Dev-Tools verfolgen, ändern und speichern.
{{% /notice %}}


## Lokale Layout Anpassungen

Für das Beispiel der Farbanpassungen möchten wir, zwecks Übersicht, lediglich die zu ändernden SASS Variablen hervorheben. Hierzu
legen wir uns im Verzeichnis »`scss`« eine neue SASS Partial Datei »`_custom.scss`« an. Hierin kopieren wir lediglich die Variablen aus 
»`variables/_colors.scss`«, die wir tatsächlich ändern bzw. überschreiben möchten.

Wir ändern die Farbwerte in der »`_custom.scss`« und binden diese als ersten Eintrag in der »`app.scss`« mittels 
»[@import](https://sass-lang.com/documentation/at-rules/import/)« ein. Die neuen Farbangaben werden zwar jetzt eingebunden aber noch nicht 
berücksichtigt!

In der »`variables/_colors.scss` müssen wir hierzu noch das SASS Flag »[!default](https://sass-lang.com/documentation/variables/#default-values)« 
nutzen. Hierüber werden die bestehenden Werte der SASS Variablen nur dann herangezogen, sofern nicht bereits eine Definition vorliegt. Dies ist aber 
über unsere Angaben aus der `_custom.scss` gegeben und daher werden diese Farbangaben jetzt berücksichtigt.

Die drei Dateien könnten jetzt in Auszügen so aussehen:

{{< tabs groupId="SASS-SAMPLE">}}

{{% tab name="_colors.scss" %}}
```scss
// global colors
$c-primary--50: hsla(30, 100%, 97%, 1)  !default;
$c-primary--500: hsla(30, 100%, 48%, 1) !default;
$c-primary--600: hsla(30, 100%, 42%, 1) !default;
$c-primary--700: hsla(30, 100%, 30%, 1) !default;

$c-secondary--700: hsla(207, 44%, 26%, 1) !default;
$c-secondary--800: hsla(207, 44%, 21%, 1) !default;
$c-secondary--900: hsla(207, 44%, 14%, 1) !default;

// background gradients
$gradient--1: radial-gradient(50% 50% at 50% 50%, hsla(207, 44%, 26%, 1) 0%, hsla(207, 44%, 21%, 1) 100%) !default;

...
```
{{% /tab %}}

{{% tab name="_custom.scss" %}}
```scss
// ### custom color variables

$c-primary--50: hsla(30, 100%, 97%, 1);
$c-primary--500: hsla(212, 100%, 48%, 1);
$c-primary--600: hsla(212, 100%, 42%, 1);
$c-primary--700: hsla(212, 100%, 30%, 1);

$c-secondary--700: hsla(242, 100%, 25%, 1);
$c-secondary--800: hsla(242, 100%, 21%, 1);
$c-secondary--900: hsla(242, 100%, 14%, 1);

$gradient--1: radial-gradient(50% 50% at 50% 50%, $c-primary--700 0%, $c-secondary--900 100%);
```
{{% /tab %}}

{{% tab name="app.scss" %}}
```scss
// ### custom variables
@import 'custom';

// ### general variables
...
```
{{% /tab %}}

{{< /tabs >}}


## Fazit

Die obige Umsetzung könntest du ohne weiteres auch direkt in Contao nutzen. Wie erwähnt, bietet »Dart Sass« aber eben noch zahlreiche,
weitere Möglichkeiten. Statt in der `_custom.scss` explizit die Farbangaben via »CSS hsla()« zu definieren, könntest du hierbei 
auch [SASS Module zur Farb-Konvertierung](https://sass-lang.com/documentation/modules/color/) verwenden.

Weiterhin wäre die Nutzung von »[@use](https://sass-lang.com/documentation/at-rules/use/)« und »[@forward](https://sass-lang.com/documentation/at-rules/forward/)«
anstelle von »[@import](https://sass-lang.com/documentation/at-rules/import/)«, gerade bei größeren Projekten, nützlich. Hierbei wurden u. a. 
»Namespaces« eingeführt, die eine eindeutige und sichere Referenzierung ermöglichen.

Möchtest du diese und zukünftige »Dart Sass« Leistungsmerkmale nutzen, kannst du das über einen lokalen Workflow realisieren. 

{{% notice tip %}}
Selbstverständlich bist du dabei, unabhängig von Contao Versionen, nicht eingeschränkt. So könntest du in deinem Workflow z. B. auch
etablierte CSS-Variablen (»[custom properties](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)«) oder 
andere Kombinationen einsetzen.
{{% /notice %}}

 

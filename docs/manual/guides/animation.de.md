---
title: "Animationen"
description: "Animationen in Contao."
aliases:
  - /de/anleitungen/animation/
weight: 100
tags: 
  - "Theme"
---


Animationen beleben deine Inhalte und begegnen dir in den unterschiedlichsten Bereichen. Sparsam eingesetzt kannst du in jedem Fall 
die gewünschte Aufmerksamkeit erzielen. Mittlerweile können Animationen in aktuellen Browsern über CSS-Angaben realisiert werden. Für 
komplexe Aufgaben stehen entsprechende JavaScript-Frameworks wie z. B. »[createjs](https://createjs.com/) (2D)« oder auch 
»[threejs](https://threejs.org/) (3D)« zur Verfügung. Weiterhin können Animationen auch direkt in .svg Dateien über die 
»[Synchronized Multimedia Integration Language](https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL)« (SMIL) realisiert werden.

Contao unterstützt dich bei der Realisierung, entweder über manuelle CSS/JavaScript Umsetzungen oder über den Einsatz von Erweiterungen.


## Grundlagen

Eine Animation definiert sich über die Änderung eines Objektes in einer bestimmten Geschwindigkeit über einen definierten Zeitraum 
([Easing](https://easings.net/de) o. a. Tweening). Die Änderung kann sich z. B. auf die Größe, Position oder Stil (auch in Kombination) 
eines Objektes beziehen. 


### Eigenschaften »transition« und »transform«

Hinsichtlich der CSS-Umsetzung sind die Eigenschaften »[transition](https://developer.mozilla.org/de/docs/Web/CSS/transition)« und 
»[transform](https://developer.mozilla.org/de/docs/Web/CSS/transform)« relevant. Im folgenden ein einfaches Beispiel für ein animiertes Symbol:

<style>
/* Internal live demo - start */
span {
  font-style: italic;
}
.symbol,
.symbol-hover {
  margin: 1em;
  width: 40px;
}

.symbol::before, 
.symbol::after, 
.symbol div {
  background-color: #000;
  border-radius: 3px;
  content: '';
  display: block;
  height: 5px;
  margin: 7px 0;
}	

.symbol.end::before { transform: translateY(12px) rotate(45deg); }
.symbol.end::after {  transform: translateY(-12px) rotate(-45deg); }
.symbol.end div { transform: scale(0); }

.symbol-hover::before, .symbol-hover::after, .symbol-hover div {
  background-color: #000;
  border-radius: 3px;
  content: '';
  display: block;
  height: 5px;
  margin: 7px 0;	
  transition: all .2s ease-in-out;	
}
.symbol-hover { cursor: pointer;}
.symbol-hover:hover::before { transform: translateY(12px) rotate(135deg); }
.symbol-hover:hover::after { transform: translateY(-12px) rotate(-135deg); }
.symbol-hover:hover div { transform: scale(0); }
/* Internal live demo - end */
</style>


{{< tabs groupId="SampleBurger">}}

{{% tab name="Beispiel" %}}
```Html
<style>
.symbol {
  margin: 1em;
  width: 40px;
}
.symbol::before, .symbol::after, .symbol div {
  background-color: #000;
  border-radius: 3px;
  content: '';
  display: block;
  height: 5px;
  margin: 7px 0;	
  transition: all .2s ease-in-out;	
}
.symbol:hover::before { transform: translateY(12px) rotate(135deg); }
.symbol:hover::after  { transform: translateY(-12px) rotate(-135deg); }
.symbol:hover div     { transform: scale(0); }
</style>

<div class="symbol"><div></div></div>
```
{{% /tab %}}

{{% tab name="Start / Ziel" %}}
<span>Darstellung »Start«</span>
<div class="symbol"><div></div></div>

<span>Darstellung »Ziel«</span>
<div class="symbol end"><div></div></div>
{{% /tab %}}

{{% tab name="Animation (Hover-Event )" %}}
<span>Bewege den Mauszeiger über das Symbol</span>
<div class="symbol-hover"><div></div></div>
{{% /tab %}}

{{< /tabs >}}

Diese Art der Umsetzung benötigt einen Auslöser (Event). Wie im obigen Beispiel als »Hover-Event» oder
anderenfalls über ein »Klick-Event« mittels JavaScript. 


### Keyframes und die Eigenschaft »animation«

Als Alternative kannst du eigene Animations-Regeln über »[@keyframes](https://developer.mozilla.org/de/docs/Web/CSS/@keyframes)« in 
Verbindung mit der Eigenschaft »[animation](https://developer.mozilla.org/de/docs/Web/CSS/animation)« definieren. Die einzelnen Schritte 
der Animationssequenz können hierbei gezielt kontrolliert werden. Diese Vorgehensweise ähnelt der 
»[transition](https://developer.mozilla.org/de/docs/Web/CSS/transition)« Nutzung, setzt allerdings eine Animationen automatisch und 
kontinuierlich in Kraft und nicht als Reaktion auf ein Event.

Im folgenden ein klassisches Beispiel für einen »hüpfenden« Ball. Hierbei verwenden wir die CSS-Eigenschaft 
»[translate3d](https://developer.mozilla.org/de/docs/Web/CSS/transform-function/translate3d())« und statt der üblichen 
»[easing](https://easings.net/de)« Funktion nutzen wir eine eigene Definition über »[cubic-bezier](https://developer.mozilla.org/en-US/docs/Web/CSS/easing-function)«.


<style>
/* Internal live demo - start*/  
.bouncing-ball-wrapper {
  min-height: 100px;
}
.bouncing-ball {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: #f47c00;

  animation: bounce 0.5s;
  animation-direction: alternate;
  animation-timing-function: cubic-bezier(.5,0.05,1,.5);
  animation-iteration-count: infinite;
}

@keyframes bounce {
  from { transform: translate3d(0, 0, 0);    }
  to   { transform: translate3d(0, 50px, 0); }
}
/* Internal live demo - end */
</style> 

{{< tabs groupId="SampleBouncingBall">}}

{{% tab name="Beispiel" %}}
```Html
<style>
.bouncing-ball {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: #f47c00;

  animation: bounce 0.5s;
  animation-direction: alternate;
  animation-timing-function: cubic-bezier(.5,0.05,1,.5);
  animation-iteration-count: infinite;
}

@keyframes bounce {
  from { transform: translate3d(0, 0, 0);    }
  to   { transform: translate3d(0, 50px, 0); }
}
</style> 

<div class="bouncing-ball"></div>
```
{{% /tab %}}

{{% tab name="Animation" %}}
<div class="bouncing-ball-wrapper"><div class="bouncing-ball"></div></div>
{{% /tab %}}

{{< /tabs >}}


### Die Eigenschaft »transform-origin«

Die CSS-Eigenschaft »[transform-origin](https://developer.mozilla.org/de/docs/Web/CSS/transform-origin)« legt den Ankerpunkt für die 
Transformationen eines Elements fest. Ein Ankerpunkt ist der Punkt, **um den** eine Transformation angewendet wird. Möchtest du den 
Ausgangspunkt der Rotation eines Objekts ändern, kannst du die entsprechende Position über diese Eigenschaft definieren.


## Animation Framework

Für CSS-Animationen stehen zahlreiche OpenSource Lösungen zur Verfügung. Die wohl bekannteste ist 
»[animate.css](https://animate.style/)». Auf der Webseite findest du entsprechende Beispiele zusammen mit einer 
detaillierten [Dokumententation](https://animate.style/#documentation).

Hierbei werden die zahlreichen Animationen über CSS-Klassen definiert. Da du in Contao in allen 
[Inhaltselementen](/de/artikelverwaltung/inhaltselemente/) und [Modulen](/de/layout/modulverwaltung/) CSS-Klassen 
angeben kannst, musst du lediglich die aktuelle [Version](https://github.com/animate-css/animate.css/releases) 
der »animate.css« Datei deinem [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/) hinzufügen. 


### Animation eines Contao Inhaltselements

Im Anschluß kannst du zur Animation eines Contao Inhaltselement vom Typ [Text](/de/artikelverwaltung/inhaltselemente/#text) im Bereich 
»Experteneinstellungen -> CSS-ID/Klasse« namentlich die gewünschte Animation (z.B. `animate__slideInRight`) als 
CSS-Klasse definieren. Damit die Animation auch **sofort** ausgeführt wird benötigt es außerdem die Angabe von `animate__animated`.


## Animation abhängig vom Browser Viewport

Wenn du Animationen über »keyframes« oder ein »Framework« setzt, werden diese u. U. sofort ausgeführt. Dies ist nicht hilfreich, sollte
der entsprechende Bereich beim Seitenaufruf nicht augenblicklich sichtbar sein. Abhilfe schaffen JavaScript Lösungen wie z. B. 
[wow.js](https://wowjs.uk/) oder [waypoint.js](http://imakewebthings.com/waypoints/).

Diese beobachten permanent den aktuellen Browser Viewport und ermöglichen dir, z. B. entsprechende CSS-Klassen zeitnah zu setzen. Damit 
starten deine Animationenen erst, sobald der Bereich im Browser auch tatsächlich sichtbar wird. Mit Contao kannst du diese JavaScript 
Lösungen manuell einbinden oder entsprechende Erweiterungen ([inspiredminds/contao-wowjs](https://extensions.contao.org/?q=wow&pages=1&p=inspiredminds%2Fcontao-wowjs)) installieren.


{{% notice info %}}
Falls die obigen JavaScript Frameworks zu aufwendig erscheinen, kannst du hierzu auch die 
[Intersection Observer API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) nutzen. Eine 
[praktische Anwendung](https://github.com/heimseiten/contao-inviewport-bundle/blob/main/src/Resources/public/inViewport.js) findest du z. B. 
in der Contao Erweiterung [contao-inviewport-bundle](https://extensions.contao.org/?q=viewport&pages=1&p=heimseiten%2Fcontao-inviewport-bundle).
{{% /notice %}}


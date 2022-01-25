---
title: "Animation"
description: "Animation in Contao."
aliases:
  - /de/guides/animation/
weight: 100
tags: 
  - "Theme"
---


Animations liven up your content and are encountered in a wide variety of areas. Used sparingly, you can in any case 
achieve the desired attention. Meanwhile, animations can be realized in current browsers via CSS specifications. For 
JavaScript frameworks such as "[createjs](https://createjs.com/)" (2D) or "[threejs](https://createjs.com/)" (3D) are available for complex tasks. 
Furthermore, animations can also be created directly in .svg files using "[SMIL](https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL)" (Synchronized Multimedia Integration Language).

Contao supports you in the realization, either through manual CSS/JavaScript implementations or through the use of extensions.


## Fundamentals

An animation is defined by the change of an object in a certain speed over a defined period of time ([Easing](https://easings.net/en) 
or tweening). The change can refer e.g. to the size, position or style (also in combination) of an object. 

### Properties "transition" and "transform

Regarding the CSS implementation, the properties "[transition](https://developer.mozilla.org/en/docs/Web/CSS/transition)" 
and "[transform](https://developer.mozilla.org/en/docs/Web/CSS/transform)" are relevant. The following is a simple example of an animated symbol:

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

{{% tab name="Example" %}}
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

{{% tab name="Start / Target" %}}
<span>Start representation</span>
<div class="symbol"><div></div></div>

<span>Target representation</span>
<div class="symbol end"><div></div></div>
{{% /tab %}}

{{% tab name="Animation (Hover-Event )" %}}
<span>Move the mouse cursor over the icon</span>
<div class="symbol-hover"><div></div></div>
{{% /tab %}}

{{< /tabs >}}

This type of implementation requires a trigger (event). As in the example above as a "hover event" or
otherwise via a "click event" using JavaScript. 


### Keyframes and the "animation" property


Alternatively, you can define your own animation rules using "[@keyframes](https://developer.mozilla.org/en-US/docs/Web/CSS/@keyframes)" 
in conjunction with the "[animation](https://developer.mozilla.org/en-US/docs/Web/CSS/animation)" property. The individual steps of the 
animation sequence can be specifically controlled here. This approach is similar to the "transition" usage, but enforces an animation 
automatically and continuously instead of reacting to an event.

The following is a classic example of a "bouncing" ball. Here we use the CSS property 
"[translate3d](https://developer.mozilla.org/en-US/docs/Web/CSS/transform-function/translate3d())" and instead of the usual "easing" 
function we use our own definition via "[cubic-bezier](https://developer.mozilla.org/en-US/docs/Web/CSS/easing-function)".

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

{{% tab name="Example" %}}
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


### The "transform-origin" property

The CSS property "[transform-origin](https://developer.mozilla.org/en-US/docs/Web/CSS/transform-origin)" sets the anchor point for an element's 
transformations. An anchor point is the point **around which** a transformation is applied. If you want to change the 
the starting point of an object's rotation, you can define the corresponding position using this property.


## Animation Framework

There are numerous open source solutions available for CSS animations. Probably the best known is 
"[animate.css](https://animate.style/)". On the website you can find corresponding examples together with a 
detailed [documentation](https://animate.style/#documentation).

Here, the numerous animations are defined using CSS classes. Since in Contao you can use 
[content elements](/en/article-management/content-elements/) and [modules](/en/layout/module-management/) you only have to specify the 
current [version](https://github.com/animate-css/animate.css/releases) of the "animate.css" file to your [page layout](/en/layout/theme-manager/manage-page-layouts/).


### Animation of a content element

To animate a Contao content element, you can define the desired animation (e.g. `animate__slideInRight`) as CSS class in the 
area "Expert settings -> CSS ID/Class". To execute the animation immediately, you also need to specify `animate__animated`.


## Animation depending on browser viewport

If you set animations via "keyframes" or a "framework", they may be executed immediately. This is not helpful if
the corresponding area is not immediately visible when the page is opened. This can be remedied by JavaScript solutions such as 
[wow.js](https://wowjs.uk/) or [waypoint.js](http://imakewebthings.com/waypoints/).

These permanently monitor the current browser viewport and allow you to set e.g. appropriate CSS classes in a timely manner. With this 
your animations start as soon as the area is actually visible in the browser. With Contao, you can use these JavaScript 
solutions manually or install appropriate extensions ([inspiredminds/contao-wowjs](https://extensions.contao.org/?q=wow&pages=1&p=inspiredminds%2Fcontao-wowjs)).

{{% notice info %}}
If the above JavaScript frameworks seem too complex, you can also use the 
[Intersection Observer API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API). A 
[practical example](https://github.com/heimseiten/contao-inviewport-bundle/blob/main/src/Resources/public/inViewport.js) can be found 
in the Contao extension [contao-inviewport-bundle](https://extensions.contao.org/?q=viewport&pages=1&p=heimseiten%2Fcontao-inviewport-bundle).
{{% /notice %}}


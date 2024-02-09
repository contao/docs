---
title: "Verschiedenes"
description: "Inhaltselemente im Bereich Verschiedenes."
url: "artikelverwaltung/inhaltselemente/verschiedenes"
aliases:
    - /de/artikelverwaltung/inhaltselemente/verschiedenes/
weight: 28
---

{{< version "5.3" >}}


## Akkordeon

**Hierbei handelt es sich um ein [verschachteltes Inhaltselement](/de/artikelverwaltung/inhaltselemente/#verschachtelte-inhaltselemente).**

Der Akkordeon-Effekt erlaubt das Anlegen mehrerer Abschnitte, von denen jeweils nur einer geöffnet ist. Wird ein
anderer Abschnitt ausgewählt, schließt sich der erste automatisch. Als Vorlage für die Umsetzung in Contao dient dabei 
das Paket [Handorgel](https://github.com/oncode/handorgel).

![Akkordeon]({{% asset "images/manual/article-management/de/akkordeon.png" %}}?classes=shadow)


### Akkordeon-Einstellungen

**Alle Bereiche schließen:** Den ersten Bereich standardmäßig nicht öffnen.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/accordion` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-accordion" id="handorgel1">
    <h2 class="handorgel__header" id="handorgel1-fold1-header">
        <button class="handorgel__header__button" aria-controls="handorgel1-fold1-content" aria-expanded="false" aria-disabled="false">…</button>
    </h2>
    <div class="handorgel__content" id="handorgel1-fold1-content" role="region" aria-labelledby="handorgel1-fold1-header" style="height: 0px;">
        <div class="handorgel__content__inner">
            <div class="content-text">
                <div class="rte">
                    …
                </div>
            </div>
        </div>
    </div>
    <h2 class="handorgel__header" id="handorgel1-fold2-header">
        <button class="handorgel__header__button" aria-controls="handorgel1-fold2-content" aria-expanded="false" aria-disabled="false">…</button>
    </h2>
    <div class="handorgel__content" id="handorgel1-fold2-content" role="region" aria-labelledby="handorgel1-fold2-header" style="height: 0px;">
        <div class="handorgel__content__inner">
            <div class="content-text">
                <div class="rte">
                    …
                </div>
            </div>
        </div>
    </div>
</div>
```


## Elementgruppe

**Hierbei handelt es sich um ein [verschachteltes Inhaltselement](/de/artikelverwaltung/inhaltselemente/#verschachtelte-inhaltselemente).**

Mit Elementgruppen kannst du Inhalte gruppieren und damit die Übersichtlichkeit in Backend erhöhen.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/element_group` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-element-group">
    <div class="content-text">
        <h2>…</h2>
        <div class="rte">
            …
        </div>
    </div>
    <div class="content-text">
        <h2>…</h2>
        <div class="rte">
            …
        </div>
    </div>
</div>
```


## Content-Slider

**Hierbei handelt es sich um ein [verschachteltes Inhaltselement](/de/artikelverwaltung/inhaltselemente/#verschachtelte-inhaltselemente).**

Mit dem Inhaltselement »Content-Slider« wird aus verschiedenen Inhaltselementen ein Slider erstellt. Als Vorlage für die 
Umsetzung in Contao dient dabei das Paket [Swiper](https://swiperjs.com/).

![Content-Slider]({{% asset "images/manual/article-management/de/content-slider.png" %}}?classes=shadow)


### Slider-Einstellungen

**Slide-Intervall:** Hier kannst du den Zeitraum in Millisekunden zwischen den Slides (1000 = 1s) bestimmen. 0
deaktiviert den automatischen Wechsel.

**Übergangsgeschwindigkeit:** Hier kannst du die Übergangsgeschwindigkeit in Millisekunden (1000 = 1s) bestimmen.

**Slide-Versatz:** Hier kannst du den Slider mit einer bestimmten Folie beginnen (die Zählung beginnt bei 0).

**Kontinuierlich:** Einen kontinuierlichen Slider erstellen (beim Erreichen des Endes von vorne beginnen).


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/swiper` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-swiper">
    <div class="swiper" data-delay="0" data-speed="300" data-offset="0" data-loop>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="content-text">
                    <h2>…</h2>
                    <div class="rte">
                        …
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="content-text">
                    <h2>…</h2>
                    <div class="rte">
                        …
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="swiper-button-prev"></button>
        <button type="button" class="swiper-button-next"></button>
        <div class="swiper-pagination"></div>
    </div>
</div>
```
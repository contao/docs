---
title: "Content-Slider"
description: "Inhaltselemente im Bereich Content-Slider"
url: "artikelverwaltung/inhaltselemente/content-slider"
aliases:
    - /de/artikelverwaltung/inhaltselemente/content-slider/
weight: 23
---


Mit dem Inhaltselement »Content-Slider« wird aus verschiedenen Inhaltselementen ein Slider erstellt.  

Damit der Slider funktioniert muss das *js_slider*-Template im Seitenlayout eingebunden sein.

**Betriebsart:** Hier wählst du die Betriebsart des Slider-Elements aus.

| Betriebsart             | Erklärung                                                                                                                            |
|:------------------------|:-------------------------------------------------------------------------------------------------------------------------------------|
| Umschlag&nbsp;Anfang    | In diesem Modus eröffnet das Element einen neuen Slider-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können. |
| Umschlag Ende           | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Slider-Abschnitt.                              |

**Slide-Intervall:** Hier kannst du den Zeitraum in Millisekunden zwischen den Slides (1000 = 1s) bestimmen. 0 
deaktiviert den automatischen Wechsel.

**Übergangsgeschwindigkeit:** Hier kannst du die Übergangsgeschwindigkeit in Millisekunden (1000 = 1s) bestimmen.

**Slide-Versatz:** Hier kannst du den Slider mit einer bestimmten Folie beginnen (die Zählung beginnt bei 0).

**Kontinuierlich:** Einen kontinuierlichen Slider erstellen (beim Erreichen des Endes von vorne beginnen).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_sliderStart` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_sliderStart first block">

    <div class="content-slider" data-config="5000,300,0,1">
        <div class="slider-wrapper">    
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
        </div>
    </div>
    
    <nav class="slider-control">
        <a href="#" class="slider-prev">Zurück</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Vorwärts</a>
    </nav>

</div>
```
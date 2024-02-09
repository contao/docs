---
title: "Legacy-Elemente"
description: "Inhaltselemente im Bereich Legacy-Elemente"
url: "artikelverwaltung/inhaltselemente/legacy-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/legacy-elemente/
weight: 30
---


## Akkordeon

Der Akkordeon-Effekt erlaubt das Anlegen mehrerer Abschnitte, von denen jeweils nur einer geöffnet ist. Wird ein 
anderer Abschnitt ausgewählt, schließt sich der erste automatisch.

Damit das Akkordeon funktioniert muss das *js_accordion*-Template im Seitenlayout eingebunden sein.

**Betriebsart:** Hier wählst du die Betriebsart des Akkordeon-Elements aus.

| Betriebsart                         | Erklärung                                                                                                                                  |
|:------------------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------|
| Akkordeon&nbsp;Einzelelement        | In diesem Modus legt das Element einen einzelnen Akkordeon-Abschnitt mit einem Textelement und einem optionalen Bild an.                   |
| Akkordeon&nbsp;Umschlag&nbsp;Anfang | In diesem Modus eröffnet das Element einen neuen Akkordeon-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können.    |
| Akkordeon&nbsp;Umschlag&nbsp;Ende   | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Akkordeon-Abschnitt.                                 |


### Akkordeon-Einstellungen

**Bereichsüberschrift:** Jeder Akkordeon-Abschnitt hat eine immer sichtbare Überschrift, über die er geöffnet werden 
kann. HTML-Eingaben sind hier erlaubt.

**CSS-Format:** Falls du die Bereichsüberschrift mittels CSS-Code formatieren möchtest, kannst du hier eine 
Formatdefinition erfassen.

**Klassennamen:** Lasse das Feld leer, um die Standard-Klassennamen zu verwenden, oder gib eigene Toggler- und 
Accordion-Klassen ein.


### Text/HTML/Code

**Text:** Hier kannst du den Text des Akkordeon-Abschnitts eingeben. Die Eingabe erfolgt wie beim Textelement über den 
Rich-Text-Editor.


### Bildeinstellungen

**Ein Bild hinzufügen:** Hier kannst du dem Element ein Bild hinzufügen.

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast,
kannst du den Upload hier nachholen, ohne die Eingabemaske zu verlassen.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird es
![oberhalb]({{% asset "icons/above.svg" %}}?classes=icon) **oberhalb**,
![unterhalb]({{% asset "icons/below.svg" %}}?classes=icon) **unterhalb**,
![linksbündig]({{% asset "icons/left.svg" %}}?classes=icon) **linksbündig** oder
![rechtsbündig]({{% asset "icons/right.svg" %}}?classes=icon) **rechtsbündig** eingefügt. Bei **links-** oder **rechtsbündig**
umfließt der Text das Bild (wie im Icon symbolisiert).

**Metadaten überschreiben:**  Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Hier kannst du einen alternativen Text für das Bild eingeben *(alt-Attribut)*. Eine
barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die angezeigt wird, wenn das Objekt
selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von Suchmaschinen ausgewertet und sind daher
ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben *(title-Attribut)*.

**Bildlink-Adresse:** Bei einem Klick auf ein verlinktes Bild wirst du direkt zu der angegebenen Zielseite
weitergeleitet (entspricht einem Bildlink). Beachte, dass für ein verlinktes Bild keine Lightbox-Großansicht mehr
möglich ist.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_accordionSingle` bzw. `ce_accordionStart` 
überschreiben.

**HTML-Ausgabe**  
Das Element generiert bei einem »Einzelnes Element« folgenden HTML-Code:

```html
<section class="ce_accordionSingle ce_accordion ce_text block">
    <div class="toggler">…</div>
    <div class="accordion">
        <div>
            <p>…</p>
        </div>
    </div>
</section>
```

Ansonsten sieht der generierte HTML-Code wie folgt aus:

```html
<section class="ce_accordionStart ce_accordion block">
    <div class="toggler">…</div>
    <div class="accordion">
        <div>
            <div class="ce_text block">
                <p>…</p> 
            </div>
        </div>
    </div>
</section>
```

Beachte, dass die Inhalte jedes Akkordeon-Abschnitts von jeweils zwei (!) `<div>`-Elementen umschlossen werden. Das ist 
notwendig, damit der Effekt browserübergreifend funktioniert und formatiert werden kann.


## Slider

Mit dem Inhaltselement »Slider« wird aus verschiedenen Inhaltselementen ein Slider erstellt.

Damit der Slider funktioniert muss das *js_slider*-Template im Seitenlayout eingebunden sein.

**Betriebsart:** Hier wählst du die Betriebsart des Slider-Elements aus.

| Betriebsart                      | Erklärung                                                                                                                            |
|:---------------------------------|:-------------------------------------------------------------------------------------------------------------------------------------|
| Slider&nbsp;Umschlag&nbsp;Anfang | In diesem Modus eröffnet das Element einen neuen Slider-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können. |
| Slider&nbsp;Umschlag&nbsp;Ende   | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Slider-Abschnitt.                              |


### Slider-Einstellungen

**Slide-Intervall:** Hier kannst du den Zeitraum in Millisekunden zwischen den Slides (1000 = 1s) bestimmen. 0
deaktiviert den automatischen Wechsel.

**Übergangsgeschwindigkeit:** Hier kannst du die Übergangsgeschwindigkeit in Millisekunden (1000 = 1s) bestimmen.

**Slide-Versatz:** Hier kannst du den Slider mit einer bestimmten Folie beginnen (die Zählung beginnt bei 0).

**Kontinuierlich:** Einen kontinuierlichen Slider erstellen (beim Erreichen des Endes von vorne beginnen).


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_sliderStart` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_sliderStart block">
    <div class="content-slider slider-start" data-config="0,300,0," style="visibility: visible;">
        <div class="slider-wrapper" style="width: 0px;">    
            <div class="ce_text block">
                …
            </div>
            <div class="ce_text block">
                …
            </div>
        </div>
    </div>
    <nav class="slider-control slider-start">
        <a href="#" class="slider-prev">Zurück</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Vorwärts</a>
    </nav>
</div>
```
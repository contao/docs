---
title: "Akkordeon"
description: "Inhaltselemente im Bereich Akkordeon"
url: "artikelverwaltung/inhaltselemente/akkordeon"
aliases:
    - /de/artikelverwaltung/inhaltselemente/akkordion/
weight: 22
---


Der Akkordeon-Effekt erlaubt das Anlegen mehrerer Abschnitte, von denen jeweils nur einer geöffnet ist. Wird ein 
anderer Abschnitt ausgewählt, schließt sich der erste automatisch.

**Betriebsart:** Hier wählst du die Betriebsart des Akkordeon-Elements aus.

| Betriebsart              | Erklärung                                                                                                                                  |
|:-------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------|
| Einzelnes&nbsp;Element   | In diesem Modus legt das Element einen einzelnen Akkordeon-Abschnitt mit einem Textelement und einem optionalen Bild an.                   |
| Umschlag Anfang          | In diesem Modus eröffnet das Element einen neuen Akkordeon-Abschnitt, in den beliebige weitere Inhaltselemente eingefügt werden können.    |
| Umschlag Ende            | In diesem Modus schließt das Element einen zuvor mittels »Umschlag Anfang« eröffneten Akkordeon-Abschnitt.                                 |

**Bereichsüberschrift:** Jeder Akkordeon-Abschnitt hat eine immer sichtbare Überschrift, über die er geöffnet werden 
kann. HTML-Eingaben sind hier erlaubt.

**CSS-Format:** Falls du die Bereichsüberschrift mittels CSS-Code formatieren möchtest, kannst du hier eine 
Formatdefinition erfassen.

**Klassennamen:** Lasse das Feld leer, um die Standard-Klassennamen zu verwenden, oder gib eigene Toggler- und 
Accordion-Klassen ein.

**Text:** Hier kannst du den Text des Akkordeon-Abschnitts eingeben. Die Eingabe erfolgt wie beim Textelement über den 
Rich Text Editor.

**Ein Bild hinzufügen:** Hier kannst du dem Element ein Bild hinzufügen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_accordionSingle` bzw. `ce_accordionStart` 
überschreiben.

**HTML-Ausgabe**  
Das Element generiert bei einem »Einzelnes Element« folgenden HTML-Code:

```html
<section class="ce_accordionSingle first ce_accordion ce_text block">

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
<section class="ce_accordionStart first ce_accordion block">

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

Beachte, dass die Inhalte jedes Akkordeon-Abschnitts von jeweils zwei (!) `<div>`-Elementen 
umschlossen werden. Das ist notwendig, damit der Effekt browserübergreifend funktioniert und formatiert werden kann.
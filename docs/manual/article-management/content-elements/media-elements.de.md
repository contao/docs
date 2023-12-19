---
title: "Media-Elemente"
description: "Inhaltselemente im Bereich Media-Elemente"
url: "artikelverwaltung/inhaltselemente/media-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/media-elemente/
weight: 25
---


## Bild

Das Inhaltselement »Bild« fügt dem Artikel ein Bild hinzu. Ein Bild kann eine Großansicht haben oder als Bildlink auf 
eine bestimmte URL verweisen.

![Ein Bildelement anlegen]({{% asset "images/manual/article-management/de/ein-bildelement-anlegen.png" %}}?classes=shadow)

**Quelldatei:** Hier wählst du das zu verwendende Bild aus.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

*Bildabstand:* Hier legst du den Abstand des Bilds zum Text fest. Die Reihenfolge der Eingabefelder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße 
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

**Metadaten überschreiben:** Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Eine barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die 
angezeigt wird, wenn das Objekt selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von 
Suchmaschinen ausgewertet und sind daher ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben (title-Attribut).

**Bildlink-Adresse:** Bei einem Klick auf ein verlinktes Bild wirst du direkt zu der angegebenen Zielseite 
weitergeleitet (entspricht einem Bildlink). Beachte, dass für ein verlinktes Bild keine Lightbox-Großansicht mehr 
möglich ist.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_image` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
div class="ce_image first last block">
    <figure class="image_container">
        <a href=…" title="…" data-lightbox="…">
            <img src="…" alt="…" itemprop="image">
        </a>
        <figcaption class="caption">…</figcaption>
    </figure>
</div>
```


## Galerie

Das Inhaltselement »Bildergalerie« fügt dem Artikel eine Bildergalerie hinzu, also eine Sammlung mehrerer 
Vorschaubilder (engl. »Thumbnails«), die in einer Liste aufgelistet sind und beim Anklicken vergrößert werden. Bei 
sehr vielen Bildern kann die Galerie auf mehrere Seiten verteilt werden.

![Die Bildergalerie im Frontend]({{% asset "images/manual/article-management/de/die-bildergalerie-im-frontend.png" %}}?classes=shadow)

**Quelldateien:** Hier wählst du einen oder mehrere Ordner bzw. Dateien aus, die in der Bildergalerie enthalten sein 
sollen. Wenn du einen Ordner auswählst, übernimmt Contao automatisch alle darin enthaltenen Bilder in die Galerie. Die 
einzelnen Bilder können durch Ziehen umsortiert werden.

**Sortieren nach:** Hier wählst du die Sortierreihenfolge aus. Es stehen folgende Sortierreihenfolgen zur Verfügung:

- Individuelle Reihenfolge
- Dateiname (aufsteigend)
- Dateiname (absteigend)
- Datum (aufsteigend)
- Datum (absteigend)
- Zufällige Reihenfolge

**Dateien ohne Metadaten ignorieren:** Wenn bei den Dateien keine Metadaten zur passenden Seitensprache eingepflegt 
wurden, werden sie bei der Aktivierung nicht angezeigt.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Bildabstand:** Hier kannst du den Abstand des Bilds zum Text festlegen. Die Reihenfolge der Felder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Vorschaubilder pro Reihe:** Hier legst du die Anzahl der Vorschaubilder pro Reihe fest.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße in der 
Lightbox geöffnet (dazu ist JavaScript erforderlich).

**Elemente pro Seite:** Contao kann große Bildergalerien automatisch auf mehrere Seiten verteilen, sodass sich die 
Ladezeit der Galerie verringert. Lege hier fest, wie viele Vorschaubilder pro Seite maximal angezeigt werden sollen.

**Gesamtzahl der Bilder:** Hier kannst du die Gesamtzahl der Bilder begrenzen. Gebe 0 ein, um alle anzuzeigen.

**Galerietemplate:** Hier kannst du das Galerietemplate überschreiben.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_gallery` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_gallery first last block">

    <ul class="cols_2" itemscope itemtype="http://schema.org/ImageGallery">
        <li class="row_0 row_first row_last even col_0 col_first">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
        <li class="row_0 row_first row_last even col_1 col_last">
            <figure class="image_container">
                <a href="…" data-lightbox="…">
                    <img src="…" alt="…" itemprop="image">
                </a>
            </figure>
        </li>
    </ul>

    <!-- indexer::stop -->
    <nav class="pagination block" aria-label="Seitenumbruch-Menü">
        <p>Seite 1 von 2</p>
        <ul>
            <li><strong class="active">1</strong></li>
            <li><a href="…" class="link" title="Gehe zu Seite 2">2</a></li>
            <li class="next"><a href="…" class="next" title="Gehe zu Seite 2">Vorwärts</a></li>
        </ul>
    </nav>
    <!-- indexer::continue -->

</div>
```


## Video/Audio

Das Inhaltselement »Video/Audio« fügt dem Artikel eine Video- bzw. Audio-Datei hinzu. 

**Video-/Audio-Dateien:** Hier kannst du die Video-/Audio-Datei bzw. – wenn du verschiedene Codecs verwendest – die 
Video-/Audio-Dateien hinzufügen.

{{< version "4.6" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- Steuerelemente verbergen
- In einer Schleife abspielen
- Inline abspielen (kein Vollbildmodus)
- Die Audioausgabe stummschalten

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Stopp bei:** Die Wiedergabe wird bei der festgelegten Anzahl an Sekunden beendet. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Preloading:** Hier kannst du dem Browser empfehlen, wie der Browser das Video vorab laden soll. Es stehen folgende 
drei Möglichkeiten zur Verfügung »Auto (das ganze Video vorab laden)«, »Metadata (nur die Metadaten vorab laden)« und 
»None (nichts vorab laden)«

**Vorschaubild:** Das Bild statt des ersten Frame des Videos vor dem Abspielen anzeigen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_player` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_player first last block">

    <figure class="video_container">
        <video width="…" height="…" autoplay loop playsinline muted>
            <source type="video/mp4" src="…" title="…">
        </video>
        <figcaption class="caption">……</figcaption>
    </figure>

</div>
```


## YouTube

Das Inhaltselement »YouTube« fügt dem Artikel ein YouTube-Video hinzu. 

**YouTube-ID:** Bitte gebe die YouTube-Video-ID für dein Video ein (z. B. rOGhp63Lvbo).

{{< version "4.5" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- Steuerelemente verbergen
- Untertitel standardmäßig anzeigen
- Den Fullscreen-Button ausblenden
- Die Contao-Seitensprache verwenden
- Anmerkungen verstecken
- Das YouTube-Logo ausblenden
- Ähnliche Videos auf denselben Kanal beschränken
- Die Linkleiste in der Vorschau ausblenden
- Die youtube-nocookie.com-Domain verwenden

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Stopp bei:** Die Wiedergabe wird bei der festgelegten Anzahl an Sekunden beendet. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Seitenverhältnis:** Hier kannst du das 
[Seitenverhältnis des Videos](https://de.wikipedia.org/wiki/Seitenverh%C3%A4ltnis#Fernsehen_und_Video) bestimmen, um es responsive zu 
machen.

{{< version "4.8" >}}

**Verwenden Sie ein Startbild:** Das Video wird erst geladen, nachdem der Benutzer auf das Startbild geklickt hat.

**Quelldatei:** Hier wählst du ein Bild aus der Dateiübersicht.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_youtube` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="ce_youtube first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://www.youtube-nocookie.com/embed/rOGhp63Lvbo?autoplay=1&amp;controls=0&amp;cc_load_policy=1&amp;fs=0&amp;hl=de&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;start=10">
                <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```


## Vimeo

Das Inhaltselement »Vimeo« fügt dem Artikel ein Vimeo-Video hinzu. 

**Vimeo-ID:** Bitte gebe die Vimeo-Video-ID ein (z. B. 275028611).

{{< version "4.5" >}}

**Player-Größe:** Hier kannst du die Breite und Höhe des Mediaplayers in Pixeln (z. B. 640x480) bestimmen.

**Player-Optionen:** Hier kannst du die verschiedenen Player-Optionen auswählen.

- Autoplay
- In einer Schleife abspielen
- Das Profilbild ausblenden
- Den Titel ausblenden
- Den Autor ausblenden

**Start bei:** Die Wiedergabe beginnt bei der festgelegten Anzahl an Sekunden. Gebe 0 ein, um das Feature zu 
deaktivieren.

**Farben der Steuererlemente:** Hier kannst du einen hexadezimalen Farbcode (z. B. ff0000) für die Steuerelemente 
eingeben.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.

**Seitenverhältnis:** Hier kannst du das 
[Seitenverhältnis des Videos](https://de.wikipedia.org/wiki/Seitenverh%C3%A4ltnis#Fernsehen_und_Video) bestimmen, um es responsive zu 
machen.

{{< version "4.8" >}}

**Verwenden Sie ein Startbild:** Das Video wird erst geladen, nachdem der Benutzer auf das Startbild geklickt hat.

**Quelldatei:** Hier wählst du ein Bild aus der Dateiübersicht.

**Bildgröße:** Hier kannst du die Abmessungen des Bildes vorgeben. Weitere Informationen dazu findest du im 
Abschnitt [Text](#text).

**Individuelles Template:** Hier kannst du das Standard-Template `ce_vimeo` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="ce_vimeo first last block">

    <figure class="video_container">
        <div class="responsive ratio-169">
            <a id="splashImage" href="https://player.vimeo.com/video/275028611?autoplay=1&amp;loop=1&amp;portrait=0&amp;title=0&amp;byline=0&amp;color=ff0000#t=10s">
            <img src="…" alt="…" itemprop="image">
            </a>
            <script>
                document.getElementById('splashImage').addEventListener('click', function(e) {
                    e.preventDefault();
                    var iframe = document.createElement('iframe');
                    iframe.src = this.href;
                    iframe.width = '…';
                    iframe.height = '…';
                    iframe.setAttribute('allowfullscreen', '');
                    this.parentNode.replaceChild(iframe, this);
                });
            </script>
        </div>
        <figcaption class="caption">…</figcaption>
    </figure>

</div>
<!-- indexer::continue -->
```
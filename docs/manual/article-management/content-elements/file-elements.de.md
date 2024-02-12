---
title: "Datei-Elemente"
description: "Inhaltselemente im Bereich Datei-Elemente"
url: "artikelverwaltung/inhaltselemente/datei-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/datei-elemente/
weight: 25
---


## Download

Das Inhaltselement »Download« fügt dem Artikel einen Download-Link hinzu. Beim Anklicken des Links öffnet sich der 
»Datei speichern unter …«-Dialog und du kannst die verlinkte Datei auf deinem lokalen Rechner speichern.

Die Besonderheit in Contao ist, dass dieser Download-Link auch mit geschützten Dateien funktioniert, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst im Abschnitt [Dateiverwaltung](../../../dateiverwaltung/).


### Quelle

**Quelldatei:** Hier kannst du die Download-Datei auswählen.


### Download-Einstellungen

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Link überschreiben:** Einen benutzerdefinierten Link-Text und Link-Titel festlegen.

**Link-Text:** Der Link-Text wird anstelle des Dateinamens angezeigt.

**Link-Titel:** Der Link-Titel wird als `title`-Attribut im HTML-Markup eingefügt.


### Vorschau-Einstellungen

{{% notice info %}}
Die PHP-Erweiterung Imagick oder Gmagick muss auf dem Server installiert sein, um in den Genuss dieser Funktion zu 
kommen.
{{% /notice %}}

**Vorschaubilder anzeigen:** Hier kannst du Vorschaubilder der gewählten Dateien anzeigen.

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet.

**Anzahl an Elementen:** Wenn du z. B. ein 10 seitiges PDF einbindest kannst du bestimmen wie viele Vorschaubilder 
generiert werden. Bei 0 werden alle Vorschaubilder generiert in unserem Fall also 10. Wenn du nur die erste Seite deines 
PDFs als Vorschaubild ausgeben möchtest, trägst du eine 1 im Feld ein.

{{% notice info %}}
Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte
Download-Dateitypen« festgelegt hast.
{{% /notice %}}


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_download` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_download block">
    <figure class="image_container">
        <a href="…" data-lightbox="lb3">
            <img src="…" width="…" height="…" alt="">
        </a>
    </figure>
    <p class="download-element ext-pdf">
        <a href="…" title="Die Datei … herunterladen" type="application/pdf">… <span class="size">(…)</span></a>
    </p>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_element/download` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="download-element ext-pdf content-download">
    <a href="…" title="Die Datei … herunterladen" type="application/pdf">…</a>
    <figure>
        <a href="…" data-lightbox="…" class="cboxElement">                                                                                   
            <img src="…" alt="" srcset="…" sizes="…" width="…" height="…" loading="lazy" class="…">
        </a>
    </figure>
</div>
```
{{% /tab %}}
{{</tabs>}}


## Downloads

Das Inhaltselement »Downloads« fügt dem Artikel mehrere Download-Links hinzu. Beim Anklicken eines Links öffnet sich 
der »Datei speichern unter …«-Dialog, und du kannst die Datei auf deinem lokalen Rechner speichern.

![Das Downloads-Element im Frontend]({{% asset "images/manual/article-management/de/das-downloads-element-im-frontend.png" %}}?classes=shadow)

Die Besonderheit in Contao ist, dass diese Download-Links auch mit geschützten Dateien funktionieren, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst du im Abschnitt [Dateiverwaltung](/de/dateiverwaltung/).


### Quelle

**Quelldateien:** Hier wählst du einen oder mehrere Ordner bzw. Dateien aus, die in dem Donwloads-Element enthalten 
sein sollen. Wenn du einen Ordner auswählst, übernimmt Contao automatisch alle darin enthaltenen herunterladbaren 
Dateien.

**Home-Verzeichnis verwenden:** Das Home-Verzeichnis als Dateiquelle verwenden, wenn sich ein Mitglied angemeldet hat.


###  Download-Einstellungen

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Sortieren nach:** Hier wählst du die Sortierreihenfolge aus. Es stehen folgende Sortierreihenfolgen zur Verfügung:

- Individuelle Reihenfolge
- Dateiname (aufsteigend)
- Dateiname (absteigend)
- Datum (aufsteigend)
- Datum (absteigend)
- Zufällige Reihenfolge

**Dateien ohne Metadaten ignorieren:** Wenn bei den Dateien keine Metadaten zur passenden Seitensprache eingepflegt 
wurden, werden sie bei der Aktivierung nicht angezeigt.


### Vorschau-Einstellungen

{{% notice info %}}
Die PHP-Erweiterung Imagick oder Gmagick muss auf dem Server installiert sein, um in den Genuss dieser Funktion zu 
kommen.
{{% /notice %}}

**Vorschaubilder anzeigen:** Hier kannst du Vorschaubilder der gewählten Dateien anzeigen.

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet.

**Anzahl an Elementen:** Wenn du z. B. ein 10 seitiges PDF einbindest kannst du bestimmen wie viele Vorschaubilder
generiert werden. Bei 0 werden alle Vorschaubilder generiert in unserem Fall also 10. Wenn du nur die erste Seite deines
PDFs als Vorschaubild ausgeben möchtest, trägst du eine 1 im Feld ein.

{{% notice info %}}
Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte
Download-Dateitypen« festgelegt hast.
{{% /notice %}}


### Template-Einstellungen

{{< tabs groupId="contao-version" >}}
{{% tab name="Contao 4" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_downloads` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_downloads block">
    <ul>
        <li class="download-element ext-jpg">
            <figure class="image_container">
                <a href="…" data-lightbox="lb3">
                    <img src="…" width="…" height="…" alt="">
                </a>
            </figure>
            <a href="…" title="Die Datei … herunterladen" type="application/jpeg">… <span class="size">(…)</span></a>
        </li>
    </ul>
</div>
```
{{% /tab %}}
{{% tab name="Contao 5" %}}
**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `content_elements/downloads` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="content-downloads">
    <ul>
        <li class="download-element ext-jpg">
            <a href="…" title="Die Datei … herunterladen" type="image/jpeg">…</a>
            <figure>
                <a href="…" data-lightbox="…" class="cboxElement">
                    <img src="…" alt="" srcset="…" sizes="…" width="…" height="…" loading="lazy" class="…">
                </a>
            </figure>
        </li>
    </ul>
</div>
```
{{% /tab %}}
{{</tabs>}}

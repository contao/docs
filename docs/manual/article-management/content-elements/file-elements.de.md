---
title: "Datei-Elemente"
description: "Inhaltselemente im Bereich Datei-Elemente"
url: "artikelverwaltung/inhaltselemente/datei-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/datei-elemente/
weight: 26
---


## Download

Das Inhaltselement »Download« fügt dem Artikel einen Download-Link hinzu. Beim Anklicken des Links öffnet sich der 
»Datei speichern unter …«-Dialog und du kannst die verlinkte Datei auf deinem lokalen Rechner speichern.

Die Besonderheit in Contao ist, dass dieser Download-Link auch mit geschützten Dateien funktioniert, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst im Abschnitt [Dateiverwaltung](../../../dateiverwaltung/).


### Quelle

**Quelldatei:** Hier kannst du die Download-Datei auswählen.


{{< version "4.8" >}}

### Download-Einstellungen

**Im Browser anzeigen:** Zeige die Datei im Browser an, anstatt den Download-Dialog zu öffnen.

**Metadaten überschreiben:** Die Metadaten aus der Dateiverwaltung überschreiben.

**Link-Text:** Der Link-Text wird anstelle des Dateinamens angezeigt.

**Link-Titel:** Der Link-Titel wird als `title`-Attribut im HTML-Markup eingefügt.


### Vorschau-Einstellungen

{{< version "4.13" >}}

{{% notice info %}}
Die PHP-Erweiterung Imagick oder Gmagick muss auf dem Server installiert sein, um in den Genuss dieser Funktion zu 
kommen.
{{% /notice %}}

**Vorschaubilder anzeigen:** Hier kannst du Vorschaubilder der gewählten Dateien anzeigen.

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Relatives Format               |                                                                                                                    |
|:-------------------------------|:-------------------------------------------------------------------------------------------------------------------|
| Proportional                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |
| An&nbsp;Rahmen&nbsp;anpassen   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |

&nbsp;

| Exaktes Format    |                                                                                                    |
|:------------------|:---------------------------------------------------------------------------------------------------|
| Wichtiger Teil    | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben.                         |
| Links / Oben      | Erhält den linken Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.        |
| Mitte / Oben      | Erhält den mittleren Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.     |
| Rechts / Oben     | Erhält den rechten Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.       |
| Links / Mitte     | Erhält den linken Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.     |
| Mitte / Mitte     | Erhält den mittleren Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.  |
| Rechts / Mitte    | Erhält den rechten Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.    |
| Links / Unten     | Erhält den linken Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.       |
| Mitte / Unten     | Erhält den mittleren Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.    |
| Rechts / Unten    | Erhält den rechten Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.      |

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet.

**Anzahl an Elementen:** Wenn du z. B. ein 10 seitiges PDF einbindest kannst du bestimmen wie viele Vorschaubilder 
generiert werden. Bei 0 werden alle Vorschaubilder generiert in unserem Fall also 10. Wenn du nur die erste Seite deines 
PDFs als Vorschaubild ausgeben möchtest, trägst du eine 1 im Feld ein.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template `ce_download` überschreiben.

Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte 
Download-Dateitypen« festgelegt hast.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_download block">
    <figure class="image_container">
        <a href="assets/previews/…/file-page1.png" data-lightbox="lb3">
            <img src="assets/images/…/file-page1.png" width="177" height="250" alt="">
        </a>
    </figure>
    <figure class="image_container">
        <a href="assets/previews/…/file-page2.png" data-lightbox="lb3">
            <img src="assets/images/…/file-page2.png" width="177" height="250" alt="">
        </a>
    </figure>
    <p class="download-element ext-pdf">
        <a href="download.html?file=files/download/file.pdf&amp;cid=3" title="Die Datei … herunterladen" type="application/pdf">… <span class="size">(…)</span></a>
    </p>
</div>
```


## Downloads

Das Inhaltselement »Downloads« fügt dem Artikel mehrere Download-Links hinzu. Beim Anklicken eines Links öffnet sich 
der »Datei speichern unter …«-Dialog, und du kannst die Datei auf deinem lokalen Rechner speichern.

![Das Downloads-Element im Frontend](/de/article-management/images/de/das-downloads-element-im-frontend.png?classes=shadow)

Die Besonderheit in Contao ist, dass diese Download-Links auch mit geschützten Dateien funktionieren, auf die du nicht 
direkt über deinen Browser zugreifen kannst. Auf diese Weise kannst du sehr einfach einen geschützten Download-Bereich 
erstellen. Weitere Informationen dazu erhältst du im Abschnitt [Dateiverwaltung](../../../dateiverwaltung/).


### Quelle

**Quelldateien:** Hier wählst du einen oder mehrere Ordner bzw. Dateien aus, die in dem Donwloads-Element enthalten 
sein sollen. Wenn du einen Ordner auswählst, übernimmt Contao automatisch alle darin enthaltenen herunterladbaren 
Dateien.


{{< version "4.8" >}}

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

{{< version "4.13" >}}

{{% notice info %}}
Die PHP-Erweiterung Imagick oder Gmagick muss auf dem Server installiert sein, um in den Genuss dieser Funktion zu 
kommen.
{{% /notice %}}

**Vorschaubilder anzeigen:** Hier kannst du Vorschaubilder der gewählten Dateien anzeigen.

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Relatives Format               |                                                                                                                    |
|:-------------------------------|:-------------------------------------------------------------------------------------------------------------------|
| Proportional                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |
| An&nbsp;Rahmen&nbsp;anpassen   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |

&nbsp;

| Exaktes Format    |                                                                                                    |
|:------------------|:---------------------------------------------------------------------------------------------------|
| Wichtiger Teil    | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben.                         |
| Links / Oben      | Erhält den linken Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.        |
| Mitte / Oben      | Erhält den mittleren Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.     |
| Rechts / Oben     | Erhält den rechten Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.       |
| Links / Mitte     | Erhält den linken Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.     |
| Mitte / Mitte     | Erhält den mittleren Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.  |
| Rechts / Mitte    | Erhält den rechten Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.    |
| Links / Unten     | Erhält den linken Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.       |
| Mitte / Unten     | Erhält den mittleren Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.    |
| Rechts / Unten    | Erhält den rechten Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.      |

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet.

**Anzahl an Elementen:** Wenn du z. B. ein 10 seitiges PDF einbindest kannst du bestimmen wie viele Vorschaubilder
generiert werden. Bei 0 werden alle Vorschaubilder generiert in unserem Fall also 10. Wenn du nur die erste Seite deines
PDFs als Vorschaubild ausgeben möchtest, trägst du eine 1 im Feld ein.



### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template `ce_downloads` überschreiben.

Beachte, dass nur die Dateitypen heruntergeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte 
Download-Dateitypen« festgelegt hast.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_downloads block">
    <ul>
        <li class="download-element ext-docx">
            <figure class="image_container">
                <a href="assets/previews/…/file1.svg" data-lightbox="lb3">
                    <img src="assets/images/…file1.svg" width="250" height="250" alt="">
                </a>
            </figure>
            <a href="downloads.html?file=files/download/file1.docx&amp;cid=3" title="Die Datei … herunterladen" type="application/msword">… <span class="size">(…)</span></a>
        </li>
        <li class="download-element ext-pdf">
            <figure class="image_container">
                <a href="assets/previews/…/file2-page1.png" data-lightbox="lb3">
                    <img src="assets/images/…/file2-page1.png" width="177" height="250" alt="">
                </a>
            </figure>
            <figure class="image_container">
                <a href="assets/previews/…/file2-page2.png" data-lightbox="lb3">
                    <img src="assets/images/…/file2-page2.png" width="177" height="250" alt="">
                </a>
            </figure>
            <a href="downloads.html?file=files/download/file2.pdf&amp;cid=3" title="Die Datei … herunterladen" type="application/pdf">… <span class="size">(…)</span></a>
        </li>
    </ul>
</div>
```

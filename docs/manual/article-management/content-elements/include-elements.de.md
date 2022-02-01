---
title: "Include-Elemente"
description: "Inhaltselemente im Bereich Include-Elemente"
url: "artikelverwaltung/inhaltselemente/include-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/include-elemente/
weight: 27
---


## Artikel

Das Inhaltselement »Artikel« ermöglicht die mehrfache Einbindung eines Artikels, ohne dass dieser dafür kopiert werden 
muss. Beachte, dass nur die Inhaltselemente und nicht der Artikel-Header übernommen werden.

**Bezogener Artikel:** Hier wählst du den Originalartikel aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Inhaltselement

Das Inhaltselement »Inhaltselement« dient dazu, ein vorhandenes Inhaltselement ein zweites Mal einzufügen, ohne es 
dafür kopieren zu müssen. Der Vorteil dieser Methode ist, dass du eventuelle Änderungen nur in dem originalen 
Inhaltselement erfassen musst und diese automatisch in allen Aliaselementen übernommen werden.

**Bezogenes Inhaltselement:** Hier wählst du das Originalelement aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Formular

Das Inhaltselement »Formular« fügt dem Artikel ein Formular hinzu. Informationen zur Erstellung und Verwaltung von 
Formularen findest du im Abschnitt [Formulargenerator](../../../formulargenerator/).

**Formular:** Wähle hier das Formular aus, das du einfügen möchtest.


## Modul

Das Inhaltselement »Modul« fügt dem Artikel ein Frontend-Modul hinzu. Wie du Module erstellst und konfigurierst, weißt 
du ja bereits aus dem Abschnitt [Modulverwaltung](../../../modulverwaltung/).

**Modul:** Hier wählst du das Modul aus, das du einfügen möchtest.

Die HTML-Ausgabe richtet sich nach dem jeweiligen Modultyp.


## Artikelteaser

Das Inhaltselement »Artikelteaser« fügt dem Artikel den Teasertext eines anderen Artikels, gefolgt von einem 
Weiterlesen-Link, hinzu. Beim Anklicken dieses Links wirst du direkt zu dem verlinkten Artikel weitergeleitet.

**Artikel:** Hier wählst du den Originalartikel aus.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_teaser` überschreiben.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_teaser first last ce_text block">
    <h1>…</h1>
    <p class="more"><a href="…" title="…">Weiterlesen …<span class="invisible"> …</span></a></p>
</div>
```


## Kommentare

Das Inhaltselement »Kommentare« bietet Besuchern die Möglichkeit, Kommentare auf deiner Webseite zu hinterlassen. Du 
kannst auch ein Gästebuch damit betreiben.

**Sortierreihenfolge:** Hier legst du die Reihenfolge der Kommentare fest. Gästebücher zeigen normalerweise den 
neuesten Eintrag zuerst (absteigende Sortierung), Kommentare hingegen den ältesten (aufsteigende Sortierung).

**Elemente pro Seite:** Hier kannst die Anzahl der Kommentare pro Seite festlegen. Contao erzeugt bei Bedarf 
automatisch einen Seitenumbruch. Gebe 0 ein, um den automatischen Seitenumbruch zu deaktivieren.

**Moderieren:** Wenn du diese Option wählst, erscheinen Kommentare nicht sofort auf der Webseite, sondern erst, nachdem 
du sie im Backend freigegeben hast.

**BBCode erlauben:** Wenn du diese Option wählst, können deine Besucher [BBCode](https://de.wikipedia.org/wiki/BBCode) 
zur Formatierung ihrer Kommentare verwenden. Folgende Tags werden unterstützt:

| Tag                                  | Erklärung                                   |
|:-------------------------------------|:--------------------------------------------|
| `[b][/b]`                            | Fettschrift                                 |
| `[i][/i]`                            | Kursivschrift                               |
| `[u][/u]`                            | Unterstrichen                               |
| `[img][/img]`                        | Bild einfügen                               |
| `[code][/code]`                      | Programmcode einfügen                       |
| `[color=#f00][/color]`               | Farbiger Text                               |
| `[quote][/quote]`                    | Zitat einfügen                              |
| `[quote=Tim][/quote]`                | Zitat mit Nennung des Urhebers einfügen     |
| `[url][/url]`                        | Link einfügen                               |
| `[url=http://example.com][/url]`     | Link mit Linktitel einfügen                 |
| `[email][email]`                     | E-Mail-Adresse einfügen                     |
| `[email=info@example.com][/email]`   | E-Mail-Adresse mit Titel einfügen           |

**Login zum Kommentieren benötigt:** Wenn du diese Option auswählst, können nur angemeldete Mitglieder Kommentare 
hinzufügen. Die bereits abgegebenen Kommentare sind aber weiterhin für alle Besucher der Webseite sichtbar.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Im Normalfall
wird diese Frage nur den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.

**Kommentartemplate:** Hier kannst du das Template für die einzelnen Beiträge auswählen.

**Individuelles Template:** Hier kannst du das Standard-Template `ce_comments` überschreiben.

**Kommentarverwaltung**

Die Verwaltung der Kommentare, die deine Besucher abgeben, erfolgt zentral im Backend mit dem Modul »Kommentare«, das 
du in der Navigation in der Gruppe Inhalte findest. Dort werden sämtliche Kommentare angezeigt, egal ob sie sich auf 
ein Inhaltselement, einen Artikel oder einen Blog-Beitrag beziehen. Bei Bedarf kannst du die Liste der Kommentare nach 
ihrem Ursprung oder ihrem Elternelement filtern.

![Kommentare nach ihrem Ursprung filtern](/de/article-management/images/de/kommentare-nach-ihrem-ursprung-filtern.png?classes=shadow)

Falls du die Option »Kommentare moderieren« aktiviert hast, kannst du neue Kommentare in der Kommentarverwaltung 
prüfen, bevor sie auf der Webseite erscheinen. So verhinderst du z. B. eventuelle Spamversuche.

**HTML-Ausgabe**  
Das Element generiert folgenden HTML-Code:

```html
<div class="ce_comments first last block">
    
    <div class="comment_default first even" id="c1">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>

    <div class="comment_default last odd" id="c2">
        <p class="info">Kommentar von … | <time datetime="…" class="date">…</time></p>
        <div class="comment">
            <p>…</p>
        </div>
    </div>
    
    <!-- indexer::stop -->
        <div class="form">
            <form action="…" id="com_tl_content" method="post">
                <div class="formbody">                  
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_name" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Name<span class="mandatory">*</span>
                        </label>
                        <input type="text" name="name" id="ctrl_name" class="text mandatory" value="" required maxlength="64">
                    </div>
                    <div class="widget widget-text mandatory">
                        <label for="ctrl_email" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>E-Mail (wird nicht veröffentlicht)<span class="mandatory">*</span>
                        </label>
                        <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                    </div>
                    <div class="widget widget-text">
                        <label for="ctrl_website">Webseite</label>
                        <input type="url" name="website" id="ctrl_website" class="text" value="" maxlength="128">
                    </div>
                    <div class="widget widget-textarea mandatory">
                        <label for="ctrl_comment" class="mandatory">
                            <span class="invisible">Pflichtfeld </span>Kommentar<span class="mandatory">*</span>
                        </label>
                        <textarea name="comment" id="ctrl_comment" class="textarea mandatory" rows="4" cols="40" required></textarea>
                    </div>
                    <div class="widget widget-checkbox">
                        <fieldset id="ctrl_notify" class="checkbox_container">
                            <input type="hidden" name="notify" value="">
                            <span>
                                <input type="checkbox" name="notify" id="opt_notify_0" class="checkbox" value="1"> 
                                <label id="lbl_notify_0" for="opt_notify_0">…</label>
                            </span>
                        </fieldset>
                    </div>
                    <div class="widget widget-submit">
                        <button type="submit" class="submit">Kommentar absenden</button>
                    </div>
                </div>
            </form>
        </div>
    <!-- indexer::continue -->

</div>
```


## Individuelles Template

{{< version "4.13" >}}

Das Inhaltselement »Individuelles Template« bietet die Möglichkeit, ein Template auszuwählen und dabei individuelle 
Platzhalter zu definieren, die im jeweiligen Template ausgegeben werden können.

**Template data:** Angabe eines oder mehrerer Schlüssel/Wert Paare.

**Inhaltselement-Template:** Hier kannst du das Standard-Template `ce_template` überschreiben.

**HTML-Ausgabe**  
Das Standard-Template generiert folgenden HTML-Code:

```html
<dl>
  <dt>Schlüssel</dt>
  <dd>Wert</dd>
</dl>
```

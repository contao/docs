---
title: "Include-Elemente"
description: "Inhaltselemente im Bereich Include-Elemente"
url: "artikelverwaltung/inhaltselemente/include-elemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/include-elemente/
weight: 29
---


## Artikel

Das Inhaltselement »Artikel« ermöglicht die mehrfache Einbindung eines Artikels, ohne dass dieser dafür kopiert werden 
muss. Beachte, dass nur die Inhaltselemente und nicht der Artikel-Header übernommen werden.


### Include-Einstellungen

**Bezogener Artikel:** Hier wählst du den Originalartikel aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Inhaltselement

Das Inhaltselement »Inhaltselement« dient dazu, ein vorhandenes Inhaltselement ein zweites Mal einzufügen, ohne es 
dafür kopieren zu müssen. Der Vorteil dieser Methode ist, dass du eventuelle Änderungen nur in dem originalen 
Inhaltselement erfassen musst und diese automatisch in allen Aliaselementen übernommen werden.


### Include-Einstellungen

**Bezogenes Inhaltselement:** Hier wählst du das Originalelement aus.

Aliaselemente verwenden dasselbe HTML-Markup wie das Originalelement.


## Formular

Das Inhaltselement »Formular« fügt dem Artikel ein Formular hinzu. Informationen zur Erstellung und Verwaltung von 
Formularen findest du im Abschnitt [Formulargenerator](/de/formulargenerator/).


### Include-Einstellungen

**Formular:** Wähle hier das Formular aus, das du einfügen möchtest.


## Modul

Das Inhaltselement »Modul« fügt dem Artikel ein Frontend-Modul hinzu. Wie du Module erstellst und konfigurierst, weißt 
du ja bereits aus dem Abschnitt [Modulverwaltung](/de/layout/modulverwaltung/).


### Include-Einstellungen

**Modul:** Hier wählst du das Modul aus, das du einfügen möchtest.

Die HTML-Ausgabe richtet sich nach dem jeweiligen Modultyp.


## Kommentare

Das Inhaltselement "Kommentare" bietet Besuchern die Möglichkeit, Kommentare auf deiner Website zu hinterlassen. Du 
kannst damit auch ein Gästebuch betreiben.


### Kommentareinstellungen

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

| Tag                                   | Erklärung                                    |
|:--------------------------------------|:---------------------------------------------|
| `[b][/b]`                             | Fettschrift                                  |
| `[i][/i]`                             | Kursivschrift                                |
| `[u][/u]`                             | Unterstrichen                                |
| `[img][/img]`                         | Bild einfügen                               |
| `[code][/code]`                       | Programmcode einfügen                       |
| `[color=#f00][/color]`                | Farbiger Text                                |
| `[quote][/quote]`                     | Zitat einfügen                              |
| `[quote=Tim][/quote]`                 | Zitat mit Nennung des Urhebers einfügen     |
| `[url][/url]`                         | Link einfügen                               |
| `[url=http://example.com][/url]`      | Link mit Linktitel einfügen                 |
| `[email][email]`                      | E-Mail-Adresse einfügen                     |
| `[email=info@example.com][/email]`    | E-Mail-Adresse mit Titel einfügen           |

**Login zum Kommentieren benötigt:** Wenn du diese Option auswählst, können nur angemeldete Mitglieder Kommentare 
hinzufügen. Die bereits abgegebenen Kommentare sind aber weiterhin für alle Besucher der Webseite sichtbar.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.


### Template-Einstellungen

**Kommentartemplate:** Hier kannst du das Template für die einzelnen Beiträge auswählen.

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_comments` überschreiben.


### Kommentarverwaltung

Die Verwaltung der Kommentare, die deine Besucher abgeben, erfolgt zentral im Backend mit dem Modul »Kommentare«, das 
du in der Navigation in der Gruppe Inhalte findest. Dort werden sämtliche Kommentare angezeigt, egal ob sie sich auf 
ein Inhaltselement, einen Artikel oder einen Blog-Beitrag beziehen. Bei Bedarf kannst du die Liste der Kommentare nach 
ihrem Ursprung oder ihrem Elternelement filtern.

![Kommentare nach ihrem Ursprung filtern]({{% asset "images/manual/article-management/de/kommentare-nach-ihrem-ursprung-filtern.png" %}}?classes=shadow)

Falls du die Option »Kommentare moderieren« aktiviert hast, kannst du neue Kommentare in der Kommentarverwaltung prüfen, 
bevor sie auf der Webseite erscheinen. So verhinderst du z. B. eventuelle Spamversuche.


## Individuelles Template

Das Inhaltselement »Individuelles Template« bietet die Möglichkeit, ein Template auszuwählen und dabei individuelle 
Platzhalter zu definieren, die im jeweiligen Template ausgegeben werden können.


### Template-Einstellungen

**Template-Daten:** Angabe eines oder mehrerer Schlüssel/Wert Paare.

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_template` bzw. `content_element/template` 
überschreiben.

**HTML-Ausgabe**  
Das Standard-Template generiert folgenden HTML-Code:

```html
<dl>
  <dt>Schlüssel</dt>
  <dd>Wert</dd>
</dl>
```

Die im Inhaltselement gesetzten »Template-Daten« sind im Array `keys` verfügbar: 

![Template Variablen]({{% asset "images/manual/article-management/de/template-data.png" %}}?classes=shadow&width=400)

{{< tabs groupId="template-data-example" >}}
{{% tab name="PHP" %}}
```
Ein Beispiel für <?= $this->keys['cms'] ?> mit PHP-Templates 
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
Ein Beispiel für {{ keys.cms }} mit Twig-Templates
```
{{% /tab %}}
{{</tabs>}}


## Artikelteaser

Das Inhaltselement »Artikelteaser« fügt dem Artikel den Teasertext eines anderen Artikels, gefolgt von einem
Weiterlesen-Link, hinzu. Beim Anklicken dieses Links wirst du direkt zu dem verlinkten Artikel weitergeleitet.


### Include-Einstellungen

**Artikel:** Hier wählst du den Originalartikel aus.


### Template-Einstellungen

**Inhaltselement-Template:** Hier kannst du das Inhaltselement-Template `ce_teaser` bzw. `content_element/teaser` 
überschreiben.
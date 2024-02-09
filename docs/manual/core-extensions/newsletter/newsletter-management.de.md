---
title: "Newsletter-Verwaltung"
description: "Die Newsletter-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest."
url: "core-erweiterung/newsletter/newsletter-verwaltung"
aliases:
    - /de/core-erweiterung/newsletter/newsletter-verwaltung/
weight: 10
---

Die Newsletter-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest. 
Du kannst dort mehrere Verteiler anlegen, die wiederum die einzelnen Newsletter und Empfänger enthalten. Durch die 
Verwendung mehrerer Verteiler können die einzelnen Newsletter nach Thema oder Sprache sortiert werden.


## Verteiler

Um einen neuen Verteiler anzulegen klicke auf 
![Einen neuen Verteiler erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Verteiler erstellen") **Neu**.


### Titel und Weiterleitung

**Titel:** Der Titel eines Verteilers wird nur in der Backend-Übersicht verwendet.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher beim Anklicken eines Links im Frontend-Modul 
»Newsletterliste« weitergeleitet wird. Diese Zielseite sollte das Modul »Newsletterleser« enthalten.


### Template-Einstellungen

**E-Mail-Template:** Hier kannst du das E-Mail-Template überschreiben.

{{< version-tag "5.3" >}} Zusätzlich zum `mail_default` steht auch `mail_responsive` zur Verfügung.

Das Template für `mail_default`:

```html
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?= $this->charset ?>">
  <meta name="Generator" content="Contao Open Source CMS">
  <title><?= $this->title ?></title>
  <?= $this->css ?>
</head>
<body>
  <?= $this->body ?>
</body>
</html>
```

Das Template für `mail_responsive`:

```html
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $this->title ?></title>
  ```
{{% faq "CSS des Newsletters" %}}
```css
    <style media="all" type="text/css">
/* -------------------------------------
    GLOBAL RESETS
------------------------------------- */
    body {
      font-family: Helvetica, sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 16px;
      line-height: 1.3;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

    table {
      border-collapse: separate;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      width: 100%;
    }

    table td {
      font-family: Helvetica, sans-serif;
      font-size: 16px;
      vertical-align: top;
    }
/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
    body {
      background-color: #f4f5f6;
      margin: 0;
      padding: 0;
    }

    .body {
      background-color: #f4f5f6;
      width: 100%;
    }

    .container {
      margin: 0 auto !important;
      max-width: 600px;
      padding: 0;
      padding-top: 24px;
      width: 600px;
    }

    .content {
      box-sizing: border-box;
      display: block;
      margin: 0 auto;
      max-width: 600px;
      padding: 0;
    }  
/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
    .main {
      background: #ffffff;
      border: 1px solid #eaebed;
      border-radius: 16px;
      width: 100%;
    }

    .wrapper {
      box-sizing: border-box;
      padding: 24px;
    }

    .footer {
      clear: both;
      padding-top: 24px;
      text-align: center;
      width: 100%;
    }

    .footer td,
    .footer p,
    .footer span,
    .footer a {
      color: #9a9ea6;
      font-size: 16px;
      text-align: center;
    }
/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
    p {
      font-family: Helvetica, sans-serif;
      font-size: 16px;
      font-weight: normal;
      margin: 0;
      margin-bottom: 16px;
    }

    a {
      color: #0867ec;
      text-decoration: underline;
    }
/* -------------------------------------
    BUTTONS
------------------------------------- */
    .btn {
      box-sizing: border-box;
      min-width: 100% !important;
      width: 100%;
    }

    .btn > tbody > tr > td {
      padding-bottom: 16px;
    }

    .btn table {
      width: auto;
    }

    .btn table td {
      background-color: #ffffff;
      border-radius: 4px;
      text-align: center;
    }

    .btn a {
      background-color: #ffffff;
      border: solid 2px #0867ec;
      border-radius: 4px;
      box-sizing: border-box;
      color: #0867ec;
      cursor: pointer;
      display: inline-block;
      font-size: 16px;
      font-weight: bold;
      margin: 0;
      padding: 12px 24px;
      text-decoration: none;
      text-transform: capitalize;
    }

    .btn-primary table td {
      background-color: #0867ec;
    }

    .btn-primary a {
      background-color: #0867ec;
      border-color: #0867ec;
      color: #ffffff;
    }

    @media all {
      .btn-primary table td:hover {
        background-color: #ec0867 !important;
      }
      .btn-primary a:hover {
        background-color: #ec0867 !important;
        border-color: #ec0867 !important;
      }
    }
/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
    .last {
      margin-bottom: 0;
    }

    .first {
      margin-top: 0;
    }

    .align-center {
      text-align: center;
    }

    .align-right {
      text-align: right;
    }

    .align-left {
      text-align: left;
    }

    .text-link {
      color: #0867ec !important;
      text-decoration: underline !important;
    }

    .clear {
      clear: both;
    }

    .mt0 {
      margin-top: 0;
    }

    .mb0 {
      margin-bottom: 0;
    }

    .preheader {
      color: transparent;
      display: none;
      height: 0;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
      mso-hide: all;
      visibility: hidden;
      width: 0;
    }

    .powered-by a {
      text-decoration: none;
    }
/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
    @media only screen and (max-width: 640px) {
      .main p,
      .main td,
      .main span {
        font-size: 16px !important;
      }
      .wrapper {
        padding: 8px !important;
      }
      .content {
        padding: 0 !important;
      }
      .container {
        padding: 0 !important;
        padding-top: 8px !important;
        width: 100% !important;
      }
      .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      .btn table {
        max-width: 100% !important;
        width: 100% !important;
      }
      .btn a {
        font-size: 16px !important;
        max-width: 100% !important;
        width: 100% !important;
      }
    }
/* -------------------------------------
    PRESERVE THESE STYLES IN THE HEAD
------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
    }
    </style>
```
{{% /faq %}}
```html
  </head>
  <body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <span class="preheader"><?= $this->preheader ?></span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
              <tr>
                <td class="wrapper">
                  <?= $this->body ?>
                </td>
              </tr>
            </table>
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 7-11 Commercial Ct, Belfast BT1 2NB</span>
                    <br> Don't like these emails? <a href="#">Unsubscribe</a>.
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
```


### Absendereinstellungen

**Absender-E-Mail-Adresse:** Hier musst du die E-Mail-Adresse des Absenders eingeben.

**Absendername:** Hier kannst du den Namen des Absenders eingeben.

**Mailer-Transport:** In vielen Fällen erlauben SMTP-Server nicht den Versand von beliebigen Absenderadressen. Meist
muss die Absenderadresse zu den verwendeten SMTP-Server Zugangsdaten passen. Vor allem in Multidomain-Installationen von
Contao kann es jedoch wichtig sein, dass die Absenderadresse der E-Mails, die Contao verschickt, zur jeweiligen Domain
passt. Deshalb kannst du sogenannte »[Transports](/de/system/einstellungen/#verschiedene-e-mail-konfigurationen-und-absenderadressen)«
anlegen und hier auswählen.


## Newsletter

Newsletter werden grundsätzlich nach ihrem Versanddatum sortiert.

Um einen neuen Newsletter anzulegen klicke auf 
![Verteiler bearbeiten]({{% asset "icons/edit.svg" %}}?classes=icon "Verteiler bearbeiten") bzw.
![Verteiler bearbeiten]({{% asset "icons/children.svg" %}}?classes=icon "Verteiler bearbeiten") und danach auf 
![Einen neuen Newsletter erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Newsletter erstellen") 
**Neu**.


### Betreff und Newsletteralias

**Betreff:** Hier kannst du den Betreff des Newsletters eingeben.

**Newsletteralias:** Der Alias eines Newsletters ist eine eindeutige und aussagekräftige Referenz, über die du ihn in 
deinem Browser aufrufen kannst.


### HTML-Inhalt

Eventuell wunderst du dich, warum du den Text des Newsletters zweimal eingeben musst. Das liegt daran, dass weder die 
HTML- noch die Text-Variante in der Praxis ohne Nachteile ist und man deshalb dazu übergegangen ist, beide in die Mail 
einzufügen. Das jeweilige Mail-Programm des Empfängers entscheidet dann selbstständig, welche Variante es anzeigen kann.

Ein reiner HTML-Newsletter hat folgende Nachteile:

- Nicht alle Mail-Clients können HTML korrekt darstellen.
- HTML-Mails werden eher als Spam eingestuft als reine Textmails.
- Extern eingebundene Bilder werden häufig geblockt.

Ein Text-Newsletter hat diese Probleme nicht, allerdings kannst du darin weder Bilder einbinden noch Einfluss auf die 
Textformatierung nehmen.

{{< version-tag "5.3" >}} **Preheader-Text:** Hier kannst du einen Preheader-Text eingeben. Ein Preheader-Text sollte 
zwischen 40 und 130 Zeichen lang sein. Der Preheader-Text ist in einer E-Mail in deiner Inbox der kurze Text nach den 
Absenderinformationen und der Betreffzeile.

**HTML-Inhalt:** Gebe hier den HTML-Inhalt des Newsletters ein. Die Eingabe erfolgt wie beim Inhaltselement »Text« über 
den Rich-Text-Editor.


### Text-Inhalt

**Text-Inhalt:** Gebe hier den Textinhalt des Newsletters ein.


### Newsletter personalisieren

Wenn du Newsletter an registrierte Mitglieder verschickst, kannst du diese mithilfe der sogenannten »[Simple Tokens](https://docs.contao.org/manual/de/artikelverwaltung/simple-tokens/)«
personalisieren. Simple Tokens funktionieren ähnlich wie Insert-Tags und können sowohl im HTML- als auch im Text-Inhalt
eines Newsletters verwendet werden. Nachfolgend ein kleines Beispiel:

```text
Sehr geehrte(r) ##firstname## ##lastname##,

bitte prüfen und aktualisieren Sie Ihre Daten:

Anschrift:   ##street##
PLZ/Ort:     ##postal## ##city##
Telefon:     ##phone##
E-Mail:      ##email##

Ihr Administrator
```

Im Gegensatz zu Insert-Tags kannst du mit Simple Tokens nicht nur auf die Daten der Mitgliedertabelle `tl_member`
zugreifen, sondern auch einfache If-Else-Abfragen realisieren und so beispielsweise die Anrede
geschlechtsspezifisch präzisieren:

```text
{if gender=="male"}
Sehr geehrter Herr ##lastname##,
{elseif gender=="female"}
Sehr geehrte Frau ##lastname##,
{else}
Sehr geehrte Damen und Herren,
{endif}

[Inhalt des Newsletters]

{if phone==""}
Bitte aktualisieren Sie Ihre Daten und geben Sie Ihre Telefonnummer an.
{endif}

<!-- Abfrage auf "nicht leer" -->
{if phone!=""}
Wir haben folgende Telefonnummer von Ihnen gespeichert: ##phone##
{endif}

Ihr Administrator
```


### Dateianhänge {#dateianhaenge}

Du kannst jedem Newsletter eine oder mehrere Dateien hinzufügen, die dann als E-Mail-Anhänge versendet oder auf der
Webseite zum Download angeboten werden.

**Dateien anhängen:** Hier aktivierst du die Funktion.

**Dateianhänge:** Hier wählst du die Dateianhänge aus.


### Template-Einstellungen

Zum E-Mail-Template musst du vor allem zwei Dinge wissen:

- Es wird nur bei HTML-Newslettern verwendet.
- Es ist primär für den Seitenaufbau und nicht für Inhalte gedacht.

HTML-Mails sind prinzipiell wie HTML-Webseiten aufgebaut, nur können die E-Mail-Programme leider bei Weitem nicht so
gut mit HTML-Code umgehen wie die modernen Internetbrowser. Deswegen generiert das Template `mail_default`
ein an sich veraltetes HTML 3.2-Dokument, das jedoch von den meisten E-Mail-Clients verarbeitet wird.

**E-Mail-Template:** Hier wählst du das Template für die HTML-Mail aus.

{{< version-tag "5.3" >}} Zusätzlich zum `mail_default` steht auch `mail_responsive` zur Verfügung.


### Absendereinstellungen

Wenn du keine individuelle Absenderadresse vorgibst, wird die E-Mail-Adresse des Verteilers verwendet.

**Individuelle Absender-E-Mail-Adresse:** Hier kannst du die E-Mail-Adresse des Absenders vorgeben.

**Individueller Absendername:** Hier kannst du den Namen des Absenders vorgeben.

**Mailer-Transport:** In vielen Fällen erlauben SMTP-Server nicht den Versand von beliebigen Absenderadressen. Meist
muss die Absenderadresse zu den verwendeten SMTP-Server Zugangsdaten passen. Vor allem in Multidomain-Installationen von
Contao kann es jedoch wichtig sein, dass die Absenderadresse der E-Mails, die Contao verschickt, zur jeweiligen Domain
passt. Deshalb kannst du sogenannte »[Transports](/de/system/einstellungen/#verschiedene-e-mail-konfigurationen-und-absenderadressen)«
anlegen und hier auswählen.


### Experten-Einstellungen

Um einen Newsletter als reine Text-Mail zu versenden, reicht es nicht, das Feld HTML-Inhalt einfach leer zu lassen. Du 
musst darüber hinaus in den Experten-Einstellungen die Option `Als Text senden` auswählen.

**Als Text senden:** Hier deaktivierst du die HTML-Versendung

**Externe Bilder:** Hier kannst du dafür sorgen, dass Bilder in HTML-Newslettern nicht eingebettet werden.


## Abonnenten

In der Regel verwalten sich die Empfänger eines Newsletters über die entsprechenden Frontend-Module selbstständig, ohne 
dass du als Administrator in den Prozess eingreifen musst. Trotzdem hast du im Backend die Möglichkeit, Abonnenten 
manuell zu ändern. Aus Gründen des Datenschutzes werden jeweils nur die E-Mail-Adresse und der Aktivierungsstatus 
gespeichert.

![Einen Abonnenten bearbeiten]({{% asset "images/manual/core-extensions/newsletter/de/einen-empfaenger-bearbeiten.png" %}}?classes=shadow)

Gemäß des [Double Opt-In-Verfahrens](https://de.wikipedia.org/wiki/Opt-In) erhält jeder Abonnent bei der Bestellung 
eine E-Mail mit einem Bestätigungslink, ohne den er sein Abonnement nicht abschließen kann. Damit wird den Bestimmungen 
des §7 Absatz 2 Nummer 2 und 3 des Gesetzes gegen den unlauteren Wettbewerb (UWG) hinreichend Genüge getan.

Um einen Abonnenten des Verteilers zu bearbeiten, klicke auf 
![Abonnenten des Verteilers bearbeiten]({{% asset "icons/mgroup.svg" %}}?classes=icon "Abonnenten des Verteilers bearbeiten") 
und danach auf 
![Einen neuen Abonnenten erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Abonnenten erstellen") 
**Neu** oder ![Abonnent bearbeiten]({{% asset "icons/edit.svg" %}}?classes=icon "Abonnent bearbeiten").

**E-Mail-Adresse:** Gebe hier die E-Mail-Adresse des Empfängers ein.

**Abonnenten aktivieren:** Hier kannst du die E-Mail-Adresse aktivieren. Solange eine E-Mail-Adresse nicht aktiviert 
ist, wird der Empfänger beim Versand des Newsletters nicht berücksichtigt. Die Aktivierung erfolgt normalerweise über 
das Anklicken des Links der Bestätigungsmail, kann hier aber auch manuell angestoßen werden.


### CSV -Import

Eventuell hast du schon vor Contao mit einem Newsletter-System gearbeitet und stehst jetzt vor der Aufgabe, die 
vorhandenen Empfänger in Contao einzufügen. Für diesen Fall bietet das Newsletter-Modul die Funktion `CSV-Import`.

Exportiere zunächst die vorhandenen Empfänger als CSV-Datei. Die meisten Programme wie z. B. phpMyAdmin oder Excel 
bieten eine entsprechende Option an, um Daten im CSV-Format zu speichern. Obwohl die Bezeichnung CSV-Datei suggeriert, 
dass nur kommagetrennte Daten verarbeitet werden könnten, akzeptiert Contao auch Strichpunkte, Tabulatoren und 
Zeilenumbrüche als Feldtrenner.

Wähle die Datei für den Import auf deinem Rechner aus.

![Newsletter-Abonnenten importieren]({{% asset "images/manual/core-extensions/newsletter/de/newsletter-empfaenger-importieren.png" %}}?classes=shadow)

Starte den Import anschließend durch einen Klick auf die Schaltfläche `CSV-Import`.


## Newsletter versenden

Die Versendung eines Newsletters leitest du über das entsprechende Navigationssymbol 
![Newsletter versenden]({{% asset "icons/send.svg" %}}?classes=icon "Newsletter versenden") in der Verteiler-Übersicht ein. 
Du gelangst zunächst zu einer Vorschauseite, auf der du die Konfiguration und den Inhalt des Newsletters noch einmal 
prüfen kannst. Es wird zudem empfohlen, regen Gebrauch von der Schaltfläche `Testsendung` zu machen. Die 
dazugehörige Empfängeradresse kannst du im Feld `Testsendung an` ändern.

![Einen Newsletter versenden]({{% asset "images/manual/core-extensions/newsletter/de/einen-newsletter-versenden.png" %}}?classes=shadow)


### Serverlimits einkalkulieren

Im Regelfall wirst du für deine Webseite keinen eigenen Server angemietet haben, sondern sich einen sogenannten 
Shared-Hosting-Server mit anderen Kunden teilen. Da die Systemressourcen im Shared-Hosting-Bereich allen Kunden 
gemeinschaftlich zur Verfügung stehen, gibt es normalerweise bestimmte Limits, die deren Nutzung einschränken.

Wenn du z. B. einen Newsletter an 500.000 Empfänger versendest, kann das den Mailserver schon mal eine Zeit lang 
beschäftigen, in der du den Dienst für alle Kunden quasi blockierst. Deswegen ist die Anzahl der E-Mails, die du pro 
Minute versenden kannst, normalerweise auf einen Wert zwischen 50 und 500 limitiert.

Um solchen Beschränkungen Rechnung zu tragen, versendet Contao nicht alle Newsletter auf einmal, sondern unterteilt 
den Versandprozess in mehrere Zyklen, die du exakt an die Vorgaben deines Mailservers anpassen kannst.

**Mails pro Zyklus:** Hier legst du die Anzahl der Mails pro Versandzyklus fest.

**Wartezeit in Sekunden:** Hier legst du die Wartezeit zwischen jedem Zyklus fest.

**Versatz:** Falls eine Versendung unterbrochen wurde, kannst du hier festlegen, ab welchem Empfänger diese 
weiterlaufen soll. 

Ausgehend von einem Serverlimit von 100 E-Mails pro Minute und einer Gesamtzahl von 10.000 Empfängern kannst du also 
beispielsweise alle 6 Sekunden 10 Mails verschicken. Der komplette Versandvorgang würde dann 100 Minuten dauern.


### Unterbrochene Versendungen wiederaufnehmen

Normalerweise erfolgt die Versendung eines Newsletters vollständig automatisiert, und du kannst währenddessen andere 
Arbeiten erledigen. Du darfst nur nicht das Contao-Browserfenster schließen oder den Rechner ausschalten. Falls dir das 
doch einmal versehentlich passiert, kannst du den Versand wie folgt wiederaufnehmen:

1. Filtere im Backend unter »System« > »System-Log« die Kategorie nach dem letzten Newsletter-Eintrag.
2. Stelle fest, wie viele Newsletter versendet wurden.
3. Gebe den gewünschten Versatz im Feld `Versatz` ein.

Die Log-Daten der Versendung findest du im Backend unter »System« > »System-Log«. Die Filter-Kategorie heißt 
NEWSLETTER_X, wobei das X für die ID des jeweiligen Newsletters steht. Die Gesamtzahl der versendeten E-Mail entnimmst 
du dem Feld <code>Anzeigen</code>. Waren es z. B. 120 Mails, gib "120" ein, um mit dem 121. Empfänger 
fortzufahren (die Zählung beginnt bei 0).

![Unterbrochene Versendungen wiederaufnehmen]({{% asset "images/manual/core-extensions/newsletter/de/unterbrochene-versendungen-wiederaufnehmen.png" %}}?classes=shadow)

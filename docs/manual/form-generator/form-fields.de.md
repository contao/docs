---
title: "Formularfelder"
description: "Ähnlich wie bei Artikeln und Inhaltselementen gibt es auch bei Formularen für jedes Formularfeld ein 
eigenes Element, das speziell auf die jeweiligen Anforderungen des Eingabefelds ausgerichtet ist."
url: "formulargenerator/formularfelder"
aliases:
    - /de/formulargenerator/formularfelder/
weight: 20
---

Ähnlich wie bei Artikeln und Inhaltselementen gibt es auch bei Formularen für jedes Formularfeld ein eigenes Element, 
das speziell auf die jeweiligen Anforderungen des Eingabefelds ausgerichtet ist. Für jedes Formularfeld musst du 
mindestens einen Feldnamen und eine Feldbezeichnung eingeben.

![Formularfelder bearbeiten]({{% asset "images/manual/form-generator/de/formularfelder-bearbeiten.png" %}}?classes=shadow)

**Feldname:** Über den Feldnamen wird die Benutzereingabe nach dem Absenden des Formulars referenziert. Falls du die 
Formulardaten in der Datenbank speicherst, muss es in der Tabelle ein gleich lautendes Feld geben.

**Feldbezeichnung:** Die Feldbezeichnung wird im Frontend vor bzw. über dem Formularfeld angezeigt und sollte in der 
jeweils richtigen Sprache verfasst werden.

**Pflichtfeld:** Wenn du diese Option auswählst, muss das Feld zum Abschicken des Formulars ausgefüllt werden. Bleibt 
es leer, erscheint eine Fehlermeldung.


## Erklärung {#erklaerung}

Das Formularfeld `Erklärung` fügt dem Formular eine beliebige formatierte Erklärung hinzu. Die Eingabe erfolgt über den 
Rich-Text-Editor.


### Text/HTML

**Text:** Gebe hier den formatierten Text der Erklärung ein.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_explanation` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-explanation explanation">
    <p>…</p>
</div>
```


## HTML-Code

Das Formularfeld `HTML-Code` fügt dem Formular beliebigen HTML-Code hinzu. In den Backend-Einstellungen unter »Erlaubte 
HTML-Tags« kannst du festlegen, welche HTML-Tags verwendet werden dürfen.


### Text/HTML

**HTML:** Gebe hier deinen HTML-Code ein.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_html` überschreiben.

HTML-Felder haben kein umschließendes HTML-Markup.


## Fieldset Anfang und Fieldset Ende

Das `fieldset`-Element wird verwendet, um mehrere Steuerelemente sowie Bezeichnungen in einem Webformular 
zu gruppieren.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du die Standard-Templates `form_fieldsetStart` und `form_fieldsetStop` 
überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<fieldset>
    <legend>…</legend>
    <div class="widget widget-text mandatory">
        …
    </div>
    <div class="widget widget-text mandatory">
        …
    </div>
</fieldset>
```


## Textfeld

Das Formularfeld Textfeld fügt dem Formular ein einzeiliges Eingabefeld hinzu. Du solltest grundsätzlich für jedes 
Textfeld die Eingabeprüfung aktivieren, um einer missbräuchlichen Verwendung des Formulars vorzubeugen.


### Feldkonfiguration

**Eingabeprüfung:** Hier kannst du ein Suchmuster vorgeben, anhand dessen die Benutzereingaben beim Abschicken des 
Formulars geprüft werden.

| Suchmuster                         | Erklärung                                                                                                  |
|:-----------------------------------|:-----------------------------------------------------------------------------------------------------------|
| Numerische Zeichen                 | Erlaubt Zahlen, Minus (-), Punkt (.) und Leerzeichen ( ).                                                  |
| Alphabetische Zeichen              | Erlaubt Buchstaben, Minus (-), Punkt (.) und Leerzeichen ( ).                                              |
| Alphanumerische Zeichen            | Erlaubt Zahlen und Buchstaben, Minus (-), Punkt (.), Unterstrich (_) und Leerzeichen ( ).                  |
| Erweiterte alphanumerische Zeichen | Erlaubt alle Zeichen außer denen, die normalerweise aus Sicherheitsgründen kodiert werden (#/()<=>).       |
| Datum                              | Erlaubt Eingaben gemäß des globalen Datumsformats.                                                         |
| Uhrzeit                            | Erlaubt Eingaben gemäß des globalen Uhrzeitformats.                                                        |
| Datum und Uhrzeit                  | Erlaubt Eingaben gemäß des globalen Datums- und Uhrzeitformats.                                            |
| Telefonnummer                      | Erlaubt Zahlen, Plus (+), Minus (-), Schrägstrich (/), runde Klammern (()) und Leerzeichen ( ).            |
| E-Mail-Adresse                     | Erlaubt die Eingabe einer gültigen E-Mail-Adresse.                                                         |
| URL-Format                         | Erlaubt die Eingabe einer gültigen URL.                                                                    |
| Absolute URL                       | {{< version-tag "4.11" >}} Erlaubt die Eingabe einer absoluten URL (beginnt mit `http://` oder `https://`) |
| Eigene                             | {{< version-tag "4.11" >}} Erlaubt die Eingabe gemäß der eigens angegebenen Regular Expression.            |

**Platzhalter:** Dieser Text wird angezeigt, solange das Feld noch nicht ausgefüllt wurde.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Standard-Wert:** Hier kannst du einen Standardwert erfassen. Bei barrierefreien Webseiten wird es empfohlen, das 
@-Zeichen für E-Mail-Adressen vorzugeben.

**Minimale Eingabelänge:** Hier kannst du die minimale Anzahl an Zeichen vorgeben, die in das Textfeld eingegeben 
werden dürfen.

**Maximale Eingabelänge:** Hier kannst du die maximale Anzahl an Zeichen vorgeben, die in das Textfeld eingegeben 
werden dürfen.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_textfield` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-text … mandatory">
    <label for="ctrl" class="… mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="text" name="…" id="ctrl" class="text … mandatory" value="" required placeholder="…" minlength="…" maxlength="…" accesskey="…" tabindex="…">
</div>
```


## Passwortfeld

Das Formularfeld `Passwortfeld` fügt dem Formular zwei einzeilige Eingabefelder für das Passwort und dessen Bestätigung 
hinzu. Prinzipiell funktionieren Passwortfelder genau wie [Textfelder](#textfeld), nur dass die Eingabe verdeckt 
erfolgt.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_password` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-password mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
    </label>
    <input type="password" name="…" id="ctrl" class="text password mandatory" value="" required>
</div>

<div class="widget widget-password confirm mandatory">
    <label for="ctrl_confirm" class="confirm mandatory">
        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
    </label>
    <input type="password" name="…_confirm" id="ctrl_confirm" class="text password mandatory" value="" required>
</div>
```


## Textarea

Das Formularfeld `Textarea` fügt dem Formular ein mehrzeiliges Eingabefeld für längere Texte hinzu. Du 
solltest auch hier die Eingabeprüfung aktivieren, um einer missbräuchlichen Verwendung des Formulars vorzubeugen.


### Feldkonfiguration

**Eingabeprüfung:** Hier kannst du ein Suchmuster vorgeben, anhand dessen die Benutzereingaben beim Abschicken des
Formulars geprüft werden.

| Suchmuster                         | Erklärung                                                                                                  |
|:-----------------------------------|:-----------------------------------------------------------------------------------------------------------|
| Numerische Zeichen                 | Erlaubt Zahlen, Minus (-), Punkt (.) und Leerzeichen ( ).                                                  |
| Alphabetische Zeichen              | Erlaubt Buchstaben, Minus (-), Punkt (.) und Leerzeichen ( ).                                              |
| Alphanumerische Zeichen            | Erlaubt Zahlen und Buchstaben, Minus (-), Punkt (.), Unterstrich (_) und Leerzeichen ( ).                  |
| Erweiterte alphanumerische Zeichen | Erlaubt alle Zeichen außer denen, die normalerweise aus Sicherheitsgründen kodiert werden (#/()<=>).       |
| Datum                              | Erlaubt Eingaben gemäß des globalen Datumsformats.                                                         |
| Uhrzeit                            | Erlaubt Eingaben gemäß des globalen Uhrzeitformats.                                                        |
| Datum und Uhrzeit                  | Erlaubt Eingaben gemäß des globalen Datums- und Uhrzeitformats.                                            |
| Telefonnummer                      | Erlaubt Zahlen, Plus (+), Minus (-), Schrägstrich (/), runde Klammern (()) und Leerzeichen ( ).            |
| E-Mail-Adresse                     | Erlaubt die Eingabe einer gültigen E-Mail-Adresse.                                                         |
| URL-Format                         | Erlaubt die Eingabe einer gültigen URL.                                                                    |
| Absolute URL                       | {{< version-tag "4.11" >}} Erlaubt die Eingabe einer absoluten URL (beginnt mit `http://` oder `https://`) |
| Eigene                             | {{< version-tag "4.11" >}} Erlaubt die Eingabe gemäß der eigens angegebenen Regular Expression.            |

**Platzhalter:** Dieser Text wird angezeigt, solange das Feld noch nicht ausgefüllt wurde.


### Reihen und Spalten

**Reihen und Spalten:** Hier legst du fest, wie viele Reihen und Spalten die Textarea haben soll. Die Abmessungen des
Feldes kannst du zudem per CSS bestimmen.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Standard-Wert:** Hier kannst du einen Standardwert erfassen.

**Minimale Eingabelänge:** Hier kannst du die minimale Anzahl an Zeichen vorgeben, die in das Textfeld eingegeben 
werden dürfen.

**Maximale Eingabelänge:** Hier kannst du die maximale Anzahl an Zeichen vorgeben, die in das Textfeld eingegeben 
werden dürfen.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_textarea` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-textarea mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <textarea name="…" id="ctrl" class="textarea mandatory" rows="4" cols="40" required placeholder="…"></textarea>
</div>
```


## Select-Menü {#select-menue}

Das Formularfeld `Select-Menü` fügt dem Formular ein Drop-Down-Menü hinzu, aus dem du genau eine Option 
auswählen kannst. Um die Auswahl mehrerer Optionen zu erlauben, kannst du entweder die Mehrfachauswahl aktivieren oder 
ein [Checkbox-Menü](#checkbox-menue) anstatt des Select-Menüs verwenden.

![Ein Select-Menü im Frontend]({{% asset "images/manual/form-generator/de/ein-select-menue-im-frontend.png" %}}?classes=shadow)


### Feldkonfiguration

**Mehrfachauswahl:** Hier kannst du die Auswahl mehrerer Optionen erlauben.

**Listengröße:** Hier legst du fest, wie viele Zeilen das Auswahlfeld bei aktivierter Mehrfachauswahl hoch sein soll. 
Innerhalb des Feldes kann gescrollt werden.


### Optionen

**Optionen:** Hier kannst du die verschiedenen Auswahlmöglichkeiten erfassen.

Beim Anlegen der Optionen unterstützt dich ein JavaScript-Assistent. Du kannst Optionen gruppieren und jede Gruppe mit 
einer Überschrift versehen. Um eine Zeile zu einer Gruppenüberschrift zu machen, wähle die Option Gruppe.

![JavaScript-Assistent für das Anlegen von Optionen]({{% asset "images/manual/form-generator/de/anlegen-von-optionen.png" %}}?classes=shadow)


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_select` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-select select mandatory">
    <label for="ctrl" class="select mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <select name="…" id="ctrl" class="select mandatory" required>
        <option value="">-</option>
        <option value="…">…</option>
        <option value="…">…</option>
        <option value="…">…</option>
    </select>
</div>
```

Felder mit Mehrfachauswahl verwenden die CSS-Klasse `multiselect` anstatt `select`.


## Radio-Button-Menü {#radio-button-menue}

Das Formularfeld Radio-Button-Menü fügt dem Formular eine Liste von Optionen hinzu, aus der du genau eine auswählen 
kannst. Um die Auswahl mehrerer Optionen zu erlauben, musst du ein [Checkbox-Menü](#checkbox-menue) verwenden.

![Ein Radio-Button-Menü im Frontend]({{% asset "images/manual/form-generator/de/ein-radio-button-menue-im-frontend.png" %}}?classes=shadow)


### Optionen

**Optionen:** Hier kannst du die verschiedenen Auswahlmöglichkeiten erfassen. Beim Anlegen der Optionen unterstützt 
dich ein JavaScript-Assistent.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_radio` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-radio mandatory">   
    <fieldset id="ctrl" class="radio_container mandatory">
        <legend>
            <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
        </legend>
        <span>
            <input type="radio" name="…" id="opt_0" class="radio" value="…" required> 
            <label id="lbl_0" for="opt_0">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_1" class="radio" value="…" required> 
            <label id="lbl_1" for="opt_1">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_2" class="radio" value="…" required> 
            <label id="lbl_2" for="opt_2">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_3" class="radio" value="…" required> 
            <label id="lbl_3" for="opt_3">…</label>
        </span>
    </fieldset>
</div>
```


## Checkbox-Menü {#checkbox-menue}

Das Formularfeld `Checkbox-Menü` fügt dem Formular eine Liste von Optionen hinzu, aus der du beliebig viele 
Optionen oder auch gar keine auswählen kannst. Um die Auswahl genau einer Option zu erlauben, musst du ein 
[Radio-Button-Menü](#radio-button-menue) oder ein [Select-Menü](#select-menue) verwenden.

![Ein Checkbox-Menü im Frontend]({{% asset "images/manual/form-generator/de/ein-checkbox-menue-im-frontend.png" %}}?classes=shadow)


### Optionen

**Optionen:** Hier kannst du die verschiedenen Auswahlmöglichkeiten erfassen. Beim Anlegen der Optionen unterstützt 
dich ein JavaScript-Assistent.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_checkbox` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-checkbox mandatory">
    <fieldset id="ctrl" class="checkbox_container mandatory">
        <legend>
            <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
        </legend>
        <input type="hidden" name="…" value="">
        <span>
            <input type="checkbox" name="…[]" id="opt_0" class="checkbox" value="…"> 
            <label id="lbl_0" for="opt_0">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_1" class="checkbox" value="…"> 
            <label id="lbl_1" for="opt_1">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_2" class="checkbox" value="…"> 
            <label id="lbl_2" for="opt_2">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_3" class="checkbox" value="…"> 
            <label id="lbl_3" for="opt_3">…</label>
        </span>
    </fieldset>
</div>
```


## Datei-Upload

Das Formularfeld `Datei-Upload` fügt dem Formular ein Feld hinzu, mit dem Besucher eine Datei von ihrem 
lokalen Rechner auf den Server übertragen können. Du kannst für jedes Upload-Feld individuell festlegen, welche 
Dateitypen hochgeladen werden dürfen und wo die übertragenen Dateien gespeichert werden.


### Feldkonfiguration

**Erlaubte Dateitypen:** Hier kannst du eine durch Kommata getrennte Liste erlaubter Dateiendungen erfassen. Beim 
Versuch, eine andere Datei hochzuladen, gibt Contao automatisch eine Fehlermeldung aus und verweigert die Annahme der 
Datei.

**Maximale Eingabelänge:** Hier legst du die maximale Upload-Dateigröße in Bytes fest. Standardmäßig dürfen Dateien bis 
zu 2 MB hochgeladen werden.

{{< version "4.13" >}}

**Maximale Bildbreite:** Beim Upload von Bildern prüft die Dateiverwaltung automatisch deren Breite und vergleicht 
diese Werte mit deiner hier festgelegten Vorgabe. Überschreitet ein Bild die maximale Breite, wird das Hochladen mit 
einer Fehlerausgabe im Formular abgebrochen.

**Maximale Bildhöhe:** Beim Upload von Bildern prüft die Dateiverwaltung automatisch deren Höhe und vergleicht diese 
Werte mit deiner hier festgelegten Vorgabe. Überschreitet ein Bild die maximale Höhe, wird das Hochladen mit
einer Fehlerausgabe im Formular abgebrochen.


### Datei speichern

**Hochgeladene Dateien speichern:** Wähle diese Option, um übertragene Dateien in einem bestimmten Verzeichnis auf dem 
Server zu speichern.

**Zielverzeichnis:** Hier wählst du den Speicherort für hochgeladene Dateien aus.

**Home-Verzeichnis verwenden:** Wenn du diese Option wählst und ein Mitglied zum Zeitpunkt des Uploads angemeldet ist, 
werden die übertragenen Dateien im Home-Verzeichnis des Mitglieds anstatt im Upload-Verzeichnis gespeichert.

**Bestehende Dateien erhalten:** Standardmäßig ersetzt Contao eine Datei, sobald eine gleichnamige neuere hochgeladen 
wird. Wenn du diese Option wählst, bleiben vorhandene Dateien erhalten und neue werden bei Namensgleichheit mit einem 
numerischen Suffix versehen.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.

**Feldgröße:** Hier kannst du die Größe des Upload-Feldes festlegen (`size`-Attribut).


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_upload` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-upload mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="file" name="…" id="ctrl" class="upload mandatory" required size="…">
</div>
```


## Range-Slider

### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Standard-Wert:** Hier kannst du einen Standard-Wert für das Feld eingeben.

**Minimalwert:** Hier kannst du einen Minimalwert für numerische Eingaben festlegen.

**Maximalwert:** Hier kannst du einen Maximalwert für numerische Eingaben festlegen.

**Schritt:** Hier kannst du die Schrittgröße des Feldes festlegen.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl,
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_range` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-range mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="range" name="…" id="ctrl" class="range mandatory" value="5" required max="10" step="2">
</div>
```


## Verstecktes Feld

Das Formularfeld `Verstecktes Feld` fügt dem Formular ein verstecktes Feld hinzu. Versteckte Felder können beliebige 
Werte enthalten, die im Formular nicht sichtbar sind, aber trotzdem beim Absenden übermittelt werden.

**Standard-Wert:** Hier kannst du den Wert des versteckten Felds eingeben.

Versteckte Felder haben keine CSS-Klasse.


### Feldkonfiguration

**Eingabeprüfung:** Hier kannst du ein Suchmuster vorgeben, anhand dessen die Benutzereingaben beim Abschicken des 
Formulars geprüft werden.

| Suchmuster                         | Erklärung                                                                                                  |
|:-----------------------------------|:-----------------------------------------------------------------------------------------------------------|
| Numerische Zeichen                 | Erlaubt Zahlen, Minus (-), Punkt (.) und Leerzeichen ( ).                                                  |
| Alphabetische Zeichen              | Erlaubt Buchstaben, Minus (-), Punkt (.) und Leerzeichen ( ).                                              |
| Alphanumerische Zeichen            | Erlaubt Zahlen und Buchstaben, Minus (-), Punkt (.), Unterstrich (_) und Leerzeichen ( ).                  |
| Erweiterte alphanumerische Zeichen | Erlaubt alle Zeichen außer denen, die normalerweise aus Sicherheitsgründen kodiert werden (#/()<=>).       |
| Datum                              | Erlaubt Eingaben gemäß des globalen Datumsformats.                                                         |
| Uhrzeit                            | Erlaubt Eingaben gemäß des globalen Uhrzeitformats.                                                        |
| Datum und Uhrzeit                  | Erlaubt Eingaben gemäß des globalen Datums- und Uhrzeitformats.                                            |
| Telefonnummer                      | Erlaubt Zahlen, Plus (+), Minus (-), Schrägstrich (/), runde Klammern (()) und Leerzeichen ( ).            |
| E-Mail-Adresse                     | Erlaubt die Eingabe einer gültigen E-Mail-Adresse.                                                         |
| URL-Format                         | Erlaubt die Eingabe einer gültigen URL.                                                                    |
| Absolute URL                       | {{< version-tag "4.11" >}} Erlaubt die Eingabe einer absoluten URL (beginnt mit `http://` oder `https://`) |
| Eigene                             | {{< version-tag "4.11" >}} Erlaubt die Eingabe gemäß der eigens angegebenen Regular Expression.            |


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_hidden` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<input type="hidden" name="…" value="…">
```


## Sicherheitsfrage

Das Formularfeld `Sicherheitsfrage` fügt dem Formular ein [CAPTCHA](https://de.wikipedia.org/wiki/Captcha) 
hinzu. 

Mithilfe eines [Honeypots](https://de.wikipedia.org/wiki/Honeypot) werden Spambots in die Falle gelockt und 
ausgesperrt. Der Honeypot besteht aus mehreren verstecken Feldern, die als Köder dienen. Normale Benutzer können die 
Felder nicht sehen und verändern sie deshalb nicht – die meisten Spambots schon. Zusätzlich werden im Hintergrund 
weitere Faktoren geprüft um Benutzer und Spambots zu unterscheiden.

Passiert es, dass ein Besucher fälschlicherweise als Spambot identifiziert wird, so muss er nur die in Contao übliche 
Rechenaufgabe lösen. Es gehen unter keinen Umständen abgesendete Formulardaten verloren.


### Feldkonfiguration

**Platzhalter:** Dieser Text wird angezeigt, solange das Feld noch nicht ausgefüllt wurde.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_captcha` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-captcha mandatory">
    <label for="ctrl">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="text" name="captcha" id="ctrl" class="captcha mandatory" value="" aria-describedby="captcha_text" placeholder="…" maxlength="2" required>
    <span id="captcha_text" class="captcha_text">…</span>
    <input type="hidden" name="captcha_hash" value="…">
    <div style="display:none">
        <label for="ctrl_hp">Füllen Sie dieses Feld nicht aus</label>
        <input type="text" name="captcha_name" id="ctrl_hp" value="">
    </div>
    <script>
        var e = document.getElementById('ctrl'),
            p = e.parentNode, f = p.parentNode;
        if ('fieldset' === f.nodeName.toLowerCase() && 1 === f.children.length) {
            p = f;
        }
        p.style.display = 'none';
        e.value = '…';
    </script>
</div>
```


## Absendefeld

Das Formularfeld `Absendefeld` fügt dem Formular eine Schaltfläche hinzu, mit der das Formular abgeschickt werden kann. 
Ein Absendefeld kann entweder eine Textschaltfläche oder eine Bildschaltfläche sein.

**Bezeichnung der Absende-Schaltfläche:** Gebe hier den Text der Absende-Schaltfläche bzw. Mouse-Rollover-Text der 
Bildschaltfläche ein.


### Bildschaltfläche

**Bildschaltfläche:** Hier definierst du das Absendefeld als Bildschaltfläche.

**Quelldatei:** Hier wählst du das Bild für die Bildschaltfläche aus.


### Experteneinstellungen

**CSS-Klasse:** Hier kannst du eine oder mehrere Klassen eingeben.

**Tastaturkürzel:** Mit einem Tastaturkürzel kann ein Besucher direkt zu einem bestimmten Eingabefeld springen, indem 
er die `[Alt]`- bzw. `[Strg]`-Taste in Verbindung mit dem Tastaturkürzel, z. B. einer Zahl, 
drückt ([vgl. Backend-Tastaturkürzel](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Hier kannst du die Position des Formularfeldes innerhalb der Tabulator-Reihenfolge bestimmen.


### Template-Einstellungen

**Formularfeld-Template:** Hier kannst du das Standard-Template `form_submit` überschreiben.

**HTML-Ausgabe**  
Das Formularfeld generiert folgenden HTML-Code:

```html
<div class="widget widget-submit">
    <button type="submit" id="ctrl" class="submit">…</button>
</div>
```

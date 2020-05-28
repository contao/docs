---
title: "Benutzermodule"
description: "Benutzermodule sind Module, die im Zusammenhang mit der Verwaltung von Frontend-Benutzern gebraucht 
werden."
url: "modulverwaltung/benutzermodule"
weight: 20
---
<style>
    .formbody .invisible {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    .formbody {
        background: #f2f2f2;
        border: 1px solid #ddd;
        padding: 20px;
        min-width: 250px;
        width: 80%;
     }
     .formbody label {
         margin-bottom: 0.125rem;
     }
     .formbody .checkbox_container {
        border: none;
        margin: 0 0 20px 0;
        padding: 0;
     }
     .formbody .checkbox_container label {
        display: inline;
     }
     .formbody .error {
        color: #ff0000;
     }
     .formbody .submit {
        background: #f47c00;
        color: #fff;
        padding: 5px 10px;
     }
</style>

Benutzermodule sind Module, die im Zusammenhang mit der Verwaltung von Frontend-Benutzern gebraucht werden. Dazu zählt 
beispielsweise die Registrierung neuer Mitglieder oder die An- bzw. Abmeldung bestehender Mitglieder.


## Login-Formular

Das Frontend-Modul »Login-Formular« fügt der Webseite ein Formular hinzu, mit dem sich registrierte Mitglieder 
authentifizieren können.

**Frontend-Ausgabe**

<div class="mod_login login block">
    <form action="#" id="tl_login" method="post">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" class="text" value="" required>
            </div>
            <div class="widget widget-password">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" class="text password" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span>
                        <input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> 
                        <label for="autologin">Angemeldet bleiben</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Anmelden</button>
            </div>
        </div>
    </form>
</div>

Sobald ein Frontend-Benutzer angemeldet ist, wird statt des Anmeldeformulars automatisch eine Schaltfläche zum Abmelden 
angezeigt.

**Frontend-Ausgabe**

<div class="mod_login logout block">
    <form action="#" id="tl_logout" method="post">
        <div class="formbody">
            <p class="login_info">
                Sie sind angemeldet als j.smith.<br>Ihre letzte Anmeldung war 2015-11-15 20:54. Willkommen zurück!
            </p>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Abmelden</button>
            </div>
        </div>
    </form>

</div>

Berücksichtige also bei der CSS-Formatierung beide Zustände des Moduls, und denke auch daran, dass eventuell eine 
Fehlermeldung ausgegeben wird.

**Autologin erlauben:** Wenn du diese Option auswählst, können Mitglieder auf Wunsch angemeldet bleiben. Läuft eine 
Benutzersitzung ab, erstellt Contao automatisch eine neue Sitzung, ohne dass das Passwort dazu erneut eingegeben werden 
muss.

**Weiterleitungsseite:** Hier legst du fest, zu welcher Seite ein Mitglied nach erfolgreicher Anmeldung weitergeleitet 
wird. Diese Einstellung kannst du pro Benutzergruppe überschreiben, um eine gruppenspezifische Weiterleitung 
einzurichten.

**Zur zuletzt besuchten Seite:** Wenn du diese Option auswählst, wird der Frontend-Benutzer zur zuletzt besuchten Seite 
anstatt zur Weiterleitungsseite weitergeleitet.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_login` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_login login block">

    <form action="/_contao/login" id="tl_login" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_login">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <input type="hidden" name="_target_path" value="…">
            <input type="hidden" name="_failure_path" value="…">
            <input type="hidden" name="_always_use_target_path" value="0">
            <div class="widget widget-text">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" class="text" value="" required>
            </div>
            <div class="widget widget-password">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" class="text password" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span>
                        <input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> 
                        <label for="autologin">Angemeldet bleiben</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Anmelden</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

Nachdem sich ein Mitglied angemeldet hat, ändert sich der HTML-Code wie folgt:

```html
<!-- indexer::stop -->
<div class="mod_login logout block">

    <form action="/_contao/logout" id="tl_logout" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_logout">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <input type="hidden" name="_target_path" value="…">
            <p class="login_info">
                Sie sind angemeldet als j.smith.<br>Ihre letzte Anmeldung war 2015-11-15 20:54. Willkommen zurück!
            </p>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Abmelden</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Automatischer Logout

Das Frontend-Modul »Automatischer Logout« fügt der Webseite ein unsichtbares Modul hinzu, das einen angemeldeten 
Frontend-Benutzer automatisch abmeldet.

Sobald sich ein Mitglied im Frontend der Webseite angemeldet hat, erscheint im Hauptmenü auf der rechten Seite ein 
Logout-Link, mit dem es sich wieder abmelden kann. In Wirklichkeit handelt es sich dabei um zwei verschiedene Seiten in 
der Seitenstruktur, die einmal das Login- und einmal das Logout-Modul enthalten.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Frontend-Benutzer nach der Abmeldung weitergeleitet 
wird.

**Zur zuletzt besuchten Seite:** Wenn du diese Option auswählst, wird das Mitglied zur zuletzt besuchten Seite anstatt 
zur Weiterleitungsseite weitergeleitet.

Das Modul erzeugt keine HTML-Ausgabe.


## Personendaten

Das Frontend-Modul »Personendaten« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied seine persönlichen 
Daten wie z. B. seine E-Mail-Adresse oder sein Passwort ändern kann. Dabei kannst du als Administrator genau festlegen, 
welche Felder bearbeitet werden dürfen und welche nicht.

**Frontend-Ausgabe `member_default`**

<div class="mod_personalData block">
    <form action="#" id="tl_member" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password">Passwort</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password_confirm" class="confirm">Bestätigung</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>
</div>

**Frontend-Ausgabe `member_grouped`**

<div class="mod_personalData block">
    <form action="#" id="tl_member" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
            </fieldset>       
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Zugangsdaten</legend>          
                <div class="widget widget-password">
                    <label for="ctrl_password">Passwort</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password__confirm" class="confirm">Bestätigung</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </fieldset>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>
</div>

**Editierbare Felder:** Hier kannst du die editierbaren Felder festlegen.

![Editierbare Felder festlegen](/de/module-management/images/de/editierbare-felder-festlegen.png?classes=shadow)

**Abonnierbare Newsletter:** Wenn du die Contao Newsletter-Erweiterung verwendest, kannst du hier festlegen, welche 
Verteiler ein Mitglied abonnieren kann.

**Weiterleitungsseite:** Hier kannst du auswählen, auf welche Seite ein Mitglied nach dem Absenden der Änderungen 
weitergeleitet wird.

**Formulartemplate:** Hier wählst du das Template des Formulars aus.

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `member_default`         | Die Eingabefelder werden untereinander aufgelistet.                                      |
| `member_grouped`         | Die Eingabefelder werden mithilfe von Fieldsets gruppiert.                               |

**HTML-Ausgabe**  
Das Frontend-Modul generiert mit `member_default` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_personalData block">
 
    <form action="…" id="tl_member" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password">Passwort</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password_confirm" class="confirm">Bestätigung</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

Das Frontend-Modul generiert mit `member_grouped` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_personalData block">

    <form action="…" id="tl_member" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            
            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
            </fieldset>

            <fieldset>
                <legend>Zugangsdaten</legend>          
                <div class="widget widget-password">
                    <label for="ctrl_password">Passwort</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password__confirm" class="confirm">Bestätigung</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </fieldset>
        
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Mitgliederregistrierung

Das Frontend-Modul »Mitgliederregistrierung« fügt der Webseite ein Formular hinzu, mit dem sich neue Mitglieder 
registrieren können und je nach Konfiguration automatisch ein Benutzerkonto für den geschützten Bereich erhalten.

**Frontend-Ausgabe `member_default`**

<div class="mod_registration block">
    <form action="#" id="tl_registration" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>
</div>

**Frontend-Ausgabe `member_grouped`**

<!-- indexer::stop -->
<div class="mod_registration block">
    <form action="#" id="tl_registration" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personendaten</legend>              
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
             </fieldset>
             <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
             </fieldset>           
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>
</div>

**Editierbare Felder:** Hier kannst du festlegen, welche Felder ein neues Mitglied bei der Registrierung ausfüllen muss. 
Um die Anmeldung im Frontend zu ermöglichen, musst du mindestens die Felder Benutzername und Passwort aktivieren.

**Abonnierbare Newsletter:** Wenn du die Contao Newsletter-Erweiterung verwendest, kannst du hier festlegen, welche 
Verteiler ein Mitglied abonnieren kann.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.

**Mitgliedergruppen:** Hier legst du die Gruppenmitgliedschaft des neuen Mitglieds fest.

**Login erlauben:** Wenn du diese Option auswählst, kann sich ein neues Mitglied nach der Registrierung im Frontend 
anmelden. Damit das funktioniert, muss das Registrierungsformular die Felder Benutzername und Passwort enthalten.

**Ein Benutzerverzeichnis anlegen:** Wenn du diese Option auswählst, wird bei der Registrierung automatisch ein neues 
Benutzerverzeichnis in einem Ordner deiner Wahl erstellt. Der Name des neuen Verzeichnisses wird aus dem Benutzernamen 
generiert.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Mitglied nach der Registrierung weitergeleitet wird 
(z. B. auf die Seite mit dem Login-Formular).

**Automatisierung der Mitgliederregistrierung**

Du kannst den Registrierungsprozess auf Wunsch vollständig automatisieren. Ein neues Mitglied erhält dann bei der 
Registrierung eine E-Mail mit einem Bestätigungslink, mit dem es sein Konto selbstständig aktivieren kann.

**Aktivierungsmail verschicken:** Hier schaltest du die automatische Aktivierung ein.

**Bestätigungsseite:** Hier legst du fest, auf welche Seite ein Benutzer nach erfolgreicher Aktivierung seines Kontos 
weitergeleitet wird (z. B. die Login-Seite).

**Aktivierungsmail:** Gebe hier den Text der Aktivierungsmail ein. Du kannst Platzhalter im Format `##key##` für alle 
Eingabefelder des Registrierungsformulars sowie die Platzhalter `##domain##` für die Domain und `##link##` für den 
Bestätigungslink verwenden.

Nachfolgend ein kurzes Beispiel:

```text
Sehr geehrte(r) ##firstname## ##lastname##,

Vielen Dank für Ihre Registrierung auf ##domain##.

Bitte klicken Sie auf den Link, um Ihre Registrierung abzuschließen und Ihr Konto zu aktivieren:

##link##

Der Bestätigungslink ist 24 Stunden gültig.

Wenn Sie keinen Zugang angefordert haben, ignorieren Sie diese E-Mail bitte.

Ihr Administrator
```

**Formulartemplate:** Hier wählst du das Template des Formulars aus.

| Template                 | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| `member_default`         | Die Eingabefelder werden untereinander aufgelistet.                                      |
| `member_grouped`         | Die Eingabefelder werden mithilfe von Fieldsets gruppiert.                               |

**HTML-Ausgabe**  
Das Frontend-Modul generiert mit `member_default` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_registration block">

    <form action="…" id="tl_registration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

Das Frontend-Modul generiert mit `member_grouped` folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_registration block">

    <form action="…" id="tl_registration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            
            <fieldset>
                <legend>Personendaten</legend>              
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
             </fieldset>
             
             <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
             </fieldset>
              
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Passwort ändern

Das Frontend-Modul »Passwort ändern« fügt der Webseite ein Formular hinzu, das einem angemeldeten Frontend-Benutzer 
ermöglicht, sein Passwort zu ändern.

**Frontend-Ausgabe**

<div class="mod_changePassword block">
    <form action="#" id="tl_change_password" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_oldpassword" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Altes Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Neues Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Passwort ändern</button>
            </div>
        </div>
    </form>
</div>

**Weiterleitungsseite:** Hier kannst du auswählen, auf welche Seite ein Mitglied nach dem Absenden der Änderungen 
weitergeleitet wird.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_changePassword` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_changePassword block">

    <form action="…" id="tl_change_password" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_change_password">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_oldpassword" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Altes Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Neues Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Passwort ändern</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Passwort vergessen

Das Frontend-Modul »Passwort vergessen« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied ein neues Passwort 
anfordern kann. Dazu verschickt Contao eine automatische E-Mail mit einem Bestätigungslink an die E-Mail-Adresse, die 
in dem jeweiligen Benutzerkonto gespeichert ist. Erst nach dem Anklicken dieses Bestätigungslinks ist die Eingabe eines 
neuen Passworts möglich.

**Frontend-Ausgabe**

<div class="mod_lostPassword block">
    <form action="#" id="tl_lost_password" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Neues Passwort anfordern</button>
            </div>
        </div>
    </form>
</div>

**Benutzernamen nicht abfragen:** Wenn du diese Option auswählst, wird der Benutzername bei der Anforderung nicht 
abgefragt.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Benutzer nach dem Anfordern eines neuen Passworts 
weitergeleitet wird.

**Bestätigungsseite:** Hier legst du fest, auf welche Seite ein Benutzer nach erfolgreicher Erstellung eines neuen 
Passworts weitergeleitet wird.

**Bestätigungsmail:** Gebe hier den Text der Bestätigungsmail ein. Du kannst Platzhalter im Format `##key##` für alle 
Benutzereigenschaften sowie die Platzhalter `##domain##` für die aktuelle Domain und `##link##` für den 
Bestätigungslink verwenden.

Eine Bestätigungsmail kann zum Beispiel wie folgt aussehen:

````text
Sehr geehrte(r) ##firstname## ##lastname##,

Sie haben ein neues Passwort für ##domain## angefordert.

Bitte klicken Sie auf den Link, um das neue Passwort festzulegen:

##link##

Wenn Sie diese E-Mail nicht angefordert haben, kontaktieren Sie bitte den Administrator der Webseite.

Ihr Administrator
````

**Individuelles Template:** Hier kannst du das Standard-Template `mod_lostPassword` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_lostPassword block">

    <form action="…" id="tl_lost_password" method="post">
        <div class="formbody">
        <input type="hidden" name="FORM_SUBMIT" value="tl_lost_password">
        <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Neues Passwort anfordern</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Konto schließen

Das Frontend-Modul »Konto schließen« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied sein Konto schließen 
kann. Je nach Konfiguration wird der Account dabei entweder nur deaktiviert oder komplett aus der Datenbank gelöscht.

**Frontend-Ausgabe**

<div class="mod_closeAccount block">
    <form action="#" id="tl_close_account" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Konto schließen</button>
            </div>
        </div>
    </form>
</div>

**Modus:** Hier legst du fest, ob das jeweilige Konto beim Absenden des Formulars lediglich deaktiviert oder komplett 
aus der Datenbank gelöscht werden soll.

**Weiterleitungsseite:**  Hier legst du fest, auf welche Seite ein Mitglied nach der Kontoschließung
weitergeleitet wird. Die Zielseite darf nicht geschützt sein.

**Individuelles Template:** Hier kannst du das Standard-Template `mod_closeAccount` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_closeAccount block">

    <form action="…" id="tl_close_account" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_close_account">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Konto schließen</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Zwei-Faktor-Authentifizierung

{{< version "4.8" >}}

Das Frontend-Modul »Zwei-Faktor-Authentifizierung« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied die 
Zwei-Faktor-Authentifizierung aktivieren kann. Wenn im Startpunkt einer Website die Zwei-Faktor-Authentifizierung für
Mitglieder erzwungen wird, muss dieses Modul auf der in der Seitenstruktur unter 
[Weitere Einstellungen bei Startpunkten](../../seitenstruktur/seiten-konfigurieren/#weitere-einstellungen-bei-startpunkten) 
ausgewählten Zwei-Faktor-Weiterleitungsseite hinzugefügt werden.

**Frontend-Ausgabe**

<div class="mod_two_factor two-factor block"> 
    <form action="#" class="tl_two_factor_form" method="post">
        <div class="formbody">
            <p class="error">Bitte aktivieren Sie die Zwei-Faktor-Authentifizierung bevor Sie fortfahren.</p>
            <p>Bitte scannen Sie den QR-Code mit Ihrer 2FA/TOTP-App.</p>
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjE4MCIgaGVpZ2h0PSIxODAiIHZpZXdCb3g9IjAgMCAxODAgMTgwIj48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTgwIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2ZlZmVmZSIvPjxnIHRyYW5zZm9ybT0ic2NhbGUoMi43NjkpIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDApIj48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04IDBMOCAxTDEwIDFMMTAgMkw4IDJMOCA1TDEwIDVMMTAgNEwxMSA0TDExIDZMMTAgNkwxMCA3TDkgN0w5IDZMOCA2TDggN0w5IDdMOSA4TDggOEw4IDEwTDYgMTBMNiAxMUw1IDExTDUgOUw0IDlMNCA4TDAgOEwwIDlMMSA5TDEgMTBMMCAxMEwwIDExTDEgMTFMMSAxMEwyIDEwTDIgMTJMMCAxMkwwIDE0TDIgMTRMMiAxNkwxIDE2TDEgMTdMMiAxN0wyIDE2TDMgMTZMMyAxN0w0IDE3TDQgMTlMMyAxOUwzIDIwTDUgMjBMNSAyMUw0IDIxTDQgMjJMMyAyMkwzIDIzTDIgMjNMMiAxOUwwIDE5TDAgMjFMMSAyMUwxIDIyTDAgMjJMMCAyM0wxIDIzTDEgMjRMMCAyNEwwIDI5TDEgMjlMMSAzMEwyIDMwTDIgMzFMMyAzMUwzIDMzTDIgMzNMMiAzMkwxIDMyTDEgMzFMMCAzMUwwIDMyTDEgMzJMMSAzNEwwIDM0TDAgMzZMMSAzNkwxIDM4TDIgMzhMMiAzN0w0IDM3TDQgMzlMMyAzOUwzIDQwTDIgNDBMMiA0MUwzIDQxTDMgNDJMMiA0MkwyIDQ0TDEgNDRMMSA0M0wwIDQzTDAgNDdMMSA0N0wxIDUwTDQgNTBMNCA1MUwyIDUxTDIgNTJMMyA1MkwzIDUzTDEgNTNMMSA1NEwyIDU0TDIgNTVMMyA1NUwzIDU2TDEgNTZMMSA1NUwwIDU1TDAgNTZMMSA1NkwxIDU3TDMgNTdMMyA1Nkw0IDU2TDQgNTdMNSA1N0w1IDU2TDQgNTZMNCA1NEw1IDU0TDUgNTVMNyA1NUw3IDU2TDYgNTZMNiA1N0w3IDU3TDcgNTZMOSA1Nkw5IDU3TDggNTdMOCA1OEw5IDU4TDkgNjBMMTAgNjBMMTAgNjFMMTEgNjFMMTEgNjJMMTIgNjJMMTIgNjBMMTAgNjBMMTAgNTlMMTEgNTlMMTEgNThMOSA1OEw5IDU3TDEwIDU3TDEwIDU1TDExIDU1TDExIDU3TDE0IDU3TDE0IDU5TDEzIDU5TDEzIDYwTDE0IDYwTDE0IDU5TDE2IDU5TDE2IDYwTDE3IDYwTDE3IDYxTDIwIDYxTDIwIDYyTDIxIDYyTDIxIDY0TDIwIDY0TDIwIDY1TDIyIDY1TDIyIDY0TDIzIDY0TDIzIDYzTDI0IDYzTDI0IDY0TDI1IDY0TDI1IDY1TDI3IDY1TDI3IDY0TDI4IDY0TDI4IDYzTDI5IDYzTDI5IDY0TDMwIDY0TDMwIDYxTDMxIDYxTDMxIDYyTDMyIDYyTDMyIDYxTDMzIDYxTDMzIDYyTDM1IDYyTDM1IDYxTDM2IDYxTDM2IDYyTDM3IDYyTDM3IDY1TDM4IDY1TDM4IDY0TDM5IDY0TDM5IDYzTDQwIDYzTDQwIDY0TDQzIDY0TDQzIDY1TDQ1IDY1TDQ1IDYyTDQ2IDYyTDQ2IDYzTDQ3IDYzTDQ3IDY0TDQ4IDY0TDQ4IDYyTDQ2IDYyTDQ2IDYxTDQ3IDYxTDQ3IDYwTDQ4IDYwTDQ4IDYxTDQ5IDYxTDQ5IDYzTDUwIDYzTDUwIDYyTDUxIDYyTDUxIDY1TDUyIDY1TDUyIDYzTDUzIDYzTDUzIDY1TDU0IDY1TDU0IDY0TDU1IDY0TDU1IDY1TDU5IDY1TDU5IDY0TDYxIDY0TDYxIDY1TDYyIDY1TDYyIDY0TDYxIDY0TDYxIDYzTDYwIDYzTDYwIDYyTDYyIDYyTDYyIDYzTDYzIDYzTDYzIDY1TDY0IDY1TDY0IDYzTDY1IDYzTDY1IDYyTDY0IDYyTDY0IDYzTDYzIDYzTDYzIDYxTDY0IDYxTDY0IDU4TDY1IDU4TDY1IDU2TDY0IDU2TDY0IDUzTDYzIDUzTDYzIDU1TDYyIDU1TDYyIDU0TDYwIDU0TDYwIDUzTDU5IDUzTDU5IDUyTDYwIDUyTDYwIDUwTDU5IDUwTDU5IDQ5TDYyIDQ5TDYyIDUwTDYzIDUwTDYzIDUxTDY0IDUxTDY0IDUyTDY1IDUyTDY1IDUwTDYzIDUwTDYzIDQ5TDY0IDQ5TDY0IDQ4TDY1IDQ4TDY1IDQ3TDY0IDQ3TDY0IDQ2TDYyIDQ2TDYyIDQ1TDYwIDQ1TDYwIDQ0TDU1IDQ0TDU1IDQ1TDU0IDQ1TDU0IDQzTDU3IDQzTDU3IDQyTDYwIDQyTDYwIDQzTDYxIDQzTDYxIDQ0TDYzIDQ0TDYzIDQyTDYyIDQyTDYyIDQzTDYxIDQzTDYxIDQyTDYwIDQyTDYwIDQxTDYxIDQxTDYxIDQwTDYyIDQwTDYyIDQxTDYzIDQxTDYzIDQwTDYyIDQwTDYyIDM5TDU5IDM5TDU5IDM3TDYxIDM3TDYxIDM2TDU5IDM2TDU5IDM3TDU4IDM3TDU4IDM4TDUzIDM4TDUzIDM3TDUyIDM3TDUyIDM4TDUzIDM4TDUzIDM5TDU1IDM5TDU1IDQwTDUzIDQwTDUzIDQxTDUyIDQxTDUyIDQwTDUwIDQwTDUwIDM4TDUxIDM4TDUxIDM2TDUwIDM2TDUwIDM1TDQ5IDM1TDQ5IDM2TDQ2IDM2TDQ2IDM1TDQ3IDM1TDQ3IDM0TDUwIDM0TDUwIDMzTDUyIDMzTDUyIDM0TDUxIDM0TDUxIDM1TDUyIDM1TDUyIDM2TDUzIDM2TDUzIDM1TDU0IDM1TDU0IDM3TDU1IDM3TDU1IDM2TDU2IDM2TDU2IDM3TDU3IDM3TDU3IDM1TDYxIDM1TDYxIDMzTDYyIDMzTDYyIDMyTDYzIDMyTDYzIDMwTDYyIDMwTDYyIDI5TDY0IDI5TDY0IDI4TDYyIDI4TDYyIDI3TDY1IDI3TDY1IDI0TDYzIDI0TDYzIDI1TDYyIDI1TDYyIDI0TDYxIDI0TDYxIDIzTDY0IDIzTDY0IDIyTDYzIDIyTDYzIDE5TDYxIDE5TDYxIDE3TDU4IDE3TDU4IDE1TDU3IDE1TDU3IDEzTDU5IDEzTDU5IDE0TDYwIDE0TDYwIDE1TDU5IDE1TDU5IDE2TDYyIDE2TDYyIDE3TDY0IDE3TDY0IDE4TDY1IDE4TDY1IDEzTDYzIDEzTDYzIDEyTDYyIDEyTDYyIDExTDYzIDExTDYzIDEwTDYyIDEwTDYyIDExTDYxIDExTDYxIDEyTDU3IDEyTDU3IDExTDU2IDExTDU2IDEyTDU1IDEyTDU1IDExTDU0IDExTDU0IDEyTDUzIDEyTDUzIDExTDUyIDExTDUyIDEwTDUxIDEwTDUxIDExTDUyIDExTDUyIDEyTDUzIDEyTDUzIDEzTDUwIDEzTDUwIDEwTDQ4IDEwTDQ4IDdMNDkgN0w0OSA5TDUzIDlMNTMgMTBMNTYgMTBMNTYgOEw1NyA4TDU3IDlMNTggOUw1OCA4TDU3IDhMNTcgNkw1NiA2TDU2IDhMNTUgOEw1NSA1TDU0IDVMNTQgN0w1MyA3TDUzIDVMNTIgNUw1MiA0TDUwIDRMNTAgMkw1MSAyTDUxIDNMNTMgM0w1MyAyTDU0IDJMNTQgNEw1NiA0TDU2IDVMNTcgNUw1NyA0TDU2IDRMNTYgM0w1NyAzTDU3IDFMNTYgMUw1NiAwTDU1IDBMNTUgMUw1NiAxTDU2IDNMNTUgM0w1NSAyTDU0IDJMNTQgMUw1MyAxTDUzIDBMNTIgMEw1MiAxTDUwIDFMNTAgMEw0OSAwTDQ5IDFMNTAgMUw1MCAyTDQ5IDJMNDkgM0w0OCAzTDQ4IDFMNDYgMUw0NiAwTDQ1IDBMNDUgMUw0NCAxTDQ0IDBMNDIgMEw0MiAxTDQxIDFMNDEgMEw0MCAwTDQwIDFMMzkgMUwzOSAyTDM4IDJMMzggMEwzNyAwTDM3IDFMMzYgMUwzNiAwTDM1IDBMMzUgMUwzNCAxTDM0IDBMMzMgMEwzMyAxTDMyIDFMMzIgMEwzMCAwTDMwIDJMMzEgMkwzMSA0TDI5IDRMMjkgNUwzMCA1TDMwIDhMMjggOEwyOCA5TDI5IDlMMjkgMTBMMjggMTBMMjggMTJMMjcgMTJMMjcgMTFMMjUgMTFMMjUgMTBMMjcgMTBMMjcgOUwyNSA5TDI1IDhMMTkgOEwxOSA2TDE4IDZMMTggOEwxNyA4TDE3IDZMMTYgNkwxNiA3TDE1IDdMMTUgNkwxNCA2TDE0IDdMMTUgN0wxNSA4TDE2IDhMMTYgOUwxNCA5TDE0IDhMMTMgOEwxMyA2TDEyIDZMMTIgNUwxNCA1TDE0IDRMMTYgNEwxNiAzTDE1IDNMMTUgMkwxNyAyTDE3IDNMMTggM0wxOCA0TDE5IDRMMTkgNUwyMSA1TDIxIDZMMjAgNkwyMCA3TDIxIDdMMjEgNkwyMiA2TDIyIDdMMjMgN0wyMyA1TDI0IDVMMjQgMUwyNSAxTDI1IDBMMjMgMEwyMyAyTDIxIDJMMjEgNEwyMCA0TDIwIDNMMTggM0wxOCAxTDIwIDFMMjAgMEwxNyAwTDE3IDFMMTYgMUwxNiAwTDE0IDBMMTQgMUwxMiAxTDEyIDBMMTEgMEwxMSAxTDEwIDFMMTAgMFpNMjEgMEwyMSAxTDIyIDFMMjIgMFpNMjYgMUwyNiAyTDI3IDJMMjcgNEwyNSA0TDI1IDVMMjcgNUwyNyA2TDI2IDZMMjYgN0wyNyA3TDI3IDZMMjggNkwyOCA3TDI5IDdMMjkgNkwyOCA2TDI4IDNMMjkgM0wyOSAxWk0zNSAxTDM1IDJMMzMgMkwzMyAzTDMyIDNMMzIgNEwzMyA0TDMzIDNMMzQgM0wzNCA0TDM1IDRMMzUgN0wzNiA3TDM2IDlMMzMgOUwzMyAxMkwzMiAxMkwzMiAxMEwzMSAxMEwzMSAxMUwzMCAxMUwzMCAxMkwyOCAxMkwyOCAxM0wzMCAxM0wzMCAxNUwzMSAxNUwzMSAxNEwzMiAxNEwzMiAxM0wzNCAxM0wzNCAxNEwzMyAxNEwzMyAxNUwzNCAxNUwzNCAxNEwzNSAxNEwzNSAxMkwzNiAxMkwzNiAxMUwzNyAxMUwzNyAxM0wzNiAxM0wzNiAxNUwzNSAxNUwzNSAxN0wzNiAxN0wzNiAxOEwzMyAxOEwzMyAxN0wzNCAxN0wzNCAxNkwzMyAxNkwzMyAxN0wzMiAxN0wzMiAxNkwzMSAxNkwzMSAxN0wyOSAxN0wyOSAxOEwzMCAxOEwzMCAxOUwyNSAxOUwyNSAxOEwyNiAxOEwyNiAxNkwyOCAxNkwyOCAxNUwyOSAxNUwyOSAxNEwyNyAxNEwyNyAxMkwyNSAxMkwyNSAxM0wyNiAxM0wyNiAxNEwyNyAxNEwyNyAxNUwyNCAxNUwyNCAxMkwyMyAxMkwyMyAxMEwyMiAxMEwyMiAxMkwyMCAxMkwyMCAxMUwyMSAxMUwyMSA5TDIwIDlMMjAgMTFMMTkgMTFMMTkgOEwxOCA4TDE4IDlMMTcgOUwxNyAxMEwxOCAxMEwxOCAxMkwxOSAxMkwxOSAxM0wxNyAxM0wxNyAxMUwxNiAxMUwxNiAxMEwxNSAxMEwxNSAxMUwxNCAxMUwxNCA5TDEzIDlMMTMgMTBMMTIgMTBMMTIgNkwxMSA2TDExIDdMMTAgN0wxMCA5TDkgOUw5IDEwTDggMTBMOCAxMUw2IDExTDYgMTJMNyAxMkw3IDEzTDMgMTNMMyAxMkwyIDEyTDIgMTRMNCAxNEw0IDE2TDUgMTZMNSAxNEw3IDE0TDcgMTNMOCAxM0w4IDEyTDEwIDEyTDEwIDE0TDggMTRMOCAxNUwxMCAxNUwxMCAxNEwxMSAxNEwxMSAxM0wxMiAxM0wxMiAxNEwxMyAxNEwxMyAxNUwxNCAxNUwxNCAxM0wxNSAxM0wxNSAxMkwxNiAxMkwxNiAxNEwxNSAxNEwxNSAxNkwxMiAxNkwxMiAxN0wxNSAxN0wxNSAxNkwxNiAxNkwxNiAxOEwxMiAxOEwxMiAxOUwxMyAxOUwxMyAyMEwxNCAyMEwxNCAyMUwxNSAyMUwxNSAyM0wxNCAyM0wxNCAyMkwxMyAyMkwxMyAyMUwxMiAyMUwxMiAyMkw5IDIyTDkgMjFMMTEgMjFMMTEgMjBMOSAyMEw5IDE5TDExIDE5TDExIDE4TDEwIDE4TDEwIDE3TDExIDE3TDExIDE2TDkgMTZMOSAxN0w4IDE3TDggMThMOSAxOEw5IDE5TDYgMTlMNiAxOEw3IDE4TDcgMTdMNSAxN0w1IDE5TDYgMTlMNiAyMEw3IDIwTDcgMjFMNSAyMUw1IDIyTDcgMjJMNyAyM0w1IDIzTDUgMjRMNCAyNEw0IDIzTDMgMjNMMyAyNEwyIDI0TDIgMjVMMSAyNUwxIDI2TDIgMjZMMiAyN0wxIDI3TDEgMjhMMiAyOEwyIDI3TDMgMjdMMyAyOEw0IDI4TDQgMzBMOCAzMEw4IDI4TDkgMjhMOSAyN0wxMCAyN0wxMCAyNkw5IDI2TDkgMjdMNiAyN0w2IDI2TDcgMjZMNyAyNUw2IDI1TDYgMjRMNyAyNEw3IDIzTDggMjNMOCAyNUwxMSAyNUwxMSAyM0wxMiAyM0wxMiAyNEwxMyAyNEwxMyAyNUwxMiAyNUwxMiAyNkwxNSAyNkwxNSAyN0wxMyAyN0wxMyAyOUwxNSAyOUwxNSAzMEwxMyAzMEwxMyAzMUwxMiAzMUwxMiAzMkwxMSAzMkwxMSAzM0wxMiAzM0wxMiAzMkwxNCAzMkwxNCAzMUwxNSAzMUwxNSAzMkwxNyAzMkwxNyAzMUwxOCAzMUwxOCAzM0wxOSAzM0wxOSAzMkwyMCAzMkwyMCAzNUwyMyAzNUwyMyAzNkwyMiAzNkwyMiAzOUwyMCAzOUwyMCA0MEwxOCA0MEwxOCAzOUwxNyAzOUwxNyAzOEwxOSAzOEwxOSAzN0wxOCAzN0wxOCAzNkwxOSAzNkwxOSAzNEwxOCAzNEwxOCAzNkwxNyAzNkwxNyAzM0wxNSAzM0wxNSAzNUwxNCAzNUwxNCAzNEwxMyAzNEwxMyAzNUwxNCAzNUwxNCAzNkwxMiAzNkwxMiAzOEwxMSAzOEwxMSAzNEwxMCAzNEwxMCAzMkw5IDMyTDkgMzZMOCAzNkw4IDM1TDYgMzVMNiAzNkw3IDM2TDcgMzdMNiAzN0w2IDM4TDggMzhMOCAzN0w5IDM3TDkgNDBMMTAgNDBMMTAgNDFMMTIgNDFMMTIgNDJMMTEgNDJMMTEgNDNMMTMgNDNMMTMgNDRMMTQgNDRMMTQgNDVMMTMgNDVMMTMgNDZMMTEgNDZMMTEgNDdMMTAgNDdMMTAgNDhMOCA0OEw4IDQ3TDkgNDdMOSA0NUwxMSA0NUwxMSA0NEwxMCA0NEwxMCA0Mkw5IDQyTDkgNDFMOCA0MUw4IDM5TDUgMzlMNSA0MEwzIDQwTDMgNDFMNCA0MUw0IDQ0TDUgNDRMNSA0Nkw0IDQ2TDQgNDVMMyA0NUwzIDQ2TDIgNDZMMiA0OEwzIDQ4TDMgNDlMNSA0OUw1IDUxTDYgNTFMNiA1Mkw4IDUyTDggNTFMNiA1MUw2IDUwTDggNTBMOCA0OUwxMSA0OUwxMSA0OEwxMiA0OEwxMiA1MEwxMSA1MEwxMSA1MUwxNCA1MUwxNCA1MkwxMyA1MkwxMyA1M0wxNCA1M0wxNCA1MkwxNyA1MkwxNyA1NEwxOCA1NEwxOCA1NUwxNSA1NUwxNSA1NkwxNCA1NkwxNCA1NEwxMiA1NEwxMiA1MkwxMCA1MkwxMCA1NEw5IDU0TDkgNTNMOCA1M0w4IDU0TDcgNTRMNyA1M0w2IDUzTDYgNTRMNyA1NEw3IDU1TDggNTVMOCA1NEw5IDU0TDkgNTVMMTAgNTVMMTAgNTRMMTEgNTRMMTEgNTVMMTIgNTVMMTIgNTZMMTQgNTZMMTQgNTdMMTUgNTdMMTUgNThMMTcgNThMMTcgNTlMMjAgNTlMMjAgNThMMjEgNThMMjEgNTlMMjIgNTlMMjIgNTZMMjMgNTZMMjMgNTdMMjQgNTdMMjQgNTZMMjUgNTZMMjUgNTVMMjQgNTVMMjQgNTRMMjUgNTRMMjUgNTNMMjQgNTNMMjQgNTBMMjUgNTBMMjUgNTJMMjYgNTJMMjYgNTdMMjUgNTdMMjUgNTlMMjYgNTlMMjYgNjFMMjcgNjFMMjcgNjJMMjUgNjJMMjUgNjFMMjQgNjFMMjQgNjNMMjUgNjNMMjUgNjRMMjcgNjRMMjcgNjJMMjkgNjJMMjkgNjBMMzAgNjBMMzAgNTlMMjkgNTlMMjkgNjBMMjggNjBMMjggNThMMjkgNThMMjkgNTdMMjggNTdMMjggNTZMMjkgNTZMMjkgNTRMMzAgNTRMMzAgNTNMMjkgNTNMMjkgNTJMMzAgNTJMMzAgNTBMMzEgNTBMMzEgNDhMMzIgNDhMMzIgNDlMMzQgNDlMMzQgNTBMMzUgNTBMMzUgNDdMMzYgNDdMMzYgNDZMMzUgNDZMMzUgNDRMMzQgNDRMMzQgNDNMMzUgNDNMMzUgNDJMMzcgNDJMMzcgNDRMMzYgNDRMMzYgNDVMMzcgNDVMMzcgNDZMMzggNDZMMzggNDhMMzkgNDhMMzkgNTFMNDAgNTFMNDAgNTNMMzkgNTNMMzkgNTJMMzUgNTJMMzUgNTFMMzQgNTFMMzQgNTJMMzUgNTJMMzUgNTNMMzQgNTNMMzQgNTRMMzMgNTRMMzMgNTNMMzEgNTNMMzEgNTVMMzIgNTVMMzIgNTRMMzMgNTRMMzMgNTVMMzQgNTVMMzQgNTZMMzYgNTZMMzYgNTdMMzcgNTdMMzcgNTRMNDAgNTRMNDAgNTNMNDEgNTNMNDEgNTFMNDIgNTFMNDIgNTJMNDUgNTJMNDUgNTBMNDQgNTBMNDQgNDlMNDUgNDlMNDUgNDhMNDMgNDhMNDMgNDZMNDQgNDZMNDQgNDdMNDUgNDdMNDUgNDZMNDYgNDZMNDYgNDdMNDcgNDdMNDcgNDZMNDggNDZMNDggNDdMNTAgNDdMNTAgNDZMNTEgNDZMNTEgNDhMNTAgNDhMNTAgNDlMNTEgNDlMNTEgNTFMNTAgNTFMNTAgNTBMNDggNTBMNDggNDlMNDcgNDlMNDcgNDhMNDYgNDhMNDYgNTJMNDcgNTJMNDcgNTFMNDggNTFMNDggNTNMNDcgNTNMNDcgNTVMNDggNTVMNDggNThMNDcgNThMNDcgNTZMNDYgNTZMNDYgNTVMNDQgNTVMNDQgNTdMNDUgNTdMNDUgNjBMNDQgNjBMNDQgNjJMNDMgNjJMNDMgNjBMNDIgNjBMNDIgNTlMNDMgNTlMNDMgNThMNDEgNThMNDEgNTdMMzggNTdMMzggNThMNDAgNThMNDAgNTlMMzcgNTlMMzcgNThMMzYgNThMMzYgNTlMMzUgNTlMMzUgNjBMMzYgNjBMMzYgNTlMMzcgNTlMMzcgNjBMMzggNjBMMzggNjFMMzkgNjFMMzkgNjJMMzggNjJMMzggNjNMMzkgNjNMMzkgNjJMNDAgNjJMNDAgNjNMNDQgNjNMNDQgNjJMNDUgNjJMNDUgNjBMNDYgNjBMNDYgNTlMNDkgNTlMNDkgNTdMNTAgNTdMNTAgNThMNTIgNThMNTIgNjBMNTEgNjBMNTEgNTlMNTAgNTlMNTAgNjFMNTEgNjFMNTEgNjJMNTMgNjJMNTMgNjNMNTUgNjNMNTUgNjRMNTcgNjRMNTcgNjNMNTggNjNMNTggNjRMNTkgNjRMNTkgNjNMNTggNjNMNTggNjJMNjAgNjJMNjAgNjFMNTggNjFMNTggNjJMNTcgNjJMNTcgNjFMNTYgNjFMNTYgNTdMNTUgNTdMNTUgNTZMNTMgNTZMNTMgNTFMNTUgNTFMNTUgNTBMNTcgNTBMNTcgNDlMNTggNDlMNTggNDhMNTUgNDhMNTUgNDlMNTMgNDlMNTMgNDhMNTQgNDhMNTQgNDdMNTYgNDdMNTYgNDZMNTggNDZMNTggNDdMNjAgNDdMNjAgNDhMNjIgNDhMNjIgNDlMNjMgNDlMNjMgNDdMNjEgNDdMNjEgNDZMNTkgNDZMNTkgNDVMNTYgNDVMNTYgNDZMNTMgNDZMNTMgNDVMNTIgNDVMNTIgNDNMNTQgNDNMNTQgNDJMNTYgNDJMNTYgNDFMNTcgNDFMNTcgNDBMNTUgNDBMNTUgNDFMNTQgNDFMNTQgNDJMNTIgNDJMNTIgNDNMNTEgNDNMNTEgNDVMNTAgNDVMNTAgNDZMNDkgNDZMNDkgNDBMNDggNDBMNDggMzlMNDkgMzlMNDkgMzhMNDggMzhMNDggMzlMNDcgMzlMNDcgMzdMNDYgMzdMNDYgMzhMNDUgMzhMNDUgMzlMNDIgMzlMNDIgMzhMNDMgMzhMNDMgMzdMNDIgMzdMNDIgMzVMNDMgMzVMNDMgMzZMNDQgMzZMNDQgMzdMNDUgMzdMNDUgMzVMNDMgMzVMNDMgMzRMNDIgMzRMNDIgMzVMNDEgMzVMNDEgMzRMNDAgMzRMNDAgMzVMNDEgMzVMNDEgMzZMMzkgMzZMMzkgMzlMMzggMzlMMzggNDBMMzkgNDBMMzkgNDFMMzcgNDFMMzcgNDBMMzUgNDBMMzUgMzlMMzcgMzlMMzcgMzhMMzggMzhMMzggMzZMMzcgMzZMMzcgMzVMMzkgMzVMMzkgMzNMMzggMzNMMzggMzRMMzYgMzRMMzYgMzNMMzcgMzNMMzcgMzJMMzYgMzJMMzYgMzNMMzUgMzNMMzUgMzVMMzYgMzVMMzYgMzZMMzcgMzZMMzcgMzhMMzYgMzhMMzYgMzdMMzUgMzdMMzUgMzZMMzQgMzZMMzQgMzdMMzUgMzdMMzUgMzlMMzQgMzlMMzQgNDBMMzMgNDBMMzMgMzlMMzEgMzlMMzEgMzhMMzAgMzhMMzAgMzlMMjkgMzlMMjkgNDJMMzAgNDJMMzAgNDFMMzEgNDFMMzEgNDNMMzMgNDNMMzMgNDVMMzIgNDVMMzIgNDZMMzEgNDZMMzEgNDhMMzAgNDhMMzAgNDlMMjkgNDlMMjkgNDdMMjggNDdMMjggNDRMMzAgNDRMMzAgNDVMMjkgNDVMMjkgNDZMMzAgNDZMMzAgNDVMMzEgNDVMMzEgNDRMMzAgNDRMMzAgNDNMMjggNDNMMjggNDRMMjYgNDRMMjYgNDNMMjcgNDNMMjcgNDJMMjggNDJMMjggNDBMMjcgNDBMMjcgNDJMMjYgNDJMMjYgNDFMMjQgNDFMMjQgNDRMMjMgNDRMMjMgNDNMMjAgNDNMMjAgNDJMMjEgNDJMMjEgNDFMMjIgNDFMMjIgNDJMMjMgNDJMMjMgNDBMMjQgNDBMMjQgMzhMMjUgMzhMMjUgMzlMMjcgMzlMMjcgMzhMMjUgMzhMMjUgMzdMMjggMzdMMjggMzhMMjkgMzhMMjkgMzdMMzAgMzdMMzAgMzZMMzEgMzZMMzEgMzdMMzMgMzdMMzMgMzVMMjkgMzVMMjkgMzZMMjggMzZMMjggMzRMMzAgMzRMMzAgMzJMMjkgMzJMMjkgMzFMMzAgMzFMMzAgMzBMMjggMzBMMjggMjlMMzEgMjlMMzEgMzBMMzMgMzBMMzMgMjlMMzYgMjlMMzYgMzBMMzUgMzBMMzUgMzFMMzcgMzFMMzcgMzBMMzggMzBMMzggMzJMMzkgMzJMMzkgMjlMMzggMjlMMzggMjhMMzkgMjhMMzkgMjZMMzggMjZMMzggMjdMMzcgMjdMMzcgMjVMMzggMjVMMzggMjRMMzcgMjRMMzcgMjNMMzkgMjNMMzkgMjVMNDEgMjVMNDEgMjZMNDIgMjZMNDIgMjdMNDMgMjdMNDMgMjhMNDAgMjhMNDAgMzFMNDIgMzFMNDIgMzJMNDEgMzJMNDEgMzNMNDIgMzNMNDIgMzJMNDMgMzJMNDMgMzFMNDIgMzFMNDIgMzBMNDMgMzBMNDMgMjhMNDQgMjhMNDQgMjZMNDUgMjZMNDUgMjhMNDYgMjhMNDYgMjlMNDcgMjlMNDcgMzBMNDYgMzBMNDYgMzFMNDUgMzFMNDUgMjlMNDQgMjlMNDQgMzRMNDcgMzRMNDcgMzNMNDYgMzNMNDYgMzFMNDcgMzFMNDcgMzBMNDggMzBMNDggMjlMNDkgMjlMNDkgMjhMNTAgMjhMNTAgMzBMNTEgMzBMNTEgMzJMNTMgMzJMNTMgMzNMNTQgMzNMNTQgMzJMNTMgMzJMNTMgMzFMNTQgMzFMNTQgMzBMNTggMzBMNTggMjlMNTYgMjlMNTYgMjhMNTggMjhMNTggMjZMNTkgMjZMNTkgMjlMNjEgMjlMNjEgMjhMNjAgMjhMNjAgMjdMNjEgMjdMNjEgMjZMNjAgMjZMNjAgMjRMNTkgMjRMNTkgMjJMNjAgMjJMNjAgMjFMNjIgMjFMNjIgMjBMNjAgMjBMNjAgMTlMNTkgMTlMNTkgMThMNTggMThMNTggMjBMNTcgMjBMNTcgMjFMNTYgMjFMNTYgMjBMNTUgMjBMNTUgMjFMNTYgMjFMNTYgMjJMNTUgMjJMNTUgMjNMNTMgMjNMNTMgMjRMNTEgMjRMNTEgMjNMNTIgMjNMNTIgMjJMNTEgMjJMNTEgMjFMNTIgMjFMNTIgMjBMNDkgMjBMNDkgMTlMNTAgMTlMNTAgMThMNTMgMThMNTMgMTdMNTQgMTdMNTQgMThMNTUgMThMNTUgMTlMNTcgMTlMNTcgMTdMNTYgMTdMNTYgMTZMNTcgMTZMNTcgMTVMNTUgMTVMNTUgMTNMNTMgMTNMNTMgMTVMNTIgMTVMNTIgMTRMNTEgMTRMNTEgMTVMNTIgMTVMNTIgMTdMNTAgMTdMNTAgMThMNDkgMThMNDkgMTZMNTAgMTZMNTAgMTNMNDkgMTNMNDkgMTRMNDggMTRMNDggMTNMNDcgMTNMNDcgOUw0NSA5TDQ1IDhMNDYgOEw0NiA2TDQ3IDZMNDcgN0w0OCA3TDQ4IDZMNDkgNkw0OSA3TDUwIDdMNTAgOEw1MyA4TDUzIDlMNTQgOUw1NCA4TDUzIDhMNTMgN0w1MiA3TDUyIDZMNTEgNkw1MSA3TDUwIDdMNTAgNkw0OSA2TDQ5IDVMNTAgNUw1MCA0TDQ5IDRMNDkgNUw0NyA1TDQ3IDRMNDYgNEw0NiAzTDQ0IDNMNDQgMUw0MyAxTDQzIDNMNDIgM0w0MiA1TDQzIDVMNDMgN0w0MiA3TDQyIDZMNDEgNkw0MSAzTDM4IDNMMzggMkwzNiAyTDM2IDFaTTQwIDFMNDAgMkw0MSAyTDQxIDFaTTEwIDJMMTAgM0w5IDNMOSA0TDEwIDRMMTAgM0wxMSAzTDExIDRMMTIgNEwxMiAzTDExIDNMMTEgMlpNMTMgMkwxMyA0TDE0IDRMMTQgMlpNMzUgMkwzNSA0TDM2IDRMMzYgNUwzNyA1TDM3IDNMMzYgM0wzNiAyWk0yMiAzTDIyIDVMMjMgNUwyMyAzWk0zOCA0TDM4IDhMMzcgOEwzNyAxMUw0MSAxMUw0MSAxMkw0MiAxMkw0MiAxM0w0MyAxM0w0MyAxNUw0MSAxNUw0MSAxNEw0MCAxNEw0MCAxM0wzNyAxM0wzNyAxNEw0MCAxNEw0MCAxNkwzOSAxNkwzOSAxOEwzOCAxOEwzOCAxNUwzNyAxNUwzNyAxOEwzNiAxOEwzNiAyMEwzNyAyMEwzNyAyMkwzOCAyMkwzOCAyMUwzOSAyMUwzOSAyMkw0MCAyMkw0MCAyNEw0MSAyNEw0MSAyNUw0MiAyNUw0MiAyM0w0MyAyM0w0MyAyMUw0MiAyMUw0MiAyM0w0MSAyM0w0MSAyMEwzNyAyMEwzNyAxOEwzOCAxOEwzOCAxOUwzOSAxOUwzOSAxOEw0MCAxOEw0MCAxNkw0MyAxNkw0MyAxN0w0NCAxN0w0NCAxOEw0NSAxOEw0NSAxOUw0NCAxOUw0NCAyMEw0NSAyMEw0NSAyMUw0NCAyMUw0NCAyMkw0NiAyMkw0NiAyM0w0NCAyM0w0NCAyNEw0NSAyNEw0NSAyNkw0NiAyNkw0NiAyN0w0NyAyN0w0NyAyOEw0OCAyOEw0OCAyN0w0NyAyN0w0NyAyNkw1MSAyNkw1MSAyN0w1MiAyN0w1MiAyOEw1MyAyOEw1MyAyN0w1NCAyN0w1NCAyNkw1MSAyNkw1MSAyNUw1MCAyNUw1MCAyNEw0NyAyNEw0NyAyMkw0NiAyMkw0NiAxOUw0OSAxOUw0OSAxOEw0OCAxOEw0OCAxN0w0NiAxN0w0NiAxNkw0OCAxNkw0OCAxNEw0NiAxNEw0NiAxM0w0NCAxM0w0NCAxMkw0NSAxMkw0NSA5TDQ0IDlMNDQgMTBMNDMgMTBMNDMgOEw0NSA4TDQ1IDZMNDYgNkw0NiA0TDQ0IDRMNDQgN0w0MyA3TDQzIDhMNDIgOEw0MiA5TDQxIDlMNDEgOEw0MCA4TDQwIDdMNDEgN0w0MSA2TDQwIDZMNDAgNUwzOSA1TDM5IDRaTTMxIDVMMzEgOEwzNCA4TDM0IDVaTTI0IDZMMjQgN0wyNSA3TDI1IDZaTTMyIDZMMzIgN0wzMyA3TDMzIDZaTTM2IDZMMzYgN0wzNyA3TDM3IDZaTTM5IDZMMzkgN0w0MCA3TDQwIDZaTTYgOEw2IDlMNyA5TDcgOFpNNjAgOEw2MCA5TDU5IDlMNTkgMTBMNjEgMTBMNjEgOUw2MyA5TDYzIDhaTTY0IDhMNjQgMTBMNjUgMTBMNjUgOFpNMzggOUwzOCAxMEw0MSAxMEw0MSAxMUw0MiAxMUw0MiAxMkw0MyAxMkw0MyAxMEw0MSAxMEw0MSA5Wk0zIDEwTDMgMTFMNCAxMUw0IDEwWk05IDEwTDkgMTFMMTAgMTFMMTAgMTJMMTEgMTJMMTEgMTBaTTEzIDExTDEzIDEyTDEyIDEyTDEyIDEzTDE0IDEzTDE0IDExWk02NCAxMUw2NCAxMkw2NSAxMkw2NSAxMVpNMzAgMTJMMzAgMTNMMzEgMTNMMzEgMTJaTTU2IDEyTDU2IDEzTDU3IDEzTDU3IDEyWk0xOSAxM0wxOSAxNUwxOCAxNUwxOCAxNEwxNyAxNEwxNyAxNUwxOCAxNUwxOCAxNkwxOSAxNkwxOSAxOEwyMCAxOEwyMCAxOUwyMSAxOUwyMSAxOEwyMCAxOEwyMCAxNkwyMSAxNkwyMSAxN0wyMiAxN0wyMiAyMEwyMSAyMEwyMSAyMkwyMiAyMkwyMiAyMEwyMyAyMEwyMyAyMUwyNCAyMUwyNCAyMkwyMyAyMkwyMyAyM0wyMSAyM0wyMSAyNEwyMCAyNEwyMCAyMEwxOSAyMEwxOSAxOUwxOCAxOUwxOCAxOEwxNyAxOEwxNyAyMEwxNiAyMEwxNiAyM0wxNSAyM0wxNSAyNEwxNiAyNEwxNiAyNUwxNyAyNUwxNyAyNkwxNiAyNkwxNiAyN0wxNyAyN0wxNyAyOEwxOSAyOEwxOSAzMUwyMCAzMUwyMCAzMkwyMSAzMkwyMSAzM0wyMyAzM0wyMyAzNUwyNCAzNUwyNCAzN0wyNSAzN0wyNSAzNUwyNCAzNUwyNCAzNEwyNiAzNEwyNiAzNUwyNyAzNUwyNyAzNEwyNiAzNEwyNiAzM0wyMyAzM0wyMyAzMkwyNCAzMkwyNCAzMUwyNSAzMUwyNSAzMkwyNyAzMkwyNyAzM0wyOSAzM0wyOSAzMkwyNyAzMkwyNyAzMUwyNiAzMUwyNiAzMEwyMyAzMEwyMyAyOUwyMiAyOUwyMiAyOEwyMSAyOEwyMSAyN0wyMCAyN0wyMCAyNkwyMSAyNkwyMSAyNEwyNSAyNEwyNSAyNkwyMyAyNkwyMyAyNUwyMiAyNUwyMiAyN0wyMyAyN0wyMyAyOEwyNCAyOEwyNCAyN0wyNSAyN0wyNSAyOUwyOCAyOUwyOCAyOEwyNyAyOEwyNyAyN0wyOSAyN0wyOSAyOEwzMSAyOEwzMSAyOUwzMyAyOUwzMyAyOEwzMSAyOEwzMSAyN0wzMCAyN0wzMCAyNkwzMiAyNkwzMiAyN0wzMyAyN0wzMyAyNkwzNCAyNkwzNCAyNEwzNSAyNEwzNSAyNUwzNyAyNUwzNyAyNEwzNiAyNEwzNiAyM0wzNSAyM0wzNSAyMkwzNiAyMkwzNiAyMUwzNSAyMUwzNSAyMEwzNCAyMEwzNCAxOUwzMyAxOUwzMyAxOEwzMiAxOEwzMiAxOUwzMyAxOUwzMyAyMEwzNCAyMEwzNCAyMUwzMyAyMUwzMyAyMkwzMiAyMkwzMiAyM0wzMSAyM0wzMSAyMUwzMiAyMUwzMiAyMEwzMSAyMEwzMSAyMUwzMCAyMUwzMCAyM0wyOSAyM0wyOSAyNEwyOCAyNEwyOCAyNUwyOSAyNUwyOSAyNkwyNyAyNkwyNyAyN0wyNSAyN0wyNSAyNkwyNiAyNkwyNiAyNEwyNyAyNEwyNyAyMkwyNSAyMkwyNSAxOUwyNCAxOUwyNCAxN0wyMiAxN0wyMiAxNkwyMSAxNkwyMSAxNUwyMyAxNUwyMyAxNkwyNCAxNkwyNCAxNUwyMyAxNUwyMyAxNEwyMiAxNEwyMiAxM0wyMSAxM0wyMSAxNEwyMCAxNEwyMCAxM1pNNjAgMTNMNjAgMTRMNjEgMTRMNjEgMTVMNjIgMTVMNjIgMTZMNjQgMTZMNjQgMTVMNjMgMTVMNjMgMTRMNjEgMTRMNjEgMTNaTTQ0IDE0TDQ0IDE1TDQzIDE1TDQzIDE2TDQ2IDE2TDQ2IDE0Wk02IDE1TDYgMTZMNyAxNkw3IDE1Wk01MyAxNUw1MyAxNkw1NCAxNkw1NCAxN0w1NSAxN0w1NSAxNkw1NCAxNkw1NCAxNVpNMjcgMTdMMjcgMThMMjggMThMMjggMTdaTTQxIDE4TDQxIDE5TDQyIDE5TDQyIDE4Wk0xNCAxOUwxNCAyMEwxNSAyMEwxNSAxOVpNMjMgMTlMMjMgMjBMMjQgMjBMMjQgMTlaTTUzIDE5TDUzIDIwTDU0IDIwTDU0IDE5Wk02NCAxOUw2NCAyMUw2NSAyMUw2NSAxOVpNMjYgMjBMMjYgMjFMMjcgMjFMMjcgMjBaTTI4IDIwTDI4IDIxTDI5IDIxTDI5IDIwWk00NyAyMEw0NyAyMUw0OCAyMUw0OCAyMFpNNTggMjBMNTggMjFMNTkgMjFMNTkgMjBaTTcgMjFMNyAyMkw4IDIyTDggMjNMOSAyM0w5IDI0TDEwIDI0TDEwIDIzTDkgMjNMOSAyMkw4IDIyTDggMjFaTTE3IDIxTDE3IDIyTDE4IDIyTDE4IDI0TDE5IDI0TDE5IDI1TDIwIDI1TDIwIDI0TDE5IDI0TDE5IDIyTDE4IDIyTDE4IDIxWk0zNCAyMUwzNCAyMkwzNSAyMkwzNSAyMVpNMjQgMjJMMjQgMjNMMjUgMjNMMjUgMjRMMjYgMjRMMjYgMjNMMjUgMjNMMjUgMjJaTTQ4IDIyTDQ4IDIzTDUwIDIzTDUwIDIyWk01NiAyMkw1NiAyM0w1NyAyM0w1NyAyMlpNMTMgMjNMMTMgMjRMMTQgMjRMMTQgMjNaTTE2IDIzTDE2IDI0TDE3IDI0TDE3IDIzWk0zMCAyM0wzMCAyNEwzMSAyNEwzMSAyM1pNMzMgMjNMMzMgMjRMMzIgMjRMMzIgMjZMMzMgMjZMMzMgMjRMMzQgMjRMMzQgMjNaTTU0IDI0TDU0IDI1TDU1IDI1TDU1IDI4TDU0IDI4TDU0IDI5TDUxIDI5TDUxIDMwTDU0IDMwTDU0IDI5TDU1IDI5TDU1IDI4TDU2IDI4TDU2IDI2TDU4IDI2TDU4IDI1TDU5IDI1TDU5IDI0TDU3IDI0TDU3IDI1TDU1IDI1TDU1IDI0Wk0yIDI1TDIgMjZMMyAyNkwzIDI3TDQgMjdMNCAyOEw1IDI4TDUgMjlMNyAyOUw3IDI4TDYgMjhMNiAyN0w0IDI3TDQgMjVaTTUgMjVMNSAyNkw2IDI2TDYgMjVaTTQzIDI1TDQzIDI2TDQ0IDI2TDQ0IDI1Wk00NiAyNUw0NiAyNkw0NyAyNkw0NyAyNVpNMTggMjZMMTggMjdMMTkgMjdMMTkgMjZaTTM1IDI2TDM1IDI3TDM0IDI3TDM0IDI4TDM2IDI4TDM2IDI2Wk0xMSAyOEwxMSAyOUwxMCAyOUwxMCAzMUwxMSAzMUwxMSAzMEwxMiAzMEwxMiAyOFpNMTUgMjhMMTUgMjlMMTYgMjlMMTYgMzBMMTggMzBMMTggMjlMMTYgMjlMMTYgMjhaTTIwIDI5TDIwIDMxTDIxIDMxTDIxIDMyTDIzIDMyTDIzIDMxTDIxIDMxTDIxIDI5Wk00MSAyOUw0MSAzMEw0MiAzMEw0MiAyOVpNNjEgMzBMNjEgMzFMNjIgMzFMNjIgMzBaTTUgMzFMNSAzNEw4IDM0TDggMzFaTTMxIDMxTDMxIDM0TDM0IDM0TDM0IDMxWk01NyAzMUw1NyAzNEw2MCAzNEw2MCAzMVpNNjQgMzFMNjQgMzNMNjUgMzNMNjUgMzFaTTYgMzJMNiAzM0w3IDMzTDcgMzJaTTMyIDMyTDMyIDMzTDMzIDMzTDMzIDMyWk00OCAzMkw0OCAzM0w0OSAzM0w0OSAzMlpNNTggMzJMNTggMzNMNTkgMzNMNTkgMzJaTTMgMzNMMyAzNEwyIDM0TDIgMzVMMSAzNUwxIDM2TDMgMzZMMyAzNUw0IDM1TDQgMzNaTTUyIDM0TDUyIDM1TDUzIDM1TDUzIDM0Wk01NCAzNEw1NCAzNUw1NiAzNUw1NiAzNFpNNjIgMzRMNjIgMzVMNjMgMzVMNjMgMzZMNjIgMzZMNjIgMzdMNjMgMzdMNjMgMzlMNjQgMzlMNjQgNDBMNjUgNDBMNjUgMzhMNjQgMzhMNjQgMzdMNjUgMzdMNjUgMzZMNjQgMzZMNjQgMzRaTTQgMzZMNCAzN0w1IDM3TDUgMzZaTTE0IDM2TDE0IDM3TDE1IDM3TDE1IDM4TDE2IDM4TDE2IDM2Wk0yMCAzNkwyMCAzN0wyMSAzN0wyMSAzNlpNNDkgMzZMNDkgMzdMNTAgMzdMNTAgMzZaTTYzIDM2TDYzIDM3TDY0IDM3TDY0IDM2Wk00MCAzN0w0MCA0MEw0MSA0MEw0MSAzOEw0MiAzOEw0MiAzN1pNMTAgMzhMMTAgMzlMMTEgMzlMMTEgNDBMMTQgNDBMMTQgMzlMMTMgMzlMMTMgMzhMMTIgMzhMMTIgMzlMMTEgMzlMMTEgMzhaTTIyIDM5TDIyIDQwTDIzIDQwTDIzIDM5Wk0zMCAzOUwzMCA0MEwzMSA0MEwzMSA0MUwzMiA0MUwzMiA0MEwzMSA0MEwzMSAzOVpNNDUgMzlMNDUgNDBMNDMgNDBMNDMgNDJMNDIgNDJMNDIgNDFMNDEgNDFMNDEgNDJMNDAgNDJMNDAgNDFMMzkgNDFMMzkgNDJMNDAgNDJMNDAgNDRMMzkgNDRMMzkgNDNMMzggNDNMMzggNDRMMzkgNDRMMzkgNDVMNDAgNDVMNDAgNDZMMzkgNDZMMzkgNDdMNDAgNDdMNDAgNDhMNDIgNDhMNDIgNDdMNDEgNDdMNDEgNDZMNDMgNDZMNDMgNDVMNDIgNDVMNDIgNDNMNDMgNDNMNDMgNDRMNDQgNDRMNDQgNDNMNDMgNDNMNDMgNDJMNDcgNDJMNDcgNDFMNDYgNDFMNDYgMzlaTTU4IDM5TDU4IDQxTDU5IDQxTDU5IDM5Wk01IDQwTDUgNDJMNiA0Mkw2IDQzTDcgNDNMNyA0NEw2IDQ0TDYgNDVMNyA0NUw3IDQ0TDggNDRMOCA0NUw5IDQ1TDkgNDRMOCA0NEw4IDQzTDkgNDNMOSA0Mkw4IDQyTDggNDFMNyA0MUw3IDQwWk0xNiA0MEwxNiA0MUwxNSA0MUwxNSA0MkwxNCA0MkwxNCA0MUwxMyA0MUwxMyA0MkwxNCA0MkwxNCA0NEwxNiA0NEwxNiA0N0wxNCA0N0wxNCA0NkwxMyA0NkwxMyA0N0wxNCA0N0wxNCA0OEwxNiA0OEwxNiA0N0wxOCA0N0wxOCA0OEwxNyA0OEwxNyA1MUwxOSA1MUwxOSA1MkwxOCA1MkwxOCA1M0wxOSA1M0wxOSA1NUwxOCA1NUwxOCA1NkwxNyA1NkwxNyA1OEwxOCA1OEwxOCA1NkwxOSA1NkwxOSA1N0wyMSA1N0wyMSA1NEwyMCA1NEwyMCA1MUwyMSA1MUwyMSA1M0wyMiA1M0wyMiA1NEwyMyA1NEwyMyA1MUwyMiA1MUwyMiA0OUwxOSA0OUwxOSA0NkwyMSA0NkwyMSA0NUwyMyA0NUwyMyA0NkwyMiA0NkwyMiA0N0wyMCA0N0wyMCA0OEwyNCA0OEwyNCA0OUwyNSA0OUwyNSA1MEwyNiA1MEwyNiA1MkwyNyA1MkwyNyA1MUwyOCA1MUwyOCA1MkwyOSA1MkwyOSA1MUwyOCA1MUwyOCA0N0wyNyA0N0wyNyA1MEwyNiA1MEwyNiA0OUwyNSA0OUwyNSA0OEwyNiA0OEwyNiA0N0wyNSA0N0wyNSA0NkwyNCA0NkwyNCA0NUwyMyA0NUwyMyA0NEwyMSA0NEwyMSA0NUwyMCA0NUwyMCA0M0wxOSA0M0wxOSA0MUwxOCA0MUwxOCA0MFpNMzQgNDBMMzQgNDJMMzMgNDJMMzMgNDNMMzQgNDNMMzQgNDJMMzUgNDJMMzUgNDBaTTAgNDFMMCA0MkwxIDQyTDEgNDFaTTYgNDFMNiA0Mkw3IDQyTDcgNDNMOCA0M0w4IDQyTDcgNDJMNyA0MVpNNTAgNDFMNTAgNDJMNTEgNDJMNTEgNDFaTTE1IDQyTDE1IDQzTDE2IDQzTDE2IDQ0TDE4IDQ0TDE4IDQ1TDE3IDQ1TDE3IDQ2TDE4IDQ2TDE4IDQ1TDE5IDQ1TDE5IDQzTDE3IDQzTDE3IDQyWk00MSA0Mkw0MSA0M0w0MiA0M0w0MiA0MlpNNDUgNDNMNDUgNDRMNDYgNDRMNDYgNDVMNDggNDVMNDggNDNaTTY0IDQzTDY0IDQ1TDY1IDQ1TDY1IDQzWk0zMyA0NUwzMyA0NkwzMiA0NkwzMiA0OEwzNCA0OEwzNCA0NVpNNDQgNDVMNDQgNDZMNDUgNDZMNDUgNDVaTTUxIDQ1TDUxIDQ2TDUyIDQ2TDUyIDQ1Wk0zIDQ2TDMgNDhMNCA0OEw0IDQ2Wk02IDQ2TDYgNDdMNSA0N0w1IDQ5TDggNDlMOCA0OEw2IDQ4TDYgNDdMOCA0N0w4IDQ2Wk01MiA0N0w1MiA0OEw1MyA0OEw1MyA0N1pNMTMgNDlMMTMgNTBMMTQgNTBMMTQgNTFMMTYgNTFMMTYgNDlMMTUgNDlMMTUgNTBMMTQgNTBMMTQgNDlaTTE4IDQ5TDE4IDUwTDE5IDUwTDE5IDQ5Wk00MCA0OUw0MCA1MUw0MSA1MUw0MSA1MEw0MiA1MEw0MiA1MUw0NCA1MUw0NCA1MEw0MiA1MEw0MiA0OVpNNTIgNDlMNTIgNTFMNTMgNTFMNTMgNDlaTTMyIDUwTDMyIDUyTDMzIDUyTDMzIDUwWk00OSA1MUw0OSA1Mkw1MCA1Mkw1MCA1MVpNNTYgNTFMNTYgNTJMNTQgNTJMNTQgNTVMNTUgNTVMNTUgNTRMNTYgNTRMNTYgNTZMNTcgNTZMNTcgNTVMNTggNTVMNTggNTZMNTkgNTZMNTkgNTVMNjAgNTVMNjAgNTRMNTkgNTRMNTkgNTNMNTYgNTNMNTYgNTJMNTggNTJMNTggNTFaTTYxIDUxTDYxIDUzTDYyIDUzTDYyIDUxWk00IDUyTDQgNTNMNSA1M0w1IDUyWk01MSA1Mkw1MSA1NEw1MCA1NEw1MCA1M0w0OSA1M0w0OSA1NEw1MCA1NEw1MCA1N0w1MiA1N0w1MiA1OEw1MyA1OEw1MyA1Nkw1MiA1Nkw1MiA1MlpNMTUgNTNMMTUgNTRMMTYgNTRMMTYgNTNaTTI3IDUzTDI3IDU0TDI5IDU0TDI5IDUzWk00MiA1M0w0MiA1NEw0MSA1NEw0MSA1NUwzOCA1NUwzOCA1Nkw0MSA1Nkw0MSA1NUw0MiA1NUw0MiA1Nkw0MyA1Nkw0MyA1NEw0NCA1NEw0NCA1M1pNMTkgNTVMMTkgNTZMMjAgNTZMMjAgNTVaTTI3IDU1TDI3IDU2TDI4IDU2TDI4IDU1Wk02MSA1Nkw2MSA1N0w2MiA1N0w2MiA1OEw2NCA1OEw2NCA1NlpNMjYgNTdMMjYgNThMMjcgNThMMjcgNTdaTTMxIDU3TDMxIDYwTDM0IDYwTDM0IDU3Wk01NCA1N0w1NCA2MEw1NSA2MEw1NSA1N1pNNTcgNTdMNTcgNjBMNjAgNjBMNjAgNTdaTTMyIDU4TDMyIDU5TDMzIDU5TDMzIDU4Wk01OCA1OEw1OCA1OUw1OSA1OUw1OSA1OFpNNjEgNTlMNjEgNjFMNjMgNjFMNjMgNTlaTTIwIDYwTDIwIDYxTDIxIDYxTDIxIDYwWk0yMiA2MEwyMiA2MUwyMyA2MUwyMyA2MFpNOCA2MUw4IDY1TDkgNjVMOSA2MVpNMTMgNjFMMTMgNjJMMTQgNjJMMTQgNjNMMTEgNjNMMTEgNjVMMTIgNjVMMTIgNjRMMTQgNjRMMTQgNjNMMTUgNjNMMTUgNjVMMTggNjVMMTggNjRMMTYgNjRMMTYgNjNMMTcgNjNMMTcgNjJMMTUgNjJMMTUgNjFaTTU1IDYxTDU1IDYzTDU2IDYzTDU2IDYxWk0zMSA2NEwzMSA2NUwzMyA2NUwzMyA2NFpNMzQgNjRMMzQgNjVMMzUgNjVMMzUgNjRaTTQ5IDY0TDQ5IDY1TDUwIDY1TDUwIDY0Wk0wIDBMMCA3TDcgN0w3IDBaTTEgMUwxIDZMNiA2TDYgMVpNMiAyTDIgNUw1IDVMNSAyWk01OCAwTDU4IDdMNjUgN0w2NSAwWk01OSAxTDU5IDZMNjQgNkw2NCAxWk02MCAyTDYwIDVMNjMgNUw2MyAyWk0wIDU4TDAgNjVMNyA2NUw3IDU4Wk0xIDU5TDEgNjRMNiA2NEw2IDU5Wk0yIDYwTDIgNjNMNSA2M0w1IDYwWiIgZmlsbD0iIzAwMDAwMCIvPjwvZz48L2c+PC9zdmc+Cg==" alt>
            </div>
            <div class="widget">
                <p>Wenn Sie den QR-Code nicht scannen können, geben Sie stattdessen diesen Schlüssel ein:</p>
                <p style="word-break:break-all; width:70%">YEXTWQFNZ5DJPZH7QTUN5U3WHBKIFAZG2O6VWYCUO7MRZENQTUVILUFRI23S6EIXCJ7PHT2L47QXY36SIQUUGR6A3ZP6VUMSHDED4KBYKAZCZJ5Q36AH6NRYELROIZL4EAZHBZLTPQ5HSW3ZSOTUH6IZWOBR7H5X4RHOTEHYVFKJ6THZB7XT3OREBEW5S5JET3TNOZIDBGJOI</p>
            </div>
            <div class="widget widget-text">
                <label for="verify">Bestätigungscode</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="off" autocomplete="off" required>
                <p class="help">Bitte geben Sie den von Ihrer 2FA/TOTP-App generierten Bestätigungscode ein.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="submit">Aktivieren</button>
            </div>
        </div>
    </form>
</div>

**Individuelles Template:** Hier kannst du das Standard-Template `mod_two_factor` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_two_factor two-factor block">
    
    <p class="error">Bitte aktivieren Sie die Zwei-Faktor-Authentifizierung bevor Sie fortfahren.</p>
    <p>Bitte scannen Sie den QR-Code mit Ihrer 2FA/TOTP-App.</p>
    
    <form action="" class="tl_two_factor_form" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_two_factor">
            <input type="hidden" name="REQUEST_TOKEN" value="_">
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,…" alt>
            </div>
            <div class="widget">
                <p>Wenn Sie den QR-Code nicht scannen können, geben Sie stattdessen diesen Schlüssel ein:</p>
                <code style="word-break:break-all">…</code>
            </div>
            <div class="widget widget-text">
                <label for="verify">Bestätigungscode</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="off" autocomplete="off" required>
                <p class="help">Bitte geben Sie den von Ihrer 2FA/TOTP-App generierten Bestätigungscode ein.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="tl_submit">Aktivieren</button>
            </div>
        </div>
    </form>
  
</div>
<!-- indexer::continue -->
```

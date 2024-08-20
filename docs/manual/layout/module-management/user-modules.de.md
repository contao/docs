---
title: "Benutzermodule"
description: "Benutzermodule sind Module, die im Zusammenhang mit der Verwaltung von Frontend-Benutzern gebraucht 
werden."
url: "layout/modulverwaltung/benutzermodule"
aliases:
    - /de/modulverwaltung/benutzermodule/
    - /de/layout/modulverwaltung/benutzermodule/
weight: 20
---

Benutzermodule sind Module, die im Zusammenhang mit der Verwaltung von Frontend-Benutzern gebraucht werden. Dazu zählt 
beispielsweise die Registrierung neuer Mitglieder oder die An- bzw. Abmeldung bestehender Mitglieder.


## Login-Formular

Das Frontend-Modul »Login-Formular« fügt der Webseite ein Formular hinzu, mit dem sich registrierte Mitglieder 
authentifizieren können.

**Frontend-Ausgabe**

<div class="user-module mod_login login block">
    <form id="tl_login_68" method="post">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" class="text" value="" autocapitalize="none" autocomplete="username" required="">
            </div>
            <div class="widget widget-password">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" class="text password" value="" autocomplete="current-password" required="">
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span><input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> <label for="autologin">Angemeldet bleiben</label></span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Anmelden</button>
            </div>
            <div class="password-reset">
                <a href="#">Passwort vergessen?</a>
            </div>
        </div>
    </form>
</div>

Sobald ein Frontend-Benutzer angemeldet ist, wird statt des Anmeldeformulars automatisch eine Schaltfläche zum Abmelden 
angezeigt.

**Frontend-Ausgabe**

<div class="user-module mod_login logout block">
    <form id="tl_logout_68" method="post">
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


### Modul-Konfiguration

**Autologin erlauben:** Wenn du diese Option auswählst, können Mitglieder auf Wunsch angemeldet bleiben. Läuft eine 
Benutzersitzung ab, erstellt Contao automatisch eine neue Sitzung, ohne dass das Passwort dazu erneut eingegeben werden 
muss.

{{< version-tag "5.3" >}} **Passwort-Reset-Seite:** Hier kannst du eine Seite auswählen, zu der Besucher weitergeleitet 
werden, wenn sie den »Passwort vergessen?«-Link anklicken.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, zu welcher Seite ein Mitglied nach erfolgreicher Anmeldung weitergeleitet 
wird. Diese Einstellung kannst du pro Benutzergruppe überschreiben, um eine gruppenspezifische Weiterleitung 
einzurichten.

**Zur zuletzt besuchten Seite:** Wenn du diese Option auswählst, wird der Frontend-Benutzer zur zuletzt besuchten Seite 
anstatt zur Weiterleitungsseite weitergeleitet.


### Template-Einstellungen

**Modul Template:** Hier kannst du das Modul-Template `ce_login` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_login login block">
    
    <h2>Lgoin</h2>

    <form id="tl_login_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_login_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <input type="hidden" name="_target_path" value="…">
            <input type="hidden" name="_always_use_target_path" value="0">
            <div class="widget widget-text">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" class="text" value="" autocapitalize="none" autocomplete="username" required="">
            </div>
            <div class="widget widget-password">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" class="text password" value="" autocomplete="current-password" required="">
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span><input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> <label for="autologin">Angemeldet bleiben</label></span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Anmelden</button>
            </div>
            <div class="password-reset">
                <a href="…">Passwort vergessen?</a>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Automatischer Logout

{{< tabs groupId="contaoVersion">}}
{{% tab name="Contao  4" %}}
Das Frontend-Modul »Automatischer Logout« fügt der Webseite ein unsichtbares Modul hinzu, das einen angemeldeten 
Frontend-Benutzer automatisch abmeldet.

Sobald sich ein Mitglied im Frontend der Webseite angemeldet hat, erscheint im Hauptmenü auf der rechten Seite ein 
Logout-Link, mit dem es sich wieder abmelden kann. In Wirklichkeit handelt es sich dabei um zwei verschiedene Seiten in 
der Seitenstruktur, die einmal das Login- und einmal das Logout-Modul enthalten.

### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Frontend-Benutzer nach der Abmeldung weitergeleitet 
wird.

**Zur zuletzt besuchten Seite:** Wenn du diese Option auswählst, wird das Mitglied zur zuletzt besuchten Seite anstatt 
zur Weiterleitungsseite weitergeleitet.

Das Modul erzeugt keine HTML-Ausgabe.
{{% /tab %}}
{{% tab name="Contao 5" %}}
Dieses Modul wurde durch den Seitentyp »[Abmelden](/de/seitenstruktur/abmelden/)« ersetzt, welches einen Abmelde-Link für 
einen geschützten Bereich erstellt. 
{{% /tab %}}
{{< /tabs >}}


## Personendaten

Das Frontend-Modul »Personendaten« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied seine persönlichen 
Daten wie z. B. seine E-Mail-Adresse oder sein Passwort ändern kann. Dabei kannst du als Administrator genau festlegen, 
welche Felder bearbeitet werden dürfen und welche nicht.

**Frontend-Ausgabe `member_default`**

<div class="mod_personalData block">
    <form id="tl_member_68" method="post">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="ctrl_firstname_68">
                    <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                </label>
                <input type="text" name="firstname" id="ctrl_firstname_68" class="text" value="John" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_lastname_68">
                    <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                </label>
                <input type="text" name="lastname" id="ctrl_lastname_68" class="text" value="Smith" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_email_68">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email_68" class="text" value="j.smith@example.com" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_username_68">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username_68" class="text" value="j.smith" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-password">
                <label for="ctrl_password_68">Passwort</label>
                <input type="password" name="password" id="ctrl_password_68" class="text password" value="" autocomplete="new-password">
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>
</div>

**Frontend-Ausgabe `member_grouped`**

<div class="mod_personalData block">
    <form id="tl_member_68" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname_68">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname_68" class="text" value="John" required="" maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname_68">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname_68" class="text" value="Smith" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email_68">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email_68" class="text" value="j.smith@example.com" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_username_68">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username_68" class="text" value="j.smith" required="" maxlength="64" autocapitalize="none" autocomplete="username">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password_68">Passwort</label>
                    <input type="password" name="password" id="ctrl_password_68" class="text password" value="" autocomplete="new-password">
                </div>
            </fieldset>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Daten speichern</button>
            </div>
        </div>
    </form>
</div>


### Modul-Konfiguration

**Editierbare Felder:** Hier kannst du die editierbaren Felder festlegen.

![Editierbare Felder festlegen]({{% asset "images/manual/layout/module-management/de/editierbare-felder-festlegen.png" %}}?classes=shadow)

**Abonnierbare Newsletter:** Wenn du die Contao Newsletter-Erweiterung verwendest, kannst du hier festlegen, welche 
Verteiler ein Mitglied abonnieren kann.


### Weiterleitung

**Weiterleitungsseite:** Hier kannst du auswählen, auf welche Seite ein Mitglied nach dem Absenden der Änderungen 
weitergeleitet wird.


### Template-Einstellungen

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
    
    <h2>Personendaten</h2>
 
    <form id="tl_member_68" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text">
                <label for="ctrl_firstname_68">
                    <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                </label>
                <input type="text" name="firstname" id="ctrl_firstname_68" class="text" value="John" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_lastname_68">
                    <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                </label>
                <input type="text" name="lastname" id="ctrl_lastname_68" class="text" value="Smith" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_email_68">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email_68" class="text" value="j.smith@example.com" required="" maxlength="255">
            </div>
            <div class="widget widget-text">
                <label for="ctrl_username_68">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username_68" class="text" value="j.smith" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-password">
                <label for="ctrl_password_68">Passwort</label>
                <input type="password" name="password" id="ctrl_password_68" class="text password" value="" autocomplete="new-password">
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

    <h2>Personendaten</h2>

    <form id="tl_member_68" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname_68">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname_68" class="text" value="John" required="" maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname_68">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname_68" class="text" value="Smith" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email_68">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email_68" class="text" value="j.smith@example.com" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text">
                    <label for="ctrl_username_68">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username_68" class="text" value="j.smith" required="" maxlength="64" autocapitalize="none" autocomplete="username">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password_68">Passwort</label>
                    <input type="password" name="password" id="ctrl_password_68" class="text password" value="" autocomplete="new-password">
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


## Registrierung

Das Frontend-Modul »Registrierung« fügt der Webseite ein Formular hinzu, mit dem sich neue Mitglieder registrieren 
können und je nach Konfiguration automatisch ein Benutzerkonto für den geschützten Bereich erhalten.

**Frontend-Ausgabe `member_default`**

<div class="mod_registration block">
    <form id="tl_registration_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_firstname_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                </label>
                <input type="text" name="firstname" id="ctrl_firstname_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_lastname_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                </label>
                <input type="text" name="lastname" id="ctrl_lastname_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_email_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_username_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username_68" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-password mandatory">
                <label for="ctrl_password_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password_68" class="text password mandatory" value="" autocomplete="new-password" required="">
            </div>
            <div class="widget widget-captcha mandatory" style="display: none;">
                …
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>
</div>

**Frontend-Ausgabe `member_grouped`**

<div class="mod_registration block">
    <form id="tl_registration_68" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username_68" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password_68" class="text password mandatory" value="" autocomplete="new-password" required="">
                </div>
            </fieldset>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Registrieren</button>
            </div>
        </div>
    </form>
</div>


### Modul-Konfiguration

**Editierbare Felder:** Hier kannst du festlegen, welche Felder ein neues Mitglied bei der Registrierung ausfüllen muss. 
Um die Anmeldung im Frontend zu ermöglichen, musst du mindestens die Felder Benutzername und Passwort aktivieren.

![Editierbare Felder festlegen]({{% asset "images/manual/layout/module-management/de/editierbare-felder-festlegen.png" %}}?classes=shadow)

**Abonnierbare Newsletter:** Wenn du die Contao Newsletter-Erweiterung verwendest, kannst du hier festlegen, welche 
Verteiler ein Mitglied abonnieren kann.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.


### Kontoeinstellungen

**Mitgliedergruppen:** Hier legst du die Gruppenmitgliedschaft des neuen Mitglieds fest.

**Login erlauben:** Wenn du diese Option auswählst, kann sich ein neues Mitglied nach der Registrierung im Frontend 
anmelden. Damit das funktioniert, muss das Registrierungsformular die Felder Benutzername und Passwort enthalten.

**Ein Home-Verzeichnis anlegen:** Wenn du diese Option auswählst, wird bei der Registrierung automatisch ein neues 
Benutzerverzeichnis in einem Ordner deiner Wahl erstellt. Der Name des neuen Verzeichnisses wird aus dem Benutzernamen 
generiert.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Mitglied nach der Registrierung weitergeleitet wird 
(z. B. auf die Seite mit dem Login-Formular).


### E-Mail-Einstellungen

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


### Template-Einstellungen

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
    
    <h2>Registrierung</h2>

    <form id="tl_registration_68" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_firstname_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                </label>
                <input type="text" name="firstname" id="ctrl_firstname_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_lastname_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                </label>
                <input type="text" name="lastname" id="ctrl_lastname_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_email_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email_68" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_username_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username_68" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-password mandatory">
                <label for="ctrl_password_68" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password_68" class="text password mandatory" value="" autocomplete="new-password" required="">
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
    
    <h2>Registrierung</h2>

    <form id="tl_registration_68" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">

            <fieldset>
                <legend>Personendaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Vorname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Nachname<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Kontaktdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email_68" class="text mandatory" value="" required="" maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Zugangsdaten</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username_68" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password_68" class="mandatory">
                        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password_68" class="text password mandatory" value="" autocomplete="new-password" required="">
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


## Passwort ändern {#passwort-aendern}

Das Frontend-Modul »Passwort ändern« fügt der Webseite ein Formular hinzu, das einem angemeldeten Frontend-Benutzer 
ermöglicht, sein Passwort zu ändern.

**Frontend-Ausgabe**

<div class="mod_changePassword block">
    <form id="tl_change_password_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_change_password_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_oldpassword" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Altes Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required="" autocomplete="current-password">
            </div>
            <div class="widget widget-password mandatory">
                <label for="ctrl_password" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Neues Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" autocomplete="new-password" required="">
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Passwort ändern</button>
            </div>
        </div>
    </form>
</div>


### Weiterleitung

**Weiterleitungsseite:** Hier kannst du auswählen, auf welche Seite ein Mitglied nach dem Absenden der Änderungen 
weitergeleitet wird.


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Modul-Template `ce_changePassword` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_changePassword block">

    <h2>Passwort ändern</h2>

    <form id="tl_change_password_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_change_password_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_oldpassword" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Altes Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required="" autocomplete="current-password">
            </div>
            <div class="widget widget-password mandatory">
                <label for="ctrl_password" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Neues Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" autocomplete="new-password" required="">
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
    <form id="tl_lost_password_68" method="post">
        <div class="formbody">
            <div class="widget widget-text mandatory">
                <label for="ctrl_username" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Neues Passwort anfordern</button>
            </div>
        </div>
    </form>
</div>


### Modul-Konfiguration

**Benutzernamen nicht abfragen:** Wenn du diese Option auswählst, wird der Benutzername bei der Anforderung nicht 
abgefragt.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen). Seit Contao 4.4 
wird diese Frage nur noch den Spambots »angezeigt«. Ohne Sicherheitsfrage ist es unter Umständen möglich, dass Spammer 
automatisiert Benutzerkonten erstellen und deine Webseite missbrauchen.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Benutzer nach dem Anfordern eines neuen Passworts 
weitergeleitet wird.


### E-Mail-Einstellungen

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


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Modul-Template `ce_lostPassword` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_lostPassword block">
    
    <h2>Passwort vergessen</h2>

    <form id="tl_lost_password_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_lost_password_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_username" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>Benutzername<span class="mandatory">*</span>
                </label>
                <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required="" maxlength="64" autocapitalize="none" autocomplete="username">
            </div>
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="mandatory">
                    <span class="invisible">Pflichtfeld </span>E-Mail-Adresse<span class="mandatory">*</span>
                </label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required="" maxlength="255">
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Neues Passwort anfordern</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Konto schließen {#konto-schliessen}

Das Frontend-Modul »Konto schließen« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied sein Konto schließen 
kann. Je nach Konfiguration wird der Account dabei entweder nur deaktiviert oder komplett aus der Datenbank gelöscht.

**Frontend-Ausgabe**

<div class="mod_closeAccount block">
    <form id="tl_close_account_68" method="post">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="ctrl_password">
                    <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password" class="text password" value="" required="" minlength="8">
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Konto schließen</button>
            </div>
        </div>
    </form>
</div>


### Modul-Konfiguration

**Modus:** Hier legst du fest, ob das jeweilige Konto beim Absenden des Formulars lediglich deaktiviert oder komplett 
aus der Datenbank gelöscht werden soll.

**Home-Verzeichnis löschen:** Hier legst du fest, ob das Home-Verzeichnis gelöscht werden soll.


### Weiterleitung

**Weiterleitungsseite:**  Hier legst du fest, auf welche Seite ein Mitglied nach der Kontoschließung
weitergeleitet wird. Die Zielseite darf nicht geschützt sein.


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Modul-Template `ce_closeAccount` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_closeAccount block">

    <h2>Konto schließen</h2>

    <form id="tl_close_account_68" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_close_account_68">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text">
                <label for="ctrl_password">
                    <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
                </label>
                <input type="password" name="password" id="ctrl_password" class="text password" value="" required="" minlength="8">
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

Das Frontend-Modul »Zwei-Faktor-Authentifizierung« fügt der Webseite ein Formular hinzu, mit dem ein Mitglied die 
Zwei-Faktor-Authentifizierung aktivieren kann. Wenn im Startpunkt einer Website die Zwei-Faktor-Authentifizierung für
Mitglieder erzwungen wird, muss dieses Modul auf der in der Seitenstruktur beim 
[Startpunkt der Website](/de/seitenstruktur/website-startseite/#zwei-faktor-authentifizierung) 
ausgewählten Zwei-Faktor-Weiterleitungsseite hinzugefügt werden.

**Frontend-Ausgabe**

<div class="mod_two_factor two-factor block"> 
    <form class="tl_two_factor_form" method="post">
        <div class="formbody">
            <p>Bitte scannen Sie den QR-Code mit Ihrer 2FA/TOTP-App.</p>
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjE4MCIgaGVpZ2h0PSIxODAiIHZpZXdCb3g9IjAgMCAxODAgMTgwIj48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTgwIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2ZlZmVmZSIvPjxnIHRyYW5zZm9ybT0ic2NhbGUoMi45NTEpIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDApIj48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04IDBMOCA0TDEwIDRMMTAgN0wxMSA3TDExIDRMMTAgNEwxMCAzTDExIDNMMTEgMkwxMyAyTDEzIDZMMTIgNkwxMiA4TDEwIDhMMTAgOUw3IDlMNyA4TDQgOEw0IDlMNSA5TDUgMTFMNCAxMUw0IDEwTDMgMTBMMyAxMUw0IDExTDQgMTVMNyAxNUw3IDE2TDYgMTZMNiAxN0w3IDE3TDcgMTZMOCAxNkw4IDE4TDUgMThMNSAxNkwzIDE2TDMgMTdMMiAxN0wyIDE2TDAgMTZMMCAxN0wxIDE3TDEgMThMMCAxOEwwIDE5TDEgMTlMMSAyMEwyIDIwTDIgMjFMMSAyMUwxIDI0TDIgMjRMMiAyM0wzIDIzTDMgMjRMNCAyNEw0IDI1TDAgMjVMMCAyOEwxIDI4TDEgMjZMMyAyNkwzIDI3TDIgMjdMMiAyOUwxIDI5TDEgMzBMMCAzMEwwIDMzTDUgMzNMNSAzNUw0IDM1TDQgMzRMMyAzNEwzIDM1TDQgMzVMNCAzNkwyIDM2TDIgMzVMMSAzNUwxIDM0TDAgMzRMMCAzNUwxIDM1TDEgMzZMMCAzNkwwIDM3TDEgMzdMMSAzOEwyIDM4TDIgMzdMMyAzN0wzIDM4TDQgMzhMNCAzNkw1IDM2TDUgMzlMNCAzOUw0IDQwTDMgNDBMMyAzOUwwIDM5TDAgNDBMMyA0MEwzIDQyTDAgNDJMMCA0NUwxIDQ1TDEgNDRMMiA0NEwyIDQ2TDAgNDZMMCA0OEwxIDQ4TDEgNDdMMiA0N0wyIDQ5TDEgNDlMMSA1MEwyIDUwTDIgNTFMMCA1MUwwIDUzTDQgNTNMNCA1Mkw1IDUyTDUgNTFMOCA1MUw4IDUwTDkgNTBMOSA1MkwxNSA1MkwxNSA1M0wxNCA1M0wxNCA1NEwxMiA1NEwxMiA1NUwxMCA1NUwxMCA1NEw5IDU0TDkgNTNMOCA1M0w4IDUyTDYgNTJMNiA1M0w4IDUzTDggNTRMOSA1NEw5IDU1TDggNTVMOCA1N0wxMCA1N0wxMCA1OEw5IDU4TDkgNTlMOCA1OUw4IDYxTDkgNjFMOSA2MEwxMCA2MEwxMCA2MUwxMiA2MUwxMiA2MEwxMyA2MEwxMyA2MUwxNCA2MUwxNCA1OUwxMiA1OUwxMiA2MEwxMSA2MEwxMSA1OUwxMCA1OUwxMCA1OEwxMSA1OEwxMSA1NkwxMiA1NkwxMiA1N0wxNCA1N0wxNCA1NkwxNSA1NkwxNSA1OUwxNiA1OUwxNiA2MEwxNSA2MEwxNSA2MUwxNiA2MUwxNiA2MEwxNyA2MEwxNyA2MUwyMiA2MUwyMiA2MEwyMyA2MEwyMyA2MUwyNSA2MUwyNSA2MEwyNiA2MEwyNiA2MUwyOCA2MUwyOCA2MEwyNiA2MEwyNiA1OEwyNyA1OEwyNyA1OUwyOSA1OUwyOSA2MUwzMCA2MUwzMCA1N0wzMSA1N0wzMSA1OEwzMiA1OEwzMiA1OUwzMSA1OUwzMSA2MEwzMiA2MEwzMiA2MUwzNSA2MUwzNSA2MEwzNiA2MEwzNiA2MUwzNyA2MUwzNyA2MEwzNiA2MEwzNiA1N0wzNyA1N0wzNyA1NEwzNiA1NEwzNiA1M0wzOCA1M0wzOCA1NEwzOSA1NEwzOSA1M0w0MCA1M0w0MCA1NEw0MSA1NEw0MSA1NUwzOSA1NUwzOSA1N0wzOCA1N0wzOCA1OEwzOSA1OEwzOSA1OUw0MCA1OUw0MCA1Nkw0MSA1Nkw0MSA1OUw0MiA1OUw0MiA2MUw0MyA2MUw0MyA1OUw0NCA1OUw0NCA2MUw0NiA2MUw0NiA2MEw0NyA2MEw0NyA2MUw0OSA2MUw0OSA2MEw1MCA2MEw1MCA2MUw1MSA2MUw1MSA2MEw1MiA2MEw1MiA1OUw1MyA1OUw1MyA1OEw1MiA1OEw1MiA1OUw1MSA1OUw1MSA1N0w1NCA1N0w1NCA1OEw1NSA1OEw1NSA1N0w1NyA1N0w1NyA1OEw1OCA1OEw1OCA2MEw1NiA2MEw1NiA2MUw1OCA2MUw1OCA2MEw1OSA2MEw1OSA2MUw2MSA2MUw2MSA2MEw2MCA2MEw2MCA1OEw2MSA1OEw2MSA1Nkw2MCA1Nkw2MCA1OEw1OCA1OEw1OCA1N0w1OSA1N0w1OSA1NEw2MSA1NEw2MSA1Mkw1OSA1Mkw1OSA0OUw1OCA0OUw1OCA1MEw1NyA1MEw1NyA0OUw1NSA0OUw1NSA0OEw1NiA0OEw1NiA0Nkw1OCA0Nkw1OCA0OEw1OSA0OEw1OSA0N0w2MCA0N0w2MCA0OEw2MSA0OEw2MSA0N0w2MCA0N0w2MCA0NUw2MSA0NUw2MSA0NEw2MCA0NEw2MCA0NUw1OSA0NUw1OSA0Nkw1OCA0Nkw1OCA0NEw1OSA0NEw1OSA0M0w2MCA0M0w2MCA0Mkw2MSA0Mkw2MSA0MEw2MCA0MEw2MCAzNkw2MSAzNkw2MSAzNUw2MCAzNUw2MCAzNkw1OSAzNkw1OSAzNUw1OCAzNUw1OCAzM0w2MCAzM0w2MCAzNEw2MSAzNEw2MSAzMUw1NyAzMUw1NyAyOEw1NSAyOEw1NSAyN0w1NiAyN0w1NiAyNkw1NyAyNkw1NyAyN0w1OCAyN0w1OCAyOEw1OSAyOEw1OSAyN0w1OCAyN0w1OCAyNkw1OSAyNkw1OSAyMkw1OCAyMkw1OCAyMUw1OSAyMUw1OSAxOUw2MCAxOUw2MCAxN0w1OSAxN0w1OSAxOEw1OCAxOEw1OCAxOUw1NyAxOUw1NyAyMEw1NiAyMEw1NiAxOUw1MyAxOUw1MyAyMkw1MiAyMkw1MiAyMUw1MCAyMUw1MCAyMEw0OSAyMEw0OSAxOUw1MCAxOUw1MCAxOEw1MiAxOEw1MiAxN0w1MyAxN0w1MyAxOEw1NSAxOEw1NSAxN0w1MyAxN0w1MyAxNkw1NSAxNkw1NSAxNUw1NCAxNUw1NCAxNEw1NiAxNEw1NiAxNUw1NyAxNUw1NyAxNEw1OCAxNEw1OCAxNkw2MSAxNkw2MSAxNUw1OSAxNUw1OSAxNEw2MSAxNEw2MSAxM0w2MCAxM0w2MCAxMkw2MSAxMkw2MSAxMUw2MCAxMUw2MCAxMkw1OSAxMkw1OSAxMUw1OCAxMUw1OCAxMkw1NiAxMkw1NiAxM0w1NCAxM0w1NCAxMkw1MyAxMkw1MyAxMUw1MiAxMUw1MiAxMkw1MSAxMkw1MSAxM0w1MCAxM0w1MCAxNEw0OSAxNEw0OSAxNUw0NyAxNUw0NyAxNkw0NiAxNkw0NiAxN0w0NSAxN0w0NSAxNkw0NCAxNkw0NCAxNUw0NSAxNUw0NSAxNEw0NiAxNEw0NiAxMUw0NyAxMUw0NyAxM0w0OSAxM0w0OSAxMkw1MCAxMkw1MCAxMUw1MSAxMUw1MSAxMEw1MiAxMEw1MiA4TDUzIDhMNTMgNkw1MiA2TDUyIDhMNTAgOEw1MCA3TDUxIDdMNTEgNUw1MiA1TDUyIDRMNTMgNEw1MyAwTDUxIDBMNTEgMkw1MCAyTDUwIDdMNDkgN0w0OSA1TDQ3IDVMNDcgNkw0NiA2TDQ2IDlMNDUgOUw0NSA2TDQ0IDZMNDQgN0w0MyA3TDQzIDZMNDIgNkw0MiA3TDQxIDdMNDEgNkw0MCA2TDQwIDRMNDEgNEw0MSA1TDQ2IDVMNDYgMkw0NyAyTDQ3IDNMNDkgM0w0OSAyTDQ4IDJMNDggMUw0NiAxTDQ2IDBMNDUgMEw0NSAxTDQ0IDFMNDQgMEw0MSAwTDQxIDFMNDAgMUw0MCAyTDM5IDJMMzkgMEwzOCAwTDM4IDFMMzcgMUwzNyAwTDM1IDBMMzUgMkwzMyAyTDMzIDFMMzQgMUwzNCAwTDMzIDBMMzMgMUwzMiAxTDMyIDJMMzEgMkwzMSA0TDMwIDRMMzAgM0wyOSAzTDI5IDJMMjggMkwyOCAzTDI5IDNMMjkgNEwyOCA0TDI4IDdMMjcgN0wyNyA2TDI2IDZMMjYgOEwyOCA4TDI4IDlMMjQgOUwyNCA4TDI1IDhMMjUgNkwyNCA2TDI0IDVMMjUgNUwyNSA0TDI2IDRMMjYgNUwyNyA1TDI3IDRMMjYgNEwyNiAzTDI1IDNMMjUgNEwyMyA0TDIzIDNMMjQgM0wyNCAyTDI1IDJMMjUgMEwyNCAwTDI0IDFMMjMgMUwyMyAyTDIyIDJMMjIgNEwyMyA0TDIzIDZMMjIgNkwyMiA1TDIxIDVMMjEgNEwyMCA0TDIwIDdMMTkgN0wxOSA0TDE4IDRMMTggN0wxOSA3TDE5IDhMMTggOEwxOCA5TDE3IDlMMTcgMTBMMTggMTBMMTggMTFMMTcgMTFMMTcgMTJMMTYgMTJMMTYgN0wxNyA3TDE3IDZMMTYgNkwxNiA3TDE1IDdMMTUgNUwxNiA1TDE2IDRMMTcgNEwxNyAzTDE2IDNMMTYgNEwxNCA0TDE0IDJMMTUgMkwxNSAxTDE2IDFMMTYgMkwxOCAyTDE4IDNMMTkgM0wxOSAyTDIwIDJMMjAgM0wyMSAzTDIxIDJMMjAgMkwyMCAxTDIyIDFMMjIgMEwyMCAwTDIwIDFMMTkgMUwxOSAwTDE4IDBMMTggMUwxNyAxTDE3IDBMMTMgMEwxMyAxTDEyIDFMMTIgMEwxMSAwTDExIDJMOSAyTDkgMFpNMjYgMEwyNiAyTDI3IDJMMjcgMUwyOCAxTDI4IDBaTTI5IDBMMjkgMUwzMSAxTDMxIDBaTTEzIDFMMTMgMkwxNCAyTDE0IDFaTTE4IDFMMTggMkwxOSAyTDE5IDFaTTQ1IDFMNDUgMkw0NiAyTDQ2IDFaTTM2IDJMMzYgM0wzNSAzTDM1IDRMMzQgNEwzNCAzTDMzIDNMMzMgNUwzNCA1TDM0IDZMMzMgNkwzMyA4TDM0IDhMMzQgMTBMMzIgMTBMMzIgOUwzMSA5TDMxIDExTDI5IDExTDI5IDEyTDI4IDEyTDI4IDEzTDI3IDEzTDI3IDE0TDI2IDE0TDI2IDEyTDI3IDEyTDI3IDExTDI4IDExTDI4IDEwTDI5IDEwTDI5IDlMMjggOUwyOCAxMEwyNyAxMEwyNyAxMUwyNiAxMUwyNiAxMkwyNSAxMkwyNSAxMUwyNCAxMUwyNCA5TDIzIDlMMjMgOEwyNCA4TDI0IDZMMjMgNkwyMyA3TDIyIDdMMjIgNkwyMSA2TDIxIDdMMjAgN0wyMCA4TDIxIDhMMjEgOUwxOSA5TDE5IDExTDE4IDExTDE4IDEyTDE5IDEyTDE5IDExTDIwIDExTDIwIDEwTDIxIDEwTDIxIDEyTDIyIDEyTDIyIDEzTDIxIDEzTDIxIDE1TDIyIDE1TDIyIDE2TDIzIDE2TDIzIDE3TDIxIDE3TDIxIDE4TDIwIDE4TDIwIDE3TDE5IDE3TDE5IDE4TDE4IDE4TDE4IDE5TDE3IDE5TDE3IDIwTDE2IDIwTDE2IDIyTDE0IDIyTDE0IDIzTDEzIDIzTDEzIDIyTDEyIDIyTDEyIDIxTDggMjFMOCAxOUw5IDE5TDkgMjBMMTIgMjBMMTIgMTlMOSAxOUw5IDE4TDEzIDE4TDEzIDIxTDE0IDIxTDE0IDIwTDE1IDIwTDE1IDE5TDE2IDE5TDE2IDE4TDE3IDE4TDE3IDE2TDE2IDE2TDE2IDE3TDE1IDE3TDE1IDE5TDE0IDE5TDE0IDE3TDEzIDE3TDEzIDE1TDE0IDE1TDE0IDE2TDE1IDE2TDE1IDE0TDE2IDE0TDE2IDE1TDE3IDE1TDE3IDE0TDE4IDE0TDE4IDEzTDE1IDEzTDE1IDE0TDEzIDE0TDEzIDE1TDEyIDE1TDEyIDE0TDExIDE0TDExIDEwTDkgMTBMOSAxMUw4IDExTDggMTBMNyAxMEw3IDlMNiA5TDYgMTBMNyAxMEw3IDExTDYgMTFMNiAxMkw3IDEyTDcgMTNMNSAxM0w1IDE0TDcgMTRMNyAxNUw4IDE1TDggMTZMOSAxNkw5IDE1TDEwIDE1TDEwIDE2TDExIDE2TDExIDE1TDEyIDE1TDEyIDE3TDkgMTdMOSAxOEw4IDE4TDggMTlMNSAxOUw1IDIxTDMgMjFMMyAyMkw3IDIyTDcgMjNMNCAyM0w0IDI0TDcgMjRMNyAyNUw1IDI1TDUgMjZMNCAyNkw0IDI3TDMgMjdMMyAyOUwyIDI5TDIgMzBMMSAzMEwxIDMxTDIgMzFMMiAzMEwzIDMwTDMgMzFMNCAzMUw0IDMwTDMgMzBMMyAyOUw0IDI5TDQgMjdMNSAyN0w1IDI4TDkgMjhMOSAyOUwxMCAyOUwxMCAyNkw4IDI2TDggMjNMOSAyM0w5IDI1TDExIDI1TDExIDI0TDEwIDI0TDEwIDIyTDEyIDIyTDEyIDIzTDEzIDIzTDEzIDI0TDE0IDI0TDE0IDIzTDE1IDIzTDE1IDI0TDE2IDI0TDE2IDI4TDE1IDI4TDE1IDI1TDE0IDI1TDE0IDI3TDEzIDI3TDEzIDI2TDExIDI2TDExIDMwTDEwIDMwTDEwIDMyTDkgMzJMOSAzNEw4IDM0TDggMzVMNiAzNUw2IDM2TDcgMzZMNyAzN0w2IDM3TDYgMzhMNyAzOEw3IDM3TDkgMzdMOSAzOUw4IDM5TDggNDFMNiA0MUw2IDQyTDUgNDJMNSA0M0wyIDQzTDIgNDRMNCA0NEw0IDQ1TDMgNDVMMyA0NkwyIDQ2TDIgNDdMMyA0N0wzIDQ5TDIgNDlMMiA1MEw0IDUwTDQgNDlMNSA0OUw1IDUwTDcgNTBMNyA0OUw2IDQ5TDYgNDhMNyA0OEw3IDQ3TDggNDdMOCA0Nkw3IDQ2TDcgNDVMOSA0NUw5IDQ0TDEwIDQ0TDEwIDQ2TDkgNDZMOSA0N0wxMiA0N0wxMiA0OEwxMSA0OEwxMSA0OUwxMCA0OUwxMCA0OEw4IDQ4TDggNDlMMTAgNDlMMTAgNTFMMTQgNTFMMTQgNTBMMTEgNTBMMTEgNDlMMTIgNDlMMTIgNDhMMTMgNDhMMTMgNDlMMTUgNDlMMTUgNTFMMTYgNTFMMTYgNTBMMTcgNTBMMTcgNDhMMTkgNDhMMTkgNDlMMjEgNDlMMjEgNTBMMjAgNTBMMjAgNTJMMTkgNTJMMTkgNTNMMTggNTNMMTggNTJMMTcgNTJMMTcgNTNMMTUgNTNMMTUgNTRMMTQgNTRMMTQgNTVMMTUgNTVMMTUgNTZMMTYgNTZMMTYgNThMMTggNThMMTggNTdMMjAgNTdMMjAgNTZMMjIgNTZMMjIgNThMMjAgNThMMjAgNTlMMTkgNTlMMTkgNjBMMjIgNjBMMjIgNThMMjMgNThMMjMgNjBMMjUgNjBMMjUgNThMMjYgNThMMjYgNTdMMjUgNTdMMjUgNThMMjMgNThMMjMgNTVMMjQgNTVMMjQgNTZMMjUgNTZMMjUgNTVMMjYgNTVMMjYgNTZMMjcgNTZMMjcgNThMMjkgNThMMjkgNTdMMjggNTdMMjggNTVMMjcgNTVMMjcgNTNMMjggNTNMMjggNTJMMjcgNTJMMjcgNTNMMjUgNTNMMjUgNTVMMjQgNTVMMjQgNTRMMjMgNTRMMjMgNTNMMjQgNTNMMjQgNTFMMjIgNTFMMjIgNTBMMjMgNTBMMjMgNDlMMjQgNDlMMjQgNTBMMjYgNTBMMjYgNTFMMjcgNTFMMjcgNTBMMjggNTBMMjggNDhMMjcgNDhMMjcgNDlMMjQgNDlMMjQgNDhMMjYgNDhMMjYgNDdMMjcgNDdMMjcgNDZMMjggNDZMMjggNDdMMzAgNDdMMzAgNDhMMzEgNDhMMzEgNDlMMzIgNDlMMzIgNDhMMzMgNDhMMzMgNDlMMzQgNDlMMzQgNTBMMzIgNTBMMzIgNTJMMzMgNTJMMzMgNTNMMzQgNTNMMzQgNTJMMzUgNTJMMzUgNTNMMzYgNTNMMzYgNTFMMzcgNTFMMzcgNTJMMzggNTJMMzggNDlMMzkgNDlMMzkgNDhMMzcgNDhMMzcgNDdMMzYgNDdMMzYgNDZMMzggNDZMMzggNDVMNDAgNDVMNDAgNDZMMzkgNDZMMzkgNDdMNDAgNDdMNDAgNTBMMzkgNTBMMzkgNTFMNDAgNTFMNDAgNTNMNDEgNTNMNDEgNTRMNDIgNTRMNDIgNTNMNDMgNTNMNDMgNTVMNDIgNTVMNDIgNTdMNDMgNTdMNDMgNThMNDQgNThMNDQgNTlMNDUgNTlMNDUgNjBMNDYgNjBMNDYgNTlMNDUgNTlMNDUgNThMNDQgNThMNDQgNTdMNDMgNTdMNDMgNTZMNDQgNTZMNDQgNTVMNDUgNTVMNDUgNTZMNDYgNTZMNDYgNThMNDcgNThMNDcgNTlMNDggNTlMNDggNjBMNDkgNjBMNDkgNTlMNTAgNTlMNTAgNjBMNTEgNjBMNTEgNTlMNTAgNTlMNTAgNTdMNDggNTdMNDggNThMNDcgNThMNDcgNTZMNDYgNTZMNDYgNTVMNDUgNTVMNDUgNTRMNDQgNTRMNDQgNTNMNDMgNTNMNDMgNTBMNDEgNTBMNDEgNDhMNDIgNDhMNDIgNDlMNDMgNDlMNDMgNDZMNDQgNDZMNDQgNDdMNDUgNDdMNDUgNDhMNDYgNDhMNDYgNTFMNDUgNTFMNDUgNDlMNDQgNDlMNDQgNTFMNDUgNTFMNDUgNTNMNDYgNTNMNDYgNTRMNDggNTRMNDggNTNMNDYgNTNMNDYgNTFMNDcgNTFMNDcgNTJMNDkgNTJMNDkgNTVMNDggNTVMNDggNTZMNDkgNTZMNDkgNTVMNTAgNTVMNTAgNTZMNTIgNTZMNTIgNTRMNTAgNTRMNTAgNTFMNTEgNTFMNTEgNTNMNTIgNTNMNTIgNTJMNTMgNTJMNTMgNTFMNTQgNTFMNTQgNTJMNTcgNTJMNTcgNTFMNTYgNTFMNTYgNTBMNTUgNTBMNTUgNDlMNTIgNDlMNTIgNDhMNTMgNDhMNTMgNDZMNTIgNDZMNTIgNDhMNTEgNDhMNTEgNDZMNTAgNDZMNTAgNDRMNTEgNDRMNTEgNDVMNTIgNDVMNTIgNDRMNTMgNDRMNTMgNDNMNTQgNDNMNTQgNDdMNTUgNDdMNTUgNDZMNTYgNDZMNTYgNDVMNTcgNDVMNTcgNDRMNTggNDRMNTggNDNMNTcgNDNMNTcgNDJMNTYgNDJMNTYgNDFMNTUgNDFMNTUgNDJMNTQgNDJMNTQgNDBMNTcgNDBMNTcgNDFMNTggNDFMNTggMzlMNTYgMzlMNTYgMzZMNTcgMzZMNTcgMzhMNTkgMzhMNTkgMzZMNTggMzZMNTggMzVMNTYgMzVMNTYgMzZMNTQgMzZMNTQgMzVMNTUgMzVMNTUgMzRMNTYgMzRMNTYgMzNMNTQgMzNMNTQgMzVMNTEgMzVMNTEgMzRMNTMgMzRMNTMgMzNMNTIgMzNMNTIgMzJMNTEgMzJMNTEgMzFMNTIgMzFMNTIgMjlMNTEgMjlMNTEgMzBMNTAgMzBMNTAgMjlMNDggMjlMNDggMzBMNDcgMzBMNDcgMjlMNDYgMjlMNDYgMzBMNDUgMzBMNDUgMjlMNDQgMjlMNDQgMzBMNDIgMzBMNDIgMzFMNDMgMzFMNDMgMzJMNDEgMzJMNDEgMzFMNDAgMzFMNDAgMzBMNDEgMzBMNDEgMjhMNDIgMjhMNDIgMjlMNDMgMjlMNDMgMjhMNDIgMjhMNDIgMjdMNDEgMjdMNDEgMjZMNDIgMjZMNDIgMjVMNDMgMjVMNDMgMjZMNDQgMjZMNDQgMjdMNDUgMjdMNDUgMjVMNDQgMjVMNDQgMjRMNDAgMjRMNDAgMjVMMzkgMjVMMzkgMjZMNDAgMjZMNDAgMjdMMzkgMjdMMzkgMjhMMzggMjhMMzggMjlMMzcgMjlMMzcgMzBMMzYgMzBMMzYgMzJMMzcgMzJMMzcgMzBMMzggMzBMMzggMjlMMzkgMjlMMzkgMzFMMzggMzFMMzggMzJMNDAgMzJMNDAgMzdMMzkgMzdMMzkgMzhMMzggMzhMMzggMzdMMzYgMzdMMzYgMzhMMzUgMzhMMzUgMzZMMzcgMzZMMzcgMzVMMzggMzVMMzggMzZMMzkgMzZMMzkgMzVMMzggMzVMMzggMzNMMzQgMzNMMzQgMzJMMzMgMzJMMzMgMzNMMzEgMzNMMzEgMzRMMzAgMzRMMzAgMzNMMjkgMzNMMjkgMzRMMzAgMzRMMzAgMzVMMjkgMzVMMjkgMzZMMjcgMzZMMjcgMzVMMjYgMzVMMjYgMzZMMjcgMzZMMjcgMzdMMjUgMzdMMjUgMzhMMjggMzhMMjggMzdMMzAgMzdMMzAgMzZMMzEgMzZMMzEgMzVMMzIgMzVMMzIgMzdMMzMgMzdMMzMgMzhMMjkgMzhMMjkgNDBMMjggNDBMMjggMzlMMjcgMzlMMjcgNDBMMjYgNDBMMjYgMzlMMjUgMzlMMjUgNDBMMjQgNDBMMjQgNDFMMjMgNDFMMjMgNDBMMjIgNDBMMjIgMzlMMjMgMzlMMjMgMzdMMjQgMzdMMjQgMzZMMjUgMzZMMjUgMzRMMjggMzRMMjggMzBMMjcgMzBMMjcgMjlMMjggMjlMMjggMjhMMzIgMjhMMzIgMjdMMjcgMjdMMjcgMjZMMjYgMjZMMjYgMjVMMjUgMjVMMjUgMjRMMjQgMjRMMjQgMjVMMjMgMjVMMjMgMjNMMjIgMjNMMjIgMjVMMjEgMjVMMjEgMjZMMjAgMjZMMjAgMjdMMTggMjdMMTggMjVMMjAgMjVMMjAgMjRMMjEgMjRMMjEgMjNMMjAgMjNMMjAgMjRMMTggMjRMMTggMjVMMTcgMjVMMTcgMjRMMTYgMjRMMTYgMjJMMTcgMjJMMTcgMjNMMTggMjNMMTggMjJMMTcgMjJMMTcgMjBMMTkgMjBMMTkgMjFMMjEgMjFMMjEgMjJMMjMgMjJMMjMgMjFMMjQgMjFMMjQgMTlMMjEgMTlMMjEgMThMMjMgMThMMjMgMTdMMjQgMTdMMjQgMThMMjUgMThMMjUgMjFMMjYgMjFMMjYgMTlMMjkgMTlMMjkgMjBMMjcgMjBMMjcgMjJMMjQgMjJMMjQgMjNMMjYgMjNMMjYgMjRMMjggMjRMMjggMjZMMjkgMjZMMjkgMjRMMzEgMjRMMzEgMjNMMzMgMjNMMzMgMjRMMzQgMjRMMzQgMjdMMzUgMjdMMzUgMjhMMzQgMjhMMzQgMzBMMzMgMzBMMzMgMzFMMzQgMzFMMzQgMzBMMzUgMzBMMzUgMjlMMzYgMjlMMzYgMjhMMzcgMjhMMzcgMjdMMzYgMjdMMzYgMjZMMzcgMjZMMzcgMjVMMzUgMjVMMzUgMjRMMzQgMjRMMzQgMjNMMzMgMjNMMzMgMjFMMzQgMjFMMzQgMjBMMzUgMjBMMzUgMTlMMzYgMTlMMzYgMjBMMzcgMjBMMzcgMTlMMzggMTlMMzggMTdMMzYgMTdMMzYgMThMMzUgMThMMzUgMTdMMzQgMTdMMzQgMThMMzUgMThMMzUgMTlMMzMgMTlMMzMgMThMMzIgMThMMzIgMTlMMzAgMTlMMzAgMTVMMjkgMTVMMjkgMTdMMjggMTdMMjggMTVMMjcgMTVMMjcgMTRMMjkgMTRMMjkgMTNMMzAgMTNMMzAgMTRMMzEgMTRMMzEgMTZMMzIgMTZMMzIgMTdMMzMgMTdMMzMgMTZMMzQgMTZMMzQgMTRMMzUgMTRMMzUgMTZMMzkgMTZMMzkgMTVMMzggMTVMMzggMTRMMzcgMTRMMzcgMTNMMzggMTNMMzggMTJMMzkgMTJMMzkgMTBMNDAgMTBMNDAgMTFMNDEgMTFMNDEgOUw0MyA5TDQzIDExTDQyIDExTDQyIDEyTDQwIDEyTDQwIDEzTDM5IDEzTDM5IDE0TDQwIDE0TDQwIDE3TDM5IDE3TDM5IDIwTDM4IDIwTDM4IDIxTDM5IDIxTDM5IDIwTDQwIDIwTDQwIDIyTDM5IDIyTDM5IDIzTDQwIDIzTDQwIDIyTDQxIDIyTDQxIDIwTDQyIDIwTDQyIDIxTDQzIDIxTDQzIDIyTDQ0IDIyTDQ0IDIzTDQ3IDIzTDQ3IDI0TDQ2IDI0TDQ2IDI2TDQ3IDI2TDQ3IDI3TDQ4IDI3TDQ4IDI4TDUwIDI4TDUwIDI2TDQ5IDI2TDQ5IDI1TDQ4IDI1TDQ4IDIyTDUwIDIyTDUwIDIzTDQ5IDIzTDQ5IDI0TDUzIDI0TDUzIDI1TDUxIDI1TDUxIDI3TDUyIDI3TDUyIDI2TDU0IDI2TDU0IDI1TDU2IDI1TDU2IDIzTDU3IDIzTDU3IDI0TDU4IDI0TDU4IDIzTDU3IDIzTDU3IDIyTDU2IDIyTDU2IDIwTDU0IDIwTDU0IDIxTDU1IDIxTDU1IDIyTDUzIDIyTDUzIDIzTDUyIDIzTDUyIDIyTDUwIDIyTDUwIDIxTDQ4IDIxTDQ4IDIwTDQ2IDIwTDQ2IDE5TDQ3IDE5TDQ3IDE3TDQ4IDE3TDQ4IDE5TDQ5IDE5TDQ5IDE4TDUwIDE4TDUwIDE3TDUxIDE3TDUxIDE2TDUyIDE2TDUyIDE1TDUzIDE1TDUzIDEzTDUxIDEzTDUxIDE0TDUwIDE0TDUwIDE2TDQ5IDE2TDQ5IDE3TDQ4IDE3TDQ4IDE2TDQ3IDE2TDQ3IDE3TDQ2IDE3TDQ2IDE5TDQ1IDE5TDQ1IDE4TDQ0IDE4TDQ0IDE2TDQxIDE2TDQxIDE0TDQwIDE0TDQwIDEzTDQzIDEzTDQzIDE0TDQyIDE0TDQyIDE1TDQzIDE1TDQzIDE0TDQ0IDE0TDQ0IDExTDQ2IDExTDQ2IDEwTDQ3IDEwTDQ3IDExTDQ4IDExTDQ4IDEyTDQ5IDEyTDQ5IDEwTDUwIDEwTDUwIDlMNDkgOUw0OSAxMEw0OCAxMEw0OCA2TDQ3IDZMNDcgOUw0NiA5TDQ2IDEwTDQ1IDEwTDQ1IDlMNDMgOUw0MyA4TDQxIDhMNDEgN0w0MCA3TDQwIDZMMzkgNkwzOSA3TDM4IDdMMzggNkwzNyA2TDM3IDdMMzggN0wzOCA5TDM1IDlMMzUgOEwzNCA4TDM0IDZMMzUgNkwzNSA3TDM2IDdMMzYgNUwzOCA1TDM4IDRMNDAgNEw0MCAzTDQyIDNMNDIgNEw0NSA0TDQ1IDNMNDMgM0w0MyAyTDQwIDJMNDAgM0wzNyAzTDM3IDJaTTUxIDNMNTEgNEw1MiA0TDUyIDNaTTggNUw4IDdMOSA3TDkgNVpNMjkgNUwyOSA4TDMyIDhMMzIgNVpNMTMgNkwxMyAxMEwxMiAxMEwxMiAxM0wxNCAxM0wxNCAxMkwxNSAxMkwxNSAxMEwxNCAxMEwxNCA4TDE1IDhMMTUgN0wxNCA3TDE0IDZaTTMwIDZMMzAgN0wzMSA3TDMxIDZaTTAgOEwwIDlMMSA5TDEgMTFMMCAxMUwwIDEyTDIgMTJMMiA4Wk01NSA4TDU1IDlMNTQgOUw1NCAxMUw1NSAxMUw1NSAxMEw1NiAxMEw1NiAxMUw1NyAxMUw1NyA5TDU4IDlMNTggMTBMNjAgMTBMNjAgOUw2MSA5TDYxIDhMNTcgOEw1NyA5TDU2IDlMNTYgOFpNMjEgOUwyMSAxMEwyMiAxMEwyMiAxMUwyMyAxMUwyMyA5Wk0zOCA5TDM4IDEwTDM2IDEwTDM2IDExTDM1IDExTDM1IDEyTDM0IDEyTDM0IDExTDMzIDExTDMzIDEyTDMyIDEyTDMyIDExTDMxIDExTDMxIDEyTDMwIDEyTDMwIDEzTDMzIDEzTDMzIDE0TDM0IDE0TDM0IDEzTDM2IDEzTDM2IDExTDM3IDExTDM3IDEyTDM4IDEyTDM4IDEwTDM5IDEwTDM5IDlaTTkgMTFMOSAxMkwxMCAxMkwxMCAxMVpNMjMgMTJMMjMgMTVMMjQgMTVMMjQgMTdMMjcgMTdMMjcgMThMMjggMThMMjggMTdMMjcgMTdMMjcgMTZMMjYgMTZMMjYgMTVMMjQgMTVMMjQgMTRMMjUgMTRMMjUgMTJaTTU4IDEyTDU4IDE0TDU5IDE0TDU5IDEyWk0yIDEzTDIgMTRMMyAxNEwzIDEzWk03IDEzTDcgMTRMOCAxNEw4IDE1TDkgMTVMOSAxM1pNMTkgMTNMMTkgMTVMMjAgMTVMMjAgMTNaTTAgMTRMMCAxNUwxIDE1TDEgMTRaTTM2IDE0TDM2IDE1TDM3IDE1TDM3IDE0Wk01MSAxNEw1MSAxNUw1MiAxNUw1MiAxNFpNMzIgMTVMMzIgMTZMMzMgMTZMMzMgMTVaTTU2IDE2TDU2IDE3TDU3IDE3TDU3IDE2Wk00MSAxN0w0MSAxOEw0MCAxOEw0MCAxOUw0MSAxOUw0MSAxOEw0MyAxOEw0MyAxOUw0MiAxOUw0MiAyMEw0MyAyMEw0MyAxOUw0NCAxOUw0NCAxOEw0MyAxOEw0MyAxN1pNMiAxOEwyIDIwTDMgMjBMMyAxOUw0IDE5TDQgMThaTTE5IDE4TDE5IDE5TDIwIDE5TDIwIDE4Wk0zNiAxOEwzNiAxOUwzNyAxOUwzNyAxOFpNMzIgMTlMMzIgMjBMMzEgMjBMMzEgMjFMMzIgMjFMMzIgMjBMMzMgMjBMMzMgMTlaTTYgMjBMNiAyMUw3IDIxTDcgMjBaTTIxIDIwTDIxIDIxTDIyIDIxTDIyIDIwWk00NCAyMEw0NCAyMkw0NSAyMkw0NSAyMUw0NiAyMUw0NiAyMFpNNjAgMjBMNjAgMjJMNjEgMjJMNjEgMjBaTTI4IDIxTDI4IDIyTDI5IDIyTDI5IDIzTDI4IDIzTDI4IDI0TDI5IDI0TDI5IDIzTDMwIDIzTDMwIDIyTDI5IDIyTDI5IDIxWk00NyAyMUw0NyAyMkw0OCAyMkw0OCAyMVpNMzcgMjNMMzcgMjRMMzggMjRMMzggMjNaTTUzIDIzTDUzIDI0TDU1IDI0TDU1IDIzWk02MCAyM0w2MCAyNUw2MSAyNUw2MSAyM1pNMjQgMjVMMjQgMjdMMjMgMjdMMjMgMjZMMjEgMjZMMjEgMjhMMTcgMjhMMTcgMzBMMTkgMzBMMTkgMjlMMjAgMjlMMjAgMzBMMjEgMzBMMjEgMzFMMjIgMzFMMjIgMzJMMjMgMzJMMjMgMzNMMjQgMzNMMjQgMzRMMjUgMzRMMjUgMzNMMjcgMzNMMjcgMzJMMjQgMzJMMjQgMzFMMjYgMzFMMjYgMzBMMjUgMzBMMjUgMjlMMjcgMjlMMjcgMjdMMjUgMjdMMjUgMjVaTTMwIDI1TDMwIDI2TDMxIDI2TDMxIDI1Wk00MCAyNUw0MCAyNkw0MSAyNkw0MSAyNVpNNTcgMjVMNTcgMjZMNTggMjZMNTggMjVaTTUgMjZMNSAyN0w3IDI3TDcgMjZaTTIyIDI3TDIyIDI5TDIxIDI5TDIxIDMwTDIzIDMwTDIzIDMxTDI0IDMxTDI0IDMwTDIzIDMwTDIzIDI5TDI0IDI5TDI0IDI4TDI1IDI4TDI1IDI3TDI0IDI3TDI0IDI4TDIzIDI4TDIzIDI3Wk00MCAyN0w0MCAyOEwzOSAyOEwzOSAyOUw0MCAyOUw0MCAyOEw0MSAyOEw0MSAyN1pNNTMgMjdMNTMgMjhMNTQgMjhMNTQgMjdaTTEyIDI4TDEyIDMwTDExIDMwTDExIDMyTDEwIDMyTDEwIDM0TDkgMzRMOSAzNUw4IDM1TDggMzZMMTAgMzZMMTAgMzdMMTEgMzdMMTEgMzZMMTAgMzZMMTAgMzRMMTEgMzRMMTEgMzVMMTIgMzVMMTIgMzhMMTEgMzhMMTEgNDJMMTAgNDJMMTAgNDBMOSA0MEw5IDQzTDExIDQzTDExIDQ0TDE1IDQ0TDE1IDQyTDE2IDQyTDE2IDQxTDE0IDQxTDE0IDQyTDEyIDQyTDEyIDM5TDEzIDM5TDEzIDQwTDE0IDQwTDE0IDM5TDEzIDM5TDEzIDM4TDE0IDM4TDE0IDM1TDEyIDM1TDEyIDM0TDExIDM0TDExIDMzTDEzIDMzTDEzIDM0TDE1IDM0TDE1IDM1TDE2IDM1TDE2IDM0TDE3IDM0TDE3IDMzTDE4IDMzTDE4IDM0TDE5IDM0TDE5IDMyTDIwIDMyTDIwIDM0TDIyIDM0TDIyIDMzTDIxIDMzTDIxIDMyTDIwIDMyTDIwIDMxTDE5IDMxTDE5IDMyTDE3IDMyTDE3IDMzTDE1IDMzTDE1IDMxTDE2IDMxTDE2IDI5TDE0IDI5TDE0IDMxTDEzIDMxTDEzIDMyTDEyIDMyTDEyIDMwTDEzIDMwTDEzIDI4Wk01IDI5TDUgMzJMOCAzMkw4IDI5Wk0yOSAyOUwyOSAzMkwzMiAzMkwzMiAyOVpNNTMgMjlMNTMgMzJMNTYgMzJMNTYgMjlaTTU5IDI5TDU5IDMwTDYxIDMwTDYxIDI5Wk02IDMwTDYgMzFMNyAzMUw3IDMwWk0zMCAzMEwzMCAzMUwzMSAzMUwzMSAzMFpNNDggMzBMNDggMzJMNDcgMzJMNDcgMzFMNDYgMzFMNDYgMzJMNDQgMzJMNDQgMzNMNDEgMzNMNDEgMzRMNDMgMzRMNDMgMzVMNDQgMzVMNDQgMzNMNDUgMzNMNDUgMzRMNDYgMzRMNDYgMzJMNDcgMzJMNDcgMzVMNDYgMzVMNDYgMzZMNDQgMzZMNDQgMzhMNDMgMzhMNDMgMzdMNDIgMzdMNDIgMzVMNDEgMzVMNDEgMzdMNDAgMzdMNDAgMzhMNDIgMzhMNDIgNDBMNDQgNDBMNDQgNDFMNDAgNDFMNDAgNDBMNDEgNDBMNDEgMzlMMzkgMzlMMzkgNDBMMzggNDBMMzggMzhMMzcgMzhMMzcgMzlMMzUgMzlMMzUgMzhMMzQgMzhMMzQgNDBMMzIgNDBMMzIgMzlMMzEgMzlMMzEgNDBMMjkgNDBMMjkgNDFMMjggNDFMMjggNDBMMjcgNDBMMjcgNDFMMjQgNDFMMjQgNDNMMjYgNDNMMjYgNDJMMjcgNDJMMjcgNDNMMjggNDNMMjggNDVMMjkgNDVMMjkgNDZMMzAgNDZMMzAgNDdMMzIgNDdMMzIgNDZMMzQgNDZMMzQgNDdMMzMgNDdMMzMgNDhMMzUgNDhMMzUgNTBMMzQgNTBMMzQgNTFMMzYgNTFMMzYgNDlMMzcgNDlMMzcgNDhMMzYgNDhMMzYgNDdMMzUgNDdMMzUgNDZMMzQgNDZMMzQgNDVMMzYgNDVMMzYgNDFMMzcgNDFMMzcgNDRMMzggNDRMMzggNDNMMzkgNDNMMzkgNDJMNDAgNDJMNDAgNDNMNDEgNDNMNDEgNDZMNDAgNDZMNDAgNDdMNDIgNDdMNDIgNDZMNDMgNDZMNDMgNDVMNDIgNDVMNDIgNDRMNDQgNDRMNDQgNDZMNDYgNDZMNDYgNDVMNDcgNDVMNDcgNDdMNDYgNDdMNDYgNDhMNDcgNDhMNDcgNTBMNDggNTBMNDggNTFMNDkgNTFMNDkgNTBMNDggNTBMNDggNDlMNDkgNDlMNDkgNDdMNDggNDdMNDggNDZMNDkgNDZMNDkgNDRMNDggNDRMNDggNDNMNDcgNDNMNDcgNDJMNDYgNDJMNDYgMzlMNDggMzlMNDggNDFMNDkgNDFMNDkgNDBMNTIgNDBMNTIgMzlMNTMgMzlMNTMgNDBMNTQgNDBMNTQgMzlMNTMgMzlMNTMgMzdMNTIgMzdMNTIgMzhMNTEgMzhMNTEgMzVMNTAgMzVMNTAgMzZMNDggMzZMNDggMzNMNTAgMzNMNTAgMzRMNTEgMzRMNTEgMzJMNTAgMzJMNTAgMzFMNDkgMzFMNDkgMzBaTTU0IDMwTDU0IDMxTDU1IDMxTDU1IDMwWk02IDMzTDYgMzRMNyAzNEw3IDMzWk0zMyAzM0wzMyAzNEwzNCAzNEwzNCAzNUwzMyAzNUwzMyAzN0wzNCAzN0wzNCAzNkwzNSAzNkwzNSAzNEwzNCAzNEwzNCAzM1pNMzYgMzRMMzYgMzVMMzcgMzVMMzcgMzRaTTE4IDM1TDE4IDM2TDE3IDM2TDE3IDM3TDE4IDM3TDE4IDM4TDE2IDM4TDE2IDM2TDE1IDM2TDE1IDM5TDE2IDM5TDE2IDQwTDE3IDQwTDE3IDM5TDE4IDM5TDE4IDM4TDE5IDM4TDE5IDM5TDIwIDM5TDIwIDQwTDE4IDQwTDE4IDQxTDE3IDQxTDE3IDQzTDE2IDQzTDE2IDQ0TDE3IDQ0TDE3IDQ1TDE4IDQ1TDE4IDQ3TDE5IDQ3TDE5IDQ4TDIxIDQ4TDIxIDQ5TDIzIDQ5TDIzIDQ4TDIyIDQ4TDIyIDQ3TDE5IDQ3TDE5IDQ0TDIwIDQ0TDIwIDQ2TDIzIDQ2TDIzIDQ3TDI2IDQ3TDI2IDQ2TDI3IDQ2TDI3IDQ0TDI2IDQ0TDI2IDQ1TDI1IDQ1TDI1IDQ0TDI0IDQ0TDI0IDQ1TDIxIDQ1TDIxIDQyTDIzIDQyTDIzIDQxTDIxIDQxTDIxIDM5TDIwIDM5TDIwIDM4TDIxIDM4TDIxIDM3TDIyIDM3TDIyIDM2TDI0IDM2TDI0IDM1TDIxIDM1TDIxIDM2TDIwIDM2TDIwIDM1Wk00NiAzNkw0NiAzOEw0OCAzOEw0OCAzN0w0NyAzN0w0NyAzNlpNMTkgMzdMMTkgMzhMMjAgMzhMMjAgMzdaTTQ5IDM3TDQ5IDM4TDUwIDM4TDUwIDM5TDUxIDM5TDUxIDM4TDUwIDM4TDUwIDM3Wk00NCAzOEw0NCAzOUw0NSAzOUw0NSAzOFpNNiAzOUw2IDQwTDcgNDBMNyAzOVpNNCA0MEw0IDQxTDUgNDFMNSA0MFpNMzEgNDBMMzEgNDFMMjkgNDFMMjkgNDRMMzAgNDRMMzAgNDNMMzEgNDNMMzEgNDFMMzIgNDFMMzIgNDBaTTM0IDQwTDM0IDQxTDMzIDQxTDMzIDQyTDM0IDQyTDM0IDQzTDMyIDQzTDMyIDQ0TDMxIDQ0TDMxIDQ2TDMyIDQ2TDMyIDQ1TDMzIDQ1TDMzIDQ0TDM0IDQ0TDM0IDQzTDM1IDQzTDM1IDQxTDM2IDQxTDM2IDQwWk0zNyA0MEwzNyA0MUwzOCA0MUwzOCA0MFpNNTkgNDBMNTkgNDFMNjAgNDFMNjAgNDBaTTE5IDQxTDE5IDQzTDIwIDQzTDIwIDQyTDIxIDQyTDIxIDQxWk00NCA0MUw0NCA0Mkw0NSA0Mkw0NSA0M0w0NiA0M0w0NiA0Mkw0NSA0Mkw0NSA0MVpNNTAgNDFMNTAgNDNMNTEgNDNMNTEgNDRMNTIgNDRMNTIgNDNMNTMgNDNMNTMgNDJMNTIgNDJMNTIgNDFaTTYgNDJMNiA0M0w3IDQzTDcgNDJaTTExIDQyTDExIDQzTDEyIDQzTDEyIDQyWk00MSA0Mkw0MSA0M0w0MiA0M0w0MiA0MlpNNTUgNDJMNTUgNDNMNTYgNDNMNTYgNDJaTTIyIDQzTDIyIDQ0TDIzIDQ0TDIzIDQzWk02IDQ0TDYgNDVMNCA0NUw0IDQ2TDYgNDZMNiA0N0w3IDQ3TDcgNDZMNiA0Nkw2IDQ1TDcgNDVMNyA0NFpNMTIgNDVMMTIgNDZMMTYgNDZMMTYgNDdMMTMgNDdMMTMgNDhMMTUgNDhMMTUgNDlMMTYgNDlMMTYgNDdMMTcgNDdMMTcgNDZMMTYgNDZMMTYgNDVaTTQgNDdMNCA0OEw1IDQ4TDUgNDdaTTUwIDQ5TDUwIDUwTDUxIDUwTDUxIDUxTDUyIDUxTDUyIDQ5Wk02MCA0OUw2MCA1MEw2MSA1MEw2MSA0OVpNMTggNTBMMTggNTFMMTkgNTFMMTkgNTBaTTI5IDUwTDI5IDUxTDMwIDUxTDMwIDUwWk0zIDUxTDMgNTJMNCA1Mkw0IDUxWk00MSA1MUw0MSA1M0w0MiA1M0w0MiA1MVpNMjAgNTJMMjAgNTRMMTggNTRMMTggNTNMMTcgNTNMMTcgNTRMMTggNTRMMTggNTVMMTYgNTVMMTYgNTRMMTUgNTRMMTUgNTVMMTYgNTVMMTYgNTZMMTcgNTZMMTcgNTdMMTggNTdMMTggNTZMMjAgNTZMMjAgNTVMMjEgNTVMMjEgNTNMMjIgNTNMMjIgNTJaTTI5IDUzTDI5IDU2TDMyIDU2TDMyIDUzWk01MyA1M0w1MyA1Nkw1NiA1Nkw1NiA1M1pNNTcgNTNMNTcgNTZMNTggNTZMNTggNTRMNTkgNTRMNTkgNTNaTTIyIDU0TDIyIDU1TDIzIDU1TDIzIDU0Wk0zMCA1NEwzMCA1NUwzMSA1NUwzMSA1NFpNMzUgNTRMMzUgNTVMMzMgNTVMMzMgNTdMMzQgNTdMMzQgNThMMzMgNThMMzMgNTlMMzIgNTlMMzIgNjBMMzQgNjBMMzQgNTlMMzUgNTlMMzUgNTdMMzQgNTdMMzQgNTZMMzYgNTZMMzYgNTRaTTU0IDU0TDU0IDU1TDU1IDU1TDU1IDU0Wk05IDU1TDkgNTZMMTAgNTZMMTAgNTVaTTEyIDU1TDEyIDU2TDEzIDU2TDEzIDU1Wk01MyA2MEw1MyA2MUw1NSA2MUw1NSA2MFpNMCAwTDAgN0w3IDdMNyAwWk0xIDFMMSA2TDYgNkw2IDFaTTIgMkwyIDVMNSA1TDUgMlpNNTQgMEw1NCA3TDYxIDdMNjEgMFpNNTUgMUw1NSA2TDYwIDZMNjAgMVpNNTYgMkw1NiA1TDU5IDVMNTkgMlpNMCA1NEwwIDYxTDcgNjFMNyA1NFpNMSA1NUwxIDYwTDYgNjBMNiA1NVpNMiA1NkwyIDU5TDUgNTlMNSA1NloiIGZpbGw9IiMwMDAwMDAiLz48L2c+PC9nPjwvc3ZnPgo=" alt="">
            </div>
            <div class="widget">
                <p>Wenn Sie den QR-Code nicht scannen können, geben Sie stattdessen diesen Schlüssel ein:</p>
                <code style="word-break:break-all">S4EVCLQCLGGYG5LMZJYNB5AP3KZLUQAWO6CPV7XAEAOFJE5FA5EL2OKL54ZLN4XO7</code>
            </div>
            <div class="widget widget-text">
                <label for="verify">Bestätigungscode</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="none" autocomplete="one-time-code" required="">
                <p class="help">Bitte geben Sie den von Ihrer 2FA/TOTP-App generierten Bestätigungscode ein.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="submit">Aktivieren</button>
            </div>
        </div>
    </form>
</div>


### Template-Einstellungen

**Modul-Template:** Hier kannst du das Standard-Template `ce_two_factor` überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_two_factor two-factor block">

    <h2>Zwei-Faktor-Authentifizierung</h2>

    <p>Bitte scannen Sie den QR-Code mit Ihrer 2FA/TOTP-App.</p>
    <form class="tl_two_factor_form" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_two_factor">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjE4MCIgaGVpZ2h0PSIxODAiIHZpZXdCb3g9IjAgMCAxODAgMTgwIj48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTgwIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2ZlZmVmZSIvPjxnIHRyYW5zZm9ybT0ic2NhbGUoMi45NTEpIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDApIj48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04IDBMOCA0TDEwIDRMMTAgN0wxMSA3TDExIDRMMTAgNEwxMCAzTDExIDNMMTEgMkwxMyAyTDEzIDZMMTIgNkwxMiA4TDEwIDhMMTAgOUw3IDlMNyA4TDQgOEw0IDlMNSA5TDUgMTFMNCAxMUw0IDEwTDMgMTBMMyAxMUw0IDExTDQgMTVMNyAxNUw3IDE2TDYgMTZMNiAxN0w3IDE3TDcgMTZMOCAxNkw4IDE4TDUgMThMNSAxNkwzIDE2TDMgMTdMMiAxN0wyIDE2TDAgMTZMMCAxN0wxIDE3TDEgMThMMCAxOEwwIDE5TDEgMTlMMSAyMEwyIDIwTDIgMjFMMSAyMUwxIDI0TDIgMjRMMiAyM0wzIDIzTDMgMjRMNCAyNEw0IDI1TDAgMjVMMCAyOEwxIDI4TDEgMjZMMyAyNkwzIDI3TDIgMjdMMiAyOUwxIDI5TDEgMzBMMCAzMEwwIDMzTDUgMzNMNSAzNUw0IDM1TDQgMzRMMyAzNEwzIDM1TDQgMzVMNCAzNkwyIDM2TDIgMzVMMSAzNUwxIDM0TDAgMzRMMCAzNUwxIDM1TDEgMzZMMCAzNkwwIDM3TDEgMzdMMSAzOEwyIDM4TDIgMzdMMyAzN0wzIDM4TDQgMzhMNCAzNkw1IDM2TDUgMzlMNCAzOUw0IDQwTDMgNDBMMyAzOUwwIDM5TDAgNDBMMyA0MEwzIDQyTDAgNDJMMCA0NUwxIDQ1TDEgNDRMMiA0NEwyIDQ2TDAgNDZMMCA0OEwxIDQ4TDEgNDdMMiA0N0wyIDQ5TDEgNDlMMSA1MEwyIDUwTDIgNTFMMCA1MUwwIDUzTDQgNTNMNCA1Mkw1IDUyTDUgNTFMOCA1MUw4IDUwTDkgNTBMOSA1MkwxNSA1MkwxNSA1M0wxNCA1M0wxNCA1NEwxMiA1NEwxMiA1NUwxMCA1NUwxMCA1NEw5IDU0TDkgNTNMOCA1M0w4IDUyTDYgNTJMNiA1M0w4IDUzTDggNTRMOSA1NEw5IDU1TDggNTVMOCA1N0wxMCA1N0wxMCA1OEw5IDU4TDkgNTlMOCA1OUw4IDYxTDkgNjFMOSA2MEwxMCA2MEwxMCA2MUwxMiA2MUwxMiA2MEwxMyA2MEwxMyA2MUwxNCA2MUwxNCA1OUwxMiA1OUwxMiA2MEwxMSA2MEwxMSA1OUwxMCA1OUwxMCA1OEwxMSA1OEwxMSA1NkwxMiA1NkwxMiA1N0wxNCA1N0wxNCA1NkwxNSA1NkwxNSA1OUwxNiA1OUwxNiA2MEwxNSA2MEwxNSA2MUwxNiA2MUwxNiA2MEwxNyA2MEwxNyA2MUwyMiA2MUwyMiA2MEwyMyA2MEwyMyA2MUwyNSA2MUwyNSA2MEwyNiA2MEwyNiA2MUwyOCA2MUwyOCA2MEwyNiA2MEwyNiA1OEwyNyA1OEwyNyA1OUwyOSA1OUwyOSA2MUwzMCA2MUwzMCA1N0wzMSA1N0wzMSA1OEwzMiA1OEwzMiA1OUwzMSA1OUwzMSA2MEwzMiA2MEwzMiA2MUwzNSA2MUwzNSA2MEwzNiA2MEwzNiA2MUwzNyA2MUwzNyA2MEwzNiA2MEwzNiA1N0wzNyA1N0wzNyA1NEwzNiA1NEwzNiA1M0wzOCA1M0wzOCA1NEwzOSA1NEwzOSA1M0w0MCA1M0w0MCA1NEw0MSA1NEw0MSA1NUwzOSA1NUwzOSA1N0wzOCA1N0wzOCA1OEwzOSA1OEwzOSA1OUw0MCA1OUw0MCA1Nkw0MSA1Nkw0MSA1OUw0MiA1OUw0MiA2MUw0MyA2MUw0MyA1OUw0NCA1OUw0NCA2MUw0NiA2MUw0NiA2MEw0NyA2MEw0NyA2MUw0OSA2MUw0OSA2MEw1MCA2MEw1MCA2MUw1MSA2MUw1MSA2MEw1MiA2MEw1MiA1OUw1MyA1OUw1MyA1OEw1MiA1OEw1MiA1OUw1MSA1OUw1MSA1N0w1NCA1N0w1NCA1OEw1NSA1OEw1NSA1N0w1NyA1N0w1NyA1OEw1OCA1OEw1OCA2MEw1NiA2MEw1NiA2MUw1OCA2MUw1OCA2MEw1OSA2MEw1OSA2MUw2MSA2MUw2MSA2MEw2MCA2MEw2MCA1OEw2MSA1OEw2MSA1Nkw2MCA1Nkw2MCA1OEw1OCA1OEw1OCA1N0w1OSA1N0w1OSA1NEw2MSA1NEw2MSA1Mkw1OSA1Mkw1OSA0OUw1OCA0OUw1OCA1MEw1NyA1MEw1NyA0OUw1NSA0OUw1NSA0OEw1NiA0OEw1NiA0Nkw1OCA0Nkw1OCA0OEw1OSA0OEw1OSA0N0w2MCA0N0w2MCA0OEw2MSA0OEw2MSA0N0w2MCA0N0w2MCA0NUw2MSA0NUw2MSA0NEw2MCA0NEw2MCA0NUw1OSA0NUw1OSA0Nkw1OCA0Nkw1OCA0NEw1OSA0NEw1OSA0M0w2MCA0M0w2MCA0Mkw2MSA0Mkw2MSA0MEw2MCA0MEw2MCAzNkw2MSAzNkw2MSAzNUw2MCAzNUw2MCAzNkw1OSAzNkw1OSAzNUw1OCAzNUw1OCAzM0w2MCAzM0w2MCAzNEw2MSAzNEw2MSAzMUw1NyAzMUw1NyAyOEw1NSAyOEw1NSAyN0w1NiAyN0w1NiAyNkw1NyAyNkw1NyAyN0w1OCAyN0w1OCAyOEw1OSAyOEw1OSAyN0w1OCAyN0w1OCAyNkw1OSAyNkw1OSAyMkw1OCAyMkw1OCAyMUw1OSAyMUw1OSAxOUw2MCAxOUw2MCAxN0w1OSAxN0w1OSAxOEw1OCAxOEw1OCAxOUw1NyAxOUw1NyAyMEw1NiAyMEw1NiAxOUw1MyAxOUw1MyAyMkw1MiAyMkw1MiAyMUw1MCAyMUw1MCAyMEw0OSAyMEw0OSAxOUw1MCAxOUw1MCAxOEw1MiAxOEw1MiAxN0w1MyAxN0w1MyAxOEw1NSAxOEw1NSAxN0w1MyAxN0w1MyAxNkw1NSAxNkw1NSAxNUw1NCAxNUw1NCAxNEw1NiAxNEw1NiAxNUw1NyAxNUw1NyAxNEw1OCAxNEw1OCAxNkw2MSAxNkw2MSAxNUw1OSAxNUw1OSAxNEw2MSAxNEw2MSAxM0w2MCAxM0w2MCAxMkw2MSAxMkw2MSAxMUw2MCAxMUw2MCAxMkw1OSAxMkw1OSAxMUw1OCAxMUw1OCAxMkw1NiAxMkw1NiAxM0w1NCAxM0w1NCAxMkw1MyAxMkw1MyAxMUw1MiAxMUw1MiAxMkw1MSAxMkw1MSAxM0w1MCAxM0w1MCAxNEw0OSAxNEw0OSAxNUw0NyAxNUw0NyAxNkw0NiAxNkw0NiAxN0w0NSAxN0w0NSAxNkw0NCAxNkw0NCAxNUw0NSAxNUw0NSAxNEw0NiAxNEw0NiAxMUw0NyAxMUw0NyAxM0w0OSAxM0w0OSAxMkw1MCAxMkw1MCAxMUw1MSAxMUw1MSAxMEw1MiAxMEw1MiA4TDUzIDhMNTMgNkw1MiA2TDUyIDhMNTAgOEw1MCA3TDUxIDdMNTEgNUw1MiA1TDUyIDRMNTMgNEw1MyAwTDUxIDBMNTEgMkw1MCAyTDUwIDdMNDkgN0w0OSA1TDQ3IDVMNDcgNkw0NiA2TDQ2IDlMNDUgOUw0NSA2TDQ0IDZMNDQgN0w0MyA3TDQzIDZMNDIgNkw0MiA3TDQxIDdMNDEgNkw0MCA2TDQwIDRMNDEgNEw0MSA1TDQ2IDVMNDYgMkw0NyAyTDQ3IDNMNDkgM0w0OSAyTDQ4IDJMNDggMUw0NiAxTDQ2IDBMNDUgMEw0NSAxTDQ0IDFMNDQgMEw0MSAwTDQxIDFMNDAgMUw0MCAyTDM5IDJMMzkgMEwzOCAwTDM4IDFMMzcgMUwzNyAwTDM1IDBMMzUgMkwzMyAyTDMzIDFMMzQgMUwzNCAwTDMzIDBMMzMgMUwzMiAxTDMyIDJMMzEgMkwzMSA0TDMwIDRMMzAgM0wyOSAzTDI5IDJMMjggMkwyOCAzTDI5IDNMMjkgNEwyOCA0TDI4IDdMMjcgN0wyNyA2TDI2IDZMMjYgOEwyOCA4TDI4IDlMMjQgOUwyNCA4TDI1IDhMMjUgNkwyNCA2TDI0IDVMMjUgNUwyNSA0TDI2IDRMMjYgNUwyNyA1TDI3IDRMMjYgNEwyNiAzTDI1IDNMMjUgNEwyMyA0TDIzIDNMMjQgM0wyNCAyTDI1IDJMMjUgMEwyNCAwTDI0IDFMMjMgMUwyMyAyTDIyIDJMMjIgNEwyMyA0TDIzIDZMMjIgNkwyMiA1TDIxIDVMMjEgNEwyMCA0TDIwIDdMMTkgN0wxOSA0TDE4IDRMMTggN0wxOSA3TDE5IDhMMTggOEwxOCA5TDE3IDlMMTcgMTBMMTggMTBMMTggMTFMMTcgMTFMMTcgMTJMMTYgMTJMMTYgN0wxNyA3TDE3IDZMMTYgNkwxNiA3TDE1IDdMMTUgNUwxNiA1TDE2IDRMMTcgNEwxNyAzTDE2IDNMMTYgNEwxNCA0TDE0IDJMMTUgMkwxNSAxTDE2IDFMMTYgMkwxOCAyTDE4IDNMMTkgM0wxOSAyTDIwIDJMMjAgM0wyMSAzTDIxIDJMMjAgMkwyMCAxTDIyIDFMMjIgMEwyMCAwTDIwIDFMMTkgMUwxOSAwTDE4IDBMMTggMUwxNyAxTDE3IDBMMTMgMEwxMyAxTDEyIDFMMTIgMEwxMSAwTDExIDJMOSAyTDkgMFpNMjYgMEwyNiAyTDI3IDJMMjcgMUwyOCAxTDI4IDBaTTI5IDBMMjkgMUwzMSAxTDMxIDBaTTEzIDFMMTMgMkwxNCAyTDE0IDFaTTE4IDFMMTggMkwxOSAyTDE5IDFaTTQ1IDFMNDUgMkw0NiAyTDQ2IDFaTTM2IDJMMzYgM0wzNSAzTDM1IDRMMzQgNEwzNCAzTDMzIDNMMzMgNUwzNCA1TDM0IDZMMzMgNkwzMyA4TDM0IDhMMzQgMTBMMzIgMTBMMzIgOUwzMSA5TDMxIDExTDI5IDExTDI5IDEyTDI4IDEyTDI4IDEzTDI3IDEzTDI3IDE0TDI2IDE0TDI2IDEyTDI3IDEyTDI3IDExTDI4IDExTDI4IDEwTDI5IDEwTDI5IDlMMjggOUwyOCAxMEwyNyAxMEwyNyAxMUwyNiAxMUwyNiAxMkwyNSAxMkwyNSAxMUwyNCAxMUwyNCA5TDIzIDlMMjMgOEwyNCA4TDI0IDZMMjMgNkwyMyA3TDIyIDdMMjIgNkwyMSA2TDIxIDdMMjAgN0wyMCA4TDIxIDhMMjEgOUwxOSA5TDE5IDExTDE4IDExTDE4IDEyTDE5IDEyTDE5IDExTDIwIDExTDIwIDEwTDIxIDEwTDIxIDEyTDIyIDEyTDIyIDEzTDIxIDEzTDIxIDE1TDIyIDE1TDIyIDE2TDIzIDE2TDIzIDE3TDIxIDE3TDIxIDE4TDIwIDE4TDIwIDE3TDE5IDE3TDE5IDE4TDE4IDE4TDE4IDE5TDE3IDE5TDE3IDIwTDE2IDIwTDE2IDIyTDE0IDIyTDE0IDIzTDEzIDIzTDEzIDIyTDEyIDIyTDEyIDIxTDggMjFMOCAxOUw5IDE5TDkgMjBMMTIgMjBMMTIgMTlMOSAxOUw5IDE4TDEzIDE4TDEzIDIxTDE0IDIxTDE0IDIwTDE1IDIwTDE1IDE5TDE2IDE5TDE2IDE4TDE3IDE4TDE3IDE2TDE2IDE2TDE2IDE3TDE1IDE3TDE1IDE5TDE0IDE5TDE0IDE3TDEzIDE3TDEzIDE1TDE0IDE1TDE0IDE2TDE1IDE2TDE1IDE0TDE2IDE0TDE2IDE1TDE3IDE1TDE3IDE0TDE4IDE0TDE4IDEzTDE1IDEzTDE1IDE0TDEzIDE0TDEzIDE1TDEyIDE1TDEyIDE0TDExIDE0TDExIDEwTDkgMTBMOSAxMUw4IDExTDggMTBMNyAxMEw3IDlMNiA5TDYgMTBMNyAxMEw3IDExTDYgMTFMNiAxMkw3IDEyTDcgMTNMNSAxM0w1IDE0TDcgMTRMNyAxNUw4IDE1TDggMTZMOSAxNkw5IDE1TDEwIDE1TDEwIDE2TDExIDE2TDExIDE1TDEyIDE1TDEyIDE3TDkgMTdMOSAxOEw4IDE4TDggMTlMNSAxOUw1IDIxTDMgMjFMMyAyMkw3IDIyTDcgMjNMNCAyM0w0IDI0TDcgMjRMNyAyNUw1IDI1TDUgMjZMNCAyNkw0IDI3TDMgMjdMMyAyOUwyIDI5TDIgMzBMMSAzMEwxIDMxTDIgMzFMMiAzMEwzIDMwTDMgMzFMNCAzMUw0IDMwTDMgMzBMMyAyOUw0IDI5TDQgMjdMNSAyN0w1IDI4TDkgMjhMOSAyOUwxMCAyOUwxMCAyNkw4IDI2TDggMjNMOSAyM0w5IDI1TDExIDI1TDExIDI0TDEwIDI0TDEwIDIyTDEyIDIyTDEyIDIzTDEzIDIzTDEzIDI0TDE0IDI0TDE0IDIzTDE1IDIzTDE1IDI0TDE2IDI0TDE2IDI4TDE1IDI4TDE1IDI1TDE0IDI1TDE0IDI3TDEzIDI3TDEzIDI2TDExIDI2TDExIDMwTDEwIDMwTDEwIDMyTDkgMzJMOSAzNEw4IDM0TDggMzVMNiAzNUw2IDM2TDcgMzZMNyAzN0w2IDM3TDYgMzhMNyAzOEw3IDM3TDkgMzdMOSAzOUw4IDM5TDggNDFMNiA0MUw2IDQyTDUgNDJMNSA0M0wyIDQzTDIgNDRMNCA0NEw0IDQ1TDMgNDVMMyA0NkwyIDQ2TDIgNDdMMyA0N0wzIDQ5TDIgNDlMMiA1MEw0IDUwTDQgNDlMNSA0OUw1IDUwTDcgNTBMNyA0OUw2IDQ5TDYgNDhMNyA0OEw3IDQ3TDggNDdMOCA0Nkw3IDQ2TDcgNDVMOSA0NUw5IDQ0TDEwIDQ0TDEwIDQ2TDkgNDZMOSA0N0wxMiA0N0wxMiA0OEwxMSA0OEwxMSA0OUwxMCA0OUwxMCA0OEw4IDQ4TDggNDlMMTAgNDlMMTAgNTFMMTQgNTFMMTQgNTBMMTEgNTBMMTEgNDlMMTIgNDlMMTIgNDhMMTMgNDhMMTMgNDlMMTUgNDlMMTUgNTFMMTYgNTFMMTYgNTBMMTcgNTBMMTcgNDhMMTkgNDhMMTkgNDlMMjEgNDlMMjEgNTBMMjAgNTBMMjAgNTJMMTkgNTJMMTkgNTNMMTggNTNMMTggNTJMMTcgNTJMMTcgNTNMMTUgNTNMMTUgNTRMMTQgNTRMMTQgNTVMMTUgNTVMMTUgNTZMMTYgNTZMMTYgNThMMTggNThMMTggNTdMMjAgNTdMMjAgNTZMMjIgNTZMMjIgNThMMjAgNThMMjAgNTlMMTkgNTlMMTkgNjBMMjIgNjBMMjIgNThMMjMgNThMMjMgNjBMMjUgNjBMMjUgNThMMjYgNThMMjYgNTdMMjUgNTdMMjUgNThMMjMgNThMMjMgNTVMMjQgNTVMMjQgNTZMMjUgNTZMMjUgNTVMMjYgNTVMMjYgNTZMMjcgNTZMMjcgNThMMjkgNThMMjkgNTdMMjggNTdMMjggNTVMMjcgNTVMMjcgNTNMMjggNTNMMjggNTJMMjcgNTJMMjcgNTNMMjUgNTNMMjUgNTVMMjQgNTVMMjQgNTRMMjMgNTRMMjMgNTNMMjQgNTNMMjQgNTFMMjIgNTFMMjIgNTBMMjMgNTBMMjMgNDlMMjQgNDlMMjQgNTBMMjYgNTBMMjYgNTFMMjcgNTFMMjcgNTBMMjggNTBMMjggNDhMMjcgNDhMMjcgNDlMMjQgNDlMMjQgNDhMMjYgNDhMMjYgNDdMMjcgNDdMMjcgNDZMMjggNDZMMjggNDdMMzAgNDdMMzAgNDhMMzEgNDhMMzEgNDlMMzIgNDlMMzIgNDhMMzMgNDhMMzMgNDlMMzQgNDlMMzQgNTBMMzIgNTBMMzIgNTJMMzMgNTJMMzMgNTNMMzQgNTNMMzQgNTJMMzUgNTJMMzUgNTNMMzYgNTNMMzYgNTFMMzcgNTFMMzcgNTJMMzggNTJMMzggNDlMMzkgNDlMMzkgNDhMMzcgNDhMMzcgNDdMMzYgNDdMMzYgNDZMMzggNDZMMzggNDVMNDAgNDVMNDAgNDZMMzkgNDZMMzkgNDdMNDAgNDdMNDAgNTBMMzkgNTBMMzkgNTFMNDAgNTFMNDAgNTNMNDEgNTNMNDEgNTRMNDIgNTRMNDIgNTNMNDMgNTNMNDMgNTVMNDIgNTVMNDIgNTdMNDMgNTdMNDMgNThMNDQgNThMNDQgNTlMNDUgNTlMNDUgNjBMNDYgNjBMNDYgNTlMNDUgNTlMNDUgNThMNDQgNThMNDQgNTdMNDMgNTdMNDMgNTZMNDQgNTZMNDQgNTVMNDUgNTVMNDUgNTZMNDYgNTZMNDYgNThMNDcgNThMNDcgNTlMNDggNTlMNDggNjBMNDkgNjBMNDkgNTlMNTAgNTlMNTAgNjBMNTEgNjBMNTEgNTlMNTAgNTlMNTAgNTdMNDggNTdMNDggNThMNDcgNThMNDcgNTZMNDYgNTZMNDYgNTVMNDUgNTVMNDUgNTRMNDQgNTRMNDQgNTNMNDMgNTNMNDMgNTBMNDEgNTBMNDEgNDhMNDIgNDhMNDIgNDlMNDMgNDlMNDMgNDZMNDQgNDZMNDQgNDdMNDUgNDdMNDUgNDhMNDYgNDhMNDYgNTFMNDUgNTFMNDUgNDlMNDQgNDlMNDQgNTFMNDUgNTFMNDUgNTNMNDYgNTNMNDYgNTRMNDggNTRMNDggNTNMNDYgNTNMNDYgNTFMNDcgNTFMNDcgNTJMNDkgNTJMNDkgNTVMNDggNTVMNDggNTZMNDkgNTZMNDkgNTVMNTAgNTVMNTAgNTZMNTIgNTZMNTIgNTRMNTAgNTRMNTAgNTFMNTEgNTFMNTEgNTNMNTIgNTNMNTIgNTJMNTMgNTJMNTMgNTFMNTQgNTFMNTQgNTJMNTcgNTJMNTcgNTFMNTYgNTFMNTYgNTBMNTUgNTBMNTUgNDlMNTIgNDlMNTIgNDhMNTMgNDhMNTMgNDZMNTIgNDZMNTIgNDhMNTEgNDhMNTEgNDZMNTAgNDZMNTAgNDRMNTEgNDRMNTEgNDVMNTIgNDVMNTIgNDRMNTMgNDRMNTMgNDNMNTQgNDNMNTQgNDdMNTUgNDdMNTUgNDZMNTYgNDZMNTYgNDVMNTcgNDVMNTcgNDRMNTggNDRMNTggNDNMNTcgNDNMNTcgNDJMNTYgNDJMNTYgNDFMNTUgNDFMNTUgNDJMNTQgNDJMNTQgNDBMNTcgNDBMNTcgNDFMNTggNDFMNTggMzlMNTYgMzlMNTYgMzZMNTcgMzZMNTcgMzhMNTkgMzhMNTkgMzZMNTggMzZMNTggMzVMNTYgMzVMNTYgMzZMNTQgMzZMNTQgMzVMNTUgMzVMNTUgMzRMNTYgMzRMNTYgMzNMNTQgMzNMNTQgMzVMNTEgMzVMNTEgMzRMNTMgMzRMNTMgMzNMNTIgMzNMNTIgMzJMNTEgMzJMNTEgMzFMNTIgMzFMNTIgMjlMNTEgMjlMNTEgMzBMNTAgMzBMNTAgMjlMNDggMjlMNDggMzBMNDcgMzBMNDcgMjlMNDYgMjlMNDYgMzBMNDUgMzBMNDUgMjlMNDQgMjlMNDQgMzBMNDIgMzBMNDIgMzFMNDMgMzFMNDMgMzJMNDEgMzJMNDEgMzFMNDAgMzFMNDAgMzBMNDEgMzBMNDEgMjhMNDIgMjhMNDIgMjlMNDMgMjlMNDMgMjhMNDIgMjhMNDIgMjdMNDEgMjdMNDEgMjZMNDIgMjZMNDIgMjVMNDMgMjVMNDMgMjZMNDQgMjZMNDQgMjdMNDUgMjdMNDUgMjVMNDQgMjVMNDQgMjRMNDAgMjRMNDAgMjVMMzkgMjVMMzkgMjZMNDAgMjZMNDAgMjdMMzkgMjdMMzkgMjhMMzggMjhMMzggMjlMMzcgMjlMMzcgMzBMMzYgMzBMMzYgMzJMMzcgMzJMMzcgMzBMMzggMzBMMzggMjlMMzkgMjlMMzkgMzFMMzggMzFMMzggMzJMNDAgMzJMNDAgMzdMMzkgMzdMMzkgMzhMMzggMzhMMzggMzdMMzYgMzdMMzYgMzhMMzUgMzhMMzUgMzZMMzcgMzZMMzcgMzVMMzggMzVMMzggMzZMMzkgMzZMMzkgMzVMMzggMzVMMzggMzNMMzQgMzNMMzQgMzJMMzMgMzJMMzMgMzNMMzEgMzNMMzEgMzRMMzAgMzRMMzAgMzNMMjkgMzNMMjkgMzRMMzAgMzRMMzAgMzVMMjkgMzVMMjkgMzZMMjcgMzZMMjcgMzVMMjYgMzVMMjYgMzZMMjcgMzZMMjcgMzdMMjUgMzdMMjUgMzhMMjggMzhMMjggMzdMMzAgMzdMMzAgMzZMMzEgMzZMMzEgMzVMMzIgMzVMMzIgMzdMMzMgMzdMMzMgMzhMMjkgMzhMMjkgNDBMMjggNDBMMjggMzlMMjcgMzlMMjcgNDBMMjYgNDBMMjYgMzlMMjUgMzlMMjUgNDBMMjQgNDBMMjQgNDFMMjMgNDFMMjMgNDBMMjIgNDBMMjIgMzlMMjMgMzlMMjMgMzdMMjQgMzdMMjQgMzZMMjUgMzZMMjUgMzRMMjggMzRMMjggMzBMMjcgMzBMMjcgMjlMMjggMjlMMjggMjhMMzIgMjhMMzIgMjdMMjcgMjdMMjcgMjZMMjYgMjZMMjYgMjVMMjUgMjVMMjUgMjRMMjQgMjRMMjQgMjVMMjMgMjVMMjMgMjNMMjIgMjNMMjIgMjVMMjEgMjVMMjEgMjZMMjAgMjZMMjAgMjdMMTggMjdMMTggMjVMMjAgMjVMMjAgMjRMMjEgMjRMMjEgMjNMMjAgMjNMMjAgMjRMMTggMjRMMTggMjVMMTcgMjVMMTcgMjRMMTYgMjRMMTYgMjJMMTcgMjJMMTcgMjNMMTggMjNMMTggMjJMMTcgMjJMMTcgMjBMMTkgMjBMMTkgMjFMMjEgMjFMMjEgMjJMMjMgMjJMMjMgMjFMMjQgMjFMMjQgMTlMMjEgMTlMMjEgMThMMjMgMThMMjMgMTdMMjQgMTdMMjQgMThMMjUgMThMMjUgMjFMMjYgMjFMMjYgMTlMMjkgMTlMMjkgMjBMMjcgMjBMMjcgMjJMMjQgMjJMMjQgMjNMMjYgMjNMMjYgMjRMMjggMjRMMjggMjZMMjkgMjZMMjkgMjRMMzEgMjRMMzEgMjNMMzMgMjNMMzMgMjRMMzQgMjRMMzQgMjdMMzUgMjdMMzUgMjhMMzQgMjhMMzQgMzBMMzMgMzBMMzMgMzFMMzQgMzFMMzQgMzBMMzUgMzBMMzUgMjlMMzYgMjlMMzYgMjhMMzcgMjhMMzcgMjdMMzYgMjdMMzYgMjZMMzcgMjZMMzcgMjVMMzUgMjVMMzUgMjRMMzQgMjRMMzQgMjNMMzMgMjNMMzMgMjFMMzQgMjFMMzQgMjBMMzUgMjBMMzUgMTlMMzYgMTlMMzYgMjBMMzcgMjBMMzcgMTlMMzggMTlMMzggMTdMMzYgMTdMMzYgMThMMzUgMThMMzUgMTdMMzQgMTdMMzQgMThMMzUgMThMMzUgMTlMMzMgMTlMMzMgMThMMzIgMThMMzIgMTlMMzAgMTlMMzAgMTVMMjkgMTVMMjkgMTdMMjggMTdMMjggMTVMMjcgMTVMMjcgMTRMMjkgMTRMMjkgMTNMMzAgMTNMMzAgMTRMMzEgMTRMMzEgMTZMMzIgMTZMMzIgMTdMMzMgMTdMMzMgMTZMMzQgMTZMMzQgMTRMMzUgMTRMMzUgMTZMMzkgMTZMMzkgMTVMMzggMTVMMzggMTRMMzcgMTRMMzcgMTNMMzggMTNMMzggMTJMMzkgMTJMMzkgMTBMNDAgMTBMNDAgMTFMNDEgMTFMNDEgOUw0MyA5TDQzIDExTDQyIDExTDQyIDEyTDQwIDEyTDQwIDEzTDM5IDEzTDM5IDE0TDQwIDE0TDQwIDE3TDM5IDE3TDM5IDIwTDM4IDIwTDM4IDIxTDM5IDIxTDM5IDIwTDQwIDIwTDQwIDIyTDM5IDIyTDM5IDIzTDQwIDIzTDQwIDIyTDQxIDIyTDQxIDIwTDQyIDIwTDQyIDIxTDQzIDIxTDQzIDIyTDQ0IDIyTDQ0IDIzTDQ3IDIzTDQ3IDI0TDQ2IDI0TDQ2IDI2TDQ3IDI2TDQ3IDI3TDQ4IDI3TDQ4IDI4TDUwIDI4TDUwIDI2TDQ5IDI2TDQ5IDI1TDQ4IDI1TDQ4IDIyTDUwIDIyTDUwIDIzTDQ5IDIzTDQ5IDI0TDUzIDI0TDUzIDI1TDUxIDI1TDUxIDI3TDUyIDI3TDUyIDI2TDU0IDI2TDU0IDI1TDU2IDI1TDU2IDIzTDU3IDIzTDU3IDI0TDU4IDI0TDU4IDIzTDU3IDIzTDU3IDIyTDU2IDIyTDU2IDIwTDU0IDIwTDU0IDIxTDU1IDIxTDU1IDIyTDUzIDIyTDUzIDIzTDUyIDIzTDUyIDIyTDUwIDIyTDUwIDIxTDQ4IDIxTDQ4IDIwTDQ2IDIwTDQ2IDE5TDQ3IDE5TDQ3IDE3TDQ4IDE3TDQ4IDE5TDQ5IDE5TDQ5IDE4TDUwIDE4TDUwIDE3TDUxIDE3TDUxIDE2TDUyIDE2TDUyIDE1TDUzIDE1TDUzIDEzTDUxIDEzTDUxIDE0TDUwIDE0TDUwIDE2TDQ5IDE2TDQ5IDE3TDQ4IDE3TDQ4IDE2TDQ3IDE2TDQ3IDE3TDQ2IDE3TDQ2IDE5TDQ1IDE5TDQ1IDE4TDQ0IDE4TDQ0IDE2TDQxIDE2TDQxIDE0TDQwIDE0TDQwIDEzTDQzIDEzTDQzIDE0TDQyIDE0TDQyIDE1TDQzIDE1TDQzIDE0TDQ0IDE0TDQ0IDExTDQ2IDExTDQ2IDEwTDQ3IDEwTDQ3IDExTDQ4IDExTDQ4IDEyTDQ5IDEyTDQ5IDEwTDUwIDEwTDUwIDlMNDkgOUw0OSAxMEw0OCAxMEw0OCA2TDQ3IDZMNDcgOUw0NiA5TDQ2IDEwTDQ1IDEwTDQ1IDlMNDMgOUw0MyA4TDQxIDhMNDEgN0w0MCA3TDQwIDZMMzkgNkwzOSA3TDM4IDdMMzggNkwzNyA2TDM3IDdMMzggN0wzOCA5TDM1IDlMMzUgOEwzNCA4TDM0IDZMMzUgNkwzNSA3TDM2IDdMMzYgNUwzOCA1TDM4IDRMNDAgNEw0MCAzTDQyIDNMNDIgNEw0NSA0TDQ1IDNMNDMgM0w0MyAyTDQwIDJMNDAgM0wzNyAzTDM3IDJaTTUxIDNMNTEgNEw1MiA0TDUyIDNaTTggNUw4IDdMOSA3TDkgNVpNMjkgNUwyOSA4TDMyIDhMMzIgNVpNMTMgNkwxMyAxMEwxMiAxMEwxMiAxM0wxNCAxM0wxNCAxMkwxNSAxMkwxNSAxMEwxNCAxMEwxNCA4TDE1IDhMMTUgN0wxNCA3TDE0IDZaTTMwIDZMMzAgN0wzMSA3TDMxIDZaTTAgOEwwIDlMMSA5TDEgMTFMMCAxMUwwIDEyTDIgMTJMMiA4Wk01NSA4TDU1IDlMNTQgOUw1NCAxMUw1NSAxMUw1NSAxMEw1NiAxMEw1NiAxMUw1NyAxMUw1NyA5TDU4IDlMNTggMTBMNjAgMTBMNjAgOUw2MSA5TDYxIDhMNTcgOEw1NyA5TDU2IDlMNTYgOFpNMjEgOUwyMSAxMEwyMiAxMEwyMiAxMUwyMyAxMUwyMyA5Wk0zOCA5TDM4IDEwTDM2IDEwTDM2IDExTDM1IDExTDM1IDEyTDM0IDEyTDM0IDExTDMzIDExTDMzIDEyTDMyIDEyTDMyIDExTDMxIDExTDMxIDEyTDMwIDEyTDMwIDEzTDMzIDEzTDMzIDE0TDM0IDE0TDM0IDEzTDM2IDEzTDM2IDExTDM3IDExTDM3IDEyTDM4IDEyTDM4IDEwTDM5IDEwTDM5IDlaTTkgMTFMOSAxMkwxMCAxMkwxMCAxMVpNMjMgMTJMMjMgMTVMMjQgMTVMMjQgMTdMMjcgMTdMMjcgMThMMjggMThMMjggMTdMMjcgMTdMMjcgMTZMMjYgMTZMMjYgMTVMMjQgMTVMMjQgMTRMMjUgMTRMMjUgMTJaTTU4IDEyTDU4IDE0TDU5IDE0TDU5IDEyWk0yIDEzTDIgMTRMMyAxNEwzIDEzWk03IDEzTDcgMTRMOCAxNEw4IDE1TDkgMTVMOSAxM1pNMTkgMTNMMTkgMTVMMjAgMTVMMjAgMTNaTTAgMTRMMCAxNUwxIDE1TDEgMTRaTTM2IDE0TDM2IDE1TDM3IDE1TDM3IDE0Wk01MSAxNEw1MSAxNUw1MiAxNUw1MiAxNFpNMzIgMTVMMzIgMTZMMzMgMTZMMzMgMTVaTTU2IDE2TDU2IDE3TDU3IDE3TDU3IDE2Wk00MSAxN0w0MSAxOEw0MCAxOEw0MCAxOUw0MSAxOUw0MSAxOEw0MyAxOEw0MyAxOUw0MiAxOUw0MiAyMEw0MyAyMEw0MyAxOUw0NCAxOUw0NCAxOEw0MyAxOEw0MyAxN1pNMiAxOEwyIDIwTDMgMjBMMyAxOUw0IDE5TDQgMThaTTE5IDE4TDE5IDE5TDIwIDE5TDIwIDE4Wk0zNiAxOEwzNiAxOUwzNyAxOUwzNyAxOFpNMzIgMTlMMzIgMjBMMzEgMjBMMzEgMjFMMzIgMjFMMzIgMjBMMzMgMjBMMzMgMTlaTTYgMjBMNiAyMUw3IDIxTDcgMjBaTTIxIDIwTDIxIDIxTDIyIDIxTDIyIDIwWk00NCAyMEw0NCAyMkw0NSAyMkw0NSAyMUw0NiAyMUw0NiAyMFpNNjAgMjBMNjAgMjJMNjEgMjJMNjEgMjBaTTI4IDIxTDI4IDIyTDI5IDIyTDI5IDIzTDI4IDIzTDI4IDI0TDI5IDI0TDI5IDIzTDMwIDIzTDMwIDIyTDI5IDIyTDI5IDIxWk00NyAyMUw0NyAyMkw0OCAyMkw0OCAyMVpNMzcgMjNMMzcgMjRMMzggMjRMMzggMjNaTTUzIDIzTDUzIDI0TDU1IDI0TDU1IDIzWk02MCAyM0w2MCAyNUw2MSAyNUw2MSAyM1pNMjQgMjVMMjQgMjdMMjMgMjdMMjMgMjZMMjEgMjZMMjEgMjhMMTcgMjhMMTcgMzBMMTkgMzBMMTkgMjlMMjAgMjlMMjAgMzBMMjEgMzBMMjEgMzFMMjIgMzFMMjIgMzJMMjMgMzJMMjMgMzNMMjQgMzNMMjQgMzRMMjUgMzRMMjUgMzNMMjcgMzNMMjcgMzJMMjQgMzJMMjQgMzFMMjYgMzFMMjYgMzBMMjUgMzBMMjUgMjlMMjcgMjlMMjcgMjdMMjUgMjdMMjUgMjVaTTMwIDI1TDMwIDI2TDMxIDI2TDMxIDI1Wk00MCAyNUw0MCAyNkw0MSAyNkw0MSAyNVpNNTcgMjVMNTcgMjZMNTggMjZMNTggMjVaTTUgMjZMNSAyN0w3IDI3TDcgMjZaTTIyIDI3TDIyIDI5TDIxIDI5TDIxIDMwTDIzIDMwTDIzIDMxTDI0IDMxTDI0IDMwTDIzIDMwTDIzIDI5TDI0IDI5TDI0IDI4TDI1IDI4TDI1IDI3TDI0IDI3TDI0IDI4TDIzIDI4TDIzIDI3Wk00MCAyN0w0MCAyOEwzOSAyOEwzOSAyOUw0MCAyOUw0MCAyOEw0MSAyOEw0MSAyN1pNNTMgMjdMNTMgMjhMNTQgMjhMNTQgMjdaTTEyIDI4TDEyIDMwTDExIDMwTDExIDMyTDEwIDMyTDEwIDM0TDkgMzRMOSAzNUw4IDM1TDggMzZMMTAgMzZMMTAgMzdMMTEgMzdMMTEgMzZMMTAgMzZMMTAgMzRMMTEgMzRMMTEgMzVMMTIgMzVMMTIgMzhMMTEgMzhMMTEgNDJMMTAgNDJMMTAgNDBMOSA0MEw5IDQzTDExIDQzTDExIDQ0TDE1IDQ0TDE1IDQyTDE2IDQyTDE2IDQxTDE0IDQxTDE0IDQyTDEyIDQyTDEyIDM5TDEzIDM5TDEzIDQwTDE0IDQwTDE0IDM5TDEzIDM5TDEzIDM4TDE0IDM4TDE0IDM1TDEyIDM1TDEyIDM0TDExIDM0TDExIDMzTDEzIDMzTDEzIDM0TDE1IDM0TDE1IDM1TDE2IDM1TDE2IDM0TDE3IDM0TDE3IDMzTDE4IDMzTDE4IDM0TDE5IDM0TDE5IDMyTDIwIDMyTDIwIDM0TDIyIDM0TDIyIDMzTDIxIDMzTDIxIDMyTDIwIDMyTDIwIDMxTDE5IDMxTDE5IDMyTDE3IDMyTDE3IDMzTDE1IDMzTDE1IDMxTDE2IDMxTDE2IDI5TDE0IDI5TDE0IDMxTDEzIDMxTDEzIDMyTDEyIDMyTDEyIDMwTDEzIDMwTDEzIDI4Wk01IDI5TDUgMzJMOCAzMkw4IDI5Wk0yOSAyOUwyOSAzMkwzMiAzMkwzMiAyOVpNNTMgMjlMNTMgMzJMNTYgMzJMNTYgMjlaTTU5IDI5TDU5IDMwTDYxIDMwTDYxIDI5Wk02IDMwTDYgMzFMNyAzMUw3IDMwWk0zMCAzMEwzMCAzMUwzMSAzMUwzMSAzMFpNNDggMzBMNDggMzJMNDcgMzJMNDcgMzFMNDYgMzFMNDYgMzJMNDQgMzJMNDQgMzNMNDEgMzNMNDEgMzRMNDMgMzRMNDMgMzVMNDQgMzVMNDQgMzNMNDUgMzNMNDUgMzRMNDYgMzRMNDYgMzJMNDcgMzJMNDcgMzVMNDYgMzVMNDYgMzZMNDQgMzZMNDQgMzhMNDMgMzhMNDMgMzdMNDIgMzdMNDIgMzVMNDEgMzVMNDEgMzdMNDAgMzdMNDAgMzhMNDIgMzhMNDIgNDBMNDQgNDBMNDQgNDFMNDAgNDFMNDAgNDBMNDEgNDBMNDEgMzlMMzkgMzlMMzkgNDBMMzggNDBMMzggMzhMMzcgMzhMMzcgMzlMMzUgMzlMMzUgMzhMMzQgMzhMMzQgNDBMMzIgNDBMMzIgMzlMMzEgMzlMMzEgNDBMMjkgNDBMMjkgNDFMMjggNDFMMjggNDBMMjcgNDBMMjcgNDFMMjQgNDFMMjQgNDNMMjYgNDNMMjYgNDJMMjcgNDJMMjcgNDNMMjggNDNMMjggNDVMMjkgNDVMMjkgNDZMMzAgNDZMMzAgNDdMMzIgNDdMMzIgNDZMMzQgNDZMMzQgNDdMMzMgNDdMMzMgNDhMMzUgNDhMMzUgNTBMMzQgNTBMMzQgNTFMMzYgNTFMMzYgNDlMMzcgNDlMMzcgNDhMMzYgNDhMMzYgNDdMMzUgNDdMMzUgNDZMMzQgNDZMMzQgNDVMMzYgNDVMMzYgNDFMMzcgNDFMMzcgNDRMMzggNDRMMzggNDNMMzkgNDNMMzkgNDJMNDAgNDJMNDAgNDNMNDEgNDNMNDEgNDZMNDAgNDZMNDAgNDdMNDIgNDdMNDIgNDZMNDMgNDZMNDMgNDVMNDIgNDVMNDIgNDRMNDQgNDRMNDQgNDZMNDYgNDZMNDYgNDVMNDcgNDVMNDcgNDdMNDYgNDdMNDYgNDhMNDcgNDhMNDcgNTBMNDggNTBMNDggNTFMNDkgNTFMNDkgNTBMNDggNTBMNDggNDlMNDkgNDlMNDkgNDdMNDggNDdMNDggNDZMNDkgNDZMNDkgNDRMNDggNDRMNDggNDNMNDcgNDNMNDcgNDJMNDYgNDJMNDYgMzlMNDggMzlMNDggNDFMNDkgNDFMNDkgNDBMNTIgNDBMNTIgMzlMNTMgMzlMNTMgNDBMNTQgNDBMNTQgMzlMNTMgMzlMNTMgMzdMNTIgMzdMNTIgMzhMNTEgMzhMNTEgMzVMNTAgMzVMNTAgMzZMNDggMzZMNDggMzNMNTAgMzNMNTAgMzRMNTEgMzRMNTEgMzJMNTAgMzJMNTAgMzFMNDkgMzFMNDkgMzBaTTU0IDMwTDU0IDMxTDU1IDMxTDU1IDMwWk02IDMzTDYgMzRMNyAzNEw3IDMzWk0zMyAzM0wzMyAzNEwzNCAzNEwzNCAzNUwzMyAzNUwzMyAzN0wzNCAzN0wzNCAzNkwzNSAzNkwzNSAzNEwzNCAzNEwzNCAzM1pNMzYgMzRMMzYgMzVMMzcgMzVMMzcgMzRaTTE4IDM1TDE4IDM2TDE3IDM2TDE3IDM3TDE4IDM3TDE4IDM4TDE2IDM4TDE2IDM2TDE1IDM2TDE1IDM5TDE2IDM5TDE2IDQwTDE3IDQwTDE3IDM5TDE4IDM5TDE4IDM4TDE5IDM4TDE5IDM5TDIwIDM5TDIwIDQwTDE4IDQwTDE4IDQxTDE3IDQxTDE3IDQzTDE2IDQzTDE2IDQ0TDE3IDQ0TDE3IDQ1TDE4IDQ1TDE4IDQ3TDE5IDQ3TDE5IDQ4TDIxIDQ4TDIxIDQ5TDIzIDQ5TDIzIDQ4TDIyIDQ4TDIyIDQ3TDE5IDQ3TDE5IDQ0TDIwIDQ0TDIwIDQ2TDIzIDQ2TDIzIDQ3TDI2IDQ3TDI2IDQ2TDI3IDQ2TDI3IDQ0TDI2IDQ0TDI2IDQ1TDI1IDQ1TDI1IDQ0TDI0IDQ0TDI0IDQ1TDIxIDQ1TDIxIDQyTDIzIDQyTDIzIDQxTDIxIDQxTDIxIDM5TDIwIDM5TDIwIDM4TDIxIDM4TDIxIDM3TDIyIDM3TDIyIDM2TDI0IDM2TDI0IDM1TDIxIDM1TDIxIDM2TDIwIDM2TDIwIDM1Wk00NiAzNkw0NiAzOEw0OCAzOEw0OCAzN0w0NyAzN0w0NyAzNlpNMTkgMzdMMTkgMzhMMjAgMzhMMjAgMzdaTTQ5IDM3TDQ5IDM4TDUwIDM4TDUwIDM5TDUxIDM5TDUxIDM4TDUwIDM4TDUwIDM3Wk00NCAzOEw0NCAzOUw0NSAzOUw0NSAzOFpNNiAzOUw2IDQwTDcgNDBMNyAzOVpNNCA0MEw0IDQxTDUgNDFMNSA0MFpNMzEgNDBMMzEgNDFMMjkgNDFMMjkgNDRMMzAgNDRMMzAgNDNMMzEgNDNMMzEgNDFMMzIgNDFMMzIgNDBaTTM0IDQwTDM0IDQxTDMzIDQxTDMzIDQyTDM0IDQyTDM0IDQzTDMyIDQzTDMyIDQ0TDMxIDQ0TDMxIDQ2TDMyIDQ2TDMyIDQ1TDMzIDQ1TDMzIDQ0TDM0IDQ0TDM0IDQzTDM1IDQzTDM1IDQxTDM2IDQxTDM2IDQwWk0zNyA0MEwzNyA0MUwzOCA0MUwzOCA0MFpNNTkgNDBMNTkgNDFMNjAgNDFMNjAgNDBaTTE5IDQxTDE5IDQzTDIwIDQzTDIwIDQyTDIxIDQyTDIxIDQxWk00NCA0MUw0NCA0Mkw0NSA0Mkw0NSA0M0w0NiA0M0w0NiA0Mkw0NSA0Mkw0NSA0MVpNNTAgNDFMNTAgNDNMNTEgNDNMNTEgNDRMNTIgNDRMNTIgNDNMNTMgNDNMNTMgNDJMNTIgNDJMNTIgNDFaTTYgNDJMNiA0M0w3IDQzTDcgNDJaTTExIDQyTDExIDQzTDEyIDQzTDEyIDQyWk00MSA0Mkw0MSA0M0w0MiA0M0w0MiA0MlpNNTUgNDJMNTUgNDNMNTYgNDNMNTYgNDJaTTIyIDQzTDIyIDQ0TDIzIDQ0TDIzIDQzWk02IDQ0TDYgNDVMNCA0NUw0IDQ2TDYgNDZMNiA0N0w3IDQ3TDcgNDZMNiA0Nkw2IDQ1TDcgNDVMNyA0NFpNMTIgNDVMMTIgNDZMMTYgNDZMMTYgNDdMMTMgNDdMMTMgNDhMMTUgNDhMMTUgNDlMMTYgNDlMMTYgNDdMMTcgNDdMMTcgNDZMMTYgNDZMMTYgNDVaTTQgNDdMNCA0OEw1IDQ4TDUgNDdaTTUwIDQ5TDUwIDUwTDUxIDUwTDUxIDUxTDUyIDUxTDUyIDQ5Wk02MCA0OUw2MCA1MEw2MSA1MEw2MSA0OVpNMTggNTBMMTggNTFMMTkgNTFMMTkgNTBaTTI5IDUwTDI5IDUxTDMwIDUxTDMwIDUwWk0zIDUxTDMgNTJMNCA1Mkw0IDUxWk00MSA1MUw0MSA1M0w0MiA1M0w0MiA1MVpNMjAgNTJMMjAgNTRMMTggNTRMMTggNTNMMTcgNTNMMTcgNTRMMTggNTRMMTggNTVMMTYgNTVMMTYgNTRMMTUgNTRMMTUgNTVMMTYgNTVMMTYgNTZMMTcgNTZMMTcgNTdMMTggNTdMMTggNTZMMjAgNTZMMjAgNTVMMjEgNTVMMjEgNTNMMjIgNTNMMjIgNTJaTTI5IDUzTDI5IDU2TDMyIDU2TDMyIDUzWk01MyA1M0w1MyA1Nkw1NiA1Nkw1NiA1M1pNNTcgNTNMNTcgNTZMNTggNTZMNTggNTRMNTkgNTRMNTkgNTNaTTIyIDU0TDIyIDU1TDIzIDU1TDIzIDU0Wk0zMCA1NEwzMCA1NUwzMSA1NUwzMSA1NFpNMzUgNTRMMzUgNTVMMzMgNTVMMzMgNTdMMzQgNTdMMzQgNThMMzMgNThMMzMgNTlMMzIgNTlMMzIgNjBMMzQgNjBMMzQgNTlMMzUgNTlMMzUgNTdMMzQgNTdMMzQgNTZMMzYgNTZMMzYgNTRaTTU0IDU0TDU0IDU1TDU1IDU1TDU1IDU0Wk05IDU1TDkgNTZMMTAgNTZMMTAgNTVaTTEyIDU1TDEyIDU2TDEzIDU2TDEzIDU1Wk01MyA2MEw1MyA2MUw1NSA2MUw1NSA2MFpNMCAwTDAgN0w3IDdMNyAwWk0xIDFMMSA2TDYgNkw2IDFaTTIgMkwyIDVMNSA1TDUgMlpNNTQgMEw1NCA3TDYxIDdMNjEgMFpNNTUgMUw1NSA2TDYwIDZMNjAgMVpNNTYgMkw1NiA1TDU5IDVMNTkgMlpNMCA1NEwwIDYxTDcgNjFMNyA1NFpNMSA1NUwxIDYwTDYgNjBMNiA1NVpNMiA1NkwyIDU5TDUgNTlMNSA1NloiIGZpbGw9IiMwMDAwMDAiLz48L2c+PC9nPjwvc3ZnPgo=" alt="">
            </div>
            <div class="widget">
                <p>Wenn Sie den QR-Code nicht scannen können, geben Sie stattdessen diesen Schlüssel ein:</p>
                <code style="word-break:break-all">S4EVCLQCLGGYG5LMZJYNB5AP3KZLUQAWO6CPV7XAEAOFJE5FA5EL2OKL54ZLN4XO7</code>
            </div>
            <div class="widget widget-text">
                <label for="verify">Bestätigungscode</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="none" autocomplete="one-time-code" required="">
                <p class="help">Bitte geben Sie den von Ihrer 2FA/TOTP-App generierten Bestätigungscode ein.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="submit">Aktivieren</button>
            </div>
        </div>
    </form>
  
</div>
<!-- indexer::continue -->
```

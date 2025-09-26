---
title: "Frontend-Module"
description: "Die Newsletter-Erweiterung enthält vier zusätzliche Frontend-Module, die du wie gewohnt über die Modulverwaltung 
konfigurieren kannst."
url: "core-erweiterung/newsletter/frontend-module"
aliases:
    - /de/core-erweiterung/newsletter/frontend-module/
weight: 20
---

Nachdem du nun weißt, wie Verteiler, Newsletter und Empfänger im Backend verwaltet werden, wird dir jetzt erklärt, wie 
deine Besucher Verteiler im Frontend abonnieren bzw. kündigen können und wie du ein Archiv anlegst, das alle versendeten Newslettern 
anzeigt. Die Newsletter-Erweiterung enthält vier zusätzliche Frontend-Module, die du wie gewohnt über die Modulverwaltung
konfigurieren kannst.

![Newsletter-Module]({{% asset "images/manual/core-extensions/newsletter/de/newsletter-module.png" %}}?classes=shadow)


## Abonnieren
Das Frontend-Modul »Abonnieren« fügt der Webseite ein Formular hinzu, mit dem sich deine Besucher für bestimmte 
Verteiler registrieren können.


### Modul-Konfiguration

**Verteiler:** Hier wählst du die Verteiler aus, für die sich deine Besucher über das Frontend-Modul zum Abonnieren von 
Verteilern registrieren können.

**Verteilermenü ausblenden:** Hier kannst du das Menü zur Verteilerauswahl ausblenden. Der Besucher abonniert in diesem 
Fall die von dir festgelegten Verteiler.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen).


### Eigener Text

**Eigener Text:** Hier kannst du z. B. einen Datenschutzhinweis eingeben, um die Anmeldung DSGVO-konform zu gestalten.


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, zu welcher Seite Besucher nach dem Absenden des Bestellformulars 
weitergeleitet werden. Dort solltest du unter anderem auch erklären, wie man ein Abonnement wieder kündigt.


### E-Mail-Einstellungen

**Abonnementbestätigung:** Gebe hier den Text der Bestätigungsmail ein. Du kannst die Platzhalter `##channel##` für den 
Verteiler sowie `##domain##` für die aktuelle Domain und `##link##` für den Bestätigungslink verwenden.

Eine Bestätigungsmail kann zum Beispiel wie folgt aussehen:

```text
Sie haben folgende Verteiler auf ##domain## abonniert:

##channels##

Bitte klicken Sie hier, um Ihr Abonnement zu aktivieren:

##link##

Der Bestätigungslink ist 24 Stunden gültig. Sie können Ihr Abonnement jederzeit beenden.

Falls Sie die Verteiler nicht selbst abonniert haben, ignorieren Sie diese E-Mail bitte.

Ihr Administrator
```


### Template-Einstellungen

**Newslettertemplate:** Hier wählst du das Template für das Bestellformular aus.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_subscribe block">
    <form action="…" id="tl_subscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_subscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail-Adresse</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Verteiler</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox">
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-explanation">
                <p>Eigener Text</p>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Abonnieren</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```


## Kündigen {#kuendigen}

Das Frontend-Modul »Kündigen« fügt der Webseite ein Formular hinzu, mit dem sich deine Besucher aus bestimmten 
Verteilern austragen können.


### Modul-Konfiguration

**Verteiler:** Hier wählst du die Verteiler aus, aus denen sich deine Besucher über dieses Frontend-Modul 
austragen können.

**Verteilermenü ausblenden:** Hier kannst du das Menü zur Verteilerauswahl ausblenden. Der Benutzer kündigt in diesem 
Fall die von dir festgelegten Verteiler.

**Spam-Schutz deaktivieren:** Hier kannst du den Spam-Schutz deaktivieren (nicht empfohlen).


### Weiterleitung

**Weiterleitungsseite:** Hier legst du fest, zu welcher Seite Besucher nach dem Absenden des Kündigungsformulars 
weitergeleitet werden.


### E-Mail-Einstellungen

**Kündigungsbestätigung:** Gebe hier den Text der Bestätigungsmail ein. Du kannst die Platzhalter `##channel##` für den 
Verteiler und `##domain##` für die aktuelle Domain verwenden.

Eine Bestätigungsmail kann zum Beispiel wie folgt aussehen:

```text
Sie haben folgende Abonnements auf ##domain## gekündigt:

##channels##

Ihr Administrator
```


### Template-Einstellungen

**Newslettertemplate:** Hier wählst du das Template für das Kündigungsformular aus.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_unsubscribe block">
    <form action="…" id="tl_unsubscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_unsubscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail-Adresse</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Verteiler</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox"> 
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Kündigen</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```


## Newsletterliste

Das Frontend-Modul »Newsletterliste« listet alle versendeten Newsletter auf. Dabei werden der Betreff, das Versanddatum 
und ein Link zur Detailansicht ausgegeben.


### Modul-Konfiguration

**Verteiler:** Hier legst du fest, aus welchen Verteilern Newsletter aufgelistet werden sollen. Newsletter werden 
absteigend nach Versanddatum sortiert.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<!-- indexer::stop -->
<div class="mod_newsletterlist block">
    <ul>
        <li>01.09.2019 22.50: <a href="…" title="…">…</a></li>
        <li>01.08.2019 23.16: <a href="…" title="…">…</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```


## Newsletterleser

Das Frontend-Modul »Newsletterleser« dient dazu, einen bestimmten Newsletter darzustellen. Die ID bzw. den Alias des 
Newsletters bezieht das Modul über die URL, sodass Newsletter mit sogenannten 
[Permalinks](https://de.wikipedia.org/wiki/Permalink) gezielt verlinkt werden können:

`www.example.com/newsletterleser/newsletteralias.html`

Der *newsletteralias* teilt dem »Newsletterleser« mit, dass er einen bestimmten Newsletter suchen und 
ausgeben soll. Existiert der gesuchte Eintrag nicht, gibt das Modul eine Fehlermeldung und den HTTP-Status-Code 
»404 Not found« zurück. Der Status-Code ist wichtig für die Suchmaschinenoptimierung.

{{% notice note %}}
Auf einer einzelnen Seite darf sich immer nur ein »Lesermodul« befinden, egal welchen Typs. Andernfalls würde das eine 
oder andere Modul eine 404 Seite auslösen, da zum Beispiel der Alias eines Newsletters nicht in einem Kalender gefunden 
wird, oder umgekehrt der Alias eines Events in einem Newsletterarchiv.
{{% /notice %}}


### Modul-Konfiguration

**Verteiler:** Hier legst du fest, in welchen Verteilern nach dem angeforderten Newsletter gesucht werden soll. 
Newsletter aus nicht ausgewählten Verteilern werden grundsätzlich nicht angezeigt, selbst wenn die URL stimmt und der 
Eintrag existiert. Dieses Feature ist vor allem im Multidomain-Betrieb mit mehreren unabhängigen Webseiten wichtig.


### Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.

**HTML-Ausgabe**  
Das Frontend-Modul generiert folgenden HTML-Code:

```html
<div class="mod_newsletterreader block">
    <h1>…</h1>
    <div class="newsletter">
        …
    </div>
    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->
</div>
```

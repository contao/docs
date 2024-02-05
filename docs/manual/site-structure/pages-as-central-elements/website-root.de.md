---
title: "Website-Startseite"
description: "Dieser Seitentyp kennzeichnet den Startpunkt einer neuen Webseite. Contao unterstützt die Verwaltung 
mehrerer Webseiten mit einer Installation. Diese Webseiten können sich z. B. durch verschiedene Sprachen unterscheiden 
oder auch völlig unabhängig voneinander unter verschiedenen Domains laufen (Multidomain-Betrieb)."
url: "seitenstruktur/website-startseite"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/website-startseite
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/website-startseite
weight: 10
---

Der Seitentyp »Website-Startseite« kennzeichnet den Startpunkt einer neuen Webseite. Contao unterstützt die Verwaltung
mehrerer Webseiten mit einer Installation. Diese Webseiten können sich z. B. durch verschiedene Sprachen unterscheiden
oder auch völlig unabhängig voneinander unter verschiedenen Domains laufen ([Multidomain-Betrieb](../multidomain-betrieb)).


## Name und Typ

**Seitenname:** Der Seitenname wird in der Navigation angezeigt und als Fallback für den Seitentitel verwendet.

**Seitentyp:** Hier kannst du den Typ der Seite bestimmen.


## Routing

**Seitenaliase:** Der Alias einer Seite ist eine eindeutige und aussagekräftige Referenz, über die du eine Seite in
deinem Browser aufrufen kannst. Wenn du das Feld beim Anlegen leer lässt, vergibt Contao den Alias automatisch.


## Metadaten

Die Metadaten einer Seite beziehen sich größtenteils auf die entsprechenden
[Meta-Tags](https://de.wikipedia.org/wiki/Meta-Element) im Kopfbereich der HTML-Seite. Du kannst darüber unter anderem den Titel und die Beschreibung einer 
Seite definieren.

**Seitentitel:** Der Seitentitel wird im `<title>`-Tag der Webseite verwendet und taucht häufig auch
in den Suchergebnissen von Google und Co. auf. Er sollte nicht mehr als 65 Zeichen enthalten, da viele Suchmaschinen
längere Titel einfach abschneiden. Wenn kein Seitentitel angegeben wird, wird als Fallback der Name der Seite benutzt.

**Ausgabe im Quellcode:**
```html
<title>Contao Open Source CMS</title>
```


## URL-Einstellungen

Die URL-Einstellungen zusammen mit den Spracheinstellungen bestimmen, welchen Startpunkt Contao in Abhängigkeit von der
aufgerufenen Domain und der im Browser des Besuchers eingestellten Sprache lädt und welches Format die von Contao generierten
URLs haben sollen.

**Domainname:** Wenn du möchtest, dass eine Webseite in deiner Seitenstruktur unter einer bestimmten Domain wie z. B.
»firma.de« erreichbar ist, kannst du diese hier eingeben. Ruft ein Besucher dann »firma.de« in seinem Browser auf, wird
er automatisch zu dem entsprechenden Startpunkt einer Webseite weitergeleitet.

**Protokoll:** Wenn deine Webseite über HTTPS verfügbar ist, muss diese Einstellung entsprechend konfiguriert werden. 
Die Besucher werden automatisch auf HTTPS weitergeleitet.

{{% notice tip %}}
{{< version-tag "5.3" >}} Wenn du HTTPS auswählst, dann sendet Contao auch automatisch den `Strict-Transport-Security`
(HSTS) HTTP Header und macht so deine Seite noch sicherer. Das gilt natürlich nur für Ressourcen, die direkt von Contao geliefert werden, also z.B. nicht für alles, was direkt über den Webserver ausgeliefert wird.
{{% /notice %}}

{{% notice warning %}}
Falls du für deine Domain ein SSL-Zertifikat einsetzt, dann muss diese Einstellung in Contao von `http://` auf `https://` 
geändert werden. Andernfalls könnte eine unendliche Weiterleitung im Frontend die Folge sein, falls beispielsweise die 
Hosting-Umgebung automatisch von `http://` auf `https://` weiterleitet.
{{% /notice %}}

**URL-Präfix:** Mit dieser Einstellung kann ein optionaler URL-Präfix allen Seitenaliasen unterhalb dieses Startpunkts
zugewiesen werden. Der URL-Präfix ist frei wählbar und damit unabhängig von der jeweils eingestellten Sprache. Damit du 
von dieser Einstellung profitieren kannst, musst du das [»Legacy-Routing« deaktivieren](#legacy-routing-modus).

**URL-Suffix:** Mit dieser Einstellung kann der »URL-Suffix« geändert oder entfernt werden. Der URL-Suffix wird bei der
Generierung der URL einer Seite an den Seitenalias angehängt. Damit du von dieser Einstellung profitieren kannst, musst 
du das [»Legacy-Routing« deaktivieren](#legacy-routing-modus).

**Gültige Alias-Zeichen:** Der Slug-Generator ermöglicht es einen individuellen Zeichensatz für automatisch erstellte
Aliase auszuwählen.

| Alias-Einstellungen                  | Erklärung                                                            |
|:-------------------------------------|:---------------------------------------------------------------------|
| Unicode-Zahlen und -Kleinbuchstaben  | Aus dem Seitennamen »Über uns« wird das Alias `über-uns` generiert.  |
| Unicode-Zahlen und -Buchstaben       | Aus dem Seitennamen »Über uns« wird das Alias `Über-uns` generiert.  |
| ASCII-Zahlen und -Kleinbuchstaben    | Aus dem Seitennamen »Über uns« wird das Alias `ueber-uns` generiert. |
| ASCII-Zahlen und -Buchstaben         | Aus dem Seitennamen »Über uns« wird das Alias `Ueber-uns` generiert. |

Für die Erzeugung des Aliases ist in Einzelfällen auch die eingestellte Sprache relevant. So wird ein Deutsches »Über«
zu »ueber« jedoch ein Finnisches »eläinkö« zu »elainko« konvertiert.

 **Ordner-URLs verwenden:** Hier kannst du Ordnerstrukturen in Seitenaliasen aktivieren. Damit werden die in der
Seitenhierarchie vorhandenen Aliase in den Alias mit übernommen z. B. die Seite »Download« im Seitenpfad
»Docs > Install« zu `docs/install/download.html` anstatt nur `download.html`.


### Legacy Routing Modus

Die Einstellungen **URL-Präfix** und **URL-Suffix** so wie **Sprachweiterleitung deaktivieren** sind erst verfügbar, wenn
das sogennante »Legacy Routing« über die Contao `contao.legacy_routing` Konfigurationseinstellung deaktiviert wurde.
Andernfalls wird die URL-Generierung nach wie vor nur durch die Einstellungen `contao.prepend_locale` und `contao.url_suffix`
bestimmt.

```yml
# config/config.yml
contao:
    legacy_routing: false
```

**Beachte allerdings**, dass die Deaktivierung des Legacy Routing Modus auch folgende Hooks deaktiviert:

* [`getRootPageFromUrl`](https://docs.contao.org/dev/reference/hooks/getRootPageFromUrl/)
* [`getPageIdFromUrl`](https://docs.contao.org/dev/reference/hooks/getPageIdFromUrl/)

{{% notice warning %}}
Falls Extensions installiert sind, die diese Hooks noch benötigen, dann muss entweder das Legacy Routing aktiviert 
bleiben, oder die Extensions müssen entfernt oder ersetzt werden. Andernfalls wird ein Fehler im Frontend auftreten.
{{% /notice %}}


## Spracheinstellungen

**Sprache:** Hier kannst du die Sprache des Startpunkts festlegen. Sprachen werden über ihr primäres Subtag nach 
[ISO 639-1](https://de.wikipedia.org/wiki/Liste_der_ISO-639-Sprachcodes) erfasst, also z. B. über `de` für Deutsch
oder `en` für Englisch.

**Sprachen-Fallback:** Contao sucht grundsätzlich nach einem Startpunkt in der Sprache, die ein Besucher in seinem
Browser voreingestellt hat. Gibt es nur einen deutschen Startpunkt, bekäme ein englischer Besucher lediglich die
Fehlermeldung »No pages found« zu sehen, da in seiner Sprache ja keine Webseite existiert.

Um das zu vermeiden, kannst du einen bestimmten Startpunkt als Fallback definieren, was frei übersetzt so viel wie
»Auffangseite« oder »Ausweichseite« bedeutet. Diese Auffangseite fängt dann quasi alle Besucher auf, die aufgrund ihrer
Spracheinstellungen eigentlich keinem Startpunkt zugeordnet werden können.

Achte also darauf, immer einen Startpunkt als Sprachen-Fallback zu definieren. Deine Webseite kann sonst nur von
deutschen Besuchern aufgerufen werden! Auch die Robots der Suchmaschinen, die deine Webseite indizieren, sprechen in
der Regel Englisch und wären ohne Sprachen-Fallback ebenfalls ausgeschlossen. Deine Seiten würden dann trotz
sorgfältiger Optimierung niemals bei Google auftauchen.

**Sprachweiterleitung deaktivieren:** Bei mehrsprachigen Seiten der selben Domain leitet Contao beim Aufruf der Domain 
automatisch auf den zur Browser-Sprache passenden Startpunkt weiter (andernfalls zur Fallback-Sprache). Mit dieser 
Einstellung kann dieses Verhalten beeinflusst und die automatische Weiterleitung zu bestimmten (oder allen) Sprachen 
deaktiviert werden.


## Website-Einstellungen

**Favicon:** Hier kannst du das Favicon für die `/favicon.ico` URL der Domain festlegen. Dies ist besonders im 
Multidomain-Betrieb hilfreich, damit jede Domain ihr eigenes Standard-Favicon hat. Andernfalls könnte man nur eine 
einzelne, _physische_ `favicon.ico` Datei im Document Root hinterlegen. Dadurch kann im Browser das korrekte Favicon 
pro Domain angezeigt werden, wenn Inhalte dargestellt werden, die keine HTML-Ausgabe beinhalten (wie zum Beispiel 
Bilder, PDFs, etc.).
Für dieselbe Domain kann man nur einmal ein Favicon festlegen. Dieses muss in der Fallback-Sprache geschehen.

{{% notice "info" %}}
Diese Funktion gibt keine zusätzlichen HTML Meta Tags auf der Seite aus.
{{% /notice %}}

{{% notice "warning" %}}
Dies wird nicht funktionieren, wenn sich bereits eine physische `favicon.ico` Datei im Document Root befindet, da der 
Webserver diese Datei dann direkt ausspielt. Stelle daher sicher, dass diese Datei gelöscht wurde, bevor du diese 
Funktion nutzt.
{{% /notice %}}

**Individuelle robots.txt-Anweisungen:** Hier kannst du eigene Direktiven für die `/robots.txt` URL der Domain eingeben. 
Dies ist besonders im Multidomain-Betrieb hilfreich, damit jede Domain ihre eigenen Direktiven haben kann. Andernfalls 
könnte man nur eine einzelne, _physische_ `robots.txt`-Datei im Document Root hinterlegen.
Für dieselbe Domain kann man nur einmal robots.txt festlegen. Dieses muss in der Fallback-Sprache geschehen.

{{% notice "warning" %}}
Dies wird nicht funktionieren, wenn sich bereits eine physische `robots.txt` Datei im Document Root befindet, da der 
Webserver diese Datei dann direkt ausspielt. Stelle daher sicher, dass diese Datei gelöscht wurde, bevor du diese 
Funktion nutzt.
{{% /notice %}}

**Wartungsmodus:** Wenn dieser Punkt aktiviert ist, wird den Besuchern der Website angezeigt, dass diese gerade gewartet 
wird. Für die Wartungsseite gibt es einen eigenen Seitentyp: 
[503 Dienst nicht verfügbar](/de/seitenstruktur/dienst-nicht-verfuegbar/).


## Content-Security-Policy

{{< version "5.3" >}}

In dieser Sektion kann der `Content-Security-Policy`-Header für das Frontend der Webseite aktiviert werden. Vor der
Aktivierung solltest du dich mit der Syntax von CSP-Direktiven und deren Auswirkungen auseinandersetzen. Bspw. über die
[offizielle Referenz](https://content-security-policy.com/) oder den [MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP).

**CSP aktivieren:** Aktiviert den `Content-Security-Policy`-Header für die Webseite.

**Content-Security-Policy:** Hier können die Content-Security-Policies eingegeben werden, die auf der Website angewendet
werden sollen. Die Eingabe erfolgt in der Form eines tatsächlichen `Content-Security-Policy`-Headers. Der Standard-Wert
ist `default-src 'self'`, wodurch nur Ressourcen von der aktuellen Domain akzeptiert werden.

**Nur-Bericht-Modus:** Aktiviert einen Modus indem der Browser die Content-Security-Policies nicht anwendet, die Verstöße
aber dennoch meldet.

**Protokollierung aktivieren:** Aktiviert die Protokollierung von CSP-Verstößen. Diese Berichte scheinen dann im
System-Log auf.

{{% notice "note" %}}
Wenn CSP aktiviert wird bedeutet das in den meisten Fällen, dass Inline-Scripts und -Styles nicht mehr erlaubt sind.
In der [Entwickler-Dokumentation](https://docs.contao.org/dev/framework/csp/) ist beschrieben wie man dies dennoch
programmatisch erlauben kann. Darüberhinaus würden die Inline-Styles, die von Contao's Text-Editor (TinyMCE) erzeugt
werden, nicht mehr funktionieren. Contao erzeugt jedoch automatisch Hashes für diese Styles, aber nur für die
dediziert erlaubten. Falls deine TinyMCE-Konfiguration andere Inline-Styles erzeugt, müssen diese über die
[Einstellungen](/de/system/einstellungen/#config-yml) erlaubt werden.
{{% /notice %}}


## Globale Einstellungen

**Mailer-Transport:** In vielen Fällen erlauben SMTP-Server nicht den Versand von beliebigen Absenderadressen. Meist 
muss die Absenderadresse zu den verwendeten SMTP-Server Zugangsdaten passen. Vor allem in Multidomain-Installationen von 
Contao kann es jedoch wichtig sein, dass die Absenderadresse der E-Mails, die Contao verschickt, zur jeweiligen Domain 
passt. Deshalb kannst du sogenannte »[Transports](/de/system/einstellungen/#verschiedene-e-mail-konfigurationen-und-absenderadressen)« 
anlegen und hier auswählen.

**rel="canonical" aktivieren:** Im Seitentyp »Startpunkt einer Webseite« kannst du hier die Ausgabe der 
rel="canonical"-Tags erlauben.

**E-Mail-Adresse des Webseiten-Administrators:** Hier kannst du die in den Backend-Einstellungen festgelegte
E-Mail-Adresse des Systemadministrators für eine bestimmte Webseite überschreiben. An diese Adresse werden z. B.
Benachrichtigungen über gesperrte Konten oder neu registrierte Benutzer geschickt. Wenn du mehrere Webseiten innerhalb
der Seitenstruktur betreibst, kann es sinnvoll sein, für jede Webseite einen eigenen Administrator festzulegen, der
dann nur die Meldungen seiner Webseite erhält. Du kannst auch folgende Notation verwenden, um einen Namen zur
E-Mail-Adresse hinzuzufügen:

```text
Kevin Jones [kevin.jones@example.com]
```

**Datumsformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Datumsformat überschreiben. Im Gegensatz
zum Backend, das nur numerische Formate unterstützt, kannst du im Frontend auch Textformate verwenden.

**Zeitformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Zeitformat überschreiben. Im Frontend
werden auch Textformate unterstützt.

**Datums- und Zeitformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Datums-
und Zeitformat überschreiben. Textformate werden unterstützt.

Contao unterstützt alle Datums- und Zeitformate, die mit der
[PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können. Um alle Eingaben in einen
UNIX-Zeitstempel umwandeln zu können, sind im Backend jedoch ausschließlich numerische Formate
(j, d, m, n, y, Y, g, G, h, H, i, s) erlaubt.

Hier sind einige Beispiele gültiger Datums- und Zeitangaben:


| Angaben  | Erklärung                                                     |
|:---------|:--------------------------------------------------------------|
| Y-m-d    | JJJJ-MM-TT, international ISO-8601, z. B. `2005-01-28`        |
| m/d/Y    | MM/TT/JJJJ, Englisches Format, z. B. `01/28/2005`             |
| d.m.Y    | TT.MM.JJJJ, Deutsches Format, z. B. `28.01.2005`              |
| y-n-j    | JJ-M-T, ohne führende Nullen, z. B. `05-1-28`                 |
| Ymd      | JJJJMMTT, Zeitstempel, z. B. `20050128`                       |
| H:i:s    | 24 Stunden, Minuten und Sekunden, z. B. `20:36:59`            |
| g:i      | 12 Stunden ohne führende Nullen sowie Minuten, z. B. `8:36`   |

**Datei-URL:** Wenn du z. B. ein Content Delivery Network für das `files`-Verzeichnis festlegen möchtest, kannst du die 
Datei-URL hier eingeben.

**Assets-URL:**  Wenn du z. B. ein Content Delivery Network für das `assets`-Verzeichnis festlegen möchtest, kannst du
die Datei-URL hier eingeben.


## Zugriffsschutz

Im Gegensatz zu den Zugriffsrechten, die die Rechte im Backend festlegen, bezieht sich der Zugriffsschutz auf den
Schutz einer Seiten vor dem Zugriff im Frontend. Besucher müssen sich dann zuerst mit ihrem Benutzernamen und Passwort
anmelden, bevor sie die Seite aufrufen können. Andernfalls sähen sie nur eine Fehlerseite.

**Seite schützen:** Hier kannst du den Zugriff auf eine Seite beschränken. Wenn du die Option nicht auswählst, wird der
Zugriffsschutz von einer übergeordneten Seite geerbt.

**Erlaubte Mitgliedergruppen:** Hier kannst du festlegen, welche Mitgliedergruppen auf die Seite zugreifen dürfen. Wie
man Mitglieder und Mitgliedergruppen konfiguriert, erfährst du auf der Seite
[Systemverwaltung](/de/system/einstellungen/).


## Layout-Einstellungen

Ein Seitenlayout ist Voraussetzung dafür, dass Contao eine Seite überhaupt im Frontend anzeigen kann. Ist kein
Seitenlayout zugewiesen oder vererbt worden, quittiert Contao mit einem kurzen »No layout specified« den Dienst.

**Ein Layout zuweisen:** Hier kannst du einer Seite ein Seitenlayout zuweisen. Die Zuweisung des Seitenlayouts
gilt automatisch auch für alle untergeordneten Seiten ohne eigenes Seitenlayout.

**Seitenlayout:** Hier werden dir alle verfügbaren Seitenlayouts nach Themes gruppiert angezeigt. Die Aktivierung eines
Themes erfolgt durch Zuweisung eines Seitenlayouts.

**Unterseitenlayout:** Mit der Auswahl »Seitenlayout vererben« (Standard) gilt die Zuweisung
des Seitenlayout auch für alle untergeordneten Seiten ohne eigenes Seitenlayout. Alternativ kann hier ein separates,
abweichendes Seitenlayout für untergeordnete Seiten zugewiesen werden.


## Zwei-Faktor-Authentifizierung

Du kannst hier die Zwei-Faktor-Authentifizierung für alle Mitglieder (Frontend) erzwingen. Wähle eine Seite aus, auf 
die die Besucher weitergeleitet werden, wenn sie die Zwei-Faktor-Authentifizierung einrichten.


## Cache-Einstellungen

In den Cache-Einstellungen legst du fest, ob und wie lange eine Seite im Cache zwischengespeichert werden soll. Eine
zwischengespeicherte Seite lädt deutlich schneller, da sie zum einen nicht erst von Contao generiert werden muss und
zum anderen für ihre Auslieferung keine Verbindung zur Datenbank notwendig ist.

**Cachezeit festlegen:** Hier kannst du einer Seite eine Cachezeit zuweisen. Wenn du die Option nicht auswählst, werden
die Cache-Einstellungen von einer übergeordneten Seite geerbt.

**Private Cache (Client-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite vom Browser als veraltet eingestuft werden soll.

**Shared Cache (Server-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite von einem gemeinsam genutzten Cache als veraltet eingestuft werden soll.

Beachte, dass Seiten aus Sicherheitsgründen nur zwischengespeichert werden, wenn sie nicht geschützt sind und kein
Benutzer im Backend angemeldet ist. Ansonsten bestünde die Gefahr, dass vertrauliche Daten in den Cache geschrieben und
versehentlich im Frontend angezeigt würden. Wundere dich also nicht, wenn deine passwortgeschützten Seiten trotz
zugewiesener Verfallszeit nicht im Cache auftauchen.

**Immer aus dem gemeinsam genutzten Cache laden:** Lade diese Seite immer aus dem gemeinsam genutzten Cache, auch wenn
ein Mitglied angemeldet ist. Beachte, dass du in diesem Fall die Seite für eingeloggte Mitglieder nicht mehr
personalisieren kannst.


## Zugriffsrechte

In den Zugriffsrechten legst du fest, welche Benutzer im **Backend** auf eine Seite zugreifen dürfen und was sie mit
dieser Seite und den darin enthaltenen Artikeln machen können. Jede Seite gehört ähnlich dem Unix-Rechtesystem einem
bestimmten Benutzer und einer bestimmten Benutzergruppe und unterscheidet drei Zugriffsebenen:

- Zugriff als Besitzer einer Seite
- Zugriff als Mitglied der Gruppe einer Seite
- Zugriff als sonstiger Backend-Benutzer

Die Seite »Unternehmen« ist beispielsweise mit Zugriffsrechten versehen und gehört dem Benutzer h.lewis sowie der
Benutzergruppe _Nachrichten_. Sowohl der Benutzer als auch alle Mitglieder der Benutzergruppe dürfen auf
dieser Seite Artikel bearbeiten, aber nur der Besitzer h.lewis – und du als Administrator natürlich – dürfen die Seite
an sich bearbeiten und z. B. den Seitentitel ändern.

![Zugriffsrechte zuweisen]({{% asset "images/manual/layout/site-structure/de/zugriffsrechte-zuweisen.png" %}}?classes=shadow)

**Zugriffsrechte zuweisen:** Hier kannst du einer Seite Zugriffsrechte zuweisen. Wenn du die Option nicht auswählst,
werden die Zugriffsrechte von einer übergeordneten Seite geerbt.

**Besitzer:** Hier legst du den Besitzer der Seite fest.

**Gruppe:** Hier legst du die Gruppe der Seite fest.

**Zugriffsrechte:** Hier weist du die Rechte den einzelnen Zugriffsebenen zu.

Weitere Informationen zum Rechtesystem und zur Konfiguration von Benutzern und Benutzergruppen erhältst du auf der
Seite [Systemverwaltung](/de/system/einstellungen/).

## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.

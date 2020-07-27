---
title: "HTTP Caching"
description: "HTTP Caching mit Contao."
url: "performance/http-caching"
aliases:
    - /de/performance/http-caching/
---

{{% notice info %}}
Dieser gesamte Artikel bezieht sich auf Contao ab **Version 4.9**.
Vorherige Versionen verfügen zwar auch über Caching-Mechanismen, diese sind aber nicht annähernd so effizient.
Daher wurde darauf verzichtet, die Funktionsweise des Cachings für die älteren Versionen zu dokumentieren.
{{% /notice %}}

Der grösste Performance-Gewinn in jeder Applikation lässt sich dadurch erzielen, sie gar nicht erst starten zu müssen.
Mit anderen Worten: Wir möchten, dass die Ausgabe die Contao generiert, gespeichert und beim nächsten Aufruf direkt
ausgeliefert wird, ohne dass Contao dafür gestartet werden muss.

Contao baut dafür auf die Schultern von Giganten: dem Rückgrat des Internets, dem Hypertext Transfer Protocol (HTTP).

Wieso sollte Contao das Rad neu erfinden, wenn sich [schlaue Köpfe schon zur Einführung von HTTP/1.1 1999][rfc2616] Gedanken
zu Caching von HTTP-Antworten gemacht haben?

## HTTP

Back to the basics, also. Zum Verständnis wie HTTP-Caching in Contao konfiguriert werden kann, sollten wir uns kurz 
in Erinnerung rufen, wie HTTP und somit im Prinzip das gesamte Internet und die Kommunikation vieler anderer Geräte
funktioniert:

{{<mermaid align="left">}}
sequenceDiagram
    participant Client
    participant Server
    Client->>Server: Anfrage (Request)
    Server->>Client: Antwort (Response)
{{< /mermaid >}}

Dabei ist es so, dass grundsätzlich beliebige weitere Mittler (sog. "Proxies") dazwischen geschaltet sein können.
Sowas ist nicht nur denkbar, sondern tatsächlich auch sehr üblich:

{{<mermaid align="left">}}
sequenceDiagram
    participant Client
    participant Proxy 1
    participant Proxy 2
    participant Server
    Client->>Proxy 1: Request
    Proxy 1->>Proxy 2: Request
    Proxy 2->>Server: Request
    Server->>Proxy 2: Response
    Proxy 2->>Proxy 1: Response
    Proxy 1->>Client:  Response
{{< /mermaid >}}

Diese Proxies können beliebige Aufgaben übernehmen, dazu gehören u. a.:

* Load Balancing (Hohe Last auf verschiedene Server verteilen)
* CDN-Aufgaben (Tiefere Latenz durch geographisch kürzere Distanzen zum Client)
* Authentifizierung/Autorisierung
* Verschlüsselung (SSL/TLS)
* Optimierungen anbringen (bspw. Komprimierung)
* und eben: **Caching!**

Damit der Client (in unserem Fall meistens der Browser) und der Server bzw. die Proxies/Server untereinander kommunizieren
können, lässt sich jede HTTP-Anfrage und jede HTTP-Antwort mit Metadaten ausstatten. Diese sog. »HTTP-Header« sind
standardisiert aber es ist jedem/jeder Entwickler*in freigestellt, weitere Header zu erfinden und diese zu nutzen.
Eine typische Anfrage könnte bspw. so aussehen:

```http request
GET /about-us.html HTTP/1.1

Accept-Language: de,en
Host: www.contao.org
```

In diesem Fall möchte der Client also gerne die Ressource die unter `/about-us.html` liegt und er teilt dem Server mit,
dass er selber die Sprachen `en` und `de` versteht wobei er `de` bevorzugt. Ausserdem möchte er die Antwort vom Host
`www.contao.org`. Die Kommunikation zwischen Client und Server findet via IP statt und ein Server kann
beliebig viele Domains bedienen.

Eine Antwort darauf könnte so aussehen:

```http request
HTTP/1.1 200 OK

Content-Type: text/html; charset=utf-8
Content-Length: 42
Cache-Control: max-age=3600

<html>
...
</html>
```

Der Server teilt uns hier mit, dass alles in Ordnung war (`200 OK`). Die Antwort enthält `UTF-8` encodiertes `HTML` und
sie ist `42` Bytes lang. Ausserdem darf diese Antwort `3600` Sekunden, also eine Stunde, gecached werden.

## Die HTTP-Caching Header

Es gibt eine Reihe an HTTP-Headern die relevant für HTTP-Caching sind. Sie alle zu erklären würde den Rahmen
dieser Dokumentation deutlich sprengen. Das Thema ist ausserdem bereits u. a. [bei MDN äusserst gut dokumentiert][mdn-caching],
so dass du dir dort bei Interesse weiteres Wissen aneignen kannst.

Den regulären Anwender von Contao interessiert vor allem der `Cache-Control`-Header und dabei die wichtigsten drei
Attribute:

* `private` oder `public`

  Gibt einem Client an, ob die Antwort privat oder öffentlich ist. Der Browser bspw. darf sowohl private als auch
  öffentliche Antworten cachen, da er die Antwort ja nicht mehr weiterreicht. Ein Proxy hingegen, darf private Antworten
  nicht cachen, da er die Antwort weiterreicht. Sie können nicht kombiniert werden. Etwas das öffentlich gecached werden
  darf, darf auch privat gecached werden.
  Eine öffentliche (`public`) Antwort bedeutet also auch implizit, dass sich mehrere Clients den selben Cache-Eintrag
  teilen. Man spricht deshalb auch von einem geteilten Cache, dem »Shared Cache«.
  
* `max-age`

  Enthält die Anzahl Sekunden die ein Client diese Antwort cachen darf.

* `s-maxage`

  Enthält die Anzahl Sekunden die ein öffentlicher Client diese Antwort cachen darf. Dieses Attribut wird nur dann
  verwendet, wenn sich die Cache-Dauer für öffentliche und private Clients unterscheiden soll.
  
Zum besseren Verständnis ein paar Beispiele:

| HTTP-Header                        | Interpretation                                                                                                                                    |
|------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------|
| `Cache-Control: max-age=3600`                        | Nur private Clients dürfen diese Antwort für eine Stunde cachen.                                                                |
| `Cache-Control: max-age=3600, private`               | Nur private Clients dürfen diese Antwort für eine Stunde cachen.                                                                |
| `Cache-Control: max-age=3600, public`                | Sowohl öffentliche als auch private Clients dürfen diese Antwort für eine Stunde cachen.                                         |
| `Cache-Control: max-age=3600, s-maxage=7200, public` | Sowohl öffentliche als auch private Clients dürfen diese Antwort cachen. Private für eine Stunde, öffentliche für zwei Stunden. |

Und so finden sich denn auch genau diese Einstellungen zur Cache-Dauer in den Contao Seiteneinstellungen. Folgende
Auswahl übersetzt sich also zu `Cache-Control: max-age=1800, s-maxage=3600, public`:

![Caching-Einstellungsmöglichkeiten im Contao Backend](/de/performance/images/de/cache-einstellungen.png?classes=shadow)

## Vorteile der Nutzung von Standards

Die Contao Managed Edition wird mit einem Caching Proxy ausgeliefert, der ebenfalls in PHP geschrieben ist und direkt
vor Contao sitzt. Das heisst, jede Antwort die Contao generiert, wird vor der Auslieferung an den Client durch
unseren Caching-Proxy geschickt und entsprechend den HTTP-Headern im Cache abgelegt oder eben nicht.

{{% notice tip %}}
Es ist wichtig zu verstehen, dass der mitgelieferte Proxy absolut **nichts** von Contao weiss. Obwohl er ebenfalls in
PHP geschrieben ist, ist er völlig unabhängig und kennt absolut keine Contao-Eigenheiten. Alles was er tut, basiert
auf den Headern der HTTP-Requests und -Responses die er vom Client bzw. von Contao bekommt.
{{% /notice %}}

Den grossen Vorteil den wir durch die Nutzung von HTTP-Standards gewinnen, ist die freie Wahl des Caching-Proxys.
Bei wirklich hohem Besuchervorkommen, kommt PHP irgendwann an seine Grenzen. Vielleicht kommt man dann zum Schluss,
leistungsfähigere - explizit für Caching ausgelegte - Proxies wie bspw. [Varnish][varnish] vor Contao zu setzen.

Das würde allerdings an dieser Stelle zu weit führen.

{{% notice note %}}
Gut zu wissen für dich: Welche Einstellungen auch immer du in den Seiten vorgenommen hast, Contao befolgt die HTTP-
Standards und funktioniert einfach out-of-the-box für dich. Sollten die Anforderungen irgendwann mal komplexer werden,
lässt dich Contao aber auch nicht im Stich!
{{% /notice %}}

## Cached der Shared-Proxy?

In diesem Abschnitt geht es darum, was denn nun im Shared Cache abgelegt werden darf. Wir sprechen also nicht mehr vom
privaten Cache, also bspw. deinem persönlichen Browsercache.
Wir wollen ja jetzt dafür sorgen, dass eben möglichst viele unserer Besucher Contao gar nicht starten müssen, sondern
vom Shared Cache profitieren können.

Das wichtigste Kriterium kennen wir bereits: Den `Cache-Control: public`-Response-Header. Wenn dieser Header fehlt, dann
kann der Shared Cache diese Antwort nie im Cache ablegen. Daneben gibt es aber noch weitere Kriterien:

* Der HTTP-Statuscode muss grundsätzlich `200 OK`, `301 Permanent Redirect` oder `404 Not Found` lauten
  (es gibt noch eine Reihe weiterer Status, aber die dürften für uns an dieser Stelle nicht so relevant sein)
  
* `Cache-Control` darf nicht `no-store` enthalten. Dieser Wert verhindert jegliches Caching.

* Es braucht eine Angabe zur Cache-Dauer, sprich `max-age` oder `s-maxage` im `Cache-Control` Header (auch hier gibt es
  weitere Header, die für uns aber nicht relevant sind)
 
Im Falle des mitgelieferten Contao Cache-Proxy's könnt ihr das relativ einfach überprüfen. Alle Antworten von Contao
werden dann nämlich mit einem `Contao-Cache` Header ausgestattet welcher grundsätzlich drei Werte annehmen kann:

* `miss`

  Der Contao-Cache konnte keinen Cache-Eintrag finden. Contao wird gestartet, generiert die Antwort und diese Antwort
  kann auch nicht im Cache abgelegt werden.
  
* `miss/store`

  Der Contao-Cache konnte keinen Cache-Eintrag finden. Contao wird gestartet, generiert die Antwort und diese Antwort
  kann gecached werden und wird entsprechend abgelegt.
    
* `fresh`

  Der Contao-Cache hat den Cache-Eintrag gefunden und die Antwort kommt direkt aus dem Cache. Im Idealfall solltest du
  das aber bereits an der Geschwindigkeit festgestellt haben. Im Falle von `Contao-Cache: fresh` gibt es auch noch den
  `Age` HTTP-Header. Er gibt dir an, wie viele Sekunden der Cache-Eintrag bereits existiert. Ein `Age: 60` bedeutet also,
  dass dieser Eintrag vor einer Minute angelegt wurde.

{{% notice info %}}
Wenn die Contao Managed Edition im Debug-Modus läuft, wird auch der gesamte Cache-Proxy deaktiviert.
{{% /notice %}}

## Wann Shared Caching nicht funktionieren kann

Wie wir gesehen haben, gibt es einige grundlegende Voraussetzungen, damit HTTP-Caching funktionieren kann.
Nebst den genannten Voraussetzungen gibt es für Contao im Speziellen noch weitere Gründe, eine Antwort vom Shared
Cache auszunehmen (also `private` zu machen):

* Wenn die Anfrage einen `Authorization`-HTTP-Header enthält

  Der `Authorization`-Header enthält gemäss Standard Authentifizierungsdetails. Für Contao bedeutet das daher, dass ggf.
  ein Modul, ein Inhaltselement auf diesen Header hört und potenziell benutzerspezifische Daten ausliefert. Um sicherzustellen,
  dass nicht private Daten im Shared Cache abgelegt und potenziell einem anderen Besucher ausgeliefert werden, forciert
  Contao hier `Cache-Control: private`. Contao teilt dir das auch mit: Der `Contao-Response-Private-Reason`-Header
  enthält in diesem Fall `authorization`.
  
  {{% notice warning %}}
  Es ist sehr beliebt, Installationen während der Entwicklung mit Basic Authentication zu schützen. Dies bedeutet, dass
  der Request einen `Authorization`-Header enthält und somit der Cache immer deaktiviert wird. Bedenke das, wenn du
  Cache-Einstellungen testest.
  {{% /notice %}}

* Wenn die Anfrage ein PHP-Session-Cookie enthält oder die Antwort es setzt

  Der offensichtlichste Fall ist hierbei natürlich die PHP-Session, also wenn sich ein Benutzer im Backend oder ein Mitglied
  im Frontend einloggt. In diesem Fall werden alle Antworten immer `private` und der `Contao-Response-Private-Reason`-
  Header enthält `session-cookie`.

* Wenn die Antwort ein Cookie enthält

  Wenn die Antwort ein Cookie enthält, bedeutet das, der/die Entwickler*in möchte die Antwort personalisieren. Die
  aktuelle Antwort enthält also potenziell bereits persönliche Daten. Der `Contao-Response-Private-Reason`-Header
  enthält in diesem Fall `response-cookies` inkl. einer Liste der betroffenen Cookie-Namen.
  
* Wenn die Anfrage ein Cookie enthält

  Dies ist der weitaus wahrscheinlichste, aber auch der komplexeste Fall. Alle Anfrage-Cookies **können** den Cache
  deaktiveren, **müssen** aber nicht zwingend.
  
  Die Regel ist ganz einfach: Jedes Cookie kann potenziell einen Besucher identifizieren und somit könnte die Applikation
  (also Contao) personalisierte Inhalte (Warenkörbe, persönliche Empfehlungen, Logins etc.) ausliefern. Somit darf ein
  Cache Proxy standardmässig auch nichts aus dem Cache ausliefern, wenn die Anfrage ein Cookie enthält.
  Wir halten nochmal fest: **Jedes** einzelne Cookie bedeutet implizit, dass der Reverse Proxy umgangen wird.
  Wollen wir eine Antwort aus dem Cache generieren lassen, so müssen wir also sicherstellen, dass **kein einziges Cookie**
  den Weg zum Cache-Proxy findet.
  
  Allerdings gibt es eine Vielzahl an Cookies. Hier mal ein paar Beispiele:
  
  * Die ganzen `_ga_*` Cookies von Google Analytics
  * Die ganzen `_pk_*` Cookies von Matomo
  * Cloudflare's `__cfduid` Cookie
  * Dein `cookiebar_accepted` Cookie, um zu wissen ob die Cookie-Bestimmungen akzeptiert wurden
  * usw.

  Die Liste ist ziemlich lang und der aufmerksame Leser hat jetzt schon einen grundsätzlichen Unterschied zwischen z. B. 
  dem zuvor erwähnten PHP-Session-Cookie und z. B. dem `_ga_*` Cookie entdeckt. Denn eines davon ist wirklich relevant für
  den Server (also die PHP-Session) und das andere ist für das clientseitige Tracking (also innerhalb des Browsers)
  des Benutzers zuständig und für Contao völlig irrelevant.
  
  Mit anderen Worten, wenn ein Request nur ein `_ga_*` Cookie enthält, können wir trotzdem die Antwort aus dem Cache
  liefern, denn dieses Cookie generiert keinen persönlichen Inhalt. Ein schlauer Cache-Proxy könnte also nur die
  relevanten Cookies berücksichtigen und alle anderen wegschmeissen, bevor er entscheidet, ob eine Antwort aus dem Cache
  geliefert werden kann.
  
  Um eine möglichst hohe Trefferquote beim Caching out-of-the-box liefern zu können, pflegt Contao eine Liste an
  irrelevanten Cookies innerhalb des Contao Cache Proxys. Diese werden vor dem Cache-Lookup vom Request entfernt
  und kommen somit weder beim Cache-Proxy noch (im Falle eines Cache Misses) bei Contao selbst an.
  
  Die fortgeschritteneren Anwender können diese Liste übersteuern.
  
  {{% notice warning %}}
  TODO: Soll das hier überhaupt erwähnt werden? Irgendwo muss es ja auch für Nicht-Entwickler stehen.
  {{% /notice %}}

  Im Falle von Cookies, enthält der `Contao-Response-Private-Reason`-Header `request-cookies` mit einer Liste aller
  Cookies die dafür gesorgt haben, dass die Antwort `private` wurde.  
  
## FAQ

{{% expand "Heisst das, die Remember-Me-Funktion deaktiviert den Cache für einen Besucher komplett?" %}}
Ja. Die Funktion von Remember-Me ist, einen Besucher beim Aufruf egal welcher URL automatisch einzuloggen, sofern
dies noch nicht der Fall ist. Es ist daher unmöglich, die Antwort aus dem Cache auszuliefern, sonst würde ein Besucher
ja nie eingeloggt werden.
{{% /expand %}}

{{% expand "Meine Erweiterung speichert aber in einem Cookie ob die Cookie-Bar noch angezeigt werden soll, dann ist der Cache ja auch immer deaktiviert?" %}}
Korrekt. Das wäre ein perfektes Beispiel für `localStorage`. Der Server braucht das nicht zu wissen, denn den Inhalt
der Cookie-Bar kann man auch mit JavaScript dynamisch in den DOM einfügen lassen, wenn der entsprechende Key noch nicht
im `localStorage` existiert. Informiere den/die Entwickler*in der Erweiterung darüber, das doch wenn möglich ohne
Cookie zu lösen.
{{% /expand %}}





[rfc2616]: https://tools.ietf.org/html/rfc2616
[mdn-caching]: https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching
[varnish]: https://varnish-cache.org/

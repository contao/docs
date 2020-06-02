---
title: "Mumble Installation"
description: "Die Mumble Installation."
url: "anleitungen/mumble"
aliases:
    - /de/anleitungen/mumble/
    - /anleitungen/mumble/
weight: 50
---

## Installation

Informationen zu Mumble findest du über [mumble.info](https://www.mumble.info/). Zur 
[Installation](https://www.mumble.info/downloads/) musst du dir die passenden Dateien für dein 
Betriebssystem herunterladen. Du benötigst nur den Mumble-Client. Die Installation der Mumble-Server-Anwendung 
ist nicht notwendig.

Wann der nächste Contao Mumble-Call stattfindet, erfährst du auf der [Projekt-Website](https://contao.org/de/mumble-calls.html).


## Mumble einrichten

Nach dem ersten Start von Mumble sollte sich der »Audio Einstellungs-Assistent« öffnen. Alle Einstellungen können 
auch nachträglich angepasst werden.

![Mumble Audio Einstellungs-Assistent](/de/guides/images/de/mumble/mumble-audio-assistant.jpg?classes=shadow)

Wenn man den »Weiter«-Button betätigt, kann man auf dem nächsten Screen die bevorzugte Audio-Ein- und Ausgabegeräte auswählen.

![Mumble Audio Einstellungs-Assistent Geräteauswahl](/de/guides/images/de/mumble/mumble-audio-assistant-geraeteauswahl.jpg?classes=shadow)

Im nächsten Screen wird die Leistung der Grafikkarte ermittelt. Dies wird im Assistentenfenster beschrieben. Man hört also 
einen Text und soll den Schieberegler unter dem Text soweit wie möglich nach links schieben, ohne dass der vorgelesene 
Text qualitativ schlechter wird oder anfängt zu stocken.

![Mumble Audio Einstellungs-Assistent Geräteeinstellung](/de/guides/images/de/mumble/mumble-audio-assistant-geraeteeinstellungen.jpg?classes=shadow)

Der nächste Schritt behandelt die Lautstärken-Einstellungen. Folgt man den Anweisungen auf dem Bildschirm, 
sollte man die optimale Einstellung finden.

![Mumble Audio Einstellungs-Assistent Lautstärke](/de/guides/images/de/mumble/mumble-audio-assistant-lautstaerkeneinstellungen-mikro.jpg?classes=shadow)

Kommen wir nun zur Sprachaktivitätserkennung. Diese wird dazu benutzt, um einzustellen, ab wann die »Geräusche«, die über 
das Mikrofon aufgenommen werden, als Sprache einzuordnen sind. Wir empfehlen vorerst die Einstellung 
»Rohamplitude der Eingabe« beizubehalten. Anschließend kann man den Schieberegler unter dem Aktivitätsbalken in die 
Mitte stellen. 

Wenn man dann im Mumble ist, kann man diese Einstellung noch besser anpassen, aber so sollte es 
erstmal funktionieren. Auf diesem Screen erkennt man auch schon den Mund, der bei erkannter und aktivierter Sprache rot 
wird und somit ein Zeichen für die Spracheingabe ist. Auch im späteren Mumble-Statusfenster wird dieser Mund zu sehen sein 
und zeigt an, wer gerade spricht.

![Mumble Audio Einstellungs-Assistent Sprachaktivierung](/de/guides/images/de/mumble/mumble-audio-assistant-sprachaktivitaetserkennung.jpg?classes=shadow)

Der folgende Screen möchte noch zwei Einstellungen zur Qualität und den Hinweisen erfragen. Die Qualität kann man auf 
»ausgeglichen« lassen. Bei den Benachrichtigungen empfehlen wir, den Punkt »Text-zu-Sprache deaktivieren und Sounds benutzen« 
zu aktivieren, denn gerade »Text-zu-Sprache« kann am Anfang zu großen Verwirrungen führen.

![Mumble Audio Einstellungs-Assistent Sprachqualität](/de/guides/images/de/mumble/mumble-audio-assistant-qualitaet-hinweise.jpg?classes=shadow)

Der letzte Punkt ist eigentlich nur für die Benutzung mit Spielen interessant und kann durchaus ignoriert werden. Wenn man 
Kopfhörer benutzt, kann man aber gern den Haken bei »Benutze Kopfhörer« setzen.

![Mumble Audio Einstellungs-Assistent Audio-Position](/de/guides/images/de/mumble/mumble-audio-assistant-positionsabhaengiges-audio.jpg?classes=shadow)

Damit ist die Audio-Konfiguration abgeschlossen.


## Zertifikat-Management

Bei Mumble muss man sich im Allgemeinen keinen Benutzernamen oder Passwort überlegen, sondern man wird mit Hilfe eines 
Zertifikates identifiziert. Wenn man bereits ein Zertifikat hat (z.B. ein Mail-Zertifikat o. ä.) kann man dieses 
durchaus nutzen. Du kannst dir aber auch ein Zertifikat von Mumble erstellen lassen.

![Mumble Zertifikat-Management](/de/guides/images/de/mumble/mumble-zertifikat-management.jpg?classes=shadow)


## Mumble-Server auswählen

Es gibt viele verschiedene Mumble-Server auf der ganzen Welt, aber wir wollen nur einen bestimmten und deshalb muss 
man Mumble noch die Zugangsdaten zum »CCA-Mumble-Server« mitteilen. Dazu im erscheinenden Screen einfach 
auf »Server hinzufügen« klicken.

![Mumble Server Verbindung](/de/guides/images/de/mumble/mumble-server-verbinden.jpg?classes=shadow)

Folgende Daten sollte man eingeben:

- **Bezeichnung:** Kann frei gewählt werden, z.B. "CCA-Mumble-Server"
- **Adresse:** mumble.c-c-a.org
- **Port:** 62492
- **Benutzername:** Kann frei gewählt werden

In der Serverliste sollte der »CCA-Mumble-Server« nun unter den Favoriten auftauchen. Diesen Eintrag auswählen 
und auf »Verbinden« klicken.

![Mumble Server Verbindung wählen](/de/guides/images/de/mumble/mumble-server-auswaehlen.jpg?classes=shadow)


## Mumble Statusfenster

Herzlichen Glückwunsch, denn wenn man das nachfolgende Fenster sieht, dann ist man im »Mumble«. Wenn man sich auf 
dem Mumble-Server anmeldet wird man am Anfang immer automatisch in die »Mos Eisley Bar« verschoben. Das ist 
eine Art virtueller Aufenthaltsraum. Ansonsten ist der »CCA-Mumble-Server« in folgende »Hauptkanäle« (sog. Channel) 
geteilt: »Galaxie« und »Universum«. 

Diese wiederum in verschiedene Subchannel. Alle Channels im »Universum« sind für jeden frei zugänglich, außerdem 
sind in der »Galaxy« die Channels »Galaktische Spiele«, »Galaktischer Salat« und »Galaktischer Senat« mit »offener Senat« für euch zugänglich.

Im Channel »geschlossener Senat« (in »Galaktischer Senat«) dürfen nur Administratoren. Diese Administratoren 
dürfen aber nun alle anderen in den Channel einladen und ihnen u. a. Sprachrechte zuweisen.

{{% notice note %}}
Wenn man in der Audio-Einrichtung eingestellt hat, dass Mumble automatisch den Sprachstatus erkennt, wird ab sofort 
jedes Wort/Geräusch an Mumble übertragen, wenn man sich selbst nicht mutet.
{{% /notice %}}

![Mumble Status Fenster](/de/guides/images/de/mumble/mumble-statusfenster.jpg?classes=shadow)


## Problem-Behandlung

Sollte jemand schon bei der Einrichtung auf Probleme stoßen, dann schreibt einfach der CCA über Twitter 
([CCA bei Twitter](https://twitter.com/ContaoCA)), über Facebook 
([CCA bei Facebook](https://www.facebook.com/contao.community.alliance)) oder einer der anderen 
[Kommunikationskanäle](https://c-c-a.org/aktuelles/news/details/contao-kommunikationskanaele). Wir helfen gern weiter.


Wenn es nach erfolgreicher Einrichtung trotzdem Sprachprobleme gibt können wir direkt im Mumble weiter helfen. 
Ob jemand im Mumble aktiv ist und helfen kann, erfährt man live auf [CCA-Website](https://c-c-a.org/aktuelles/news) 
in der Box »Mumblestatus«.

Unter dem Menüpunkt »Einstellungen« gibt es (unter Windows/Linux unten links, unter Mac OS X oben rechts) 
den Punkt »Erweitert«.

Jetzt unter »Audioeingabe« nachschauen, ob ein Ausschlag bei der Spracheingabe in das Mikrodon gemessen wird. 
Wenn es keinen Ausschlag gibt, wird vom Mikro überhaupt gar kein Ton aufgenommen. Deshalb sollte man unter 
»Audioeingabe« den Punkt »Gerät« (unter »Schnittstelle«) prüfen ob die passende Eingabequelle/Mikrofon ausgewählt ist.

Wenn es unter »Audioausgabe« einen Ausschlag gibt, dieser aber nur im roten Bereich bleibt sollte man die Regler 
»Stille bis« und »Sprache über« so verschieben, dass der Ausschlag im grünen Bereich ist.


### Bedeutung der Bereiche:

- **Gelber Bereich:** Hier wird noch übertragen, falls es zuvor im grünen Bereich war.
- **Roter Bereich:** Auch wenn hier ein Ausschlag zu sehen ist, wird hiervon nichts übertragen.

---
title: "Über den Contao Manager"
description: "Der Contao Manager ist ein Tool, welches eine grafische Oberfläche zur einfachen Verwaltung einer 
Contao-Installation bietet."
weight: 2
---

Die Entwicklung des Contao Managers wird durch die [Contao Association](https://association.contao.org/) unterstützt.

## Aufgabe des Managers

Der Contao Manager ist ein Tool, welches eine grafische Oberfläche zur einfachen Verwaltung einer Contao-Installation 
bietet. Im Prinzip werden vom Manager die nötigen Befehle für den Composer im Hintergrund ausgeführt.

Mit dem Manager können unter anderem folgende Aufgaben durchgeführt werden:

- Contao installieren
- Contao aktualisieren
- Erweiterungen suchen
- Erweiterungen installieren
- Erweiterungen deinstallieren
- Contao Cache leeren (Systemwartung)

Für die Zukunft sind weitere Funktionen geplant, wie z.B. Systemeinstellungen festlegen oder den Contao Check ausführen.

Der Contao Manager ist optional und nicht zwingend für den Betrieb von Contao nötig. Das Tool erleichtert jedoch 
besonders Einsteigern die Installation und Verwaltung von Erweiterungen, da keine Composer-Kenntnisse nötig sind.

Es ist weiterhin möglich die Installation von Contao 4 und Extensions direkt über die Kommandozeile per Composer zu 
verwalten.


## Contao Manager installieren


### Systemvoraussetzungen

Die Systemvoraussetzungen entsprechen grundsätzlich denen von [Contao](../../installation/systemvoraussetzungen). Der 
Contao Manager prüft automatisch, ob die Anforderungen erfüllt sind.

- PHP Version 5.5.9 oder neuer
- PHP Erweiterung *Intl* und *OpenSSL*
- PHP Funktionen *proc_open* und *proc_close*
- PHP Einstellung *allow_url_fopen* muss aktiv sein


### Hosting-Konfiguration

In Contao befinden sich alle öffentlich erreichbaren Dateien im Unterorder <code>/web</code> der Installation. Erstelle 
dazu den Ordner <code>web</code> und setze das Wurzelverzeichnis (Document Root) der Installation über das Admin-Panel 
des Hosting-Providers auf diesen Unterordner.

**Beispiel:** <code>example.com</code> zeigt auf das Verzeichnis <code>/www/example/web</code>

{{% notice note %}}
Pro Contao-Installation wird deshalb eine eigene (Sub)Domain benötigt.
{{% /notice %}}


### Download und Installation

Der Contao Manager besteht aus einer einzelnen Datei, welche über [contao.org](https://contao.org/de/download.html) 
heruntergeladen werden kann. Nach erfolgreichem Download erhältst du eine Datei <code>contao-manager.phar</code>. 
Übertrage diese Datei in das Verzeichnis <code>web</code> auf deinem Webserver.

{{% notice info %}}
<code>.phar</code>-Dateien werden nicht von allen Hosting-Anbietern ausgeführt. Für beste Kompatibilität füge die 
Dateiendung <code>.php</code> hinzu (Finaler Dateiname: <code>contao-manager.phar.php</code>).
{{% /notice %}}

{{% notice warning %}}
<code>.php</code>-Dateien werden von den meisten FTP-Programmen im Text- statt Binär-Modus übertragen, was die 
Manager-Datei zerstört. Füge deshalb die Dateiendung <code>.php</code> erst nach dem Upload hinzu.
{{% /notice %}}


### Contao Manager aufrufen

Rufe anschließend mit deinem Browser die URL <code>www.example.com/contao-manager.phar.php</code> auf. Du solltest nun 
die Willkommensseite des Contao Managers sehen.

![Willkommensseite des Contao Managers](/installation/images/de/willkommensseite-des-contao-managers.png)


### Grundkonfiguration

Bevor du nun Contao installierst, muss der Manager selbst konfiguriert werden. Lege dazu einen neuen Benutzer an, indem 
du einen Benutzernamen und ein Passwort vergibst. Das Passwort ist unabhängig von der späteren Contao Installation.

Der Contao Manager benötigt keine eigene Datenbank. Die Konfiguration des Contao Managers wird in der 
<code>manager.json</code> und die Benutzerdaten in der <code>users.json</code> im Verzeichnis 
<code>/contao-manager</code> gespeichert.


### Serverkonfiguration

Der Contao Manager benötigt den Pfad zum PHP-Binary und weitere Server-Informationen, um Hintergrund-Prozesse korrekt 
auszuführen.

Die meisten Server werden automatisch erkannt. Sollte dein Hosting-Anbieter nicht aufgeführt sein, kannst du diesen [in 
unserem Wiki ergänzen](https://github.com/contao/contao-manager/wiki).


#### Serverkonfiguration

Wähle die passende Konfiguration für deinen Server- oder Hosting-Anbieter aus. Für eine manuelle Konfiguration wähle 
»Andere …«.

![Serverkonfiguration](/installation/images/de/serverkonfiguration.png)


#### Composer Resolver Cloud

Der [Composer Resolver Cloud](https://composer-resolver.cloud/) erlaubt die Installation von Composer-Abhängigkeiten, 
selbst wenn der Server nicht über genug Arbeitsspeicher verfügt. Bitte beachte, dass deine Paketinformationen für die 
Auflösung der Abhängigkeiten an einen Cloud-Dienst der [Contao Association](https://association.contao.org/) 
übermittelt werden.


Nach der erfolgreichen Grundkonfiguration kann nun 
[Contao installiert](../contao-installieren/#contao-mit-dem-contao-manager-installieren) werden.


## Häufige Fragen zum Contao Manager {#haeufige-fragen-zum-contao-manager}


### Wie kann man den Contao Manager aktualisieren?

Grundsätzlich ist ein manuelles Update nicht nötig. Der Manager führt automatisch im Hintergrund eine Prüfung durch. 
Sollte eine neue Version verfügbar sein, aktualisiert sich der Manager selbst.

Bei Problemen kannst du jederzeit die aktuellste <code>contao-manager.phar</code> herunterladen und diese manuell 
[per FTP hochladen und ersetzen](#download-und-installation).


### Hast du die Zugangsdaten vom Contao Manager vergessen?

Um dein Passwort zurückzusetzen, musst du dich per FTP mit deinem Server verbinden.

Lösche im Verzeichnis <code>contao-manager</code> die Datei <code>users.json</code>.

Rufe nun den Contao Manager über deine Domain mit dem Zusatz <code>contao-manager.phar.php</code> auf und lege einen 
neuen Admin-User an.


### Kann ich dem Contao Manager ein weiteres Benutzerkonto hinzufügen? {#kann-ich-dem-contao-manager-ein-weiteres-benutzerkonto-hinzufuegen}

Ja, dazu musst du im Verzeichnis <code>contao-manager</code> die Datei <code>users.json</code> bearbeiten und ein 
weiteres Benutzerkonto hinzufügen. In unserem Fall ist das <code>h.lewis</code>.

```json
{
    "users": {
        "k.jones": {
            "username": "k.jones",
            "password": "…"
        },
        "h.lewis": {
            "username": "h.lewis",
            "password": "…"
        }
    },
    "version": 2,
    "secret": "…"
}

```

### Kann der Contao Manager zu einer bestehenden Installation hinzugefügt werden? {#kann-der-contao-manager-zu-einer-bestehenden-installation-hinzugefuegt-werden}
    
Ja, wenn du eine Contao Installation in der Managed Edition verwendest, dann kann der Contao Manager nachinstalliert 
werden. Dazu einfach die <code>contao-manager.phar</code> in das Verzeichnis <code>web</code> laden und mit der 
Dateiendung <code>.php</code> versehen.

Der Manager erkennt bei der Grundinstallation, dass bereits Contao installiert ist.

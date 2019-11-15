---
title: "Benutzer (Backend)"
description: "Bisher haben wir ausschließlich als Administrator gearbeitet, der auf alle Bereiche und Elemente des 
Systems zugreifen darf."
url: "benutzerverwaltung/benutzer"
weight: 10
---

Bisher haben wir ausschließlich als Administrator gearbeitet, der auf alle Bereiche und Elemente des Systems zugreifen 
darf. Ein Benutzer wird in der Regel aber nur Zugriff auf die Ressourcen erhalten, die er für eine bestimmte 
Aufgabe tatsächlich benötigt.

![Das Backend aus Sicht des Benutzers](/de/user-management/images/de/das-backend-aus-sicht-des-benutzers.png)

Normale Benutzer haben im Gegensatz zu Administratoren standardmäßig überhaupt keine Rechte und dürfen grundsätzlich 
nur das tun, was du ihnen explizit erlaubst. Die sehr umfassende Rechteverwaltung in Contao ermöglicht es dir als 
Administrator nicht nur, den Zugriff auf bestimmte Backend-Module einzuschränken, sondern bei Bedarf jedes einzelne
Eingabefeld abzuschalten.

![Einzelne Eingabefelder freischalten](/de/user-management/images/de/einzelne-eingabefelder-freischalten.png)

## Benutzergruppen

Jeder Benutzer kann Mitglied in mehreren Benutzergruppen sein und erbt automatisch alle diesen Gruppen zugewiesenen 
Rechte. Die verschiedenen Berechtigungen werden addiert, sodass ein Mitglied der Gruppen A und B die Summe der Rechte 
beider Gruppen erhält – natürlich nur, wenn beide Gruppen aktiv sind.


### Erlaubte Module

Die Backend-Navigation wird dynamisch anhand der Benutzerrechte erstellt, wobei nicht freigegebene Backend-Module aus 
Gründen der Übersichtlichkeit auch nicht in der Backend-Navigation erscheinen. Der Zugriff auf die Theme-Module kann 
gesondert gesteuert werden.

**Backend-Module:** Hier legst du den Zugriff auf die Backend-Module fest.

**Theme-Module:** Hier legst du den Zugriff auf die Untermodule des Theme-Managers fest.


### Pagemounts

Das Einbinden eines Dateisystems, sodass ein Benutzer darauf zugreifen kann, bezeichnet man beim Computer als 
»mounten«. Analog dazu ist ein »Pagemount« die Seite, ab der ein Benutzer Zugriff auf die Seitenstruktur erhält.

**Pagemounts:** Hier wählst du die Pagemounts der Gruppe aus.

**Erlaubte Seitentypen:** Hier kannst du festlegen, welche Seitentypen die Mitglieder der Benutzergruppe erstellen 
dürfen vgl. [Seitentypen](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen).


### Filemounts

Analog zum Pagemount, der den Einstiegspunkt in die Seitenstruktur bestimmt, legt der Filemount den Einstiegspunkt in 
das Dateisystem fest. Auf Ordner außerhalb des Filemount kann der Benutzer nicht zugreifen.

![Filemounts des Benutzers](/de/user-management/images/de/filemounts-des-benutzers.png)

Der Benutzer sieht also nur die Ordner `files/public/media/content-images`, `files/public/media/documents` sowie 
`files/public/media/slider` und alle eventuell darin enthaltenen Unterordner. Alle übrigen Verzeichnisse, die sich 
auf derselben oder einer übergeordneten Ebene befinden, werden nicht angezeigt

![Die Dateiverwaltung aus Sicht des Benutzers](/de/user-management/images/de/die-dateiverwaltung-aus-sicht-des-benutzers.png)

**Filemounts:** Hier wählst du die Filemounts der Gruppe aus.

**Erlaubte Datei-Operationen:** Ein Verzeichnis und die darin enthaltenen Dateien sehen zu können, bedeutet noch nicht, 
dass ein Benutzer diese auch bearbeiten darf. Du kannst hier festlegen, was mit den gemounteten Ressourcen möglich ist.

| Operation                                                           | Erklärung                                                                                           |
|:--------------------------------------------------------------------|:----------------------------------------------------------------------------------------------------|
| Dateien auf den Server hochladen                                    | Der Benutzer darf bestimmte Dateien über die Dateiverwaltung auf den Server übertragen (Upload). Die erlaubten Dateien kannst du in den Backend-Einstellungen festlegen. |
| Dateien und Verzeichnisse bearbeiten, kopieren und verschieben      | Der Benutzer darf Dateien und Verzeichnisse umbenennen, duplizieren und verschieben. |
| Einzelne Dateien und leere Verzeichnisse löschen                    | Der Benutzer darf einzelne Dateien und leere Verzeichnisse löschen (nicht rekursiv). |
| Verzeichnisse inklusive aller Dateien und Unterordner löschen (!)   | Der Benutzer darf Dateien und Verzeichnisse rekursiv, also inklusive aller enthaltenen Unterorder und Dateien, löschen. |
| Dateien im Quelltexteditor bearbeiten                               | Der Benutzer darf den Inhalt bestimmter Dateien mit dem Quelltexteditor direkt auf dem Server bearbeiten. Die erlaubten Dateien kannst du in den Backend-Einstellungen festlegen. |
| Das Dateisystem mit der Datenbank synchronisieren                   | Der Benutzer darf das Dateisystem mit der Datenbank synchronisieren. |


### Bildgrößen

In diesem Punkt kannst du den Zugriff auf die verschiedenen Bildgrößen einschränken.


### Formular-Rechte 
[Formulargenerator](../../formulargenerator/)

**Erlaubte Formulare:** Hier legst du fest, auf welche Formulare die Mitglieder der Benutzergruppe zugreifen dürfen.

**Formular-Rechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue Formulare anlegen bzw. bestehende 
löschen dürfen.


### FAQ-Rechte 
[FAQ-Erweiterung](../../core-erweiterung/faq/)

**Erlaubte FAQ-Kategorien:** Hier legst du fest, auf welche FAQ-Kategorien die Mitglieder der Benutzergruppe zugreifen 
dürfen.

**FAQ-Kategorierechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue Kategorien anlegen bzw. 
bestehende löschen dürfen.


### Archiv-Rechte
[News/Blog-Erweiterung](../../core-erweiterung/nachrichten/)

**Erlaubte Archive:** Hier legst du fest, auf welche News/Blog-Archive die Mitglieder der Benutzergruppe zugreifen 
dürfen.

**Archivrechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue News/Blog-Archive anlegen bzw. 
bestehende löschen dürfen.

**Erlaubte RSS-Feeds:** Hier legst du fest, auf welche RSS-Feeds die Mitglieder der Benutzergruppe zugreifen dürfen.

**RSS-Feed-Rechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue RSS-Feeds anlegen bzw. bestehende 
löschen dürfen.


### Newsletter-Rechte 
[Newsletter-Erweiterung](../../core-erweiterung/newsletter/)

**Erlaubte Verteiler:** Hier legst du fest, auf welche Verteiler die Mitglieder der Benutzergruppe zugreifen dürfen.

**Verteilerrechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue Verteiler anlegen bzw. bestehende 
löschen dürfen.


### Events-Rechte
[Kalender-Erweiterung](../../core-erweiterung/kalender/)

**Erlaubte Kalender:** Hier legst du fest, auf welche Kalender die Mitglieder der Benutzergruppe zugreifen dürfen.

**Kalenderrechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue Kalender anlegen bzw. bestehende 
löschen dürfen.

**Erlaubte RSS-Feeds:** Hier legst du fest, auf welche RSS-Feeds die Mitglieder der Benutzergruppe zugreifen dürfen.

**RSS-Feed-Rechte:** Hier legst du fest, ob die Mitglieder der Benutzergruppe neue RSS-Feeds anlegen bzw. bestehende 
löschen dürfen.


### Erlaubte Mitgliedergruppen

**Erlaubte Mitgliedergruppen:** Mitglieder dieser Gruppe können in der Frontend-Vorschau verwendet werden.


### Ausgenommene Felder

Zu Beginn des Abschnitts wurde erwähnt, dass normale Benutzer standardmäßig keinerlei Rechte haben (»deny all«) und 
du als Administrator jeden Zugriff explizit freischalten musst. Das gilt auch für die einzelnen Eingabefelder jedes 
Moduls bzw. jeder Tabelle, die dir hier aufgelistet werden.

**Erlaubte Felder:** Hier wählst du die erlaubten Felder aus.

Mittels der erlaubten Felder kannst du sehr einfach Arbeitsabläufe (engl. Workflows) erstellen, indem du z. B. die 
Felder zur Veröffentlichung eines Artikels oder eines Nachrichtenbeitrags für Redakteure nicht freigibst. So kann kein 
Redakteur etwas veröffentlichen, ohne dass du oder ein Chefredakteur es vorher gesehen hat.


### Deaktivierung

Benutzergruppen können manuell oder automatisch zu einem bestimmten Zeitpunkt deaktiviert werden. Von einer 
deaktivierten Gruppe können keine Rechte mehr geerbt werden.

**Deaktivieren:** Hier kannst du die Gruppe deaktivieren.

**Aktivieren am:** Hier aktivierst du die Gruppe zu einem bestimmten Tag um 0:00 Uhr.

**Deaktivieren am:** Hier deaktivierst du die Gruppe zu einem bestimmten Tag um 0:00 Uhr.


## Benutzer

Mit dem Modul »Benutzer« kannst du Benutzerkonten verwalten. Benutzer können sich mit ihrem Benutzernamen und Passwort 
im Backend anmelden und erben die Berechtigungen der ihnen zugewiesenen Benutzergruppen.

{{% notice note %}}
Der Benutzernamen und die E-Mail-Adresse müssen eindeutig sein, das heißt, sie dürfen nur einmal vergeben werden.
{{% /notice %}}


### Name und E-Mail-Adresse

**Benutzername:** Hier legst du den Benutzernamen fest.

**Name:** Hier gibst du den Vor- und Nachnamen des Benutzers ein.

**E-Mail-Adresse:** Hier gibst du die E-Mail-Adresse des Benutzers ein.


### Backend-Einstellungen

Jeder Benutzer kann das Backend an seine persönlichen Vorstellungen anpassen.

**Backend-Sprache:** Hier legst due die Backend-Sprache fest.

**Datei-Uploader:** Hier kannst du zwischen »DropZone« und dem »Standard-Uploader« auswählen.

**Erklärungen anzeigen:** Standardmäßig zeigt Contao unter jedem Eingabefeld eine kurze Erklärung an, die du bei Bedarf 
hier abschalten kannst.

**Vorschaubilder anzeigen:** Hier kannst du die Vorschaubilder in der Dateiübersicht der Dateiverwaltung deaktivieren, 
damit die Verzeichnisstruktur schneller lädt.

**Rich Text Editor verwenden:** Hier kannst du den Rich Text Editor deaktivieren.

**Code-Editor verwenden:** Hier kannst du den Code-Editor deaktivieren.


### Backend-Theme

**Backend-Theme:** Hier kannst du das Backend-Theme ändern, falls ein weiteres vorhanden ist.

**Fullscreen:** Die Breite des Backends soll nicht begrenzen.


### Passworteinstellungen

**Passwort-Änderung notwendig:**  Hier kannst du den den Benutzer zwingen, sein Passwort bei der nächsten Anmeldung zu 
ändern.

**Passwort:** Hier kannst du dem Benutzer ein Passwort zuweisen.


### Zwei-Faktor-Authentisierung

Benutzer können die Zwei-Faktor-Authentisierung aktivieren, um den Account zusätzlich abzusichern. Neben dem Benutzernamen 
und Passwort muss ein Verifizierungscode (»Time-based One-time Password«) eingegeben werden. Dieses Einmalpasswort muss 
von einer Zwei-Faktor-App wie z. B. 1Password, Authy, Google Authenticator, Microsoft Authenticator, LastPass Authenticator 
oder jeder anderen TOTP-App generiert werden.

Benutzer können verpflichtet werden, Zwei-Faktor-Authentisierung zu verwenden. Hierfür muss folgende Konfiguration in die `config/config.yml` übernommen werden:

```yml
contao:
  security:
    two_factor:
      enforce_backend: true
```


### Administrator

**Zum Administrator machen:** Hier kannst du den Benutzer zu einem Administrator machen. Die Zuordnung zu einer Gruppe 
ist dann nicht mehr notwendig.


### Benutzergruppen

Hier legst du unter anderem die Gruppenzugehörigkeit des Benutzers fest. Die erste Gruppe, also die ganz oben im 
Auswahlmenü, ist die Hauptgruppe, die z. B. beim Erstellen neuer Seiten automatisch in den Zugriffsrechten gesetzt wird.

**Benutzergruppen:** Hier legst du die Gruppenzugehörigkeit des Benutzers fest.

**Rechtevererbung:** Es gibt folgende drei Möglichkeiten der Rechtevergabe:

| Modus                          | Erklärung                                               |
|:-------------------------------|:--------------------------------------------------------|
| Nur Gruppenrechte verwenden    | Es werden nur die Rechte der aktiven Gruppen geerbt.    |
| Gruppenrechte erweitern        | Es werden die Rechte der aktiven Gruppen geerbt und zusätzlich um individuelle Rechte erweitert. |
| Nur Benutzerrechte verwenden   | Es werden nur individuelle Rechte verwendet.            |

Die Konfiguration der individuellen Rechte erfolgt analog zur Konfiguration der [Benutzergruppen](#benutzergruppen).

### Kontoeinstellung

Genau wie Benutzergruppen können auch Benutzer manuell oder automatisch zu einem bestimmten Zeitpunkt deaktiviert 
werden. Ein deaktivierter Benutzer kann sich nicht mehr im Backend anmelden.

**Deaktivieren:** Hier kannst du den Benutzer deaktivieren.

**Aktivieren am:** Hier aktivierst du den Benutzer zu einem bestimmten Tag um 0:00 Uhr.

**Deaktivieren am:** Hier deaktivierst du den Benutzer zu einem bestimmten Tag um 0:00 Uhr.


## Seiten und Artikel freischalten

Das Freischalten von Seiten und Artikeln, sodass diese im Backend bearbeitet werden können, führt in der Praxis öfter 
mal zu Unklarheiten, weil die notwendigen Berechtigungen an verschiedenen Stellen im System gesetzt werden müssen.

Um bestimmte Seiten freizuschalten und das Bearbeiten von Artikeln auf diesen Seiten zu erlauben, musst du sowohl in 
der Benutzerverwaltung als auch in der Seitenstruktur die entsprechenden Voraussetzungen schaffen.


### Voraussetzungen in der Benutzerverwaltung

Zunächst benötigst du eine Benutzergruppe, in der du die Module »Seitenstruktur« und »Artikel« aktivierst und die zu 
bearbeitenden Seiten als Pagemount einbinden musst. Damit schaffst du die Voraussetzungen dafür, dass ein Benutzer auf 
den Seitenbaum zugreifen kann und dort bestimmte Seiten bzw. Artikel sieht.

Anschließend musst du in der Benutzergruppe unter »Erlaubte Felder« die Eingabefelder der Tabellen `tl_page`, 
`tl_article` und `tl_content` freischalten, die der Benutzer später bearbeiten können soll. Damit schaffst du die 
Voraussetzungen dafür, dass er nicht nur eine leere Seite sieht, wenn er z. B. einen Artikel editieren will.

Als Letztes musst du noch einen Benutzer anlegen und ihn der Gruppe zuweisen.


### Voraussetzungen in der Seitenstruktur

In Abschnitt [Zugriffsrechte](../../seitenstruktur/seiten-konfigurieren/#zugriffsrechte), hast du bereits gelernt, 
dass jede Seite einem bestimmten Benutzer und einer bestimmten Gruppe gehört und dass es darauf basierend verschiedene 
Zugriffsebenen gibt.

![Zugriffsrechte einer Seite](/de/user-management/images/de/zugriffsrechte-einer-seite.png)

Diese Seite gehört z. B. dem Benutzer `Helen Lewis`, der sie und die darin enthaltenen Artikel bearbeiten, verschieben 
oder löschen darf. Andere Benutzer der Gruppe Nachrichten dürfen lediglich die Artikel bearbeiten, nicht aber die Seite 
an sich.

Du musst also die Seiten, die ein Benutzer bearbeiten soll oder auf denen er Artikel anlegen können soll, mit 
Zugriffsrechten versehen und sie entweder dem Benutzer oder seiner Gruppe zuweisen. Damit schaffst du die 
Voraussetzungen dafür, dass ein Benutzer die entsprechenden Navigationssymbole anklicken kann.

![Die Seitenstruktur ohne zugewiesene Zugriffsrechte](/de/user-management/images/de/die-seitenstruktur-ohne-zugewiesene-zugriffsrechte.png)

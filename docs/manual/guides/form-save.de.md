---
title: "Formulardaten speichern"
description: "Übertragene Formulardaten in eine Datenbanktabelle speichern."
url: "/de/anleitungen/formulardaten-speichern"
aliases:
  - /de/anleitungen/formulardaten-speichern/
weight: 95
tags: 
  - "Formular"
  - "Leads"
  - "Hook"
---


Mit Contao kannst du Formulardaten nicht nur via E-Mail versenden, sondern diese auch in eine
Datenbanktabelle speichern. Möchtest du dazu keine vorhandene oder eigene Datenbanktabelle nutzen, kannst du als
Alternative die [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) installieren.

Im ersten Beispiel verwenden wir zur Speicherung die in Contao zur Verfügung stehenden Möglichkeiten zusammen mit dem
[Hook](https://docs.contao.org/dev/reference/hooks/) »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.
Im Backend werden die Reservierungen in der [Terminverwaltung](/de/core-erweiterung/kalender/terminverwaltung/) aufgeführt. 

Im zweiten Beispiel nutzen wir zur Speicherung und Backend-Darstellung der Daten 
die [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads).


## Formularaufbau

Für unser Beispiel halten wir den Formularaufbau übersichtlich. Über den [Formulargenerator](/de/formulargenerator/)
erstellst du ein neues Formular mit dem Titel `Reservierung`. Als [Formularfelder](/de/formulargenerator/formularfelder/) 
benötigen wir lediglich folgende Feldtypen zusammen mit einem 
[Absendefeld](http://localhost:1313/de/formulargenerator/formularfelder/#absendefeld):


|Feldtyp   |Feldname  |Feldbezeichnung  |Pflichtfeld |Eingabeprüfung         |
|:---------|:---------|:----------------|:-----------|:----------------------|
|Textfeld  |title     |Name             |Ja          |Alphabetische Zeichen  |
|Textfeld  |startDate |Von              |Ja          |Datum                  |
|Textfeld  |endDate   |Bis              |Nein        |Datum                  |


## Beispiel I

Die Daten sollen im Backend über die [Terminverwaltung](/de/core-erweiterung/kalender/terminverwaltung/) zur Verfügung 
stehen. Erstelle dir dazu ein neues Kalender mit dem Namen `Reservierungen`.

In den Einstellungen deines Formulars aktivierst du nun die Option 
[Eingaben speichern](http://localhost:1313/de/formulargenerator/formulare/#formulardaten-speichern) und verwendest 
als Zieltabelle den Eintrag `tl_calendar_events`.

{{% notice info %}}
Zur Auswahl der Zieltabelle stehen alle vorhandenen Datenbanktabellen deiner Contao Installation zur Verfügung. 
Du könntest auch eine eigene Datenbanktabelle erstellen. Der entsprechende Tabellenname muss dann mit dem Präfix »tl_«
beginnen. Grundsätzlich müssen die Feldnamen deines Formulars mit den entsprechenden Feldnamen der Datenbanktabelle 
übereinstimmen.
{{% /notice %}}


### Der Hook prepareFormData

Die Datenbanktabelle `tl_calendar_events` beinhaltet zahlreiche Felder. Nicht alle sind für unser Beispiel notwendig.
Wir benötigen Einträge für die Felder »pid«, »title«, »alias«, »author«, »startDate«, »startTime«, »endDate«, 
»endTime« und »published«, damit wir im Backend eine gültige Darstellung unserer Reservierungen erhalten. Optional 
wären auch Einträge für »location«, »description« oder »teaser« möglich. 

Unser Formular bedient zur Zeit zumindest die Felder »title«, »startDate« und optionales »endDate«. Die weiteren Felder
könnte man über versteckte Formularfelder hinzufügen. Diese Vorgehensweise ermöglicht jedoch die Manipulation der zu 
übermittelten Formulardaten. Aus diesem Grund verwenden wir den Hook 
»[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.


Dieser Hook greift nach der Formular-Übermittlung aber vor der eigentlichen Datenspeicherung. Du kannst darüber 
die übermittelten Daten bearbeiten und neue Informationen hinzufügen. Erstelle in deiner Contao-Installation 
die Verzeichnisse `src/EventListener/` und platziere darin die Datei `PrepareFormDataListener.php` mit folgendem Inhalt:


```php
// src/EventListener/PrepareFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Slug\Slug;
use Contao\Form;
use Doctrine\DBAL\Connection;

#[AsHook('prepareFormData')]
class PrepareFormDataListener
{
    // Change these variables for your form, calendar and author
    private const FORM_ID = 3;
    private const CALENDAR_ID = 5;
    private const AUTHOR_ID = 1;

    private $slug;
    private $db;

    public function __construct(Slug $slug, Connection $db)
    {
        $this->slug = $slug;
        $this->db = $db;
    }

    public function __invoke(array &$submittedData, array $labels, array $fields, Form $form): void
    {
        // Check if this is the right form
        if (self::FORM_ID !== (int) $form->id) {
            return;
        }

        // Mandatory fields
        $submittedData['tstamp'] = time();
        $submittedData['pid'] = self::CALENDAR_ID;
        $submittedData['author'] = self::AUTHOR_ID;

        // Set this to false, if newly created events should not be immediately published
        $submittedData['published'] = true;

        // Generate unique alias
        $submittedData['alias'] = $this->getSlug($submittedData['title']);

        // Convert and set date fields
        $submittedData['startDate'] = strtotime(trim($submittedData['startDate'])) ?: null;
        $submittedData['startTime'] = $submittedData['startDate'];

        // Optional fields
        if (!empty(trim($submittedData['endDate']))) {
            $submittedData['endDate'] = strtotime(trim($submittedData['endDate'])) ?: null;
            $submittedData['endTime'] = $submittedData['endDate'];
        } else {
            $submittedData['endDate'] = null;
            $submittedData['endTime'] = null;
        }
    }

    private function getSlug(string $text, string $locale = 'de', string $validChars = '0-9a-z'): string
    {
        $options = [
            'locale' => $locale,
            'validChars' => $validChars,
        ];
        
        $duplicateCheck = function (string $slug): bool {
            return $this->db->fetchOne('SELECT COUNT(*) FROM tl_calendar_events WHERE alias = ?', [$slug]) > 0;
        };

        return $this->slug->generate($text, $options, $duplicateCheck);
    }
}
```

Die für unser Kalender benötigten Felder werden in dieser Datei gesetzt. Die folgenden Werte musst du entsprechend
deiner Umgebung anpassen:

- `FORM_ID` (Die ID deines Formulars)
- `CALENDAR_ID` (Die ID deines Kalenders)
- `AUTHOR_ID` (Die ID des Autors/Backend Benutzer)

Diese Angaben erhältst du im Backend über die Detailinformationen der jeweiligen Einträge.

Das Feld »alias« entspricht dem »Event-Alias« deines Kalenders und muss eindeutig sein. Hierzu benutzen wir den
[Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug). Zunächst verwenden wir dazu den Inhalt 
unseres übermittelten »title« Feldes und lassen lediglich Kleinbuchstaben und Ziffern zu. Umlaute 
werden umgeschrieben und Leerzeichen ersetzt. 

Die Methode »generate()» des Contao Slug-Service erlaubt auch die Übergabe einer Duplikatsprüfung als Callable 
für den dritten Parameter. Sofern erforderlich wird darüber automatisch eine eindeutige Nummer dem »alias« 
Eintrag hinzugefügt.

{{% notice info %}}
Du musst im Anschluss den Contao Cache über den »Contao Manager« oder über die »Konsole« löschen damit der Hook 
verarbeitet werden kann. Dies wird auch notwendig nachdem du Änderungen an der Datei »PrepareFormDataListener.php«
vorgenommen hast.
{{% /notice %}}


### Fazit

Zum aktuellen Zeitpunkt werden deine Formulardaten gespeichert und können im Backend im entsprechenden 
[Kalender](/de/core-erweiterung/kalender/terminverwaltung/) eingesehen und auch geändert werden. Zusätzlich könntest du hier 
weitere Einträge manuell pflegen.

Weiterhin stehen dir alle [Frontend Module](/de/core-erweiterung/kalender/frontend-module/#template-einstellungen) 
(z. B. der Mini-Kalendar) zwecks Darstellung dieses Kalenders zur Verfügung.


## Beispiel II

Falls du keine vorhandenen Contao-Datenbanktabellen benötigst und keinen Hook erstellen möchtest, bietet sich die 
[Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) an. 


### Die Erweiterung Leads

Die Erweiterung legt je Formular die Daten automatisch in die Datenbanktabellen »tl_lead« bzw. »tl_lead_data« ab. 
Vorhandene Einträge sind darüber hinaus im Backend einsehbar. 

Unser bisheriger [Formularaufbau](#formularaufbau) bleibt unverändert. Nach Installation 
der [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads)
musst du die Leads-Speicherung in den Formular-Einstellungen über den Eintrag »Anfragen speichern« aktivieren.

Anschließend stehen dir weitere Optionen zur Verfügung, die der Leads Backend-Darstellung dienen. Wir verwenden
hierzu folgende Einträge:


| Feld                    |Wert                                              |
|:----------------------- |:-------------------------------------------------|
|Hauptkonfiguration       |Dies ist ein Master-Formular                      |
|Navigations-Bezeichnung  |Reservierung Vereinsboot                          |
|Datensatz-Bezeichnung    |##title## - {{formatted_datetime::##startDate##::d.m.Y}} {{formatted_datetime::##endDate##::d.m.Y}}|

Weiterhin musst du in jedem Formularfeld, das gespeichert werden soll, dies explizit aktivieren. Hierzu kannst du in den
jeweiligen Formularfeldern die Auswahl »In Anfrage speichern« auf »ja« setzen.

Die Erweiterung bietet keine eigenen Frontend Module zur Darstellung. Hierzu kannst du dann die 
Core-Erweiterung [Auflistungen](/de/layout/modulverwaltung/anwendungen/#auflistung) nutzen. 
Erstelle dir ein neues [Modul](/de/layout/modulverwaltung/) vom 
Typ `Auflistung` mit folgenden Angaben:


| Feld                       | Wert                                             |
|:---------------------------|:-------------------------------------------------|
|**Tabelle**                 |tl_lead                                           |
|**Felder**                  |post_data                                         |


### Fazit

Wenn du jetzt das Formular benutzt, werden die Daten gespeichert und sind im Navigationsbereich des Backends über den 
Bereich »Anfragen« einsehbar.

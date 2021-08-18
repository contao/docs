---
title: "Formulardaten speichern"
description: "Übertragene Formulardaten in eine Datenbanktabelle speichern."
url: "/de/anleitungen/formulardaten-speichern"
aliases:
  - /de/anleitungen/form-save/
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
erstellst du ein neues Formular mit dem Titel ``Reservierung``. Als [Formularfelder](/de/formulargenerator/formularfelder/) 
benötigen wir lediglich folgende Feldtypen zusammen mit einem 
[Absendefeld](http://localhost:1313/de/formulargenerator/formularfelder/#absendefeld):


|Feldtyp   |Feldname  |Feldbezeichnung  |Pflichtfeld |Eingabeprüfung         |
|:---------|:---------|:----------------|:-----------|:----------------------|
|Textfeld  |title     |Name             |Ja          |Alphabetische Zeichen  |
|Textfeld  |startDate |Von              |Ja          |Datum                  |
|Textfeld  |endDate   |Bis              |Nein        |Datum                  |


## Beispiel I

Die Daten sollen im Backend über die [Terminverwaltung](/de/core-erweiterung/kalender/terminverwaltung/) zur Verfügung 
stehen. Erstelle dir dazu ein neues Event-Archiv mit dem Namen ``Reservierungen``.

In den Einstellungen deines Formulars aktivierst du nun die Option 
[Eingaben speichern](http://localhost:1313/de/formulargenerator/formulare/#formulardaten-speichern) und verwendest 
als Zieltabelle den Eintrag ``tl_calendar_events``.

{{% notice info %}}
Zur Auswahl der Zieltabelle stehen alle vorhandenen Datenbanktabellen deiner Contao Installation zur Verfügung. 
Du könntest auch eine eigene Datenbanktabelle erstellen. Der entsprechende Tabellenname muss dann mit dem Präfix »tl_«
beginnen. Grundsätzlich müssen die Feldnamen deines Formulars mit den entsprechenden Feldnamen der Datenbanktabelle 
übereinstimmen.
{{% /notice %}}


### Der Hook prepareFormData

Die Datenbanktabelle ``tl_calendar_events`` beinhaltet zahlreiche Felder. Nicht alle sind für unser Beispiel notwendig.
Wir benötigen Einträge für die Felder »pid«, »title«, »alias«, »author«, »startDate«, »startTime«, »endDate«, 
»endTime« und »published«, damit wir im Backend eine gültige Darstellung unserer Reservierungen erhalten. Optional 
wären auch Einträge für »location«, »description« oder »teaser« möglich. 

Unser Formular bedient zur Zeit zumindest die Felder »title«, »startDate« und optionales »endDate«. Die weiteren Felder
könnte man über versteckte Formularfelder hinzufügen. Diese Vorgehensweise ermöglicht jedoch die Manipulation der zu 
übermittelten Formulardaten. Aus diesem Grund verwenden wir den Hook 
»[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.


Dieser Hook greift nach der Formular-Übermittlung aber vor der eigentlichen Datenspeicherung. Du kannst darüber 
die übermittelten Daten bearbeiten und neue Informationen hinzufügen. Erstelle in deiner Contao-Installation 
die Verzeichnisse ``src\EventListener\`` und platziere darin die Datei ``PrepareFormDataListener.php`` mit folgendem Inhalt:


```php
// src/EventListener/PrepareFormDataListener.php

namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;

use Contao\CoreBundle\Slug\Slug;
use Doctrine\DBAL\Connection;

/**
 * @Hook("prepareFormData")
 */
class PrepareFormDataListener 
{
    private $slug;
    private $db;

    public function __construct(Slug $slug, Connection $db)
    {
        $this->slug = $slug;
        $this->db = $db;
    }  
  
    public function __invoke(array &$submittedData, array $labels, array $fields, Form $form): void
    {
        // set id of form, eventarchiv and author
        $idForm         = 3;
        $idEventArchiv  = 5;
        $idAuthor       = 1;
    
        // form restriction 
        if ((int) $form->id === $idForm) {

          // mandatory fields
          $submittedData['pid']       = $idEventArchiv;
          $submittedData['author']    = $idAuthor;
          $submittedData['published'] = 1;
        
          // generate unique alias 
          $submittedData['alias'] = $this->getSlug($submittedData['title']);
      
          $submittedData['startTime'] = strtotime($submittedData['startDate']);
        
          // optional fields
          if (!empty(trim($submittedData['endDate']))) {
            $submittedData['endTime'] = strtotime($submittedData['endDate']);
          } else {
            $submittedData['endTime'] = null;
            $submittedData['endDate'] = null;
          }
        }
    }
  
    public function getSlug(string $text, string $locale = 'de', string $validChars = '0-9a-z'): string
    {
        $options = [
          'locale' => $locale,
          'validChars' => $validChars,
        ];

        $duplicateCheck = function (string $slug): bool {
          return $this->slugExists($slug);
        };

        return $this->slug->generate($text, $options, $duplicateCheck);
    }

    private function slugExists(string $slug): bool
    {
      return !empty($this->db->fetchAllAssociative("SELECT * FROM tl_calendar_events WHERE alias = ?", [$slug]));
    }  
}
```

Die für unser Event-Archiv benötigten Felder werden in dieser Datei gesetzt. Die folgenden Werte mußt du entsprechend
deiner Umgebung anpassen:

- »$idForm« (Die ID deines Formulars)
- »$idEventArchiv« (Die ID deines Event-Archivs)
- »$idAuthor« (Die ID des Autors/Backend Benutzer)

Diese Angaben erhältst du im Backend über die Detailinformationen der jeweiligen Einträge.

Das Feld »alias« entspricht dem »Event-Alias« deines Event-Archivs und muß eindeutig sein. Hierzu benutzen wir den
[Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug). Zunächst verwenden wir dazu den Inhalt 
unseres übermittelten »title« Feldes und lassen lediglich Kleinbuchstaben und Ziffern zu. Umlaute 
werden umgeschrieben und Leerzeichen ersetzt. 

Die Methode »generate()» des Contao Slug-Service erlaubt auch die Übergabe einer Duplikatsprüfung als Callable 
für den dritten Parameter. Sofern erforderlich wird darüber automatisch eine eindeutige Nummer dem »alias« 
Eintrag hinzugefügt.

{{% notice info %}}
Du mußst im Anschluß den Contao Cache über den »Contao Manager« oder über die »Konsole« löschen damit der Hook 
verarbeitet werden kann. Dies wird auch notwendig nachdem du Änderungen an der Datei »PrepareFormDataListener.php«
vorgenommen hast.
{{% /notice %}}


### Fazit

Zum aktuellen Zeitpunkt werden deine Formulardaten gespeichert und können im Backend im entsprechenden 
[Event-Archiv](/de/core-erweiterung/kalender/terminverwaltung/) eingesehen und auch geändert werden. Zusätzlich könntest du hier 
weitere Einträge manuell pflegen.

Weiterhin stehen dir alle [Frontend Module](/de/core-erweiterung/kalender/frontend-module/#template-einstellungen) 
(z. B. der Mini-Kalendar) zwecks Darstellung dieses Event-Archivs zur Verfügung.


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
Typ ``Auflistung`` mit folgenden Angaben:


| Feld                       | Wert                                             |
|:---------------------------|:-------------------------------------------------|
|**Tabelle**                 |tl_lead                                           |
|**Felder**                  |post_data                                         |



{{% notice tip %}}
Die Erweiterung bietet darüber hinaus zur gezielten Abfrage der Tabelle »tl_lead_data», in beliebigen Contao-Templates, 
die Methode »getExportData()« der Klasse »DataCollector« 
(s. a.: Leads »[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)»)
{{% /notice %}}

### Fazit

Wenn du jetzt das Fromular benutzt, werden die Daten gespeichert und sind im Navigationsbereich des Backends über den 
Bereich »Anfragen« einsehbar.

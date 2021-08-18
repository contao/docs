---
title: "Save form data"
description: "Save transferred form data in a database table."
url: "/en/guides/save-form-data"
aliases:
  - /en/guides/form-save/
weight: 95
tags: 
  - "Form"
  - "Leads"
  - "Hook"
---


With Contao, you can not only send transmitted form data as an email, but also save it in an existing database table. 
If you do not want to use an existing or your own database table, the 
[extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) can be installed as an alternative.

In the first example, we use the possibilities available in Contao for storage together with the 
[hook](https://docs.contao.org/dev/reference/hooks/) »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«. 
In the backend, the reservations are listed as a [event archiv](/en/core-extensions/calendar/calendar-management/). 

In the second example, we use the [extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) 
for storage and backend presentation.


## Formlayout

For our example, we will keep the form structure clear. Use the form generator to create a new form with the title 
``Reservation``. We only need the following field types as form fields together with a submit field:


|Field type   |Field name  |Field label   |Mandatory |Validation            |
|:------------|:-----------|:-------------|:---------|:---------------------|
|Text field   |title       |Name          |Yes       |Alphabetic characters |
|Text field   |startDate   |From          |Yes       |Date                  |
|Text field   |endDate     |To            |No        |Date                  |


## Example I

The data should be available in the backend via the [event management](/en/core-extensions/calendar/calendar-management/). 
To do this, create a new event archive, e.g. with the name ``Reservations``.

In the settings of your form, activate the option ``Store data`` and use the entry ``tl_calendar_events`` as the target table.

{{% notice info %}}
To select the target table, you can use all the existing database tables of your Contao installation. You can also 
create your own database table. The corresponding table name must then begin with the »tl_«. prefix. Basically, 
the field names of your form must match the corresponding field names of the database table.
{{% /notice %}}


### Hook prepareFormData

The database table ``tl_calendar_events`` contains numerous fields. Not all of them are necessary for our example.
We need at least entries for the fields »pid«, »title«, »alias«, »author«, »startDate«, »startTime«, »endDate«, 
»endTime« and »published« so that we get a valid representation of our reservations in the backend. Optional 
would be entries for »location«, »description« or »teaser«. 

Our form currently serves at least the fields »title«, »startDate« and optional »endDate«. The other fields
could be added via hidden form fields. This procedure, however, makes it possible to manipulate the 
transmitted form data. For this reason we use the hook »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.

This hook takes effect after the form submission but before the actual data storage. You can use it to 
edit the submitted data and add new information. Create the following directories ``src\EventListener\`` in your Contao installation 
and in it the file ``PrepareFormDataListener.php`` with the following content:

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

The fields required for our event archive are set here. You must adjust the following values
according to your environment:

- »$idForm« (The ID of your form)
- »$idEventArchiv« (The ID of your event archive)
- »$idAuthor« (The ID of the author/backend user)

You can get this information in the backend via the detailed information of the respective entries.

The field "alias" corresponds to the "event alias" of your event archive and must be unique. For this we use the 
[Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug). First of all, we use the content of our 
of our transmitted »title« field and only allow lower case letters and numbers. Special characters 
are rewritten and blanks are replaced. 

The method »generate()« of the Contao Slug-Service also allows the passing of a duplicate check as a callable 
for the third parameter. If necessary, a unique number is automatically added to the "alias" entry. 

{{% notice info %}}
You must then delete the Contao cache via the »Contao Manager« or the »Console« so that the hook can be processed. This 
is also necessary after you have made changes to the file »PrepareFormDataListener.php«.
{{% /notice %}}


### Conclusion

At the current time, your form data is saved and can be viewed in the backend in the corresponding event archive 
and can also be changed. You can also manually maintain further reservations here.

Furthermore, all frontend modules (e.g. the mini calendar) are available for displaying this event archive.


## Example II

If you do not want to use existing Contao database tables or if you do not want to use your own database table, 
you can use the [Extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads). 


### The Leads extension

The extension automatically stores the data for each form in the database tables »tl_lead« and »tl_lead_data«. 
Existing entries can also be viewed in the backend. 

Our previous [formlayout](#formlayout) remains unchanged. After installing 
the [extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) you have to activate 
the saving of leads in the form settings via the entry »Store Leads«.

Afterwards, further options are available to you, which serve the leads backend display. We use the following 
entries for this:


| Field                  | Value                                            |
|:-----------------------|:-------------------------------------------------|
|Master configuration    |This is a master form                             |
|Navigations label       |Dates club boat                                   |
|Record label            |##title## - {{formatted_datetime::##startDate##::d.m.Y}} {{formatted_datetime::##endDate##::d.m.Y}}|

Furthermore, you must explicitly activate this in each form field that is to be saved. To do this, you can set the
the selection »Save in leads« to »yes« in the respective form fields.

The extension does not provide its own frontend modules for display. To display the data in the frontend, you can use the 
core extension [Listings](/en/layout/module-management/applications/#listing).
You can then create a new module of the type ``Listing`` with the following specifications:


| Field                      | Value                                            |
|:---------------------------|:-------------------------------------------------|
|**Table**                   |tl_lead                                           |
|**Fields**                  |post_data                                         |


{{% notice tip %}}
The extension also provides a method for querying the table "tl_lead_data" in any Contao template with the method 
»getExportData()« of the class »DataCollector« 
(see: Leads "[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)")
{{% /notice %}}

### Conclusion

If you now use the form, the data will be saved and can be viewed in the navigation area of the backend 
in the »Leads« section.

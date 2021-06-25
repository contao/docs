---
title: "Simple reservations"
description: "Save transferred form data in a database table."
aliases:
  - /en/guides/form-save/
weight: 95
tags: 
  - "Form"
  - "Template"
  - "Database"
  - "Leads"
  - "Hook"
---


With Contao, you can not only send transmitted form data as an email, but also save it in an existing database table. 
If you do not want to use an existing or your own database table, the 
[extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) can be installed as an alternative.


## Background

For a fictitious boat club, club members can reserve the club boat via a form for one or more days. 
day(s) via a form. The date selection via the form fields is to be carried out conveniently via a mini calendar. 
The date entries of already existing reservations should be excluded. Furthermore, the 
reservations must be available in the Contao backend.

In the first example, we use the possibilities available in Contao for storage together with the extension 
[listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) and the 
[hook](https://docs.contao.org/dev/reference/hooks/) »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«. 
In the backend, the reservations are listed as a event archiv. In the second example, we use the 
[extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) for storage and backend 
presentation of the data.


## Formlayout

For our example, we will keep the form structure clear. Use the form generator to create a new form with the title 
``Boat Reservation``. We only need the following field types as form fields together with a submit field:


|Field type   |Field name  |Field label   |Mandatory |Validation            |CSS class    | 
|:------------|:-----------|:-------------|:---------|:---------------------|:------------|
|Text field   |title       |Name          |Yes       |Alphabetic characters |             |
|Text field   |startDate   |From          |Yes       |Date                  |js_startDate |
|Text field   |endDate     |To            |No        |Date                  |js_endDate   |


## Sample I

The data should be available in the backend via the event management. To do this, create a new event archive, 
e.g. with the name ``Reservations``.


### Save form data

In the settings of your form, activate the option ``Store data`` and use the entry ``tl_calendar_events`` as the target table.

{{% notice info %}}
To select the target table, you can use all the existing database tables of your Contao installation. You can also 
create your own database table. The corresponding table name must then begin with the »tl_«. prefix. Basically, 
the field names of your form must match the corresponding field names of the database table.
{{% /notice %}}


### Hook prepareFormData

The database table ``tl_calendar_events`` contains numerous fields. Not all of them are necessary for our example.
We need at least entries for the fields »pid«, »title«, »alias«, »author«, »startDate«, »startTime«, »endDate«, 
»endTime« and »published« so that we get a valid representation of our reservations in the Contao backend. Optional 
would be entries for »location«, »description« or »teaser«. 

Our form currently serves at least the fields »title«, »startDate« and optional »endDate«. The other fields
could be added via hidden form fields. This procedure, however, makes it possible to manipulate the 
transmitted form data. For this reason we use the hook »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.

This hook takes effect after the form submission but before the actual data storage. You can use it to 
edit the submitted data and add new information. Create the following directories in your Contao installation 
create the directory ``src\EventListener\`` and in it the file ``PrepareFormDataListener.php`` with the following content:

```php
// src/EventListener/PrepareFormDataListener.php

namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\CoreBundle\Slug\Slug;

/**
 * @Hook("prepareFormData")
 */
class PrepareFormDataListener 
{
  private $slug;

  public function __construct(Slug $slug)
  {
      $this->slug = $slug;
  }  

  public function __invoke(array &$submittedData, array $labels, array $fields, Form $form): void
  {
    // set id of form, eventarchiv and author
    $idForm         = 3;
    $idEventArchiv  = 5;
    $idAuthor       = 1;
    
    $ticketNr = strtotime("now");
    
    // form restriction 
    if ($form->id == strval($idForm)) {

      // mandatory fields
      $submittedData['pid']       = $idEventArchiv;
      $submittedData['author']    = $idAuthor;
      $submittedData['published'] = 1;
      
      $tmpTitle = $submittedData['title'] . " Ticket: " . $ticketNr;
      $submittedData['title'] = $tmpTitle;
      $submittedData['alias'] = $this->slug->generate(
        $tmpTitle, ['validChars' => 'a-z0-9', 'locale' => 'de', 'delimiter' => '-']
      );      
      
      $submittedData['startTime'] = strtotime($submittedData['startDate']);
      
      // optional fields
      if (!empty(trim($submittedData['endDate']))) {
        $submittedData['endTime'] = strtotime($submittedData['endDate']);
      } else {
        $submittedData['endTime'] = null;
        $submittedData['endDate'] = null;
      }
      
      $submittedData['location'] = "Bootsverein Anleger";
      $submittedData['teaser'] = "Reservierung Vereins-Boot: <br>" . $tmpTitle;

    }
  }
}
```

The fields required for our event archive are set here. You must adjust the following values
according to your environment:

- »$idForm« (The ID of your form)
- »$idEventArchiv« (The ID of your event archive)
- »$idAuthor« (The ID of the author/backend user)

You can get this information in the Contao backend via the detailed information of the respective entries.

The field "alias" corresponds to the "event alias" of your event archive and must be unique. For this we use the 
[Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug). First of all, we use the content of our 
of our transmitted »title« field (the member name) and only allow lower case letters and numbers. Special characters 
are rewritten and blanks are replaced. Finally, we create a unique ticket number and complete the final entry with it. 

By entering a member name of e.g. ``Jon Smith``, this becomes the "alias" entry ``jon-smith-ticket-1624279859``.

{{% notice info %}}
You must then delete the Contao cache via the »Contao Manager« or the »Console« so that the hook can be processed. This 
is also necessary after you have made changes to the file »PrepareFormDataListener.php«.
file.<br><br>
The [Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug) offers its own possibility
for the unique »alias« creation. A corresponding example is given in the documentation. For our example, 
the use of a random ticker number should suffice.
{{% /notice %}}


### Interim conclusion

At the current time, your form data is saved and can be viewed in the Contao backend in the corresponding event archive 
and can also be changed. You can also manually maintain further reservations here.


### Convenient date selection in the frontend

In the next step, we will extend our two form fields, "startDate" and "startEnd", with a convenient date picker.
and use the jQuery PlugIn »[pickadate.js](https://amsul.ca/pickadate.js/)« for this. To do this, download the 
version (currently [v.3.6.2](http://github.com/amsul/pickadate.js/archive/3.6.2.zip)) and put the files in a public, 
accessible directory of your Contao installation below »files«.

The jQuery PlugIn »[pickadate.js](https://amsul.ca/pickadate.js/)« offers the possibility to exclude dates from the 
selection. This could be individual days or an entire period (from/to). The plugin expects an 
[Array](https://amsul.ca/pickadate.js/date/#disable-dates) in a certain date format and can be defined as an 
option parameter. A possible definition could look as follows:


```js
disable: [
  [2021,7,2],                             // disable single date
  { from: [2021,7,14], to: [2021,7,18] }  // disable date range
]
```

#### The extension Listings

We have the dates of our reservations and you can query the required values of the database table ``tl_calendar_events`` 
via the extension [Listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle).

After installing the extension [Listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) 
create a new Contao template, e.g. ``list_pickadate.html5``, based on the template »list_default.html5« with 
the following specifications:


```php
// list_pickadate.html5
<?php
  $GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.css|static';
  $GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.date.css|static';
?>
<script src="files\EDITPATH\picker.js"></script>
<script src="files\EDITPATH\picker.date.js"></script>
<script src="files\EDITPATH\picker.time.js"></script>
<script src="files\EDITPATH\translations\de_DE.js"></script>

<script>
$(document).ready(function(){
	
	// create javascript array wirh dates to disable and consider php/js difference
	var arrDisableDate = [
	<?php 
		foreach ($this->tbody as $row) {
	
			$startTimestamp = $row['startDate']['raw'];
			$startTimestampJs = date('Y,m,d', strtotime('-1 month', $startTimestamp));
			$endTimestamp = $row['endDate']['raw'];
			$endTimestampJs = date('Y,m,d', strtotime('-1 month', $endTimestamp));

			// check for optional endDate value
			if ( !empty(trim($endTimestamp)) ) {
				print "{from:[". $startTimestampJs ."], to:[". $endTimestampJs ."]},"; 
			} else {
		  		print "[". $startTimestampJs ."],"; 
			}
		}
	?> 
	]

    $.extend($.fn.pickadate.defaults, {
        showMonthsShort: true,
        showWeekdaysFull: false,        
        labelMonthNext: 'nächster Monat',
        labelMonthPrev: 'vorheriger Monat',
        closeOnSelect: true,
        closeOnClear: true,
        format: 'dd.mm.yyyy',
        formatSubmit: 'dd.mm.yyyy',
        hiddenName: true,
        min: new Date(),
        disable: arrDisableDate
    })    

    var from_$input = $('input.js_startDate').pickadate(),
        from_picker = from_$input.pickadate('picker')
    
    var to_$input = $('input.js_endDate').pickadate(),
        to_picker = to_$input.pickadate('picker')

    // Check if there’s a “from” or “to” date to start with.
    if ( from_picker.get('value') ) {
      to_picker.set('min', from_picker.get('select'))
    }
    if ( to_picker.get('value') ) {
      from_picker.set('max', to_picker.get('select'))
    }
    
    // When something is selected, update the “from” and “to” limits.
    from_picker.on('set', function(event) {
      if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))    
      }
      else if ( 'clear' in event ) {
        to_picker.set('min', false)
      }
    })
    
    to_picker.on('set', function(event) {
      if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
      }
      else if ( 'clear' in event ) {
        from_picker.set('max', false)
      }
    })    
}) 
</script>
```

The paths for the .js and .css files must be adapted to your environment. A referencing to 
our two form fields is done via their CSS classes »js_startDate« and »js_endDate«. 
([see formlayout](#formlayout)) and are used in the JavaScript variables »from_$input« and »to_$input«.

With the definition of »format« and »formatSubmit« we ensure that the transfer values match the input check of 
the dates in our form.

The existing dates or reservations from the database table ``tl_calendar_events`` (»startDate« and »endDate«) 
are determined in the PHP "foreach" loop, prepared in accordance of the jQuery plugin and stored in »arrDisableDate«.

In your Contao theme, you then create a new module of the type ``Listing`` with the following specifications:


| Field                      | Value                                            |
|:---------------------------|:-------------------------------------------------|
|**Table**                   |tl_calendar_events                                |
|**Fields**                  |startDate, endDate                                |
|**Condition**               |pid = 1 AND published = 1                         |
|**Order by**                |startDate                                         |


The »pid« must then match the respective ID of your Contao event archive. In the selection »List template« you 
set the above template ``list_pickadate.html5``.

You then integrate this module in the article below your form.


### Conclusion

Afterwards, you can easily set the dates via your form, whereby existing registrations will be taken into account. 
The data is stored in the Contao database and is available via the Contao backend.

Furthermore, all frontend modules (e.g. the mini calendar) are available for displaying this event archive.


## Sample II

If you do not want to use existing Contao database tables or if you do not want to use your own database table, 
you can use the [Extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads). 


### The Leads extension

The extension automatically stores the data for each form in the database tables »tl_lead« and »tl_lead_data«. 
Existing entries can also be viewed in the Contao backend. 

However, the extension does not include its own frontend modules for display. For this you can use the 
extension [Listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle)
or specifically, in any Contao template, the functions of the 
Leads "[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)".


### Save form data

Our previous [formlayout](#formlayout) remains unchanged. After installing 
the [extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads)
you have to activate the saving of leads in the form settings via the entry »Store Leads«.

Afterwards, further options are available to you, which serve the leads backend display. We use
the following entries for this:


| Field                  | Value                                            |
|:-----------------------|:-------------------------------------------------|
|Master configuration    |This is a master form                             |
|Navigations label       |Dates club boat                                   |
|Record label            |##title## - {{formatted_datetime::##startDate##::d.m.Y}} {{formatted_datetime::##endDate##::d.m.Y}}|

Furthermore, you must explicitly activate this in each form field that is to be saved. To do this, you can set the
the selection »Save in leads« to »yes« in the respective form fields.


### Interim conclusion

If you now use the fromular, the data will be saved and can be viewed in the navigation area of the Contao backend 
in the »Leads« section. To display the data in the frontend, you can use the 
extension [Listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle).
You can create a new module of the type ``Listing`` with the following specifications:


| Field                      | Value                                            |
|:---------------------------|:-------------------------------------------------|
|**Table**                   |tl_lead                                           |
|**Fields**                  |post_data                                         |


### Convenient date selection in the frontend

The implementation hardly differs from the previous procedure in connection with 
the [example formlayout](#formlayout). We need a Contao template to integrate and configure the jQuery 
PlugIn "[pickadate.js](https://amsul.ca/pickadate.js/)".

To query the dates specifically, we need access to the values of the database table »tl_lead_data«.
However, via the extension [listings](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) 
we cannot query these.


#### Leads DataCollector

The [extension Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) offers for this purpose, 
via the "[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)", 
the corresponding functions.

First, we create a new Contao template based on »form_wrapper.html« and name it e.g.
``form_wrapper_pickadate.html5``. Then select this template in the settings of the form.


```js
// form_wrapper_pickadate.html5
<?php
// see https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php
use Leads\DataCollector;

// corresponding field master_id from table tl_lead
$myLeadsMasterID = 1;
$dataCollector = new DataCollector($myLeadsMasterID);

$GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.css|static';
$GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.date.css|static';
?>

<!-- indexer::stop -->
<div class="<?= $this->class ?> block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

<?php if ($this->headline): ?>
  <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
<?php endif; ?>

<form<?php if ($this->action): ?> action="<?= $this->action ?>"<?php endif; ?> method="<?= $this->method ?>" enctype="<?= $this->enctype ?>"<?= $this->attributes ?><?= $this->novalidate ?>>
  <div class="formbody">
    <?php if ('get' != $this->method): ?>
      <input type="hidden" name="FORM_SUBMIT" value="<?= $this->formSubmit ?>">
      <input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
      <?php if ($this->maxFileSize): ?>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $this->maxFileSize ?>">
      <?php endif; ?>
    <?php endif; ?>
    <?= $this->hidden ?>
    <?= $this->fields ?>
  </div>
</form>

</div>
<!-- indexer::continue -->

<script src="files\EDITPATH\pickadate\picker.js"></script>
<script src="files\EDITPATH\picker.date.js"></script>
<script src="files\EDITPATH\picker.time.js"></script>
<script src="files\EDITPATH\translations\de_DE.js"></script>

<script>
$(document).ready(function(){
	
	// create javascript array wirh dates to disable and consider php/js difference
	var arrDisableDate = [

	<?php	
	$leadsData = $dataCollector-> getExportData(); 
	
	foreach($leadsData as $row) {
		foreach($row as $content) {
		    if ( $content['name'] == "startDate" )  {
				$startTimestamp = $content['value'];
				$startTimestampJs = date('Y,m,d', strtotime('-1 month', $startTimestamp));
			}
			
			if ( $content['name'] == "endDate" && !empty(trim($content['value'])) )  {
				$endTimestamp = $content['value'];
				$endTimestampJs = date('Y,m,d', strtotime('-1 month', $endTimestamp));	
			} else {
				$endTimestamp = null;
			}
		}
	
		// check for optional endDate value
		if ( !empty(trim($endTimestamp)) ) {
			print "{from:[". $startTimestampJs ."], to:[". $endTimestampJs ."]},"; 
		} else {
	  		print "[". $startTimestampJs ."],"; 
		}
	}
	?>	
	]
	
    $.extend($.fn.pickadate.defaults, {
        showMonthsShort: true,
        showWeekdaysFull: false,        
        labelMonthNext: 'nächster Monat',
        labelMonthPrev: 'vorheriger Monat',
        closeOnSelect: true,
        closeOnClear: true,
        format: 'dd.mm.yyyy',
        formatSubmit: 'dd.mm.yyyy',
        hiddenName: true,
        min: new Date(),
        disable: arrDisableDate
    })    

    var from_$input = $('input.js_startDate').pickadate(),
        from_picker = from_$input.pickadate('picker')
    
    var to_$input = $('input.js_endDate').pickadate(),
        to_picker = to_$input.pickadate('picker')

    // Check if there’s a “from” or “to” date to start with.
    if ( from_picker.get('value') ) {
      to_picker.set('min', from_picker.get('select'))
    }
    if ( to_picker.get('value') ) {
      from_picker.set('max', to_picker.get('select'))
    }
    
    // When something is selected, update the “from” and “to” limits.
    from_picker.on('set', function(event) {
      if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))    
      }
      else if ( 'clear' in event ) {
        to_picker.set('min', false)
      }
    })
    
    to_picker.on('set', function(event) {
      if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
      }
      else if ( 'clear' in event ) {
        from_picker.set('max', false)
      }
    })    
}) 
</script>
```

The template does not differ from the first example with regard to the »pickadate.js« implementation. 
To collect the dates from the table »tl_lead_data« we now use the class ``DataCollector`` of the 
Leads "[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)".

The »$myLeadsMasterID« contains the respective »master_id« of the table »tl_lead«. Via the method ``getExportData()``. 
the data is delivered and then prepared accordingly.


## Conclusion

For our use case, the first example is certainly more suitable, as here you also have all the
Contao frontend modules for events available. The specifications for the extension »Leads« in combination 
with the class ``DataCollector`` are nevertheless helpful.

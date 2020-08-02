---
title: Forms
description: 'With the form generator you can create forms and either send their data by e-mail or write them into the database.'
aliases:
    - /en/form-generator/forms/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

With the form generator you can create forms and either send their data by e-mail or write them into the database. Contao automatically checks the form input according to the rules you specify. Transferred files can be sent as attachments or saved on the server.

## Own SMTP server

Without specifying an own SMTP server, the data is sent via [Sendmail](https://de.wikipedia.org/wiki/Sendmail), which can lead to problems.

{{% notice info %}}
We recommend sending via the [e-mail transport protocol (SMTP)](../../system/einstellungen/#smtp-versand) . 
{{% /notice %}}

## Form configuration

You can find the form generator in the backend navigation in the group "Contents".

To create a new form click on ![Create a new form](/de/icons/new.svg?classes=icon "Ein neues Formular anlegen")**New** .

### Title and forwarding

**Title:** The title of a form is only used in the backend.

**Formalias:** The formalias is a unique reference that can be called instead of the numeric form ID.

**Forwarding page:** Here you can define to which page a visitor is forwarded after submitting a form (confirmation page).

### Form configuration

**Allow HTML tags:** If you select this option, your visitors can use HTML code in the form fields. In the backend settings under "Allowed HTML tags" you define which HTML tags are allowed.

## Send form data

Upon request, Contao sends the form data by email to one or more recipients. If a form contains a field for the transmission of a file, the file will be attached to the e-mail.

**Send by e-mail:** Here you can activate the sending of e-mails.

**Recipient address:** Here you can enter one or more e-mail addresses separated by commas to which the form data will be sent.

**Subject:** Here you enter the subject of the e-mail.

**Data format:** Here you define the format in which the form data is transmitted. Transmitted files are always attached as an attachment.

| Data format | Declaration |
| ----------- | ----------- |
| Raw data | The e-mail contains the unprocessed data, i.e. the contents of the individual form fields are simply listed below each other. |
| XML file | An XML file with the form data is attached to the e-mail. |
| CSV file | A CSV file with the form data is attached to the e-mail. |
| CSV file (Microsoft Excel) | {{< version "4.10" >}} A CSV file in Microsoft Excel format with the form data is attached to the e-mail. |
| E-mail | The form data is formatted as if the sender had written an e-mail with his e-mail program. In this case, the form generator only processes the fields `name`, `email`, `subject`and `message`ignores all other form fields. |

**Omit empty fields:** If you select this option, only completed fields will be sent by e-mail. Fields without an entry are skipped.

## Save form data

In addition to or instead of being sent by e-mail, form entries can also be stored in a table in the database. To do this, you must create a corresponding field in the target table for each form field and make sure that the field names match.

**Save entries:** Here you activate the saving of data in the database.

**Destination table:** Here you select the table in which the data is to be written. The table must have been created before e.g. via phpMyAdmin.

## Template settings

**Individual template:** Here you can overwrite the standard template.

## Expert settings

In the expert settings you can change the transmission method of a form. By default, forms are sent as POST requests, since this allows larger amounts of data, such as files, to be transferred. However, in special cases, for example if you want to create a search form to control the Contao search engine, it is necessary to send a GET request instead, which appends the form data to the URL of the page.

**Transfer method:** Here you set the transfer method.

**Disable HTML5 validation:** Here you add the `novalidate`-attribute to the form.

**CSS ID/class:** To address a specific form specifically in a stylesheet, you can assign it a CSS ID or CSS class here.

**Form ID:** Most frontend modules that accept user input have a form ID that can be used to uniquely identify them. If you want to access such a module with its own form, you must specify this form ID here.

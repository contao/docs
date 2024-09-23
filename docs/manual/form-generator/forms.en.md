---
title: Forms
description: 'With the form generator you can create forms and either send their data by e-mail or write them into the database.'
aliases:
    - /en/form-generator/forms/
weight: 10
---

With the form generator you can create forms and either send their data by e-mail or write them to the database. Contao 
automatically validates the form input according to the rules you specify. Files can be sent as attachments or saved on the server.

## Setting your own SMTP server

Without specifying a separate SMTP server, the data is sent via [sendmail](https://en.wikipedia.org/wiki/Sendmail), which can lead to problems.

{{% notice info %}}
We recommend sending via the [e-mail transport protocol (SMTP)](/en/system/settings/#e-mail-sending-configuration).
{{% /notice %}}

## Form configuration

You can find the form generator in the "Content" group in the backend navigation.

To create a new form click on **New** ![Create a new form]({{% asset "icons/new.svg" %}}?classes=icon).

### Title and forwarding

**Title:** The title of a form is only used in the backend.

**Form alias:** The form alias is a unique reference that can be called instead of the numeric form ID.

**Redirect page:** Here you can define to which page a visitor is redirected to after submitting a form (confirmation/thank you page).

### Form configuration

**Allow HTML tags:** If you select this option, your visitors can use HTML code in the form fields. In the backend 
settings under "Allowed HTML Tags" you define which HTML tags are allowed.

{{< version-tag "5.1" >}} **Submit via Ajax:** If you select this option, you will not need a redirect page 
and you can additionally set a text as confirmation message. The submitted form data can be used as simple tokens like: ##field_name##.

## Send form data

If desired, Contao will send the form data by email to one or more recipients. If a form contains a file upload field, 
the file will be attached to the e-mail.

**Send by e-mail:** Here you can activate the sending of e-mails.

**Recipient address:** Here you can enter one or more comma separated e-mail addresses to which the form data will be sent.

**Subject:** Here you enter the subject of the e-mail.

**Data format:** Here you can define the format in which the form data will be sent. Uploaded files are always sent as 
an attachment.

| Data format | Declaration |
| ----------- | ----------- |
| Raw data | The e-mail contains the unprocessed data, i.e. the contents of the individual form fields are simply listed below each other. |
| XML file | An XML file with the form data is attached to the e-mail. |
| CSV file | A CSV file with the form data is attached to the e-mail. |
| CSV file (Microsoft Excel) | {{< version "4.10" >}} A CSV file in Microsoft Excel format with the form data is attached to the e-mail. |
| E-mail | The form data is formatted as if the sender had written an e-mail with their e-mail program. In this case, the form generator only processes the fields `name`, `email`, `subject`, and `message`, and ignores all other form fields. |

**Omit empty fields:** If you select this option, only completed fields will be sent by e-mail. Fields without any input will be skipped.


### Special Field Names

Certain field names influence the behavior of Contao's email sending process. To take advantage of these features you 
need to insert a form field with exactly the field name as described here.

| Field&nbsp;name | Effect |
| --- | --- |
| `email`    | The email address from this field will be used as the `Reply-To:` address (must be a valid email address). |
| `name`     | The value of this field will be used as the name for the `Reply-To:` address. |
| `firstname` | The value of this field will be used as the first name for the `Reply-To:` address. <br>Only applies if also a `lastname` and no `name` is present. |
| `lastname` | The value of this field will be used as the last name for the `Reply-To:` address. <br>Only applies if also a `firstname` and no `name` is present. |
| `cc` | If the value of this field is not empty, the email address from the `email` field will be used as a `Cc:` address (i.e. a copy of the email will be sent to that address). Typically used as a hidden or checkbox field. |


## Save form data

In addition to or instead of sending the form by e-mail, form entries can also be stored in a table in the database. To do 
this, you have to create a corresponding field in the target table for each form field and make sure that the field names match.

**Save entries:** Here you activate the saving of the data in the database.

**Destination table:** Here you select the table in which the data should be written. The table must be created
 before (e.g. via phpMyAdmin or as [DCA](../../../../dev/reference/dca/)) in order to show up as a choice. The SQL-table must contain a column of the same name for each form field. Special characters such as hyphens in the field name can cause problems.

Example SQL code to create a new table `prefix_example` in the database `##DB-name##` for a form with the (text) fields `field1` , `field2` , `field3`:
```SQL
CREATE TABLE `##DB-name##`.`prefix_example` ( `ID` INT NOT NULL AUTO_INCREMENT , `field1` TEXT NOT NULL , `field2` TEXT NOT NULL , `field3` TEXT NOT NULL , INDEX (`ID`)) ENGINE = InnoDB;
``` 

## Template settings

**Individual template:** Here you can overwrite the standard template.

## Expert settings

In the expert settings you can change the transmission method of a form. By default, forms are sent as a POST request, 
which allows you to transfer large amounts of data such as files. However, in special cases, for example if you want to 
create a search form to control the Contao search engine, it is necessary to send a GET request instead, which attaches the form data to the URL of the page.

**Submission method:** Here you define the submission method.

**Disable HTML5 validation:** Here you add the `novalidate` attribute to the form.

**CSS ID/class:** To address a specific form in a specific stylesheet, you can assign it a CSS ID or CSS class here.

**Form ID:** Most frontend modules that receive user input have a form ID that can be used to uniquely identify them. 
If you want to access such a module with your own form, you have to specify this form ID here.

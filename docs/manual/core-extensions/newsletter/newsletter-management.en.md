---
title: 'Newsletter management'
description: 'The newsletter management is a separate module in the back end, which you can find in the 
"Content" group.'
aliases:
    - /en/core-extensions/newsletter/newsletter-management/
weight: 10
---

The newsletter management is a separate module in the back end, which you can find in the "Content" group, where you 
can create several distribution lists (or channels) containing the individual newsletters and recipients. By using 
multiple distribution lists/channels you can sort the newsletters by topic or language.

## Channels

To create a new channel click on ![Create a new channel]({{% asset "icons/new.svg" %}}?classes=icon "Create a new 
channel") **New**.

### Title and redirection

**Title:** The title of a channel is only used in the back end overview.

**Redirect page:** Here you can define to which page a visitor is forwarded when clicking on a link in the front end 
module "Newsletter list". This target page should contain the module "Newsletter reader".

### Template settings

**E-mail Template:** Here you can overwrite the e-mail template.

{{< version-tag "5.3" >}} In addition to `mail_default`, `mail_responsive` is also available.

The template for `mail_default`:

```html
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?= $this->charset ?>">
  <meta name="Generator" content="Contao Open Source CMS">
  <title><?= $this->title ?></title>
  <?= $this->css ?>
</head>
<body>
  <?= $this->body ?>
</body>
</html>
```

The template for `mail_responsive`:

```html
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $this->title ?></title>
  ```
{{% faq "CSS of the newsletter" %}}
```css
    <style media="all" type="text/css">
/* -------------------------------------
    GLOBAL RESETS
------------------------------------- */
    body {
      font-family: Helvetica, sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 16px;
      line-height: 1.3;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

    table {
      border-collapse: separate;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      width: 100%;
    }

    table td {
      font-family: Helvetica, sans-serif;
      font-size: 16px;
      vertical-align: top;
    }
/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
    body {
      background-color: #f4f5f6;
      margin: 0;
      padding: 0;
    }

    .body {
      background-color: #f4f5f6;
      width: 100%;
    }

    .container {
      margin: 0 auto !important;
      max-width: 600px;
      padding: 0;
      padding-top: 24px;
      width: 600px;
    }

    .content {
      box-sizing: border-box;
      display: block;
      margin: 0 auto;
      max-width: 600px;
      padding: 0;
    }  
/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
    .main {
      background: #ffffff;
      border: 1px solid #eaebed;
      border-radius: 16px;
      width: 100%;
    }

    .wrapper {
      box-sizing: border-box;
      padding: 24px;
    }

    .footer {
      clear: both;
      padding-top: 24px;
      text-align: center;
      width: 100%;
    }

    .footer td,
    .footer p,
    .footer span,
    .footer a {
      color: #9a9ea6;
      font-size: 16px;
      text-align: center;
    }
/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
    p {
      font-family: Helvetica, sans-serif;
      font-size: 16px;
      font-weight: normal;
      margin: 0;
      margin-bottom: 16px;
    }

    a {
      color: #0867ec;
      text-decoration: underline;
    }
/* -------------------------------------
    BUTTONS
------------------------------------- */
    .btn {
      box-sizing: border-box;
      min-width: 100% !important;
      width: 100%;
    }

    .btn > tbody > tr > td {
      padding-bottom: 16px;
    }

    .btn table {
      width: auto;
    }

    .btn table td {
      background-color: #ffffff;
      border-radius: 4px;
      text-align: center;
    }

    .btn a {
      background-color: #ffffff;
      border: solid 2px #0867ec;
      border-radius: 4px;
      box-sizing: border-box;
      color: #0867ec;
      cursor: pointer;
      display: inline-block;
      font-size: 16px;
      font-weight: bold;
      margin: 0;
      padding: 12px 24px;
      text-decoration: none;
      text-transform: capitalize;
    }

    .btn-primary table td {
      background-color: #0867ec;
    }

    .btn-primary a {
      background-color: #0867ec;
      border-color: #0867ec;
      color: #ffffff;
    }

    @media all {
      .btn-primary table td:hover {
        background-color: #ec0867 !important;
      }
      .btn-primary a:hover {
        background-color: #ec0867 !important;
        border-color: #ec0867 !important;
      }
    }
/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
    .last {
      margin-bottom: 0;
    }

    .first {
      margin-top: 0;
    }

    .align-center {
      text-align: center;
    }

    .align-right {
      text-align: right;
    }

    .align-left {
      text-align: left;
    }

    .text-link {
      color: #0867ec !important;
      text-decoration: underline !important;
    }

    .clear {
      clear: both;
    }

    .mt0 {
      margin-top: 0;
    }

    .mb0 {
      margin-bottom: 0;
    }

    .preheader {
      color: transparent;
      display: none;
      height: 0;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
      mso-hide: all;
      visibility: hidden;
      width: 0;
    }

    .powered-by a {
      text-decoration: none;
    }
/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
    @media only screen and (max-width: 640px) {
      .main p,
      .main td,
      .main span {
        font-size: 16px !important;
      }
      .wrapper {
        padding: 8px !important;
      }
      .content {
        padding: 0 !important;
      }
      .container {
        padding: 0 !important;
        padding-top: 8px !important;
        width: 100% !important;
      }
      .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      .btn table {
        max-width: 100% !important;
        width: 100% !important;
      }
      .btn a {
        font-size: 16px !important;
        max-width: 100% !important;
        width: 100% !important;
      }
    }
/* -------------------------------------
    PRESERVE THESE STYLES IN THE HEAD
------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
    }
    </style>
```
{{% /faq %}}
```html
  </head>
  <body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <span class="preheader"><?= $this->preheader ?></span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
              <tr>
                <td class="wrapper">
                  <?= $this->body ?>
                </td>
              </tr>
            </table>
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 7-11 Commercial Ct, Belfast BT1 2NB</span>
                    <br> Don't like these emails? <a href="#">Unsubscribe</a>.
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
```


### Sender settings

**Sender e-mail address:** Here you have to enter the sender's e-mail address.

**Sender name:** Here you can enter the name of the sender.

**Mailer transport:** In many cases, SMTP servers do not allow the sending of arbitrary sender addresses. In most cases,
the sender address must match the SMTP server access data used. However, especially in multi-domain installations of
Contao, it can be important that the sender address of the emails that Contao sends matches the respective domain.
Therefore, you can create so-called
"[transports](/en/system/settings/#different-e-mail-configurations-and-sender-addresses)" and select them here.


## Newsletters

Newsletters are always sorted according to their dispatch date.

To create a new newsletter click on ![Edit channel]({{% asset "icons/edit.svg" %}}?classes=icon "Edit Channel") or
![Edit channel]({{% asset "icons/children.svg" %}}?classes=icon "Edit Channel") and 
then on New ![Create a new newsletter]({{% asset "icons/new.svg" %}}?classes=icon "Create a new newsletter").


### Subject and newsletter aliases

**Subject:** Here you can enter the subject of the newsletter email.

**Newsletter aliases:** The alias of a newsletter is a unique and meaningful reference that you can use to call it up 
in any browser.

### HTML content

You may wonder why you have to enter the text of the newsletter twice. This is because neither the HTML nor the text 
variant is free from disadvantages, and so we have decided to include both in the newsletter. The recipient's mail 
program then decides for itself which variant it can display.

A pure HTML newsletter has the following disadvantages:

- Not all mail clients can display HTML correctly.
- HTML mails are more likely to be classified as spam than plain text mails.
- Externally embedded images are often blocked.

A text newsletter does not have these problems, but you can neither include pictures nor influence the text formatting.

{{< version-tag "5.3" >}} **Preheader text:** You can enter a preheader text here. A preheader text should be between 
40 and 130 characters long. The preheader text is the short text in an email in your inbox after the sender information 
and the subject line.

**HTML content:** Enter the HTML content of the newsletter here. The input is done in the same way as for the content 
element "Text" using the Rich Text Editor.


### Text content

**Text content:** Enter the text content of the newsletter here.


### Personalizing the newsletter

If you send newsletters to registered members, you can personalize them using "[simple tokens](https://docs.contao.org/manual/en/article-management/simple-tokens/)". Simple tokens work similar to insert tags and can be used in both HTML and text content of a newsletter. Below is a small example:

```text
Dear ##firstname## ##lastname##,

please check and update your data:

Address: ##street##
ZIP / City: ##postal## ##city##
Phone: ##phone##
Email: ##email##

Your administrator
```

In contrast to insert tags, simple tokens not only allow you to access `tl_member` field data in the member table, but 
also to implement simple if-else queries and thus, for example, to specify the gender of the salutation:

```text
{if gender=="male"}
Dear Mr. ##lastname##,
{elseif gender=="female"}
Dear Ms. ##lastname##,
{else}
Dear Sirs and Madams,
{endif}

[Content of the newsletter]

{if phone==""}
Please update your details and include your phone number.
{endif}

<!-- query on "not empty" -->
{if phone!=""}
We have the following phone number stored by you: ##phone##
{endif}

Your administrator
```

### File attachments {#attachments}

You can add one or more files to each newsletter, which are then sent as e-mail attachments or offered for download on 
the website.

**Add attachments:** Here you activate the function.

**Attachments:** Here you can select the file attachments.


### Template settings

There are two things you need to know about the e-mail template:

- It is only used for HTML newsletters.
- It is primarily intended for page layout and not for content.

HTML mails are basically structured like HTML web pages, but unfortunately, e-mail programs cannot handle HTML code like 
modern Internet browsers. Therefore the template generates an `mail_default` outdated HTML 3.2 document, which is 
processed by most email clients.

**E-Mail Template:** Here you select the template for the HTML mail.

{{< version-tag "5.3" >}} In addition to `mail_default`, `mail_responsive` is also available.


### Sender settings

If you do not provide an individual sender address, the mailing list email address will be used.

**Custom sender e-mail address:** Here you can enter the e-mail address of the sender.

**Custom sender name:** Here you can enter the name of the sender.

**Mailer transport:** In many cases, SMTP servers do not allow the sending of arbitrary sender addresses. In most cases,
the sender address must match the SMTP server access data used. However, especially in multi-domain installations of
Contao, it can be important that the sender address of the emails that Contao sends matches the respective domain.
Therefore, you can create so-called
"[transports](/en/system/settings/#different-e-mail-configurations-and-sender-addresses)" and select them here.


### Expert settings

To send a newsletter as a plain text mail, it is not enough to simply leave the HTML content field empty. You also 
have to select the option `Send as plain text` in the expert settings.

**Send as plain textt:** Here you deactivate the HTML-sending

**External images:** Here you can make sure that images are not embedded in HTML newsletters.


## Recipients

Usually, the recipients of a newsletter manage themselves using the corresponding front end modules without your 
intervention as administrator. Nevertheless, you still have the possibility to change recipients manually in the 
back end. For data protection reasons, only the e-mail address and the activation status are saved.

![Edit a recipient]({{% asset "images/manual/core-extensions/newsletter/en/activate_recipient.png" %}}?classes=shadow)

According to the [double opt-in procedure](https://de.wikipedia.org/wiki/Opt-In), every subscriber receives an 
e-mail with a confirmation link when subscribing, without which he cannot complete their subscription. This is 
sufficient to comply with the provisions of §7 paragraph 2 numbers 2 and 3 of the Law against Unfair Competition (UWG).

To add/edit a subscriber to the distribution list, click 
on ![Edit subscribers of the distribution list]({{% asset "icons/mgroup.svg" %}}?classes=icon "Edit channel subscribers") 
and then on New ![Create a new subscriber]({{% asset "icons/new.svg" %}}?classes=icon "Create a new subscriber") or 
![Edit subscriber]({{% asset "icons/edit.svg" %}}?classes=icon "Edit Subscriber").

**E-mail address:** Enter the recipient's e-mail address here.

**Activate recipient:** Here you can activate the e-mail address. As long as an e-mail address is not activated, the 
recipient will not be considered when sending the newsletter. Activation is normally done by clicking on the link in 
the confirmation mail, but can also be triggered manually.


### CSV import

Maybe you have been working with a newsletter system before Contao, and now you are faced with the task of adding 
existing recipients to Contao. In this case, the newsletter module offers the function `CSV Import`.

First export the existing recipients as CSV file. Most programs such as phpMyAdmin or Excel offer a corresponding option 
to save data in CSV format. Although the name CSV file suggests that only comma separated data can be processed, Contao 
also accepts semicolons, tabs and line breaks as field separators.

Select the file for import on your computer.

![Import newsletter recipients]({{% asset "images/manual/core-extensions/newsletter/en/csv_import.png" %}}?classes=shadow)

Then start the import by clicking the button `CSV-Import`.


## Send newsletter

You can start sending a newsletter by clicking on the corresponding navigation 
![Send newsletter]({{% asset "icons/send.svg" %}}?classes=icon "Send newsletter") symbol in the distribution list 
overview, which will take you to a preview page where you can check the configuration and content of the newsletter 
again. It is also recommended that you make active use of the button `Send preview`. You can change the recipient 
address in the field `Send preview to`.

![Sending a newsletter]({{% asset "images/manual/core-extensions/newsletter/en/send_newsletter.png" %}}?classes=shadow)


### Calculate server limits

Usually, you will not have rented a private server for your website, but share a so-called shared hosting server with 
other customers. Since the system resources in shared hosting are available to all customer communities, there are 
usually certain limits that restrict their use.

For example, if you send a newsletter to 500,000 recipients, the mail server may be busy for a while, during which time 
you will virtually block the service for all customers. Therefore, the number of emails you can send per minute is 
usually limited to between 50 and 500.

To accommodate such limitations, Contao does not send all newsletters at once, but divides the sending process into 
several cycles which you can adjust exactly to the requirements of your mail server.

**Mails per cycle:** Here you define the number of mails per cycle.

**Waiting time in seconds:** Here you specify the wait time between each cycle.

**Offset:** If a send cycle was interrupted, you can specify here from which receiver this should be resumed.

For example, assuming a server limit of 100 emails per minute, and a total number of 10,000 recipients, you can send 
10 emails every 6 seconds. The complete sending process would then take 100 minutes.


### Resuming interrupted sending

Normally, the sending of a newsletter is completely automated, and you can do other work while it is being sent. You just must not close the Contao browser window or turn off your computer. However, if this happens accidentally, you can resume sending the newsletter as follows:

1. Filter the category in the back end under "System" &gt; "System Log" after the last newsletter entry.
2. Determine how many newsletters were sent.
3. Enter the desired offset in the field `Offset`.

You can find the log data of the transmission in the back end under "System" &gt; "System Log". The filter category 
is called NEWSLETTER_X, where the X stands for the ID of the respective newsletter. The total number of e-mails sent 
can be seen in the field `Show`. For example, if there were 120 mails, enter "120" to continue with the 121st 
recipient (counting starts at 0).

![Resume interrupted sending]({{% asset "images/manual/core-extensions/newsletter/en/system_log.png" %}}?classes=shadow)

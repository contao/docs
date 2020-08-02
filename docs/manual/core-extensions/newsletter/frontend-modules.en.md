---
title: 'Front-end modules'
description: 'The newsletter extension contains four additional frontend modules which you can configure as usual via the module management.'
aliases:
    - /en/core-extensions/newsletter/frontend-modules/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Now that you know how mailing lists, newsletters and recipients are managed in the backend, we will explain how your visitors can subscribe or unsubscribe to mailing lists in the frontend and how to create an archive that shows all sent newsletters. The newsletter extension contains four additional frontend modules which you can configure as usual via the module management.

![Newsletter modules](/de/core-extensions/newsletter/images/de/newsletter-module.png?classes=shadow)

## Subscribe

The frontend module "Subscribe" adds a form to the website, which your visitors can use to register for certain mailing lists.

### Module configuration

**Distributor:** Here you select the mailing lists your visitors can subscribe to via the frontend module for subscribing to mailing lists.

**Hide the distribution menu:** Here you can hide the distribution list selection menu. In this case the visitor subscribes to the distribution lists you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

{{< version "4.6" >}}

### Own text

**Own text:** Here you can, for example, enter a data protection notice to make the registration DSGVO-compliant.

### Forwarding

**Forwarding page:** Here you can define to which page visitors are forwarded after submitting the order form. Among other things, you should also explain how to cancel a subscription.

### E-mail settings

**Subscription confirmation:** Enter the text of the confirmation email here. You can use the placeholders `##channel##`for the distribution list as well `##domain##`as for the current domain and `##link##`for the confirmation link.

For example, a confirmation mail could look like this:

```text
Sie haben folgende Verteiler auf ##domain## abonniert:

##channels##

Bitte klicken Sie hier, um Ihr Abonnement zu aktivieren:

##link##

Der Bestätigungslink ist 24 Stunden gültig. Sie können Ihr Abonnement jederzeit beenden.

Falls Sie die Verteiler nicht selbst abonniert haben, ignorieren Sie diese E-Mail bitte.

Ihr Administrator
```

### Template settings

**Newsletter template:** Here you choose the template for the order form.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_subscribe block">
    <form action="…" id="tl_subscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_subscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail-Adresse</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Verteiler</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox">
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-explanation">
                <p>Eigener Text</p>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Abonnieren</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```

## Quit {#quit}

The frontend module "Cancel" adds a form to the website, which allows your visitors to unsubscribe from certain mailing lists.

### Module configuration

**Distributor:** Here you select the distribution lists from which your visitors can unsubscribe via this frontend module.

**Hide the distribution menu:** Here you can hide the distribution list selection menu. In this case the user cancels the distribution lists you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

### Forwarding

**Forwarding page:** Here you can define to which page visitors are forwarded after submitting the cancellation form.

### E-mail settings

**Confirmation of cancellation:** Enter the text of the confirmation mail here. You can use the placeholders `##channel##`for the distribution list and `##domain##`for the current domain.

For example, a confirmation mail could look like this:

```text
Sie haben folgende Abonnements auf ##domain## gekündigt:

##channels##

Ihr Administrator
```

### Template settings

**Newsletter template:** Here you choose the template for the cancellation form.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_unsubscribe block">
    <form action="…" id="tl_unsubscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_unsubscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail-Adresse</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Verteiler</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox"> 
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Kündigen</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```

## Newsletter list

The frontend module "Newsletter list" lists all sent newsletters. The subject, the date of dispatch and a link to the detailed view are displayed.

### Module configuration

**Distributor:** Here you define from which mailing lists newsletters should be listed. Newsletters are sorted in descending order by date of dispatch.

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsletterlist block">
    <ul>
        <li>01.09.2019 22.50: <a href="…" title="…">…</a></li>
        <li>01.08.2019 23.16: <a href="…" title="…">…</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

## Newsletter reader

The frontend module "Newsletter reader" is used to display a specific newsletter. The module obtains the ID or the alias of the newsletter via the URL, so that newsletters can be specifically linked with so-called [permalinks](https://de.wikipedia.org/wiki/Permalink):

`www.example.com/newsletterleser/newsletteralias.html`

The *newsletteralias* tells the "newsletter reader" to search for a specific newsletter and to output it. If the searched entry does not exist, the module returns an error message and the HTTP status code "404 Not found". The status code is important for search engine optimization.

{{% notice info %}}Only one "reader module" may be located on a single page, regardless of the type. Otherwise one or the other module would trigger a 404 page, because for example the alias of a newsletter cannot be found in a calendar, or vice versa the alias of an event in a newsletter archive.
{{% /notice %}}

### Module configuration

**Distributor:** Here you can define the distribution lists in which the requested newsletter should be searched. Newsletters from unselected distribution lists are generally not displayed, even if the URL is correct and the entry exists. This feature is especially important in multi-domain operations with several independent websites.

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<div class="mod_newsletterreader block">
    <h1>…</h1>
    <div class="newsletter">
        …
    </div>
    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->
</div>
```

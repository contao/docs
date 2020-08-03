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

Now that you know how mailing lists, newsletters and recipients are managed in the backend, we will explain how visitors can subscribe or unsubscribe to mailing lists in the frontend and how to create an archive that displays all sent newsletters. The newsletter extension contains four additional frontend modules, which you can configure as usual via the module management.

![Newsletter modules](/de/core-extensions/newsletter/images/de/newsletter-module.png?classes=shadow)

## Subscribe to

The frontend module "Subscribe" adds a form to the website which allows your visitors to register for specific mailing lists.

### Module Configuration

**Distributor:** Here you select the distribution lists for which your visitors can register via the frontend module for subscribing to distribution lists.

**Hide the distribution list menu:** Here you can hide the menu for the distribution list selection. In this case the visitor subscribes to the distribution lists you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

{{< version "4.6" >}}

### Own text

**Own text:** Here you can, for example, enter a data protection notice to make the registration DSGVO-compliant.

### Forwarding

**Forwarding page:** Here you can define to which page visitors are forwarded after submitting the order form. Among other things, you should also explain how to cancel a subscription.

### E-mail settings

**Subscription Confirmation:** Enter the text of the confirmation mail here. You can use the placeholders `##channel##`for the distribution list, `##domain##`the current domain and `##link##`the confirmation link.

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

  
**HTML Output**The frontend module generates the following HTML code:

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

## Cancel {#cancell}

The frontend module "Cancel" adds a form to the website, with which your visitors can unsubscribe from certain mailing lists.

### Module configuration

**Distribution list:** Here you can select the distribution lists from which your visitors can unsubscribe via this frontend module.

**Hide distribution list menu:** Here you can hide the menu for selecting distribution lists. In this case the user cancels the distribution lists you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

### Forwarding

**Forwarding page:** Here you can define to which page visitors are forwarded after submitting the cancellation form.

### E-mail settings

**Confirmation of cancellation:** Enter the text of the confirmation mail here. You can use the placeholders `##channel##`for the distribution list and `##domain##`for the current domain.

For example, a confirmation mail might look like this:

```text
Sie haben folgende Abonnements auf ##domain## gekündigt:

##channels##

Ihr Administrator
```

### Template settings

**Newsletter template:** Here you select the template for the cancellation form.

**HTML outputThe**  
 frontend module generates **the** following HTML code:

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

The frontend module "Newsletterlist" lists all sent newsletters. The subject, the sending date and a link to the detail view are displayed.

### Module configuration

**Distributor:** Here you define from which mailing lists newsletters should be listed. Newsletters are sorted in descending order by date of dispatch.

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML OutputThe**  
 frontend module generates the following HTML code:

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

The frontend module "Newsletter reader" is used to display a specific newsletter. The module obtains the ID or the alias of the newsletter via the URL, so that newsletters can be specifically linked with so-called permanent links:

`www.example.com/newsletterleser/newsletteralias.html`

The *newsletteralias* tells the "newsletter reader" to search for and issue a specific newsletter. If the searched entry does not exist, the module returns an error message and the HTTP status code "404 Not found". The status code is important for search engine optimization.

{{% notice info %}}
On a single page there may only be one "reader module" at a time, regardless of the type. Otherwise, one or the other module would trigger a 404 page, because, for example, the alias of a newsletter cannot be found in a calendar, or vice versa the alias of an event in a newsletter archive.
{{% /notice %}}

### Module configuration

**Distribution list:** Here you can define the distribution lists to be searched for the requested newsletter. Newsletters from unselected distribution lists are not displayed, even if the URL is correct and the entry exists. This feature is especially important in multi-domain operations with several independent websites.

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML outputThe**  
 frontend module generates the following HTML code:

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

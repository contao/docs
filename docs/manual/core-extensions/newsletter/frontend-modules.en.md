---
title: 'Front end modules'
description: 'The newsletter extension contains four additional front end modules which you can configure as usual 
via the module management.'
aliases:
    - /en/core-extensions/newsletter/frontend-modules/
weight: 20
---

Now that you know how mailing lists, newsletters, and recipients are managed in the back end, we will explain how 
visitors can subscribe or unsubscribe to mailing lists in the front end and how to create an archive that displays 
all sent newsletters. The newsletter extension contains four additional front end modules, which you can configure 
as usual via the module management.

![Newsletter modules]({{% asset "images/manual/core-extensions/newsletter/images/en/newsletter_modules.png?classes=shadow" %}})

## Subscribe

The front end module "Subscribe" adds a form to the website which allows your visitors to register for specific 
mailing lists.

### Module Configuration

**Channels:** Here you select the distribution lists for which your visitors can register via the front end module for 
subscribing to distribution lists, or channels.

**Hide the channel menu:** Here you can hide the menu for the distribution list/channel selection. In this case the 
visitor is automatically subscribed to the distribution lists/channel you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

{{< version "4.6" >}}

### Custom text

**Custom text:** Here you can, for example, enter a data protection notice to make the registration DSGVO-compliant.

### Redirect settings

**Redirect page:** Here you can define to which page visitors are forwarded after submitting the subscription form. 
Among other things, you should also explain how to cancel a subscription on this page.

### E-mail settings

**Subscription Message:** Enter the text of the confirmation email here. You can use the placeholders `##channel##` for 
the distribution list/channel, `##domain##` for the current domain and `##link##` for the email confirmation link.

For example, a confirmation email could look like this:

```text
You have subscribed to the following distribution lists on ##domain##:

##channels##

Please click here to activate your subscription:

##link##

The confirmation link is valid for 24 hours. You can end your subscription at any time.

If you have not subscribed to the mailing list yourself, please ignore this email.

Your administrator
```

### Template settings

**Newsletter template:** Here you choose the template for the order form.

  
**HTML Output** The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_subscribe block">
    <form action="…" id="tl_subscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_subscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail Address</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Channels</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox">
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-explanation">
                <p>Custom Text</p>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Subscribe</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```

## Unsubscribe {#cancell}

The front end module "Unsubscribe" adds a form to the website, with which your visitors can unsubscribe from certain 
mailing lists.

### Module configuration

**Channels:** Here you can select the distribution lists/channels from which your visitors can unsubscribe via this 
front end module.

**Hide channel menu:** Here you can hide the menu for selecting distribution lists/channels. In this case the user 
is removed from all the distribution lists you have defined.

**Disable spam protection:** Here you can disable the spam protection (not recommended).

### Redirect settings

**Redirect page:** Here you can define which page visitors are forwarded after submitting the cancellation form.

### E-mail settings

**Unsubscription message:** Enter the text of the unsubscribe email here. You can use the placeholders `##channel##` 
for the distribution list/channel and `##domain##` for the current domain.

For example, a confirmation mail might look like this:

```text
You have canceled the following subscriptions to ##domain##:

##channels##

Your administrator
```

### Template settings

**Newsletter template:** Here you select the template for the cancellation form.

**The HTML output** The front end module generates **the** following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_unsubscribe block">
    <form action="…" id="tl_unsubscribe" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_unsubscribe">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="widget widget-text mandatory">
                <label for="ctrl_email" class="invisible">E-Mail Address</label>
                <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset id="ctrl_channels" class="checkbox_container">
                    <legend class="invisible">Channels</legend>
                    <span>
                        <input type="checkbox" name="channels[]" id="opt_3" value="3" class="checkbox"> 
                        <label for="opt_3">…</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Unsubscribe</button>
            </div>
        </div>
    </form>
</div>
<!-- indexer::continue -->
```

## Newsletter list

The front end module "Newsletter list" lists all sent newsletters. The subject, the sending date, and a link to the 
detail view are displayed.

### Module configuration

**Channels:** Here you define which mailing lists/newsletters should be listed. Newsletters are sorted in 
descending order by date of dispatch.

### Template settings

**Module template:** Here you can overwrite the standard module template.

**The HTML Output** The front end module generates the following HTML code:

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

The front end module "Newsletter reader" is used to display the details of a specific newsletter. The module obtains 
the ID or the alias of the newsletter via the URL, so that newsletters can be specifically linked via permanent links:

`www.example.com/newslettereader/newsletteralias.html`

The *newsletteralias* tells the "Newsletter reader" to search for and display a specific newsletter. If the searched 
entry does not exist, the module returns an error message, and the HTTP status code "404 Not found". The status code 
is important for search engine optimization.

{{% notice info %}}
On a single page there may only be one "reader module" at a time, regardless of the type. Otherwise, one or the other module would trigger a 404 page, because, for example, the alias of a newsletter cannot be found in a calendar, or vice versa the alias of an event in a newsletter archive.
{{% /notice %}}

### Module configuration

**Channels:** Here you can define the distribution lists/channels to be searched for the requested newsletter module. 
Newsletters from unselected distribution lists are not displayed, even if the URL is correct and the entry exists. This feature is especially important in multi-domain operations with several independent websites.

### Template settings

**Module template:** Here you can overwrite the standard template.

**The HTML output** The front end module generates the following HTML code:

```html
<div class="mod_newsletterreader block">
    <h1>…</h1>
    <div class="newsletter">
        …
    </div>
    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Go Back">Go Back</a></p>
    <!-- indexer::continue -->
</div>
```

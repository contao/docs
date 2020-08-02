---
title: 'Form fields'
description: 'Similar to articles and content elements, forms have a separate element for each form field, which is specifically designed to meet the particular requirements of the input field.'
aliases:
    - /en/form-generator/form-fields/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Similar to articles and content elements, forms have a separate element for each form field, which is specifically designed to meet the requirements of the input field. Each form field must have at least one field name and one field label.

![Edit form fields](/de/form-generator/images/de/formularfelder-bearbeiten.png?classes=shadow)

**Field name:** The field name is used to reference the user input after the form has been submitted. If you store the form data in the database, there must be a field in the table with the same name.

**Field label:** The field label is displayed in the frontend before or above the form field and should be written in the correct language.

**Mandatory field:** If you select this option, the field must be filled in to submit the form. If it remains empty, an error message will appear.

## Explanation {#explanation}

The form `Erklärung`field adds any formatted explanation to the form. The input is done with the Rich Text Editor.

**Text:** Enter here the formatted text of the explanation.

**CSS class:** Here you can enter one or more classes.

**Individual template:** Here you can overwrite the default template.

  
**HTML OutputThe** form field generates the following HTML code:

```html
<div class="widget widget-explanation explanation">
    <p>…</p>
</div>
```

## HTML

The form `HTML`field adds any HTML code to the form. In the backend settings under "AllowedHTML tags" you can define which HTML tags can be used.

**HTML:** Enter your HTML code here.

**Individual template**: Here you can overwrite the standard template.

HTML fields have no enclosing HTML markup.

## Fieldset Start and Fieldset End

The `fieldset`element is used to group several controls and labels in a web form.

**CSS class**: Here you can enter one or more classes.

**Individual template:** Here you can overwrite the standard template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<fieldset>
    <legend>…</legend>
    <div class="widget widget-text mandatory">
        …
    </div>
    <div class="widget widget-text mandatory">
        …
    </div>
</fieldset>
```

## Text field

The form field Text Field adds a single-line input field to the form. You should always enable input validation for each text field to prevent misuse of the form.

**Input Validation:** Here you can specify a search pattern that is used to check user input when the form is submitted.

| Search pattern | Declaration |
| -------------- | ----------- |
| Numeric characters | Allows numbers, minus (-), period (.) and spaces ( ). |
| Alphabetic characters | Allows letters, minus (-), period (.) and spaces ( ). |
| Alphanumeric characters | Allows numbers and letters, minus (-), period (.), underscore (\_) and spaces ( ). |
| Extended alphanumeric characters | Allows all characters except those that are normally encoded for security reasons (#/()&lt;=&gt;). |
| Date | Allows entries according to the global date format. |
| Time of day | Allows entries according to the global time format. |
| Date and time | Allows input according to the global date and time format. |
| Phone number | Allows numbers, plus (+), minus (-), slash (/), round brackets (()) and spaces ( ). |
| E-mail address | Allows you to enter a valid email address. |
| URL format | Allows the entry of a valid URL. |

**Placeholder:** This text is displayed as long as the field has not been filled in.

**CSS class:** Here you can enter one or more classes.

**Default value:** Here you can enter a default value. For accessible web pages, it is recommended to use the@ character for e-mail addresses.

**Minimum input length:** Here you can specify the minimum number of characters that can be entered in the text field.

**Maximum input length**: Here you can specify the maximum number of characters that can be entered in the text field.

**Keyboard shortcut:** A keyboard shortcut allows a visitor to jump directly to a specific input field by pressing the `[Alt]`- or - `[Strg]`key in conjunction with the keyboard shortcut, e.g. a number[ (see backend keyboard shortcut](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab-Index:** Here you can determine the position of the form field within the tab order.

**Individual template:** Here you can overwrite the default template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-text … mandatory">
    <label for="ctrl" class="… mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="text" name="…" id="ctrl" class="text … mandatory" value="" required placeholder="…" minlength="…" maxlength="…" accesskey="…" tabindex="…">
</div>
```

## Password field

The form field `Passwortfeld`adds two single-line input fields for the password and its confirmation to the form. In principle, password fields work just like [text fields](#textfeld), except that the input is hidden.

**HTML OutputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-password mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>Passwort<span class="mandatory">*</span>
    </label>
    <input type="password" name="…" id="ctrl" class="text password mandatory" value="" required>
</div>

<div class="widget widget-password confirm mandatory">
    <label for="ctrl_confirm" class="confirm mandatory">
        <span class="invisible">Pflichtfeld </span>Bestätigung<span class="mandatory">*</span>
    </label>
    <input type="password" name="…_confirm" id="ctrl_confirm" class="text password mandatory" value="" required>
</div>
```

## Text area

The form field `Textarea`adds a multiline input field to the form for longer texts. Dustest should also activate the input check here to prevent misuse of the form.

**Rows and columns:** Here you define how many rows and columns the text area should have. You can also define the dimensions of the field via CSS.

**Placeholder:** This text is displayed as long as the field has not been filled in.

**CSS class:** Here you can enter one or more classes.

**Default value**: Here you can enter a default value.

**Minimum input length**: Here you can specify the minimum number of characters that can be entered in the text field.

**Maximum input length**: Here you can specify the maximum number of characters that can be entered in the text field.

**Keyboard shortcut:** A keyboard shortcut allows a visitor to jump directly to a specific input field by pressing the `[Alt]`- or - `[Strg]`key in conjunction with the keyboard shortcut, e.g. a number[ (see backend keyboard shortcut](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab Index:** Here you can determine the position of the form field within the tab order.

**Individual template:** Here you can overwrite the standard template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-textarea mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <textarea name="…" id="ctrl" class="textarea mandatory" rows="4" cols="40" required placeholder="…"></textarea>
</div>
```

## Select menu {#select-menu}

The form field `Select-Menü`adds a drop-down menu to the form from which you can select exactly one option. To allow multiple options to be selected, you can either enable multiple selection or use a [checkbox menu](#checkbox-menue) instead of the Select menu.

![A select menu in the frontend](/de/form-generator/images/de/ein-select-menue-im-frontend.png?classes=shadow)

**Multiple selection:** Here you can allow the selection of multiple options.

**List size:** Here you define how many lines the selection field should be high when multiple selection is activated.

**options:** Here you can enter the different options.

A JavaScript wizard supports you in creating the options. You can group options and assign a heading to each group. To make a line a group heading, select the option Group.

![JavaScript wizard for creating options](/de/form-generator/images/de/anlegen-von-optionen.png?classes=shadow)

**CSS class:** Here you can enter one or more classes.

**Shortcut key:** A shortcut key allows a visitor to jump directly to a certain input field by pressing the `[Alt]``[Strg]`key in conjunction with the shortcut key, e.g. a number[ (see backend shortcut key](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab Index:** Here you can determine the position of the form field within the tab order.

**Individual template:** Here you can overwrite the standard template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-select select mandatory">
    <label for="ctrl" class="select mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <select name="…" id="ctrl" class="select mandatory" required>
        <option value="">-</option>
        <option value="…">…</option>
        <option value="…">…</option>
        <option value="…">…</option>
    </select>
</div>
```

Fields with multiple selection use the CSS `multiselect`class instead `select`of .

## Radio button menu {#radio-button-menu}

The form field Radio button menu adds a list of options to the form from which you can choose exactly one. To allow multiple options to be selected, you must use a [checkbox menu](#checkbox-menue).

![A radio button menu in the front end](/de/form-generator/images/de/ein-radio-button-menue-im-frontend.png?classes=shadow)

**Options:** Here you can enter the different options. A JavaScript assistant supports you when creating the options.

**CSS class:** Here you can enter one or more classes.

**Individual template:** Here you can overwrite the default template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-radio mandatory">   
    <fieldset id="ctrl" class="radio_container mandatory">
        <legend>
            <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
        </legend>
        <span>
            <input type="radio" name="…" id="opt_0" class="radio" value="…" required> 
            <label id="lbl_0" for="opt_0">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_1" class="radio" value="…" required> 
            <label id="lbl_1" for="opt_1">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_2" class="radio" value="…" required> 
            <label id="lbl_2" for="opt_2">…</label>
        </span>
        <span>
            <input type="radio" name="…" id="opt_3" class="radio" value="…" required> 
            <label id="lbl_3" for="opt_3">…</label>
        </span>
    </fieldset>
</div>
```

## Checkbox Menu {#checkbox-menu}

The form field `Checkbox-Menü`adds a list of options to the form, from which you can select as many options as you like or none at all. To allow the selection of just one option, you must use a radio button menu or a [select menu](#select-menue).

![A checkbox menu in the frontend](/de/form-generator/images/de/ein-checkbox-menue-im-frontend.png?classes=shadow)

**options:** Here you can enter the different options. A JavaScript assistant supports you when creating the options.

**CSS class:** Here you can enter one or more classes.

**Individual template**: Here you can overwrite the standard template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-checkbox mandatory">
    <fieldset id="ctrl" class="checkbox_container mandatory">
        <legend>
            <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
        </legend>
        <input type="hidden" name="…" value="">
        <span>
            <input type="checkbox" name="…[]" id="opt_0" class="checkbox" value="…"> 
            <label id="lbl_0" for="opt_0">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_1" class="checkbox" value="…"> 
            <label id="lbl_1" for="opt_1">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_2" class="checkbox" value="…"> 
            <label id="lbl_2" for="opt_2">…</label>
        </span>
        <span>
            <input type="checkbox" name="…[]" id="opt_3" class="checkbox" value="…"> 
            <label id="lbl_3" for="opt_3">…</label>
        </span>
    </fieldset>
</div>
```

## File Upload

The form field `Datei-Upload`adds a field to the form that allows visitors to transfer a file from their local computer to the server. For each upload field, you can define individually which file types may be uploaded and where the transferred files are stored.

**Allowed file types:** Here you can enter a comma-separated list of allowed file extensions. If you try to upload another file, Contao will automatically display an error message and refuse to accept the file.

**Maximum input length:** Here you define the maximum upload file size in bytes. By default, files up to 2 MB can be uploaded.

**Save uploaded files:** Select this option to save transferred files in a specific directory on the server.

**Target directory:** Here you select the storage location for uploaded files.

**Use home directory:** If you select this option and a member is logged in at the time of uploading, the transferred files will be stored in the member's home directory instead of the upload directory.

**Preserve existing files:** By default, Contao replaces a file as soon as a newer file with the same name is uploaded. If you select this option, existing files are preserved and new files are given a numeric suffix if they have the same name.

**CSS class:** Here you can enter one or more classes.

**Shortcut** key: A shortcut key allows a visitor to jump directly to a certain input field by pressing the `[Alt]``[Strg]`key in connection with the shortcut key, e.g. a number[ (see backend shortcut key](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab index:** Here you can determine the position of the form field within the tab order.

**Field size:** Here you can set the size of the upload field (`size`-attribute).

**Individual template**: Here you can overwrite the standard template.

**HTML outputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-upload mandatory">
    <label for="ctrl" class="mandatory">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="file" name="…" id="ctrl" class="upload mandatory" required size="…">
</div>
```

## Hidden Field

The form field `Verstecktes Feld`adds a hidden field to the form. Hidden fields can contain any values that are not visible in the form, but are still submitted when the form is submitted.

**Default value:** Here you can enter the value of the hidden field.

Hidden fields have no CSS class.

**Input validation:** Here you can specify a search pattern that is used to check user input when the form is submitted.

| Search pattern | Declaration |
| -------------- | ----------- |
| Numeric characters | Allows numbers, minus (-), period (.) and spaces ( ). |
| Alphabetic characters | Allows letters, minus (-), period (.) and spaces ( ). |
| Alphanumeric characters | Allows numbers and letters, minus (-), period (.), underscore (\_) and spaces ( ). |
| Extended alphanumeric characters | Allows all characters except those that are normally encoded for security reasons (#/()&lt;=&gt;). |
| Date | Allows entries according to the global date format. |
| Time | Allows entries according to the global time format. |
| Date and time | Allows entries according to the global date and time format. |
| Telephone number | Allows numbers, plus (+), minus (-), slash (/), round brackets (()) and spaces ( ). |
| E-mail address | Allows you to enter a valid e-mail address. |
| URL format | Allows the entry of a valid URL. |

**Individual template:** Here you can overwrite the default template.

**HTML OutputThe**  
 form field generates the following HTML code:

```html
<input type="hidden" name="…" value="…">
```

## Security question

The form field `Sicherheitsfrage`adds a [CAPTCHA](https://de.wikipedia.org/wiki/Captcha) to the form.

A [honeypot](https://de.wikipedia.org/wiki/Honeypot) is used to trap and lock out spambots. The honeypot consists of several hidden fields that serve as bait. Normal users cannot see the fields and therefore do not change them - most spambots do. In addition, other factors are checked in the background to differentiate between users and spambots.

If it happens that a visitor is falsely identified as a spambot, he only has to solve the usual Contao calculation task. Submitted form data will not be lost under any circumstances.

**Placeholder:** This text is displayed as long as the field has not been filled in.

**CSS class:** Here you can enter one or more classes.

**Keyboard shortc**ut: With a keyboard shortcut a visitor can jump directly to a certain input field by pressing the `[Alt]`- or - `[Strg]`key in connection with the keyboard shortcut, e.g. a number[ (see backend keyboard shortcut](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab Index:** Here you can determine the position of the form field within the tab order.

**Individual template:** Here you can overwrite the standard template.

**HTML OutputThe**  
 form field generates the following HTML code:

```html
<div class="widget widget-captcha mandatory">
    <label for="ctrl">
        <span class="invisible">Pflichtfeld </span>…<span class="mandatory">*</span>
    </label>
    <input type="text" name="captcha" id="ctrl" class="captcha mandatory" value="" aria-describedby="captcha_text" placeholder="…" maxlength="2" required>
    <span id="captcha_text" class="captcha_text">…</span>
    <input type="hidden" name="captcha_hash" value="…">
    <div style="display:none">
        <label for="ctrl_hp">Füllen Sie dieses Feld nicht aus</label>
        <input type="text" name="captcha_name" id="ctrl_hp" value="">
    </div>
    <script>
        var e = document.getElementById('ctrl'),
            p = e.parentNode, f = p.parentNode;
        if ('fieldset' === f.nodeName.toLowerCase() && 1 === f.children.length) {
            p = f;
        }
        p.style.display = 'none';
        e.value = '…';
    </script>
</div>
```

## Submit field

The form field `Absendefeld`adds a button to the form to submit the form, which can be either a text button or a screen button.

**Name of the submit button:** Enter the text of the submit button or mouse-rollover text of the screen button here.

**Screen button:** Here you define the send field as a screen button.

**source file:** Here you select the image for the screen button.

**CSS class**: Here you can enter one or more classes.

**Keyboard shortc**ut: With a keyboard shortcut a visitor can jump directly to a certain input field by pressing the `[Alt]`- or - `[Strg]`key in connection with the keyboard shortcut, e.g. a number[ (see backend keyboard shortcut](../../administrationsbereich/backend-tastaturkuerzel/)).

**Tab Index:** Here you can determine the position of the form field within the tab order.

**Individual template**: Here you can overwrite the standard template.

  
**HTML OutputThe** form field generates the following HTML code:

```html
<div class="widget widget-submit">
    <button type="submit" id="ctrl" class="submit">…</button>
</div>
```

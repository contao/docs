---
title: "User modules"
description: "User modules are modules that are used in connection with the administration of front end users."
aliases:
    - /en/layout/module-management/user-modules/
weight: 20
---

<style>
    .formbody .invisible {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    .formbody {
        background: #f2f2f2;
        border: 1px solid #ddd;
        padding: 20px;
        min-width: 250px;
        width: 80%;
     }
     .formbody label {
         margin-bottom: 0.125rem;
     }
     .formbody .checkbox_container {
        border: none;
        margin: 0 0 20px 0;
        padding: 0;
     }
     .formbody .checkbox_container label {
        display: inline;
     }
     .formbody .error {
        color: #ff0000;
     }
     .formbody .submit {
        background: #f47c00;
        color: #fff;
        padding: 5px 10px;
     }
</style>

User modules are modules that are used in connection with the administration of front end users. This includes, for 
example, the registration of new members or the login/logout of existing members.


## Login form

The front end module "Login form" adds a form to the website, with which registered members can authenticate themselves.

**Front end output**

<div class="mod_login login block">
    <form action="#" id="tl_login" method="post">
        <div class="formbody">
            <div class="widget widget-text">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="text" value="" required>
            </div>
            <div class="widget widget-password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="text password" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span>
                        <input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> 
                        <label for="autologin">Remember me</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Login</button>
            </div>
        </div>
    </form>
</div>

As soon as a front end user is logged in, a logoff button is automatically displayed instead of the login form.

**Front end output**

<div class="mod_login logout block">
    <form action="#" id="tl_logout" method="post">
        <div class="formbody">
            <p class="login_info">
                 You are logged in as j.smith.<br>Your previous login was 2015-11-15 20:54. Welcome back!
            </p>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Logout</button>
            </div>
        </div>
    </form>
</div>

So when formatting CSS, consider both states of the module, and also remember that an error message may be output.

**Allow auto login:** If you select this option, members can remain logged in if they wish. If a user session expires, 
Contao will automatically create a new session without requiring you to enter the password again.

**Redirect page:** Here you can define to which page a member will be forwarded after successful registration. You can 
override this setting per user group to set up a group-specific redirection.

**Redirect to last page visited:** If you select this option, the front end user will be redirected to the last visited 
page instead of the redirection page.

**Module template:** Here you can overwrite the standard `mod_login` template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_login login block">

    <form action="/_contao/login" id="tl_login" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_login">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <input type="hidden" name="_target_path" value="…">
            <input type="hidden" name="_failure_path" value="…">
            <input type="hidden" name="_always_use_target_path" value="0">
            <div class="widget widget-text">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="text" value="" required>
            </div>
            <div class="widget widget-password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="text password" value="" required>
            </div>
            <div class="widget widget-checkbox">
                <fieldset class="checkbox_container">
                    <span>
                        <input type="checkbox" name="autologin" id="autologin" value="1" class="checkbox"> 
                        <label for="autologin">Remember me</label>
                    </span>
                </fieldset>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Login</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

After a member has logged in, the HTML code changes as follows:

```html
<!-- indexer::stop -->
<div class="mod_login logout block">

    <form action="/_contao/logout" id="tl_logout" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_logout">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <input type="hidden" name="_target_path" value="…">
            <p class="login_info">
                You are logged in as j.smith.<br>Your previous login was 2015-11-15 20:54. Welcome back!
            </p>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Logout</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Automatic logout

The front end module "Automatic logout" adds an invisible module to the website that automatically logs out a logged in 
front end user.

As soon as a member has logged in to the front end of the website, a logout link appears in the main menu on the right 
hand side, with which the member can log out again. In reality, these are two different pages in the page structure, 
which contain the login and the logout module.

**Redirect page:** Here you can define to which page a front end user will be forwarded after logging out.

**Redirect to last page visited:** If you select this option, the member will be redirected to the last page visited 
instead of the redirection page.

The module does not generate HTML output.


## Personal data

The front end module "Personal data" adds a form to the website, which allows a member to change his personal data such 
as his e-mail address or password. As an administrator, you can define exactly which fields can be edited and which 
cannot.

**Front end output `member_default`**

<div class="mod_personalData block">
    <form action="#" id="tl_member" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password">Password</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password_confirm" class="confirm">Confirmation</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Save data</button>
            </div>
        </div>
    </form>
</div>

**Front end output `member_grouped`**

<div class="mod_personalData block">
    <form action="#" id="tl_member" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personal data</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
            </fieldset>       
            <fieldset>
                <legend>Contact details</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Login details</legend>          
                <div class="widget widget-password">
                    <label for="ctrl_password">Password</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password__confirm" class="confirm">Confirmation</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </fieldset>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Save data</button>
            </div>
        </div>
    </form>
</div>

**Editable fields:** Here you can define the editable fields.

![Set editable fields](/de/layout/module-management/images/en/set-editable-fields.png?classes=shadow)

**Subscribable newsletters:** If you are using the Contao newsletter extension, you can define here which distribution 
lists a member can subscribe to.

**Redirect page:** Here you can choose to which page a member is forwarded to after submitting the changes.

**Form template:** Here you select the template of the form.

| Template | Explanation |
| -------- | ----------- |
| `member_default` | The editable fields are listed below each other. |
| `member_grouped` | The input fields are grouped using field sets. |

**The HTML Output**  
The front end module generated using the `member_default` following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_personalData block">

    <form action="…" id="tl_member" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
                <div class="widget widget-password">
                    <label for="ctrl_password">Password</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password_confirm" class="confirm">Confirmation</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Save data</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

The front end module generates with the `member_grouped` following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_personalData block">

    <form action="…" id="tl_member" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_member">
            <input type="hidden" name="REQUEST_TOKEN" value="…">

            <fieldset>
                <legend>Personal data</legend>
                <div class="widget widget-text">
                    <label for="ctrl_firstname">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text" value="John" required maxlength="255">
                </div>
                <div class="widget widget-text">
                    <label for="ctrl_lastname">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text" value="Smith" required maxlength="255">
                </div>
            </fieldset>

            <fieldset>
                <legend>Contact details</legend>
                <div class="widget widget-text">
                    <label for="ctrl_email">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text" value="j.smith@example.com" required maxlength="255">
                </div>
            </fieldset>

            <fieldset>
                <legend>Login details</legend>          
                <div class="widget widget-password">
                    <label for="ctrl_password">Password</label>
                    <input type="password" name="password" id="ctrl_password" class="text password" value="">
                </div>
                <div class="widget widget-password confirm">
                    <label for="ctrl_password__confirm" class="confirm">Confirmation</label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password" value="">
                </div>
            </fieldset>

            <div class="widget widget-submit">
                <button type="submit" class="submit">Save data</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Registration

The front end module "Registration" adds a form to the website, with which new members can register and, depending on 
the configuration, automatically receive a user account for the protected area.

**Front end output `member_default`**

<div class="mod_registration block">
    <form action="#" id="tl_registration" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Register</button>
            </div>
        </div>
    </form>
</div>

**Front end output `member_grouped`**

<div class="mod_registration block">
    <form action="#" id="tl_registration" method="post">
        <div class="formbody">
            <fieldset>
                <legend>Personal data</legend>              
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
            </fieldset>
            <fieldset>
                <legend>Contact details</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
             </fieldset>
             <fieldset>
                <legend>Login details</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
             </fieldset>           
            <div class="widget widget-submit">
                <button type="submit" class="submit">Register</button>
            </div>
        </div>
    </form>
</div>

**Editable fields:** Here you can define which fields a new member has to fill in during registration. To enable the 
login in the front end, you have to activate at least the fields username and password.

**Subscribable newsletters:** If you are using the Contao newsletter extension, you can define here which distribution 
lists a member can subscribe to.

**Disable spam protection:** Here you can disable the spam protection (not recommended). Since Contao 4.4, this 
question is only "displayed" to spambots. Without a security question it is possible that spammers automatically create 
user accounts and abuse your website.

**Member groups:** Here you define the group membership of the new member.

**Allow login:** If you select this option, a new member can log in after registering in the front end login. For this 
to work, the registration form must contain the fields username and password.

**Create a home directory:** If you select this option, a new user directory is automatically created in a folder of 
your choice during registration. The name of the new directory will be generated from the username.

**Redirect page:** Here you can define to which page a member will be forwarded after registration (e.g. to the page 
with the login form).

**Automation of member registration**

You can fully automate the registration process if you wish. A new member will then receive an e-mail with a 
confirmation link when registering, with which they can activate their account independently.

**Send activation e-mail:** Here you can switch on the automatic activation.

**Confirmation page:** Here you can define to which page a user is redirected after successful activation of his 
account (e.g. the login page).

**Activation message:** Enter the text of the activation mail here. You can use placeholders in the format `##key##` 
for all input fields of the registration form as well as the placeholders `##domain##` for the domain and `##link##` 
for the confirmation link.

Below is a short example:

```text
Dear ##firstname## ##lastname##,

Thank you very much for your registration on ##domain##.

Please click on the link to complete your registration and activate your account:

##link##

The confirmation link is valid for 24 hours.

If you have not requested access, please ignore this email.

Your administrator
```

**Form template:** Here you select the template of the form.

| Template | Declaration |
| -------- | ----------- |
| `member_default` | The input fields are listed one below the other. |
| `member_grouped` | The input fields are grouped using field sets. |

**The HTML Output**  
The front end module generates with the `member_default` following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_registration block">

    <form action="…" id="tl_registration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Register</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

The front end module generates using the `member_grouped` following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_registration block">

    <form action="…" id="tl_registration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_registration">
            <input type="hidden" name="REQUEST_TOKEN" value="…">

            <fieldset>
                <legend>Personal data</legend>              
                <div class="widget widget-text mandatory">
                    <label for="ctrl_firstname" class="mandatory">
                        <span class="invisible">Mandatory field </span>First name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="firstname" id="ctrl_firstname" class="text mandatory" value="" required maxlength="255">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_lastname" class="mandatory">
                        <span class="invisible">Mandatory field </span>Last Name<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="lastname" id="ctrl_lastname" class="text mandatory" value="" required maxlength="255">
                </div>
            </fieldset>

            <fieldset>
                <legend>Contact details</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
             </fieldset>

             <fieldset>
                <legend>Login details</legend>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
             </fieldset>

            <div class="widget widget-submit">
                <button type="submit" class="submit">Register</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Change password

The front end module "Change password" adds a form to the website that allows a logged in front end user to change his 
password.

**Front end output**

<div class="mod_changePassword block">
    <form action="#" id="tl_change_password" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_oldpassword" class="mandatory">
                        <span class="invisible">Mandatory field </span>Old password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>New password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Change password</button>
            </div>
        </div>
    </form>
</div>

**Redirect page:** Here you can select to which page a member will be forwarded after submitting the changes.

**Module template:** Here you can overwrite the default `mod_changePassword` template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_changePassword block">

    <form action="…" id="tl_change_password" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_change_password">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_oldpassword" class="mandatory">
                        <span class="invisible">Mandatory field </span>Old password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="oldpassword" id="ctrl_oldpassword" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>New password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
                <div class="widget widget-password confirm mandatory">
                    <label for="ctrl_password_confirm" class="confirm mandatory">
                        <span class="invisible">Mandatory field </span>Confirmation<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password_confirm" id="ctrl_password_confirm" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Change password</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Lost password

The front end module "Lost password" adds a form to the website that a member can use to request a new password. Contao 
sends an automatic e-mail with a confirmation link to the e-mail address stored in the user account. Only after 
clicking on this confirmation link is it possible to enter a new password.

**Front end output**

<div class="mod_lostPassword block">
    <form action="#" id="tl_lost_password" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Request a new password</button>
            </div>
        </div>
    </form>
</div>

**Skip username:** If you select this option, the username will not be queried when you request it.

**Disable spam protection:** Here you can disable the spam protection (not recommended). Since Contao 4.4, this 
question is only "displayed" to spambots. Without a security question it is possible that spammers automatically 
create user accounts and abuse your website.

**Redirect page:** Here you can define to which page a user is forwarded after requesting a new password.

**Confirmation page:** Here you can define to which page a user will be redirected after a new password has been 
successfully created.

**Password message:** Enter the text of the confirmation mail here. You can use placeholders in the format `##key##` 
for all user properties as well as the placeholders `##domain##` for the current domain and `##link##` for the 
confirmation link.

For example, a confirmation mail could look like this:

```text
Dear ##firstname## ##lastname##,

You have requested a new password for ##domain##.

Please click on the link to set the new password:

##link##

If you have not requested this email, please contact the website administrator.

Your administrator
```

**Module template:** Here you can overwrite the default `mod_lostPassword` template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_lostPassword block">

    <form action="…" id="tl_lost_password" method="post">
        <div class="formbody">
        <input type="hidden" name="FORM_SUBMIT" value="tl_lost_password">
        <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_username" class="mandatory">
                        <span class="invisible">Mandatory field </span>Username<span class="mandatory">*</span>
                    </label>
                    <input type="text" name="username" id="ctrl_username" class="text mandatory" value="" required maxlength="64">
                </div>
                <div class="widget widget-text mandatory">
                    <label for="ctrl_email" class="mandatory">
                        <span class="invisible">Mandatory field </span>E-mail address<span class="mandatory">*</span>
                    </label>
                    <input type="email" name="email" id="ctrl_email" class="text mandatory" value="" required maxlength="255">
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Request a new password</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Close account

The front end module "Close account" adds a form to the website, which a member can use to close his account. Depending 
on the configuration, the account is either deactivated or completely deleted from the database.

**Front end output**

<div class="mod_closeAccount block">
    <form action="#" id="tl_close_account" method="post">
        <div class="formbody">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Close account</button>
            </div>
        </div>
    </form>
</div>

**Mode:** Here you can specify whether the account should be deactivated or completely deleted from the database when 
the form is submitted.

**Redirect page:** Here you define to which page a member will be forwarded after account closure. The target page must 
not be protected.

**Module template:** Here you can overwrite the default `mod_closeAccount` template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_closeAccount block">

    <form action="…" id="tl_close_account" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_close_account">
            <input type="hidden" name="REQUEST_TOKEN" value="…">
            <div class="fields">
                <div class="widget widget-text mandatory">
                    <label for="ctrl_password" class="mandatory">
                        <span class="invisible">Mandatory field </span>Password<span class="mandatory">*</span>
                    </label>
                    <input type="password" name="password" id="ctrl_password" class="text password mandatory" value="" required>
                </div>
            </div>
            <div class="widget widget-submit">
                <button type="submit" class="submit">Close account</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```


## Two-factor authentication

{{< version "4.8" >}}

The "Two-factor authentication" front end module adds a form to the website that a member can use to enable two-factor 
authentication. If the two-factor authentication for members is forced, this module must be used on the page structure 
described in [Further settings for starting points](/en/layout/site-structure/configure-pages/#further-settings-for-starting-points) 
can be added to the selected two-factor forwarding page.

**Front end output**

<div class="mod_two_factor two-factor block"> 
    <form action="#" class="tl_two_factor_form" method="post">
        <div class="formbody">
            <p class="error">Please enable two-factor authentication before you proceed.</p>
            <p>Please scan the QR Code with your 2FA/TOTP app.</p>
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjE4MCIgaGVpZ2h0PSIxODAiIHZpZXdCb3g9IjAgMCAxODAgMTgwIj48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTgwIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2ZlZmVmZSIvPjxnIHRyYW5zZm9ybT0ic2NhbGUoMi43NjkpIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDApIj48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04IDBMOCAxTDEwIDFMMTAgMkw4IDJMOCA1TDEwIDVMMTAgNEwxMSA0TDExIDZMMTAgNkwxMCA3TDkgN0w5IDZMOCA2TDggN0w5IDdMOSA4TDggOEw4IDEwTDYgMTBMNiAxMUw1IDExTDUgOUw0IDlMNCA4TDAgOEwwIDlMMSA5TDEgMTBMMCAxMEwwIDExTDEgMTFMMSAxMEwyIDEwTDIgMTJMMCAxMkwwIDE0TDIgMTRMMiAxNkwxIDE2TDEgMTdMMiAxN0wyIDE2TDMgMTZMMyAxN0w0IDE3TDQgMTlMMyAxOUwzIDIwTDUgMjBMNSAyMUw0IDIxTDQgMjJMMyAyMkwzIDIzTDIgMjNMMiAxOUwwIDE5TDAgMjFMMSAyMUwxIDIyTDAgMjJMMCAyM0wxIDIzTDEgMjRMMCAyNEwwIDI5TDEgMjlMMSAzMEwyIDMwTDIgMzFMMyAzMUwzIDMzTDIgMzNMMiAzMkwxIDMyTDEgMzFMMCAzMUwwIDMyTDEgMzJMMSAzNEwwIDM0TDAgMzZMMSAzNkwxIDM4TDIgMzhMMiAzN0w0IDM3TDQgMzlMMyAzOUwzIDQwTDIgNDBMMiA0MUwzIDQxTDMgNDJMMiA0MkwyIDQ0TDEgNDRMMSA0M0wwIDQzTDAgNDdMMSA0N0wxIDUwTDQgNTBMNCA1MUwyIDUxTDIgNTJMMyA1MkwzIDUzTDEgNTNMMSA1NEwyIDU0TDIgNTVMMyA1NUwzIDU2TDEgNTZMMSA1NUwwIDU1TDAgNTZMMSA1NkwxIDU3TDMgNTdMMyA1Nkw0IDU2TDQgNTdMNSA1N0w1IDU2TDQgNTZMNCA1NEw1IDU0TDUgNTVMNyA1NUw3IDU2TDYgNTZMNiA1N0w3IDU3TDcgNTZMOSA1Nkw5IDU3TDggNTdMOCA1OEw5IDU4TDkgNjBMMTAgNjBMMTAgNjFMMTEgNjFMMTEgNjJMMTIgNjJMMTIgNjBMMTAgNjBMMTAgNTlMMTEgNTlMMTEgNThMOSA1OEw5IDU3TDEwIDU3TDEwIDU1TDExIDU1TDExIDU3TDE0IDU3TDE0IDU5TDEzIDU5TDEzIDYwTDE0IDYwTDE0IDU5TDE2IDU5TDE2IDYwTDE3IDYwTDE3IDYxTDIwIDYxTDIwIDYyTDIxIDYyTDIxIDY0TDIwIDY0TDIwIDY1TDIyIDY1TDIyIDY0TDIzIDY0TDIzIDYzTDI0IDYzTDI0IDY0TDI1IDY0TDI1IDY1TDI3IDY1TDI3IDY0TDI4IDY0TDI4IDYzTDI5IDYzTDI5IDY0TDMwIDY0TDMwIDYxTDMxIDYxTDMxIDYyTDMyIDYyTDMyIDYxTDMzIDYxTDMzIDYyTDM1IDYyTDM1IDYxTDM2IDYxTDM2IDYyTDM3IDYyTDM3IDY1TDM4IDY1TDM4IDY0TDM5IDY0TDM5IDYzTDQwIDYzTDQwIDY0TDQzIDY0TDQzIDY1TDQ1IDY1TDQ1IDYyTDQ2IDYyTDQ2IDYzTDQ3IDYzTDQ3IDY0TDQ4IDY0TDQ4IDYyTDQ2IDYyTDQ2IDYxTDQ3IDYxTDQ3IDYwTDQ4IDYwTDQ4IDYxTDQ5IDYxTDQ5IDYzTDUwIDYzTDUwIDYyTDUxIDYyTDUxIDY1TDUyIDY1TDUyIDYzTDUzIDYzTDUzIDY1TDU0IDY1TDU0IDY0TDU1IDY0TDU1IDY1TDU5IDY1TDU5IDY0TDYxIDY0TDYxIDY1TDYyIDY1TDYyIDY0TDYxIDY0TDYxIDYzTDYwIDYzTDYwIDYyTDYyIDYyTDYyIDYzTDYzIDYzTDYzIDY1TDY0IDY1TDY0IDYzTDY1IDYzTDY1IDYyTDY0IDYyTDY0IDYzTDYzIDYzTDYzIDYxTDY0IDYxTDY0IDU4TDY1IDU4TDY1IDU2TDY0IDU2TDY0IDUzTDYzIDUzTDYzIDU1TDYyIDU1TDYyIDU0TDYwIDU0TDYwIDUzTDU5IDUzTDU5IDUyTDYwIDUyTDYwIDUwTDU5IDUwTDU5IDQ5TDYyIDQ5TDYyIDUwTDYzIDUwTDYzIDUxTDY0IDUxTDY0IDUyTDY1IDUyTDY1IDUwTDYzIDUwTDYzIDQ5TDY0IDQ5TDY0IDQ4TDY1IDQ4TDY1IDQ3TDY0IDQ3TDY0IDQ2TDYyIDQ2TDYyIDQ1TDYwIDQ1TDYwIDQ0TDU1IDQ0TDU1IDQ1TDU0IDQ1TDU0IDQzTDU3IDQzTDU3IDQyTDYwIDQyTDYwIDQzTDYxIDQzTDYxIDQ0TDYzIDQ0TDYzIDQyTDYyIDQyTDYyIDQzTDYxIDQzTDYxIDQyTDYwIDQyTDYwIDQxTDYxIDQxTDYxIDQwTDYyIDQwTDYyIDQxTDYzIDQxTDYzIDQwTDYyIDQwTDYyIDM5TDU5IDM5TDU5IDM3TDYxIDM3TDYxIDM2TDU5IDM2TDU5IDM3TDU4IDM3TDU4IDM4TDUzIDM4TDUzIDM3TDUyIDM3TDUyIDM4TDUzIDM4TDUzIDM5TDU1IDM5TDU1IDQwTDUzIDQwTDUzIDQxTDUyIDQxTDUyIDQwTDUwIDQwTDUwIDM4TDUxIDM4TDUxIDM2TDUwIDM2TDUwIDM1TDQ5IDM1TDQ5IDM2TDQ2IDM2TDQ2IDM1TDQ3IDM1TDQ3IDM0TDUwIDM0TDUwIDMzTDUyIDMzTDUyIDM0TDUxIDM0TDUxIDM1TDUyIDM1TDUyIDM2TDUzIDM2TDUzIDM1TDU0IDM1TDU0IDM3TDU1IDM3TDU1IDM2TDU2IDM2TDU2IDM3TDU3IDM3TDU3IDM1TDYxIDM1TDYxIDMzTDYyIDMzTDYyIDMyTDYzIDMyTDYzIDMwTDYyIDMwTDYyIDI5TDY0IDI5TDY0IDI4TDYyIDI4TDYyIDI3TDY1IDI3TDY1IDI0TDYzIDI0TDYzIDI1TDYyIDI1TDYyIDI0TDYxIDI0TDYxIDIzTDY0IDIzTDY0IDIyTDYzIDIyTDYzIDE5TDYxIDE5TDYxIDE3TDU4IDE3TDU4IDE1TDU3IDE1TDU3IDEzTDU5IDEzTDU5IDE0TDYwIDE0TDYwIDE1TDU5IDE1TDU5IDE2TDYyIDE2TDYyIDE3TDY0IDE3TDY0IDE4TDY1IDE4TDY1IDEzTDYzIDEzTDYzIDEyTDYyIDEyTDYyIDExTDYzIDExTDYzIDEwTDYyIDEwTDYyIDExTDYxIDExTDYxIDEyTDU3IDEyTDU3IDExTDU2IDExTDU2IDEyTDU1IDEyTDU1IDExTDU0IDExTDU0IDEyTDUzIDEyTDUzIDExTDUyIDExTDUyIDEwTDUxIDEwTDUxIDExTDUyIDExTDUyIDEyTDUzIDEyTDUzIDEzTDUwIDEzTDUwIDEwTDQ4IDEwTDQ4IDdMNDkgN0w0OSA5TDUzIDlMNTMgMTBMNTYgMTBMNTYgOEw1NyA4TDU3IDlMNTggOUw1OCA4TDU3IDhMNTcgNkw1NiA2TDU2IDhMNTUgOEw1NSA1TDU0IDVMNTQgN0w1MyA3TDUzIDVMNTIgNUw1MiA0TDUwIDRMNTAgMkw1MSAyTDUxIDNMNTMgM0w1MyAyTDU0IDJMNTQgNEw1NiA0TDU2IDVMNTcgNUw1NyA0TDU2IDRMNTYgM0w1NyAzTDU3IDFMNTYgMUw1NiAwTDU1IDBMNTUgMUw1NiAxTDU2IDNMNTUgM0w1NSAyTDU0IDJMNTQgMUw1MyAxTDUzIDBMNTIgMEw1MiAxTDUwIDFMNTAgMEw0OSAwTDQ5IDFMNTAgMUw1MCAyTDQ5IDJMNDkgM0w0OCAzTDQ4IDFMNDYgMUw0NiAwTDQ1IDBMNDUgMUw0NCAxTDQ0IDBMNDIgMEw0MiAxTDQxIDFMNDEgMEw0MCAwTDQwIDFMMzkgMUwzOSAyTDM4IDJMMzggMEwzNyAwTDM3IDFMMzYgMUwzNiAwTDM1IDBMMzUgMUwzNCAxTDM0IDBMMzMgMEwzMyAxTDMyIDFMMzIgMEwzMCAwTDMwIDJMMzEgMkwzMSA0TDI5IDRMMjkgNUwzMCA1TDMwIDhMMjggOEwyOCA5TDI5IDlMMjkgMTBMMjggMTBMMjggMTJMMjcgMTJMMjcgMTFMMjUgMTFMMjUgMTBMMjcgMTBMMjcgOUwyNSA5TDI1IDhMMTkgOEwxOSA2TDE4IDZMMTggOEwxNyA4TDE3IDZMMTYgNkwxNiA3TDE1IDdMMTUgNkwxNCA2TDE0IDdMMTUgN0wxNSA4TDE2IDhMMTYgOUwxNCA5TDE0IDhMMTMgOEwxMyA2TDEyIDZMMTIgNUwxNCA1TDE0IDRMMTYgNEwxNiAzTDE1IDNMMTUgMkwxNyAyTDE3IDNMMTggM0wxOCA0TDE5IDRMMTkgNUwyMSA1TDIxIDZMMjAgNkwyMCA3TDIxIDdMMjEgNkwyMiA2TDIyIDdMMjMgN0wyMyA1TDI0IDVMMjQgMUwyNSAxTDI1IDBMMjMgMEwyMyAyTDIxIDJMMjEgNEwyMCA0TDIwIDNMMTggM0wxOCAxTDIwIDFMMjAgMEwxNyAwTDE3IDFMMTYgMUwxNiAwTDE0IDBMMTQgMUwxMiAxTDEyIDBMMTEgMEwxMSAxTDEwIDFMMTAgMFpNMjEgMEwyMSAxTDIyIDFMMjIgMFpNMjYgMUwyNiAyTDI3IDJMMjcgNEwyNSA0TDI1IDVMMjcgNUwyNyA2TDI2IDZMMjYgN0wyNyA3TDI3IDZMMjggNkwyOCA3TDI5IDdMMjkgNkwyOCA2TDI4IDNMMjkgM0wyOSAxWk0zNSAxTDM1IDJMMzMgMkwzMyAzTDMyIDNMMzIgNEwzMyA0TDMzIDNMMzQgM0wzNCA0TDM1IDRMMzUgN0wzNiA3TDM2IDlMMzMgOUwzMyAxMkwzMiAxMkwzMiAxMEwzMSAxMEwzMSAxMUwzMCAxMUwzMCAxMkwyOCAxMkwyOCAxM0wzMCAxM0wzMCAxNUwzMSAxNUwzMSAxNEwzMiAxNEwzMiAxM0wzNCAxM0wzNCAxNEwzMyAxNEwzMyAxNUwzNCAxNUwzNCAxNEwzNSAxNEwzNSAxMkwzNiAxMkwzNiAxMUwzNyAxMUwzNyAxM0wzNiAxM0wzNiAxNUwzNSAxNUwzNSAxN0wzNiAxN0wzNiAxOEwzMyAxOEwzMyAxN0wzNCAxN0wzNCAxNkwzMyAxNkwzMyAxN0wzMiAxN0wzMiAxNkwzMSAxNkwzMSAxN0wyOSAxN0wyOSAxOEwzMCAxOEwzMCAxOUwyNSAxOUwyNSAxOEwyNiAxOEwyNiAxNkwyOCAxNkwyOCAxNUwyOSAxNUwyOSAxNEwyNyAxNEwyNyAxMkwyNSAxMkwyNSAxM0wyNiAxM0wyNiAxNEwyNyAxNEwyNyAxNUwyNCAxNUwyNCAxMkwyMyAxMkwyMyAxMEwyMiAxMEwyMiAxMkwyMCAxMkwyMCAxMUwyMSAxMUwyMSA5TDIwIDlMMjAgMTFMMTkgMTFMMTkgOEwxOCA4TDE4IDlMMTcgOUwxNyAxMEwxOCAxMEwxOCAxMkwxOSAxMkwxOSAxM0wxNyAxM0wxNyAxMUwxNiAxMUwxNiAxMEwxNSAxMEwxNSAxMUwxNCAxMUwxNCA5TDEzIDlMMTMgMTBMMTIgMTBMMTIgNkwxMSA2TDExIDdMMTAgN0wxMCA5TDkgOUw5IDEwTDggMTBMOCAxMUw2IDExTDYgMTJMNyAxMkw3IDEzTDMgMTNMMyAxMkwyIDEyTDIgMTRMNCAxNEw0IDE2TDUgMTZMNSAxNEw3IDE0TDcgMTNMOCAxM0w4IDEyTDEwIDEyTDEwIDE0TDggMTRMOCAxNUwxMCAxNUwxMCAxNEwxMSAxNEwxMSAxM0wxMiAxM0wxMiAxNEwxMyAxNEwxMyAxNUwxNCAxNUwxNCAxM0wxNSAxM0wxNSAxMkwxNiAxMkwxNiAxNEwxNSAxNEwxNSAxNkwxMiAxNkwxMiAxN0wxNSAxN0wxNSAxNkwxNiAxNkwxNiAxOEwxMiAxOEwxMiAxOUwxMyAxOUwxMyAyMEwxNCAyMEwxNCAyMUwxNSAyMUwxNSAyM0wxNCAyM0wxNCAyMkwxMyAyMkwxMyAyMUwxMiAyMUwxMiAyMkw5IDIyTDkgMjFMMTEgMjFMMTEgMjBMOSAyMEw5IDE5TDExIDE5TDExIDE4TDEwIDE4TDEwIDE3TDExIDE3TDExIDE2TDkgMTZMOSAxN0w4IDE3TDggMThMOSAxOEw5IDE5TDYgMTlMNiAxOEw3IDE4TDcgMTdMNSAxN0w1IDE5TDYgMTlMNiAyMEw3IDIwTDcgMjFMNSAyMUw1IDIyTDcgMjJMNyAyM0w1IDIzTDUgMjRMNCAyNEw0IDIzTDMgMjNMMyAyNEwyIDI0TDIgMjVMMSAyNUwxIDI2TDIgMjZMMiAyN0wxIDI3TDEgMjhMMiAyOEwyIDI3TDMgMjdMMyAyOEw0IDI4TDQgMzBMOCAzMEw4IDI4TDkgMjhMOSAyN0wxMCAyN0wxMCAyNkw5IDI2TDkgMjdMNiAyN0w2IDI2TDcgMjZMNyAyNUw2IDI1TDYgMjRMNyAyNEw3IDIzTDggMjNMOCAyNUwxMSAyNUwxMSAyM0wxMiAyM0wxMiAyNEwxMyAyNEwxMyAyNUwxMiAyNUwxMiAyNkwxNSAyNkwxNSAyN0wxMyAyN0wxMyAyOUwxNSAyOUwxNSAzMEwxMyAzMEwxMyAzMUwxMiAzMUwxMiAzMkwxMSAzMkwxMSAzM0wxMiAzM0wxMiAzMkwxNCAzMkwxNCAzMUwxNSAzMUwxNSAzMkwxNyAzMkwxNyAzMUwxOCAzMUwxOCAzM0wxOSAzM0wxOSAzMkwyMCAzMkwyMCAzNUwyMyAzNUwyMyAzNkwyMiAzNkwyMiAzOUwyMCAzOUwyMCA0MEwxOCA0MEwxOCAzOUwxNyAzOUwxNyAzOEwxOSAzOEwxOSAzN0wxOCAzN0wxOCAzNkwxOSAzNkwxOSAzNEwxOCAzNEwxOCAzNkwxNyAzNkwxNyAzM0wxNSAzM0wxNSAzNUwxNCAzNUwxNCAzNEwxMyAzNEwxMyAzNUwxNCAzNUwxNCAzNkwxMiAzNkwxMiAzOEwxMSAzOEwxMSAzNEwxMCAzNEwxMCAzMkw5IDMyTDkgMzZMOCAzNkw4IDM1TDYgMzVMNiAzNkw3IDM2TDcgMzdMNiAzN0w2IDM4TDggMzhMOCAzN0w5IDM3TDkgNDBMMTAgNDBMMTAgNDFMMTIgNDFMMTIgNDJMMTEgNDJMMTEgNDNMMTMgNDNMMTMgNDRMMTQgNDRMMTQgNDVMMTMgNDVMMTMgNDZMMTEgNDZMMTEgNDdMMTAgNDdMMTAgNDhMOCA0OEw4IDQ3TDkgNDdMOSA0NUwxMSA0NUwxMSA0NEwxMCA0NEwxMCA0Mkw5IDQyTDkgNDFMOCA0MUw4IDM5TDUgMzlMNSA0MEwzIDQwTDMgNDFMNCA0MUw0IDQ0TDUgNDRMNSA0Nkw0IDQ2TDQgNDVMMyA0NUwzIDQ2TDIgNDZMMiA0OEwzIDQ4TDMgNDlMNSA0OUw1IDUxTDYgNTFMNiA1Mkw4IDUyTDggNTFMNiA1MUw2IDUwTDggNTBMOCA0OUwxMSA0OUwxMSA0OEwxMiA0OEwxMiA1MEwxMSA1MEwxMSA1MUwxNCA1MUwxNCA1MkwxMyA1MkwxMyA1M0wxNCA1M0wxNCA1MkwxNyA1MkwxNyA1NEwxOCA1NEwxOCA1NUwxNSA1NUwxNSA1NkwxNCA1NkwxNCA1NEwxMiA1NEwxMiA1MkwxMCA1MkwxMCA1NEw5IDU0TDkgNTNMOCA1M0w4IDU0TDcgNTRMNyA1M0w2IDUzTDYgNTRMNyA1NEw3IDU1TDggNTVMOCA1NEw5IDU0TDkgNTVMMTAgNTVMMTAgNTRMMTEgNTRMMTEgNTVMMTIgNTVMMTIgNTZMMTQgNTZMMTQgNTdMMTUgNTdMMTUgNThMMTcgNThMMTcgNTlMMjAgNTlMMjAgNThMMjEgNThMMjEgNTlMMjIgNTlMMjIgNTZMMjMgNTZMMjMgNTdMMjQgNTdMMjQgNTZMMjUgNTZMMjUgNTVMMjQgNTVMMjQgNTRMMjUgNTRMMjUgNTNMMjQgNTNMMjQgNTBMMjUgNTBMMjUgNTJMMjYgNTJMMjYgNTdMMjUgNTdMMjUgNTlMMjYgNTlMMjYgNjFMMjcgNjFMMjcgNjJMMjUgNjJMMjUgNjFMMjQgNjFMMjQgNjNMMjUgNjNMMjUgNjRMMjcgNjRMMjcgNjJMMjkgNjJMMjkgNjBMMzAgNjBMMzAgNTlMMjkgNTlMMjkgNjBMMjggNjBMMjggNThMMjkgNThMMjkgNTdMMjggNTdMMjggNTZMMjkgNTZMMjkgNTRMMzAgNTRMMzAgNTNMMjkgNTNMMjkgNTJMMzAgNTJMMzAgNTBMMzEgNTBMMzEgNDhMMzIgNDhMMzIgNDlMMzQgNDlMMzQgNTBMMzUgNTBMMzUgNDdMMzYgNDdMMzYgNDZMMzUgNDZMMzUgNDRMMzQgNDRMMzQgNDNMMzUgNDNMMzUgNDJMMzcgNDJMMzcgNDRMMzYgNDRMMzYgNDVMMzcgNDVMMzcgNDZMMzggNDZMMzggNDhMMzkgNDhMMzkgNTFMNDAgNTFMNDAgNTNMMzkgNTNMMzkgNTJMMzUgNTJMMzUgNTFMMzQgNTFMMzQgNTJMMzUgNTJMMzUgNTNMMzQgNTNMMzQgNTRMMzMgNTRMMzMgNTNMMzEgNTNMMzEgNTVMMzIgNTVMMzIgNTRMMzMgNTRMMzMgNTVMMzQgNTVMMzQgNTZMMzYgNTZMMzYgNTdMMzcgNTdMMzcgNTRMNDAgNTRMNDAgNTNMNDEgNTNMNDEgNTFMNDIgNTFMNDIgNTJMNDUgNTJMNDUgNTBMNDQgNTBMNDQgNDlMNDUgNDlMNDUgNDhMNDMgNDhMNDMgNDZMNDQgNDZMNDQgNDdMNDUgNDdMNDUgNDZMNDYgNDZMNDYgNDdMNDcgNDdMNDcgNDZMNDggNDZMNDggNDdMNTAgNDdMNTAgNDZMNTEgNDZMNTEgNDhMNTAgNDhMNTAgNDlMNTEgNDlMNTEgNTFMNTAgNTFMNTAgNTBMNDggNTBMNDggNDlMNDcgNDlMNDcgNDhMNDYgNDhMNDYgNTJMNDcgNTJMNDcgNTFMNDggNTFMNDggNTNMNDcgNTNMNDcgNTVMNDggNTVMNDggNThMNDcgNThMNDcgNTZMNDYgNTZMNDYgNTVMNDQgNTVMNDQgNTdMNDUgNTdMNDUgNjBMNDQgNjBMNDQgNjJMNDMgNjJMNDMgNjBMNDIgNjBMNDIgNTlMNDMgNTlMNDMgNThMNDEgNThMNDEgNTdMMzggNTdMMzggNThMNDAgNThMNDAgNTlMMzcgNTlMMzcgNThMMzYgNThMMzYgNTlMMzUgNTlMMzUgNjBMMzYgNjBMMzYgNTlMMzcgNTlMMzcgNjBMMzggNjBMMzggNjFMMzkgNjFMMzkgNjJMMzggNjJMMzggNjNMMzkgNjNMMzkgNjJMNDAgNjJMNDAgNjNMNDQgNjNMNDQgNjJMNDUgNjJMNDUgNjBMNDYgNjBMNDYgNTlMNDkgNTlMNDkgNTdMNTAgNTdMNTAgNThMNTIgNThMNTIgNjBMNTEgNjBMNTEgNTlMNTAgNTlMNTAgNjFMNTEgNjFMNTEgNjJMNTMgNjJMNTMgNjNMNTUgNjNMNTUgNjRMNTcgNjRMNTcgNjNMNTggNjNMNTggNjRMNTkgNjRMNTkgNjNMNTggNjNMNTggNjJMNjAgNjJMNjAgNjFMNTggNjFMNTggNjJMNTcgNjJMNTcgNjFMNTYgNjFMNTYgNTdMNTUgNTdMNTUgNTZMNTMgNTZMNTMgNTFMNTUgNTFMNTUgNTBMNTcgNTBMNTcgNDlMNTggNDlMNTggNDhMNTUgNDhMNTUgNDlMNTMgNDlMNTMgNDhMNTQgNDhMNTQgNDdMNTYgNDdMNTYgNDZMNTggNDZMNTggNDdMNjAgNDdMNjAgNDhMNjIgNDhMNjIgNDlMNjMgNDlMNjMgNDdMNjEgNDdMNjEgNDZMNTkgNDZMNTkgNDVMNTYgNDVMNTYgNDZMNTMgNDZMNTMgNDVMNTIgNDVMNTIgNDNMNTQgNDNMNTQgNDJMNTYgNDJMNTYgNDFMNTcgNDFMNTcgNDBMNTUgNDBMNTUgNDFMNTQgNDFMNTQgNDJMNTIgNDJMNTIgNDNMNTEgNDNMNTEgNDVMNTAgNDVMNTAgNDZMNDkgNDZMNDkgNDBMNDggNDBMNDggMzlMNDkgMzlMNDkgMzhMNDggMzhMNDggMzlMNDcgMzlMNDcgMzdMNDYgMzdMNDYgMzhMNDUgMzhMNDUgMzlMNDIgMzlMNDIgMzhMNDMgMzhMNDMgMzdMNDIgMzdMNDIgMzVMNDMgMzVMNDMgMzZMNDQgMzZMNDQgMzdMNDUgMzdMNDUgMzVMNDMgMzVMNDMgMzRMNDIgMzRMNDIgMzVMNDEgMzVMNDEgMzRMNDAgMzRMNDAgMzVMNDEgMzVMNDEgMzZMMzkgMzZMMzkgMzlMMzggMzlMMzggNDBMMzkgNDBMMzkgNDFMMzcgNDFMMzcgNDBMMzUgNDBMMzUgMzlMMzcgMzlMMzcgMzhMMzggMzhMMzggMzZMMzcgMzZMMzcgMzVMMzkgMzVMMzkgMzNMMzggMzNMMzggMzRMMzYgMzRMMzYgMzNMMzcgMzNMMzcgMzJMMzYgMzJMMzYgMzNMMzUgMzNMMzUgMzVMMzYgMzVMMzYgMzZMMzcgMzZMMzcgMzhMMzYgMzhMMzYgMzdMMzUgMzdMMzUgMzZMMzQgMzZMMzQgMzdMMzUgMzdMMzUgMzlMMzQgMzlMMzQgNDBMMzMgNDBMMzMgMzlMMzEgMzlMMzEgMzhMMzAgMzhMMzAgMzlMMjkgMzlMMjkgNDJMMzAgNDJMMzAgNDFMMzEgNDFMMzEgNDNMMzMgNDNMMzMgNDVMMzIgNDVMMzIgNDZMMzEgNDZMMzEgNDhMMzAgNDhMMzAgNDlMMjkgNDlMMjkgNDdMMjggNDdMMjggNDRMMzAgNDRMMzAgNDVMMjkgNDVMMjkgNDZMMzAgNDZMMzAgNDVMMzEgNDVMMzEgNDRMMzAgNDRMMzAgNDNMMjggNDNMMjggNDRMMjYgNDRMMjYgNDNMMjcgNDNMMjcgNDJMMjggNDJMMjggNDBMMjcgNDBMMjcgNDJMMjYgNDJMMjYgNDFMMjQgNDFMMjQgNDRMMjMgNDRMMjMgNDNMMjAgNDNMMjAgNDJMMjEgNDJMMjEgNDFMMjIgNDFMMjIgNDJMMjMgNDJMMjMgNDBMMjQgNDBMMjQgMzhMMjUgMzhMMjUgMzlMMjcgMzlMMjcgMzhMMjUgMzhMMjUgMzdMMjggMzdMMjggMzhMMjkgMzhMMjkgMzdMMzAgMzdMMzAgMzZMMzEgMzZMMzEgMzdMMzMgMzdMMzMgMzVMMjkgMzVMMjkgMzZMMjggMzZMMjggMzRMMzAgMzRMMzAgMzJMMjkgMzJMMjkgMzFMMzAgMzFMMzAgMzBMMjggMzBMMjggMjlMMzEgMjlMMzEgMzBMMzMgMzBMMzMgMjlMMzYgMjlMMzYgMzBMMzUgMzBMMzUgMzFMMzcgMzFMMzcgMzBMMzggMzBMMzggMzJMMzkgMzJMMzkgMjlMMzggMjlMMzggMjhMMzkgMjhMMzkgMjZMMzggMjZMMzggMjdMMzcgMjdMMzcgMjVMMzggMjVMMzggMjRMMzcgMjRMMzcgMjNMMzkgMjNMMzkgMjVMNDEgMjVMNDEgMjZMNDIgMjZMNDIgMjdMNDMgMjdMNDMgMjhMNDAgMjhMNDAgMzFMNDIgMzFMNDIgMzJMNDEgMzJMNDEgMzNMNDIgMzNMNDIgMzJMNDMgMzJMNDMgMzFMNDIgMzFMNDIgMzBMNDMgMzBMNDMgMjhMNDQgMjhMNDQgMjZMNDUgMjZMNDUgMjhMNDYgMjhMNDYgMjlMNDcgMjlMNDcgMzBMNDYgMzBMNDYgMzFMNDUgMzFMNDUgMjlMNDQgMjlMNDQgMzRMNDcgMzRMNDcgMzNMNDYgMzNMNDYgMzFMNDcgMzFMNDcgMzBMNDggMzBMNDggMjlMNDkgMjlMNDkgMjhMNTAgMjhMNTAgMzBMNTEgMzBMNTEgMzJMNTMgMzJMNTMgMzNMNTQgMzNMNTQgMzJMNTMgMzJMNTMgMzFMNTQgMzFMNTQgMzBMNTggMzBMNTggMjlMNTYgMjlMNTYgMjhMNTggMjhMNTggMjZMNTkgMjZMNTkgMjlMNjEgMjlMNjEgMjhMNjAgMjhMNjAgMjdMNjEgMjdMNjEgMjZMNjAgMjZMNjAgMjRMNTkgMjRMNTkgMjJMNjAgMjJMNjAgMjFMNjIgMjFMNjIgMjBMNjAgMjBMNjAgMTlMNTkgMTlMNTkgMThMNTggMThMNTggMjBMNTcgMjBMNTcgMjFMNTYgMjFMNTYgMjBMNTUgMjBMNTUgMjFMNTYgMjFMNTYgMjJMNTUgMjJMNTUgMjNMNTMgMjNMNTMgMjRMNTEgMjRMNTEgMjNMNTIgMjNMNTIgMjJMNTEgMjJMNTEgMjFMNTIgMjFMNTIgMjBMNDkgMjBMNDkgMTlMNTAgMTlMNTAgMThMNTMgMThMNTMgMTdMNTQgMTdMNTQgMThMNTUgMThMNTUgMTlMNTcgMTlMNTcgMTdMNTYgMTdMNTYgMTZMNTcgMTZMNTcgMTVMNTUgMTVMNTUgMTNMNTMgMTNMNTMgMTVMNTIgMTVMNTIgMTRMNTEgMTRMNTEgMTVMNTIgMTVMNTIgMTdMNTAgMTdMNTAgMThMNDkgMThMNDkgMTZMNTAgMTZMNTAgMTNMNDkgMTNMNDkgMTRMNDggMTRMNDggMTNMNDcgMTNMNDcgOUw0NSA5TDQ1IDhMNDYgOEw0NiA2TDQ3IDZMNDcgN0w0OCA3TDQ4IDZMNDkgNkw0OSA3TDUwIDdMNTAgOEw1MyA4TDUzIDlMNTQgOUw1NCA4TDUzIDhMNTMgN0w1MiA3TDUyIDZMNTEgNkw1MSA3TDUwIDdMNTAgNkw0OSA2TDQ5IDVMNTAgNUw1MCA0TDQ5IDRMNDkgNUw0NyA1TDQ3IDRMNDYgNEw0NiAzTDQ0IDNMNDQgMUw0MyAxTDQzIDNMNDIgM0w0MiA1TDQzIDVMNDMgN0w0MiA3TDQyIDZMNDEgNkw0MSAzTDM4IDNMMzggMkwzNiAyTDM2IDFaTTQwIDFMNDAgMkw0MSAyTDQxIDFaTTEwIDJMMTAgM0w5IDNMOSA0TDEwIDRMMTAgM0wxMSAzTDExIDRMMTIgNEwxMiAzTDExIDNMMTEgMlpNMTMgMkwxMyA0TDE0IDRMMTQgMlpNMzUgMkwzNSA0TDM2IDRMMzYgNUwzNyA1TDM3IDNMMzYgM0wzNiAyWk0yMiAzTDIyIDVMMjMgNUwyMyAzWk0zOCA0TDM4IDhMMzcgOEwzNyAxMUw0MSAxMUw0MSAxMkw0MiAxMkw0MiAxM0w0MyAxM0w0MyAxNUw0MSAxNUw0MSAxNEw0MCAxNEw0MCAxM0wzNyAxM0wzNyAxNEw0MCAxNEw0MCAxNkwzOSAxNkwzOSAxOEwzOCAxOEwzOCAxNUwzNyAxNUwzNyAxOEwzNiAxOEwzNiAyMEwzNyAyMEwzNyAyMkwzOCAyMkwzOCAyMUwzOSAyMUwzOSAyMkw0MCAyMkw0MCAyNEw0MSAyNEw0MSAyNUw0MiAyNUw0MiAyM0w0MyAyM0w0MyAyMUw0MiAyMUw0MiAyM0w0MSAyM0w0MSAyMEwzNyAyMEwzNyAxOEwzOCAxOEwzOCAxOUwzOSAxOUwzOSAxOEw0MCAxOEw0MCAxNkw0MyAxNkw0MyAxN0w0NCAxN0w0NCAxOEw0NSAxOEw0NSAxOUw0NCAxOUw0NCAyMEw0NSAyMEw0NSAyMUw0NCAyMUw0NCAyMkw0NiAyMkw0NiAyM0w0NCAyM0w0NCAyNEw0NSAyNEw0NSAyNkw0NiAyNkw0NiAyN0w0NyAyN0w0NyAyOEw0OCAyOEw0OCAyN0w0NyAyN0w0NyAyNkw1MSAyNkw1MSAyN0w1MiAyN0w1MiAyOEw1MyAyOEw1MyAyN0w1NCAyN0w1NCAyNkw1MSAyNkw1MSAyNUw1MCAyNUw1MCAyNEw0NyAyNEw0NyAyMkw0NiAyMkw0NiAxOUw0OSAxOUw0OSAxOEw0OCAxOEw0OCAxN0w0NiAxN0w0NiAxNkw0OCAxNkw0OCAxNEw0NiAxNEw0NiAxM0w0NCAxM0w0NCAxMkw0NSAxMkw0NSA5TDQ0IDlMNDQgMTBMNDMgMTBMNDMgOEw0NSA4TDQ1IDZMNDYgNkw0NiA0TDQ0IDRMNDQgN0w0MyA3TDQzIDhMNDIgOEw0MiA5TDQxIDlMNDEgOEw0MCA4TDQwIDdMNDEgN0w0MSA2TDQwIDZMNDAgNUwzOSA1TDM5IDRaTTMxIDVMMzEgOEwzNCA4TDM0IDVaTTI0IDZMMjQgN0wyNSA3TDI1IDZaTTMyIDZMMzIgN0wzMyA3TDMzIDZaTTM2IDZMMzYgN0wzNyA3TDM3IDZaTTM5IDZMMzkgN0w0MCA3TDQwIDZaTTYgOEw2IDlMNyA5TDcgOFpNNjAgOEw2MCA5TDU5IDlMNTkgMTBMNjEgMTBMNjEgOUw2MyA5TDYzIDhaTTY0IDhMNjQgMTBMNjUgMTBMNjUgOFpNMzggOUwzOCAxMEw0MSAxMEw0MSAxMUw0MiAxMUw0MiAxMkw0MyAxMkw0MyAxMEw0MSAxMEw0MSA5Wk0zIDEwTDMgMTFMNCAxMUw0IDEwWk05IDEwTDkgMTFMMTAgMTFMMTAgMTJMMTEgMTJMMTEgMTBaTTEzIDExTDEzIDEyTDEyIDEyTDEyIDEzTDE0IDEzTDE0IDExWk02NCAxMUw2NCAxMkw2NSAxMkw2NSAxMVpNMzAgMTJMMzAgMTNMMzEgMTNMMzEgMTJaTTU2IDEyTDU2IDEzTDU3IDEzTDU3IDEyWk0xOSAxM0wxOSAxNUwxOCAxNUwxOCAxNEwxNyAxNEwxNyAxNUwxOCAxNUwxOCAxNkwxOSAxNkwxOSAxOEwyMCAxOEwyMCAxOUwyMSAxOUwyMSAxOEwyMCAxOEwyMCAxNkwyMSAxNkwyMSAxN0wyMiAxN0wyMiAyMEwyMSAyMEwyMSAyMkwyMiAyMkwyMiAyMEwyMyAyMEwyMyAyMUwyNCAyMUwyNCAyMkwyMyAyMkwyMyAyM0wyMSAyM0wyMSAyNEwyMCAyNEwyMCAyMEwxOSAyMEwxOSAxOUwxOCAxOUwxOCAxOEwxNyAxOEwxNyAyMEwxNiAyMEwxNiAyM0wxNSAyM0wxNSAyNEwxNiAyNEwxNiAyNUwxNyAyNUwxNyAyNkwxNiAyNkwxNiAyN0wxNyAyN0wxNyAyOEwxOSAyOEwxOSAzMUwyMCAzMUwyMCAzMkwyMSAzMkwyMSAzM0wyMyAzM0wyMyAzNUwyNCAzNUwyNCAzN0wyNSAzN0wyNSAzNUwyNCAzNUwyNCAzNEwyNiAzNEwyNiAzNUwyNyAzNUwyNyAzNEwyNiAzNEwyNiAzM0wyMyAzM0wyMyAzMkwyNCAzMkwyNCAzMUwyNSAzMUwyNSAzMkwyNyAzMkwyNyAzM0wyOSAzM0wyOSAzMkwyNyAzMkwyNyAzMUwyNiAzMUwyNiAzMEwyMyAzMEwyMyAyOUwyMiAyOUwyMiAyOEwyMSAyOEwyMSAyN0wyMCAyN0wyMCAyNkwyMSAyNkwyMSAyNEwyNSAyNEwyNSAyNkwyMyAyNkwyMyAyNUwyMiAyNUwyMiAyN0wyMyAyN0wyMyAyOEwyNCAyOEwyNCAyN0wyNSAyN0wyNSAyOUwyOCAyOUwyOCAyOEwyNyAyOEwyNyAyN0wyOSAyN0wyOSAyOEwzMSAyOEwzMSAyOUwzMyAyOUwzMyAyOEwzMSAyOEwzMSAyN0wzMCAyN0wzMCAyNkwzMiAyNkwzMiAyN0wzMyAyN0wzMyAyNkwzNCAyNkwzNCAyNEwzNSAyNEwzNSAyNUwzNyAyNUwzNyAyNEwzNiAyNEwzNiAyM0wzNSAyM0wzNSAyMkwzNiAyMkwzNiAyMUwzNSAyMUwzNSAyMEwzNCAyMEwzNCAxOUwzMyAxOUwzMyAxOEwzMiAxOEwzMiAxOUwzMyAxOUwzMyAyMEwzNCAyMEwzNCAyMUwzMyAyMUwzMyAyMkwzMiAyMkwzMiAyM0wzMSAyM0wzMSAyMUwzMiAyMUwzMiAyMEwzMSAyMEwzMSAyMUwzMCAyMUwzMCAyM0wyOSAyM0wyOSAyNEwyOCAyNEwyOCAyNUwyOSAyNUwyOSAyNkwyNyAyNkwyNyAyN0wyNSAyN0wyNSAyNkwyNiAyNkwyNiAyNEwyNyAyNEwyNyAyMkwyNSAyMkwyNSAxOUwyNCAxOUwyNCAxN0wyMiAxN0wyMiAxNkwyMSAxNkwyMSAxNUwyMyAxNUwyMyAxNkwyNCAxNkwyNCAxNUwyMyAxNUwyMyAxNEwyMiAxNEwyMiAxM0wyMSAxM0wyMSAxNEwyMCAxNEwyMCAxM1pNNjAgMTNMNjAgMTRMNjEgMTRMNjEgMTVMNjIgMTVMNjIgMTZMNjQgMTZMNjQgMTVMNjMgMTVMNjMgMTRMNjEgMTRMNjEgMTNaTTQ0IDE0TDQ0IDE1TDQzIDE1TDQzIDE2TDQ2IDE2TDQ2IDE0Wk02IDE1TDYgMTZMNyAxNkw3IDE1Wk01MyAxNUw1MyAxNkw1NCAxNkw1NCAxN0w1NSAxN0w1NSAxNkw1NCAxNkw1NCAxNVpNMjcgMTdMMjcgMThMMjggMThMMjggMTdaTTQxIDE4TDQxIDE5TDQyIDE5TDQyIDE4Wk0xNCAxOUwxNCAyMEwxNSAyMEwxNSAxOVpNMjMgMTlMMjMgMjBMMjQgMjBMMjQgMTlaTTUzIDE5TDUzIDIwTDU0IDIwTDU0IDE5Wk02NCAxOUw2NCAyMUw2NSAyMUw2NSAxOVpNMjYgMjBMMjYgMjFMMjcgMjFMMjcgMjBaTTI4IDIwTDI4IDIxTDI5IDIxTDI5IDIwWk00NyAyMEw0NyAyMUw0OCAyMUw0OCAyMFpNNTggMjBMNTggMjFMNTkgMjFMNTkgMjBaTTcgMjFMNyAyMkw4IDIyTDggMjNMOSAyM0w5IDI0TDEwIDI0TDEwIDIzTDkgMjNMOSAyMkw4IDIyTDggMjFaTTE3IDIxTDE3IDIyTDE4IDIyTDE4IDI0TDE5IDI0TDE5IDI1TDIwIDI1TDIwIDI0TDE5IDI0TDE5IDIyTDE4IDIyTDE4IDIxWk0zNCAyMUwzNCAyMkwzNSAyMkwzNSAyMVpNMjQgMjJMMjQgMjNMMjUgMjNMMjUgMjRMMjYgMjRMMjYgMjNMMjUgMjNMMjUgMjJaTTQ4IDIyTDQ4IDIzTDUwIDIzTDUwIDIyWk01NiAyMkw1NiAyM0w1NyAyM0w1NyAyMlpNMTMgMjNMMTMgMjRMMTQgMjRMMTQgMjNaTTE2IDIzTDE2IDI0TDE3IDI0TDE3IDIzWk0zMCAyM0wzMCAyNEwzMSAyNEwzMSAyM1pNMzMgMjNMMzMgMjRMMzIgMjRMMzIgMjZMMzMgMjZMMzMgMjRMMzQgMjRMMzQgMjNaTTU0IDI0TDU0IDI1TDU1IDI1TDU1IDI4TDU0IDI4TDU0IDI5TDUxIDI5TDUxIDMwTDU0IDMwTDU0IDI5TDU1IDI5TDU1IDI4TDU2IDI4TDU2IDI2TDU4IDI2TDU4IDI1TDU5IDI1TDU5IDI0TDU3IDI0TDU3IDI1TDU1IDI1TDU1IDI0Wk0yIDI1TDIgMjZMMyAyNkwzIDI3TDQgMjdMNCAyOEw1IDI4TDUgMjlMNyAyOUw3IDI4TDYgMjhMNiAyN0w0IDI3TDQgMjVaTTUgMjVMNSAyNkw2IDI2TDYgMjVaTTQzIDI1TDQzIDI2TDQ0IDI2TDQ0IDI1Wk00NiAyNUw0NiAyNkw0NyAyNkw0NyAyNVpNMTggMjZMMTggMjdMMTkgMjdMMTkgMjZaTTM1IDI2TDM1IDI3TDM0IDI3TDM0IDI4TDM2IDI4TDM2IDI2Wk0xMSAyOEwxMSAyOUwxMCAyOUwxMCAzMUwxMSAzMUwxMSAzMEwxMiAzMEwxMiAyOFpNMTUgMjhMMTUgMjlMMTYgMjlMMTYgMzBMMTggMzBMMTggMjlMMTYgMjlMMTYgMjhaTTIwIDI5TDIwIDMxTDIxIDMxTDIxIDMyTDIzIDMyTDIzIDMxTDIxIDMxTDIxIDI5Wk00MSAyOUw0MSAzMEw0MiAzMEw0MiAyOVpNNjEgMzBMNjEgMzFMNjIgMzFMNjIgMzBaTTUgMzFMNSAzNEw4IDM0TDggMzFaTTMxIDMxTDMxIDM0TDM0IDM0TDM0IDMxWk01NyAzMUw1NyAzNEw2MCAzNEw2MCAzMVpNNjQgMzFMNjQgMzNMNjUgMzNMNjUgMzFaTTYgMzJMNiAzM0w3IDMzTDcgMzJaTTMyIDMyTDMyIDMzTDMzIDMzTDMzIDMyWk00OCAzMkw0OCAzM0w0OSAzM0w0OSAzMlpNNTggMzJMNTggMzNMNTkgMzNMNTkgMzJaTTMgMzNMMyAzNEwyIDM0TDIgMzVMMSAzNUwxIDM2TDMgMzZMMyAzNUw0IDM1TDQgMzNaTTUyIDM0TDUyIDM1TDUzIDM1TDUzIDM0Wk01NCAzNEw1NCAzNUw1NiAzNUw1NiAzNFpNNjIgMzRMNjIgMzVMNjMgMzVMNjMgMzZMNjIgMzZMNjIgMzdMNjMgMzdMNjMgMzlMNjQgMzlMNjQgNDBMNjUgNDBMNjUgMzhMNjQgMzhMNjQgMzdMNjUgMzdMNjUgMzZMNjQgMzZMNjQgMzRaTTQgMzZMNCAzN0w1IDM3TDUgMzZaTTE0IDM2TDE0IDM3TDE1IDM3TDE1IDM4TDE2IDM4TDE2IDM2Wk0yMCAzNkwyMCAzN0wyMSAzN0wyMSAzNlpNNDkgMzZMNDkgMzdMNTAgMzdMNTAgMzZaTTYzIDM2TDYzIDM3TDY0IDM3TDY0IDM2Wk00MCAzN0w0MCA0MEw0MSA0MEw0MSAzOEw0MiAzOEw0MiAzN1pNMTAgMzhMMTAgMzlMMTEgMzlMMTEgNDBMMTQgNDBMMTQgMzlMMTMgMzlMMTMgMzhMMTIgMzhMMTIgMzlMMTEgMzlMMTEgMzhaTTIyIDM5TDIyIDQwTDIzIDQwTDIzIDM5Wk0zMCAzOUwzMCA0MEwzMSA0MEwzMSA0MUwzMiA0MUwzMiA0MEwzMSA0MEwzMSAzOVpNNDUgMzlMNDUgNDBMNDMgNDBMNDMgNDJMNDIgNDJMNDIgNDFMNDEgNDFMNDEgNDJMNDAgNDJMNDAgNDFMMzkgNDFMMzkgNDJMNDAgNDJMNDAgNDRMMzkgNDRMMzkgNDNMMzggNDNMMzggNDRMMzkgNDRMMzkgNDVMNDAgNDVMNDAgNDZMMzkgNDZMMzkgNDdMNDAgNDdMNDAgNDhMNDIgNDhMNDIgNDdMNDEgNDdMNDEgNDZMNDMgNDZMNDMgNDVMNDIgNDVMNDIgNDNMNDMgNDNMNDMgNDRMNDQgNDRMNDQgNDNMNDMgNDNMNDMgNDJMNDcgNDJMNDcgNDFMNDYgNDFMNDYgMzlaTTU4IDM5TDU4IDQxTDU5IDQxTDU5IDM5Wk01IDQwTDUgNDJMNiA0Mkw2IDQzTDcgNDNMNyA0NEw2IDQ0TDYgNDVMNyA0NUw3IDQ0TDggNDRMOCA0NUw5IDQ1TDkgNDRMOCA0NEw4IDQzTDkgNDNMOSA0Mkw4IDQyTDggNDFMNyA0MUw3IDQwWk0xNiA0MEwxNiA0MUwxNSA0MUwxNSA0MkwxNCA0MkwxNCA0MUwxMyA0MUwxMyA0MkwxNCA0MkwxNCA0NEwxNiA0NEwxNiA0N0wxNCA0N0wxNCA0NkwxMyA0NkwxMyA0N0wxNCA0N0wxNCA0OEwxNiA0OEwxNiA0N0wxOCA0N0wxOCA0OEwxNyA0OEwxNyA1MUwxOSA1MUwxOSA1MkwxOCA1MkwxOCA1M0wxOSA1M0wxOSA1NUwxOCA1NUwxOCA1NkwxNyA1NkwxNyA1OEwxOCA1OEwxOCA1NkwxOSA1NkwxOSA1N0wyMSA1N0wyMSA1NEwyMCA1NEwyMCA1MUwyMSA1MUwyMSA1M0wyMiA1M0wyMiA1NEwyMyA1NEwyMyA1MUwyMiA1MUwyMiA0OUwxOSA0OUwxOSA0NkwyMSA0NkwyMSA0NUwyMyA0NUwyMyA0NkwyMiA0NkwyMiA0N0wyMCA0N0wyMCA0OEwyNCA0OEwyNCA0OUwyNSA0OUwyNSA1MEwyNiA1MEwyNiA1MkwyNyA1MkwyNyA1MUwyOCA1MUwyOCA1MkwyOSA1MkwyOSA1MUwyOCA1MUwyOCA0N0wyNyA0N0wyNyA1MEwyNiA1MEwyNiA0OUwyNSA0OUwyNSA0OEwyNiA0OEwyNiA0N0wyNSA0N0wyNSA0NkwyNCA0NkwyNCA0NUwyMyA0NUwyMyA0NEwyMSA0NEwyMSA0NUwyMCA0NUwyMCA0M0wxOSA0M0wxOSA0MUwxOCA0MUwxOCA0MFpNMzQgNDBMMzQgNDJMMzMgNDJMMzMgNDNMMzQgNDNMMzQgNDJMMzUgNDJMMzUgNDBaTTAgNDFMMCA0MkwxIDQyTDEgNDFaTTYgNDFMNiA0Mkw3IDQyTDcgNDNMOCA0M0w4IDQyTDcgNDJMNyA0MVpNNTAgNDFMNTAgNDJMNTEgNDJMNTEgNDFaTTE1IDQyTDE1IDQzTDE2IDQzTDE2IDQ0TDE4IDQ0TDE4IDQ1TDE3IDQ1TDE3IDQ2TDE4IDQ2TDE4IDQ1TDE5IDQ1TDE5IDQzTDE3IDQzTDE3IDQyWk00MSA0Mkw0MSA0M0w0MiA0M0w0MiA0MlpNNDUgNDNMNDUgNDRMNDYgNDRMNDYgNDVMNDggNDVMNDggNDNaTTY0IDQzTDY0IDQ1TDY1IDQ1TDY1IDQzWk0zMyA0NUwzMyA0NkwzMiA0NkwzMiA0OEwzNCA0OEwzNCA0NVpNNDQgNDVMNDQgNDZMNDUgNDZMNDUgNDVaTTUxIDQ1TDUxIDQ2TDUyIDQ2TDUyIDQ1Wk0zIDQ2TDMgNDhMNCA0OEw0IDQ2Wk02IDQ2TDYgNDdMNSA0N0w1IDQ5TDggNDlMOCA0OEw2IDQ4TDYgNDdMOCA0N0w4IDQ2Wk01MiA0N0w1MiA0OEw1MyA0OEw1MyA0N1pNMTMgNDlMMTMgNTBMMTQgNTBMMTQgNTFMMTYgNTFMMTYgNDlMMTUgNDlMMTUgNTBMMTQgNTBMMTQgNDlaTTE4IDQ5TDE4IDUwTDE5IDUwTDE5IDQ5Wk00MCA0OUw0MCA1MUw0MSA1MUw0MSA1MEw0MiA1MEw0MiA1MUw0NCA1MUw0NCA1MEw0MiA1MEw0MiA0OVpNNTIgNDlMNTIgNTFMNTMgNTFMNTMgNDlaTTMyIDUwTDMyIDUyTDMzIDUyTDMzIDUwWk00OSA1MUw0OSA1Mkw1MCA1Mkw1MCA1MVpNNTYgNTFMNTYgNTJMNTQgNTJMNTQgNTVMNTUgNTVMNTUgNTRMNTYgNTRMNTYgNTZMNTcgNTZMNTcgNTVMNTggNTVMNTggNTZMNTkgNTZMNTkgNTVMNjAgNTVMNjAgNTRMNTkgNTRMNTkgNTNMNTYgNTNMNTYgNTJMNTggNTJMNTggNTFaTTYxIDUxTDYxIDUzTDYyIDUzTDYyIDUxWk00IDUyTDQgNTNMNSA1M0w1IDUyWk01MSA1Mkw1MSA1NEw1MCA1NEw1MCA1M0w0OSA1M0w0OSA1NEw1MCA1NEw1MCA1N0w1MiA1N0w1MiA1OEw1MyA1OEw1MyA1Nkw1MiA1Nkw1MiA1MlpNMTUgNTNMMTUgNTRMMTYgNTRMMTYgNTNaTTI3IDUzTDI3IDU0TDI5IDU0TDI5IDUzWk00MiA1M0w0MiA1NEw0MSA1NEw0MSA1NUwzOCA1NUwzOCA1Nkw0MSA1Nkw0MSA1NUw0MiA1NUw0MiA1Nkw0MyA1Nkw0MyA1NEw0NCA1NEw0NCA1M1pNMTkgNTVMMTkgNTZMMjAgNTZMMjAgNTVaTTI3IDU1TDI3IDU2TDI4IDU2TDI4IDU1Wk02MSA1Nkw2MSA1N0w2MiA1N0w2MiA1OEw2NCA1OEw2NCA1NlpNMjYgNTdMMjYgNThMMjcgNThMMjcgNTdaTTMxIDU3TDMxIDYwTDM0IDYwTDM0IDU3Wk01NCA1N0w1NCA2MEw1NSA2MEw1NSA1N1pNNTcgNTdMNTcgNjBMNjAgNjBMNjAgNTdaTTMyIDU4TDMyIDU5TDMzIDU5TDMzIDU4Wk01OCA1OEw1OCA1OUw1OSA1OUw1OSA1OFpNNjEgNTlMNjEgNjFMNjMgNjFMNjMgNTlaTTIwIDYwTDIwIDYxTDIxIDYxTDIxIDYwWk0yMiA2MEwyMiA2MUwyMyA2MUwyMyA2MFpNOCA2MUw4IDY1TDkgNjVMOSA2MVpNMTMgNjFMMTMgNjJMMTQgNjJMMTQgNjNMMTEgNjNMMTEgNjVMMTIgNjVMMTIgNjRMMTQgNjRMMTQgNjNMMTUgNjNMMTUgNjVMMTggNjVMMTggNjRMMTYgNjRMMTYgNjNMMTcgNjNMMTcgNjJMMTUgNjJMMTUgNjFaTTU1IDYxTDU1IDYzTDU2IDYzTDU2IDYxWk0zMSA2NEwzMSA2NUwzMyA2NUwzMyA2NFpNMzQgNjRMMzQgNjVMMzUgNjVMMzUgNjRaTTQ5IDY0TDQ5IDY1TDUwIDY1TDUwIDY0Wk0wIDBMMCA3TDcgN0w3IDBaTTEgMUwxIDZMNiA2TDYgMVpNMiAyTDIgNUw1IDVMNSAyWk01OCAwTDU4IDdMNjUgN0w2NSAwWk01OSAxTDU5IDZMNjQgNkw2NCAxWk02MCAyTDYwIDVMNjMgNUw2MyAyWk0wIDU4TDAgNjVMNyA2NUw3IDU4Wk0xIDU5TDEgNjRMNiA2NEw2IDU5Wk0yIDYwTDIgNjNMNSA2M0w1IDYwWiIgZmlsbD0iIzAwMDAwMCIvPjwvZz48L2c+PC9zdmc+Cg==" alt>
            </div>
            <div class="widget">
                <p>If you cannot scan the QR code, enter this key instead:</p>
                <p style="word-break:break-all; width:70%">YEXTWQFNZ5DJPZH7QTUN5U3WHBKIFAZG2O6VWYCUO7MRZENQTUVILUFRI23S6EIXCJ7PHT2L47QXY36SIQUUGR6A3ZP6VUMSHDED4KBYKAZCZJ5Q36AH6NRYELROIZL4EAZHBZLTPQ5HSW3ZSOTUH6IZWOBR7H5X4RHOTEHYVFKJ6THZB7XT3OREBEW5S5JET3TNOZIDBGJOI</p>
            </div>
            <div class="widget widget-text">
                <label for="verify">Confirmation code</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="off" autocomplete="off" required>
                <p class="help">Please enter the confirmation code generated by your 2FA/TOTP app.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="submit">Activate</button>
            </div>
        </div>
    </form>
</div>

 
**Module template:** Here you can overwrite the standard `mod_two_factor`template.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_two_factor two-factor block">

    <p class="error">Please enable two-factor authentication before you proceed.</p>
    <p>Please scan the QR Code with your 2FA/TOTP app.</p>

    <form action="" class="tl_two_factor_form" method="post">
        <div class="formbody">
            <input type="hidden" name="FORM_SUBMIT" value="tl_two_factor">
            <input type="hidden" name="REQUEST_TOKEN" value="_">
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,…" alt>
            </div>
            <div class="widget">
                <p>If you cannot scan the QR code, enter this key instead:</p>
                …
            </div>
            <div class="widget widget-text">
                <label for="verify">Confirmation code</label>
                <input type="text" name="verify" id="verify" class="text" value="" autocapitalize="off" autocomplete="off" required>
                <p class="help">Please enter the confirmation code generated by your 2FA/TOTP app.</p>
            </div>
            <div class="submit_container">
                <button type="submit" class="tl_submit">Activate</button>
            </div>
        </div>
    </form>

</div>
<!-- indexer::continue -->
```

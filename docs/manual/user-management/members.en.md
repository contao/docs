---
title: 'Members'
menuTitle: 'Members (front end)'
description: 'The administration of front end users is much simpler than the administration of back end users, since there is no need to work with mounts and individual input fields.'
aliases:
    - /en/user-management/members/
weight: 20
---

The administration of front end users is much simpler than the administration of back end users, because you do not have to work with mounts and single input fields. Member management is mainly about accessing protected subpages and changing personal data.

The term "members" dates back to the early days of Contao, when the software was mainly used for community pages. In the meantime, many commercial websites are also implemented with it, so you could also say "customers".

## Member groups

Members are also organized in groups and inherit access rights to protected pages from them.

### Auto-redirect

In the front end module "Login" you can define to which page members will be redirected after registration. In the group settings you can overwrite this default page with an individual destination page per group.

**Redirect on login:** Here you activate the individual redirect.

**Redirect page:** Here you select the target page.

### Group settings

Member groups can also be deactivated manually or automatically.

**Deactivate:** Here you can deactivate the group.

**Activate on:** Here you activate the group on a specific day at 0:00.

**Deactivate on:** Here you deactivate the group on a specific day at 0:00.

## Members

Unlike users, members are not so much concerned with access rights as with personal data such as name, address or telephone number.

{{% notice note %}}
The username and email address must be unique, i.e. they can only be used once. 
{{% /notice %}}

### Personal data

**First name:** Here you enter the first name of the member.

**Last name:** Here you can enter the last name of the member.

**Date of birth:** Here you can enter the date of birth. A click on the green symbol next to the input field opens a JavaScript calendar.

**Gender**: Here you can select the gender of the member.

### Address data

**Company:** Here you can enter the company name of the member.

**Street:** Here you can enter the address of the member.

**Postal code**: Here you can enter the postcode of the member.

**City:** Here you can enter the city of the member.

**State:** Here you can enter the state or federal state where the member is located.

**Country:** Here you can select the country where the member lives.

### Contact details

**Phone number:** Here you can enter the phone number of the member.

**Cell phone number:** Here you can enter the mobile number of the member.

**Fax number**: Here you can enter the member's fax number.

**E-mail address:** Enter the member's e-mail address here.

**Website:** Here you can enter the website of the member.

**Language**: Here you can choose the language of the member.

### Member groups

Here you define the group membership of the member. The first group, i.e. the one at the top of the selection, is the main group, which is taken into account e.g. for automatic forwarding after login.

**Member groups:** Here you define the group membership of the member.

### Login details

In this section you can assign a username and password to the member, which will be used to log in to the front end. For this purpose, the member should belong to at least one member group.

**Allow login:** Here you activate the front end login.

**Username:** Here you define a unique user name.

**Password**: Here you assign a password to the member.

### Home directory

Here you can assign a member their own home directory and provide certain files there, for example with the file management. Both the module "Picture gallery" and the module "Downloads" offer the possibility to use the user directory of a member as a data source.

**Set home directory:** Here you activate your own home directory.

**Home directory:** Here you set the member's home directory.

### Subscriptions

**Subscriptions**: Here you can edit the member's newsletter subscriptions.

### Account settings

Just like users, members can also be deactivated manually or automatically. A deactivated member can no longer log in to the front end.

**Deactivate:** Here you can deactivate the member.

**Activate on:** Here you activate the member on a specific day at 0:00.

**Deactivate on:** Here you deactivate the member on a specific day at 0:00.

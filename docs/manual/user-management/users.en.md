---
title: 'User (Backend)'
description: 'Up to now we have worked exclusively as an administrator, who has access to all areas and elements of the system.'
aliases:
    - /en/user-management/users/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Up to now we have worked exclusively as an administrator who has access to all areas and elements of the system. However, a user will usually only be given access to the resources that he or she actually needs for a specific task.

![The backend from the user's perspective](/de/user-management/images/de/das-backend-aus-sicht-des-benutzers.png?classes=shadow)

Normal users, unlike administrators, have no rights at all by default and are only allowed to do what you explicitly allow them to do. The very comprehensive rights management in Contao allows you as an administrator to not only restrict access to certain backend modules, but also to disable every single input field if necessary.

![Activate individual input fields](/de/user-management/images/de/einzelne-eingabefelder-freischalten.png?classes=shadow)

## User groups

Each user can be a member of several user groups and automatically inherits all rights assigned to these groups. The different permissions are added together so that a member of groups A and B receives the sum of the permissions of both groups - of course only if both groups are active.

### Allowed modules

The backend navigation is created dynamically based on user rights, but backend modules that have not been released do not appear in the backend navigation for reasons of clarity. Access to the theme modules can be controlled separately.

**Backend modules:** This is where you define access to the backend modules.

**Theme modules:** Here you define access to the sub-modules of the Theme Manager.

### Pagemounts

Mounting a file system so that a user can access it is called "mounting" on the computer. Similarly, a "pagemount" is the page from which a user gains access to the page structure.

**Pagemounts:** Here you select the pagemounts of the group.

**Allowed page types:** Here you can define which page types the members of the user group are allowed to create, see [Page Types](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen).

### Filemounts

Similar to the pagemount, which determines the entry point into the page structure, the filemount determines the entry point into the file system. The user cannot access folders outside the filemount.

![Filemounts of the user](/de/user-management/images/de/filemounts-des-benutzers.png?classes=shadow)

The user only sees the folders `files/public/media/content-images``files/public/media/documents`and`files/public/media/slider` any subfolders they may contain. All other directories, which are on the same or a higher level, are not displayed

![The file management from the user's point of view](/de/user-management/images/de/die-dateiverwaltung-aus-sicht-des-benutzers.png?classes=shadow)

**filemounts:** Here you select the filemounts of the group.

**Allowed file operations:** Being able to see a directory and the files it contains does not mean that a user is allowed to edit them. You can specify what is possible with the mounted resources here.

| Operation | Explanation |
| --------- | ----------- |
| Upload files to the server | The user may transfer certain files to the server via the file management (upload). You can define the allowed files in the backend settings. |
| Edit, copy, and move files and directories | The user may rename, duplicate and move files and directories. |
| Delete single files and empty directories | The user may delete individual files and empty directories (not recursively). |
| Delete directories including all files and subfolders (!) | The user can delete files and directories recursively, i.e. including all the sub-folders and files they contain. |
| Edit files in the source code editor | The user is allowed to edit the content of certain files with the source code editor directly on the server. You can define the allowed files in the backend settings. |
| Synchronize the file system with the database | The user can synchronize the file system with the database. |

### Image sizes

In this point you can restrict access to the different image sizes.

### Form rights

[Form Generator](../../formulargenerator/)

**Allowed forms:** Here you define which forms the members of the user group can access.

**Form rights:** Here you define whether the members of the user group can create new forms or delete existing ones.

### FAQ rights

[FAQ extension](../../core-erweiterung/faq/)

**Allowed FAQ categories:** Here you define which FAQ categories the members of the usergroup are allowed to access.

**FAQ category rights:** Here you define whether the members of the user group can create new categories or delete existing ones.

### Archive rights

[News/Blog extension](../../core-erweiterung/nachrichten/)

**Allowed archives:** Here you define which news/blog archives the members of the user group are allowed to access.

**Archive rights**: Here you can define whether the members of the user group can create new news/blog archives or delete existing ones.

**Allowed RSS feeds:** Here you define which RSS feeds the members of the user group are allowed to access.

**RSS feed rights:** Here you define whether the members of the user group may create new RSS feeds or delete existing ones.

### Newsletter rights

[Newsletter extension](../../core-erweiterung/newsletter/)

**Permitted distributors:** Here you define which distribution lists the members of the user group are allowed to access.

**Distribution rights:** Here you can define whether the members of the user group can create new distribution lists or delete existing ones.

### Event rights

[Calendar extension](../../core-erweiterung/kalender/)

**Allowed calendars:** Here you define which calendars the members of the user group are allowed to access.

**Calendar rights:** Here you define whether the members of the user group are allowed to create new calendars or delete existing ones.

**Allowed RSS feeds:** Here you can define which RSS feeds the members of the user group can access.

**RSS feed rights:** Here you define whether the members of the user group are allowed to create new RSS feeds or delete existing ones.

### Allowed Member Groups

**Allowed member groups:** Members of this group can be used in the frontend preview.

### Excluded fields

At the beginning of the section it was mentioned that by default, normal users have no rights at all ("deny all") and you as administrator have to explicitly enable all access. This also applies to the individual input fields of each module or table listed here.

**Allowed fields:** Here you choose the allowed fields.

With the allowed fields you can easily create workflows, e.g. by not releasing the fields for publishing an article or a news item for editors. No editor can publish something without you or an editor-in-chief having seen it first.

### Deactivation

User groups can be deactivated manually or automatically at a specific time. No more rights can be inherited from a deactivated group.

**Deactivate:** Here you can deactivate the group.

**Activate on:** Here you activate the group on a specific day at 0:00.

**Disable on:** Here you deactivate the group on a specific day at 0:00.

## User

With the "Users" module you can manage user accounts. Users can login with their username and password in the backend and inherit the permissions of the user groups assigned to them.

{{% notice note %}}
The user name and email address must be unique, i.e. they can only be assigned once.
{{% /notice %}}

### Name and e-mail address

**User name:** Here you define the user name.

**Name**: Here you enter the first and last name of the user.

**Email address:** Enter the user's e-mail address here.

### Backend Settings

Every user can customize the backend to his or her personal preferences.

**Backend language:** Here you set the backend language.

**File Uploader:** Here you can choose between "DropZone" and the "Standard Uploader".

**Show explanations:** By default, Contao displays a short explanation below each input field which you can disable here if needed.

**Show thumbnails:** Here you can disable the thumbnails in the file overview of the file manager to make the directory structure load faster.

**Use Rich Text Editor:** Here you can disable the Rich Text Editor.

**Use Code Editor:** Here you can disable the code editor.

### Backend Theme

**Backend-Theme:** Here you can change the Backend-Theme, if there is another one.

**Full screen:** The width of the backend should not be limited.

### Password settings

**Password change necessary:**  Here you can force the user to change his password at the next login.

**Password:** Here you can assign a password to the user.

### Two-Factor Authentication

Users can enable two-factor authentication to further secure the account. In addition to the user name and password, a verification code ("Time-based One-time Password") must be entered. This one-time password must be generated by a two-factor app such as 1Password, Authy, Google Authenticator, Microsoft Authenticator, LastPass Authenticator, or any other TOTP app.

Users can be required to use two-factor authentication. To do this, the following configuration must be `config/config.yml`adopted in the:

```yml
contao:
  security:
    two_factor:
      enforce_backend: true
```

### Administrator

**Make him an administrator:** Here you can make the user an administrator. The assignment to a group is then no longer necessary.

### User groups

Among other things, this is where you define the group membership of the user. The first group, i.e. the one at the top of the selection menu, is the main group, which is automatically set in the access rights when creating new pages, for example.

**User groups:** Here you define the group membership of the user.

**Rights inheritance:** There are the following three possibilities for the assignment of rights:

| Mode | Declaration |
| ---- | ----------- |
| Use group rights only | Only the rights of the active groups are inherited. |
| Extend group rights | The rights of the active groups are inherited and additionally extended by individual rights. |
| Use user rights only | Only individual rights are used. |

Individual rights are configured in the same way as [user groups](#benutzergruppen).

### Account settings

Just like user groups, users can be deactivated manually or automatically at a certain point in time. A deactivated user can no longer log on to the back end.

**Deactivate:** Here you can deactivate the user.

**Activate on:** Here you activate the user on a specific day at 0:00.

**Deactivate on:** Here you deactivate the user on a specific day at 0:00 a.m.

## Unlock pages and articles

The release of pages and articles so that they can be processed in the backend often leads to confusion in practice, because the necessary authorizations have to be set at different places in the system.

In order to unlock certain pages and to allow editing of articles on these pages, you have to create the appropriate prerequisites in the user administration as well as in the page structure.

### Prerequisites in the user administration

First you need a user group, in which you activate the modules "Page structure" and "Articles" and have to include the pages to be edited as pagemount. This way you create the conditions for a user to access the page tree and see certain pages or articles there.

Then you have to activate`tl_article` and `tl_content`unlock the input fields of the tables `tl_page`in the user group under "Allowed fields". In this way you create the conditions for the user to see more than just an empty page, for example, when he wants to edit an article.

Finally you have to create a user and assign him to the group.

### Requirements in the page structure

In section [Access Rights](../../seitenstruktur/seiten-konfigurieren/#zugriffsrechte), you have already learned that each page belongs to a specific user and group, and that there are different levels of access based on that.

![access rights of a page](/de/user-management/images/de/zugriffsrechte-einer-seite.png?classes=shadow)

For example, this page belongs to the user `Helen Lewis`who can edit, move or delete it and the articles it contains. Other users in the group `Editors`may only edit the articles, but not the page itself.

So you have to assign access rights to the pages that a user should be able to edit or create articles on and assign them either to the user or to his group. In this way you create the conditions for a user to be able to click on the corresponding navigation icons.

![The page structure without assigned access rights](/de/user-management/images/de/die-seitenstruktur-ohne-zugewiesene-zugriffsrechte.png?classes=shadow)

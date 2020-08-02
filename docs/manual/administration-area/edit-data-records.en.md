---
title: 'Edit Records'
description: 'To enable the comfortable editing of data is one of the main tasks of a CMS - at least it should be.'
aliases:
    - /en/administration-area/edit-data-records/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

To enable the comfortable editing of data is one of the main tasks of a CMS - at least it should be. But if you have ever faced the problem of having to change 25 data records at once, you know that many systems do not do so well in this discipline. Often there is no other choice than to call up and change each data record individually. That costs time and nerves.

Of course, this would not be explained at this point if Contao could not shine here with a well thought-out solution. In the following sections, I will show you how Contao supports you in editing records.

## Options when saving

Contao always offers you several buttons to save your entries. Each button takes you to a different location after you have saved your entries, depending on what you want to do next.

**Save:** When you click on this button, your entries are saved and the input mask is reloaded. You can continue to edit the record.

**Save and close:** Clicking this button will save your entries and close the form. You will return to the previous page.

**Save and New:** When you click this button, your entries are saved and a new element is inserted after the element you have just edited. You will be taken directly to the editing mask of the new record.

**Save and duplicate:** When you click this button your input is saved, the saved element is duplicated and inserted after the currently edited element. You will be taken directly to the editing mask of the new record.

**Save and edit:** This button is only available when creating new elements. When you click on it, your entries are saved and you are taken directly to the Parent View of the child records.

**Save and back:** Clicking this button will save your entries and close the form. You will be forwarded to the parent page, e.g. from a content element directly to the article overview.

To the [shortcuts in edit mode](../backend-tastaturkuerzel/#tastaturkuerzel-im-bearbeitungsmodus) .

## Edit multiple records at once {#Edit multiple records-once}

In Contao, you can comfortably edit multiple records at once instead of having to access and change each record individually. To do this, click on the `Edit multiple` records link. As you can see, the navigation icons are automatically replaced by checkboxes that let you select the records you want to edit.

![Editing Multiple Records](/de/administration-area/images/de/mehrere-datensaetze-bearbeiten.png?classes=shadow)

**Edit:** The selected records can be edited.

**Delete:** The selected records are deleted.

**Copy:** The selected records are duplicated using the clipboard.

**Postpone:** The selected records are moved using the clipboard.

**Overwrite:** The selected data records can be overwritten.

**Generate aliases:** The aliases of the selected data records are regenerated.

Go to the [shortcuts in "Edit multiple" mode](../backend-tastaturkuerzel/#tastaturkuerzel-im-modus-mehrere-bearbeiten) .

Use the overwrite function with care, because here all existing values of the selected data sets are actually replaced by the new value!

A click on `Overwrite` or `Edit` takes you to the overview of the fields that are available in the table. Select the input fields you want to overwrite or edit and click on `Next` .

![Select the input fields to be edited](/de/administration-area/images/de/die-zu-bearbeitenden-eingabefelder-auswaehlen.png?classes=shadow)

You now see the selected input fields of the selected records and can easily change them in a single step. Even when editing several data sets, you will of course only see the input fields that you actually need for your project.

![Only the selected input fields are displayed](/de/administration-area/images/de/nur-die-ausgewaehlten-eingabefelder-werden-angezeigt.png?classes=shadow)

Similar to this example, you could have used the "Overwrite" function to overwrite the language of all pages with a new value in one go. And the function can do even more: You might at some point find yourself in the situation that you have created a new member group and now want to add it to the access rights of several pages without deleting the existing assignment. You can also do this with the "Overwrite" function by selecting the appropriate update mode.

![Selecting the update mode when overwriting data records](/de/administration-area/images/de/auswahl-des-update-modus-beim-ueberschreiben-von-datensaetzen.png?classes=shadow)

**Add selected values:** The existing values are retained and supplemented by the newly selected values. A page that already has the group *Piano Students* assigned would have the groups *Piano Students* and *Violin Students* .

**Remove selected values:** The newly selected values (if any) are removed from the existing values. Our page with the groups *Piano Students* and *Violin Students* would have only the group *Piano Students* after saving.

**Overwrite existing entries:** The existing values are deleted and replaced by the newly selected values. Our site would have only the group *Violin Students* after saving, no matter which groups were assigned before.

## Different versions of a data record

Contao automatically creates a new version of the edited data set every time you save the file, so you can always undo changes. As soon as more than one version is available, a drop-down menu appears above the input mask listing the different versions, their date and creator. With a click on `Restore` you can restore a previous version.

![Restore previous versions of a record](/de/administration-area/images/de/fruehere-versionen-eines-datensatzes-wiederherstellen.png?classes=shadow)

By clicking on the icon ![Show differences](/de/icons/diff.svg?classes=icon)next to the drop-down menus, the differences between the current version and the selected version are displayed.

![Differences between the selected versions](/de/administration-area/images/de/unterschiede-zwischen-den-gewaehlten-versionen.png?classes=shadow)

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

One of the main tasks of a CMS is to provide a comfortable way to edit data - at least that is how it should be, but if you have ever had the problem of having to edit 25 records at once, you know that many systems of this discipline do not do so well. Often you have no other choice than to call up and change each data record individually. That costs time and nerves.

Of course, this would not be explained here if Contao could not come up with a well thought-out solution. In the following sections, I will show you how Contao supports you in editing records.

## Options when saving

Contao always offers several buttons to save your entries. Each button takes you to a different place after saving, depending on what you want to do next.

**Save:** When you click on this button, your entries will be saved and the input mask will be reloaded, allowing you to continue editing the data set.

**Save and close:** Clicking this button saves your entries and closes the form. You will be taken back to the previous page.

**Save and New:** Clicking this button will save your entries, and a new element will be inserted after the element you have just edited. You will be taken directly to the editing mask of the new record.

**Save and duplicate:** Clicking this button saves your input, the saved element is duplicated and inserted after the element you are currently editing. You will be taken directly to the editing mask of the new record.

**Save and edit:** This button is only available when creating new elements. Clicking on it will save your entries and take you directly to the Parent View of the child records.

**Save and back:** Clicking this button will save your entries and close the form. You will be forwarded to the parent page, e.g. from a content element directly to the article overview.

Go to the [keyboard shortcuts in edit mode](../backend-tastaturkuerzel/#tastaturkuerzel-im-bearbeitungsmodus).

## Edit multiple records at once {#edit multiple records at once}

In Contao, you can easily edit multiple records at once instead of having to access and change each record individually. Just click on the link `Mehrere bearbeiten`. As you can see, the navigation icons are automatically replaced by checkboxes that let you select the records you want to edit.

![Editing Multiple Records](/de/administration-area/images/de/mehrere-datensaetze-bearbeiten.png?classes=shadow)

**Edit:** The selected records can be edited.

**Delete:** The selected records are deleted.

**Copy:** The selected records are duplicated using the clipboard.

**Move the record:** The selected records are moved using the clipboard.

**Overwrite:** The selected records can be overwritten.

**Generate aliases:** The aliases of the selected records are regenerated.

Go to the [keyboard shortcuts in "Edit multiple" mode](../backend-tastaturkuerzel/#tastaturkuerzel-im-modus-mehrere-bearbeiten).

Use the overwrite function carefully, because here all existing values of the selected data sets are actually replaced by the new value!

Clicking `Überschreiben`or `Bearbeiten`takes you to the overview of the fields in the table, where you can select the fields you want to overwrite or edit and click `Weiter`.

![Select the input fields to be edited](/de/administration-area/images/de/die-zu-bearbeitenden-eingabefelder-auswaehlen.png?classes=shadow)

Now you can see the selected input fields of the selected data sets and can easily change them in a single step. Even when editing several data sets, you will of course only see the input fields that you actually need for your project.

![Only the selected input fields are displayed](/de/administration-area/images/de/nur-die-ausgewaehlten-eingabefelder-werden-angezeigt.png?classes=shadow)

Similar to this example, you could have used the "Overwrite" function to overwrite the language of all pages with a new value in one go. And the function can do even more: You might find yourself in the situation that you have created a new member group and now want to add it to the access rights of several page additions without deleting the existing assignment. You can also do this with the "Overwrite" function by selecting the appropriate update mode.

![Selecting the update mode when overwriting data records](/de/administration-area/images/de/auswahl-des-update-modus-beim-ueberschreiben-von-datensaetzen.png?classes=shadow)

**Add selected values:** The existing values are retained and are supplemented by the newly selected values. A page that already has the group *Piano Students* assigned would have the groupsPiano *Students* and *Violin Students* after saving.

**Remove selected values:** The newly selected values (if available) are removed from the existing values. Our page with the groups *Piano Students* and *Violin Students* would have only the group *Piano Students* after saving.

**Overwrite existing entries:** The existing values are deleted and replaced by the newly selected values. So after saving, our page would have only the group *Violin Students*, no matter which groups were previously assigned.

## Different versions of a record

Contao automatically creates a new version of the edited data set each time you save it, so you can always undo your changes. As soon as more than one version is available, a drop-down menu appears above the input mask listing the different versions, their date and creator. With a click on `Wiederherstellen`you can restore a previous version.

![Restore previous versions of a record](/de/administration-area/images/de/fruehere-versionen-eines-datensatzes-wiederherstellen.png?classes=shadow)

Clicking on the icon ![Show differences](/de/icons/diff.svg?classes=icon)next to the drop-down menu will display the differences between the current and the selected version.

![Differences between the selected versions](/de/administration-area/images/de/unterschiede-zwischen-den-gewaehlten-versionen.png?classes=shadow)

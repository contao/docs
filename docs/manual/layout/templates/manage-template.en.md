---
title: 'Manage templates'
description: 'The management of the template files.'
aliases:
    - /en/layout/templates/manage-template/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## Folder structure

A template can be stored in the main directory. The corresponding template is then offered for selection in a content element and marked as `global`such.

In the [Theme Manager](../../theme-manager/themes-verwalten) you can link an existing template folder to the theme. The template files in this folder are then `Theme-Namen`marked with the appropriate one when you select them.

{{% notice note %}}
Template files in further subodners are not considered for selection.
{{% /notice %}}

## File names

The template files are prefixed for recognition. For example, this indicates `ce_`a content element**.** If you want to change the output of the content element of type "Text" you can use the template for this `ce_text.html5`purpose.

In this case, the template changes affect all content elements of type "Text". This is not always desirable. For specific use, you can give the template an individual name. In this case, the respective default template name must be retained and only extended. For example, rename `ce_text.html5`it after `ce_text_individuell.html5`.

This template can then be used specifically for the output of one (or more) content element(s) of type "Text".

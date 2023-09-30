---
title: "Checkbox Wizard"
description: Multiple checkboxes with sorting support.
---

This widget is just like the [Checkbox widget][CheckboxWidget] but it supports manual sorting of the multiple 
checkboxes.

![A checkbox wizard]({{% asset "images/dev/reference/widgets/checkbox-wizard.png" %}}?classes=shadow)

This can be useful if the order of the select element matters when processed in the front end (just like the order of CSS files in the
example of the screenshot).

As this widgets is otherwise identical in functionality it also comes with the same options as the regular checkbox widget. See
[its reference][CheckboxWidget] for more details.


## Usage in Contao

This widget is most notably used for various fields in the page layout settings, such as the selection of the Contao CSS framework or for
JavaScript template files. It is also used for the image format of responsive image size settings, since the order of the format will
influence the order of their output in the front end.


[CheckboxWidget]: /reference/widgets/checkbox/

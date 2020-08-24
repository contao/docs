---
title: 'Create a search form'
description: 'You can use the form generator to create your own search form and include it in the header of your website, for example.'
aliases:
    - /en/form-generator/create-a-search-form/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

As already mentioned in the section [My Search Forms](/en/layout/module-management/website-search/#own-search-forms), you can use the form generator to create your own search form and include it in the header of your website, for example. The following steps are necessary:

1. Open the form generator, and create [a new form](/en/form-generator/forms/#form-configuration). Specify the search page as the redirect destination, and select *GET* as the transfer method.
2. Add a [text field](/en/form-generator/form-fields/#text-field) to the form, and enter the field `keywords` name. If you like, you can make this field mandatory, because a search without a search term will probably not yield many results.
3. Optionally add a [radio button menu](/en/form-generator/form-fields/#radio-button-menu) to the form if you want your visitor to be able to choose between AND and OR search. The field name is in this case `query_type` and the option `and` values and `or`.
4. Add a [submit button](/en/form-generator/form-fields/#submit-field) to the form.

This completes the search form, and you can embed it as a frontend module in the page layout in the header or any other column of your website.

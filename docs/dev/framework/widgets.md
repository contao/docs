---
title: "Widgets"
description: How to create custom input widgets for the back and front end.
aliases:
    - /framework/widgets/
---


You can create custom _Widgets_ for the front end (see the [form generator][FormGenerator])
or the back end (see [DCA fields][DcaFields]). In both cases, the custom widget
needs to extend from the abstract `\Contao\Widget` class. The custom widget class
is then registered either via the `$GLOBALS['BE_FFL']` array (back end widgets)
or the `$GLOBALS['TL_FFL']` array (front end widgets). 

Also in both cases, the abstract method `generate()` needs to be implemented. However,
when the widget is rendered, Contao will execute the `parse()` method of the widget
(also both in the front and back end). It is then up to each widget's implementation
how the output is delivered.

The abstract class also contains some member variables that control the output and
behavior of the widget. The default value of these member variables will need to be
set in the custom child class accordingly. Typically the following member variables
are adjusted:

* `$blnSubmitInput`: controls whether this widget actually submits any input.
* `$blnForAttribute`: controls whether a `for` attribute should be used for the widget's label.
* `$strTemplate`: the Contao template for the widget.
* `$strPrefix`: controls the CSS class prefix for front end widgets.


## Creating Back End Widgets

The following example creates a simple text input widget for the back end. The input
is allowed to be submitted and the generated label should contain the `for` attribute.
The template is set to `be_widget`, which most back end widgets commonly use. It
contains the label as a headline and executes `$this->generateWithError(true)`, 
which in turn will execute `$this->generate()`.

```php
// src/Contao/BackEndWidget/CustomWidget.php
namespace App\Contao\BackEndWidget;

use Contao\StringUtil;
use Contao\Widget;

class CustomWidget extends Widget
{
    protected $blnSubmitInput = true;
    protected $blnForAttribute = true;
    protected $strTemplate = 'be_widget';

    public function generate(): string
    {
        return sprintf(
            '<input type="text" name="%s" id="ctrl_%s" class="tl_custom_widget%s" value="%s">',
            $this->name,
            $this->id,
            ($this->class ? ' ' . $this->class : ''),
            StringUtil::specialchars($this->value)
        );
    }
}
```

To get a better idea on the implementation details and possibilites for back end
widgets, have a look at the source of the [core's widgets][ContaoCoreWidgets].

The widget is registered in the `$GLOBALS['BE_FFL']` array with its own key:

```php
// contao/config/config.php
$GLOBALS['BE_FFL']['custom_widget'] = \App\Contao\BackendWidget\CustomWidget::class;
```

Now the widget can be used as an `inputType` in your DCA.


## Creating Front End Widgets

Similar to the back end example, the following example creates a simple text input
widget (form field) fro the form generator. The input is allowed to be submitted
and the generated label should contain the `for` attribute. The template is set to
`form_myfield` and the CSS class prefix is set to `widget widget-myfield`.

```php
// src/Contao/FrontEndWidget/MyField.php
namespace App\Contao\FrontEndWidget;

use Contao\StringUtil;
use Contao\Widget;

class MyField extends Widget
{
    protected $blnSubmitInput = true;
    protected $blnForAttribute = true;
    protected $strTemplate = 'form_myfield';
    protected $strPrefix = 'widget widget-myfield';

    public function generate(): string
    {
        // Not actually used
        return '';
    }
}
```

This time the widget's HTML output is done in the template file where we extend
the `form_row` template (see [template inheritance][TemplateInheritance]).

```html
<?php $this->extend('form_row'); ?>

<?php $this->block('label'); ?>
  <?= $this->generateLabel() ?>
<?php $this->endblock(); ?>

<?php $this->block('field'); ?>
  <?php if ($this->hasErrors()): ?>
    <p class="error"><?= $this->getErrorAsString(); ?></p>
  <?php endif; ?>

  <input 
    type="text" 
    name="<?= $this->name ?>" 
    id="ctrl_<?= $this->id ?>" 
    class="text<?php if ($this->class): ?> <?= $this->class ?><?php endif; ?>" 
    value="<?= Contao\StringUtil::specialchars($this->value) ?>"
  >
<?php $this->endblock(); ?>
```

To get a better idea on the implementation details and possibilites for front end
widgets, have a look at the source of the [core's form fields][ContaoCoreFormFields]
and [their templates][ContaoCoreFormFieldTemplates].

The widget is registered in the `$GLOBALS['TL_FFL']` array with its own key:

```php
// contao/config/config.php
$GLOBALS['TL_FFL']['myfield'] = \App\Contao\FrontEndWidget\MyField::class;
```

Now the widget can be selected as an additional form field in the form generator.
To translate the form field's name, use the `FFL.myfield.0` & `FFL.myfield.1` key
in the `contao_default` domain, e.g.

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['FFL']['myfield'] = [
    'My custom form field',
    'Provides a custom form field.'
];
```


[FormGenerator]: https://docs.contao.org/manual/en/form-generator/
[DcaFields]: /reference/dca/fields/
[ContaoCoreWidgets]: https://github.com/contao/contao/tree/master/core-bundle/src/Resources/contao/widgets
[TemplateInheritance]: /framework/templates/#template-inheritance
[ContaoCoreFormFields]: https://github.com/contao/contao/tree/master/core-bundle/src/Resources/contao/forms
[ContaoCoreFormFieldTemplates]: https://github.com/contao/contao/tree/master/core-bundle/src/Resources/contao/templates/forms

---
title: "Content Elements"
---

In Contao, Content Elements are the fundamental content blocks. In its simplest
form it is a controller which receives data in form of a content model and returns
a response.



```php
<?php

declare(strict_types=1);

namespace App\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyContentElement extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $template->title = $model->headline;
        $template->text = $model->text;
        
        return $template->getResponse();
    }
}
```

```yaml
# config/services.yaml
services:
    App\ContentElement\MyContentElement:
        tags:
            - { name: contao.content_element, category: texts }
```

```html
<!-- templates/ce_my_content_element.html5 -->
<div class="my-content-element">
    <h2><?= $this->title; ?></h2>
    
    <?= $this->text; ?>
</div>
```

```php
<?php // src/Resources/contao/dca/tl_content.php

$GLOBALS['TL_DCA']['tl_content']['palettes']['my_content_element'] = '
    {type_legend},type;
    {text_legend),title,text;
';
```

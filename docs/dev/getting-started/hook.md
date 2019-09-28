---
title: "Implementing Hooks"
description: "Implementing your first Hooks in Contao."
weight: 600
aliases:
  - /getting-started/hook/
---


Another core concept of Contao are so called _Hooks_. They allow you to implement
custom logic in certain points of the execution flow of Contao's framework. To better
understand what that means, two examples will be shown in this getting-started tutorial.

Assuming you have autoloaded and autoregistered your services as described [here][1],
implementing a hook is as easy as creating one single PHP file containing your hook's
logic. Hooks can be registered through service tagging and thus we can also use
annotations directly in your hook's class to register the hook.

For our first example we assume that we want to provide more information about the 
author of a news entry in the news template. Usually `$this->author` in the news
template is simply filled with _by &lt;Author Name&gt;_. No other information about
the author is available via the news template's variables. Instead of fetching the
information we need with custom PHP code in the template, we can instead implement
a [`parseArticles`][2] hook. This hook allows us to enrich the template object of
a news entry with additional variables, before the template is parsed for each news
entry. The implementation of this hook also uses the concept of Contao's _Models_: 
the database entry of the news entry's author is fetched via the `\Contao\UserModel`.

```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\UserModel;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ParseArticlesListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("parseArticles")
     */
    public function onParseArticles(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Fetch the news entry's author
        $author = UserModel::findByPk($newsEntry['author']);

        // Override the "author" variable of the template with the row information of the author
        $template->author = $author->row();
    }
}
```

Now, in _any_ of our news templates, we can access _any_ information about the news
entry's author directly.

```diff
 <!-- templates/news_short.html5 -->
 <div class="layout_short arc_<?= $this->archive->id ?> block<?= $this->class ?>" itemscope itemtype="http://schema.org/Article">
 
-  <?php if ($this->hasMetaFields): ?>
-    <p class="info"><time datetime="<?= $this->datetime ?>" itemprop="datePublished"><?= $this->date ?></time> <?= $this->author ?> <?= $this->commentCount ?></p>
-  <?php endif; ?>
+  <p class="author"><a href="mailto:<?= $this->author->email ?>"><?= $this->author->name ?></a></p>

   <h2 itemprop="name"><?= $this->linkHeadline ?></h2>
 
   <div class="ce_text block" itemprop="description">
     <?= $this->teaser ?>
   </div>
 
   <?php if ($this->hasText || $this->hasTeaser): ?>
     <p class="more"><?= $this->more ?></p>
   <?php endif; ?>
 
 </div>
```

The following more complex example shows how to customize the login procedure for
your members. Assume you have an external service, against which the personal data 
of members need to be kept in sync, whenever a member changes his personal data. 
The _Personal data_ module of Contao provides a [updatePersonalData][3] hook which
will be triggered when, as the name of the hook suggests, a member updates his personal
data via this module.

```php
// src/EventListener/UpdatePersonalDataListener.php
namespace App\EventListener;

use App\ExternalMembers\ExternalMemberService;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Contao\FrontendUser;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class UpdatePersonalDataListener implements ServiceAnnotationInterface
{
    private $externalMemberService;

    public function __construct(ExternalMemberService $externalMemberService)
    {
        $this->externalMemberService = $externalMemberService;
    }

    /**
     * @Hook("updatePersonalData")
     */
    public function onUpdatePersonalData(FrontendUser $member, array $data, Module $module): void
    {
        $this->externalMemberService->updateMemberData($data);
    }
}
```

The hook requests an instance of a hypothetical `ExternalMemberService`. Whenever
a member updates her or his personal data, the hook will be triggered and the updated
data will be sent to that service, which then handles updating the member's data
in that external service.

These are just some basic examples of what could be done with hooks, providing a
glimpse into the possibilities. To learn more about hooks, visit the [dedicated article][3]
of the framework documentation and have a look at the complete [reference of hooks][4].


[1]: /getting-started/starting-development/#autoloading-services-and-actions
[2]: /reference/hooks/parsearticles/
[3]: /framework/hook/
[4]: /reference/hooks/

---
title: Content Routing
description: "URL generation for database records in Contao."
---


{{< version "5.3" >}}

In Symfony you can generate the URL to the routes of controllers via the [`router` service][RouterService]. However,
in Contao you also want to generate front end URLs for your objects (like a news item for example) - or just
for a regular page.

Contao **5.3** introduces a system with which you can implement "URL resolvers" for your own objects (models,
Doctrine entities) and then use the `ContentUrlGenerator` service to generate URLs to these database records - or to any of the
other existing models in Contao, like news or pages.


## Content URL Generation

Since Contao **5.3** this can be done via the `ContentUrlGenerator` service, which works analogous to the Symfony
router service. It has a `generate()` method, just like the Symfony URL generator - but instead of a route name it
expects an object for which the URL should be generated as its first parameter. You can also optionally pass parameters
for the URL generation and also define the URL reference type (e.g. absolute URL, absolute path, etc.).

This is important for when your front end module references a page as the redirect target for a form for example. Or
if your front end module creates a news list and you need the URL to the detail page of each news item.

```php
// src/MyService.php
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MyService
{
    public function __construct(private readonly ContentUrlGenerator $contentUrlGenerator)
    {
    }

    public function __invoke()
    {
        $page = PageModel::findBy(…);

        // Generates an absolute URL for the given page
        $pageUrl = $this->contentUrlGenerator->generate($page, [], UrlGeneratorInterface::ABSOLUTE_URL);

        $news = NewsModel::findBy(…);

        // Generates an absolte path for the given news item
        $newsUrl = $this->contentUrlGenerator->generate($news, [], UrlGeneratorInterface::ABSOLUTE_PATH);
    }
}
```

But suppose you have a front end module that fetches your objects from the database and then lists them via a template
in the front end:

```php
// src/Controller/FrontendModule/FoobarListController.php
namespace App\Controller\FrontendModule;

use App\Model\FoobarModel;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule]
class FoobarListController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $template->items = FoobarModel::findAll(['order' => 'title ASC']);

        return $template->getResponse();
    }
}
```

You can generate the URL directly in your template via the `content_url()` Twig function:

```twig
{# templates/frontend_module/foobar_list.html.twig #}
{% extends "@Contao/frontend_module/_base.html.twig" %}

{% block content %}
    {% for item in items %}
        <div class="item">
            <a href="{{ content_url(item) }}">{{ item.title }}</a>
        </div>
    {% endfor %}
{% endblock %}
```


## Content URL Resolver

For your own database records (i.e. for your own models or entities) you can register a "content URL resolver" which the
`ContentUrlGenerator` will then invoke whenever the generation of an URL is requested. Such a resolver needs to
implement the `ContentUrlResolverInterface`:

```php
namespace Contao\CoreBundle\Routing\Content;

use Contao\PageModel;

interface ContentUrlResolverInterface
{
    /**
     * Returns a result for resolving the given content.
     *
     * - ContentUrlResult::url() if the content has a URL string that could be relative or contain insert tags.
     * - ContentUrlResult::redirect() to generate the URL for a new content instead of the current one.
     * - ContentUrlResult::resolve() to generate the URL for the given PageModel with the current content.
     *
     * Return NULL if you cannot handle the content.
     */
    public function resolve(object $content): ContentUrlResult|null;

    /**
     * Returns an array of parameters for the given content that can be used to
     * generate a URL for this content. If the parameter is used in the page alias, it
     * will be used to generate the URL. Otherwise, it is ignored (contrary to the
     * Symfony URL generator which would add it as a query parameter).
     *
     * @return array<string, string|int>
     */
    public function getParametersForContent(object $content, PageModel $pageModel): array;
}
```

The resolver service also needs to be tagged with `contao.content_url_resolver` (done automatically through the
interface, if auto configuration is enabled).

Each content URL resolver will receive an `object` for which the URL is supposed to be generated. Each resolver then
needs to decide whether they are responsible for that type of object and otherwise return `null`.

Let's have a look at Contao's own news URL resolver as an example:

```php
namespace Contao\NewsBundle\Routing;

use Contao\ArticleModel;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Routing\Content\ContentUrlResolverInterface;
use Contao\CoreBundle\Routing\Content\ContentUrlResult;
use Contao\NewsArchiveModel;
use Contao\NewsModel;
use Contao\PageModel;

class NewsResolver implements ContentUrlResolverInterface
{
    public function __construct(private readonly ContaoFramework $framework)
    {
    }

    public function resolve(object $content): ContentUrlResult|null
    {
        if (!$content instanceof NewsModel) {
            return null;
        }

        switch ($content->source) {
            // Link to an external page
            case 'external':
                return ContentUrlResult::url($content->url);

            // Link to an internal page
            case 'internal':
                $pageAdapter = $this->framework->getAdapter(PageModel::class);

                return ContentUrlResult::redirect($pageAdapter->findPublishedById($content->jumpTo));

            // Link to an article
            case 'article':
                $articleAdapter = $this->framework->getAdapter(ArticleModel::class);

                return ContentUrlResult::redirect($articleAdapter->findPublishedById($content->articleId));
        }

        $pageAdapter = $this->framework->getAdapter(PageModel::class);
        $archiveAdapter = $this->framework->getAdapter(NewsArchiveModel::class);

        // Link to the default page
        return ContentUrlResult::resolve(
            $pageAdapter->findPublishedById((int) $archiveAdapter->findById($content->pid)?->jumpTo)
        );
    }

    public function getParametersForContent(object $content, PageModel $pageModel): array
    {
        if (!$content instanceof NewsModel) {
            return [];
        }

        return ['parameters' => '/'.($content->alias ?: $content->id)];
    }
}
```

The news resolver first checks whether the given `$content` is an instance of `NewsModel`. Depending on the type of news
either of these 3 things will happen next:

* If the news is simply a reference to an external URL, the news URL resolver returns a `ContentUrlResult` with the 
stored URL as its `StringUrl` content. This will cause the result to be forwarded to the `StringResolver`, which will
then process the URL further (i.e. replace insert tags and make sure that the URL reference type matches the requested
type).
* If the news redirects to a Contao page or article (and not to a news reader), a `ContentUrlResult` with the page or article as its content
will be returned. This will cause the result to be forwarded to the `PageResolver` or `ArticleResolver` respectively.
* Otherwise the news resolver determines the target page of the news item's archive and returns a `ContentUrlResult`
with that page as its content.

The difference in the latter case is the usage of `ContentUrlResult::resolve()` rather than 
`ContentUrlResult::redirect()`. In this case the URL will be resolved for the given target with the current content as
the target's content.

This is important for the second part of the interface: `getParametersForContent()`. Here your URL resolver can define
what parameters should be used during URL generation when generating the URL for your resolved content. For example, if your
content is expected to be shown on a regular page of Contao (like in the news item example) then you might want to
define the `parameters` parameter (see [Legacy Parameters][LegacyParameters]). Or if your content is expected to be
shown within a certain [page controller][PageControllers] you can generate the parameters that your page controller's
route uses for the given content.


### Custom Example

The follwing shows a custom example using a page controller. Let's say you have a custom DCA `tl_foobar` and an 
accompanying `FoobarModel`:

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar'] = […];
```

```php
// src/Model/FoobarModel.php
namespace App\Model;

use Contao\Model;

class FoobarModel extends Model
{
    protected static $strTable = 'tl_foobar';
}
```

```php
// contao/config/config.php
use App\Model\FoobarModel;

$GLOBALS['BE_MOD']['content']['Foobar'] = ['tables' => ['tl_foobar']];
$GLOBALS['TL_MODELS']['tl_foobar'] = FoobarModel::class;
```

You want to render the details of these records via your own page controller and front end module:

```php
// src/Controller/Page/FoobarReaderController.php
namespace App\Controller\Page;

use App\Model\FoobarModel;
use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\FrontendIndex;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsPage(path: '{foobarId}', requirements: ['foobarId' => '\d+'])]
class FoobarReaderController
{
    public function __invoke(Request $request, PageModel $pageModel, int $foobarId): Response
    {
        if (!$record = FoobarModel::findById($foobarId)) {
            throw new PageNotFoundException();
        }

        $request->attributes->set('_content', $record);

        return (new FrontendIndex())->renderPage($pageModel);
    }
}
```

Now our resolver to generate URLs to these records could look like this:

```php
// src/Routing/FoobarResolver.php
namespace App\Routing;

use App\Model\FoobarModel;
use Contao\CoreBundle\Routing\Content\ContentUrlResolverInterface;
use Contao\CoreBundle\Routing\Content\ContentUrlResult;
use Contao\CoreBundle\Routing\PageFinder;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\RequestStack;

class FoobarResolver implements ContentUrlResolverInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly PageFinder $pageFinder,
    ) {
    }

    public function resolve(object $content): ContentUrlResult|null
    {
        if (!$content instanceof FoobarModel) {
            return null;
        }

        if (!$request = $this->requestStack->getCurrentRequest()) {
            return null;
        }

        /**
         * This is a simplification for this example. We simply look for the first "foobar_reader" page type in this
         * website and assume that this is the correct page for which we want to generate the detail URL of our record.
         */
        $foobarPage = $this->pageFinder->findFirstPageOfTypeForRequest($request, 'foobar_reader');

        return ContentUrlResult::resolve($foobarPage);
    }

    public function getParametersForContent(object $content, PageModel $pageModel): array
    {
        if (!$content instanceof FoobarModel) {
            return [];
        }

        return ['foobarId' => (int) $content->id];
    }
}
```

As you can see within our `getParametersForContent()` method we return a value for the `foobarId` parameter as this is
the required parameter for our page controller for which we are leting the content URL resolver generate the URL in our
own resolver above.


[SymfonyGenerateUrls]: https://symfony.com/doc/5.x/routing.html#generating-urls
[RouterService]: /reference/services/#router
[LegacyParameters]: /framework/routing/legacy-parameters/
[PageControllers]: /framework/page-controllers/

# Contributing


## Documented versions

Only major versions are documented (e.g. Contao 4 and later on Contao 5).


## General rules

* Only use ATX style headlines (e.g. `# H1` or `### H3`).
* See [learn.netlify.com/en/cont/markdown/](https://learn.netlify.com/en/cont/markdown/) 
  and [learn.netlify.com/en/shortcodes/notice/](https://learn.netlify.com/en/shortcodes/) 
  for available markdown and shortcode syntax.
* Always add two empty lines above each headline.
* Add line breaks after 80 characters in paragraphs.
* Code examples should follow the Symfony Best Practices Book, use PHP 7.1 and
  put Contao related files to `contao`.
* When using examples for PHP code or YAML configurations etc., include the example
  path to the file as a comment as the very first line. Do not use the `<?php` open
  tag and also do not use the `declare()` statement.

Example for link references:
```
Lorem ipsum dolor [sit amet](https://contao.org/) consectetuer adipiscing elitr. Aenean massa. 
Cum sociis [natoque](https://www.google.com/) penatibus et magnis dis.
```


## New features

Since we will not maintain different versions of the documentation for each minor 
Contao version, some features will be documented which are only available in newer 
Contao version. In such a case, document the _old_ way first (if applicable), then 
show the new way with a notice of the minimum Contao version required.

You can use the following short code to automatically add a note for features of a 
specific Contao version:

```
{{< version "4.7" >}}
```


### Example:

```markdown
## DCA callbacks

### PHP array configuration 

…

### Service tag

{{< version "4.8" >}}
```


## Structure


### Manual

TBD


### Development documentation

The development documentation is split into three parts:

* Documentation
* Reference
* Cookbook


#### Documentation

This part of the development documentation should explain features of the Contao framework and how to use them. e.g. Templates, Palette Manipulator, image generation, etc. with references to the cookbook.


#### Reference

This part of the development documentation should be a full reference of all available hooks, callbacks, DCA configuration, available config settings, etc.


#### Cookbook

This should contain specific examples and use cases on how to use and implement the previously mentioned topics.


## Some notes about your markdown contribution

* The paths and filenames should be english
* Consider that all markdown headings are taken over in the page navigation of the documentation
* Use images by copying existing or create new ones only


## The hugo front matter variables

Every file needs at least the following [hugo front matter](https://gohugo.io/content-management/front-matter/) variables on top of your markdown content:

* `title`: A title for the file (language specific). This entry refletcs the main left navigation of the documentation also.
* `description`: The content description (language specific).
* `url`: The url path to build (language specific). This should only be used, if you want the path to be different from the physical path. e.g. for the german translation.
* `weight`: Used for the sorting order in the left main navigation of the documentaion. The weight might not be necessary everywhere. It's only necessary, when files need to be sorted by something other than the default sorting (i.e. sorted by name).
* `menuTitle` (optional): The optional menuTitle entry reflects an alternative entry in the main left navigation of the documentaion. This is especially helpful if the original title is too long for the navigation.


## Workflow examples to contribute to the Contao docs repo.


### GitHub only workflow 

All you need to contribute to the documentation is a GitHub account. There are no further installations necessary. This approach is handy for changing existing content, for example to change spelling mistakes. If you want to create new content we recommend the "Local Workflow".

First step is to [fork](https://help.github.com/en/github/getting-started-with-github/fork-a-repo) the [Contao docs repo](https://github.com/contao/docs) (recommended). As an alternative, you could also edit the markdown files directly in the [Contao docs repo](https://github.com/contao/docs) and save your changes with a comment. GitHub will then automatically create a fork and a new branch with your changes in your repository (named "patch-1" for example).

Eiher way, switch to your repository and branch and make a pull request. If your changes are taken over by the Contao team, you will receive corresponding information.

If the Contao team does not want to accept your changes without further actions, switch to the appropriate branch of your forked repository and change the content accordingly. 

It is also possible that the Contao team leave some direct suggestions in the PR (see: [Allowing changes to a pull request branch created from a fork](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/allowing-changes-to-a-pull-request-branch-created-from-a-fork)). If you agree with the proposal you can commit one or more of the suggestions within the PR (see: [Incorporating feedback in your pull request](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/incorporating-feedback-in-your-pull-request)). Your commits are then taken over to your forked repository.


### Local Workflow  

Unlike "GitHub only workflow", you want to have the GitHub fork locally available and then edit it with your favorite IDE. For this [git](https://git-scm.com/) must be installed on your computer. Another advantage is that you could then preview your changes locally right inside the documenation (with a installed [hugo](https://gohugo.io/) version) before you upload your changes and start a pull request. This is especially useful when creating new files.

Most of the commands mentioned here can probably be triggered easily within your favorite development environment. For example: With the free [Visual Studio Code](https://code.visualstudio.com/docs/editor/versioncontrol) Editor.


#### Step 1: Clone your fork

* [Fork](https://help.github.com/en/github/getting-started-with-github/fork-a-repo) the [Contao docs repo](https://github.com/contao/docs)
* Clone the forked repo

```bash
git clone --recurse-submodules https://github.com/YOUR-USERNAME/docs
```


#### Step 2: Configure a remote that points to the upstream repository (see: [GitHub help](https://help.github.com/en/articles/configuring-a-remote-for-a-fork) ) 

```bash
git remote add upstream https://github.com/contao/docs.git
git remote -v
```

#### Step 3: Edit and preview your changes 

Within your cloned directory, switch to the `page` subdirectory and let the hugo server watch your changes. 

```bash
cd page
hugo server --cleanDestinationDir --environment manual --destination ../build/manual 
```

This would start the hugo server (with the Contao manual here), watching for your changes and write them to "../build/manual". Edit your files and preview the results in the browser via 127.0.0.1:1313.

#### Step 4: Upload to your forked repo

If you are satisfied with your changes you could then stage/commit/push these to your forked repository. For example:

```bash
git add .
git commit -m "Describe your change here"
git push
```

> Please [check](https://git-scm.com/docs/git-pull) before you update that no recent changes from others are available. It is therefore recommended to keep your local data up to date before you upload it.

#### Step 5: Make a pull request

At this point it is time to make your pull request. You can do this either within Github itself or with the possibilities of the development environment of your choice. For example with "Visual Studio Code" you need this extension: [GitHub Pull Requests](https://marketplace.visualstudio.com/items?itemName=GitHub.vscode-pull-request-github).


# CWP Themes module

This module provides some added configuration and underlying functionality to support the `cwp/starter-theme` and `cwp/watea-theme` CWP themes.

## Installation

This module will be installed as a dependency when you install one of the themes listed above.

If you need to install this module on its own you can do so via `composer require cwp/ageny-extensions`.

## Requirements

* SilverStripe CMS/framework 3.2 or above

## CWP Search

Search has its own form and search index. To override the search index used, you can create your own and add the following to your `config.yml`:

```
Injector:
  CWPIndexer:
    class: CWPModuleSearchIndex
```

Replace `CWPModuleSearchIndex` with your own Index class.

To change the amount of search results per page, add the following to your configuration:

```
CWPSearchController:
  page_limit: 10
```

The `page_limit` is changeable to whatever limit you prefer.

## Bootstrap 3

The themes that this module supports use [Bootstrap 3](http://getbootstrap.com/) as a frontend framework. This module has some extensions that inject Bootstrap HTML attributes into various parts of SilverStripe, including `Form`, `FormField`, etc.

## Accessibility

As with Bootstrap 3, another priority of the themes that this module supports is to have high accessibility. This module injects some extra aria attributes on top of what is already provided by the SilverStripe framework.

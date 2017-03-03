# CWP Themes module

This module provides some added configuration and underlying functionality to support the `cwp/starter-theme` and `cwp/watea-theme` CWP themes.

## Installation

This module will be installed as a dependency when you install one of the themes listed above.

If you need to install this module on its own you can do so via `composer require cwp/ageny-extensions`.

## Requirements

* cwp/cwp 1.6.0 or above

## Bootstrap 3

The themes that this module supports use [Bootstrap 3](http://getbootstrap.com/) as a frontend framework. This module has some extensions that inject Bootstrap HTML attributes into various parts of SilverStripe, including `Form`, `FormField`, etc.

## Accessibility

As with Bootstrap 3, another priority of the themes that this module supports is to have high accessibility. This module injects some extra aria attributes on top of what is already provided by the SilverStripe framework.

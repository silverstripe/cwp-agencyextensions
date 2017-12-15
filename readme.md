# CWP Agency Extensions Module

[![Build Status](https://travis-ci.org/silverstripe/cwp-agencyextensions.svg?branch=master)](https://travis-ci.org/silverstripe/cwp-agencyextensions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/cwp-agencyextensions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/cwp-agencyextensions/?branch=master)

This module provides some added configuration and underlying functionality that may be useful to allow clients/agencies to adjust website functionality theirselves, or to provide additional functionality that may not always be required for a CWP project.

## Summary of contents

This module provides the following (may not be a definitive list):

* [Carousel/hero image](docs/en/01_Features/Carousel.md) for the home page
* Customise search results labels from SiteConfig
* Upload custom header and footer logos from SiteConfig
* Upload custom favicon and Apple touch logos from SiteConfig
* Define an AddThis social media profile ID (used in CWP default theme, for example) from SiteConfig
* Add frontend asset requirements for the CWP default theme
* [FontAwesome](http://fontawesome.io) icon popup dialog to the TinyMCE content editor (Wātea theme only, by default)

## Installation

This module will automatically be installed along with either the "default" or Wātea CWP themes.

If you want to install this module on its own you can do so with Composer:

```
composer require cwp/agency-extensions
```

## Requirements

* `cwp/cwp` 1.6.0 or above

## Documentation

### Features

* [Carousel/hero image](docs/en/01_Features/Carousel.md)
* [FontAwesome icon plugin for TinyMCE](docs/en/01_Features/FontAwesomePlugin.md)

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

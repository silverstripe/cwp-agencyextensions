# CWP Agency Extensions Module

[![Build Status](https://travis-ci.org/silverstripe/cwp-agencyextensions.svg?branch=master)](https://travis-ci.org/silverstripe/cwp-agencyextensions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/cwp-agencyextensions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/cwp-agencyextensions/?branch=master)
[![codecov](https://codecov.io/gh/silverstripe/cwp-agencyextensions/branch/master/graph/badge.svg)](https://codecov.io/gh/silverstripe/cwp-agencyextensions)

This module provides some added configuration and underlying functionality that may be useful to allow clients/agencies to adjust website functionality theirselves, or to provide additional functionality that may not always be required for a CWP project. It provides the content management side of the functionality provided by the Watea theme (specifically the Carousel).

## Summary of contents

This module provides the following (may not be a definitive list):

* [Carousel/hero image](docs/en/01_Features/Carousel.md) for the home page
* Customise search results labels from SiteConfig
* Upload custom header and footer logos from SiteConfig
* Upload custom favicon and Apple touch logos from SiteConfig
* [FontAwesome](http://fontawesome.io) icon popup dialog to the TinyMCE content editor (Wātea theme only, by default)

## Installation

This module will automatically be installed along with either the "default" or Wātea CWP themes.

If you want to install this module on its own you can do so with Composer:

```
composer require cwp/agency-extensions
```

## Requirements

* `cwp/cwp` 2.0 or above

**Note** For use with CWP versions less than 2, please see the `1.x` [release line](https://github.com/silverstripe/cwp-agencyextensions/releases).

## Documentation

### Features

* [Carousel/hero image](docs/en/01_Features/Carousel.md)
* [FontAwesome icon plugin for TinyMCE](docs/en/01_Features/FontAwesomePlugin.md)

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

## Notes

This library includes a version of the [TinyMCE-FontAwesome-Plugin by Josh18](https://github.com/josh18/TinyMCE-FontAwesome-Plugin) which is open and permissive via the [expat/MIT Licence](https://en.wikipedia.org/wiki/MIT_License).

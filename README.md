# CWP Agency Extensions Module

[![CI](https://github.com/silverstripe/cwp-agencyextensions/actions/workflows/ci.yml/badge.svg)](https://github.com/silverstripe/cwp-agencyextensions/actions/workflows/ci.yml)
[![Silverstripe supported module](https://img.shields.io/badge/silverstripe-supported-0071C4.svg)](https://www.silverstripe.org/software/addons/silverstripe-commercially-supported-module-list/)

This module provides some added configuration and underlying functionality that may be useful to allow clients/agencies to adjust website functionality theirselves, or to provide additional functionality that may not always be required for a CWP project. It provides the content management side of the functionality provided by the Watea theme (specifically the Carousel).

## Summary of contents

This module provides the following (may not be a definitive list):

* [Theme colour picker](docs/en/01_Features/ThemeColors.md). Allows CMS users to adjust the colours of different areas of their site without requiring developer intervention
* [Carousel/hero image](docs/en/01_Features/Carousel.md) for the home page
* Customise search results labels from SiteConfig
* Upload custom header and footer logos from SiteConfig
* Upload custom favicon and Apple touch logos from SiteConfig
* Customisable theme colours in site settings

## Installation

This module will automatically be installed along with either the "default" or Wātea CWP themes.

If you want to install this module on its own you can do so with Composer:

```sh
composer require cwp/agency-extensions
```

## Documentation

### Features

* [Theme colour picker](docs/en/01_Features/ThemeColors.md)
* [Carousel/hero image](docs/en/01_Features/Carousel.md)
* [Customisable theme colours](docs/en/01_Features/ThemeColors.md)

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

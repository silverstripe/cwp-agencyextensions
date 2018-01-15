title: Carousel
summary: Information regarding the use of the carousel extension

# Carousel/hero image

The carousel extension provides the ability to add a carousel of images and/or text to a Page.

## Configuration

To add the extension to a page, add the extension to your Page type via the YAML configuration. E.g. in `_config/config.yml`:

```yml
CWP\CWP\PageTypes\BaseHomePage:
  extensions:
    - CWP\AgencyExtensions\Extensions\CarouselPageExtension
```

This will add a "Carousel" tab in the CMS when you edit a BaseHomePage. From here you can manage the slides for your
carousel.
**Note:** The configuration in the example is enabled by default (Carousels are applied to CWP's BaseHomePage).

## Usage

By adding a carousel item to your home page in via the Hero/Carousel tab in the CMS, you will enable the carousel functionality.

You can add an image and/or some content text as well as a heading, and a primary and secondary call to action link with label. All of these content areas are optional.

When adding a single item to the carousel/hero area, the image will automatically be displayed as a banner image on the home page. Once you add two or more items to the carousel the carousel's controls will be added: previous and next slide, etc.

## Templates

For an example of templates for the carousel, please see either the Wātea theme or the "default" theme.

The Wātea theme includes an example of a fully functional and accessible carousel with controls.

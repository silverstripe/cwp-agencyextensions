title: Theme colours
summary: Information on configuration around the theme colour picker

# Theme colour picker

The theme colour picker is a way of providing CMS users to adjust the colours of different areas of their site without requiring developer intervention.

## Enabling

By default the theme colour picker is disabled, to enable this you can adjust your YAML configuration. E.g. in `_config/config.yml`:

```yml
SilverStripe\SiteConfig\SiteConfig:
  enable_theme_color_picker: true
```

## Adjusting/adding colours

The theme colours are all configurable, so via YAML configuration you can adjust existing colours or add new ones to the theme colour picker. see CWPSiteConfigExtension#theme_colors for a list of the default colours.

```yml
SilverStripe\SiteConfig\SiteConfig:
  enable_theme_color_picker: true
  theme_colors:
    # Edit existing pink colour
    pink:
      Color: '#C12099'
    # Add new brown colour
    brown:
      Title: 'Brown'
      CSSClass: 'brown'
      Color: '#594116'
```

Now you can add the matching colour to your scss. Assuming your project is using a custom theme which imports watea's `main.scss` file, create a `$custom-theme-colors` as follows:

```scss
// themes/customtheme/scss/main.scss

// Ensure this variable is set before importing watea scss
$custom-theme-colors: (
  'pink': #C12099, // Adjusting existing pink colour
  'brown': #594116 // Adding new brown colour
);

@import '../../../watea/src/scss/main';
```

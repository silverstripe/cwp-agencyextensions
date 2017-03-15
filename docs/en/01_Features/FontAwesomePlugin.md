title: FontAwesome TinyMCE Plugin
summary: How to enable and use the FontAwesome icon plugin for TinyMCE

# FontAwesome TinyMCE Plugin

This module comes with a TinyMCE plugin which is enabled by default when using the Wātea theme, and can be enabled for your custom theme. It adds a popup to the TinyMCE editor for pages so you can select a [FontAwesome icon](https://fontawesome.io) to be added to your content area.

## Configuration

The plugin is enabled by detecting the current theme. For Wātea (registered as "starter" as it is a subtheme) it is enabled by default.

If you want to enable the plugin for your own custom theme you can define a constant in your `_ss_environment.php` file:

    define('CWP_AGENCY_ENABLE_FONTAWESOME_PLUGIN', true);

You will need to ensure that your theme templates reference a FontAweome CSS stylesheet to allow the icons to be rendered. The Wātea theme has this enabled by default. If you need to add it, you could use [the BootstrapCDN for FontAwesome](https://www.bootstrapcdn.com/fontawesome/).

title: FontAwesome TinyMCE Plugin
summary: How to enable and use the FontAwesome icon plugin for TinyMCE

# FontAwesome TinyMCE Plugin

This module comes with a TinyMCE plugin which is enabled by default. It adds a popup to the TinyMCE editor for pages so you can select a [FontAwesome icon](https://fontawesome.io) to be added to your content area.

## Configuration

You will need to ensure that your theme templates reference a FontAweome CSS stylesheet to allow the icons to be rendered. The Wātea theme has this enabled by default. If you need to add it, you could use [the BootstrapCDN for FontAwesome](https://www.bootstrapcdn.com/fontawesome/).

## Disabling the plugin

The plugin is enabled by default. If you want to disable the plugin you can define a constant in your [environment variables](https://docs.silverstripe.org/en/4/getting_started/environment_management/) or `.env` file:

```sh
CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN=1
```
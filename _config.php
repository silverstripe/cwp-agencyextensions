<?php

// The name for the 'starter-theme' theme
define('CWP_THEME_NAME', 'starter');

$cwpEditor = HtmlEditorConfig::get('cwp');
$cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');

// By default the FontAwesome plugin for TinyMCE is enabled when using the "starter" or "Watea" themes.
// You can enable it for your custom theme by defining CWP_AGENCY_ENABLE_FONTAWESOME_PLUGIN = true in your
// environment configuration.
if (SSViewer::current_theme() === CWP_THEME_NAME
    || (defined('CWP_AGENCY_ENABLE_FONTAWESOME_PLUGIN') && CWP_AGENCY_ENABLE_FONTAWESOME_PLUGIN)
) {
    // Add a FontAwesome icon popup to TinyMCE
    $cwpEditor->enablePlugins(array('ssicons' => '../../../agency-extensions/tinymce_plugins/editor_plugin_src.js'));
    $cwpEditor->addButtonsToLine(2, 'ssicons');

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');
}

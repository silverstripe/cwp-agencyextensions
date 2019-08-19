<?php

// Ensure compatibility with PHP 7.2 ("object" is a reserved word),
// with SilverStripe 3.6 (using Object) and SilverStripe 3.7 (using SS_Object)
if (!class_exists('SS_Object')) class_alias('Object', 'SS_Object');

// The name for the 'starter-theme' theme. This is also valid for 'Watea', since it is a subtheme.
define('CWP_THEME_NAME', 'starter');

$cwpEditor = HtmlEditorConfig::get('cwp');

// By default the agency extensions editor CSS stylesheet is added to HtmlEditorConfig. You can disable
// this by setting the config below to true in your configuration.
if (!Config::inst()->get('CwpThemeHelper', 'disable_editor_css')) {
    $cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');
}

// By default the FontAwesome plugin for TinyMCE is enabled. You can disable it by defining
// CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN = true in your environment configuration.
if (!defined('CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN')) {
    // Add a FontAwesome icon popup to TinyMCE
    $cwpEditor->enablePlugins(array('ssicons' => '../../../agency-extensions/tinymce_plugins/editor_plugin_src.js'));
    $cwpEditor->addButtonsToLine(2, 'ssicons');

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');
}

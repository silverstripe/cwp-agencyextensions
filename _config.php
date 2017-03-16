<?php

// The name for the 'starter-theme' theme. This is also valid for 'Watea', since it is a subtheme.
define('CWP_THEME_NAME', 'starter');

$cwpEditor = HtmlEditorConfig::get('cwp');
$cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');

// By default the FontAwesome plugin for TinyMCE is enabled. You can disable it by defining
// CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN = true in your environment configuration.
if (!defined('CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN')) {
    // Add a FontAwesome icon popup to TinyMCE
    $cwpEditor->enablePlugins(array('ssicons' => '../../../agency-extensions/tinymce_plugins/editor_plugin_src.js'));
    $cwpEditor->addButtonsToLine(2, 'ssicons');

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');
}

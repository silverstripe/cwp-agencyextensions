<?php

// The name for the 'starter-theme' theme
define('CWP_THEME_NAME', 'starter');

$cwpEditor = HtmlEditorConfig::get('cwp');

$cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');

// Add a FontAwesome icon popup to TinyMCE
$cwpEditor->enablePlugins(array('ssicons' => '../../../agency-extensions/tinymce_plugins/editor_plugin_src.js'));
$cwpEditor->insertButtonsAfter('ssmacron', 'ssicons');

// Allow span tags in TinyMCE to have aria-hidden attributes
$cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');

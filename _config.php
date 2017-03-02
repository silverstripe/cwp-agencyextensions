<?php

define("CWP_THEME_NAME", "starter");

$cwpEditor = HtmlEditorConfig::get('cwp');

$cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');

$cwpEditor->enablePlugins(array('ssicons' => '../../../cwp-theme-module/tinymce_plugins/editor_plugin_src.js'));
$cwpEditor->insertButtonsAfter ('ssmacron', 'ssicons');

$cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');

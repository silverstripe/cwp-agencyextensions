<?php

define("CWP_THEME_NAME", "new-theme");

HtmlEditorConfig::get('cwp')->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');


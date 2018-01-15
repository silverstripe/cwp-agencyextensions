<?php

use SilverStripe\Core\Config\Config;
use CWP\AgencyExtensions\Helper\CwpThemeHelper;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Core\Manifest\ModuleLoader;
use SilverStripe\View\ThemeResourceLoader;
use SilverStripe\View\SSViewer;

$cwpEditor = HtmlEditorConfig::get('cwp');

// By default the agency extensions editor CSS stylesheet is added to HtmlEditorConfig. You can disable
// this by setting the config below to true in your configuration.
if (!Config::inst()->get(CwpThemeHelper::class, 'disable_editor_css')) {
    $editorCSS = ThemeResourceLoader::inst()->findThemedCSS(
        'editor.css', 
        SSViewer::get_themes()
    );
    $cwpEditor->setOption('content_css', $editorCSS);
}

// By default the FontAwesome plugin for TinyMCE is enabled. You can disable it by defining
// CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN = true in your environment configuration.
if (!Environment::getEnv('CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN')) {
    // Add a FontAwesome icon popup to TinyMCE
    $pluginPath = ModuleLoader::getModule('agency-extensions')
        ->getResource('tinymce_plugins/editor_plugin_src.js')
        ->getURL();
    $cwpEditor->enablePlugins(['ssicons' => $pluginPath]);
    $cwpEditor->addButtonsToLine(2, 'ssicons');

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption('extended_valid_elements', 'span[class|align|style|aria-hidden]');
}

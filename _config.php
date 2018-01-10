<?php

use SilverStripe\Core\Config\Config;
use CWP\AgencyExtensions\Helper\CwpThemeHelper;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Core\Manifest\ModuleLoader;
use SilverStripe\View\ThemeResourceLoader;
use SilverStripe\View\SSViewer;

// The name for the 'starter-theme' theme. This is also valid for 'Watea', since it is a subtheme.
Environment::setEnv('CWP_THEME_NAME', 'starter');

$cwpEditor = HtmlEditorConfig::get('cwp');

// By default the agency extensions editor CSS stylesheet is added to HtmlEditorConfig. You can disable
// this by setting the config below to true in your configuration.
if (!Config::inst()->get(CwpThemeHelper::class, 'disable_editor_css')) {
    $cwpEditor->setOption(
        'content_css', 
        ThemeResourceLoader::inst()->findThemedCSS(
            'editor.css', 
            SSViewer::get_themes()
        )
    );
    // $cwpEditor->setOption('content_css', 'themes/' . SSViewer::current_theme() . '/dist/css/editor.css');
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

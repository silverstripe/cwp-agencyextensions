<?php

use SilverStripe\Core\Environment;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Core\Manifest\ModuleLoader;

// By default the FontAwesome plugin for TinyMCE is enabled. You can disable it by defining
// CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN = true in your environment configuration.
if (!Environment::getEnv('CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN')) {
    $cwpEditor = HtmlEditorConfig::get('cwp');
    $pluginPath = ModuleLoader::getModule('cwp/agency-extensions')
        ->getResource('thirdparty/TinyMCE-FontAwesome-Plugin/fontawesome/plugin.min.js')
        ->getURL();
    $cwpEditor->enablePlugins(['fontawesome' => $pluginPath]);
    $cwpEditor->addButtonsToLine(2, 'fontawesome');

    $contentCSS = (array)$cwpEditor->getOption('editor_css');
    $contentCSS[] = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
    $cwpEditor->setOption('editor_css', $contentCSS);

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption(
        'extended_valid_elements',
        $cwpEditor->getOption('extended_valid_elements')
        . ',span[class|align|style|aria-hidden]'
    );
}

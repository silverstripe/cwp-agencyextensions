<?php

use SilverStripe\Core\Environment;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

// CWP_AGENCY_DISABLE_FONTAWESOME_PLUGIN used to control whether an actual tinymce plugin was used.
// CWP_AGENCY_ENABLE_FONTAWESOME_STYLES replaces it as the inverse, since that plugin is no longer available.
// This config is here only to control whether legacy config is kept or not, to make upgrading from CMS 4 easier.
if (Environment::getEnv('CWP_AGENCY_ENABLE_FONTAWESOME_STYLES')) {
    $cwpEditor = TinyMCEConfig::get('cwp');

    // Allow span tags in TinyMCE to have aria-hidden attributes
    $cwpEditor->setOption(
        'extended_valid_elements',
        $cwpEditor->getOption('extended_valid_elements') // appending is necessary as setOption is overriding values
        . ',span[class|align|style|aria-hidden]' // later definition will be used in case of multiple elements in config
    );
}

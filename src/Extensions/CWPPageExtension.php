<?php

namespace CWP\AgencyExtensions\Extensions;

use PageController;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * @extends Extension<PageController>
 */
class CWPPageExtension extends Extension
{
    /**
     * See BasePage_Controller::results()
     *
     * @param CwpSearchResult $results
     * @param array $properties
     */
    public function updateSearchResults(&$results, &$properties)
    {
        // Customise empty results
        $customNoSearchResultsText = SiteConfig::current_site_config()->NoSearchResults;
        if ($customNoSearchResultsText) {
            $properties['NoSearchResults'] = $customNoSearchResultsText;
        }

        // Customise empty search
        $customEmptyText = SiteConfig::current_site_config()->EmptySearch;
        if ($customEmptyText) {
            $properties['EmptySearch'] = $customEmptyText;
        }
    }
}

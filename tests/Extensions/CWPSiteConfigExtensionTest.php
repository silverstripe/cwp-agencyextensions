<?php

namespace CWP\AgencyExtensions\Tests\Extensions;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\TextField;
use SilverStripe\SiteConfig\SiteConfig;

class CWPSiteConfigExtensionTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure that the two "search caption" fields exist and are in the right tab
     */
    public function testConfigurableSearchLabelsExistAndAreInCorrectTab()
    {
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertInstanceOf(TextField::class, $fields->fieldByName('Root.SearchOptions.EmptySearch'));
        $this->assertInstanceOf(TextField::class, $fields->fieldByName('Root.SearchOptions.NoSearchResults'));
    }
}

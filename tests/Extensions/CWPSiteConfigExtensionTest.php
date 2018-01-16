<?php

namespace CWP\AgencyExtensions\Tests\Extensions;




use SilverStripe\Forms\FileHandleField;



use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Environment;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\SSViewer;
use SilverStripe\Forms\TextField;
use CWP\AgencyExtensions\Extensions\CWPSiteConfigExtension;


class CWPSiteConfigExtensionTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure that other fields that are removed are only removed when the CWP theme is enabled
     */
    public function testRetinaFieldsAreRemovedByDefault()
    {
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertNull($fields->fieldByName('Root.LogosIcons.LogoRetina'));
    }

    /**
     * Test that the existing fields are not removed when not using the CWP theme
     */
    public function testFieldsAreNotRemovedWhenConfiguredNotTo()
    {
        Config::modify()->set(CWPSiteConfigExtension::class, 'hide_fields', null);
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertInstanceOf(FileHandleField::class, $fields->fieldByName('Root.LogosIcons.LogoRetina'));
    }

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

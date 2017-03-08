<?php

class CWPSiteConfigExtensionTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Nest the configuration for these tests
     *
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();
        Config::nest();
        Config::inst()->update('SSViewer', 'theme', CWP_THEME_NAME);
    }

    /**
     * Ensure that other fields that are removed are only removed when the CWP theme is enabled
     */
    public function testFieldsAreRemovedWhenUsingCwpTheme()
    {
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertNull($fields->fieldByName('Root.LogosIcons.LogoRetina'));
    }

    /**
     * Test that the existing fields are not removed when not using the CWP theme
     */
    public function testFieldsAreNotRemovedWhenNotUsingCwpTheme()
    {
        Config::inst()->update('SSViewer', 'theme', 'simple');
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertInstanceOf(SelectUploadField::class, $fields->fieldByName('Root.LogosIcons.LogoRetina'));
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

    /**
     * Unnest the configuration after these tests
     *
     * {@inheritDoc}
     */
    public function tearDown()
    {
        Config::unnest();
        parent::tearDown();
    }
}

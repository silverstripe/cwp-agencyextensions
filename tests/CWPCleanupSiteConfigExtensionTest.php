<?php

class CWPCleanupSiteConfigExtensionTest extends SapphireTest
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
     * Test that the LogosIcons menu has had its title updated when using the CMS theme
     */
    public function testLogosIconsMenuHasNewTitle()
    {
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertSame('Icons', $fields->findOrMakeTab('Root.LogosIcons')->Title());
    }

    /**
     * Ensure that the two "search caption" fields exist and are in the right tab
     */
    public function testConfigurableSearchLabelsExistAndAreInCorrectTab()
    {
        $fields = SiteConfig::create()->getCMSFields();
        $this->assertInstanceOf(TextareaField::class, $fields->fieldByName('Root.SearchOptions.EmptySearch'));
        $this->assertInstanceOf(TextareaField::class, $fields->fieldByName('Root.SearchOptions.NoSearchResults'));
    }

    /**
     * Test the default return value from EmptySearch
     */
    public function testEmptySearchDefault()
    {
        $result = SiteConfig::create()->EmptySearch();
        $this->assertContains('please enter your search query', $result);
    }

    /**
     * Test that EmptySearch can be overridden from SiteConfig settings
     */
    public function testEmptySearchReturnsConfiguredValueIfDefined()
    {
        $siteConfig = SiteConfig::create(['EmptySearch' => 'Please type something to search']);
        $this->assertSame('Please type something to search', $siteConfig->EmptySearch());
    }

    /**
     * Test the default return value from NoSearchResults
     */
    public function testNoSearchResultsDefault()
    {
        $result = SiteConfig::create()->NoSearchResults();
        $this->assertContains('your search query did not return any results', $result);
    }

    /**
     * Test that NoSearchResults can be overridden from SiteConfig settings
     */
    public function testNoSearchResultsReturnsConfiguredValueIfDefined()
    {
        $siteConfig = SiteConfig::create(['NoSearchResults' => 'Nothing returned.']);
        $this->assertSame('Nothing returned.', $siteConfig->NoSearchResults());
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

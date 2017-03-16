<?php

class CwpThemeHelperTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * @var CwpThemeHelper
     */
    protected $helper;

    public function setUp()
    {
        parent::setUp();
        Config::nest();
        $this->helper = CwpThemeHelper::create();
    }

    /**
     * Ensure that the "default" theme can be detected correctly via configuration settings
     */
    public function testDetectDefaultThemeViaConfig()
    {
        Config::inst()->update('SSViewer', 'theme_enabled', true);
        Config::inst()->update('SSViewer', 'theme', 'default');
        $this->assertTrue($this->helper->getIsDefaultTheme());

        Config::inst()->update('SSViewer', 'theme', 'starter');
        $this->assertFalse($this->helper->getIsDefaultTheme());
    }

    /**
     * Ensure that the "default" theme can be detected correctly via SiteConfig
     */
    public function testDetectDefaultThemeViaSiteConfig()
    {
        $siteConfig = SiteConfig::current_site_config();
        $siteConfig->Theme = 'default';
        $siteConfig->write();
        $siteConfig->flushCache();

        $this->assertTrue($this->helper->getIsDefaultTheme());

        $siteConfig->Theme = 'starter';
        $siteConfig->write();
        $siteConfig->flushCache();

        $this->assertFalse($this->helper->getIsDefaultTheme());
    }

    public function tearDown()
    {
        Config::unnest();
        parent::tearDown();
    }
}

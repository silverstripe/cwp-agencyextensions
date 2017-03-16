<?php

class CwpThemeHelperTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure that the "default" theme can be detected correctly via configuration settings
     */
    public function testDetectDefaultThemeViaConfig()
    {
        Config::inst()->update('SSViewer', 'theme_enabled', true);
        Config::inst()->update('SSViewer', 'theme', 'default');
        $this->assertTrue(CwpThemeHelper::singleton()->getIsDefaultTheme());

        Config::inst()->update('SSViewer', 'theme', 'starter');
        $this->assertFalse(CwpThemeHelper::singleton()->getIsDefaultTheme());
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

        $this->assertTrue(CwpThemeHelper::singleton()->getIsDefaultTheme());

        $siteConfig->Theme = 'starter';
        $siteConfig->write();
        $siteConfig->flushCache();

        $this->assertFalse(CwpThemeHelper::singleton()->getIsDefaultTheme());
    }
}

<?php

namespace CWP\AgencyExtensions\Tests\Helper;





use SilverStripe\Core\Config\Config;
use SilverStripe\View\SSViewer;
use CWP\AgencyExtensions\Helper\CwpThemeHelper;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Dev\SapphireTest;



class CwpThemeHelperTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure that the "default" theme can be detected correctly via configuration settings
     */
    public function testDetectDefaultThemeViaConfig()
    {
        Config::inst()->update(SSViewer::class, 'theme_enabled', true);
        Config::inst()->update(SSViewer::class, 'theme', 'default');
        $this->assertTrue(CwpThemeHelper::singleton()->getIsDefaultTheme());

        Config::inst()->update(SSViewer::class, 'theme', 'starter');
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

    /**
     * Ensure that a customised default theme name can be detected
     */
    public function testRenamedDefaultThemeCanBeDetected()
    {
        Config::inst()->update(SSViewer::class, 'theme_enabled', true);
        Config::inst()->update(SSViewer::class, 'theme', 'default-but-updated');
        Config::inst()->update(CwpThemeHelper::class, 'default_themes', array('default-but-updated'));

        $this->assertTrue(CwpThemeHelper::singleton()->getIsDefaultTheme());
    }
}

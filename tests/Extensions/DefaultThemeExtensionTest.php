<?php

class DefaultThemeExtensionTest extends SapphireTest
{
    protected $requiredExtensions = array(
        'BasePage_Controller' => array('DefaultThemeExtension', 'DefaultThemeExtensionStub')
    );

    /**
     * @var BasePage_Controller
     */
    protected $controller;

    public function setUp()
    {
        parent::setUp();

        if (!is_dir(BASE_PATH . '/themes/default')) {
            $this->markTestSkipped('These tests require the default theme to be installed');
        }

        $this->controller = BasePage_Controller::create();
        $this->controller->init();
    }

    public function testAddCustomStylesAndScripts()
    {
        Config::inst()->update('DefaultThemeExtension', 'disable_default_styles', false);
        Config::inst()->update('DefaultThemeExtension', 'disable_default_scripts', false);

        $this->controller->extend('onAfterInit');

        $javascript = Requirements::backend()->get_javascript();
        $this->assertContains('agency-extensions/tests/Extensions/Stub/agencytest.js', $javascript);
        $this->assertContains('themes/default/js/general.js', $javascript);

        $css = Requirements::backend()->get_css();
        $this->assertArrayHasKey('agency-extensions/tests/Extensions/Stub/agencytest.css', $css);
        $this->assertArrayHasKey('themes/default/css/layout.css', $css);
    }

    public function testDefaultAssetsAreNotAddedWhenDisabledWithConfig()
    {
        Config::inst()->update('DefaultThemeExtension', 'disable_default_scripts', true);
        $this->controller->extend('onAfterInit');
        $javascript = Requirements::backend()->get_javascript();
        $this->assertContains('agency-extensions/tests/Extensions/Stub/agencytest.js', $javascript);
        $this->assertNotContains('themes/default/js/general.js', $javascript);

        Config::inst()->update('DefaultThemeExtension', 'disable_default_styles', true);
        $this->controller->extend('onAfterInit');
        $css = Requirements::backend()->get_css();
        $this->assertArrayHasKey('agency-extensions/tests/Extensions/Stub/agencytest.css', $css);
        $this->assertArrayNotHasKey('themes/default/css/layout.css', $css);
    }
}

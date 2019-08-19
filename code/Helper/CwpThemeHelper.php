<?php

/**
 * The CWP theme helper provides some quick helper methods to support the CWP themes
 *
 * Removed in cwp theme 2.0
 *
 * @deprecated 2.0
 */
class CwpThemeHelper extends SS_Object
{
    /**
     * Define the theme names that will have combined styles and scripts added - see {@link DefaultThemeExtension}
     *
     * @config
     * @var string[]
     */
    private static $default_themes = array('default');

    /**
     * Change this in user code to disable the agency extensions editor.css from being added to HtmlEditorConfig
     *
     * @config
     * @var bool
     */
    private static $disable_editor_css = false;

    /**
     * Decide whether the current configured theme is the "default" CWP theme or a variation of it
     *
     * @return bool
     */
    public function getIsDefaultTheme()
    {
        if (class_exists('SiteConfig') && ($config = SiteConfig::current_site_config()) && $config->Theme) {
            $theme = $config->Theme;
        } elseif (Config::inst()->get('SSViewer', 'theme_enabled') && Config::inst()->get('SSViewer', 'theme')) {
            $theme = Config::inst()->get('SSViewer', 'theme');
        } else {
            $theme = false;
        }
        return in_array($theme, $this->config()->default_themes);
    }
}

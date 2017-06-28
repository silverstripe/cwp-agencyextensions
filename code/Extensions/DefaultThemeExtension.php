<?php
/**
 * This extension provides some extra requirements and functionality for the "default" CWP theme. It extends
 * the BasePage_Controller.
 *
 * @deprecated 2.0.0 Please use the "starter" theme
 */
class DefaultThemeExtension extends Extension
{
    /**
     * Add the default theme's requirements
     */
    public function onAfterInit()
    {
        if (!CwpThemeHelper::singleton()->getIsDefaultTheme()) {
            return;
        }

        // Include base scripts that are needed on all pages
        Requirements::combine_files('scripts.js', $this->getBaseAssets('scripts'));

        // Include base styles that are needed on all pages
        $styles = $this->getBaseAssets('styles');

        // Combine by media type.
        Requirements::combine_files('styles.css', $styles['all']);
        Requirements::combine_files('screen.css', $styles['screen'], 'screen');
        Requirements::combine_files('print.css', $styles['print'], 'print');

        // Extra folder to keep the relative paths consistent when combining.
        Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp-' . SSViewer::current_theme());
    }

    /**
     * Add required base scripts for the default theme
     *
     * @param array $scripts
     */
    public function updateBaseScripts(&$scripts)
    {
        if (!CwpThemeHelper::singleton()->getIsDefaultTheme()) {
            return;
        }

        $themeDir = SSViewer::get_theme_folder();

        $scripts = array_merge($scripts, array(
            THIRDPARTY_DIR .'/jquery/jquery.js',
            THIRDPARTY_DIR .'/jquery-ui/jquery-ui.js',
            "$themeDir/js/lib/modernizr.js",
            "$themeDir/js/bootstrap-transition.2.3.1.js",
            'themes/module_bootstrap/js/bootstrap-collapse.js',
            "$themeDir/js/bootstrap-carousel.2.3.1.js",
            "$themeDir/js/general.js",
            "$themeDir/js/express.js"
        ));
    }

    /**
     * Add required base stylesheets for the default theme
     *
     * @param array $styles
     */
    public function updateBaseStyles(&$styles)
    {
        if (!CwpThemeHelper::singleton()->getIsDefaultTheme()) {
            return;
        }

        $themeDir = SSViewer::get_theme_folder();

        $styles['all'] = !empty($styles['all']) ? $styles['all'] : array();
        $styles['screen'] = !empty($styles['screen']) ? $styles['screen'] : array();
        $styles['print'] = !empty($styles['print']) ? $styles['print'] : array();

        $styles['all'] = array_merge($styles['all'], array(
            "$themeDir/css/layout.css",
            "$themeDir/css/typography.css"
        ));

        $styles['screen'] = array_merge($styles['screen'], array(
            "$themeDir/css/responsive.css"
        ));

        $styles['print'] = array_merge($styles['print'], array(
            "$themeDir/css/print.css"
        ));
    }

    /**
     * Get base styles or scripts from either the owner class that this extension is applied to, or create a new
     * BasePage_Controller to use instead. This prevents missing theme assets on the Security controller.
     *
     * @param string $type "styles" or "scripts"
     * @return array
     */
    protected function getBaseAssets($type)
    {
        $method = 'getBase' . ucfirst($type);
        if ($this->owner->hasMethod($method)) {
            return $this->owner->$method();
        }

        $basePageController = BasePage_Controller::create();
        return $basePageController->$method();
    }
}

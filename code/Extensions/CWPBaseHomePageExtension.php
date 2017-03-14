<?php

class CWPBaseHomePageExtension extends DataExtension
{
    /**
     * Remove icons for themes other than "default".
     * Icon field will be removed in CWP 2.0
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        if (!$this->owner->getIsDefaultTheme()) {
            /** @var CompositeField $compositeField */
            $compositeField = $fields->fieldByName('Root.Features.FeatureOne');
            if ($compositeField) {
                $children = $compositeField->FieldList();
                $children->removeByName(array('FeatureOneCategory', 'FeatureTwoCategory'));
            }
        }
    }

    /**
     * Decide whether the current configured theme is the "default" CWP theme
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
        return $theme === 'default';
    }
}

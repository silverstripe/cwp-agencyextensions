<?php

/**
 * Class CWPCleanupSiteConfigExtension
 *
 * @property SiteConfig|CWPCleanupSiteConfigExtension $owner
 */
class CWPCleanupSiteConfigExtension extends DataExtension
{
    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        if (SSViewer::current_theme() === CWP_THEME_NAME) {
            $fields->removeByName([
                "Tagline",
                "AddThisProfileID",
                "LogoRetina",
                "FooterLogoRetina",
            ]);

            $fields->findOrMakeTab("Root.LogosIcons")->setTitle("Icons");
        }
    }
}

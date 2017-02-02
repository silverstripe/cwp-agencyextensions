<?php

/**
 * Class CWPCleanupSiteConfigExtension
 *
 * @property SiteConfig|CWPCleanupSiteConfigExtension $owner
 * @property string $EmptySearch
 * @property string $NoSearchResults
 */
class CWPCleanupSiteConfigExtension extends DataExtension
{
    private static $db = [
        'EmptySearch' => 'Text',
        'NoSearchResults' => 'Varchar(255)'
    ];
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
            $fields->findOrMakeTab('Root.SearchOptions');
            $fields->addFieldToTab('Root.SearchOptions', TextareaField::create('EmptySearch', _t('CWP.SITECONFIG.EmptySearch', 'Text to display when there is no search query')));
            $fields->addFieldToTab('Root.SearchOptions', TextareaField::create('NoSearchResults', _t('CWP.SITECONFIG.NoResult', 'Text to display when there are no results')));
        }
    }
}

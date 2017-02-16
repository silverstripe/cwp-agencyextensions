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

    /**
     * Return the text for an empty search parameter, defaulting to a translatable value if not already defined
     *
     * @return string
     */
    public function EmptySearch()
    {
        if ($this->owner->EmptySearch) {
            return $this->owner->EmptySearch;
        }

        return _t('CWP.SITECONFIG.EmptySearch', 'Search field empty, please enter your search query.');
    }

    /**
     * Return the text for an empty search result, defaulting to a translatable value if not already defined
     *
     * @return string
     */
    public function NoSearchResults()
    {
        if ($this->owner->NoSearchResults) {
            return $this->owner->NoSearchResults;
        }

        return _t('CWP.SITECONFIG.NoResult', 'Sorry, your search query did not return any results.');
    }
}

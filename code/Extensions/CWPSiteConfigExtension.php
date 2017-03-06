<?php

/**
 * Class CWPCleanupSiteConfigExtension
 *
 * @property SiteConfig|CWPSiteConfigExtension $owner
 * @property string $EmptySearch
 * @property string $NoSearchResults
 * @property string $FooterLogoSecondaryLink
 * @property string $FooterLogoSecondaryDescription
 * @property int $FooterLogoSecondaryID
 * @property int $FooterLogoSecondaryRetinaID
 * @method Image FooterLogoSecondary()
 * @method Image FooterLogoSecondaryRetina()
 */
class CWPSiteConfigExtension extends DataExtension
{
    private static $db = array(
        'EmptySearch' => 'Text',
        'NoSearchResults' => 'Varchar(255)',
        'FooterLogoSecondaryLink' => 'Varchar(255)',
        'FooterLogoSecondaryDescription' => 'Varchar(255)'
    );

    private static $has_one = array(
        'FooterLogoSecondary' => 'Image',
        'FooterLogoSecondaryRetina' => 'Image'
    );

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
            $fields->addFieldToTab('Root.SearchOptions', TextareaField::create('EmptySearch', _t(
                'CWP.SITECONFIG.EmptySearch',
                'Text to display when there is no search query'
            )));
            $fields->addFieldToTab('Root.SearchOptions', TextareaField::create('NoSearchResults', _t(
                'CWP.SITECONFIG.NoResult',
                'Text to display when there are no results'
            )));

            $fields->addFieldToTab('Root.LogosIcons', $footerLogoSecondaryField = UploadField::create(
                'FooterLogoSecondary',
                _t('CwpConfig.FooterLogoSecondaryField', 'Secondary Footer Logo, to appear in the footer.')
            ));
            $footerLogoSecondaryField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
            $footerLogoSecondaryField->setConfig('allowedMaxFileNumber', 1);

            $fields->addFieldToTab('Root.LogosIcons', $footerSecondaryLink = TextField::create(
                'FooterLogoSecondaryLink',
                _t('CwpConfig.FooterLogoSecondaryLinkField', 'Secondary Footer Logo link.')
            ));
            $footerSecondaryLink->setRightTitle(_t(
                'CwpConfig.FooterLogoSecondaryLinkDesc',
                'Please include the protocol (ie, http:// or https://) unless it is an internal link.'
            ));
            $fields->addFieldToTab('Root.LogosIcons', TextField::create(
                'FooterLogoSecondaryDescription',
                _t('CwpConfig.FooterLogoSecondaryDescField', 'Secondary Footer Logo description')
            ));
        }
    }
}

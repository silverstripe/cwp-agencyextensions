<?php

namespace CWP\AgencyExtensions\Extensions;






use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Environment;
use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\Assets\Image;
use SilverStripe\View\SSViewer;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;


/**
 * Class CWPCleanupSiteConfigExtension
 */
class CWPSiteConfigExtension extends DataExtension
{
    private static $db = array(
        'AddThisProfileID' => 'Varchar(32)',
        'FooterLogoLink' => 'Varchar(255)',
        'FooterLogoDescription' => 'Varchar(255)',
        'FooterLogoSecondaryLink' => 'Varchar(255)',
        'FooterLogoSecondaryDescription' => 'Varchar(255)',
        'EmptySearch' => 'Varchar(255)',
        'NoSearchResults' => 'Varchar(255)'
    );

    private static $has_one = array(
        'Logo' => Image::class,
        'LogoRetina' => Image::class,
        'FooterLogo' => Image::class,
        'FooterLogoRetina' => Image::class,
        'FooterLogoSecondary' => Image::class,
        'FavIcon' => File::class,
        'AppleTouchIcon144' => File::class,
        'AppleTouchIcon114' => File::class,
        'AppleTouchIcon72' => File::class,
        'AppleTouchIcon57' => File::class
    );

    /**
     * Define fields that should be removed for specific CWP themes
     *
     * @var array
     */
    protected $fieldsToRemoveByTheme = [];

    public function __construct()
    {
        $cwpThemeName = Environment::getEnv('CWP_THEME_NAME');
        $this->fieldsToRemoveByTheme = [
            $cwpThemeName => array(
                'AddThisProfileID',
                'LogoRetina',
                'FooterLogoRetina'
            )
        ];
        parent::__construct();
    }

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $this
            ->addSocialMedia($fields)
            ->addLogosAndIcons($fields)
            ->addSearchOptions($fields)
            ->removeFieldsForCurrentTheme($fields);
    }

    /**
     * Remove fields from the given FieldList depending on the current theme and the configured fields to remove
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function removeFieldsForCurrentTheme(FieldList $fields)
    {
        foreach ($this->fieldsToRemoveByTheme as $themeName => $fieldNames) {
            if (SSViewer::current_theme() !== $themeName) {
                continue;
            }
            $fields->removeByName($fieldNames);
        }
        return $this;
    }

    /**
     * Add or extend social media fields
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function addSocialMedia(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.SocialMedia',
            $addThisID = TextField::create(
                'AddThisProfileID',
                _t('CwpConfig.AddThisField', 'AddThis Profile ID')
            )
        );
        $addThisID->setRightTitle(
            _t(
                'CwpConfig.AddThisFieldDesc',
                'Profile ID to be used all across the site (in the format <strong>ra-XXXXXXXXXXXXXXXX</strong>)'
            )
        );

        return $this;
    }

    /**
     * Add fields for logo and icon uploads
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function addLogosAndIcons(FieldList $fields)
    {
        $logoTypes = array('jpg', 'jpeg', 'png', 'gif');
        $iconTypes = array('ico');
        $appleTouchTypes = array('png');

        $fields->findOrMakeTab(
            'Root.LogosIcons',
            _t('CustomSiteConfig.LogosIconsTab', 'Logos/Icons')
        );

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $logoField = UploadField::create(
                'Logo',
                _t('CwpConfig.LogoUploadField', 'Logo, to appear in the top left')
            )
        );
        $logoField->getValidator()->setAllowedExtensions($logoTypes);
        $logoField->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $logoRetinaField = UploadField::create(
                'LogoRetina',
                _t(
                    'CwpConfig.LogoRetinaUploadField',
                    'High resolution logo, to appear in the top left (recommended twice the height and width of the standard logo)'
                )
            )
        );
        $logoRetinaField->getValidator()->setAllowedExtensions($logoTypes);
        $logoRetinaField->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoField = UploadField::create(
                'FooterLogo',
                _t('CwpConfig.FooterLogoField', 'Footer logo, to appear in the footer')
            )
        );
        $footerLogoField->getValidator()->setAllowedExtensions($logoTypes);
        $footerLogoField->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoRetinaField = UploadField::create(
                'FooterLogoRetina',
                _t(
                    'CwpConfig.FooterLogoRetinaField',
                    'High resolution footer logo (recommended twice the height and width of the standard footer logo)'
                )
            )
        );
        $footerLogoRetinaField->getValidator()->setAllowedExtensions($logoTypes);
        $footerLogoRetinaField->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLink = TextField::create(
                'FooterLogoLink',
                _t('CwpConfig.FooterLogoLinkField', 'Footer Logo link')
            )
        );
        $footerLink->setRightTitle(
            _t(
                'CwpConfig.FooterLogoLinkDesc',
                'Please include the protocol (ie, http:// or https://) unless it is an internal link.'
            )
        );

        $fields->addFieldToTab(
            'Root.LogosIcons',
            TextField::create(
                'FooterLogoDescription',
                _t('CwpConfig.FooterLogoDescField', 'Footer Logo description')
            )
        );

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoSecondaryField = UploadField::create(
                'FooterLogoSecondary',
                _t('CwpConfig.FooterLogoSecondaryField', 'Secondary Footer Logo, to appear in the footer.')
            )
        );
        $footerLogoSecondaryField->getValidator()->setAllowedExtensions($logoTypes);
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

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $favIconField = UploadField::create(
                'FavIcon',
                _t('CwpConfig.FavIconField', 'Favicon, in .ico format, dimensions of 16x16, 32x32, or 48x48')
            )
        );
        $favIconField->getValidator()->setAllowedExtensions($iconTypes);
        $favIconField->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon144 = UploadField::create(
                'AppleTouchIcon144',
                _t(
                    'CwpConfig.AppleIconField144',
                    'Apple Touch Web Clip and Windows 8 Tile Icon (dimensions of 144x144, PNG format)'
                )
            )
        );
        $atIcon144->getValidator()->setAllowedExtensions($appleTouchTypes);
        $atIcon144->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon114 = UploadField::create(
                'AppleTouchIcon114',
                _t('CwpConfig.AppleIconField114', 'Apple Touch Web Clip Icon (dimensions of 114x114, PNG format)')
            )
        );
        $atIcon114->getValidator()->setAllowedExtensions($appleTouchTypes);
        $atIcon114->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon72 = UploadField::create(
                'AppleTouchIcon72',
                _t('CwpConfig.AppleIconField72', 'Apple Touch Web Clip Icon (dimensions of 72x72, PNG format)')
            )
        );
        $atIcon72->getValidator()->setAllowedExtensions($appleTouchTypes);
        $atIcon72->setConfig('allowedMaxFileNumber', 1);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon57 = UploadField::create(
                'AppleTouchIcon57',
                _t('CwpConfig.AppleIconField57', 'Apple Touch Web Clip Icon (dimensions of 57x57, PNG format)')
            )
        );
        $atIcon57->getValidator()->setAllowedExtensions($appleTouchTypes);
        $atIcon57->setConfig('allowedMaxFileNumber', 1);

        return $this;
    }

    /**
     * Add user configurable search field labels
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function addSearchOptions(FieldList $fields)
    {
        $fields->findOrMakeTab('Root.SearchOptions');

        $fields->addFieldToTab(
            'Root.SearchOptions',
            TextField::create(
                'EmptySearch',
                _t(
                    'CWP.SITECONFIG.EmptySearch',
                    'Text to display when there is no search query'
                )
            )
        );
        $fields->addFieldToTab(
            'Root.SearchOptions',
            TextField::create(
                'NoSearchResults',
                _t(
                    'CWP.SITECONFIG.NoResult',
                    'Text to display when there are no results'
                )
            )
        );

        return $this;
    }
}

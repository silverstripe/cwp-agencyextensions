<?php

namespace CWP\AgencyExtensions\Extensions;

use CWP\AgencyExtensions\Forms\ColorPickerField;
use CWP\AgencyExtensions\Forms\FontPickerField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileHandleField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\Requirements;

/**
 * @method File AppleTouchIcon114()
 * @method File AppleTouchIcon144()
 * @method File AppleTouchIcon57()
 * @method File AppleTouchIcon72()
 * @method File FavIcon()
 * @method Image FooterLogo()
 * @method Image FooterLogoRetina()
 * @method Image FooterLogoSecondary()
 * @method Image Logo()
 * @method Image LogoRetina()
 *
 * @extends DataExtension<SiteConfig>
 */
class CWPSiteConfigExtension extends DataExtension
{
    private static $db = array(
        'FooterLogoLink' => 'Varchar(255)',
        'FooterLogoDescription' => 'Varchar(255)',
        'FooterLogoSecondaryLink' => 'Varchar(255)',
        'FooterLogoSecondaryDescription' => 'Varchar(255)',
        'EmptySearch' => 'Varchar(255)',
        'NoSearchResults' => 'Varchar(255)',
        'MainFontFamily' => 'Varchar(50)',
        'HeaderBackground' => 'Varchar(50)',
        'NavigationBarBackground' => 'Varchar(50)',
        'CarouselBackground' => 'Varchar(50)',
        'FooterBackground' => 'Varchar(50)',
        'AccentColor' => 'Varchar(50)',
        'TextLinkColor' => 'Varchar(50)',
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

    private static $owns = [
        'Logo',
        'LogoRetina',
        'FooterLogo',
        'FooterLogoRetina',
        'FooterLogoSecondary',
        'FavIcon',
        'AppleTouchIcon144',
        'AppleTouchIcon114',
        'AppleTouchIcon72',
        'AppleTouchIcon57'
    ];

    /**
     * Defines if the theme colour picker is enabled in the CMS
     *
     * @config
     * @var boolean
     */
    private static $enable_theme_color_picker = false;

    /**
     * Defines the theme fonts that can be selected via the CMS
     *
     * @config
     * @var array
     */
    private static $theme_fonts = [
        'nunito-sans' => 'Nunito Sans',
        'fira-sans' => 'Fira Sans',
        'merriweather' => 'Merriweather',
    ];

    /**
     * Defines the theme colours that can be selected via the CMS
     *
     * @config
     * @var array
     */
    private static $theme_colors = [
        'default-accent' => [
            'Title' => 'Default',
            'CSSClass' => 'default-accent',
            'Color' => '#0F7EB2',
        ],
        'default-background' => [
            'Title' => 'Default',
            'CSSClass' => 'default-background',
            'Color' => '#001F2C',
        ],
        'red' => [
            'Title' => 'Red',
            'CSSClass' => 'red',
            'Color' => '#E51016',
        ],
        'dark-red' => [
            'Title' => 'Dark red',
            'CSSClass' => 'dark-red',
            'Color' => '#AD161E',
        ],
        'pink' => [
            'Title' => 'Pink',
            'CSSClass' => 'pink',
            'Color' => '#B32A95',
        ],
        'purple' => [
            'Title' => 'Purple',
            'CSSClass' => 'purple',
            'Color' => '#6239C8',
        ],
        'blue' => [
            'Title' => 'Blue',
            'CSSClass' => 'blue',
            'Color' => '#1F6BFE',
        ],
        'dark-blue' => [
            'Title' => 'Dark blue',
            'CSSClass' => 'dark-blue',
            'Color' => '#123581',
        ],
        'teal' => [
            'Title' => 'Teal',
            'CSSClass' => 'teal',
            'Color' => '#00837A',
        ],
        'green' => [
            'Title' => 'Green',
            'CSSClass' => 'green',
            'Color' => '#298436',
        ],
        'dark-orange' => [
            'Title' => 'Dark orange',
            'CSSClass' => 'dark-orange',
            'Color' => '#D34300',
        ],
        'dark-ochre' => [
            'Title' => 'Dark ochre',
            'CSSClass' => 'dark-ochre',
            'Color' => '#947200',
        ],
        'black' => [
            'Title' => 'Black',
            'CSSClass' => 'black',
            'Color' => '#111111',
        ],
        'dark-grey' => [
            'Title' => 'Dark grey',
            'CSSClass' => 'dark-grey',
            'Color' => '#555555',
        ],
        'light-grey' => [
            'Title' => 'Light grey',
            'CSSClass' => 'light-grey',
            'Color' => '#EAEAEA',
        ],
        'white' => [
            'Title' => 'White',
            'CSSClass' => 'white',
            'Color' => '#FFFFFF',
        ],
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $this
            ->addLogosAndIcons($fields)
            ->addSearchOptions($fields)
            ->addThemeColorPicker($fields);
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
            _t(__CLASS__ . '.LogosIconsTab', 'Logos/Icons')
        );

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $logoField = Injector::inst()->create(
                FileHandleField::class,
                'Logo',
                _t(__CLASS__ . '.LogoUploadField', 'Logo, to appear in the top left')
            )
        );
        $logoField->getValidator()->setAllowedExtensions($logoTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $logoRetinaField = Injector::inst()->create(
                FileHandleField::class,
                'LogoRetina',
                _t(
                    'CwpConfig.LogoRetinaUploadField',
                    'High resolution logo, to appear in the top left ' .
                    '(recommended to be twice the height and width of the standard logo)'
                )
            )
        );
        $logoRetinaField->getValidator()->setAllowedExtensions($logoTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoField = Injector::inst()->create(
                FileHandleField::class,
                'FooterLogo',
                _t(__CLASS__ . '.FooterLogoField', 'Footer logo, to appear in the footer')
            )
        );
        $footerLogoField->getValidator()->setAllowedExtensions($logoTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoRetinaField = Injector::inst()->create(
                FileHandleField::class,
                'FooterLogoRetina',
                _t(
                    'CwpConfig.FooterLogoRetinaField',
                    'High resolution footer logo (recommended twice the height and width of the standard footer logo)'
                )
            )
        );
        $footerLogoRetinaField->getValidator()->setAllowedExtensions($logoTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLink = TextField::create(
                'FooterLogoLink',
                _t(__CLASS__ . '.FooterLogoLinkField', 'Footer Logo link')
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
                _t(__CLASS__ . '.FooterLogoDescField', 'Footer Logo description')
            )
        );

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $footerLogoSecondaryField = Injector::inst()->create(
                FileHandleField::class,
                'FooterLogoSecondary',
                _t(__CLASS__ . '.FooterLogoSecondaryField', 'Secondary Footer Logo, to appear in the footer.')
            )
        );
        $footerLogoSecondaryField->getValidator()->setAllowedExtensions($logoTypes);

        $fields->addFieldToTab('Root.LogosIcons', $footerSecondaryLink = TextField::create(
            'FooterLogoSecondaryLink',
            _t(__CLASS__ . '.FooterLogoSecondaryLinkField', 'Secondary Footer Logo link.')
        ));
        $footerSecondaryLink->setRightTitle(_t(
            'CwpConfig.FooterLogoSecondaryLinkDesc',
            'Please include the protocol (ie, http:// or https://) unless it is an internal link.'
        ));
        $fields->addFieldToTab('Root.LogosIcons', TextField::create(
            'FooterLogoSecondaryDescription',
            _t(__CLASS__ . '.FooterLogoSecondaryDescField', 'Secondary Footer Logo description')
        ));

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $favIconField = Injector::inst()->create(
                FileHandleField::class,
                'FavIcon',
                _t(__CLASS__ . '.FavIconField', 'Favicon, in .ico format, dimensions of 16x16, 32x32, or 48x48')
            )
        );
        $favIconField->getValidator()->setAllowedExtensions($iconTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon144 = Injector::inst()->create(
                FileHandleField::class,
                'AppleTouchIcon144',
                _t(
                    'CwpConfig.AppleIconField144',
                    'Apple Touch Web Clip and Windows 8 Tile Icon (dimensions of 144x144, PNG format)'
                )
            )
        );
        $atIcon144->getValidator()->setAllowedExtensions($appleTouchTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon114 = Injector::inst()->create(
                FileHandleField::class,
                'AppleTouchIcon114',
                _t(__CLASS__ . '.AppleIconField114', 'Apple Touch Web Clip Icon (dimensions of 114x114, PNG format)')
            )
        );
        $atIcon114->getValidator()->setAllowedExtensions($appleTouchTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon72 = Injector::inst()->create(
                FileHandleField::class,
                'AppleTouchIcon72',
                _t(__CLASS__ . '.AppleIconField72', 'Apple Touch Web Clip Icon (dimensions of 72x72, PNG format)')
            )
        );
        $atIcon72->getValidator()->setAllowedExtensions($appleTouchTypes);

        $fields->addFieldToTab(
            'Root.LogosIcons',
            $atIcon57 = Injector::inst()->create(
                FileHandleField::class,
                'AppleTouchIcon57',
                _t(__CLASS__ . '.AppleIconField57', 'Apple Touch Web Clip Icon (dimensions of 57x57, PNG format)')
            )
        );
        $atIcon57->getValidator()->setAllowedExtensions($appleTouchTypes);

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

    /**
     * Add fields for selecting the font theme colour for different areas of the site.
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function addThemeColorPicker(FieldList $fields)
    {
        // Only show theme colour selector if enabled
        if (!$this->owner->config()->get('enable_theme_color_picker')) {
            return $this;
        }

        $fonts = $this->owner->config()->get('theme_fonts');

        // Import each font via the google fonts api to render font preview
        foreach ($fonts as $fontTitle) {
            $fontFamilyName = str_replace(' ', '+', $fontTitle ?? '');
            Requirements::css("//fonts.googleapis.com/css?family=$fontFamilyName");
        }

        $fields->addFieldsToTab(
            'Root.ThemeOptions',
            [
                FontPickerField::create(
                    'MainFontFamily',
                    _t(
                        __CLASS__ . '.MainFontFamily',
                        'Main font family'
                    ),
                    $fonts
                ),
                 ColorPickerField::create(
                     'HeaderBackground',
                     _t(
                         __CLASS__ . '.HeaderBackground',
                         'Header background'
                     ),
                     $this->getThemeOptionsExcluding([
                         'default-accent',
                     ])
                 ),
                 ColorPickerField::create(
                     'NavigationBarBackground',
                     _t(
                         __CLASS__ . '.NavigationBarBackground',
                         'Navigation bar background'
                     ),
                     $this->getThemeOptionsExcluding([
                         'default-accent',
                     ])
                 ),
                 ColorPickerField::create(
                     'CarouselBackground',
                     _t(
                         __CLASS__ . '.CarouselBackground',
                         'Carousel background'
                     ),
                     $this->getThemeOptionsExcluding([
                         'default-accent',
                     ])
                 )->setDescription(
                     _t(
                         __CLASS__ . '.CarouselBackgroundDescription',
                         'The background colour of the carousel when there is no image set.'
                     )
                 ),
                 ColorPickerField::create(
                     'FooterBackground',
                     _t(
                         __CLASS__ . '.FooterBackground',
                         'Footer background'
                     ),
                     $this->getThemeOptionsExcluding([
                         'light-grey',
                         'white',
                         'default-accent',
                     ])
                 ),
                 ColorPickerField::create(
                     'AccentColor',
                     _t(
                         __CLASS__ . '.AccentColor',
                         'Accent colour'
                     ),
                     $this->getThemeOptionsExcluding([
                         'light-grey',
                         'white',
                         'default-background',
                     ])
                 )->setDescription(
                     _t(
                         __CLASS__ . '.AccentColorDescription',
                         'Affects colour of buttons, current navigation items, etc. '.
                         'Please ensure sufficient contrast with background colours.'
                     )
                 ),
                 ColorPickerField::create(
                     'TextLinkColor',
                     _t(
                         __CLASS__ . '.TextLinkColor',
                         'Text link colour'
                     ),
                     $this->getThemeOptionsExcluding([
                         'black',
                         'light-grey',
                         'dark-grey',
                         'white',
                         'default-background',
                     ])
                 ),
            ]
        );

        return $this;
    }

    /**
     * Returns theme_colors used for ColorPickerField.
     *
     * @param  array  $excludedColors list of colours to exclude from the returned options
     *                                based on the theme colour's 'CSSClass' value
     * @return array
     */
    public function getThemeOptionsExcluding($excludedColors = [])
    {
        $themeColors = $this->owner->config()->get('theme_colors');
        $options = [];

        foreach ($themeColors as $themeColor) {
            if (in_array($themeColor['CSSClass'], $excludedColors ?? [])) {
                continue;
            }

            $options[] = $themeColor;
        }

        return $options;
    }

    /**
     * Auto-publish any images attached to the SiteConfig object if it's not versioned. Versioned objects will
     * handle their related objects via the "owns" API by default.
     */
    public function onAfterWrite()
    {
        if (!$this->owner->hasExtension(Versioned::class)) {
            $this->owner->publishRecursive();
        }
    }

    /**
     * If HeaderBackground is not set, assume no theme colours exist and populate some defaults if the colour
     * picker is enabled. We don't use populateDefaults() because we don't want SiteConfig to re-populate its own
     * defaults.
     */
    public function onBeforeWrite()
    {
        $colorPickerEnabled = $this->owner->config()->get('enable_theme_color_picker');

        if ($colorPickerEnabled && !$this->owner->HeaderBackground) {
            $this->owner->update([
                'MainFontFamily' => FontPickerField::DEFAULT_VALUE,
                'HeaderBackground' => 'default-background',
                'NavigationBarBackground' => 'default-background',
                'CarouselBackground' => 'default-background',
                'FooterBackground' => 'default-background',
                'AccentColor' => 'default-accent',
                'TextLinkColor' => 'default-accent',
            ]);
        }
    }
}

<?php

/**
 * Class CWPCarouselItemExtension
 *
 * @property CarouselItem|CWPCarouselItemExtension $owner
 * @property string $Content
 * @property string $PrimaryCallToActionLabel
 * @property string $SecondaryCallToActionLabel
 * @property int $PrimaryCallToActionID
 * @property int $SecondaryCallToActionID
 * @method SiteTree PrimaryCallToAction()
 * @method SiteTree SecondaryCallToAction()
 */
class CWPCarouselItemExtension extends DataExtension
{
    private static $db = array(
        'Content' => 'HTMLText',
        'PrimaryCallToActionLabel' => 'Varchar(255)',
        'SecondaryCallToActionLabel' => 'Varchar(255)'
    );

    private static $has_one = array(
        'PrimaryCallToAction' => 'SiteTree',
        'SecondaryCallToAction' => 'SiteTree'
    );

    private static $summary_fields = array(
        'ImageThumb' => 'Image',
        'Title' => 'Title',
        'Content.FirstSentence' => 'Text',
        'PrimaryCallToAction.Title' => 'Primary CTA',
        'SecondaryCallToAction.Title' => 'Secondary CTA',
        'ArchivedReadable' => 'Current Status'
    );

    private static $searchable_fields = array(
        'Title',
        'Content'
    );

    /**
     * Add call to action fields and replace the "Caption" field with a "Content" HTML editor
     *
     * {@inheritDoc}
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('LinkID');

        $fields->insertAfter('Image', TextField::create('PrimaryCallToActionLabel'));
        $fields->insertAfter(
            'PrimaryCallToActionLabel',
            TreeDropdownField::create(
                'PrimaryCallToActionID',
                _t('CwpCarousel.PRIMARYCALLTOACTION', 'Primary Call To Action Link'),
                'SiteTree'
            )
        );

        $fields->insertAfter('PrimaryCallToActionID', TextField::create('SecondaryCallToActionLabel'));
        $fields->insertAfter(
            'SecondaryCallToActionLabel',
            TreeDropdownField::create(
                'SecondaryCallToActionID',
                _t('CwpCarousel.SECONDARYCALLTOACTION', 'Secondary Call To Action Link'),
                'SiteTree'
            )
        );

        $fields->removeByName('Caption');
        $fields->insertAfter('Title', HtmlEditorField::create('Content'));
    }
}

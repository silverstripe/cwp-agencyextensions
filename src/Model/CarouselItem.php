<?php

namespace CWP\AgencyExtensions\Model;




use HtmlEditorField;





use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\LabelField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;


class CarouselItem extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Archived' => 'Boolean',
        'SortOrder' => 'Int',
        'PrimaryCallToActionLabel' => 'Varchar(255)',
        'SecondaryCallToActionLabel' => 'Varchar(255)'
    );

    private static $has_one = array(
        'Parent' => 'HomePage',
        'Image' => Image::class,
        'PrimaryCallToAction' => SiteTree::class,
        'SecondaryCallToAction' => SiteTree::class
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

    public function getCMSFields()
    {
        $fields = new FieldList(
            // Set title
            TextField::create('Title', 'Title', null, 255),
            // Content
            HtmlEditorField::create('Content')
                ->setRows(5)
                ->setDescription(
                    _t(
                        'CwpCarousel.CONTENT_HELPTIP',
                        'Recommended: Use less than 50 words. For carousel slides, use similar amount of content to ensure carousel height does not vary.'
                    )
                ),
            // Image
            UploadField::create(Image::class, Image::class)
                ->setAllowedFileCategories('image')
                ->setDescription(
                    _t(
                        'CwpCarousel.IMAGE_HELPTIP',
                        'Recommended: Use high resolution images greater than 1600x900px.'
                    )
                ),
            // Call to actions
            TextField::create('PrimaryCallToActionLabel'),
            TreeDropdownField::create(
                'PrimaryCallToActionID',
                _t('CwpCarousel.PRIMARYCALLTOACTION', 'Primary Call To Action Link'),
                SiteTree::class
            ),
            TextField::create('SecondaryCallToActionLabel'),
            TreeDropdownField::create(
                'SecondaryCallToActionID',
                _t('CwpCarousel.SECONDARYCALLTOACTION', 'Secondary Call To Action Link'),
                SiteTree::class
            ),
            // Can archive option
            CompositeField::create(
                LabelField::create(
                    'LabelArchive',
                    _t('CwpCarousel.ArchivedField', 'Archive this carousel item?')
                )->addExtraClass('left'),
                CheckboxField::create('Archived', '')
            )->addExtraClass('field special')
        );

        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    public function canCreate($member = null, $context = array())
    {
        return $this->Parent()->canCreate($member);
    }

    public function canEdit($member = null)
    {
        return $this->Parent()->canEdit($member);
    }

    public function canDelete($member = null)
    {
        return $this->Parent()->canDelete($member);
    }

    public function canView($member = null)
    {
        return $this->Parent()->canView($member);
    }

    public function ImageThumb()
    {
        return $this->Image()->SetWidth(50);
    }

    public function ArchivedReadable()
    {
        if ($this->Archived == 1) {
            return _t('GridField.Archived', 'Archived');
        }
        return _t('GridField.Live', 'Live');
    }
}

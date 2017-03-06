<?php
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
        'Image' => 'Image',
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

    public function getCMSFields()
    {
        $fields = new FieldList(
            // Set title
            TextField::create('Title', 'Title', null, 255),
            // Content
            HtmlEditorField::create('Content')->setRows(5),
            // Image
            UploadField::create('Image', 'Image')
                ->setAllowedFileCategories('image'),
            // Call to actions
            TextField::create('PrimaryCallToActionLabel'),
            TreeDropdownField::create(
                'PrimaryCallToActionID',
                _t('CwpCarousel.PRIMARYCALLTOACTION', 'Primary Call To Action Link'),
                'SiteTree'
            ),
            TextField::create('SecondaryCallToActionLabel'),
            TreeDropdownField::create(
                'SecondaryCallToActionID',
                _t('CwpCarousel.SECONDARYCALLTOACTION', 'Secondary Call To Action Link'),
                'SiteTree'
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

    public function canCreate($member = null)
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

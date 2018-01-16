<?php

namespace CWP\AgencyExtensions\Extensions;






use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

use CWP\AgencyExtensions\Model\CarouselItem;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\GridField\GridFieldVersionedState;



class CarouselPageExtension extends DataExtension
{
    private static $has_many = [
        'CarouselItems' => CarouselItem::class
    ];

    private static $owns = [
        'CarouselItems'
    ];

    /**
     * @return DataList
     */
    public function getCarouselItems()
    {
        return $this->owner->getComponents('CarouselItems')->sort('SortOrder');
    }

    /**
     * @return DataList
     */
    public function getVisibleCarouselItems()
    {
        return $this->getCarouselItems()->filter('Archived', false);
    }

    /**
     * Add the carousel management GridField to the Page's CMS fields
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $gridField = GridField::create(
            'CarouselItems',
            _t(__CLASS__ . 'TITLE', 'Hero/Carousel'),
            $this->getCarouselItems(),
            GridFieldConfig_RelationEditor::create()
        );
        $gridField->setDescription( _t(
            __CLASS__ . 'NOTE',
            'NOTE: Carousel functionality will automatically be loaded when 2 or more items are added below'
        ));
        $gridConfig = $gridField->getConfig();
        $gridConfig->getComponentByType(GridFieldAddNewButton::class)->setButtonName(
            _t(__CLASS__ . 'ADDNEW', 'Add new')
        );
        $gridConfig->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $gridConfig->removeComponentsByType(GridFieldDeleteAction::class);
        $gridConfig->addComponent(new GridFieldDeleteAction());
        $gridConfig->addComponent(new GridFieldVersionedState());
        if (class_exists(GridFieldSortableRows::class)) {
            $gridConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        }
        $gridConfig->removeComponentsByType(GridFieldSortableHeader::class);
        $gridField->setModelClass(CarouselItem::class);

        $fields->findOrMakeTab(
            'Root.Carousel',
            _t(__CLASS__ . 'TITLE', 'Hero/Carousel')
        );

        $fields->addFieldToTab('Root.Carousel', $gridField);
    }
}

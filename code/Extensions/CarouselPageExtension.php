<?php

class CarouselPageExtension extends DataExtension
{
    private static $has_many = array(
        'CarouselItems' => 'CarouselItem'
    );

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
            'Carousel',
            $this->getCarouselItems(),
            GridFieldConfig_RelationEditor::create()
        );
        $gridConfig = $gridField->getConfig();
        $gridConfig->getComponentByType('GridFieldAddNewButton')->setButtonName(
            _t('BaseHomePage.AddNewButton', 'Add new')
        );
        $gridConfig->removeComponentsByType('GridFieldAddExistingAutocompleter');
        $gridConfig->removeComponentsByType('GridFieldDeleteAction');
        $gridConfig->addComponent(new GridFieldDeleteAction());
        $gridConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $gridConfig->removeComponentsByType('GridFieldSortableHeader');
        $gridField->setModelClass('CarouselItem');

        $fields->addFieldToTab('Root.Carousel', $gridField);
    }
}

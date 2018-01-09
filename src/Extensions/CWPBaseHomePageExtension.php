<?php

namespace CWP\AgencyExtensions\Extensions;




use SilverStripe\Forms\FieldList;
use CWP\AgencyExtensions\Helper\CwpThemeHelper;
use SilverStripe\ORM\DataExtension;



class CWPBaseHomePageExtension extends DataExtension
{
    /**
     * Remove icons for themes other than "default".
     * Icon field will be removed in CWP 2.0
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        if (!CwpThemeHelper::singleton()->getIsDefaultTheme()) {
            /** @var CompositeField $compositeField */
            $compositeField = $fields->fieldByName('Root.Features.FeatureOne');
            if ($compositeField) {
                $children = $compositeField->FieldList();
                $children->removeByName(array('FeatureOneCategory', 'FeatureTwoCategory'));
            }
        }
    }
}

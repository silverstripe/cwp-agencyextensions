<?php

/**
 * Class CWPFormFieldExtension
 *
 * @property FormField $owner
 */
class CWPFormFieldExtension extends Extension
{
    /**
     * @param array $attributes
     */
    public function updateAttributes(array &$attributes)
    {
        $type = $this->owner->class;

        $ariaFields = [
            "CheckboxField",
            "CheckboxSetField",
            "OptionsetField"
        ];

        if (in_array($type, $ariaFields)) {
        	$attributes["class"] .= " list-unstyled";
            unset($attributes['aria-required']);
        }

        $ignored = array_merge($ariaFields, [
            "SelectionGroupField",
            "FormAction",
        ]);

        if (in_array($type, $ignored)) {
            return;
        }

        $attributes["class"] .= " form-control";
    }
}

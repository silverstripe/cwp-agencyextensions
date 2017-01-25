<?php

class CWPFormFieldExtension extends Extension
{
    /**
     * @param array $attributes
     */
    public function updateAttributes(array &$attributes)
    {
        $type = $this->owner->class;

        $ignored = [
            "CheckboxField",
            "CheckboxSetField",
            "OptionsetField",
            "SelectionGroupField",
            "FormAction",
        ];

        if (in_array($type, $ignored)) {
            return;
        }

        $attributes["class"] .= " form-control";
    }
}

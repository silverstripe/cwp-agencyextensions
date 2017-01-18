<?php

/**
 * Class FormFieldExtension
 *
 * @property FormField $owner
 */
class FormFieldExtension extends Extension
{

    /**
     * @param array $attributes
     */
    public function updateAttributes(array &$attributes)
    {
        $type = $this->owner->class;
        switch ($type) {
            case 'CheckboxField':
            case 'CheckboxSetField':
                $attributes['class'] .= ' checkbox';
                break;
            case 'OptionsetField':
            case 'SelectionGroupField':
                break;
            case 'FormAction':
                $attributes['class'] .= ' btn';
                break;
            default:
                $attributes['class'] .= ' form-control';
        }
    }
}

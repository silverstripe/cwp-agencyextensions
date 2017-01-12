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
        $attributes['class'] .= ' form-control';
    }
}

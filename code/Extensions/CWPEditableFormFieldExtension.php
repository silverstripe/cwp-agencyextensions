<?php

/**
 * Class CWPEditableFormFieldExtension
 *
 * @property EditableFormField|CWPEditableFormFieldExtension $owner
 */
class CWPEditableFormFieldExtension extends DataExtension
{
    /**
     * Add the form-group class to all userforms field holders (other than checkbox sets)
     *
     * @param FormField $field
     */
    public function beforeUpdateFormField(FormField $field)
    {
        if (!($field instanceof CheckboxSetField)) {
            $field->addExtraClass('form-group');
        }
    }
}

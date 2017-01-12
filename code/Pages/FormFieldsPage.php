<?php

/**
 * Class FormFieldsPage
 *
 */
class FormFieldsPage extends Page
{
}

/**
 * Class FormFieldsPage_Controller
 *
 * @property FormFieldsPage dataRecord
 * @method FormFieldsPage data()
 * @mixin FormFieldsPage dataRecord
 */
class FormFieldsPage_Controller extends Page_Controller
{
    public function Form()
    {
        $fields = array(
            HeaderField::create('HeaderField', 'Header Field'),
            TextField::create('TextField', 'Text Field'),
            TextareaField::create('TextareaField', 'Textarea Field'),
            CheckboxField::create('CheckboxField', 'Checkbox Field'),
            OptionsetField::create('OptionsetField', 'Optionset Field', array('a' => 'Option 1', 'b' => 'Option 2')),
            SelectionGroup::create('SelectionGroup', array('a' => 'Option 1', 'b' => 'Option 2')),
            DropdownField::create('DropdownField', 'Dropdown Field', array(1 => 'Option 1', 2 => 'Option 2'))
        );
        $fieldList = FieldList::create($fields);
        $actions = FieldList::create(array(
            FormAction::create('ActionNoButton', 'No Button'),
            FormAction::create('ActionButton', 'Button')->setUseButtonTag(true),
        ));
        $required = RequiredFields::create(
            array(
                'TextField',
                'CheckboxField',
            )
        );

        return Form::create($this, __FUNCTION__, $fieldList, $actions, $required);
    }
}

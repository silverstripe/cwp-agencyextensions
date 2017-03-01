<?php

class CWPEditableFormFieldExtensionTest extends SapphireTest
{
    /**
     * Test that "form-group" is added to form fields other than the checkbox set
     *
     * @param string $class
     * @param bool   $expected
     * @dataProvider formFieldProvider
     */
    public function testFormGroupClassIsAddedToFields($class, $expected)
    {
        $field = new $class;
        $result = $field->getFormField();
        $this->assertEquals($expected, $result->hasClass('form-group'));
    }

    /**
     * @return array[]
     */
    public function formFieldProvider()
    {
        return array(
            array('EditableTextField', true),
            array('EditableCheckboxGroupField', false)
        );
    }
}

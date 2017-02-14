<?php

class CWPFormFieldExtensionTest extends SapphireTest
{
    /**
     * Test that a unique HTML ID can be returned for the field's message (validation) element
     */
    public function testGetMessageId()
    {
        $field = TextField::create('Testing');
        $id = $field->ID();
        $this->assertSame("{$id}-message", $field->getMessageID());
    }

    /**
     * Test that a unique HTML ID can be returned for the FormField
     */
    public function testGetLabelId()
    {
        $field = NumericField::create('Testing');
        $id = $field->ID();
        $this->assertSame("{$id}-label", $field->getLabelID());
    }

    /**
     * Test that the correct Bootstrap validation class is returned for the field's label (description)
     */
    public function testGetMessageClass()
    {
        $field = TextField::create('Testing');

        $field->setError('Test message', 'required');
        $this->assertSame('has-error', $field->getMessageClass());

        $field->setError('Test message', 'something else');
        $this->assertSame('has-warning', $field->getMessageClass());
    }

    /**
     * Ensure that the aria-describedby attribute is added to the FormField, and correctly identifies
     * the label and/or message that describe the field.
     */
    public function testUpdateAttributesAddsAriaDescribedBy()
    {
        $field = EmailField::create('Testing');
        $field->setError('Test message', 'required');
        $field->setDescription('Test description');

        $attributes = $field->getAttributes();
        $this->assertArrayHasKey('aria-describedby', $attributes);
        $this->assertContains($field->getMessageID(), $attributes['aria-describedby']);
        $this->assertContains($field->getLabelID(), $attributes['aria-describedby']);

        $field->setDescription(null);
        $attributes = $field->getAttributes();
        $this->assertArrayHasKey('aria-describedby', $attributes);
        $this->assertNotContains($field->getLabelID(), $attributes['aria-describedby']);

        $field->setError(null, null);
        $attributes = $field->getAttributes();
        $this->assertArrayNotHasKey('aria-describedby', $attributes);
    }
}

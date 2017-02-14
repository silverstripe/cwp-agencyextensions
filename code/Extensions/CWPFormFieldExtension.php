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
        $this->addAriaDescribedBy($attributes);

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
            "FileField",
        ]);

        if (in_array($type, $ignored)) {
            return;
        }

        $this->embellishAttributes($attributes, $type);

        $attributes["class"] .= " form-control";
    }

    /**
     * Get the form field's "message" ID attribute
     *
     * @return string
     */
    public function getMessageID()
    {
        return $this->owner->ID() . '-message';
    }

    /**
     * Get the form field's "label" ID attribute
     *
     * @return string
     */
    public function getLabelID()
    {
        return $this->owner->ID() . '-label';
    }

    /**
     * Get the appropriate message (validation) class to use for the form-group container, if relevant
     *
     * @return string
     */
    public function getMessageClass()
    {
        if (!$this->owner->Message()) {
            return '';
        }

        return ($this->owner->MessageType() === 'required') ? 'has-error' : 'has-warning';
    }

    /**
     * Adds an "aria-describedby" attribute if there are elements in the page that will describe this field
     *
     * @param  array $attributes
     * @return $this
     */
    private function addAriaDescribedBy(&$attributes)
    {
        $describedBy = [];

        if ($this->owner->Message()) {
            $describedBy[] = $this->getMessageID();
        }

        if ($this->owner->getDescription()) {
            $describedBy[] = $this->getLabelID();
        }

        if (!empty($describedBy)) {
            $attributes['aria-describedby'] = implode(' ', $describedBy);
        }

        return $this;
    }

    /**
     * Add class for the type of field and patterns for validation
     *
     * @param  array  $attributes FormField attributes
     * @param  string $type       FormField type (class name)
     * @return $this
     */
    private function embellishAttributes(&$attributes, $type)
    {
        $numericFields = [
            CreditCardField::class,
            NumericField::class
        ];

        $moneyFields = [
            CurrencyField::class,
            MoneyField::class
        ];

        if (in_array($type, $numericFields)) {
            $attributes['class'] .= ' number';
            $attributes['pattern'] = '[0-9]*';
        }

        if (in_array($type, $moneyFields)) {
            $attributes['class'] .= ' number';
            $attributes['pattern'] = '[\d\.]*';
        }

        if ($type === DateField::class) {
            $attributes['type'] = 'date';
            $attributes['pattern'] = $this->owner->getConfig('dateformat');
        }
        if ($type === TimeField::class) {
            $attributes['type'] = 'time';
            $attributes['pattern'] = $this->owner->getConfig('timeformat');
        }
        if ($type === EmailField::class) {
            $attributes['type'] = 'email';
        }

        return $this;
    }
}

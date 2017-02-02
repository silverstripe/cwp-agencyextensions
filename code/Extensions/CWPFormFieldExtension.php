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

        $this->updateType($attributes, $type);

        $attributes["class"] .= " form-control";
    }

    private function updateType(&$attributes, $type)
    {
        $numericFields = [
            'CreditCardField',
            'NumericField',
            'CurrencyField',
            'MoneyField'
        ];

        if (in_array($type, $numericFields)) {
            $attributes['class'] .= ' number';
            $attributes['pattern'] = '[0-9]*';
        }
        if ($type === 'DateField') {
            $attributes['type'] = 'date';
            $attributes['pattern'] = $this->owner->getConfig('dateformat');
        }
        if ($type === 'TimeField') {
            $attributes['type'] = 'time';
            $attributes['pattern'] = $this->owner->getConfig('timeformat');
        }
        if ($type === 'EmailField') {
            $attributes['type'] = 'email';
        }
    }
}

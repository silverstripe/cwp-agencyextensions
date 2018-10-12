<?php

namespace CWP\AgencyExtensions\Forms;

use SilverStripe\Forms\SingleSelectField;

class ColorPickerField extends SingleSelectField {
    public function __construct($name, $title = null, $source = array(), $value = null)
    {
        parent::__construct($name, $title, $source, $value);

        $this->addExtraClass('color-picker-field');
    }
}

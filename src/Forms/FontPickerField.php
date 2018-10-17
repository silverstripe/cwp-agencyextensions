<?php

namespace CWP\AgencyExtensions\Forms;

use SilverStripe\Forms\SingleSelectField;

class FontPickerField extends SingleSelectField
{
    public function __construct($name, $title = null, $source = array(), $value = null)
    {
        parent::__construct($name, $title, $source, $value);

        $this->addExtraClass('font-picker-field');
    }

    public function getSchemaDataDefaults()
    {
        $schemaData = parent::getSchemaDataDefaults();

        $fonts = [];
        foreach ($this->getSource() as $css => $title) {
            $fonts[] = [
                'CSSClass' => $css,
                'Title' => $title,
            ];
        }

        $schemaData['source'] = $fonts;
        $schemaData['name'] = $this->getName();
        $schemaData['value'] = $this->Value();

        return $schemaData;
    }
}

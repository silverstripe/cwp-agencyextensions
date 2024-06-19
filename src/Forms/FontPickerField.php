<?php

namespace CWP\AgencyExtensions\Forms;

use SilverStripe\Forms\SingleSelectField;

class FontPickerField extends SingleSelectField
{
    /**
     * The default value if none is already configured
     *
     * @var string
     */
    const DEFAULT_VALUE = 'nunito-sans';

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

    public function Value()
    {
        return parent::Value() ?: FontPickerField::DEFAULT_VALUE;
    }
}

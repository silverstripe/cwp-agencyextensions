<?php

namespace CWP\AgencyExtensions\Tests\Forms;

use CWP\AgencyExtensions\Forms\FontPickerField;
use SilverStripe\Dev\SapphireTest;

class FontPickerFieldTest extends SapphireTest
{
    public function testValueReturnsDefaultValueIfFalsy()
    {
        $field = new FontPickerField('test');
        $this->assertSame(FontPickerField::DEFAULT_VALUE, $field->Value());
    }
}

<?php

class CWPSiteTreeLanguageExtentionTest extends SapphireTest
{
    /**
     * Test that the native language name can be returned for the current locale
     *
     * @see i18n
     * @param string $locale
     * @param string $expected
     * @dataProvider localeProvider
     */
    public function testGetSelectedLanguage($locale, $expected)
    {
        if (!class_exists('Translatable')) {
            $this->markTestSkipped('Language tests require Translatable module.');
        }

        Translatable::set_current_locale($locale);
        $class = new Page;
        $this->assertSame($expected, $class->getSelectedLanguage());
    }

    /**
     * @return array[]
     */
    public function localeProvider()
    {
        return array(
            array('en_NZ', 'English'),
            array('af_ZA', 'Afrikaans'),
            array('es_ES', 'espa&ntilde;ol')
        );
    }
}

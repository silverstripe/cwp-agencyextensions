<?php

/**
 * Class CWPSiteTreeLanguageExtention
 *
 * @property SiteTree|CWPSiteTreeLanguageExtention $owner
 */
class CWPSiteTreeLanguageExtention extends DataExtension
{
    /**
     * Returns the native language name for the selected locale/language, "Unknown" if Translatable is not available
     *
     * @return string
     */
    public function getSelectedLanguage()
    {
        if (!class_exists('Translatable')) {
            return 'Unknown';
        }

        $language = explode('_', Translatable::get_current_locale());
        $languageCode = array_shift($language);
        $nativeName = i18n::get_language_name($languageCode, true);

        return $nativeName;
    }
}

<?php

/**
 * Class CWPBasePageExtension
 *
 * @property BasePage|CWPBasePageExtension $owner
 */
class CWPBasePageExtension extends DataExtension
{
    /**
     * Provides data for translation navigation.
     * Collects all site translations, marks the current one, and redirects
     * to the translated home page if a. there is a translated homepage and b. the
     * translation of the specific page is not available.
     *
     * This function is modified from BasePage::getAvailableTranslations to
     * include the locale code for accessibility.
     *
     * @return ArrayList|false
     */
    public function getAvailableTranslationsWithLocale()
    {
        if (!class_exists('Translatable')) {
            return false;
        }

        $translations = new ArrayList();
        $globalTranslations = Translatable::get_existing_content_languages();

        foreach ($globalTranslations as $loc => $langName) {
            // Find out the language name in native language.
            $nativeLangName = i18n::get_language_name($loc, true);

            if (!$nativeLangName) {
                $nativeLangName = i18n::get_language_name(i18n::get_lang_from_locale($loc), true);
            }

            if (!$nativeLangName) {
                // Fall back to the locale name.
                $nativeLangName = $langName;
            }
            // Eliminate the part in brackets (e.g. [mandarin])
            $nativeLangName = preg_replace('/ *[\(\[].*$/', '', $nativeLangName);

            // Find out the link to the translated page.
            $link = null;
            $page = $this->owner->getTranslation($loc);
            if ($page) {
                $link = $page->Link();
            }
            if (!$link) {
                // Fall back to the home page
                $link = Translatable::get_homepage_link_by_locale($loc);
            }
            if (!$link) {
                continue;
            }

            // Assemble the table for the switcher.
            $translations->push(new ArrayData(array(
                'Locale' => i18n::convert_rfc1766($loc),
                'LangName' => $nativeLangName,
                'Link' => $link,
                'Current' => (Translatable::get_current_locale() == $loc)
            )));
        }

        if ($translations->count() > 1) {
            return $translations;
        }
    }
}

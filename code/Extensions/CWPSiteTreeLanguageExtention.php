<?php

class CWPSiteTreeLanguageExtention extends DataExtension
{
    /**
     * @return string
     */
    public function GetSelectedLocale()
    {
        if (!class_exists("Translatable")) {
            return "Unknown";
        }

        $name = i18n::get_locale_name(Translatable::get_current_locale());
        $parts = explode("(", $name);

        return $parts[0];
    }
}

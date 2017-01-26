<?php

/**
 * Class CWPPageExtension
 *
 * @property Page_Controller $owner
 */
class CWPPageExtension extends Extension
{

    /**
     * @return CWPSearchForm
     */
    public function SearchForm()
    {
        return CWPSearchForm::create($this->owner);
    }
}

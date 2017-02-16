<?php

/**
 * @property Form $owner
 */
class CWPFormExtension extends Extension
{
    public function afterCallActionHandler()
    {
        if (!$this->owner->validate()) {
            $message = _t('CWP.FORMEXTENSION.ErrorMessage', 'There has been a validation error');
            Session::set("FormInfo.{$this->owner->FormName()}.formError.message", $message);
            Session::set("FormInfo.{$this->owner->FormName()}.formError.type", 'danger'); // We use danger because of bootstrap styling.
        }
    }
}

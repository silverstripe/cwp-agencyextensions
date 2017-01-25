<?php

/**
 * Default CWP Search Form
 */
class CWPSearchForm extends Form
{
    /**
     * CWPSearchForm constructor.
     * @param Controller $controller
     * @param string $name
     */
    public function __construct(Controller $controller, $name)
    {
        $fields = FieldList::create([
            $searchField = TextField::create('search', "", $controller->getRequest()->getVar('search'))
        ]);

        $actions = FieldList::create([
            $submit = FormAction::create('search', _t('CWP.Search.SUBMIT', 'Submit'))
        ]);

        $form = parent::__construct($controller, 'search', $fields, $actions);
        $form->setStrictFormMethodCheck(true);

        // we override the default action and method so that search URLs can be shared
        $form->setFormAction('search');
        $form->setFormMethod('GET');

        // we disable CSRF checking so that search URLs can be shared
        $form->disableSecurityToken();
        $form->setTemplate("SearchForm");
    }
}

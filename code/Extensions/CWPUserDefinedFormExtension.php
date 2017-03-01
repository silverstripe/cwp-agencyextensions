<?php
/**
 * Used to populate sample userform data when installing the theme
 *
 * @property UserDefinedForm|CWPUserDefinedFormExtension $owner
 */
class CWPUserDefinedFormExtension extends DataExtension
{
    /**
     * Create an example contact form
     *
     * {@inheritDoc}
     */
    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        if ($this->getContactFormExists()) {
            return;
        }

        $this->createContactForm();
    }

    /**
     * Determine whether a "contact us" userform exists yet
     *
     * @return bool
     */
    protected function getContactFormExists()
    {
        return (int) UserDefinedForm::get()->filter('URLSegment', 'contact')->count() === 1;
    }

    /**
     * Create a "contact us" userform. Please note that this form does not have any recipients by default, so
     * no emails will be sent. To add recipients - edit the page in the CMS and add a recipient via the "Recipients"
     * tab.
     *
     * @return $this
     */
    protected function createContactForm()
    {
        $form = UserDefinedForm::create(array(
            'Title' => 'Contact',
            'URLSegment' => 'contact',
            'Content' => '<p>$UserDefinedForm</p>',
            'SubmitButtonText' => 'Submit',
            'ClearButtonText' => 'Clear',
            'OnCompleteMessage' => "<p>Thanks, we've received your submission and will be in touch shortly.</p>",
            'EnableLiveValidation' => true
        ));

        $form->write();

        // Add form fields
        $fields = array(
            EditableFormStep::create(array(
                'Title' => _t('EditableFormStep.TITLE_FIRST', 'First Page')
            )),
            EditableTextField::create(array(
                'Title' => 'Name',
                'Required' => true,
                'RightTitle' => 'Please enter your first and last name'
            )),
            EditableEmailField::create(array(
                'Title' => 'Email',
                'Required' => true,
                'Placeholder' => 'example@example.com'
            )),
            EditableTextField::create(array(
                'Title' => 'Subject'
            )),
            EditableTextField::create(array(
                'Title' => 'Message',
                'Required' => true,
                'Rows' => 5
            ))
        );

        foreach ($fields as $field) {
            $field->write();
            $form->Fields()->add($field);
            $field->publish('Stage', 'Live');
        }

        $form->publish('Stage', 'Live');
        $form->flushCache();

        DB::alteration_message('Created "contact" UserDefinedForm page', 'changed');

        return $this;
    }
}

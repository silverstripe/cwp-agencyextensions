<?php

/**
 * Class CWPHomePageExtension
 *
 * @property HomePage|CWPHomePageExtension $owner
 * @property string $JumbotronContent
 */
class CWPHomePageExtension extends DataExtension
{
    private static $db = [
        'JumbotronContent' => 'HTMLText'
    ];

    /**
     * Add the jumbotron content editor to its own tab for HomePage instances
     *
     * {@inheritDoc}
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Jumbotron', HtmlEditorField::create('JumbotronContent'));
    }
}

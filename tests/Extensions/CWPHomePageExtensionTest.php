<?php

class CWPHomePageExtensionTest extends SapphireTest
{
    /**
     * Ensure that the jumbotron content editor is in its own tab
     */
    public function testJumbotronContentEditorShouldBeInItsOwnTab()
    {
        $page = new HomePage;
        $fields = $page->getCMSFields();
        $this->assertInstanceOf(HtmlEditorField::class, $fields->fieldByName('Root.Jumbotron.JumbotronContent'));
    }
}

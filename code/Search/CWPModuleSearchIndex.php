<?php

class CWPModuleSearchIndex extends SolrSearchIndex
{

    /**
     * @inheritdoc
     * @throws \Exception
     */
    public function init()
    {
        $this->addClass("SiteTree");

        $this->addFulltextField("Title");
        $this->addFulltextField("MenuTitle");
        $this->addFulltextField("MetaDescription");
        $this->addFulltextField("ExtraMeta");
        $this->addFulltextField("Content");

        $this->addFilterField("ShowInSearch");
    }
}

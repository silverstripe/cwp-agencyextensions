<?php

/**
 * Created by PhpStorm.
 *
 * @property CWPSearchController dataRecord
 * @method CWPSearchController data()
 * @mixin CWPSearchController dataRecord
 */
class CWPSearchController extends Page_Controller
{
    private static $page_limit = 10;

    private static $allowed_actions = [
    ];

    public function index(SS_HTTPRequest $request)
    {
        $list = ArrayList::create();

        $limit = static::config()->get('page_limit');
        $total = 0;

        if ($search = $request->getVar('Search')) {
            $query = SearchQuery::create();
            $query->search($search);

            $offset = $request->getVar('start');

            if (!$offset) {
                $offset = 0;
            }

            /** @var ArrayData $results */
            $results = Injector::inst()->get('CWPIndexer')->search($query, $offset, $limit);

            /** @var PaginatedList $list */
            $list = $results->Matches;

            $limit = $list->getPageLength();
            $total = $list->getTotalItems();
        }

        $data = ArrayData::create([
            'Results' => $list,
            'Limit'   => min($limit, $total),
            'Total'   => $total,
        ]);
        return $this->renderWith(['Page_results', 'Page'], $data);
    }

    public function getTitle()
    {
        return 'Search ';
    }

    public function getMetaTitle()
    {
        return $this->getTitle() . $this->request->getVar('Search');
    }

    public function getSearchQuery()
    {
        return $this->request->getVar('Search');
    }
}

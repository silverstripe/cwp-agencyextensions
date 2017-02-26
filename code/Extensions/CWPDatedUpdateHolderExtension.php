<?php

/**
 * Class CWPDatedUpdateHolderExtension
 *
 * @property DatedUpdateHolder|CWPDatedUpdateHolderExtension $owner
 */
class CWPDatedUpdateHolderExtension extends DataExtension
{
    /**
     * Retuns a filter context string for the template containing each applied filter context
     *
     * @return string|null
     */
    public function FilteredContext()
    {
        $request = Controller::curr()->getRequest();

        $tag = null;
        if ($request->getVar('tag')) {
            $tags = $this->owner->UpdateTags()->filter('ID', $request->getVar('tag'));
            if ($tags->count() > 0) {
                $tag = $tags->first()->Name;
            }
        }

        $fromDate = $this->convertDateToNice($request->getVar('from'));
        $toDate = $this->convertDateToNice($request->getVar('to'));
        $month = $this->convertMonthToName($request->getVar('month'));
        $year = $request->getVar('year');


        $context = array();
        if ($tag) {
            $context[] = _t('CWP.NewsEventHolder.FilteredContext_Tagged', 'tagged <b>{tagname}</b>', array('tagname' => $tag));
        }

        if ($fromDate) {
            $context[] = _t('CWP.NewsEventHolder.FilteredContext_From', 'from {from}', array('from' => $fromDate));
        }

        if ($toDate) {
            $context[] = _t('CWP.NewsEventHolder.FilteredContext_To', 'to {to}', array('to' => $toDate));
        }

        if ($month) {
            $context[] = _t('CWP.NewsEventHolder.FilteredContext_Month', 'for {month}', array('month' => $month));
        }

        if ($year) {
            $context[] = _t('CWP.NewsEventHolder.FilteredContext_Year', '{year}', array('year' => $year));
        }

        if (!empty($context)) {
            return _t('CWP.NewsEventHolder.FilteredContext', 'Showing filtered results ') . implode(' ', $context);
        }
    }

    /**
     * Takes an unformatted date and returns it in a short, nice format for the template
     *
     * @param  string $date
     * @return string
     */
    protected function convertDateToNice($date)
    {
        if (empty($date)) {
            return;
        }

        $datetime = SS_Datetime::create();
        $datetime->setValue($date);
        return $datetime->Format('d/m/y');
    }

    /**
     * Takes a month number and converts it to its corresponding month name
     *
     * @param  string $month
     * @return string
     */
    protected function convertMonthToName($month)
    {
        if (empty($month)) {
            return;
        }

        $dateObj = DateTime::createFromFormat('!m', $month);
        return $dateObj->format('F');
    }
}

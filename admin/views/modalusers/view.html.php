<?php
defined("_JEXEC") or die();

class TestingViewModalusers extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;
    protected $listOrder;
    protected $listDirn;

    public $filterForm;
    public $activeFilters;

    public function display($tpl = null)
    {
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->listOrder = $this->state->get('list.ordering');
        $this->listDirn = $this->state->get('list.direction');

        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        parent::display($tpl);
    }
}

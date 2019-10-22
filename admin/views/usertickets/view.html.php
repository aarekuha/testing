<?php
defined("_JEXEC") or die();

class TestingViewUsertickets extends JViewLegacy {

    protected $items;
    protected $state;
    protected $listOrder;
    protected $listDirn;

    public $filterForm;
    public $activeFilters;

    protected $pagination;

    public function display($tpl = null)
    {
        $this->sidebar = TestingHelper::addSubMenu("usertickets");
        $this->addToolBar();
        $this->setDocument();

        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->listOrder = $this->state->get('list.ordering');
        $this->listDirn = $this->state->get('list.direction');

        $this->pagination = $this->get('Pagination');

        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JToolbarHelper::title(JText::_("COM_TESTING_USER_TICKETS_TITLE"));

        JToolbarHelper::addNew('userticket.add', 'COM_TESTING_ADD_USER_TICKET');
        JToolbarHelper::deleteList('COM_TESTING_DELETE_USER_TICKET_ASK', 'usertickets.delete', "COM_TESTING_DELETE_TICKETS");
    }

    protected function setDocument()
    {

    }
}
?>
<?php
defined("_JEXEC") or die();

class TestingViewUsers extends JViewLegacy {

    protected $items;
    protected $state;
    protected $listOrder;
    protected $listDirn;

    public $filterForm;
    public $activeFilters;

    protected $pagination;

    public function display($tpl = null)
    {
        $this->sidebar = TestingHelper::addSubMenu("users");
        $this->addToolBar();
        $this->setDocument();

        $this->items = $this->get('Items');
        $this->state = $this->get('State');
        $this->listOrder = $this->state->get('list.ordering');
        $this->listDirn = $this->state->get('list.direction');

        $this->pagination = $this->get('Pagination');

        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JToolbarHelper::title(JText::_("COM_TESTING_USERS_TITLE"));

        JToolbarHelper::addNew('user.add', 'COM_TESTING_ADD_USER');
        JToolbarHelper::deleteList('COM_TESTING_DELETE_USERS_ASK', 'users.delete', "COM_TESTING_DELETE_USERS");
    }

    protected function setDocument()
    {

    }
}
?>
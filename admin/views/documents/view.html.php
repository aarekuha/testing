<?php
defined("_JEXEC") or die();

class TestingViewDocuments extends JViewLegacy {

    protected $items;
    protected $state;
    protected $listOrder;
    protected $listDirn;

    public $filterForm;
    public $activeFilters;

    protected $pagination;

    public function display($tpl = null)
    {
        $this->sidebar = TestingHelper::addSubMenu("documents");
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
        JToolbarHelper::title(JText::_("COM_TESTING_DOCUMENTS_TITLE"));

        JToolbarHelper::addNew('document.add', 'COM_TESTING_ADD_DOCUMENT');
        JToolbarHelper::deleteList('COM_TESTING_DELETE_DOCUMENTS_ASK', 'documents.delete', "COM_TESTING_DELETE_DOCUMENTS");
    }

    protected function setDocument()
    {

    }
}
?>
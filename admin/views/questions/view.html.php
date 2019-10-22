<?php
defined("_JEXEC") or die();

class TestingViewQuestions extends JViewLegacy {

    protected $sidebar;

    protected $items;
    protected $pagination;
    protected $state;

    protected $listOrder;
    protected $listDirection;

    public $filterForm;
    public $activeFilters;

    public function display($tpl = null)
    {
        $this->sidebar = TestingHelper::addSubMenu("questions");

        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->listOrder = $this->escape($this->state->get('list.ordering'));
        $this->listDirection = $this->escape($this->state->get('list.direction'));

        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        $this->addToolBar();
        $this->setDocument();

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JToolbarHelper::title(JText::_("COM_TESTING_QUESTIONS_TITLE"));

        JToolbarHelper::addNew('question.add', 'COM_TESTING_ADD_QUESTION');
        JToolbarHelper::deleteList('COM_TESTING_DELETE_QUESTIONS_ASK', 'questions.delete', "COM_TESTING_DELETE_QUESTIONS");
    }

    protected function setDocument()
    {

    }
}
?>
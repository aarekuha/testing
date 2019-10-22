<?php
defined('_JEXEC') or die('Restricted access');

class TestingViewHelloWorlds extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $filterForm;
    protected $activeFilters;
    protected $canDo;

    function display($tpl = null)
    {
        // Get application
//        $app = JFactory::getApplication();
//        $context = "helloworld.list.admin.helloworld";
        // Get data from the model
        $this->items			= $this->get('Items');
        $this->pagination		= $this->get('Pagination');
        var_dump($this->get('State'));
        exit;
        $this->state			= $this->get('State');
        $this->filterForm    	= $this->get('FilterForm');
        $this->activeFilters 	= $this->get('ActiveFilters');

        // Check for errors.
//        if (count($errors = $this->get('Errors')))
//        {
//            JError::raiseError(500, implode('<br />', $errors));
//
//            return false;
//        }

        // Set the sidebar submenu and toolbar, but not on the modal window
        if ($this->getLayout() !== 'modal')
        {
//            HelloWorldHelper::addSubmenu('helloworlds');
            $this->addToolBar();
        }

        // Display the template
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolBar()
    {
        $title = JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLDS');

        if ($this->pagination->total)
        {
            $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
        }
    }
    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION'));
    }
}
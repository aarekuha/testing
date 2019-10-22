<?php
defined("_JEXEC") or die();

class TestingViewUserticket extends JViewLegacy {

    protected $form = null;
    protected $item = null;

    public function display($tmpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolBar();
        $this->setDocument();

        parent::display($tmpl);
    }

    protected function addToolBar()
    {
        $title = JText::_("COM_TESTING_USER_TICKET_TITLE_NEW");
        JToolbarHelper::title($title);

        JToolbarHelper::apply('userticket.apply');
        JToolbarHelper::save('userticket.save');
        JToolbarHelper::cancel('userticket.cancel');
    }

    protected function setDocument()
    {

    }
}
?>

<?php
defined("_JEXEC") or die();

class TestingViewUser extends JViewLegacy {

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
        $isNew = ($this->item->id == 0);

        $title = ($isNew) ? JText::_("COM_TESTING_USER_TITLE_NEW") : JText::_("COM_TESTING_USER_TITLE_EDIT");
        JToolbarHelper::title($title);

        JToolbarHelper::save('user.save');
        JToolbarHelper::cancel('user.cancel');
    }

    protected function setDocument()
    {

    }
}
?>

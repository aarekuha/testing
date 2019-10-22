<?php
defined("_JEXEC") or die();

class TestingViewDocument extends JViewLegacy {

    protected $form = null;
    protected $item = null;
    protected $id = 0;

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
        $this->id = ($this->item) ? $this->item->id : $this->id;
        $isNew = ($this->id == 0);

        $title = ($isNew) ? JText::_("COM_TESTING_DOCUMENT_TITLE_NEW") : JText::_("COM_TESTING_DOCUMENT_TITLE_EDIT");
        JToolbarHelper::title($title);

        JToolbarHelper::save('document.save');
        JToolbarHelper::cancel('document.cancel');
    }

    protected function setDocument()
    {

    }
}
?>

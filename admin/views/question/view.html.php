<?php
defined("_JEXEC") or die();

class TestingViewQuestion extends JViewLegacy {

    protected $form;
    protected $item;

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

        $title = ($isNew) ? JText::_("COM_TESTING_QUESTION_TITLE_NEW") : JText::_("COM_TESTING_QUESTION_TITLE_EDIT");
        JToolbarHelper::title($title);

        JToolbarHelper::apply('question.apply');
        JToolbarHelper::save('question.save');
        JToolbarHelper::cancel('question.cancel');
    }

    protected function setDocument()
    {

    }
}
?>
